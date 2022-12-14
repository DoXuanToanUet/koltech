<?php
/**
 * Theme functions and definitions
 *
 * @package HelloElementorChild
 */

/**
 * Load child theme css and optional scripts
 *
 * @return void
 */
function hello_elementor_child_enqueue_scripts() {
	wp_enqueue_style(
		'hello-elementor-child-style',
		get_stylesheet_directory_uri() . '/style.css',
		[
			'hello-elementor-theme-style',
		],
		'1.0.0'
	);
}
add_action( 'wp_enqueue_scripts', 'hello_elementor_child_enqueue_scripts', 20 );

// Allow SVG
add_filter( 'wp_check_filetype_and_ext', function($data, $file, $filename, $mimes) {

  global $wp_version;
  if ( $wp_version !== '4.7.1' ) {
     return $data;
  }

  $filetype = wp_check_filetype( $filename, $mimes );

  return [
      'ext'             => $filetype['ext'],
      'type'            => $filetype['type'],
      'proper_filename' => $data['proper_filename']
  ];

}, 10, 4 );

function cc_mime_types( $mimes ){
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter( 'upload_mimes', 'cc_mime_types' );

function fix_svg() {
  echo '<style type="text/css">
        .attachment-266x266, .thumbnail img {
             width: 100% !important;
             height: auto !important;
        }
        </style>';
}
add_action( 'admin_head', 'fix_svg' );

/**
 * AKAZA  Step 1: Allow only 1 element in the cart.
 */
// add_filter( 'woocommerce_add_cart_item_data', function ( $cart_item_data ) {
// 	global $woocommerce;
// 	$woocommerce->cart->empty_cart();
// 	return $cart_item_data;
// } );

/**
 * Step 2. Disable AJAX "Add to cart" Buttons.
 */
// add_filter( 'option_woocommerce_enable_ajax_add_to_cart', '__return_false' );

/**
 * Step 3a: Redirect to the checkout page after adding a product to the to cart.
 */
// add_filter('add_to_cart_redirect', function () {
// 	return wc_get_page_permalink( 'checkout' ); 
// } );

/**
 * Step 3b: Remove '“Product blah blah blah” has been added to your cart. | View cart'.
 */
// add_filter( 'wc_add_to_cart_message_html', '__return_null' );

/**
 * Step 3c: Redirect cart to checkout.
 */
// add_action( 'wp', function() {
// 	if ( is_cart() ) {
// 		wp_safe_redirect( wc_get_page_permalink( 'checkout' ) );
// 		exit;
// 	}
// } );

/**
 * Step 4a: Change "Add to cart".
 */
// add_action( 'init', function() {

// 	$text = 'Buy Now';

// 	add_action( 'woocommerce_product_add_to_cart_text', function() use ( $text ) {
// 		return $text;
// 	} );

// 	add_action( 'woocommerce_product_single_add_to_cart_text', function() use ( $text ) {
// 		return $text;
// 	} );
// } );

/**
 * Step 4b:Remove the quantity input field.
 */
// add_filter( 'woocommerce_is_sold_individually', '__return_true' );

// add_role("kol_user","KOL/KOC",array(
// 	"read"=>true
// )); 

// if ( ! current_user_can( 'manage_options' ) ) {
//     show_admin_bar( false );
// }
// function cc_wpse_278096_disable_admin_bar() {
// 	if( current_user_can( 'kol_user' ) ){
// 		show_admin_bar(true);
// 	}
//  }
//  add_action('after_setup_theme', 'cc_wpse_278096_disable_admin_bar');
function add_theme_scripts()
{
    $version = '1.0';

    wp_enqueue_style('devMainCss', get_stylesheet_directory_uri() . '/assets/css/custom.css', array(), $version, 'all');
    wp_enqueue_style('BootstrapCss', get_stylesheet_directory_uri() . '/assets/css/bootstrap.min.css', array(), $version, 'all');
    wp_enqueue_style('devFontAwe', get_stylesheet_directory_uri() . '/assets/plugins/fontAwesome/font-awesome.min.css', array(), $version, 'all');
    // wp_enqueue_style('DataTableCss', get_stylesheet_directory_uri() . '/assets/plugin/xls/jquery.dataTables.min.css', array(), $version, 'all');
  
    wp_enqueue_script('devMainJS', get_stylesheet_directory_uri() . '/assets/js/main.js', array(), $version, true);
    wp_enqueue_script('BootstrapJs', get_stylesheet_directory_uri() . '/assets/js/bootstrap.min.js', array(), $version, true);
    // wp_enqueue_script('DataTableJs', get_stylesheet_directory_uri() . '/assets/plugin/xls/jquery.dataTables.min.js', array(), $version, true);

}

add_action('wp_enqueue_scripts', 'add_theme_scripts');


require get_stylesheet_directory() . '/inc-function/inc-register.php';
require get_stylesheet_directory() . '/inc-function/inc-ajaxregis.php';
require get_stylesheet_directory() . '/inc-function/inc_dashboard_kol.php';
require get_stylesheet_directory() . '/inc-function/inc_kol.php';
require get_stylesheet_directory() . '/inc-function/custom-avartar.php';
require get_stylesheet_directory() . '/inc-function/inc_acf_roles.php';
require get_stylesheet_directory() . '/inc-function/shrt_rank.php';
require get_stylesheet_directory() . '/template-page/shrt-ranks.php';
require get_stylesheet_directory() . '/inc-function/shrt_rank_role.php';



//Theme Options
if (function_exists('acf_add_options_page')) {

  acf_add_options_page(array(
      'page_title' => 'Coupon Settings',
      'menu_title' => 'Coupon Settings',
      'menu_slug'  => 'coupon-general-settings',
      'capability' => 'manage_options',
      'redirect'   => false
  ));

  // acf_add_options_sub_page(array(
  //     'page_title'  => 'Theme Header Settings',
  //     'menu_title'  => 'Header',
  //     'parent_slug' => 'theme-general-settings',
  // ));
}
add_action('rest_api_init', 'universityRegisterSearch');

function universityRegisterSearch(){
    register_rest_route('techwings/v1', 'coupon', array(
        'methods' => 'GET',
        'callback' => 'phoneResult',
        // 'permission_callback' => function () {
        //     return current_user_can( 'edit_others_posts' );
        //   }
      ));
}
function phoneResult($data){
    
  $args = array(
    // 'role' => 'Contributor',
    'orderby' => 'post_count',
    'order' => 'DESC',
  );
  $wp_user_query = new WP_User_Query( $args );
  $authors = $wp_user_query->get_results();
  $user_kol = [];
  foreach ($authors as $author):
    // get all the user's data
    $author_info = get_userdata($author->ID);
    $user = get_userdata( $author->ID );
    $user_roles = $user->roles;
    // echo "<pre>";
    // var_dump($author_info);
    // echo "</pre>";
    array_push( $user_kol , array(
      "userID"  => $author->ID,
      "userName" => $author_info->user_login,
      "userRole" => $user_roles

    ));  

  endforeach;
  return $user_kol;
}
// $path = 'http://kolt.local/wp-json/techwings/v1/coupon';
// $str = file_get_contents($path);
// var_dump( json_decode($str) );


// ajax order last
add_action('wp_ajax_WlastOrder', 'WlastOrder');
add_action('wp_ajax_nopriv_WlastOrder', 'WlastOrder');

function WlastOrder(){

    // ob_start();
    $user_arr=[];
    $last_order_id = wc_get_orders(array('limit' => 1, 'return' => 'ids')); // Get last Order ID (array)
    $order_last = wc_get_order($last_order_id[0]);
    $order_data_last = $order_last->get_data(); // The Order data
    $order_date_created = $order_data_last['date_created']->date('Y-m-d H:i:s');
    $user_orders =[];
    foreach ($order_last->get_items() as $item_key => $item ):
        $product      = $item->get_name(); // Get the WC_Product object
        $product_id   = $item->get_product_id(); // the Product id
        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $product_id ), 'single-post-thumbnail' );
        // $date      = $item->get_date(); // Get the WC_Product object
        array_push($user_orders, array(
            // "orderID" => $orderObj->get_id(),
            "orderDate" =>    $order_date_created ,
            'product' => $product,
            'image' =>$image[0]
        ));
    endforeach;
    $user_id = $order_last->get_user_id();
    $get_user = get_user_by( 'id', $user_id ); 
    $user_display_name = $get_user->display_name;
    array_push( $user_arr,array(
        'userName'   => $user_display_name,
        $user_orders
    ));
    // return $user_arr;
 
    // $result = ob_get_clean();
    if ($user_arr){
        wp_send_json_success(array(
            "message"=>"success",
            "showdata"=> $user_arr
        ));  
        die();
    }
}

// Custom order number 
// add_filter( 'woocommerce_order_number', 'change_woocommerce_order_number' );

// function change_woocommerce_order_number( $order_id ) {
//     $prefix = 'VK/';
//     $suffix = '/TS';
//     $new_order_id = $prefix . $order_id . $suffix;
//     return $new_order_id;
// }


// Change sale
// ===========================================
add_filter('woocommerce_sale_flash', 'ds_change_sale_text');
function ds_change_sale_text() {
  return '<span class="onsale onsale_badge">Sale</span>';
}

// Thêm hình ảnh cho sản phẩm trang checkout
// ===========================================
add_filter( 'woocommerce_cart_item_name', 'ts_product_image_on_checkout', 10, 3 );
 
function ts_product_image_on_checkout( $name, $cart_item, $cart_item_key ) {
     
    /* Return if not checkout page */
    if ( ! is_checkout() ) {
        return $name;
    }
     
    /* Get product object */
    $_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
 
    /* Get product thumbnail */
    $thumbnail = $_product->get_image();
 
    /* Add wrapper to image and add some css */
    $image = '<div class="ts-product-image" style="width: 64px; height: 64px; display: inline-block; padding-right: 7px; vertical-align: middle;">'
                . $thumbnail .
            '</div>'; 
 
    /* Prepend image to name and return it */
    return $image . $name;
}

// function tf_check_user_role( $roles ) {
//   /*@ Check user logged-in */
//   if ( is_user_logged_in() ) :
//       /*@ Get current logged-in user data */
//       $user = wp_get_current_user();
//       /*@ Fetch only roles */
//       $currentUserRoles = $user->roles;
//       /*@ Intersect both array to check any matching value */
//       $isMatching = array_intersect( $currentUserRoles, $roles);
//       $response = false;
//       /*@ If any role matched then return true */
//       if ( !empty($isMatching) ) :
//           $response = true;        
//       endif;
//       return $response;
//   endif;
// }
// $roles = [ 'shop_manager' ];
// if ( tf_check_user_role($roles) ) :
//   add_filter('show_admin_bar', '__return_false');
// endif;