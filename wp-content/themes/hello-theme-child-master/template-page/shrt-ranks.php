<?php function kolRank(){
    ob_start();
    
    ?>
   
       <div class="rank">
            <div class="rank__container">
                <div class="rank__top">
                    <p> Bảng Xếp Hạng Thành Viên </p>
                    <div class="rank__tab d-flex">
                        <!-- <div class="rank__tab1  common-tab rank__tab-item" data-tab="1month">1 tháng</div> -->
                        <div class="rank__tab2  common-tab rank__tab-item" data-tab="all">ALL</div>
                        <div class="rank__tab3  common-tab rank__tab-item" data-tab="kol">KOL</div>
                        <div class="rank__tab3  common-tab rank__tab-item" data-tab="distributor_user">Nhà phân phối</div>
                        <!-- <div class="rank__tab3  common-tab rank__tab-item" data-tab="saleman_user">Saleman</div> -->
                    </div>
                </div>
                <!-- <div class="rank__body rank__tab-content rank__body 1month"> -->
                    <?php 
                        //echo do_shortcode("[rankTab day='1 month ago']");
                       
                        // function get_user_orders_total($user_id) {
                        //     // Use other args to filter more
                        //     $args = array(
                        //         'customer_id' => $user_id
                        //     );
                        //     // call WC API
                        //     $orders = wc_get_orders($args);
                        
                        //     if (empty($orders) || !is_array($orders)) {
                        //         return false;
                        //     }
                        
                        //     // One implementation of how to sum up all the totals
                        //     $total = array_reduce($orders, function ($carry, $order) {
                        //         $carry += (float)$order->get_total();
                        
                        //         return $carry;
                        //     }, 0.0);
                        
                        //     return $total;
                        // }
                        // $users = get_users( array( 
                        //     'fields' => array( 'ID' ),
                        //     "role__not_in"=> 'administrator'
                        // ) );
                        // // echo count($users);
                        // $rank_arr = [];
                        // foreach($users as $user){
                        //     $order_total = get_user_orders_total($user->ID);
                        //     $get_user = get_user_by( 'id', $user->ID ); 
                        //     $user_display_name = $get_user->display_name;
                        //     array_push( $rank_arr, array(
                        //         'user_name'   => $user_display_name,
                        //         'order_total' => $order_total
                        //     ));
                          
                        // }
                        // $price = array_column($rank_arr, 'order_total');
                        // array_multisort($price, SORT_DESC, $rank_arr);
                        // echo "<pre>";
                        // // var_dump( ($user->ID) );
                        // var_dump( ($rank_arr) );
                        // echo "</pre>";
                        // $rank_arr = array_slice($rank_arr, 0, 10, true);
                        // foreach($rank_arr as $key=>$rank_user){
                           ?>
                                <!-- <div class="rank_user d-flex align-items-center mb-2">
                                    <div class="rank_user_avatar">
                                        <?php //if( $key == 0 ): ?>
                                            <img src="https://www.nimo.tv/nms/images/rank01.e7581049902a9996fe6781f54e255589.png" alt="" class="rank_user-icon">
                                        <?php  //elseif ( $key == 1 ): ?>
                                            <img src="https://www.nimo.tv/nms/images/rank02.f2c2fc53cfc33319ff3ab606a07d3e57.png" alt="" class="rank_user-icon">
                                        <?php  //elseif ( $key == 2 ): ?>
                                            <img src="https://www.nimo.tv/nms/images/rank03.06eb169fa37f1c0fe42f3c9cc37a3c27.png" alt="" class="rank_user-icon">
                                        <?php  //else: ?>
                                            <div class="rank_user-icon">0<?php //echo $key+1; ?></div>
                                        <?php  //endif; ?>
                                            
                                    </div>
                                    <div><?php //echo $rank_user['user_name']; ?></div>
                                </div> -->
                           <?php
                        // }
                    ?>
                    <?php 
                        
                    ?>
                <!-- </div> -->
                <div class="rank__body rank__tab-content all">
                    <div class="rank__body_child-tab d-flex">
                        <div class="rank__tab2  common-tab rank__tab-item" data-tab="all-1week">1 tuần</div>
                        <span style="padding:0px 2px">|</span>
                        <div class="rank__tab2  common-tab rank__tab-item" data-tab="all-1month">1 tháng</div>
                        <span style="padding:0px 2px">|</span>
                        <div class="rank__tab2  common-tab rank__tab-item" data-tab="all-3month">3 tháng</div>
                    </div>
                    <!-- <div class="rank__body_child-content all-show">
                        <?php //echo do_shortcode("[rankTab day='12 month ago']"); ?>
                    </div> -->
                    <div class="rank__body_child-content  all-1week">
                        <?php echo do_shortcode("[rankTab day='1 week ago']"); ?>
                    </div>
                    <div class="rank__body_child-content  all-1month">
                        <?php echo do_shortcode("[rankTab day='1 month ago']"); ?>
                    </div>
                    <div class="rank__body_child-content  all-3month">
                        <?php echo do_shortcode("[rankTab day='3 month ago']"); ?>
                    </div>
                </div>
                <div class="rank__body rank__tab-content kol">
                    <div class="rank__body_child-tab d-flex">
                         <div class="rank__tab2  common-tab rank__tab-item" data-tab="kol-1week">1 tuần</div>
                        <span style="padding:0px 2px">|</span>
                        <div class="rank__tab2  common-tab rank__tab-item" data-tab="kol-1month">1 tháng</div>
                        <span style="padding:0px 2px">|</span>
                        <div class="rank__tab2  common-tab rank__tab-item" data-tab="kol-3month">3 tháng</div>
                    </div>
                    <div class="rank__body_child-content  kol-1week" >
                        <?php echo do_shortcode("[rankTabRole day='1 week ago' role_name='kol_user']"); ?>
                    </div>
                    <div class="rank__body_child-content  kol-1month" >
                        <?php echo do_shortcode("[rankTabRole day='1 month ago' role_name='kol_user']"); ?>
                    </div>
                    <div class="rank__body_child-content  kol-3month" >
                        <?php echo do_shortcode("[rankTabRole day='3 month ago' role_name='kol_user']"); ?>
                    </div>
                </div>
                <div class="rank__body rank__tab-content distributor_user">
                    <div class="rank__body_child-tab d-flex">
                        <div class="rank__tab2  common-tab rank__tab-item" data-tab="distributor_user-1week">1 tuần</div>
                        <span style="padding:0px 2px">|</span>
                        <div class="rank__tab2  common-tab rank__tab-item" data-tab="distributor_user-1month">1 tháng</div>
                        <span style="padding:0px 2px">|</span>
                        <div class="rank__tab2  common-tab rank__tab-item" data-tab="distributor_user-3month">3 tháng</div>
                    </div>
                    <div class="rank__body_child-content  distributor_user-1week">
                        <?php echo do_shortcode("[rankTabRole day='1 week ago' role_name='distributor_user']"); ?>
                    </div>
                    <div class="rank__body_child-content  distributor_user-1month">
                        <?php echo do_shortcode("[rankTabRole day='1 month ago' role_name='distributor_user']"); ?>
                    </div>
                    <div class="rank__body_child-content  distributor_user-3month">
                        <?php echo do_shortcode("[rankTabRole day='3 month ago' role_name='distributor_user']"); ?>
                    </div>
                </div>
                <!-- <div class="rank__body rank__tab-content kol">
                    <?php //echo do_shortcode("[rankTabRole day='3 month ago' role_name='kol_user']"); ?>
                </div> -->
                <!-- <div class="rank__body rank__tab-content distributor_user">
                    <?php //echo do_shortcode("[rankTabRole day='3 month ago' role_name='distributor_user']"); ?>
                </div>
                <div class="rank__body rank__tab-content saleman_user">
                    <?php //echo do_shortcode("[rankTabRole day='3 month ago' role_name='saleman_user']"); ?>
                </div> -->
            </div>
       </div>
       <?php 
            // $t = [
            //     'userName'=>'Nguyễn Hương',
            //     [
            //         ['orderID'=>1, 'orderTotal'=> 100],
            //         ['orderID'=>2, 'orderTotal'=> 100],
            //         ['orderID'=>3, 'orderTotal'=> 100],
            //     ]
            // ];
            // echo '<pre>';
            // var_dump($t[0]);
            // echo '</pre>'; 
       ?>
    <?php 
     $result = ob_get_clean(); //cho hết bộ nhớ đệm vào biến $result
    
     return $result; // trả về giá trị dạng json
     die();     
}
add_shortcode("kolRank", "kolRank");