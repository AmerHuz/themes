<?php
	
	require('../../../wp-blog-header.php');
	global $wpdb;
	$options = get_option( 'mansion_theme_options' ); 
	 if ($options["publicGens"]== "yes"){	
		$imgsrc = get_bloginfo("template_directory")."/images/memepics/";
		$siteurl = get_option('siteurl');
		$memeGenerator =  get_bloginfo("template_directory")."/frontPosterMemeGenerator.php";
		$imageUpload = get_bloginfo("template_directory")."/frontPosterImageUpload.php";
		$options = get_option( 'mansion_theme_options' );
		$textColor = $options['textColor'];
		if (empty($textColor)){
				$textColor = "white";
		}
		$backgroundColor = $options['backgroundColor'];
		if (empty($backgroundColor)){
				$backgroundColor = "black";
		}
		$content =  '
		<style>
			   body {
				margin: 0px;
				padding: 20px;
				background-color:'. $backgroundColor.';
				color: '. $textColor.';
			}
			.frontImgChooser{
				color: '.$textColor.';
			
			}
		</style>
		<div class = "frontImgChooser">
		<h2>Upload Your Own Image (png, jpg or gif only)</h2>
		<form action="'.$imageUpload.'" method="post"
		enctype="multipart/form-data">
		<label for="file">Choose File: </label>
		<input type="file" name="file" id="file" />
		<input type="submit" name="submit" value="Submit" />
		</form>';


		$content.= '<h2>Or Choose An Image</h2>';

		for ($x= 1; $x<50 ; $x++){
			$content.= '<a href = "'.$memeGenerator.'?img='.$x.'"><img src = "'.$imgsrc.$x.'.jpg" width="125" height="100"/></a>';
		}
		$content.= '</div>';
		echo $content;
	}
	
?>	
