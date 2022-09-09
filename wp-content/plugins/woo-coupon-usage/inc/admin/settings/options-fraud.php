<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function wcusage_field_cb_fraud( $args )
{
  $options = get_option( 'wcusage_options' );
  $ispro = ( wcu_fs()->can_use_premium_code() ? 1 : 0 );
  $probrackets1 = ( $ispro ? "" : " (PRO)" );
  $probrackets2 = ( $ispro ? "" : "(PRO) " );
  ?>

	<div id="fraud-settings" class="settings-area">

    <h1><?php echo __( 'Fraud Prevention & Usage Restrictions', 'woo-coupon-usage' ); ?></h1>

    <hr/>

    <p>- <?php echo __( 'Apply restrictions on when affiliate coupons can be used to help prevent affiliate fraud.', 'woo-coupon-usage' ); ?></p>

    <br/><hr/>

    <h3><span class="dashicons dashicons-admin-generic" style="margin-top: 2px;"></span> <?php echo __( 'Coupon Usage Restrictions', 'woo-coupon-usage' ); ?>:</h3>

    <!-- Allow affiliate user to apply their own coupon code at cart / checkout. -->
    <?php echo wcusage_setting_toggle_option('wcusage_field_allow_assigned_user', 1, __( 'Allow affiliate user to apply their own coupon code at cart / checkout.', 'woo-coupon-usage' ), '0px'); ?>
    <i><?php echo __( 'When disabled, the affiliate user will be prevented from using their own coupon code (coupons they are assigned to) at cart or checkout.', 'woo-coupon-usage' ); ?></i>
    <i><?php echo __( 'Unless you have a specific use case, we suggest keeping this disabled as in general it can cause some issues (commission granted to all coupons).', 'woo-coupon-usage' ); ?></i>

    <br/><br/>

    <!-- Allow multiple affiliate coupons to be used in the same order. -->
    <?php echo wcusage_setting_toggle_option('wcusage_field_allow_multiple_coupons', 0, __( 'Allow multiple affiliate coupons to be used in the same order.', 'woo-coupon-usage' ), '0px'); ?>
    <i><?php echo __( 'When disabled, it will only allow 1 affiliate coupon to be used per order. (This is any coupons that have an affiliate user assigned to them.)', 'woo-coupon-usage' ); ?></i>
    <br/>
    <i><?php echo __( 'We highly recommend that you keep this option DISABLED, as it may cause some issues or paying too much commission.', 'woo-coupon-usage' ); ?></i>

    <br/><br/>

    <!-- Allow affiliate coupons to be used by existing and new customers. -->
    <p>
      <?php $wcusage_field_allow_all_customers = wcusage_get_setting_value('wcusage_field_allow_all_customers', '1'); ?>
      <input type="hidden" value="0" id="wcusage_field_allow_all_customers" data-custom="custom" name="wcusage_options[wcusage_field_allow_all_customers]" >
      <strong><label for="scales"><?php echo __( 'Who can apply affiliate coupons to their cart?', 'woo-coupon-usage' ); ?></label></strong><br/>
      <select name="wcusage_options[wcusage_field_allow_all_customers]" id="wcusage_field_allow_all_customers">
        <option value="1" <?php if($wcusage_field_allow_all_customers == "1") { ?>selected<?php } ?>><?php echo __( 'All Existing & New Customers', 'woo-coupon-usage' ); ?></option>
        <option value="0" <?php if($wcusage_field_allow_all_customers == "0") { ?>selected<?php } ?>><?php echo __( 'New Customers Only (First Order)', 'woo-coupon-usage' ); ?></option>
      </select>
    </p>
    <i><?php echo __( '(Only applies to coupons that have an affiliate user assigned to them.)', 'woo-coupon-usage' ); ?></i><br/>
    <i><?php echo __( 'If preferred, you can enable "New Customers Only" for individual coupons in the "Usage limits" coupon settings tab.', 'woo-coupon-usage' ); ?> <a href="https://couponaffiliates.com/docs/new-customers-only" target="_blank"><?php echo __( 'Learn More.', 'woo-coupon-usage' ); ?></a></i><br/>

    <br/><hr/>

    <h3><span class="dashicons dashicons-admin-generic" style="margin-top: 2px;"></span> <?php echo __( 'Visitors Blacklist', 'woo-coupon-usage' ); ?>:</h3>

    <p><?php echo __( 'These visitors will not be able to use any affiliate coupons on their purchases, and can not apply to become an affiliate.', 'woo-coupon-usage' ); ?> <a href="https://couponaffiliates.com/docs/blocked-domains" target="_blank"><?php echo __( 'Learn More.', 'woo-coupon-usage' ); ?></a></p>

    <br/>

    <!-- Blocked Domains -->
    <?php echo wcusage_setting_textarea_option('wcusage_field_fraud_block_ips', "", __( 'Blocked "Visitor ID" or "IP Address" List', 'woo-coupon-usage' ), '0px'); ?>
    <i><?php echo __( 'Enter one per line.', 'woo-coupon-usage' ); ?></i><br/>

    <div <?php if( !wcu_fs()->can_use_premium_code() || !wcu_fs()->is_premium() ) { ?>style="opacity: 0.4; pointer-events: none;" class="wcu-settings-pro-only"<?php } ?>>

      <br/><hr/>

      <h3><span class="dashicons dashicons-admin-generic" style="margin-top: 2px;"></span> <?php echo __( 'Domains Blacklist', 'woo-coupon-usage' ) . $probrackets1; ?>:</h3>

      <p><?php echo __( 'Visitors referred directly from any of these domains will not have referrals tracked or coupons applied automatically.', 'woo-coupon-usage' ); ?> <a href="https://couponaffiliates.com/docs/blocked-domains" target="_blank"><?php echo __( 'Learn More.', 'woo-coupon-usage' ); ?></a></p>

      <br/>

      <!-- Blocked Domains -->
      <?php echo wcusage_setting_textarea_option('wcusage_field_fraud_block_domains', "", __( 'Blocked Domains List', 'woo-coupon-usage' ), '0px'); ?>
      <i><?php echo __( 'Enter one per line. You do not need to include "http://", "https://", or "www." in the domain.', 'woo-coupon-usage' ); ?></i><br/>

      <br/>

      <!-- Allow manually application of affiliate coupons. -->
      <?php echo wcusage_setting_toggle_option('wcusage_field_fraud_block_domains_manual', 0, __( 'Also block MANUAL use of affiliate coupons, if referred by a blocked domain.', 'woo-coupon-usage' ), '0px'); ?>
      <i><?php echo __( 'When enabled, visitors referred by blocked domains will be completely blocked from entering any affiliate coupons manually (as long as the cookie is saved).', 'woo-coupon-usage' ); ?></i>

      <br/><br/><hr/>

      <h3><span class="dashicons dashicons-admin-generic" style="margin-top: 2px;"></span> <?php echo __( 'Direct Link Tracking Restrictions', 'woo-coupon-usage' ) . $probrackets1; ?>:</h3>

      <p><?php echo __( 'You can apply additional strict fraud prevention with direct link tracking.', 'woo-coupon-usage' ); ?> <a href="https://couponaffiliates.com/docs/pro-direct-link-tracking" target="_blank"><?php echo __( 'Learn More.', 'woo-coupon-usage' ); ?></a></p></p>

      <p><?php echo __( 'With this feature, you can enable an option to prevent ALL affiliate coupons and referral links from working UNLESS the customer was directly linked by the approved domain that is assigned to that coupon.', 'woo-coupon-usage' ); ?></p>

      <br/>

      <a href="#" onclick="wcusage_go_to_settings('#tab-urls', '#wcu-setting-header-referral-directlinks');"
        class="wcu-addons-box-view-details" style="margin-left: 0px;">
        <?php echo __( 'View "Direct Link Tracking" Settings', 'woo-coupon-usage' ); ?>
      </a>

      <?php echo wcusage_setting_toggle('.wcusage_field_enable_directlinks', '.wcu-field-section-directlinks'); // Show or Hide ?>
      <span class="wcu-field-section-directlinks">

        <br/><br/>

        <?php echo wcusage_setting_toggle_option('wcusage_field_enable_directlinks_protection', 0, 'Only allow affiliate coupons to be applied when directly linked by an approved domain.', '0px'); ?>
        <i><?php echo __( 'Enabling this option will prevent ALL affiliate coupons and referral links from working UNLESS the customer was directly linked by the approved domain that is assigned to that coupon.', 'woo-coupon-usage' ); ?></i><br/>

      </span>

      <br/>

    </div>

	</div>

 <?php
}
