<?php get_header(); ?>

<?php 
	// grab grid design settings
	$options = get_option('mansion_theme_options');
	$gd = $options['griddesign'];
?>

		<?php $count = 0; if (have_posts()) : ?>

		<?php while (have_posts()) : the_post(); $count++; ?>
			
			<?php if($gd == "one" || $gd == "") : // show one image per post ?>
			
			<?php if(checkimage()): ?>
			<div class="box">
			<?php if(has_tag('featured') && ($count == 1) ) : 			
					get_the_image( array( 'custom_key' => array( 'featured' ), 'default_size' => 'featured', 'width' => '401', 'height' => '301', 'image_class' => 'featured' ) ); 			
				else : 			
					get_the_image( array( 'custom_key' => array( 'thumbnail' ), 'width' => '200', 'height' => '', 'image_class' => 'thumbnail' ) ); 				
				endif; ?>
			</div>
		<?php endif; ?>
		<?php endif; // end $gd condition ?>
		
		<?php if($gd == "all") : // show all images from post ?>
		<?php if(has_tag('featured') && ($count == 1) ) : ?>
				<?php postimages('featured'); ?>
			<?php else : ?>
				<?php if(checkimage('thumbnail')) :
					postimages('thumbnail'); 
				else : ?>
					<div class="box"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/default-thumb.jpg" class="attachment-thumbnail" alt="<?php the_title(); ?>" width="200" height="150" /></a></div>
				<?php endif; ?>
			<?php endif; ?>
		<?php endif; // end $gd condition ?>

				
		<?php endwhile; ?>

	<?php else :

		if ( is_category() ) { // If this is a category archive
			printf("<h2 class='center'>" . esc_html__("Sorry, but there aren't any posts in the %s category yet.", 'gpp') . "</h2>", single_cat_title('',false));
		} else if ( is_date() ) { // If this is a date archive 
		    ?>
			<h2><?php _e("Sorry, but there aren't any posts with this date.", 'gpp'); ?></h2>
		<?php
		} else if ( is_author() ) { // If this is a category archive
			$userdata = get_userdatabylogin(get_query_var('author_name'));
			printf("<h2 class='center'>" . esc_html__("Sorry, but there aren't any posts by %s yet.", 'gpp') . "</h2>", $userdata->display_name);
		} else { ?>
			<h2 class='center'><?php _e('No posts found.', 'gpp'); ?></h2>
		<?php }
		get_search_form();

	endif;
?>

<?php get_footer(); ?>
