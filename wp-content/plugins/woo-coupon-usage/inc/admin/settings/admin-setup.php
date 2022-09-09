<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Displays setup page.
 *
 */
function wcusage_setup_page_html() {
  // check user capabilities
  if ( ! wcusage_check_admin_access() ) {
  return;
  }

  do_action('wcusage_hook_setup_page_update'); // Update on Post

  $options = get_option( 'wcusage_options' );

  $step = $_GET['step'];
  ?>

  <style>
  .wp-admin #wpcontent .notice, .wp-admin #wpcontent .updated, .wp-admin #wpcontent .success {
    display: none !important;
  }
  </style>

  <link rel="stylesheet" href="<?php echo WCUSAGE_UNIQUE_PLUGIN_URL .'fonts/font-awesome/css/all.min.css'; ?>" crossorigin="anonymous">

  <div class="wrap plugin-setup-settings">

    <center>

      <a href="https://couponaffiliates.com" target="_blank">
        <img src="<?php echo WCUSAGE_UNIQUE_PLUGIN_URL; ?>images/coupon-affiliates-logo.png"
        style="display: inline-block; width: 100%; max-width: 290px; text-align: left; margin: 25px 0 10px 0;">
      </a>

    </center>

    <div class="bar-container">
      <ul class="progressbar">
        <li class="<?php if(!$step || $step >= "1") { ?>active<?php } ?><?php if(!$step || $step == "1") { ?> current<?php } ?>">
          <a href="<?php echo get_admin_url(); ?>admin.php?page=wcusage_setup&step=1"><?php echo __('Dashboard', 'woo-coupon-usage'); ?></a>
        </li>
        <li class="<?php if($step >= "2") { ?>active<?php } ?><?php if($step == "2") { ?> current<?php } ?>">
          <a href="<?php echo get_admin_url(); ?>admin.php?page=wcusage_setup&step=2"><?php echo __('Commission', 'woo-coupon-usage'); ?></a>
        </li>
        <li class="<?php if($step >= "3") { ?>active<?php } ?><?php if($step == "3") { ?> current<?php } ?>">
          <a href="<?php echo get_admin_url(); ?>admin.php?page=wcusage_setup&step=3"><?php echo __('Calculations', 'woo-coupon-usage'); ?></a>
        </li>
        <li class="<?php if($step >= "4") { ?>active<?php } ?><?php if($step == "4") { ?> current<?php } ?>">
          <a href="<?php echo get_admin_url(); ?>admin.php?page=wcusage_setup&step=4"><?php echo __('Orders', 'woo-coupon-usage'); ?></a>
        </li>
        <li class="<?php if($step >= "5") { ?>active<?php } ?><?php if($step == "5") { ?> current<?php } ?>">
          <a href="<?php echo get_admin_url(); ?>admin.php?page=wcusage_setup&step=5"><?php echo __('Emails', 'woo-coupon-usage'); ?></a>
        </li>
        <li class="<?php if($step >= "6") { ?>active<?php } ?><?php if($step == "6") { ?> current<?php } ?>">
          <a href="<?php echo get_admin_url(); ?>admin.php?page=wcusage_setup&step=6"><?php echo __('Style', 'woo-coupon-usage'); ?></a>
        </li>
        <li class="<?php if($step >= "7") { ?>active<?php } ?><?php if($step == "7") { ?> current<?php } ?>">
          <a href="<?php echo get_admin_url(); ?>admin.php?page=wcusage_setup&step=7"><?php echo __('Finish', 'woo-coupon-usage'); ?></a>
        </li>
      </ul>
    </div>

    <div class="wcusage_row wcusage-settings-form" style="width: 100%;">
      <div style="display: block; width: 800px; max-width: calc(100% - 50px); margin: 20px auto; padding: 15px 25px; background: #FFF; border: 2px solid #e3e3e3; border-radius: 10px;">

        <!-- Step 1 -->

        <?php if(!$step || $step == "1") { ?>

          <p style="font-size: 20px;">
            <strong><?php echo __('Welcome to the Coupon Affiliates setup wizard!', 'woo-coupon-usage'); ?></strong>
          </p>

          <p>
            <?php echo __('We are going to run you through some of the most important settings in the Coupon Affiliates plugin, to help you get everything setup!', 'woo-coupon-usage'); ?>
            <strong><?php echo sprintf( __('You will be able to customise more options in the <a href="%s">settings page</a> later.', 'woo-coupon-usage'), get_admin_url() . 'admin.php?page=wcusage_settings'); ?></strong>
            <strong><?php echo __('Lets get started...', 'woo-coupon-usage'); ?></strong>
          </p>

          <hr style="margin: 20px 0;" />

          <h3><span class="dashicons dashicons-admin-generic"></span> Dashboard:</h3>

          <p>
            <?php echo __('Firstly, we need to create the main affiliate dashboard page on your website.', 'woo-coupon-usage'); ?>
          </p>

          <p>
            <?php echo sprintf( __('Simply add the %s shortcode to a new page, then select the page from the dropdown below.', 'woo-coupon-usage'), '[couponaffiliates]'); ?>
          </p>

          <?php
          $coupon_shortcode_page = wcusage_get_coupon_shortcode_page('0');
          if(!$coupon_shortcode_page) {
            ?>
            <p>
                <?php echo __('Or you can click the button below to automatically generate the page for you:', 'woo-coupon-usage'); ?>
            </p>
            <?php
            do_action('wcusage_hook_getting_started_create');
            if(!isset( $_POST['submitnewpage2'] )) {
              do_action('wcusage_hook_getting_started3');
            }
          } else {
            echo "<br/>";
          }
          ?>

          <form action="<?php echo get_admin_url(); ?>admin.php?page=wcusage_setup&step=2" method="post">

            <?php echo do_action( 'wcusage_hook_setting_section_dashboard_page' ); ?>

            <hr style="margin: 25px 0;" />

            <button type="submit" name="submit_step1" id="submit_step1" class="button button-primary"
            style="padding: 5px 20px; margin-bottom: 20px; font-size: 15px;"><?php echo __('Save & Continue', 'woo-coupon-usage'); ?> <span class="fa-solid fa-circle-arrow-right"></span></button>

          </form>

        <?php } // End Step 1 ?>

        <!-- Step 2 -->
        <?php if($step == "2") { ?>

          <form action="<?php echo get_admin_url(); ?>admin.php?page=wcusage_setup&step=3" method="post">

            <!-- Commission -->
            <h3><span class="dashicons dashicons-admin-generic"></span> <?php echo __( 'Commission Amounts', 'woo-coupon-usage' ); ?>:</h3>
            <?php echo do_action( 'wcusage_hook_setting_section_commission_amounts' ); ?>

            <br/>
            <hr style="margin: 25px 0 25px 0;" />

            <button type="submit" name="submit_step2" id="submit_step2" class="button button-primary"
            style="padding: 5px 20px; margin-bottom: 20px; font-size: 15px;"><?php echo __('Save & Continue', 'woo-coupon-usage'); ?> <span class="fa-solid fa-circle-arrow-right"></span></button>

          </form>

        <?php } // End Step 2 ?>

        <!-- Step 3 -->
        <?php if($step == "3") { ?>

          <form action="<?php echo get_admin_url(); ?>admin.php?page=wcusage_setup&step=4" method="post">

            <!-- Calculations -->
            <h3><span class="dashicons dashicons-admin-generic"></span> <?php echo __( 'Calculation Settings', 'woo-coupon-usage' ); ?>:</h3>

            <?php echo do_action( 'wcusage_hook_setting_section_calculations' ); ?>

            <hr style="margin: 25px 0 25px 0;" />

            <!-- Tax -->
            <h3><span class="dashicons dashicons-admin-generic"></span> <?php echo __( 'Tax Settings', 'woo-coupon-usage' ); ?>:</h3>

            <?php echo do_action( 'wcusage_hook_setting_section_tax' ); ?>

            <br/>
            <hr style="margin: 25px 0 25px 0;" />

            <button type="submit" name="submit_step3" id="submit_step3" class="button button-primary"
            style="padding: 5px 20px; margin-bottom: 20px; font-size: 15px;"><?php echo __('Save & Continue', 'woo-coupon-usage'); ?> <span class="fa-solid fa-circle-arrow-right"></span></button>

          </form>

        <?php } // End Step 3 ?>

        <!-- Step 4 -->
        <?php if($step == "4") { ?>

          <form action="<?php echo get_admin_url(); ?>admin.php?page=wcusage_setup&step=5" method="post">

            <!-- Order/Sales Tracking -->
            <h3><span class="dashicons dashicons-admin-generic"></span> <?php echo __('Order/Sales Tracking', 'woo-coupon-usage'); ?>:</h3>
            <?php echo do_action('wcusage_hook_setting_section_ordersalestracking', '1'); ?>

            <br/>

            <hr style="margin: 10px 0 25px 0;" />

            <button type="submit" name="submit_step4" id="submit_step4" class="button button-primary"
            style="padding: 5px 20px; margin-bottom: 20px; font-size: 15px;"><?php echo __('Save & Continue', 'woo-coupon-usage'); ?> <span class="fa-solid fa-circle-arrow-right"></span></button>

          </form>

        <?php } // End Step 4 ?>

        <!-- Step 5 -->
        <?php if($step == "5") { ?>

          <form action="<?php echo get_admin_url(); ?>admin.php?page=wcusage_setup&step=6" method="post">

            <!-- General Email Settings & Free Email Settings -->
            <h3><span class="dashicons dashicons-admin-generic"></span> <?php echo __('General Email Settings', 'woo-coupon-usage'); ?>:</h3>
            <?php echo do_action('wcusage_hook_setting_section_email_free'); ?>

            <hr style="margin: 25px 0 25px 0;" />

            <button type="submit" name="submit_step5" id="submit_step5" class="button button-primary"
            style="padding: 5px 20px; margin-bottom: 20px; font-size: 15px;"><?php echo __('Save & Continue', 'woo-coupon-usage'); ?> <span class="fa-solid fa-circle-arrow-right"></span></button>

          </form>

        <?php } // End Step 4 ?>

        <!-- Step 6 -->
        <?php if($step == "6") { ?>

          <form action="<?php echo get_admin_url(); ?>admin.php?page=wcusage_setup&step=7" method="post">

          <h1 style="margin-top: -5px; margin-bottom: 5px;"><?php echo __( 'Colours', 'woo-coupon-usage' ); ?></h1>

          <p style="margin-top: -5px; margin-bottom: 25px;"><?php echo __('Change the colours used on your affiliate dashboard to match your branding.', 'woo-coupon-usage'); ?></p>

          <?php echo do_action('wcusage_hook_setting_section_colours'); ?>

          <div style="clear: both;"></div>

          <hr style="margin: 0 0 25px 0;" />

          <button type="submit" name="submit_step6" id="submit_step6" class="button button-primary"
          style="padding: 5px 20px; margin-bottom: 20px; font-size: 15px;"><?php echo __('Save & Continue', 'woo-coupon-usage'); ?> <span class="fa-solid fa-circle-arrow-right"></span></button>

        </form>

      <?php } // End Step 6 ?>

        <!-- Step 7 -->
        <?php if($step == "7") { ?>

          <h1><?php echo __('Setup Wizard Complete!', 'woo-coupon-usage'); ?></h1>

          <p>- <?php echo sprintf( __('Visit the <a href="%s">settings page</a> to edit more options, and customise your affiliate program to work exactly how you want!', 'woo-coupon-usage'), get_admin_url() . 'admin.php?page=wcusage_settings'); ?></p>

          <p>- <?php echo sprintf( __('View all coupons, and links to each of their dashboards on the <a href="%s" target="_blank">coupons list</a> page.', 'woo-coupon-usage'), '/wp-admin/edit.php?post_type=shop_coupon'); ?></p>

          <p>- <?php echo sprintf( __('Assign users to coupons by going to the <a href="%s" target="_blank">coupons list</a> page, edit a coupon, and go to the "coupon affiliates" tab. You can then link them directly to the affiliate dashboard page for them to track statistics, generate referral URLs, and more!', 'woo-coupon-usage'), '/wp-admin/edit.php?post_type=shop_coupon'); ?></p>

          <p>- <?php echo sprintf( __('If you are interested in enabling more advanced features, such as an affiliate registration system, managed payouts, multi-level affiliates, creatives, email reports, and lots more, then visit the <a href="%s">PRO modules section</a>.', 'woo-coupon-usage'), '/wp-admin/admin.php?page=wcusage_settings&section=tab-pro-details'); ?></p>

          <p><strong>- <?php echo __('Need help?', 'woo-coupon-usage'); ?> <?php if ( wcu_fs()->can_use_premium_code() ) { ?><a href="<?php echo get_admin_url(); ?>admin.php?page=wcusage-contact" target="_blank"><?php } else { ?><a href="https://wordpress.org/support/plugin/woo-coupon-usage/#new-topic-0" target="_blank" style="text-decoration: none;"><?php } ?><?php echo __('Create a new support ticket', 'woo-coupon-usage'); ?></a>.</strong><br/></p>

          <br/>

          <a href="<?php echo get_admin_url(); ?>admin.php?page=wcusage_settings">
            <button type="submit"class="button button-primary" style="padding: 5px 20px; font-size: 15px;">
              <?php echo __('Continue to Settings Page', 'woo-coupon-usage'); ?> <span class="fa-solid fa-circle-arrow-right"></span>
            </button>
          </a>

          <hr style="margin: 25px 0 10px 0;" />

          <h1><?php echo __('How To Get Started', 'woo-coupon-usage'); ?>:</h1>

          <p style="margin: 0 0 10px 0;"><?php echo __('Here is a video guide explaining how to get started with the plugin', 'woo-coupon-usage'); ?>:</p>

          <div style="padding:56.25% 0 0 0;position:relative;"><iframe src="https://player.vimeo.com/video/709270929?h=9ad67fcaad&amp;badge=0&amp;autopause=0&amp;player_id=0&amp;app_id=58479" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen style="position:absolute;top:0;left:0;width:100%;height:100%;" title="Coupon Affiliates - Setup Guide 2 - Short Version"></iframe></div><script src="https://player.vimeo.com/api/player.js"></script>

          <br/>

          <a href="<?php echo get_admin_url(); ?>admin.php?page=wcusage_settings">
            <button type="submit"class="button button-primary" style="padding: 5px 20px; font-size: 15px;">
              Continue to Settings Page <span class="fa-solid fa-circle-arrow-right"></span>
            </button>
          </a>

          <?php if( wcu_fs()->is_free_plan() ) { ?>

          <hr style="margin: 25px 0 15px 0;" />

            <h1><?php echo __('Want more advanced features?', 'woo-coupon-usage'); ?></h1>

            <a href="<?php echo get_admin_url(); ?>admin.php?page=wcusage-pricing">
              <button type="submit"class="button button-primary" style="background: #40965d; border: 1px solid #333; padding: 5px 20px; font-size: 15px; margin-top: 10px;">
                <?php echo __('Upgrade to Pro', 'woo-coupon-usage'); ?> <span class="fa-solid fa-circle-arrow-right"></span>
              </button>
            </a>

          <?php } ?>

          <br/><br/>

        <?php } // End Step 7 ?>

      </div>
    </div>

    <br/>

    <p style="text-align: center; font-size: 12px;"><?php echo __('Note: There are lots more options available in the settings page.', 'woo-coupon-usage'); ?></p>

    <p style="text-align: center; font-weight: bold;">
      <a href="<?php echo get_admin_url(); ?>admin.php?page=wcusage_settings" style="font-size: 15px; text-decoration: none;"><?php echo __('Skip Setup Wizard / Go To Settings Page', 'woo-coupon-usage'); ?> <span class="fa-solid fa-circle-arrow-right"></span></a>
    </p>

    <br/>

  </div>

  <?php
}

/**
 * Updates setup page options on each step.
 *
 */
add_action( 'wcusage_hook_setup_page_update', 'wcusage_setup_page_update' );
function wcusage_setup_page_update() {

  // check user capabilities
  if ( ! wcusage_check_admin_access() ) {
  return;
  }

  $option_group = get_option('wcusage_options');

  // 1
  if( isset( $_POST['submit_step1'] ) ) {

    if( isset( $_POST['wcusage_options']['wcusage_dashboard_page'] ) ) {
      $option_group['wcusage_dashboard_page'] = sanitize_text_field( $_POST['wcusage_options']['wcusage_dashboard_page'] );
    }

  }

  // 2
  if( isset( $_POST['submit_step2'] ) ) {

    // Refresh Data?
    $refresh_data = 0;

    $wcusage_field_affiliate = wcusage_get_setting_value('wcusage_field_affiliate', '');
      if($wcusage_field_affiliate != $_POST['wcusage_options']['wcusage_field_affiliate']) { $refresh_data = 1; }

    $wcusage_field_affiliate_fixed_order = wcusage_get_setting_value('wcusage_field_affiliate_fixed_order', '0');
      if($wcusage_field_affiliate_fixed_order != $_POST['wcusage_options']['wcusage_field_affiliate_fixed_order']) { $refresh_data = 1; }

    $wcusage_field_affiliate_fixed_product = wcusage_get_setting_value('wcusage_field_affiliate_fixed_product', '0');
      if($wcusage_field_affiliate_fixed_product != $_POST['wcusage_options']['wcusage_field_affiliate_fixed_product']) { $refresh_data = 1; }

    if($refresh_data) {
      $option_group['wcusage_refresh_date'] = time();
    }

    // Update Options
    if( isset( $_POST['wcusage_options']['wcusage_field_affiliate'] ) ) {
      $option_group['wcusage_field_affiliate'] = sanitize_text_field( $_POST['wcusage_options']['wcusage_field_affiliate'] );
    }

    if( isset( $_POST['wcusage_options']['wcusage_field_affiliate_fixed_order'] ) ) {
      $option_group['wcusage_field_affiliate_fixed_order'] = sanitize_text_field( $_POST['wcusage_options']['wcusage_field_affiliate_fixed_order'] );
    }

    if( isset( $_POST['wcusage_options']['wcusage_field_affiliate_fixed_product'] ) ) {
      $option_group['wcusage_field_affiliate_fixed_product'] = sanitize_text_field( $_POST['wcusage_options']['wcusage_field_affiliate_fixed_product'] );
    }

    if( isset( $_POST['wcusage_options']['wcusage_field_affiliate_custom_message'] ) ) {
      $option_group['wcusage_field_affiliate_custom_message'] = sanitize_text_field( $_POST['wcusage_options']['wcusage_field_affiliate_custom_message'] );
    }

  }

  // 3
  if( isset( $_POST['submit_step3'] ) ) {

    if( isset( $_POST['wcusage_options']['wcusage_field_commission_before_discount'] ) ) {
      $option_group['wcusage_field_commission_before_discount'] = sanitize_text_field( $_POST['wcusage_options']['wcusage_field_commission_before_discount'] );
    }

    if( isset( $_POST['wcusage_options']['wcusage_field_commission_include_shipping'] ) ) {
      $option_group['wcusage_field_commission_include_shipping'] = sanitize_text_field( $_POST['wcusage_options']['wcusage_field_commission_include_shipping'] );
    }

    if( isset( $_POST['wcusage_options']['wcusage_field_commission_before_discount_custom'] ) ) {
      $option_group['wcusage_field_commission_before_discount_custom'] = sanitize_text_field( $_POST['wcusage_options']['wcusage_field_commission_before_discount_custom'] );
    }

    if( isset( $_POST['wcusage_options']['wcusage_field_commission_include_fees'] ) ) {
      $option_group['wcusage_field_commission_include_fees'] = sanitize_text_field( $_POST['wcusage_options']['wcusage_field_commission_include_fees'] );
    }

    if( isset( $_POST['wcusage_options']['wcusage_field_show_tax'] ) ) {
      $option_group['wcusage_field_show_tax'] = sanitize_text_field( $_POST['wcusage_options']['wcusage_field_show_tax'] );
    }

    if( isset( $_POST['wcusage_options']['wcusage_field_show_tax_fixed'] ) ) {
      $option_group['wcusage_field_show_tax_fixed'] = sanitize_text_field( $_POST['wcusage_options']['wcusage_field_show_tax_fixed'] );
    }

    if( isset( $_POST['wcusage_options']['wcusage_field_affiliate_deduct_percent'] ) ) {
      $option_group['wcusage_field_affiliate_deduct_percent'] = sanitize_text_field( $_POST['wcusage_options']['wcusage_field_affiliate_deduct_percent'] );
    }

  }

  // 4
  if( isset( $_POST['submit_step4'] ) ) {

    if( isset( $_POST['wcusage_options']['wcusage_field_orders'] ) ) {
      $option_group['wcusage_field_orders'] = sanitize_text_field( $_POST['wcusage_options']['wcusage_field_orders'] );
    }

    $orderstatuses = wc_get_order_statuses();
    $option_group['wcusage_field_order_type_custom'] = array();
    foreach( $orderstatuses as $key => $status ){
      if( isset( $_POST['wcusage_field_order_type_custom'][$key] ) ) {
        $option_group['wcusage_field_order_type_custom'][$key] = "1";
      }
    }

    if( isset( $_POST['wcusage_options']['wcusage_field_order_sort'] ) ) {
      $option_group['wcusage_field_order_sort'] = sanitize_text_field( $_POST['wcusage_options']['wcusage_field_order_sort'] );
    }

  }

  // 5
  if( isset( $_POST['submit_step5'] ) ) {

    if( isset( $_POST['wcusage_options']['wcusage_field_from_email'] ) ) {
      $option_group['wcusage_field_from_email'] = sanitize_text_field( $_POST['wcusage_options']['wcusage_field_from_email'] );
    }

    if( isset( $_POST['wcusage_options']['wcusage_field_from_name'] ) ) {
      $option_group['wcusage_field_from_name'] = sanitize_text_field( $_POST['wcusage_options']['wcusage_field_from_name'] );
    }

    if( isset( $_POST['wcusage_options']['wcusage_field_registration_admin_email'] ) ) {
      $option_group['wcusage_field_registration_admin_email'] = sanitize_text_field( $_POST['wcusage_options']['wcusage_field_registration_admin_email'] );
    }

    if( isset( $_POST['wcusage_options']['wcusage_field_email_enable'] ) ) {
      $option_group['wcusage_field_email_enable'] = $_POST['wcusage_options']['wcusage_field_email_enable'];
    }

    if( isset( $_POST['wcusage_options']['wcusage_field_email_subject'] ) ) {
      $option_group['wcusage_field_email_subject'] = sanitize_text_field( $_POST['wcusage_options']['wcusage_field_email_subject'] );
    }

    if( isset( $_POST['wcusage_options']['wcusage_field_email_message'] ) ) {
      $option_group['wcusage_field_email_message'] = html_entity_decode(stripslashes( $_POST['wcusage_options']['wcusage_field_email_message'] ));
    }

  }

  // 6
  if( isset( $_POST['submit_step6'] ) ) {

    if( isset( $_POST['wcusage_options']['wcusage_field_color_tab'] ) ) {
      $option_group['wcusage_field_color_tab'] = sanitize_text_field( $_POST['wcusage_options']['wcusage_field_color_tab'] );
    }

    if( isset( $_POST['wcusage_options']['wcusage_field_color_tab_font'] ) ) {
      $option_group['wcusage_field_color_tab_font'] = sanitize_text_field( $_POST['wcusage_options']['wcusage_field_color_tab_font'] );
    }

    if( isset( $_POST['wcusage_options']['wcusage_field_color_tab_hover'] ) ) {
      $option_group['wcusage_field_color_tab_hover'] = sanitize_text_field( $_POST['wcusage_options']['wcusage_field_color_tab_hover'] );
    }

    if( isset( $_POST['wcusage_options']['wcusage_field_color_tab_hover_font'] ) ) {
      $option_group['wcusage_field_color_tab_hover_font'] = sanitize_text_field( $_POST['wcusage_options']['wcusage_field_color_tab_hover_font'] );
    }

    if( isset( $_POST['wcusage_options']['wcusage_field_color_table'] ) ) {
      $option_group['wcusage_field_color_table'] = sanitize_text_field( $_POST['wcusage_options']['wcusage_field_color_table'] );
    }

    if( isset( $_POST['wcusage_options']['wcusage_field_color_table_font'] ) ) {
      $option_group['wcusage_field_color_table_font'] = sanitize_text_field( $_POST['wcusage_options']['wcusage_field_color_table_font'] );
    }

    if( isset( $_POST['wcusage_options']['wcusage_field_color_button'] ) ) {
      $option_group['wcusage_field_color_button'] = sanitize_text_field( $_POST['wcusage_options']['wcusage_field_color_button'] );
    }

    if( isset( $_POST['wcusage_options']['wcusage_field_color_button_font'] ) ) {
      $option_group['wcusage_field_color_button_font'] = sanitize_text_field( $_POST['wcusage_options']['wcusage_field_color_button_font'] );
    }

    if( isset( $_POST['wcusage_options']['wcusage_field_color_button_hover'] ) ) {
      $option_group['wcusage_field_color_button_hover'] = sanitize_text_field( $_POST['wcusage_options']['wcusage_field_color_button_hover'] );
    }

    if( isset( $_POST['wcusage_options']['wcusage_field_color_button_font_hover'] ) ) {
      $option_group['wcusage_field_color_button_font_hover'] = sanitize_text_field( $_POST['wcusage_options']['wcusage_field_color_button_font_hover'] );
    }

    if( isset( $_POST['wcusage_options']['wcusage_field_color_stats_icon'] ) ) {
      $option_group['wcusage_field_color_stats_icon'] = sanitize_text_field( $_POST['wcusage_options']['wcusage_field_color_stats_icon'] );
    }

    if( isset( $_POST['wcusage_options']['wcusage_field_color_line_graph'] ) ) {
      $option_group['wcusage_field_color_line_graph'] = sanitize_text_field( $_POST['wcusage_options']['wcusage_field_color_line_graph'] );
    }
  }

  update_option( 'wcusage_options', $option_group );

}
