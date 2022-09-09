<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * On order status change update all stats
 *
 * @param int $order_id
 *
 */
if( !function_exists( 'wcusage_new_order_update_stats' ) ) {
  function wcusage_new_order_update_stats( $order_id, $status_from = "", $status_to = "" ) {

    $order = wc_get_order( $order_id );

    $check_status_from_show = wcusage_check_status_show($status_from);
    $check_status_to_show = wcusage_check_status_show($status_to);

    if($status_to != "refunded") {

      if($order) {

        // Set the currency conversion rate for order.

        $enablecurrency = wcusage_get_setting_value('wcusage_field_enable_currency', '0');
        $enable_save_rate = wcusage_get_setting_value('wcusage_field_enable_currency_save_rate', '0');
        if($enablecurrency && $enable_save_rate) {
          $currencycode = $order->get_currency();
          $currency_rate = wcusage_get_currency_rate($currencycode);
          update_post_meta( $order_id, 'wcusage_currency_conversion', $currency_rate );
        }

        $recurringaffiliate = $order->get_meta('lifetime_affiliate_coupon_referrer');

        // Update All-Time Stats

        $wcusage_field_enable_coupon_all_stats_meta = wcusage_get_setting_value('wcusage_field_enable_coupon_all_stats_meta', '1');

        if($recurringaffiliate) {
          // If is a recurring affiliate order.

          if($wcusage_field_enable_coupon_all_stats_meta) {
            if(!$check_status_from_show && $check_status_to_show) { // If old order NOT shown and new order IS shown
              do_action( 'wcusage_hook_update_all_stats_single', $recurringaffiliate, $order_id, 1, 1 ); // Add
            }
            if($check_status_from_show && !$check_status_to_show) { // If old order IS shown and new order NOT shown
              do_action( 'wcusage_hook_update_all_stats_single', $recurringaffiliate, $order_id, 0, 1 ); // Remove
            }
          }

          $coupon_info = wcusage_get_coupon_info($recurringaffiliate);
          $coupon_user_id = $coupon_info[1];

          $parent_affiliates = get_user_meta( $coupon_user_id, 'wcu_ml_affiliate_parents', true );

        } else {

          $parent_affiliates = array();

          if ( class_exists( 'WooCommerce' ) ) {

            if ( version_compare( WC_VERSION, 3.7, ">=" ) ) {
              // New Versions of WooCommerce
              $coupons_array = $order->get_coupon_codes();
            } else {
              // Old Versions of WooCommerce
              $coupons_array = $order->get_used_coupons();
            }

            foreach( $coupons_array as $coupon_code ) {

              $coupon_info = wcusage_get_coupon_info($coupon_code);
              $coupon_user_id = $coupon_info[1];

              if($wcusage_field_enable_coupon_all_stats_meta) {
                if(!$check_status_from_show && $check_status_to_show) { // If old order NOT shown and new order IS shown
                  do_action( 'wcusage_hook_update_all_stats_single', $coupon_code, $order_id, 1, 1 ); // Add
                }
                if($check_status_from_show && !$check_status_to_show) { // If old order IS shown and new order NOT shown
                  do_action( 'wcusage_hook_update_all_stats_single', $coupon_code, $order_id, 0, 1 ); // Remove
                }
              }

              $parents = get_user_meta( $coupon_user_id, 'wcu_ml_affiliate_parents', true );

              array_push($parent_affiliates, $parents);

              $parent_affiliates = array_unique($parent_affiliates);

            }

          }

        }

        if(!empty($parent_affiliates)) {
          update_post_meta( $order_id, 'wcusage_mla_parents', json_encode($parent_affiliates) );
        }

      }

    }

  }
}
add_action( 'woocommerce_order_status_changed', 'wcusage_new_order_update_stats', 10, 3 );
add_action( 'woocommerce_process_shop_order_meta', 'wcusage_new_order_update_stats', 10, 3 );

/**
 * Adds new referral to activity log
 *
 * @param int $order_id
 *
 */
if( !function_exists( 'wcusage_new_order_event' ) ) {
  function wcusage_new_order_event( $order_id ) {

    $order = wc_get_order( $order_id );
    $affiliate_user = get_post_meta( $order_id, 'wcusage_affiliate_user', true );
    if($order && $affiliate_user) {
      $activity_log = wcusage_add_activity($order_id, 'referral', '');
    }

  }
}
add_action( 'woocommerce_payment_complete', 'wcusage_new_order_event', 100, 1 );
