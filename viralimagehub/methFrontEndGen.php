<?php


function createGenPage(){
	$imagegen = get_page_by_title( 'Image Generator');		
	wp_delete_post( $imagegen->ID, true ); 
	
	$iframesrc = get_bloginfo("template_directory")."/frontImageChooser.php";
	$my_post = array(
	'post_title'    => 'Image Generator',
	'post_content'  => '<iframe src = "'.$iframesrc.'" frameborder = "0" height = "1200" width = "1000"></iframe>',
	'post_status'   => 'publish',
	'post_author'   => 1,
	'post_category' => array(1),
	'post_type' => 'page'
	);
	wp_insert_post( $my_post );
}
	
	
function createPosterGenPage(){
	$postergen = get_page_by_title( 'Poster Generator');	
	wp_delete_post( $postergen->ID, true ); 
	 
	$iframesrc = get_bloginfo("template_directory")."/frontPosterImageChooser.php";
	$my_post = array(
	'post_title'    => 'Poster Generator',
	'post_content'  => '<iframe src = "'.$iframesrc.'" frameborder = "0" height = "1200" width = "1000"></iframe>',
	'post_status'   => 'publish',
	'post_author'   => 1,
	'post_category' => array(1),
	'post_type' => 'page'
	);
	wp_insert_post( $my_post );
}
	
  




?>