<?php

if ( !defined( 'ABSPATH' ) ) {
    exit;
}
function wcusage_field_cb_registration( $args )
{
    $options = get_option( 'wcusage_options' );
    ?>

	<div id="registration-settings" class="settings-area" <?php 
    if ( !wcu_fs()->can_use_premium_code() ) {
        ?>title="Available with Pro version." style="pointer-events:none; opacity: 0.6;"<?php 
    }
    ?>>

	<?php 
    
    if ( !wcu_fs()->can_use_premium_code() ) {
        ?><p><strong style="color: green;"><?php 
        echo  __( 'Available with Pro version.', 'woo-coupon-usage' ) ;
        ?></strong></p><?php 
    }
    
    ?>

	<h1><?php 
    echo  __( 'Affiliate Registration', 'woo-coupon-usage' ) ;
    ?> (Pro)</h1>

  <hr/>

  <p>- <?php 
    echo  __( 'Affiliate registration will allow your users to easily register to become affiliate, and create an affiliate coupon for themselves.', 'woo-coupon-usage' ) ;
    ?> <a href="https://couponaffiliates.com/docs/pro-affiliate-registration" target="_blank"><?php 
    echo  __( 'Learn More', 'woo-coupon-usage' ) ;
    ?></a>.</p>

  <p>- <?php 
    echo  __( 'They can enter their account details, preferred coupon code, then submit the application.', 'woo-coupon-usage' ) ;
    ?></p>

  <p>- <?php 
    echo  __( 'As an admin, you can then view all affiliate applications, and approve/deny them. This will then automatically create the coupon, and assign that user to it.', 'woo-coupon-usage' ) ;
    ?></p>

  <p>- <?php 
    echo  __( 'Email notifications will be sent to both admins and users on affiliate registration, and approval.', 'woo-coupon-usage' ) ;
    ?></p>

  <br/>

  <p>- <strong><?php 
    echo  __( 'To get started with affiliate registration, you will need to add this shortcode to a NEW page:', 'woo-coupon-usage' ) ;
    ?> <span style="color: red;">[couponaffiliates-register]</span></strong></p>

  <p>- <strong><?php 
    echo  __( 'Please do not add this shortcode to the same page as your affiliate dashboard shortcode.', 'woo-coupon-usage' ) ;
    ?></p>

  <p>- <strong><?php 
    echo  __( 'The registration form will also be shown on the affiliate dashboard page (if selected below) for users that are not already an affiliate.', 'woo-coupon-usage' ) ;
    ?></p>

	<br/><hr/>

    <!-- Enable Affiliate Registration Features -->
    <?php 
    echo  wcusage_setting_toggle_option(
        'wcusage_field_registration_enable',
        1,
        __( 'Enable Affiliate Registration Features', 'woo-coupon-usage' ),
        '0px'
    ) ;
    ?>
    <i><?php 
    echo  __( 'This will enable the coupon affiliate registration features on your website.', 'woo-coupon-usage' ) ;
    ?></i><br/>

    <?php 
    echo  wcusage_setting_toggle( '.wcusage_field_registration_enable', '.wcu-field-section-registration-settings' ) ;
    // Show or Hide
    ?>
    <span class="wcu-field-section-registration-settings">

      <br/><hr/>

      <h3><span class="dashicons dashicons-admin-generic" style="margin-top: 2px;"></span> <?php 
    echo  __( 'Template Coupon', 'woo-coupon-usage' ) ;
    ?> <span style="color: red;"><?php 
    echo  __( '(Required)', 'woo-coupon-usage' ) ;
    ?></span></h3>

      <p>
  		  <a href="/wp-admin/post-new.php?post_type=shop_coupon" target="_blank"><?php 
    echo  __( 'Create a coupon code', 'woo-coupon-usage' ) ;
    ?></a>, <?php 
    echo  __( 'as a template (with the default settings you would like) and enter the code below.', 'woo-coupon-usage' ) ;
    ?><br/>
  		  <?php 
    echo  __( 'Then, whenever you accept an affiliate application, a new coupon code will be created with the same settings as the template coupon for the affiliate.', 'woo-coupon-usage' ) ;
    ?><br/>
  		  <?php 
    echo  __( 'The only fields that will be modified are the "Coupon Code", "Affiliate User", and "Unpaid Commission". All other settings are copied over.', 'woo-coupon-usage' ) ;
    ?>
      </p>

      <br/>

      <?php 
    ?>
      <!-- Template coupon code for new affiliate coupon generation -->
      <?php 
    echo  wcusage_setting_text_option(
        'wcusage_field_registration_coupon_template',
        '',
        __( 'Template coupon code:', 'woo-coupon-usage' ),
        '0px'
    ) ;
    ?>
      <i><?php 
    echo  __( 'Make sure this matches the exact name of an existing template coupon code, otherwise the coupon may not be created automatically.', 'woo-coupon-usage' ) ;
    ?> <?php 
    echo  __( 'Must be unique, exact and case sensitive.', 'woo-coupon-usage' ) ;
    ?></i><br/>

      <br/>
      <hr/>

      <h3><span class="dashicons dashicons-admin-generic" style="margin-top: 2px;"></span> <?php 
    echo  __( 'Registration Settings', 'woo-coupon-usage' ) ;
    ?></h3>

      <!-- Automatically accept all affiliate applications. -->
      <?php 
    echo  wcusage_setting_toggle_option(
        'wcusage_field_registration_auto_accept',
        0,
        __( 'Automatically accept all affiliate applications.', 'woo-coupon-usage' ),
        '0px'
    ) ;
    ?>
      <i><?php 
    echo  __( 'With this enabled, affiliate registrations will be automatically accepted (and coupon auto-created instantly), instead of manual approval.', 'woo-coupon-usage' ) ;
    ?></i><br/>

      <br/>

      <!-- Allow logged out users to register for an affiliate coupon. -->
      <?php 
    echo  wcusage_setting_toggle_option(
        'wcusage_field_registration_enable_logout',
        1,
        __( 'Allow logged out users to register for an affiliate coupon.', 'woo-coupon-usage' ),
        '0px'
    ) ;
    ?>
      <i><?php 
    echo  __( 'With this enabled, logged out users can view the registration form (with some extra fields). When submitted it will create a new account for them, and submit the affiliate application.', 'woo-coupon-usage' ) ;
    ?></i><br/>
      <i><?php 
    echo  __( 'With this disabled, only logged in users can apply.', 'woo-coupon-usage' ) ;
    ?></i><br/>

      <?php 
    echo  wcusage_setting_toggle( '.wcusage_field_registration_enable_logout', '.wcu-field-section-registration-enable-login' ) ;
    // Show or Hide
    ?>
    	<span class="wcu-field-section-registration-enable-login">

        <br/>

        <!-- Show registration form on affiliate page for logged out users. -->
        <?php 
    echo  wcusage_setting_toggle_option(
        'wcusage_field_registration_enable_login',
        1,
        __( 'Show registration form on affiliate dashboard page for logged out users.', 'woo-coupon-usage' ),
        '0px'
    ) ;
    ?>
        <i><?php 
    echo  __( 'This will show the affiliate application/registration form automatically on the affiliate page for logged out users (alongside the login form).', 'woo-coupon-usage' ) ;
    ?></i><br/>

      </span>

      <br/>

      <!-- Show registration form on affiliate page for logged in users -->
      <?php 
    echo  wcusage_setting_toggle_option(
        'wcusage_field_registration_enable_register_loggedin',
        1,
        __( 'Show registration form on affiliate dashboard page for logged in users - if they are not assigned to any coupons.', 'woo-coupon-usage' ),
        '0px'
    ) ;
    ?>
      <i><?php 
    echo  __( 'If the user is not already registered as an affilaite and has no active coupons, this will show the registration from on the affiliate dashboard page.', 'woo-coupon-usage' ) ;
    ?></i><br/>

      <br/>

      <!-- Disable form for existing affiliates -->
      <?php 
    echo  wcusage_setting_toggle_option(
        'wcusage_field_registration_disable_existing',
        1,
        __( 'Disable registration form for existing affiliate users.', 'woo-coupon-usage' ),
        '0px'
    ) ;
    ?>
      <i><?php 
    echo  __( 'If enabled, then the registration form shortcode will be disabled/hidden for any affiliate user that is already assigned to an affiliate coupon.', 'woo-coupon-usage' ) ;
    ?></i><br/>

      <?php 
    $wcusage_field_registration_enable_admincan = wcusage_get_setting_value( 'wcusage_field_registration_enable_admincan', '0' );
    ?>
      <?php 
    
    if ( $wcusage_field_registration_enable_admincan ) {
        ?>
      <br/>
      <!-- Allow administrator users to fill out the registration form for new users. -->
      <?php 
        echo  wcusage_setting_toggle_option(
            'wcusage_field_registration_enable_admincan',
            0,
            __( 'Allow administrator users to fill out the registration form for new users.', 'woo-coupon-usage' ),
            '0px'
        ) ;
        ?>
      <i><?php 
        echo  __( 'With this enabled, "administrator" users will be able to fill out the affiliate registration form for new users (custom username/email etc), whilst logged in.', 'woo-coupon-usage' ) ;
        ?></i><br/>
      <i><?php 
        echo  __( 'As an admin, you can also manually add new affiliate registrations easily in the "Registrations" admin page, via the "Create New Registration" button.', 'woo-coupon-usage' ) ;
        ?></i><br/>
      <?php 
    }
    
    ?>

      <br/><hr/>

      <h3><span class="dashicons dashicons-admin-generic" style="margin-top: 2px;"></span> <?php 
    echo  __( '"Coupon Affiliate" User Role', 'woo-coupon-usage' ) ;
    ?></h3>

      <!-- Upon new registration, assign user to custom "coupon affiliate" user role. -->
      <?php 
    echo  wcusage_setting_toggle_option(
        'wcusage_field_register_role',
        1,
        __( 'Upon new registration, assign user to custom "coupon affiliate" user role.', 'woo-coupon-usage' ),
        '0px'
    ) ;
    ?>
      <i><?php 
    echo  __( 'With this enabled, instead of using the default WordPress "subscriber" user role, new affiliate users will be assigned to the custom "coupon affiliate" user role (or the custom role defined below) instead.', 'woo-coupon-usage' ) ;
    ?></i><br/>

      <br/>

      <?php 
    echo  wcusage_setting_toggle( '.wcusage_field_register_role', '.wcu-field-section-registration-accepted-role' ) ;
    // Show or Hide
    ?>
      <span class="wcu-field-section-registration-accepted-role">
        <p>

          <!-- DROPDOWN - Accepted Affiliate User Role -->
    			<strong><?php 
    echo  __( 'Accepted Affiliate User Role', 'woo-coupon-usage' ) ;
    ?>:</strong><br/>
          <?php 
    $wcusage_field_registration_accepted_role = wcusage_get_setting_value( 'wcusage_field_registration_accepted_role', 'coupon_affiliate' );
    ?>
          <select name="wcusage_options[wcusage_field_registration_accepted_role]" id="wcusage_field_registration_accepted_role" class="wcusage_field_registration_accepted_role">
            <?php 
    $r1 = "";
    $editable_roles = array_reverse( get_editable_roles() );
    foreach ( $editable_roles as $role => $details ) {
        
        if ( $role != 'administrator' && $role != 'editor' && $role != 'author' && $role != 'shop_manager' ) {
            $name = translate_user_role( $details['name'] );
            
            if ( $wcusage_field_registration_accepted_role === $role ) {
                $r1 .= "\n\t<option selected='selected' value='" . esc_attr( $role ) . "'>{$name}</option>";
            } else {
                $r1 .= "\n\t<option value='" . esc_attr( $role ) . "'>{$name}</option>";
            }
        
        }
    
    }
    echo  $r1 ;
    ?>
          </select>

        </p>
        <br/>
      </span>

      <!-- Set a different user role for pending affiliate users. -->
      <?php 
    echo  wcusage_setting_toggle_option(
        'wcusage_field_register_role_only_accept',
        0,
        __( 'Set a different user role for pending affiliate users.', 'woo-coupon-usage' ),
        '0px'
    ) ;
    ?>
      <i><?php 
    echo  __( 'With this enabled, the new user account created will be assigned to the default "Subscriber" role (or the custom role defined below) initially, and only when their affiliate application is accepted will they be assigned to the "coupon affiliate" user role instead.', 'woo-coupon-usage' ) ;
    ?></i><br/>

      <br/>

      <?php 
    echo  wcusage_setting_toggle( '.wcusage_field_register_role_only_accept', '.wcu-field-section-registration-pending-role' ) ;
    // Show or Hide
    ?>
      <span class="wcu-field-section-registration-pending-role">
        <p>

          <!-- DROPDOWN - Pending Affiliate User Role -->
    			<strong><?php 
    echo  __( 'Pending Affiliate User Role', 'woo-coupon-usage' ) ;
    ?>:</strong><br/>
          <?php 
    $wcusage_field_registration_pending_role = wcusage_get_setting_value( 'wcusage_field_registration_pending_role', 'subscriber' );
    ?>
          <select name="wcusage_options[wcusage_field_registration_pending_role]" id="wcusage_field_registration_pending_role" class="wcusage_field_registration_pending_role">
            <?php 
    $r2 = "";
    $editable_roles = array_reverse( get_editable_roles() );
    foreach ( $editable_roles as $role => $details ) {
        
        if ( $role != 'administrator' && $role != 'editor' && $role != 'author' && $role != 'shop_manager' ) {
            $name = translate_user_role( $details['name'] );
            // Preselect specified role.
            
            if ( $wcusage_field_registration_pending_role === $role ) {
                $r2 .= "\n\t<option selected='selected' value='" . esc_attr( $role ) . "'>{$name}</option>";
            } else {
                $r2 .= "\n\t<option value='" . esc_attr( $role ) . "'>{$name}</option>";
            }
        
        }
    
    }
    echo  $r2 ;
    ?>
          </select>

        </p>

        <br/>

        <!-- Remove the pending affiliate role from user when their affiliate application is accepted. -->
        <?php 
    echo  wcusage_setting_toggle_option(
        'wcusage_field_register_role_remove_pending',
        1,
        __( 'Remove the pending affiliate role from user when their affiliate application is accepted.', 'woo-coupon-usage' ),
        '0px'
    ) ;
    ?>
        <i><?php 
    echo  __( 'With this enabled, the pending user role will be removed from the affiliate when the application is accepted.', 'woo-coupon-usage' ) ;
    ?></i><br/>

        <br/>

      </span>

      <hr/>

      <h3><span class="dashicons dashicons-admin-generic" style="margin-top: 2px;"></span> <?php 
    echo  __( 'Email Notifications', 'woo-coupon-usage' ) ;
    ?></h3>

      <p>
  		  <?php 
    echo  __( 'To manage (and enable) email notifications for affiliate applications, go to the "Emails" settings tab.', 'woo-coupon-usage' ) ;
    ?>
  		</p>

    <br/><hr/>

    <h3><span class="dashicons dashicons-admin-generic" style="margin-top: 2px;"></span> <?php 
    echo  __( 'Dynamic Code Generator', 'woo-coupon-usage' ) ;
    ?></h3>

    <p><?php 
    echo  __( 'By default, a required "preferred coupon code" field will be shown on the registration form for the affiliate to enter their prefered coupon code name.', 'woo-coupon-usage' ) ;
    ?></p>
    <p><?php 
    echo  __( 'When they submit the affiliate registration form you can then view and edit the coupon code they have entered, before approving the affiliate registration.', 'woo-coupon-usage' ) ;
    ?></p>
    <p><?php 
    echo  __( 'Alternatively, enable the option below to disable this field and generate a specific code automatically via a merge tag template.', 'woo-coupon-usage' ) ;
    ?></p>

    <br/>

    <!-- Automatically generate coupon code? -->
    <?php 
    echo  wcusage_setting_toggle_option(
        'wcusage_field_registration_auto_coupon',
        0,
        __( 'Generate a unique coupon automatically.', 'woo-coupon-usage' ),
        '0px'
    ) ;
    ?>
    <i><?php 
    echo  __( 'With this enabled, instead of the user entering their "preferred coupon code", a code will be generated for them automatically.', 'woo-coupon-usage' ) ;
    ?></i><br/>
    <i><?php 
    echo  __( 'You will still be able to review and edit the generated code before approving.', 'woo-coupon-usage' ) ;
    ?></i>

    <br/>

    <?php 
    echo  wcusage_setting_toggle( '.wcusage_field_registration_auto_coupon', '.wcu-field-section-registration-auto-coupon-text' ) ;
    // Show or Hide
    ?>
    <span class="wcu-field-section-registration-auto-coupon-text">
      <!-- Coupon Format Field -->
      <br/>
      <?php 
    echo  wcusage_setting_text_option(
        'wcusage_field_registration_auto_coupon_format',
        '{username}{amount}',
        __( 'Coupon Format', 'woo-coupon-usage' ),
        '0px'
    ) ;
    ?>

      <?php 
    $template_coupon_code = wcusage_get_setting_value( 'wcusage_field_registration_coupon_template', '' );
    
    if ( !empty($template_coupon_code) ) {
        $template_coupon_info = wcusage_get_coupon_info( $template_coupon_code );
        $template_coupon_id = $template_coupon_info[2];
        $template_coupon_amount = get_post_meta( $template_coupon_id, 'coupon_amount', true );
    } else {
        $template_coupon_amount = "10";
    }
    
    ?>

      <script>
      jQuery( document ).ready(function() {
        wcusage_update_example_coupon();
      });
      jQuery('#wcusage_field_registration_auto_coupon_format').on('input', wcusage_update_example_coupon );
      function wcusage_update_example_coupon() {
        var couponexample = jQuery('#wcusage_field_registration_auto_coupon_format').val();
        var couponexample = couponexample.replace("{username}", "JOHN");
        var couponexample = couponexample.replace("{amount}", "<?php 
    echo  $template_coupon_amount ;
    ?>");
        var couponexample = couponexample.replace("{random}", "KPQS9JY");
        jQuery('#coupon_format_example').text(couponexample);
      }
      </script>
      <p><strong>Example code:</strong> <span id="coupon_format_example"></span></p>
      <br/>Merge tags:
      <br/><strong>{username}</strong> - The affiliate's username, for example "JOHN".
      <br/><strong>{amount}</strong> - The discount amount the coupon gives for example "<?php 
    echo  $template_coupon_amount ;
    ?>" (if it was a "<?php 
    echo  $template_coupon_amount ;
    ?>% off" or "$<?php 
    echo  $template_coupon_amount ;
    ?> off" discount code).
      <br/><strong>{random}</strong> - A randomly generated 7 letter/number phrase for example "KPQS9JY". Unique every time.
      <br/>You can also place your own custom text in the format before, after or inbetween the merge tags.
      <br/>

    </span>

    <br/><hr/>

    <h3><span class="dashicons dashicons-admin-generic" style="margin-top: 2px;"></span> <?php 
    echo  __( 'Email Address / Username Fields', 'woo-coupon-usage' ) ;
    ?></h3>

    <!-- Use the email address as username. -->
    <?php 
    echo  wcusage_setting_toggle_option(
        'wcusage_field_registration_emailusername',
        0,
        __( 'Use the email address as username.', 'woo-coupon-usage' ),
        '0px'
    ) ;
    ?>
    <i><?php 
    echo  __( 'With this enabled, the username field will be hidden, and the email address will be used as their username instead.', 'woo-coupon-usage' ) ;
    ?></i><br/>

    <br/><hr/>

    <h3><span class="dashicons dashicons-admin-generic" style="margin-top: 2px;"></span> <?php 
    echo  __( 'Extra Fields', 'woo-coupon-usage' ) ;
    ?></h3>

    <!-- Show "Website" field on affiliate application form. -->
    <?php 
    echo  wcusage_setting_toggle_option(
        'wcusage_field_registration_enable_website',
        0,
        __( '"Website" Field', 'woo-coupon-usage' ),
        '0px'
    ) ;
    ?>

    <?php 
    echo  wcusage_setting_toggle( '.wcusage_field_registration_enable_website', '.wcu-field-section-registration-website-text' ) ;
    // Show or Hide
    ?>
    <span class="wcu-field-section-registration-website-text" style="margin-top: 7px; display: block;">
      <!-- Website field label -->
      <?php 
    echo  wcusage_setting_text_option(
        'wcusage_field_registration_website_text',
        'Your Website',
        '',
        '0px'
    ) ;
    ?>
    </span>

    <br/>

    <!-- Show "How will you promote us?" field on affiliate application form. -->
    <?php 
    echo  wcusage_setting_toggle_option(
        'wcusage_field_registration_enable_promote',
        0,
        __( '"How will you promote us?" Field', 'woo-coupon-usage' ),
        '0px'
    ) ;
    ?>

    <?php 
    echo  wcusage_setting_toggle( '.wcusage_field_registration_enable_promote', '.wcu-field-section-registration-promote-text' ) ;
    // Show or Hide
    ?>
    <span class="wcu-field-section-registration-promote-text" style="margin-top: 7px; display: block;">
      <!-- Promote field label -->
      <?php 
    echo  wcusage_setting_text_option(
        'wcusage_field_registration_promote_text',
        'How will you promote us?',
        '',
        '0px'
    ) ;
    ?>
    </span>

    <br/>

    <!-- Show "How did you hear about us?" field on affiliate application form. -->
    <?php 
    echo  wcusage_setting_toggle_option(
        'wcusage_field_registration_enable_referrer',
        0,
        __( '"How did you hear about us?" Field', 'woo-coupon-usage' ),
        '0px'
    ) ;
    ?>

    <?php 
    echo  wcusage_setting_toggle( '.wcusage_field_registration_enable_referrer', '.wcu-field-section-registration-referrer-text' ) ;
    // Show or Hide
    ?>
    <span class="wcu-field-section-registration-referrer-text" style="margin-top: 7px; display: block;">
      <!-- Referrer field label -->
      <?php 
    echo  wcusage_setting_text_option(
        'wcusage_field_registration_referrer_text',
        'How did you hear about us?',
        '',
        '0px'
    ) ;
    ?>
    </span>

    <br/><hr/>

    <h3><span class="dashicons dashicons-admin-generic" style="margin-top: 2px;"></span> <?php 
    echo  __( 'Form Styling / Customisations', 'woo-coupon-usage' ) ;
    ?></h3>

    <p>
  		<?php 
    $wcusage_field_form_style = wcusage_get_setting_value( 'wcusage_field_form_style', '1' );
    ?>
  		<input type="hidden" value="0" id="wcusage_field_form_style" data-custom="custom" name="wcusage_options[wcusage_field_form_style]" >
  		<strong><label for="scales"><?php 
    echo  __( 'Form Style', 'woo-coupon-usage' ) ;
    ?>:</label></strong><br/>
  		<select name="wcusage_options[wcusage_field_form_style]" id="wcusage_field_form_style" class="wcusage_field_form_style">
        <option value="1" <?php 
    if ( $wcusage_field_form_style == "1" ) {
        ?>selected<?php 
    }
    ?>><?php 
    echo  __( 'Style #1 - Default', 'woo-coupon-usage' ) ;
    ?></option>
  			<option value="2" <?php 
    if ( $wcusage_field_form_style == "2" ) {
        ?>selected<?php 
    }
    ?>><?php 
    echo  __( 'Style #2 - Modern (Bold)', 'woo-coupon-usage' ) ;
    ?></option>
  			<option value="3" <?php 
    if ( $wcusage_field_form_style == "3" ) {
        ?>selected<?php 
    }
    ?>><?php 
    echo  __( 'Style #3 - Modern (Compact)', 'woo-coupon-usage' ) ;
    ?></option>
      </select>
    </p>

    <br/>

    <!-- Use the email address as username. -->
    <?php 
    echo  wcusage_setting_toggle_option(
        'wcusage_field_form_style_columns',
        0,
        __( 'Enable 2 Column Layout', 'woo-coupon-usage' ),
        '0px'
    ) ;
    ?>
    <i><?php 
    echo  __( 'With this enabled, some of the fields on the form will be displayed in 2 columns, such as first and last name.', 'woo-coupon-usage' ) ;
    ?></i><br/>

    <br/>

    <!-- Form Title -->
    <?php 
    echo  wcusage_setting_text_option(
        'wcusage_field_registration_form_title',
        '',
        __( 'Custom Registration Form Title', 'woo-coupon-usage' ),
        '0px'
    ) ;
    ?>
    <i><?php 
    echo  __( 'Default', 'woo-coupon-usage' ) ;
    ?>: <?php 
    echo  __( 'Register New Affiliate Account', 'woo-coupon-usage' ) ;
    ?></i><br/>

    <br/>

    <!-- Submit button text field label -->
    <?php 
    echo  wcusage_setting_text_option(
        'wcusage_field_registration_submit_button_text',
        '',
        __( 'Custom Submit Button Text', 'woo-coupon-usage' ),
        '0px'
    ) ;
    ?>
    <i><?php 
    echo  __( 'Default', 'woo-coupon-usage' ) ;
    ?>: <?php 
    echo  __( 'Submit Application', 'woo-coupon-usage' ) ;
    ?></i><br/>

    <br/><hr/>

    <h3><span class="dashicons dashicons-admin-generic" style="margin-top: 2px;"></span> <?php 
    echo  __( 'Terms and Conditions Notice', 'woo-coupon-usage' ) ;
    ?></h3>

    <!-- Enable terms acceptance checkbox on affiliate registration form. -->
    <?php 
    echo  wcusage_setting_toggle_option(
        'wcusage_field_registration_enable_terms',
        0,
        __( 'Enable terms acceptance checkbox on affiliate registration form.', 'woo-coupon-usage' ),
        '0px'
    ) ;
    ?>

    <style>
    #wcusage_field_registration_terms_message_ifr { height: 60px !important; }
    </style>
    <?php 
    echo  wcusage_setting_toggle( '.wcusage_field_registration_enable_terms', '.wcu-field-section-registration-terms-message' ) ;
    // Show or Hide
    ?>
    <div class="wcu-field-section-registration-terms-message">
      <br/
      <!-- Terms and Conditions Message -->
      <?php 
    $terms1message = wcusage_get_setting_value( 'wcusage_field_registration_terms_message', 'I have read and agree to the Affiliate Terms and Privacy Policy.' );
    echo  wcusage_setting_tinymce_option(
        'wcusage_field_registration_terms_message',
        $terms1message,
        "Terms and Conditions Message",
        '0px'
    ) ;
    ?>
      <i><?php 
    echo  __( 'Enter your terms acceptance message. Make sure you edit the message to include links to your terms and privacy policy!', 'woo-coupon-usage' ) ;
    ?></i><br/>
    </div>

    <br/><hr/>

    <h3><span class="dashicons dashicons-admin-generic" style="margin-top: 2px;"></span> <?php 
    echo  __( 'Form Submission', 'woo-coupon-usage' ) ;
    ?></h3>

    <!-- DROPDOWN - Select submission complete type -->
    <p>
  		<?php 
    $wcusage_field_registration_submit_type = wcusage_get_setting_value( 'wcusage_field_registration_submit_type', 'message' );
    ?>
  		<input type="hidden" value="0" id="wcusage_field_registration_submit_type" data-custom="custom" name="wcusage_options[wcusage_field_registration_submit_type]" >
  		<strong><label for="scales"><?php 
    echo  __( 'What should happen after form submission?', 'woo-coupon-usage' ) ;
    ?></label></strong><br/>
  		<select name="wcusage_options[wcusage_field_registration_submit_type]" id="wcusage_field_registration_submit_type" class="wcusage_field_registration_submit_type">
        <option value="message" <?php 
    if ( $wcusage_field_registration_submit_type == "message" ) {
        ?>selected<?php 
    }
    ?>><?php 
    echo  __( 'Show a message on the same page.', 'woo-coupon-usage' ) ;
    ?></option>
  			<option value="redirect" <?php 
    if ( $wcusage_field_registration_submit_type == "redirect" ) {
        ?>selected<?php 
    }
    ?>><?php 
    echo  __( 'Redirect to a different page.', 'woo-coupon-usage' ) ;
    ?></option>
      </select>
    </p>

    <br/>
    <script>
    jQuery('.wcusage_field_registration_submit_type').change(function() {
      wcusage_js_registration_type_change();
    });
    jQuery( document ).ready(function() {
      wcusage_js_registration_type_change();
    });
    function wcusage_js_registration_type_change() {
      jQuery('.section-registration-type-message').hide();
      jQuery('.section-registration-type-redirect').hide();
      if( jQuery('.wcusage_field_registration_submit_type :selected' ).val() == 'message' ){
        jQuery('.section-registration-type-message').show();
        jQuery('.section-registration-type-redirect').hide();
      }
      if(jQuery('.wcusage_field_registration_submit_type :selected' ).val() == 'redirect' ){
        jQuery('.section-registration-type-message').hide();
        jQuery('.section-registration-type-redirect').show();
      }
    }
    </script>
    <div class="section-registration-type-message">
      <style>
      #wcusage_field_registration_accept_message_ifr { height: 60px !important; }
      </style>
      <!-- Message -->
      <?php 
    $terms2message = wcusage_get_setting_value( 'wcusage_field_registration_accept_message', 'Your affiliate application for the coupon code "{coupon}" has been submitted. Please check your email.' );
    echo  wcusage_setting_tinymce_option(
        'wcusage_field_registration_accept_message',
        $terms2message,
        'Message',
        '0px'
    ) ;
    ?>
      <i><?php 
    echo  __( 'This is the message shown on the page as soon as the user submits the application form. The {couponcode} placeholder will be replaced with their chosen coupon code.', 'woo-coupon-usage' ) ;
    ?></i><br/>
      <br/>
    </div>

    <!-- DROPDOWN - Redirect to page -->
    <div class="section-registration-type-redirect">
      <p>
        <strong><?php 
    echo  __( 'Redirect to Page:', 'woo-coupon-usage' ) ;
    ?></strong><br/>
        <?php 
    $dashboardpage = "";
    
    if ( isset( $options['wcusage_field_registration_accept_redirect'] ) ) {
        $dashboardpage = $options['wcusage_field_registration_accept_redirect'];
    } else {
        $dashboardpage = wcusage_get_coupon_shortcode_page_id();
    }
    
    $dropdown_args = array(
        'post_type'        => 'page',
        'selected'         => $dashboardpage,
        'name'             => 'wcusage_options[wcusage_field_registration_accept_redirect]',
        'id'               => 'wcusage_field_registration_accept_redirect',
        'value_field'      => 'wcusage_field_registration_accept_redirect',
        'show_option_none' => '-',
    );
    wp_dropdown_pages( $dropdown_args );
    ?>
        <br/>
      </p>
      <br/>
    </div>

    <hr/>

    <h3><span class="dashicons dashicons-admin-generic" style="margin-top: 2px;"></span> <?php 
    echo  __( 'Checkout Page: Join Affiliate Program', 'woo-coupon-usage' ) ;
    ?></h3>

    <!-- Join affiliate program checkbox -->
    <?php 
    echo  wcusage_setting_toggle_option(
        'wcusage_field_registration_checkout_checkbox',
        0,
        __( 'Show a "join our affiliate program" checkbox on the store checkout.', 'woo-coupon-usage' ),
        '0px'
    ) ;
    ?>
    <i><?php 
    echo  __( 'When enabled, a new checkbox will appear on store checkout, under order notes, for them to join the affiliate program. This will submit an affiliate registration application for the user.', 'woo-coupon-usage' ) ;
    ?></i><br/>
    <i><?php 
    echo  __( 'Note: This will only show for users that are not currently assigned to any affiliate coupons. They must also be logged in, or have selected "Create an account?" for it to show.', 'woo-coupon-usage' ) ;
    ?></i><br/>

    <?php 
    echo  wcusage_setting_toggle( '.wcusage_field_registration_checkout_checkbox', '.wcu-field-section-checkout-checkbox-text' ) ;
    // Show or Hide
    ?>
    <span class="wcu-field-section-checkout-checkbox-text">
      <br/>
      <!-- Checkout checkbox label -->
      <?php 
    echo  wcusage_setting_text_option(
        'wcusage_field_registration_checkout_checkbox_text',
        'Click here to join our affiliate program',
        __( 'Checkbox label', 'woo-coupon-usage' ),
        '0px'
    ) ;
    ?>
      <br/>
      <!-- Join affiliate program checked by default? -->
      <?php 
    echo  wcusage_setting_toggle_option(
        'wcusage_field_registration_checkout_checkbox_checked',
        0,
        __( 'Checkbox ticked by default?', 'woo-coupon-usage' ),
        '0px'
    ) ;
    ?>
      <i><?php 
    echo  __( 'When enabled, the checkbox to join the affiliate program will be checked automatically.', 'woo-coupon-usage' ) ;
    ?></i><br/>
    </span>

    <br/><hr/>

    <h3><span class="dashicons dashicons-admin-generic" style="margin-top: 2px;"></span> <?php 
    echo  __( 'Google reCAPTCHA', 'woo-coupon-usage' ) ;
    ?> (v2)</h3>

    <p>
      <!-- Threshold -->
      <a href="https://www.google.com/recaptcha/admin/create" target="_blank">https://www.google.com/recaptcha/admin/create</a><br/><br/>
      <?php 
    echo  __( 'Setup Google reCAPTCHA on your affiliate registration form to help prevent spam.', 'woo-coupon-usage' ) ;
    ?>
    </p>

    <br/>

    <!-- Site Key -->
    <?php 
    echo  wcusage_setting_text_option(
        'wcusage_registration_recaptcha_key',
        '',
        __( 'Site Key', 'woo-coupon-usage' ),
        '0px'
    ) ;
    ?>

    <br/>

    <!-- Secret Key -->
    <?php 
    echo  wcusage_setting_text_option(
        'wcusage_registration_recaptcha_secret',
        '',
        __( 'Secret Key', 'woo-coupon-usage' ),
        '0px'
    ) ;
    ?>

  </span>

</div>

 <?php 
}
