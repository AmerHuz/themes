<div class="archiveposts">
	<?php if ( have_posts() ) 	the_post(); ?>

	<h3>
		<?php /* category archive */ if (is_category()) { ?> <?php single_cat_title(); ?>
		<?php /* tag archive */ } elseif( is_tag() ) { ?> <?php single_tag_title(); ?>
		<?php /* author archive */ } elseif (is_author()) { ?><?php printf( __( '%s', 'wpzoom' ), "<a href='" . get_author_posts_url( get_the_author_meta( 'ID' ) ) . "' title='" . esc_attr( get_the_author() ) . "' rel='me'>" . get_the_author() . "</a>" ); ?> <?php echo get_avatar( get_the_author_id() , 50 ); ?><br /><small><?php the_author_meta( 'description' ); ?></small>
		<?php /* paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?><?php _e('Archives', 'wpzoom'); ?>
		<?php /* home page */ } elseif (is_front_page()) { ?><?php _e('Meme Center','wpzoom');?> <?php } ?>
	</h3>

	<ul class="posts">
		 		<?php rewind_posts(); ?>

		<?php if (is_front_page()) { 
				$z = count($wpzoom_exclude_cats_home);if ($z > 0) { 
				$x = 0; $que = ""; while ($x < $z) {
				$que .= "-".$wpzoom_exclude_cats_home[$x]; $x++;
				if ($x < $z) {$que .= ",";} } }		 
				query_posts($query_string . "&cat=$que"); 
			} 
 			if (have_posts()) : 
		?>

		<?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>	
		<li>
			<?php if ($wpzoom_homepost_thumb  == 'Show') { ?>	
				<?php if ( current_theme_supports( 'post-thumbnails' ) && has_post_thumbnail() ) {
						$thumbURL = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), '' );
						$img = $thumbURL[0]; 
					}
					else {
					$img = catch_that_image($post->ID);
					}
					if ($img){ 
						$img = wpzoom_wpmu($img);
					?>
				<div class="cover"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><img src="<?php bloginfo('template_directory'); ?>/scripts/timthumb.php?src=<?php echo $img ?>&amp;w=<?php echo "$wpzoom_homepost_thumb_width";?>&amp;h=<?php echo "$wpzoom_homepost_thumb_height";?>&amp;zc=1" alt="<?php the_title(); ?>" /></a></div>
				<?php } ?>
			<?php } ?>
			<div class="postcontent">
				<h2 class="title"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
			
				<div class="meta">
					<?php if ($wpzoom_home_cat == 'Show') { ?><span class="cat_icon"><?php the_category(', ') ?></span><?php } ?>
 					<?php if ($wpzoom_home_date == 'Show') { ?><span class="date_icon"><?php the_time("$dateformat $timeformat"); ?></span><?php } ?>
					<span><?php edit_post_link( __('Edit', 'wpzoom'), '', ''); ?></span>
				</div>
					
				<?php the_excerpt(); ?>
			</div>
			<div class="cleaner">&nbsp;</div>
		
		</li>
		<?php endwhile; ?>
	
	</ul>
	<div class="cleaner">&nbsp;</div>
	
		<div class="navigation">
			<?php if ( function_exists( 'page_navi' ) ) page_navi( 'items=10&prev_label=������&next_label=������&first_label=������&last_label=�������&num_position=after' ); ?>
		</div> 
		<?php else : ?>

		<p class="title"><?php _e('No posts matched your criteria', 'wpzoom');?></p>

		<?php endif; ?>

	<?php wp_reset_query(); ?>
	<div class="cleaner">&nbsp;</div> 
 </div>