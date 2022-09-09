<?php

if ( !defined( 'ABSPATH' ) ) {
    exit;
}
/**
 * Displays the statistics tab content on affiliate dashboard
 *
 * @param int $postid
 * @param string $coupon_code
 * @param int $combined_commission
 *
 * @return mixed
 *
 */
if ( !function_exists( 'wcusage_tab_statistics' ) ) {
    function wcusage_tab_statistics(
        $postid,
        $coupon_code,
        $combined_commission,
        $force_refresh_stats = ""
    )
    {
        $translate = wcusage_translate();
        $options = get_option( 'wcusage_options' );
        $couponinfo = wcusage_get_coupon_info_by_id( $postid );
        $couponuser = $couponinfo[1];
        $currentuserid = get_current_user_id();
        $wcusage_page_load = wcusage_get_setting_value( 'wcusage_field_page_load', '' );
        $wcusage_field_load_ajax = wcusage_get_setting_value( 'wcusage_field_load_ajax', 1 );
        $discount_type_original = get_post_meta( $postid, 'discount_type', true );
        $option_text = wcusage_get_setting_value( 'wcusage_field_text', '' );
        $wcusage_show_commission = wcusage_get_setting_value( 'wcusage_field_show_commission', '' );
        $wcusage_show_tabs = wcusage_get_setting_value( 'wcusage_field_show_tabs', '1' );
        $wcusage_field_which_toggle = wcusage_get_setting_value( 'wcusage_field_which_toggle', '1' );
        $wcusage_show_graphs = wcusage_get_setting_value( 'wcusage_field_show_graphs', '1' );
        $wcusage_hide_all_time = wcusage_get_setting_value( 'wcusage_field_hide_all_time', '0' );
        $wcusage_show_boxed = wcusage_get_setting_value( 'wcusage_field_show_boxed', '1' );
        $save_order_commission_meta = wcusage_get_setting_value( 'wcusage_field_enable_order_commission_meta', '1' );
        $save_coupon_all_stats_meta = wcusage_get_setting_value( 'wcusage_field_enable_coupon_all_stats_meta', '1' );
        $current_commission_message = get_post_meta( $postid, 'wcu_commission_message', true );
        // Refresh The Stats
        $update_stats = "";
        
        if ( $force_refresh_stats ) {
            delete_post_meta( $postid, 'wcusage_monthly_summary_data_orders' );
            $update_stats = wcusage_update_all_stats( $coupon_code, 1 );
        }
        
        // Check if user is parent affiliate
        $is_mla_parent = "";
        if ( function_exists( 'wcusage_network_check_sub_affiliate' ) ) {
            $is_mla_parent = wcusage_network_check_sub_affiliate( $currentuserid, $couponuser );
        }
        $thismonthorders = "";
        $pastmonthorders = "";
        $pastoldmonthorders = "";
        // Show
        
        if ( $is_mla_parent || !$couponuser || $couponuser == $currentuserid || wcusage_check_admin_access() ) {
            $amount = get_post_meta( $postid, 'coupon_amount', true );
            ?>

			<?php 
            
            if ( $wcusage_hide_all_time ) {
                ?>
				<script>
				jQuery(document).ready(function() {
					jQuery('.wcusage-show-last-30').show();
					jQuery('.wcusage-show-last-7').delay(1).fadeOut('fast');
					jQuery('.wcusage-show-last-all').delay(1).fadeOut('fast');
					jQuery('#wcusage-last-days30').css("color", "#333");
				});
				</script>
			<?php 
            } else {
                ?>
				<script>
				jQuery(document).ready(function() {
					jQuery('.wcusage-show-last-all').show();
					jQuery('.wcusage-show-last-7').delay(1).fadeOut('fast');
					jQuery('.wcusage-show-last-30').delay(1).fadeOut('fast');
					jQuery('.wcusage-show-last-all-30').show();
				});
				</script>
			<?php 
            }
            
            ?>

			<br/>
			<?php 
            echo  '<p style="margin: 0;font-size:;font-weight: bold;/*! margin-top: 20px; */margin-bottom: 10px;">' . $translate['wcusage_field_tr_coupon_info2'] . '</p>' ;
            // Text
            if ( $option_text ) {
                echo  '<p><span class="wcusage-info-box-title">' . $option_text . '</p>' ;
            }
            // Type
            if ( $wcusage_show_boxed ) {
                echo  '<div class="wcusage-info-box wcusage-info-box-discount">' ;
            }
            
            if ( $discount_type_original == "percent" ) {
                echo  '<p><span class="wcusage-info-box-title">' . $translate['wcusage_field_tr_discount'] . ':</span> <span id="wcu-the-discount-type">' . $amount . '%</span></p>' ;
            } elseif ( $discount_type_original == "fixed_cart" ) {
                echo  '<p><span class="wcusage-info-box-title">' . $translate['wcusage_field_tr_discount'] . ':</span> <span id="wcu-the-discount-type">' . wcusage_format_price( $amount ) . '</span></p>' ;
            } else {
                
                if ( $discount_type_original == "recurring_percent" ) {
                    echo  '<p><span class="wcusage-info-box-title">' . $translate['wcusage_field_tr_discount'] . ':</span> <span id="wcu-the-discount-type">' . $amount . '%</span></p>' ;
                } else {
                    echo  '<p><span class="wcusage-info-box-title">' . $translate['wcusage_field_tr_discount'] . ':</span> <span id="wcu-the-discount-type">' . wcusage_format_price( $amount ) . '</span></p>' ;
                }
                
                if ( $discount_type ) {
                    echo  '<span style="font-size: 10px; position: absolute;">' . $translate['wcusage_field_tr_type'] . ':</span> <span id="wcu-the-discount-type">' . $discount_type . '</span>' ;
                }
            }
            
            if ( $wcusage_show_boxed ) {
                echo  '</div>' ;
            }
            
            if ( !$wcusage_field_which_toggle ) {
                $date7 = date( 'Y-m-d', strtotime( '-7 days' ) );
                $date14 = date( 'Y-m-d', strtotime( '-14 days' ) );
                $this7orders = wcusage_wh_getOrderbyCouponCode(
                    $coupon_code,
                    $date7,
                    date( "Y-m-d" ),
                    '',
                    1
                );
                $past14orders = wcusage_wh_getOrderbyCouponCode(
                    $coupon_code,
                    $date14,
                    $date7,
                    '',
                    1
                );
                $date30 = date( 'Y-m-d', strtotime( '-30 days' ) );
                $date60 = date( 'Y-m-d', strtotime( '-60 days' ) );
                $this30orders = wcusage_wh_getOrderbyCouponCode(
                    $coupon_code,
                    $date30,
                    date( "Y-m-d" ),
                    '',
                    1
                );
                $past60orders = wcusage_wh_getOrderbyCouponCode(
                    $coupon_code,
                    $date60,
                    $date30,
                    '',
                    1
                );
                // Text
                $this30text = $translate['wcusage_field_tr_coupon_last30'];
                $this7text = $translate['wcusage_field_tr_coupon_last7'];
            } else {
                // Current Month
                $date1month = date( 'Y-m-01' );
                // Last Month
                $date2month = date( 'Y-m-d', strtotime( "first day of last month" ) );
                $date2monthend = date( 'Y-m-d', strtotime( "last day of last month" ) );
                // Month Before
                $date3month = date( 'Y-m-d', strtotime( "first day of -2 month" ) );
                $date3monthend = date( 'Y-m-d', strtotime( "last day of -2 month" ) );
                // Get Monthly Statistics
                $wcusage_monthly_summary_data_orders = get_post_meta( $postid, 'wcusage_monthly_summary_data_orders', true );
                if ( !$wcusage_monthly_summary_data_orders ) {
                    $wcusage_monthly_summary_data_orders = array();
                }
                // Delete old months that are not needed
                foreach ( $wcusage_monthly_summary_data_orders as $key => $value ) {
                    if ( $key != strtotime( $date1month ) && $key != strtotime( $date2month ) && $key != strtotime( $date3month ) ) {
                        $wcusage_monthly_summary_data_orders[strtotime( $key )] = "";
                    }
                }
                // This Month
                
                if ( empty($wcusage_monthly_summary_data_orders[strtotime( $date1month )]) ) {
                    $thismonthorders = wcusage_wh_getOrderbyCouponCode(
                        $coupon_code,
                        $date1month,
                        date( "Y-m-d" ),
                        '',
                        1,
                        0
                    );
                    $wcusage_monthly_summary_data_orders[strtotime( $date1month )] = $thismonthorders;
                    //echo "a1: " . $date1month . "<br/>";
                } else {
                    $monthly_summary_data1 = $wcusage_monthly_summary_data_orders[strtotime( $date1month )];
                    $thismonthorders = $monthly_summary_data1;
                    //echo "a2: " . $date1month . "<br/>";
                }
                
                // Last Month
                
                if ( empty($wcusage_monthly_summary_data_orders[strtotime( $date2month )]) ) {
                    $pastmonthorders = wcusage_wh_getOrderbyCouponCode(
                        $coupon_code,
                        $date2month,
                        $date2monthend,
                        '',
                        1,
                        0
                    );
                    $wcusage_monthly_summary_data_orders[strtotime( $date2month )] = $pastmonthorders;
                    //echo "b1: " . $date2month . "<br/>";
                } else {
                    $monthly_summary_data2 = $wcusage_monthly_summary_data_orders[strtotime( $date2month )];
                    $pastmonthorders = $monthly_summary_data2;
                    //echo "b2: " . $date2month . "<br/>";
                }
                
                // 2 Months Ago
                
                if ( empty($wcusage_monthly_summary_data_orders[strtotime( $date3month )]) ) {
                    $pastoldmonthorders = wcusage_wh_getOrderbyCouponCode(
                        $coupon_code,
                        $date3month,
                        $date3monthend,
                        '',
                        1,
                        0
                    );
                    $wcusage_monthly_summary_data_orders[strtotime( $date3month )] = $pastoldmonthorders;
                    //echo "c1: " . $date3month . "<br/>";
                } else {
                    $monthly_summary_data3 = $wcusage_monthly_summary_data_orders[strtotime( $date3month )];
                    $pastoldmonthorders = $monthly_summary_data3;
                    //echo "c2: " . $date3month . "<br/>";
                }
                
                $this7orders = $pastmonthorders;
                $past14orders = $pastoldmonthorders;
                $this30orders = $thismonthorders;
                $past60orders = $pastmonthorders;
                // Text
                $this30text = $translate['wcusage_field_tr_coupon_thismonth'];
                $this7text = $translate['wcusage_field_tr_coupon_lastmonth'];
            }
            
            
            if ( !$wcusage_hide_all_time ) {
                $wcu_alltime_stats = get_post_meta( $postid, 'wcu_alltime_stats', true );
                
                if ( !isset( $wcu_alltime_stats ) || $wcu_alltime_stats == "" ) {
                    
                    if ( !$update_stats ) {
                        $fullorders = wcusage_wh_getOrderbyCouponCode(
                            $coupon_code,
                            "",
                            date( "Y-m-d" ),
                            '',
                            1,
                            1
                        );
                    } else {
                        $fullorders = $update_stats;
                    }
                    
                    $fullorders = array_reverse( $fullorders );
                    $usage = $fullorders['total_count'];
                } else {
                    $fullorders = "";
                    $wcu_alltime_stats = get_post_meta( $postid, 'wcu_alltime_stats', true );
                    $usage = $wcu_alltime_stats['total_count'];
                }
            
            } else {
                global  $woocommerce ;
                $c = new WC_Coupon( $coupon_code );
                $usage = $c->get_usage_count();
            }
            
            // Usage
            if ( $wcusage_show_boxed ) {
                echo  '<div class="wcusage-info-box wcusage-info-box-usage">' ;
            }
            echo  '<p><span class="wcusage-info-box-title">' . $translate['wcusage_field_tr_usage'] . ':</span> <span id="wcu-total-usage-number">' . $usage . '</span></p>' ;
            if ( $wcusage_show_boxed ) {
                echo  '</div>' ;
            }
            $multitypes = 0;
            // Commission
            
            if ( $wcusage_show_commission ) {
                // Commission Type
                if ( $wcusage_show_boxed ) {
                    echo  '<div class="wcusage-info-box wcusage-info-box-percent">' ;
                }
                echo  '<p>' ;
                $commissionthisstyles = "";
                
                if ( strlen( $combined_commission ) >= 14 ) {
                    $commissionthisstyles = 'font-size: 15px; line-height: 16px;';
                } elseif ( strlen( $combined_commission ) < 12 && strlen( $combined_commission ) > 10 ) {
                    $commissionthisstyles = 'font-size: 19px; line-height: 20px;';
                }
                
                echo  '<span class="wcusage-info-box-title">' . $translate['wcusage_field_tr_commission'] . ":</span> " ;
                echo  '<span class="wcu-total-commission-text" style="' . $commissionthisstyles . '">' . $combined_commission . "</span> " ;
                echo  "</p>" ;
                if ( $wcusage_show_boxed ) {
                    echo  '</div>' ;
                }
            }
            
            echo  '<div style="width: 100%; clear: both;"></div>' ;
            echo  '<div class="wcusage-sales-stats-toggles">' ;
            echo  '<p class="wcusage-last-days">' ;
            if ( !$wcusage_hide_all_time ) {
                echo  '<a href="javascript:void(0);" id="wcusage-last-days-all">' . $translate['wcusage_field_tr_coupon_alltime'] . '</a> <span style="color: #f3f3f3;">|</span> ' ;
            }
            echo  '<a href="javascript:void(0);" id="wcusage-last-days30" style="color: #a6a6a6;">' . $this30text . '</a> <span style="color: #f3f3f3;">|</span> <a href="javascript:void(0);" id="wcusage-last-days7" style="color: #a6a6a6;">' . $this7text . '</a>
				</p>' ;
            echo  '</div>' ;
            echo  '<div class="wcusage-sales-stats">' ;
            
            if ( !$wcusage_hide_all_time ) {
                echo  '<div class="wcusage-show-last-all">' ;
                echo  do_action(
                    'wcusage_hook_get_main_info_boxes',
                    $fullorders,
                    '',
                    $combined_commission,
                    $postid
                ) ;
                echo  '</div>' ;
            }
            
            
            if ( !$wcusage_hide_all_time ) {
                echo  '<div class="wcusage-show-last-30" style="display: none;">' ;
            } else {
                echo  '<div class="wcusage-show-last-30">' ;
            }
            
            echo  do_action(
                'wcusage_hook_get_main_info_boxes',
                $this30orders,
                $past60orders,
                $combined_commission,
                $postid
            ) ;
            echo  '</div>' ;
            echo  '<div class="wcusage-show-last-7" style="display: none;">' ;
            echo  do_action(
                'wcusage_hook_get_main_info_boxes',
                $this7orders,
                $past14orders,
                $combined_commission,
                $postid
            ) ;
            echo  '</div>' ;
            echo  '</div>' ;
            ?>

      <div <?php 
            if ( $wcusage_field_load_ajax ) {
                ?>class="wcu-loading-hide" style="visibility: hidden; height: 0;"<?php 
            }
            ?>>
      <?php 
            ?>
      </div>

      <?php 
            // Update Data
            update_post_meta( $postid, 'wcusage_monthly_summary_data_orders', $wcusage_monthly_summary_data_orders );
            //var_dump($wcusage_monthly_summary_data_orders);
            // Update Refresh Date
            
            if ( $force_refresh_stats ) {
                $wcusage_refresh_date = strtotime( "now" );
                if ( isset( $options['wcusage_refresh_date'] ) ) {
                    $wcusage_refresh_date = $options['wcusage_refresh_date'];
                }
                update_post_meta( $postid, 'wcu_last_refreshed', $wcusage_refresh_date );
            }
        
        }
    
    }

}
add_action(
    'wcusage_hook_tab_statistics',
    'wcusage_tab_statistics',
    10,
    4
);
/**
 * Get the info boxes for the statistics tab
 *
 * @param array $orders
 * @param array $past30orders
 * @param int $combined_commission
 *
 * @return mixed
 *
 */
if ( !function_exists( 'wcusage_get_main_info_boxes' ) ) {
    function wcusage_get_main_info_boxes(
        $orders,
        $past30orders,
        $combined_commission,
        $postid = ""
    )
    {
        if ( !$orders ) {
            $orders = get_post_meta( $postid, 'wcu_alltime_stats', true );
        }
        
        if ( $orders && is_array( $orders ) ) {
            $options = get_option( 'wcusage_options' );
            $translate = wcusage_translate();
            $wcusage_show_boxed = wcusage_get_setting_value( 'wcusage_field_show_boxed', '1' );
            $wcusage_show_commission = wcusage_get_setting_value( 'wcusage_field_show_commission', '1' );
            $wcusage_show_tax = wcusage_get_setting_value( 'wcusage_field_show_tax', '' );
            
            if ( $wcusage_show_tax == 1 && isset( $orders['full_discount_tax'] ) ) {
                $full_discount = $orders['full_discount'] + $orders['full_discount_tax'];
            } else {
                $full_discount = $orders['full_discount'];
            }
            
            $full_discount = number_format(
                (double) $full_discount,
                2,
                '.',
                ''
            );
            $total_orders = $orders['total_orders'] - $orders['full_discount'];
            $total_orders = number_format(
                (double) $total_orders,
                2,
                '.',
                ''
            );
            $totalcommissionearned = number_format(
                (double) $orders['total_commission'],
                2,
                '.',
                ''
            );
            if ( $totalcommissionearned == "" || !$totalcommissionearned ) {
                $totalcommissionearned = 0;
            }
            // Past 30 Days
            
            if ( isset( $past30orders['full_discount'] ) ) {
                $full_discount_30 = $past30orders['full_discount'];
            } else {
                $full_discount_30 = 0;
            }
            
            
            if ( isset( $past30orders['full_discount_tax'] ) ) {
                $full_discount_30_tax = $past30orders['full_discount_tax'];
            } else {
                $full_discount_30_tax = 0;
            }
            
            
            if ( $wcusage_show_tax == 1 ) {
                $past30_full_discount = $full_discount_30 + $full_discount_30_tax;
            } else {
                $past30_full_discount = $full_discount_30;
            }
            
            $full_discount_diff = "";
            $past30_full_discount = number_format(
                (double) $past30_full_discount,
                2,
                '.',
                ''
            );
            
            if ( $past30orders && $wcusage_show_boxed ) {
                $full_discount_diff = wcusage_getPercentageChange( $full_discount, $past30_full_discount );
                $full_discount_diff = wcusage_show_pos_neg(
                    $full_discount_diff,
                    $past30_full_discount,
                    1,
                    2
                );
            }
            
            
            if ( isset( $past30orders['total_orders'] ) ) {
                $past30_total_orders = $past30orders['total_orders'] - $past30orders['full_discount'];
            } else {
                $past30_total_orders = 0;
            }
            
            $total_orders_diff = "";
            $past30_total_orders = number_format(
                (double) $past30_total_orders,
                2,
                '.',
                ''
            );
            
            if ( $past30orders && $wcusage_show_boxed ) {
                $total_orders_diff = wcusage_getPercentageChange( $total_orders, $past30_total_orders );
                $total_orders_diff = wcusage_show_pos_neg(
                    $total_orders_diff,
                    $past30_total_orders,
                    1,
                    2
                );
            }
            
            
            if ( isset( $past30orders['total_commission'] ) ) {
                $past30_totalcommissionearned = number_format(
                    (double) $past30orders['total_commission'],
                    2,
                    '.',
                    ''
                );
            } else {
                $past30_totalcommissionearned = 0;
            }
            
            $totalcommissionearned_diff = "";
            if ( $past30_totalcommissionearned == "" || !$past30_totalcommissionearned ) {
                $past30_totalcommissionearned = 0;
            }
            
            if ( $past30orders && $wcusage_show_boxed ) {
                $totalcommissionearned_diff = wcusage_getPercentageChange( $totalcommissionearned, $past30_totalcommissionearned );
                $totalcommissionearned_diff = wcusage_show_pos_neg(
                    $totalcommissionearned_diff,
                    $past30_totalcommissionearned,
                    1,
                    2
                );
            }
            
            if ( $wcusage_show_boxed ) {
                echo  '<div class="wcusage-info-box wcusage-info-box-sales">' ;
            }
            echo  '<p><span class="wcusage-info-box-title">' . $translate['wcusage_field_tr_total_order'] . ':</span> ' . wcusage_format_price( number_format(
                (double) $total_orders,
                2,
                '.',
                ''
            ) ) . $total_orders_diff . '</p>' ;
            if ( $wcusage_show_boxed ) {
                echo  '</div>' ;
            }
            if ( $wcusage_show_boxed ) {
                echo  '<div class="wcusage-info-box wcusage-info-box-discounts">' ;
            }
            echo  '<p><span class="wcusage-info-box-title">' . $translate['wcusage_field_tr_total_saved'] . ':</span> ' ;
            echo  '<span class="wcu-total-discount-saved">' . wcusage_format_price( number_format(
                (double) $full_discount,
                2,
                '.',
                ''
            ) ) . $full_discount_diff . '</span>' ;
            echo  "</p>" ;
            if ( $wcusage_show_boxed ) {
                echo  '</div>' ;
            }
            
            if ( $wcusage_show_commission ) {
                // Earned Commission
                if ( $wcusage_show_boxed ) {
                    echo  '<div class="wcusage-info-box wcusage-info-box-dollar">' ;
                }
                echo  '<p><span class="wcusage-info-box-title">' . $translate['wcusage_field_tr_total_referrer_commission'] . ':</span> ' . wcusage_format_price( number_format(
                    (double) $totalcommissionearned,
                    2,
                    '.',
                    ''
                ) ) . $totalcommissionearned_diff . "</p>" ;
                if ( $wcusage_show_boxed ) {
                    echo  '</div>' ;
                }
            }
        
        }
    
    }

}
add_action(
    'wcusage_hook_get_main_info_boxes',
    'wcusage_get_main_info_boxes',
    10,
    4
);
/**
 * Gets statistics tab for shortcode page
 *
 * @param int $postid
 * @param string $coupon_code
 * @param int $combined_commission
 *
 * @return mixed
 *
 */
add_action(
    'wcusage_hook_dashboard_tab_content_statistics',
    'wcusage_dashboard_tab_content_statistics',
    10,
    5
);
if ( !function_exists( 'wcusage_dashboard_tab_content_statistics' ) ) {
    function wcusage_dashboard_tab_content_statistics(
        $postid,
        $coupon_code,
        $combined_commission,
        $wcusage_page_load,
        $force_refresh_stats
    )
    {
        // *** GET SETTINGS *** /
        $options = get_option( 'wcusage_options' );
        $translate = wcusage_translate();
        $language = wcusage_get_language_code();
        $wcusage_field_load_ajax = wcusage_get_setting_value( 'wcusage_field_load_ajax', 1 );
        $wcusage_field_load_ajax_per_page = wcusage_get_setting_value( 'wcusage_field_load_ajax_per_page', 1 );
        if ( !$wcusage_field_load_ajax ) {
            $wcusage_field_load_ajax_per_page = 0;
        }
        $wcusage_show_tabs = wcusage_get_setting_value( 'wcusage_field_show_tabs', '1' );
        $wcusage_show_graphs = wcusage_get_setting_value( 'wcusage_field_show_graphs', '1' );
        $wcusage_justcoupon = wcusage_get_setting_value( 'wcusage_field_justcoupon', '1' );
        $wcusage_show_tax = wcusage_get_setting_value( 'wcusage_field_show_tax', '0' );
        $wcusage_hide_all_time = wcusage_get_setting_value( 'wcusage_field_hide_all_time', '0' );
        $wcusage_urlprivate = wcusage_get_setting_value( 'wcusage_field_urlprivate', '1' );
        if ( wcusage_check_admin_access() ) {
            $wcusage_urlprivate = 0;
        }
        $wcusage_field_which_toggle = wcusage_get_setting_value( 'wcusage_field_which_toggle', '1' );
        $show_graphs_alltime = wcusage_get_setting_value( 'wcusage_field_show_graphs_alltime', 1 );
        $current_commission_message = get_post_meta( $postid, 'wcu_commission_message', true );
        $ajaxerrormessage = wcusage_ajax_error();
        // *** DISPLAY CONTENT *** //
        ?>

    <?php 
        
        if ( isset( $_POST['page-stats'] ) || !isset( $_POST['load-page'] ) || $wcusage_page_load == false ) {
            ?>

      <?php 
            if ( isset( $_POST['page-stats'] ) || !isset( $_POST['load-page'] ) ) {
                ?>
      <style>#wcu1 { display: block; }</style>
      <?php 
            }
            ?>

      <div id="wcu1" <?php 
            if ( $wcusage_show_tabs == '1' || $wcusage_show_tabs == '' ) {
                ?>class="wcutabcontent"<?php 
            }
            ?>>

        <script>
        /* Get & display data */
        jQuery(document).ready(function(){
          setTimeout(function(){
             jQuery('.stuck-loading-message').show();
          }, 25000);
          <?php 
            
            if ( $wcusage_field_load_ajax_per_page ) {
                ?>
          wcusage_run_tab_page_stats();
          <?php 
            } else {
                ?>
          jQuery( ".wcusage-refresh-data" ).on('click', wcusage_run_tab_page_stats);
          <?php 
            }
            
            ?>
        });

        /* Load Page Statistics data & content */
        function wcusage_run_tab_page_stats() {

          var data = {
            action: 'wcusage_load_page_statistics',
            _ajax_nonce: '<?php 
            echo  wp_create_nonce( 'wcusage_dashboard_ajax_nonce' ) ;
            ?>',
            postid: '<?php 
            echo  sanitize_text_field( $postid ) ;
            ?>',
            couponcode: '<?php 
            echo  sanitize_text_field( $coupon_code ) ;
            ?>',
            combinedcommission: '<?php 
            echo  wcusage_convert_symbols( $combined_commission ) ;
            ?>',
            refresh: '<?php 
            echo  $force_refresh_stats ;
            ?>',
            language: '<?php 
            echo  $language ;
            ?>',
          };
          jQuery.ajax({
              type: 'POST',
              url: wcusageajax.ajaxurl,
              data: data,
              success: function(data){
                jQuery('.show_statistics').html(data);
                jQuery('.wcutablinks').css("opacity", "1");
                jQuery('.wcutablinks').css("pointer-events", "auto");
                setTimeout( function() { wcusage_run_tab_page_stats_graph_update(); }, 500);
              },
              error: function(data){ jQuery('.show_statistics').html("<?php 
            echo  $ajaxerrormessage ;
            ?>"); }
          });

        }
        </script>

      <?php 
            
            if ( $wcusage_field_load_ajax ) {
                ?>

        <div class="show_statistics"></div>

      <?php 
            } else {
                ?>

        <?php 
                do_action(
                    'wcusage_hook_tab_statistics',
                    $postid,
                    $coupon_code,
                    $combined_commission,
                    $force_refresh_stats
                );
                ?>

      <?php 
            }
            
            ?>

        <div style="width: 100%; clear: both;"></div>

        <?php 
            
            if ( $wcusage_field_load_ajax ) {
                ?>


        <div class="wcu-loading-image wcu-loading-stats">
          <?php 
                
                if ( $force_refresh_stats ) {
                    ?>
          <br/><i class="fas fa-exclamation-circle"></i> <?php 
                    echo  __( "Calculating statistics for all referrals. Since this is your first visit, it will take a little longer than normal.", "woo-coupon-usage" ) ;
                    ?><br/>
          <?php 
                }
                
                ?>
          <div class="wcu-loading-loader">
            <div class="loader"></div>
          </div>
          <p style="margin: 0;font-size:;font-weight: bold; margin-top: 30px; width: 100px; text-align: center;"><br/><?php 
                echo  __( "Loading", "woo-coupon-usage" ) ;
                ?>...</p>
          <?php 
                
                if ( current_user_can( 'administrator' ) ) {
                    ?>
          <p class="stuck-loading-message" style="display:none;font-size:12px;color:#B2B2B2;font-weight: bold; margin-top: 20px; text-align: center;">
          <i class="fas fa-exclamation-circle"></i> <?php 
                    echo  __( "Notice (admin only): Page constantly loading?", "woo-coupon-usage" ) ;
                    ?> <a href='https://couponaffiliates.com/docs/affiliate-dashboard-is-not-showing' style='color:#B2B2B2;' target='_blank'><?php 
                    echo  __( "Click here", "woo-coupon-usage" ) ;
                    ?></a>.
          <br/><i class="fas fa-exclamation-circle"></i> <?php 
                    echo  __( "If this is your first time loading this dashboard, and it's a large coupon, it may take a little while to load.", "woo-coupon-usage" ) ;
                    ?>
          <?php 
                }
                
                ?>
          </p>
        </div>
        <?php 
            }
            
            ?>

      </div>

      <div style="width: 100%; clear: both;"></div>

    <?php 
        }
        
        ?>

  <?php 
    }

}