<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function wcusage_field_cb_notifications( $args )
{
  $options = get_option( 'wcusage_options' );
  $ispro = ( wcu_fs()->can_use_premium_code() ? 1 : 0 );
  $probrackets = ( $ispro ? "" : "(PRO) " );
  ?>

	<div id="notification-settings" class="settings-area">

	<h1><?php echo __( 'Email Notifications', 'woo-coupon-usage' ); ?></h1>

  <hr style="margin-bottom: 35px;"/>

    <h3 class="wcu-setting-email-header">
      <span class="dashicons dashicons-admin-generic" style="margin-top: 2px;"></span> <?php echo __( 'General Email Settings', 'woo-coupon-usage' ); ?>:
    </h3>
    <br/>

    <!-- General Email Settings & Free Email Settings -->
    <?php echo do_action('wcusage_hook_setting_section_email_free'); ?>

    <!-- PRO Email Settings -->
    <div <?php if( !wcu_fs()->can_use_premium_code() || !wcu_fs()->is_premium() ) { ?>style="opacity: 0.4; pointer-events: none;" class="wcu-settings-pro-only"<?php } ?>>

    <?php echo wcusage_setting_toggle_option('wcusage_field_email_enable_extra', 1, $probrackets . __( 'Enable the "Additional Email Addresses" field in affiliate settings.', 'woo-coupon-usage' ), '0px'); ?>
    <i><?php echo __( 'This will allow them to add extra emails to send their email notifications to.', 'woo-coupon-usage' ); ?></i>

    <br/><br/><br/>

    <h3 class="wcu-setting-email-header">
      <span class="dashicons dashicons-admin-generic" style="margin-top: 2px;"></span> <?php echo __( 'Affiliate Registration Emails', 'woo-coupon-usage' ); ?>:
    </h3>
    <br/>

    <div class="wcu-setting-email-notification-box">

      <!--
      ********************
      ** [User Email] Affiliate Application Submitted
      ********************
      -->
      <?php echo wcusage_setting_toggle_option('wcusage_field_email_registration_enable', 1, __( 'Affiliate Application Submitted', 'woo-coupon-usage' ), '0px'); ?>

      <i><?php echo __( 'Send an email to affiliate when they submit the affiliate application form.', 'woo-coupon-usage' ); ?></i>

      <br/><br/><p><span class="fa-solid fa-circle-user"></span> <strong><?php echo __( 'Recipient', 'woo-coupon-usage' ); ?>:</strong> <?php echo __( 'Affiliate User', 'woo-coupon-usage' ); ?></p>

      <br/><p><span class="fa-solid fa-envelope-open-text"></span> <strong><?php echo __( 'Email Customizer', 'woo-coupon-usage' ); ?>:</strong> <button type="button" class="wcu-showhide-button" id="wcu_show_email_registration_customise">Show <span class="fa-solid fa-arrow-down"></span></button></p>

      <?php echo wcu_admin_settings_showhide_toggle("wcu_show_email_registration_customise", "wcu_email_registration_customise", "Show", "Hide"); ?>
      <div id="wcu_email_registration_customise" style="display: none;">

        <br/>

        <!-- Email Notification Subject -->
        <?php echo wcusage_setting_text_option('wcusage_field_email_registration_subject', __( "Affiliate Application Submitted", "woo-coupon-usage" ), __( 'Email Notification Subject', 'woo-coupon-usage' ), '0px'); ?>

        <br/>

        <!-- Email Notification Message -->
        <?php
        $email2message = "Hello {name},"
        . "<br/><br/>"
        . "Your affiliate application for the coupon code"
        . " '{coupon}' "
        . "has been submitted."
        . "<br/><br/>"
        . "We will review your application and get back to you soon.";
        echo wcusage_setting_tinymce_option('wcusage_field_email_registration_message', $email2message, __( 'Email Notification Message', 'woo-coupon-usage' ), '0px');
        ?>

        <br/>

        <?php echo wcusage_email_merge_tags(array("name", "email", "coupon")); ?>

      </div>

    </div>

    <div class="wcu-setting-email-notification-box">

      <!--
      ********************
      ** [User Email] New Affiliate Account Created
      ********************
      -->
      <?php echo wcusage_setting_toggle_option('wcusage_field_email_registration_new_enable', 1, __( 'New Affiliate Account Created', 'woo-coupon-usage' ), '0px'); ?>

      <i><?php echo __( 'Send a custom new user account email (replaces default registration email).', 'woo-coupon-usage' ); ?></i>

      <br/><br/><p><span class="fa-solid fa-circle-user"></span> <strong><?php echo __( 'Recipient', 'woo-coupon-usage' ); ?>:</strong> <?php echo __( 'Affiliate User', 'woo-coupon-usage' ); ?></p>

      <br/><p><span class="fa-solid fa-envelope-open-text"></span> <strong><?php echo __( 'Email Customizer', 'woo-coupon-usage' ); ?>:</strong> <button type="button" class="wcu-showhide-button" id="wcu_show_email_registration_new_customise">Show <span class="fa-solid fa-arrow-down"></span></button></p>

      <?php echo wcu_admin_settings_showhide_toggle("wcu_show_email_registration_new_customise", "wcu_email_registration_new_customise", "Show", "Hide"); ?>
      <div id="wcu_email_registration_new_customise" style="display: none;">

        <br/>

        <!-- Email Notification Subject -->
        <?php echo wcusage_setting_text_option('wcusage_field_email_registration_new_subject', __( "Affiliate Account Login Details", "woo-coupon-usage" ), __( 'Email Notification Subject', 'woo-coupon-usage' ), '0px'); ?>

        <br/>

        <!-- Email Notification Message -->
        <?php
        $email3message = "Hello {name},"
        . "<br/><br/>"
        . "Your new affiliate account has been created."
        . "<br/><br/>"
        . "Username: {username}"
        . "<br/><br/>"
        . "You can login and access the affiliate dashboard page here: "
        . "<br/>"
        . "{dashboardurl}";
        echo wcusage_setting_tinymce_option('wcusage_field_email_registration_new_message', $email3message, __( 'Email Notification Message', 'woo-coupon-usage' ), '0px');
        ?>

        <br/>

        <?php echo wcusage_email_merge_tags(array("name", "email", "coupon", "dashboardurl", "username")); ?>

      </div>

    </div>

    <div class="wcu-setting-email-notification-box">

      <!--
      ********************
      ** [Admin Email] New Affiliate Application
      ********************
      -->
      <?php echo wcusage_setting_toggle_option('wcusage_field_email_registration_admin_enable', 1, __( 'New Affiliate Application', 'woo-coupon-usage' ), '0px'); ?>

      <i><?php echo __( 'Send an email to admin when there is a new affiliate application.', 'woo-coupon-usage' ); ?></i>

      <br/><br/><p><span class="fa-solid fa-circle-user"></span> <strong><?php echo __( 'Recipient', 'woo-coupon-usage' ); ?>:</strong> <?php echo __( 'Administrator', 'woo-coupon-usage' ); ?></p>

      <br/><p><span class="fa-solid fa-envelope-open-text"></span> <strong><?php echo __( 'Email Customizer', 'woo-coupon-usage' ); ?>:</strong> <button type="button" class="wcu-showhide-button" id="wcu_show_email_registration_admin_customise">Show <span class="fa-solid fa-arrow-down"></span></button></p>

      <?php echo wcu_admin_settings_showhide_toggle("wcu_show_email_registration_admin_customise", "wcu_email_registration_admin_customise", "Show", "Hide"); ?>
      <div id="wcu_email_registration_admin_customise" style="display: none;">

        <br/>

        <!-- Email Notification Subject -->
        <?php echo wcusage_setting_text_option('wcusage_field_email_registration_admin_subject', __( "New Affiliate Application", "woo-coupon-usage" ), __( 'Email Notification Subject', 'woo-coupon-usage' ), '0px'); ?>

        <br/>

        <!-- Email Notification Message -->
        <?php
        $email4message = "You have received a new coupon affiliate application!"
        . "<br/><br/>Username: {username}"
        . "<br/><br/>Preferred coupon code: {coupon}"
        . "<br/><br/>You can approve or decline this application here: {adminurl}";
        echo wcusage_setting_tinymce_option('wcusage_field_email_registration_admin_message', $email4message, __( 'Email Notification Message', 'woo-coupon-usage' ), '0px');
        ?>

        <br/>

        <?php echo wcusage_email_merge_tags(array("username", "coupon", "adminurl")); ?>

      </div>

    </div>

    <div class="wcu-setting-email-notification-box">

      <!--
      ********************
      ** [User Email] Affiliate Application Accepted
      ********************
      -->
      <?php echo wcusage_setting_toggle_option('wcusage_field_email_registration_accept_enable', 1, __( 'Affiliate Application Accepted', 'woo-coupon-usage' ), '0px'); ?>

      <i><?php echo __( 'Send an email to affiliate when their affiliate application is accepted.', 'woo-coupon-usage' ); ?></i>

      <br/><br/><p><span class="fa-solid fa-circle-user"></span> <strong><?php echo __( 'Recipient', 'woo-coupon-usage' ); ?>:</strong> <?php echo __( 'Affiliate User', 'woo-coupon-usage' ); ?></p>

      <br/><p><span class="fa-solid fa-envelope-open-text"></span> <strong><?php echo __( 'Email Customizer', 'woo-coupon-usage' ); ?>:</strong> <button type="button" class="wcu-showhide-button" id="wcu_show_email_registration_accept_customise">Show <span class="fa-solid fa-arrow-down"></span></button></p>

      <?php echo wcu_admin_settings_showhide_toggle("wcu_show_email_registration_accept_customise", "wcu_email_registration_accept_customise", "Show", "Hide"); ?>
      <div id="wcu_email_registration_accept_customise" style="display: none;">

        <br/>

        <!-- Email Notification Subject -->
        <?php echo wcusage_setting_text_option('wcusage_field_email_registration_accept_subject', __( "Affiliate Application Accepted!", "woo-coupon-usage" ), __( 'Email Notification Subject', 'woo-coupon-usage' ), '0px'); ?>

        <br/>

        <!-- Email Notification Message -->
        <?php
        $email5message = "Your affiliate application has been accepted for the coupon code: {coupon}"
        . "<br/><br/>Get started by visiting the affiliate dashboard here: {dashboardurl}"
        . "<br/><br/>{message}";
        echo wcusage_setting_tinymce_option('wcusage_field_email_registration_accept_message', $email5message, __( 'Email Notification Message', 'woo-coupon-usage' ), '0px');
        ?>

        <br/>

        <?php echo wcusage_email_merge_tags(array("coupon", "dashboardurl", "message", "username", "name")); ?>

      </div>

    </div>

    <div class="wcu-setting-email-notification-box">

      <!--
      ********************
      ** [User Email] Affiliate Application declined
      ********************
      -->
      <?php echo wcusage_setting_toggle_option('wcusage_field_email_registration_decline_enable', 1, __( 'Affiliate Application declined', 'woo-coupon-usage' ), '0px'); ?>

      <i><?php echo __( 'Send an email to affiliate when their affiliate application is declined.', 'woo-coupon-usage' ); ?></i>

      <br/><br/><p><span class="fa-solid fa-circle-user"></span> <strong><?php echo __( 'Recipient', 'woo-coupon-usage' ); ?>:</strong> <?php echo __( 'Affiliate User', 'woo-coupon-usage' ); ?></p>

      <br/><p><span class="fa-solid fa-envelope-open-text"></span> <strong><?php echo __( 'Email Customizer', 'woo-coupon-usage' ); ?>:</strong> <button type="button" class="wcu-showhide-button" id="wcu_show_email_registration_decline_customise">Show <span class="fa-solid fa-arrow-down"></span></button></p>

      <?php echo wcu_admin_settings_showhide_toggle("wcu_show_email_registration_decline_customise", "wcu_email_registration_decline_customise", "Show", "Hide"); ?>
      <div id="wcu_email_registration_decline_customise" style="display: none;">

        <br/>

        <!-- Email Notification Subject -->
        <?php echo wcusage_setting_text_option('wcusage_field_email_registration_decline_subject', __( "Affiliate Application Declined", "woo-coupon-usage" ), __( 'Email Notification Subject', 'woo-coupon-usage' ), '0px'); ?>

        <br/>

        <!-- Email Notification Message -->
        <?php
        $email6message = "Sorry, your affiliate application has been declined for the coupon code: {coupon}"
        . "<br/><br/>Please feel free to submit another application for a different coupon code, or contact us if you have any questions."
        . "<br/><br/>{message}";
        echo wcusage_setting_tinymce_option('wcusage_field_email_registration_decline_message', $email6message, __( 'Email Notification Message', 'woo-coupon-usage' ), '0px');
        ?>

        <br/>

        <?php echo wcusage_email_merge_tags(array("coupon", "message")); ?>

      </div>

    </div>

    <br/>
    <h3 class="wcu-setting-email-header">
      <span class="dashicons dashicons-admin-generic" style="margin-top: 2px;"></span> <?php echo __( 'Payouts Emails', 'woo-coupon-usage' ); ?>:
    </h3>
    <br/>

    <div class="wcu-setting-email-notification-box">

      <!--
      ********************
      ** [Admin Email] New Payout
      ********************
      -->
      <?php echo wcusage_setting_toggle_option('wcusage_field_email_payout_admin_enable', 1, __( 'New Payout Request', 'woo-coupon-usage' ), '0px'); ?>

      <i><?php echo __( 'Send an email to admin when there is a new payout request for unpaid commission.', 'woo-coupon-usage' ); ?></i>

      <br/><br/><p><span class="fa-solid fa-circle-user"></span> <strong><?php echo __( 'Recipient', 'woo-coupon-usage' ); ?>:</strong> <?php echo __( 'Administrator', 'woo-coupon-usage' ); ?></p>

      <br/><p><span class="fa-solid fa-envelope-open-text"></span> <strong><?php echo __( 'Email Customizer', 'woo-coupon-usage' ); ?>:</strong> <button type="button" class="wcu-showhide-button" id="wcu_show_email_payout_admin_customise">Show <span class="fa-solid fa-arrow-down"></span></button></p>

      <?php echo wcu_admin_settings_showhide_toggle("wcu_show_email_payout_admin_customise", "wcu_email_payout_admin_customise", "Show", "Hide"); ?>
      <div id="wcu_email_payout_admin_customise" style="display: none;">

        <br/>

        <!-- Email Notification Subject -->
        <?php echo wcusage_setting_text_option('wcusage_field_email_payout_admin_subject', __( "New Payout Request: {coupon}", "woo-coupon-usage" ), __( 'Email Notification Subject', 'woo-coupon-usage' ), '0px'); ?>

        <br/>

        <!-- Email Notification Message -->
        <?php
        $email4messagepayout = "You have received a new payout request from an affiliate."
        . "<br/><br/>Username: {username}"
        . "<br/><br/>Coupon code: {coupon}"
        . "<br/><br/>Amount: " . get_woocommerce_currency_symbol() . "{amount}"
        . "<br/><br/>You can manage this payout here: {adminpayoutsurl}";
        echo wcusage_setting_tinymce_option('wcusage_field_email_payout_admin_message', $email4messagepayout, __( 'Email Notification Message', 'woo-coupon-usage' ), '0px');
        ?>

        <br/>

        <?php echo wcusage_email_merge_tags(array("username", "coupon", "adminpayoutsurl", "amount")); ?>

      </div>

    </div>

    <div class="wcu-setting-email-notification-box">

      <!--
      ********************
      ** [Admin Email] New Payout Request (Bulk Scheduled)
      ********************
      -->
      <?php echo wcusage_setting_toggle_option('wcusage_field_email_payout_admin_enable', 1, __( 'New Payout Request (Bulk Scheduled)', 'woo-coupon-usage' ), '0px'); ?>

      <i><?php echo __( 'Send an email to admin when there are 1 or more "scheduled" payout requests (this will be sent instead of multiple individual emails).', 'woo-coupon-usage' ); ?></i>

      <br/><br/><p><span class="fa-solid fa-circle-user"></span> <strong><?php echo __( 'Recipient', 'woo-coupon-usage' ); ?>:</strong> <?php echo __( 'Administrator', 'woo-coupon-usage' ); ?></p>

      <br/><p><span class="fa-solid fa-envelope-open-text"></span> <strong><?php echo __( 'Email Customizer', 'woo-coupon-usage' ); ?>:</strong> <button type="button" class="wcu-showhide-button" id="wcu_show_email_payout_admin_bulk_customise">Show <span class="fa-solid fa-arrow-down"></span></button></p>

      <?php echo wcu_admin_settings_showhide_toggle("wcu_show_email_payout_admin_bulk_customise", "wcu_email_payout_admin_bulk_customise", "Show", "Hide"); ?>
      <div id="wcu_email_payout_admin_bulk_customise" style="display: none;">

        <br/>

        <!-- Email Notification Subject -->
        <?php echo wcusage_setting_text_option('wcusage_field_email_payout_admin_bulk_subject', __( "{number} New Payout Requests", "woo-coupon-usage" ), __( 'Email Notification Subject', 'woo-coupon-usage' ), '0px'); ?>

        <br/>

        <!-- Email Notification Message -->
        <?php
        $email4messagepayoutbulk = "{number} new commission payouts have been automatically requested:"
        . "<br/><br/>{payoutslist}"
        . "<br/><br/>You can manage these payouts here: {adminpayoutsurl}";
        echo wcusage_setting_tinymce_option('wcusage_field_email_payout_admin_bulk_message', $email4messagepayoutbulk, __( 'Email Notification Message', 'woo-coupon-usage' ), '0px');
        ?>

        <br/>

        <?php echo wcusage_email_merge_tags(array("number", "payoutslist", "adminpayoutsurl")); ?>

      </div>

    </div>

    <div class="wcu-setting-email-notification-box">

      <!--
      ********************
      ** [User Email] New Commission Payout
      ********************
      -->
      <?php echo wcusage_setting_toggle_option('wcusage_field_email_payout_affiliate_enable', 1, __( 'New Commission Payout', 'woo-coupon-usage' ), '0px'); ?>

      <i><?php echo __( 'Send an email to affiliates when a payout request is successfully marked as paid.', 'woo-coupon-usage' ); ?></i>

      <br/><br/><p><span class="fa-solid fa-circle-user"></span> <strong><?php echo __( 'Recipient', 'woo-coupon-usage' ); ?>:</strong> <?php echo __( 'Affiliate User', 'woo-coupon-usage' ); ?></p>

      <br/><p><span class="fa-solid fa-envelope-open-text"></span> <strong><?php echo __( 'Email Customizer', 'woo-coupon-usage' ); ?>:</strong> <button type="button" class="wcu-showhide-button" id="wcu_show_email_payout_affiliate_customise">Show <span class="fa-solid fa-arrow-down"></span></button></p>

      <?php echo wcu_admin_settings_showhide_toggle("wcu_show_email_payout_affiliate_customise", "wcu_email_payout_affiliate_customise", "Show", "Hide"); ?>
      <div id="wcu_email_payout_affiliate_customise" style="display: none;">

        <br/>

        <!-- Email Notification Subject -->
        <?php echo wcusage_setting_text_option('wcusage_field_email_payout_affiliate_subject', __( "New Commission Payout!", "woo-coupon-usage" ), __( 'Email Notification Subject', 'woo-coupon-usage' ), '0px'); ?>

        <br/>

        <!-- Email Notification Message -->
        <?php
        $payoutcurrency = get_option('woocommerce_currency');
        $email5messagepayout = "Hello {name},"
        . "<br/><br/>Your latest payout request #{id} has now been successfully paid."
        . "<br/><br/>Coupon code: {coupon}"
        . "<br/><br/>Amount: " . get_woocommerce_currency_symbol() . "{amount}"
        . "<br/><br/>Payment method: {method}";
        echo wcusage_setting_tinymce_option('wcusage_field_email_payout_affiliate_message', $email5messagepayout, __( 'Email Notification Message', 'woo-coupon-usage' ), '0px');
        ?>

        <br/>

        <?php echo wcusage_email_merge_tags(array("username", "coupon", "amount", "method", "name")); ?>

      </div>

    </div>

    <?php echo wcusage_setting_toggle('.wcusage_field_enable_directlinks', '.wcu-field-section-directlinks'); // Show or Hide ?>
    <span class="wcu-field-section-directlinks">

        <br/>
        <h3 class="wcu-setting-email-header">
          <span class="dashicons dashicons-admin-generic" style="margin-top: 2px;"></span> <?php echo __( 'Direct Link Tracking Emails', 'woo-coupon-usage' ); ?>:
        </h3>
        <br/>

        <div class="wcu-setting-email-notification-box">

          <!--
          ********************
          ** [Admin Email] New Domain Request
          ********************
          -->
          <?php echo wcusage_setting_toggle_option('wcusage_field_email_direct_link_admin_enable', 1, __( 'New "Direct Link Tracking" Domain', 'woo-coupon-usage' ), '0px'); ?>

          <i><?php echo __( 'Send an email to admin when a new domain is added by affiliate for direct link tracking.', 'woo-coupon-usage' ); ?></i>

          <br/><br/><p><span class="fa-solid fa-circle-user"></span> <strong><?php echo __( 'Recipient', 'woo-coupon-usage' ); ?>:</strong> <?php echo __( 'Administrator', 'woo-coupon-usage' ); ?></p>

          <br/><p><span class="fa-solid fa-envelope-open-text"></span> <strong><?php echo __( 'Email Customizer', 'woo-coupon-usage' ); ?>:</strong> <button type="button" class="wcu-showhide-button" id="wcu_show_email_direct_link_admin_customise">Show <span class="fa-solid fa-arrow-down"></span></button></p>

          <?php echo wcu_admin_settings_showhide_toggle("wcu_show_email_direct_link_admin_customise", "wcu_email_direct_link_admin_customise", "Show", "Hide"); ?>
          <div id="wcu_email_direct_link_admin_customise" style="display: none;">

            <br/>

            <!-- Email Notification Subject -->
            <?php echo wcusage_setting_text_option('wcusage_field_email_direct_link_admin_subject', __( "New Domain Request (Direct Link Tracking)", "woo-coupon-usage" ), __( 'Email Notification Subject', 'woo-coupon-usage' ), '0px'); ?>

            <br/>

            <!-- Email Notification Message -->
            <?php
            $email6message = "You have received a new domain request for direct link tracking."
            . "<br/><br/>Coupon code: {coupon}"
            . "<br/><br/>Domain: {domain}"
            . "<br/><br/>You can approve or decline this domain here: {adminurl}";
            echo wcusage_setting_tinymce_option('wcusage_field_email_direct_link_admin_message', $email6message, __( 'Email Notification Message', 'woo-coupon-usage' ), '0px');
            ?>

            <br/>

            <?php echo wcusage_email_merge_tags(array("coupon", "domain", "adminurl")); ?>

          </div>

        </div>

        <div class="wcu-setting-email-notification-box">

          <!--
          ********************
          ** [Admin Email] New Domain Request
          ********************
          -->
          <?php echo wcusage_setting_toggle_option('wcusage_field_email_direct_link_accept_enable', 1, __( 'Domain Accepted', 'woo-coupon-usage' ), '0px'); ?>

          <i><?php echo __( 'Send an email to affiliate users when their domain is accepted for Direct Link Tracking.', 'woo-coupon-usage' ); ?></i>

          <br/><br/><p><span class="fa-solid fa-circle-user"></span> <strong><?php echo __( 'Recipient', 'woo-coupon-usage' ); ?>:</strong> <?php echo __( 'Affiliate User', 'woo-coupon-usage' ); ?></p>

          <br/><p><span class="fa-solid fa-envelope-open-text"></span> <strong><?php echo __( 'Email Customizer', 'woo-coupon-usage' ); ?>:</strong> <button type="button" class="wcu-showhide-button" id="wcu_show_email_direct_link_accept_customise">Show <span class="fa-solid fa-arrow-down"></span></button></p>

          <?php echo wcu_admin_settings_showhide_toggle("wcu_show_email_direct_link_accept_customise", "wcu_email_direct_link_accept_customise", "Show", "Hide"); ?>
          <div id="wcu_email_direct_link_accept_customise" style="display: none;">

            <br/>

            <!-- Email Notification Subject -->
            <?php echo wcusage_setting_text_option('wcusage_field_email_direct_link_accept_subject', __( "Domain Accepted: {domain}", "woo-coupon-usage" ), __( 'Email Notification Subject', 'woo-coupon-usage' ), '0px'); ?>

            <br/>

            <!-- Email Notification Message -->
            <?php
            $email7message = "Hello {name},"
            . "<br/><br/>Your domain has been accepted for direct link tracking."
            . "<br/><br/>Coupon code: {coupon}"
            . "<br/><br/>Domain: {domain}"
            . "<br/><br/>You can now link directly to our website on this domain, and it will work in the same way as a referral URL."
            . "<br/><br/>"
            . "{dashboardurl}";
            echo wcusage_setting_tinymce_option('wcusage_field_email_direct_link_accept_message', $email7message, __( 'Email Notification Message', 'woo-coupon-usage' ), '0px');
            ?>

            <br/>

            <?php echo wcusage_email_merge_tags(array("coupon", "domain", "name", "username", "dashboardurl")); ?>

          </div>

        </div>

        <div class="wcu-setting-email-notification-box">

          <!--
          ********************
          ** [User Email] Domain Request Declined
          ********************
          -->
          <?php echo wcusage_setting_toggle_option('wcusage_field_email_direct_link_decline_enable', 1, __( 'Domain Declined', 'woo-coupon-usage' ), '0px'); ?>

          <i><?php echo __( 'Send an email to affiliate users when their domain is declined for Direct Link Tracking.', 'woo-coupon-usage' ); ?></i>

          <br/><br/><p><span class="fa-solid fa-circle-user"></span> <strong><?php echo __( 'Recipient', 'woo-coupon-usage' ); ?>:</strong> <?php echo __( 'Affiliate User', 'woo-coupon-usage' ); ?></p>

          <br/><p><span class="fa-solid fa-envelope-open-text"></span> <strong><?php echo __( 'Email Customizer', 'woo-coupon-usage' ); ?>:</strong> <button type="button" class="wcu-showhide-button" id="wcu_show_email_direct_link_decline_customise">Show <span class="fa-solid fa-arrow-down"></span></button></p>

          <?php echo wcu_admin_settings_showhide_toggle("wcu_show_email_direct_link_decline_customise", "wcu_email_direct_link_decline_customise", "Show", "Hide"); ?>
          <div id="wcu_email_direct_link_decline_customise" style="display: none;">

            <br/>

            <!-- Email Notification Subject -->
            <?php echo wcusage_setting_text_option('wcusage_field_email_direct_link_decline_subject', __( "Domain Declined: {domain}", "woo-coupon-usage" ), __( 'Email Notification Subject', 'woo-coupon-usage' ), '0px'); ?>

            <br/>

            <!-- Email Notification Message -->
            <?php
            $email7message = "Hello {name},"
            . "<br/><br/>Sorry, your domain has been declined for direct link tracking."
            . "<br/><br/>Coupon code: {coupon}"
            . "<br/><br/>Domain: {domain}";
            echo wcusage_setting_tinymce_option('wcusage_field_email_direct_link_decline_message', $email7message, __( 'Email Notification Message', 'woo-coupon-usage' ), '0px');
            ?>

            <br/>

            <?php echo wcusage_email_merge_tags(array("coupon", "domain", "name", "username", "dashboardurl")); ?>

          </div>

        </div>

    </span>

    <?php echo wcusage_setting_toggle('.wcusage_field_mla_enable', '.wcu-field-section-mla-emails'); // Show or Hide ?>
    <span class="wcu-field-section-mla-emails">

        <br/>
        <h3 class="wcu-setting-email-header">
          <span class="dashicons dashicons-admin-generic" style="margin-top: 2px;"></span> <?php echo __( 'Multi-Level Affiliate Emails', 'woo-coupon-usage' ); ?>:
        </h3>
        <br/>

        <div class="wcu-setting-email-notification-box">

          <!--
          ********************
          ** [User Email] Affiliate Program Invitation
          ********************
          -->
          <?php echo wcusage_setting_toggle_option('wcusage_field_email_mla_invite_enable', 1, __( 'Affiliate Program Invitation', 'woo-coupon-usage' ), '0px'); ?>

          <i><?php echo __( 'Send an email when parent invite enters an email address to send affiliate program invitation.', 'woo-coupon-usage' ); ?></i>

          <br/><br/><p><span class="fa-solid fa-circle-user"></span> <strong><?php echo __( 'Recipient', 'woo-coupon-usage' ); ?>:</strong> <?php echo __( 'Affiliate User', 'woo-coupon-usage' ); ?></p>

          <br/><p><span class="fa-solid fa-envelope-open-text"></span> <strong><?php echo __( 'Email Customizer', 'woo-coupon-usage' ); ?>:</strong> <button type="button" class="wcu-showhide-button" id="wcu_show_email_mla_invite_customise">Show <span class="fa-solid fa-arrow-down"></span></button></p>

          <?php echo wcu_admin_settings_showhide_toggle("wcu_show_email_mla_invite_customise", "wcu_email_mla_invite_customise", "Show", "Hide"); ?>
          <div id="wcu_email_mla_invite_customise" style="display: none;">

            <br/>

            <!-- Email Notification Subject -->
            <?php echo wcusage_setting_text_option('wcusage_field_email_mla_invite_subject', __( "Affiliate Program Invitation", "woo-coupon-usage" ), __( 'Email Notification Subject', 'woo-coupon-usage' ), '0px'); ?>

            <br/>

            <!-- Email Notification Message -->
            <?php
            $email51message = "Hello,"
            . "<br/><br/>You have just been invited to join our affiliate program."
            . "<br/><br/>Earn commission on all the sales that you refer to us!"
            . "<br/><br/>Get started by registering here: {inviteurl}";
            echo wcusage_setting_tinymce_option('wcusage_field_email_mla_invite_message', $email51message, __( 'Email Notification Message', 'woo-coupon-usage' ), '0px');
            ?>

            <br/>

            <?php echo wcusage_email_merge_tags(array("inviteurl", "inviteurltext")); ?>

          </div>

        </div>

        <div class="wcu-setting-email-notification-box">

          <!--
          ********************
          ** [Parent Email] Affiliate Program Invitation
          ********************
          -->
          <?php echo wcusage_setting_toggle_option('wcusage_field_email_mla_sub_referral_enable', 1, __( 'New Sub-Affiliate Referral', 'woo-coupon-usage' ), '0px'); ?>

          <i><?php echo __( 'Send an email to parent affiliate when a sub-affiliate refers a new order (and it is completed).', 'woo-coupon-usage' ); ?></i>

          <br/><br/><p><span class="fa-solid fa-circle-user"></span> <strong><?php echo __( 'Recipient', 'woo-coupon-usage' ); ?>:</strong> <?php echo __( 'Parent Affiliate User', 'woo-coupon-usage' ); ?></p>

          <br/><p><span class="fa-solid fa-envelope-open-text"></span> <strong><?php echo __( 'Email Customizer', 'woo-coupon-usage' ); ?>:</strong> <button type="button" class="wcu-showhide-button" id="wcu_show_email_mla_sub_referral_customise">Show <span class="fa-solid fa-arrow-down"></span></button></p>

          <?php echo wcu_admin_settings_showhide_toggle("wcu_show_email_mla_sub_referral_customise", "wcu_email_mla_sub_referral_customise", "Show", "Hide"); ?>
          <div id="wcu_email_mla_sub_referral_customise" style="display: none;">

            <br/>

            <!-- Email Notification Subject -->
            <?php echo wcusage_setting_text_option('wcusage_field_email_mla_sub_referral_subject', __( "(MLA) New Sub-Affiliate Referral", "woo-coupon-usage" ), __( 'Email Notification Subject', 'woo-coupon-usage' ), '0px'); ?>

            <br/>

            <!-- Email Notification Message -->
            <?php
            $email51message = "Hello {name},"
            . "<br/><br/>Congratulations, your sub-affiliate member '{sub-affiliate-user}' has referrered a new sale!"
            . "<br/><br/>You earned a commission share of: {commission}";
            echo wcusage_setting_tinymce_option('wcusage_field_email_mla_sub_referral_message', $email51message, __( 'Email Notification Message', 'woo-coupon-usage' ), '0px');
            ?>

            <br/>

            <?php echo wcusage_email_merge_tags(array("name", "sub-affiliate-user", "commission")); ?>

          </div>

        </div>

        <div class="wcu-setting-email-notification-box">

          <!--
          ********************
          ** [Parent Email] Affiliate Program Invitation
          ********************
          -->
          <?php echo wcusage_setting_toggle_option('wcusage_field_email_mla_sub_signup_enable', 1, __( 'New Sub-Affiliate Signup', 'woo-coupon-usage' ), '0px'); ?>

          <i><?php echo __( 'Send an email to parent affiliate when a new affiliate signs up in their MLA network.', 'woo-coupon-usage' ); ?></i>

          <br/><br/><p><span class="fa-solid fa-circle-user"></span> <strong><?php echo __( 'Recipient', 'woo-coupon-usage' ); ?>:</strong> <?php echo __( 'Parent Affiliate User', 'woo-coupon-usage' ); ?></p>

          <br/><p><span class="fa-solid fa-envelope-open-text"></span> <strong><?php echo __( 'Email Customizer', 'woo-coupon-usage' ); ?>:</strong> <button type="button" class="wcu-showhide-button" id="wcu_show_email_mla_sub_signup_customise">Show <span class="fa-solid fa-arrow-down"></span></button></p>

          <?php echo wcu_admin_settings_showhide_toggle("wcu_show_email_mla_sub_signup_customise", "wcu_email_mla_sub_signup_customise", "Show", "Hide"); ?>
          <div id="wcu_email_mla_sub_signup_customise" style="display: none;">

            <br/>

            <!-- Email Notification Subject -->
            <?php echo wcusage_setting_text_option('wcusage_field_email_mla_sub_signup_subject', __( "New Sub-Affiliate Signup", "woo-coupon-usage" ), __( 'Email Notification Subject', 'woo-coupon-usage' ), '0px'); ?>

            <br/>

            <!-- Email Notification Message -->
            <?php
            $email51message = "Hello {name},"
            . "<br/><br/>The user '{sub-affiliate-user}' has just become a tier {sub-affiliate-tier} affiliate in your MLA network!"
            . "<br/><br/>You will earn {sub-affiliate-commission}% commission on all sales they refer to us.";
            echo wcusage_setting_tinymce_option('wcusage_field_email_mla_sub_signup_message', $email51message, __( 'Email Notification Message', 'woo-coupon-usage' ), '0px');
            ?>

            <br/>

            <?php echo wcusage_email_merge_tags(array("name", "sub-affiliate-user", "sub-affiliate-tier", "sub-affiliate-commission")); ?>

          </div>

        </div>

    </span>

    </div>

	</div>

 <?php
}

/**
 * Settings Section: Email FREE
 *
 */
add_action( 'wcusage_hook_setting_section_email_free', 'wcusage_setting_section_email_free', 10, 1 );
if( !function_exists( 'wcusage_setting_sectio_email_free' ) ) {
  function wcusage_setting_section_email_free($type = "") {

  $options = get_option( 'wcusage_options' );
  ?>

    <!-- From Email Address -->
    <?php echo wcusage_setting_text_option('wcusage_field_from_email', '', __( 'From Email Address:', 'woo-coupon-usage' ), '0px'); ?>

    <br/>

    <!-- From Name -->
    <?php echo wcusage_setting_text_option('wcusage_field_from_name', '', __( 'From Name:', 'woo-coupon-usage' ), '0px'); ?>
    <i><?php echo __( '(If you are using a mail SMTP plugin, the from email and name may be overridden.)', 'woo-coupon-usage' ); ?></i><br/>

  <?php if( wcu_fs()->can_use_premium_code() ) { ?>

    <br/>

    <!-- Admin email address for notifications -->
    <?php echo wcusage_setting_text_option('wcusage_field_registration_admin_email', get_bloginfo( 'admin_email' ), __( 'Email address for recieving admin notifications:', 'woo-coupon-usage' ), '0px'); ?>
    <i><?php echo __( 'This is the email address that will recieve admin notifications such as new affiliate applications, and payout notifications.', 'woo-coupon-usage' ); ?></i>

    <br/>

  <?php } ?>

    <br/>
    <hr style="margin-bottom: 35px;"/>

    <h3 class="wcu-setting-email-header">
      <span class="dashicons dashicons-admin-generic" style="margin-top: 2px;"></span> <?php echo __( 'New Referral Emails', 'woo-coupon-usage' ); ?>:
    </h3>
    <br/>

    <!--
    ********************
    ** [User Email] New Coupon Usage / Pending Commission Earned
    ********************
    -->
    <div class="wcu-setting-email-notification-box">

      <span id="wcu-setting-email-notification-new-usage">
      <?php echo wcusage_setting_toggle_option('wcusage_field_email_enable', 1, __( 'New Coupon Usage / Commission Earned', 'woo-coupon-usage' ), '0px'); ?>
      </span>

      <i><?php echo __( 'Send an email to affiliates whenever their coupon code is used (and the order is "completed").', 'woo-coupon-usage' ); ?></i>

      <br/><br/><p><span class="fa-solid fa-circle-user"></span> <strong><?php echo __( 'Recipient', 'woo-coupon-usage' ); ?>:</strong> <?php echo __( 'Affiliate User', 'woo-coupon-usage' ); ?></p>

      <br/><p><span class="fa-solid fa-envelope-open-text"></span> <strong><?php echo __( 'Email Customizer', 'woo-coupon-usage' ); ?>:</strong> <button type="button" class="wcu-showhide-button" id="wcu_show_email_customise_1">Show <span class="fa-solid fa-arrow-down"></span></button></p>

      <?php echo wcu_admin_settings_showhide_toggle("wcu_show_email_customise_1", "wcu_email_customise_1", "Show", "Hide"); ?>
      <div id="wcu_email_customise_1" style="display: none;">

        <br/>

        <!-- Email Notification Subject -->
        <?php echo wcusage_setting_text_option('wcusage_field_email_subject', __( "New Coupon Usage", "woo-coupon-usage" ), __( 'Email Notification Subject', 'woo-coupon-usage' ), '0px'); ?>

        <br/>

        <?php
        $email1message = "Hello {name},\r\n<br/>\r\nCongratulations, your coupon code '{coupon}' has just been used in a new order.\r\n<br/>\r\nYou have earned {commission} in unpaid commission!\r\n<br/>\r\nThank you for your support.\r\n<br>\r\n" . get_bloginfo( 'name' );
        echo wcusage_setting_tinymce_option('wcusage_field_email_message', $email1message, __( 'Email Notification Message', 'woo-coupon-usage' ), '0px');
        ?>

        <br/>

        <?php echo wcusage_email_merge_tags(array("name", "email", "coupon", "commission", "id", "listproducts")); ?>

      </div>

    </div>

  <?php
  }
}

/**
 * Gets the merge tags for email notifications
 *
 */
if( !function_exists( 'wcusage_email_merge_tags' ) ) {
  function wcusage_email_merge_tags($array) {
    ?>

    <p><strong><?php echo __( 'Supported merge tags', 'woo-coupon-usage' ); ?>:</strong></p>

    <?php
    foreach ($array as &$i) {

      switch ($i) {

          case "name":
              echo "<p>- <strong>{name}</strong> ".__( 'to show the users display name.', 'woo-coupon-usage' )."</p>";
              break;
          case "email":
              echo "<p>- <strong>{email}</strong> ".__( 'to show the users email address.', 'woo-coupon-usage' )."</p>";
              break;
          case "coupon":
              echo "<p>- <strong>{coupon}</strong> ".__( 'to show the coupon code.', 'woo-coupon-usage' )."</p>";
              break;
          case "commission":
              echo "<p>- <strong>{commission}</strong> ".__( 'to show the users commission earned on that order.', 'woo-coupon-usage' )."</p>";
              break;
          case "id":
              echo "<p>- <strong>{id}</strong> ".__( 'to show the order ID.', 'woo-coupon-usage' )."</p>";
              break;
          case "listproducts":
              echo "<p>- <strong>{listproducts}</strong> ".__( 'to show a list of the products purchased (and quantities).', 'woo-coupon-usage' )."</p>";
              break;
          case "username":
              echo "<p>- <strong>{username}</strong> ".__( 'to show the account username.', 'woo-coupon-usage' )."</p>";
              break;
          case "dashboardurl":
              echo "<p>- <strong>{dashboardurl}</strong> ".__( 'to show the affiliate dashboard URL.', 'woo-coupon-usage' )."</p>";
              break;
          case "adminurl":
              echo "<p>- <strong>{adminurl}</strong> ".__( 'to show the admin URL.', 'woo-coupon-usage' )."</p>";
              break;
          case "message":
              echo "<p>- <strong>{message}</strong> ".__( 'to show the custom message entered when admins accept/decline affiliate applications.', 'woo-coupon-usage' )."</p>";
              break;
          case "amount":
              echo "<p>- <strong>{amount}</strong> ".__( 'to show the amount.', 'woo-coupon-usage' )."</p>";
              break;
          case "adminpayoutsurl":
              echo "<p>- <strong>{adminpayoutsurl}</strong> ".__( 'to show the admin URL to manage payouts.', 'woo-coupon-usage' )."</p>";
              break;
          case "number":
              echo "<p>- <strong>{number}</strong> ".__( 'to show the number.', 'woo-coupon-usage' )."</p>";
              break;
          case "payoutslist":
              echo "<p>- <strong>{payoutslist}</strong> ".__( 'to show a list of all the payouts.', 'woo-coupon-usage' )."</p>";
              break;
          case "method":
              echo "<p>- <strong>{payoutslist}</strong> ".__( 'to show the payout method.', 'woo-coupon-usage' )."</p>";
              break;
          case "domain":
              echo "<p>- <strong>{domain}</strong> ".__( 'to show the domain.', 'woo-coupon-usage' )."</p>";
              break;
          case "inviteurl":
              echo "<p>- <strong>{inviteurl}</strong> ".__( 'to show the invite referral UR (with hyperlink) for the registration form.', 'woo-coupon-usage' )."</p>";
              break;
          case "inviteurltext":
              echo "<p>- <strong>{inviteurltext}</strong> ".__( 'to show the invite referral URL without hyperlink (to create your own link/button).', 'woo-coupon-usage' )."</p>";
              break;
          case "sub-affiliate-user":
              echo "<p>- <strong>{sub-affiliate-user}</strong> ".__( 'to the sub-affiliate username.', 'woo-coupon-usage' )."</p>";
              break;

      }

    }

  }
}
