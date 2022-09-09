<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function wcusage_admin_clicks_page_html() {
// check user capabilities
if ( ! wcusage_check_admin_access() ) {
return;
}
?>

<link rel="stylesheet" href="<?php echo WCUSAGE_UNIQUE_PLUGIN_URL .'fonts/font-awesome/css/all.min.css'; ?>" crossorigin="anonymous">

<!-- Check Website Field Enabled -->
<?php
$wcusage_click_enable_website = wcusage_get_setting_value('wcusage_field_click_enable_website', '0');
$wcusage_field_track_click_ip = wcusage_get_setting_value('wcusage_field_track_click_ip', '1');
?>

<?php if(!$wcusage_click_enable_website) { ?>
<style>.column-website { display: none; }</style>
<?php } ?>

<!-- Delete Click Entry When Click Delete Button -->
<?php
if(isset($_POST['_wpnonce'])) {
  $nonce = $_REQUEST['_wpnonce'];
  if(isset($_POST['wcu-status-delete']) && wp_verify_nonce( $nonce, 'delete_url' )  ){
  	$postid = sanitize_text_field( $_POST['wcu-id'] );
  	$delete = wcusage_delete_click_entry($postid);
  }
}
?>

<!-- Add BlackList IP/ID When When Click Button -->
<?php
if(isset($_POST['_wpnonce'])) {
  $nonce = $_REQUEST['_wpnonce'];
  if(isset($_POST['wcu-blacklist-ipaddress']) && wp_verify_nonce( $nonce, 'blacklist_url' )  ){
    $option_group = get_option('wcusage_options');
    $wcusage_field_fraud_block_ips = wc_sanitize_textarea($option_group['wcusage_field_fraud_block_ips'] . "\n" . $_POST['wcu-blacklist-ipaddress']);
    $wcusage_field_fraud_block_ips = preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $wcusage_field_fraud_block_ips); /* Remove Empty Lines */
    $option_group['wcusage_field_fraud_block_ips'] = $wcusage_field_fraud_block_ips;
    update_option( 'wcusage_options', $option_group );
  }
}
?>

<!-- Remove BlackList IP/ID When When Click Button -->
<?php
if(isset($_POST['_wpnonce'])) {
  $nonce = $_REQUEST['_wpnonce'];
  if(isset($_POST['wcu-blacklist-ipaddress-remove']) && wp_verify_nonce( $nonce, 'blacklist_url' )  ){
    $option_group = get_option('wcusage_options');
    $wcusage_field_fraud_block_ips = wc_sanitize_textarea( str_replace( $_POST['wcu-blacklist-ipaddress-remove'], '', $option_group['wcusage_field_fraud_block_ips']) );
    $wcusage_field_fraud_block_ips = preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $wcusage_field_fraud_block_ips); /* Remove Empty Lines */
    $option_group['wcusage_field_fraud_block_ips'] = $wcusage_field_fraud_block_ips;
    update_option( 'wcusage_options', $option_group );
  }
}
?>

<!-- Styling -->
<style type="text/css">
.column-id { width: 50px; }
<?php if( !wcu_fs()->can_use_premium_code() ) { ?>
.column-campaign { display: none; }
<?php } ?>
</style>

<?php echo do_action( 'wcusage_hook_dashboard_page_header', ''); ?>

<!-- Output Page -->
<div class="wrap plugin-settings">
	<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
	<?php
	$ListTable = new wcusage_clicks_List_Table();
	$ListTable->prepare_items();
	?>
	<div class="wrap" style="margin-top: -30px;">
		<input type="hidden" name="page" value="<?php echo esc_attr( $_REQUEST['page'] ) ?>" />
		<?php $ListTable->display() ?>
	</div>
</div>

<?php
}

/***** Function to Delete Click Entry *****/
function wcusage_delete_click_entry($id) {
 	global $wpdb;
 	$table_name = $wpdb->prefix . 'wcusage_clicks';
 	$where = [ 'id' => $id ];
 	$wpdb->delete( $table_name, $where );
}
