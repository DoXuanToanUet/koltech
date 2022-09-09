<?php
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
/**
 * Displays the normal dashboard tabs used in the shortcode
 *
 * @return mixed
 *
 */
add_action(
    'wcusage_hook_dashboard_normal_tabs',
    'wcusage_dashboard_normal_tabs',
    10,
    1
);
function wcusage_dashboard_normal_tabs( $wcusage_page_load )
{
    // $options
    $options = get_option( 'wcusage_options' );
    // $translate
    $translate = wcusage_translate();
    // $option_coupon_orders
    $option_coupon_orders = wcusage_get_setting_value( 'wcusage_field_orders', '10' );
    $show_tabs_icons = wcusage_get_setting_value( 'wcusage_field_show_tabs_icons', '1' );
    ?>

<div class="wcutab">

  <!-- ##############Info Tab ############## -->
  <?php 
    if ( $wcusage_page_load ) {
        ?><form method="post"><?php 
    }
    ?>
  <input type="text" name="page-stats" value="1" style="display: none;">

  <button id="tab-page-stats" class="wcutablinks wcutabfirst <?php 
    if ( isset( $_POST['page-stats'] ) || !isset( $_POST['load-page'] ) && $wcusage_page_load ) {
        ?>wcu-active-tab<?php 
    }
    ?>" <?php 
    if ( !$wcusage_page_load ) {
        ?>onclick="wcuOpenTab(event, 'wcu1')"<?php 
    }
    ?>>
    <?php 
    if ( $show_tabs_icons ) {
        ?><i class="fas fa-chart-line fa-xs"></i> <?php 
    }
    echo  $translate['wcusage_field_tr_coupon_info'] ;
    ?>
  </button>

  <?php 
    if ( $wcusage_page_load ) {
        ?></form><?php 
    }
    ?>

  <!-- ############## Monthly Summary Tab ############## -->
  <?php 
    ?>

  <!-- ############## Recent Orders Tab############## -->
  <?php 
    
    if ( $option_coupon_orders > 0 || $option_coupon_orders == "" ) {
        ?>

    <?php 
        if ( $wcusage_page_load ) {
            ?><form method="post"><?php 
        }
        ?>
    <input type="text" name="page-orders" value="1" style="display: none;">

      <button id="tab-page-orders" name="load-page" class="wcutablinks tabrecentorders <?php 
        if ( isset( $_POST['page-orders'] ) && $wcusage_page_load ) {
            ?>wcu-active-tab<?php 
        }
        ?>" <?php 
        if ( !$wcusage_page_load ) {
            ?>onclick="wcuOpenTab(event, 'wcu3')"<?php 
        }
        ?>>
        <?php 
        if ( $show_tabs_icons ) {
            ?><i class="fas fa-shopping-cart fa-xs"></i> <?php 
        }
        echo  $translate['wcusage_field_tr_recent_orders'] ;
        ?>
      </button>

    <?php 
        if ( $wcusage_page_load ) {
            ?></form><?php 
        }
        ?>

  <?php 
    }
    
    ?>

  <!-- ############## Links Tab ############## -->
  <?php 
    $wcusage_field_urls_enable = wcusage_get_setting_value( 'wcusage_field_urls_enable', '1' );
    $wcusage_field_urls_tab_enable = wcusage_get_setting_value( 'wcusage_field_urls_tab_enable', '1' );
    
    if ( $wcusage_field_urls_enable == '1' && $wcusage_field_urls_tab_enable == '1' ) {
        ?>

  <?php 
        if ( $wcusage_page_load ) {
            ?><form method="post"><?php 
        }
        ?>
  <input type="text" name="page-links" value="1" style="display: none;">

  <button id="tab-page-links" name="load-page" class="wcutablinks tablinks <?php 
        if ( isset( $_POST['page-links'] ) && $wcusage_page_load ) {
            ?>wcu-active-tab<?php 
        }
        ?>" <?php 
        if ( !$wcusage_page_load ) {
            ?>onclick="wcuOpenTab(event, 'wcu4')"<?php 
        }
        ?>>
    <?php 
        if ( $show_tabs_icons ) {
            ?><i class="fas fa-link fa-xs"></i> <?php 
        }
        echo  $translate['wcusage_field_tr_referral_url'] ;
        ?>
  </button>

  <?php 
        if ( $wcusage_page_load ) {
            ?></form><?php 
        }
        ?>

  <?php 
    }
    
    ?>

  <!-- ############## Creatives Tab ############## -->
  <?php 
    $wcusage_field_creatives_enable = wcusage_get_setting_value( 'wcusage_field_creatives_enable', '1' );
    ?>

  <!-- ############## Payouts Tab ############## -->
  <?php 
    $wcusage_field_payouts_enable = wcusage_get_setting_value( 'wcusage_field_payouts_enable', '1' );
    ?>

  <!-- ############## Settings Tab ############## -->
  <?php 
    $wcusage_field_show_settings_tab_show = wcusage_get_setting_value( 'wcusage_field_show_settings_tab_show', '1' );
    if ( is_user_logged_in() ) {
        
        if ( $wcusage_field_show_settings_tab_show ) {
            ?>

  <?php 
            if ( $wcusage_page_load ) {
                ?><form method="post"><?php 
            }
            ?>
  <input type="text" name="page-settings" value="1" style="display: none;">

  <button id="tab-page-settings" name="load-page" class="wcutablinks tabsettings <?php 
            if ( isset( $_POST['page-settings'] ) && $wcusage_page_load ) {
                ?>wcu-active-tab<?php 
            }
            ?>" <?php 
            if ( !$wcusage_page_load ) {
                ?>onclick="wcuOpenTab(event, 'wcu6')"<?php 
            }
            ?>>
    <?php 
            if ( $show_tabs_icons ) {
                ?><i class="fas fa-cog fa-xs"></i> <?php 
            }
            echo  $translate['wcusage_field_tr_settings'] ;
            ?>
  </button>

  <?php 
            if ( $wcusage_page_load ) {
                ?></form><?php 
            }
            ?>

    <?php 
        }
    
    }
    ?>

  <!-- ############## Custom Tabs ############## -->

  <?php 
    do_action( 'wcusage_hook_after_normal_tabs', $wcusage_page_load );
    // Custom Hook
    ?>

</div>

<?php 
}

/**
 * Checks the current session to prevent spamming requests. No more than 15 requests per 2 minute session.
 *
 * @param int $postid
 *
 * @return boolean
 *
 */
function wcusage_requests_session_check( $postid )
{
    //delete_post_meta( $postid, 'wcu_requests_last_session' );
    //delete_post_meta( $postid, 'wcu_requests_last_session_count' );
    $blocked = 0;
    $wcu_requests_last_session = get_post_meta( $postid, 'wcu_requests_last_session', true );
    $wcu_requests_last_session_count = get_post_meta( $postid, 'wcu_requests_last_session_count', true );
    
    if ( $wcu_requests_last_session ) {
        $futureRequestDate = $wcu_requests_last_session + 60 * 2;
        $currentRequestDate = strtotime( date( 'Y-m-d H:i:s' ) );
        
        if ( $currentRequestDate < $futureRequestDate ) {
            $wcu_requests_last_session_count = get_post_meta( $postid, 'wcu_requests_last_session_count', true );
            update_post_meta( $postid, 'wcu_requests_last_session_count', $wcu_requests_last_session_count + 1 );
            $wcu_requests_last_session_count = get_post_meta( $postid, 'wcu_requests_last_session_count', true );
            if ( $wcu_requests_last_session_count > 15 ) {
                $blocked = 1;
            }
        } else {
            update_post_meta( $postid, 'wcu_requests_last_session', strtotime( date( 'Y-m-d H:i:s' ) ) );
            update_post_meta( $postid, 'wcu_requests_last_session_count', 1 );
        }
    
    }
    
    
    if ( !$wcu_requests_last_session ) {
        update_post_meta( $postid, 'wcu_requests_last_session', strtotime( date( 'Y-m-d H:i:s' ) ) );
        update_post_meta( $postid, 'wcu_requests_last_session_count', 1 );
        $wcu_requests_last_session = get_post_meta( $postid, 'wcu_requests_last_session', true );
        $wcu_requests_last_session_count = get_post_meta( $postid, 'wcu_requests_last_session_count', true );
    }
    
    $return_array = [];
    $return_array['status'] = $blocked;
    $return_array['message'] = "<p style='color: red;'>" . __( 'Request Failed!', 'woo-coupon-usage' ) . "</p><p>" . __( 'You are sending too many of requests in a short time and have been temporarily timed out.', 'woo-coupon-usage' ) . "</p><p>" . __( 'Please try again in around 1-2 minutes.', 'woo-coupon-usage' ) . "</p>";
    return $return_array;
}

/**
 * Code added to end of the affiliate dashboard page shortcode.
 *
 */
if ( !function_exists( 'wcusage_do_after_dashboard' ) ) {
    function wcusage_do_after_dashboard()
    {
        $options = get_option( 'wcusage_options' );
        $wcusage_field_load_ajax = wcusage_get_setting_value( 'wcusage_field_load_ajax', 1 );
        $wcusage_field_load_ajax_per_page = wcusage_get_setting_value( 'wcusage_field_load_ajax_per_page', 1 );
        if ( !$wcusage_field_load_ajax ) {
            $wcusage_field_load_ajax_per_page = 0;
        }
        ?>

    <style>
    :not(section.container) #preloader, :not(section.container) .preloader, :not(section.container) .smart-page-loader, :not(section.container) #wptime-plugin-preloader, :not(section.container) .loaderWrap {
      display: none !important;
    }
    </style>

  	<?php 
        if ( $wcusage_field_load_ajax && !$wcusage_field_load_ajax_per_page ) {
            ?>
  		<script>
  		jQuery(document).ready(function(){
  			jQuery( ".wcusage-refresh-data" ).click();
  		});
  		</script>
  	<?php 
        }
        ?>

    <?php 
    }

}
add_action(
    'wcusage_hook_after_dashboard',
    'wcusage_do_after_dashboard',
    10,
    0
);
/**
 * Gets the old basic products list table row
 *
 * @param array $orderinfo
 * @param array $order_refunds
 * @param int $cols
 *
 * @return mixed
 *
 */
add_action(
    'wcusage_hook_get_basic_list_order_products',
    'wcusage_get_basic_list_order_products',
    10,
    3
);
function wcusage_get_basic_list_order_products( $orderinfo, $order_refunds, $cols )
{
    $translate = wcusage_translate();
    ?>

  <td class='wcuTableCell' colspan="<?php 
    echo  $cols ;
    ?>">

  <strong><?php 
    echo  $translate['wcusage_field_tr_products'] ;
    ?>:</strong><br/>
  <?php 
    foreach ( $orderinfo->get_items() as $key => $lineItem ) {
        $refunded_quantity = 0;
        foreach ( $order_refunds as $refund ) {
            foreach ( $refund->get_items() as $item_id => $item ) {
                
                if ( $item->get_product_id() == $lineItem['product_id'] ) {
                    $refunded_quantity += abs( $item->get_quantity() );
                    // Get Refund Qty
                }
            
            }
        }
        $itemtotal = $lineItem['qty'] - $refunded_quantity;
        echo  "&#8226; " . $itemtotal . " x " . $lineItem['name'] . "<br/>" ;
    }
    ?>
  </td>

<?php 
}

/**
 * Gets the detailed products summary section / tr
 *
 * @param array $orderinfo
 * @param array $order_refunds
 * @param int $cols
 *
 * @return mixed
 *
 */
add_action(
    'wcusage_hook_get_detailed_products_summary_tr',
    'wcusage_get_detailed_products_summary_tr',
    10,
    4
);
function wcusage_get_detailed_products_summary_tr(
    $orderinfo,
    $order_summary,
    $productcols,
    $tier = ""
)
{
    if ( $order_summary ) {
        ksort( $order_summary );
    }
    $translate = wcusage_translate();
    $wcusage_show_commission_before_discount = wcusage_get_setting_value( 'wcusage_field_commission_before_discount', '0' );
    
    if ( $wcusage_show_commission_before_discount ) {
        $this_show_total_title = __( "Subtotal", "woo-coupon-usage" );
    } else {
        $this_show_total_title = __( "Total", "woo-coupon-usage" );
    }
    
    ?>

  <tr class="wcuTableRow listtheproducts-summary-head">
    <td class='wcuTableHead-summary' colspan="<?php 
    echo  $productcols ;
    ?>">
      <?php 
    echo  __( "Product", "woo-coupon-usage" ) ;
    ?>
    </td>
    <td class='wcuTableHead-summary' colspan="1">
      <?php 
    echo  __( "Quantity", "woo-coupon-usage" ) ;
    ?>
    </td>
    <td class='wcuTableHead-summary' colspan="2">
      <?php 
    echo  $this_show_total_title ;
    ?>
    </td>
    <td class='wcuTableHead-summary' colspan="2">
      <?php 
    echo  __( "Commission", "woo-coupon-usage" ) ;
    ?>
    </td>
  </tr>

  <?php 
    if ( !empty($order_summary) ) {
        foreach ( $order_summary as $key => $value ) {
            $this_number = "-";
            $this_subtotal = "0.00";
            $this_total = "0.00";
            $this_discount = "0.00";
            $this_show_total = "0.00";
            if ( isset( $value['number'] ) ) {
                $this_number = $value['number'];
            }
            $the_commission = "";
            if ( isset( $value['commission'] ) ) {
                $the_commission = $value['commission'];
            }
            $the_subtotal = "";
            if ( isset( $value['subtotal'] ) ) {
                $the_subtotal = $value['subtotal'];
            }
            $the_total = "";
            if ( isset( $value['total'] ) ) {
                $the_total = $value['total'];
            }
            
            if ( $orderinfo ) {
                $the_commission = wcusage_convert_order_value_to_currency( $orderinfo, $the_commission );
                $the_subtotal = wcusage_convert_order_value_to_currency( $orderinfo, $the_subtotal );
                $the_total = wcusage_convert_order_value_to_currency( $orderinfo, $the_total );
            }
            
            if ( $tier ) {
                $the_commission = wcusage_mla_get_commission_from_tier( $the_commission, $tier );
            }
            $this_commission = wcusage_format_price( number_format(
                $the_commission,
                2,
                '.',
                ''
            ) );
            
            if ( $wcusage_show_commission_before_discount ) {
                if ( isset( $value['subtotal'] ) ) {
                    $this_show_total = wcusage_format_price( number_format(
                        $the_subtotal,
                        2,
                        '.',
                        ''
                    ) );
                }
            } else {
                if ( isset( $value['total'] ) ) {
                    $this_show_total = wcusage_format_price( number_format(
                        $the_total,
                        2,
                        '.',
                        ''
                    ) );
                }
            }
            
            
            if ( is_numeric( $key ) ) {
                $product_title = get_the_title( $key );
            } else {
                $product_title = $key;
            }
            
            
            if ( $value['commission'] > 0 ) {
                ?>
      <tr class="wcuTableRowDropdown">
        <td class='wcuTableCell' colspan="<?php 
                echo  $productcols ;
                ?>" style="padding: 0 !important;">
          <?php 
                echo  $product_title ;
                ?> <a href="<?php 
                echo  get_permalink( $key ) ;
                ?>" target="_blank" title="<?php 
                echo  __( "View Product", "woo-coupon-usage" ) ;
                ?>"><span class="fa-solid fa-arrow-up-right-from-square" style="font-size: 10px;"></span></a>
        </td>
        <td class='wcuTableCell' colspan="1" style="padding: 4px 10px !important;">
          <?php 
                echo  $this_number ;
                ?>
        </td>
        <td class='wcuTableCell' colspan="2" style="padding: 4px 10px !important;">
          <?php 
                echo  $this_show_total ;
                ?>
        </td>
        <td class='wcuTableCell' colspan="2" style="padding: 4px 10px !important;">
          <?php 
                echo  $this_commission ;
                ?>
        </td>
      </tr>
      <?php 
            }
        
        }
    }
    ?>

  <tr style="height: 15px;"></tr>

<?php 
}
