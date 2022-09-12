<?php
/**
 * My Account Dashboard
 *
 * Shows the first intro screen on the account dashboard.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/dashboard.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$allowed_html = array(
	'a' => array(
		'href' => array(),
	),
);
?>
<?php 
	


?>
<p>
	<?php
	printf(
		/* translators: 1: user display name 2: logout url */
		wp_kses( __( 'Hello %1$s (not %1$s? <a href="%2$s">Log out</a>)', 'woocommerce' ), $allowed_html ),
		'<strong>' . esc_html( $current_user->display_name ) . '</strong>',
		esc_url( wc_logout_url() )
	);
	?>
</p>

<p>
	<?php
	/* translators: 1: Orders URL 2: Address URL 3: Account URL. */
	$dashboard_desc = __( 'From your account dashboard you can view your <a href="%1$s">recent orders</a>, manage your <a href="%2$s">billing address</a>, and <a href="%3$s">edit your password and account details</a>.', 'woocommerce' );
	if ( wc_shipping_enabled() ) {
		/* translators: 1: Orders URL 2: Addresses URL 3: Account URL. */
		$dashboard_desc = __( 'From your account dashboard you can view your <a href="%1$s">recent orders</a>, manage your <a href="%2$s">shipping and billing addresses</a>, and <a href="%3$s">edit your password and account details</a>.', 'woocommerce' );
	}
	printf(
		wp_kses( $dashboard_desc, $allowed_html ),
		esc_url( wc_get_endpoint_url( 'orders' ) ),
		esc_url( wc_get_endpoint_url( 'edit-address' ) ),
		esc_url( wc_get_endpoint_url( 'edit-account' ) )
	);
	?>
</p>

<?php
	/**
	 * My Account dashboard.
	 *
	 * @since 2.6.0
	 */
	do_action( 'woocommerce_account_dashboard' );

	/**
	 * Deprecated woocommerce_before_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_before_my_account' );

	/**
	 * Deprecated woocommerce_after_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_after_my_account' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */

?>
<!-- Custom show dashboard infomation  -->
<?php $current_user = wp_get_current_user(); ?>
<?php if ( ! $current_user->exists() ) : return; else:?>
	<div class="profile-break"></div>
	<div class="ac-avatar">
		<p class="fw-bold">Avatar</p>
		
		<div class="avatar-row d-flex align-items-center">
			<div class="avatar-img pe-3">
				<?php if( get_field('tt_userImage','user_'. $current_user->ID)): ?>
					<img id="avtChange" src="<?php the_field('tt_userImage','user_'. $current_user->ID); ?>" />
				<?php else:?>
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/avatar.svg" alt="">
				<?php endif;?>
			</div>
			<div class="avatar-button">
				<!-- <form action="" method="post"  enctype="multipart/form-data" id="test">
					<input type="file" name="pet_avatar" id="FileAttachment" class="upload"/>
					<button>Change</button>
					<input type="submit" name="avatar_save" class="tt" />
				</form>	 -->
				<form action="<?php echo get_stylesheet_directory_uri(); ?>/process_upload.php" method="post" enctype="multipart/form-data">
					<input type="file" name="profile_picture"  id="profile_picture"/>
					<div class="pb-2">
						<label for="profile_picture"><a  class="btn btn-outline-primary">Upload</a></label>
						<span class="px-2"> Vui lòng chọn ảnh kích thước 400x400</span>
					</div>
					<!-- <span class="px-2"> Chọn hình ảnh phù hợp, không phản cảm</span> -->
					<input type="submit"  class="btn btn-outline-primary" name="submit" value="Save" />
				</form> 
			</div>
		</div>
		<div class="profile-break"></div>
		<div class="profile-info">
			<p class="fw-bold">Tổng quan</p>
			<div class="profile-common">
				<?php 
					global $wp_roles;
					$user_data = get_userdata($current_user->ID);
					$user_role_slug = $user_data->roles[0];
					$user_role_name = $wp_roles->roles[$user_role_slug]['name'];
				?>
				<div class="row">
					<div class="col col-lg-3 col-md-4 col-6 py-2">
						<div class="profile-item ">
							<span class="d-block">Tên đăng nhập</span>
							<span class="profile-name"><?php echo $current_user->user_login; ?> </span>
						</div>
					</div>
					<div class="col col-lg-3 col-md-4 col-6 py-2">
						<div class="profile-item ">
							<span class="d-block">Họ và tên</span>
							<span class="profile-name"><?php echo $current_user->user_lastname.' '.$current_user->user_firstname;?> </span>
						</div>
					</div>
					<div class="col col-lg-3 col-md-4 col-6 py-2">
						<div class="profile-item ">
							<span class="d-block">Tên hiển thị</span>
							<span class="profile-name"><?php echo $current_user->display_name;?> </span>
						</div>
					</div>
					<div class="col col-lg-3 col-md-4 col-6 py-2">
						<div class="profile-item ">
							<span class="d-block">Email</span>
							<span class="profile-name"><?php echo $current_user->user_email;?> </span>
						</div>
					</div>
					<div class="col col-lg-3 col-md-4 col-6 py-2">
						<div class="profile-item ">
							<span class="d-block">Loại tài khoản</span>
							<span class="profile-name"><?php echo $user_role_name;?> </span>
						</div>
					</div>
					<?php 
						// echo "<pre>";
						// var_dump( );
						// echo "</pre>";
					?>
				</div>
			</div>
			<!-- <div class="row py-3">
				<div class="col-lg-6 col-12">
					<div class="mb-3">
						<label for="lastname" class="form-label">Họ</label>
						<input type="text" class="form-control" id="lastname"  readonly aria-describedby="emailHelp" value="<?php echo $current_user->user_lastname;?>">
					</div>
				</div>
				<div class="col-lg-6 col-12">
					<div class="mb-3">
						<label for="fistname" class="form-label">Tên</label>
						<input type="text" class="form-control" id="fistname" readonly aria-describedby="emailHelp"  value="<?php echo $current_user->user_firstname;?>">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<div class="mb-3">
						<label for="fullname" class="form-label">Tên hiển thị</label>
						<input type="text" class="form-control" id="fullname" readonly aria-describedby="emailHelp" value="<?php echo $current_user->display_name;?>">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<div class="mb-3">
						<label for="email" class="form-label">Email</label>
						<input type="email" class="form-control" id="email" readonly aria-describedby="emailHelp" value="<?php echo $current_user->user_email;?>">
					</div>
				</div>
			</div> -->
			<div class="mb-2"></div>
			<a href="<?php echo esc_url( wc_get_account_endpoint_url('edit-account') ); ?>" class="btn btn-outline-primary">Sửa thông tin</a>
			<?php 
				$customer = wp_get_current_user(); // do this when user is logged in
				$customer_orders = get_posts(array(
					'numberposts' => -1,
					'meta_key' => '_customer_user',
					'orderby' => 'date',
					'order' => 'DESC',
					'meta_value' => get_current_user_id(),
					'post_type' => wc_get_order_types(),
					'post_status' => array_keys(wc_get_order_statuses()), 
					'fields' => 'ids',
					'date_query' => array(
						array(
							'after' => '2 day ago'
						)
					)
				));

				$user_orders = array(); //
				foreach ($customer_orders as $orderID) {
					$orderObj = wc_get_order($orderID);
					$user_orders[] = array(
						"orderID" => $orderObj->get_id(),
						"orderTotal" => $orderObj->get_total(),
						"orderDate" => $orderObj->get_date_created()->date_i18n('Y-m-d h:i:s'),
					);
				}
				echo '<pre>';
				var_dump($user_orders);
				echo '</pre>';
				// foreach ($user_orders as $user_orders_item) {
				// 	echo '<pre>';
				// 	// var_dump( count($user_orders) );
				// 	var_dump($user_orders_item['orderTotal']);
				// 	// echo "break";
				// 	echo '</pre>';
				// 	// echo "step2";
				// }
			?>
		</div>
	</div>
<?php endif; ?>
<?php 
// $upload_dir = wp_upload_dir();
// echo "<pre>";
// var_dump($upload_dir['baseurl'].'/profile');
// echo "</pre>";
?>

 