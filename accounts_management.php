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
			foreach ( $wp_user_search as $userid ) {
				$user_id       = (int) $userid->ID;
				$user_login    = stripslashes($userid->user_login);
				$display_name  = stripslashes($userid->display_name);
				echo "<div><label>$user_id</label><label>$user_login</label><label>$display_name</label></div>";
			}
		}else{
			echo "<div><label>No users to edit.</label></div>";
		}
	}
}catch(\Exception $ex){
	echo $ex->getMessage();
}
?>
</div>