<?php


function addCategoryFields(){

	/*
	* configure taxonomy custom fields
	*/
	$config = array(
	   'id' => 'category_ad_settings',                         // meta box id, unique per meta box
	   'title' => 'Category Ad Setting',                      // meta box title
	   'pages' => array('category'),                    // taxonomy name, accept categories, post_tag and custom taxonomies
	   'context' => 'normal',                           // where the meta box appear: normal (default), advanced, side; optional
	   'fields' => array(),                             // list of meta fields (can be added by field arrays)
	   'local_images' => false,                         // Use local or hosted images (meta box images for add/remove)
	   'use_with_theme' => true                        //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
	   );
	/*
	* Initiate your taxonomy custom fields
	*/
	
	$categoryBanners = get_tax_meta($term_id,'categoryBanners');
	$categoryPopUnders = get_tax_meta($term_id,'categoryPopUnders');
	
	$my_meta = new Tax_Meta_Class($config);
	$my_meta->addTextarea('categoryBanners',array('name'=> 'Category Banner Codes', 'std'=>$categoryBanners));
	$my_meta->addTextarea('categoryPopUnders',array('name'=> 'Category PopUnder URLs', 'std'=>$categoryPopUnders));
	$my_meta->Finish();
}


?>