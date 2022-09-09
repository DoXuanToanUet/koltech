<?php

if ( !defined( 'ABSPATH' ) ) {
    exit;
}
/**
 * Adds "coupon_affiliate" Custom User Role
 *
 */
if ( !function_exists( 'wcusage_update_custom_roles' ) ) {
    function wcusage_update_custom_roles()
    {
        
        if ( get_option( 'wcusage_custom_roles_version' ) < 1 ) {
            add_role( 'coupon_affiliate', 'Coupon Affiliate', array(
                'read'    => true,
                'level_0' => true,
            ) );
            update_option( 'wcusage_custom_roles_version', 1 );
        }
    
    }

}
add_action( 'init', 'wcusage_update_custom_roles' );
/**
 * Add custom settings to coupons
 *
 */
if ( !function_exists( 'add_wcusage_coupon_data_fields' ) ) {
    function add_wcusage_coupon_data_fields( $coupon_get_id )
    {
        echo  '<div id="wcusage_coupon_data" class="panel woocommerce_options_panel">' ;
        $options = get_option( 'wcusage_options' );
        
        if ( isset( $options['wcusage_field_hide_coupon_edit_user_list'] ) ) {
            $wcusage_hide_coupon_edit_user_list = $options['wcusage_field_hide_coupon_edit_user_list'];
        } else {
            $wcusage_hide_coupon_edit_user_list = "";
        }
        
        $wcusage_lifetime = wcusage_get_setting_value( 'wcusage_field_lifetime', '0' );
        $wcusage_field_lifetime_all = wcusage_get_setting_value( 'wcusage_field_lifetime_all', '0' );
        $countusers = count_users();
        //echo "Users: " . $users['total_users'];
        $wcusage_field_user_list_affiliates = wcusage_get_setting_value( 'wcusage_field_user_list_affiliates', '0' );
        
        if ( $wcusage_field_user_list_affiliates == 1 ) {
            $args = array(
                'role'   => 'coupon_affiliate',
                'fields' => array( 'ID', 'user_login' ),
            );
        } else {
            $args = array(
                'fields' => array( 'ID', 'user_login' ),
            );
        }
        
        $get_users_list = "";
        
        if ( !$wcusage_hide_coupon_edit_user_list ) {
            $users = get_users( $args );
            $user_ids = wp_list_pluck( $users, 'ID' );
            $user_names = wp_list_pluck( $users, 'user_login' );
            $get_users_list = array_combine( $user_ids, $user_names );
            //$get_users_list = array('' => '---') + $get_users_list;
        }
        
        $theusers = "";
        foreach ( $get_users_list as $key => $user ) {
            $theusers .= "{ value: '" . addslashes( $key ) . "', label: '" . addslashes( $user ) . "' }, ";
        }
        
        if ( isset( $_GET['post'] ) ) {
            $post_id = $_GET['post'];
            $getcurrentcouponuser = get_post_meta( $post_id, 'wcu_select_coupon_user' );
        } else {
            $getcurrentcouponuser = "";
        }
        
        
        if ( $getcurrentcouponuser ) {
            $getcurrentcouponuserid = $getcurrentcouponuser[0];
            $currentselecteduser = get_user_by( 'id', $getcurrentcouponuserid );
        } else {
            $getcurrentcouponuserid = "";
            $currentselecteduser = "";
        }
        
        
        if ( $currentselecteduser ) {
            $currentselecteduserlogin = $currentselecteduser->user_login;
        } else {
            $currentselecteduserlogin = "";
        }
        
        echo  '<style>.wcu-input-checkbox label { width: 100%; }</style>' ;
        ?>

    <script>
      jQuery(function () {
          var yerler = [ <?php 
        echo  $theusers ;
        ?> ];
          jQuery("#wcu_select_coupon_user_visual").autocomplete({
              source: yerler,
              focus: function (event, ui) {
                  event.preventDefault();
                  jQuery("#wcu_select_coupon_user_visual").val(ui.item.label);
              },
              select: function (event, ui) {
                  event.preventDefault();
                  jQuery("#wcu_select_coupon_user").val(ui.item.value);
                  jQuery("#wcu_select_coupon_user_visual").val(ui.item.label);
                  jQuery('#selecteduserid').text(ui.item.value);
                  jQuery('#selectedusername').text(ui.item.label);
                  jQuery('.selectedusernamedelete').show();
                  jQuery('.selectedusernamedelete').css("display", "");
              }
          });
      });
      jQuery( document ).ready(function() {
        <?php 
        if ( !$currentselecteduserlogin ) {
            ?>
        jQuery('.selectedusernamedelete').hide();
        <?php 
        }
        ?>
        jQuery( ".selectedusernamedelete" ).click(function() {
          jQuery("#wcu_select_coupon_user_visual").val("");
          jQuery("#wcu_select_coupon_user").val("");
          jQuery('#selecteduserid').text("");
          jQuery('#selectedusername').html("<span style='color: red;'>N/A</span>");
          jQuery('.selectedusernamedelete').hide();
        });
      });
    </script>

    <style>
    .selectedusernamedelete { display: none; }
    .wcu_select_coupon_user_visual_field:hover .selectedusernamedelete { display: inline-block; }
    </style>

    <br/>&nbsp;&nbsp;&nbsp;General Settings:<br/>

    <?php 
        
        if ( !$wcusage_hide_coupon_edit_user_list && $get_users_list ) {
            woocommerce_wp_text_input( array(
                'id'          => 'wcu_select_coupon_user_visual',
                'label'       => __( 'Affiliate User', 'woocommerce' ),
                'description' => __( '(Start typing username, then select from the options.)', 'woo-coupon-usage' ),
                'value'       => $currentselecteduserlogin,
                'placeholder' => 'Start typing username here...',
            ) );
            ?>

      <p class="form-field wcu_select_coupon_user_visual_field" style="margin-top: -15px; font-size: 15px;">
    		<label for="wcu_select_coupon_user_visual"></label>

        Selected affiliate user: <strong><span id="selectedusername" style="color: green;"><?php 
            
            if ( $currentselecteduserlogin ) {
                echo  $currentselecteduserlogin ;
            } else {
                echo  "<span style='color: red;'>N/A</span>" ;
            }
            
            ?></span></strong>
        <span style="margin-top: -5px; margin-left: 5px;">
          <a class="selectedusernamedelete" href="#" onclick="return false;" style="font-size: 10px; color: red; text-decoration: none; height: 15px;">
            <span class="dashicons dashicons-dismiss" style="font-size: 10px; margin-top: 8px; width: 10px;"></span> Remove
          </a>
        </span>
      </p>

      <?php 
            woocommerce_wp_hidden_input( array(
                'id'    => 'wcu_select_coupon_user',
                'value' => $getcurrentcouponuserid,
            ) );
        } else {
            woocommerce_wp_text_input( array(
                'id'          => 'wcu_select_coupon_user',
                'label'       => __( 'Affiliate User', 'woocommerce' ),
                'description' => __( 'Enter the user ID for the affiliate user.', 'woo-coupon-usage' ),
                'value'       => $getcurrentcouponuserid,
            ) );
        }
        
        woocommerce_wp_text_input( array(
            'type'        => 'date',
            'id'          => 'wcu_text_coupon_start_date',
            'label'       => __( 'Coupon History Start Date', 'woocommerce' ),
            'description' => __( '<br/><i>Custom date to begin displaying past coupon data. Leave empty to show full history.</i>', 'woo-coupon-usage' ),
            'desc_tip'    => false,
        ) );
        echo  "<br/><hr/><br/>&nbsp;&nbsp;&nbsp;Email Notifications:<br/>" ;
        $wcu_enable_notifications = get_post_meta( $coupon_get_id, 'wcu_enable_notifications', true );
        woocommerce_wp_select( array(
            'id'      => 'wcu_enable_notifications',
            'label'   => __( 'Enable affiliate email notifications.', 'woocommerce' ),
            'options' => array(
            '1' => __( 'Enabled', 'woocommerce' ),
            '0' => __( 'Disabled', 'woocommerce' ),
        ),
        ) );
        echo  "<br/><hr/><br/>" ;
        echo  "<p>You can set the global commission rates for all coupons in the <a href='/wp-admin/admin.php?page=wcusage_settings'>plugin settings</a> page.<p>" ;
        echo  "<p>Extra features are available with PRO version including custom commission amounts per coupon, email notifications, and more. <a href='/wp-admin/admin.php?page=wcusage-pricing&trial=true'>UPGRADE</a><p>" ;
        echo  "<img src='" . WCUSAGE_UNIQUE_PLUGIN_URL . "images/coupon-settings-pro.png' style='max-width: 100%;'>" ;
        echo  "</div>" ;
    }

}
add_action( 'woocommerce_coupon_data_panels', 'add_wcusage_coupon_data_fields', 1 );
if ( !function_exists( 'add_wcusage_coupon_data_fields_limits' ) ) {
    function add_wcusage_coupon_data_fields_limits( $coupon_get_id )
    {
        $allow_all_customers = wcusage_get_setting_value( 'wcusage_field_allow_all_customers', '1' );
        ?>

    <?php 
        if ( !$allow_all_customers ) {
            ?>
    <script>
      function wcusage_check_extra_limits() {
        if( jQuery( "#wcu_select_coupon_user_visual" ).val() != "" ) {
          jQuery('.wcusage-coupon-extra-limits').hide();
          jQuery('.wcusage-coupon-extra-limits-default-enabled').show();
        } else {
          jQuery('.wcusage-coupon-extra-limits').show();
          jQuery('.wcusage-coupon-extra-limits-default-enabled').hide();
        }
      }
      jQuery( document ).ready(function() {
        jQuery( "#wcu_select_coupon_user_visual" ).keyup(function () {
          wcusage_check_extra_limits();
        });
        jQuery( ".selectedusernamedelete" ).click(function(){
          jQuery('.wcusage-coupon-extra-limits').show();
          jQuery('.wcusage-coupon-extra-limits-default-enabled').hide();
        });
        wcusage_check_extra_limits();
      });
    </script>
    <?php 
        }
        ?>

    <br/>&nbsp;&nbsp;&nbsp;Coupon Affiliates - Extra Limits:<br/>

    <span class="wcusage-coupon-extra-limits">

    <?php 
        woocommerce_wp_checkbox( array(
            'id'          => 'wcu_enable_first_order_only',
            'label'       => __( 'New customers only?', 'woocommerce' ),
            'description' => __( 'When checked, this coupon can only be used by new customers on their first order.', 'woo-coupon-usage' ),
        ) );
        ?>

    </span>

    <span class="wcusage-coupon-extra-limits-default-enabled" style="display: none;">

    <p class="form-field wcu_enable_first_order_only_field ">
    	<label for="wcu_enable_first_order_only">New customers only?</label>
      (Global Setting) This affiliate coupon can only be used by new customers on their first order.
    </p>

    </span>

  <?php 
    }

}
add_action( 'woocommerce_coupon_options_usage_limit', 'add_wcusage_coupon_data_fields_limits', 1 );
/**
 * Save Coupon Settings on Save
 *
 */
if ( !function_exists( 'wcusage_save_coupon_settings' ) ) {
    function wcusage_save_coupon_settings( $post_id )
    {
        
        if ( isset( $_POST['wcu_select_coupon_user_visual'] ) ) {
            $wcu_select_coupon_user_visual = sanitize_text_field( $_POST['wcu_select_coupon_user_visual'] );
        } else {
            $wcu_select_coupon_user_visual = "";
        }
        
        
        if ( isset( $_POST['wcu_select_coupon_user'] ) ) {
            $wcu_select_coupon_user = sanitize_text_field( $_POST['wcu_select_coupon_user'] );
        } else {
            $wcu_select_coupon_user = "";
        }
        
        // Updates coupon user if selected
        update_post_meta( $post_id, 'wcu_select_coupon_user', $wcu_select_coupon_user );
        // Check & update just incase they enter username but didn't select from dropdown. Only runs if no existing user selected.
        $wcu_select_coupon_user_old = get_post_meta( $post_id, 'wcu_select_coupon_user', true );
        
        if ( !$wcu_select_coupon_user_old && $wcu_select_coupon_user_visual && !$wcu_select_coupon_user ) {
            $save_user = get_user_by( 'login', $wcu_select_coupon_user_visual );
            
            if ( $save_user ) {
                $save_user_id = $save_user->ID;
                update_post_meta( $post_id, 'wcu_select_coupon_user', $save_user_id );
            }
        
        }
        
        
        if ( isset( $_POST['wcu_text_coupon_start_date'] ) ) {
            $wcu_text_coupon_start_date = sanitize_text_field( $_POST['wcu_text_coupon_start_date'] );
            update_post_meta( $post_id, 'wcu_text_coupon_start_date', $wcu_text_coupon_start_date );
        }
        
        $first_order_only = ( isset( $_POST['wcu_enable_first_order_only'] ) ? 'yes' : 'no' );
        update_post_meta( $post_id, 'wcu_enable_first_order_only', $first_order_only );
    }

}
add_action( 'woocommerce_coupon_options_save', 'wcusage_save_coupon_settings' );
/**
 * Function to check if coupon is users
 *
 * @param string $coupon
 * @param int $current_user_id
 *
 * @return bool
 *
 */
if ( !function_exists( 'wcusage_iscouponusers' ) ) {
    function wcusage_iscouponusers( $coupon, $current_user_id )
    {
        $args = array(
            'post_type'      => 'shop_coupon',
            'posts_per_page' => -1,
            'meta_key'       => 'wcu_select_coupon_user',
            'meta_value'     => $current_user_id,
        );
        $options = get_option( 'wcusage_options' );
        $obituary_query = new WP_Query( $args );
        $urlid = "";
        //$singlecoupon = strtolower($atts['coupon']);
        while ( $obituary_query->have_posts() ) {
            $obituary_query->the_post();
            $postid = get_the_ID();
            $wcu_select_coupon_user = get_post_meta( $postid, 'wcu_select_coupon_user', true );
            $thiscoupon = get_the_title();
            if ( $current_user_id == $wcu_select_coupon_user ) {
                if ( $coupon == $thiscoupon ) {
                    return true;
                }
            }
        }
        return false;
    }

}
/**
 * Get IDs of all coupons assigned to user
 *
 * @param int $user_id
 *
 * @return array
 *
 */
if ( !function_exists( 'wcusage_get_users_coupons_ids' ) ) {
    function wcusage_get_users_coupons_ids( $user_id )
    {
        $args = array(
            'post_type'      => 'shop_coupon',
            'posts_per_page' => -1,
            'meta_key'       => 'wcu_select_coupon_user',
            'meta_value'     => $user_id,
        );
        $obituary_query = new WP_Query( $args );
        $post_ids = array();
        while ( $obituary_query->have_posts() ) {
            $obituary_query->the_post();
            $post_ids[] = get_the_ID();
        }
        return $post_ids;
    }

}
/**
 * Get IDs of all coupons assigned to user by name
 *
 * @param int $user_id
 *
 * @return array
 *
 */
if ( !function_exists( 'wcusage_get_users_coupons_names' ) ) {
    function wcusage_get_users_coupons_names( $user_id )
    {
        $args = array(
            'post_type'      => 'shop_coupon',
            'posts_per_page' => -1,
            'meta_key'       => 'wcu_select_coupon_user',
            'meta_value'     => $user_id,
        );
        $obituary_query = new WP_Query( $args );
        $coupons = array();
        while ( $obituary_query->have_posts() ) {
            $obituary_query->the_post();
            $coupon = get_the_title( get_the_ID() );
            $coupons[] = $coupon;
        }
        return $coupons;
    }

}
/**
 * Function to output the list of coupons assigned to user, on the affiliate dashboard, if they are assigned to multiple coupons
 *
 */
if ( !function_exists( 'wcusage_getUserCouponList' ) ) {
    function wcusage_getUserCouponList()
    {
        ob_start();
        $translate = wcusage_translate();
        $current_user = wp_get_current_user();
        $current_user_id = $current_user->ID;
        $args = array(
            'post_type'      => 'shop_coupon',
            'posts_per_page' => -1,
            'meta_key'       => 'wcu_select_coupon_user',
            'meta_value'     => $current_user_id,
        );
        $options = get_option( 'wcusage_options' );
        $obituary_query = new WP_Query( $args );
        $numcoupons = $obituary_query->post_count;
        $urlid = "";
        if ( is_array( $obituary_query ) ) {
            $countamount = count( $obituary_query );
        }
        $wcusage_justcoupon = wcusage_get_setting_value( 'wcusage_field_justcoupon', '1' );
        $wcusage_registration_enable = wcusage_get_setting_value( 'wcusage_field_registration_enable', '1' );
        $wcusage_loginform = wcusage_get_setting_value( 'wcusage_field_loginform', '1' );
        $wcusage_registration_enable_login = wcusage_get_setting_value( 'wcusage_field_registration_enable_login', '1' );
        $wcusage_registration_enable_logout = wcusage_get_setting_value( 'wcusage_field_registration_enable_logout', '1' );
        $wcusage_show_coupon_if_single = wcusage_get_setting_value( 'wcusage_field_show_coupon_if_single', '1' );
        $wcusage_field_form_style = wcusage_get_setting_value( 'wcusage_field_form_style', '1' );
        $wcusage_field_form_style_columns = wcusage_get_setting_value( 'wcusage_field_form_style_columns', '0' );
        if ( isset( $_GET['couponid'] ) ) {
            $urlid = $_GET['couponid'];
        }
        
        if ( $urlid ) {
            echo  do_shortcode( '[couponaffiliates coupon="' . $urlid . '"]' ) ;
        } else {
            ?>

  		<h3 class="wcu-user-coupon-title"><?php 
            echo  $translate['wcusage_field_tr_your_coupons'] ;
            ?> (<?php 
            echo  $numcoupons ;
            ?>)</h3>
  		<hr class="wcu-user-coupon-linebreak" />

      <?php 
            
            if ( !is_user_logged_in() ) {
                // Get Login Form
                
                if ( $wcusage_loginform ) {
                    ob_start();
                    ?>
          <style>.wcu-user-coupon-title { display: none; }</style>

          <?php 
                    ?>

          <div class="wcu-form-section">

            <p class="wcusage-login-form-title" style="font-size: 1.2em;"><strong><?php 
                    echo  __( 'Login', 'woo-coupon-usage' ) ;
                    ?>:</strong></p>

            <div class="wcusage-login-form-section">
            <?php 
                    if ( function_exists( 'wc_print_notices' ) ) {
                        woocommerce_output_all_notices();
                    }
                    if ( function_exists( 'woocommerce_login_form' ) ) {
                        woocommerce_login_form();
                    }
                    ?>
            </div>

          </div>

          <?php 
                    if ( $wcusage_registration_enable && $wcusage_registration_enable_login && $wcusage_registration_enable_logout && wcu_fs()->can_use_premium_code() ) {
                        ?>
          </div>
          <?php 
                    }
                    ?>

          <?php 
                    ?>

          <?php 
                    return ob_get_clean();
                } else {
                    echo  __( "No affiliate dashboard found. Please contact us for your unique affiliate dashboard URL.", "woo-coupon-usage" ) ;
                    if ( current_user_can( 'administrator' ) ) {
                        echo  "<br/><br/><strong>Admin message:</strong><br/>To get started, go to the '<strong><a href='/wp-admin/edit.php?post_type=shop_coupon'>coupons list</a></strong>' in your dashboard, where you can find a list of the affiliate dashboard URLs." ;
                    }
                }
            
            } else {
                if ( !$numcoupons ) {
                    echo  __( "Sorry, you don't currently have any active affiliate coupons.", "woo-coupon-usage" ) ;
                }
                $countcoupons = 0;
                $countcouponsloop = 0;
                $lastcoupon = "";
                while ( $obituary_query->have_posts() ) {
                    $obituary_query->the_post();
                    $postid = get_the_ID();
                    $coupon = get_the_title();
                    $secretid = $coupon . "-" . $postid;
                    $uniqueurl = wcusage_get_coupon_shortcode_page( 1 ) . 'couponid=' . $secretid;
                    
                    if ( $numcoupons <= 1 && $wcusage_show_coupon_if_single ) {
                        
                        if ( wcusage_iscouponusers( $coupon, $current_user_id ) && $lastcoupon != $coupon ) {
                            $coupon = str_replace( ' ', '%20', $coupon );
                            // Fix spaces
                            echo  do_shortcode( "[couponaffiliates coupon=" . $coupon . "]" ) ;
                            echo  "<style>.admin-only-list-coupons, .wcu-user-coupon-title, .wcu-user-coupon-linebreak { display: none; }</style>" ;
                        }
                        
                        $lastcoupon = $coupon;
                    } else {
                        $select_coupon_user = get_post_meta( $postid, 'wcu_select_coupon_user', true );
                        //echo $current_user_id . " - " . $select_coupon_user . "<br/>";
                        
                        if ( get_the_title() ) {
                            $countcoupons++;
                            $countcouponsloop++;
                            if ( $countcouponsloop == 1 ) {
                                echo  "<div class='wcu-user-coupon-list-group'>" ;
                            }
                            echo  "<div class='wcu-user-coupon-list'>" ;
                            echo  "<h3>" . get_the_title() . "</h3>" ;
                            $amount = get_post_meta( $postid, 'coupon_amount', true );
                            $discount_type = get_post_meta( $postid, 'discount_type', true );
                            $combined_commission = wcusage_commission_message( $postid );
                            
                            if ( $discount_type == "percent" ) {
                                $discount_msg = $amount . "%";
                            } elseif ( $discount_type == "recurring_percent" ) {
                                $discount_msg = $amount . "% (" . __( 'Recurring', 'woo-coupon-usage' ) . ")";
                            } elseif ( $discount_type == "fixed_cart" ) {
                                $discount_msg = wcusage_get_currency_symbol() . $amount;
                            } else {
                                $discount_msg = $amount . " (" . $discount_type . ")";
                            }
                            
                            echo  '<p>' . $translate['wcusage_field_tr_discount'] . ': ' . $discount_msg . '</p>' ;
                            //$orders = wcusage_wh_getOrderbyCouponCode( get_the_title(), '0000-00-00', date( "Y-m-d" ), '', 1 );
                            //$usage = $orders['total_count'];
                            global  $woocommerce ;
                            $c = new WC_Coupon( get_the_title() );
                            $usage = $c->get_usage_count();
                            if ( $usage === "" ) {
                                $usage = '0';
                            }
                            echo  '<p >' . $translate['wcusage_field_tr_usage'] . ': ' . $usage . '</p>' ;
                            echo  '<p>' . $translate['wcusage_field_tr_commission'] . ': ' . $combined_commission . '</p>' ;
                            $usage = get_post_meta( $postid, 'usage_count', true );
                            echo  '<p style="margin: 0 0 10px 0;"><a class="wcu-coupon-list-button" href="' . $uniqueurl . '">' . __( 'Dashboard', 'woo-coupon-usage' ) . ' <i class="far fa-arrow-alt-circle-right"></i></a></p>' ;
                            echo  "</div>" ;
                            
                            if ( $countcouponsloop == 3 ) {
                                echo  "</div>" ;
                                $countcouponsloop = 0;
                            }
                        
                        }
                    
                    }
                
                }
                if ( $countcouponsloop != 3 ) {
                    echo  "</div>" ;
                }
            }
            
            echo  "<div style='clear: both;'></div>" ;
        }
        
        $thecontent = ob_get_contents();
        ob_end_clean();
        wp_reset_postdata();
        return $thecontent;
    }

}
add_shortcode( 'couponusage-user', 'wcusage_getUserCouponList' );
add_shortcode( 'couponaffiliates-user', 'wcusage_getUserCouponList' );
add_action(
    'wcusage_hook_getUserCouponList',
    'wcusage_getUserCouponList',
    10,
    0
);
/**
 * Adds meta box to coupon page.
 *
 */
if ( !function_exists( 'wcusage_add_coupon_meta_box' ) ) {
    function wcusage_add_coupon_meta_box()
    {
        add_meta_box(
            "wcusage-meta-box",
            "Coupon Affiliates",
            "wcusage_coupon_meta_box_markup",
            "shop_coupon",
            "side",
            "low",
            null
        );
    }

}
add_action( "add_meta_boxes", "wcusage_add_coupon_meta_box" );
/**
 * Content for meta box on coupons page.
 *
 */
if ( !function_exists( 'wcusage_coupon_meta_box_markup' ) ) {
    function wcusage_coupon_meta_box_markup()
    {
        
        if ( isset( $_GET['post'] ) ) {
            $post_id = $_GET['post'];
            $coupon_info = wcusage_get_coupon_info_by_id( $post_id );
            $uniqueurl = $coupon_info[4];
            $coupon_user_id = $coupon_info[1];
            if ( isset( $_GET['refreshstats'] ) ) {
                
                if ( $_GET['refreshstats'] ) {
                    ?>
					<div class="notice notice-success is-dismissible">
			        <p><?php 
                    echo  sprintf( __( 'Done! The affiliate statistics for this coupon will be refreshed the next time the <a href="%s">affiliate dashboard</a> is loaded.', 'woo-coupon-usage' ), $uniqueurl ) ;
                    ?></p>
			    </div>
					<?php 
                    delete_post_meta( $post_id, 'wcu_last_refreshed' );
                }
            
            }
            
            if ( $coupon_user_id ) {
                $user_info = get_userdata( $coupon_user_id );
                $coupon_user = $user_info->user_login;
            } else {
                $coupon_user = "N/A";
            }
            
            ?>

      <p style="margin-top: 20px;"><a href="<?php 
            echo  $uniqueurl ;
            ?>" target="_blank" class="page-title-action" style="margin: 0;">View Dashboard <span class="dashicons dashicons-external"></span></a></p>

      <p>Affiliate User: <?php 
            echo  $coupon_user ;
            ?></p>

			<a href="#" class=""
			onclick="if (confirm('Are you sure you want to refresh all this coupons affiliate dashboard data? The next time you visit the affiliate dashboard, it may take significantly longer to load (first visit).')){location+='&refreshstats=true'}else{event.stopPropagation(); event.preventDefault();};">
			REFRESH ALL DATA <i class="fas fa-sync" style="background: transparent; margin: 0;"></i>
			</a>

    <?php 
        }
    
    }

}
/**
 * Unlink user from coupon
 *
 */
if ( !function_exists( 'wcusage_coupon_affiliate_unlink' ) ) {
    function wcusage_coupon_affiliate_unlink( $coupon )
    {
        update_post_meta( $coupon, 'wcu_select_coupon_user', '' );
    }

}
add_filter(
    'wcusage_hook_coupon_affiliate_unlink',
    'wcusage_coupon_affiliate_unlink',
    10,
    1
);