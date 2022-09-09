<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function wcusage_field_cb_currency( $args )
{
  $options = get_option( 'wcusage_options' );
  ?>

	<h1><?php echo __( 'Multi-Currency Settings', 'woo-coupon-usage' ); ?></h1>

  <hr/>

	<p>- <?php echo __( 'In this section, you can manage multi-currency settings, if you are using a multi currency plugin.', 'woo-coupon-usage' ); ?></p>

  <p>- <?php echo __( 'This will then automatically convert all the stats, order totals and commission on the affiliate dashboard into your base store currency, even if the order is made in a different currency.', 'woo-coupon-usage' ); ?></p>

  <p>- <?php echo __( 'NOTE: Updating the conversion rates below will only update the totals for NEW orders (if the affiliate dashboard has been viewed at-least once).', 'woo-coupon-usage' ); ?></p>

  <p>- <?php echo __( 'To completely refresh each of your affiliate dashboards stats for past orders, with the new conversion rates, <a href="/wp-admin/admin.php?page=wcusage_settings&refreshstats=true">click here</a>. (The first page load for each dashboard may take slightly longer.)', 'woo-coupon-usage' ); ?></p>

  <br/><hr/>

  <?php $wcusage_field_currencies = $options['wcusage_field_currencies']; ?>

  <!-- Main Currency -->
  <?php echo wcusage_setting_toggle_option('wcusage_field_enable_currency', 0, __( 'Enable multi currency settings.', 'woo-coupon-usage' ), '0px'); ?>

  <?php echo wcusage_setting_toggle('.wcusage_field_enable_currency', '.wcu-field-section-currency'); // Show or Hide ?>
  <span class="wcu-field-section-currency">

  <br/><br/>

  <!-- Main Currency -->
  <?php
  $defaultcurrency = get_woocommerce_currency();
  $defaultcurrencysym = get_woocommerce_currency_symbol();
  ?>
  <strong>Base Store Currency:</strong> <?php echo $defaultcurrency; ?><br/>
  <i><?php echo __( 'This is the base currency for your store, in which totals/commission will be converted to. You can change this in the WooCommerce settings.', 'woo-coupon-usage' ); ?></i><br/>

  <br/><br/>

  <!-- Save Rate -->
  <?php echo wcusage_setting_toggle_option('wcusage_field_enable_currency_save_rate', 0, __( 'Save the conversion rate for each order.', 'woo-coupon-usage' ), '0px'); ?>
  <i><?php echo __( 'With this enabled, it will permanently save and use the commission rate that was set at the time the order is created, even if you update the rates below.', 'woo-coupon-usage' ); ?></i><br/>
  <i><?php echo __( '(This is saved as meta data "wcusage_currency_conversion" for the order.)', 'woo-coupon-usage' ); ?></i><br/>
  <i><?php echo __( 'Note: When enabled, any existing orders that do not currently have a conversion rate set, will save the rate as the rate set below (when the affiliate dashboard is next loaded).', 'woo-coupon-usage' ); ?></i><br/>

  <br/><br/>

  <!-- Number of currency -->
  <?php $currencynumber = wcusage_get_setting_value('wcusage_field_currency_number', '5'); ?>
  <?php echo wcusage_setting_number_option('wcusage_field_currency_number', $currencynumber, __( 'Number of Extra Currencies', 'woo-coupon-usage' ), '0px'); ?>
  <i><?php echo __( 'Please refresh the page to add/remove the new currency options (found below) when you update this number.', 'woo-coupon-usage' ); ?></i><br/>

  <br/><hr/>

  <?php
  // Loop through custom tabs
  for ($i = 1; $i <= $currencynumber; $i++) {
    echo '<h3><span class="dashicons dashicons-admin-generic" style="margin-top: 2px;"></span> Currency #' . $i . '</h3>';

    $get_default_currency_settings = wcusage_get_default_currency_settings($i);
		$wcusage_field_currency_name = $get_default_currency_settings['wcusage_field_currency_name'];
		$wcusage_field_currency_rate = $get_default_currency_settings['wcusage_field_currency_rate'];

    $thistabsfields = ' <div class="input_fields_wrap"></div>';
    $thistabsfields .= '<span style="display: block; float: left;"><span style="margin-left: 35px; font-size: 12px;">Currency Code:</span><br/> <span style="font-size: 12px;">1.00 x</span> <input type="text" style="max-width: 82px;" id="wcusage_field_currencies_name_'.$i.'" customid="wcusage_field_currencies" name="wcusage_options[wcusage_field_currencies]['.$i.'][name]" checktype="customnumber" custom1="'.$i.'" custom2="name" placeholder="" value="'.$wcusage_field_currency_name.'"></span>';
    $thistabsfields .= '<span style="display: block; float: left;"><span style="margin-left: 18px; font-size: 12px;">Conversion:</span><br/>&nbsp;= <input type="text" style="max-width: 82px;" id="wcusage_field_currencies_rate_'.$i.'" customid="wcusage_field_currencies" name="wcusage_options[wcusage_field_currencies]['.$i.'][rate]" checktype="customnumber" custom1="'.$i.'" custom2="rate" placeholder="1.00" value="'.$wcusage_field_currency_rate.'"> <span style="font-size: 12px;">'.$defaultcurrency.'</span></span>';
    echo $thistabsfields;
    echo '<div style="clear: both;"></div><br/><hr/>';
  }
  ?>

  </span>

	</div>

 <?php
}
