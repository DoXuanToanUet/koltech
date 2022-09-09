<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Displays custom styles/css in admin dashboard
 *
 */
function wcusage_custom_admin_styles() {

$options = get_option( 'wcusage_options' );
if(isset($options['wcusage_field_coupon_hide_woo_marketing'])) {
	$wcusage_coupon_hide_woo_marketing = $options['wcusage_field_coupon_hide_woo_marketing'];
} else {
	$wcusage_coupon_hide_woo_marketing = 1;
}
?>

<style>
	.wcu-coupon-box table { width: 1240px; max-width: 100%; }
	.wcu-thetitlerow { background: #edf7ff; text-align: left !important; }
	.wcu-thetitlerow-admin { background: #edf7ff !important; font-weight: bold; }
	.wcu-coupon-box tr { background: #fff; margin-bottom: 20px; }
	.wcu-coupon-box td { padding: 10px; text-align: center; }
	.wcu-coupon-box-admin td { padding: 0px; text-align: center; }
	.wcu-coupon-box-admin .wcu-thetitlerow-admin td { padding: 5px !important; }
	.wcu-coupon-box { margin-bottom: 25px; }
	.wcusage_thebutton { background: #333; text-align: center !important; font-weight: bold; }
	.wcusage_thebutton a { color: #fff; text-decoration: none; }
	.wcu-td-a { padding: 0 !important; }
	.wcu-td-a a, .wcu-td-a input { display:block; width:100%; text-decoration: none; padding: 10px 0; }

  .wcusage-settings-form a:hover {
    color: #21B1D3;
  }

	.nav-tab {
		border-bottom: 2px solid #f3f3f3;
		min-width: 50px;
		text-align: center;
		font-size: 12.5px;
	}
  @media only screen and (max-width: 720px) {
    .nav-tab {
  		width: 17% !important;
  	}
  }
	.nav-tab.active {
		background: #fff !important;
		box-shadow: 0px 0px 2px #000;
		color: #333 !important;
	}
	.nav-tab:hover {
		box-shadow: 0px 0px 2px #000;
	}
  @media only screen and (max-width: 1240px) {
    .nav-tab .settings-tab-icon {
      display: none !important;
    }
  }
  .wcu-settings-pro-icon {
    position: absolute;
    background: green;
    padding: 2px 5px 3px 5px;
    color: #fff;
    border-radius: 20px;
    line-height: 12px;
  }
  @media only screen and (min-width: 1241px) {
  	.wcu-settings-pro-icon {
  		margin-top: -45px;
  		margin-left: -15px;
  	}
  }
  @media only screen and (max-width: 1240px) {
  	.wcu-settings-pro-icon {
  		margin-top: -15px;
  		margin-left: -15px;
  	}
  }
	.settings-tab-icon {
		font-size: 22px;
		text-align: center;
		margin-top: 5px;
		margin-bottom: 2px;
		display: block !important;
	}

  /* Settings */

  .wcusage-settings th { display: none; }
  .wcusage-settings input[type="text"], .wcusage-settings input[type="number"], .wcusage-settings input[type="color"] { width: 100%; max-width: 250px; }
  .wcusage-settings .submit input { font-size: 20px !important; height: 50px !important; width: 100%; max-width: 300px; }
  .wcusage-settings .nav-tab { background: #ADD8E6; color: #000; border-top-left-radius: 10px; border-top-right-radius: 10px; margin-top: 2px; padding: 7px; margin-left: 5px; }
  .wcusage-settings form { background: #F8F8FF; padding: 15px 20px; margin: 20px 0; border-radius: 10px; }
  .wcusage-settings i { background: #e9f3f5; display: inline-block; padding: 4px; margin: 5px 0 -4px 0; font-style: normal; border-radius: 4px; font-size: 11px; color: #848484; opacity: 0.85; }
  .wcusage-settings i:hover { opacity: 1; }

	/* Pro Details */
	@media only screen and (min-width: 1387px)  {
		.wcu-pro-details-col-1 {
			width: 450px;
			margin-right: 0px;
			float: left;
      padding-right: 30px;
		}
		.wcu-pro-details-col-2 {
			width: 470px;
			float: left;
		}
		.wcu-pro-col-inner {
			width: 100%;
			float: left;
		}
	}

  /* Pro Details */
  @media only screen and (min-width: 1024px) and (max-width: 1500px)   {
    .wcu-pro-details-col-1 {
      width: 400px;
    }
    .wcu-pro-details-col-2 {
      width: 400px;
    }
  }

  /* Setup Wizard */

  .wcusage-settings-wizard-button {
     text-decoration: none; font-weight: bold; border: 2px solid #f3f3f3; border-radius: 5px;
     margin-top: -5px; margin-left: 15px; padding: 9px; font-size: 14px;
     background: linear-gradient(#fefefe, #f6f6f6); box-shadow: 0px 0px 4px #d0d0d0; border: 1px solid #f3f3f3;
   }
   .wcusage-settings-wizard-button:hover {
      padding: 10px;
   }

  .plugin-setup-settings .bar-container {
      width: 800px;
      margin: 20px auto 90px auto;
  }
  .plugin-setup-settings .progressbar {
      counter-reset: step;
  }
  .plugin-setup-settings .progressbar li {
      list-style-type: none;
      width: 14%;
      float: left;
      font-size: 12px;
      position: relative;
      text-align: center;
      text-transform: uppercase;
      color: #7d7d7d;
  }
  .plugin-setup-settings .progressbar li:before {
      width: 30px;
      height: 30px;
      content: counter(step);
      counter-increment: step;
      line-height: 30px;
      border: 2px solid #7d7d7d;
      display: block;
      text-align: center;
      margin: 0 auto 10px auto;
      border-radius: 50%;
      background-color: white;
  }
  .plugin-setup-settings .progressbar li:after {
      width: 100%;
      height: 2px;
      content: '';
      position: absolute;
      background-color: #7d7d7d;
      top: 15px;
      left: -50%;
      z-index: -1;
  }
  .plugin-setup-settings .progressbar li:first-child:after {
      content: none;
  }
  .plugin-setup-settings .progressbar li.active {
      color: green;
  }
  .plugin-setup-settings .progressbar li.current {
      font-weight: bold;
  }
  .plugin-setup-settings .progressbar li.active:before {
      border-color: #55b776;
  }
  .plugin-setup-settings .progressbar li.active + li:after {
      background-color: #55b776;
  }
  .plugin-setup-settings .progressbar a {
    color: #000;
    text-decoration: none;
  }
  .plugin-setup-settings label {
    margin-bottom: 5px;
  }
  .plugin-setup-settings input[type="checkbox"] {
    margin: 5px 0;
  }
  .plugin-setup-settings #wcusage_field_order_type_custom {
    display: inline-block;
    margin: 5px 0;
  }
  .plugin-setup-settings p {
    margin: 10px 0 0 0;
  }
  .plugin-setup-settings i {
    background: #e9f3f5;
    display: inline-block;
    padding: 4px;
    margin: 5px 0 -4px 0;
    font-style: normal;
    border-radius: 4px;
    font-size: 11px;
    color: #848484;
    opacity: 0.85;
  }
  .plugin-setup-settings .dashicons {
    margin-top: -2px !important;
  }
  .plugin-setup-settings input[type="text"], .plugin-setup-settings input[type="number"], .plugin-setup-settings input[type="color"] { width: 100%; max-width: 250px; }

  /* Dashboard Page */

  .wcusage-admin-page-col { width: calc(50% - 85px); margin: 10px 0px 10px 0px; padding: 15px 30px 30px 30px; background: #fff; float: left; border: 2px solid #e3e3e3; }
  .wcusage-admin-page-col3 { width: calc(100% - 65px); margin: 10px 0; padding: 15px 30px; background: #F8F8FF; float: left; border: 2px solid #e3e3e3; }

  .wcusage-admin-dash-button {
    font-weight: bold;
    border: 2px solid #f3f3f3;
    border-radius: 5px;
    padding: 10px;
    margin: 12px 5px 10px 5px;
    display: inline-block;
    float: right;
    background: linear-gradient(#fefefe, #f6f6f6);
    box-shadow: 0px 0px 4px #d0d0d0;
    border: 1px solid #f3f3f3;
  }
  .wcusage-admin-dash-button:hover {
    transform: scale(1.05);
  }

  .wcusage-admin-table-col-head th, .wcusage-admin-table-col-footer td {
    background: linear-gradient(#fefefe, #f6f6f6);
  }
  .wcusage-admin-table-col-head th, .wcusage-admin-table-col-row td, .wcusage-admin-table-col-footer td {
    padding: 10px 5px;
    border: 1px solid #f3f3f3;
  }

  /* Account Page */

  @media only screen and (min-width: 900px) {
    .wcusage-settings-form .nav-tab-wrapper {
      background: #F8F8FF;
      border-bottom: 5px solid #F8F8FF;
      padding-top: 0px !important;
    }
  }

  .coupon-affiliates_page_wcusage-account .nav-tab-wrapper a:nth-child(2) {
    display: none;
  }

  /* Addons */

  .coupon-affiliates_page_wcusage-addons #wpbody {
    display: none;
  }

	/*Menu*/
	#toplevel_page_wcusage .fs-trial {
		display: none;
	}

	@media only screen and (max-width: 760px), (min-device-width: 768px) and (max-device-width: 1024px)  {

		/* Force table to not be like tables anymore */
		.wcu-coupon-box table, .wcu-coupon-box thead, .wcu-coupon-box tbody, .wcu-coupon-box th, .wcu-coupon-box td, .wcu-coupon-box tr {
			display: block;
		}

		/* Hide table headers (but not display: none;, for accessibility) */
		.wcu-coupon-box thead tr {
			position: absolute;
			top: -9999px;
			left: -9999px;
		}

		.wcu-coupon-box tr { border: 1px solid #ccc; }

		.wcu-coupon-box td {
			/* Behave  like a "row" */
			border: none;
			border-bottom: 1px solid #eee;
			position: relative;
			padding-left: 50%;
			padding-top: 5px;
			padding-bottom: 5px;
		}

		.wcu-coupon-box td:before {
			/* Now like a table header */
			position: absolute;
			/* Top/left values mimic padding */
			top: 5px;
			left: 6px;
			width: 45%;
			padding-right: 10px;
			white-space: nowrap;
		}

		.wcu-thetitlerow-admin {
			display: none !important;
		}
		.wcu-td-a {
			width: 100% !important;
		}

		/*
		Label the data
		*/
		.wcu-coupon-box-admin td:nth-of-type(1):before { content: "ID"; }
		.wcu-coupon-box-admin td:nth-of-type(2):before { content: "User"; }
		.wcu-coupon-box-admin td:nth-of-type(3):before { content: "Coupon"; }
		.wcu-coupon-box-admin td:nth-of-type(4):before { content: "Amount"; }
		.wcu-coupon-box-admin td:nth-of-type(5):before { content: "Method"; }
		.wcu-coupon-box-admin td:nth-of-type(6):before { content: "Status"; }
		.wcu-coupon-box-admin td:nth-of-type(7):before { content: "Date Req"; }
		.wcu-coupon-box-admin td:nth-of-type(8):before { content: ""; }
		.wcu-coupon-box-admin td:nth-of-type(9):before { content: ""; }

	}

	.payout-action {
		color: #fff;
    font-weight: bold;
    background: #333;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    display: block;
    margin: 8px auto;
    padding: 4px 7px 5px 7px;
    font-size: 14px;
    min-width: 148px;
	}
	.payout-action-paid, .payout-action-accepted {
		border: 2px solid #015F13;
	}
    .payout-action-paid:hover, .payout-action-accepted:hover {
      background: #015F13;
      border: 2px solid #333;
    }
  .payout-action-paid2 {
		border: 2px solid #054A8C;
	}
    .payout-action-paid2:hover {
  		background: #054A8C;
      border: 2px solid #333;
  	}
	.payout-action-pending {
		border: 2px solid #A57100;
	}
    .payout-action-pending:hover {
  		background: #A57100;
      border: 2px solid #333;
  	}
	.payout-action-cancel, .payout-action-declined, .payout-action-delete {
		border: 2px solid #872222;
	}
    .payout-action-cancel:hover, .payout-action-declined:hover, .payout-action-delete:hover {
  		background: #872222;
      border: 2px solid #333;
  	}
    .payout-action-delete {
      width: 40px;
      min-width: 40px;
    }

  #submitclick button:hover, #submitregister button:hover, #submitpayout button:hover, #submitdomain button:hover {
    font-weight: bold;
  }

	#the-list #submitregister {
		margin-bottom: 5px;
	}

  .payout-api-notice {
    padding: 10px 20px;
    background: #333;
    display: inline-block;
    color: #fff;
    font-size: 15px;
    border-radius: 20px;
    max-width: 700px;
    width: 90%;
  }

	/* Coupons List */

	.wcusage-copy-url {
		font-size: 11px; color: #333; background: #333; color: #fff; border: 0; border-radius: 10px; padding: 2px 15px; width: 100%; max-width: 110px; cursor: pointer;
	}
	.wcusage-copy-url:active {
		background: green; cursor: -webkit-grabbing; cursor: grabbing;
	}

  /* Edit Coupons */

  #poststuff #woocommerce-coupon-data {
    display: block !important;
  }

	/* Admin Orders Column */

	.wcusage-orders-affiliate-column {
		margin-right: -5px;
	}
	.wcusage-orders-affiliate-column .woocommerce-help-tip, .wcusage-users-affiliate-column .woocommerce-help-tip {
		font-size: 28px;
		margin-top: -15px;
		color: green;
		width: 34px;
	}

	<?php if($wcusage_coupon_hide_woo_marketing) { ?>
	.post-type-shop_coupon .woocommerce-marketing-coupons, .post-type-shop_coupon .woocommerce-marketing-knowledgebase-card {
		display: none;
	}
	<?php } ?>
</style>

<style>
.wcusage_row .switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
  scale: 0.7;
	margin: 2px;
}

.wcusage_row .switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

.wcusage_row .slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #9f9c9c;
  -webkit-transition: .4s;
  transition: .4s;
	max-width: 70px !important;
	min-height: 32px;
  box-shadow: inset 0 2px 0 #707070;
}

.wcusage_row .slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
  box-shadow: 0 2px 0 #707070;
}

.switch:hover .slider:before {
  width: 24px;
  height: 24px;
  bottom: 5px;
  left: 5px;
  -webkit-transition: 0s;
  transition: 0s;
}

.wcusage_row input:checked + .slider {
  background-color: #2196F3;
  box-shadow: inset 0 2px 0 #707070;
}

.wcusage_row input:focus + .slider {
  box-shadow: inset 0 2px 0 #707070;
}

.wcusage_row input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

.wcusage-settings-form .switch .slider.round {
  max-width: 60px !important;
}

.wcusage-settings-form .slider .on {
  display: none;
  margin-left: -12px;
}
.wcusage-settings-form .slider .off {
  margin-left: 12px;
}
.wcusage-settings-form .slider .on, .wcusage-settings-form .slider .off {
  color: white;
  position: absolute;
  transform: translate(-50%,-50%);
  top: 50%;
  left: 50%;
  font-size: 9px;
  font-family: Verdana, sans-serif;
}
.wcusage-settings-form input:checked+ .slider .on { display: block; }
.wcusage-settings-form input:checked + .slider .off { display: none; }

/* Admin Users */

.column-affiliateinfo {
  text-align: center !important;
}

.wp-admin.users-php #tiptip_content {
  max-width: 200px !important;
  width: 200px !important;
  margin-top: 10px;
  margin-left: -10px;
}
.wp-admin.users-php #tiptip_arrow {
  padding-top: 10px !important;
  margin-left: 100px !important;
}

.wcu-affiliate-tooltip-unlink-button {
  color: white;
  margin: 0;
  display: inline;
  font-size: 12px;
  color: #fff;
  text-decoration: underline;
  background: none;
  padding: 0;
  border: 0;
  cursor: pointer;
}
.wcu-affiliate-tooltip-unlink-button:hover {
  color: #EC3232;
}
.wcu-affiliate-tooltip-edit-button {
  color: white;
}
.wcu-affiliate-tooltip-edit-button:hover {
  color: #1FD036;
}
.wcu-affiliate-tooltip-dashboard-button, .wcu-affiliate-tooltip-user-button {
  color: #07bbe3;
}
.wcu-affiliate-tooltip-dashboard-button:hover, .wcu-affiliate-tooltip-user-button:hover {
  color: #6CE5FF;
}
.wcu-showhide-button {
  padding: 1px 7px;
}

/* Rounded sliders */
.wcusage_row .slider.round {
  border-radius: 34px;
}

.wcusage_row .slider.round:before {
  border-radius: 50%;
}

/* Addons */

.wcu-addons-box {
	padding: 10px;
	background: linear-gradient(#fefefe, #f6f6f6);
	border-radius: 10px;
	border: 1px solid #333;
	margin: 15px 10px;
	float: left;
	display: block;
	position: relative;
	padding-bottom: 60px;
}
	.wcu-addons-box {
		width: calc(25% - 50px);
		min-height: 165px;
	}
	@media only screen and (max-width: 1760px)  {
		.wcu-addons-box {
			width: calc(25% - 50px);
			min-height: 180px;
		}
	}
	@media only screen and (max-width: 1580px)  {
		.wcu-addons-box {
			width: calc(33% - 50px);
			min-height: 190px;
		}
	}
	@media only screen and (max-width: 1390px)  {
		.wcu-addons-box {
			width: calc(50% - 50px);
			min-height: 160px;
		}
	}
	@media only screen and (max-width: 1220px)  {
		.wcu-addons-box {
			width: calc(50% - 50px);
			min-height: 180px;
		}
	}
	@media only screen and (max-width: 1090px)  {
		.wcu-addons-box {
			width: calc(100% - 50px);
			min-height: 160px;
		}
	}
.wcu-addons-box strong {
	font-size: 16px;
}
.wcu-addons-box-bottom {
	min-height: 39px;
	background: #eaecef;
	display: inline-block;
	padding-top: 5px;
	width: 100%;
	margin-top: 12px;
	margin-left: -10px;
	position: absolute;
	bottom: 0px;
	border-bottom-left-radius: 10px;
	border-bottom-right-radius: 10px;
}
.wcu-addons-box-view-details {
	font-size: 12px;
	padding: 4px 10px;
	border: 1px solid #333;
	border-radius: 10px;
	text-decoration: none;
	background: #fff;
	color: #333;
	display: inline-block;
	margin-top: 4px;
	margin-left: 12px;
}
.wcu-addons-box-view-details:hover {
	background: #333;
	color: #fff;
}
.wcusage-addon-button {
	width: calc(100% - 10px);
	background: #333;
	color: #fff;
	border-radius: 10px;
	margin: 10px 10px 0 5px;
	padding: 5px 0px;
	display: block;
	text-align: center;
	text-decoration: none;
}
.wcusage-addon-button:hover {
	color: #fff;
	background: #000;
}
.wcu-addons-box .switch {
	float: right;
	margin-top: -5px;
	margin-right: -7px;
}
.wcu-addons-box .dashicons-yes-alt, .wcu-addons-box .dashicons-clock {
	float: right;
	margin-top: -5px;
	font-size: 25px;
	color: green;
}
.wcu-addons-box .wcu-addon-upgrade {
	float: right;
	margin-top: -5px;
	font-size: 10px;
	color: #333;
	text-align: center;
	text-decoration: none;
	margin-right: -5px;
}

/* Payouts Table */

.wp-list-table.payout {
  table-layout: fixed;
}

.wp-list-table.payout th,
.wp-list-table.registration th,
.wp-list-table.click th,
.wp-list-table.directlink th {
  text-align: center;
}
.wp-list-table.payout th a,
.wp-list-table.registration th a,
.wp-list-table.click th a,
.wp-list-table.directlink th a {
  display: inline-block;
  margin: 0 auto;
}
.wp-list-table.payout th.sortable span,
.wp-list-table.registration th.sortable span,
.wp-list-table.click th.sortable span,
.wp-list-table.directlink th.sortable span {
  display: inline;
  float: none;
}
.wp-list-table.payout th.sortable span.sorting-indicator:before,
.wp-list-table.registration th.sortable span.sorting-indicator:before,
.wp-list-table.click th.sortable span.sorting-indicator:before,
.wp-list-table.directlink th.sortable span.sorting-indicator:before {
  display: none;
}

.wp-list-table.payout tr:hover,
.wp-list-table.registration tr:hover,
.wp-list-table.click tr:hover,
.wp-list-table.directlink tr:hover {
  outline: 2px solid #AFAFAF;
}

.wp-list-table.payout td,
.wp-list-table.registration td,
.wp-list-table.click td,
.wp-list-table.directlink td {
  width: auto;
  padding: 15px 10px 15px 10px;
  border-right: 1px solid #EFEFEF;
  text-align: center;
}

.column-id { width: 50px; }
.payout .manage-column.column-status {
  width: 110px;
}
.payout .manage-column.column-userid,
.payout .manage-column.column-couponid,
.payout .manage-column.column-amount {
  width: 100px;
}
.payout .manage-column.column-date,
.payout .manage-column.column-datepaid {
  width: 100px;
}
.payout .manage-column.column-method {
  width: 240px;
}
.payout .manage-column.column-downloads {
  width: 120px;
}
.payout .manage-column.column-action1 {
  text-align: center;
  width: 200px;
}
.registration .manage-column.column-action1 {
  text-align: center;
  width: 200px;
}

@media screen and (max-width: 782px) {
  .wp-list-table.registration .is-expanded td, .wp-list-table.payout .is-expanded td {
        margin: 15px 0;
  }
}

@media screen and (max-width: 782px) {
  .wcu-registration-filters, .wcu-payout-filters {
    margin-bottom: 0 !important;
  }
}

.wcu-table-custom-links {
  font-size: 15px;
}

/* Registration Create Popup */

.wcu_form_affiliate_popup_overlay {
  /*Hides pop-up when there is no "active" class*/
  visibility: hidden;
  position: fixed;
  background: #ffffff !important;
  border: 2px solid #666666;
  width: 400px;
  max-width: 70%;
  height: auto;
  left: calc(50% - 200px);
  margin-top: 0px;
  padding: 0 20px 10px 20px;
  z-index: 9999;
  box-shadow: 0px 0px 30px #333;
  max-height: 80vh;
  overflow: auto;
}
.wcu_form_affiliate_popup_overlay.active {
  /*displays pop-up when "active" class is present*/
  visibility: visible;
}
@media screen and (max-width: 720px) {
  .wcu_form_affiliate_popup_overlay {
    top: 10px;
    left: 2px;
    width: calc(100% - 48px);
    max-width: calc(100% - 48px);
  }
}

#wcu_form_affiliate_register {
  z-index: 99999;
  background: #ffffff !important;
}

.wcu_form_affiliate_popup_content {
  /*Hides pop-up content when there is no "active" class */
  visibility: hidden;
}

.wcu_form_affiliate_popup_content.active {
  /*Shows pop-up content when "active" class is present */
  visibility: visible;
}

.wcu_form_affiliate_close {
  position: absolute;
  right: 12px;
  top: 2px;
  padding: 0;
  margin: 0;
  border: 0;
  background: 0;
  cursor: pointer;
}
.wcu_form_affiliate_close .dashicons {
  font-size: 32px;
}

/* Custom Message Box */

#wcu-close-me button {
    position: absolute;
    top: 14px;
    margin-left: -19px;
    border-radius: 8px;
    cursor: pointer;
    padding: 0px 5px 2px 5px;
}

/***** Settings Form *****/

.wcusage-settings-form h3 {
  font-size: 21px;
}
.wcusage-settings-form h3 .dashicons {
  font-size: 24px;
  margin-right: 5px;
}

@media screen and (min-width: 1120px) {
	.wcusage-settings-form {
		width: calc(100% - 310px);
		float: left;
	}
	.wcu-settings-sidebar {
		padding: 20px 0 20px 20px;
		width: 250px;
		float: left;
	}
}
@media screen and (max-width: 1120px) {
	.wcusage-settings-form {
		width: 100%;
		float: left;
	}
	.wcu-settings-sidebar {
		padding: 0px;
    margin-top: 20px;
    max-width: 400px;
		width: 100%;
		float: left;
	}
}

/*
.wcusage-settings-form .submit {
	position: fixed;
	bottom: 0;
	padding-bottom: 0;
	margin-left: -20px !important;
	z-index: 999999;
	width: 300px;
	margin: 0;
	border-radius: 10px;
}
*/

.wcusage-settings-form hr {
	margin: 20px 0 30px 0;
}

@media screen and (min-width: 1400px) {
	.wcusage-settings-col-2 {
	    width: 50%; float: left;
	}
}

.wcu-setting-email-header {
  margin: 0;
}
.wcu-setting-email-notification-box {
  padding: 15px 15px 20px 15px;
  background: rgba(255,255,255,0.4);
  border-radius: 15px;
  border: 2px solid #e3e8e8;
  margin-bottom: 20px;
  max-width: 700px;
}

.wcu-update-text {
	position: fixed;
  bottom: 15px;
  left: 185px;
  font-size: 35px;
  background: #1C954F;
  padding: 15px 35px;
  color: #fff;
  border-radius: 20px;
	z-index: 99999;
}
.wcu-update-icon {
	display: inline-block !important;
	margin: 0 !important;
	padding: 0 !important;
}
.wcu-update-icon i {
	font-size: 18px !important;
  color: green !important;
  background: transparent !important;
	z-index: 9999999 !important;
	margin: 0 !important;
	margin-left: -25px !important;
	margin-top: -10px !important;
	padding: 0 !important;
	position: absolute;
}

.wcusage-settings-form input::-webkit-outer-spin-button,
.wcusage-settings-form input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}
/* Firefox */
.wcusage-settings-form input[type=number] {
  -moz-appearance: textfield;
}

p label {
  margin-left: 2px;
}

#wcusage_field_paypalapi_id,
#wcusage_field_stripeapi_publish,
#wcusage_field_paypalapi_test_id,
#wcusage_field_stripeapi_test_publish {
  max-width: 225px;
}
#wcusage_field_paypalapi_secret,
#wcusage_field_stripeapi_secret,
#wcusage_field_paypalapi_test_secret,
#wcusage_field_stripeapi_test_secret {
  color: transparent;
  text-shadow: 0 0 4px rgba(0,0,0,1);
  max-width: 225px;
}
#wcusage_field_paypalapi_secret:hover,
#wcusage_field_stripeapi_secret:hover,
#wcusage_field_paypalapi_test_secret:hover,
#wcusage_field_stripeapi_test_secret:hover {
  color: #000;
  text-shadow: none;
}

/***** Admin Reports *****/

/* Tables */
.coupon-item-box {
	display: block;
	border-radius: 10px;
	border: 1px solid #f3f3f3;
	margin-bottom: 20px;
	background: linear-gradient(#fefefe, #f6f6f6);
	box-shadow: 0px 0px 4px #d0d0d0;
	font-weight: 600;
}

.coupon-data-row {
	padding: 0 15px;
	width: auto;
	display: block;
	max-width: 100%;
}
.coupon-data-row-head, .coupon-data-row-head-mobile {
	color: #A0A0A0;
	font-size: 10px;
}
.coupon-data-row-head-mobile {
	color: #A0A0A0;
	font-size: 10px;
	padding: 10px 0 0 0 !important;
}
.coupon-data-row-main {
	font-size: 18px;
}
	@media screen and (max-width: 1390px) {
		.coupon-data-row-main {
			font-size: 15px;
		}
	}

#table-coupon-items { width: 70%; table-layout: fixed; }
@media only screen and (max-width: 1520px) {
  #table-coupon-items {
    width: 95%;
  }
}

.coupon-item-box tr { border-radius: 10px; display: block }
.wcu-r-td { padding: 0 2px; max-width: 14% !important; vertical-align: top; }
.wcu-r-td-120 { min-width: 150px; }
	@media screen and (max-width: 1380px) {
		.wcu-r-td-120 { min-width: 135px; }
	}
	@media screen and (max-width: 1290px) {
		.wcu-r-td-120 { min-width: 120px; }
	}
	@media screen and (max-width: 1200px) {
		.wcu-r-td-120 { min-width: 105px; }
	}
	@media screen and (max-width: 1090px) {
		.wcu-r-td-120 { min-width: 90px; }
	}

.coupon-data-row-head-mobile {
	display: none;
}
@media screen and (max-width: 1100px) {
	.wcu-r-td {
		display: block;
		width: 100%;
		padding: 10px 0;
	}
	.wcu-r-td-products {
		display: inline;
	}
	.coupon-data-row-head {
		display: none !important;
	}
	.coupon-data-row-head-mobile {
		display: block;
	}
}

.wcu-button-export-admin {
	float: right;
	margin-right: 30%;
	height: 50px;
	background: green;
	color: #fff;
	font-weight: bold;
	border: 0;
	padding: 0 20px;
	border-radius: 10px;
	border: 1px solid #fff;
	cursor: pointer;
}
@media only screen and (max-width: 1520px) {
  .wcu-button-export-admin {
	   margin-right: 5%;
  }
}
@media screen and (max-width: 520px) {
	.wcu-button-export-admin {
		float: none;
		display: block;
    margin: 20px 0;
	}
}

.wcu-button-search-report-admin {
	height: 50px;
	background: green;
	color: #fff;
	font-weight: bold;
	border: 0;
	padding: 0 20px;
	border-radius: 10px;
	border: 1px solid #fff;
	cursor: pointer;
}
.ordersfilterbutton {
  width: 100%;
  background: linear-gradient(#00A721, #005B12);
}
.ordersfilterbutton:hover {
	background: linear-gradient(#005B12, #00A721);
}

/* How To Use - Settings Tab */

.wcusage_row_help strong {
	color: green !important;
	font-size: 18px !important;
}

@media only screen and (max-width: 1400px) {
  .wcu-setup-video {
    width: 100% !important;
    margin-bottom: 20px;
    float: none !important;
  }
}

/* Get Started Box */

.wcusage-get-started {
	background: #F8F8FF;
	padding: 4px 15px;
	border-radius: 10px;
}
.wcusage-get-started button {
  padding: 5px;
  cursor: pointer;
  background: linear-gradient(#fefefe, #f6f6f6);
  box-shadow: 0px 0px 4px #d0d0d0;
  border: 1px solid #f3f3f3;
  font-weight: bold;
  color: #2271b1;
}
.wcusage-get-started button:hover {
  transform: scale(1.02);
}


/* Form */

.wcu-admin-reports-form {
  padding: 25px 5px 15px 5px;
	background: #fff;
	border-radius: 20px;
	display: inline-block;
  max-width: calc(98% - 10px);
}
@media only screen and (min-width: 720px) {
  .wcu-admin-reports-form {
  	padding: 25px 25px 15px 25px;
    max-width: calc(98% - 50px);
  }
}

.wcu-admin-reports-form select, .wcu-admin-reports-form input {
  font-size: 12px;
}
.wcu-admin-reports-form select {
  margin-top: -4px;
}
.wcu-admin-reports-form input[type="text"], .wcu-admin-reports-form input[type="number"] {
  max-width: 55px !important;
}
.wcu-admin-reports-form input[type="text"], .wcu-admin-reports-form input[type="number"], .wcu-admin-reports-form input[type="date"], .wcu-admin-reports-form select {
    min-height: 29px;
}
.wcu-admin-reports-form input[type="date"] {
  max-width: 135px;
}

.admin-report-form-row {
  display: block;
  float: left;
  margin: 20px 0 10px 0;
}
@media only screen and (min-width: 720px) {
  .admin-report-form-row {
    padding: 0 20px;
  }
}

@media only screen and (max-width: 540px) {
	.wcu-order-filters-field-date {
		display: block;
		width: 100%;
	}
}

#inpSearch {
	min-width: 15%
}

/* Loading */
.wcu-loader,
.wcu-loader:before,
.wcu-loader:after {
  border-radius: 50%;
  width: 2.5em;
  height: 2.5em;
  -webkit-animation-fill-mode: both;
  animation-fill-mode: both;
  -webkit-animation: wcu-load7 1.8s infinite ease-in-out;
  animation: wcu-load7 1.8s infinite ease-in-out;
}
.wcu-loader {
  color: #000;
  font-size: 10px;
  margin: 0px auto;
  position: relative;
  text-indent: -9999em;
  -webkit-transform: translateZ(0);
  -ms-transform: translateZ(0);
  transform: translateZ(0);
  -webkit-animation-delay: -0.16s;
  animation-delay: -0.16s;
}
.wcu-loader:before,
.wcu-loader:after {
  content: '';
  position: absolute;
  top: 0;
}
.wcu-loader:before {
  left: -3.5em;
  -webkit-animation-delay: -0.32s;
  animation-delay: -0.32s;
}
.wcu-loader:after {
  left: 3.5em;
}
@-webkit-keyframes wcu-load7 {
  0%,
  80%,
  100% {
    box-shadow: 0 2.5em 0 -1.3em;
  }
  40% {
    box-shadow: 0 2.5em 0 0;
  }
}
@keyframes wcu-load7 {
  0%,
  80%,
  100% {
    box-shadow: 0 2.5em 0 -1.3em;
  }
  40% {
    box-shadow: 0 2.5em 0 0;
  }
}
.wcu-loading-loader {
	width: 100px;
}

/* Info Boxes */

.wcusage-info-box, .wcusage-info-box2 {
	padding: 25px 15px 25px 100px;
	background: linear-gradient(#fefefe, #f6f6f6);
	color: #000;
	border: 1px solid #f3f3f3;
	display: block;
	border-radius: 10px;
	margin: 0.5%;
	box-shadow: 0px 0px 4px #d0d0d0;
	width: 99%;
	position:relative;
}
.wcusage-info-box:before, .wcusage-info-box2:before {
  content:"";
  font-family: 'Font Awesome 5 Free';
	font-size: 40px;
  position:absolute;
  left:30px;
  top:34px;
	color: #bebebe;
	width: 50px;
	text-align: center;
  font-style: normal;
  font-weight: 900;
	height: 60px !important;
	display: flex;
	align-items: center;
	justify-content: center;
 }
.wcusage-info-box-dollar:before { content:"\f155"; }
.wcusage-info-box-discount:before { content:"\f02b"; }
.wcusage-info-box-discounts:before { content:"\f02c"; }
.wcusage-info-box-usage:before { content:"\f0c0"; }
.wcusage-info-box-sales:before { content:"\f07a"; }
.wcusage-info-box-commission:before { content:"\f53a"; }
.wcusage-info-box-percent:before { content:"\f541"; }
.wcusage-info-box-clicks:before { content:"\f245"; }
.wcusage-info-box-convert:before { content:"\f058"; }

  @media only screen and (min-width: 1260px) {
    .wcusage-info-box {
      width: calc(33.20% - 128px);
      float: left;
    }
  }
  @media only screen and (min-width: 920px) and (max-width: 1260px) {
    .wcusage-info-box {
      width: calc(49.5% - 128px);
      float: left;
    }
  }
  @media only screen and (max-width: 919px) {
    .wcusage-info-box {
      width: calc(100% - 128px);
      float: left;
    }
  }

	@media only screen and (min-width: 1680px) {
		.wcusage-info-box2 {
			width: calc(19% - 118px);
			float: left;
		}
	}
	@media only screen and (min-width: 1080px) and (max-width: 1679px) {
		.wcusage-info-box2 {
			width: calc(32% - 118px);
			float: left;
		}
	}
  @media only screen and (min-width: 920px) and (max-width: 1079px) {
		.wcusage-info-box2 {
			width: calc(49% - 118px);
			float: left;
		}
	}
	@media only screen and (max-width: 919px) {
		.wcusage-info-box2 {
			width: calc(99% - 118px);
			float: left;
		}
	}

  @media only screen and (min-width: 1450px) and (max-width: 1520px) {
    .wcusage-info-box2 {
      padding: 25px 15px 25px 80px;
    }
    .wcusage-info-box2:before {
      left: 15px;
    }
    .wcusage-info-box2 {
 			width: calc(19% - 98px);
 			float: left;
 		}
  }

.wcusage-info-box:hover, .wcusage-info-box2:hover {
	background: #f9f9f9;
}
.wcusage-info-box p, .wcusage-info-box2 p {
	margin: 0; padding: 0;
	font-size: 32px;
}
.wcusage-info-box .wcusage-info-box-title, .wcusage-info-box2 .wcusage-info-box-title {
	width: 100%;
	font-size: 16px;
	display: block;
	margin-bottom: 5px;
}
.wcusage-info-box .wcusage-info-box-value, .wcusage-info-box2 .wcusage-info-box-value {
	width: 100%;
	font-size: 22px;
	display: block;
}

.wcusage-last-days {
	margin: 0;
	font-size: 16px;
	font-weight: bold;
	margin-top: 20px;
	margin-bottom: 10px;
	color: #333;
}

/* Clicks */

.icon-blacklist-remove {
  color: red;
}
.icon-blacklist-remove:hover {
  color: green;
}
.icon-blacklist-add:hover {
  color: red;
}

/* Admin Reports */

.report-complete-box {
  padding: 0 20px 8px 20px;
  margin-bottom: 4px;
  width: auto;
  display: inline-block;
  background: linear-gradient(#fefefe, #f6f6f6);
  border: 1px solid #f3f3f3;
  box-shadow: 0px 0px 4px #d0d0d0;
  border-radius: 10px;
}
.report-complete-box p {
  font-size: 12px;
}

.wcusage-reports-stats-section {
  border: 2px #D0D0D0 dotted;
  border-radius: 20px;
  width: calc(70% - 20px);
  padding: 5px;
  margin-bottom: 20px;
}
  @media only screen and (max-width: 1520px) {
    .wcusage-reports-stats-section {
      width: 95%;
    }
  }

.wcusage-reports-stats-title {
  border: 2px #D0D0D0 dotted;
  border-radius: 5px;
  margin-left: 1em;
  padding: 5px 10px;
  font-size: 1.3em;
  font-weight: 600;
}

/* Hide Report Cols */

.wcu-hide-col {
	display: none;
}
.wcu-r-td:hover .wcu-hide-col {
	display: inline;
}
.wcu-hide-col {
	text-decoration: none;
	color: #A0A0A0;
}
.wcu-hide-col .fas {
	font-size: 8px;
}

/* Tooltip */

/* Tooltip container */
.wcu-tooltip {
  position: relative;
  display: block;
}
wcu-tooltip:hover {

}

.wcu-tooltop-lifetime .woocommerce-help-tip {

}
.wcu-tooltop-lifetime .woocommerce-help-tip:after {
	content: "\f155";
	font-size: 15px !important;
	margin-top: 8px !important;
	margin-left: 5px;
	color: #50575e !important;
}

.wcu-tooltop-lifetime2 .woocommerce-help-tip:after {
	content: "\f468";
	font-size: 17px !important;
	margin-top: 7px !important;
	margin-left: 5px;
	color: #50575e !important;
}

/* Tooltip text */
.wcu-tooltip .wcu-tooltiptext {
  visibility: hidden;
	top: 4px;
	left: 90px;
	margin: 0 auto;
  width: 230px;
  background-color: black;
  color: #fff;
  text-align: center;
  padding: 5px 0;
  border-radius: 6px;

  /* Position the tooltip text - see examples below! */
  position: absolute;
  z-index: 1;
}

/* Show the tooltip text when you mouse over the tooltip container */
.wcu-tooltip:hover .wcu-tooltiptext {
  visibility: visible;
}
</style>

<?php
}
add_action('admin_head', 'wcusage_custom_admin_styles');
