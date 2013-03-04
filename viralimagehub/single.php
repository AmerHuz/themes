<?php get_header(); ?>

	<div id="content">

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>


		<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
			
			<div class="navigation">			
				<div class="prev"><?php previous_post_link('%link', esc_html__('Previous', 'gpp'), TRUE); ?></div>
				<div class="next"><?php next_post_link('%link', esc_html__('Next', 'gpp'), TRUE); ?></div>
			</div>
			
			<h2 class="posttitle"><?php the_title(); ?></h2>
			<span class="posted"><?php esc_html_e('Posted on', 'gpp'); ?> <?php the_time('l, F jS, Y') ?> <?php esc_html_e('at', 'gpp'); ?> <?php the_time() ?></span>
			<div class="entry">
				<?php the_content('<p class="serif">'. esc_html__('Read the rest of this entry &raquo;', 'gpp') . '</p>'); ?>

				<?php wp_link_pages(array('before' => '<p><strong>'. esc_html__('Pages:','gpp') . '</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
				<?php the_tags( __('<p class="tags">Tags: ', 'gpp'), ', ', '</p>'); ?>
				<div class = 'socialbuttons'>
				<!-- AddThis Button BEGIN -->
				<div class="addthis_toolbox addthis_default_style">
				<a class="addthis_button_facebook_like" fb:like:layout="box_count" ></a> 
				<a class="addthis_button_tweet" tw:count="vertical"></a> 				
				<a class="addthis_button_google_plusone" g:plusone:size="tall"></a> 
				<a class="addthis_button_pinterest_pinit"></a>
				<a class="addthis_counter addthis_pill_style"></a>
				</div>
				<script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
				<script type="text/javascript" src="http://s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5076b6105bb2542b"></script>
				<!-- AddThis Button END -->
				</div>	
				<p class="postmetadata alt">
					Filed under <?php the_category(', ') ?>.
						<?php edit_post_link(esc_html__('Edit this entry.', 'gpp'),'','.'); ?> 
				</p>

			</div>
		</div>
		

		<div class="clear"></div>
		

	<?php comments_template(); ?>

	<?php endwhile; else: ?>

		<p><?php esc_html_e('Sorry, no attachments matched your criteria.', 'gpp'); ?></p>

<?php endif; ?>

	</div>
	

<?php get_footer(); ?>
