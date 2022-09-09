<?php function kolRank(){
    ob_start();
    
    ?>
       <div class="rank">
            <div class="rank__container">
                <div class="rank__top">
                    <p> Bảng Xếp Hạng Quà Tặng Của Streamer Mới </p>
                    <div class="rank__tab d-flex">
                        <div class="rank__tab1 rank__tab-item">1 tuần trước </div>
                        <div class="rank__tab2 rank__tab-item">1 tháng trước</div>
                    </div>
                </div>
                <div class="rank__body">
                    <?php 
                        function get_user_orders_total($user_id) {
                            // Use other args to filter more
                            $args = array(
                                'customer_id' => $user_id
                            );
                            // call WC API
                            $orders = wc_get_orders($args);
                        
                            if (empty($orders) || !is_array($orders)) {
                                return false;
                            }
                        
                            // One implementation of how to sum up all the totals
                            $total = array_reduce($orders, function ($carry, $order) {
                                $carry += (float)$order->get_total();
                        
                                return $carry;
                            }, 0.0);
                        
                            return $total;
                        }
                        $users = get_users( array( 
                            'fields' => array( 'ID' ),
                            "role__not_in"=> 'administrator'
                        ) );
                        echo count($users);
                        foreach($users as $user){
                            echo "<pre>";
                            var_dump( ($user->ID) );
                            var_dump( get_user_orders_total($user->ID) );
                            echo "</pre>";
                                
                        }
                       
                       
                    ?>
                    <p>This is content rank</p>
                </div>
            </div>
       </div>
    <?php 
     $result = ob_get_clean(); //cho hết bộ nhớ đệm vào biến $result
    
     return $result; // trả về giá trị dạng json
     die();     
}
add_shortcode("kolRank", "kolRank");