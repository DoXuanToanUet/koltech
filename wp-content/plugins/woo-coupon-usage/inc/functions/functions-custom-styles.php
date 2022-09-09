<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Get custom styles for affiliate dashboard
 *
 * @return mixed
 *
 */
if( !function_exists( 'wcusage_custom_styles' ) ) {
  function wcusage_custom_styles() {

    $options = get_option( 'wcusage_options' );

  	$wcusage_color_tab = wcusage_get_setting_value('wcusage_field_color_tab', '#333');
  	$wcusage_color_tab_font = wcusage_get_setting_value('wcusage_field_color_tab_font', '#fff');
  	$wcusage_color_tab_hover = wcusage_get_setting_value('wcusage_field_color_tab_hover', '#333333');
  	$wcusage_color_tab_hover_font = wcusage_get_setting_value('wcusage_field_color_tab_hover_font', '#fff');
  	$wcusage_color_table = wcusage_get_setting_value('wcusage_field_color_table', '#333333');
  	$wcusage_color_table_font = wcusage_get_setting_value('wcusage_field_color_table_font', '#fff');
  	$wcusage_color_button = wcusage_get_setting_value('wcusage_field_color_button', '#333333');
  	$wcusage_color_button_font = wcusage_get_setting_value('wcusage_field_color_button_font', '#fff');
    $wcusage_color_button_hover = wcusage_get_setting_value('wcusage_field_color_button_hover', '#131313');
  	$wcusage_color_button_font_hover = wcusage_get_setting_value('wcusage_field_color_button_font_hover', '#fff');
  	$wcusage_color_stats_icon = wcusage_get_setting_value('wcusage_field_color_stats_icon', '#bebebe');
  	?>

  	<style>
  		<?php if($wcusage_color_table) { ?>
  			.wcuTableHead, .wcuTableFoot  {
  				background: <?php echo $wcusage_color_table; ?> !important;
  				color: <?php echo $wcusage_color_table_font; ?> !important;
  			}
        .wcuTableHead span, .wcuTableFoot span {
  				color: <?php echo $wcusage_color_table_font; ?> !important;
  			}
  		<?php } ?>
  		<?php if($wcusage_color_tab) { ?>
  			.wcutab button  {
  				background: <?php echo $wcusage_color_tab; ?> !important;
  				color: <?php echo $wcusage_color_tab_font; ?> !important;
  			}
  		<?php } ?>
  		<?php if($wcusage_color_tab_hover) { ?>
  			.wcutab button:hover, .wcutab button.active  {
  				background: <?php echo $wcusage_color_tab_hover; ?> !important;
  				color: <?php echo $wcusage_color_tab_hover_font; ?> !important;
  			}
  		<?php } ?>
  		<?php if($wcusage_color_button) { ?>
  			.wcu-button-export, #wcu-monthly-orders-button, #wcu-orders-button, #wcusage_copylink,
        #wcu-paypal-button, #submitpayoutno, .wcu-paypal-button,
        #wcu6 .woocommerce-EditAccountForm .woocommerce-Button, #ml-wcu4 .woocommerce-EditAccountForm .woocommerce-Button,
        #wcu-add-campaign-button, #wcu-add-directlink-button, #wcu-add-mlainvite-button,
        .wcu-save-settings-button, #wcu6 button, #wcu-register-button, .wcusage-login-form-col .woocommerce-button,
        .wcusage_copylink, .wcusage_creativelink, .wcu-coupon-list-button {
  				background: <?php echo $wcusage_color_button; ?> !important;
  				color: <?php echo $wcusage_color_button_font; ?> !important;
  				text-shadow: 0 0 2px #000;
  			}
        .wcusage-social-icon {
  				color: <?php echo $wcusage_color_button; ?> !important;
  			}
  		<?php } ?>
      <?php if($wcusage_color_button_hover) { ?>
  			.wcu-button-export:hover, #wcu-monthly-orders-button:hover, #wcu-orders-button:hover, #wcusage_copylink:hover,
        #wcu-paypal-button:hover, #submitpayoutno:hover, .wcu-paypal-button:hover,
        #wcu6 .woocommerce-EditAccountForm .woocommerce-Button:hover, #ml-wcu4 .woocommerce-EditAccountForm .woocommerce-Button:hover,
        #wcu-add-campaign-button:hover, #wcu-add-directlink-button:hover, #wcu-add-mlainvite-button:hover,
        .wcu-save-settings-button:hover, #wcu6 button:hover, #wcu-register-button:hover, .wcusage-login-form-col .woocommerce-button:hover,
        .wcusage_copylink:hover, .wcusage_creativelink:hover, .wcu-coupon-list-button:hover {
  				background: <?php echo $wcusage_color_button_hover; ?> !important;
  				color: <?php echo $wcusage_color_button_font_hover; ?> !important;
  			}
        .wcusage-social-icon:hover {
  				color: <?php echo $wcusage_color_button_hover; ?> !important;
  			}
  		<?php } ?>
  		<?php if($wcusage_color_stats_icon) { ?>
  			.wcusage-info-box::before {
  				color: <?php echo $wcusage_color_stats_icon; ?> !important;
  			}
  		<?php } ?>

  	</style>

  <?php
  }
}
add_action('wcusage_hook_custom_styles', 'wcusage_custom_styles', 10, 0);
