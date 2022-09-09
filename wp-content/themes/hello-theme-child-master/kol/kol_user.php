<?php 
    $kol_select = get_field_object( 'koc_select','user_'. $current_user->ID );
    if( $kol_select == true ){
        $kol_select = $kol_select;
    }else{
        $kol_select = get_field_object( 'koc_select');
    }
    $kol_select_value = $kol_select['value'];
    $kol_select_label = $kol_select['choices'];
    $field = get_field_object('koc_select', 'user_19');
    // echo "<pre>";
    // var_dump($kol_select);
    // echo "</pre>";
    // if (isset($_POST['updateInforUser'])) {
    // 	// update_row('koc_select',$_POST['userFirstName'] , 'user_' . $current_user->ID);
    // 	update_field('koc_select', $_POST['kol_select'],'user_' . $current_user->ID);
    // 	echo '<script language="javascript">';
    // 	echo '$(".alert").html("Cập nhập thành công ")';
    // 	echo '</script>';
    // }
    ?>
    
    <form action="" id="formChangeProfile" method="post">
        <h5 class="account_kol_title">Thông tin về tài khoản</h5>
        <div class="form-info">
            <div class="box-input">
                <span>Chọn Kol/koc<span class="required">*</span></span>
                <select name="kol_select" id="kol_select">
                    <option value="all">Lượng follow </option>
                    <?php 
                    
                        foreach( $kol_select_label as $key=>$value):
                            ?> <option value="<?php echo $key;?>" <?php if( $kol_select_value == $value ) echo 'selected';?> ><?php echo $value;?></option><?php
                        endforeach;
                        // echo "<pre>";
                        // var_dump(  $terms );
                        // echo "</pre>";
                    ?>
                </select>
                
            </div>
            
        </div>
        <div class="kol_alert alert alert-success my-2" role="alert">
            
        </div>
       <p></p>
        <div class="btn-save">
            <button type="submit" name="updateInforUser" class="btn btn-primary btn-submit"> Save</button>
        </div>
        <input type="hidden" name="url_ajax" value="<?= admin_url('admin-ajax.php');?>">
    </form>
    
<?php