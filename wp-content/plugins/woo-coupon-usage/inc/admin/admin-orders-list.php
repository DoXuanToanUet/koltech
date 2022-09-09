<?php

if ( !defined( 'ABSPATH' ) ) {
    exit;
}
// Create Order Columns
function wusage_add_order_column_header( $columns )
{
    $options = get_option( 'wcusage_options' );
    $wcusage_show_column_code = wcusage_get_setting_value( 'wcusage_field_show_column_code', '1' );
    $new_columns = array();
    foreach ( $columns as $column_name => $column_info ) {
        $new_columns[$column_name] = $column_info;
        if ( $wcusage_show_column_code ) {
            if ( 'order_total' === $column_name ) {
                $new_columns['wcu_order_affiliate_coupon'] = __( 'Coupon / Affiliate', 'woo-coupon-usage' );
            }
        }
    }
    return $new_columns;
}

add_filter( 'manage_edit-shop_order_columns', 'wusage_add_order_column_header', 20 );
// Getting Order Meta
if ( !function_exists( 'wcusage_helper_get_order_meta' ) ) {
    function wcusage_helper_get_order_meta(
        $order,
        $key = '',
        $single = true,
        $context = 'edit'
    )
    {
        // WooCommerce > 3.0
        
        if ( defined( 'WC_VERSION' ) && WC_VERSION && version_compare( WC_VERSION, '3.0', '>=' ) ) {
            $value = $order->get_meta( $key, $single, $context );
        } else {
            // have the $order->get_id() check here just in case the WC_VERSION isn't defined correctly
            $order_id = ( is_callable( array( $order, 'get_id' ) ) ? $order->get_id() : $order->id );
            $value = get_post_meta( $order_id, $key, $single );
        }
        
        return $value;
    }

}
function wusage_add_order_column_content( $column )
{
    global  $post ;
    $order = wc_get_order( $post->ID );
    $affiliate = array();
    $coupon_codes = array();
    $coupon_code = "";
    $nocoupon = true;
    
    if ( $order ) {
        $recurringaffiliate = $order->get_meta( 'lifetime_affiliate_coupon_referrer' );
        $wcusage_field_lifetime = wcusage_get_setting_value( 'wcusage_field_lifetime', '0' );
        if ( class_exists( 'WooCommerce' ) ) {
            if ( version_compare( WC_VERSION, 3.7, ">=" ) ) {
                foreach ( $order->get_coupon_codes() as $coupon_code ) {
                    // Get the WC_Coupon object;
                    $getcoupon = wcusage_get_coupon_info( $coupon_code );
                    
                    if ( !$recurringaffiliate && $wcusage_field_lifetime || $coupon_code == $recurringaffiliate || !$wcusage_field_lifetime && !$recurringaffiliate ) {
                        
                        if ( $coupon_code ) {
                            
                            if ( $coupon_code != $recurringaffiliate ) {
                                $coupon_code_linked = wcusage_output_affiliate_info_orders( $coupon_code, $post, "" );
                            } else {
                                $coupon_code_linked = wcusage_output_affiliate_info_orders( $coupon_code, $post, "returncoupon" );
                            }
                            
                            array_push( $affiliate, "" );
                            array_push( $coupon_codes, $coupon_code_linked );
                        }
                        
                        $nocoupon = false;
                    }
                
                }
            }
        }
        
        if ( $nocoupon && $recurringaffiliate ) {
            $coupon_code_linked = wcusage_output_affiliate_info_orders( $recurringaffiliate, $post, "return" );
            array_push( $affiliate, "" );
            array_push( $coupon_codes, $coupon_code_linked );
        }
        
        $affiliate = implode( ', ', $affiliate );
        if ( !$affiliate ) {
            $affiliate = "-";
        }
        $coupon_codes = implode( '<br>', $coupon_codes );
        if ( !$coupon_codes ) {
            $coupon_codes = "-";
        }
        if ( 'wcu_order_affiliate_coupon' === $column ) {
            echo  $coupon_codes ;
        }
        if ( 'wcu_order_affiliate' === $column ) {
            echo  $affiliate ;
        }
        //if ( 'wcu_order_affiliate_commission' === $column ) {
        //    echo '' . wcusage_get_currency_symbol() . number_format((float)$commission, 2, '.', '');
        //}
    }

}

add_action( 'manage_shop_order_posts_custom_column', 'wusage_add_order_column_content' );
// Get the affiliate info tooltip
function wcusage_output_affiliate_info_orders( $coupon_code, $post, $islifetime )
{
    $getinfo = wcusage_get_the_order_coupon_info( $coupon_code, "", $post );
    $order = wc_get_order( $post->ID );
    // Lifetime Text
    
    if ( $islifetime == "return" ) {
        $islifetimetext = "<p style='margin: 0;'>(Lifetime Referral Sale)</p>";
        $islifetimeicon = "<span class='wcu-tooltop-lifetime'>" . wc_help_tip( "(Lifetime Commission)<br/>This is a returning customer that didn't use the coupon code at checkout, but is a linked as a 'lifetime referral' for this affiliate coupon." ) . "</span>";
    } elseif ( $islifetime == "returncoupon" ) {
        $islifetimetext = "<p style='margin: 0;'>(Lifetime Referral Sale)</p>";
        $islifetimeicon = "<span class='wcu-tooltop-lifetime2'>" . wc_help_tip( "(Lifetime Commission)<br/>This is a lifetime referral that used the affiliates coupon code at checkout." ) . "</span>";
    } else {
        $islifetimetext = "";
        $islifetimeicon = "";
    }
    
    // Commission
    
    if ( $getinfo['thecommissionnum'] > 0 && $order->get_status() != "refunded" ) {
        $commissiontext = __( 'Commission', 'woo-coupon-usage' ) . ": " . $getinfo['thecommission'] . "<br/>";
    } else {
        $commissiontext = "";
    }
    
    // MLA Commission
    $mla_text = "";
    $wcusage_field_mla_enable = wcusage_get_setting_value( 'wcusage_field_mla_enable', '0' );
    
    if ( $wcusage_field_mla_enable && wcu_fs()->can_use_premium_code() ) {
        $get_parents = get_user_meta( $getinfo['theuserid'], 'wcu_ml_affiliate_parents', true );
        
        if ( !empty($get_parents) && is_array( $get_parents ) ) {
            $mla_text .= "<br/><p style='margin: 0;'><strong>MLA Commission:</strong>";
            foreach ( $get_parents as $key => $parent_id ) {
                $parent_user_info = get_user_by( 'ID', $parent_id );
                $parent_user_name = $parent_user_info->user_login;
                $parent_user_id = $parent_user_info->ID;
                $coupon_info = wcusage_get_coupon_info( $coupon_code );
                $coupon_id = $coupon_info[2];
                $parent_commission = wcusage_mla_get_commission_from_tier( $getinfo['thecommissionnum'], $key );
                $mla_text .= "<br/>(" . $key . ") <a href='/wp-admin/user-edit.php?user_id=" . $parent_user_id . "' target='_blank' style='color: #07bbe3;'>" . $parent_user_name . "</a>: " . wcusage_format_price( $parent_commission );
            }
            $mla_text .= "</p>";
        }
    
    }
    
    // Message
    $coupon_code_linked = '<span class="wcusage-orders-affiliate-column">' . $islifetimeicon . '<a href="' . $getinfo['uniqueurl'] . '" target="_blank">' . $coupon_code . '</a> ' . wc_help_tip( "<span style='font-size: 18px;'>" . $coupon_code . "</span>" . $islifetimetext . "<p style='margin: 0;'>" . $getinfo['affililiateusertext'] . $commissiontext . "<a href='" . $getinfo['uniqueurl'] . "' target='_blank' class='wcu-affiliate-tooltip-dashboard-button'>" . __( 'View Dashboard', 'woo-coupon-usage' ) . "</a></p>" . $mla_text . "</span>" );
    return $coupon_code_linked;
}

// Styling
function wcusage_wc_cogs_add_order_profit_column_style()
{
    $css = '.widefat .column-wcu_order_affiliate_coupon, .widefat .column-wcu_order_affiliate, .widefat .column-wcu_order_affiliate_commission { max-width: 100px; text-align: right; }';
    wp_add_inline_style( 'woocommerce_admin_styles', $css );
}

add_action( 'admin_print_styles', 'wcusage_wc_cogs_add_order_profit_column_style' );
// Get The Order Coupon Info
function wcusage_get_the_order_coupon_info( $coupon_code, $coupon_post_object, $post )
{
    $orderinfo = wc_get_order( $post->ID );
    
    if ( $coupon_code ) {
        $options = get_option( 'wcusage_options' );
        $coupon_info = wcusage_get_coupon_info( $coupon_code );
        $commission = 0;
        $coupon_id = $coupon_info[2];
        // Commission
        $order_data = wcusage_calculate_order_data(
            $post->ID,
            $coupon_code,
            0,
            1
        );
        
        if ( isset( $order_data['totalcommission'] ) ) {
            $commission += $order_data['totalcommission'];
        } else {
            $commission = 0;
        }
        
        $thecommission = wcusage_get_base_currency_symbol() . number_format(
            $commission,
            2,
            '.',
            ''
        );
        // User
        $theuserid = "";
        $couponuser = get_post_meta( $coupon_id, 'wcu_select_coupon_user', true );
        
        if ( $couponuser ) {
            $current_user = get_user_by( 'id', $couponuser );
            $username = "";
            if ( $current_user ) {
                $username = $current_user->user_login;
            }
            
            if ( $username ) {
                $theuser = '<a href="' . get_site_url() . '/wp-admin/user-edit.php?user_id=' . $couponuser . '" target="_blank" class="wcu-affiliate-tooltip-user-button">' . $username . '</a>';
                $theuserid = $username = $current_user->ID;
            } else {
                $theuser = '';
            }
        
        } else {
            $theuser = '';
        }
        
        // Coupon Code & Link
        $thepageurl = wcusage_get_coupon_shortcode_page( 1 );
        $wcusage_justcoupon = wcusage_get_setting_value( 'wcusage_field_justcoupon', '1' );
        
        if ( $wcusage_justcoupon ) {
            $secretid = $coupon_code;
        } else {
            $secretid = $coupon_code . "-" . $coupon_id;
        }
        
        $uniqueurl = $thepageurl . 'couponid=' . $secretid;
        $affililiateusertext = "";
        // Currency Conversion
        $thecommissionpaid = get_post_meta( $post->ID, 'wcu_commission_paid', true );
        if ( $thecommissionpaid ) {
            $thecommission = wcusage_format_price( $thecommissionpaid );
        }
        $return_array = [];
        $return_array['uniqueurl'] = $uniqueurl;
        $return_array['affililiateusertext'] = $affililiateusertext;
        $return_array['thecommission'] = $thecommission;
        $return_array['thecommissionnum'] = $commission;
        $return_array['theuser'] = $theuser;
        $return_array['theuserid'] = $theuserid;
        return $return_array;
    } else {
        return "";
    }

}
