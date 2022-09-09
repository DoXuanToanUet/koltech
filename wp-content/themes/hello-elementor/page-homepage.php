<?php get_header();?>
<link rel="stylesheet" href="<?php echo get_template_directory_uri().'/assets/css/home.css';?>">
<link rel="stylesheet" href="<?php echo get_template_directory_uri().'/assets/plugins/wowjs/animate.min.css';?>">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600&display=swap" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<div class="homepage">
    <style>
        .intro-section{
            background: url(<?php the_field('intro_bkg'); ?>) no-repeat bottom;
            background-size: cover;
            height: 100%;
            min-height: 790px;
        }
        .want-section {
            background: url(<?php the_field('want_bkg'); ?>) no-repeat bottom;
            background-size: cover;
            height: 613px;
        }
        .banner-section {
            background: url(<?php the_field('banner_bkg'); ?>) no-repeat top;
            background-size: cover;
            height: 373px;
            position: relative;
        }
        .detect-section{
            background: url(<?php the_field('detect_bkg'); ?>) no-repeat 50%;
            -webkit-background-size: cover;
            background-size: cover;
            padding-bottom: 55px;
        }
    </style>
    <div class="intro-section">
        <div class="h-container h-flex h-gap h-flex-center intro-wrapper">
            <div class="intro-left h-flex1 " >
                <div class="intro-title wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s">
                    <h1 class="h-heading"><?php the_field('intro_title'); ?></h1>
                </div>
                <div class="intro-subtitle h-subtitle  wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.4s">
                    <p><?php the_field('intro_subtitle'); ?> </p>
                </div>
                <div class="intro-button" href="">
                    <span>tìm hiểu thêm</span>
                </div>
            </div>  
            <div class="intro-right h-flex1 wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.6s"> 
                <img src="<?php the_field('intro_img'); ?>" alt="">
            </div>
        </div>
    </div>
    <div class="detect-section">
        <div class="h-container common-section">
            <h5 class="h-heading h-text-center"><?php the_field('detect_title'); ?></h5>
            <div class="detect-wrapper h-flex h-gap ">
                <div class="detect-left h-flex-col h-flex1">
                    <div class="detect-block h-flex h-flex-col">
                        <?php if( have_rows('detect_left')) : while ( have_rows('detect_left') ) : the_row();?>
                            <div class="detect-box detect-box-left wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s">
                                <div class="detect-title"><?php the_sub_field('text'); ?></div>
                                <div class="detect-line detect-line-left"></div>
                            </div>
                        <?php endwhile; endif; ?>
                    </div>

                </div>
                <div class="detect-middle h-flex1 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.6s">
                    <?php if( have_rows('detect_middle')) : while ( have_rows('detect_middle') ) : the_row();?>
                        <img src="<?php the_sub_field('bkg'); ?>" alt="" >
                        <img src="<?php the_sub_field('img'); ?>" alt="" class="detect-img">
                    <?php endwhile; endif; ?>
                    <!-- <img src="<?php //echo get_template_directory_uri().'/assets/images/img_4.png';?>" alt=""> -->
                    <!-- <img src="https://viralworks.com/assets/img/animation-data/home-become-influencer/img_2.png" alt="" class="detect-img"> -->
                    <!-- <img src="https://viralworks.com/assets/img/animation-data/home-become-influencer/img_3.png" alt="" class="detect-img"> -->
                </div>
                <div class="detect-right h-flex1">
                    <div class="detect-block h-flex h-flex-col">
                        <?php if( have_rows('detect_right')) : while ( have_rows('detect_right') ) : the_row();?>
                            <div class="detect-box detect-box-right wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.8s">
                                <div class="detect-title"><?php the_sub_field('text'); ?></div>
                                <div class="detect-line detect-line-right"></div>
                            </div>
                        <?php endwhile; endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="want-section ">
        <div class="h-container common-section">
            <h3 class="h-heading h-text-center wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s" style="color:#fff"><?php the_field('want_title');?></h3>
            <div class="want-wrapper h-flex h-gap ">
                <div style="position: absolute;width: 75%;height: 450px; top: 40px; transform: translate(13%)" class="want-border">
                    <div class="topbottom want-line"></div>
                    <div class="leftright want-line"></div>
                    <div class="middle want-line"></div>
                </div>
                <?php if( have_rows('want_rp')) : $i=0; $k=0; while ( have_rows('want_rp') ) : the_row();?>
                    <div class="item h-box--<?php echo $i;?> h-box--bullet wow fadeInUp" data-wow-duration="1s" data-wow-delay="<?php echo $k;?>s">
                        <img src="<?php the_sub_field('img');?>">
                        <p class="want-title"> <?php the_sub_field('txt'); ?></p>
                    </div>
                <?php $i++; $k=$k+0.2;  endwhile;  endif; ?>
            </div>
        </div>
    </div>
    <div class="banner-section">
        <div class="h-container common-section">
            <h3 class="h-heading h-text-center h-banner--title wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s" ><?php the_field('banner_txt'); ?></h3>
        </div>
    </div>
    <div class="become-kol--section">
        <div class="h-container  common-section">
            <div class="kol-wrapper h-flex h-flex-center">
                <div class="become-kol-left wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s">
                    <img src="<?php the_field('kol_img'); ?>" alt="">
                </div>
                <div class="become-kol-right wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.4s">
                    <h3 class="h-heading h-text-center" style="color:#fff"><?php the_field('kol_title'); ?></h3>
                    <div class="contact h-flex h-gap">
                        <a href="" class="intro-btn2">Liên hệ ngay</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .intro-mb{
        background: url(https://viralworks.com/assets/img/element/home_shape_1_m.svg) no-repeat 50%;
        background-size: 90%;
    }
    .intromb-bottom{
        height: 263px;
        background: url(https://viralworks.com/assets/img/bg/home_bg_1_m.svg) no-repeat bottom;
    }
</style>
<div class="homepage-mb">
        <div class="intro-mb">
            <div class="h-container-mb">
                <div class="intromb-img">
                    <img src="https://viralworks.com/assets/img/animation-data/home-become-influencer/img_3.png" alt="" >
                </div>
            </div>
           
        </div>
        <div class="intromb-bottom h-flex h-flex-center">
            <h1 class="h-heading wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s" style="color:#fff"><?php the_field('intro_title'); ?></h1>
        </div>
        <div class="detectmb common-section">
            <div class="h-container-mb">
                <h3 class="h-heading h-text-center wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s" style="color:#531f8f"><?php the_field('want_title');?></h3>
                <img src="https://viralworks.com/assets/img/animation-data/home-become-influencer/img_4.png" alt="" class="detectmb-img">
                <div class="detectmb-box">
                    <?php if( have_rows('detect_left')) : while ( have_rows('detect_left') ) : the_row();?>
                        <div class="detect-boxmb wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s">
                            <div class="detect-title"><?php the_sub_field('text'); ?></div>
                        </div>
                    <?php endwhile; endif; ?>
                    <?php if( have_rows('detect_right')) : while ( have_rows('detect_right') ) : the_row();?>
                        <div class="detect-boxmb wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.8s">
                            <div class="detect-title"><?php the_sub_field('text'); ?></div>
                        </div>
                    <?php endwhile; endif; ?>
                </div>
            </div>
        </div>
        <div class="want-section wantmb-section">
            <div class="h-container-mb common-section">
                <h3 class="h-heading h-text-center wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s" style="color:#fff"><?php the_field('want_title');?></h3>
                <div class="want-wrappermb h-flex h-gap h-flex-col">
                    <?php if( have_rows('want_rp')) : $i=0; $k=0; while ( have_rows('want_rp') ) : the_row();?>
                        <div class="item  h-flex h-gap h-flex-center wow fadeInUp" data-wow-duration="1s" data-wow-delay="<?php echo $k;?>s">
                            <img src="<?php the_sub_field('img');?>">
                            <p class="want-title"> <?php the_sub_field('txt'); ?></p>
                        </div>
                    <?php $i++; $k=$k+0.2;  endwhile;  endif; ?>
                </div>
            </div>
        </div>
        <div class="banner-section">
            <div class="h-container-mb common-section">
                <h3 class="h-heading h-text-center h-banner--title wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s" ><?php the_field('banner_txt'); ?></h3>
            </div>
        </div>
        <div class="become-kol--section kol-mb">
            <div class="h-container-mb  common-section">
                <div class="kol-wrapper h-flex h-flex-center">
                    <div class="become-kol-left wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s">
                        <img src="<?php the_field('kol_img'); ?>" alt="">
                    </div>
                    <div class="become-kol-right wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.4s">
                        <h3 class="h-heading h-text-center" style="color:#fff"><?php the_field('kol_title'); ?></h3>
                        <div class="contact h-flex h-gap">
                            <a href="" class="intro-btn2">Liên hệ ngay</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
<script src="<?php echo get_template_directory_uri().'/assets/plugins/wowjs/wow.min.js';?>"></script>
<script>
     new WOW().init();
</script>
<?php get_footer();?>