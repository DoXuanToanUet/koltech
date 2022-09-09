<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function wcusage_admin_activity_page_html() {
// check user capabilities
if ( ! wcusage_check_admin_access() ) {
return;
}
?>

<link rel="stylesheet" href="<?php echo WCUSAGE_UNIQUE_PLUGIN_URL .'fonts/font-awesome/css/all.min.css'; ?>" crossorigin="anonymous">

<?php echo do_action( 'wcusage_hook_dashboard_page_header', ''); ?>

<style>@media screen and (min-width: 540px) { .column-user_id { width: 250px; max-width: 100%; } }</style>
<style>@media screen and (min-width: 540px) { .column-event { text-align: left !important; } }</style>

<!-- Output Page -->
<div class="wrap plugin-settings">
	<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
	<?php
	$ListTable = new wcusage_activity_List_Table();
	$ListTable->prepare_items();
	?>
	<div class="wrap" style="margin-top: -30px;">
		<input type="hidden" name="page" value="<?php echo esc_attr( $_REQUEST['page'] ) ?>" />
		<?php $ListTable->display() ?>
	</div>
</div>

<?php
}
