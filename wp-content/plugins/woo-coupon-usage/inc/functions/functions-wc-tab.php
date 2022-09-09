<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Adds new menu item to My Account page.
 *
 */
if( !function_exists( 'wcusage_account_tab_affiliate_link' ) ) {
  function wcusage_account_tab_affiliate_link( $menu_links ){

  	$new = array( "coupon-affiliate" => __( "Affiliate", "woo-coupon-usage" ) );

  	$menu_links = array_slice( $menu_links, 0, 6, true )
  	+ $new
  	+ array_slice( $menu_links, 1, NULL, true );

  	return $menu_links;

  }
}
add_filter ( 'woocommerce_account_menu_items', 'wcusage_account_tab_affiliate_link' );

/**
 * Adds link for menu item to affiliate dashboard.
 *
 */
if( !function_exists( 'wcusage_account_tab_affiliate_hook_endpoint' ) ) {
  function wcusage_account_tab_affiliate_hook_endpoint( $url, $endpoint, $value, $permalink ){

  	if( $endpoint === "coupon-affiliate" ) {

  		$url = wcusage_get_coupon_shortcode_page(0);

  	}
  	return $url;

  }
}
add_filter( 'woocommerce_get_endpoint_url', 'wcusage_account_tab_affiliate_hook_endpoint', 10, 4 );
