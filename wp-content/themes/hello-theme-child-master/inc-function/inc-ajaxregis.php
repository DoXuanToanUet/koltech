<?php 
add_action('wp_ajax_regisForm', 'regisForm');
add_action('wp_ajax_nopriv_regisForm', 'regisForm');

function regisForm(){
    $err = '';
    $success = '';

    // First check the nonce, if it fails the function will break
    check_ajax_referer( 'ajax-regis-nonce', 'securityregis' );

    $last_name = isset($_POST['last_name']) ? $_POST['last_name'] : '';
    $first_name = isset($_POST['first_name']) ? $_POST['first_name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $pass = isset($_POST['pass']) ? $_POST['pass'] : '';
    $confirm_pass = isset($_POST['confirm_pass']) ? $_POST['confirm_pass'] : '';
    $kol_user = isset($_POST['kol_user_select']) ? $_POST['kol_user_select'] : '';
    $percent = isset($_POST['percent']) ? $_POST['percent'] : '';

    if( $email == "" || $username == "" || $pass == "" || $confirm_pass == "" ) {
        $err = 'Vui lòng không bỏ trống các thông tin!';
        wp_send_json_error(array(
            "showdata"=>$err,
            'class'=>'error'
        ));
        
    }else if( $pass != $confirm_pass ){
        $err = 'Mật khẩu không khớp';
        wp_send_json_error(array(
            "showdata"=>$err,
            'class'=>'error'
        ));

    }else if( username_exists($username) ){
        $err = 'Tên tài khoản không hợp lệ';
        wp_send_json_error(array(
            "showdata"=>$err,
            'class'=>'error'
        ));
    }else if( strlen($username) < 4  ){
        $err = 'Tên tài khoản của bạn quá ngắn (4 kí tự trở lên)';
        wp_send_json_error(array(
            "showdata"=>$err,
            'class'=>'error'
        ));      
    }else if( email_exists($email) || !is_email($email) ){
        $err = 'Email không hợp lệ';
        wp_send_json_error(array(
            "showdata"=>$err,
            'class'=>'error'
        ));      
    }else if( strlen($pass) < 4 ){
        $err = 'Password của bạn quá ngắn (4 kí tự trở lên)';
        wp_send_json_error(array(
            "showdata"=>$err,
            'class'=>'error'
        ));
        
    } else {
        $regis_user_id = wp_insert_user( 
            array (
                'first_name' => apply_filters('pre_user_first_name', $first_name),
                'last_name' => apply_filters('pre_user_last_name', $last_name),
                'user_pass' => apply_filters('pre_user_user_pass', $pass),
                'user_login' => apply_filters('pre_user_user_login', $username),
                'user_email' => apply_filters('pre_user_user_email', $email),
                'role' => $kol_user ) 
            );
        if( !is_wp_error( $regis_user_id ) ) {
            // wp_set_current_user($user_id);
            // wp_set_auth_cookie($user_id);
            wp_signon(
                array(
                    'user_login'    => $username,
                    'user_password' => $pass,
                    'remember'      => false,
                )
            );
            
            // $coupon_role = get_field('coupon_role_rp','option');
            // foreach ($coupon_role as $key => $value) {
            //     $coupon_role = $value['coupon_role'][0];
            //     $coupon_name  = $value['coupon_role_name'];
            //     if( $coupon_role == $kol_user){
                    $role_name_post = array(
                        'kol_user'          => 'KOL',
                        'partner_user'      =>  'PAT',
                        'saleman_user'      =>  'SM',
                        'distributor_user'  => 'DT'
                    );
                    foreach ($role_name_post as $key => $value) {
                        if( $key === $kol_user ){
                            $coupon_symbol = $value;
                        }
                    }
                    $coupon = array(
                        'post_title'  => 'TNT'.$coupon_symbol.$regis_user_id.date('is'),
                        'post_type'   => 'shop_coupon',
                        'post_status' => 'publish',
                        // 'post_author' => ,
                        // 'wcu_select_coupon_user'=> wp_get_current_user()->ID
                    );
                   
                    $coupon_id = wp_insert_post($coupon);   
                    // var_dump($regis_user_id);
                    $discount_type = 'percent';
                    $amount = $percent;

                    // update coupon settings 
                    add_post_meta( $coupon_id,'wcu_select_coupon_user', $regis_user_id);
                    update_post_meta( $coupon_id, 'discount_type', $discount_type );
                    update_post_meta( $coupon_id, 'coupon_amount', $amount );
                // }
                // echo "<pre>";
                // var_dump($value['coupon_role'][0]);
                // echo "</pre>";
            // }
 
            $success = 'Bạn đã đăng ký thành công!';
            wp_send_json_success(array(
                "message"=>"success",
                "showdata"=> $success,
                'class'=>'success'
            ));   
            
            
        } else {
            $err = 'Lỗi đăng ký tài khoản';
            wp_send_json_error(array(
                "showdata"=>$err,
                'class'=>'error'
            ));  
        }
    }
}


// add_action('wp_ajax_avatar_custom', 'avatar_custom');
// add_action('wp_ajax_nopriv_avatar_custom', 'avatar_custom');
// function avatar_custom(){
//     $upload_dir = wp_upload_dir();

// 	if ( isset( $_FILES[ 'misha_file' ] ) ) {
// 		$path = $upload_dir[ 'path' ] . '/' . basename( $_FILES[ 'misha_file' ][ 'name' ] );

// 		if( move_uploaded_file( $_FILES[ 'misha_file' ][ 'tmp_name' ], $path ) ) {
// 			echo $upload_dir[ 'url' ] . '/' . basename( $_FILES[ 'misha_file' ][ 'name' ] );
// 		}
// 	}
// 	die;
// }

// add_action( 'wp_ajax_mishaupload', 'misha_file_upload' );
// add_action( 'wp_ajax_nopriv_mishaupload', 'misha_file_upload' );

// function misha_file_upload(){

// 	$upload_dir = wp_upload_dir();

// 	if ( isset( $_FILES[ 'misha_file' ] ) ) {
// 		$path = $upload_dir[ 'path' ] . '/' . basename( $_FILES[ 'misha_file' ][ 'name' ] );

// 		if( move_uploaded_file( $_FILES[ 'misha_file' ][ 'tmp_name' ], $path ) ) {
// 			echo $upload_dir[ 'url' ] . '/' . basename( $_FILES[ 'misha_file' ][ 'name' ] );
// 		}
// 	}
// 	die;
// }