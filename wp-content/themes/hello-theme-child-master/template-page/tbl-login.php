<?php
/**
 * Template Name: Login
 */
get_header(); ?>

<div class="kol-login">
    <div class="container">
        <?php echo do_shortcode("[woocommerce_my_account]"); ?>
    </div>
</div>

<?php get_footer(); ?>