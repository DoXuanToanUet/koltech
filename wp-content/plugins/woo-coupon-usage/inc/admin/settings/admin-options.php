<?php

if ( !defined( 'ABSPATH' ) ) {
    exit;
}
/**
 * custom option and settings
 */
function wcusage_settings_init()
{
    // register a new setting for "wcusage" page
    register_setting( 'wcusage', 'wcusage_options' );
    // register a new section in the "wcusage" page
    $options = get_option( 'wcusage_options' );
    add_settings_section(
        'wcusage_section_developers',
        __( ' ', 'woo-coupon-usage' ),
        'wcusage_section_developers_cb',
        'wcusage'
    );
    // register general settings
    add_settings_field(
        'wcusage_field_orders',
        __( 'General Settings', 'woo-coupon-usage' ),
        'wcusage_field_cb',
        'wcusage',
        'wcusage_section_developers',
        [
        'class'               => 'wcusage_row wcusage_row_general',
        'wcusage_custom_data' => 'custom',
    ]
    );
    // register commission settings
    add_settings_field(
        'wcusage_field_commission',
        __( 'Commission Settings', 'woo-coupon-usage' ),
        'wcusage_field_cb_commission',
        'wcusage',
        'wcusage_section_developers',
        [
        'class' => 'wcusage_row wcusage_row_commission',
    ]
    );
    // register commission settings
    add_settings_field(
        'wcusage_field_fraud',
        __( 'Fraud Prevention & Usage Restrictions', 'woo-coupon-usage' ),
        'wcusage_field_cb_fraud',
        'wcusage',
        'wcusage_section_developers',
        [
        'class' => 'wcusage_row wcusage_row_fraud',
    ]
    );
    // register URL's
    add_settings_field(
        'wcusage_field_urls',
        __( 'URL Settings', 'woo-coupon-usage' ),
        'wcusage_field_cb_urls',
        'wcusage',
        'wcusage_section_developers',
        [
        'class' => 'wcusage_row wcusage_row_urls',
    ]
    );
    // register Email Notifications
    add_settings_field(
        'wcusage_field_notifications',
        __( 'Notifications Settings', 'woo-coupon-usage' ),
        'wcusage_field_cb_notifications',
        'wcusage',
        'wcusage_section_developers',
        [
        'class' => 'wcusage_row wcusage_row_notifications',
    ]
    );
    // register currency section
    add_settings_field(
        'wcusage_field_currency',
        __( 'Currency Settings', 'woo-coupon-usage' ),
        'wcusage_field_cb_currency',
        'wcusage',
        'wcusage_section_developers',
        [
        'class' => 'wcusage_row wcusage_row_currency',
    ]
    );
    // register Payouts
    add_settings_field(
        'wcusage_field_payouts',
        __( 'Payouts Settings', 'woo-coupon-usage' ),
        'wcusage_field_cb_payouts',
        'wcusage',
        'wcusage_section_developers',
        [
        'class' => 'wcusage_row wcusage_row_payouts',
    ]
    );
    // register pdf reports
    add_settings_field(
        'wcusage_field_reports',
        __( 'Affiliate Reports Settings', 'woo-coupon-usage' ),
        'wcusage_field_cb_reports',
        'wcusage',
        'wcusage_section_developers',
        [
        'class' => 'wcusage_row wcusage_row_reports',
    ]
    );
    // register custom tabs section
    add_settings_field(
        'wcusage_field_custom_tabs',
        __( 'Custom Affiliate Dashboard Tabs', 'woo-coupon-usage' ),
        'wcusage_field_cb_custom_tabs',
        'wcusage',
        'wcusage_section_developers',
        [
        'class' => 'wcusage_row wcusage_row_custom_tabs',
    ]
    );
    // register Registration
    add_settings_field(
        'wcusage_field_registration',
        __( 'Registration Settings', 'woo-coupon-usage' ),
        'wcusage_field_cb_registration',
        'wcusage',
        'wcusage_section_developers',
        [
        'class' => 'wcusage_row wcusage_row_registration',
    ]
    );
    // register Subscriptions
    add_settings_field(
        'wcusage_field_subscriptions',
        __( 'Subscription Renewal Settings', 'woo-coupon-usage' ),
        'wcusage_field_cb_subscriptions',
        'wcusage',
        'wcusage_section_developers',
        [
        'class' => 'wcusage_row wcusage_row_subscriptions',
    ]
    );
    // register design
    add_settings_field(
        'wcusage_field_design',
        __( 'Design', 'woo-coupon-usage' ),
        'wcusage_field_cb_design',
        'wcusage',
        'wcusage_section_developers',
        [
        'class' => 'wcusage_row wcusage_row_design',
    ]
    );
    // register debug
    add_settings_field(
        'wcusage_field_debug',
        __( 'Performance & Debug', 'woo-coupon-usage' ),
        'wcusage_field_cb_debug',
        'wcusage',
        'wcusage_section_developers',
        [
        'class' => 'wcusage_row wcusage_row_debug',
    ]
    );
    // help area
    add_settings_field(
        'wcusage_field_help',
        __( 'Help Area', 'woo-coupon-usage' ),
        'wcusage_field_cb_help',
        'wcusage',
        'wcusage_section_developers',
        [
        'class' => 'wcusage_row wcusage_row_help',
    ]
    );
    // pro version
    add_settings_field(
        'wcusage_field_pro_details',
        __( 'Pro Details', 'woo-coupon-usage' ),
        'wcusage_field_cb_pro_details',
        'wcusage',
        'wcusage_section_developers',
        [
        'class' => 'wcusage_row wcusage_row_pro_details',
    ]
    );
}

//register our wcusage_settings_init to the admin_init action hook
add_action( 'admin_init', 'wcusage_settings_init' );
// Display admin settings
function wcusage_section_developers_cb( $args )
{
    
    if ( !wcu_fs()->is__premium_only() || !wcu_fs()->can_use_premium_code() ) {
        $ispro = false;
    } else {
        $ispro = true;
    }
    
    $options = get_option( 'wcusage_options' );
    
    if ( function_exists( 'wp_enqueue_media' ) ) {
        wp_enqueue_media();
    } else {
        wp_enqueue_style( 'thickbox' );
        wp_enqueue_script( 'media-upload' );
        wp_enqueue_script( 'thickbox' );
    }
    
    ?>

<!--- Font Awesome -->
<link rel="stylesheet" href="<?php 
    echo  WCUSAGE_UNIQUE_PLUGIN_URL . 'fonts/font-awesome/css/all.min.css' ;
    ?>" crossorigin="anonymous">

<p style="font-size: 15px; color: green;"><strong>Plugin not working? Need help? Have a suggestion? <?php 
    
    if ( wcu_fs()->can_use_premium_code() ) {
        ?><a href="<?php 
        echo  get_site_url() ;
        ?>/wp-admin/admin.php?page=wcusage-contact"><?php 
    } else {
        ?><a href="https://wordpress.org/support/plugin/woo-coupon-usage/#new-topic-0" target="_blank" style="text-decoration: none;"><?php 
    }
    
    ?>Create a new support ticket <span class='fas fa-arrow-circle-right'></span></a></strong><br/></p>

<?php 
    if ( !wcu_fs()->is_premium() && wcu_fs()->can_use_premium_code() ) {
        ?>
<p style="font-size: 20px; color: red;"><strong>You have a Pro license! Please deactivate the FREE version and install the PRO version instead to enable the new functionality.</strong><br/></p>
<?php 
    }
    ?>

<?php 
    
    if ( class_exists( 'WooCommerce' ) ) {
        if ( version_compare( WC_VERSION, 3.7, "<=" ) ) {
            ?>
    <p style="font-size: 15px; color: red;"><strong><span class="dashicons dashicons-bell"></span> You are using an old version of WooCommerce. Version 3.7 or later is required for full access to all this plugins features.</strong><br/></p>
    <?php 
        }
    } else {
        ?>
  <p style="font-size: 15px; color: red;"><strong><span class="dashicons dashicons-bell"></span> WooCommerce needs to be installed/activated for this plugin to work.</strong><br/></p>
  <?php 
    }
    
    ?>

<?php 
    /*
        if ( !wcu_fs()->can_use_premium_code() ) {
    	echo '<br/><strong style="font-size: 20px;">Want more features?</strong><br/>';
            echo '<a style="font-size: 24px; margin-top: 10px; display: block;" href="' . wcu_fs()->get_upgrade_url() . '">' .
                __('UPGRADE TO PRO VERSION', 'woo-coupon-usage') .
                '</a>';
            echo '</section><br/><br/>';
        }
    */
    ?>

<?php 
    // Message on free version to promote PRO upgrade
    
    if ( !wcu_fs()->can_use_premium_code() ) {
        ?>

  <?php 
        // Black Friday Deal
        $todayDate = strtotime( 'now' );
        $dealDateBegin = strtotime( '10-12-2022' );
        $dealDateEnd = strtotime( '31-12-2022' );
        
        if ( $todayDate >= $dealDateBegin && $todayDate <= $dealDateEnd ) {
            $specialsale = true;
        } else {
            $specialsale = false;
        }
        
        ?>

  <div style="background: #fff; padding: 10px; margin: 10px 10px 0px 0; border-radius: 10px; display: inline-block; width: auto; border: 2px solid #c9c9c9;">
  <strong>Want more advanced features?</strong> &nbsp;
  <a href="<?php 
        echo  get_site_url() ;
        ?>/wp-admin/admin.php?page=wcusage-pricing&trial=true"
    style="font-weight: bold; color: green; text-decoration: none; background: green; color: #fff; padding: 5px; border-radius: 5px;">
    TRY PRO NOW, FREE FOR 7 DAYS
  </a>
  </div>

  <?php 
        
        if ( $specialsale ) {
            ?>
    <div style="background: transparent; color: #333; padding: 10px; margin: 10px 0 20px 0;
    display: inline-block; width: auto; max-width: 90%; font-size: 14px;">
    <strong style="color: red;">HOLIDAY SALE</strong> - Get 20% off PRO with code: <strong style="color: green;">FESTIVE2021</strong>
    </div>
  <?php 
        } else {
            ?>
    <div style="background: #fff; padding: 10px; margin: 10px 0 20px 0;
    border: 2px solid #c9c9c9; border-radius: 10px; display: inline-block; width: auto; max-width: 90%;">
    <strong style="color: red;">Special offer:</strong> <strong style="color: green;">Save 15%</strong> on PRO with discount code: <strong style="color: green;">DASH15</strong>
    </div>
  <?php 
        }
        
        ?>

  <br/>

<?php 
    }
    
    ?>

<!---
***** Script to Toggle Settings Tabs *****
--->

<script>
jQuery( document ).ready(function() {

  jQuery( ".nav-tab" ).on('click', function(){
    jQuery(".nav-tab" ).removeClass("active");
		jQuery( this ).addClass("active");
    if ( jQuery(document).scrollTop() >= 175 ) {
      jQuery('html, body').animate({
          scrollTop: jQuery(".nav-tab-wrapper-before").offset().top - 32
      }, 200);
    }
	});

  <?php 
    echo  wcusage_admin_settings_tab_click( "#tab-general", ".wcusage_row_general", 0 ) ;
    ?>

  <?php 
    echo  wcusage_admin_settings_tab_click( "#tab-commission", ".wcusage_row_commission", 1 ) ;
    ?>

  <?php 
    echo  wcusage_admin_settings_tab_click( "#tab-fraud", ".wcusage_row_fraud", 1 ) ;
    ?>

  <?php 
    echo  wcusage_admin_settings_tab_click( "#tab-pro", ".wcusage_row_pro", 1 ) ;
    ?>

  <?php 
    echo  wcusage_admin_settings_tab_click( "#tab-urls", ".wcusage_row_urls", 1 ) ;
    ?>

  <?php 
    echo  wcusage_admin_settings_tab_click( "#tab-notifications", ".wcusage_row_notifications", 1 ) ;
    ?>

  <?php 
    echo  wcusage_admin_settings_tab_click( "#tab-payouts", ".wcusage_row_payouts", 1 ) ;
    ?>

  <?php 
    echo  wcusage_admin_settings_tab_click( "#tab-invoices", ".wcusage_row_invoices", 1 ) ;
    ?>

  <?php 
    echo  wcusage_admin_settings_tab_click( "#tab-reports", ".wcusage_row_reports", 1 ) ;
    ?>

  <?php 
    echo  wcusage_admin_settings_tab_click( "#tab-custom-tabs", ".wcusage_row_custom_tabs", 1 ) ;
    ?>

  <?php 
    echo  wcusage_admin_settings_tab_click( "#tab-currency", ".wcusage_row_currency", 1 ) ;
    ?>

  <?php 
    echo  wcusage_admin_settings_tab_click( "#tab-registration", ".wcusage_row_registration", 1 ) ;
    ?>

  <?php 
    echo  wcusage_admin_settings_tab_click( "#tab-creatives", ".wcusage_row_creatives", 1 ) ;
    ?>

  <?php 
    echo  wcusage_admin_settings_tab_click( "#tab-mla", ".wcusage_row_mla", 1 ) ;
    ?>

  <?php 
    echo  wcusage_admin_settings_tab_click( "#tab-subscriptions", ".wcusage_row_subscriptions", 1 ) ;
    ?>

  <?php 
    echo  wcusage_admin_settings_tab_click( "#tab-translations", ".wcusage_row_translations", 1 ) ;
    ?>

  <?php 
    echo  wcusage_admin_settings_tab_click( "#tab-design", ".wcusage_row_design", 1 ) ;
    ?>

  <?php 
    echo  wcusage_admin_settings_tab_click( "#tab-debug", ".wcusage_row_debug", 1 ) ;
    ?>

  <?php 
    echo  wcusage_admin_settings_tab_click( "#tab-help", ".wcusage_row_help", 1 ) ;
    ?>

  <?php 
    echo  wcusage_admin_settings_tab_click( "#tab-pro-details", ".wcusage_row_pro_details", 1 ) ;
    ?>

});
</script>

<!---
***** Show Settings Tabs *****
--->

<div class="nav-tab-wrapper-before"></div>
<h2 class="nav-tab-wrapper">

  <!--- GENERAL --->
  <?php 
    echo  wcusage_admin_settings_tab_button(
        "tab-general",
        __( "General", "woo-coupon-usage" ),
        "fas fa-money-bill-wave",
        0,
        ''
    ) ;
    ?>

  <!--- COMMISSION --->
  <?php 
    echo  wcusage_admin_settings_tab_button(
        "tab-commission",
        __( "Commission", "woo-coupon-usage" ),
        "fas fa-money-bill-wave",
        0,
        ''
    ) ;
    ?>

  <!--- URLS --->
  <?php 
    echo  wcusage_admin_settings_tab_button(
        "tab-urls",
        __( "Referral URLs", "woo-coupon-usage" ),
        "fas fa-link",
        0,
        ''
    ) ;
    ?>

  <!--- Fraud --->
  <?php 
    echo  wcusage_admin_settings_tab_button(
        "tab-fraud",
        __( "Fraud", "woo-coupon-usage" ),
        "fa-solid fa-user-secret",
        0,
        ''
    ) ;
    ?>

  <!--- NOTIFICATIONS --->
  <?php 
    echo  wcusage_admin_settings_tab_button(
        "tab-notifications",
        __( "Emails", "woo-coupon-usage" ),
        "fas fa-envelope",
        0,
        ''
    ) ;
    ?>

  <!--- SUBSCRIPTIONS --->
  <?php 
    $wcusage_subscriptions_enable = ( is_plugin_active( 'woocommerce-subscriptions/woocommerce-subscriptions.php' ) ? true : false );
    if ( $wcusage_subscriptions_enable ) {
        echo  wcusage_admin_settings_tab_button(
            "tab-subscriptions",
            __( "Subscriptions", "woo-coupon-usage" ),
            "fas fa-sync-alt",
            0,
            ''
        ) ;
    }
    ?>

  <!--- TRANSLATIONS --->
  <?php 
    $wcusage_field_show_custom_translations = wcusage_get_setting_value( 'wcusage_field_show_custom_translations', '0' );
    if ( $wcusage_field_show_custom_translations ) {
        echo  wcusage_admin_settings_tab_button(
            "tab-translations",
            __( "Translations", "woo-coupon-usage" ),
            "fas fa-language",
            0,
            ''
        ) ;
    }
    ?>

  <!--- CURRENCY --->
  <?php 
    echo  wcusage_js_settings_tab_toggle( '.wcusage_field_enable_currency', '', '#tab-currency' ) ;
    ?>
  <?php 
    echo  wcusage_admin_settings_tab_button(
        "tab-currency",
        __( "Currencies", "woo-coupon-usage" ),
        "fas fa-dollar-sign",
        0,
        ''
    ) ;
    ?>

  <!--- PAYOUTS --->
  <?php 
    
    if ( wcu_fs()->can_use_premium_code() ) {
        ?>
  <?php 
        echo  wcusage_js_settings_tab_toggle( '.wcusage_field_tracking_enable', '', '#tab-payouts' ) ;
        ?>
  <?php 
    }
    
    ?>
  <?php 
    echo  wcusage_admin_settings_tab_button(
        "tab-payouts",
        __( "Payouts", "woo-coupon-usage" ),
        "fas fa-handshake",
        1,
        ''
    ) ;
    ?>

  <!-- INVOICES --->
  <?php 
    
    if ( wcu_fs()->can_use_premium_code() ) {
        ?>
    <?php 
        echo  wcusage_js_settings_tab_toggle( '.wcusage_field_payouts_enable_invoices', '.wcusage_field_payouts_enable_statements', '#tab-invoices' ) ;
        ?>
    <?php 
        echo  wcusage_admin_settings_tab_button(
            "tab-invoices",
            __( "Invoices", "woo-coupon-usage" ),
            "fas fa-file-invoice",
            1,
            ''
        ) ;
        ?>
  <?php 
    }
    
    ?>

  <?php 
    
    if ( wcu_fs()->can_use_premium_code() ) {
        ?>
  <!-- REPORTS --->
  <?php 
        echo  wcusage_js_settings_tab_toggle( '.wcusage_field_enable_reports', '', '#tab-reports' ) ;
        ?>
  <?php 
        echo  wcusage_admin_settings_tab_button(
            "tab-reports",
            __( "Reports", "woo-coupon-usage" ),
            "fas fa-file-alt",
            1,
            ''
        ) ;
        ?>

  <!--- TABS --->
  <?php 
        echo  wcusage_admin_settings_tab_button(
            "tab-custom-tabs",
            __( "Tabs", "woo-coupon-usage" ),
            "fas fa-folder-plus",
            1,
            ''
        ) ;
        ?>
  <?php 
    }
    
    ?>

  <!--- REGISTRATION --->
  <?php 
    echo  wcusage_js_settings_tab_toggle( '.wcusage_field_registration_enable', '', '#tab-registration' ) ;
    ?>
  <?php 
    echo  wcusage_admin_settings_tab_button(
        "tab-registration",
        __( "Registration", "woo-coupon-usage" ),
        "fas fa-user-circle",
        1,
        ''
    ) ;
    ?>

    <!--- CREATIVES --->
  <?php 
    
    if ( wcu_fs()->can_use_premium_code() ) {
        ?>
  <?php 
        echo  wcusage_js_settings_tab_toggle( '.wcusage_field_creatives_enable', '', '#tab-creatives' ) ;
        ?>
  <?php 
        echo  wcusage_admin_settings_tab_button(
            "tab-creatives",
            __( "Creatives", "woo-coupon-usage" ),
            "fas fa-images",
            1,
            ''
        ) ;
        ?>
  <?php 
    }
    
    ?>

    <!--- MLA --->
  <?php 
    
    if ( wcu_fs()->can_use_premium_code() ) {
        ?>
  <?php 
        echo  wcusage_js_settings_tab_toggle( '.wcusage_field_mla_enable', '', '#tab-mla' ) ;
        ?>
  <?php 
        echo  wcusage_admin_settings_tab_button(
            "tab-mla",
            __( "MLA", "woo-coupon-usage" ),
            "fa-solid fa-users",
            1,
            ''
        ) ;
        ?>
  <?php 
    }
    
    ?>

  <!--- DESIGN --->
  <?php 
    echo  wcusage_admin_settings_tab_button(
        "tab-design",
        __( "Design", "woo-coupon-usage" ),
        "fas fa-palette",
        0,
        ''
    ) ;
    ?>

  <!--- DEBUGS --->
  <?php 
    echo  wcusage_admin_settings_tab_button(
        "tab-debug",
        __( "Debug", "woo-coupon-usage" ),
        "fas fa-wrench",
        0,
        ''
    ) ;
    ?>

  <!--- HOW TO --->
  <?php 
    echo  wcusage_admin_settings_tab_button(
        "tab-help",
        __( "Help", "woo-coupon-usage" ),
        "fas fa-question-circle",
        0,
        'background: RoyalBlue; color: #fff;'
    ) ;
    ?>

  <!--- MODULES --->
  <?php 
    echo  wcusage_admin_settings_tab_button(
        "tab-pro-details",
        __( "PRO Modules", "woo-coupon-usage" ),
        "fas fa-star",
        0,
        'background: green; color: #fff;'
    ) ;
    ?>

</h2>

<?php 
}

/**
 * Options Page
 *
 */
if ( !function_exists( 'wcusage_options_page_html' ) ) {
    function wcusage_options_page_html()
    {
        // check user capabilities
        if ( !current_user_can( 'manage_options' ) ) {
            return;
        }
        // add error/update messages
        // check if the user have submitted the settings
        // wordpress will add the "settings-updated" $_GET parameter to the url
        
        if ( isset( $_GET['settings-updated'] ) ) {
            // add settings saved message with the class of "updated"
            add_settings_error(
                'wcusage_messages',
                'wcusage_message',
                __( 'Settings Saved', 'woo-coupon-usage' ),
                'updated'
            );
            flush_rewrite_rules( false );
        }
        
        // show error/update messages
        settings_errors( 'wcusage_messages' );
        ?>

   <div class="wrap plugin-settings wcusage-settings">

   <h1 style="height: 0; opacity: 0;">-</h1>

   <?php 
        echo  do_action( 'wcusage_hook_dashboard_page_header', '' ) ;
        ?>

    <h2 style="margin-bottom: 25px;">
      <?php 
        echo  esc_html( get_admin_page_title() ) ;
        ?>
      <a href="/wp-admin/admin.php?page=wcusage_setup" class="wcusage-settings-wizard-button">Setup Wizard <span class="fa-solid fa-circle-arrow-right"></span></a>
    </h2>

  	<?php 
        $coupon_shortcode_page = wcusage_get_coupon_shortcode_page( 1 );
        ?>

  	<!-- Generate Getting Started Message -->
  	<?php 
        
        if ( !$coupon_shortcode_page ) {
            do_action( 'wcusage_hook_getting_started_create' );
            do_action( 'wcusage_hook_getting_started' );
        }
        
        ?>

    <?php 
        // Output if refresh stats link clicked
        if ( isset( $_GET['refreshstats'] ) ) {
            
            if ( $_GET['refreshstats'] ) {
                $option_group = get_option( 'wcusage_options' );
                $option_group['wcusage_refresh_date'] = time();
                update_option( 'wcusage_options', $option_group );
                
                if ( isset( $options['wcusage_refresh_date'] ) ) {
                    $wcusage_refresh_date = $options['wcusage_refresh_date'];
                } else {
                    $wcusage_refresh_date = "";
                }
                
                ?>

          <p style="max-width: 500px;">Success! All affiliate dashboard stats will now be refreshed and re-calculated, the next time the affiliate dashboard is loaded (first load may take a few seconds longer).</p>

          <p>Redirecting back to settings in <span id="count">5</span> seconds...</p>

          <script type="text/javascript">

          window.onload = function(){

          (function(){
            var counter = 5;

            setInterval(function() {
              counter--;
              if (counter >= 0) {
                span = document.getElementById("count");
                span.innerHTML = counter;
              }
              // Display 'counter' wherever you want to display it.
              if (counter === 0) {
              //    alert('this is where it happens');
                  clearInterval(counter);
              }

            }, 1000);

          })();

          }

          </script>

          <?php 
                echo  "<style>.wcusage-settings-form, .wcu-settings-sidebar { display: none; }</style>" ;
                header( "refresh:5; url=" . get_admin_url() . "admin.php?page=wcusage_settings" );
            }
        
        }
        ?>

    <?php 
        // Output if refresh stats link clicked
        
        if ( isset( $_GET['section'] ) ) {
            ?>
      <script>
      jQuery( document ).ready(function() {
        setTimeout(
          function()
          {
            jQuery( "#<?php 
            echo  $_GET['section'] ;
            ?>" ).trigger('click');
          }, 50);
      });
      </script>
      <?php 
        }
        
        ?>

    <?php 
        echo  wcusage_test_report_form() ;
        ?>

  	<!-- Generate Settings Page Area -->
  	<form class="wcusage-settings-form" action="options.php" method="post" style="margin-top: 10px;">
  	<?php 
        // output security fields for the registered setting "wcusage"
        settings_fields( 'wcusage' );
        // output setting sections and their fields
        // (sections are registered for "wcusage", each field is registered to a specific section)
        do_settings_sections( 'wcusage' );
        ?>

      <br/><br/><hr/>

      <p style="display: block; font-size: 15px; margin-bottom: 34px;"><strong>Have a feature suggestion? Found a bug? Need help? <?php 
        
        if ( wcu_fs()->can_use_premium_code() ) {
            ?><a href="/wp-admin/admin.php?page=wcusage-contact"><?php 
        } else {
            ?><a href="https://wordpress.org/support/plugin/woo-coupon-usage/#new-topic-0" target="_blank"><?php 
        }
        
        ?>Get in touch.</a></strong></p>

      <?php 
        $wcusage_field_settings_legacy = wcusage_get_setting_value( 'wcusage_field_settings_legacy', '0' );
        ?>
      <?php 
        if ( !$wcusage_field_settings_legacy ) {
            ?>
      <hr/>
      <p style="font-size: 20px; color: green; display: none;" id="wcu-number-settings-saved-message"><i class="fas fa-check-square" style="font-size: 20px; color: green; background: transparent; padding: 0;"></i>&nbsp; <span id="wcu-number-settings-saved">0</span> settings were updated (this session).</p>
      <?php 
        }
        ?>

      <br/>
      <div style="transform: scale(0.8); -webkit-transform-origin-x: 0;">
        <strong>Settings not saving automatically?</strong><br/>
        <?php 
        echo  wcusage_setting_toggle_option(
            'wcusage_field_settings_legacy',
            0,
            'Enable legacy (bulk) saving for settings page.',
            '0px'
        ) ;
        ?>
        <i><?php 
        echo  __( 'This will disable automatic ajax saving, and instead will enable the "Save Settings" button, and you will save all settings at once.', 'woo-coupon-usage' ) ;
        ?></i>

        <?php 
        echo  wcusage_setting_toggle( '.wcusage_field_settings_legacy', '.wcu-field-section-save' ) ;
        // Show or Hide
        ?>
      </div>

      <script>
      jQuery( document ).ready(function() {
        if( jQuery('#wcusage_field_settings_legacy').prop('checked') ) {
          jQuery('.wcu-field-section-save').show();
        }
        jQuery('#wcusage_field_settings_legacy').change(function(){
          if(jQuery(this).prop('checked')) {
            jQuery('.wcu-field-section-save').show();
          } else {
            jQuery('.wcu-field-section-save').hide();
          }
        });
      });
      </script>
      <span class="wcu-field-section-save" style="display: none;">
        <?php 
        // output save settings button
        submit_button( 'Save Settings' );
        ?>

        <?php 
        
        if ( ini_get( 'max_input_vars' ) < 1000 ) {
            ?>
        <br/><p style="font-size: 12px;"><strong>Settings not saving? Try disabling "legacy" saving, or increasing your PHP "max_input_vars" in your hosting configuration to 3000 or higher (currently <?php 
            echo  ini_get( 'max_input_vars' ) ;
            ?>). <a href="https://couponaffiliates.com/docs/increase-max-input-vars-limit" target="_blank"><?php 
            echo  __( 'Learn More.', 'woo-coupon-usage' ) ;
            ?></a></strong><br/></p>
        <?php 
        }
        
        ?>
      </span>

  	</form>

    <div class="wcu-settings-sidebar" style="margin-top: -10px;">

    <a href="https://couponaffiliates.com/docs/setup-guide-free?utm_source=dashboard-sidebar" style="text-decoration: none;" target="_blank">
      <div class="wcu-settings-sidebar-box" style="background: linear-gradient(-45deg,#1a9612,#0c5a07,#1a9612,#0c5a07); background-size: 250% 250% !important; color: #fff;
      padding: 22px 0 30px 0; font-size: 22px; text-align: center; border-radius: 10px; border: 2px solid #F8F8FF; margin-bottom: 10px;">
        <span style="font-size: 10px; color: #71B375; font-weight: bold;">Need help getting started?</span><br/>
        Setup Guide <span class="dashicons dashicons-external"></span>
      </div>
    </a>

    <a href="https://couponaffiliates.com/docs?utm_source=dashboard-sidebar" style="text-decoration: none;" target="_blank">
      <div class="wcu-settings-sidebar-box" style="background: linear-gradient(-45deg,#1a9612,#0c5a07,#1a9612,#0c5a07); background-size: 250% 250% !important; color: #fff;
      padding: 22px 0 30px 0; font-size: 22px; text-align: center; border-radius: 10px; border: 2px solid #F8F8FF; margin-bottom: 10px;">
        <span style="font-size: 10px; color: #71B375; font-weight: bold;">Need help configuring the settings?</span><br/>
        Documentation <span class="dashicons dashicons-external"></span>
      </div>
    </a>

    <?php 
        
        if ( wcu_fs()->can_use_premium_code() ) {
            ?>
      <a href="/wp-admin/admin.php?page=wcusage-contact" style="text-decoration: none;" target="_blank">
    <?php 
        } else {
            ?>
      <a href="https://wordpress.org/support/plugin/woo-coupon-usage/#new-topic-0" style="text-decoration: none;" target="_blank">
    <?php 
        }
        
        ?>
      <div class="wcu-settings-sidebar-box" style="background: linear-gradient(-45deg,#1a9612,#0c5a07,#1a9612,#0c5a07); background-size: 250% 250% !important; color: #fff;
      padding: 22px 0 30px 0; font-size: 22px; text-align: center; border-radius: 10px; border: 2px solid #F8F8FF; margin-bottom: 10px;">
        <span style="font-size: 10px; color: #71B375; font-weight: bold;">Need help from a human?</span><br/>
        Support Ticket <span class="dashicons dashicons-external"></span>
      </div>
    </a>

    <?php 
        ?>

  <style>
  #wcu-settings-sidebar-pro-upgrade {
    --borderWidth: 5px;
    background: #1D1F20;
    position: relative;
    border-radius: var(--borderWidth);
  }
  #wcu-settings-sidebar-pro-upgrade:after {
    content: '';
    position: absolute;
    top: calc(-1 * var(--borderWidth));
    left: calc(-1 * var(--borderWidth));
    height: calc(100% + var(--borderWidth) * 2);
    width: calc(100% + var(--borderWidth) * 2);
    background: linear-gradient(60deg, #1a9612, #0c5a07, #000000, #1a9612, #0c5a07, #000000);
    z-index: -1;
    animation: animatedgradient 3s ease alternate infinite;
    background-size: 300% 300%;
    border-radius: 10px;
  }
  @keyframes animatedgradient {
    0% {
      background-position: 0% 50%;
    }
    50% {
      background-position: 100% 50%;
    }
    100% {
      background-position: 0% 50%;
    }
  }
  .wcu-settings-sidebar-pro-upgrade-button {
    font-size: 20px;
    line-height: 30px;
    margin: 15px auto 0 auto;
    background: linear-gradient(-45deg,#1a9612,#0c5a07,#1a9612,#0c5a07);
    background-size: 250% 250% !important;
    padding: 2px 5px 5px 5px;
    color: #fff;
    border-radius: 20px;
    display: block;
    width: 190px;
    border: 2px solid #fff;
  }
  .wcu-settings-sidebar-pro-upgrade-button:hover {
    background: #1a9612;
  }
  .wcu-settings-sidebar-pro-upgrade-showmore {
    font-size: 15px;
    color: #fff !important;
    text-decoration: none;
    line-height: 20px;
    margin-top: 20px;
    margin-bottom: -12px;
    font-weight: bold;
  }
  .wcu-settings-sidebar-pro-upgrade-showmore:hover, .wcu-settings-sidebar-pro-upgrade-showmore:active {
    color: #1a9612 !important;
    border: 0 !important;
    text-decoration: none !important;
    box-shadow: none !important;
  }
  </style>

    <?php 
        
        if ( wcu_fs()->is_free_plan() ) {
            ?>

    <script>
    jQuery( document ).ready(function() {
      jQuery('.wcu-settings-sidebar-pro-upgrade-showmore-content').hide();
      jQuery('.wcu-settings-sidebar-pro-upgrade-showmore').mouseover(function(){
        jQuery('.wcu-settings-sidebar-pro-upgrade-showmore-content').show();
      });
    });
    </script>

      <div id="wcu-settings-sidebar-pro-upgrade" class="wcu-settings-sidebar-box" style="background: #333; color: #fff;
      padding: 22px 10px 30px 10px; font-size: 22px; text-align: center; border-radius: 10px; margin-top: 17px; margin-bottom: 18px; margin-left: 7px; width: calc(100% - 34px);">
        <span style="font-size: 10px; color: #fff;">Want more advanced features?</span><br/>
        <p style="font-size: 24px; line-height: 30px; margin: 0;">Upgrade to PRO!</p>
        <a href="<?php 
            echo  wcu_fs()->get_upgrade_url() ;
            ?>&trial=true" style="text-decoration: none;" target="_blank">
        <p class="wcu-settings-sidebar-pro-upgrade-button">FREE 7 DAY TRIAL <span class="fas fa-arrow-right"></span></p>
        </a>
        <p style="font-size: 12px; line-height: 20px; margin-top: 15px;">After your trial, just $12.99 per month.</p>
        <a href="#!" onclick="return false;" class="wcu-settings-sidebar-pro-upgrade-showmore">
          What's included? <span class="fas fa-angle-double-down"></span>
        </a>
        <div style="font-size: 12px;" class="wcu-settings-sidebar-pro-upgrade-showmore-content">
          <br><span class="dashicons dashicons-yes-alt"></span> Affiliate Registration System
          <br><span class="dashicons dashicons-yes-alt"></span> Advanced Admin Reports
          <br><span class="dashicons dashicons-yes-alt"></span> Affiliate Email Reports
          <br><span class="dashicons dashicons-yes-alt"></span> Creatives Section
          <br><span class="dashicons dashicons-yes-alt"></span> Multi-Level Affiliates
          <br><span class="dashicons dashicons-yes-alt"></span> Unpaid Commission Tracking
          <br><span class="dashicons dashicons-yes-alt"></span> Commission Payout Requests
          <br><span class="dashicons dashicons-yes-alt"></span> Commission Payout Tracking
          <br><span class="dashicons dashicons-yes-alt"></span> One-Click Stripe Payouts
          <br><span class="dashicons dashicons-yes-alt"></span> One-Click PayPal Payouts
          <br><span class="dashicons dashicons-yes-alt"></span> Scheduled Payout Requests
          <br><span class="dashicons dashicons-yes-alt"></span> PDF Statements & Invoices
          <br><span class="dashicons dashicons-yes-alt"></span> Lifetime Commissions
          <br><span class="dashicons dashicons-yes-alt"></span> Affiliate Landing Pages
          <br><span class="dashicons dashicons-yes-alt"></span> Monthly Summary Table
          <br><span class="dashicons dashicons-yes-alt"></span> Commission Line Graphs
          <br><span class="dashicons dashicons-yes-alt"></span> Export to Excel Buttons
          <br><span class="dashicons dashicons-yes-alt"></span> Custom Commission Per Coupon
          <br><span class="dashicons dashicons-yes-alt"></span> Custom Commission Per Product
          <br><span class="dashicons dashicons-yes-alt"></span> Custom Commission Per User Role
          <br><span class="dashicons dashicons-yes-alt"></span> Campaigns (Referral URL)
          <br><span class="dashicons dashicons-yes-alt"></span> Direct Link Tracking (Referral URL)
          <br><span class="dashicons dashicons-yes-alt"></span> Social Sharing (Referral URL)
          <br><span class="dashicons dashicons-yes-alt"></span> Short URL Generator (Referral URL)
          <br><span class="dashicons dashicons-yes-alt"></span> QR Code Generator (Referral URL)
          <br><span class="dashicons dashicons-yes-alt"></span> Custom Affiliate Dashboard Tabs
          <br><span class="dashicons dashicons-yes-alt"></span> and more great features!
          <br>
          <br><span class="dashicons dashicons-yes-alt"></span> All Future PRO Features
          <br><span class="dashicons dashicons-yes-alt"></span> Priority UK-based Support
          <br><span class="dashicons dashicons-yes-alt"></span> 14 Day Money-Back Guarantee
        </div>

      </div>

      <a href="https://couponaffiliates.com?utm_source=dashboard-sidebar" style="text-decoration: none;" target="_blank">
        <div class="wcu-settings-sidebar-box" style="background: #333; background-size: 250% 250% !important; color: #fff;
        padding: 22px 0 22px 0; font-size: 18px; text-align: center; border-radius: 10px; border: 2px solid #F8F8FF; margin-bottom: 10px;">
          Learn more about PRO <span class="dashicons dashicons-external"></span>
        </div>
      </a>

    <?php 
        }
        
        ?>


      <a href="https://roadmap.couponaffiliates.com/boards/feature-requests" style="text-decoration: none;" target="_blank">
        <div class="wcu-settings-sidebar-box" style="background: linear-gradient(-45deg,#1a9612,#0c5a07,#1a9612,#0c5a07); background-size: 250% 250% !important; color: #fff;
        padding: 22px 0 30px 0; font-size: 22px; text-align: center; border-radius: 10px; border: 2px solid #F8F8FF; margin-bottom: 10px;">
          <span style="font-size: 10px; color: #71B375; font-weight: bold;">Got a suggestion for the plugin?</span><br/>
          Feature Requests <span class="dashicons dashicons-external"></span>
        </div>
      </a>

    <br/><br/>

    <center><a href="https://twitter.com/CouponAffs?ref_src=twsrc%5Etfw" class="twitter-follow-button" data-show-count="false">Follow @CouponAffs</a><script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script></center>

    <br/><br/>

    <script type="text/javascript">
    function wcusage_hide_admin_sidebar() {
      jQuery(".wcu-settings-sidebar").hide();
      jQuery(".wcusage-settings-form").css("width", "97.5%");
    }
    </script>
    <button onclick="wcusage_hide_admin_sidebar()" style="border: 0; display: block; margin: 0 auto; cursor: pointer; font-weight: bold; color: #333;">
      Collapse Sidebar <span class="dashicons dashicons-arrow-right-alt"></span>
    </button>

    </div>

   </div>
   <?php 
    }

}
/**
 * Script for showing section when toggle is on/off
 *
 */
if ( !function_exists( 'wcusage_setting_toggle' ) ) {
    function wcusage_setting_toggle( $toggleclass, $showclass )
    {
        return "<script>\r\n    jQuery( document ).ready(function() {\r\n      if(!jQuery('" . $toggleclass . "').prop('checked')) {\r\n        jQuery('" . $showclass . "').hide();\r\n      }\r\n      jQuery('" . $toggleclass . "').change(function(){\r\n        if(jQuery(this).prop('checked')) {\r\n          jQuery('" . $showclass . "').show();\r\n        } else {\r\n          jQuery('" . $showclass . "').hide();\r\n        }\r\n      });\r\n    });\r\n    </script>";
    }

}
/**
 * Function for toggle settings option
 *
 */
if ( !function_exists( 'wcusage_setting_toggle_option' ) ) {
    function wcusage_setting_toggle_option(
        $name,
        $default,
        $label,
        $margin
    )
    {
        $options = get_option( 'wcusage_options' );
        wcusage_setting_option_set_default( $options, $name, $default );
        ?>
    <p style="margin-left: <?php 
        echo  $margin ;
        ?>">
      <?php 
        $setting = wcusage_get_setting_value( $name, $default );
        $checked2 = ( $setting == '1' ? ' checked="checked"' : '' );
        ?>
      <label class="switch">
          <input type="hidden" value="0" data-custom="custom" name="wcusage_options[<?php 
        echo  $name ;
        ?>]" >
          <input type="checkbox" value="1" id="<?php 
        echo  $name ;
        ?>" class="<?php 
        echo  $name ;
        ?>" data-custom="custom" name="wcusage_options[<?php 
        echo  $name ;
        ?>]"
          <?php 
        echo  $checked2 ;
        ?>>
        <span class="slider round">
          <span class="on"><span class="fa-solid fa-check"></span></span>
          <span class="off"></span>
        </span>
      </label>
      <strong><label for="scales"><?php 
        echo  $label ;
        ?></label></strong>
    </p>
  <?php 
    }

}
/**
 * Function for textarea settings option
 *
 */
if ( !function_exists( 'wcusage_setting_textarea_option' ) ) {
    function wcusage_setting_textarea_option(
        $name,
        $default,
        $label,
        $margin
    )
    {
        $options = get_option( 'wcusage_options' );
        wcusage_setting_option_set_default( $options, $name, $default );
        ?>
    <p style="margin-left: <?php 
        echo  $margin ;
        ?>">
      <?php 
        $setting = wcusage_get_setting_value( $name, $default );
        ?>
      <?php 
        
        if ( $label ) {
            ?><strong><?php 
            echo  $label ;
            ?>:</strong><br/><?php 
        }
        
        ?>
    	<textarea rows="3" cols="30" id="<?php 
        echo  $name ;
        ?>" style="width: 300px; max-width: 100%;"
    	name="wcusage_options[<?php 
        echo  $name ;
        ?>]"><?php 
        echo  $setting ;
        ?></textarea><br/>
    </p>
  <?php 
    }

}
/**
 * Function for text settings option
 *
 */
if ( !function_exists( 'wcusage_setting_text_option' ) ) {
    function wcusage_setting_text_option(
        $name,
        $default,
        $label,
        $margin
    )
    {
        $options = get_option( 'wcusage_options' );
        wcusage_setting_option_set_default( $options, $name, $default );
        ?>
  <p style="margin-left: <?php 
        echo  $margin ;
        ?>">
    <?php 
        $setting = wcusage_get_setting_value( $name, $default );
        ?>
    <?php 
        
        if ( $label ) {
            ?><strong><?php 
            echo  $label ;
            ?></strong><br/><?php 
        }
        
        ?>
    <input type="text" value="<?php 
        echo  $setting ;
        ?>" id="<?php 
        echo  $name ;
        ?>" name="wcusage_options[<?php 
        echo  $name ;
        ?>]">
  </p>
  <?php 
    }

}
/**
 * Function for password text settings option
 *
 */
if ( !function_exists( 'wcusage_setting_password_option' ) ) {
    function wcusage_setting_password_option(
        $name,
        $default,
        $label,
        $margin
    )
    {
        $options = get_option( 'wcusage_options' );
        wcusage_setting_option_set_default( $options, $name, $default );
        ?>
  <p style="margin-left: <?php 
        echo  $margin ;
        ?>">
    <?php 
        $setting = wcusage_get_setting_value( $name, $default );
        ?>
    <strong><?php 
        echo  $label ;
        ?></strong><br/>
    <input type="password" value="<?php 
        echo  $setting ;
        ?>" id="<?php 
        echo  $name ;
        ?>" name="wcusage_options[<?php 
        echo  $name ;
        ?>]">
  </p>
  <?php 
    }

}
/**
 * Function for color settings option
 *
 */
if ( !function_exists( 'wcusage_setting_color_option' ) ) {
    function wcusage_setting_color_option(
        $name,
        $default,
        $label,
        $margin
    )
    {
        $options = get_option( 'wcusage_options' );
        wcusage_setting_option_set_default( $options, $name, $default );
        ?>
  <p style="margin-left: <?php 
        echo  $margin ;
        ?>">
      <?php 
        $setting = wcusage_get_setting_value( $name, $default );
        ?>
      <?php 
        
        if ( $label ) {
            ?><strong><?php 
            echo  $label ;
            ?>:</strong><br/><?php 
        }
        
        ?>
      <input type="color" value="<?php 
        echo  $setting ;
        ?>" id="<?php 
        echo  $name ;
        ?>" name="wcusage_options[<?php 
        echo  $name ;
        ?>]">
  </p>
  <?php 
    }

}
/**
 * Function for number settings option
 *
 */
if ( !function_exists( 'wcusage_setting_number_option' ) ) {
    function wcusage_setting_number_option(
        $name,
        $default,
        $label,
        $margin
    )
    {
        $options = get_option( 'wcusage_options' );
        wcusage_setting_option_set_default( $options, $name, $default );
        ?>
  <p style="margin-left: <?php 
        echo  $margin ;
        ?>">
    <?php 
        $setting = wcusage_get_setting_value( $name, $default );
        ?>
    <strong><?php 
        echo  $label ;
        ?></strong><br/>
    <input type="number" value="<?php 
        echo  $setting ;
        ?>"
    id="<?php 
        echo  $name ;
        ?>" name="wcusage_options[<?php 
        echo  $name ;
        ?>]">
    <br/>
  </p>
  <?php 
    }

}
/**
 * Function for textarea settings option
 *
 */
if ( !function_exists( 'wcusage_setting_tinymce_option' ) ) {
    function wcusage_setting_tinymce_option(
        $name,
        $default,
        $label,
        $margin,
        $size = "150"
    )
    {
        $options = get_option( 'wcusage_options' );
        wcusage_setting_option_set_default( $options, $name, $default );
        ?>
    <strong style="margin-bottom: 5px; display: block;"><?php 
        echo  $label ;
        ?></strong>
    <?php 
        $setting = html_entity_decode( wcusage_get_setting_value( $name, $default ) );
        $settings1 = array(
            'wpautop'       => true,
            'media_buttons' => true,
            'textarea_name' => 'wcusage_options[' . $name . ']',
            'textarea_rows' => 5,
            'editor_class'  => $name,
            'tinymce'       => true,
            'editor_height' => $size,
        );
        echo  wcusage_tinymce_ajax_script( $name ) ;
        wp_editor( $setting, $name, $settings1 );
    }

}
/**
 * Saves the current default option value if not already set.
 *
 */
if ( !function_exists( 'wcusage_setting_option_set_default' ) ) {
    function wcusage_setting_option_set_default( $options, $name, $default )
    {
        
        if ( !isset( $options[$name] ) && current_user_can( 'manage_options' ) ) {
            $option_group = get_option( 'wcusage_options' );
            $option_group[$name] = $default;
            update_option( 'wcusage_options', $option_group );
        }
    
    }

}
/**
 * Get Value of Setting with Default
 *
 */
if ( !function_exists( 'wcusage_get_setting_value' ) ) {
    function wcusage_get_setting_value( $theoption, $thedefault )
    {
        $options = get_option( 'wcusage_options' );
        
        if ( isset( $options[$theoption] ) && $options[$theoption] != "" ) {
            $wcusage_field = $options[$theoption];
        } else {
            $wcusage_field = $thedefault;
        }
        
        if ( !is_array( $wcusage_field ) ) {
            $wcusage_field = esc_attr( $wcusage_field );
        }
        return $wcusage_field;
    }

}
/**
 * Script for TinyMCE editor to auto update via ajax
 *
 */
if ( !function_exists( 'wcusage_tinymce_ajax_script' ) ) {
    function wcusage_tinymce_ajax_script( $id )
    {
        ?>
  <script>
  function wcusettingsdelay(callback, ms) {
    var timer = 0;
    return function() {
      var context = this, args = arguments;
      clearTimeout(timer);
      timer = setTimeout(function () {
        callback.apply(context, args);
      }, ms || 0);
    };
  }
  jQuery( document ).ready(function() {
      tinymce.editors['<?php 
        echo  $id ;
        ?>'].onChange.add(wcusettingsdelay(function (ed, e) {
          wcu_ajax_update_the_options('<?php 
        echo  $id ;
        ?>', 'data-id', 'wcu-update-text', 1);
      }, 1500));
  });
  </script>
  <?php 
    }

}
/**
 * Function to display a settings tab
 *
 */
if ( !function_exists( 'wcusage_admin_settings_tab_button' ) ) {
    function wcusage_admin_settings_tab_button(
        $id,
        $name,
        $icon,
        $pro,
        $css
    )
    {
        ?>
  <a href="javascript:void(0);" class="nav-tab" <?php 
        if ( $css ) {
            echo  'style="' . $css . '"' ;
        }
        ?> id="<?php 
        echo  $id ;
        ?>" <?php 
        if ( (!wcu_fs()->can_use_premium_code() || !wcu_fs()->is_premium()) && $pro ) {
            ?>style="opacity: 0.4;"<?php 
        }
        ?>>
    <span class="<?php 
        echo  $icon ;
        ?> settings-tab-icon"></span>
    <?php 
        echo  $name ;
        if ( !wcu_fs()->can_use_premium_code() && $pro ) {
            ?><span class="wcu-settings-pro-icon">Pro</span><?php 
        }
        ?>
  </a>
  <?php 
    }

}
/**
 * Function for onclick script event on click settings tab
 *
 */
if ( !function_exists( 'wcusage_admin_settings_tab_click' ) ) {
    function wcusage_admin_settings_tab_click( $tab, $class, $hide )
    {
        if ( $hide == 1 ) {
            echo  'jQuery( "' . $class . '" ).hide();' ;
        }
        echo  '
    jQuery( "' . $tab . '" ).click(function() {
    	jQuery( ".wcusage_row" ).hide();
    	jQuery( ".plugin-settings .submit" ).show();
    	jQuery( "' . $class . '" ).show();
    });
    ' ;
    }

}
/**
 * Creates the toggle for the settings page tabs.
 *
 */
if ( !function_exists( 'wcusage_js_settings_tab_toggle' ) ) {
    function wcusage_js_settings_tab_toggle( $class1, $class2, $tab )
    {
        ?>
  <script>
  jQuery( document ).ready(function() {
    var class1 = "<?php 
        echo  $class1 ;
        ?>:not(.pro-setting-toggle)";
    <?php 
        
        if ( $class2 ) {
            ?>
    var class2 = "<?php 
            echo  $class2 ;
            ?>:not(.pro-setting-toggle)";
    <?php 
        }
        
        ?>
    var tabid = "<?php 
        echo  $tab ;
        ?>";
    if( !jQuery(class1).prop('checked')<?php 
        if ( $class2 ) {
            ?> && !jQuery(class2).prop('checked')<?php 
        }
        ?> ) {
      jQuery(tabid).hide();
    } else {
      jQuery(tabid).show();
    }
    jQuery(class1).on('change', function() {
      if(jQuery(class1).prop('checked')<?php 
        if ( $class2 ) {
            ?> || jQuery(class2).prop('checked')<?php 
        }
        ?> ) {
        jQuery(tabid).show();
      } else {
        jQuery(tabid).hide();
      }
    });
    <?php 
        if ( $class2 ) {
            ?>
    jQuery(class2).on('change', function() {
      if(jQuery(class1).prop('checked') || jQuery(class2).prop('checked')) {
        jQuery(tabid).show();
      } else {
        jQuery(tabid).hide();
      }
    });
    <?php 
        }
        ?>
  });
  </script>
  <?php 
    }

}
/**
 * Function to create show hide toggle
 *
 */
if ( !function_exists( 'wcu_admin_settings_showhide_toggle' ) ) {
    function wcu_admin_settings_showhide_toggle(
        $buttonid,
        $sectionid,
        $show,
        $hide
    )
    {
        ?>
    <script>
    jQuery(document).ready(function() {
      jQuery('#<?php 
        echo  $buttonid ;
        ?>').click(function() {
        jQuery( "#<?php 
        echo  $sectionid ;
        ?>" ).toggle();
        if(jQuery('#<?php 
        echo  $sectionid ;
        ?>:visible').length == 0) {
          jQuery( "#<?php 
        echo  $buttonid ;
        ?>" ).html("<?php 
        echo  $show ;
        ?> <span class='fa-solid fa-arrow-down'></span>");
        } else {
          jQuery( "#<?php 
        echo  $buttonid ;
        ?>" ).html("<?php 
        echo  $hide ;
        ?> <span class='fa-solid fa-arrow-up'></span>");
        }
      });
    });
    </script>
  <?php 
    }

}