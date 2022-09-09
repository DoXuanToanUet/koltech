<?php
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
/**
 * Outputs the affiliate dashboard page as shortcode
 *
 * @param mixed $atts
 *
 */
function wcusage_couponusage( $atts )
{
    if ( function_exists( 'is_product' ) ) {
        
        if ( !is_admin() && !is_product() ) {
            ob_start();
            ?>

      <link rel="stylesheet" href="<?php 
            echo  WCUSAGE_UNIQUE_PLUGIN_URL . 'fonts/font-awesome/css/all.min.css' ;
            ?>" crossorigin="anonymous">
      <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    	<?php 
            do_action( 'wcusage_hook_custom_styles' );
            // Custom Styles
            ?>

      <?php 
            // Get Language
            $language = wcusage_get_language_code();
            $translate = wcusage_translate();
            $options = get_option( 'wcusage_options' );
            $urlid = "";
            $coupon_code = "";
            $couponvisible = 0;
            $wcusage_show_tabs = 1;
            $wcusage_page_load = 0;
            $singlecoupon = "";
            
            if ( isset( $atts['coupon'] ) ) {
                $singlecoupon = strtolower( $atts['coupon'] );
                // Allows Single Coupon Shortcode
            } else {
                $singlecoupon = "";
            }
            
            $wcusage_justcoupon = wcusage_get_setting_value( 'wcusage_field_justcoupon', '1' );
            $wcusage_show_tax = wcusage_get_setting_value( 'wcusage_field_show_tax', '0' );
            $wcusage_hide_all_time = wcusage_get_setting_value( 'wcusage_field_hide_all_time', '0' );
            $wcusage_urlprivate = wcusage_get_setting_value( 'wcusage_field_urlprivate', '1' );
            if ( wcusage_check_admin_access() ) {
                $wcusage_urlprivate = 0;
            }
            $wcusage_field_which_toggle = wcusage_get_setting_value( 'wcusage_field_which_toggle', '1' );
            $wcusage_show_refresh = wcusage_get_setting_value( 'wcusage_field_show_refresh', '0' );
            $couponnotassigned = false;
            if ( isset( $_GET['couponid'] ) ) {
                $urlid = strtolower( $_GET['couponid'] );
            }
            $show_coupon = "";
            
            if ( $singlecoupon ) {
                $show_coupon = $singlecoupon;
            } else {
                if ( $urlid ) {
                    $show_coupon = $urlid;
                }
            }
            
            $show_coupon = preg_replace( '/-[^-]*$/', '', $show_coupon );
            // Remove everything after last dash ("-") which is the ID.
            $args = array(
                'post_type'       => 'shop_coupon',
                'posts_per_page'  => -1,
                'post_title_like' => $show_coupon,
                'cache_results'   => false,
            );
            $the_query = new WP_Query( $args );
            while ( $the_query->have_posts() ) {
                $the_query->the_post();
                $postid = get_the_ID();
                $currentuserid = get_current_user_id();
                $coupon = strtolower( get_the_title() );
                $secretid = $coupon . $postid;
                $secretid2 = $coupon . "-" . $postid;
                
                if ( $wcusage_justcoupon ) {
                    $secretid3 = $coupon;
                } else {
                    $secretid3 = "-";
                }
                
                $getthetitle = strtolower( get_the_title() );
                $getthetitle = str_replace( ' ', '%20', $getthetitle );
                // Fix spaces
                
                if ( ($secretid == $urlid || $secretid2 == $urlid || $secretid3 == $urlid || $getthetitle == $singlecoupon) && ($coupon && $urlid || $coupon && !empty($atts['coupon'])) ) {
                    $coupon_user_id = get_post_meta( $postid, 'wcu_select_coupon_user', true );
                    global  $woocommerce ;
                    $c = new WC_Coupon( $coupon );
                    $the_coupon_usage = $c->get_usage_count();
                    $wcusage_field_load_ajax = wcusage_get_setting_value( 'wcusage_field_load_ajax', 1 );
                    $wcusage_field_load_ajax_per_page = wcusage_get_setting_value( 'wcusage_field_load_ajax_per_page', 1 );
                    if ( !$wcusage_field_load_ajax ) {
                        $wcusage_field_load_ajax_per_page = 0;
                    }
                    
                    if ( !$wcusage_field_load_ajax ) {
                        $wcusage_page_load = wcusage_get_setting_value( 'wcusage_field_page_load', '0' );
                        if ( $the_coupon_usage > 5000 ) {
                            $wcusage_page_load = 1;
                        }
                    } else {
                        $wcusage_page_load = "0";
                    }
                    
                    $couponinfo = wcusage_get_coupon_info_by_id( $postid );
                    $couponuser = $couponinfo[1];
                    // Check if user is parent affiliate
                    $is_mla_parent = "";
                    
                    if ( function_exists( 'wcusage_network_check_sub_affiliate' ) ) {
                        $is_mla_parent = wcusage_network_check_sub_affiliate( $currentuserid, $couponuser );
                        if ( $is_mla_parent ) {
                            echo  "<style>#tab-page-payouts, #tab-page-settings { display: none; }</style>" ;
                        }
                    }
                    
                    // Show Content
                    
                    if ( ($is_mla_parent || $couponuser == $currentuserid || wcusage_check_admin_access() || $coupon_user_id == "" && !$wcusage_urlprivate) && ($urlid || $couponuser == $currentuserid || !empty($atts['coupon'])) ) {
                        ?>

    			  <div class="wcu-dash-coupon-area">

            <style>.wcu-user-coupon-title, .wcu-user-coupon-linebreak { display: none; }</style>

    				<?php 
                        // Coupon Dashboard Title
                        echo  '<h2 class="coupon-title">' ;
                        the_title();
                        
                        if ( $wcusage_field_load_ajax ) {
                            ?>
    					<a class="wcusage-refresh-data" href="javascript:void(0);" style="visibility: hidden;">
    						<i class="fas fa-sync" style="font-size: 16px;" title="<?php 
                            echo  __( "Refresh stats...", "woo-coupon-usage" ) ;
                            ?>"></i>
    					</a>
    					<?php 
                        }
                        
                        // Logout Link
                        $wcusage_field_show_logout_link = wcusage_get_setting_value( 'wcusage_field_show_logout_link', '1' );
                        
                        if ( is_user_logged_in() && $wcusage_field_show_logout_link ) {
                            $thecurrentuser = get_userdata( $currentuserid );
                            $display_name = $thecurrentuser->display_name;
                            $logoutredirectpage = get_page_link( wcusage_get_coupon_shortcode_page_id() );
                            echo  "<span class='wcusage-dash-logout' style='float: right; text-align: right;'><a href='" . wp_logout_url( $logoutredirectpage ) . "' style='font-size: 12px;'>" . __( 'Logout', 'woo-coupon-usage' ) . " <i class='fas fa-sign-out-alt'></i></a></span>" ;
                        }
                        
                        // MLA Link
                        $wcusage_field_mla_enable = wcusage_get_setting_value( 'wcusage_field_mla_enable', '0' );
                        $wcusage_field_show_mla_link = wcusage_get_setting_value( 'wcusage_field_show_mla_link', '1' );
                        
                        if ( $wcusage_field_mla_enable && $wcusage_field_show_mla_link ) {
                            $mla_dashboard_url = wcusage_get_mla_shortcode_page();
                            echo  "<span class='wcusage-dash-logout wcusage-dash-mla-link' style='float: right; text-align: right; margin-right: 20px;'><a href='" . $mla_dashboard_url . "' style='font-size: 12px;'>" . __( 'MLA Dashboard', 'woo-coupon-usage' ) . " <i class='fa-solid fa-circle-arrow-right'></i></a></span>" ;
                        }
                        
                        echo  '</h2>' ;
                        $coupon_code = "";
                        
                        if ( $singlecoupon ) {
                            $coupon_code = $singlecoupon;
                        } else {
                            $urlid = str_replace( "-" . $postid, "", $urlid );
                            $urlid = preg_replace( '/' . preg_quote( $postid, '/' ) . '$/', '', $urlid );
                            if ( $urlid ) {
                                $coupon_code = $urlid;
                            }
                        }
                        
                        $get_options = get_option( 'wcusage_options' );
                        $discount_type_original = get_post_meta( $postid, 'discount_type', true );
                        $discount_type = get_post_meta( $postid, 'discount_type', true );
                        if ( $discount_type == "fixed_cart" ) {
                            $discount_type = $translate['wcusage_field_tr_discount_fixed_cart'];
                        }
                        if ( $discount_type == "percent" ) {
                            $discount_type = $translate['wcusage_field_tr_discount_percent'];
                        }
                        if ( $discount_type == "recurring_fee" ) {
                            $discount_type = $translate['wcusage_field_tr_discount_recurring_fee'];
                        }
                        if ( $discount_type == "recurring_percent" ) {
                            $discount_type = $translate['wcusage_field_tr_discount_recurring_percent'];
                        }
                        if ( $discount_type == "signup_fixed" ) {
                            $discount_type = $translate['wcusage_field_tr_discount_signup_fixed'];
                        }
                        // Total Orders To Show
                        $option_coupon_orders = wcusage_get_setting_value( 'wcusage_field_orders', '10' );
                        $combined_commission = wcusage_commission_message( $postid );
                        $current_commission_message = get_post_meta( $postid, 'wcu_commission_message', true );
                        /*** Error if ajax fails ***/
                        $ajaxerrormessage = wcusage_ajax_error();
                        /*** Show Tabs ***/
                        $old_url_tracking = wcusage_get_setting_value( 'wcusage_field_coupon_old_url_tracking', '0' );
                        $wcusage_show_tabs = wcusage_get_setting_value( 'wcusage_field_show_tabs', '1' );
                        /*** REFRESH STATS? ***/
                        $force_refresh_stats = 0;
                        // This checks to see if commission amount updated, if so then refresh stats
                        
                        if ( $combined_commission != $current_commission_message ) {
                            update_post_meta( $postid, 'wcu_commission_message', $combined_commission );
                            $force_refresh_stats = 1;
                        }
                        
                        // Get force refresh date
                        $wcusage_refresh_date = "";
                        if ( isset( $options['wcusage_refresh_date'] ) ) {
                            $wcusage_refresh_date = $options['wcusage_refresh_date'];
                        }
                        // Check if force refresh not done
                        $wcu_last_refreshed = get_post_meta( $postid, 'wcu_last_refreshed', true );
                        if ( !$wcu_last_refreshed ) {
                            $force_refresh_stats = 1;
                        }
                        // Check if force refresh needed
                        
                        if ( $force_refresh_stats || $wcusage_refresh_date && $wcusage_refresh_date > $wcu_last_refreshed ) {
                            $force_refresh_stats = 1;
                            update_post_meta( $postid, 'wcu_last_refreshed', $wcusage_refresh_date );
                            ?>
              <?php 
                            if ( $wcusage_field_load_ajax ) {
                                ?>
              <script>
              jQuery(document).ready(function() {
                jQuery('.wcutablinks').css("opacity", "0.5");
                jQuery('.wcutablinks').css("pointer-events", "none");
              });
              </script>
              <?php 
                            }
                            ?>
              <?php 
                        }
                        
                        // Loader
                        
                        if ( $wcusage_show_tabs == '1' || $wcusage_show_tabs == '' ) {
                            ?>

            <div style="height: 0;">

    				<script>
    				function wcusage_update_complete_loading() {
    					jQuery(".wcu-loading-image").hide();
    					jQuery('.stuck-loading-message').hide();
    					jQuery(".wcu-loading-hide").css({"visibility": "visible", "height": "auto"});
    					jQuery('.wcusage-refresh-data i').removeClass('fa-spin wcusage-loading');
    					jQuery(".wcusagechart").css("visibility", "visible");
    					jQuery("#wcusagechartmonth path").click();
    					jQuery('#generate-short-url').css('opacity', '1');
    					jQuery('#generate-short-url').prop('disabled', false);
    					<?php 
                            if ( $old_url_tracking ) {
                                ?>
                wcusage_update_complete_loading_referral_usage();
              <?php 
                            }
                            ?>
    				}
            <?php 
                            
                            if ( $old_url_tracking ) {
                                ?>
    				function wcusage_update_complete_loading_referral_usage() {
    					/* OLD TRACKING - Update Referral URL Usage */
    					if(!jQuery('#wcu-referral-campaign').val()) {
    						var wcu_usage_number = jQuery("#wcu-total-usage-number").text();
    						var wcu_usage_clicks_number = jQuery("#wcu-total-usage-clicks-url").text();
    						var wcu_usage_clicks_conversion = wcu_usage_number / wcu_usage_clicks_number * 100;
    						var wcu_usage_clicks_conversion = wcu_usage_clicks_conversion.toFixed(2);
    						if(isNaN(wcu_usage_clicks_conversion)) { wcu_usage_clicks_conversion = 0; }
    						if(!isFinite(wcu_usage_clicks_conversion)) { wcu_usage_clicks_conversion = 0; }
    						if(wcu_usage_clicks_conversion > 100) { wcu_usage_clicks_conversion = 100; }
    						<?php 
                                if ( !$wcusage_page_load ) {
                                    ?>
    							jQuery('#wcu-total-usage-number-url').html(wcu_usage_number);
    						<?php 
                                }
                                ?>
    						jQuery('#wcu-total-usage-clicks-conversion').html(wcu_usage_clicks_conversion);
    					}
    				}
            <?php 
                            }
                            
                            ?>
    				<?php 
                            
                            if ( $wcusage_field_load_ajax ) {
                                ?>
    				jQuery(document).on({
    						ajaxStart: function(){
    								jQuery(".wcu-loading-image").show();
    								jQuery('.wcusage-refresh-data i').addClass('fa-spin wcusage-loading');
    						},
    						ajaxStop: function(){
    						<?php 
                            } else {
                                ?>
    						jQuery( document ).ready(function() {
    						<?php 
                            }
                            
                            ?>
    							wcusage_update_complete_loading();
    						<?php 
                            if ( $wcusage_field_load_ajax ) {
                                ?>
    						}
    						<?php 
                            }
                            ?>
    				});
    				</script>
    				<?php 
                        }
                        
                        ?>

            <script>
            function wcuOpenTab(evt, tabName) {
              jQuery(".wcutabcontent").css("display", "none");
              jQuery(".wcutabcontent").removeClass( "active" );
              jQuery("#" + tabName).css("display", "block");
              jQuery("#" + tabName).addClass( "active" );
            }
            </script>

            <script>
          	<?php 
                        if ( !$wcusage_page_load ) {
                            ?>
            if (jQuery('.wcutabfirst').length > 0) {
          	   document.querySelector('.wcutabfirst').click();
            }
          	<?php 
                        }
                        ?>
          	</script>

            </div>

            <?php 
                        do_action( 'wcusage_hook_before_dashboard', $coupon_code );
                        // Custom Hook
                        ?>

            <div style="clear: both;"></div>

            <?php 
                        do_action( 'wcusage_hook_dashboard_normal_tabs', $wcusage_page_load );
                        ?>

            <?php 
                        // Get Statistics tab content
                        do_action(
                            'wcusage_hook_dashboard_tab_content_statistics',
                            $postid,
                            $coupon_code,
                            $combined_commission,
                            $wcusage_page_load,
                            $force_refresh_stats
                        );
                        ?>

    				<?php 
                        ?>

            <?php 
                        // Get Latest Orders tab content
                        do_action(
                            'wcusage_hook_dashboard_tab_content_latest_orders',
                            $postid,
                            $coupon_code,
                            $combined_commission,
                            $wcusage_page_load
                        );
                        ?>

            <?php 
                        // Referral URL Links Section
                        do_action(
                            'wcusage_hook_dashboard_tab_content_referral_url_stats',
                            $postid,
                            $coupon_code,
                            $combined_commission,
                            $wcusage_page_load
                        );
                        ?>

    				<?php 
                        ?>

    				<?php 
                        ?>

            <?php 
                        // Settings Section
                        $wcusage_field_show_settings_tab_show = wcusage_get_setting_value( 'wcusage_field_show_settings_tab_show', '1' );
                        
                        if ( $wcusage_field_show_settings_tab_show ) {
                            ?>
              <?php 
                            
                            if ( !$is_mla_parent || wcusage_check_admin_access() ) {
                                ?>
                <?php 
                                do_action(
                                    'wcusage_hook_dashboard_tab_content_settings',
                                    $postid,
                                    $coupon_code,
                                    $combined_commission,
                                    $wcusage_page_load,
                                    $coupon_user_id,
                                    ''
                                );
                                ?>
              <?php 
                            }
                            
                            ?>
    				<?php 
                        }
                        
                        ?>

            <?php 
                        ?>

    			<?php 
                    } else {
                        // Show message if coupon not assigned to user
                        $couponnotassigned = true;
                        echo  "<p class='wcusage-full-not-assigned'>" . $translate['wcusage_field_tr_coupon_not_assigned'] . "</p>" ;
                    }
                
                }
            
            }
            if ( !isset( $couponnotassigned ) ) {
                $couponnotassigned = false;
            }
            if ( !isset( $urlid ) ) {
                $urlid = "";
            }
            if ( !isset( $singlecoupon ) ) {
                $singlecoupon = "";
            }
            // If unique URL but no coupon/page found show message
            if ( !$coupon_code && !$couponnotassigned && $urlid ) {
                echo  __( "No affiliate dashboard found.", "woo-coupon-usage" ) ;
            }
            ?>

      	<?php 
            $get_options = get_option( 'wcusage_options' );
            
            if ( !$singlecoupon && !isset( $_GET['couponid'] ) ) {
                echo  do_shortcode( '[couponaffiliates-user]' ) ;
            } else {
                
                if ( !$urlid && !$coupon_code ) {
                    ?>
      		<br/><br/>
      		<div style="clear: both;"></div>
      		<p>
            <?php 
                    echo  __( "No coupon ID has been selected.", "woo-coupon-usage" ) ;
                    ?>
      		</p>
      		<?php 
                }
            
            }
            
            ?>

        <div style="clear: both; margin-bottom: 50px;"></div>

        <?php 
            do_action( 'wcusage_hook_after_dashboard', $coupon_code );
            // Custom Hook
            ?>

    	   <?php 
            $thecontent = ob_get_contents();
            ob_end_clean();
            wp_reset_postdata();
            // Return content removing white spaces
            $thecontent = trim( preg_replace( '/\\s+/', ' ', $thecontent ) );
            return $thecontent;
        }
    
    }
}

add_shortcode( 'couponusage', 'wcusage_couponusage' );
add_shortcode( 'couponaffiliates', 'wcusage_couponusage' );
//add_filter('the_content', 'wpautop', 12);