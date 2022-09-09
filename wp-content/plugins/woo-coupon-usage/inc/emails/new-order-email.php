<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Returns the "from" info for email notifications.
 *
 * @return string
 *
 */
if( !function_exists( 'wcusage_get_from_email' ) ) {
  function wcusage_get_from_email() {

    $from = wcusage_get_setting_value('wcusage_field_from_email', '');
    $fromname = wcusage_get_setting_value('wcusage_field_from_name', '');
    $frominfo = "";
    if($from && !$fromname) {
      $fromname = get_bloginfo( 'name' );
      $frominfo = "From: ".$fromname." <" . $from . ">";
    }
    if($from && $fromname) {
      $frominfo = "From: ".$fromname." <" . $from . ">";
    }

    return $frominfo;

  }
}

/**
 * Creates and sends email notification to affiliate for new order
 *
 * @param int $order_id
 *
 */
if( !function_exists( 'wcusage_new_order_affiliate_email' ) ) {
  function wcusage_new_order_affiliate_email( $order_id ) {

    if (!$order_id) {
        return;
    }

  	$options = get_option( 'wcusage_options' );

    // Email Enabled
    $wcusage_email_enable = wcusage_get_setting_value('wcusage_field_email_enable', '1');

    if($wcusage_email_enable) {

    	$order = wc_get_order( $order_id );

    	// Get List Products
    	$items = $order->get_items();
    	foreach ( $items as $item_id => $item ) {
    		$product = $item->get_product();
    		$product_name = $item->get_name();
    		$product_quantity = $item->get_quantity();
    		$list_products = "- " . $product_quantity . " x " . $product_name . "<br/>";
    	}

    	// Output
    	foreach( $order->get_coupon_codes() as $coupon_code ) {

    		$coupon = new WC_Coupon($coupon_code);
        $id = $coupon->get_id();

        $valueuser = get_post_meta( $id, "wcu_select_coupon_user", true );

    		$wcu_enable_notifications = get_post_meta( $id, 'wcu_enable_notifications', true );
    		if($wcu_enable_notifications == "") { $wcu_enable_notifications = 1; }

        if ( wcu_fs()->can_use_premium_code() ) {
    		  $wcu_notifications_extra = sanitize_text_field( get_post_meta( $id, 'wcu_notifications_extra', true ) );
        } else {
          $wcu_notifications_extra = "";
        }

    		if( $wcu_enable_notifications && $valueuser ) {

          $calculateorder = wcusage_calculate_order_data( $order_id, $coupon_code, 0, 1 );
      		$totalcommission = $calculateorder['totalcommission'];
      		$totalcommission = number_format((float)$totalcommission, 2, '.', '');

      		$discount_type = $coupon->get_discount_type(); // Get coupon discount type
      		$coupon_amount = $coupon->get_amount(); // Get coupon amount

    			$order_subtotal = $order->get_subtotal();
    			$order_discount = $order->get_discount_total();
    			$order_total = $order_subtotal - $order_discount;

      		$valuecommission = wcusage_format_price( number_format($totalcommission, 2, '.', '') );

          $user_info = get_userdata($valueuser);

      		$user_name = $user_info->display_name;
      		$user_email = $user_info->user_email;

          $from = wcusage_get_from_email();

        	if($wcusage_email_enable) {

            $wcusage_email_subject = wcusage_get_setting_value('wcusage_field_email_subject', 'New Coupon Usage: {coupon}');

          	$wcusage_email_message = html_entity_decode( wcusage_get_setting_value('wcusage_field_email_message', '') );

        		if(!$wcusage_email_message) {

        			$wcusage_email_message = "Hi {name},
        			<br/><br/>
        			Congratulations, your coupon code '{coupon}' has just been used in a new order.
        			<br/><br/>
        			You have just earned {commission} in unpaid commission!
        			<br/><br/>
        			Here's a list of items the customer purchased:
        			<br/>
        			{listproducts}
        			<br/><br/>
        			Thanks!";

        		}

        		$wcusage_email_subject = str_replace("{name}", $user_name, $wcusage_email_subject);
        		$wcusage_email_subject = str_replace("{coupon}", $coupon_code, $wcusage_email_subject);
        		$wcusage_email_subject = str_replace("{commission}", $valuecommission, $wcusage_email_subject);
        		$wcusage_email_subject = str_replace("{id}", $order_id, $wcusage_email_subject);

        		$wcusage_email_message = str_replace("{name}", $user_name, $wcusage_email_message);
        		$wcusage_email_message = str_replace("{coupon}", $coupon_code, $wcusage_email_message);
        		$wcusage_email_message = str_replace("{commission}", $valuecommission, $wcusage_email_message);
        		$wcusage_email_message = str_replace("{id}", $order_id, $wcusage_email_message);
        		$wcusage_email_message = str_replace("{listproducts}", $list_products, $wcusage_email_message);
        		$wcusage_email_message = str_replace("{email}", $user_email, $wcusage_email_message);

        		$to = $user_email . "," . $wcu_notifications_extra;
        		$subject = $wcusage_email_subject;
        		$body = $wcusage_email_message;
        		$headers = array( 'Content-Type: text/html; charset=UTF-8;', $from );

      		  // Get woocommerce mailer from instance
      		  $mailer = WC()->mailer();

      		  // Wrap message using woocommerce html email template
      		  $wrapped_message = $mailer->wrap_message($subject, $body);

      		  // Create new WC_Email instance
      		  $wc_email = new WC_Email;

      		  // Style the wrapped message with woocommerce inline styles
      		  $html_message = $wc_email->style_inline($wrapped_message);

      		  wp_mail( $to, $subject, $html_message, $headers );

        	}

        }

    	}

    }

  }
}
add_action( 'woocommerce_order_status_completed', 'wcusage_new_order_affiliate_email', 10, 1 );
