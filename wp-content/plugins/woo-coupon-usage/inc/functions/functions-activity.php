<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/*** CREATE THE TABLES ***/

global $wcusage_activity_db_version;
$wcusage_activity_db_version = "3";

/**
 * Create database tables for activity
 *
 */
function wcusage_install_activity_tables() {

	global $wpdb;
	global $wcusage_activity_db_version;
	$installed_ver = get_option( "wcusage_activity_db_version" );

	if ( $installed_ver != $wcusage_activity_db_version ) {

		$table_name = $wpdb->prefix . 'wcusage_activity';

		$sql = "CREATE TABLE $table_name (
			id bigint NOT NULL AUTO_INCREMENT,
			event_id bigint NOT NULL,
			event text(9) NOT NULL,
      user_id bigint NOT NULL,
      info text(9) NOT NULL,
      date datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
			PRIMARY KEY (id)
		);";

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );

		update_option( "wcusage_activity_db_version", $wcusage_activity_db_version );

	}
}

/**
 * Check / Update Creatives Database Table
 *
 */
function wcusage_update_activity_db_check() {
    global $wcusage_activity_db_version;
    if ( get_site_option( 'wcusage_activity_db_version' ) != $wcusage_activity_db_version ) {
        wcusage_install_activity_tables();
    }
}
add_action( 'plugins_loaded', 'wcusage_update_activity_db_check' );

/**
 * Function to install data to table
 *
 * @param int $coupon_id
 * @param string $name
 *
 * @return mixed
 *
 */
function wcusage_add_activity($event_id, $event, $info) {

    $enable_activity_log = wcusage_get_setting_value('wcusage_enable_activity_log', '1');
    if($enable_activity_log) {

  		$event_id = sanitize_text_field($event_id);
  		$event = sanitize_text_field($event);

      global $wpdb;
  		$table_name = $wpdb->prefix . 'wcusage_activity';

  		$wpdb->insert(
  			$table_name,
  			array(
  				'event_id' => $event_id,
  				'event' => $event,
          'user_id' => get_current_user_id(),
          'date' => current_time( 'mysql' ),
          'info' => $info,
  			)
  		);
  		$last_id = $wpdb->insert_id;

  		return $last_id;

    } else {

      return 0;

    }

}

/**
 * Displays activity log event message.
 *
 * @param string $event
 * @param int $event_id
 * @param string $info
 *
 * @return string
 *
 */
function wcusage_activity_message($event, $event_id, $info) {

  switch ( $event ) {
    case 'referral':
      $event_message = "New order referral by an affiliate:" . " <a href='/wp-admin/post.php?post=".$event_id."&action=edit'>#".$event_id."</a>";
      break;
    case 'registration':
      $event_message = "New affiliate registration:" . " " . $info;
      break;
    case 'registration_accept':
      $event_message = "Affiliate registration accepted:" . " " . $info;
      break;
    case 'mla_invite':
      $event_message = $info . " was invited to an affiliate network.";
      break;
    case 'direct_link_domain':
      $event_message = "Direct link domain request:" . " " . $info;
      break;
    case 'payout_request':
      $event_message = "New payout request (#".$event_id."):" . " " . wcusage_format_price($info);
      break;
    case 'payout_paid':
      $event_message = "Payout request paid (#".$event_id."):" . " " . wcusage_format_price($info);
      break;
      case 'payout_reversed':
        $event_message = "Payout request reversed (#".$event_id."):" . " " . wcusage_format_price($info);
        break;
    case 'new_campaign':
      $event_message = "New campaign added by an affiliate:" . " " . $info;
      break;
  }

  return $event_message;

}
