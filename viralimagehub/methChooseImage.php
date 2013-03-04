<?php

function meth_chooseImage() {

$imgsrc = get_bloginfo("template_directory")."/images/memepics/";
$siteurl = get_option('siteurl');
$memeGenerator  = $siteurl . '/wp-admin/admin.php?page=memetheme2';
$imageUpload = get_bloginfo("template_directory")."/imageUpload.php";
$manual  =  get_bloginfo("template_directory")."/manual.pdf";
echo'<h2><a href = "'.$manual.'">Manual</a> Read This First!</h2>';
echo '<h2>Upload Your Own Image (png, jpg or gif only)</h2>
<form action="'.$imageUpload.'" method="post"
enctype="multipart/form-data">
<label for="file">Filename:</label>
<input type="file" name="file" id="file" />
<input type="submit" name="submit" value="Submit" />
</form>';


echo '<h2>Or Choose An Image</h2>';

for ($x= 1; $x<50 ; $x++){
	echo '<a href = "'.$memeGenerator.'&img='.$x.'"><img src = "'.$imgsrc.$x.'.jpg" width="125" height="100"/></a>';
}



}

function meth_choosePoster() {

$imgsrc = get_bloginfo("template_directory")."/images/memepics/";
$siteurl = get_option('siteurl');
$memeGenerator  = $siteurl . '/wp-admin/admin.php?page=memethemeposter2';
$imageUpload = get_bloginfo("template_directory")."/posterUpload.php";
$manual  =  get_bloginfo("template_directory")."/manual.pdf";
echo'<h2><a href = "'.$manual.'">Manual</a> Read This First!</h2>';
echo '<h2>Upload Your Own Image (png, jpg or gif only)</h2>
<form action="'.$imageUpload.'" method="post"
enctype="multipart/form-data">
<label for="file">Filename:</label>
<input type="file" name="file" id="file" />
<input type="submit" name="submit" value="Submit" />
</form>';


echo '<h2>Or Choose An Image</h2>';

for ($x= 1; $x<50 ; $x++){
	echo '<a href = "'.$memeGenerator.'&img='.$x.'"><img src = "'.$imgsrc.$x.'.jpg" width="125" height="100"/></a>';
}



}



?>