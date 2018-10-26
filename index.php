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

	add_action( 'admin_menu', 'add_plugin_menu' );

	function add_plugin_menu() {
		remove_menu_page( 'index.php' );                  //Dashboard
		remove_menu_page( 'edit.php' );                   //Posts
		remove_menu_page( 'edit-comments.php' );          //Comments
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
		add_menu_page( '帳號管理', '帳號管理', 'edit_users', 'efc-accounts-menu', 'efc_accounts_management' );
	}

	function efc_products_management() {
		if ( !current_user_can( 'read' ) )  {
			wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
		}
		echo '<div class="wrap">';
		echo '<p>從此處設定產品資訊</p>';
		echo '</div>';
	}
	function efc_investors_management() {
		if ( !current_user_can( 'read' ) )  {
			wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
		}
		echo '<div class="wrap">';
		echo '<p>從此處設定公司財務及股務相關資料</p>';
		echo '</div>';
	}
	function efc_news_management() {
		if ( !current_user_can( 'read' ) )  {
			wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
		}
		echo '<div class="wrap">';
		echo '<p>從此處設定公司相關新聞</p>';
		echo '</div>';
	}
	function efc_activities_management() {
		if ( !current_user_can( 'read' ) )  {
			wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
		}
		echo '<div class="wrap">';
		echo '<p>從此處設定公司活動資料</p>';
		echo '</div>';
	}	
	function efc_accounts_management() {
		echo '<div><p>設定帳號權限</p>';
		include_once em_path . 'accounts_management.php';
		echo '</div>';
	}