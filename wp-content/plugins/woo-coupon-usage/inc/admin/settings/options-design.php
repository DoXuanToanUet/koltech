<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function wcusage_field_cb_design( $args )
{
    $options = get_option( 'wcusage_options' );
    ?>

	<div id="design-settings" class="settings-area">

	<h1><?php echo __( 'Design & Layout', 'woo-coupon-usage' ); ?></h1>

  <hr/>

  <!-- Enable boxed "Statistics" tab layout -->
  <?php echo wcusage_setting_toggle_option('wcusage_field_show_boxed', 1, __( 'Enable boxed "Statistics" tab layout (recommended).', 'woo-coupon-usage' ), '0px'); ?>

  <br/>

  <?php $wcusage_field_show_tabs = wcusage_get_setting_value('wcusage_field_show_tabs', '1');
  if(!$wcusage_field_show_tabs) { ?>
  <!-- Enable "tabbed" layout - Discontinued but option hidden if turned off -->
  <?php echo wcusage_setting_toggle_option('wcusage_field_show_tabs', 1, __( 'Enable "tabbed" layout (recommended).', 'woo-coupon-usage' ), '0px'); ?>
	<br/>
  <?php } ?>

  <!-- Show icons on affiliate dashboard tabs -->
  <?php echo wcusage_setting_toggle_option('wcusage_field_show_tabs_icons', 1, __( 'Show icons on the affiliate dashboard tabs.', 'woo-coupon-usage' ), '0px'); ?>

	<br/>

  <hr/>

  <h1 style="margin-top: -5px; margin-bottom: 20px;"><?php echo __( 'Colours', 'woo-coupon-usage' ); ?></h1>

  <?php echo do_action('wcusage_hook_setting_section_colours'); ?>

  <div style="clear: both;"></div>

  <hr/>

  <h3><span class="dashicons dashicons-admin-generic" style="margin-top: 2px;"></span> <?php echo __( 'Forms', 'woo-coupon-usage' ); ?></h3>

  <p>
		<?php $wcusage_field_form_style = wcusage_get_setting_value('wcusage_field_form_style', '1'); ?>
		<input type="hidden" value="0" id="wcusage_field_form_style" data-custom="custom" name="wcusage_options[wcusage_field_form_style]" >
		<strong><label for="scales"><?php echo __( 'Form Style', 'woo-coupon-usage' ); ?>:</label></strong><br/>
		<select name="wcusage_options[wcusage_field_form_style]" id="wcusage_field_form_style" class="wcusage_field_form_style">
      <option value="1" <?php if($wcusage_field_form_style == "1") { ?>selected<?php } ?>><?php echo __( 'Style #1 - Default', 'woo-coupon-usage' ); ?></option>
			<option value="2" <?php if($wcusage_field_form_style == "2") { ?>selected<?php } ?>><?php echo __( 'Style #2 - Modern (Bold)', 'woo-coupon-usage' ); ?></option>
      <option value="3" <?php if($wcusage_field_form_style == "3") { ?>selected<?php } ?>><?php echo __( 'Style #3 - Modern (Compact)', 'woo-coupon-usage' ); ?></option>
    </select>
  </p>

	</div>

 <?php
}

/**
 * Settings Section: Colours
 *
 */
add_action( 'wcusage_hook_setting_section_colours', 'wcusage_setting_section_colours', 10, 1 );
if( !function_exists( 'wcusage_setting_section_colours' ) ) {
  function wcusage_setting_section_colours() {

  $options = get_option( 'wcusage_options' );
  ?>

  <style>
  .wcusage-settings-style-colors {
      width: calc(50% - 20px);
      max-width: 290px;
      float: left;
      margin-right: 20px;
      margin-bottom: 40px;
  }
  .wcusage-settings-style-colors h3 {
    margin-top: 0;
    margin-bottom: 10px;
  }
  </style>

  <!-- Tabs -->
  <div class="wcusage-settings-style-colors">

    <h3><span class="dashicons dashicons-admin-generic" style="margin-top: 2px;"></span> <?php echo __( 'Tabs', 'woo-coupon-usage' ); ?></h3>

    <!-- Background -->
    <?php echo wcusage_setting_color_option('wcusage_field_color_tab', '#333333', __( 'Background', 'woo-coupon-usage' ), '0px'); ?>

    <!-- Text -->
    <?php echo wcusage_setting_color_option('wcusage_field_color_tab_font', '#ffffff', __( 'Text', 'woo-coupon-usage' ), '0px'); ?>

  </div>

  <!-- Tabs Hover -->
  <div class="wcusage-settings-style-colors">

    <h3><span class="dashicons dashicons-admin-generic" style="margin-top: 2px;"></span> <?php echo __( 'Tabs Hover', 'woo-coupon-usage' ); ?></h3>

    <!-- Background -->
    <?php echo wcusage_setting_color_option('wcusage_field_color_tab_hover', '#000000', __( 'Background', 'woo-coupon-usage' ), '0px'); ?>

    <!-- Text -->
    <?php echo wcusage_setting_color_option('wcusage_field_color_tab_hover_font', '#ffffff', __( 'Text', 'woo-coupon-usage' ), '0px'); ?>

  </div>

  <!-- Table Header & Footer -->
  <div class="wcusage-settings-style-colors">

    <h3><span class="dashicons dashicons-admin-generic" style="margin-top: 2px;"></span> <?php echo __( 'Table Header & Footer', 'woo-coupon-usage' ); ?></h3>

    <!-- Background -->
    <?php echo wcusage_setting_color_option('wcusage_field_color_table', '#333333', __( 'Background', 'woo-coupon-usage' ), '0px'); ?>

    <!-- Text -->
    <?php echo wcusage_setting_color_option('wcusage_field_color_table_font', '#ffffff', __( 'Text', 'woo-coupon-usage' ), '0px'); ?>

  </div>

  <!-- Buttons -->
  <div class="wcusage-settings-style-colors">

    <h3><span class="dashicons dashicons-admin-generic" style="margin-top: 2px;"></span> <?php echo __( 'Buttons', 'woo-coupon-usage' ); ?></h3>

    <!-- Background -->
    <?php echo wcusage_setting_color_option('wcusage_field_color_button', '#333333', __( 'Background', 'woo-coupon-usage' ), '0px'); ?>

    <!-- Text -->
    <?php echo wcusage_setting_color_option('wcusage_field_color_button_font', '#ffffff', __( 'Text', 'woo-coupon-usage' ), '0px'); ?>

  </div>

  <!-- Buttons Hover -->
  <div class="wcusage-settings-style-colors">

    <h3><span class="dashicons dashicons-admin-generic" style="margin-top: 2px;"></span> <?php echo __( 'Buttons Hover', 'woo-coupon-usage' ); ?></h3>

    <!-- Background -->
    <?php echo wcusage_setting_color_option('wcusage_field_color_button_hover', '#131313', __( 'Background', 'woo-coupon-usage' ), '0px'); ?>

    <!-- Text -->
    <?php echo wcusage_setting_color_option('wcusage_field_color_button_font_hover', '#ffffff', __( 'Text', 'woo-coupon-usage' ), '0px'); ?>

  </div>

  <!-- Stats Icons -->
  <div class="wcusage-settings-style-colors">

    <h3><span class="dashicons dashicons-admin-generic" style="margin-top: 2px;"></span> <?php echo __( 'Stats Icons', 'woo-coupon-usage' ); ?></h3>

    <!-- Main -->
    <?php echo wcusage_setting_color_option('wcusage_field_color_stats_icon', '#bebebe', '', '0px'); ?>

  </div>

  <?php if( !wcu_fs()->is_free_plan() ) { ?>
  <!-- Line Graph -->
  <div class="wcusage-settings-style-colors">

    <span <?php if( !wcu_fs()->can_use_premium_code() ) { ?>style="opacity: 0.4 !important; display: block; pointer-events: none;" class="wcu-settings-pro-only"<?php } ?>>

      <h3><span class="dashicons dashicons-admin-generic" style="margin-top: 2px;"></span> <?php echo __( 'Line Graph', 'woo-coupon-usage' ); ?> (PRO)</h3>

      <!-- Main -->
      <?php echo wcusage_setting_color_option('wcusage_field_color_line_graph', '#008000', '', '0px'); ?>

    </span>

  </div>
  <?php } ?>

  <?php
  }
}
