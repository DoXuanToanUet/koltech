<?php
// /*
// * Template Name: Order Page Template
// */
get_header();
defined( 'ABSPATH' ) || exit;

global $woocommerce, $user_id;  

if (!class_exists('WooCommerce') || !get_current_user_id()) {
    return;
};

$user_id = get_current_user_id();

//$customer = wp_get_current_user();
$posts_per_page = 2; 
// Get all customer orders
$customer__all_orders = get_posts(apply_filters('woocommerce_my_account_my_orders_query', array(
    'numberposts' => -1,
    'meta_key' => '_customer_user',
    'orderby' => 'date',
    'order' => 'DESC',
    'meta_value' => $user_id ,
    'post_type' => wc_get_order_types(),
    'post_status' => array_keys(wc_get_order_statuses()), 'post_status' => array('wc-on-hold'),
)));
$paged = isset($_REQUEST['order_page']) ? $_REQUEST['order_page'] : 1;
$total_records = count($customer__all_orders);
$total_pages = ceil($total_records / $posts_per_page);


$customer_orders = get_posts(array(
    'meta_key' => '_customer_user',
    'order' => 'DESC',
    'meta_value' => $user_id ,
    'post_type' => wc_get_order_types(),
    'posts_per_page' => $posts_per_page,
    'paged' => $paged,
    'post_status' => array_keys(wc_get_order_statuses()), 'post_status' => array('wc-on-hold'),
));
?>

<?php if (!empty($customer_orders)) : ?>
    <?php 
        // echo "<pre>";
        // var_dump($customer_orders);
        // echo "</pre>";
       
        foreach ($customer_orders as $customer_order) {
            $order_id =  $customer_order->ID;
            $order = wc_get_order( $order_id );

            $order_data = $order->get_data(); // The Order data
            $customer_order = $customer_order->post_status;
            switch ($customer_order) {
                case "wc-on-hold":
                  $customer_order = "Tạm giữ";
                  break;
                // case "blue":
                //   echo "Your favorite color is blue!";
                //   break;
                // case "green":
                //   echo "Your favorite color is green!";
                //   break;
                default:
                  echo "Your favorite color is neither red, blue, nor green!";
              }
            ?>
                <p>Đơn hàng: #<?php echo $customer_order->ID; ?></p>
                <p>Status: <?php  echo $customer_order; ?></p>
                <p>Tổng tiền: #<?php echo $order_data['total']; ?></p>
            <?php
        }
    ?>
<?php endif;?>
<div class="pagination">
    <?php
        $args = array(
            'base' => '%_%',
            'format' => '?order_page=%#%',
            'total' => $total_pages,
            'current' => $paged,
            'show_all' => False,
            'end_size' => 5,
            'mid_size' => 5,
            'prev_next' => True,
            'prev_text' => __('&laquo; Previous'),
            'next_text' => __('Next &raquo;'),
            'type' => 'plain',
            'add_args' => False,
            'add_fragment' => ''
        );
        echo paginate_links($args);
    ?>
</div>
<?php if (!empty($customer_orders)) : ?>

    <table class="woocommerce-orders-table woocommerce-MyAccount-orders shop_table shop_table_responsive my_account_orders account-orders-table">
        <thead>
            <tr>
                <?php foreach ( wc_get_account_orders_columns() as $column_id => $column_name ) : ?>
                    <th class="woocommerce-orders-table__header woocommerce-orders-table__header-<?php echo esc_attr( $column_id ); ?>"><span class="nobr"><?php echo esc_html( $column_name ); ?></span></th>
                <?php endforeach; ?>
            </tr>
        </thead>

        <tbody>
            <?php
            foreach ( $customer_orders as $customer_order ) {
                $order      = wc_get_order( $customer_order ); 
                $item_count = $order->get_item_count() - $order->get_item_count_refunded();
                ?>
                <tr class="woocommerce-orders-table__row woocommerce-orders-table__row--status-<?php echo esc_attr( $order->get_status() ); ?> order">
                    <?php foreach ( wc_get_account_orders_columns() as $column_id => $column_name ) : ?>
                        <td class="woocommerce-orders-table__cell woocommerce-orders-table__cell-<?php echo esc_attr( $column_id ); ?>" data-title="<?php echo esc_attr( $column_name ); ?>">
                            <?php if ( has_action( 'woocommerce_my_account_my_orders_column_' . $column_id ) ) : ?>
                                <?php do_action( 'woocommerce_my_account_my_orders_column_' . $column_id, $order ); ?>

                            <?php elseif ( 'order-number' === $column_id ) : ?>
                                <a href="<?php echo esc_url( $order->get_view_order_url() ); ?>">
                                    <?php echo esc_html( _x( '#', 'hash before order number', 'woocommerce' ) . $order->get_order_number() ); ?>
                                </a>

                            <?php elseif ( 'order-date' === $column_id ) : ?>
                                <time datetime="<?php echo esc_attr( $order->get_date_created()->date( 'c' ) ); ?>"><?php echo esc_html( wc_format_datetime( $order->get_date_created() ) ); ?></time>

                            <?php elseif ( 'order-status' === $column_id ) : ?>
                                <?php echo esc_html( wc_get_order_status_name( $order->get_status() ) ); ?>

                            <?php elseif ( 'order-total' === $column_id ) : ?>
                                <?php
                                /* translators: 1: formatted order total 2: total order items */
                                echo wp_kses_post( sprintf( _n( '%1$s for %2$s item', '%1$s for %2$s items', $item_count, 'woocommerce' ), $order->get_formatted_order_total(), $item_count ) );
                                ?>

                            <?php elseif ( 'order-actions' === $column_id ) : ?>
                                <?php
                                $actions = wc_get_account_orders_actions( $order );

                                if ( ! empty( $actions ) ) {
                                    foreach ( $actions as $key => $action ) { // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
                                        echo '<a href="' . esc_url( $action['url'] ) . '" class="woocommerce-button button ' . sanitize_html_class( $key ) . '">' . esc_html( $action['name'] ) . '</a>';
                                    }
                                }
                                ?>
                            <?php endif; ?>
                        </td>
                    <?php endforeach; ?>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
    <div class="pagination">
    <?php
        $args = array(
            'base' => '%_%',
            'format' => '?order_page=%#%',
            'total' => $total_pages,
            'current' => $paged,
            'show_all' => False,
            'end_size' => 5,
            'mid_size' => 5,
            'prev_next' => True,
            'prev_text' => __('&laquo; Previous'),
            'next_text' => __('Next &raquo;'),
            'type' => 'plain',
            'add_args' => False,
            'add_fragment' => ''
        );
        echo paginate_links($args);
    ?>
</div>
<?php else : ?>
    <div class="woocommerce-message woocommerce-message--info woocommerce-Message woocommerce-Message--info woocommerce-info">
        <a class="woocommerce-Button button" href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>"><?php esc_html_e( 'Browse products', 'woocommerce' ); ?></a>
        <?php esc_html_e( 'No order has been made yet.', 'woocommerce' ); ?>
    </div>
<?php endif; ?>
<input type="hidden" name="url_ajax" value="<?= admin_url('admin-ajax.php');?>">
<!-- Get last order woocommerce -->
<?php 
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
            'post_status' => array('wc-pending', 'wc-processing', 'wc-completed'),
            'fields' => 'ids',
        ));
       
        //
        // $user_orders = array();
        // if ( !empty( $customer_orders ) ) {
        //     $latest_order_id = $customer_orders[0]->ID;
        //     $orderObj = wc_get_order($latest_order_id);
        //     $product = [];
        //     foreach ($orderObj->get_items() as $item_key => $item ):
        //         $item = ($orderObj->get_items())[0];
        //         $item_name    = $item->get_name(); 
        //         array_push( $product,array(
        //             'pr'   =>  $item_name ,
        //         ));
        //     endforeach;
        //     array_push($user_orders, array(
        //         "orderID" => $orderObj->get_id(),
        //         "orderDate" => $orderObj->get_date_created()->date_i18n('Y-m-d h:i:s'),
        //         'product' => $product
        //     ));
        // }
        // // foreach ($customer_orders as $orderID) {
        // //     $orderObj = wc_get_order($orderID);
        // //     // $orderObj_data = $order->get_data(); // The Order data
        // //     $product = [];
        // //     // foreach ($orderObj->get_items() as $item_key => $item ):
        // //         $item = ($orderObj->get_items())[0];
        // //         $item_name    = $item->get_name(); 
        // //         array_push( $product,array(
        // //             'pr'   =>  $item_name ,
        // //         ));
        // //     // endforeach;
        // //     array_push($user_orders, array(
        // //         "orderID" => $orderObj->get_id(),
        // //         "orderDate" => $orderObj->get_date_created()->date_i18n('Y-m-d h:i:s'),
        // //         'product' => $product
        // //     ));
        // // }
        
       
        // array_push( $user_arr,array(
        //     'userName'   => $user_display_name,
        //      $user_orders
        // ));
       
        // echo '<pre>';
        // var_dump($user_arr);
        // echo '</pre>'; 
    }
    // $last_order_id = wc_get_orders(array('limit' => 3, 'return' => 'ids')); // Get last Order ID (array)
    // $order_last = wc_get_order($last_order_id[0]);
    // echo '<pre>';
    // var_dump($last_order_id);
    // echo '</pre>'; 
?>
<div class="container">
    <div class="alert alert-primary" role="alert" id="woo-push">
        <?php 
             
        ?>
        <!-- A simple primary alert—check it out! -->
    </div>
</div>
<style>
    #woo-push{
        display:none;
    }
</style>

<?php get_footer(); ?>
<script type="text/javascript"> 
    (function($) {
        $(document).ready(function() {
            var ajax_url = $("input[name='url_ajax']").val();
            var ajax_call = function() {
                //your jQuery ajax code
                $.ajax({
                    type: "post",
                    dataType: "json",
                    async: true,
                    url: ajax_url,
                    data: {
                        action:'WlastOrder',                      
                    },
                    beforeSend: function () {
                    },
                    success: function (response) {
                        console.log(response);
                        product_name = response.data.showdata;
                        if(response.success == true ){
                            $("#woo-push").html(`
                                <img style="width:50px;height:50px" src="${product_name[0][0][0].image}" />
                                ${product_name[0]['userName']} vừa mua ${product_name[0][0][0].product}
                            `)
                            $('#woo-push').delay(1000).fadeIn().delay(4000).fadeOut(); 
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        //Làm gì đó khi có lỗi xảy ra
                        console.log('The following error occured: ' + textStatus, errorThrown);
                    }
                });
            };
            var interval = 1000*60*1; // where X is your every X minutes
            setInterval(ajax_call, interval);
        })
    })(jQuery);
</script>


