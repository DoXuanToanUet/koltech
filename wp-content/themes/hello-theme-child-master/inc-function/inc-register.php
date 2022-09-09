<?php function createRegister()
{
?>
<?php if( !is_user_logged_in()):?>
<div class="register-form">
    <div class="register-form-title text-center" style="font-size:20px; padding-bottom:20px; font-weight:600">Đăng ký tài khoản</div>
    <form method="post" id="devRegis-form" class="devRegis-form">
        <div class="row row-small">
            <div class="col large-6">
                <div class="devRegis-item">
                    <label>Họ của bạn:</label>
                    <input type="text" value="" name="last_name" id="last_name" placeholder="Nhập họ của bạn" required/>
                </div>
            </div>
            <div class="col large-6">
                <div class="devRegis-item">
                    <label>Tên của bạn:</label>
                    <input type="text" value="" name="first_name" id="first_name" placeholder="Nhập tên của bạn"  required/>
                </div>
            </div>
        </div>
        <div class="devRegis-item">
            <label>Email của bạn:</label>
            <input type="text" value="" name="email" id="email" placeholder="Nhập email của bạn" required/>
        </div>
        <div class="devRegis-item">
            <label>Tài khoản:</label>
            <input type="text" value="" name="username" id="username" placeholder="Nhập tên tài khoản" required/>
        </div>
        <div class="devRegis-item">
            <label>Mật khẩu:</label>
            <input type="password" value="" name="pwd1" id="pwd1" placeholder="Nhập mật khẩu" required/>
            <div class="show-password-icon" id="show-password-icon">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="512" height="512" x="0" y="0" viewBox="0 0 128 128" style="enable-background:new 0 0 512 512" xml:space="preserve" class="hovered-paths"><g><path xmlns="http://www.w3.org/2000/svg" id="Show" d="m64 104c-41.873 0-62.633-36.504-63.496-38.057-.672-1.209-.672-2.678 0-3.887.863-1.552 21.623-38.056 63.496-38.056s62.633 36.504 63.496 38.057c.672 1.209.672 2.678 0 3.887-.863 1.552-21.623 38.056-63.496 38.056zm-55.293-40.006c4.758 7.211 23.439 32.006 55.293 32.006 31.955 0 50.553-24.775 55.293-31.994-4.758-7.211-23.439-32.006-55.293-32.006-31.955 0-50.553 24.775-55.293 31.994zm55.293 24.006c-13.234 0-24-10.766-24-24s10.766-24 24-24 24 10.766 24 24-10.766 24-24 24zm0-40c-8.822 0-16 7.178-16 16s7.178 16 16 16 16-7.178 16-16-7.178-16-16-16z" fill="#000000" data-original="#000000" class="hovered-path"></path></g></svg>
            </div>
        </div>
        <div class="devRegis-item">
            <label>Nhập lại mật khẩu:</label>
            <input type="password" value="" name="pwd2" id="pwd2" placeholder="Xác nhận mật khẩu" required />
            <div class="show-password-icon" id="show-password-icon2">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="512" height="512" x="0" y="0" viewBox="0 0 128 128" style="enable-background:new 0 0 512 512" xml:space="preserve" class="hovered-paths"><g><path xmlns="http://www.w3.org/2000/svg" id="Show" d="m64 104c-41.873 0-62.633-36.504-63.496-38.057-.672-1.209-.672-2.678 0-3.887.863-1.552 21.623-38.056 63.496-38.056s62.633 36.504 63.496 38.057c.672 1.209.672 2.678 0 3.887-.863 1.552-21.623 38.056-63.496 38.056zm-55.293-40.006c4.758 7.211 23.439 32.006 55.293 32.006 31.955 0 50.553-24.775 55.293-31.994-4.758-7.211-23.439-32.006-55.293-32.006-31.955 0-50.553 24.775-55.293 31.994zm55.293 24.006c-13.234 0-24-10.766-24-24s10.766-24 24-24 24 10.766 24 24-10.766 24-24 24zm0-40c-8.822 0-16 7.178-16 16s7.178 16 16 16 16-7.178 16-16-7.178-16-16-16z" fill="#000000" data-original="#000000" class="hovered-path"></path></g></svg>
            </div>
        </div>
        
        <?php 
           global $wp_roles;
           $all_roles = $wp_roles->roles;
            if ( ! isset( $wp_roles ) ){
                $wp_roles = new WP_Roles();
            }
            $all_roles = $wp_roles->get_names();
            // echo "<pre>";
            // var_dump(   $wp_roles->get_names() );
            // echo "</pre>"; 
            $all_roles_slide = array_slice( $all_roles , 9);
        ?>
        <select name="kol_role" id="kol_role">
            <option value="all">Chọn quản lí mà bạn muốn</option>
            <?php 
                foreach( $all_roles_slide as $key=>$value):
                    ?> <option value="<?php echo $key;?>" <?php if( $key == 'saleman_user' ){ echo "selected";}?>><?php echo $value;?></option><?php
                endforeach;
            ?>
        </select>

        <?php

            // Get value percent coupon acf
            $coupon_role = get_field('kol_coupon_rp','option');
            $coupon_role_arr = [];
            foreach ($coupon_role as $key => $value) {
                array_push( $coupon_role_arr, array (
                    'percent' => $value['kol_choose_percent'],
                    'name'  =>   $value['kol_choose_role'][0]
                    
                ));
            } 
            $coupon_role_arr = wp_list_pluck( $coupon_role_arr,  'percent', 'name' );
           
        ?>
        <input type="hidden" name="percent_coupon" value='<?php echo json_encode($coupon_role_arr); ?>'>

        <div class="devRegis-alert">
        </div>
        <p></p>
        <button type="submit" name="btnregister" id="devRegis-btn" class="button">Đăng ký</button>
        <p class="text-center">Bạn đã có tài khoản? <a href="#" class="login-link">Đăng nhập</a></p>
        <?php wp_nonce_field( 'ajax-regis-nonce', 'securityregis' ); ?>
        <input type="hidden" name="url_ajax" value="<?= admin_url('admin-ajax.php');?>">
        
    </form>
    <?php
    //     $cookie_name = "user";
    //     $cookie_value = "David Vinh";
    //     // 86400 = 1 day
    //     setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
        // echo $_COOKIE['user'];
    
    ?>
</div>
<?php endif; ?>
<?php 
}

add_shortcode("devRegister", "createRegister");

