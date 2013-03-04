<?php

function addPostFields(){
	add_meta_box(  'methPostSettings', 'Ad Settings','addPostFieldsCallback', 'post'); 
	add_meta_box(  'methPostSettings', 'Ad Settings','addPostFieldsCallback', 'page'); 
}

function addPostFieldsCallback(){
	$post_id = get_the_ID();
	$methPostBanners= get_post_meta($post_id, 'methPostBanners', TRUE);
	$methPostPopUps = get_post_meta($post_id, 'methPostPopUps', TRUE);
	
	wp_nonce_field( 'methThemeNonce', 'methNoncename' );
	echo '
		Post Banner Codes: <br />
		<textarea name ="methPostBanners"  rows = "7" cols = "100">'.$methPostBanners.'</textarea><br />
		Post Pop-Up URLs: <br />
		<textarea name ="methPostPopUps"  rows = "7" cols = "100">'.$methPostPopUps.'</textarea>';
}	

function savePostFields(){
	 // verify if this is an auto save routine. 
	// If it is our form has not been submitted, so we dont want to do anything
	$post_id = get_the_ID();
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
	return;

	  // verify this came from the our screen and with proper authorization,
	  // because save_post can be triggered at other times

	if ( !wp_verify_nonce( $_POST['methNoncename'], 'methThemeNonce' ) )
	return;
	
	 // Check permissions
	if ( ( isset ( $_POST['post_type'] ) ) && ( 'page' == $_POST['post_type'] )  ) {
		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return;
		}		
	}
	else {
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
	}
	
	$methPostBanners = $_POST['methPostBanners'];   	
	update_post_meta($post_id, 'methPostBanners',$methPostBanners);	
	
	$methPostPopUps = $_POST['methPostPopUps'];   	
	update_post_meta($post_id, 'methPostPopUps', $methPostPopUps);
	
	
	
}	
?>