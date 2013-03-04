<?php

//add theme options
require_once ( TEMPLATEPATH . '/includes/theme-options.php' );

if ( function_exists('register_sidebar') )
    register_sidebar();

// Add Post Thumbnail Theme Support
if ( function_exists( 'add_theme_support' ) ) { 
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'featured', 401, 301, true );
}

// Load Text Domain
load_theme_textdomain('gpp',get_template_directory().'/lang');


$includes_path = TEMPLATEPATH . '/includes/';

// load javascripts
require_once ($includes_path . 'theme-js.php');

// Load Post Images
require_once ($includes_path . 'images.php');

// Add Menu Theme Support
if ( function_exists( 'add_theme_support' ) ) { 
	add_theme_support( 'nav-menus' );
	add_action( 'init', 'register_gpp_menus' );

	function register_gpp_menus() {
		register_nav_menus(
			array(
				'main-menu' => __( 'Main Menu', 'gpp' )
			)
		);
	}
}


//get thumbnail
function postimage($size=medium) {
	if ( $images = get_children(array(
		'post_parent' => get_the_ID(),
		'post_type' => 'attachment',
		'numberposts' => 1,
		'order' => 'ASC',
		'post_mime_type' => 'image',)))
	{
		foreach( $images as $image ) {
			$attachmentimage=wp_get_attachment_image( $image->ID, $size );
			echo $attachmentimage.apply_filters('the_title', $parent->post_title);
		}
	} 
}

//get thumbnails
function postimages($size=medium) {
	if ( $images = get_children(array(
		'post_parent' => get_the_ID(),
		'post_type' => 'attachment',
		'post_mime_type' => 'image')))
	{
		foreach( $images as $image ) {
			$attachmenturl=wp_get_attachment_url($image->ID);
			
			if($size=='featured') {
				$attachmentimage=wp_get_attachment_image( $image->ID, array(401, 301) );
			} else {
				$attachmentimage=wp_get_attachment_image( $image->ID, $size );
			}
			
			
			$imagelink=get_permalink($image->post_parent);

			echo '<div class="box"><a href="'.$imagelink.'">'.$attachmentimage.apply_filters('the_title', $parent->post_title).'</a></div>';
		}
	} 
}


//check any attachment 
function checkimage($size=medium) {
	if ( $images = get_children(array(
		'post_parent' => get_the_ID(),
		'post_type' => 'attachment',
		'numberposts' => 1,
		'post_mime_type' => 'image',)))
	{
		foreach( $images as $image ) {
			$attachmentimage=wp_get_attachment_image( $image->ID, $size );
			return $attachmentimage;
		}
	} 
}

function trim_excerpt($text) {
  return rtrim($text,'[...]');
}
add_filter('get_the_excerpt', 'trim_excerpt');
function new_excerpt_length($length) {
	return 30;
}
add_filter('excerpt_length', 'new_excerpt_length');

/************************************CHANGES***********/
include 'methChooseImage.php';
include 'methGenerator.php';
include 'methFrontEndGen.php';

add_action("after_switch_theme", "createGenPage", 10 ,  2);



add_action('admin_menu', 'meth_menu');
add_action('admin_menu', 'meth_submenu_page');



function meth_menu(){
	add_menu_page( 'Meme Generator', 'Meme Generator', 'manage_options', 'memetheme', 'meth_chooseImage' );
}	

function meth_submenu_page() {
	add_submenu_page( NULL, 'Meme Generator', 'Meme Generator', 'manage_options', 'memetheme2', 'meth_submenu_page_callback' ); 
}


require_once("Tax-meta-class/Tax-meta-class.php");
include "methCategories.php";
include "methPosts.php";


add_action( 'add_meta_boxes', 'addPostFields' );
add_action( 'save_post', 'savePostFields' );


addCategoryFields();

function getCategoryAds($categories){
	foreach($categories as $category){			
		$term_id = $category->term_id;
		$bannerCodes = get_tax_meta($term_id,'categoryBanners');					
	}				
	$bannerCodesArray = explode(",",$bannerCodes);
	$numOfBanners = count($bannerCodesArray);				
	$randomChoice = rand(0, $numOfBanners -1) ;
	$chosenBanner = stripslashes($bannerCodesArray[$randomChoice ]);	
	if (strpos($chosenBanner,"</a>")==false){
		$chosenBanner = stripslashes($bannerCodesArray[$randomChoice-1]);	
	}
	return $chosenBanner;
}

function getPostAds($post_id){
	$bannerCodes = get_post_meta($post_id, 'methPostBanners', TRUE);
	$bannerCodesArray = explode(",",$bannerCodes);
	$numOfBanners = count($bannerCodesArray);				
	$randomChoice = rand(0, $numOfBanners -1) ;
	$chosenBanner = stripslashes($bannerCodesArray[$randomChoice ]);	
	if (strpos($chosenBanner,"</a>")==false){
		$chosenBanner = stripslashes($bannerCodesArray[$randomChoice-1]);	
	}
	return $chosenBanner;
}

function getSiteAds(){
	$options = get_option( 'mansion_theme_options' );
	$bannerCodes = $options['siteBannerURLs'];
	$bannerCodesArray = explode(",",$bannerCodes);		
	$numOfBanners = count($bannerCodesArray);
	$randomChoice = rand(0, $numOfBanners -1) ;
	$chosenBanner =  $bannerCodesArray[$randomChoice];
	if (strpos($chosenBanner,"</a>")==false){
		$chosenBanner = stripslashes($bannerCodesArray[$randomChoice-1]);	
	}
	return $chosenBanner;

}

function getSitePopUnders(){

	$options = get_option( 'mansion_theme_options' );
	$popUnders = $options['sitePopUnderURLs'];
	$popUndersArray = explode(",",$popUnders);
	$numOfPopUps = count($popUndersArray);
	$randomChoice = rand(0, $numOfPopUps -1) ;
	$chosenPopup = trim($popUndersArray[$randomChoice]);
	if (strpos($chosenPopup,":")==false){
		$chosenPopup = stripslashes($popUndersArray[$randomChoice-1]);	
	}	
	return $chosenPopup;
}

function getCategoryPopUnders($categories){
	foreach($categories as $category){			
		$term_id = $category->term_id;
		$bannerCodes = get_tax_meta($term_id,'categoryPopUnders');					
	}
	$bannerCodesArray = explode(",",$bannerCodes);
	$numOfBanners = count($bannerCodesArray);				
	$randomChoice = rand(0, $numOfBanners -1) ;
	$chosenBanner = stripslashes($bannerCodesArray[$randomChoice ]);	
	if (strpos($chosenBanner,":")==false){
		$chosenBanner = stripslashes($bannerCodesArray[$randomChoice-1]);	
	}	
	return $chosenBanner;
}

function getPostPopUnders($post_id){
	$bannerCodes = get_post_meta($post_id, 'methPostPopUps', TRUE);
	$bannerCodesArray = explode(",",$bannerCodes);
	$numOfBanners = count($bannerCodesArray);				
	$randomChoice = rand(0, $numOfBanners -1) ;
	$chosenBanner = stripslashes($bannerCodesArray[$randomChoice ]);	
	if (strpos($chosenBanner,":")==false){
		$chosenBanner = stripslashes($bannerCodesArray[$randomChoice-1]);	
	}
	return $chosenBanner;
}

?>
