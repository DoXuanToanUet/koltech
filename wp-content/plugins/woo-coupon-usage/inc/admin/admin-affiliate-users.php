<?php
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
/**
 * On users list show message that filtered by coupon affiliates users only.
 *
 */
function wcusage_filter_users_by_affiliates_message( $which )
{
    ?>

  <?php 
    do_action( 'wcusage_hook_admin_new_registration_button' );
    // "Create New Registration" button action
    ?>

  <?php 
    if ( isset( $_GET["unlink-affiliate"] ) ) {
        wcusage_coupon_affiliate_unlink( $coupon );
    }
    // POST: Unlink Affiliate From Coupon
    
    if ( isset( $_POST['_wpnonce'] ) ) {
        $nonce = $_REQUEST['_wpnonce'];
        if ( wp_verify_nonce( $nonce, 'admin_unlink_affiliate' ) ) {
            
            if ( isset( $_POST['unlink_affiliate'] ) ) {
                $postid = sanitize_text_field( $_POST['wcu-id'] );
                wcusage_coupon_affiliate_unlink( $postid );
            }
        
        }
    }

}

add_action( 'admin_head-users.php', 'wcusage_filter_users_by_affiliates_message' );
add_action( 'load-users.php', function () {
    $screen = get_current_screen();
    // Only edit post screen:
    if ( 'users' === $screen->id ) {
        // Show Message if Coupon Affiliates role selected.
        if ( isset( $_GET["role"] ) ) {
            if ( $_GET["role"] == "coupon_affiliate" ) {
                add_action( 'all_admin_notices', function () {
                    echo  '<p style="color: green; font-weight: bold; margin-bottom: 0;"><span class="dashicons dashicons-info-outline"></span>&nbsp; Filter: Only showing users with the Coupon Affiliate role.</p>' ;
                } );
            }
        }
    }
} );
/**
 * Add Custom Columns to Users List
 *
 */
function wcusage_new_modify_user_table( $column )
{
    $column['affiliateinfo'] = 'Affiliate Coupons';
    $wcusage_field_mla_enable = wcusage_get_setting_value( 'wcusage_field_mla_enable', '0' );
    if ( $wcusage_field_mla_enable ) {
        $column['affiliatemla'] = 'MLA';
    }
    
    if ( wcu_fs()->can_use_premium_code() ) {
        $credit_enable = wcusage_get_setting_value( 'wcusage_field_storecredit_enable', 0 );
        $system = wcusage_get_setting_value( 'wcusage_field_storecredit_system', 'default' );
        $storecredit_users_col = wcusage_get_setting_value( 'wcusage_field_tr_payouts_storecredit_users_col', 1 );
        
        if ( $credit_enable && $storecredit_users_col && $system == "default" ) {
            $credit_label = wcusage_get_setting_value( 'wcusage_field_tr_payouts_storecredit_only', 'Store Credit' );
            $column['affiliatestorecredit'] = $credit_label;
        }
    
    }
    
    return $column;
}

add_filter( 'manage_users_columns', 'wcusage_new_modify_user_table' );
function wcusage_new_modify_user_table_row( $val, $column_name, $user_id )
{
    switch ( $column_name ) {
        case 'affiliateinfo':
            $theoutput = "";
            $coupons = wcusage_get_users_coupons_ids( $user_id );
            foreach ( $coupons as $coupon ) {
                $theoutput .= wcusage_output_affiliate_tooltip_users( $coupon );
            }
            return $theoutput;
        case 'affiliatemla':
            $theoutput = "";
            $wcusage_field_mla_enable = wcusage_get_setting_value( 'wcusage_field_mla_enable', '0' );
            
            if ( $wcusage_field_mla_enable ) {
                $dash_page_id = wcusage_get_mla_shortcode_page_id();
                $dash_page = get_page_link( $dash_page_id );
                $user_info = get_userdata( $user_id );
                $theoutput = '<a href="' . $dash_page . '?user=' . $user_info->user_login . '" title="View MLA Dashboard" target="_blank">MLA <span class="dashicons dashicons-external"></span></a>';
            }
            
            return $theoutput;
        case 'affiliatestorecredit':
            $credit_enable = wcusage_get_setting_value( 'wcusage_field_storecredit_enable', 0 );
            
            if ( $credit_enable && function_exists( 'wcusage_get_credit_users_balance' ) ) {
                $balance = wcusage_format_price( wcusage_get_credit_users_balance( $user_id ) );
                return $balance;
            } else {
                return "";
            }
        
        default:
    }
    return $val;
}

add_filter(
    'manage_users_custom_column',
    'wcusage_new_modify_user_table_row',
    10,
    3
);
/**
 * Set users page as WooCommerce screen to load tooltip
 *
 */
add_filter( 'woocommerce_screen_ids', 'wcusage_set_uses_wc_screen' );
function wcusage_set_uses_wc_screen( $screen )
{
    $screen[] = 'users';
    return $screen;
}

/**
 * Get Coupon Tooltip
 *
 */
function wcusage_output_affiliate_tooltip_users( $couponid )
{
    $coupon_info = wcusage_get_coupon_info_by_id( $couponid );
    $user_id = $coupon_info[1];
    $user_info = get_userdata( $user_id );
    $coupon_code = $coupon_info[3];
    $unpaid_commission = wcusage_format_price( $coupon_info[2] );
    $dashboard_url = $coupon_info[4];
    $wcusage_tracking_enable = wcusage_get_setting_value( 'wcusage_field_tracking_enable', 1 );
    
    if ( $wcusage_tracking_enable && wcu_fs()->can_use_premium_code() ) {
        $commission_message = "<strong>" . __( 'Unpaid Commission', 'woo-coupon-usage' ) . "</strong>: " . $unpaid_commission . "<br/>";
    } else {
        $commission_message = "";
    }
    
    $unlink_message = '<form method="post" id="unlink_affiliate" style="display: inline;">' . wp_nonce_field( 'admin_unlink_affiliate' ) . '<input type="text" id="wcu-id" name="wcu-id" value="' . $couponid . '" style="display: none;">
  <button href="#!" onClick="' . "return confirm('Unassign affiliate user &#8220;" . $user_info->user_login . "&#8220; from the coupon code &#8220;" . $coupon_code . "&#8220;? This will not delete the coupon or user, it will simply remove them from the coupon, so they can no longer gain commission or view the affiliate dashboard for it.');" . '"
  type="submit" name="unlink_affiliate" class="wcu-affiliate-tooltip-unlink-button">Unassign
  </button>
  </form>';
    $coupon_code_linked = '<p><span class="wcusage-users-affiliate-column">' . '<a href="' . $dashboard_url . '" target="_blank">' . $coupon_code . '</a>' . wc_help_tip( "<span style='font-size: 18px;'>" . $coupon_code . "</span><br/><span style='font-size: 12px;'>" . $commission_message . "<a href='" . $dashboard_url . "' target='_blank' class='wcu-affiliate-tooltip-dashboard-button'>" . __( 'View Affiliate Dashboard', 'woo-coupon-usage' ) . "</a>" . "<br/>" . "<a href='" . get_admin_url() . "post.php?post=" . $couponid . "&action=edit' target='_blank' class='wcu-affiliate-tooltip-edit-button'>" . __( 'Edit Coupon', 'woo-coupon-usage' ) . "</a> - " . $unlink_message . "</span>" ) . "</p>";
    return $coupon_code_linked;
}

add_action( 'wcusage_hook_output_affiliate_tooltip_users', 'wcusage_output_affiliate_tooltip_users' );
/**
 * Add "Coupon Affiliates & Commission" tab to coupons
 *
 */
if ( !function_exists( 'add_wcusage_coupon_data_tab' ) ) {
    function add_wcusage_coupon_data_tab( $product_data_tabs )
    {
        $product_data_tabs['coupon-affiliates'] = array(
            'label'  => __( 'Coupon Affiliates & Commission', 'woo-coupon-usage' ),
            'target' => 'wcusage_coupon_data',
            'order'  => 0,
        );
        return $product_data_tabs;
    }

}
add_filter(
    'woocommerce_coupon_data_tabs',
    'add_wcusage_coupon_data_tab',
    99,
    1
);