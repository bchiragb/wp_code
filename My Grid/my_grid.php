<?php
/*
Plugin Name: My Grid CRUD
Plugin URI: https://github.com/bchiragb/
Description: A Plugin For WordPress CRUD ( Create, Read, Update & Delete ) Application Using Ajax, Post & WP List Table
Author: Chirag Baldaniya
Author URI: https://github.com/bchiragb
Version: 1.0.0
*/


global $wpdb;

define('CRUD_PLUGIN_URL', plugin_dir_url( __FILE__ ));
define('CRUD_PLUGIN_PATH', plugin_dir_path( __FILE__ ));

function activate_crud_plugin_function() {
	global $wpdb;
	$charset_collate = $wpdb->get_charset_collate();
	$table_name = 'wp_crud';
	$sql = "CREATE TABLE $table_name (
	`id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
	`title` varchar(255),
	`description` text,
	`created_at` varchar(255),
	`updated_at` varchar(255),
	PRIMARY KEY  (id)
	) $charset_collate;";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	//dbDelta( $sql );
}
register_activation_hook( __FILE__, 'activate_crud_plugin_function' );

function deactivate_crud_plugin_function() {
	global $wpdb;
	$table_name = 'wp_crud';
	$sql = "DROP TABLE IF EXISTS $table_name";
	//$wpdb->query($sql);
}
register_deactivation_hook( __FILE__, 'deactivate_crud_plugin_function' );

//css, js
function load_custom_css_js() {
  wp_register_style( 'my_custom_css1', CRUD_PLUGIN_URL.'css/style.css', false, '1.0.0' );
  wp_enqueue_style( 'my_custom_css1' );
  wp_enqueue_script( 'my_custom_script1', CRUD_PLUGIN_URL. 'js/custom.js' );
  wp_enqueue_script( 'my_custom_script2', CRUD_PLUGIN_URL. 'js/jQuery.min.js' );
  wp_localize_script( 'my_custom_script1', 'ajax_var1', array( 'ajaxurl1' => admin_url('admin-ajax.php'), 'ajaxurl2' => get_site_url() ));
 
}
add_action( 'admin_enqueue_scripts', 'load_custom_css_js' );
require_once(CRUD_PLUGIN_PATH.'/ajax/ajax_action.php');


// Loading WP_List_Table class file
// We need to load it as it's not automatically loaded by WordPress
if (!class_exists('WP_List_Table')) {
	require_once(ABSPATH . 'wp-admin/includes/class-wp-list-table.php');
}

// Adding menu
function my_add_menu_items1() {
	global $supporthost_sample_page;

	$supporthost_sample_page = add_menu_page(__('List Table', 'admin-tablex'), __('List Table', 'admin-tablex'), 'manage_options', 'supporthost_list', 'supporthost_list_init1');
	$supporthost_sam = add_submenu_page('supporthost_list', 'List Table Application', 'All Data Grid', 'manage_options', 'supporthost_list', 'supporthost_list_init1' );
	add_submenu_page('supporthost_list', 'List Table Application', 'Add New Entry-ajax', 'manage_options', 'supporthost_list2', 'supporthost_list_init2' );
	add_submenu_page('supporthost_list', 'List Table Application', 'Add New Entry-post', 'manage_options', 'supporthost_list3', 'supporthost_list_init3' );

	add_action("load-$supporthost_sample_page", "supporthost_sample_screen_options1"); // for screen option
}
add_action('admin_menu', 'my_add_menu_items1');

// add screen options
function supporthost_sample_screen_options1() {
	global $supporthost_sample_page; global $table;

	$screen = get_current_screen();
	// get out of here if we are not on our settings page
	if(!is_object($screen) || $screen->id != $supporthost_sample_page) return;

	$args = array(
	'label' => __('Item per page', 'supporthost-admin-table'),
	'default' => 10,
	'option' => 'elements_per_page'
	);
	add_screen_option( 'per_page', $args );
	$table = new Supporthost_List_Table1();
}

add_filter('set-screen-option', 'test_table_set_option1', 10, 3);
function test_table_set_option1($status, $option, $value) {
  return $value;
}

// Plugin menu callback function
function supporthost_list_init1() {
	$li_val = "all"; if(isset($_REQUEST['view'])) { $li_val = $_REQUEST['view']; }
	
	$table = new Supporthost_List_Table1();
	echo '<div class="wrap"><h1 class="wp-heading-inline">My Grid</h1>
	<a href="'.admin_url('admin.php?page=supporthost_list2').'" class="page-title-action">Add New</a>
	<hr class="wp-header-end">
	<h2 class="screen-reader-text">Filter posts list</h2>
	<input type="hidden" class="activeon" value="'.$li_val.'" />
	<ul class="subsubsub">
		<li class="all"><a href="'.admin_url('admin.php?page=supporthost_list').'">All</a> |</li>
		<li class="active"><a href="'.admin_url('admin.php?page=supporthost_list&view=active').'">Active</a></li>
	</ul>
	<form method="post">';
	$table->prepare_items();
	ob_start();
	$table->search_box('search', 'search_id');
	$table->display();
	echo '</div></form>';
	$wq_msg = ob_get_clean();
  	echo $wq_msg;
}

function supporthost_list_init2() {
	require_once(CRUD_PLUGIN_PATH.'templates/newx-ajax.php');
}

function supporthost_list_init3() {
	require_once(CRUD_PLUGIN_PATH.'templates/newx-post.php');
}

//Extending class
class Supporthost_List_Table1 extends WP_List_Table{
    private $table_data;
    // Get table data
    private function get_table_data1($type = '',  $search = '') {
        global $wpdb;
        $table = $wpdb->prefix . 'crud';
        if($type == 0) {
        	if ( !empty($search) ) {
	            return $wpdb->get_results(
	                "SELECT * from {$table} WHERE title Like '%{$search}%' OR description Like '%{$search}%' OR sts Like '%{$search}%'",
	                ARRAY_A
	            );
	        } else {
	            return $wpdb->get_results(
	                "SELECT * from {$table}",
	                ARRAY_A
	            );
	        }
        } else {
        	if($search == strtolower('active')){ $search = 1; }
        	return $wpdb->get_results(
                "SELECT * from {$table} WHERE sts = '{$search}'",
                ARRAY_A
            );
        }
    }

    // Define table columns
    function get_columns(){
        $columns = array(
                'cb'            => '<input type="checkbox" />',
                'title'         => __('Title', 'supporthost-admin-table'),
                'description'   => __('Description', 'supporthost-admin-table'),
                'namex'          => __('Name', 'supporthost-admin-table'),
                'chkx'          => __('Check', 'supporthost-admin-table'),
                'sts'          => __('Status', 'supporthost-admin-table'),
                'action'          => __('Action', 'supporthost-admin-table')
        );
        return $columns;
    }

    function process_bulk_action() {
      global $wpdb; //print_r($_REQUEST);
      $table_name = "wp_crud";
      	
      	if('active_all' === $this->current_action()) {
      		$ids = isset($_REQUEST['id']) ? $_REQUEST['id'] : array();
            if (is_array($ids)) $ids = implode(',', $ids);
            if (!empty($ids)) {
            	$wpdb->query("Update $table_name set sts = 1 WHERE id IN($ids)");
            }
        } else if('deactive_all' === $this->current_action()) {
      		$ids = isset($_REQUEST['id']) ? $_REQUEST['id'] : array();
            if (is_array($ids)) $ids = implode(',', $ids);
            if (!empty($ids)) {
            	$wpdb->query("Update $table_name set sts = 0 WHERE id IN($ids)");
            }
        } else if('delete' === $this->current_action()) {
            $ids = isset($_REQUEST['id']) ? $_REQUEST['id'] : array();
            if (is_array($ids)) $ids = implode(',', $ids);
            if (!empty($ids)) {
            	echo $sql = "DELETE FROM $table_name WHERE id IN($ids)";
                //$wpdb->query($sql);
            }
        }
    }

    // Bind table with columns, data and all
    function prepare_items(){
    	global $wpdb,$current_user;
    	$this->process_bulk_action();

    	if(isset($_POST['s'])){
            $this->table_data = $this->get_table_data1(0, $_POST['s']);
        } else if(isset($_GET['view'])) {
            $this->table_data = $this->get_table_data1(1, $_GET['view']);
        } else {
            $this->table_data = $this->get_table_data1(0);
        }

        $columns = $this->get_columns();
        $hidden = ( is_array(get_user_meta( get_current_user_id(), 'managetoplevel_page_supporthost_list_tablecolumnshidden', true)) ) ? get_user_meta( get_current_user_id(), 'managetoplevel_page_supporthost_list_tablecolumnshidden', true) : array();
        $sortable = $this->get_sortable_columns();
        $primary  = 'title';
        $this->_column_headers = array($columns, $hidden, $sortable, $primary);
        usort($this->table_data, array(&$this, 'usort_reorder'));

        /* pagination */
        $per_page = $this->get_items_per_page('elements_per_page', 10);
        $current_page = $this->get_pagenum();
        $total_items = count($this->table_data);
        $this->table_data = array_slice($this->table_data, (($current_page - 1) * $per_page), $per_page);
        $this->set_pagination_args(array(
            'total_items' => $total_items, // total number of items
            'per_page'    => $per_page, // items to show on a page
            'total_pages' => ceil( $total_items / $per_page ) // use ceil to round up
        ));
        $this->items = $this->table_data;
    }

    // set value for each column
    function column_default($item, $column_name){
        switch ($column_name) {
            case 'id':
            	return $item[$column_name];
            case 'title':
				return $this->column_name1($item);
            case 'description':
            	return $item[$column_name];
            case 'namex':
            	return $item[$column_name];
            case 'chkx':
            	if($item['chkx'] == 0) {
            		echo "Not Check";
            	} else {
            		echo "Check";
            	}
            	break;
            case 'sts':
            	if($item['sts'] == 0) {
            		echo "Deactive";
            	} else {
            		echo "Active";
            	}
            	break;
            case 'action':
            	//<a href="'.admin_url('admin.php?page=supporthost_list2&id='.$item['id']).'">Edit</a> | 
            	$datx = '<input type="button" class="button button-primary button-large chn_sts" value="Change Sts" data-val="'.$item['id'].'">';
            	return $item['action'] = $datx; 
            default:
                return $item[$column_name];
        }
    }

    // Add a checkbox in the first column
    function column_cb($item){
        return sprintf('<input type="checkbox" name="id[]" value="%s" />',$item['id'] );
    }

    // Define sortable column
    protected function get_sortable_columns(){
        $sortable_columns = array(
            'title'  => array('title', false),
            'description'  => array('description', false),
            'chkx'  => array('chkx', false),
            'sts'  => array('sts', false),
        );
        return $sortable_columns;
    }

    // Sorting function
    function usort_reorder($a, $b){
        // If no sort, default to user_login
        $orderby = (!empty($_GET['orderby'])) ? $_GET['orderby'] : 'title';
        // If no order, default to asc
        $order = (!empty($_GET['order'])) ? $_GET['order'] : 'asc';
        // Determine sort order
        $result = strcmp($a[$orderby], $b[$orderby]);
        // Send final sort direction to usort
        return ($order === 'desc') ? $result : -$result;
    }

    // Adding action links to column
    function column_name1($item){
        $actions = array(
			'edit'      => sprintf('<a href="?page=%s&action=%s&id=%s">' . __('Edit', 'supporthost-admin-table') . '</a>', 'supporthost_list2', 'edit', $item['id']),
			'delete'    => sprintf('<a href="?page=%s&action=%s&id=%s">' . __('Delete', 'supporthost-admin-table') . '</a>', $_REQUEST['page'], 'delete', $item['id']),
        );
        return sprintf('%1$s %2$s', $item['title'], $this->row_actions($actions));
    }

    // To show bulk action dropdown
    function get_bulk_actions(){
        $actions = array(
            'delete'    => __('Delete All', 'supporthost-admin-table'),
            'deactive_all' => __('Deactive All Status', 'supporthost-admin-table'),
            'active_all' => __('Active All Status', 'supporthost-admin-table'),
        );
        return $actions;
    }
}