<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Commission Settings
function wcusage_field_cb_commission( $args )
{
  $options = get_option( 'wcusage_options' );
  $ispro = ( wcu_fs()->can_use_premium_code() ? 1 : 0 );
  $probrackets = ( $ispro ? "" : " (PRO)" );
  ?>

	<div id="commission-settings" class="settings-area">

	<h1><?php echo __( 'Flexible Commission Settings', 'woo-coupon-usage' ); ?></h1>

  <hr/>

  <p>- These settings allow you to customise the exact amount of commission earned by affiliates for new referrals.</p>

  <br/>
  <hr/>

  <!-- Enable commission calculation statistics -->
  <?php echo wcusage_setting_toggle_option('wcusage_field_show_commission', 1, __( 'Enable Commission Calculations & Statistics', 'woo-coupon-usage' ), '0px'); ?>

  <br/><hr/>

  <!-- ********** Commission Amounts ********** -->
  <h3><span class="dashicons dashicons-admin-generic" style="margin-top: 2px;"></span> <?php echo __( 'Commission Amounts', 'woo-coupon-usage' ); ?>:</h3>
  <?php echo do_action( 'wcusage_hook_setting_section_commission_amounts' ); ?>

  <br/><br/>

  <p><?php echo __( 'Note: When updating these settings saved data will be refreshed for all dashboards automatically (first page load may take longer).', 'woo-coupon-usage' ); ?></p>

  <br/><hr/>

  <!-- ********** Calculations ********** -->
  <h3><span class="dashicons dashicons-admin-generic" style="margin-top: 2px;"></span> <?php echo __( 'Calculation Settings', 'woo-coupon-usage' ); ?>:</h3>
  <?php echo do_action( 'wcusage_hook_setting_section_calculations' ); ?>

  <!-- ********** Calculations ********** -->
  <h3><span class="dashicons dashicons-admin-generic" style="margin-top: 2px;"></span> <?php echo __( 'Tax Settings', 'woo-coupon-usage' ); ?>:</h3>
  <?php echo do_action( 'wcusage_hook_setting_section_tax' ); ?>

  <br/>

	<span <?php if( !wcu_fs()->can_use_premium_code() || !wcu_fs()->is_premium() ) { ?>style="opacity: 0.4; display: block; pointer-events: none;" class="wcu-settings-pro-only"<?php } ?>>

    <!-- Priority Commission Field -->
    <br/><hr/>
    <h3><span class="dashicons dashicons-admin-generic" style="margin-top: 2px;"></span> Commission Priority<?php echo $probrackets; ?>:</h3>

		<?php
    if(isset($options['wcusage_field_priority_commission'])) {
      $wcusage_field_priority_commission = $options['wcusage_field_priority_commission'];
    } else {
    	$wcusage_field_priority_commission = "";
    }
    ?>
		<input type="hidden" value="0" id="wcusage_field_priority_commission" data-custom="custom" name="wcusage_options[wcusage_field_priority_commission]" >
		<strong><label for="scales"><?php echo __( 'Which custom commission values should be applied as priority?', 'woo-coupon-usage' ); ?></label></strong><br/>
		<select name="wcusage_options[wcusage_field_priority_commission]" id="wcusage_field_priority_commission">
			<option value="product" <?php if($wcusage_field_priority_commission == "product") { ?>selected<?php } ?>><?php echo __( 'Product Commission Settings', 'woo-coupon-usage' ); ?></option>
			<option value="coupon" <?php if($wcusage_field_priority_commission == "coupon") { ?>selected<?php } ?>><?php echo __( 'Coupon Commission Settings', 'woo-coupon-usage' ); ?></option>
		</select>
    <br/><i><?php echo __( 'This setting is required in case you have set custom commission amounts on both a coupon level, and product level.', 'woo-coupon-usage' ); ?></i>
    <br/><i><?php echo __( 'It will set one as priority, so if both are set, the commission settings for your chosen priority will be used.', 'woo-coupon-usage' ); ?></i>

    <br/><hr/>

    <h3 id="wcu-setting-header-lifetime">
      <span class="dashicons dashicons-admin-generic" style="margin-top: 2px;"></span> <?php echo __( 'Lifetime Commission', 'woo-coupon-usage' ); ?><?php echo $probrackets; ?>:
    </h3>

    <i><?php echo __( 'With lifetime commission enabled, once someone uses the affiliates coupon code, that customer will be linked to the affiliate forever, and ALL future purchases from that customer and will count as a referral, even if they dont re-use the coupon code.', 'woo-coupon-usage' ); ?></i>
    <i><?php echo __( 'Even if the "coupon code" isnt used, the commission and sales will still be tracked on the coupons affiliate dashboard. All future orders by that customer, even with different coupon codes, will only apply to the original coupon affiliate.', 'woo-coupon-usage' ); ?></i>

    <br/><br/>

    <!-- Enable "lifetime commission" features. -->
    <?php echo wcusage_setting_toggle_option('wcusage_field_lifetime', 0, __( 'Enable "lifetime commission" features.', 'woo-coupon-usage' ), '0px'); ?>
    <i><?php echo __( 'This option will allow you to enable "lifetime commission" either globally, or on a per-coupon basis.', 'woo-coupon-usage' ); ?></i>

    <br/>

    <?php echo wcusage_setting_toggle('.wcusage_field_lifetime', '.wcu-field-section-lifetime-features'); // Show or Hide ?>
    <span class="wcu-field-section-lifetime-features">
    <br/>

    <!-- Enable "lifetime commission" functionality globally for all affiliate coupons. -->
    <?php echo wcusage_setting_toggle_option('wcusage_field_lifetime_all', 0, __( 'Enable "lifetime commission" functionality globally for all affiliate coupons.', 'woo-coupon-usage' ), '0px'); ?>
    <i><?php echo __( 'Enabling this option will enable lifetime commission for ALL your affiliates & coupons. You can alternatively enable lifetime commission on a per-coupon basis, in the individual coupon settings.', 'woo-coupon-usage' ); ?></i>

    <br/><br/>

    <!-- Only trigger lifetime referral if coupon is assigned to user. -->
    <?php echo wcusage_setting_toggle_option('wcusage_field_lifetime_require_user', 1, __( 'Only trigger lifetime referral if coupon is assigned to user.', 'woo-coupon-usage' ), '0px'); ?>
    <i><?php echo __( 'Enable this to only link customer to coupon as "lifetime referral" if the coupon has a user affiliate assigned to it.', 'woo-coupon-usage' ); ?></i>

    <br/><br/>

    <!-- Lifetime Commission Expiry (Days) -->
    <?php echo wcusage_setting_number_option('wcusage_field_lifetime_expire', '0', __( 'Lifetime Commission Expiry (Days)', 'woo-coupon-usage' ), '0px'); ?>
    <i><?php echo __( 'Optional: How many days after being assigned as a "lifetime" referral should it expire, and the customer be unlinked from the customer.', 'woo-coupon-usage' ); ?></i><br/>
    <i><?php echo __( 'Set to "0" for permanent lifetime commission with no expiry time.', 'woo-coupon-usage' ); ?> <?php echo __( 'Can also be set on a per-coupon basis.', 'woo-coupon-usage' ); ?></i><br/>

    <br/>

    </span>

    <!-- Per User Role -->
    <br/><hr/>
    <h3><span class="dashicons dashicons-admin-generic" style="margin-top: 2px;" id="wcu-setting-header-commission-user-role"></span> <?php echo __( 'Per User Role Commission', 'woo-coupon-usage' ); ?><?php echo $probrackets; ?>:</h3>

    <?php echo wcusage_setting_toggle_option('wcusage_field_affiliate_per_user', 0, __( 'Enable "Per User Role" Commission', 'woo-coupon-usage' ), '0px'); ?>
    <i><?php echo __( 'Allows you to set custom commission rates per user role. This will replace the settings set above, if it is set.', 'woo-coupon-usage' ); ?></i>

    <?php echo wcusage_setting_toggle('.wcusage_field_affiliate_per_user', '.wcu-field-section-per-user'); // Show or Hide ?>
    <span class="wcu-field-section-per-user">

    <br/><br/>

    <p style="font-size: 17px; margin-left: 40px;"><strong><?php echo __( 'Information:', 'woo-coupon-usage' ); ?></strong></p>

    <p style="margin-left: 40px;">- <?php echo __( 'Set the custom commission rates for each user role below (this is the role of the affiliate user). Leave empty to use default rates.', 'woo-coupon-usage' ); ?></p>

    <p style="margin-left: 40px;">- <?php echo __( 'If you set custom "coupon" commission for that affiliate, or "per product" commission, they WILL take priority over the "user role" commission.', 'woo-coupon-usage' ); ?></p>

    <p style="margin-left: 40px;">- <?php echo __( 'If the affiliate user is assigned to multiple user roles, it will apply the commission rates for the first role it detects with any custom values set.', 'woo-coupon-usage' ); ?></p>

    <p style="margin-left: 40px;">- <?php echo __( 'When updating these settings, you may need to click the "REFRESH ALL DATA" button in the "Debug" tab for changes to show immediately for existing orders.', 'woo-coupon-usage' ); ?></p>

    <br/>

    <style>
    .settings-user-role-fields .wcu-update-icon {
      position: absolute !important;
    }
    </style>
    <?php
    $editable_roles = get_editable_roles();
    foreach ($editable_roles as $role => $details) {
        echo "<div class='settings-user-role-fields' style='width: 100%; max-width: 320px; float: left; display: block; margin-bottom: 15px;'>";
        echo "<br/><strong style='font-size: 17px; margin-left: 40px;'>" . translate_user_role($details['name']) . ":</strong>";
        echo wcusage_setting_text_option('wcusage_field_affiliate_percent_role_' . esc_attr($role), "", '% - ' . __( 'Percentage Amount Of Total Order', 'woo-coupon-usage' ), '40px');
        echo wcusage_setting_text_option('wcusage_field_affiliate_fixed_order_role_' . esc_attr($role), "", wcusage_get_currency_symbol() . ' - ' . __( 'Fixed Amount Per Order', 'woo-coupon-usage' ), '40px');
        echo wcusage_setting_text_option('wcusage_field_affiliate_fixed_product_role_' . esc_attr($role), "", wcusage_get_currency_symbol() . ' - ' . __( 'Fixed Amount Per Product', 'woo-coupon-usage' ), '40px');
        echo "</div>";
    }
    ?>

    </span>

  </span>

	</div>

 <?php
}

/**
 * Settings Section: Commission Amounts
 *
 */
add_action( 'wcusage_hook_setting_section_commission_amounts', 'wcusage_setting_section_commission_amounts' );
if( !function_exists( 'wcusage_setting_section_commission_amounts' ) ) {
  function wcusage_setting_section_commission_amounts() {

  $options = get_option( 'wcusage_options' );
  ?>

  <p>- <?php echo __( 'Enter your commission amounts below (0 to disable). If you enter multiple types, they will be combined. For example you could have: 10% of total order, plus an extra $2 per product.', 'woo-coupon-usage' ); ?></p>

	<p>- (Pro Version) <?php echo __( 'These values be overridden on a per coupon and/or per product basis.', 'woo-coupon-usage' ); ?> <a href="https://couponaffiliates.com/docs/flexible-commission-settings" target="_blank"><?php echo __( 'Learn More', 'woo-coupon-usage' ); ?></a>.</p>

  <br/>

  <?php $textaffiliatecommission = __( 'Affiliate commission', 'woo-coupon-usage' ) . ": "; ?>

  <!-- Percentage Amount Of Total Order -->
  <?php echo wcusage_setting_number_option('wcusage_field_affiliate', '0', $textaffiliatecommission . '(% - ' . __( 'Percentage Amount Of Total Order', 'woo-coupon-usage' ) . ')', '0px'); ?>

	<br/>

  <!-- Fixed Amount Per Order -->
  <?php echo wcusage_setting_number_option('wcusage_field_affiliate_fixed_order', '0', $textaffiliatecommission . '(' . wcusage_get_currency_symbol() . ' - ' . __( 'Fixed Amount Per Order', 'woo-coupon-usage' ) . ')', '0px'); ?>

	<br/>

  <!-- Fixed Amount Per Product -->
  <?php echo wcusage_setting_number_option('wcusage_field_affiliate_fixed_product', '0', $textaffiliatecommission . '(' . wcusage_get_currency_symbol() . ' - ' . __( 'Fixed Amount Per Product', 'woo-coupon-usage' ) . ')', '0px'); ?>

	<br/>

  <?php echo wcusage_setting_text_option('wcusage_field_affiliate_custom_message', '', __( 'Custom "Commission" Message', 'woo-coupon-usage' ), '0px'); ?>
  <i><?php echo __( 'Custom text shown affiliate dashboard for the "commission" amount. This will be overridden if you enter commission amounts on the coupon level.', 'woo-coupon-usage' ); ?></i>

  <?php
  }
}

/**
 * Settings Section: Calculation Settings
 *
 */
add_action( 'wcusage_hook_setting_section_calculations', 'wcusage_setting_section_calculations' );
if( !function_exists( 'wcusage_setting_section_calculations' ) ) {
  function wcusage_setting_section_calculations() {

  $options = get_option( 'wcusage_options' );
  ?>

  <p>By default the order totals displayed on the dashboard, and used for % commission calculations exclude shipping costs, fees, taxes, and discounts (recommended).</p>
  <p>You can however customise this below if required:</p>

  <br/>

  <!-- Calculate commission BEFORE the discount is applied (at full price). -->
  <?php echo wcusage_setting_toggle_option('wcusage_field_commission_before_discount', 0, __( 'Include the "coupon discount" in % commission calculations.', 'woo-coupon-usage' ), '0px'); ?>
  <i><?php echo __( 'When enabled, % commission will be calculated on the order subtotal (instead of total), before the coupon discount is deducted from it.', 'woo-coupon-usage' ); ?></i>

  <br/><br/>

  <!-- Calculate affiliate commission BEFORE the discount is applied (at full price). -->
  <?php echo wcusage_setting_toggle_option('wcusage_field_commission_include_shipping', 0, __( 'Include "shipping costs" in % commission calculations & order totals.', 'woo-coupon-usage' ), '0px'); ?>
  <i><?php echo __( 'When enabled, % commission will be calculated based on the order subtotal/total including "shipping costs". It will also be added to the subtotal/total shown in statistics.', 'woo-coupon-usage' ); ?></i>

  <br/>

  <br/><p><span class="fa-solid fa-gear"></span> <strong><?php echo __( 'Advanced Calculation Settings', 'woo-coupon-usage' ); ?>:</strong> <button type="button" class="wcu-showhide-button" id="wcu_show_commission_calc_advanced">Show <span class="fa-solid fa-arrow-down"></span></button></p>

  <?php echo wcu_admin_settings_showhide_toggle("wcu_show_commission_calc_advanced", "wcu_commission_calc_advanced", "Show", "Hide"); ?>
  <div id="wcu_commission_calc_advanced" style="display: none;">

    <br/>

    <!-- Calculate commission BEFORE any custom discounts are applied. -->
    <?php echo wcusage_setting_toggle_option('wcusage_field_commission_before_discount_custom', 0, __( 'Include "custom discounts" in % commission calculations & order totals.', 'woo-coupon-usage' ), ''); ?>
    <i><?php echo __( 'When enabled, % commission will be calculated before any custom discounts are deducted from the subtotal/total. It will also be added to the subtotal/total shown in statistics.', 'woo-coupon-usage' ); ?></i>
    <br/><i><?php echo __( '(Custom discounts include negative fees, store credit, and discounts added by other plugins.)', 'woo-coupon-usage' ); ?></i>

    <br/><br/>

    <!-- Calculate affiliate commission BEFORE the discount is applied (at full price). -->
    <?php echo wcusage_setting_toggle_option('wcusage_field_commission_include_fees', 0, __( 'Include "fees" in % commission calculations & order totals.', 'woo-coupon-usage' ), '0px'); ?>
    <i><?php echo __( 'When enabled, % commission will be calculated based on the order subtotal/total including "fees". It will also be added to the subtotal/total shown in statistics.', 'woo-coupon-usage' ); ?></i>

  </div>

  <br/>

  <p><?php echo __( 'Note: When updating these settings saved data will be refreshed for all dashboards automatically (first page load may take longer).', 'woo-coupon-usage' ); ?></p>

  <?php
  }
}

/**
 * Settings Section: Tax Settings
 *
 */
add_action( 'wcusage_hook_setting_section_tax', 'wcusage_setting_section_tax' );
if( !function_exists( 'wcusage_setting_section_tax' ) ) {
  function wcusage_setting_section_tax() {

  $options = get_option( 'wcusage_options' );
  ?>

  <!-- Include tax in orders and commission calculations. -->
  <?php echo wcusage_setting_toggle_option('wcusage_field_show_tax', 0, __( 'Include "taxes" in % commission calculations & order totals.', 'woo-coupon-usage' ), '0px'); ?>
  <i><?php echo __( 'If enabled, order tax will be added to the order subtotal/total/discount for orders in the statistics, and when calculating percentage (%) commission calculations.', 'woo-coupon-usage' ); ?></i><br/>

  <br/>

  <!-- Include tax on fixed commission amounts. -->
  <script>
  jQuery( document ).ready(wcusage_check_show_tax_fixed);
  jQuery('#wcusage_field_affiliate_fixed_order').change(wcusage_check_show_tax_fixed);
  jQuery('#wcusage_field_affiliate_fixed_product').change(wcusage_check_show_tax_fixed);
  function wcusage_check_show_tax_fixed() {
    if(jQuery('#wcusage_field_affiliate_fixed_order').val() <= 0 && jQuery('#wcusage_field_affiliate_fixed_product').val() <= 0) {
      jQuery('.wcu-field-section-tax-fixed').hide();
    } else {
      jQuery('.wcu-field-section-tax-fixed').show();
    }
  }
  </script>
  <span class="wcu-field-section-tax-fixed">
    <?php echo wcusage_setting_toggle_option('wcusage_field_show_tax_fixed', 0, __( 'Include "taxes" in "fixed" commission calculations.', 'woo-coupon-usage' ), '0px'); ?>
    <i><?php echo __( 'If enabled, order tax will be added to the fixed commission calculations.', 'woo-coupon-usage' ); ?></i><br/>
    <br/>
  </span>

  <!-- Deduct a custom percentage from order total before calculating commission -->
  <?php echo wcusage_setting_number_option('wcusage_field_affiliate_deduct_percent', '0', __( 'Custom Tax Adjustment (%):', 'woo-coupon-usage' ), '0px'); ?>
  <i><?php echo __( 'Deduct a custom percentage from the order subtotal, before calculating the commission (% commission).', 'woo-coupon-usage' ); ?></i>

  <script>
  jQuery( document ).ready(function() {
    if(jQuery('#wcusage_field_affiliate_deduct_percent').val() <= 0) {
      jQuery('.wcu-field-section-deduct-percent-show').hide();
    }
    jQuery('#wcusage_field_affiliate_deduct_percent').change(function(){
      if(jQuery('#wcusage_field_affiliate_deduct_percent').val() > 0) {
        jQuery('.wcu-field-section-deduct-percent-show').show();
      } else {
        jQuery('.wcu-field-section-deduct-percent-show').hide();
      }
    });
  });
  </script>
  <span class="wcu-field-section-deduct-percent-show">
  <br/><br/>

  <!-- Display adjusted total and subtotal. -->
  <?php echo wcusage_setting_toggle_option('wcusage_field_affiliate_deduct_percent_show', 0, __( 'Display adjusted total and subtotal.', 'woo-coupon-usage' ), '0px'); ?>
  <i><?php echo __( 'When enabled, this will also show the adjusted "total" and "subtotal" (with deducted percentage) on affiliate dashboard. When disabled, only the "commission" stat will be affected by the adjustment.', 'woo-coupon-usage' ); ?></i>
  </span>

  <br/><br/>

  <i>Note: Changing these tax settings will affect stats for all coupons and all new/past orders. Stats are refreshed next time there is a new order (for that specific coupon), or you click the "refresh all data" button in "debug" settings to refresh ALL coupon stats.</i>

  <?php
  }
}
