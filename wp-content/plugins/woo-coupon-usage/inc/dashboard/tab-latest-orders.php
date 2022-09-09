<?php

if ( !defined( 'ABSPATH' ) ) {
    exit;
}
/**
 * Displays the latest orders tab content on affiliate dashboard
 *
 * @param int $postid
 * @param string $coupon_code
 * @param date $wcu_orders_start
 * @param date $wcu_orders_end
 * @param date $isordersstartset
 *
 * @return mixed
 *
 */
add_action(
    'wcusage_hook_tab_latest_orders',
    'wcusage_tab_latest_orders',
    10,
    5
);
if ( !function_exists( 'wcusage_tab_latest_orders' ) ) {
    function wcusage_tab_latest_orders(
        $postid,
        $coupon_code,
        $wcu_orders_start,
        $wcu_orders_end,
        $isordersstartset
    )
    {
        $requests_session = wcusage_requests_session_check( $postid );
        
        if ( $requests_session['status'] ) {
            echo  $requests_session['message'] ;
        } else {
            $couponinfo = wcusage_get_coupon_info_by_id( $postid );
            $couponuser = $couponinfo[1];
            $currentuserid = get_current_user_id();
            $wcusage_urlprivate = wcusage_get_setting_value( 'wcusage_field_urlprivate', '1' );
            // Check if user is parent affiliate
            $is_mla_parent = "";
            if ( function_exists( 'wcusage_network_check_sub_affiliate' ) ) {
                $is_mla_parent = wcusage_network_check_sub_affiliate( $currentuserid, $couponuser );
            }
            // Check to make sure not set to private, coupon is assigned to current user, or is admin
            
            if ( $is_mla_parent || !$couponuser && !$wcusage_urlprivate || $couponuser == $currentuserid || wcusage_check_admin_access() ) {
                $translate = wcusage_translate();
                $options = get_option( 'wcusage_options' );
                $option_show_orderid = wcusage_get_setting_value( 'wcusage_field_orderid', '0' );
                $option_show_status = wcusage_get_setting_value( 'wcusage_field_status', '0' );
                $option_show_ordercountry = wcusage_get_setting_value( 'wcusage_field_ordercountry', '0' );
                $option_show_ordercity = wcusage_get_setting_value( 'wcusage_field_ordercity', '0' );
                $option_show_ordername = wcusage_get_setting_value( 'wcusage_field_ordername', '0' );
                $option_show_amount = wcusage_get_setting_value( 'wcusage_field_amount', '1' );
                $option_show_amount_saved = wcusage_get_setting_value( 'wcusage_field_amount_saved', '1' );
                $option_show_shipping = wcusage_get_setting_value( 'wcusage_field_show_shipping', '0' );
                $option_show_list_products = wcusage_get_setting_value( 'wcusage_field_list_products', '1' );
                $wcusage_show_commission = wcusage_get_setting_value( 'wcusage_field_show_commission', '1' );
                $isordersstartset = false;
                /* Get If Page Load */
                global  $woocommerce ;
                $c = new WC_Coupon( $coupon_code );
                $the_coupon_usage = $c->get_usage_count();
                $wcusage_page_load = wcusage_get_setting_value( 'wcusage_field_page_load', '' );
                //if($the_coupon_usage > 5000) { $wcusage_page_load = 1; }
                /**/
                $wcusage_field_load_ajax = wcusage_get_setting_value( 'wcusage_field_load_ajax', '1' );
                $wcusage_field_order_sort = wcusage_get_setting_value( 'wcusage_field_order_sort', '' );
                
                if ( !$wcusage_field_load_ajax ) {
                    // Filter Orders Submitted
                    
                    if ( isset( $_POST['submitordersfilter'] ) ) {
                        if ( !$wcusage_page_load ) {
                            echo  "<script>jQuery( document ).ready(function() { jQuery( '.tabrecentorders' ).click(); });</script>" ;
                        }
                        $wcu_orders_start = sanitize_text_field( $_POST['wcu_orders_start'] );
                        $wcu_orders_start = preg_replace( "([^0-9-])", "", $wcu_orders_start );
                        $wcu_orders_end = sanitize_text_field( $_POST['wcu_orders_end'] );
                        $wcu_orders_end = preg_replace( "([^0-9-])", "", $wcu_orders_end );
                    }
                    
                    
                    if ( $wcu_orders_start == "" ) {
                        $wcu_orders_start = "";
                    } else {
                        $isordersstartset = true;
                    }
                    
                    if ( $wcu_orders_end == "" ) {
                        $wcu_orders_end = date( "Y-m-d" );
                    }
                }
                
                // Check if more than 12 months, limit it to 12.
                $datedifferencemonths = (int) abs( (strtotime( $wcu_orders_start ) - strtotime( $wcu_orders_end )) / (60 * 60 * 24 * 30) );
                
                if ( $datedifferencemonths > 12 && $wcu_orders_start ) {
                    $wcu_orders_start = date( 'Y-m-d', strtotime( '-11 months', strtotime( $wcu_orders_end ) ) );
                    echo  "<p>" . __( 'The maximum date range is 12 months. Your filters have been updated.', 'woo-coupon-usage' ) . "</p>" ;
                    ?>
          <script>
          jQuery( document ).ready(function() {
            jQuery( '#wcu-orders-start' ).val("<?php 
                    echo  $wcu_orders_start ;
                    ?>");
          });
          </script>
          <?php 
                }
                
                // Orders to Show
                $option_coupon_orders = wcusage_get_setting_value( 'wcusage_field_orders', '15' );
                if ( $wcu_orders_start ) {
                    $option_coupon_orders = "";
                }
                $orders = wcusage_wh_getOrderbyCouponCode(
                    $coupon_code,
                    $wcu_orders_start,
                    $wcu_orders_end,
                    $option_coupon_orders,
                    1
                );
                $orders = array_reverse( $orders );
                // Show Table
                if ( $option_coupon_orders > 0 || $option_coupon_orders == "" ) {
                    do_action(
                        'wcusage_hook_show_latest_orders_table',
                        $orders,
                        "",
                        $wcu_orders_start,
                        $wcu_orders_end,
                        ""
                    );
                }
            }
        
        }
    
    }

}
/**
 * Displays the latest orders tab content on affiliate dashboard
 *
 * @param int $postid
 * @param string $type
 *
 * @return mixed
 *
 */
add_action(
    'wcusage_hook_show_latest_orders_table',
    'wcusage_show_latest_orders_table',
    10,
    5
);
if ( !function_exists( 'wcusage_show_latest_orders_table' ) ) {
    function wcusage_show_latest_orders_table(
        $orders,
        $type,
        $wcu_orders_start,
        $wcu_orders_end,
        $user_id = ""
    )
    {
        $translate = wcusage_translate();
        $options = get_option( 'wcusage_options' );
        if ( !$user_id ) {
            $user_id = get_current_user_id();
        }
        $option_show_orderid = wcusage_get_setting_value( 'wcusage_field_orderid', '0' );
        $option_show_status = wcusage_get_setting_value( 'wcusage_field_status', '0' );
        $option_show_ordercountry = wcusage_get_setting_value( 'wcusage_field_ordercountry', '0' );
        $option_show_ordercity = wcusage_get_setting_value( 'wcusage_field_ordercity', '0' );
        $option_show_ordername = wcusage_get_setting_value( 'wcusage_field_ordername', '0' );
        $option_show_amount = wcusage_get_setting_value( 'wcusage_field_amount', '1' );
        $option_show_amount_saved = wcusage_get_setting_value( 'wcusage_field_amount_saved', '1' );
        $option_show_shipping = wcusage_get_setting_value( 'wcusage_field_show_shipping', '0' );
        $option_show_list_products = wcusage_get_setting_value( 'wcusage_field_list_products', '1' );
        $wcusage_show_commission = wcusage_get_setting_value( 'wcusage_field_show_commission', '1' );
        $option_coupon_orders = wcusage_get_setting_value( 'wcusage_field_orders', '15' );
        $customdaterange = false;
        
        if ( $wcu_orders_start ) {
            $option_coupon_orders = 250;
            $customdaterange = true;
        }
        
        $wcusage_field_order_sort = wcusage_get_setting_value( 'wcusage_field_order_sort', '' );
        echo  "<div class='coupon-orders-list'>" ;
        $totalcount = count( $orders );
        $completedorders = 0;
        ?>

    <!-- Mobile Reponsive Labels -->
    <?php 
        $wcusage_ro_label_count = 1;
        ?>
    <style>
    @media only screen and (max-width: 760px), (min-device-width: 768px) and (max-device-width: 1024px)  {

      .listtheproducts { display: none; }
      .listtheproducts td:before { content: "" !important; }
      .listtheproducts { margin-top: -20px !important; margin-bottom: 20px !important; }
      .wcuTableFoot:nth-of-type(1):before { content: "" !important; }

      <?php 
        
        if ( $option_show_orderid ) {
            ?>
        .wcu-table-recent-orders td:nth-of-type(<?php 
            echo  $wcusage_ro_label_count ;
            ?>):before { content: "<?php 
            echo  $translate['wcusage_field_tr_orderid'] ;
            ?>"; }
        <?php 
            $wcusage_ro_label_count++;
            ?>
      <?php 
        }
        
        ?>

      <?php 
        
        if ( $type == "mla" ) {
            ?>
        .wcu-table-recent-orders td:nth-of-type(<?php 
            echo  $wcusage_ro_label_count ;
            ?>):before { content: "<?php 
            echo  __( 'Coupon', 'woo-coupon-usage' ) ;
            ?>"; }
        <?php 
            $wcusage_ro_label_count++;
            ?>
      <?php 
        }
        
        ?>

      .wcu-table-recent-orders td:nth-of-type(<?php 
        echo  $wcusage_ro_label_count ;
        ?>):before { content: "<?php 
        echo  $translate['wcusage_field_tr_date'] ;
        ?>"; }
      <?php 
        $wcusage_ro_label_count++;
        ?>

      <?php 
        
        if ( $option_show_status ) {
            ?>
        .wcu-table-recent-orders td:nth-of-type(<?php 
            echo  $wcusage_ro_label_count ;
            ?>):before { content: "<?php 
            echo  __( 'Status', 'woo-coupon-usage' ) ;
            ?>"; }
        <?php 
            $wcusage_ro_label_count++;
            ?>
      <?php 
        }
        
        ?>

      <?php 
        
        if ( $option_show_amount ) {
            ?>
        .wcu-table-recent-orders td:nth-of-type(<?php 
            echo  $wcusage_ro_label_count ;
            ?>):before { content: "<?php 
            echo  __( 'Subtotal', 'woo-coupon-usage' ) ;
            ?>"; }
        <?php 
            $wcusage_ro_label_count++;
            ?>
      <?php 
        }
        
        ?>

      <?php 
        
        if ( $option_show_amount_saved ) {
            ?>
        .wcu-table-recent-orders td:nth-of-type(<?php 
            echo  $wcusage_ro_label_count ;
            ?>):before { content: "<?php 
            echo  $translate['wcusage_field_tr_discount'] ;
            ?>"; }
        <?php 
            $wcusage_ro_label_count++;
            ?>
      <?php 
        }
        
        ?>

        .wcu-table-recent-orders td:nth-of-type(<?php 
        echo  $wcusage_ro_label_count ;
        ?>):before { content: "<?php 
        echo  $translate['wcusage_field_tr_order_total'] ;
        ?>"; }
        <?php 
        $wcusage_ro_label_count++;
        ?>

      <?php 
        
        if ( $wcusage_show_commission ) {
            ?>
        .wcu-table-recent-orders td:nth-of-type(<?php 
            echo  $wcusage_ro_label_count ;
            ?>):before { content: "<?php 
            echo  $translate['wcusage_field_tr_commission'] ;
            ?>"; }
        <?php 
            $wcusage_ro_label_count++;
            ?>
      <?php 
        }
        
        ?>

      <?php 
        
        if ( $option_show_shipping ) {
            ?>
        .wcu-table-recent-orders td:nth-of-type(<?php 
            echo  $wcusage_ro_label_count ;
            ?>):before { content: "Shipping"; }
        <?php 
            $wcusage_ro_label_count++;
            ?>
      <?php 
        }
        
        ?>

      <?php 
        
        if ( $option_show_ordercountry ) {
            ?>
        .wcu-table-recent-orders td:nth-of-type(<?php 
            echo  $wcusage_ro_label_count ;
            ?>):before { content: "<?php 
            echo  $translate['wcusage_field_tr_ordercountry'] ;
            ?>"; }
        <?php 
            $wcusage_ro_label_count++;
            ?>
      <?php 
        }
        
        ?>

      <?php 
        
        if ( $option_show_ordercity ) {
            ?>
        .wcu-table-recent-orders td:nth-of-type(<?php 
            echo  $wcusage_ro_label_count ;
            ?>):before { content: "<?php 
            echo  $translate['wcusage_field_tr_ordercity'] ;
            ?>"; }
        <?php 
            $wcusage_ro_label_count++;
            ?>
      <?php 
        }
        
        ?>

      <?php 
        
        if ( $option_show_ordername ) {
            ?>
        .wcu-table-recent-orders td:nth-of-type(<?php 
            echo  $wcusage_ro_label_count ;
            ?>):before { content: "<?php 
            echo  $translate['wcusage_field_tr_ordername'] ;
            ?>"; }
        <?php 
            $wcusage_ro_label_count++;
            ?>
      <?php 
        }
        
        ?>

      <?php 
        
        if ( $option_show_list_products ) {
            ?>
        .wcu-table-recent-orders td:nth-of-type(<?php 
            echo  $wcusage_ro_label_count ;
            ?>):before { content: "<?php 
            echo  $translate['wcusage_field_tr_products'] ;
            ?>"; }
        <?php 
            $wcusage_ro_label_count++;
            ?>
      <?php 
        }
        
        ?>

      }

    }
    </style>

    <!-- Recent Orders Table -->
    <table id='wcuTable2' class='wcuTable wcu-table-recent-orders' border='2'>

    <thead valign="top">

      <tr class='wcuTableRow'>

        <?php 
        
        if ( $option_show_orderid ) {
            ?><th class='wcuTableHead'><?php 
            echo  __( 'ID', 'woo-coupon-usage' ) ;
            ?></th><?php 
        }
        
        ?>

        <?php 
        
        if ( $type == "mla" ) {
            ?>
          <th class='wcuTableHead'><?php 
            echo  __( 'Coupon', 'woo-coupon-usage' ) ;
            ?></th>
        <?php 
        }
        
        ?>

        <th class='wcuTableHead' style='width: 25%;'><?php 
        echo  __( 'Date', 'woo-coupon-usage' ) ;
        ?></th>

        <?php 
        
        if ( $option_show_status ) {
            ?>
          <th class='wcuTableHead'><?php 
            echo  __( 'Status', 'woo-coupon-usage' ) ;
            ?></th>
        <?php 
        }
        
        ?>

        <?php 
        
        if ( $option_show_amount ) {
            ?><th class='wcuTableHead'><?php 
            echo  __( 'Subtotal', 'woo-coupon-usage' ) ;
            ?></th><?php 
        }
        
        ?>

        <?php 
        
        if ( $option_show_amount_saved ) {
            ?><th class='wcuTableHead'><?php 
            echo  __( 'Discount', 'woo-coupon-usage' ) ;
            ?></th><?php 
        }
        
        ?>

        <th class='wcuTableHead'><?php 
        echo  __( 'Total', 'woo-coupon-usage' ) ;
        ?></th>

        <?php 
        
        if ( $orders['total_commission'] > 0 && $wcusage_show_commission ) {
            ?>
        <th class='wcuTableHead'>
          <?php 
            echo  __( 'Commission', 'woo-coupon-usage' ) ;
            ?>
        </th>
        <?php 
        }
        
        ?>

        <?php 
        
        if ( $option_show_shipping ) {
            ?>
          <th class='wcuTableHead'><?php 
            echo  __( 'Shipping', 'woo-coupon-usage' ) ;
            ?></th>
        <?php 
        }
        
        ?>

        <?php 
        
        if ( $option_show_ordercountry ) {
            ?>
          <th class='wcuTableHead'><?php 
            echo  __( 'Country', 'woo-coupon-usage' ) ;
            ?></th>
        <?php 
        }
        
        ?>

        <?php 
        
        if ( $option_show_ordercity ) {
            ?>
          <th class='wcuTableHead'><?php 
            echo  __( 'City', 'woo-coupon-usage' ) ;
            ?></th>
        <?php 
        }
        
        ?>

        <?php 
        
        if ( $option_show_ordername ) {
            ?>
          <th class='wcuTableHead'><?php 
            echo  __( 'Name', 'woo-coupon-usage' ) ;
            ?></th>
        <?php 
        }
        
        ?>

        <?php 
        if ( $option_show_list_products == "1" ) {
            ?>
          <th class='wcuTableHead'> </th>
        <?php 
        }
        ?>

      </tr>

    </thead>

    <?php 
        $currentid = 0;
        $combined_total_discount = 0;
        $combined_shipping = 0;
        $combined_ordertotal = 0;
        $combined_ordertotaldiscounted = 0;
        $combined_totalcommission = 0;
        $colstatus = 0;
        $i = 0;
        $count = 0;
        $cols = 0;
        $col1 = 0;
        $col2 = 0;
        $col3 = 0;
        $col4 = 0;
        $col5 = 0;
        $col6 = 0;
        $col7 = 0;
        $col8 = 0;
        $col9 = 0;
        $col10 = 0;
        $colmla = 0;
        foreach ( $orders as $item ) {
            
            if ( isset( $orders[$i]['order_id'] ) ) {
                $orderid = $orders[$i]['order_id'];
            } else {
                $orderid = "";
            }
            
            
            if ( $currentid != $orderid ) {
                $currentid = $orderid;
                $orderinfo = wc_get_order( $orderid );
                
                if ( $orderinfo ) {
                    $enablecurrency = wcusage_get_setting_value( 'wcusage_field_enable_currency', '0' );
                    if ( $orderinfo ) {
                        $currencycode = $orderinfo->get_currency();
                    }
                    $order_date = get_the_time( 'F j, Y', $orderid );
                    
                    if ( $orderinfo ) {
                        $completed_date = $orderinfo->get_date_completed();
                        $completed_date = date_i18n( "F j, Y", strtotime( $completed_date ) );
                    }
                    
                    
                    if ( $wcusage_field_order_sort != "completeddate" ) {
                        $showdate = $order_date;
                    } else {
                        $showdate = $completed_date;
                    }
                    
                    if ( !$orderid ) {
                        break;
                    }
                    $i++;
                    if ( $orderinfo->get_status() != "refunded" ) {
                        $count++;
                    }
                    $wcusage_show_tax = wcusage_get_setting_value( 'wcusage_field_show_tax', '0' );
                    $wcusage_currency_conversion = get_post_meta( $orderid, 'wcusage_currency_conversion', true );
                    $enable_save_rate = wcusage_get_setting_value( 'wcusage_field_enable_currency_save_rate', '0' );
                    if ( !$wcusage_currency_conversion || !$enable_save_rate ) {
                        $wcusage_currency_conversion = "";
                    }
                    $include_shipping_tax = 0;
                    $shipping = 0;
                    
                    if ( $orderinfo->get_total_shipping() ) {
                        if ( $wcusage_show_tax ) {
                            $include_shipping_tax = wcusage_get_order_tax_percent( $orderid );
                        }
                        $shipping = $orderinfo->get_total_shipping() * (1 + $include_shipping_tax);
                    }
                    
                    if ( $enablecurrency ) {
                        $shipping = wcusage_calculate_currency( $currencycode, $shipping, $wcusage_currency_conversion );
                    }
                    $combined_shipping += $shipping;
                    
                    if ( $wcusage_show_tax == 1 ) {
                        $total_tax = 0;
                    } else {
                        $total_tax = $orderinfo->get_total_tax();
                    }
                    
                    $calculateorder = wcusage_calculate_order_data(
                        $orderid,
                        '',
                        0,
                        1
                    );
                    $ordertotal = $calculateorder['totalorders'];
                    $combined_ordertotal += $ordertotal;
                    $ordertotaldiscounted = $calculateorder['totalordersexcl'];
                    $combined_ordertotaldiscounted += $ordertotaldiscounted;
                    $totalorders = $calculateorder['totalorders'];
                    $totaldiscounts = $calculateorder['totaldiscounts'];
                    $combined_total_discount += $totaldiscounts;
                    $totalordersexcl = $calculateorder['totalordersexcl'];
                    $totalcommission = $calculateorder['totalcommission'];
                    $tier = 0;
                    $totalcommissionmla = 0;
                    
                    if ( $type == "mla" ) {
                        foreach ( $orderinfo->get_coupon_codes() as $coupon_code ) {
                            $coupon = new WC_Coupon( $coupon_code );
                            $couponid = $coupon->get_id();
                            $coupon_user_id = get_post_meta( $couponid, 'wcu_select_coupon_user', true );
                            
                            if ( $coupon_user_id ) {
                                $get_parents = get_user_meta( $coupon_user_id, 'wcu_ml_affiliate_parents', true );
                                if ( is_array( $get_parents ) ) {
                                    $tier = array_search( $user_id, $get_parents );
                                }
                            }
                        
                        }
                        $totalcommission = wcusage_mla_get_commission_from_tier( $totalcommission, $tier );
                    }
                    
                    $combined_totalcommission += $totalcommission;
                    $affiliatecommission = "";
                    if ( isset( $calculateorder['affiliatecommission'] ) ) {
                        $affiliatecommission = $calculateorder['affiliatecommission'];
                    }
                    $currency = $orderinfo->get_currency();
                    $status = $orderinfo->get_status();
                    $order_refunds = $orderinfo->get_refunds();
                    // Check if order can be shown by current status
                    $check_status_show = wcusage_check_status_show( $status );
                    // Get subscription renewal icon if exist
                    $subicon = wcusage_get_sub_order_icon( $orderid );
                    //$wcusage_get_order_calculate_data_refunds = wcusage_get_order_calculate_data($orderid, $coupon_code, 'refunds');
                    //$refunds = $wcusage_get_order_calculate_data_refunds['item_count'];
                    
                    if ( $check_status_show && ($tier || $type != "mla") ) {
                        ?>

            <!-- Script for toggling list of products section -->
            <script>
            jQuery( document ).ready(function() {
              jQuery( "#listproductsbutton<?php 
                        echo  $orderid ;
                        ?>" ).click(function() {
                jQuery( ".wcuTableCell.orderproductstd<?php 
                        echo  $orderid ;
                        ?> .fa-chevron-down" ).toggle();
                jQuery( ".wcuTableCell.orderproductstd<?php 
                        echo  $orderid ;
                        ?> .fa-chevron-up" ).toggle();
                jQuery( ":not(#listproducts<?php 
                        echo  $orderid ;
                        ?>).listtheproducts" ).hide();
                jQuery( "#listproducts<?php 
                        echo  $orderid ;
                        ?>" ).toggle();
                jQuery( "#listproducts2<?php 
                        echo  $orderid ;
                        ?>" ).toggle();
              });
            });
            </script>

            <tr class='wcuTableRow'>
              <?php 
                        // Order ID
                        
                        if ( $option_show_orderid ) {
                            echo  "<td class='wcuTableCell'>" ;
                            echo  "#" . $orderid ;
                            echo  "</td>" ;
                            $col1 = true;
                        }
                        
                        
                        if ( $type == "mla" ) {
                            echo  "<td class='wcuTableCell'>" ;
                            foreach ( $orderinfo->get_coupon_codes() as $coupon_code ) {
                                $coupon = new WC_Coupon( $coupon_code );
                                $couponid = $coupon->get_id();
                                $coupon_user_id = get_post_meta( $couponid, 'wcu_select_coupon_user', true );
                                $coupon_user_info = get_user_by( 'ID', $coupon_user_id );
                                $coupon_user_name = $coupon_user_info->user_login;
                                echo  "<span title='User: " . $coupon_user_name . "'><span class='fa-solid fa-tags' style='font-size: 12px; display: inline; margin-right: 5px;'></span>" . $coupon_code . "</span><br/>" ;
                            }
                            echo  "</td>" ;
                            $colmla = true;
                        }
                        
                        // Date
                        echo  "<td class='wcuTableCell'><strong>" . $subicon . ucfirst( $showdate ) . "</strong></td>" ;
                        // Status
                        
                        if ( $option_show_status ) {
                            echo  "<td class='wcuTableCell'>" . ucfirst( wc_get_order_status_name( $orderinfo->get_status() ) ) . "</td>" ;
                            $colstatus = true;
                        }
                        
                        // Total
                        
                        if ( $option_show_amount != "0" ) {
                            echo  "<td class='wcuTableCell'> " . wcusage_format_price( $ordertotal ) . "</td>" ;
                            $col2 = true;
                        }
                        
                        
                        if ( $option_show_amount_saved != "0" ) {
                            echo  "<td class='wcuTableCell'> " . wcusage_format_price( number_format(
                                (double) $totaldiscounts,
                                2,
                                '.',
                                ''
                            ) ) . "</td>" ;
                            $col3 = true;
                        }
                        
                        echo  "<td class='wcuTableCell'> " . wcusage_format_price( number_format(
                            (double) $ordertotaldiscounted,
                            2,
                            '.',
                            ''
                        ) ) . "</td>" ;
                        
                        if ( $orders['total_commission'] > 0 && $wcusage_show_commission ) {
                            echo  "<td class='wcuTableCell'> " ;
                            if ( $type == "mla" ) {
                                echo  "<span title='Your commission earned from this sub-affiliate referral.'>" ;
                            }
                            echo  wcusage_format_price( number_format(
                                (double) $totalcommission,
                                2,
                                '.',
                                ''
                            ) ) ;
                            if ( $type == "mla" ) {
                                echo  "</span>" ;
                            }
                            echo  "</td>" ;
                            $col5 = true;
                        }
                        
                        // Shipping
                        
                        if ( $option_show_shipping != "0" ) {
                            echo  "<td class='wcuTableCell'> " . wcusage_format_price( $shipping ) . "</td>" ;
                            $col6 = true;
                        }
                        
                        // Country
                        $zone_country = $orderinfo->get_billing_country();
                        
                        if ( $option_show_ordercountry ) {
                            echo  "<td class='wcuTableCell'> " . $zone_country . "</td>" ;
                            $col8 = true;
                        }
                        
                        // City
                        $zone_city = $orderinfo->get_billing_city();
                        
                        if ( $option_show_ordercity ) {
                            echo  "<td class='wcuTableCell'> " . $zone_city . "</td>" ;
                            $col9 = true;
                        }
                        
                        // First Name
                        $zone_name = get_post_meta( $orderinfo->get_id(), '_billing_first_name', true );
                        
                        if ( $option_show_ordername ) {
                            echo  "<td class='wcuTableCell'> " . $zone_name . "</td>" ;
                            $col10 = true;
                        }
                        
                        /* Show the "MORE" products list column / toggle on table */
                        
                        if ( $option_show_list_products == "1" ) {
                            
                            if ( $orderinfo->get_items() ) {
                                echo  "<td class='wcuTableCell excludeThisClass orderproductstd orderproductstd" . $orderid . "' style='min-width: 100px; font-size: 16px;'>" ;
                                echo  "<a class='listproductsbutton' href='javascript:void(0);' id='listproductsbutton" . $orderid . "'>" . $translate['wcusage_field_tr_more'] . " <i class='fas fa-chevron-down'></i> <i class='fas fa-chevron-up' style='display: none;'></i></i></i></a>" ;
                            } else {
                                echo  "<td class='wcuTableCell excludeThisClass orderproductstd'>" ;
                            }
                            
                            echo  "</td>" ;
                            $col7 = true;
                            $cols++;
                        }
                        
                        $totalorders = 0;
                        $totaldiscounts = 0;
                        $totalcommission = 0;
                        ?>
            </tr>

            <?php 
                        // Cols Count
                        $cols = $wcusage_ro_label_count + 1;
                        /* Show the "MORE" products list section */
                        if ( $option_show_list_products == "1" ) {
                            
                            if ( $orderinfo->get_items() ) {
                                $order_summary = $calculateorder['commission_summary'];
                                
                                if ( isset( $order_summary ) ) {
                                    $extracols = $wcusage_ro_label_count - 7;
                                    $productcols = 2 + $extracols - 1;
                                    ?>

                <tbody style="margin-bottom: 15px;" id="listproducts<?php 
                                    echo  $orderid ;
                                    ?>" class="listtheproducts listtheproducts-summary"<?php 
                                    if ( $option_show_list_products ) {
                                        ?> style="display: none;"<?php 
                                    }
                                    ?>>

                  <?php 
                                    do_action(
                                        'wcusage_hook_get_detailed_products_summary_tr',
                                        $orderinfo,
                                        $order_summary,
                                        $productcols,
                                        $tier
                                    );
                                    ?>

                </tbody>

                <tbody id="listproducts2<?php 
                                    echo  $orderid ;
                                    ?>" style="display: none;">
                  <tr class="listtheproducts listtheproducts-small">
                    <?php 
                                    do_action(
                                        'wcusage_hook_get_basic_list_order_products',
                                        $orderinfo,
                                        $order_refunds,
                                        $cols
                                    );
                                    ?>
                  </tr>
                </tbody>

              </span>

              <?php 
                                }
                            
                            }
                        
                        }
                        ?>

          <?php 
                        $completedorders = $completedorders + 1;
                    }
                    
                    
                    if ( $count >= $totalcount || $count >= $option_coupon_orders ) {
                        if ( $customdaterange ) {
                            echo  "<p>" . __( "Maximum orders per request reached", "woo-coupon-usage" ) . " (" . $option_coupon_orders . "). " . __( "Please shorten your date range to show all orders.", "woo-coupon-usage" ) . "</p>" ;
                        }
                        ?>
              <script>
              jQuery( document ).ready(function() {
                jQuery( '#wcu-orders-start' ).val("<?php 
                        echo  date( "Y-m-d", strtotime( $showdate ) ) ;
                        ?>");
              });
              </script>
              <?php 
                        break;
                    }
                
                }
            
            }
        
        }
        ?>

    <?php 
        $wcusage_show_orders_table_totals = wcusage_get_setting_value( 'wcusage_field_show_orders_table_totals', '1' );
        
        if ( $wcusage_show_orders_table_totals ) {
            ?>

      <?php 
            
            if ( $completedorders > 0 ) {
                ?>
      <tfoot valign="top">
        <tr class='wcuTableRow'>

          <?php 
                if ( $col1 ) {
                    echo  "<td class='wcuTableFoot'></td>" ;
                }
                echo  "<td class='wcuTableFoot'><strong>" . $translate['wcusage_field_tr_totals'] . ": </strong></td>" ;
                if ( $colstatus ) {
                    echo  "<td class='wcuTableFoot'></td>" ;
                }
                if ( $colmla ) {
                    echo  "<td class='wcuTableFoot'></td>" ;
                }
                if ( $col2 ) {
                    echo  "<td class='wcuTableFoot'><strong>" . wcusage_format_price( number_format(
                        $combined_ordertotal,
                        2,
                        '.',
                        ''
                    ) ) . "</strong></td>" ;
                }
                if ( $col3 ) {
                    echo  "<td class='wcuTableFoot'><strong>" . wcusage_format_price( number_format(
                        $combined_total_discount,
                        2,
                        '.',
                        ''
                    ) ) . "</strong></td>" ;
                }
                echo  "<td class='wcuTableFoot'><strong>" . wcusage_format_price( number_format(
                    $combined_ordertotaldiscounted,
                    2,
                    '.',
                    ''
                ) ) . "</strong></td>" ;
                if ( $col5 ) {
                    echo  "<td class='wcuTableFoot'><strong>" . wcusage_format_price( number_format(
                        $combined_totalcommission,
                        2,
                        '.',
                        ''
                    ) ) . "</strong></td>" ;
                }
                if ( $col6 ) {
                    echo  "<td class='wcuTableFoot'><strong>" . wcusage_format_price( number_format(
                        $combined_shipping,
                        2,
                        '.',
                        ''
                    ) ) . "</strong></td>" ;
                }
                $finalcolspan = 1;
                if ( $col8 ) {
                    echo  "<td class='wcuTableFoot'></td>" ;
                }
                if ( $col9 ) {
                    echo  "<td class='wcuTableFoot'></td>" ;
                }
                if ( $col10 ) {
                    echo  "<td class='wcuTableFoot'></td>" ;
                }
                if ( $col7 ) {
                    echo  "<td class='wcuTableFoot'></td>" ;
                }
                ?>
        </tr>
      </tfoot>
      <?php 
            }
            
            ?>

    <?php 
        }
        
        ?>

    </table>
    <?php 
        if ( $completedorders == 0 ) {
            echo  "<p>" . $translate['wcusage_field_tr_coupon_no_orders'] . "<p><br/>" ;
        }
        echo  "</div>" ;
    }

}
/**
 * Gets the filters for latest orders
 *
 * @param date $wcu_orders_start
 * @param date $wcu_orders_end
 * @param string $coupon_code
 *
 * @return mixed
 *
 */
add_action(
    'wcusage_hook_tab_latest_orders_filters',
    'wcusage_tab_latest_orders_filters',
    10,
    3
);
if ( !function_exists( 'wcusage_tab_latest_orders_filters' ) ) {
    function wcusage_tab_latest_orders_filters( $wcu_orders_start, $wcu_orders_end, $coupon_code )
    {
        $translate = wcusage_translate();
        $options = get_option( 'wcusage_options' );
        $wcusage_field_load_ajax = wcusage_get_setting_value( 'wcusage_field_load_ajax', '1' );
        ?>

	<?php 
        ?>

	<div class="wcu-filters-col1">
		<div class="wcu-filters-inner">
			<div class="wcu-order-filters">

					<form method="post" id="wcusage_settings_form_orders" class="wcusage_settings_form" <?php 
        if ( $wcusage_field_load_ajax ) {
            ?>onsubmit="return false;"<?php 
        }
        ?>>
						<span class="wcu-order-filters-field"><?php 
        echo  $translate['wcusage_field_tr_start'] ;
        ?>: <input type="date" id="wcu-orders-start" name="wcu_orders_start" value="<?php 
        echo  $wcu_orders_start ;
        ?>"></span><span class="wcu-order-filters-space">&nbsp;</span><span class="wcu-order-filters-field"><?php 
        echo  $translate['wcusage_field_tr_end'] ;
        ?>: <input type="date" id="wcu-orders-end" name="wcu_orders_end" value="<?php 
        echo  $wcu_orders_end ;
        ?>"></span><span class="wcu-order-filters-space">&nbsp;</span><input type="text" name="page-orders" value="1" style="display: none;"><input type="text" name="load-page" value="1" style="display: none;"><input class="ordersfilterbutton" type="submit" id="wcu-orders-button" name="submitordersfilter" value="<?php 
        echo  $translate['wcusage_field_tr_filter'] ;
        ?>" style="padding: 1px 10px;">
					</form>

			</div>
		</div>
	</div>

	<div class="wcu-filters-col2">
		<div class="wcu-filters-inner">

			<?php 
        ?>
		</div>
	</div>

	<style>.wcu-loading-orders { display: none; }</style>

	<?php 
    }

}
/**
 * Gets latest orders tab for shortcode page
 *
 * @param int $postid
 * @param string $coupon_code
 * @param int $combined_commission
 *
 * @return mixed
 *
 */
add_action(
    'wcusage_hook_dashboard_tab_content_latest_orders',
    'wcusage_dashboard_tab_content_latest_orders',
    10,
    4
);
if ( !function_exists( 'wcusage_dashboard_tab_content_latest_orders' ) ) {
    function wcusage_dashboard_tab_content_latest_orders(
        $postid,
        $coupon_code,
        $combined_commission,
        $wcusage_page_load
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
        $wcusage_justcoupon = wcusage_get_setting_value( 'wcusage_field_justcoupon', '1' );
        $wcusage_show_tax = wcusage_get_setting_value( 'wcusage_field_show_tax', '0' );
        $wcusage_hide_all_time = wcusage_get_setting_value( 'wcusage_field_hide_all_time', '0' );
        $wcusage_urlprivate = wcusage_get_setting_value( 'wcusage_field_urlprivate', '1' );
        if ( wcusage_check_admin_access() ) {
            $wcusage_urlprivate = 0;
        }
        $ajaxerrormessage = wcusage_ajax_error();
        // *** DISPLAY CONTENT *** //
        ?>

  <?php 
        
        if ( isset( $_POST['page-orders'] ) || $wcusage_page_load == false ) {
            ?>

    <?php 
            // Get orders date filters
            $isordersstartset = false;
            $wcu_orders_start = "";
            $wcu_orders_end = "";
            
            if ( $wcu_orders_start == "" ) {
                $wcu_orders_start = "";
            } else {
                $isordersstartset = true;
            }
            
            if ( $wcu_orders_end == "" ) {
                $wcu_orders_end = date( "Y-m-d" );
            }
            ?>

    <?php 
            if ( isset( $_POST['page-orders'] ) ) {
                ?>
    <style>#wcu3 { display: block;  }</style>
    <?php 
            }
            ?>

    <div id="wcu3" <?php 
            if ( $wcusage_show_tabs == '1' || $wcusage_show_tabs == '' ) {
                ?>class="wcutabcontent"<?php 
            }
            ?>>

      <script>
      <?php 
            if ( $wcusage_field_load_ajax_per_page ) {
                ?>
      jQuery( "#tab-page-orders" ).one('click', wcusage_run_tab_page_orders);
      <?php 
            }
            ?>
      jQuery( ".wcusage-refresh-data" ).on('click', wcusage_run_tab_page_orders);

      function wcusage_run_tab_page_orders() {

        jQuery('#wcusage_settings_form_orders').on('submit', function (e) {

          /* 3 second disable on click button */
          jQuery( "#wcu-orders-button" ).css("opacity", "0.5");
          jQuery( "#wcu-orders-button" ).css("pointer-events", "none");
          setTimeout(function(){
            jQuery( "#wcu-orders-button" ).css("opacity", "1");
            jQuery( "#wcu-orders-button" ).css("pointer-events", "auto");
          }, 3*1000);

          /* Set content to empty */
          jQuery('.show_orders').html('');

          /* Ajax request */
          var data = {
            action: 'wcusage_load_page_orders',
            _ajax_nonce: '<?php 
            echo  wp_create_nonce( 'wcusage_dashboard_ajax_nonce' ) ;
            ?>',
            postid: '<?php 
            echo  sanitize_text_field( $postid ) ;
            ?>',
            couponcode: '<?php 
            echo  sanitize_text_field( $coupon_code ) ;
            ?>',
            startdate: jQuery('input[name=wcu_orders_start]').val(),
            enddate: jQuery('input[name=wcu_orders_end]').val(),
            language: '<?php 
            echo  $language ;
            ?>',
          };
          jQuery.ajax({
              type: 'POST',
              url: wcusageajax.ajaxurl,
              data: data,
              success: function(data){ jQuery('.show_orders').html(data); },
              error: function(data){ jQuery('.show_orders').html("<?php 
            echo  $ajaxerrormessage ;
            ?>"); }
          });

        });
        jQuery( "#wcu-orders-button" ).click();

      }
      </script>

      <?php 
            echo  "<p class='wcu-tab-title coupon-orders-list-title' style='font-size: 22px; margin-bottom: 0;'>" . $translate['wcusage_field_tr_latest_orders_using'] . ":</p>" ;
            // Latest orders using coupon:
            ?>

      <?php 
            do_action(
                'wcusage_hook_tab_latest_orders_filters',
                $wcu_orders_start,
                $wcu_orders_end,
                $coupon_code
            );
            ?>
      <div style="clear: both;"></div>

      <?php 
            
            if ( $wcusage_field_load_ajax ) {
                ?>

        <div class="show_orders"></div>

        <div class="wcu-loading-image wcu-loading-orders">
          <div class="wcu-loading-loader">
            <div class="loader"></div>
          </div>
          <p style="margin: 0;font-size:;font-weight: bold; margin-top: 30px; width: 100px; text-align: center;"><br/><?php 
                echo  __( "Loading", "woo-coupon-usage" ) ;
                ?>...</p>
        </div>

      <?php 
            } else {
                ?>

        <?php 
                do_action(
                    'wcusage_hook_tab_latest_orders',
                    $postid,
                    $coupon_code,
                    $wcu_orders_start,
                    $wcu_orders_end,
                    $isordersstartset
                );
                ?>

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