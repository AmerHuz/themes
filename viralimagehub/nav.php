<ul id="nav">
 <li><a href="<?php bloginfo('home'); ?>"><?php esc_html_e('Home', 'gpp'); ?></a></li>
 <?php wp_list_categories('title_li='); ?>
 <?php wp_list_pages('title_li='); ?>
 <li><a href="<?php bloginfo('rss2_url'); ?>"><?php esc_html_e('RSS Feed', 'gpp'); ?></a></li>
 <li class="search"><?php if(function_exists('get_search_form')) : ?>
			<?php get_search_form(); ?>
			<?php else : ?>
			<?php include (TEMPLATEPATH . '/searchform.php'); ?>
			<?php endif; ?>
 </li>
</ul>