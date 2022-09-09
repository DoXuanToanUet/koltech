<?php

if ( !defined( 'ABSPATH' ) ) {
    exit;
}
function wcusage_options_page()
{
    $options = get_option( 'wcusage_options' );
    
    if ( isset( $options['wcusage_field_admin_permission'] ) ) {
        
        if ( current_user_can( 'administrator' ) ) {
            $admin_perms = "administrator";
        } else {
            $admin_perms = $options['wcusage_field_admin_permission'];
        }
    
    } else {
        $admin_perms = "administrator";
    }
    
    // add top level menu page
    add_menu_page(
        __( 'Coupon Affiliates', 'woo-coupon-usage' ),
        __( 'Coupon Affiliates', 'woo-coupon-usage' ),
        $admin_perms,
        'wcusage',
        'wcusage_dashboard_page_html',
        WCUSAGE_UNIQUE_PLUGIN_URL . 'images/icon.png',
        58
    );
    add_submenu_page(
        'wcusage',
        __( 'Dashboard', 'woo-coupon-usage' ),
        __( 'Dashboard', 'woo-coupon-usage' ),
        'manage_options',
        'wcusage',
        ''
    );
    add_submenu_page(
        null,
        __( 'Coupon Affiliates - Info & Help', 'woo-coupon-usage' ),
        __( 'Info & Help', 'woo-coupon-usage' ),
        'manage_options',
        'wcusage_help',
        'wcusage_admin_list_page_html'
    );
    add_submenu_page(
        null,
        __( 'Coupon Affiliates - Setup Wizard', 'woo-coupon-usage' ),
        __( 'Setup Wizard', 'woo-coupon-usage' ),
        'manage_options',
        'wcusage_setup',
        'wcusage_setup_page_html'
    );
    add_submenu_page(
        'wcusage',
        __( 'Plugin Settings', 'woo-coupon-usage' ),
        __( 'Settings', 'woo-coupon-usage' ),
        'manage_options',
        'wcusage_settings',
        'wcusage_options_page_html'
    );
    if ( function_exists( 'wc_coupons_enabled' ) ) {
        if ( wc_coupons_enabled() ) {
            add_submenu_page(
                'wcusage',
                __( 'Coupons List', 'woo-coupon-usage' ),
                __( 'Coupons List', 'woo-coupon-usage' ),
                $admin_perms,
                'edit.php?post_type=shop_coupon',
                ''
            );
        }
    }
    add_submenu_page(
        'wcusage',
        __( 'Coupons Orders', 'woo-coupon-usage' ),
        __( 'Coupon Orders', 'woo-coupon-usage' ),
        $admin_perms,
        'edit.php?post_type=shop_order&wcu_coupons=ALL',
        ''
    );
    add_submenu_page(
        'wcusage',
        __( 'Admin Reports & Analytics', 'woo-coupon-usage' ),
        __( 'Admin Reports', 'woo-coupon-usage' ),
        $admin_perms,
        'wcusage_admin_reports',
        'wcusage_admin_reports_page_html'
    );
    $wcusage_field_urls_enable = wcusage_get_setting_value( 'wcusage_field_urls_enable', '1' );
    $wcusage_field_show_click_history = wcusage_get_setting_value( 'wcusage_field_show_click_history', '1' );
    if ( $wcusage_field_urls_enable && $wcusage_field_show_click_history ) {
        add_submenu_page(
            'wcusage',
            __( 'Coupon Affiliates - Referral URL Visits / Clicks', 'woo-coupon-usage' ),
            __( 'Referral Visits', 'woo-coupon-usage' ),
            $admin_perms,
            'wcusage_clicks',
            'wcusage_admin_clicks_page_html'
        );
    }
    $enable_activity_log = wcusage_get_setting_value( 'wcusage_enable_activity_log', '1' );
    if ( $enable_activity_log ) {
        add_submenu_page(
            'wcusage',
            __( 'Coupon Affiliates - Activity Log', 'woo-coupon-usage' ),
            __( 'Activity Log', 'woo-coupon-usage' ),
            $admin_perms,
            'wcusage_activity',
            'wcusage_admin_activity_page_html'
        );
    }
    add_submenu_page(
        'wcusage',
        __( 'Coupon Affiliates - PRO Modules', 'woo-coupon-usage' ),
        __( '<span class="dashicons dashicons-star-filled" style="font-size: 17px; color: green;"></span> PRO Modules', 'woo-coupon-usage' ),
        $admin_perms,
        'admin.php?page=wcusage_settings&section=tab-pro-details',
        ''
    );
}

add_action( 'admin_menu', 'wcusage_options_page', 1 );