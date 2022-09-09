<?php

if ( !defined( 'ABSPATH' ) ) {
    exit;
}
/**
 * Forces all stats to be refreshed
 *
 * @param string $coupon_code
 *
 */
if ( !function_exists( 'wcusage_update_all_stats' ) ) {
    function wcusage_update_all_stats( $coupon_code, $force = 0 )
    {
        $wcusage_field_enable_coupon_all_stats_meta = wcusage_get_setting_value( 'wcusage_field_enable_coupon_all_stats_meta', '1' );
        
        if ( $wcusage_field_enable_coupon_all_stats_meta || $force ) {
            $fullorders = wcusage_wh_getOrderbyCouponCode(
                $coupon_code,
                "",
                date( "Y-m-d" ),
                '',
                1,
                1
            );
        } else {
            $fullorders = "";
        }
        
        return $fullorders;
    }

}
add_action(
    'wcusage_hook_update_all_stats',
    'wcusage_update_all_stats',
    10,
    2
);
/**
 * Updates all stats for a coupon by adding/removing values from a single order
 *
 * @param string $coupon_code
 * @param int $order_id
 * @param bool $type - If add or remove order from stats
 * @param bool $change - If the usage should be changed.
 *
 */
if ( !function_exists( 'wcusage_update_all_stats_single' ) ) {
    function wcusage_update_all_stats_single(
        $coupon_code,
        $order_id,
        $type,
        $change
    )
    {
        $order = wc_get_order( $order_id );
        $coupon_code = strtolower( $coupon_code );
        $couponinfo = wcusage_get_coupon_info( $coupon_code );
        $wcu_alltime_stats = get_post_meta( $couponinfo[2], 'wcu_alltime_stats', true );
        
        if ( $wcu_alltime_stats ) {
            // Get Current Values
            $total_orders = 0;
            if ( isset( $wcu_alltime_stats['total_orders'] ) ) {
                $total_orders = $wcu_alltime_stats['total_orders'];
            }
            $total_discount = 0;
            if ( isset( $wcu_alltime_stats['full_discount'] ) ) {
                $total_discount = $wcu_alltime_stats['full_discount'];
            }
            $total_commission = 0;
            if ( isset( $wcu_alltime_stats['total_commission'] ) ) {
                $total_commission = $wcu_alltime_stats['total_commission'];
            }
            $total_count = 0;
            if ( isset( $wcu_alltime_stats['total_count'] ) ) {
                $total_count = $wcu_alltime_stats['total_count'];
            }
            // Get Order Values
            $order_data = wcusage_calculate_order_data(
                $order_id,
                $coupon_code,
                1,
                0
            );
            $order_total = $order_data['totalorders'];
            $order_discounts = $order_data['totaldiscounts'];
            $order_commission = $order_data['totalcommission'];
            // Update
            $allstats = array();
            
            if ( $type ) {
                $allstats['total_orders'] = $total_orders + $order_total;
                $allstats['full_discount'] = $total_discount + $order_discounts;
                $allstats['total_commission'] = $total_commission + $order_commission;
                
                if ( $change ) {
                    $allstats['total_count'] = $total_count + 1;
                } else {
                    $allstats['total_count'] = $total_count;
                }
            
            } else {
                $allstats['total_orders'] = $total_orders - $order_total;
                $allstats['full_discount'] = $total_discount - $order_discounts;
                $allstats['total_commission'] = $total_commission - $order_commission;
                
                if ( $change ) {
                    $allstats['total_count'] = $total_count - 1;
                } else {
                    $allstats['total_count'] = $total_count;
                }
            
            }
            
            update_post_meta( $couponinfo[2], 'wcu_alltime_stats', $allstats );
        }
    
    }

}
add_action(
    'wcusage_hook_update_all_stats_single',
    'wcusage_update_all_stats_single',
    10,
    4
);