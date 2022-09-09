<?php 
// 1follows : >100.000 follows
// 2follows : 100.000 -500.000 follows
// 3follows : 1.000.000 -2.000.000 follows
/**
 * @snippet       WooCommerce Add New Tab @ My Account
 * @how-to        Get CustomizeWoo.com FREE
 * @author        Rodolfo Melogli
 * @compatible    WooCommerce 5.0
 * @donate $9     https://businessbloomer.com/bloomer-armada/
 */
  
// ------------------
// 1. Register new endpoint (URL) for My Account page
// Note: Re-save Permalinks or it will give 404 error
add_filter ( 'woocommerce_account_menu_items', 'wptips_customize_account_menu_items' );
function wptips_customize_account_menu_items( $menu_items ){
 
    //unset( $menu_items['dashboard'] ); // Remove Dashboard from My Account Menu
    unset( $menu_items['orders'] ); // Remove Orders from My Account Menu
    unset( $menu_items['downloads'] ); // Remove Downloads from My Account Menu
    unset( $menu_items['edit-account'] ); // Remove Account details from My Account Menu
    unset( $menu_items['payment-methods'] ); // Remove Payment Methods from My Account Menu
    //unset( $menu_items['edit-address'] ); // Addresses from My Account Menu
    //unset( $menu_items['customer-logout'] ); // Remove Logout link from My Account Menu
	return $menu_items;
}
function kol_add_info_support_endpoint() {
    add_rewrite_endpoint( 'info-support', EP_ROOT | EP_PAGES );
    add_rewrite_endpoint( 'kol-report', EP_ROOT | EP_PAGES );
	flush_rewrite_rules();
}
  
add_action( 'init', 'kol_add_info_support_endpoint' );
  
// ------------------
// 2. Add new query var
  
function kol_info_query_vars( $vars ) {
    $vars[] = 'info-support';
    $vars[] = 'kol-report';
    return $vars;
}
  
add_filter( 'query_vars', 'kol_info_query_vars', 0 );
  
// ------------------
// 3. Insert the new endpoint into the My Account menu
  
function kol_add_info_link_my_account( $items ) {
    $items['info-support'] = 'Cài đặt';
    $items['kol-report'] = 'Báo cáo';
    return $items;
}
  
add_filter( 'woocommerce_account_menu_items', 'kol_add_info_link_my_account' );
  
// ------------------
// 4. Add content to the new tab
  
function kol_info_support_content() {
	if( is_user_logged_in() ) {
		$current_user = wp_get_current_user();
		$roles = ( array ) $current_user->roles;
		// echo "<pre>";
		// var_dump($current_user->ID);
		// echo "</pre>";
	}

	// Role is koc/kol
	if ( $roles[0] == 'kol_user' ){
		// $select_kol = get_field('koc_select','user_' . $current_user->ID);
		require get_stylesheet_directory() . '/kol/kol_user.php';
	} 
    // else if( $roles[0] == 'kol_user' ){

    // }

//    echo do_shortcode( ' /* your shortcode here */ ' );
}
  
add_action( 'woocommerce_account_info-support_endpoint', 'kol_info_support_content' );
// Note: add_action must follow 'woocommerce_account_{your-endpoint-slug}_endpoint' format

function kol_kol_report_content() {
	if( is_user_logged_in() ) {
		$current_user = wp_get_current_user();
		$roles = ( array ) $current_user->roles;
		// echo "<pre>";
		// var_dump($roles[0]);
		// echo "</pre>";
	}

	// Role is koc/kol
	if ( $roles[0] == 'administrator' ){
		// $select_kol = get_field('koc_select','user_' . $current_user->ID);
		// echo "Admin report";
		// echo "This is report";
        require get_stylesheet_directory() . '/kol/kol_admin_report.php';
	} 
    else{
		require get_stylesheet_directory() . '/kol/kol_report.php';
    }

//    echo do_shortcode( ' /* your shortcode here */ ' );
}
  
add_action( 'woocommerce_account_kol-report_endpoint', 'kol_kol_report_content' );

// Rename, re-order my account menu items
function fwuk_reorder_my_account_menu() {
    $neworder = array(
        'dashboard'          => __( 'Dashboard', 'woocommerce' ),
        'edit-address'       => __( 'Addresses', 'woocommerce' ),
        'coupon-affiliate'       => __( 'Affiliate', 'woocommerce' ),
        'info-support'       => __( 'Cài đặt', 'woocommerce' ),
        'kol-report'       => __( 'Báo cáo', 'woocommerce' ),
        'customer-logout'    => __( 'Logout', 'woocommerce' ),
    );
    return $neworder;
}
add_filter ( 'woocommerce_account_menu_items', 'fwuk_reorder_my_account_menu' );

