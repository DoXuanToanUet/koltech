<?php function rankTab($attr)
{
    extract( shortcode_atts(
        [
            'day' => ''
        ], $attr
    ));
    $users = get_users( array( 
        'fields' => array( 'ID' ),
        "role__not_in"=> 'administrator'
    ) );
    $rank_arr = [];
    $user_arr = [];
    foreach($users as $user){
        // $order_total = get_user_orders_total($user->ID);
        $get_user = get_user_by( 'id', $user->ID ); 
        $user_display_name = $get_user->display_name;
        
        // $customer = wp_get_current_user(); // do this when user is logged in
        $customer_orders = get_posts(array(
            'numberposts' => -1,
            'meta_key' => '_customer_user',
            'orderby' => 'date',
            'order' => 'DESC',
            'meta_value' => $user->ID,
            'post_type' => wc_get_order_types(),
            'post_status' => array_keys(wc_get_order_statuses()),'post_status' => array('wc-completed'), 
            'fields' => 'ids',
            'date_query' => array(
                array(
                    'after' => $day
                )
            )
        ));
        //
        $user_orders = array();
        foreach ($customer_orders as $orderID) {
            $orderObj = wc_get_order($orderID);
            // echo '<pre>';
            // var_dump($orderObj->get_total());
            // echo '</pre>'; 
            
            array_push($user_orders, array(
                "orderID" => $orderObj->get_id(),
                "orderTotal" => $orderObj->get_total(),
                "orderDate" => $orderObj->get_date_created()->date_i18n('Y-m-d h:i:s'),
            ));
        }
        // array_push( $user_orders,array(
        //     'userName'   => $user_display_name,
        // ) );
       
        array_push( $user_arr,array(
            'userName'   => $user_display_name,
             $user_orders
        ));
       
    }
    $rank_user_day = [];
    foreach( $user_arr as $order_value ){
        // echo '<pre>';
        // var_dump($order_value);
        // echo '</pre>'; 
        // echo "break";
        $order_sum = 0;
        foreach( $order_value[0] as $value){
            // echo $value;
            $order_sum += (float)$value['orderTotal'];
        }
        // echo  $order_sum;
        array_push( $rank_user_day,array(
            'userName'   => $order_value['userName'],
            'orderTotal' => $order_sum
        ));
    }
    $user_sort = array_column($rank_user_day, 'orderTotal');
    array_multisort($user_sort, SORT_DESC, $rank_user_day);
    // echo '<pre>';
    // var_dump($rank_user_day);
    // echo '</pre>';
    $rank_arr = array_slice($rank_user_day, 0, 10, true);
    foreach($rank_arr as $key=>$rank_user){
        ?>
            <div class="rank_user d-flex align-items-center mb-2">
                <div class="rank_user_avatar">
                    <?php if( $key == 0 ): ?>
                        <img src="https://www.nimo.tv/nms/images/rank01.e7581049902a9996fe6781f54e255589.png" alt="" class="rank_user-icon">
                    <?php  elseif ( $key == 1 ): ?>
                        <img src="https://www.nimo.tv/nms/images/rank02.f2c2fc53cfc33319ff3ab606a07d3e57.png" alt="" class="rank_user-icon">
                    <?php  elseif ( $key == 2 ): ?>
                        <img src="https://www.nimo.tv/nms/images/rank03.06eb169fa37f1c0fe42f3c9cc37a3c27.png" alt="" class="rank_user-icon">
                    <?php  else: ?>
                        <div class="rank_user-icon">0<?php echo $key+1; ?></div>
                    <?php  endif; ?>
                        
                </div>
                <div><?php echo $rank_user['userName']; ?></div>
            </div>
       <?php
    }
}

add_shortcode("rankTab", "rankTab");

?>
