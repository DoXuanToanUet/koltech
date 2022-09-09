<?php if ( has_nav_menu( 'my_account' ) ) { ?>

<?php
  echo wp_nav_menu(array(
    'theme_location' => 'my_account',
    'container' => false,
    'items_wrap' => '%3$s',
    'depth' => 0,
    'walker' => new FlatsomeNavSidebar
  ));
  
?>
<?php } else if(!get_theme_mod('wc_account_links', 1)) { ?>
  <li>Define your My Account dropdown menu in <b>Appearance > Menus</b> or enable default WooCommerce Account Endpoints.</li>
<?php } ?>

<?php if(function_exists('wc_get_account_menu_items') && get_theme_mod('wc_account_links', 1)){
$icons = [
  'dashboard' => 'avatar.svg',
    'orders' => 'order.svg',
    'edit-account' => 'avatar.svg',
    'customer-logout' => 'logout.svg',
    'downloads' => 'download.svg',
    'edit-address' => 'address_account.svg'
];
?>
<?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
  <li class="<?php echo wc_get_account_menu_item_classes( $endpoint ); ?>">
  <?php if($endpoint == 'dashboard'){ ?>
    <a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint )); ?>">
        <img src="<?php echo get_stylesheet_directory_uri().'/assets/img/myaccount/'.$icons['dashboard']; ?>" alt="">
        <?php echo esc_html( $label ); ?>
    </a>
    <!-- empty -->
  <?php } else { ?>
    <a href="<?php echo esc_url( wc_get_endpoint_url( $endpoint, '', wc_get_page_permalink( 'myaccount' )) ); ?>">
        <?php //echo $endpoint;?>
        <img src="<?php echo get_stylesheet_directory_uri().'/assets/img/myaccount/'.$icons[$endpoint]; ?>" alt="">
        <?php echo esc_html( $label ); ?>
    </a>
  <?php } ?>
  </li>
<?php endforeach; ?>
<?php do_action('flatsome_account_links'); ?>
<li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--customer-logout">
  <a href="<?php echo esc_url( wc_get_endpoint_url( 'customer-logout', '', wc_get_page_permalink( 'myaccount' )) ); ?>">
        <img src="<?php echo get_stylesheet_directory_uri().'/assets/img/myaccount/'.$icons['customer-logout']; ?>" alt="">
        <?php _e('Logout','woocommerce'); ?>
   </a>
</li>
<?php } ?>

