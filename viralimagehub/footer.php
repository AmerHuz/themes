</div>
<div id="footer">
	
	<div class="copyright">
		&copy; <?php esc_html_e('All rights reserved by', 'gpp'); ?> <?php bloginfo('name'); ?>.
	</div>
	
	
	<?php if(is_home() || is_archive()): ?>
	<div class="navigation">		
		<div class="prev"><?php previous_posts_link(__('Previous &raquo;', 'gpp')); ?></div>
		<div class="next"><?php next_posts_link(__('&laquo; Next', 'gpp')); ?></div>
	</div>
	<?php endif; ?>
	
</div>
<?php wp_footer(); ?>
</body>
</html>
