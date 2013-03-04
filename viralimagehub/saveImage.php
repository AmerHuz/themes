<?php
require('../../../wp-blog-header.php');
global $wpdb;

require_once(ABSPATH . "wp-admin" . '/includes/image.php');
require_once(ABSPATH . "wp-admin" . '/includes/file.php');
require_once(ABSPATH . "wp-admin" . '/includes/media.php');


$data = $_POST["img"];
$file = "/images/memes/".md5(date('Y-m-d H:i:s:u')).".png";

$uri = substr($data,strpos($data,",")+1);
$encodedData = str_replace(' ','+',$uri);
$decodedData = base64_decode($encodedData);


file_put_contents(".".$file, $decodedData );

$imgurl = get_bloginfo("template_directory").$file;

if (!empty($_POST["name"])){
	$memename = $_POST["name"];
}
else{
	$memename = "MEME";
}

if (!empty($_POST["category"])){
	$category = $_POST["category"];
}
else{
	$category = 1;
}

$my_post = array(
  'post_title'    =>$memename,
  'post_content'  => '<img src = "'.$imgurl.'" />',
  'post_status'   => 'publish',
   'post_author'   => 1,
  'post_category' => array($category)
);

$post_id = wp_insert_post( $my_post );

$return = media_sideload_image($imgurl,$post_id);



echo "OK";

?>