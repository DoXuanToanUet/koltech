<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function wcusage_field_cb_help( $args )
{
    $options = get_option( 'wcusage_options' );
    ?>

	<div id="help-area" class="help-area">

	<h1>How To Use</h1>

  <hr/>

  <p style="font-size: 15px; color: green;"><strong>Need help with anything?</strong></p>

  <br/><span class="dashicons dashicons-arrow-right"></span> <?php if ( wcu_fs()->can_use_premium_code() ) { ?><a href="<?php echo get_site_url(); ?>/wp-admin/admin.php?page=wcusage-contact"><?php } else { ?><a href="https://wordpress.org/support/plugin/woo-coupon-usage/#new-topic-0" target="_blank" style="text-decoration: none;"><?php } ?>Create a new support ticket <span class='fas fa-arrow-circle-right'></span></a><br/>

  <br/><span class="dashicons dashicons-arrow-right"></span> <a href="https://couponaffiliates.com/docs?utm_source=dashboard-link&utm_medium=getting-started" target="_blank">View help documentation <span class='fas fa-arrow-circle-right'></span></a><br/>

  <br/>

	<?php echo wcusage_how_to_use_content(); ?>

  <h2><?php echo __( 'Translations', 'woo-coupon-usage' ); ?></h2>

  <?php echo __( 'Localisation is supported. We recommended to using', 'woo-coupon-usage' ); ?> "<a href="<?php echo get_site_url(); ?>/wp-admin/plugin-install.php?s=Loco%20Translate&tab=search&type=term" target="_blank">Loco Translate</a>" / "<a href="https://wpml.org" target="_blank">WPML</a>" <?php echo __( 'to fully translate this plugin.', 'woo-coupon-usage' ); ?>
  <br/>

	<h2><?php echo __( 'Support & Suggestions', 'woo-coupon-usage' ); ?></h2>

	<p>

		<?php echo __( 'If you need help, or have any suggestions,', 'woo-coupon-usage' ); ?> <?php if ( wcu_fs()->can_use_premium_code() ) { ?><a href="/wp-admin/admin.php?page=wcusage-contact"><?php } else { ?><a href="https://wordpress.org/support/plugin/woo-coupon-usage/#new-topic-0" target="_blank"><?php } ?><?php echo __( 'click here', 'woo-coupon-usage' ); ?></a> <?php echo __( 'to send a support ticket.', 'woo-coupon-usage' ); ?>

    <h2><?php echo __( 'Documentation', 'woo-coupon-usage' ); ?></h2>

  	<?php echo __( 'For plugin documentation and FAQs visit', 'woo-coupon-usage' ); ?>: <a href="https://couponaffiliates.com/docs?utm_source=dashboard-link&utm_medium=getting-started" target="_blank">https://couponaffiliates.com/docs</a>
  	<br/><br/>

	</p>

	</div>

 <?php
}
