<?php 
    $current_user = wp_get_current_user();
    // var_dump($current_user->ID);
    $args = array(
        'post_type' => 'shop_coupon',
        'post_status' => 'publish',
        'order' => 'DESC',
        'orderby' => 'DATE',
        'posts_per_page' => -1 ,
        'meta_key'       => 'wcu_select_coupon_user',
        'meta_value'     => $current_user->ID,
        // 'tax_query' => array(
        //     array(
        //         'taxonomy' => 'project_cat',
        //         'field' => 'term_id',
        //         'terms' => $cat,
        //     )
        // ),
    );
    $report = new WP_Query($args);
    $numcoupons = $report->post_count;
    // var_dump($numcoupons);
    $kol_title_arr = [];
    $clickcount_arr = [];
    ?><div class="cp-wrapper"><?php
    if ( $report->have_posts() ) : while ( $report->have_posts() ) : $report->the_post();
        // $usage = get_post_meta( get_the_ID(), 'usage_count', true );
        // $meta = get_post_meta( get_the_ID() );
        // echo "<pre>";
        // var_dump($meta);
        // echo "</pre>";
        global $wpdb;
        $table_name = $wpdb->prefix . 'wcusage_clicks';
        $id = get_the_id();
        $result2 = $wpdb->get_results( 
            $wpdb->prepare(
                // "SELECT * from wp_my_books WHERE id = %d ",$book_id
                "SELECT * FROM " . $table_name . " WHERE couponid = %d",$id
            )
        );
        $clickcount = count($result2);
        // $kol_title = get_the_title();
        // array_push($kol_title_arr ,  $kol_title);
        // array_push($clickcount_arr , $clickcount );
        ?>  
           
                <div class="dsh-click">
                    <p>Mã : <?php the_title();?></p>
                    <p>Số lượt click : <?php echo $clickcount;?></p>
                </div>
           
        <?php
    endwhile; wp_reset_postdata(); else:
        ?></div><?php
        ?>
            <p>Chưa có dữ liệu</p>
        <?php
        
    endif;
        // echo "<pre>";
        // var_dump($kol_title_arr, $clickcount_arr);
        // echo "</pre>";
?>
 <!-- <canvas id="bar-chart" width="800" height="450"></canvas>   -->
 <script>
    // (function ($) {
    //     $(document).ready(function () {
    //             kol_title_arr = <?php //echo json_encode($kol_title_arr); ?>;
    //             clickcount_arr = <?php //echo json_encode($clickcount_arr); ?>;
    //             console.log(kol_title_arr,clickcount_arr );
    //             new Chart(document.getElementById("bar-chart"), {
    //                 type: 'bar',
    //                 data: {
    //                     labels: kol_title_arr,
    //                     datasets: [
    //                         {
    //                         label: "Coupon",
    //                         backgroundColor: [  'rgba(255, 99, 132, 0.2)',
    //                                             'rgba(255, 159, 64, 0.2)',
    //                                             'rgba(255, 205, 86, 0.2)',
    //                                             'rgba(75, 192, 192, 0.2)',
    //                                             'rgba(54, 162, 235, 0.2)',
    //                                             'rgba(153, 102, 255, 0.2)',
    //                                             'rgba(201, 203, 207, 0.2)'],
    //                         data: clickcount_arr
    //                         }
    //                     ]
    //                 },
    //                 options: {
    //                 legend: { display: false },
    //                 title: {
    //                     display: true,
    //                     text: 'Predicted world population (millions) in 2050'
    //                 }
    //             }
    //         });
    //     })
    // })(jQuery);
</script>
<!-- <script src="<?php //echo get_stylesheet_directory_uri().'/assets/plugin//chart.min.js'; ?>"></script> -->