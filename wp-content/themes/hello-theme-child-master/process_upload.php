<?php 
// if( isset($_POST['avatar_save']) ){
//   $post_thumb = $_FILES['pet_avatar']['name'];

//   $file = $_FILES['pet_avatar']['tmp_name'];
//   echo $post_thumb;
//   die();
//   $parent_post_id = 239;
//   var_dump($parent_post_id);
//   $upload_file = wp_upload_bits($post_thumb, null, @file_get_contents($file));
//   if (!$upload_file['error'] || !$upload_file['error']) {
//   //if succesfull insert the new file into the media library (create a new attachment post type)
//   $wp_filetype = wp_check_filetype($post_thumb, null);
//   $attachment = array(
//     'post_mime_type' => $wp_filetype['type'],
//     'post_title'     => preg_replace('/\.[^.]+$/', '', $post_thumb),
//     'post_content'   => '',
//     'post_status'    => 'inherit'
//   );
//   echo "toandx";
//   $attachment_id = wp_insert_attachment($attachment, $upload_file['file'], $parent_post_id);
//   if (!is_wp_error($attachment_id)) {
//     //if attachment post was successfully created, insert it as a thumbnail to the post $post_id
//     require_once(ABSPATH . "wp-admin" . '/includes/image.php');
//     require_once(ABSPATH . "wp-admin" . '/includes/file.php');
//     require_once(ABSPATH . "wp-admin" . '/includes/media.php');

//     $attachment_data = wp_generate_attachment_metadata($attachment_id, $upload_file['file']);
//     wp_update_attachment_metadata($attachment_id, $attachment_data);
//     // set_post_thumbnail($parent_post_id, $attachment_id);
//   }

//   }
// }

/**
 * Upload image from URL programmatically
 *
 * @author Misha Rudrastyh
 * @link https://rudrastyh.com/wordpress/how-to-add-images-to-media-library-from-uploaded-files-programmatically.html#upload-image-from-url
 */
// function rudr_upload_file_by_url( $image_url ) {

// 	// it allows us to use download_url() and wp_handle_sideload() functions
// 	require_once( ABSPATH . 'wp-admin/includes/file.php' );

// 	// download to temp dir
// 	$temp_file = download_url( $image_url );

// 	if( is_wp_error( $temp_file ) ) {
// 		return false;
// 	}

// 	// move the temp file into the uploads directory
// 	$file = array(
// 		'name'     => basename( $image_url ),
// 		'type'     => mime_content_type( $temp_file ),
// 		'tmp_name' => $temp_file,
// 		'size'     => filesize( $temp_file ),
// 	);
// 	$sideload = wp_handle_sideload(
// 		$file,
// 		array(
// 			'test_form'   => false // no needs to check 'action' parameter
// 		)
// 	);

// 	if( ! empty( $sideload[ 'error' ] ) ) {
// 		// you may return error message if you want
// 		return false;
// 	}

// 	// it is time to add our uploaded image into WordPress media library
// 	$attachment_id = wp_insert_attachment(
// 		array(
// 			'guid'           => $sideload[ 'url' ],
// 			'post_mime_type' => $sideload[ 'type' ],
// 			'post_title'     => basename( $sideload[ 'file' ] ),
// 			'post_content'   => '',
// 			'post_status'    => 'inherit',
// 		),
// 		$sideload[ 'file' ]
// 	);

// 	if( is_wp_error( $attachment_id ) || ! $attachment_id ) {
// 		return false;
// 	}

// 	// update medatata, regenerate image sizes
// 	require_once( ABSPATH . 'wp-admin/includes/image.php' );

// 	wp_update_attachment_metadata(
// 		$attachment_id,
// 		wp_generate_attachment_metadata( $attachment_id, $sideload[ 'file' ] )
// 	);

// 	return $attachment_id;

// }

// WordPress environmet
require( dirname(__FILE__) . '/../../../wp-load.php' );

// it allows us to use wp_handle_upload() function
require_once( ABSPATH . 'wp-admin/includes/file.php' );

// you can add some kind of validation here
if( empty( $_FILES[ 'profile_picture' ] ) ) {
	wp_die( 'Bạn chưa chọn hình ảnh' );
	
}

$upload = wp_handle_upload( 
	$_FILES[ 'profile_picture' ], 
	array( 'test_form' => false ) 
);
var_dump( $upload );
if( ! empty( $upload[ 'error' ] ) ) {
	wp_die( $upload[ 'error' ] );
}
$image_info = getimagesize( $upload[ 'url' ] );
// echo "<pre>";
// var_dump($image_info);
// echo "</pre>";
$image_width = $image_info[0];
$image_height = $image_info[1];

if($image_width > "400" || $image_height > "400") {
    // echo "Error : image size must be 400 x 400 pixels.";
	$url = get_permalink( get_option('woocommerce_myaccount_page_id') );
	wp_safe_redirect($url);
    exit;
}else{
	// it is time to add our uploaded image into WordPress media library
	$attachment_id = wp_insert_attachment(
		array(
			'guid'           => $upload[ 'url' ],
			'post_mime_type' => $upload[ 'type' ],
			'post_title'     => basename( $upload[ 'file' ] ),
			'post_content'   => '',
			'post_status'    => 'inherit',
		),
		$upload[ 'file' ]
	);

	if( is_wp_error( $attachment_id ) || ! $attachment_id ) {
		wp_die( 'Upload error.' );
	}

	// update medatata, regenerate image sizes
	require_once( ABSPATH . 'wp-admin/includes/image.php' );

	wp_update_attachment_metadata(
		$attachment_id,
		wp_generate_attachment_metadata( $attachment_id, $upload[ 'file' ] )
	);

	// Update avatar
	$current_user = wp_get_current_user();
	// var_dump($current_user);
	update_field('tt_userImage', $attachment_id ,'user_' . $current_user->ID);
	// just redirect to the uploaded file
	$url_account= get_permalink( get_option('woocommerce_myaccount_page_id') );
	wp_safe_redirect($url_account);
	exit;

}


