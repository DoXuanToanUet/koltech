<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Displays header section on dashboard pages.
 *
 */
add_action( 'wcusage_hook_dashboard_page_header', 'wcusage_dashboard_page_header' );
function wcusage_dashboard_page_header() {
  ?>

  <div class="wcusage-admin-page-col3">
	   <a href="https://couponaffiliates.com" target="_blank"><img src="<?php echo WCUSAGE_UNIQUE_PLUGIN_URL; ?>images/coupon-affiliates-logo.png" style="display: inline-block; width: 100%; max-width: 290px; text-align: left; margin: 12px 0 10px 0;"></a>
     <a href="#"><div class="wcusage-admin-dash-button"><span class="fa-solid fa-circle-question"></span> Support Ticket</div></a>
     <a href="https://couponaffiliates.com/docs" target="_blank"><div class="wcusage-admin-dash-button"><span class="fa-solid fa-book"></span> Documentation</div></a>
     <a href="<?php echo get_admin_url(); ?>admin.php?page=wcusage_help&utm_source=dashboard-link&utm_medium=header"><div class="wcusage-admin-dash-button"><span class="fa-solid fa-circle-info"></span> Info</div></a>
     <a href="<?php echo get_admin_url(); ?>admin.php?page=wcusage_settings"><div class="wcusage-admin-dash-button"><span class="fa-solid fa-cog"></span> Settings</div></a>
	</div>

	<div style="clear: both;"></div>

  <?php
}

/**
 * Displays statistics section on dashboard page.
 *
 */
add_action( 'wcusage_hook_dashboard_page_section_statistics', 'wcusage_dashboard_page_section_statistics' );
function wcusage_dashboard_page_section_statistics() {

  $orders = wc_get_orders( array(
      'orderby'   => 'date',
      'order'     => 'DESC',
      'meta_key' => 'wcusage_affiliate_user',
      'meta_compare' => 'EXISTS',
      'date_query' => array(
          array(
              'after' => '1 week ago'
          )
      )
  ));

  $count = 0;
  $subtotal = 0;
  $discounts = 0;
  $total = 0;
  $commission = 0;
  
  foreach ( $orders as $key => $order ) {
    $order_id = $order->get_id();
    $orderinfo = wc_get_order( $order_id );
    $calculateorder = wcusage_calculate_order_data( $order_id, '', 0, 1 );
    $status = $orderinfo->get_status();
    $check_status_show = wcusage_check_status_show($status);
    if($check_status_show) {
      $count++;
      $subtotal += $calculateorder['totalorders'];
      $discounts += $calculateorder['totaldiscounts'];
      $total += $calculateorder['totalordersexcl'];
      $commission += $calculateorder['totalcommission'];
    }
  }
  $subtotal = wcusage_format_price( number_format($subtotal, 2, '.', '') );
  $discounts = wcusage_format_price( number_format($discounts, 2, '.', '') );
  $total = wcusage_format_price( number_format($total, 2, '.', '') );
  $commission = wcusage_format_price( number_format($commission, 2, '.', '') );

  $date1 = date("Y-m-d", strtotime('-8 days'));
  $date2 = date("Y-m-d", strtotime('+1 days'));
  global $wpdb;
  $table_name = $wpdb->prefix . 'wcusage_clicks';
  $result2 = $wpdb->get_results( "SELECT * FROM " . $table_name . " WHERE date > '$date1' AND date < '$date2' ORDER BY id DESC" );
  $clickcount = count($result2);
  ?>

  <style>
  .wcusage-info-box-title { margin-top: 5px; margin-bottom: 0px !important; }
  </style>

  <div>

  <!-- Total Usage -->
  <div class="wcusage-info-box2 wcusage-info-box-usage">
    <p>
      <span class="wcusage-info-box-title">Referrals:</span>
      <span class="total-usage"><?php echo $count; ?></span>
    </p>
  </div>

  <!-- Total Order -->
  <div class="wcusage-info-box2 wcusage-info-box-sales">
    <p>
      <span class="wcusage-info-box-title">Sales:</span>
      <span class="total-sales"><?php echo $total; ?></span>
    </p>
  </div>

  <!-- Total Discounts -->
  <div class="wcusage-info-box2 wcusage-info-box-discounts">
    <p>
      <span class="wcusage-info-box-title">Discounts:</span>
      <span class="total-discounts"><?php echo $discounts; ?></span>
    </p>
  </div>

  <div class="wcusage-info-box2 wcusage-info-box-dollar">
      <p>
        <span class="wcusage-info-box-title">Commission:</span>
        <span class="total-commission"><?php echo $commission; ?></span>
      </p>
    </div>

    <div class="wcusage-info-box2 wcusage-info-box-clicks">
      <p>
        <span class="wcusage-info-box-title">Clicks:</span>
        <span class="total-clicks"><?php echo $clickcount; ?></span>
      </p>
    </div>

  </div>

  <?php
}

/**
 * Displays activity section on dashboard page.
 *
 */
add_action( 'wcusage_hook_dashboard_page_section_activity', 'wcusage_dashboard_page_section_activity' );
function wcusage_dashboard_page_section_activity() {

  global $wpdb;
  $table_name = $wpdb->prefix . 'wcusage_activity';

  $get_activity = $wpdb->get_results( "SELECT * FROM " . $table_name . " ORDER BY id DESC LIMIT 5" );
  ?>

  <div>
    <?php if(!empty($get_activity)) { ?>
    <table style="border: 2px solid #f3f3f3; width: 100%; text-align: center; border-collapse: collapse;">
        <thead>
          <tr class="wcusage-admin-table-col-head">
            <th>User</th>
            <th>Date</th>
            <th>Time</th>
            <th>Event</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($get_activity as $result) {
            $event_id = $result->event_id;
            $the_date = $result->date;
              $date = date_i18n( 'F jS', strtotime($the_date) );
              $time = date( 'H:i', strtotime($the_date) );
            $user_id = $result->user_id;
            $user = get_userdata( $user_id );
            $event = $result->event;
            $info = $result->info;

            if($event == "referral") {
              $user_id = get_post_meta( $event_id, 'wcusage_affiliate_user', true );
            }

            $event_message = wcusage_activity_message($event, $event_id, $info);
            ?>
            <tr class="wcusage-admin-table-col-row">
              <td><a href="<?php echo get_edit_user_link($user_id); ?>" title="<?php echo $user->user_login; ?>" target="_blank"><?php echo $user->first_name; ?> <?php echo $user->last_name; ?></a></td>
              <td><?php echo $date; ?></td>
              <td><?php echo $time; ?></td>
              <td><?php echo $event_message; ?></td>
            </tr>
            <?php
          }
          ?>
          <tr class="wcusage-admin-table-col-footer">
            <td colspan="5"><a href="/wp-admin/admin.php?page=wcusage_activity" style="text-decoration: none;">View All Activity <i class="fa-solid fa-arrow-right"></i></a></td>
          </tr>
        </tbody>
    </table>
  <?php } else { ?>
    <p><?php echo __('No recent activity found.', 'woo-coupon-usage'); ?></p>
  <?php } ?>
  </div>

  <?php
}

/**
 * Displays referrals section on dashboard page.
 *
 */
add_action( 'wcusage_hook_dashboard_page_section_referrals', 'wcusage_dashboard_page_section_referrals' );
function wcusage_dashboard_page_section_referrals() {

  $orders = wc_get_orders( array(
      'orderby'   => 'date',
      'order'     => 'DESC',
      'meta_key' => 'wcusage_affiliate_user',
      'meta_compare' => 'EXISTS',
      'limit' => '5'
  ));
  ?>

  <div>
    <?php if(!empty($orders)) { ?>
    <table style="border: 2px solid #f3f3f3; width: 100%; text-align: center; border-collapse: collapse;">
        <thead>
          <tr class="wcusage-admin-table-col-head">
            <th>Affiliate</th>
            <th>Date</th>
            <th>Order ID</th>
            <th>Total</th>
            <th>Commission</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ( $orders as $key => $order ) {
            $order_id = $order->get_id();
            $orderinfo = wc_get_order( $order_id );
            $calculateorder = wcusage_calculate_order_data( $order_id, '', 0, 1 );
            $order_date = get_the_time( 'F jS', $order_id );
            $status = $orderinfo->get_status();
            $subtotal = $calculateorder['totalorders'];
            $discounts = $calculateorder['totaldiscounts'];
            $total = $calculateorder['totalordersexcl'];
            $commission = $calculateorder['totalcommission'];
            $user_id = get_post_meta( $order_id, 'wcusage_affiliate_user', true );
            $user = get_userdata( $user_id );
            ?>
            <tr class="wcusage-admin-table-col-row">
              <td><a href="<?php echo get_edit_user_link($user_id); ?>" title="<?php echo $user->user_login; ?>" target="_blank"><?php echo $user->first_name; ?> <?php echo $user->last_name; ?></a></td>
              <td><?php echo $order_date; ?></td>
              <td><a href="/wp-admin/post.php?post=<?php echo $order_id; ?>&action=edit">#<?php echo $order_id; ?></a></td>
              <td><?php echo wcusage_format_price( number_format((float)$total, 2, '.', '') ); ?></td>
              <td><?php echo wcusage_format_price( number_format((float)$commission, 2, '.', '') ); ?></td>
              <td><?php echo ucfirst($status); ?></td>
            </tr>
            <?php
          }
          ?>
          <tr class="wcusage-admin-table-col-footer">
            <td colspan="7"><a href="/wp-admin/edit.php?post_type=shop_order&wcu_coupons=ALL" style="text-decoration: none;">View All Referrals <i class="fa-solid fa-arrow-right"></i></a></td>
          </tr>
        </tbody>
    </table>
  <?php } else { ?>
    <p><?php echo __('No recent referral orders found.', 'woo-coupon-usage'); ?></p>
  <?php } ?>
  </div>

  <?php
}

/**
 * Displays visits section on dashboard page.
 *
 */
add_action( 'wcusage_hook_dashboard_page_section_visits', 'wcusage_dashboard_page_section_visits' );
function wcusage_dashboard_page_section_visits() {

  global $wpdb;
  $table_name = $wpdb->prefix . 'wcusage_clicks';

  $get_visits = $wpdb->get_results( "SELECT * FROM " . $table_name . " ORDER BY id DESC LIMIT 5" );
  ?>

  <div>
    <?php if(!empty($get_visits)) { ?>
    <table style="border: 2px solid #f3f3f3; width: 100%; text-align: center; border-collapse: collapse;">
        <thead>
          <tr class="wcusage-admin-table-col-head">
            <th><?php echo __('Date', 'woo-coupon-usage'); ?></th>
            <th><?php echo __('Coupon', 'woo-coupon-usage'); ?></th>
            <th><?php echo __('Referrer Domain', 'woo-coupon-usage'); ?></th>
            <th><?php echo __('Converted', 'woo-coupon-usage'); ?></th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($get_visits as $result) {
            $id = $result->id;
            $date = $result->date;
              $date = date_i18n( 'F jS (H:i)', strtotime($date) );
            $coupon_id = $result->couponid;
              $coupon = get_the_title($coupon_id);
            $referrer = $result->referrer;
            $converted = $result->converted;
              $converted = $converted ? "yes" : "no";
            ?>
            <tr class="wcusage-admin-table-col-row">
              <td><?php echo $date; ?></td>
              <td><?php echo $coupon; ?></td>
              <td><?php echo $referrer; ?></td>
              <td><?php echo ucfirst($converted); ?></td>
            </tr>
            <?php
          }
          ?>
          <tr class="wcusage-admin-table-col-footer">
            <td colspan="5"><a href="/wp-admin/admin.php?page=wcusage_clicks" style="text-decoration: none;">View All Clicks <i class="fa-solid fa-arrow-right"></i></a></td>
          </tr>
        </tbody>
    </table>
  <?php } else { ?>
    <p><?php echo __('No recent clicks found.', 'woo-coupon-usage'); ?></p>
  <?php } ?>
  </div>

  <?php
}

/**
 * Displays coupons section on dashboard page.
 *
 */
add_action( 'wcusage_hook_dashboard_page_section_coupons', 'wcusage_dashboard_page_section_coupons' );
function wcusage_dashboard_page_section_coupons() {

  $args = array(
    'posts_per_page'   => 5,
    'orderby'          => 'date',
    'order'            => 'desc',
    'post_type'        => 'shop_coupon',
    'meta_query' => array(
        array(
            'key' => 'wcu_select_coupon_user',
            'value'   => array(''),
            'compare' => 'NOT IN'
        )
    ),
    'post_status'      => 'publish',
  );
  $coupons = get_posts( $args );
  ?>

  <div>
    <?php if(!empty($coupons)) { ?>
    <table style="border: 2px solid #f3f3f3; width: 100%; text-align: center; border-collapse: collapse;">
        <thead>
          <tr class="wcusage-admin-table-col-head">
            <th><?php echo __('Affiliate', 'woo-coupon-usage'); ?></th>
            <th><?php echo __('Coupon', 'woo-coupon-usage'); ?></th>
            <th><?php echo __('Created', 'woo-coupon-usage'); ?></th>
          </tr>
        </thead>
        <tbody>
        <?php
        foreach ( $coupons as $coupon ) {
          $coupon_code = $coupon->post_title;
          $coupon_id = $coupon->ID;
          $date = $coupon->post_date;
            $date = date_i18n( 'F jS (H:i)', strtotime($date) );
          $user_id = get_post_meta($coupon_id, 'wcu_select_coupon_user', true);
          $user = get_userdata( $user_id );

      		$coupon_info = wcusage_get_coupon_info_by_id($coupon_id);
      		$uniqueurl = $coupon_info[4];
          ?>
          <tr class="wcusage-admin-table-col-row">
            <td><a href="<?php echo get_edit_user_link($user_id); ?>" title="<?php echo $user->user_login; ?>" target="_blank"><?php echo $user->first_name; ?> <?php echo $user->last_name; ?></a></td>
            <td><a href="<?php echo $uniqueurl; ?>" title="View Dashboard" target="_blank"><?php echo get_the_title($coupon_id); ?></a></td>
            <td><?php echo $date; ?></td>
          </tr>
          <?php
          }
          ?>
          <tr class="wcusage-admin-table-col-footer">
            <td colspan="5"><a href="/wp-admin/edit.php?post_type=shop_coupon" style="text-decoration: none;">View All Affiliate Coupons <i class="fa-solid fa-arrow-right"></i></a></td>
          </tr>
        </tbody>
    </table>
  <?php } else { ?>
    <p><?php echo __('No new affiliate coupons found.', 'woo-coupon-usage'); ?></p>
  <?php } ?>
  </div>

  <?php
}

/**
 * Displays registrations section on dashboard page.
 *
 */
add_action( 'wcusage_hook_dashboard_page_section_registrations', 'wcusage_dashboard_page_section_registrations' );
function wcusage_dashboard_page_section_registrations() {

  global $wpdb;
  $table_name = $wpdb->prefix . 'wcusage_register';

  $get_visits = $wpdb->get_results( "SELECT * FROM " . $table_name . " ORDER BY id DESC LIMIT 5" );
  ?>

  <div>
    <?php if(!empty($get_visits)) { ?>
    <table style="border: 2px solid #f3f3f3; width: 100%; text-align: center; border-collapse: collapse;">
        <thead>
          <tr class="wcusage-admin-table-col-head">
            <th><?php echo __('Affiliate', 'woo-coupon-usage'); ?></th>
            <th><?php echo __('Date', 'woo-coupon-usage'); ?></th>
            <th><?php echo __('Coupon', 'woo-coupon-usage'); ?></th>
            <th><?php echo __('Status', 'woo-coupon-usage'); ?></th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($get_visits as $result) {
            $user_id = $result->userid;
            $user = get_userdata( $user_id );
            $date = $result->date;
              $date = date_i18n( 'F jS (H:i)', strtotime($date) );
            $coupon = $result->couponcode;
            $status = $result->status;
            ?>
            <tr class="wcusage-admin-table-col-row">
              <td><a href="<?php echo get_edit_user_link($user_id); ?>" title="<?php echo $user->user_login; ?>" target="_blank"><?php echo $user->first_name; ?> <?php echo $user->last_name; ?></a></td>
              <td><?php echo $date; ?></td>
              <td><?php echo $coupon; ?></td>
              <td><?php echo ucfirst($status); ?></td>
            </tr>
            <?php
          }
          ?>
          <tr class="wcusage-admin-table-col-footer">
            <td colspan="5"><a href="/wp-admin/admin.php?page=wcusage_registrations" style="text-decoration: none;">View Registrations <i class="fa-solid fa-arrow-right"></i></a></td>
          </tr>
        </tbody>
    </table>
  <?php } else { ?>
    <p><?php echo __('No recent registrations found.', 'woo-coupon-usage'); ?></p>
  <?php } ?>
  </div>

  <?php
}

/**
 * Displays payouts section on dashboard page.
 *
 */
add_action( 'wcusage_hook_dashboard_page_section_payouts', 'wcusage_dashboard_page_section_payouts' );
function wcusage_dashboard_page_section_payouts() {

  global $wpdb;
  $table_name = $wpdb->prefix . 'wcusage_payouts';

  $get_visits = $wpdb->get_results( "SELECT * FROM " . $table_name . " ORDER BY id DESC LIMIT 5" );
  ?>

  <div>
    <?php if(!empty($get_visits)) { ?>
    <table style="border: 2px solid #f3f3f3; width: 100%; text-align: center; border-collapse: collapse;">
        <thead>
          <tr class="wcusage-admin-table-col-head">
            <th><?php echo __('Affiliate', 'woo-coupon-usage'); ?></th>
            <th><?php echo __('Date', 'woo-coupon-usage'); ?></th>
            <th><?php echo __('Coupon', 'woo-coupon-usage'); ?></th>
            <th><?php echo __('Amount', 'woo-coupon-usage'); ?></th>
            <th><?php echo __('Status', 'woo-coupon-usage'); ?></th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($get_visits as $result) {
            $user_id = $result->userid;
            $user = get_userdata( $user_id );
            $date = $result->date;
              $date = date_i18n( 'F jS (H:i)', strtotime($date) );
            $coupon_id = $result->couponid;
              $coupon = get_the_title($coupon_id);
              if(!$coupon) { $coupon = "(MLA)"; }
            $status = $result->status;
            $paid = $result->amount;
            ?>
            <tr class="wcusage-admin-table-col-row">
              <td><a href="<?php echo get_edit_user_link($user_id); ?>" title="<?php echo $user->user_login; ?>" target="_blank"><?php echo $user->first_name; ?> <?php echo $user->last_name; ?></a></td>
              <td><?php echo $date; ?></td>
              <td><?php echo $coupon; ?></td>
              <td><?php echo wcusage_format_price( number_format($paid, 2, '.', '') ); ?></td>
              <td><?php echo ucfirst($status); ?></td>
            </tr>
            <?php
          }
          ?>
          <tr class="wcusage-admin-table-col-footer">
            <td colspan="5"><a href="/wp-admin/admin.php?page=wcusage_payouts" style="text-decoration: none;">View Payouts <i class="fa-solid fa-arrow-right"></i></a></td>
          </tr>
        </tbody>
    </table>
  <?php } else { ?>
    <p><?php echo __('No recent payouts found.', 'woo-coupon-usage'); ?></p>
  <?php } ?>
  </div>

  <?php
}

/**
 * Displays dashboard page.
 *
 */
function wcusage_dashboard_page_html() {
// check user capabilities
if ( ! wcusage_check_admin_access() ) {
return;
}
?>

<link rel="stylesheet" href="<?php echo WCUSAGE_UNIQUE_PLUGIN_URL .'fonts/font-awesome/css/all.min.css'; ?>" crossorigin="anonymous">

<style>
@media screen and (max-width: 1040px) { .wcusage-admin-page-col { width: calc(100% - 85px) !important; } }
.wcusage-admin-page-col-section {
  padding: 0; margin: 0; list-style: none; display: -webkit-box; display: -moz-box; display: -ms-flexbox; display: -webkit-flex; display: flex; -webkit-flex-flow: row wrap; justify-content: space-around;
}
strong { color: green; font-size: 16px; }
h2 { font-size: 22px; }
</style>

<div class="wrap plugin-settings">

	<h1></h1>

  <?php echo do_action( 'wcusage_hook_dashboard_page_header', ''); ?>

  <div class="wcusage-admin-page-col-section">

  	<div class="wcusage-admin-page-col" style="width: calc(100% - 85px);">
      <h2><?php echo __('Affiliate Statistics (Last 7 Days)', 'woo-coupon-usage'); ?></h2>
      <?php echo do_action( 'wcusage_hook_dashboard_page_section_statistics', ''); ?>
  	</div>

    <?php
    $enable_activity_log = wcusage_get_setting_value('wcusage_enable_activity_log', '1');
    if($enable_activity_log) {
    ?>
    	<div class="wcusage-admin-page-col">
        <h2><?php echo __('Recent Activity', 'woo-coupon-usage'); ?></h2>
        <?php echo do_action( 'wcusage_hook_dashboard_page_section_activity', ''); ?>
      </div>
    <?php } ?>

  	<div class="wcusage-admin-page-col">
      <h2><?php echo __('Latest Referrals', 'woo-coupon-usage'); ?></h2>
      <?php echo do_action( 'wcusage_hook_dashboard_page_section_referrals', ''); ?>
  	</div>

    <div class="wcusage-admin-page-col">
      <h2><?php echo __('Latest Referral Visits', 'woo-coupon-usage'); ?></h2>
      <?php echo do_action( 'wcusage_hook_dashboard_page_section_visits', ''); ?>
    </div>

    <div class="wcusage-admin-page-col">
      <h2><?php echo __('Newest Affiliate Coupons', 'woo-coupon-usage'); ?></h2>
      <?php echo do_action( 'wcusage_hook_dashboard_page_section_coupons', ''); ?>
    </div>

    <?php
    if ( wcu_fs()->can_use_premium_code() ) {
      $wcusage_field_registration_enable = wcusage_get_setting_value('wcusage_field_registration_enable', '1');
      if($wcusage_field_registration_enable) {
      ?>
      <div class="wcusage-admin-page-col">
        <h2><?php echo __('Pending Affiliate Registrations', 'woo-coupon-usage'); ?></h2>
        <?php echo do_action( 'wcusage_hook_dashboard_page_section_registrations', ''); ?>
      </div>
      <?php
      }
    }
    ?>

    <?php
    if ( wcu_fs()->can_use_premium_code() ) {
      $wcusage_field_tracking_enable = wcusage_get_setting_value('wcusage_field_tracking_enable', 1);
      if($wcusage_field_tracking_enable) {
      ?>
      <div class="wcusage-admin-page-col">
        <h2><?php echo __('Pending Payout Requests', 'woo-coupon-usage'); ?></h2>
        <?php echo do_action( 'wcusage_hook_dashboard_page_section_payouts', ''); ?>
    	</div>
      <?php
      }
    }
    ?>

  </div>

</div>

<?php
}
