<div>
<?php
if ( !current_user_can( 'edit_user' ) )  {
	wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
}
try{
	global $wpdb;	
	$wp_user_search = $wpdb->get_results(
		"
		SELECT ID, user_login, display_name 
		FROM $wpdb->users 
		ORDER BY ID
		"
	);
	if ( is_wp_error( $wp_user_search ) ) {
    	$error_string = $wp_user_search->get_error_message();
    	echo '<div id="message" class="error"><p>' . $error_string . '</p></div>';
	} else {
		if (count($wp_user_search)> 0){
			echo '<table class="wp-list-table widefat fixed striped pages">';
			echo '<tr><th class="manage-column">帳號編碼</th><th class="manage-column">帳號</th><th class="manage-column">姓名</th><th class="manage-column">產品管理權限</th><th class="manage-column">投資人專區權限</th><th class="manage-column">新聞中心權限</th><th class="manage-column">活動花絮權限</th></tr>';
			foreach ( $wp_user_search as $userid ) {
				$user_id       = (int) $userid->ID;
				$user_login    = stripslashes($userid->user_login);
				$display_name  = stripslashes($userid->display_name);
				echo "<tr><td>$user_id</td><td>$user_login</td><td>$display_name</td><td></td><td></td><td></td><td></td></tr>";
			}
			echo "</table>";
		}else{
			echo "<div><label>No users to edit.</label></div>";
		}
	}
}catch(\Exception $ex){
	echo $ex->getMessage();
}
?>
</div>