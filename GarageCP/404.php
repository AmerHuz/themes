<?php get_header(); ?>
  
  <div id="frame">  

  <div id="layout">
  <div class="wrapper" id="wrapperMain">
  
  <div id="content">

        <div id="main">
        
			<div class="archive">
				<h3><?php _e('خطأ 404', 'wpzoom'); ?></h3>
			</div>
			
			<div class="posts">
				<p><?php _e('نأسف الصفحة المطلوبة غير موجودة.', 'wpzoom');?> </p>
			</div>
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
