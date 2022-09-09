<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// This file is discontinued and not used by most new sites.

function wcusage_field_cb_translate( $args )
{
    $options = get_option( 'wcusage_options' );
    $option_affiliate = $options['wcusage_field_affiliate'];
    $affiliate_commission_amount = $option_affiliate;
    ?>

<div id="translation-settings" class="settings-area">

  <h2><?php echo __( 'Translations', 'woo-coupon-usage' ); ?></h2>

	<p style="color: red; font-weight: bold;">
		<a href="https://codex.wordpress.org/I18n_for_WordPress_Developers" target="_blank" style="color: red;">Internationalization (I18n)</a> is now available with this plugin.
	</p>
	<p>
		<?php echo __( 'You now now easily translate the plugin to other languages, using a plugin such as', 'woo-coupon-usage' ); ?> <a href="<?php echo get_site_url(); ?>/wp-admin/plugin-install.php?s=Loco%20Translate&tab=search&type=term" target="_blank">Loco Translate</a> / "<a href="https://wpml.org" target="_blank">WPML</a>".
	</p>
	<p>
		<?php echo __( 'However, if you dont want to use internationalization, you can use enter custom translations for any specific phrases (frontend only) used in the plugin below, and this will overwrite the internationalized translations.', 'woo-coupon-usage' ); ?>
	</p>
	<p style="font-size: 12px;">
		<?php echo __( 'If you would like to translate this plugin to your language for us, that would be much appreciated. Please', 'woo-coupon-usage' ); ?> <a href="<?php echo get_site_url(); ?>/wp-admin/admin.php?page=wcusage-contact" target="_blank"><?php echo __( 'contact us', 'woo-coupon-usage' ); ?></a> <?php echo __( 'or feel free to send the generated po/mo files.', 'woo-coupon-usage' ); ?>
	</p>

	<h2><?php echo __( 'Custom Translations', 'woo-coupon-usage' ); ?></h2>

	<p>
		<!-- Show/Hide -->
		<?php
	$wcusage_tr_discount = $options['wcusage_field_tr_discount'];

    $wcusage_show_custom_translations = $options['wcusage_field_show_custom_translations'];
    $checked2 = ( $wcusage_show_custom_translations == '1' || $wcusage_tr_discount != '' ? ' checked="checked"' : '' );
    ?>
	<label class="switch">
		<input type="hidden" value="0" id="wcusage_field_show_custom_translations" data-custom="custom" name="wcusage_options[wcusage_field_show_custom_translations]" >
		<input type="checkbox" value="1" id="wcusage_field_show_custom_translations" data-custom="custom" name="wcusage_options[wcusage_field_show_custom_translations]" <?php
    echo  $checked2 ;
    ?>>
	<span class="slider round"></span>
	</label>
		<strong><label for="scales"><?php echo __( 'Show/enable custom translation settings.', 'woo-coupon-usage' ); ?></label></strong><br/>
		<?php echo __( '(Click save, then the settings will appear below.)', 'woo-coupon-usage' ); ?>
	</p>

	<br/>

	<p><?php echo __( 'Any phrases you leave empty will use the normal internationalized translations.', 'woo-coupon-usage' ); ?><p>

	<?php if($checked2) { ?>

	<br/>

	<p style="color: red; font-weight: bold;"><?php echo __( 'Note: It is recommended to now use', 'woo-coupon-usage' ); ?> "<a href="<?php echo get_site_url(); ?>/wp-admin/plugin-install.php?s=Loco%20Translate&tab=search&type=term" target="_blank">Loco Translate</a>" / "<a href="https://wpml.org" target="_blank">WPML</a>" <?php echo __( 'to fully translate this plugin. However, if you enable these custom translations settings, they will cover most words/phrases (but not all) on the frontend affiliate dashboard.', 'woo-coupon-usage' ); ?><p>

	<br/>

	<strong><u><?php echo __( 'General', 'woo-coupon-usage' ); ?></u></strong>

	<?php echo wcusage_translation_field('wcusage_tr_discount', '"'.__( 'Discount', 'woo-coupon-usage' ).'"', $args); ?>

	<?php echo wcusage_translation_field('wcusage_tr_type', '"'.__( 'Type', 'woo-coupon-usage' ).'"', $args); ?>

	<?php echo wcusage_translation_field('wcusage_tr_usage', '"'.__( 'Total Usage', 'woo-coupon-usage' ).'"', $args); ?>

	<?php echo wcusage_translation_field('wcusage_tr_total_order', '"'.__( 'Total Sales', 'woo-coupon-usage' ).'"', $args); ?>

	<?php echo wcusage_translation_field('wcusage_tr_total_saved', '"'.__( 'Total Discounts', 'woo-coupon-usage' ).'"', $args); ?>

	<?php echo wcusage_translation_field('wcusage_tr_total_referrer_commission', '"'.__( 'Total Commission', 'woo-coupon-usage' ).'"', $args); ?>

	<?php echo wcusage_translation_field('wcusage_tr_coupon_info', '"'.__( 'Statistics', 'woo-coupon-usage' ).'"', $args); ?>

		<?php echo wcusage_translation_field('wcusage_tr_coupon_info2', '"'.__( 'Coupon Info', 'woo-coupon-usage' ).'"', $args); ?>

		<?php echo wcusage_translation_field('wcusage_tr_coupon_alltime', '"'.__( 'All-time', 'woo-coupon-usage' ).'"', $args); ?>

		<?php echo wcusage_translation_field('wcusage_tr_coupon_last30', '"'.__( 'Last 30 Days', 'woo-coupon-usage' ).'"', $args); ?>

		<?php echo wcusage_translation_field('wcusage_tr_coupon_last7', '"'.__( 'Last 7 Days', 'woo-coupon-usage' ).'"', $args); ?>

		<?php echo wcusage_translation_field('wcusage_tr_coupon_last90', '"'.__( 'Last 90 days', 'woo-coupon-usage' ).'"', $args); ?>

		<?php echo wcusage_translation_field('wcusage_tr_coupon_lastmonth', '"'.__( 'Last Month', 'woo-coupon-usage' ).'"', $args); ?>

		<?php echo wcusage_translation_field('wcusage_tr_coupon_thismonth', '"'.__( 'This Month', 'woo-coupon-usage' ).'"', $args); ?>

		<?php echo wcusage_translation_field('wcusage_tr_coupon_commission_graph', '"'.__( 'Commission Graph', 'woo-coupon-usage' ).'"', $args); ?>

	<?php echo wcusage_translation_field('wcusage_tr_monthly_summary', '"'.__( 'Monthly Summary', 'woo-coupon-usage' ).'"', $args); ?>

	<?php echo wcusage_translation_field('wcusage_tr_recent_orders', '"'.__( 'Recent Orders', 'woo-coupon-usage' ).'"', $args); ?>

	<?php echo wcusage_translation_field('wcusage_tr_latest_orders_using', ''.__( 'Latest orders using coupon', 'woo-coupon-usage' ).'', $args); ?>

	<?php echo wcusage_translation_field('wcusage_tr_orderid', '"'.__( 'ID', 'woo-coupon-usage' ).'"', $args); ?>

  <?php echo wcusage_translation_field('wcusage_tr_ordercountry', '"'.__( 'Country', 'woo-coupon-usage' ).'"', $args); ?>

  <?php echo wcusage_translation_field('wcusage_tr_ordercity', '"'.__( 'City', 'woo-coupon-usage' ).'"', $args); ?>

  <?php echo wcusage_translation_field('wcusage_tr_ordername', '"'.__( 'Name', 'woo-coupon-usage' ).'"', $args); ?>

	<?php echo wcusage_translation_field('wcusage_tr_date', '"'.__( 'Date', 'woo-coupon-usage' ).'"', $args); ?>

	<?php echo wcusage_translation_field('wcusage_tr_order', '"'.__( 'Order', 'woo-coupon-usage' ).'"', $args); ?>

	<?php echo wcusage_translation_field('wcusage_tr_order_total', '"'.__( 'Order Total', 'woo-coupon-usage' ).'"', $args); ?>

	<?php echo wcusage_translation_field('wcusage_tr_commission', '"'.__( 'Commission', 'woo-coupon-usage' ).'"', $args); ?>

	<?php echo wcusage_translation_field('wcusage_tr_products', '"'.__( 'Products', 'woo-coupon-usage' ).'"', $args); ?>

	<?php echo wcusage_translation_field('wcusage_tr_export_to_excel', '"'.__( 'Export to Excel', 'woo-coupon-usage' ).'"', $args); ?>

	<?php echo wcusage_translation_field('wcusage_tr_month', '"'.__( 'Month', 'woo-coupon-usage' ).'" ('.__( 'Monthly Summary Table', 'woo-coupon-usage' ).')', $args); ?>

	<?php echo wcusage_translation_field('wcusage_tr_total_orders_count', '"'.__( 'Quantity', 'woo-coupon-usage' ).'" ('.__( 'Monthly Summary Table', 'woo-coupon-usage' ).')', $args); ?>

	<?php echo wcusage_translation_field('wcusage_tr_total_orders', '"'.__( 'Subtotal', 'woo-coupon-usage' ).'" ('.__( 'Monthly Summary Table', 'woo-coupon-usage' ).')', $args); ?>

	<?php echo wcusage_translation_field('wcusage_tr_total_discounts', '"'.__( 'Discounts', 'woo-coupon-usage' ).'" ('.__( 'Monthly Summary Table', 'woo-coupon-usage' ).')', $args); ?>

	<?php echo wcusage_translation_field('wcusage_tr_total_with_discount', '"'.__( 'Total', 'woo-coupon-usage' ).'" ('.__( 'Monthly Summary Table', 'woo-coupon-usage' ).')', $args); ?>

	<?php echo wcusage_translation_field('wcusage_tr_total_commission', '"'.__( 'Commission', 'woo-coupon-usage' ).'" ('.__( 'Monthly Summary', 'woo-coupon-usage' ).')', $args); ?>

	<?php echo wcusage_translation_field('wcusage_tr_more', '"'.__( 'MORE', 'woo-coupon-usage' ).'" (Monthly Summary Table)', $args); ?>

	<?php echo wcusage_translation_field('wcusage_tr_totals', '"'.__( 'Totals', 'woo-coupon-usage' ).'"', $args); ?>

	<?php echo wcusage_translation_field('wcusage_tr_products_sold', '"'.__( 'List of products sold this month', 'woo-coupon-usage' ).':" (Monthly Summary Table)', $args); ?>

	<?php echo wcusage_translation_field('wcusage_tr_your_coupons', '"'.__( 'Your Coupons', 'woo-coupon-usage' ).'"', $args); ?>

	<?php echo wcusage_translation_field('wcusage_tr_coupon_not_assigned', '"'.__( 'Sorry, this coupon is not assigned to you.', 'woo-coupon-usage' ).'"', $args); ?>

	<?php echo wcusage_translation_field('wcusage_tr_coupon_no_orders', '"'.__( 'No orders found.', 'woo-coupon-usage' ).'"', $args); ?>

	<?php echo wcusage_translation_field('wcusage_tr_start', '"'.__( 'Start', 'woo-coupon-usage' ).'"', $args); ?>

	<?php echo wcusage_translation_field('wcusage_tr_end', '"'.__( 'End', 'woo-coupon-usage' ).'"', $args); ?>

	<?php echo wcusage_translation_field('wcusage_tr_filter', '"'.__( 'Filter', 'woo-coupon-usage' ).'"', $args); ?>

	<br/><hr/>

	<strong><u><?php echo __( 'Referral URLs', 'woo-coupon-usage' ); ?></u></strong>

	<?php echo wcusage_translation_field('wcusage_tr_referral_url', '"'.__( 'Referral URL', 'woo-coupon-usage' ).'"', $args); ?>

	<?php echo wcusage_translation_field('wcusage_tr_page_url', '"'.__( 'Page URL', 'woo-coupon-usage' ).'"', $args); ?>

	<?php echo wcusage_translation_field('wcusage_tr_ref_link', '"'.__( 'Referral Link', 'woo-coupon-usage' ).'"', $args); ?>

	<?php echo wcusage_translation_field('wcusage_tr_total_clicks', '"'.__( 'Total Clicks', 'woo-coupon-usage' ).'"', $args); ?>

	<?php echo wcusage_translation_field('wcusage_tr_total_uses', '"'.__( 'Total Uses', 'woo-coupon-usage' ).'"', $args); ?>

	<?php echo wcusage_translation_field('wcusage_tr_conversion_rate', '"'.__( 'Conversion Rate', 'woo-coupon-usage' ).'"', $args); ?>

	<?php echo wcusage_translation_field('wcusage_tr_copy', '"'.__( 'Copy', 'woo-coupon-usage' ).'"', $args); ?>

	<br/><hr/>
	<strong><u><?php echo __( 'Payouts', 'woo-coupon-usage' ); ?></u></strong>

	<?php echo wcusage_translation_field('wcusage_tr_payouts', '"'.__( 'Payouts', 'woo-coupon-usage' ).'"', $args); ?>

	<?php echo wcusage_translation_field('wcusage_tr_request_payout', '"'.__( 'Request Payout', 'woo-coupon-usage' ).'"', $args); ?>

	<?php echo wcusage_translation_field('wcusage_tr_payouts_already_pending', '"'.__( 'You already have a pending commission payment. Please wait until this has been paid before requesting another payout.', 'woo-coupon-usage' ).'"', $args); ?>

	<?php echo wcusage_translation_field('wcusage_tr_payouts_threshold_req', '"'.__( 'Payment Threshold Required', 'woo-coupon-usage' ).'"', $args); ?>

	<?php echo wcusage_translation_field('wcusage_tr_payouts_paypal_only', '"'.__( 'PayPal', 'woo-coupon-usage' ).'"', $args); ?>

	<?php echo wcusage_translation_field('wcusage_tr_payouts_unpaid_commission', '"'.__( 'Unpaid Commission', 'woo-coupon-usage' ).'"', $args); ?>

	<?php echo wcusage_translation_field('wcusage_tr_payouts_pending_payments', '"'.__( 'Pending Payments', 'woo-coupon-usage' ).'"', $args); ?>

	<?php echo wcusage_translation_field('wcusage_tr_payouts_completed_payments', '"'.__( 'Completed Payments', 'woo-coupon-usage' ).'"', $args); ?>

	<?php echo wcusage_translation_field('wcusage_tr_payouts_no_pending', '"'.__( 'You dont have any pending commission payments.', 'woo-coupon-usage' ).'"', $args); ?>

	<?php echo wcusage_translation_field('wcusage_tr_payouts_no_completed', '"'.__( 'You dont have any completed commission payments yet.', 'woo-coupon-usage' ).'"', $args); ?>

	<?php echo wcusage_translation_field('wcusage_tr_payouts_row_id', '"'.__( 'ID', 'woo-coupon-usage' ).'"', $args); ?>

	<?php echo wcusage_translation_field('wcusage_tr_payouts_row_amount', '"'.__( 'Amount', 'woo-coupon-usage' ).'"', $args); ?>

	<?php echo wcusage_translation_field('wcusage_tr_payouts_row_method', '"'.__( 'Method', 'woo-coupon-usage' ).'"', $args); ?>

	<?php echo wcusage_translation_field('wcusage_tr_payouts_row_status', '"'.__( 'Status', 'woo-coupon-usage' ).'"', $args); ?>

	<?php echo wcusage_translation_field('wcusage_tr_payouts_row_date_req', '"'.__( 'Date Requested', 'woo-coupon-usage' ).'"', $args); ?>

	<?php echo wcusage_translation_field('wcusage_tr_payouts_row_date_paid', '"'.__( 'Date Paid', 'woo-coupon-usage' ).'"', $args); ?>

	<br/><hr/>
	<strong><u><?php echo __( 'Discount Types', 'woo-coupon-usage' ); ?></u></strong>

	<?php echo wcusage_translation_field('wcusage_tr_discount_fixed_cart', '"'.__( 'Fixed amount on cart.', 'woo-coupon-usage' ).'"', $args); ?>

	<?php echo wcusage_translation_field('wcusage_tr_discount_percent', '"'.__( 'Percentage discount on cart.', 'woo-coupon-usage' ).'"', $args); ?>

	<?php echo wcusage_translation_field('wcusage_tr_discount_recurring_fee', '"'.__( 'Recurring fixed discount on subscription fee.', 'woo-coupon-usage' ).'"', $args); ?>

	<?php echo wcusage_translation_field('wcusage_tr_discount_recurring_percent', '"'.__( 'Recurring percentage discount on subscription fee.', 'woo-coupon-usage' ).'"', $args); ?>

	<?php echo wcusage_translation_field('wcusage_tr_discount_signup_fixed', '"'.__( 'Fixed discount on subscription signup.', 'woo-coupon-usage' ).'"', $args); ?>

	<br/><hr/>
	<strong><u><?php echo __( 'Settings Tab', 'woo-coupon-usage' ); ?></u></strong>

	<?php echo wcusage_translation_field('wcusage_tr_settings', '"'.__( 'Settings', 'woo-coupon-usage' ).'"', $args); ?>

	<?php echo wcusage_translation_field('wcusage_tr_notification_settings', '"'.__( 'Email Notification Settings', 'woo-coupon-usage' ).'"', $args); ?>

	<?php echo wcusage_translation_field('wcusage_tr_enable_email', '"'.__( 'Enable Email Notifications', 'woo-coupon-usage' ).'"', $args); ?>

	<?php echo wcusage_translation_field('wcusage_tr_additional_email', '"'.__( 'Additional Email Addresses: (Separate with Comma)', 'woo-coupon-usage' ).'"', $args); ?>

	<?php echo wcusage_translation_field('wcusage_tr_payouts_settings', '"'.__( 'Payouts Settings', 'woo-coupon-usage' ).'"', $args); ?>

	<?php } ?>

</div>

 <?php
}




function wcusage_translation_field($fieldatt, $text, $args) {
	$options = get_option( 'wcusage_options' );
  if(isset($options[$args[$fieldatt]])) {
	  $value = $options[$args[$fieldatt]];
  } else {
    $value = "";
  }
	?>
		<p>
		<strong><?php echo $text; ?></strong><br/>
		<input type="text"
		value="<?php echo $value; ?>"
		id="<?php echo esc_attr( $args[$fieldatt] ); ?>"
		name="wcusage_options[<?php echo esc_attr( $args[$fieldatt] ); ?>]"><br/>
		</p>
	<?php
}
