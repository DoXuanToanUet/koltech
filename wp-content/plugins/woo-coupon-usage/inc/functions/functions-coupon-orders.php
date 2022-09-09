<?php

if ( !defined( 'ABSPATH' ) ) {
    exit;
}
/**
 * Get Orders For Coupon Code Within Date Range
 *
 * @param string $coupon_code
 * @param date $start_date
 * @param date $end_date
 * @param int $numberoforders
 * @param bool $refresh
 * @param bool $update
 *
 * @return mixed
 *
 */
if ( !function_exists( 'wcusage_wh_getOrderbyCouponCode' ) ) {
    function wcusage_wh_getOrderbyCouponCode(
        $coupon_code,
        $start_date,
        $end_date,
        $numberoforders = '',
        $refresh = 1,
        $update = 0
    )
    {
        $coupon_code = sanitize_text_field( $coupon_code );
        $start_date = sanitize_text_field( $start_date );
        $end_date = sanitize_text_field( $end_date );
        $coupon_code = strtolower( $coupon_code );
        $couponinfo = wcusage_get_coupon_info( $coupon_code );
        $options = get_option( 'wcusage_options' );
        $wcu_save_all_stats_as_meta = wcusage_get_setting_value( 'wcusage_field_enable_coupon_all_stats_meta', '1' );
        if ( !$wcu_save_all_stats_as_meta ) {
            delete_post_meta( $couponinfo[2], 'wcu_alltime_stats' );
        }
        $wcu_all_total_orders = "";
        $wcu_all_full_discount = "";
        $wcu_all_total_commission = "";
        $wcu_alltime_stats = get_post_meta( $couponinfo[2], 'wcu_alltime_stats', true );
        
        if ( $wcu_alltime_stats && $wcu_save_all_stats_as_meta ) {
            if ( isset( $wcu_alltime_stats['total_orders'] ) ) {
                $wcu_all_total_orders = $wcu_alltime_stats['total_orders'];
            }
            if ( isset( $wcu_alltime_stats['full_discount'] ) ) {
                $wcu_all_full_discount = $wcu_alltime_stats['full_discount'];
            }
            if ( isset( $wcu_alltime_stats['total_commission'] ) ) {
                $wcu_all_total_commission = $wcu_alltime_stats['total_commission'];
            }
        }
        
        $list_of_products = "";
        //$refresh = 1;
        
        if ( $refresh || $start_date && $end_date || $numberoforders || !$wcu_all_total_orders || !$wcu_all_full_discount || !$wcu_all_total_commission || !$wcu_save_all_stats_as_meta ) {
            global  $wpdb ;
            $return_array = [];
            $total_discount = 0;
            $total_orders = 0;
            $total_shipping = 0;
            $total_count = 0;
            $total_commission = 0;
            
            if ( $numberoforders ) {
                $limit = "LIMIT " . $numberoforders;
            } else {
                $limit = "";
            }
            
            $wcusage_field_order_sort = wcusage_get_setting_value( 'wcusage_field_order_sort', '' );
            $wcu_text_coupon_start_date = get_post_meta( $couponinfo[2], 'wcu_text_coupon_start_date', true );
            if ( $wcu_text_coupon_start_date ) {
                if ( strtotime( $start_date ) < strtotime( $wcu_text_coupon_start_date ) || !$start_date ) {
                    $start_date = $wcu_text_coupon_start_date;
                }
            }
            if ( !$start_date ) {
                $start_date = "2000-01-01";
            }
            // Check if enable lifetime
            $wcusage_field_lifetime_all = wcusage_get_setting_value( 'wcusage_field_lifetime_all', '0' );
            $wcu_coupon_enable_lifetime_commission = get_post_meta( $couponinfo[2], 'wcu_enable_lifetime_commission', true );
            
            if ( $wcusage_field_lifetime_all || $wcu_coupon_enable_lifetime_commission ) {
                $enablelifetime = true;
            } else {
                $enablelifetime = false;
            }
            
            $wcusage_field_order_type_custom = wcusage_get_setting_value( 'wcusage_field_order_type_custom', '' );
            
            if ( !$wcusage_field_order_type_custom ) {
                $statuses = wc_get_order_statuses();
                if ( isset( $statuses['wc-refunded'] ) ) {
                    unset( $statuses['wc-refunded'] );
                }
            } else {
                $statuses = $wcusage_field_order_type_custom;
            }
            
            
            if ( $wcusage_field_order_sort != "completeddate" ) {
                // Get By Paid date
                
                if ( wcu_fs()->is_premium() && $enablelifetime ) {
                } else {
                    // DO NOT include lifetime commissions
                    $query = "SELECT\r\n p.ID AS order_id\r\n\r\n  \t\t\t\tFROM\r\n {$wpdb->prefix}posts AS p\r\n\r\n  \t\t\t\tINNER JOIN {$wpdb->prefix}woocommerce_order_items AS woi\r\n  \t\t\t\tON p.ID = woi.order_id\r\n\r\n  \t\t\t\tWHERE\r\n p.post_type IN ('shop_order')\r\n  \t\t\t\tAND\r\n p.post_status IN ('" . implode( "','", array_keys( $statuses ) ) . "')\r\n  \t\t\t\tAND\r\n woi.order_item_type IN ('coupon')\r\n  \t\t\t\tAND\r\n woi.order_item_name IN ('" . $coupon_code . "')\r\n  \t\t\t\tAND\r\n DATE(p.post_date) BETWEEN '" . $start_date . "' AND '" . $end_date . "'\r\n  \t\t\t\tORDER BY p.post_date DESC " . $limit . ";";
                }
            
            } else {
                // Get By Completed date
                
                if ( wcu_fs()->is_premium() && $enablelifetime ) {
                } else {
                    // DO NOT include lifetime commissions
                    $query = "SELECT\r\n p.ID AS order_id\r\n\r\n  \t\t\t\tFROM\r\n {$wpdb->prefix}posts AS p\r\n\r\n  \t\t\t\tINNER JOIN {$wpdb->prefix}woocommerce_order_items AS woi ON p.ID = woi.order_id\r\n\r\n  \t\t\t\tINNER JOIN {$wpdb->prefix}postmeta AS woib ON woi.order_id = woib.post_id AND '_completed_date' = woib.meta_key\r\n  \t\t\t\tAND\r\n p.post_status IN ('" . implode( "','", array_keys( $statuses ) ) . "')\r\n  \t\t\t\tAND\r\n woi.order_item_type IN ('coupon')\r\n  \t\t\t\tAND\r\n woi.order_item_name IN ('" . $coupon_code . "')\r\n  \t\t\t\tAND\r\n (woib.meta_key = '_completed_date' AND date(woib.meta_value) BETWEEN '" . $start_date . "' AND '" . $end_date . "')\r\n  \t\t\t\tORDER BY woib.meta_value DESC " . $limit . ";";
                }
            
            }
            
            $orders = $wpdb->get_results( $query );
            $orders = array_reverse( $orders );
            $list_of_products = array();
            $commission_summary = array();
            $wcusage_show_tax = wcusage_get_setting_value( 'wcusage_field_show_tax', '0' );
            
            if ( !empty($orders) ) {
                $dp = ( isset( $filter['dp'] ) ? intval( $filter['dp'] ) : 2 );
                //looping throught all the order_id
                foreach ( $orders as $key => $order ) {
                    $order_id = $order->order_id;
                    
                    if ( $order_id ) {
                        //getting order object
                        $objOrder = wc_get_order( $order_id );
                        $theorderstatus = $objOrder->get_status();
                        $theordertotal = $objOrder->get_total();
                        $theordertotaltax = $objOrder->get_total_tax();
                        $check_status_show = wcusage_check_status_show( $theorderstatus );
                        // Check Lifetime
                        $lifetimecheck = wcusage_check_lifetime_or_coupon( $order_id, $coupon_code );
                        // Subscription renewals check
                        $renewalcheck = wcusage_check_if_renewal_allowed( $order_id );
                        
                        if ( ($theorderstatus == "completed" || $check_status_show) && $renewalcheck && $lifetimecheck ) {
                            
                            if ( $update ) {
                                $calculateorder = wcusage_calculate_order_data(
                                    $order_id,
                                    $coupon_code,
                                    1,
                                    0
                                );
                            } else {
                                $calculateorder = wcusage_calculate_order_data(
                                    $order_id,
                                    $coupon_code,
                                    0,
                                    1
                                );
                            }
                            
                            
                            if ( isset( $calculateorder['totalorders'] ) ) {
                                $shipping_data_total = 0;
                                $return_array[$key]['order_id'] = $order_id;
                                $order_totals = wcusage_get_order_totals( $order_id );
                                // Get Totals For Order
                                $return_array[$key]['total'] = $calculateorder['totalorders'];
                                $return_array[$key]['total_discount'] = $calculateorder['totaldiscounts'];
                                $return_array[$key]['total_shipping'] = $order_totals['total_shipping'];
                                // Get Totals
                                $this_total_discount = $return_array[$key]['total_discount'];
                                $this_total_orders = $return_array[$key]['total'];
                                $this_total_shipping = $return_array[$key]['total_shipping'];
                                // Convert Currency
                                $currencycode = $objOrder->get_currency();
                                $wcusage_currency_conversion = get_post_meta( $order_id, 'wcusage_currency_conversion', true );
                                $enable_save_rate = wcusage_get_setting_value( 'wcusage_field_enable_currency_save_rate', '0' );
                                if ( !$wcusage_currency_conversion || !$enable_save_rate ) {
                                    $wcusage_currency_conversion = "";
                                }
                                $enablecurrency = wcusage_get_setting_value( 'wcusage_field_enable_currency', '0' );
                                
                                if ( $enablecurrency ) {
                                    $this_total_discount = wcusage_calculate_currency( $currencycode, $this_total_discount, $wcusage_currency_conversion );
                                    $this_total_orders = wcusage_calculate_currency( $currencycode, $this_total_orders, $wcusage_currency_conversion );
                                    $this_total_shipping = wcusage_calculate_currency( $currencycode, $this_total_shipping, $wcusage_currency_conversion );
                                }
                                
                                // Add To Combined Total
                                $total_discount += $this_total_discount;
                                $total_orders += $this_total_orders;
                                $total_shipping += $this_total_shipping;
                                $total_count++;
                                $affiliatecommission = $calculateorder['totalcommission'];
                                $total_commission += $affiliatecommission;
                                // Get List Products
                                $items = $objOrder->get_items();
                                $order_refunds = $objOrder->get_refunds();
                                $refunded_quantity = 0;
                                foreach ( $items as $item_id => $item ) {
                                    $refunded_quantity = 0;
                                    foreach ( $order_refunds as $refund ) {
                                        foreach ( $refund->get_items() as $item_id => $item2 ) {
                                            
                                            if ( $item2->get_product_id() == $item['product_id'] ) {
                                                $refunded_quantity += abs( $item2->get_quantity() );
                                                // Get Refund Qty
                                            }
                                        
                                        }
                                    }
                                    $product_id = $item->get_product_id();
                                    if ( !$product_id ) {
                                        $product_id = 0;
                                    }
                                    $product_quantity = $item->get_quantity() - $refunded_quantity;
                                    if ( !$product_quantity ) {
                                        $product_quantity = 0;
                                    }
                                    
                                    if ( isset( $list_of_products[$product_id] ) ) {
                                        $list_of_products[$product_id] += $product_quantity;
                                    } else {
                                        $list_of_products[$product_id] = $product_quantity;
                                    }
                                
                                }
                            }
                        
                        }
                        
                        // Add to $commission_summary Array
                        
                        if ( !empty($calculateorder['commission_summary']) ) {
                            $a2 = $calculateorder['commission_summary'];
                            $a1 = $commission_summary;
                            foreach ( array_keys( $a1 + $a2 ) as $key ) {
                                $commission_summary[$key]['total'] = (( isset( $a1[$key]['total'] ) ? $a1[$key]['total'] : 0 )) + (( isset( $a2[$key]['total'] ) ? $a2[$key]['total'] : 0 ));
                                $commission_summary[$key]['commission'] = (( isset( $a1[$key]['commission'] ) ? $a1[$key]['commission'] : 0 )) + (( isset( $a2[$key]['commission'] ) ? $a2[$key]['commission'] : 0 ));
                                $commission_summary[$key]['number'] = (( isset( $a1[$key]['number'] ) ? $a1[$key]['number'] : 0 )) + (( isset( $a2[$key]['number'] ) ? $a2[$key]['number'] : 0 ));
                            }
                        }
                    
                    }
                
                }
            }
            
            
            if ( $refresh && $update ) {
                $allstats = array();
                $allstats['total_orders'] = $total_orders;
                $allstats['full_discount'] = $total_discount;
                $allstats['total_commission'] = $total_commission;
                $allstats['total_shipping'] = $total_shipping;
                $allstats['total_count'] = $total_count;
                $allstats['commission_summary'] = $commission_summary;
                update_post_meta( $couponinfo[2], 'wcu_alltime_stats', $allstats );
            }
            
            //delete_post_meta( $couponinfo[2], 'wcu_alltime_stats' );
        } else {
            
            if ( isset( $wcu_alltime_stats['total_orders'] ) ) {
                $total_orders = $wcu_alltime_stats['total_orders'];
            } else {
                $total_orders = 0;
            }
            
            
            if ( isset( $wcu_alltime_stats['full_discount'] ) ) {
                $total_discount = $wcu_alltime_stats['full_discount'];
            } else {
                $total_discount = 0;
            }
            
            
            if ( isset( $wcu_alltime_stats['total_commission'] ) ) {
                $total_commission = $wcu_alltime_stats['total_commission'];
            } else {
                $total_commission = 0;
            }
            
            
            if ( isset( $wcu_alltime_stats['total_shipping'] ) ) {
                $total_shipping = $wcu_alltime_stats['total_shipping'];
            } else {
                $total_shipping = 0;
            }
            
            
            if ( isset( $wcu_alltime_stats['total_count'] ) ) {
                $total_count = $wcu_alltime_stats['total_count'];
            } else {
                $total_count = 0;
            }
            
            
            if ( isset( $wcu_alltime_stats['commission_summary'] ) ) {
                $commission_summary = $wcu_alltime_stats['commission_summary'];
            } else {
                $commission_summary = "";
            }
        
        }
        
        if ( !$total_orders || !is_numeric( $total_orders ) ) {
            $total_orders = 0;
        }
        if ( !$total_shipping || !is_numeric( $total_shipping ) ) {
            $total_shipping = 0;
        }
        if ( !$list_of_products ) {
            $list_of_products = "";
        }
        $return_array['list_of_products'] = $list_of_products;
        $return_array['total_count'] = $total_count;
        $return_array['full_discount'] = $total_discount;
        //$return_array['total_orders'] = $total_orders;
        $return_array['total_shipping'] = $total_shipping;
        $return_array['total_orders'] = $total_orders;
        $return_array['total_commission'] = $total_commission;
        $return_array['commission_summary'] = $commission_summary;
        return $return_array;
    }

}
/**
 * Check if the current order status can be shown
 *
 * @param string $theorderstatus
 *
 * @return bool
 *
 */
if ( !function_exists( 'wcusage_check_status_show' ) ) {
    function wcusage_check_status_show( $theorderstatus )
    {
        $wcusage_field_order_type = wcusage_get_setting_value( 'wcusage_field_order_type', '' );
        $wcusage_field_order_type_custom = wcusage_get_setting_value( 'wcusage_field_order_type_custom', '' );
        $isthistrue = false;
        
        if ( is_string( $theorderstatus ) ) {
            // Check Old Settings
            
            if ( !$wcusage_field_order_type_custom ) {
                if ( $wcusage_field_order_type != "completed" ) {
                    if ( $theorderstatus == "processing" || $theorderstatus == "completed" ) {
                        $isthistrue = true;
                    }
                }
                if ( $wcusage_field_order_type == "completed" ) {
                    if ( $theorderstatus == "completed" ) {
                        $isthistrue = true;
                    }
                }
            }
            
            // Check New Settings
            if ( $wcusage_field_order_type_custom ) {
                foreach ( $wcusage_field_order_type_custom as $key2 => $status2 ) {
                    $thestatus = wc_get_order_status_name( $key2 );
                    $thisstatusname = wc_get_order_status_name( $theorderstatus );
                    //echo "<br/>Test: " . $order_id . " - " . $thestatus . " = " . $thisstatusname;
                    if ( $thisstatusname == $thestatus ) {
                        $isthistrue = true;
                    }
                }
            }
        }
        
        return $isthistrue;
    }

}