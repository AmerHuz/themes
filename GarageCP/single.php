<?php
global $options;
foreach ($options as $value) {
    if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); }
}
$template = get_post_meta($post->ID, 'wpzoom_post_template', true);
?>

<?php get_header(); ?>

<div id="frame">  
<div id="layout">
<div class="wrapper" id="wrapperMain">
  <div id="content"<?php 
  if ($template == 'Sidebar on the left') {echo' class="side-left"';}
  if ($template == 'Full Width (no sidebar)') {echo' class="full-width"';} 
  ?>>
	<div id="main">  
		<?php wp_reset_query(); if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="metadata">
			<?php if ($wpzoom_singlepost_date == 'Show') { ?><div class="datetime"><span class="month"><?php the_time("M"); ?></span><span class="date"><?php the_time("j"); ?></span></div><?php } ?>
			<div class="metainfo">
				<h1><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
				<div class="meta">
					<?php if ($wpzoom_singlepost_cat == 'Show') { ?><span><?php the_category(', ') ?></span><?php } ?>
					<?php if ($wpzoom_singlepost_date == 'Show') { ?><span><?php the_time("$timeformat"); ?></span><?php } ?>
					<?php if ($wpzoom_singlepost_comm == 'Show') { ?><span class="comm_icon"><a href="<?php the_permalink() ?>#commentspost" title="Jump to the comments"><?php comments_number(__('لا يوجد تعليق', 'wpzoom'),__('تعليق واحد', 'wpzoom'),__('تعليقان', 'wpzoom'),__('% تعليقات', 'wpzoom')); ?></a></span><?php } ?>
					<span><?php edit_post_link( __('Edit', 'wpzoom'), '', ''); ?></span>
				</div>
			</div>
		</div><!-- end .metadata -->
		<div class="entry">
			<?php if (strlen($wpzoom_ad_content_imgpath) > 1 && $wpzoom_ad_content_select == 'Yes' && $wpzoom_ad_content_pos == 'Before') { echo '<div class="banner">'.stripslashes($wpzoom_ad_content_imgpath)."</div>"; }?>
			<?php the_content(); ?>
			<?php wp_link_pages(array('before' => '<p class="pages"><strong>'.__('Pages', 'wpzoom').':</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
			<p class="tags-title">وصلات: </p>
			<div class="cleaner">&nbsp;</div>
			<p class="tags">
			<?php if ($wpzoom_singlepost_tags == 'Show' && get_the_tags()) 
			{
				$links = array();
				foreach(get_the_tags() as $this_tag) {
					if ($this_tag->name != "featured" && $this_tag->name != "multigallery" && $this_tag->name != "multivideo"){
						$links[] = '<a href="'.get_tag_link($this_tag->term_id).'">'.$this_tag->name.'</a>';
					}
				}
				echo implode(' ', $links);
			} ?></p>
			<div class="cleaner">&nbsp;</div>
			<?php if (strlen($wpzoom_ad_content_imgpath) > 1 && $wpzoom_ad_content_select == 'Yes' && $wpzoom_ad_content_pos == 'After') { echo '<div class="banner">'.stripslashes($wpzoom_ad_content_imgpath)."</div>"; }?>
		</div><!-- end .entry -->
		<?php endwhile; else: ?>
		<p><?php _e('Sorry, no posts matched your criteria', 'wpzoom');?>.</p>
		<?php endif; ?>
		<div class="cleaner">&nbsp;</div>   
	</div><!-- end #main -->
	<?php if ($template != 'Full Width (no sidebar)') { ?>
		<div id="sidebar">
			<?php get_sidebar(); ?>
		</div><!-- end #sidebar -->
	<?php } ?>
	<div class="cleaner">&nbsp;</div>
</div><!-- end #content -->
</div><!-- end .wrapper -->
</div><!-- end #layout -->
</div><!-- end #frame -->
<?php get_footer(); ?>