<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'wcusage_hook_getting_started_create', 'wcusage_getting_started_create' );
function wcusage_getting_started_create() {

    if ( isset( $_POST['submitnewpage'] ) || isset( $_POST['submitnewpage2'] ) ) {

    $current_user_id = get_current_user_id();

    global $wpdb;
		$table_name = $wpdb->prefix . 'posts';
		$wpdb->insert(
			$table_name,
			array(
        'post_title'     => 'Affiliate Dashboard',
        'post_type'      => 'page',
        'post_name'      => 'affiliates',
        'comment_status' => 'closed',
        'ping_status'    => 'closed',
        'post_content'   => '[couponaffiliates]',
        'post_status'    => 'publish',
        'post_author'    => $current_user_id,
			)
		);
		$new_page_id = $wpdb->insert_id;

    if( isset( $_POST['submitnewpage'] ) ) {
      echo "<form>";
      echo "<strong style='font-size: 1.3em;'>Affiliate dashboard page created. (ID #" . $new_page_id . ")</strong>";
  		echo "<br/><br/>- You can now view a full list of affiliate dashboard URL's for each coupon on the <a href='/wp-admin/edit.php?post_type=shop_coupon' target='_blank'>coupons list</a> page.";
  		echo "<br/><br/>-  You can assign users to coupons by going to the <a href='/wp-admin/edit.php?post_type=shop_coupon' target='_blank'>coupons list</a> page, edit a coupon, and go to the 'coupon affiliates' tab.";
  	  echo "<br/><br/>- Make sure to customise the plugin, and set your commission rates etc, in the <a href='".get_admin_url()."admin.php?page=wcusage_settings'>plugin settings</a>.";
  	  echo "<br/><br/>If you need help with anything at all, please <a href='".get_site_url()."/wp-admin/admin.php?page=wcusage-contact' target='_blank'>contact us</a> or check out our <a href='https://couponaffiliates.com/docs/setup-guide-free' target='_blank'>setup guide</a>";
  		echo "<style>.wcusage-get-started { display: none; }</style>";
      echo "</form>";
    } else {
      echo "<p style='color: green;'><strong>Affiliate dashboard page created. (ID #" . $new_page_id . ")</strong></p><br/>";
    }

    $option_group = get_option('wcusage_options');
    $option_group['wcusage_dashboard_page'] = $new_page_id;
    update_option( 'wcusage_options', $option_group );

    }

}

add_action( 'wcusage_hook_getting_started', 'wcusage_getting_started' );
function wcusage_getting_started() {
?>
	<form method="post" class="wcusage-get-started" action="" style="margin-top: 35px;">

    <div style="height: 220px; width: 55%; display: inline-block;">
  		<strong style="font-size: 1.3em;">Getting Started</strong>
  		<p>
  		<?php echo __( "(1) Add the shortcode [couponaffiliates] to a frontend page (click the button below to generate automatically).", "woo-coupon-usage" ); ?>
  		</p>
  		<p>
  		<?php echo __( "(2) As an admin, you will see a full list of dashboard URLs to share with affiliates on the", "woo-coupon-usage" ); ?> <a href="<?php echo get_site_url(); ?>/wp-admin/edit.php?post_type=shop_coupon" target="_blank"><?php echo __( "WooCommerce coupons list", "woo-coupon-usage" ); ?></a>.
      </p>
      <p>
      <?php echo __( "(3) You can assign/link users to coupons so they can access their coupons affiliate dashboard directly, without needing the unique link.", "woo-coupon-usage" ); ?> (<a href="https://couponaffiliates.com/docs/assign-users-to-coupons" target="_blank"><?php echo __( "Learn More", "woo-coupon-usage" ); ?></a>)
  		</p>
  		<p>
  		<?php echo __( "(4) Customise the settings on this page below, and view the 'How To Use' tab for more help on getting started.", "woo-coupon-usage" ); ?>
  		</p>
      <p>
  		<?php echo __( "(5) To view our step-by-step setup guide", "woo-coupon-usage" ); ?> <a href='https://couponaffiliates.com/docs/setup-guide-free' target='_blank'><?php echo __( "click here", "woo-coupon-usage" ); ?></a>.
  		</p>

      <button type="submit" name="submitnewpage" style="width: 250px; display: block; margin-bottom: -17px;" />
        <?php echo __( "Generate Dashboard Page", "woo-coupon-usage" ); ?> <span class="fa-solid fa-circle-arrow-right"></span>
      </button>
      <br/>
      <div style="clear: both;"></div>

    </div>

	</form>
<?php
}

add_action( 'wcusage_hook_getting_started2', 'wcusage_getting_started2' );
function wcusage_getting_started2() {
?>

<h2 style="font-size: 20px; margin: 8px 0 35px -12px;"> <a href="<?php echo get_site_url(); ?>/wp-admin/admin.php?page=wcusage_setup" class="wcusage-settings-wizard-button">Start Setup Wizard <span class="fa-solid fa-circle-arrow-right"></span></a></h2>

	<form method="post" class="wcusage-get-started" action="">

    <p><strong>Quick Guide:</strong></p>

		<p>
		<?php echo __( "(1) Add the shortcode [couponaffiliates] to a frontend page (click the button below to generate automatically).", "woo-coupon-usage" ); ?>
		</p>

		<p>
		<?php echo __( "(2) As an admin, you will see a full list of dashboard URLs to share with affiliates on the", "woo-coupon-usage" ); ?> <a href="<?php echo get_site_url(); ?>/wp-admin/edit.php?post_type=shop_coupon" target="_blank"><?php echo __( "WooCommerce coupons list", "woo-coupon-usage" ); ?></a>.
    </p>

    <p>
    <?php echo __( "(3) You can assign/link users to coupons so they can access their coupons affiliate dashboard directly, without needing the unique link.", "woo-coupon-usage" ); ?> (<a href="https://couponaffiliates.com/docs/assign-users-to-coupons" target="_blank"><?php echo __( "Learn More", "woo-coupon-usage" ); ?></a>)
		</p>

		<p>
		<?php echo __( "(4) Customise the plugin on the", "woo-coupon-usage" ); ?> <a href="<?php echo get_admin_url(); ?>admin.php?page=wcusage_settings" target="_blank"><?php echo __( "settings page", "woo-coupon-usage" ); ?></a>.
		</p>

    <p>
		<?php echo __( "(5) To view our plugin setup guide", "woo-coupon-usage" ); ?> <a href="https://couponaffiliates.com/docs/setup-guide-free" target="_blank"><?php echo __( "click here", "woo-coupon-usage" ); ?></a>.
		</p>

		<button type="submit" name="submitnewpage" style="width: 250px; margin-bottom: 2px;" />
      <?php echo __( "Generate Dashboard Page", "woo-coupon-usage" ); ?> <span class="fa-solid fa-circle-arrow-right"></span>
    </button>

		<br/><br/>

	</form>
<?php
}

add_action( 'wcusage_hook_getting_started3', 'wcusage_getting_started3' );
function wcusage_getting_started3() {
?>
	<form method="post" action="" style="margin-bottom: 20px;">
		<input type="submit" name="submitnewpage2" value="<?php echo __( "Generate Dashboard Page >", "woo-coupon-usage" ); ?>" style="margin-top: 5px;" />
	</form>
<?php
}
