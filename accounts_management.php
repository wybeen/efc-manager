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
?>			
	<table class="wp-list-table widefat fixed striped pages">
	<tr>
		<th class="manage-column">帳號編碼</th>
		<th class="manage-column">帳號</th>
		<th class="manage-column">姓名</th>
		<th class="manage-column">產品管理權限</th>
		<th class="manage-column">投資人專區權限</th>
		<th class="manage-column">新聞中心權限</th>
		<th class="manage-column">活動花絮權限</th>
	</tr>
<?php	
			foreach ( $wp_user_search as $userid ) {
				$user_id       = (int) $userid->ID;
				$user_login    = stripslashes($userid->user_login);
				$display_name  = stripslashes($userid->display_name);
?>				
	<tr>
		<td><?php echo $user_id; ?></td>
		<td><?php echo $user_login; ?></td>
		<td><?php echo $display_name; ?></td>
		<td ><input type='checkbox'></td>
		<td><input type='checkbox'></td>
		<td><input type='checkbox'></td>
		<td><input type='checkbox'></td>
	</tr>
<?php				
			}
?>
	</table>
	<div><inpu type="button" value="儲存" /><inpu type="button" value="取消" /></div>
<?php				
		}else{
			echo "<div><label>No users to edit.</label></div>";
		}
	}
}catch(\Exception $ex){
	echo $ex->getMessage();
}
?>

</div>