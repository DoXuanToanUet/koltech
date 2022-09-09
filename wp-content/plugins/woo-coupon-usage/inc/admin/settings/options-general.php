<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function wcusage_field_cb( $args )
{
    $options = get_option( 'wcusage_options' );

    $ispro = ( wcu_fs()->can_use_premium_code() ? 1 : 0 );
    $probrackets = ( $ispro ? "" : " (PRO)" );
    ?>

<div id="general-settings" class="settings-area">

	<h1><?php echo __( "General Settings", "woo-coupon-usage" ); ?></h1>

  <?php
  if ( function_exists('wc_coupons_enabled') ) {
    if ( !wc_coupons_enabled() ) {
      echo "Notice: Coupons have been automatically enabled in your WooCommerce settings.";
      update_option( 'woocommerce_enable_coupons', 'yes' );
    }
  }
  ?>

  <hr/>

  <!-- Dashboard Page -->
  <h3><span class="dashicons dashicons-admin-generic" style="margin-top: 2px;"></span> Dashboard:</h3>
  <?php echo do_action( 'wcusage_hook_setting_section_dashboard_page' ); ?>

  <br/><br/>

  <?php echo wcusage_setting_textarea_option("wcusage_field_text", "", __( 'Custom Text / Information', 'woo-coupon-usage' ), "0px"); ?>
  <i><?php echo __( 'Displayed at top the "statistics" section on the coupon affiliate dashboard page. HTML tags enabled.', 'woo-coupon-usage' ); ?></i><br/>

  <br/><hr/>

  <!-- Assign Affiliates to Coupons -->
  <h3><span class="dashicons dashicons-admin-generic" style="margin-top: 2px;"></span> <?php echo __( 'Assign Affiliates to Coupons', 'woo-coupon-usage' ); ?>:</h3>

  <span class="dashicons dashicons-arrow-right"></span> <?php echo __( 'To assign users to a specific coupon, go to the', 'woo-coupon-usage' ); ?> <a href="<?php echo get_site_url(); ?>/wp-admin/edit.php?post_type=shop_coupon" target="_blank"><?php echo __( 'coupons management page', 'woo-coupon-usage' ); ?></a>, <?php echo __( 'edit a coupon and assign users under the "coupon affiliates" tab', 'woo-coupon-usage' ); ?>.  <a href="https://couponaffiliates.com/docs/how-do-i-assign-users-to-coupons" target="_blank"><?php echo __( 'Learn More.', 'woo-coupon-usage' ); ?></a>
  <br/><br/><span class="dashicons dashicons-arrow-right"></span> <?php echo __( 'The affiliate user can then visit the "affiliate dashboard page" to view their affiliate statistics, commissions, referral URLs, etc, for the coupons they are assigned to.', 'woo-coupon-usage' ); ?>

  <br/><br/><hr/>

  <!-- Assign Affiliates to Coupons -->
  <h3><span class="dashicons dashicons-admin-generic" style="margin-top: 2px;"></span> <?php echo __( '"My Account" Menu Link', 'woo-coupon-usage' ); ?>:</h3>

  <?php echo wcusage_setting_toggle_option('wcusage_field_account_tab', 0, __( 'Add an "Affiliate" menu link to the "My Account" page.', 'woo-coupon-usage' ), '0px'); ?>
  <i><?php echo __( 'With this enabled, a new "Affiliate" link will appear on the users "My Account" page menu. This will take them to the affiliate dashboard page selected above.', 'woo-coupon-usage' ); ?></i>

  <br/><br/><hr/>

  <h3><span class="dashicons dashicons-admin-generic" style="margin-top: 2px;"></span> <?php echo __( 'Affiliate Dashboard - Login Form', 'woo-coupon-usage' ); ?>:</h3>

  <?php echo wcusage_setting_toggle_option('wcusage_field_loginform', 1, __( 'Show WooCommerce login form on affiliate dashboard page when users are logged out.', 'woo-coupon-usage' ), '0px'); ?>
  <i><?php echo __( 'This will allow affiliate users to login to the dashboard if they visit the base dashboard URL.', 'woo-coupon-usage' ); ?></i><br/>

  <br/><hr/>

  <!-- Order/Sales Tracking -->
  <h3><span class="dashicons dashicons-admin-generic" style="margin-top: 2px;"></span> Order/Sales Tracking:</h3>
  <?php echo do_action('wcusage_hook_setting_section_ordersalestracking'); ?>

  <br/><hr/>

  <!-- Affiliate Dashboard - Orders List -->
  <h3><span class="dashicons dashicons-admin-generic" style="margin-top: 2px;"></span> <?php echo __( 'Affiliate Dashboard - Orders List', 'woo-coupon-usage' ); ?>:</h3>

	<i><?php echo __( 'Customise what data is shown on the coupon affiliate dashboard.', 'woo-coupon-usage' ); ?></i>

  	<br/><br/>

    <!-- Show order ID in orders list. -->
    <?php echo wcusage_setting_toggle_option('wcusage_field_orderid', 0, __( 'Show order ID in orders list.', 'woo-coupon-usage' ), '0px'); ?>
    <i><?php echo __( 'If the user is an admin, then the ID will also be clickable to open the order page in the backend.', 'woo-coupon-usage' ); ?></i><br/>

  	<br/>

    <!-- Show order "status" in orders list. -->
    <?php echo wcusage_setting_toggle_option('wcusage_field_status', 0, __( 'Show order "status" in orders list.', 'woo-coupon-usage' ), '0px'); ?>

  	<br/>

    <!-- Show order "country" in orders list. -->
    <?php echo wcusage_setting_toggle_option('wcusage_field_ordercountry', 0, __( 'Show order "country" in orders list.', 'woo-coupon-usage' ), '0px'); ?>

  	<br/>

    <!-- Show order "city" in orders list. -->
    <?php echo wcusage_setting_toggle_option('wcusage_field_ordercity', 0, __( 'Show order "city" in orders list.', 'woo-coupon-usage' ), '0px'); ?>

    <br/>

    <!-- Show customer "first name" in orders list. -->
    <?php echo wcusage_setting_toggle_option('wcusage_field_ordername', 0, __( 'Show customer "first name" in orders list.', 'woo-coupon-usage' ), '0px'); ?>

    <br/>

    <!-- Show total order amount. -->
    <?php echo wcusage_setting_toggle_option('wcusage_field_amount', 1, __( 'Show total order amount.', 'woo-coupon-usage' ), '0px'); ?>

  	<br/>

    <!-- Show total discounts. -->
    <?php echo wcusage_setting_toggle_option('wcusage_field_amount_saved', 1, __( 'Show total discounts.', 'woo-coupon-usage' ), '0px'); ?>

  	<br/>

    <!-- Show shipping costs. -->
    <?php echo wcusage_setting_toggle_option('wcusage_field_show_shipping', 0, __( 'Show shipping costs.', 'woo-coupon-usage' ), '0px'); ?>

    <br/>

    <!-- Show list of products for orders. -->
    <?php echo wcusage_setting_toggle_option('wcusage_field_list_products', 1, __( 'Show products summary/list for orders ("MORE" column).', 'woo-coupon-usage' ), '0px'); ?>

    <br/>

    <!-- Show the combined totals for all orders within the selected date range. -->
    <?php echo wcusage_setting_toggle_option('wcusage_field_show_orders_table_totals', 1, __( 'Show the combined totals for all orders within the selected date range.', 'woo-coupon-usage' ), '0px'); ?>
    <i><?php echo __( 'When selected, the totals for all orders within the selected date range will be shown in a new row at the bottom of the recent orders and monthly summary table.', 'woo-coupon-usage' ); ?></i><br/>

    <br/><hr/>

    <h3><span class="dashicons dashicons-admin-generic" style="margin-top: 2px;"></span> <?php echo __( 'Affiliate Dashboard - Statistics Toggles', 'woo-coupon-usage' ); ?>:</h3>

    <!-- Toggle Between Stats Types -->
    <p styel="margin-bottom: -10px;">
			<?php
    $wcusage_field_which_toggle = wcusage_get_setting_value('wcusage_field_which_toggle', '1');
    $checked1 = ( $wcusage_field_which_toggle == '0' ? ' checked="checked"' : '' );
    $checked2 = ( $wcusage_field_which_toggle == '1' || $wcusage_field_which_toggle == '' ? ' checked="checked"' : '' );
    ?>
    <strong><label for="scales"><?php echo __( 'What toggles should be shown for statistics and line graphs?', 'woo-coupon-usage' ); ?></label></strong>
      <br/>
      <label class="switch">
      		<input type="radio" value="0" id="wcusage_field_which_toggle" data-custom="custom" name="wcusage_options[wcusage_field_which_toggle]" <?php
        echo  $checked1;
        ?>>
      <span class="slider round">
        <span class="on"><span class="fa-solid fa-check"></span></span>
        <span class="off"></span>
      </span>
      </label>
			<strong><label for="scales"><?php echo __( 'All-time', 'woo-coupon-usage' ); ?> | <?php echo __( 'Last 30 Days', 'woo-coupon-usage' ); ?> | <?php echo __( 'Last 7 Days', 'woo-coupon-usage' ); ?></label></strong>
      <br/>
      <label class="switch">
          <input type="radio" value="1" id="wcusage_field_which_toggle" data-custom="custom" name="wcusage_options[wcusage_field_which_toggle]" <?php
        echo  $checked2;
        ?>>
      <span class="slider round">
        <span class="on"><span class="fa-solid fa-check"></span></span>
        <span class="off"></span>
      </span>
      </label>
      <strong><label for="scales"><?php echo __( 'All-time', 'woo-coupon-usage' ); ?> | <?php echo __( 'This Month', 'woo-coupon-usage' ); ?> | <?php echo __( 'Last Month', 'woo-coupon-usage' ); ?></label></strong>
		</p>

  <br/><hr/>

  <h3><span class="dashicons dashicons-admin-generic" style="margin-top: 2px;"></span> <?php echo __( 'Affiliate Dashboard - Settings Section', 'woo-coupon-usage' ); ?>:</h3>

  <!-- Show "Settings" tab. -->
  <?php echo wcusage_setting_toggle_option('wcusage_field_show_settings_tab_show', 1, __( 'Show "Settings" tab on the affiliate dashboard.', 'woo-coupon-usage' ), '0px'); ?>

  <br/>

  <!-- Show "Account Details" section in the "Settings" tab. -->
  <?php echo wcusage_setting_toggle_option('wcusage_field_show_settings_tab_account', 1, __( 'Show "Account Details" section in the "Settings" tab.', 'woo-coupon-usage' ), '0px'); ?>
  <i><?php echo __( 'This will show the WooCommerce "Account Details" fields directly in the "settings" tab on the affiliate dashboard, along with a logout link.', 'woo-coupon-usage' ); ?></i>

  <br/><br/><hr/>

  <h3><span class="dashicons dashicons-admin-generic" style="margin-top: 2px;"></span> <?php echo __( 'Affiliate Dashboard - Logout Link', 'woo-coupon-usage' ); ?>:</h3>

  <!-- Show logout link on affiliate dashboard (top right). -->
  <?php echo wcusage_setting_toggle_option('wcusage_field_show_logout_link', 1, __( 'Show logout link on affiliate dashboard (top right).', 'woo-coupon-usage' ), '0px'); ?>

  <br/><hr/>

  <!-- Currency Settings Toggle -->
  <h3><span class="dashicons dashicons-admin-generic" style="margin-top: 2px;"></span> <?php echo __( 'Multi-Currency Settings', 'woo-coupon-usage' ); ?>:</h3>

  <?php echo wcusage_setting_toggle_option('wcusage_field_enable_currency', 0, __( 'Enable "Multi-Currency" Functionality', 'woo-coupon-usage' ), '0px'); ?>

  <?php echo wcusage_setting_toggle('.wcusage_field_enable_currency', '.wcu-field-section-currency'); // Show or Hide ?>
  <span class="wcu-field-section-currency">
    <br/>

    <a href="#" onclick="wcusage_go_to_settings('#tab-currency', '#tab-currency');"
      class="wcu-addons-box-view-details" style="margin-left: 5px;">Click here</a> to manage multi currency settings.

    <br/>
  </span>

  <br/><hr/>

  <div id="pro-settings" class="settings-area" <?php
    if ( !wcu_fs()->can_use_premium_code() ) {
        ?>title="Available with Pro version." style="pointer-events:none; opacity: 0.4;"<?php
    }
    ?>>

    <h3><span class="dashicons dashicons-admin-generic" style="margin-top: 2px;"></span> <?php echo __( 'Line Graphs', 'woo-coupon-usage' ); ?><?php echo $probrackets; ?>:</h3>

    <!-- Show "commission graphs" on the statistics tab. -->
    <?php echo wcusage_setting_toggle_option('wcusage_field_show_graphs', 1, __( 'Show "commission graphs" on the statistics tab.', 'woo-coupon-usage' ), '0px'); ?>
    <i>These are line graphs that show the commission earnings for every day in the past 90 days, 30 days or 7 days.</i><br/>

      <?php echo wcusage_setting_toggle('.wcusage_field_show_graphs', '.wcu-field-section-graphs-column-pick'); // Show or Hide ?>
      <span class="wcu-field-section-graphs-column-pick">

        <br/>

        <!-- Show "All Time" Column. -->
        <?php
        $show_graphs_alltime = wcusage_get_setting_value('wcusage_field_show_graphs_alltime', 1);
        ?>
    		<input type="hidden" value="0" id="wcusage_field_show_graphs_alltime" data-custom="custom" name="wcusage_options[wcusage_field_show_graphs_alltime]" >
    		<strong><label for="scales"><?php echo __( 'What graph should be shown for "All-time" stats toggle?', 'woo-coupon-usage' ); ?></label></strong><br/>
    		<select name="wcusage_options[wcusage_field_show_graphs_alltime]" id="wcusage_field_show_graphs_alltime">
    			<option value="1" <?php if($show_graphs_alltime == 1) { ?>selected<?php } ?>><?php echo __( 'Last 90 Days', 'woo-coupon-usage' ); ?></option>
    			<option value="0" <?php if($show_graphs_alltime == 0) { ?>selected<?php } ?>><?php echo __( 'This Month', 'woo-coupon-usage' ); ?> / <?php echo __( 'Last 30 Days', 'woo-coupon-usage' ); ?></option>
    		</select>

        <br/>

      </span>

	  <br/><hr/>

    <h3 id="wcu-setting-header-monthly-summary"><span class="dashicons dashicons-admin-generic" style="margin-top: 2px;"></span> <?php echo __( 'Monthly Summary Section', 'woo-coupon-usage' ); ?><?php echo $probrackets; ?>:</h3>

    <!-- Show "monthly summary" table section on affiliate dashboard. -->
    <?php echo wcusage_setting_toggle_option('wcusage_field_show_months_table', 1, __( 'Show "monthly summary" table section on affiliate dashboard.', 'woo-coupon-usage' ), '0px'); ?>

    <?php if ( wcu_fs()->can_use_premium_code() ) { ?>
    <?php echo wcusage_setting_toggle('.wcusage_field_show_months_table', '.wcu-field-section-monthly-summary-column-pick'); // Show or Hide ?>
    <span class="wcu-field-section-monthly-summary-column-pick">

      <!-- Show "Month" Column. -->
      <?php echo wcusage_setting_toggle_option('wcusage_field_show_months_table_col_date', 1, __( 'Show "Month" Column.', 'woo-coupon-usage' ), '30px'); ?>

      <!-- Show "Order Count" Column. -->
      <?php echo wcusage_setting_toggle_option('wcusage_field_show_months_table_col_order_count', 1, __( 'Show "Order Count" Column.', 'woo-coupon-usage' ), '30px'); ?>

      <!-- Show "Total Sales" Column. -->
      <?php echo wcusage_setting_toggle_option('wcusage_field_show_months_table_col_order', 1, __( 'Show "Total Sales" Column.', 'woo-coupon-usage' ), '30px'); ?>

      <!-- Show "Discounts" Column. -->
      <?php echo wcusage_setting_toggle_option('wcusage_field_show_months_table_col_discount', 1, __( 'Show "Discounts" Column.', 'woo-coupon-usage' ), '30px'); ?>

      <!-- Show "Total" Column. -->
      <?php echo wcusage_setting_toggle_option('wcusage_field_show_months_table_col_totalwithdiscount', 1, __( 'Show "Total" Column.', 'woo-coupon-usage' ), '30px'); ?>

      <!-- Show "Commission" Column. -->
      <?php echo wcusage_setting_toggle_option('wcusage_field_show_months_table_col_commission', 1, __( 'Show "Commission" Column.', 'woo-coupon-usage' ), '30px'); ?>

      <!-- Show "% Change" Column. -->
      <?php echo wcusage_setting_toggle_option('wcusage_field_show_months_table_col_change', 1, __( 'Show "% Change" Column.', 'woo-coupon-usage' ), '30px'); ?>

      <!-- Show "More" column to show/hide "List of products purchased" section. -->
      <?php echo wcusage_setting_toggle_option('wcusage_field_show_months_table_col_more', 1, __( 'Show "More" Column (Toggle for products summary/list).', 'woo-coupon-usage' ), '30px'); ?>

  		<br/>

      <!-- Default number of months to show -->
      <?php echo wcusage_setting_number_option('wcusage_field_months_table_total', '6', __( 'Default number of months to show', 'woo-coupon-usage' ), '30px'); ?>
      <i style="margin-left: 30px;"><?php echo __( 'How many months to show on the "monthly summary" table by default.', 'woo-coupon-usage' ); ?></i><br/>

    </span>
    <?php } ?>

		<br/><hr/>

    <h3 id="wcu-setting-header-export"><span class="dashicons dashicons-admin-generic" style="margin-top: 2px;"></span> <?php echo __( 'Export to Excel Buttons', 'woo-coupon-usage' ); ?><?php echo $probrackets; ?>:</h3>

    <!-- Enable button to export an Excel file of "monthly summary" table. -->
    <?php echo wcusage_setting_toggle_option('wcusage_field_show_months_table_export', 1, __( 'Enable button to export an Excel file of "monthly summary" table.', 'woo-coupon-usage' ), '0px'); ?>

		<br/>

    <!-- Enable button to export an Excel file of "recent orders" table. -->
    <?php echo wcusage_setting_toggle_option('wcusage_field_show_orders_table_export', 1, __( 'Enable button to export an Excel file of "recent orders" table.', 'woo-coupon-usage' ), '0px'); ?>

	</div>

</div>

 <?php
}

/**
 * Settings Section: Dashboard Page
 *
 */
add_action( 'wcusage_hook_setting_section_dashboard_page', 'wcusage_setting_section_dashboard_page' );
if( !function_exists( 'wcusage_setting_section_dashboard_page' ) ) {
  function wcusage_setting_section_dashboard_page() {

    $options = get_option( 'wcusage_options' );
    ?>

    <?php if (!class_exists('SitePress')) { ?>

      <!-- Dashboard Page Dropdown -->
      <strong><?php echo __( 'Affiliate Dashboard Page:', 'woo-coupon-usage' ); ?><?php if ( !$options['wcusage_dashboard_page'] ) { ?> <span class="dashicons dashicons-warning" title="Important" style="color: red;"></span><?php } ?></strong><br/>
      <?php
      $dashboardpage = "";
      if ( isset($options['wcusage_dashboard_page']) ) {
          //echo "Page: " . $options['wcusage_dashboard_page'] . "<br/>";
          $dashboardpage = $options['wcusage_dashboard_page'];
      } else {
          $dashboardpage = wcusage_get_coupon_shortcode_page_id();
      }
      //echo "test: " . $dashboardpage . "<br/>";
      $dropdown_args = array(
          'post_type'        => 'page',
          'selected'         => $dashboardpage,
          'name'             => 'wcusage_options[wcusage_dashboard_page]',
          'id'               => 'wcusage_dashboard_page',
          'value_field'      => 'wcusage_dashboard_page',
          'show_option_none' => '-',
        );
      wp_dropdown_pages( $dropdown_args );

      echo "<br/>";
      ?>

    <?php } else { ?>

      <!-- Showing number input if WPML installed -->
      <?php echo wcusage_setting_number_option('wcusage_dashboard_page', '', __( 'Affiliate Dashboard Page (ID):', 'woo-coupon-usage' ), '0px'); ?>

    <?php } ?>
    <i><?php echo __( '(The page that has the [couponaffiliates] shortcode on.)', 'woo-coupon-usage' ); ?></i>

  <?php
  }
}

/**
 * Settings Section: Order/Sales Tracking
 *
 */
add_action( 'wcusage_hook_setting_section_ordersalestracking', 'wcusage_setting_section_ordersalestracking', 10, 1 );
if( !function_exists( 'wcusage_setting_section_ordersalestracking' ) ) {
  function wcusage_setting_section_ordersalestracking($type = "") {

  $options = get_option( 'wcusage_options' );
  ?>

    <!-- Recent Orders Number -->
    <?php echo wcusage_setting_number_option('wcusage_field_orders', '10', __( 'Default amount of "latest orders" to show:', 'woo-coupon-usage' ), '0px'); ?>
    <i><?php echo __( 'Amount of orders to show on the affiliate dashboard by default. Enter 0 to disable.', 'woo-coupon-usage' ); ?></i>

    <br/><br/>

    <p class="option_wcusage_field_order_type">
      <?php
      $wcusage_field_order_type = wcusage_get_setting_value('wcusage_field_order_type', '');
      $wcusage_field_order_type_custom = wcusage_get_setting_value('wcusage_field_order_type_custom', '');
      ?>

      <!-- Order Status Type Field -->
      <strong><label for="scales"><?php echo __( 'Required order status to show on affiliate dashboard:', 'woo-coupon-usage' ); ?></label></strong><br/>

        <?php
        $orderstatuses = wc_get_order_statuses();
        $i = 0;
        foreach( $orderstatuses as $key => $status ){

          if($status == "Refunded") {
            if(isset($options['wcusage_field_order_type_custom'][$key])) {
              $current = $options['wcusage_field_order_type_custom'][$key];
            }
            if( !isset($current) ) {
              continue;
            }
          }

          $i++;
          if($i == 1) { $thisid = "wcusage_field_order_type_custom"; }

          $checkedx = "";

          if($wcusage_field_order_type_custom) {
            if( isset($options['wcusage_field_order_type_custom'][$key]) ) {
              // Get Current Input Value
              $current = $options['wcusage_field_order_type_custom'][$key];
              // See if Checked
              if( isset($current) ) {
                $checkedx = "checked";
              }
            }
          }

          // MAKE COMPATIBLE WITH OLD SETTING
          if( ( !$wcusage_field_order_type_custom && $wcusage_field_order_type ) || ( !$wcusage_field_order_type_custom && !$wcusage_field_order_type ) ) {
            if($wcusage_field_order_type == "completed") {
              if($key == "wc-completed") {
                $checkedx = "checked";
              }
            } else {
              if($key == "wc-completed" || $key == "wc-processing") {
                $checkedx = "checked";
              }
            }
          }

          // Force completed to be checked
          if($key == "wc-completed") {
            if($checkedx) {
              $option_group = get_option('wcusage_options');
              $option_group['wcusage_field_order_type_custom']['wc-completed'] = 1;
              update_option( 'wcusage_options', $option_group );
              $checkedx = "checked";
            }
          }

          // Force processing to be checked on first time load settings
          if( !get_option('wcusage_field_order_type_custom_isset') && !isset($options['wcusage_field_load_ajax']) && $key == "wc-processing" ) {
            $option_group = get_option('wcusage_options');
            $option_group['wcusage_field_order_type_custom']['wc-processing'] = 1;
            update_option( 'wcusage_options', $option_group );
            $checkedx = "checked";
          }

          $extrastyles = "";
          if($key == "wc-completed" && $checkedx == "checked") {
            $extrastyles = ' pointer-events: none; opacity: 0.6;';
          }

          // Output Checkbox
          if(!$type) {
            $name = 'wcusage_options[wcusage_field_order_type_custom]['.$key.']';
          } else {
            $name = 'wcusage_field_order_type_custom['.$key.']';
          }
          echo '<span style="margin-right: 20px;'.$extrastyles.'" id="'.$thisid.'"><input type="checkbox" style="'.$extrastyles.'" checktype="multi" class="order-status-checkbox-'.$key.'" checktypekey="'.$key.'" customid="wcusage_field_order_type_custom" class="wcusage_field_order_type_custom" name="'.$name.'" '.$checkedx.'> '.$status.'</span>';


        }
        update_option( 'wcusage_field_order_type_custom_isset', 1 );
        ?>

        <br/><i><?php echo __( 'This will affect the coupon usage stats, orders list, commission, and monthly summary.', 'woo-coupon-usage' ); ?></i>

        <br/><i><?php echo __( 'For "commission payouts" in PRO, for "unpaid commission" to be granted, the order status must be completed, or you can customise this in the "Payouts" settings.', 'woo-coupon-usage' ); ?></i>

    <br/><br/>

    </p>

    <!-- How to sort orders -->
  	<p>
  		<?php $wcusage_field_order_sort = wcusage_get_setting_value('wcusage_field_order_sort', 'paiddate'); ?>
  		<input type="hidden" value="0" id="wcusage_field_order_sort" data-custom="custom" name="wcusage_options[wcusage_field_order_sort]" >

      <script>
      jQuery( document ).ready(function() {
        check_order_sort_dropdown();
      });
      function check_order_sort_dropdown() {
        if ( jQuery('.wcusage_field_order_sort_option:selected').val() == "completeddate" ) {
          jQuery(".wcu-field-section-message-orders-sort-completed").show();
          /*jQuery(".option_wcusage_field_order_type").hide();*/
        } else {
          jQuery(".wcu-field-section-message-orders-sort-completed").hide();
          /*jQuery(".option_wcusage_field_order_type").show();*/
        }
      }
      </script>
  		<strong><label for="scales"><?php echo __( 'By which date should orders be sorted on the affiliate dashboard?', 'woo-coupon-usage' ); ?></label></strong><br/>
  		<select name="wcusage_options[wcusage_field_order_sort]" id="wcusage_field_order_sort" onchange="check_order_sort_dropdown()">
  			<option class="wcusage_field_order_sort_option" value="paiddate" <?php if($wcusage_field_order_sort == "paiddate") { ?>selected<?php } ?>><?php echo __( 'Paid Date', 'woo-coupon-usage' ); ?></option>
  			<option class="wcusage_field_order_sort_option" value="completeddate" <?php if($wcusage_field_order_sort == "completeddate") { ?>selected<?php } ?>><?php echo __( 'Completed Date', 'woo-coupon-usage' ); ?></option>
  		</select>
  		<br/><i><?php echo __( 'This will determine how the orders are sorted on the affiliate dashboard, either by the day they were paid for, or the day it was set to completed.', 'woo-coupon-usage' ); ?></i>
      <span class="wcu-field-section-message-orders-sort-completed" style="display: none;">
        <br/>
        <i style="color: red; font-size: 15px; font-weight: bold;">
          <?php echo __( 'NOTE: If set to "Completed Date", only orders that have been marked as "completed" (at-least once) can be displayed on the dashboard.', 'woo-coupon-usage' ); ?>
          <br/>
          <?php echo __( 'This may therefore disregard some of the order statuses that are checked above.', 'woo-coupon-usage' ); ?>
        </i>
      </span>

  	</p>

  <?php
  }
}
