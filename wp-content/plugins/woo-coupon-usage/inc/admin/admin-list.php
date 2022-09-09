<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_filter( 'manage_edit-shop_coupon_columns', 'wcusage_woo_customer_order_coupon_column_for_orders' );
function wcusage_woo_customer_order_coupon_column_for_orders( $columns ) {
    $new_columns = array();

    foreach ( $columns as $column_key => $column_label ) {

		$new_columns[$column_key] = $column_label;

		if ( 'expiry_date' === $column_key ) {
			$new_columns['coupon_affiliate'] = __('Affiliate User', 'woocommerce');
		}

    if ( wcu_fs()->can_use_premium_code() ) {
			if ( 'expiry_date' === $column_key ) {
				$new_columns['coupon_unpaid_commission'] = __('Unpaid Commission', 'woocommerce');
			}
		}

    if ( 'expiry_date' === $column_key ) {
        $new_columns['coupon_dash_link'] = __('Affiliate Dashboard', 'woocommerce');
    }

    }
    return $new_columns;
}

add_action( 'manage_shop_coupon_posts_custom_column' , 'wcusage_woo_display_customer_order_coupon_in_column_for_orders' );
function wcusage_woo_display_customer_order_coupon_in_column_for_orders( $column ) {

  global $the_coupon, $post;
	if(isset($post->ID)) {

		$couponid = $post->ID;
		$coupon_info = wcusage_get_coupon_info_by_id($couponid);

		$coupon_user_id = $coupon_info[1];
		$username = "";
    $usernametext = "";

		if($coupon_user_id) {
		$user_info = get_userdata($coupon_user_id);
    if($user_info) {
  		$username = $user_info->user_login;
  		$userlink = get_edit_user_link($coupon_user_id);
  		$usernametext = '<a href="'.$userlink.'" target="_blank">' . $username . '</a>';
    }
		}

		$unpaid_commission = $coupon_info[2];
			if($unpaid_commission == "") { $unpaid_commission = 0; }

		$coupon = $coupon_info[3];
		$uniqueurl = $coupon_info[4];

		if( $column  == 'coupon_affiliate' ) {
			if($username) {
				echo '<strong><a href="'.$userlink.'" target="_blank">' . $username . '</a></strong>';
			} else {
				echo "N/A";
			}
		}

		if( $column  == 'coupon_unpaid_commission' ) {
			if($uniqueurl) {
				echo wcusage_get_currency_symbol() . number_format((float)$unpaid_commission, 2, '.', '');
			} else {
				echo "0";
			}
		}

	}

?>

<script>
// Copy Button
function wcusage_copyToClipboard(elementId) {
  var aux = document.createElement("input");
  aux.setAttribute("value", document.getElementById(elementId).innerText);
  document.body.appendChild(aux);
  aux.select();
  document.execCommand("copy");
  document.body.removeChild(aux);
}
</script>

    <?php
    if( $column  == 'coupon_dash_link' ) {

      $dashboardpage = wcusage_get_coupon_shortcode_page(0);

      if( $dashboardpage != "" && $dashboardpage != "-" && !empty($dashboardpage) ) {

    		if($uniqueurl) {
    			echo '<strong><a href="' . $uniqueurl . '" target="_blank">'.__( "DASHBOARD", "woo-coupon-usage" ).' <span class="dashicons dashicons-external"></span></a></strong>';
    			echo '<a style="display: none;" id="clink'.get_the_ID().'" href="' . $uniqueurl . '" style="color: #333; color: #868686;">'.$uniqueurl.'</code></a>';
    			?>
    			<button type="button" class="wcusage-copy-url" id="wcusage_copylink" onclick="wcusage_copyToClipboard('clink<?php echo get_the_ID(); ?>')"><?php echo __( "Copy URL", "woo-coupon-usage" ); ?></button> <span id="wcu-copied" style="display: none;">Copied!</span>
    			<?php
    		} else {
    			//echo var_dump($coupon_info);
    		}

      } else {

        echo "<span class='dashicons dashicons-warning'></span> Dashboard page not assigned. Please <strong><a href='/wp-admin/admin.php?page=wcusage_settings'>create & assign it in settings</a></strong> first.";
      }

    }

}

// Custom filters
add_action('pre_get_posts', 'wcusage_coupons_query_add_filter' );
function wcusage_coupons_query_add_filter( $wp_query ) {
  if( is_admin()) {
      add_filter('views_edit-shop_coupon', 'wcusage_coupons_filter_cpt');
  }
}

// add filter
function wcusage_coupons_filter_cpt($views) {

  global $wp_query;

  $query = array(
    'post_type'   => 'shop_coupon',
    'meta_query' => array(
      array(
        'key' => 'wcu_select_coupon_user',
        'value'   => array(''),
        'compare' => 'NOT IN'
      ),
     )
  );

  $result = new WP_Query($query);
  if ( isset($_GET['affiliate']) ) {
    $class = 'class="current"';
  } else {
    $class = '';
  }
  $views['missing_related'] = sprintf(__('<a href="%s"'. $class .'>Affiliate Coupons <span class="count">(%d)</span></a>', 'affiliate coupons'),
  admin_url('edit.php?post_type=shop_coupon&affiliate=1'),
  $result->found_posts);

  return $views;

}

add_filter( 'parse_query','wcusage_coupons_norelated_filter' );
function wcusage_coupons_norelated_filter( $query ) {
  if( !empty($query) && isset($query->query['post_type']) ) {

    if( is_admin() AND $query->query['post_type'] == 'shop_coupon' ) {
      if ( isset($_GET['affiliate'] ) ) {
        $qv = &$query->query_vars;
        $qv['meta_query'] = array(
        array(
          'key' => 'wcu_select_coupon_user',
          'value'   => array(''),
          'compare' => 'NOT IN'
        ));
      }
    }

  }
}
