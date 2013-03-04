<?php
global $options;
foreach ($options as $value) {
    if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); }
}
$dateformat = get_option('date_format');
$timeformat = get_option('time_format');
?>

<?php get_header(); ?>


<div id="frame">  

	<div id="layout">
	<div class="wrapper" id="wrapperMain">

	<div id="content">

        <div id="main">
        
			<?php if ($wpzoom_featured_posts_show == 'Yes' && is_home() && $paged < 2) { include(TEMPLATEPATH . '/wpzoom_featured_posts.php'); }  // Featured Slider ?>
 			
			<?php if ( $paged < 2 && $wpzoom_homepage_style == 'Magazine Style') { // Magazine Layout ?>

				<div class="home_widgets">
					<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Homepage Widgets (top)') ) : ?> <?php endif; ?>
				</div>
				
				
				<div class="home_widgets_full">
					<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Homepage Widgets (full-width)') ) : ?> <?php endif; ?>
				</div>
				
				<div class="cleaner">&nbsp;</div>
				
				<div class="home_widgets">
					<div class="widgets_col">
						<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Homepage Widgets (1st column)') ) : ?> <?php endif; ?>
					</div>
					
					<div class="widgets_col">
						<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Homepage Widgets (2nd column)') ) : ?> <?php endif; ?>
					</div>
					
					<div class="widgets_col">
						<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Homepage Widgets (3rd column)') ) : ?> <?php endif; ?>
					</div>
					<div class="cleaner">&nbsp;</div>
				</div>
				
				
				<div class="home_widgets_full">
					<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Homepage Widgets (full-width bottom)') ) : ?> <?php endif; ?>
				</div>
				
				
				<div class="home_widgets">
					<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Homepage Widgets (bottom)') ) : ?> <?php endif; ?>
				</div>
			
			<?php } // end Magazine Layout
 
			else { // Meme Center  
		
			include(STYLESHEETPATH . '/archive-post.php');  
			
			} // end Meme Center ?>
				
         </div><!-- end #main -->
          
		<div id="sidebar">

			<?php get_sidebar(); ?>

		</div><!-- end #sidebar -->

      <div class="cleaner">&nbsp;</div>
    </div><!-- end #content -->

    </div><!-- end .wrapper -->
    </div><!-- end #layout -->

</div><!-- end #frame -->
<?php get_footer(); ?>