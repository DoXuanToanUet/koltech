<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * The PRO version tab on admin settings page
 *
 * @param string $args
 *
 */
function wcusage_field_cb_pro_details( $args )
{
  $options = get_option( 'wcusage_options' );

  $ispro = true;
  if( !wcu_fs()->can_use_premium_code() || !wcu_fs()->is_plan('pro') || !wcu_fs()->is_premium() ) { $ispro = false; }
  ?>

  <script>
  jQuery( document ).ready(function() {

    jQuery("input:checkbox").change(function () {
        var value = jQuery(this).attr("name");
        jQuery(":checkbox[name='" + value + "']").prop("checked", this.checked);
    });

  });
  </script>

<div id="pro-details" class="pro-details">

  <?php if(!$ispro) { ?>

  <div class="wcu-pro-details-col-1">

    <div class="wcu-pro-col-inner">

  	<h2 style="margin-bottom: 5px;">Coupon Affiliates: PRO Version</h2>

    PRO is a paid upgrade which provides a whole bunch of exciting addons and extra features to take your coupon affiliate system to the next level.

    <br/><br/>This includes advanced admin reports, affiliate registrations, payout management, monthly summary, campaigns, creatives, and lots more!

    <br/><br/><?php echo __( 'Learn more about PRO at', 'woo-coupon-usage' ); ?> <a href="https://couponaffiliates.com?utm_source=dashboard-link&utm_medium=pro-tab" target="_blank">couponaffiliates.com</a>

    <br/><br/>

    <p style="font-size: 20px; margin-bottom: 0px;">Upgrade for just $12.99 per month.</p><br/>

    <a href="<?php echo get_site_url(); ?>/wp-admin/admin.php?billing_cycle=annual&page=wcusage-pricing&trial=true" class="button button-primary" style="background: green; padding: 5px 20px;">
        <?php echo __( 'Start your FREE 7 Day Trial', 'woo-coupon-usage' ); ?> <i class="fas fa-arrow-right" style="background: transparent; color: #fff;"></i>
    </a>

    <?php
    // Black Friday Deal
    $todayDate = strtotime('now');
    $dealDateBegin = strtotime('10-12-2022');
    $dealDateEnd = strtotime('31-12-2022');
    if ($todayDate >= $dealDateBegin && $todayDate <= $dealDateEnd) { $specialsale = true; } else { $specialsale = false; }
    ?>
    <p style="margin-top: 20px;">
      <?php if(!$specialsale) { ?>
      <strong style="color: red;"><span class="fas fa-star fa-spin"></span> Get 15% off PRO today with code: DASH15</strong>
    <?php } else { ?>
      <strong style="color: red;"><span class="fas fa-star fa-spin"></span> Holiday Sale: Get 20% off PRO with code: FESTIVE2021</strong>
    <?php } ?>
    </p>

    <br/><br/><br/>

    </div>

  </div>

  <div class="wcu-pro-details-col-2">

    <div class="wcu-pro-col-inner">

      <center>
      <strong style="margin-bottom: 8px; display: block;">PRO Dashboard Example:</strong>
      <div style="box-shadow: 0px 0px 5px #000; margin-bottom: 35px;">
        <div class="wistia_responsive_padding" style="padding:60.42% 0 0 0;position:relative;"><div class="wistia_responsive_wrapper" style="height:100%;left:0;position:absolute;top:0;width:100%;"><iframe src="https://fast.wistia.net/embed/iframe/5vmaa8bn3i?seo=false&videoFoam=true" title="Coupon Affs Demo Video" allow="autoplay; fullscreen" allowtransparency="true" frameborder="0" scrolling="no" class="wistia_embed" name="wistia_embed" msallowfullscreen width="100%" height="100%"></iframe></div></div>
        <script src="https://fast.wistia.net/assets/external/E-v1.js" async></script>
      </div>
      </center>

    </div>

  </div>

  <div style="clear: both;"></div>

  <?php } ?>

<h1 style="margin-bottom: 5px;">PRO <?php echo __( 'Modules & Features', 'woo-coupon-usage' ); ?>:</h1>

<hr/>

<p><?php echo __( 'The below section includes a list of most of the modules and features included in the Pro plan. However other smaller features and customisations can be found throughout the settings page.', 'woo-coupon-usage' ); ?></p>
<br/>

<!-- Advanced Admin Reports -->
<?php echo wcusage_output_addon_box(
__( 'Advanced Admin Reports', 'woo-coupon-usage' ),
"wcusage_field_addon_default",
__( 'Access to unlimited date range, export to excel, and date comparison features on the admin reports.', 'woo-coupon-usage' ),
"https://couponaffiliates.com/docs/admin-reports-analytics",
"far fa-list-alt",
1,
1,
0,
'',
''
);
?>

<!-- Affiliate Reports -->
<?php echo wcusage_output_addon_box(
__( 'Affiliate Email Reports', 'woo-coupon-usage' ),
"wcusage_field_enable_reports",
__( 'Automatically send an email report (and PDF) to affiliates every week/month with a summary of their recent commission and referral stats.', 'woo-coupon-usage' ),
"https://couponaffiliates.com/docs/pro-affiliate-reports",
"far fa-file-pdf",
0,
0,
0,
'tab-reports',
'affiliate-reports-settings'
);
?>

<!-- Affiliate Registration -->
<?php echo wcusage_output_addon_box(
__( 'Affiliate Registration', 'woo-coupon-usage' ),
"wcusage_field_registration_enable",
__( 'Users can register as an affiliate and pick their coupon code. Admins can approve/decline applications.', 'woo-coupon-usage' ),
"https://couponaffiliates.com/docs/pro-affiliate-registration",
"far fa-user-circle",
1,
0,
0,
'tab-registration',
'registration-settings'
);
?>

<?php echo wcusage_output_addon_box(
__( '(MLA) Multi-Level Affiliates', 'woo-coupon-usage' ),
"wcusage_field_mla_enable",
__( 'Your users can become super-affiliates and invite other affiliates to be a part of their network. They will then earn extra commission from all their referrals.', 'woo-coupon-usage' ),
"https://couponaffiliates.com/docs/pro-multi-level-affiliates",
"fa-solid fa-users",
0,
0,
0,
'tab-mla',
''
);
?>

<!-- Monthly Summary -->
<?php echo wcusage_output_addon_box(
__( 'Monthly Summary', 'woo-coupon-usage' ),
"wcusage_field_show_months_table",
__( 'Show a table with a monthly summary of orders for the coupon, with total sales, commission, and more.', 'woo-coupon-usage' ),
"https://couponaffiliates.com/docs/pro-monthly-summary-table",
"far fa-calendar-alt",
1,
0,
0,
'tab-general',
'wcu-setting-header-monthly-summary'
);
?>

<?php echo wcusage_output_addon_box(
__( 'Creatives', 'woo-coupon-usage' ),
"wcusage_field_creatives_enable",
__( 'Display a creatives section with downloadable banners. They can also generate an embed code to easily display it on their site.', 'woo-coupon-usage' ),
"https://couponaffiliates.com/docs/pro-creatives",
"fas fa-images",
1,
0,
0,
'tab-creatives',
'creatives-settings'
);
?>

<!-- Custom Coupon Commission -->
<?php echo wcusage_output_addon_box(
__( 'Custom Commission Per Coupon, Product, or User Role', 'woo-coupon-usage' ),
"wcusage_field_addon_default",
__( 'Set custom "flexible commission" amounts for each individual coupon, product or user role.', 'woo-coupon-usage' ),
"https://couponaffiliates.com/docs/flexible-commission-settings",
"fas fa-cogs",
1,
1,
0,
'',
''
);
?>

<?php echo wcusage_output_addon_box(
__( 'Campaigns (Referral URL)', 'woo-coupon-usage' ),
"wcusage_field_show_campaigns",
__( 'Allow your affiliates to create referral "campaigns" and then create custom URLs to track clicks/conversions per campaign.', 'woo-coupon-usage' ),
"https://couponaffiliates.com/docs/pro-campaigns",
"fas fa-bullhorn",
1,
0,
0,
'tab-urls',
'wcu-setting-header-referral-campaigns'
);
?>

<?php echo wcusage_output_addon_box(
__( 'Social Sharing (Referral URL)', 'woo-coupon-usage' ),
"wcusage_field_show_social",
__( 'Add social sharing buttons to the referral URL tab, so affiliates can instantly share their generated referral link.', 'woo-coupon-usage' ),
"https://couponaffiliates.com/docs/pro-social-sharing",
"fas fa-share-alt",
1,
0,
0,
'tab-urls',
'wcu-setting-header-referral-social'
);
?>

<?php echo wcusage_output_addon_box(
__( 'Short URL Generator (Referral URL)', 'woo-coupon-usage' ),
"wcusage_field_show_shortlink",
__( 'Add a button to the referral URL tab, to allow affiliate users to generate a short URL for their referral link automatically.', 'woo-coupon-usage' ),
"https://couponaffiliates.com/docs/pro-short-url",
"fas fa-crop-alt",
0,
0,
0,
'tab-urls',
'wcu-setting-header-referral-short'
);
?>

<?php echo wcusage_output_addon_box(
__( 'QR Code Generator (Referral URL)', 'woo-coupon-usage' ),
"wcusage_field_show_qrcodes",
__( 'Add a button to the referral URL tab, to allow affiliate users to automatically generate a QR code for their referral link.', 'woo-coupon-usage' ),
"https://couponaffiliates.com/docs/pro-qr-codes",
"fas fa-qrcode",
0,
0,
0,
'tab-urls',
'wcu-setting-header-referral-qr'
);
?>

<?php echo wcusage_output_addon_box(
__( 'Direct Link Tracking (Referrals)', 'woo-coupon-usage' ),
"wcusage_field_enable_directlinks",
__( 'Affiliates can link directly to your website via their website without needing an affiliate link.', 'woo-coupon-usage' ),
"https://couponaffiliates.com/docs/pro-direct-link-tracking",
"fas fa-link",
1,
0,
0,
'tab-urls',
'wcu-setting-header-referral-directlinks'
);
?>

<?php echo wcusage_output_addon_box(
__( 'Affiliate Landing Pages (Referrals)', 'woo-coupon-usage' ),
"wcusage_field_landing_pages",
__( 'Ability to link a landing page to an affiliate coupon, which will then work the same as a referral URL.', 'woo-coupon-usage' ),
"https://couponaffiliates.com/docs/pro-affiliate-landing-pages",
"fas fa-laptop-code",
0,
0,
0,
'tab-urls',
'wcu-setting-header-landing-pages'
);
?>

<?php echo wcusage_output_addon_box(
__( 'Payouts Features', 'woo-coupon-usage' ),
"wcusage_field_tracking_enable",
__( 'Enable Payouts features, and automatically add "unpaid" commission to the affiliates account on order completion, ready for payout.', 'woo-coupon-usage' ),
"https://couponaffiliates.com/docs/commission-tracking-and-payouts",
"fas fa-dollar-sign",
1,
0,
0,
'tab-payouts',
'payouts-settings'
);
?>

<?php echo wcusage_output_addon_box(
__( 'Payout Requests (Payouts)', 'woo-coupon-usage' ),
"wcusage_field_payouts_enable",
__( 'Affiliates can select a payment method, then request and track payouts for unpaid commission, if they meet the threshold.', 'woo-coupon-usage' ),
"https://couponaffiliates.com/docs/commission-tracking-and-payouts",
"fas fa-hand-holding-medical",
1,
0,
0,
'tab-payouts',
'payouts-settings'
);
?>

<?php echo wcusage_output_addon_box(
__( 'PayPal Payouts', 'woo-coupon-usage' ),
"wcusage_field_paypalapi_enable",
__( 'Automatically pay your affiliates in one-click with PayPal Payouts! Your affiliates get paid instantly directly from your account.', 'woo-coupon-usage' ),
"https://couponaffiliates.com/docs/pro-paypal-payouts",
"fab fa-paypal",
1,
0,
0,
'tab-payouts',
'paypalapi-settings'
);
?>

<?php echo wcusage_output_addon_box(
__( 'Stripe Payouts', 'woo-coupon-usage' ),
"wcusage_field_stripeapi_enable",
__( 'Automatically pay your affiliates in one-click with Stripe! Your affiliates get paid instantly directly from your Stripe funds.', 'woo-coupon-usage' ),
"https://couponaffiliates.com/docs/pro-stripe-payouts",
"fab fa-stripe-s",
1,
0,
0,
'tab-payouts',
'stripeapi-settings'
);
?>

<?php echo wcusage_output_addon_box(
__( 'Store Credit Payouts', 'woo-coupon-usage' ),
"wcusage_field_storecredit_enable",
__( 'Allow your affiliates to request commission payouts as "Store Credit" which they can use towards purchases in your store at checkout.', 'woo-coupon-usage' ),
"https://couponaffiliates.com/docs/pro-store-credit",
"far fa-credit-card",
1,
0,
0,
'tab-payouts',
'storecredit-settings'
);
?>

<?php echo wcusage_output_addon_box(
__( 'Scheduled Requests (Payouts)', 'woo-coupon-usage' ),
"wcusage_field_enable_payoutschedule",
__( 'Automatically submit "payout requests" for your affiliates, every month, week or day, if they meet certain criteria.', 'woo-coupon-usage' ),
"https://couponaffiliates.com/docs/pro-scheduled-payouts",
"fas fa-hourglass-start",
1,
0,
0,
'tab-payouts',
'wcu-setting-header-payouts-scheduled'
);
?>

<?php echo wcusage_output_addon_box(
__( 'Invoices (Payouts)', 'woo-coupon-usage' ),
"wcusage_field_payouts_enable_invoices",
__( 'Allow affiliates to upload their invoice when requesting a payout for their unpaid commission.', 'woo-coupon-usage' ),
"https://couponaffiliates.com/docs/pro-payout-invoices",
"fas fa-file-invoice",
0, // Default
0, // Always
0, // Soon
'tab-invoices',
'invoices-settings'
);
?>

<?php echo wcusage_output_addon_box(
__( 'PDF Statements (Payouts)', 'woo-coupon-usage' ),
"wcusage_field_payouts_enable_statements",
__( 'Automatically generate a PDF statement when your affiliates request a commission payout.', 'woo-coupon-usage' ),
"https://couponaffiliates.com/docs/pro-payout-statements",
"fas fa-receipt",
0, // Default
0, // Always
0, // Soon
'tab-invoices',
'statements-settings'
);
?>

<?php echo wcusage_output_addon_box(
__( 'Delayed Commission (Payouts)', 'woo-coupon-usage' ),
"wcusage_field_addon_default",
__( 'Automatically add unpaid commission a number of days after completion (optional).', 'woo-coupon-usage' ),
"https://couponaffiliates.com/docs/commission-tracking-and-payouts",
"fas fa-hourglass-start",
0,
1,
0,
'tab-payouts',
'wcu-setting-header-payouts-general'
);
?>

<?php echo wcusage_output_addon_box(
__( 'Commission Line Graphs', 'woo-coupon-usage' ),
"wcusage_field_show_graphs",
__( 'Show some nice line graphs on the statistics tab of the affiliate dashboard.', 'woo-coupon-usage' ),
"https://couponaffiliates.com/docs/line-graphs",
"fas fa-chart-line",
1,
0,
0,
'',
''
);
?>

<!-- Excel Export -->
<?php echo wcusage_output_addon_box(
__( 'Export to Excel Buttons', 'woo-coupon-usage' ),
"",
__( 'Show an "export to excel" button for the "monthly summary" and "recent orders" tables.', 'woo-coupon-usage' ),
"https://couponaffiliates.com/docs/export-to-excel",
"far fa-file-excel",
0,
1,
0,
'tab-general',
'wcu-setting-header-export'
);
?>

<?php echo wcusage_output_addon_box(
__( 'Custom Dashboard Tabs', 'woo-coupon-usage' ),
"wcusage_field_addon_default",
__( 'Create your own tabs, to display custom sections and content on the affiliate dashboard.', 'woo-coupon-usage' ),
"https://couponaffiliates.com/docs/pro-custom-tabs",
"fas fa-pager",
0,
1,
0,
'tab-custom-tabs',
'custom-tabs-settings'
);
?>

<?php echo wcusage_output_addon_box(
__( 'Lifetime Commission', 'woo-coupon-usage' ),
"wcusage_field_lifetime",
__( 'Give your affiliates lifetime commission for ALL future purchases from all their referred users.', 'woo-coupon-usage' ),
"https://couponaffiliates.com/docs/pro-lifetime-commission",
"fas fa-handshake",
0,
0,
0,
'tab-commission',
'wcu-setting-header-lifetime'
);
?>

<?php echo wcusage_output_addon_box(
__( 'Priority Support', 'woo-coupon-usage' ),
"wcusage_field_addon_default",
__( 'Get priority support, and your suggestions will have more priority for development.', 'woo-coupon-usage' ),
"",
"far fa-smile-beam",
1,
1,
0,
'',
''
);
?>

<?php echo wcusage_output_addon_box(
__( 'All Future Pro Features', 'woo-coupon-usage' ),
"wcusage_field_addon_default",
__( 'More features coming soon. Get access to all future features included in the Pro version!', 'woo-coupon-usage' ) . " <a href='https://couponaffiliates.com/roadmap' target='_blank'>View Roadmap</a>",
"",
"far fa-star",
1, // Default
1, // Always
0, // Soon
'',
''
);
?>

<!-- On Click Settings Button - Go to Settings Section -->
<script>
function wcusage_go_to_settings(settings1, settings2) {
  jQuery('html, body').animate({
      scrollTop: jQuery( settings1 ).offset().top - 150
  }, 75);
  setTimeout(
    function() {
        jQuery( settings1 ).click();
    },
  150);
  setTimeout(
    function() {
      jQuery('html, body').animate({
          scrollTop: jQuery( settings2 ).offset().top - 70
      }, 300);
    },
  575);
}
</script>

<div style="clear: both;"></div>

  <br/>

	<?php echo __( 'Learn more about Pro and upgrade at', 'woo-coupon-usage' ); ?> <a href="https://couponaffiliates.com" target="_blank">couponaffiliates.com</a>

	</div>

 <?php
}

function wcusage_output_addon_box($title, $id, $text, $link, $icon, $default, $always, $soon, $settings1, $settings2) {

$options = get_option( 'wcusage_options' );

$ispro = true;
if( !wcu_fs()->can_use_premium_code() || !wcu_fs()->is_plan('pro') ) { $ispro = false; }

if(!$icon) {
  $icon = "fas fa-cog";
}

if(isset($options[$id])) {
  $wcusage_enable = $options[$id];
} else {
  $wcusage_enable = "";
}
if(isset($default)) {
  $checked2 = ( $wcusage_enable == '1' ? ' checked="checked"' : '' );
} else {
  $checked2 = ( $default == '1' ? ' checked="checked"' : '' );
}

if( !$ispro ) { $checked2 = 0; }

$color1 = wcusage_random_color();
$color2 = wcusage_random_color();
?>

  <script>
  jQuery( document ).ready(function() {
    jQuery('.<?php echo $id; ?>.pro-setting-toggle').change(function(){
      jQuery('.<?php echo $id; ?>:not(.pro-setting-toggle)').trigger("change");
    });
  });
  </script>
  <div class="wcu-addons-box wcu-addons-box-<?php echo $id; ?>">

    <span><i class="<?php echo $icon; ?>"
      style="text-align: center; font-size: 25px; display: block; margin: 5px auto 15px auto; background: linear-gradient(#<?php echo $color1; ?>, #<?php echo $color2; ?>);
      color: #fff; width: 40px; text-shadow: 0 0 2px #333; min-height: 27px; opacity: 0.7;"></i>
    </span>

    <?php if($link) { ?><a href="<?php echo $link; ?>" target="_blank" title="<?php echo __( 'Click for more details', 'woo-coupon-usage' ); ?>."><?php } ?>
      <strong style="text-align: center; display: block;"><?php echo $title; ?></strong>
    <?php if($link) { ?></a><?php } ?>

  <p style="text-align: center;"><?php echo $text; ?></p>

    <div class="wcu-addons-box-bottom">

    <?php if($link) { ?>
    <a href="<?php echo $link; ?>" target="_blank"
      class="wcu-addons-box-view-details">
      <?php echo __( 'DETAILS', 'woo-coupon-usage' ); ?>
    </a>
    <?php } ?>
    <?php if($settings1 && $ispro) { ?>
    <a href="#" onclick="wcusage_go_to_settings('#<?php echo $settings1; ?>', '#<?php echo $settings2; ?>');"
      class="wcu-addons-box-view-details" style="margin-left: 5px;">
      <?php echo __( 'SETTINGS', 'woo-coupon-usage' ); ?>
    </a>
    <?php } ?>

      <?php if( $ispro ) { ?>
        <?php if(!$always) { ?>
        <label class="switch" style="margin: 0; margin-right: 8px;" <?php if($always) { ?>style="pointer-events: none;"<?php } ?>>
            <input type="hidden" value="0" id="<?php echo $id; ?>" data-custom="custom" name="wcusage_options[<?php echo $id; ?>]" >
            <input type="checkbox" value="1" id="<?php echo $id; ?>" class="<?php echo $id; ?> pro-setting-toggle" data-custom="custom" name="wcusage_options[<?php echo $id; ?>]" <?php
          echo  $checked2 ;
          ?>>
        <span class="slider round">
          <span class="on">ON</span>
          <span class="off">OFF</span>
        </span>
        </label>
        <?php } else { ?>
          <?php if($soon) { ?>
            <span style="float: right; text-align: right; margin-top: 7px; margin-right: 10px;">
              COMING SOON <span class="dashicons dashicons-clock"></span>
            </span>
          <?php } else { ?>
            <span style="float: right; text-align: right; margin-top: 7px; margin-right: 10px;">
              ENABLED <span style="margin-top: -3px;" class="dashicons dashicons-yes-alt" title="<?php echo __( 'Always Enabled', 'woo-coupon-usage' ); ?>"></span>
            </span>
          <?php } ?>
        <?php } ?>
      <?php } else { ?>

        <?php if(!$soon) { ?>
          <span style="float: right; text-align: right; margin-top: 7px; margin-right: 10px;">
            <a class="wcu-addon-upgrade" href="<?php echo get_site_url(); ?>/wp-admin/admin.php?page=wcusage-pricing&trial=true" title="<?php echo __( 'Upgrade to unlock this module.', 'woo-coupon-usage' ); ?>">
              <span style="font-size: 14px; font-weight: bold; margin-top: 1px; display: inline-block;"><?php echo __( 'UPGRADE', 'woo-coupon-usage' ); ?></span> <span class="dashicons dashicons-warning"></span>
            </a>
          </span>
        <?php } ?>

      <?php } ?>
      <br/>

    </div>

  </div>

<?php
}
