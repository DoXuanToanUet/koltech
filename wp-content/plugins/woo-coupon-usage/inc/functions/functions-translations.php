<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * This file covers all translations/text before March 2021.
 * New translations use simple localisation and are not supported in translations settings.
 *
 */

/**
 * This function gets the available translations
 *
 */
 if( !function_exists( 'wcusage_translate' ) ) {
	function wcusage_translate() {

		$get_options = get_option( 'wcusage_options' );

		if (!empty( $get_options['wcusage_field_tr_discount_fixed_cart'] )) { $translate_discount_fixed_cart = $get_options['wcusage_field_tr_discount_fixed_cart']; }
		else {
			$translate_discount_fixed_cart = __( "Fixed amount on cart.", "woo-coupon-usage" );
		}

		if (!empty( $get_options['wcusage_field_tr_discount_percent'] )) { $translate_discount_percent = $get_options['wcusage_field_tr_discount_percent']; }
		else {
			$translate_discount_percent = __( "Percentage discount on cart.", "woo-coupon-usage" );
		}

		if (!empty( $get_options['wcusage_field_tr_discount_recurring_fee'] )) { $translate_discount_recurring_fee = $get_options['wcusage_field_tr_discount_recurring_fee']; }
		else {
			$translate_discount_recurring_fee = __( "Recurring fixed discount on subscription fee.", "woo-coupon-usage" );
		}

		if (!empty( $get_options['wcusage_field_tr_discount_recurring_percent'] )) { $translate_discount_recurring_percent = $get_options['wcusage_field_tr_discount_recurring_percent']; }
		else {
			$translate_discount_recurring_percent = __( "Recurring percentage discount on subscription fee.", "woo-coupon-usage" );
		}

		if (!empty( $get_options['wcusage_field_tr_discount_signup_fixed'] )) { $translate_discount_signup_fixed = $get_options['wcusage_field_tr_discount_signup_fixed']; }
		else {
			$translate_discount_signup_fixed = __( "Fixed discount on subscription signup.", "woo-coupon-usage" );
		}

		// Shortcode Page

		if (!empty( $get_options['wcusage_field_tr_discount'] )) { $translate_discount = $get_options['wcusage_field_tr_discount']; }
		else {
			$translate_discount = __( "Discount", "woo-coupon-usage" );
		}
		if (!empty( $get_options['wcusage_field_tr_type'] )) { $translate_type = $get_options['wcusage_field_tr_type']; }
		else {
			$translate_type = __( "Type", "woo-coupon-usage" );
		}
		if (!empty( $get_options['wcusage_field_tr_usage'] )) { $translate_usage = $get_options['wcusage_field_tr_usage']; }
		else {
			$translate_usage = __( "Total Usage", "woo-coupon-usage" );
		}
		if (!empty( $get_options['wcusage_field_tr_total_order'] )) { $translate_total_order = $get_options['wcusage_field_tr_total_order']; }
		else {
			$translate_total_order = __( "Total Sales", "woo-coupon-usage" );
		}
		if (!empty( $get_options['wcusage_field_tr_total_saved'] )) { $translate_total_saved = $get_options['wcusage_field_tr_total_saved']; }
		else {
			$translate_total_saved = __( "Total Discounts", "woo-coupon-usage" );
		}
		if (!empty( $get_options['wcusage_field_tr_total_referrer_commission'] )) { $translate_total_referrer_commission = $get_options['wcusage_field_tr_total_referrer_commission']; }
		else {
			$translate_total_referrer_commission = __( "Total Commission", "woo-coupon-usage" );
		}

		if (!empty( $get_options['wcusage_field_tr_coupon_info'] )) { $translate_coupon_info = $get_options['wcusage_field_tr_coupon_info']; }
		else {
			$translate_coupon_info = __( "Statistics", "woo-coupon-usage" );
		}

		if (!empty( $get_options['wcusage_field_tr_coupon_info2'] )) { $translate_coupon_info2 = $get_options['wcusage_field_tr_coupon_info2']; }
		else {
			$translate_coupon_info2 = __( "Coupon Info", "woo-coupon-usage" );
		}

		if (!empty( $get_options['wcusage_field_tr_coupon_alltime'] )) { $translate_coupon_alltime = $get_options['wcusage_field_tr_coupon_alltime']; }
		else {
			$translate_coupon_alltime = __( "All-time", "woo-coupon-usage" );
		}

		if (!empty( $get_options['wcusage_field_tr_coupon_last30'] )) { $translate_coupon_last30 = $get_options['wcusage_field_tr_coupon_last30']; }
		else {
			$translate_coupon_last30 = __( "Last 30 Days", "woo-coupon-usage" );
		}

		if (!empty( $get_options['wcusage_field_tr_coupon_last7'] )) { $translate_coupon_last7 = $get_options['wcusage_field_tr_coupon_last7']; }
		else {
			$translate_coupon_last7 = __( "Last 7 Days", "woo-coupon-usage" );
		}

		if (!empty( $get_options['wcusage_field_tr_coupon_last90'] )) { $translate_coupon_last90 = $get_options['wcusage_field_tr_coupon_last90']; }
		else {
			$translate_coupon_last90 = __( "Last 90 days", "woo-coupon-usage" );
		}

		if (!empty( $get_options['wcusage_field_tr_coupon_thismonth'] )) { $translate_coupon_thismonth = $get_options['wcusage_field_tr_coupon_thismonth']; }
		else {
			$translate_coupon_thismonth = __( "This Month", "woo-coupon-usage" );
		}

		if (!empty( $get_options['wcusage_field_tr_coupon_lastmonth'] )) { $translate_coupon_lastmonth = $get_options['wcusage_field_tr_coupon_lastmonth']; }
		else {
			$translate_coupon_lastmonth = __( "Last Month", "woo-coupon-usage" );
		}

		if (!empty( $get_options['wcusage_field_tr_coupon_commission_graph'] )) { $translate_coupon_commission_graph = $get_options['wcusage_field_tr_coupon_commission_graph']; }
		else {
			$translate_coupon_commission_graph = __( "Commission Graph", "woo-coupon-usage" );
		}

		if (!empty( $get_options['wcusage_field_tr_monthly_summary'] )) { $translate_monthly_summary = $get_options['wcusage_field_tr_monthly_summary']; }
		else {
			$translate_monthly_summary = __( "Monthly Summary", "woo-coupon-usage" );
		}
		if (!empty( $get_options['wcusage_field_tr_recent_orders'] )) { $translate_recent_orders = $get_options['wcusage_field_tr_recent_orders']; }
		else {
			$translate_recent_orders = __( "Recent Orders", "woo-coupon-usage" );
		}

		if (!empty( $get_options['wcusage_field_tr_orderid'] )) { $translate_orderid = $get_options['wcusage_field_tr_orderid']; }
		else {
			$translate_orderid = __( "ID", "woo-coupon-usage" );
		}
		if (!empty( $get_options['wcusage_field_tr_ordercountry'] )) { $translate_ordercountry = $get_options['wcusage_field_tr_ordercountry']; }
		else {
			$translate_ordercountry = __( "Country", "woo-coupon-usage" );
		}
		if (!empty( $get_options['wcusage_field_tr_ordercity'] )) { $translate_ordercity = $get_options['wcusage_field_tr_ordercity']; }
		else {
			$translate_ordercity = __( "City", "woo-coupon-usage" );
		}
		if (!empty( $get_options['wcusage_field_tr_ordername'] )) { $translate_ordername = $get_options['wcusage_field_tr_ordername']; }
		else {
			$translate_ordername = __( "Name", "woo-coupon-usage" );
		}

		if (!empty( $get_options['wcusage_field_tr_date'] )) { $translate_date = $get_options['wcusage_field_tr_date']; }
		else {
			$translate_date = __( "Date", "woo-coupon-usage" );
		}
		if (!empty( $get_options['wcusage_field_tr_order'] )) { $translate_order = $get_options['wcusage_field_tr_order']; }
		else {
			$translate_order = __( "Order", "woo-coupon-usage" );
		}
		if (!empty( $get_options['wcusage_field_tr_order_total'] )) { $translate_order_total = $get_options['wcusage_field_tr_order_total']; }
		else {
			$translate_order_total = __( "Total", "woo-coupon-usage" );
		}
		if (!empty( $get_options['wcusage_field_tr_commission'] )) { $translate_commission = $get_options['wcusage_field_tr_commission']; }
		else {
			$translate_commission = __( "Commission", "woo-coupon-usage" );
		}
		if (!empty( $get_options['wcusage_field_tr_products'] )) { $translate_products = $get_options['wcusage_field_tr_products']; }
		else {
			$translate_products = __( "Products", "woo-coupon-usage" );
		}

		if (!empty( $get_options['wcusage_field_tr_latest_orders_using'] )) { $translate_latest_orders_using = $get_options['wcusage_field_tr_latest_orders_using']; }
		else {
			$translate_latest_orders_using = __( "Latest orders using coupon", "woo-coupon-usage" );
		}

		if (!empty( $get_options['wcusage_field_tr_your_coupons'] )) { $translate_your_coupons = $get_options['wcusage_field_tr_your_coupons']; }
		else {
			$translate_your_coupons = __( "Your Coupons", "woo-coupon-usage" );
		}

		// Ref URLs


		if (!empty( $get_options['wcusage_field_tr_referral_url'] )) { $translate_referral_url = $get_options['wcusage_field_tr_referral_url']; }
		else {
			$translate_referral_url = __( "Referral URL", "woo-coupon-usage" );
		}

		if (!empty( $get_options['wcusage_field_tr_page_url'] )) { $translate_page_url = $get_options['wcusage_field_tr_page_url']; }
		else {
			$translate_page_url = __( "Page URL", "woo-coupon-usage" );
		}

		if (!empty( $get_options['wcusage_field_tr_ref_link'] )) { $translate_ref_link = $get_options['wcusage_field_tr_ref_link']; }
		else {
			$translate_ref_link = __( "Referral Link", "woo-coupon-usage" );
		}

		if (!empty( $get_options['wcusage_field_tr_total_clicks'] )) { $translate_total_clicks = $get_options['wcusage_field_tr_total_clicks']; }
		else {
			$translate_total_clicks = __( "Total Clicks", "woo-coupon-usage" );
		}

		if (!empty( $get_options['wcusage_field_tr_total_uses'] )) { $translate_total_uses = $get_options['wcusage_field_tr_total_uses']; }
		else {
			$translate_total_uses = __( "Total Uses", "woo-coupon-usage" );
		}

		if (!empty( $get_options['wcusage_field_tr_conversion_rate'] )) { $translate_conversion_rate = $get_options['wcusage_field_tr_conversion_rate']; }
		else {
			$translate_conversion_rate = __( "Conversion Rate", "woo-coupon-usage" );
		}

		if (!empty( $get_options['wcusage_field_tr_copy'] )) { $translate_copy = $get_options['wcusage_field_tr_copy']; }
		else {
			$translate_copy = __( "Copy", "woo-coupon-usage" );
		}

		if (!empty( $get_options['wcusage_field_tr_coupon_not_assigned'] )) { $translate_coupon_not_assigned = $get_options['wcusage_field_tr_coupon_not_assigned']; }
		else {
			$translate_coupon_not_assigned = __( "Sorry, this coupon is not assigned to you.", "woo-coupon-usage" );
		}

		if (!empty( $get_options['wcusage_field_tr_coupon_no_orders'] )) { $translate_coupon_no_orders = $get_options['wcusage_field_tr_coupon_no_orders']; }
		else {
			$translate_coupon_no_orders = __( "No orders found.", "woo-coupon-usage" );
		}

		if (!empty( $get_options['wcusage_field_tr_start'] )) { $translate_start = $get_options['wcusage_field_tr_start']; }
		else {
			$translate_start = __( "Start", "woo-coupon-usage" );
		}

		if (!empty( $get_options['wcusage_field_tr_end'] )) { $translate_end = $get_options['wcusage_field_tr_end']; }
		else {
			$translate_end = __( "End", "woo-coupon-usage" );
		}

		if (!empty( $get_options['wcusage_field_tr_filter'] )) { $translate_filter = $get_options['wcusage_field_tr_filter']; }
		else {
			$translate_filter = __( "Filter", "woo-coupon-usage" );
		}

		// Payouts

		if (!empty( $get_options['wcusage_field_tr_payouts'] )) { $translate_payouts = $get_options['wcusage_field_tr_payouts']; }
		else {
			$translate_payouts = __( "Payouts", "woo-coupon-usage" );
		}
		if (!empty( $get_options['wcusage_field_tr_request_payout'] )) { $translate_request_payout = $get_options['wcusage_field_tr_request_payout']; }
		else {
			$translate_request_payout = __( "Request Payout", "woo-coupon-usage" );
		}
		if (!empty( $get_options['wcusage_field_tr_payouts_already_pending'] )) { $translate_payouts_already_pending = $get_options['wcusage_field_tr_payouts_already_pending']; }
		else {
			$translate_payouts_already_pending = __( "You already have a pending commission payment. Please wait until this has been paid before requesting another payout.", "woo-coupon-usage" );
		}
		if (!empty( $get_options['wcusage_field_tr_payouts_threshold_req'] )) { $translate_payouts_threshold_req = $get_options['wcusage_field_tr_payouts_threshold_req']; }
		else {
			$translate_payouts_threshold_req = __( "Payment Threshold Required", "woo-coupon-usage" );
		}
		if (!empty( $get_options['wcusage_field_tr_payouts_paypal'] )) { $translate_payouts_paypal = $get_options['wcusage_field_tr_payouts_paypal']; }
		else {
			$translate_payouts_paypal = __( "Payment Details", "woo-coupon-usage" );
		}
		if (!empty( $get_options['wcusage_field_tr_payouts_paypal_only'] )) { $translate_payouts_paypal_only = $get_options['wcusage_field_tr_payouts_paypal_only']; }
		else {
			$translate_payouts_paypal_only = __( "Manual", "woo-coupon-usage" );
		}
		if (!empty( $get_options['wcusage_field_tr_payouts_unpaid_commission'] )) { $translate_payouts_unpaid_commission = $get_options['wcusage_field_tr_payouts_unpaid_commission']; }
		else {
			$translate_payouts_unpaid_commission = __( "Unpaid Commission", "woo-coupon-usage" );
		}
		if (!empty( $get_options['wcusage_field_tr_payouts_pending_payments'] )) { $translate_payouts_pending_payments = $get_options['wcusage_field_tr_payouts_pending_payments']; }
		else {
			$translate_payouts_pending_payments = __( "Pending Payments", "woo-coupon-usage" );
		}
		if (!empty( $get_options['wcusage_field_tr_payouts_completed_payments'] )) { $translate_payouts_completed_payments = $get_options['wcusage_field_tr_payouts_completed_payments']; }
		else {
			$translate_payouts_completed_payments = __( "Completed Payments", "woo-coupon-usage" );
		}
		if (!empty( $get_options['wcusage_field_tr_payouts_no_pending'] )) { $translate_payouts_no_pending = $get_options['wcusage_field_tr_payouts_no_pending']; }
		else {
			$translate_payouts_no_pending = __( "You don't have any pending commission payments.", "woo-coupon-usage" );
		}
		if (!empty( $get_options['wcusage_field_tr_payouts_no_completed'] )) { $translate_payouts_no_completed = $get_options['wcusage_field_tr_payouts_no_completed']; }
		else {
			$translate_payouts_no_completed = __( "You don't have any completed commission payments yet.", "woo-coupon-usage" );
		}

		if (!empty( $get_options['wcusage_field_tr_payouts_row_id'] )) { $translate_payouts_row_id = $get_options['wcusage_field_tr_payouts_row_id']; }
		else {
			$translate_payouts_row_id = __( "ID", "woo-coupon-usage" );
		}
		if (!empty( $get_options['wcusage_field_tr_payouts_row_amount'] )) { $translate_payouts_row_amount = $get_options['wcusage_field_tr_payouts_row_amount']; }
		else {
			$translate_payouts_row_amount = __( "Amount", "woo-coupon-usage" );
		}
		if (!empty( $get_options['wcusage_field_tr_payouts_row_method'] )) { $translate_payouts_row_method = $get_options['wcusage_field_tr_payouts_row_method']; }
		else {
			$translate_payouts_row_method = __( "Method", "woo-coupon-usage" );
		}
		if (!empty( $get_options['wcusage_field_tr_payouts_row_status'] )) { $translate_payouts_row_status = $get_options['wcusage_field_tr_payouts_row_status']; }
		else {
			$translate_payouts_row_status = __( "Status", "woo-coupon-usage" );
		}
		if (!empty( $get_options['wcusage_field_tr_payouts_row_date_req'] )) { $translate_payouts_row_date_req = $get_options['wcusage_field_tr_payouts_row_date_req']; }
		else {
			$translate_payouts_row_date_req = __( "Date Requested", "woo-coupon-usage" );
		}
		if (!empty( $get_options['wcusage_field_tr_payouts_row_date_paid'] )) { $translate_payouts_row_date_paid = $get_options['wcusage_field_tr_payouts_row_date_paid']; }
		else {
			$translate_payouts_row_date_paid = __( "Date Paid", "woo-coupon-usage" );
		}

		// Settings
		if (!empty( $get_options['wcusage_field_tr_settings'] )) { $translate_settings = $get_options['wcusage_field_tr_settings']; }
		else {
			$translate_settings = __( "Settings", "woo-coupon-usage" );
		}

		if (!empty( $get_options['wcusage_field_tr_notification_settings'] )) { $translate_notification_settings = $get_options['wcusage_field_tr_notification_settings']; }
		else {
			$translate_notification_settings = __( "Email Notification Settings", "woo-coupon-usage" );
		}

		if (!empty( $get_options['wcusage_field_tr_enable_email'] )) { $translate_enable_email = $get_options['wcusage_field_tr_enable_email']; }
		else {
			$translate_enable_email = __( "Enable Email Notifications", "woo-coupon-usage" );
		}

		if (!empty( $get_options['wcusage_field_tr_additional_email'] )) { $translate_additional_email = $get_options['wcusage_field_tr_additional_email']; }
		else {
			$translate_additional_email = __( "Additional Email Addresses: (Separate with Comma)", "woo-coupon-usage" );
		}

		if (!empty( $get_options['wcusage_field_tr_payouts_settings'] )) { $translate_payouts_settings = $get_options['wcusage_field_tr_payouts_settings']; }
		else {
			$translate_payouts_settings = __( "Payouts Settings", "woo-coupon-usage" );
		}

		// Monthly Summary

		if (!empty( $get_options['wcusage_field_tr_export_to_excel'] )) { $translate_export_to_excel = $get_options['wcusage_field_tr_export_to_excel']; }
		else {
			$translate_export_to_excel = __( "Export to Excel", "woo-coupon-usage" );
		}
		if (!empty( $get_options['wcusage_field_tr_month'] )) { $translate_month = $get_options['wcusage_field_tr_month']; }
		else {
			$translate_month = __( "Month", "woo-coupon-usage" );
		}
		if (!empty( $get_options['wcusage_field_tr_total_orders'] )) { $translate_total_orders = $get_options['wcusage_field_tr_total_orders']; }
		else {
			$translate_total_orders = __( "Subtotal", "woo-coupon-usage" );
		}
		if (!empty( $get_options['wcusage_field_tr_total_orders_count'] )) { $translate_orders_count = $get_options['wcusage_field_tr_total_orders_count']; }
		else {
			$translate_orders_count = __( "Quantity", "woo-coupon-usage" );
		}
		if (!empty( $get_options['wcusage_field_tr_total_discounts'] )) { $translate_total_discounts = $get_options['wcusage_field_tr_total_discounts']; }
		else {
			$translate_total_discounts = __( "Discounts", "woo-coupon-usage" );
		}
		if (!empty( $get_options['wcusage_field_tr_total_with_discount'] )) { $translate_total_with_discount = $get_options['wcusage_field_tr_total_with_discount']; }
		else {
			$translate_total_with_discount = __( "Total", "woo-coupon-usage" );
		}
		if (!empty( $get_options['wcusage_field_tr_total_commission'] )) { $translate_total_commission = $get_options['wcusage_field_tr_total_commission']; }
		else {
			$translate_total_commission = __( "Commission", "woo-coupon-usage" );
		}
		if (!empty( $get_options['wcusage_field_tr_more'] )) { $translate_more = $get_options['wcusage_field_tr_more']; }
		else {
			$translate_more = __( "MORE", "woo-coupon-usage" );
		}
		if (!empty( $get_options['wcusage_field_tr_totals'] )) { $translate_totals = $get_options['wcusage_field_tr_totals']; }
		else {
			$translate_totals = __( "Totals", "woo-coupon-usage" );
		}
		if (!empty( $get_options['wcusage_field_tr_products_sold'] )) { $translate_products_sold = $get_options['wcusage_field_tr_products_sold']; }
		else {
			$translate_products_sold = __( "List of products sold this month:", "woo-coupon-usage" );
		}

		// Output

		return array(
		'wcusage_field_tr_discount_fixed_cart' => $translate_discount_fixed_cart,
		'wcusage_field_tr_discount_percent' => $translate_discount_percent,
		'wcusage_field_tr_discount_recurring_fee' => $translate_discount_recurring_fee,
		'wcusage_field_tr_discount_recurring_percent' => $translate_discount_recurring_percent,
		'wcusage_field_tr_discount_signup_fixed' => $translate_discount_signup_fixed,

		'wcusage_field_tr_discount' => $translate_discount,
		'wcusage_field_tr_type' => $translate_type,
		'wcusage_field_tr_usage' => $translate_usage,
		'wcusage_field_tr_total_order' => $translate_total_order,
		'wcusage_field_tr_total_saved' => $translate_total_saved,
		'wcusage_field_tr_total_referrer_commission' => $translate_total_referrer_commission,
		'wcusage_field_tr_coupon_info' => $translate_coupon_info,

		'wcusage_field_tr_coupon_info2' => $translate_coupon_info2,
		'wcusage_field_tr_coupon_alltime' => $translate_coupon_alltime,
		'wcusage_field_tr_coupon_last30' => $translate_coupon_last30,
		'wcusage_field_tr_coupon_last7' => $translate_coupon_last7,
		'wcusage_field_tr_coupon_last90' => $translate_coupon_last90,
		'wcusage_field_tr_coupon_thismonth' => $translate_coupon_thismonth,
		'wcusage_field_tr_coupon_lastmonth' => $translate_coupon_lastmonth,
		'wcusage_field_tr_coupon_commission_graph' => $translate_coupon_commission_graph,

		'wcusage_field_tr_monthly_summary' => $translate_monthly_summary,
		'wcusage_field_tr_recent_orders' => $translate_recent_orders,

		'wcusage_field_tr_orderid' => $translate_orderid,
		'wcusage_field_tr_ordercountry' => $translate_ordercountry,
		'wcusage_field_tr_ordercity' => $translate_ordercity,
		'wcusage_field_tr_ordername' => $translate_ordername,
		'wcusage_field_tr_date' => $translate_date,
		'wcusage_field_tr_order' => $translate_order,
		'wcusage_field_tr_order_total' => $translate_order_total,
		'wcusage_field_tr_commission' => $translate_commission,
		'wcusage_field_tr_products' => $translate_products,
		'wcusage_field_tr_latest_orders_using' => $translate_latest_orders_using,
		'wcusage_field_tr_your_coupons' => $translate_your_coupons,
		'wcusage_field_tr_coupon_not_assigned' => $translate_coupon_not_assigned,
		'wcusage_field_tr_coupon_no_orders' => $translate_coupon_no_orders,

		'wcusage_field_tr_start' => $translate_start,
		'wcusage_field_tr_end' => $translate_end,
		'wcusage_field_tr_filter' => $translate_filter,

		'wcusage_field_tr_payouts' => $translate_payouts,
		'wcusage_field_tr_request_payout' => $translate_request_payout,
		'wcusage_field_tr_payouts_already_pending' => $translate_payouts_already_pending,
		'wcusage_field_tr_payouts_threshold_req' => $translate_payouts_threshold_req,
		'wcusage_field_tr_payouts_paypal' => $translate_payouts_paypal,
		'wcusage_field_tr_payouts_paypal_only' => $translate_payouts_paypal_only,
		'wcusage_field_tr_payouts_unpaid_commission' => $translate_payouts_unpaid_commission,
		'wcusage_field_tr_payouts_pending_payments' => $translate_payouts_pending_payments,
		'wcusage_field_tr_payouts_completed_payments' => $translate_payouts_completed_payments,
		'wcusage_field_tr_payouts_no_pending' => $translate_payouts_no_pending,
		'wcusage_field_tr_payouts_no_completed' => $translate_payouts_no_completed,

		'wcusage_field_tr_payouts_row_id' => $translate_payouts_row_id,
		'wcusage_field_tr_payouts_row_amount' => $translate_payouts_row_amount,
		'wcusage_field_tr_payouts_row_method' => $translate_payouts_row_method,
		'wcusage_field_tr_payouts_row_status' => $translate_payouts_row_status,
		'wcusage_field_tr_payouts_row_date_req' => $translate_payouts_row_date_req,
		'wcusage_field_tr_payouts_row_date_paid' => $translate_payouts_row_date_paid,

		'wcusage_field_tr_referral_url' => $translate_referral_url,
		'wcusage_field_tr_page_url' => $translate_page_url,
		'wcusage_field_tr_ref_link' => $translate_ref_link,
		'wcusage_field_tr_total_clicks' => $translate_total_clicks,
		'wcusage_field_tr_total_uses' => $translate_total_uses,
		'wcusage_field_tr_conversion_rate' => $translate_conversion_rate,
		'wcusage_field_tr_copy' => $translate_copy,

		'wcusage_field_tr_export_to_excel' => $translate_export_to_excel,
		'wcusage_field_tr_month' => $translate_month,
		'wcusage_field_tr_total_orders' => $translate_total_orders,
		'wcusage_field_tr_total_orders_count' => $translate_orders_count,
		'wcusage_field_tr_total_discounts' => $translate_total_discounts,
		'wcusage_field_tr_total_with_discount' => $translate_total_with_discount,
		'wcusage_field_tr_total_commission' => $translate_total_commission,
		'wcusage_field_tr_more' => $translate_more,
		'wcusage_field_tr_totals' => $translate_totals,
		'wcusage_field_tr_products_sold' => $translate_products_sold,

		'wcusage_field_tr_settings' => $translate_settings,
		'wcusage_field_tr_notification_settings' => $translate_notification_settings,
		'wcusage_field_tr_enable_email' => $translate_enable_email,
		'wcusage_field_tr_additional_email' => $translate_additional_email,
		'wcusage_field_tr_payouts_settings' => $translate_payouts_settings,
		);

	}
}

/**
 * Load language settings
 *
 */
if( !function_exists( 'wcusage_settings_init_translations' ) ) {
	function wcusage_settings_init_translations()
	{
			$options = get_option( 'wcusage_options' );

	    if(isset($options['wcusage_field_show_custom_translations'])) {
	      $wcusage_field_show_custom_translations = $options['wcusage_field_show_custom_translations'];
	    } else {
	      $wcusage_field_show_custom_translations = "";
	    }
	    if($wcusage_field_show_custom_translations) {
	      // register wcusage_orders
	      add_settings_field(
	          'wcusage_field_orders_tr',
	          __( 'Translations', 'woo-coupon-usage' ),
	          'wcusage_field_cb_translate',
	          'wcusage',
	          'wcusage_section_developers',
	          [
	          'class'                                 => 'wcusage_row wcusage_row_translations',
	          'wcusage_tr_discount'                   => 'wcusage_field_tr_discount',
	          'wcusage_tr_type'                       => 'wcusage_field_tr_type',
	          'wcusage_tr_usage'                      => 'wcusage_field_tr_usage',
	          'wcusage_tr_total_order'                => 'wcusage_field_tr_total_order',
	          'wcusage_tr_total_saved'                => 'wcusage_field_tr_total_saved',
	          'wcusage_tr_total_referrer_commission'  => 'wcusage_field_tr_total_referrer_commission',
	          'wcusage_tr_coupon_info'                => 'wcusage_field_tr_coupon_info',
	          'wcusage_tr_coupon_info2'                => 'wcusage_field_tr_coupon_info2',
	          'wcusage_tr_coupon_alltime'             => 'wcusage_field_tr_coupon_alltime',
	          'wcusage_tr_coupon_last30'              => 'wcusage_field_tr_coupon_last30',
	          'wcusage_tr_coupon_last7'               => 'wcusage_field_tr_coupon_last7',
	          'wcusage_tr_coupon_last90'              => 'wcusage_field_tr_coupon_last90',
	          'wcusage_tr_coupon_lastmonth'           => 'wcusage_field_tr_coupon_lastmonth',
	          'wcusage_tr_coupon_thismonth'           => 'wcusage_field_tr_coupon_thismonth',
	          'wcusage_tr_coupon_commission_graph'    => 'wcusage_field_tr_coupon_commission_graph',
	          'wcusage_tr_monthly_summary'            => 'wcusage_field_tr_monthly_summary',
	          'wcusage_tr_recent_orders'              => 'wcusage_field_tr_recent_orders',
	          'wcusage_tr_latest_orders_using'        => 'wcusage_field_tr_latest_orders_using',
	          'wcusage_tr_date'                       => 'wcusage_field_tr_date',
	          'wcusage_tr_order'                      => 'wcusage_field_tr_order',
	          'wcusage_tr_order_total'                => 'wcusage_field_tr_order_total',
	          'wcusage_tr_commission'                 => 'wcusage_field_tr_commission',
	          'wcusage_tr_products'                   => 'wcusage_field_tr_products',
	          'wcusage_tr_export_to_excel'            => 'wcusage_field_tr_export_to_excel',
	          'wcusage_tr_month'                      => 'wcusage_field_tr_month',
	          'wcusage_tr_total_orders_count'         => 'wcusage_field_tr_total_orders_count',
	          'wcusage_tr_total_orders'               => 'wcusage_field_tr_total_orders',
	          'wcusage_tr_total_discounts'            => 'wcusage_field_tr_total_discounts',
	          'wcusage_tr_total_with_discount'        => 'wcusage_field_tr_total_with_discount',
	          'wcusage_tr_total_commission'           => 'wcusage_field_tr_total_commission',

						'wcusage_tr_more'                       => 'wcusage_field_tr_more',
						'wcusage_tr_totals'                     => 'wcusage_field_tr_totals',
						'wcusage_tr_products_sold'              => 'wcusage_field_tr_products_sold',
				    'wcusage_tr_referral_url'               => 'wcusage_field_tr_referral_url',
				    'wcusage_tr_page_url'                   => 'wcusage_field_tr_page_url',
				    'wcusage_tr_ref_link'                   => 'wcusage_field_tr_ref_link',
				    'wcusage_tr_total_clicks'               => 'wcusage_field_tr_total_clicks',
				    'wcusage_tr_total_uses'                 => 'wcusage_field_tr_total_uses',
				    'wcusage_tr_conversion_rate'            => 'wcusage_field_tr_conversion_rate',
				    'wcusage_tr_copy'                       => 'wcusage_field_tr_copy',
				    'wcusage_tr_coupon_not_assigned'        => 'wcusage_field_tr_coupon_not_assigned',
						'wcusage_tr_coupon_no_orders'           => 'wcusage_field_tr_coupon_no_orders',
						'wcusage_tr_start'          			      => 'wcusage_field_tr_start',
						'wcusage_tr_end'          				      => 'wcusage_field_tr_end',
						'wcusage_tr_filter'          			      => 'wcusage_field_tr_filter',
				    'wcusage_tr_your_coupons'               => 'wcusage_field_tr_your_coupons',

						'wcusage_tr_payouts'                    => 'wcusage_field_tr_payouts',
						'wcusage_tr_request_payout'             => 'wcusage_field_tr_request_payout',
						'wcusage_tr_payouts_already_pending'    => 'wcusage_field_tr_payouts_already_pending',
						'wcusage_tr_payouts_threshold_req'      => 'wcusage_field_tr_payouts_threshold_req',
						'wcusage_tr_payouts_unpaid_commission'  => 'wcusage_field_tr_payouts_unpaid_commission',
						'wcusage_tr_payouts_pending_payments'   => 'wcusage_field_tr_payouts_pending_payments',
						'wcusage_tr_payouts_completed_payments' => 'wcusage_field_tr_payouts_completed_payments',
						'wcusage_tr_payouts_no_pending'         => 'wcusage_field_tr_payouts_no_pending',
						'wcusage_tr_payouts_no_completed'       => 'wcusage_field_tr_payouts_no_completed',
						'wcusage_tr_payouts_row_id'             => 'wcusage_field_tr_payouts_row_id',
						'wcusage_tr_payouts_row_amount'         => 'wcusage_field_tr_payouts_row_amount',
						'wcusage_tr_payouts_row_method'         => 'wcusage_field_tr_payouts_row_method',
						'wcusage_tr_payouts_row_status'         => 'wcusage_field_tr_payouts_row_status',
						'wcusage_tr_payouts_row_date_req'       => 'wcusage_field_tr_payouts_row_date_req',
						'wcusage_tr_payouts_row_date_paid'      => 'wcusage_field_tr_payouts_row_date_paid',

						'wcusage_tr_settings'                   => 'wcusage_field_tr_settings',
						'wcusage_tr_notification_settings'      => 'wcusage_field_tr_notification_settings',
						'wcusage_tr_enable_email'               => 'wcusage_field_tr_enable_email',
						'wcusage_tr_additional_email'           => 'wcusage_field_tr_additional_email',
						'wcusage_tr_payouts_settings'           => 'wcusage_field_tr_payouts_settings',

				    'wcusage_tr_discount_fixed_cart'        => 'wcusage_field_tr_discount_fixed_cart',
				    'wcusage_tr_discount_percent'           => 'wcusage_field_tr_discount_percent',
				    'wcusage_tr_discount_recurring_fee'     => 'wcusage_field_tr_discount_recurring_fee',
				    'wcusage_tr_discount_recurring_percent' => 'wcusage_field_tr_discount_recurring_percent',
				    'wcusage_tr_discount_signup_fixed'      => 'wcusage_field_tr_discount_signup_fixed',
	      ]
	      );
	    }

	}
}
add_action( 'admin_init', 'wcusage_settings_init_translations' );

/**
 * WPML Support Function
 *
 * @param string $language
 *
 */
if( !function_exists( 'wcusage_load_custom_language_wpml' ) ) {
	function wcusage_load_custom_language_wpml($language) {
		if (class_exists('SitePress')) {
		  global $sitepress;
		  $sitepress->switch_lang($language, true);
		  load_plugin_textdomain( 'woo-coupon-usage', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
		}
	}
}
