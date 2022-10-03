
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri().'/assets/plugin/xls/jquery.dataTables.min.css'; ?>">
<div class="kol-admin-report">

    <?php 
        $usercount = count_users();
        $result_usercount = $usercount['total_users']; 
        // echo "<pre>";
        // var_dump( $usercount['avail_roles'] );
        // echo "</pre>";
    ?>
    <p class="fw-bold dsh-title">Báo cáo</p>
    <div class="kol-user-manager">
        <p class="kol-subtitle fw-bold">User Manage</p>
        <div class="row g-3">
            <div class="col-lg-2 col-6">
                <div class="user-manager p-3 text-center">
                    <p>Total</p>
                    <p><?= $result_usercount; ?></p>
                </div>  
            </div>
            <?php foreach( $usercount['avail_roles'] as $role => $count ) : global $wp_roles;  
                // echo "<pre>";
                // var_dump( $wp_roles->role_names );
                // echo "</pre>";
                $arr = [];
                foreach ( $wp_roles->role_names as $key => $value ){
                    array_push( $arr,$key );
                }
                if(  in_array (  $role, $arr ) ){
                    $role_name = $wp_roles->roles[$role]['name']; 
                } else{
                    $role_name = 'None';
                }
            ?>
                <div class="col-lg-2 col-6">
                    <div class="user-manager p-3 text-center">
                        <p><?= $role_name; ?></p>
                        <p><?= $count; ?></p>
                    </div> 
                </div>
            <?php endforeach;   ?>
        
        </div>
    </div>
    
    <div class="kol-coupon-manager py-4">
        <p class="fw-bold">User Coupon Manage</p>  
        <div class="row kol-tab d-flex g-3">
            <!-- Giải pháp dùng select gọi ajax -->
            <div class="box-input">
                <span>Chọn danh sách KOL<span class="required">*</span></span>
                <select name="admin_kol_select" id="admin_kol_select">
                    <option value="all">--Chọn</option>
                    <?php 
                        $admin_kol_select = [
                            'kol_user'        =>'Kol/koc',
                            'partner_user'    =>'Nhà cung cấp',
                            'saleman_user'    =>'Saleman',
                            'distributor_user' =>'Nhà phân phối'

                        ];

                        foreach( $admin_kol_select as $key=>$value):
                            ?> <option value="<?php echo $key;?>" ><?php echo $value;?></option><?php
                        endforeach;
                        // echo "<pre>";
                        // var_dump(  $terms );
                        // echo "</pre>";
                    ?>
                </select>
                <input type="hidden" name="url_ajax" value="<?= admin_url('admin-ajax.php');?>">
            </div>
           
            <!-- <div class="col kol-tab-item common-tab" data-tab="salemanTab">
                Saleman  <span></span>
            </div>
            <div class="col kol-tab-item common-tab" data-tab="payTab">
                Thanh toán  <span></span>
            </div>
            <div class="col kol-tab-item common-tab" data-tab="machineTab">
                Gia công  <span></span>
            </div>
            <div class="col kol-tab-item common-tab" data-tab="successTab">
                Hoàn thành <span></span>
            </div>
            <div class="col kol-tab-item common-tab" data-tab="deliveryTab">
                Giao hàng <span></span>
            </div> -->
        </div>
        <div class="kol_tab-content-wrapper">
            <div class="kol-tab-content py-4">
            </div>
        </div>
    </div>
</div>
<?php 
  
?>
<script src="<?php echo get_stylesheet_directory_uri().'/assets/plugin/xls/jquery.dataTables.min.js'; ?>"></script>
<script src="<?php echo get_stylesheet_directory_uri().'/assets/plugin//chart.min.js'; ?>"></script>