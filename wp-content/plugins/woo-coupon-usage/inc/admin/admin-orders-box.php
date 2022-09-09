<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if(!class_exists( 'SitePress' )) { // Temp fix for WPML conflict
  function wcusage_add_custom_box() {

    $screens = ['shop_order', 'wporg_cpt'];
    foreach ($screens as $screen) {
        add_meta_box(
            'wcusage_affiliate_info',           // Unique ID
            'Coupon Affiliate',  // Box title
            'wcusage_custom_box_html',  // Content callback, must be of type callable
            $screen,      // Post type
  		'side'
        );
    }

  }
  add_action('add_meta_boxes', 'wcusage_add_custom_box');
}

function wcusage_custom_box_html($post)
{

	$options = get_option( 'wcusage_options' );
	$wcusage_show_column_code = wcusage_get_setting_value('wcusage_field_show_orders_aff_info', '1');

	if( $wcusage_show_column_code && !class_exists( 'SitePress' ) ) {

		$value = get_post_meta($post->ID, '_wcusage_meta_key', true);

		$order = wc_get_order( $post->ID );

		$affiliate = array();
		$coupon_codes = array();

    $recurringaffiliate = $order->get_meta('lifetime_affiliate_coupon_referrer');

    if($recurringaffiliate) {

      wcusage_custom_box_html_content($recurringaffiliate, $post, $order, 1);

    } else {

      if ( class_exists( 'WooCommerce' ) ) {
        if ( version_compare( WC_VERSION, 3.7, ">=" ) ) {
      		foreach( $order->get_coupon_codes() as $coupon_code ) {
      			// Get the WC_Coupon object

      			if($coupon_code) {

              wcusage_custom_box_html_content($coupon_code, $post, $order, 0);

      			}

      		}
        }
      }

    }

    if( !$order->get_coupon_codes() && !$recurringaffiliate ) {
      echo __( "No coupons were used for this order.", "woo-coupon-usage" );
    }

	} else {

    echo __( "Affiiliate Info not available.", "woo-coupon-usage" );

  }

}

function wcusage_custom_box_html_content($coupon_code, $post, $order, $type) {

  $getinfo = wcusage_get_the_order_coupon_info($coupon_code, "", $post);

  echo "<p>";
  if($type) {
    echo '('.__( 'Lifetime Referrer', 'woo-coupon-usage' ).')<br/>';
  }
  echo 'Coupon Code: '.$coupon_code.'<br/>';
  echo $getinfo['affililiateusertext'];
  if( $order->get_status() != "refunded" ) {
        echo __( 'Commission', 'woo-coupon-usage' ) . ": " . $getinfo['thecommission'] . "<br/>";
  }
  echo "<a href='".$getinfo['uniqueurl']."' target='_blank' style='color: #07bbe3;'>". __( 'View Dashboard', 'woo-coupon-usage' ) ."</a>";
  echo "</p>";

  $wcusage_field_mla_enable = wcusage_get_setting_value('wcusage_field_mla_enable', '0');
  if( $wcusage_field_mla_enable && wcu_fs()->can_use_premium_code() ) {
    $get_parents = get_user_meta( $getinfo['theuserid'], 'wcu_ml_affiliate_parents', true );
    if(!empty($get_parents) && is_array($get_parents)) {
      echo "<p><strong>MLA Commission:</strong>";
      foreach($get_parents as $key => $parent_id) {
          $parent_user_info = get_user_by( 'ID', $parent_id );
          $parent_user_name = $parent_user_info->user_login;
          $parent_user_id = $parent_user_info->ID;
          $coupon_info = wcusage_get_coupon_info($coupon_code);
          $coupon_id = $coupon_info[2];
          $parent_commission = wcusage_mla_get_commission_from_tier($getinfo['thecommissionnum'], $key);
          echo "<br/>(".$key.") <a href='/wp-admin/user-edit.php?user_id=".$parent_user_id."' target='_blank' style='color: #07bbe3;'>" . $parent_user_name . "</a>: " . wcusage_format_price($parent_commission);
      }
      echo "</p>";
    }
  }

}

function wcusage_save_postdata($post_id) {
    if (array_key_exists('wcusage_field', $_POST)) {
        update_post_meta(
            $post_id,
            '_wcusage_meta_key',
            sanitize_text_field( $_POST['wcusage_field'] )
        );
    }
}
add_action('save_post', 'wcusage_save_postdata');
