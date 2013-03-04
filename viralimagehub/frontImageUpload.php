<?php
require('../../../wp-blog-header.php');
global $wpdb;
$imgsrc = "./images/uploads/";
$siteurl = get_option('siteurl');
$memeGenerator =  get_bloginfo("template_directory")."/frontMemeGenerator.php";
	
$allowedExts = array("jpg", "jpeg", "gif", "png");
$extension = end(explode(".", $_FILES["file"]["name"]));
if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/png")
|| ($_FILES["file"]["type"] == "image/pjpeg"))
&& in_array($extension, $allowedExts))
  {
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
    }
  else
    {
    
    if (file_exists("upload/" . $_FILES["file"]["name"]))
      {
      header("Location: ".$memeGenerator."?file=".$_FILES["file"]["name"]);
      }
    else
      {
      move_uploaded_file($_FILES["file"]["tmp_name"],
      $imgsrc.$_FILES["file"]["name"]);
	header("Location: ".$memeGenerator."?file=".$_FILES["file"]["name"]);
      }
    }
  }
else
  {
  echo "Invalid file";
  }
 ?> 

 