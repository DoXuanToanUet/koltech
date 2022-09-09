<?php

/**
* Plugin Name: Coupon Affiliates for WooCommerce
* Plugin URI: https://couponaffiliates.com
* Description: Easily create an affiliate program for WooCommerce, based on coupons. Track affiliate commission, coupon usage statistics, referral URLs, and more.
* Version: 5.1.0
* Author: Elliot Sowersby
* Author URI: https://couponaffiliates.com/#about
* License: GPLv3
* Text Domain: woo-coupon-usage
* Domain Path: /languages
*
* WC requires at least: 3.7
* WC tested up to: 6.5.1
*
*/
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

if ( function_exists( 'wcu_fs' ) ) {
    wcu_fs()->set_basename( false, __FILE__ );
} else {
    
    if ( !function_exists( 'wcu_fs' ) ) {
        // ***** SDK Integration *****
        
        if ( !function_exists( 'wcu_fs' ) ) {
            // Create a helper function for easy SDK access.
            function wcu_fs()
            {
                global  $wcu_fs ;
                
                if ( !isset( $wcu_fs ) ) {
                    // Include Freemius SDK.
                    require_once dirname( __FILE__ ) . '/freemius/start.php';
                    $wcu_fs = fs_dynamic_init( array(
                        'id'             => '2732',
                        'slug'           => 'woo-coupon-usage',
                        'premium_slug'   => 'woo-coupon-usage-pro',
                        'type'           => 'plugin',
                        'public_key'     => 'pk_a8d9ceeaec08247afd31dbb3e26b3',
                        'is_premium'     => false,
                        'premium_suffix' => '(PRO)',
                        'has_addons'     => true,
                        'has_paid_plans' => true,
                        'trial'          => array(
                        'days'               => 7,
                        'is_require_payment' => true,
                    ),
                        'menu'           => array(
                        'slug'       => 'wcusage',
                        'first-path' => 'admin.php?page=wcusage_settings',
                        'support'    => true,
                        'contact'    => true,
                        'pricing'    => true,
                        'addons'     => false,
                    ),
                        'is_live'        => true,
                    ) );
                }
                
                return $wcu_fs;
            }
            
            // Init Freemius.
            wcu_fs();
            // Signal that SDK was initiated.
            do_action( 'wcu_fs_loaded' );
            function wcu_fs_settings_url()
            {
                return admin_url( 'admin.php?page=wcusage' );
            }
            
            function wcu_fs_settings_url2()
            {
                return admin_url( 'admin.php?page=wcusage_setup' );
            }
            
            wcu_fs()->add_filter( 'connect_url', 'wcu_fs_settings_url' );
            wcu_fs()->add_filter( 'after_skip_url', 'wcu_fs_settings_url2' );
            wcu_fs()->add_filter( 'after_connect_url', 'wcu_fs_settings_url2' );
            wcu_fs()->add_filter( 'after_pending_connect_url', 'wcu_fs_settings_url2' );
        }
        
        // ***** END SDK Integration *****
    }
    
    // Activate Function
    // Redirect to settings on activate
    //add_action( 'admin_init', 'wcusage_my_plugin_redirect' );
    register_activation_hook( __FILE__, 'wcusage_my_plugin_activate' );
    function wcusage_my_plugin_activate()
    {
        add_option( 'wcusage_my_plugin_do_activation_redirect', true );
        wp_redirect( "/wp-admin/admin.php?page=wcusage_settings" );
    }
    
    /*
        function wcusage_my_plugin_redirect()
        {
    
            if ( get_option( 'wcusage_my_plugin_do_activation_redirect', false ) ) {
                delete_option( 'wcusage_my_plugin_do_activation_redirect' );
                wp_redirect( "/wp-admin/admin.php?page=wcusage_settings" );
            }
    
        }
    */
    // Get Plugin Base URL
    $url = plugin_dir_url( __FILE__ );
    define( 'WCUSAGE_UNIQUE_PLUGIN_URL', $url );
    // Scripts
    function wcusage_include_scripts_basic()
    {
        global  $post, $wpdb ;
        // determine whether this page contains "couponusage" shortcode
        $shortcode_found = false;
        
        if ( $post ) {
            
            if ( has_shortcode( $post->post_content, 'couponusage' ) ) {
                $shortcode_found = true;
            } else {
                
                if ( isset( $post->ID ) ) {
                    $result = $wpdb->get_var( $wpdb->prepare( "SELECT count(*) FROM {$wpdb->postmeta} " . "WHERE post_id = %d and meta_value LIKE '%%couponusage%%'", $post->ID ) );
                    $shortcode_found = !empty($result);
                }
            
            }
            
            
            if ( has_shortcode( $post->post_content, 'couponaffiliates' ) ) {
                $shortcode_found = true;
            } else {
                
                if ( isset( $post->ID ) ) {
                    $result = $wpdb->get_var( $wpdb->prepare( "SELECT count(*) FROM {$wpdb->postmeta} " . "WHERE post_id = %d and meta_value LIKE '%%couponaffiliates%%'", $post->ID ) );
                    $shortcode_found = !empty($result);
                }
            
            }
        
        }
        
        
        if ( $shortcode_found ) {
            // only use this method is we're not in wp-admin
            
            if ( !is_admin() ) {
                
                if ( !wp_script_is( 'jquery', 'registered' ) ) {
                    // deregister the original version of jQuery
                    wp_deregister_script( 'jquery' );
                    // discover the correct protocol to use
                    $protocol = 'http:';
                    if ( $_SERVER['HTTPS'] == 'on' ) {
                        $protocol = 'https:';
                    }
                    // register the Google CDN version
                    wp_register_script(
                        'jquery',
                        $protocol . '//ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js',
                        array(),
                        '3.5.1',
                        true
                    );
                }
                
                if ( !wp_script_is( 'jquery', 'enqueued' ) ) {
                    wp_enqueue_script( 'jquery' );
                }
                //wp_register_script( 'jquery', $protocol . '//ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js', array(), '3.5.1', true );
            }
            
            // Custom JS Only Loads on Page
            wp_register_script(
                'woo-coupon-usage',
                plugins_url( '/js/woo-coupon-usage.js', __FILE__ ),
                array( 'jquery' ),
                '1.0',
                false
            );
            wp_enqueue_script( 'woo-coupon-usage' );
        }
        
        $wcusage_urls_prefix = wcusage_get_setting_value( 'wcusage_field_urls_prefix', 'coupon' );
        $wcusage_urls_prefix_mla = wcusage_get_setting_value( 'wcusage_urls_prefix_mla', 'mla' );
        if ( isset( $_GET[$wcusage_urls_prefix] ) || isset( $_GET[$wcusage_urls_prefix_mla] ) ) {
            wp_enqueue_script(
                "jquery-cookie",
                WCUSAGE_UNIQUE_PLUGIN_URL . 'js/jquery.cookie.js',
                array(),
                '0'
            );
        }
    }
    
    add_action( 'wp_enqueue_scripts', 'wcusage_include_scripts_basic' );
    /*** Localization ***/
    add_action( 'init', 'wcusage_load_textdomain' );
    function wcusage_load_textdomain()
    {
        load_plugin_textdomain( 'woo-coupon-usage', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
    }
    
    /*** Include Styles ***/
    function wcusage_include_plugin_css()
    {
        $plugin_url = plugin_dir_url( __FILE__ );
        wp_enqueue_style( 'style1', $plugin_url . 'css/style.css' );
    }
    
    add_action( 'wp_enqueue_scripts', 'wcusage_include_plugin_css' );
    /*** Include Files ***/
    // Admin Settings
    include plugin_dir_path( __FILE__ ) . 'inc/admin/settings/admin-options.php';
    include plugin_dir_path( __FILE__ ) . 'inc/admin/settings/admin-options-update.php';
    include plugin_dir_path( __FILE__ ) . 'inc/admin/settings/admin-setup.php';
    include plugin_dir_path( __FILE__ ) . 'inc/admin/settings/options-commission.php';
    include plugin_dir_path( __FILE__ ) . 'inc/admin/settings/options-currency.php';
    include plugin_dir_path( __FILE__ ) . 'inc/admin/settings/options-debug.php';
    include plugin_dir_path( __FILE__ ) . 'inc/admin/settings/options-design.php';
    include plugin_dir_path( __FILE__ ) . 'inc/admin/settings/options-fraud.php';
    include plugin_dir_path( __FILE__ ) . 'inc/admin/settings/options-general.php';
    include plugin_dir_path( __FILE__ ) . 'inc/admin/settings/options-help.php';
    include plugin_dir_path( __FILE__ ) . 'inc/admin/settings/options-notifications.php';
    include plugin_dir_path( __FILE__ ) . 'inc/admin/settings/options-reports.php';
    include plugin_dir_path( __FILE__ ) . 'inc/admin/settings/options-subscriptions.php';
    include plugin_dir_path( __FILE__ ) . 'inc/admin/settings/options-tabs.php';
    include plugin_dir_path( __FILE__ ) . 'inc/admin/settings/options-urls.php';
    include plugin_dir_path( __FILE__ ) . 'inc/admin/settings/options-payouts.php';
    include plugin_dir_path( __FILE__ ) . 'inc/admin/settings/options-registrations.php';
    // Admin Files
    include plugin_dir_path( __FILE__ ) . 'inc/admin/admin-activity.php';
    include plugin_dir_path( __FILE__ ) . 'inc/admin/admin-dashboard.php';
    include plugin_dir_path( __FILE__ ) . 'inc/admin/admin-page.php';
    include plugin_dir_path( __FILE__ ) . 'inc/admin/admin-list.php';
    include plugin_dir_path( __FILE__ ) . 'inc/admin/admin-styles.php';
    include plugin_dir_path( __FILE__ ) . 'inc/admin/admin-translations.php';
    include plugin_dir_path( __FILE__ ) . 'inc/admin/admin-menu.php';
    include plugin_dir_path( __FILE__ ) . 'inc/admin/admin-pro-details.php';
    include plugin_dir_path( __FILE__ ) . 'inc/admin/admin-getting-started.php';
    include plugin_dir_path( __FILE__ ) . 'inc/admin/admin-orders-list.php';
    include plugin_dir_path( __FILE__ ) . 'inc/admin/admin-orders-box.php';
    include plugin_dir_path( __FILE__ ) . 'inc/admin/admin-url-clicks.php';
    include plugin_dir_path( __FILE__ ) . 'inc/admin/admin-affiliate-users.php';
    // Classes
    include plugin_dir_path( __FILE__ ) . 'inc/admin/class-clicks-list-table.php';
    include plugin_dir_path( __FILE__ ) . 'inc/admin/class-orders-filter-coupons.php';
    $enable_activity_log = wcusage_get_setting_value( 'wcusage_enable_activity_log', '1' );
    if ( $enable_activity_log ) {
        include plugin_dir_path( __FILE__ ) . 'inc/admin/class-activity-list-table.php';
    }
    // Main Functions
    include plugin_dir_path( __FILE__ ) . 'inc/functions/functions-ajax.php';
    include plugin_dir_path( __FILE__ ) . 'inc/functions/functions-update-notice.php';
    include plugin_dir_path( __FILE__ ) . 'inc/functions/functions-shortcode.php';
    include plugin_dir_path( __FILE__ ) . 'inc/functions/functions-shortcode-extra.php';
    include plugin_dir_path( __FILE__ ) . 'inc/functions/functions-shortcode-page.php';
    include plugin_dir_path( __FILE__ ) . 'inc/functions/functions-dashboard.php';
    include plugin_dir_path( __FILE__ ) . 'inc/functions/functions-custom-styles.php';
    include plugin_dir_path( __FILE__ ) . 'inc/functions/functions-translations.php';
    include plugin_dir_path( __FILE__ ) . 'inc/functions/functions-general.php';
    include plugin_dir_path( __FILE__ ) . 'inc/functions/functions-coupon-orders.php';
    include plugin_dir_path( __FILE__ ) . 'inc/functions/functions-coupon-info.php';
    include plugin_dir_path( __FILE__ ) . 'inc/functions/functions-coupon-apply.php';
    include plugin_dir_path( __FILE__ ) . 'inc/functions/functions-commission-message.php';
    include plugin_dir_path( __FILE__ ) . 'inc/functions/functions-urls.php';
    include plugin_dir_path( __FILE__ ) . 'inc/functions/functions-url-clicks.php';
    include plugin_dir_path( __FILE__ ) . 'inc/functions/functions-calculate-order.php';
    include plugin_dir_path( __FILE__ ) . 'inc/functions/functions-percentage-change.php';
    include plugin_dir_path( __FILE__ ) . 'inc/functions/functions-uninstall.php';
    include plugin_dir_path( __FILE__ ) . 'inc/functions/functions-refund.php';
    include plugin_dir_path( __FILE__ ) . 'inc/functions/functions-all-time.php';
    include plugin_dir_path( __FILE__ ) . 'inc/functions/functions-new-order.php';
    include plugin_dir_path( __FILE__ ) . 'inc/functions/functions-user-coupons.php';
    include plugin_dir_path( __FILE__ ) . 'inc/functions/functions-activity.php';
    // API
    include plugin_dir_path( __FILE__ ) . 'inc/api/coupon-info.php';
    include plugin_dir_path( __FILE__ ) . 'inc/api/users-coupons.php';
    include plugin_dir_path( __FILE__ ) . 'inc/api/request-payout.php';
    // WC Account Tab
    $wcusage_field_account_tab = wcusage_get_setting_value( 'wcusage_field_account_tab', 0 );
    if ( $wcusage_field_account_tab ) {
        include plugin_dir_path( __FILE__ ) . 'inc/functions/functions-wc-tab.php';
    }
    // Subscriptions
    include plugin_dir_path( __FILE__ ) . 'inc/functions/functions-subscriptions.php';
    // Tabs Files
    include plugin_dir_path( __FILE__ ) . 'inc/dashboard/tab-statistics.php';
    include plugin_dir_path( __FILE__ ) . 'inc/dashboard/tab-latest-orders.php';
    include plugin_dir_path( __FILE__ ) . 'inc/dashboard/tab-referral-url.php';
    include plugin_dir_path( __FILE__ ) . 'inc/dashboard/tab-settings.php';
    // Emails
    include plugin_dir_path( __FILE__ ) . 'inc/emails/new-order-email.php';
    // Admin Reports
    include plugin_dir_path( __FILE__ ) . 'inc/admin-reports/admin-reports.php';
    include plugin_dir_path( __FILE__ ) . 'inc/admin-reports/ajax-admin-reports.php';
    add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'wcusage_add_action_links' );
    function wcusage_add_action_links( $links )
    {
        
        if ( wcu_fs()->can_use_premium_code() ) {
            $support_link = get_site_url() . "/wp-admin/admin.php?page=wcusage-contact";
        } else {
            $support_link = "https://wordpress.org/support/plugin/woo-coupon-usage/#new-topic-0";
        }
        
        $mylinks = array( '<a href="' . admin_url( '/admin.php?page=wcusage_settings' ) . '">Settings</a>', '<a href="' . $support_link . '">Support</a>' );
        return array_merge( $links, $mylinks );
    }
    
    function wcusage_fs_is_submenu_visible( $is_visible, $submenu_id )
    {
        $pro = wcu_fs()->can_use_premium_code();
        $trial = wcu_fs()->is_trial();
        if ( $submenu_id == "contact" ) {
            $is_visible = ( $pro ? true : false );
        }
        
        if ( $submenu_id == "pricing" ) {
            $is_visible = ( $pro ? false : true );
            if ( $trial ) {
                $is_visible = true;
            }
        }
        
        if ( $submenu_id == "support" ) {
            $is_visible = ( $pro ? false : true );
        }
        return $is_visible;
    }
    
    wcu_fs()->add_filter(
        'is_submenu_visible',
        'wcusage_fs_is_submenu_visible',
        10,
        2
    );
    // END MAIN LOGIC
}
