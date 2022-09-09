<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Class for Clicks/Visits List Table
 *
 */
if(!class_exists('WP_List_Table')){
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}
class wcusage_clicks_List_Table extends WP_List_Table {

    function __construct(){
        global $status, $page;

        //Set parent defaults
        parent::__construct( array(
            'singular'  => 'clicks',
            'plural'    => 'click',
            'ajax'      => false
        ) );

    }

    function column_default($item, $column_name){

		$options = get_option( 'wcusage_options' );

      switch($column_name){
        default:
            return $item[$column_name]; //Show the whole array for troubleshooting purposes
  			case 'id':
  				return $item[$column_name];
        case 'couponid':
					if(isset($item[$column_name]) && $item[$column_name] != 0 ) {
            $coupon_info = wcusage_get_coupon_info_by_id($item[$column_name]);
        		$uniqueurl = $coupon_info[4];
				    return "<a href='".$uniqueurl."' target='_blank' title='".__( 'View Affiliate Dashboard', 'woo-coupon-usage' )."'>" . get_the_title($item[$column_name]) . "</a> <a href='/wp-admin/post.php?post=".$item[$column_name]."&action=edit&classic-editor' target='_blank' title='".__( 'Edit Coupon', 'woo-coupon-usage' )."'><span class='dashicons dashicons-edit-page'></span></a>";
          } else {
            return "";
          }
				case 'campaign':
	  			if(isset($item[$column_name])) { return ucfirst( $item[$column_name] ); } else { return "---"; }
        case 'page':
  				if(isset($item[$column_name])) {
            return "<a href='".get_permalink($item[$column_name])."' target='_blank' title='".__( 'View Landing Page', 'woo-coupon-usage' )."'>" . get_the_title($item[$column_name]) . "</a>";
          } else {
            return "";
          }
				case 'referrer':
  				if(isset($item[$column_name])) { return $item[$column_name]; } else { return ""; }
				case 'ipaddress':
  				if(isset($item[$column_name])) {

            if( wcusage_is_customer_blacklisted($item[$column_name]) ) {
              $blacklist_button_part1 = '<input type="text" id="wcu-blacklist-ipaddress-remove" name="wcu-blacklist-ipaddress-remove" value="'.$item['ipaddress'].'" style="display: none;">';
              $blacklist_button_part2 = '<span class="fa-solid fa-shield icon-blacklist-remove"></span>';
              $blacklist_button_part3 = __( 'Remove from Blacklist', 'woo-coupon-usage' );
            } else {
              $blacklist_button_part1 = '<input type="text" id="wcu-blacklist-ipaddress" name="wcu-blacklist-ipaddress" value="'.$item['ipaddress'].'" style="display: none;">';
              $blacklist_button_part2 = '<span class="fa-solid fa-ban icon-blacklist-add"></span>';
              $blacklist_button_part3 = __( 'Add to Blacklist', 'woo-coupon-usage' );
            }

            $blacklist_button = '<form method="post" id="submitclick" style="display: inline-block;">
  					'.$blacklist_button_part1.'
            '.wp_nonce_field( 'blacklist_url' ).'
            <button type="submit" name="submitclickblacklistip" class="payout-action-blacklistip" style="padding: 0; background: transparent; border: 0;" title="'.$blacklist_button_part3.'">
               '.$blacklist_button_part2.'
            </button>
            </form>';

            if( wcusage_is_customer_blacklisted($item[$column_name]) ) {

              return '<span style="color: red;" title="This visitor is blacklisted from using affiliate coupons.">' . $item[$column_name] . " " . $blacklist_button . '</span>';

            } else {

              return $item[$column_name] . " " . $blacklist_button;
            }

          } else {
            return "";
          }
  			case 'converted':
  				if($item[$column_name] == 1) {
  					return '<span class="dashicons dashicons-yes-alt" style="color: green;"></span> ' . __( 'Yes', 'woo-coupon-usage' );
  				} else {
  					return '<span class="dashicons dashicons-dismiss" style="color: red;"></span> ' . __( 'No', 'woo-coupon-usage' );
  				}
  			case 'date':
  				$thedatetime = strtotime($item[$column_name]);
  				return date_i18n("M jS, Y (g:ia)", $thedatetime);
  			case 'action1':
					?>
					<form method="post" id="submitclick">
					<input type="text" id="wcu-id" name="wcu-id" value="<?php echo $item['id']; ?>" style="display: none;">
					<input type="text" id="wcu-status-delete" name="wcu-status-delete" value="cancel" style="display: none;">
          <?php wp_nonce_field( 'delete_url' ); ?>

          <button onClick="return confirm('\nAre you sure you want to delete visit #<?php echo $item['id']; ?>?');"
            title="<?php echo __( 'Delete this visit.', 'woo-coupon-usage' ); ?>"
          type="submit" name="submitclickdelete" style="padding: 0; background: 0; border: 0; cursor: pointer; margin-bottom: 5px; color: #B52828;">
            <i class="fa-solid fa-trash-can"></i> <?php echo __( 'Delete', 'woo-coupon-usage' ); ?>
          </button>

					</form>
					<?php
      }
    }

    function column_title($item){

        //Build row actions
        $actions = array(
            'delete'    => sprintf('<a href="?page=%s&action=%s&click=%s">Delete</a>', esc_attr( $_REQUEST['page'] ),'delete',$item['ID']),
        );

        //Return the title contents
        return sprintf('%1$s <span style="color:silver">(id:%2$s)</span>%3$s',
            /*$1%s*/ $item['title'],
            /*$2%s*/ $item['ID'],
            /*$3%s*/ $this->row_actions($actions)
        );
    }

    function column_cb($item){
        return sprintf(
            '<input type="checkbox" name="%1$s[]" value="%2$s" />',
            /*$1%s*/ $this->_args['singular'],
            /*$2%s*/ $item['ID']
        );
    }

    function get_columns(){

      $wcusage_field_track_click_ip = wcusage_get_setting_value('wcusage_field_track_click_ip', '1');
      if($wcusage_field_track_click_ip) {
        $ip_text = __( 'IP Address', 'woo-coupon-usage' );
      } else {
        $ip_text = __( 'Visitor ID', 'woo-coupon-usage' );
      }

        $columns = array(
            //'cb'        => '<input type="checkbox" />', //Render a checkbox instead of text
            'id'     => __( 'ID', 'woo-coupon-usage' ),
            'couponid'  => __( 'Affiliate Coupon', 'woo-coupon-usage' ),
						'campaign'  => __( 'Campaign Name', 'woo-coupon-usage' ),
						'page'  => __( 'Landing Page', 'woo-coupon-usage' ),
						'referrer'  => __( 'Referrer URL', 'woo-coupon-usage' ),
						'ipaddress'  => $ip_text,
      			'date'  => __( 'Visit Date', 'woo-coupon-usage' ),
            'converted'  => __( 'Converted', 'woo-coupon-usage' ),
      			'action1'  => __( 'Action', 'woo-coupon-usage' ),
        );
        return $columns;

    }

    function get_sortable_columns() {
      $sortable_columns = array(
			'date'  => array('date',false),
        );
        return $sortable_columns;
    }

    function prepare_items() {

        global $wpdb; //This is used only if making any database queries

        $per_page = 20;

        $columns = $this->get_columns();
        $hidden = array();
        $sortable = $this->get_sortable_columns();

        $this->_column_headers = array($columns, $hidden, $sortable);

        $this->process_bulk_action();

				$table_name = $wpdb->prefix . 'wcusage_clicks';

				if(isset($_GET['status'])) {
					$sql = "SELECT * FROM " . $table_name . " WHERE status = '" . sanitize_text_field( $_GET['status'] ) . "' ORDER BY id DESC";
				} else {
					$sql = "SELECT * FROM " . $table_name . " ORDER BY id DESC";
				}
				$data = $wpdb->get_results($sql,ARRAY_A);

        $current_page = $this->get_pagenum();

        $total_items = count($data);

        $data = array_slice($data,(($current_page-1)*$per_page),$per_page);

        $this->items = $data;

        $this->set_pagination_args( array(
            'total_items' => $total_items,                  //WE have to calculate the total number of items
            'per_page'    => $per_page,                     //WE have to determine how many items to show on a page
            'total_pages' => ceil($total_items/$per_page)   //WE have to calculate the total number of pages
        ) );

    }

}
?>
