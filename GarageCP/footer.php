<?php
 global $options;
foreach ($options as $value) {
    if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); }
}
?>

	<div class="wrapper">
		<div id="footer">

			<p class="copy"><?php _e('كراج. جميع حقوق النشر محفوظة 2013', 'wpzoom'); ?> .</p>
	  
		</div><!-- end #footer -->
		
		<div id="secondFooter">
		
			<div id="nav2">
				<?php wp_nav_menu( array('container' => '', 'container_class' => '', 'menu_class' => 'menu',   'sort_column' => 'menu_order', 'depth' => '1', 'theme_location' => 'secondary' ) ); ?>
			</div>
			<div class="cleaner">&nbsp;</div>
	  
		</div><!-- end #2footer -->
	</div>

</div><!-- end #frame -->

</div><!-- end #container -->

<?php if ($wpzoom_misc_analytics != '' && $wpzoom_misc_analytics_select == 'Yes')
{
  echo stripslashes($wpzoom_misc_analytics);
} ?> 

<?php wp_footer(); ?>

<?php wpzoom_js('jtools', 'jcarousel', 'dropdown', 'fancybox', 'easing', 'tabber-minimized', 'wpzoom' ); ?>
 
<?php if ($wpzoom_featured_posts_show == 'Yes' && $paged < 2 && is_home() ){ ?>
<script type="text/javascript">
(function($) {
 $(".pagination").tabs(".slides li", {
	event: 'mouseover', 
 	rotate: true
		}).slideshow({
			clickable: false,
			autoplay: <?php if ($wpzoom_slideshow_auto == 'Yes') { ?>true<?php } ?> <?php if ($wpzoom_slideshow_auto == 'No') { ?>false<?php } ?>, 
			interval: <?php echo "$wpzoom_slideshow_speed"; ?> 
		});
 
})(jQuery);
</script>
<?php } ?>

</body>
</html>