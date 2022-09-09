<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Function that runs when coupon is applied to check if it is allowed
 *
 */
if( !function_exists( 'wcusage_applied_coupon_check_allow_coupons' ) ) {
  function wcusage_applied_coupon_check_allow_coupons( $applied_coupon ) {

    $current_coupons = 0;

    foreach ( WC()->cart->get_coupons() as $code => $coupon ) {

      $coupon_user_id = get_post_meta( $coupon->get_id(), 'wcu_select_coupon_user', true );

      if($coupon_user_id) {

        $current_coupons++;

        /***** Checks if current user is assigned to the coupon *****/

        $wcusage_field_allow_assigned_user = wcusage_get_setting_value('wcusage_field_allow_assigned_user', 1);
        if(!$wcusage_field_allow_assigned_user) {

          if(isset($_POST['coupon_code'])) {
            if($coupon->get_code() == $_POST['coupon_code']) {

                $current_user_id = get_current_user_id();

                $iscouponusers = wcusage_iscouponusers( $coupon->get_code(), $current_user_id );

                if($iscouponusers) {

                  WC()->cart->remove_coupon( $applied_coupon );

                  wc_clear_notices();

                  wc_add_notice( __( "Sorry, you can't use your own affiliate coupon code.", "woo-coupon-usage" ), "error" );

                }

            }
          }

        }

        /***** Checks if other affiliate coupons already used *****/

        $wcusage_field_allow_multiple_coupons = wcusage_get_setting_value('wcusage_field_allow_multiple_coupons', 0);
        if(!$wcusage_field_allow_multiple_coupons) {

          if($current_coupons > 1) {

            WC()->cart->remove_coupon( $applied_coupon );

            wc_clear_notices();

            wc_add_notice( __( "Sorry, you can only use one affiliate coupon per order.", "woo-coupon-usage" ), "error" );

          }

        }

      }

    }

  }
}
add_action( 'woocommerce_applied_coupon', 'wcusage_applied_coupon_check_allow_coupons', 10, 1 );

/**
 * Function that checks if customer is allowed to use the applied coupons at all stages.
 *
 */
if( !function_exists( 'wcusage_applied_coupon_check_allow_customer' ) ) {
  function wcusage_applied_coupon_check_allow_customer() {

    foreach ( WC()->cart->get_coupons() as $code => $coupon ) {

      if($coupon) {

        $coupon_user_id = get_post_meta( $coupon->get_id(), 'wcu_select_coupon_user', true );

        /***** Check existing customer. *****/

        if( is_user_logged_in() ) {
          $allow_all_customers = wcusage_get_setting_value('wcusage_field_allow_all_customers', 1);
          $first_order_only = get_post_meta( $coupon->get_id(), 'wcu_enable_first_order_only', true );
          if( $first_order_only == "yes" || (!$allow_all_customers && $coupon_user_id) ) {
            if(wcusage_is_existing_customer()) {
              wc_clear_notices();
              WC()->cart->remove_coupon( $coupon->get_code() );
              wc_add_notice( __( "Sorry, only new customers can use this coupon code.", "woo-coupon-usage" ), "error" );
            }
          }
        }

        /***** Check if visitor is blacklisted *****/

        if( wcusage_is_customer_blacklisted() && $coupon_user_id ) {
            wc_clear_notices();
            WC()->cart->remove_coupon( $coupon->get_code() );
            wc_add_notice( __( "Sorry, you can't use this coupon code or it has expired.", "woo-coupon-usage"), "error" );
        }

        /***** Check if referrer domain is blacklisted *****/

        $block_domains_manual = wcusage_get_setting_value('wcusage_field_fraud_block_domains_manual', '0');
        if( wcusage_is_domain_blacklisted() && $coupon_user_id && $block_domains_manual ) {
            wc_clear_notices();
            WC()->cart->remove_coupon( $coupon->get_code() );
            wc_add_notice( __( "Sorry, you can't use this coupon code or it has expired.", "woo-coupon-usage"), "error" );
        }

      }

    }

  }
}
add_action( 'woocommerce_before_checkout_form', 'wcusage_applied_coupon_check_allow_customer', 10, 0 );
add_action( 'woocommerce_before_cart', 'wcusage_applied_coupon_check_allow_customer', 10, 0 );
add_action( 'woocommerce_applied_coupon', 'wcusage_applied_coupon_check_allow_customer', 10, 0 );
add_action( 'woocommerce_update_cart_action_cart_updated', 'wcusage_applied_coupon_check_allow_customer', 10, 0 );

/**
 * Function that checks if user is a new customer
 *
 */
if( !function_exists( 'wcusage_is_existing_customer' ) ) {
  function wcusage_is_existing_customer() {
      // Get all customer orders
      $customer_orders = get_posts( array(
          'numberposts' => 1, // one order is enough
          'meta_key'    => '_customer_user',
          'meta_value'  => get_current_user_id(),
          'post_type'   => 'shop_order', // WC orders post type
          'post_status' => array('wc-completed', 'wc-processing', 'wc-pending'), // Only orders with "completed" status
          'fields'      => 'ids', // Return Ids "completed"
      ) );

      // return "true" when customer has already at least one order (false if not)
     return count($customer_orders) > 0 ? true : false;
  }
}

/**
 * Function that checks if visitor is blacklisted
 *
 */
if( !function_exists( 'wcusage_is_customer_blacklisted' ) ) {
  function wcusage_is_customer_blacklisted($ip_address = "") {

    $block_ips = wcusage_get_setting_value('wcusage_field_fraud_block_ips', '');

    if($block_ips) {

      $block_ips = preg_split("/\r\n|\n|\r/", $block_ips);

      $referral_id = "";
      if(!$ip_address) {
        $ip_address = $_SERVER['REMOTE_ADDR'];
        if(isset($_COOKIE['wcusage_referral_id'])) {
          $referral_id = $_COOKIE['wcusage_referral_id'];
        }
      }

      if( ( $ip_address && in_array($ip_address, $block_ips) ) || ( $referral_id && in_array($referral_id, $block_ips) ) ) {
        return true;
      }

    }

    return false;

  }
}

/**
 * Function that checks if referrer domain is blacklisted
 *
 */
if( !function_exists( 'wcusage_is_domain_blacklisted' ) ) {
  function wcusage_is_domain_blacklisted($referral_domain = "") {

    $block_domains = wcusage_get_setting_value('wcusage_field_fraud_block_domains', '');

    if($block_domains) {

      $block_domains = preg_split("/\r\n|\n|\r/", $block_domains);
        $block_domains = str_replace("http://", "", $block_domains);
        $block_domains = str_replace("https://", "", $block_domains);
        $block_domains = preg_replace('/^www\./i', '', $block_domains);

      if(!$referral_domain) {
        $referral_domain = $_COOKIE['wcusage_referral_domain'];
          $referral_domain = preg_replace('/^www\./i', '', $referral_domain);
      }

      if( $referral_domain && in_array($referral_domain, $block_domains) ) {
        return true;
      }

    }

    return false;

  }
}
