<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />

<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>

<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=423136367718082";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div class = 'topbanner'>
		<?php			
			if(is_singular()){
				$post_id = get_the_ID();
				$chosenBanner = getPostAds($post_id);	
				if (empty($chosenBanner)){
					$categories = get_the_category();				 
					$chosenBanner = getCategoryAds($categories);
					if (empty($chosenBanner)){
						$chosenBanner = getSiteAds();
					}
				}
			}
			else if(is_category()){				
				$categories = get_the_category();				 
				$chosenBanner = getCategoryAds($categories);
				if (empty($chosenBanner)){
					$chosenBanner = getSiteAds();
				}
			}
			else{
				$chosenBanner = getSiteAds();
			
			}							
			
		?>
		<center>
			<?php echo $chosenBanner;  ?>
		</center>	
</div>
<div id="container">
<?php 
	 $options = get_option( 'mansion_theme_options' ); 
	$imagegen = get_page_by_title( 'Image Generator');		
	
	
	$imagegenlink = get_permalink( $imagegen -> ID);
	
?>
<div id="header" class="box">
	
	<?php
	if ($options["publicGens"]== "yes"){
		echo'
		<div class = "genbuttons">
		<a href = "'.$imagegenlink.'"> <div class = "genbutton">Generate An Image</div></a>
		
		</div>';
	}
	?>
	
	<div class="logo">
	 	<div class="bottom">
			<h1><a href="<?php echo get_option('home'); ?>/"><?php bloginfo('name'); ?></a></h1>
			<span class="description"><?php bloginfo('description'); ?></span>
		</div>
		
	</div>
	
	<?php if(!is_home() && !is_page()) : ?>
	<div class="titles">
		<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
	 	<?php /* If this is a category archive */ if (is_category()) { ?>
			<h2 class="pagetitle"><?php single_cat_title(); ?></h2>
	 	  <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
			<h2 class="pagetitle"><?php single_tag_title(); ?></h2>
		  <?php /* If this is a tag archive */ } elseif( is_search() ) { ?>
			<h2 class="pagetitle"><?php esc_html_e('Search', 'gpp'); ?></h2>
	 	  <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
			<h2 class="pagetitle"><?php the_time('F jS, Y'); ?></h2>
	 	  <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
			<h2 class="pagetitle"><?php the_time('F, Y'); ?></h2>
	 	  <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
			<h2 class="pagetitle"><?php the_time('Y'); ?></h2>
		  <?php /* If this is an author archive */ } elseif (is_author()) { ?>
			<h2 class="pagetitle"><?php esc_html_e('Author Archive', 'gpp'); ?></h2>
		  <?php /* If this is an author archive */ } elseif (is_single()) { ?>
			<h2 class="pagetitle"><?php the_category(' <span>/</span>'); ?></h2>
	 	  <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
			<h2 class="pagetitle"><?php esc_html_e('Blog Archives', 'gpp'); ?></h2>
	 	  <?php } ?>
	</div>
	<?php endif; ?>
	
	<div class="menu">
	
		<?php 
			if (function_exists('wp_nav_menu')) {
				wp_nav_menu( 'sort_column=menu_order&container=&menu_id=nav&menu_location=main-menu' ); ?>
				
			<div class="search">
				<?php if(function_exists('get_search_form')) : 
					get_search_form();
				else : 
					include (TEMPLATEPATH . '/searchform.php'); 
				endif; ?>
 			</div>
		<?php } else {
				include ('nav.php');
			} 
		?>
		
	</div>
	
</div>
