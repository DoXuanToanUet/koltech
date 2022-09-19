<?php
/**
 * Template Name: Login
 */
get_header(); ?>
<style>
    /* .kol-login{
        background-image: url(<?php //echo get_stylesheet_directory_uri(); ?>/assets/img/logink.jpg); 
    } */
</style>
<div class="kol-login">
    <div class="container">
        <?php echo do_shortcode("[woocommerce_my_account]"); ?>
    </div>
</div>

<?php get_footer(); ?>