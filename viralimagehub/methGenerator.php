<?php


function meth_submenu_page_callback(){

	$imgsrc = get_bloginfo("template_directory")."/images/memepics/";
	$img = $_GET["img"]; 
	$file = $_GET["file"];
	if (isset($img)){
		$iframesrc = get_bloginfo("template_directory")."/methGeneratorIframe.php?img=".$img;
		echo '
		<iframe src = "'.$iframesrc.'" frameborder = "0" height = "1000" width = "1000"></iframe>';
	}

	else {
		$iframesrc = get_bloginfo("template_directory")."/methGeneratorIframe.php?file=".$file;
		echo '
		<iframe src = "'.$iframesrc.'" frameborder = "0" height = "1000" width = "1000"></iframe>';

	}
}

function meth_submenu_poster_callback(){

	$imgsrc = get_bloginfo("template_directory")."/images/memepics/";
	$img = $_GET["img"]; 
	$file = $_GET["file"];
	if (isset($img)){
		$iframesrc = get_bloginfo("template_directory")."/posterGeneratorIframe.php?img=".$img;
		echo '
		<iframe src = "'.$iframesrc.'" frameborder = "0" height = "1000" width = "1000"></iframe>';
	}

	else {
		$iframesrc = get_bloginfo("template_directory")."/posterGeneratorIframe.php?file=".$file;
		echo '
		<iframe src = "'.$iframesrc.'" frameborder = "0" height = "1000" width = "1000"></iframe>';

	}

}

?>