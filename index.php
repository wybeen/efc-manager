<?php
/*
Plugin Name: EFC Manager
Plugin URI: http://www.efctw.com/
Description: To deal with funtions to enable website management
Version: 1.0
Author: EFC
Author URI: http://www.efctw.com/
*/

	require_once(ABSPATH.'wp-admin/includes/plugin.php');
	
	$plugin_data = get_plugin_data( __FILE__ );

	define('em_url',plugin_dir_url(__FILE__ ));
	define('em_path',plugin_dir_path(__FILE__ ));
	define('em_plugin', plugin_basename( __FILE__ ) );
	
	define('efcmanager_version', $plugin_data['Version'] );
	
	$plugin = em_plugin;
	
	/***
	***	@Init
	***/
	//require_once em_path . 'em-init.php';
	
	/***
	***	@Display a welcome page
	***/
	function efcmanager_activation_hook( $plugin ) {

		if( $plugin == em_plugin && get_option('em_version') != efcmanager_version ) {
		
			update_option('em_version', efcmanager_version );
			
			//exit( wp_redirect( admin_url('admin.php?page=ultimatemember-about')  ) );
			
		}

	}
	add_action( 'activated_plugin', 'efcmanager_activation_hook' );

	function create_post_type() {
		register_post_type( 'efc_product',
			array(
		    	'labels' => array(
		    		'name' => __( 'Products' ),
		    		'singular_name' => __( 'Product' ),
				    'add_new' => _x( '新增產品', '新增一項產品說明' ),
				    'add_new_item' => __( '新增產品' ),
				    'edit_item' => __( '修改產品' ),
				    'new_item' => __( '新產品' ),
				    'all_items' => __( '所有產品' ),
				    'view_item' => __( '檢視產品' ),
				    'search_items' => __( '搜尋產品' ),
				    'not_found' => __( '找不到相關的產品' ),
				    'not_found_in_trash' => __( '回收桶裡沒有相關的產品' ),
				    'parent_item_colon' => '',
				    'menu_name' => '產品管理專區'
		    	),
		    	'public' => true,
		    	'has_archive' => true,
		    )
		);
		register_taxonomy( 'efc_product_category', 'efc_prodcut', 
			array(
				'labels' => array(
					'name'              => _x( '產品類別', 'taxonomy' ),
					'singular_name'     => _x( '產品分類', 'taxonomy' ),
					'search_items'      => __( '搜索產品分類' ),
					'all_items'         => __( '所有產品分類' ),
					'parent_item'       => __( '該產品分類的上層分類' ),
					'parent_item_colon' => __( '該產品分類的上層分類：' ),
					'edit_item'         => __( '編輯產品分類' ),
					'update_item'       => __( '更新產品分類' ),
					'add_new_item'      => __( '增加新的產品分類' ),
					'new_item_name'     => __( '新產品分類' ),
					'menu_name'         => __( '產品分類' ),
				),
				'hierarchical' => true,
			)
		);
		register_post_type( 'efc_investor',
			array(
		    	'labels' => array(
		    		'name' => __( 'Investors' ),
		    		'singular_name' => __( 'Investor' ),
				    'add_new' => _x( '新增投資人專區資訊', '新增投資人專區資訊' ),
				    'add_new_item' => __( '新增投資人專區資訊' ),
				    'edit_item' => __( '修改投資人專區資訊' ),
				    'new_item' => __( '新投資人專區資訊' ),
				    'all_items' => __( '所有投資人專區資訊' ),
				    'view_item' => __( '檢視投資人專區資訊' ),
				    'search_items' => __( '搜尋投資人專區資訊' ),
				    'not_found' => __( '找不到相關的投資人專區資訊' ),
				    'not_found_in_trash' => __( '回收桶裡沒有相關的投資人專區資訊' ),
				    'parent_item_colon' => '',
				    'menu_name' => '投資人專區'
		    	),
		    	'public' => true,
		    	'has_archive' => true,
		    )
		);		
		register_post_type( 'efc_news',
			array(
		    	'labels' => array(
		    		'name' => __( 'News' ),
		    		'singular_name' => __( 'News' ),
				    'add_new' => _x( '新增新聞', '新增新聞' ),
				    'add_new_item' => __( '新增新聞' ),
				    'edit_item' => __( '修改新聞' ),
				    'new_item' => __( '新新聞' ),
				    'all_items' => __( '所有新聞' ),
				    'view_item' => __( '檢視新聞' ),
				    'search_items' => __( '搜尋新聞' ),
				    'not_found' => __( '找不到相關的新聞' ),
				    'not_found_in_trash' => __( '回收桶裡沒有相關的新聞' ),
				    'parent_item_colon' => '',
				    'menu_name' => '新聞專區'
		    	),
		    	'public' => true,
		    	'has_archive' => true,
		    )
		);				
		register_post_type( 'efc_activity',
			array(
		    	'labels' => array(
		    		'name' => __( 'Activities' ),
		    		'singular_name' => __( 'Activity' ),
				    'add_new' => _x( '新增活動花絮', '新增活動花絮' ),
				    'add_new_item' => __( '新增活動花絮' ),
				    'edit_item' => __( '修改活動花絮' ),
				    'new_item' => __( '新活動花絮' ),
				    'all_items' => __( '所有活動花絮' ),
				    'view_item' => __( '檢視活動花絮' ),
				    'search_items' => __( '搜尋活動花絮' ),
				    'not_found' => __( '找不到相關的活動花絮' ),
				    'not_found_in_trash' => __( '回收桶裡沒有相關的活動花絮' ),
				    'parent_item_colon' => '',
				    'menu_name' => '活動花絮專區'
		    	),
		    	'public' => true,
		    	'has_archive' => true,
		    )
		);						
	}
	add_action( 'init', 'create_post_type' );


	function modify_editor( $post ) {
		$custom_types = array('efc_product', 'efc_investor', 'efc_news', 'efc_activity' );
		$type = get_post_type( $post );
		if ( in_array( $type, $custom_types) ) {
			include_once em_path . $type . '.php';
		}
	}

	add_action( 'edit_form_after_title', 'modify_editor');
	add_action( 'admin_menu', 'add_plugin_menu' );

	function add_plugin_menu() {
		remove_menu_page( 'index.php' );                  //Dashboard
		remove_menu_page( 'edit.php' );                   //Posts
		remove_menu_page( 'edit-comments.php' );          //Comments
	}


	/***
	Deal with account privilige
	***/
	function add_extra_user_column($columns) {
		$c = array(
			'cb'       => '<input type="checkbox" />',
			'username' => __( 'Username' ),
			'name'     => __( 'Name' ),
			'email'    => __( 'E-mail' ),
			'role'     => __( 'Role' )
		);
    	return array_merge( $c, 
        	      array('edit_product' => __('產品專區'), 
				  'edit_investor' => __('投資人專區'), 
				  'edit_news' => __('新聞中心'), 
				  'edit_activity' => __('活動花絮')) );
	}
	add_filter('manage_users_columns' , 'add_extra_user_column');	
	add_action('manage_users_custom_column',  'show_customized_user_column_content', 10, 3);
	function show_customized_user_column_content($value, $column_name, $user_id) {
    	$caps = array('edit_product','edit_investor','edit_news','edit_activity');
		if ( in_array( $column_name, $caps) )
			return '<input type="checkbox" id="' . $column_name . '_' . $user_id . '" />';
		return $value;
	}
	add_action('admin_head-users.php', 'customized_user_column_width');
	function my_admin_column_width() {
		echo '<style type="text/css">
			.column-edit_product, .column-edit_investor, .column-edit_news, .column-edit_activity { text-align: center; width: 6% !important; vertical-align: middle; }
		</style>';
	}
