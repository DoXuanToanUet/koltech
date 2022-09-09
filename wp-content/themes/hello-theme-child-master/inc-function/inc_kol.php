<?php 
add_action('wp_ajax_kol_select', 'kol_select');
add_action('wp_ajax_nopriv_kol_select', 'kol_select');

function kol_select(){
    $err = '';
    $success = '';
    $kol_select = isset($_POST['kol_select']) ? $_POST['kol_select'] : '';
    $current_user = wp_get_current_user();
    update_field('koc_select', $_POST['kol_select'],'user_' . $current_user->ID);

            
    $success = 'Cập nhập thành công';
    wp_send_json_success(array(
        "message"=>"success",
        "showdata"=> $success,
        'class'=>'success'
    ));   
    die();     
       
}


// Ajax about report all select user dashboard 
add_action('wp_ajax_admin_kol_select', 'admin_kol_select');
// add_action('wp_ajax_nopriv_kol_select', 'kol_select');

function admin_kol_select(){
    // $err = '';
    // $success = '';
    // $kol_select = isset($_POST['kol_select']) ? $_POST['kol_select'] : '';
    // $current_user = wp_get_current_user();
    // update_field('koc_select', $_POST['kol_select'],'user_' . $current_user->ID);

            
    // $success = 'Cập nhập thành công';
    // wp_send_json_success(array(
    //     "message"=>"success",
    //     "showdata"=> $success,
    //     'class'=>'success'
    // ));   
    // die();     
       
}

add_action('wp_ajax_admin_kol_dashboard', 'admin_kol_dashboard');

function admin_kol_dashboard(){
    $err = '';
    $success = '';
    $choose_kol = isset($_POST['choose_kol']) ? $_POST['choose_kol'] : '';
    // $current_user = wp_get_current_user();
    // update_field('koc_select', $_POST['kol_select'],'user_' . $current_user->ID);

            
    // $success = 'Cập nhập thành công';
    ob_start();
    $args_kol = array(
        'role'    =>  $choose_kol,
        'orderby' => 'user_nicename',
        'order'   => 'ASC'
    );
    $users_kol = get_users( $args_kol );

    ?>
        <table id="table_kol_tab" class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Coupon</th>
                    <th scope="col">Lượt click</th>
                    <th scope="col">Lượt chuyển đổi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i=1; 
                        $report_kol_click = []; 
                        foreach( $users_kol as $key=>$value ): 
                        // echo "<pre>";
                        // var_dump( $value);
                        // echo "</pre>";
                        $args_kol_coupon = array(
                            'post_type' => 'shop_coupon',
                            'post_status' => 'publish',
                            'order' => 'DESC',
                            'orderby' => 'DATE',
                            'posts_per_page' => -1 ,
                            'meta_key'       => 'wcu_select_coupon_user',
                            'meta_value'     => $value->ID,
                        );
                        $report_kol_coupon = new WP_Query($args_kol_coupon);
                        $report_kol_title =  $value->user_nicename;
                        // $thepageurl = wcusage_get_coupon_shortcode_page(1);
                ?>
                    <tr>
                        <td><?= $i;?></td>
                        <td>
                            <?php if ( $report_kol_coupon->have_posts() ) : while ( $report_kol_coupon->have_posts() ) :$report_kol_coupon->the_post(); ?>
                                <a href="<?php echo home_url().'/coupon/?couponid='.get_the_title(); ?>" target="_blank">
                                    <?php echo $value->user_nicename; ?></td>
                                </a>
                            <?php endwhile; wp_reset_postdata();  endif; ?>
                        <td>
                            <?php 
                                $kol_click_count= 0;
                                if ( $report_kol_coupon->have_posts() ) : while ( $report_kol_coupon->have_posts() ) :$report_kol_coupon->the_post();
                                global $wpdb;
                                $table_name = $wpdb->prefix . 'wcusage_clicks';
                                $id = get_the_id();
                                $date1 = date("Y-m-d", strtotime('-30 days'));
                                $date2 = date("Y-m-d", strtotime('+1 days'));
                                // echo $date1;
                                // echo "\n";
                                // echo $date2;
                                $result2 = $wpdb->get_results( 
                                    $wpdb->prepare(
                                        // "SELECT * from wp_my_books WHERE id = %d ",$book_id
                                        "SELECT * FROM " . $table_name . " WHERE date > '$date1' AND date < '$date2' AND couponid = %d",$id
                                    )
                                );
                                $clickcount = count($result2);
                                $getconversions = $wpdb->get_results( "SELECT * FROM " . $table_name . " WHERE couponid = " . $id . " AND converted = 1 ORDER BY id ASC" );
                                $usage = count($getconversions);
                                // echo "<pre>";
                                // var_dump($getconversions);
                                // echo "</pre>";
                                // array_push( $report_kol_click, $clickcount);
                                // var_dump($clickcount);
                                ?>
                                    <div >
                                        <span><?php the_title();?></span>
                                        <!-- <span>- <?php //echo $clickcount;?></span> -->
                                    </div>
                                <?php
                                $kol_click_count = $kol_click_count+ $clickcount;
                                endwhile; wp_reset_postdata();  endif;
                                // echo $kol_click_count;
                                if( $kol_click_count!=0 ){
                                    array_push( $report_kol_click, array('user'=>$report_kol_title ,'click' => $kol_click_count));
                                }
                                
                            ?>
                        </td>
                        <td><?php echo $kol_click_count; ?></td>
                        <td><?php echo $usage; ?></td>
                    
                    </tr>
                    
                <?php $i++; endforeach; 
                    // echo "<pre>";var_dump($report_kol_click); echo "</pre>";
                ?>   
            </tbody>
        </table>
        <div class="kol-chart">
            <p>Chart KOL</p>
            <canvas id="bar-chart" width="800" height="450"></canvas>
        </div>

        <script>
            (function ($) {
                $(document).ready(function () {
                        $("#table_kol_tab").DataTable();
                        function random_bg_color() {
                            var x = Math.floor(Math.random() * 256);
                            var y = Math.floor(Math.random() * 256);
                            var z = Math.floor(Math.random() * 256);
                            var bgColor = `rgba(${x},${y},${z},0.9)`;
                            return bgColor;
                        }
                    
                        report_kol_click =<?php echo json_encode($report_kol_click); ?>;
                        console.log(report_kol_click);
                        color_arr = [];
                        length_kol = report_kol_click.length;
                        for (let index = 0; index < length_kol; index++) {
                            color_arr.push(random_bg_color());
                        }
                        console.log(color_arr);
                        report_kol_arr = [];
                        user_arr = [];
                        click_arr = [];
                        report_kol_click.forEach(element => {
                            user_arr.push(element.user) 
                            click_arr.push(element.click) 
                        });
                        new Chart(document.getElementById("bar-chart"), {
                        type: 'bar',
                        data: {
                        labels: user_arr,
                        datasets: [
                            {
                            label: "Coupon User Chart",
                            backgroundColor: color_arr,
                            data: click_arr
                            }
                        ]
                        },
                        options: {
                        legend: { display: false },
                        title: {
                            display: true,
                            text: 'Predicted world population (millions) in 2050'
                        }
                        }
                    });
                })
            })(jQuery);
        </script>
    <?php

    $result = ob_get_clean(); //cho hết bộ nhớ đệm vào biến $result
    
    wp_send_json_success($result); // trả về giá trị dạng json
    die();     
       
}
