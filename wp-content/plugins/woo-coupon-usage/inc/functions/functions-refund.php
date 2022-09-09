<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Force refresh/update affiliate stats on order refunds change
 *
 * @param int $order_id
 * @param int $refund_id
 *
 */
if( !function_exists( 'wcusage_order_update_stats' ) ) {
  function wcusage_order_update_stats( $order_id, $refund_id ) {

    $wcusage_field_enable_order_commission_meta = wcusage_get_setting_value('wcusage_field_enable_order_commission_meta', '1');

    if($wcusage_field_enable_order_commission_meta) {

      $order = wc_get_order( $order_id );
      if($order) {
        foreach( $order->get_coupon_codes() as $coupon_code ) {

          // Update Order Data
          $get_order = wcusage_calculate_order_data( $order_id, $coupon_code, 1, 0, 1 );

          // Update Coupon All-Time Stats
          $wcusage_field_enable_coupon_all_stats_meta = wcusage_get_setting_value('wcusage_field_enable_coupon_all_stats_meta', '1');
          if($wcusage_field_enable_coupon_all_stats_meta) {
            $fullorders = wcusage_wh_getOrderbyCouponCode( $coupon_code, '', date("Y-m-d"), '', 1, 1 );
          }

        }
      }

    }

  }
}
add_action( 'woocommerce_order_refunded', 'wcusage_order_update_stats', 5, 2 );
add_action( 'woocommerce_refund_deleted', 'wcusage_order_update_stats', 5, 2 );
//add_action( 'woocommerce_update_order', 'wcusage_order_update_stats', 5, 2 );
