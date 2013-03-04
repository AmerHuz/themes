<?php

// Load Base Javascripts
if (!is_admin()) add_action( 'init', 'load_base_js' );


function load_base_js( ) {
	wp_enqueue_script('jquery');
	wp_enqueue_script('search', get_bloginfo('template_directory').'/includes/js/search.js', array( 'jquery' ) );
	wp_enqueue_script('cookies', get_bloginfo('template_directory').'/includes/js/jquery.cookies.js', array( 'jquery' ) );
	wp_enqueue_script('chromepopunder', get_bloginfo('template_directory').'/includes/js/jquery.chromepopunder.js', array( 'jquery' ) );
	wp_enqueue_script('popunder', get_bloginfo('template_directory').'/includes/js/jquery.popunder.js', array( 'jquery' ) );
	wp_enqueue_script('kinetic', get_bloginfo('template_directory').'/includes/js/kinetic-v4.0.5.min.js', array( 'jquery' ) );
	wp_enqueue_script('swfobject');
}

// Load Conditional Javascripts
function load_conditional_js() {	
	if(!is_single() && !is_page() || is_page_template('page-blog.php'))
		wp_enqueue_script('masonry', get_bloginfo('template_directory').'/includes/js/jquery.masonry.min.js', array('jquery'));
}

// Load Dom Ready Javascripts
function load_dom_ready_js() {

	
	if(!is_single() && !is_page() || is_page_template('page-blog.php')) {
	
	$doc_ready_script = '
	<script type="text/javascript">
	
		// apply masonry on load
		jQuery(window).load(function() {
	 		jQuery("#container").masonry({animate: true});
	 		jQuery("#footer").adjustFooterWidth();					
	 	});
		
		

		jQuery(document).ready(function(){
			
			// adjust menu height
			var menuheight = parseInt(jQuery("div.menu").height());';
			

	if(is_archive()){
		$doc_ready_script .= '
	      	if(menuheight < 150) { jQuery("#nav").height(170); }
	      	if(menuheight > 150) { jQuery("#nav").height(212); }';
	}


	if(!is_archive()) {
	   $doc_ready_script .= '
	      	if(menuheight < 150) { jQuery("#nav").height(100); }
	      	if(menuheight > 150) { jQuery("#nav").height(251); }';
	}

	$doc_ready_script .= '		
			
	      	// apply masonry on resize
	      	jQuery(window).resize(function() {
		 		jQuery("#footer").adjustFooterWidth();
		 	});		

		 	// apply opacity on hover
		 	jQuery(".box, #footer").css({opacity: 0}); 	// Initial opacity 0
		 	jQuery("#footer").fadeTo(900, 1.0); 	// fade #footer opacity to 1.0
			jQuery(".box").fadeTo(900, 1.0); 	// fade box opacity to 1.0
			jQuery(".gpplogo, .wplogo").fadeTo(900, 0.6); 	// fade logos opacity to 0.4
			jQuery(".box").hover(function(){
				if (this.id != "header"){
				jQuery(this).fadeTo("fast", 0.8);} 	// fade to 1.0
			},function(){
   				jQuery(this).fadeTo("fast", 1.0); 	// fade back to 0.8
			});	

			jQuery(".gpplogo, .wplogo").hover(function(){
				jQuery(this).fadeTo("fast", 1.0); 	// fade to 1.0
			},function(){
   				jQuery(this).fadeTo("fast", 0.6); 	// fade back to 0.8
			});

		});

		jQuery.fn.adjustFooterWidth = function() {
   			var noOfColumns = jQuery("#container").data("masonry").colCount;
			var totalWidth = noOfColumns * (jQuery(".box").width() + 1 ) ;
			jQuery(this).width(totalWidth - 40);
		};
			

	</script>';
	
	echo $doc_ready_script;
	}
	
}

function popUnderScripts(){
	
	$options = get_option( 'mansion_theme_options' );
	$popUpFrequency =  $options['sitePopUpFreq'];
	if(is_singular()){
		$post_id = get_the_ID();
		$chosenPopup = getPostPopUnders($post_id);	
		if (empty($chosenPopup)){
			$categories = get_the_category();	
			$chosenPopup = getCategoryPopUnders($categories);	
			if (empty($chosenPopup)){
				$chosenPopup = getSitePopUnders(); 
			}
		}
	}
	else if(is_category()){	
		$categories = get_the_category();				 
		$chosenPopup = getCategoryPopUnders($categories);
		if (empty($chosenPopup)){			
			 $chosenPopup = getSitePopUnders(); 
			
		}		
	}
	else{
		$chosenPopup = getSitePopUnders(); 
	}	
	
	if (empty($popUpFrequency)){
		$popUpFrequency = .001;	
	}
	if (!empty($chosenPopup)){
		echo'
		<script type="text/javascript">
		 var is_chrome = navigator.userAgent.toLowerCase().indexOf("chrome") > -1;
		if (is_chrome){
			 window.aPopunder = [
				["'.$chosenPopup.'", {height:400, width:400, blocktime:'.$popUpFrequency.'}]
       
				];

			   jQuery(document).on("mousedown click", function(e) {
				//alert("works");
				jQuery.chromepopunder(window.aPopunder);
			    });
		}
		else{
			jQuery(document).on("mousedown click", function(e) {					
				jQuery.popunder("'.$chosenPopup.'", '.$popUpFrequency.');
				});
			
		}
		</script>';
	}
	
	
}

function addCustomStyling(){

	$options = get_option( 'mansion_theme_options' );
	$backgroundColor = $options['backgroundColor'];
	if (empty($backgroundColor)){
			$backgroundColor = "black";
	}
	$menuColor = $options['menuColor'];
	if (empty($menuColor)){
			$menuColor = "white";
	}
	$textColor =$options['textColor'];
	if (empty($textColor)){
			$textColor = "white";
	}
	$menuTextColor = $options['menuTextColor'];
	if (empty($menuTextColor )){
			$menuTextColor = "black";
	}
	echo "<style>
	body{
		background-color: ".$backgroundColor.";
		color: ".$textColor.";
	}
	#header{
		background-color: ".$menuColor.";
	}
	#header h1 a {
		color:".$menuTextColor.";
	}
	#header span.description {
		color:".$menuTextColor.";
	}
	.topbanner{
		background-color: ".$menuColor.";
	}
	#nav li a {color:".$menuTextColor.";}
	#nav li a:hover {color:".$menuTextColor.";}
	#nav .current-cat a, #nav .current_page_item a {color: ".$textColor.";}
	.wp-caption {color:".$textColor."}
	#nav span.navtitle {color:".$textColor.";}
	.box a {color:".$textColor.";}
	h2.pagetitle {color:".$textColor."; background-color: ".$backgroundColor." }
	.category-blog .datediv, .page-template-page-blog-php .datediv {color:".$textColor.";}
	pagetitle span {color:".$textColor.";}
	.posted {color:".$textColor.";}
	.postmetadata {ccolor:".$textColor.";}
	.postmetadata a {color:".$textColor.";}
	.postmetadata a:hover {color:".$textColor.";}
	h3#comments {color:".$textColor.";}
	
	.genbuttons{
		float: left;
		margin-top: 20px;
		margin-bottom: 20px;
	}

	.genbutton{
		background-color: ".$menuColor.";
		border-style: outset;
		border-width: 4px;		
		color:".$menuTextColor.";		
		padding-top: 5px;
		padding-bottom: 5px;
		float: left;
		font-weight: bold;
		margin-left: 20px;
		margin-top: 5px;
		width: 150px;
		text-align: center;
		-moz-border-radius: 10px;
		border-radius: 10px;
			
	}
	
	
	</style>";
	

}

function frameBreak(){
	$iframe = $_GET["published"];
	if ($iframe == "published"){
		echo '
		<script type="text/javascript">
		<!--
			if (top.location!= self.location) {
				top.location = self.location.href
			}
		//-->
		</script>';
	}	

}

// Add Javascripts

add_action('template_redirect', 'load_conditional_js');
add_action('wp_head', 'load_dom_ready_js');
add_action('wp_head', 'popUnderScripts');
add_action('wp_head', 'addCustomStyling');
add_action('wp_head', 'frameBreak');