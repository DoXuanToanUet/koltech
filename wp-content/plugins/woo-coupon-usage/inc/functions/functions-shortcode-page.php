<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Check if Page Contains Shortcode
 *
 * @param bool $seperate
 *
 * @return string
 *
 */
if( !function_exists( 'wcusage_page_contain_shortcode' ) ) {
	function wcusage_page_contain_shortcode($pageid) {

		$options = get_option( 'wcusage_options' );
		$structure = get_option( 'permalink_structure' );

		global $wpdb;
		$query = "SELECT ID FROM ".$wpdb->posts." WHERE ID = '".$pageid."' && (post_content LIKE '%[couponaffiliates]%' OR post_content LIKE '%[couponusage]%' OR post_content LIKE '%[couponaffiliates-mla]%') AND post_status = 'publish'";
		$results = $wpdb->get_results($query);
    $rowcount = $wpdb->num_rows;

		if($rowcount) {
      return true;
		} else {
      return false;
    }

	}
}

/**
 * Get Coupon Shortcode Page
 *
 * @param bool $seperate
 *
 * @return string
 *
 */
if( !function_exists( 'wcusage_get_coupon_shortcode_page' ) ) {
	function wcusage_get_coupon_shortcode_page($seperate) {

		$options = get_option( 'wcusage_options' );
		$structure = get_option( 'permalink_structure' );

    if(isset($options['wcusage_dashboard_page'])) {
      $wcusage_dashboard_page = $options['wcusage_dashboard_page'];
    } else {
      $wcusage_dashboard_page = "";
    }

		if($seperate) {
			if($structure == "") { $seperatepermalink = "&"; } else { $seperatepermalink = "?"; }
		} else {
			$seperatepermalink = "";
		}

		if ( $wcusage_dashboard_page && get_post_status ( $wcusage_dashboard_page ) == 'publish' ) {

			//$slug = get_post_field( 'post_name', $wcusage_dashboard_page );
			$slug = rtrim(get_permalink( $wcusage_dashboard_page ),'/');

			$thepageurl = $slug . $seperatepermalink;

		} else {

			global $wpdb;
			$query = "SELECT ID, post_title FROM ".$wpdb->posts." WHERE post_content LIKE '%[couponaffiliates]%' AND post_status = 'publish'";
			$results = $wpdb->get_results($query);

			if(!$results) {
				$query = "SELECT ID, post_title FROM ".$wpdb->posts." WHERE post_content LIKE '%[couponusage]%' AND post_status = 'publish'";
				$results = $wpdb->get_results($query);
			}

			$thepageurl = "";

			if($results) {

				foreach ( $results as $result ) {
					$thepageid = $result->ID;
					$slug = rtrim(get_permalink( $result->ID ),'/');
				}

				$thepageurl = $slug . $seperatepermalink;

			}

			if( !$wcusage_dashboard_page ) {
        if($thepageid) {
  				$option_group = get_option('wcusage_options');
  		    $option_group['wcusage_dashboard_page'] = $thepageid;
  		    update_option( 'wcusage_options', $option_group );
        }
			}

		}

		return $thepageurl;

	}
}

/**
 * Get Coupon Shortcode Page ID
 *
 * @return int
 *
 */
if( !function_exists( 'wcusage_get_coupon_shortcode_page_id' ) ) {
	function wcusage_get_coupon_shortcode_page_id() {

		$options = get_option( 'wcusage_options' );

		if ( $options['wcusage_dashboard_page'] && get_post_status ( $options['wcusage_dashboard_page'] ) == 'publish' ) {

      if(isset($options['wcusage_dashboard_page'])) {
        $thepageid = $options['wcusage_dashboard_page'];
      } else {
        $thepageid = "";
      }

		} else {

			global $wpdb;
			$query = "SELECT ID, post_title FROM ".$wpdb->posts." WHERE post_content LIKE '%[couponaffiliates]%' AND post_status = 'publish'";
			$results = $wpdb->get_results($query);

			if(!$results) {
				$query = "SELECT ID, post_title FROM ".$wpdb->posts." WHERE post_content LIKE '%[couponusage]%' AND post_status = 'publish'";
				$results = $wpdb->get_results($query);
			}

			$thepageid = "";

			if($results) {

				foreach ( $results as $result ) {
					$thepageid = $result->ID;
				}

			}

		}

		return $thepageid;

	}
}

/**
 * Get Registration Shortcode Page
 *
 * @param bool $seperate
 *
 * @return int
 *
 */
if( !function_exists( 'wcusage_get_registration_shortcode_page' ) ) {
	function wcusage_get_registration_shortcode_page($seperate) {

		$options = get_option( 'wcusage_options' );
		$structure = get_option( 'permalink_structure' );
		if($seperate) {
			if($structure == "") { $seperatepermalink = "&"; } else { $seperatepermalink = "?"; }
		} else {
			$seperatepermalink = "";
		}

		global $wpdb;
		$query = "SELECT ID, post_title FROM ".$wpdb->posts." WHERE post_content LIKE '%[couponaffiliates-register]%' AND post_status = 'publish'";
		$results = $wpdb->get_results($query);

		$thepageurl = "";

		if($results) {

			foreach ( $results as $result ) {
				$slug = rtrim(get_permalink( $result->ID ),'/');
			}

			$thepageurl = $slug . $seperatepermalink;

		}

		return $thepageurl;

	}
}

/**
 * Get MLA Shortcode Page ID
 *
 * @return int
 *
 */
if( !function_exists( 'wcusage_get_mla_shortcode_page_id' ) ) {
	function wcusage_get_mla_shortcode_page_id() {

		$options = get_option( 'wcusage_options' );

    if ( $options['wcusage_mla_dashboard_page'] && get_post_status ( $options['wcusage_mla_dashboard_page'] ) == 'publish' ) {

      if(isset($options['wcusage_mla_dashboard_page'])) {
        $thepageid = $options['wcusage_mla_dashboard_page'];
      } else {
        $thepageid = "";
      }

		} else {

  		global $wpdb;
  		$query = "SELECT ID, post_title FROM ".$wpdb->posts." WHERE post_content LIKE '%[couponaffiliates-mla]%' AND post_status = 'publish'";
  		$results = $wpdb->get_results($query);

  		$thepageurl = "";

  		if($results) {

  			foreach ( $results as $result ) {
  				$thepageid =  $result->ID;
  			}

  		}

    }

		return $thepageid;

	}
}

/**
 * Get MLA Shortcode Page
 *
 * @return int
 *
 */
if( !function_exists( 'wcusage_get_mla_shortcode_page' ) ) {
	function wcusage_get_mla_shortcode_page() {

		$options = get_option( 'wcusage_options' );

    if ( $options['wcusage_mla_dashboard_page'] && get_post_status ( $options['wcusage_mla_dashboard_page'] ) == 'publish' ) {

      if(isset($options['wcusage_mla_dashboard_page'])) {
        $thepageid = $options['wcusage_mla_dashboard_page'];
      } else {
        $thepageid = "";
      }

		} else {

      $thepageid = wcusage_get_mla_shortcode_page_id();

    }

    $thepageurl = rtrim(get_permalink( $thepageid ),'/');

		return $thepageurl;

	}
}

/**
 * Get Registration Shortcode Page by ID
 *
 * @return int
 *
 */
if( !function_exists( 'wcusage_get_coupon_register_shortcode_page_id' ) ) {
	function wcusage_get_coupon_register_shortcode_page_id() {

		global $wpdb;
		$query = "SELECT ID, post_title FROM ".$wpdb->posts." WHERE post_content LIKE '%[couponaffiliates-register]%' AND post_status = 'publish'";
		$results = $wpdb->get_results($query);

		$thepageurl = "";

		if($results) {
			foreach ( $results as $result ) {
				return $result->ID;
			}
		} else {
			return false;
		}

	}
}
