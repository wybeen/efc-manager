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
/*
		add_menu_page( '產品管理', '產品管理功能', 'read', 'efc-products-menu', 'efc_products_management' );
		add_submenu_page('efc-products-menu', '產品分類設定', '產品分類設定', 'read', 'efc-products-catalog-menu' );
		add_submenu_page('efc-products-menu', '產品資料設定', '產品資料設定', 'read', 'efc-products-detail-menu' );
		add_menu_page( '投資人專區管理', '投資人專區管理', 'read', 'efc-investors-menu', 'efc_investors_management' );
		add_submenu_page('efc-investors-menu', '每月營業額報告', '每月營業額報告', 'read', 'efc-investors-monthly-menu' );
		add_submenu_page('efc-investors-menu', '財務報表', '財務報表', 'read', 'efc-investors-finance-menu' );
		add_submenu_page('efc-investors-menu', '法人說明會', '法人說明會', 'read', 'efc-investors-artificial-menu' );
		add_submenu_page('efc-investors-menu', '公司年報', '公司年報', 'read', 'efc-investors-yearly-menu' );
		add_submenu_page('efc-investors-menu', '股東會', '股東會', 'read', 'efc-investors-shareholders-menu' );
		add_menu_page( '新聞中心管理', '新聞中心管理', 'read', 'efc-news-menu', 'efc_news_management' );
		add_menu_page( '活動花絮管理', '活動花絮管理', 'read', 'efc-activities-menu', 'efc_activities_management' );
*/		
		add_menu_page( '帳號管理', '帳號管理', 'edit_users', 'efc-accounts-menu', 'efc_accounts_management' );
	}
/*
	add_action("manage_posts_custom_column",  "movie_custom_columns");
	add_filter("manage_edit-movie_columns", "movie_edit_columns");
	function movie_custom_columns($column){
    	global $post;
    	switch ($column) {
        	case "movie_director":
            	echo get_post_meta( $post->ID, '_movie_director', true );
            	break;
    	}
	}
	function movie_edit_columns($columns){
    	$columns['movie_director'] = '导演';
    	return $columns;
	}	
*/
	function add_extra_user_column($columns) {
    	return array_merge( $columns, 
        	      array('edit_product' => __('產品專區'), 'edit_investor' => __('投資人專區'), 'edit_news' => __('新聞中心'), 'edit_activity' => __('活動花絮')) );
	}
	add_filter('manage_users_columns' , 'add_extra_user_column');	
	
	function efc_accounts_management() {
		echo '<div><p>設定帳號權限</p>';
		include_once em_path . 'accounts_management.php';
		echo '</div>';
	}