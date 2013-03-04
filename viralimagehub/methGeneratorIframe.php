<?php
require('../../../wp-blog-header.php');
global $wpdb;

$site = get_site_url();
if (strstr($site, "http://www.")){
	$site = substr($site, 11);
}
else{
	$site = substr($site, 7);
}
$kineticscript = get_bloginfo('template_directory').'/includes/js/kinetic-v4.0.5.min.js';
$manual  =  get_bloginfo("template_directory")."/manual.pdf";
?>
<!DOCTYPE HTML>
<html>
  <head>
    <style>
      body {
        margin: 0px;
        padding: 20px;
      }
      canvas {
        border: 1px solid #9C9898;
      }
      
      .config{
	margin-top: 20px;
	border-width: 2px;
	border-style: solid;	
	border-color: black;
	width: 425px;
	font-weight: bold;
	background-color: lightgrey;	
      }
      
      #saving{
	background-color: red;	
	color: white;
	font-weight: bold;
	font-size: 20px;
	border-top-style: solid;
	border-width: 2px;
	border-color: black;
	padding: 2px;	
	margin-top: 5px;
	display :none;
      }
      #saved{
	background-color: green;	
	color: white;
	font-weight: bold;
	font-size: 20px;
	border-top-style: solid;
	border-width: 2px;
	border-color: black;
	padding: 2px;	
	margin-top: 5px;
	display :none;
      }
      #buttons{
	margin-left: 270px;
      }
      
     
     
    </style>
   
      <script src="<?php echo $kineticscript; ?>"></script>

    <script>
	window.onload = function() {
		
		var stage = new Kinetic.Stage({
			container: "container",
			width: 578,
			height: 200
		});
		var layer = new Kinetic.Layer();
		var background = new Kinetic.Layer();
		var rectX = stage.getWidth() / 2 - 50;
		var rectY = stage.getHeight() / 2 - 25;
		
		var box = new Kinetic.Rect({
			x: rectX,
			y: rectY,
			width: 100,
			height: 50,
			fill: "#00D2FF",
			stroke: "black",
			strokeWidth: 4,
			draggable: true
		});

		var line1 = new Kinetic.Text({
			x: 190,
			y: 40,
			text: "Line 1",
			fontSize: 30,
			fontFamily: "Impact, Charcoal, sans-serif",
			fontStyle: "bold",
			align: "center",
			textFill: "white",
			draggable: true,					
			 textStroke: "black",
			textStrokeWidth: 2,	
			stroke: "",
			strokeWidth: 0,
			padding: 5
		});
		
		var line2 = new Kinetic.Text({
			x: 190,
			y: 300,
			text: "Line 2",
			fontSize: 30,
			fontFamily: "Impact, Charcoal, sans-serif",
			fontStyle: "bold",
			align: "center",
			textFill: "white",
			draggable: true,					
			 textStroke: "black",
			textStrokeWidth: 2,
			textStrokeWidth: 2,
			stroke: "",
			strokeWidth: 0,
			padding: 5
		});
		
		var watermark = new Kinetic.Text({
			x: 5,
			y: 5,
			text: "<?php  echo $site;  ?>",
			fontSize: 12,
			fontFamily: "sans-serif",
			fontStyle: "bold",
			textFill: "white",
			draggable: true,
			opacity: .8,
			 textStroke: "black",
			textStrokeWidth: 1
		});	
		
		
		var imageObj = new Image();	  
		imageObj.onload = function() {
			var imgHeight = imageObj.height;
			var imgWidth = imageObj.width;
			if (imgHeight > 500 || imgWidth > 700){
				if ( imgHeight > 500){
					var scale = imgHeight/500;				
					imgHeight = 500;
					imgWidth = imgWidth/scale;
				}
				if (imgWidth > 700){
					var scale = imgWidth/700;				
					imgWidth = 700;
					imgHeight = imgHeight/scale;
				}
			}
			else if(imgHeight < 300 || imgWidth < 400){
				if ( imgHeight < 300){
					var scale = imgHeight/300;				
					imgHeight = 300;
					imgWidth = imgWidth/scale;
				}
				if (imgWidth < 400){
					var scale = imgWidth/400;				
					imgWidth = 400;
					imgHeight = imgHeight/scale;
				}
			
			}
			var meme = new Kinetic.Image({
				x: 0,
				y: 0,
				height: imgHeight,
				width: imgWidth,
				image: imageObj
			});
			
			line1.setX((imgWidth/2)-50);
			line1.setY(30);
			line2.setX((imgWidth/2)-50);
			line2.setY(imgHeight - 60);
			
			container.style.width = imgWidth+'px';
			container.style.height = imgHeight+'px';	
			stage.setHeight(imgHeight);
			stage.setWidth(imgWidth);
		
			// add cursor styling
			box.on("mouseover", function() {
				document.body.style.cursor = "pointer";
			});
			box.on("mouseout", function() {
				document.body.style.cursor = "default";
			});

			layer.add(meme);
			layer.add(watermark);	
			layer.add(line1);	
			layer.add(line2);			
			stage.add(layer);
			stage.add(background);
			
			document.getElementById('save').addEventListener('click', function() {
				/*
				* since the stage toDataURL() method is asynchronous, we need
				* to provide a callback
				*/

				stage.toDataURL({
					callback: function(dataUrl) {
						/*
						* here you can do anything you like with the data url.
						* In this tutorial we'll just open the url with the browser
						* so that you can see the result as an image
						*/
						//window.open(dataUrl);
						showSaving("block");
						saveImage(dataUrl);
					}
				});
			}, false);
			document.getElementById('textbox1').addEventListener('keyup', function() {
				var currentLine1Text = document.getElementById('textbox1').value;
				line1.setText(currentLine1Text);
				line1.setStroke("");		
				layer.draw();	
			}, false);
			document.getElementById('textbox1').addEventListener('keydown', function() {
				var currentLine1Text = document.getElementById('textbox1').value;				
				line1.setStroke("lightgrey");							
				layer.draw();	
			}, false);
			document.getElementById('textbox2').addEventListener('keyup', function() {
				var currentLine2Text = document.getElementById('textbox2').value;
				line2.setText(currentLine2Text);	
				line2.setStroke("");			
				layer.draw();	
			}, false);
			document.getElementById('textbox2').addEventListener('keydown', function() {
				var currentLine2Text = document.getElementById('textbox2').value;
				line2.setText(currentLine2Text);
				line2.setStroke("lightgrey");				
				layer.draw();	
			}, false);
			document.getElementById('textbox3').addEventListener('keyup', function() {
				var currentLine3Text = document.getElementById('textbox3').value;
				watermark.setText(currentLine3Text);	
				layer.draw();	
			}, false);
			document.getElementById('fontstyle').addEventListener('change', function() {
				var fontStyleSelect = document.getElementById('fontstyle');
				currentFontStyle = fontStyleSelect.value;
				if (currentFontStyle == "Comic"){
					line1.setFontFamily("Comic Sans MS, cursive, sans-serif");
					line2.setFontFamily("Comic Sans MS, cursive, sans-serif");
					layer.draw();
				}
				else if (currentFontStyle == "Impact"){
					line1.setFontFamily("Impact, Charcoal, sans-serif");
					line2.setFontFamily("Impact, Charcoal, sans-serif");
					layer.draw();
				}
				else if (currentFontStyle == "Monospace"){
					line1.setFontFamily("Courier New, Courier, monospace");
					line2.setFontFamily("Courier New, Courier, monospace");
					layer.draw();
				}
				else{
					line1.setFontFamily("Arial, Helvetica, sans-serif");
					line2.setFontFamily("Arial, Helvetica, sans-serif");
					layer.draw();
				}
			}, false);
			document.getElementById('line1plus').addEventListener('click', function() {	
				var currentsize =  line1.getFontSize();
				line1.setFontSize(currentsize + 1);	
				layer.draw();	
			}, false);
			document.getElementById('line1minus').addEventListener('click', function() {	
				var currentsize =  line1.getFontSize();
				line1.setFontSize(currentsize - 1);	
				layer.draw();	
			}, false);
			document.getElementById('line2plus').addEventListener('click', function() {	
				var currentsize =  line2.getFontSize();
				line2.setFontSize(currentsize + 1);	
				layer.draw();	
			}, false);
			document.getElementById('line2minus').addEventListener('click', function() {	
				var currentsize =  line2.getFontSize();
				line2.setFontSize(currentsize - 1);	
				layer.draw();	
			}, false);
			document.getElementById('watermarkplus').addEventListener('click', function() {	
				var currentsize =  watermark.getFontSize();
				watermark.setFontSize(currentsize + 1);	
				layer.draw();	
			}, false);
			document.getElementById('watermarkminus').addEventListener('click', function() {	
				var currentsize =  watermark.getFontSize();
				watermark.setFontSize(currentsize - 1);	
				layer.draw();	
			}, false);	
			line1.on('mouseover', function() {
				document.body.style.cursor = 'move';
				line1.setStroke("lightgrey");	
				layer.draw();	
			});
			line2.on('mouseover', function() {
				document.body.style.cursor = 'move';
				line2.setStroke("lightgrey");	
				layer.draw();	
			});
			line1.on('mouseout', function() {
				document.body.style.cursor = 'default';
				line1.setStroke("");	
				layer.draw();	
			});
			line2.on('mouseout', function() {
				document.body.style.cursor = 'default';
				line2.setStroke("");
				layer.draw();					
			});
		};
		
			
		<?php
		
		$imgsrc = get_bloginfo("template_directory")."/images/memepics/";
		$uploadsrc = get_bloginfo("template_directory")."/images/uploads/";
		
		$img = $_GET["img"];
		if (isset($img)){		 
			 echo '
			imageObj.src = "'.$imgsrc.$img.'.jpg";
			';
		}
		$file = $_GET["file"];
		if (isset($file)){
			 echo '
			imageObj.src = "'.$uploadsrc .$file.'";
			';
		}	
		?>
	};
	
	function saveImage(dataUrl){
		var memename = document.getElementById('memename').value;		
		var category = document.getElementById('category').value;	
		
		var ajaxRequest; 	
		try{
			// Opera 8.0+, Firefox, Safari
			ajaxRequest = new XMLHttpRequest();
		} catch (e){
			// Internet Explorer Browsers
			try{
				ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
			} catch (e) {
				try{
					ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
				} catch (e){
					// Something went wrong
					alert("ajaxerror!");
					return false;
				}
			}
		}
		// Create a function that will receive data sent from the server
		ajaxRequest.onreadystatechange = function(){
			if(ajaxRequest.readyState == 4){
				var response= ajaxRequest.responseText;	
				if (response == "OK"){
					showSaving("none");
					showSaved("block");
				}
			}
		}
		<?php
			$saveImage = get_bloginfo("template_directory")."/saveImage.php";
			echo'
			ajaxRequest.open("POST", "'.$saveImage.'", true);			
			ajaxRequest.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			ajaxRequest.send("img="+dataUrl+"&name="+memename+"&category="+category);
			';
		?>	
	}
	function showSaving(displaytype){
		showSaved("none");
		var saving = document.getElementById('saving');	
		saving.style.display = displaytype;
	}
	function showSaved(displaytype){
		var saving = document.getElementById('saved');	
		saving.style.display = displaytype;
	}
	
    </script>
  </head>
  <?php  $plus = get_bloginfo("template_directory")."/images/plus.png";
	$minus = get_bloginfo("template_directory")."/images/minus.png";?>
  <body>
    <div id="container"  onmousedown="return false;"></div>   

    <div class = "config"> 
	    <form>
		<table>		
			<tr><td>Line One:<br />(draggable) </td><td><textarea id ="textbox1" cols = "25" rows = "2"  >Line 1</textarea></td><td id = "line1plus"><img src  ='<?php echo $plus; ?>' height = '35' width = '35' /></td><td id = "line1minus"><img src  ='<?php echo $minus; ?>' height = '35' width = '35' /></td></tr>
			
			<tr><td>Line Two:<br />(draggable)</td><td><textarea id = "textbox2" cols = "25" rows = "2">Line2</textarea></td><td id = "line2plus"><img src  ='<?php echo $plus; ?>' height = '35' width = '35' /></td><td id = "line2minus"><img src  ='<?php echo $minus; ?>' height = '35' width = '35' /></td></tr>
			<tr><td>Watermark:<br />(draggable) </td><td><textarea id = "textbox3" cols = "25" rows = "2" ><?php  echo $site;  ?></textarea></td><td id = "watermarkplus"><img src  ='<?php echo $plus; ?>' height = '35' width = '35' /></td><td id = "watermarkminus"><img src  ='<?php echo $minus; ?>' height = '35' width = '35' /></td></tr>
			<tr><td>Font Style: </td><td><select id  = "fontstyle">
				<option value = "Impact" selected = "selected">Impact</option>	
				<option value = "Helvetica" >Helvetica</option>
				<option value = "Comic">Comic</option>						
				<option value = "Monospace">Monospace</option>
			</select></td></tr>
			<tr><td>Category: </td><td><?php wp_dropdown_categories(array('hide_empty' => 0, 'id' => 'category', 'hierarchical' => true)); ?></td></tr>
			<tr><td>Meme Name: </td><td colspan = '3'><input type = "text" id = "memename" size = "47"  /></td>
			</tr>			
		</table>
	    </form>
	    <div id="buttons">
		      <button id="save" class = "submit">
				Save (Press Once!)
		      </button>
	     </div> 
	      <div id = 'saving'>
			Saving.... 
	      </div>
	      <div id = 'saved'>
		   MEME Published!
	      </div>			
    </div>
    
  </body>
</html>
