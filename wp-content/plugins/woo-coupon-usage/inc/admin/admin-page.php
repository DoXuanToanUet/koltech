<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function wcusage_admin_list_page_html() {
// check user capabilities
if ( ! wcusage_check_admin_access() ) {
return;
}
$coupon_shortcode_page = wcusage_get_coupon_shortcode_page('0');
$registration_shortcode_page = wcusage_get_registration_shortcode_page('0');
?>

<!--- Font Awesome -->
<link rel="stylesheet" href="<?php echo WCUSAGE_UNIQUE_PLUGIN_URL .'fonts/font-awesome/css/all.min.css'; ?>" crossorigin="anonymous">

<style>
.wcusage-admin-page-help-col { width: calc(50% - 80px); margin: 10px; padding: 15px 30px; background: #fff; float: left; border: 2px solid #e3e3e3; }
.wcusage-admin-page-help-col2 { width: calc(50% - 80px); float: left; }
.wcusage-admin-page-help-col3 { width: 100%; margin: 10px; padding: 15px 30px; background: #fff; float: left; border: 2px solid #e3e3e3; }
@media screen and (max-width: 1040px) { .wcusage-admin-page-help-col, .wcusage-admin-page-help-col2 { width: calc(100% - 76px); } }
strong { color: green; font-size: 16px; }
.wcusage-quicklink {
	display: block;
	width: calc(50% - 12px);
	padding: 20px 0;
	margin: 5px;
	background: #fafafa;
	float: left;
	border-radius: 10px;
	text-align: center;
	color: #333;
	font-size: 26px;
	font-weight: bold;
	text-decoration: none;
	border: 1px solid #333;
}
@media screen and (max-width: 1690px) {
	.wcusage-quicklink {
		font-size: 20px;
	}
}
@media screen and (max-width: 1260px) {
	.wcusage-quicklink {
		width: calc(100% - 12px);
	}
}
h2 { font-size: 22px; }
</style>

<?php
// Black Friday Deal
$todayDate = strtotime('now');
$dealDateBegin = strtotime('10-12-2022');
$dealDateEnd = strtotime('31-12-2022');
if ($todayDate >= $dealDateBegin && $todayDate <= $dealDateEnd) { $specialsale = true; } else { $specialsale = false; }
?>

<div class="wrap plugin-settings">

	<h1></h1>

	<div class="wcusage-admin-page-help-col" style="width: calc(100% - 76px);">
	<img src="https://couponaffiliates.com/wp-content/uploads/2021/06/couponaffiliates-logo.png" style="display: block; width: 100%; max-width: 550px; text-align: center; margin: 10px auto 20px auto;">

	<p style="text-align: center; font-weight: bold;"><?php echo __( "Create a coupon based affiliate program for your WooCommerce website, and view coupon usage statistics.", "woo-coupon-usage" ); ?></p>

	<p style="text-align: center; margin: 0; margin-bottom: 10px;">Website: <a href="https://couponaffiliates.com" target="_blank">www.couponaffiliates.com</a> | Follow us on Twitter <a href="https://twitter.com/CouponAffs" target="_blank">@CouponAffs</a> to keep up to date with new plugin features.</p>

	<?php if ( !wcu_fs()->can_use_premium_code() ) { ?>
    <?php if(!$specialsale) { ?>
    	<div style="background: #fff; padding: 10px; margin: 10px 0 20px 0; border-radius: 10px; display: block; width: auto; margin: 0 auto; width: 700px;">
    	Use coupon code <strong style="color: green;">DASH15</strong> for 15% off the Pro version. &nbsp;&nbsp;
    	<a href="<?php echo get_site_url(); ?>/wp-admin/admin.php?page=wcusage-pricing&trial=true&coupon=DASH15" style="font-weight: bold; color: green; text-decoration: none; background: green; color: #fff; padding: 5px 7px; border-radius: 5px;">START 7 DAY TRIAL + SAVE 15%!</a>
    	</div>
    <?php } else { ?>
      <div style="background: #fff; padding: 10px; margin: 10px 0 20px 0; border-radius: 10px; display: block; width: auto; margin: 0 auto; width: 700px;">
    	<strong>Save 20%</strong> with discount code: <strong style="color: #F93E3E;">FESTIVE2021</strong> &nbsp;&nbsp;
    	<a href="<?php echo get_site_url(); ?>/wp-admin/admin.php?page=wcusage-pricing&trial=true&coupon=FESTIVE2021" style="font-weight: bold; color: green; text-decoration: none; background: green; color: #fff; padding: 5px 7px; border-radius: 5px;">START 7 DAY TRIAL + SAVE 20%!</a>
    	</div>
    <?php } ?>
	<?php } ?>
	</div>

	<div style="clear: both;"></div>

	<div class="wcusage-admin-page-help-col">

		<h2><?php echo __( "Getting Started", "woo-coupon-usage" ); ?></h2>

    <p style="font-weight: bold; font-size: 15px;">Need help with setup? Follow our step-by-step setup guide (<a href="https://couponaffiliates.com/docs/setup-guide-free?utm_source=dashboard-link&amp;utm_medium=getting-started" target="_blank">click here</a>), or see a list of instructions below.</p>

    <hr/><br/>

		<?php if(!$coupon_shortcode_page) {

			do_action('wcusage_hook_getting_started_create');
			do_action('wcusage_hook_getting_started2');

		} else { ?>

		<?php echo __( "Affiliate dashboard page", "woo-coupon-usage" ); ?>:<br/><a href="<?php echo $coupon_shortcode_page; ?>" target="_blank"><?php echo $coupon_shortcode_page; ?></a>
		<br/><br/>

		<?php if ( wcu_fs()->can_use_premium_code() ) { ?>

  		<?php echo __( "Affiliate registration page", "woo-coupon-usage" ); ?>:<br/><a href="<?php echo $registration_shortcode_page; ?>" target="_blank"><?php echo $registration_shortcode_page; ?></a>
  		<br/>

		<?php } else { ?>

			<?php echo __( "Affiliate registration page", "woo-coupon-usage" ); ?>: (PRO)
      <br/>

		<?php } ?>

		<?php } ?>

    <br/>

    <h1><?php echo __( 'Instructions & Plugin Details', 'woo-coupon-usage' ); ?></h1>

    <hr/>

		<?php echo wcusage_how_to_use_content(); ?>

	</div>

	<div class="wcusage-admin-page-help-col2">

		<div class="wcusage-admin-page-help-col3">

		<div style="clear: both;"></div>

		<h2><?php echo __( "Admin Quicklinks", "woo-coupon-usage" ); ?></h2>

		<a href="<?php echo get_site_url(); ?>/wp-admin/admin.php?page=wcusage_settings" class="wcusage-quicklink">
			<?php echo __( "Plugin Settings", "woo-coupon-usage" ); ?>
		</a>

		<a href="<?php echo get_site_url(); ?>/wp-admin/edit.php?post_type=shop_coupon" class="wcusage-quicklink">
			<?php echo __( "Coupons List", "woo-coupon-usage" ); ?>
		</a>

		<a href="<?php echo get_site_url(); ?>/wp-admin/admin.php?page=wcusage_payouts" class="wcusage-quicklink"
			<?php if ( !wcu_fs()->can_use_premium_code() ) { ?>
				style="opacity: 0.5; pointer-events: none;"
			<?php } ?>
			>
			<?php echo __( "Commission Payouts", "woo-coupon-usage" ); ?> <?php if ( !wcu_fs()->can_use_premium_code() ) { ?>(Pro)<?php } ?>
		</a>

		<a href="<?php echo get_site_url(); ?>/wp-admin/edit.php?post_type=shop_coupon" class="wcusage-quicklink">
			<?php echo __( "Affiliate Dashboard URLs", "woo-coupon-usage" ); ?>
		</a>

		<a href="<?php echo get_site_url(); ?>/wp-admin/admin.php?page=wcusage_registrations" class="wcusage-quicklink"
			<?php if ( !wcu_fs()->can_use_premium_code() ) { ?>
				style="opacity: 0.5; pointer-events: none;"
			<?php } ?>
			>
			<?php echo __( "Affiliate Registrations", "woo-coupon-usage" ); ?> <?php if ( !wcu_fs()->can_use_premium_code() ) { ?>(Pro)<?php } ?>
		</a>

		<a href="<?php echo get_site_url(); ?>/wp-admin/admin.php?page=wcusage_admin_reports" class="wcusage-quicklink">
			<?php echo __( "Reports & Analytics", "woo-coupon-usage" ); ?>
		</a>

		<div style="clear: both;"></div>
		<br/>

		</div>

		<div class="wcusage-admin-page-help-col3">

		<h2><?php echo __( "Other Useful Links", "woo-coupon-usage" ); ?></h2>

		<?php if ( wcu_fs()->can_use_premium_code() ) { ?>
		<a href="<?php echo get_site_url(); ?>/wp-admin/admin.php?page=wcusage-contact" class="wcusage-quicklink" target="_blank">
		<?php } else { ?>
		<a href="https://wordpress.org/support/plugin/woo-coupon-usage/#new-topic-0" class="wcusage-quicklink" target="_blank">
		<?php } ?>
			<?php echo __( "Create Support Ticket", "woo-coupon-usage" ); ?>
		</a>

		<a href="<?php echo get_site_url(); ?>/wp-admin/admin.php?page=wcusage-account" class="wcusage-quicklink" target="_blank">
			<?php echo __( "Your Account", "woo-coupon-usage" ); ?>
		</a>

		<a href="https://couponaffiliates.com/docs" target="_blank" class="wcusage-quicklink" target="_blank">
			<?php echo __( "Help Documentation", "woo-coupon-usage" ); ?>
		</a>

		<a href="https://twitter.com/CouponAffs" target="_blank" class="wcusage-quicklink" target="_blank">
			Twitter @CouponAffs
		</a>

		<?php if ( !wcu_fs()->can_use_premium_code() ) { ?>
		<a href="<?php echo get_site_url(); ?>/wp-admin/admin.php?page=wcusage-pricing&trial=true" target="_blank" class="wcusage-quicklink" target="_blank" style="width: calc(100% - 12px);">
			Try PRO free for 7 days!
		</a>
		<?php } ?>

		<div style="clear: both;"></div>
		<br/>

		</div>

		<div class="wcusage-admin-page-help-col3">

		<h2><?php echo __( "Latest News & Updates", "woo-coupon-usage" ); ?></h2>

		<?php
			global $text, $maxchar, $end;
			function substrwords($text, $maxchar, $end='...') {
				if (strlen($text) > $maxchar || $text == '') {
					$words = preg_split('/\s/', $text);
					$output = '';
					$i      = 0;
					while (1) {
						$length = strlen($output)+strlen($words[$i]);
						if ($length > $maxchar) {
							break;
						} else {
							$output .= " " . $words[$i];
							++$i;
						}
					}
					$output .= $end;
				} else {
					$output = $text;
				}
				return $output;
			}

			$rss = new DOMDocument();
			$rss->load('https://couponaffiliates.com/feed/');
			$feed = array();
			foreach ($rss->getElementsByTagName('item') as $node) {
				$item = array (
					'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
					'desc' => $node->getElementsByTagName('description')->item(0)->nodeValue,
					'link' => $node->getElementsByTagName('link')->item(0)->nodeValue,
					'date' => $node->getElementsByTagName('pubDate')->item(0)->nodeValue,
				);
				array_push($feed, $item);
			}

			$limit = 8;
			for ($x=0; $x<$limit; $x++) {
				$title = str_replace(' & ', ' &amp; ', $feed[$x]['title']);
				$link = $feed[$x]['link'] . "?utm_source=dashboard-link&utm_medium=dashboard-news";
				$description = $feed[$x]['desc'];
				$description = substrwords($description, 100);
				$date = date_i18n('l F d, Y', strtotime($feed[$x]['date']));
				echo '<p><strong><a href="'.$link.'" title="'.$title.'">'.$title.'</a></strong><br />';
				echo '<small><em>Posted on '.$date.'</em></small>';
				echo '<br/>'.$description.'</p>';
			}
		?>

		<br/>
		Follow us on Twitter <a href="https://twitter.com/CouponAffs" target="_blank">@CouponAffs</a> to keep up to date with the latest news, and new features.

		</div>

</div>

<?php
}

function wcusage_how_to_use_content() {
?>

<p>

    <strong><?php echo __( 'Setup Guide', 'woo-coupon-usage' ); ?></strong><br/>

    <br/><span class="dashicons dashicons-arrow-right"></span>  Follow our step-by-step setup guide: <a href="https://couponaffiliates.com/docs/setup-guide-free?utm_source=dashboard-link&utm_medium=getting-started" style="text-decoration: none;" target="_blank">Click Here<span class="dashicons dashicons-external"></span></a>

    <br/>

    <br/><span class="dashicons dashicons-arrow-right"></span>  Watch our 5 minute setup video: <a href="https://couponaffiliates.com/docs/setup-guide-free?utm_source=dashboard-link&utm_medium=getting-started" style="text-decoration: none;" target="_blank">Click Here<span class="dashicons dashicons-external"></span></a>

    <br/>

		<br/><strong><?php echo __( 'Settings & Customization', 'woo-coupon-usage' ); ?></strong><br/>

		<br/><span class="dashicons dashicons-arrow-right"></span> <?php echo __( 'You can customise the plugin to meet your requirements on ', 'woo-coupon-usage' ); ?> <a href="<?php echo get_site_url(); ?>/wp-admin/admin.php?page=wcusage_settings" target="_blank"><?php echo __( 'settings page', 'woo-coupon-usage' ); ?></a>.<br/>

    <?php
    if ( function_exists('wc_coupons_enabled') ) {
      if ( !wc_coupons_enabled() ) {
        update_option( 'woocommerce_enable_coupons', 'yes' );
        ?>

        <br/><strong><?php echo __( 'Enable Coupon Codes', 'woo-coupon-usage' ); ?></strong><br/>

    		<br/><span class="dashicons dashicons-arrow-right"></span> Note: For this plugin to work, coupons need to be enabled in WooCommerce. This has been enabled automatically for you, in your "WooCommerce > Settings > General".<br/>

        <?php
      }
    }
    ?>

		<br/><strong><?php echo __( 'Creating Affiliates & Coupons', 'woo-coupon-usage' ); ?></strong><br/>

		<br/><span class="dashicons dashicons-arrow-right"></span> <a href="/wp-admin/post-new.php?post_type=shop_coupon" target="_blank"><?php echo __( 'Create a coupon code', 'woo-coupon-usage' ); ?></a> <?php echo __( 'as normal in the WooCommerce. You can then assign affiliate users to these coupons (see below) to make them an affiliate.', 'woo-coupon-usage' ); ?>

		<br/><br/>

		<strong><?php echo __( 'Assign Affiliates to Coupons', 'woo-coupon-usage' ); ?></strong><br/>
		<br/><span class="dashicons dashicons-arrow-right"></span> <?php echo __( 'To assign users to a specific coupon, go to the', 'woo-coupon-usage' ); ?> <a href="<?php echo get_site_url(); ?>/wp-admin/edit.php?post_type=shop_coupon"><?php echo __( 'coupons management page', 'woo-coupon-usage' ); ?></a>, <?php echo __( 'edit a coupon and assign users under the "coupon affiliates" tab', 'woo-coupon-usage' ); ?>. (<a href="https://couponaffiliates.com/docs/how-do-i-assign-users-to-coupons" target="_blank"><?php echo __( 'Learn More.', 'woo-coupon-usage' ); ?></a>)
		<br/><br/><span class="dashicons dashicons-arrow-right"></span> <?php echo __( 'The affiliate user can then visit the "affiliate dashboard page" to view their affiliate statistics, commissions, referral URLs, etc, for the coupon(s) they are assigned to.', 'woo-coupon-usage' ); ?>

		<br/>

		<br/><strong><?php echo __( 'Affiliate Dashboard', 'woo-coupon-usage' ); ?></strong><br/>

		<br/><span class="dashicons dashicons-arrow-right"></span> <?php echo __( 'To display the affiliate dashboard for the coupon(s) assigned to the logged in user use shortcode:', 'woo-coupon-usage' ); ?> <span style="font-weight: bold; color: blue;">[couponaffiliates]</span>
    <br/>
    <br/><span class="dashicons dashicons-arrow-right"></span> <?php echo __( 'Affiliate users will then just need to visit this page to see their affiliate dashboard.', 'woo-coupon-usage' ); ?>
    <br/>
    <br/><span class="dashicons dashicons-arrow-right"></span> <?php echo __( 'If you are getting the "Failed to load ajax request" error on the affiliate dashboard', 'woo-coupon-usage' ); ?>, <a href="https://couponaffiliates.com/docs/error-ajax-request" target="_blank"><?php echo __( 'click here', 'woo-coupon-usage' ); ?></a> <?php echo __( 'for some a solution.', 'woo-coupon-usage' ); ?>

    <br/><br/>

		<strong><?php echo __( 'Shortcodes', 'woo-coupon-usage' ); ?></strong><br/>
		<br/><span class="dashicons dashicons-arrow-right"></span> <?php echo __( 'To view a list of all the different shortcodes available to use with this plugin', 'woo-coupon-usage' ); ?>, <a href="https://couponaffiliates.com/docs/shortcodes?utm_source=dashboard-link" target="_blank"><?php echo __( 'click here', 'woo-coupon-usage' ); ?></a>.

		<br/>

		<br/><strong><?php echo __( 'Affiliate Login Form', 'woo-coupon-usage' ); ?></strong><br/>
		<br/><span class="dashicons dashicons-arrow-right"></span> <?php echo __( 'A login form will be displayed on the affiliate dashboard for users to login to their account, and directly access their dashboard without needing to use the unique link.', 'woo-coupon-usage' ); ?>

		<br/><br/><strong><?php echo __( 'Set Your Commission Rates', 'woo-coupon-usage' ); ?></strong><br/>

		<br/><span class="dashicons dashicons-arrow-right"></span> <?php echo __( 'You can set your custom commission rates in the "commision" tab of the', 'woo-coupon-usage' ); ?> <a href="<?php echo get_site_url(); ?>/wp-admin/admin.php?page=wcusage_settings" target="_blank"><?php echo __( 'settings page', 'woo-coupon-usage' ); ?></a>.
		<br/>
		<br/><span class="dashicons dashicons-arrow-right"></span> <?php echo __( 'You can set fixed commission amounts (either per order, or per product), alongside percentage of the total order. You can set all 3 of these for a combined total if required.', 'woo-coupon-usage' ); ?>
    <br/>
		<br/><span class="dashicons dashicons-arrow-right"></span> <?php echo __( 'With the PRO version can also set commission rates per each individual affiliate/coupon, or product. Learn more below.', 'woo-coupon-usage' ); ?>

		<br/>

		<br/><strong><?php echo __( 'View Coupons List & Unique Links', 'woo-coupon-usage' ); ?></strong><br/>
		<br/><span class="dashicons dashicons-arrow-right"></span> <?php echo __( 'You can also view a full list of the coupons, with the assigned user, pending payments, and unique affiliate dashboard links for each coupon (to view yourself) on the', 'woo-coupon-usage' ); ?> <a href="<?php echo get_site_url(); ?>/wp-admin/edit.php?post_type=shop_coupon" target="_blank"><?php echo __( 'WooCommerce coupon list page', 'woo-coupon-usage' ); ?>.</a>

		<br/>

		<br/><strong><?php echo __( 'Referral URLs', 'woo-coupon-usage' ); ?></strong><br/>
		<br/><span class="dashicons dashicons-arrow-right"></span> <?php echo __( 'You can enable referral URLs, and customise the settings for these, in the "Referral URLs" tab on the settings tab.', 'woo-coupon-usage' ); ?></br>
		<br/><span class="dashicons dashicons-arrow-right"></span> <?php echo __( 'Referral URLs can be generated by the affiliate on the affiliate dashboard page.', 'woo-coupon-usage' ); ?></br>
		<br/><span class="dashicons dashicons-arrow-right"></span> <?php echo __( 'If the referral URL is clicked, the coupon code will automatically be applied to the users checkout. The coupon must be used for commission to be tracked.', 'woo-coupon-usage' ); ?></br>

		<br/>

		<strong><?php echo __( 'Basic Admin Reports', 'woo-coupon-usage' ); ?></strong><br/>
		<br/><span class="dashicons dashicons-arrow-right"></span> <?php echo __( 'The free version gives access to admin reports for the past 4 weeks. Reports allow you to see the overall statistics for all affiliates/coupons, and each individual affiliate/coupon, on a single page', 'woo-coupon-usage' ); ?>: <a href="<?php echo get_site_url(); ?>/wp-admin/admin.php?page=wcusage_admin_reports"><?php echo __( 'View Reports', 'woo-coupon-usage' ); ?></a>

		<br/><br/>

		<strong><?php echo __( 'Multi-Currency Support', 'woo-coupon-usage' ); ?></strong><br/>
		<br/><span class="dashicons dashicons-arrow-right"></span> <?php echo __( 'To get started with Multi-Currency support, simply enable "multi-currency settings" under the "General" settings tab. A new tab will the appear labeled "currencies" to customise your currencies and conversion rates.', 'woo-coupon-usage' ); ?>

	</p>

	<div <?php
    if ( !wcu_fs()->can_use_premium_code() ) {
        ?>title="Available with Pro version." style="opacity: 0.6;"<?php
    }
    ?>>

		<br/>

		<h1><?php echo __( 'Pro Features', 'woo-coupon-usage' ); ?> <?php
    if ( !wcu_fs()->can_use_premium_code() ) {
        ?><strong style="color: green;"><a href="<?php echo get_site_url(); ?>/wp-admin/admin.php?page=wcusage-pricing&trial=true">(<?php echo __( 'UPGRADE', 'woo-coupon-usage' ); ?>)</a></strong><?php
    }
    ?></h1>

		<hr/>

		<p>

			<strong><?php echo __( 'Advanced Admin Reports', 'woo-coupon-usage' ); ?></strong><br/>
			<br/><span class="dashicons dashicons-arrow-right"></span> <?php echo __( 'With the Pro version get access to unlimited date range on the admin reports, export to CSV, and access to date comparison features, to compare analytics between 2 sets of dates', 'woo-coupon-usage' ); ?>: <a href="<?php echo get_site_url(); ?>/wp-admin/admin.php?page=wcusage_admin_reports"><?php echo __( 'View Reports', 'woo-coupon-usage' ); ?></a>

			<br/><br/>

			<strong><?php echo __( 'Display Affiliate Registration Form', 'woo-coupon-usage' ); ?></strong><br/>
			<br/><span class="dashicons dashicons-arrow-right"></span> <?php echo __( 'The affiliate registration form will be shown as default for logged out users on the affiliate dashboard page, next to the login form.' ); ?>
			<br/>
			<br/><span class="dashicons dashicons-arrow-right"></span> <?php echo __( 'To display the affiliate application form on a custom page, use the shortcode: ', 'woo-coupon-usage' ); ?> <span style="font-weight: bold; color: blue;">[couponaffiliates-register]</span>

      <br/><br/>

      <strong><?php echo __( 'Manage/Track Payouts', 'woo-coupon-usage' ); ?></strong><br/>
			<br/><span class="dashicons dashicons-arrow-right"></span> <?php echo __( 'Affiliates can request payouts for coupons they are assigned to in the "Payouts" tab on the coupon affiliate dashboard page.', 'woo-coupon-usage' ); ?>
      <br/>
      <br/><span class="dashicons dashicons-arrow-right"></span> <?php echo __( 'You can track and manage payouts on the', 'woo-coupon-usage' ); ?> "<a href="<?php echo get_site_url(); ?>/wp-admin/admin.php?page=wcusage_payouts"><?php echo __( 'Commission Payouts', 'woo-coupon-usage' ); ?></a>" <?php echo __( 'admin page', 'woo-coupon-usage' ); ?>.
      <br/>
      <br/><span class="dashicons dashicons-arrow-right"></span> <?php echo __( 'For detailed information regarding the payouts features, and setting up one-click payout methods such as Stripe and PayPal,', 'woo-coupon-usage' ); ?> <a href="https://couponaffiliates.com/docs-category/features-commission" target="_blank"><?php echo __( 'click here', 'woo-coupon-usage' ); ?>.</a>

			<br/><br/>

			<strong><?php echo __( 'Edit Unpaid Commission', 'woo-coupon-usage' ); ?></strong><br/>
			<br/><span class="dashicons dashicons-arrow-right"></span> <?php echo __( 'To manually edit/change "unpaid commission" for a coupon, go to the', 'woo-coupon-usage' ); ?> <a href="<?php echo get_site_url(); ?>/wp-admin/edit.php?post_type=shop_coupon"><?php echo __( 'coupons management page', 'woo-coupon-usage' ); ?></a>, <?php echo __( 'click "edit" on the coupon, then go to "Coupon Affiliates & Commission" data settings tab.', 'woo-coupon-usage' ); ?>

			<br/><br/>

      <strong><?php echo __( 'Creatives', 'woo-coupon-usage' ); ?></strong><br/>
			<br/><span class="dashicons dashicons-arrow-right"></span> <?php echo __( 'To get started with creatives, first go to the "Creatives" settings to to enable and customise the settings.', 'woo-coupon-usage' ); ?>
			<br/>
			<br/><span class="dashicons dashicons-arrow-right"></span> <?php echo __( 'Next, simply <a href="/wp-admin/edit.php?post_type=wcu-creatives">add new creatives</a> and they will be displayed in the new "Creatives" tab on the affiliate dashboard.', 'woo-coupon-usage' ); ?>

			<br/><br/>

      <strong><?php echo __( 'Affiliate Email Reports', 'woo-coupon-usage' ); ?></strong><br/>
			<br/><span class="dashicons dashicons-arrow-right"></span> <?php echo __( 'To get started with affiliate email reports, first enable it in the "PRO Modules" section of the settings, then setup and customise the settings in the new "Reports" settings tab that will appear.', 'woo-coupon-usage' ); ?>

			<br/><br/>

      <strong><?php echo __( 'Flexible Commission - Per Product or Coupon', 'woo-coupon-usage' ); ?></strong><br/>
			<br/><span class="dashicons dashicons-arrow-right"></span> <?php echo __( 'Flexible commission settings can also be set at product level, as well as coupon level. To do this, simply edit a product, or coupon, and visit the "Coupon Affiliates & Commission" data settings tab.', 'woo-coupon-usage' ); ?>

			<br/><br/>

      <strong><?php echo __( 'Lifetime Commission', 'woo-coupon-usage' ); ?></strong><br/>
			<br/><span class="dashicons dashicons-arrow-right"></span> <?php echo __( 'Give your affiliates lifetime commission for ALL future purchases from all their referred users.', 'woo-coupon-usage' ); ?> <?php echo __( 'To do this go to "Pro Settings" and toggle on "Enable lifetime commission features." option.', 'woo-coupon-usage' ); ?>

			<br/><br/>

      <strong><?php echo __( 'Affiliate Landing Pages', 'woo-coupon-usage' ); ?></strong><br/>
			<br/><span class="dashicons dashicons-arrow-right"></span> <?php echo __( 'Ability to link a landing page to an affiliate coupon, which will then work the same as a referral URL.', 'woo-coupon-usage' ); ?> <?php echo __( 'To get started, simply enable the "Affiliate Landing Pages" option in "Pro Settings" then you will see a new meta box when editing pages, to assign an affiliate coupon to that page.', 'woo-coupon-usage' ); ?>

			<br/><br/>

			<strong><?php echo __( 'Commission Line Graphs', 'woo-coupon-usage' ); ?></strong><br/>
			<br/><span class="dashicons dashicons-arrow-right"></span> <?php echo __( 'You can enable line graphs in the "Pro Settings" tab. This will show some nice line graphs on the statistics tab of the affiliate dashboard.', 'woo-coupon-usage' ); ?>

      <br/><br/>

			<strong><?php echo __( 'Other PRO Modules', 'woo-coupon-usage' ); ?></strong><br/>
			<br/><span class="dashicons dashicons-arrow-right"></span> <?php echo __( 'To view all available PRO modules, simply visit the "Pro Modules" tab on the settings page, and enable the modules you want to use.', 'woo-coupon-usage' ); ?>

		</p>

	</div>

	<br/>

	<h1><?php echo __( 'Other Information', 'woo-coupon-usage' ); ?></h1>

	<hr/>

	<?php echo __( 'To view all features available with PRO, visit our website:', 'woo-coupon-usage' ); ?> <a href="https://couponaffiliates.com" target="_blank">https://couponaffiliates.com</a>
	<br/><br/>
	<?php echo __( 'For more in-depth tutorials and guides, see our plugin documentation:', 'woo-coupon-usage' ); ?> <a href="https://couponaffiliates.com/docs" target="_blank">https://couponaffiliates.com/docs</a>

<?php
}
