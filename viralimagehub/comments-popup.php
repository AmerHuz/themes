<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
     <title><?php echo get_option('blogname'); ?> - <?php esc_html_e('Comments on', 'gpp'); ?> <?php the_title(); ?></title>

	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php echo get_option('blog_charset'); ?>" />
	<style type="text/css" media="screen">
		@import url( <?php bloginfo('stylesheet_url'); ?> );
		body { margin: 3px; }
	</style>

</head>
<body id="commentspopup">

<h1 id="header"><a href="" title="<?php echo get_option('blogname'); ?>"><?php echo get_option('blogname'); ?></a></h1>

<?php
/* Don't remove these lines. */
add_filter('comment_text', 'popuplinks');
if ( have_posts() ) :
while ( have_posts() ) : the_post();
?>
<h2 id="comments"><?php esc_html_e('Comments', 'gpp'); ?></h2>

<p><a href="<?php echo get_post_comments_feed_link($post->ID); ?>"><abbr title="Really Simple Syndication"><?php esc_html_e('RSS', 'gpp'); ?></abbr> <?php esc_html_e('feed for comments on this post.', 'gpp'); ?></a></p>

<?php if ('open' == $post->ping_status) { ?>
<p>The <abbr title="Universal Resource Locator"><?php esc_html_e('URL', 'gpp'); ?></abbr> <?php esc_html_e('to TrackBack this entry is', 'gpp'); ?>: <em><?php trackback_url() ?></em></p>
<?php } ?>

<?php
// this line is WordPress' motor, do not delete it.
$commenter = wp_get_current_commenter();
extract($commenter);
$comments = get_approved_comments($id);
$post = get_post($id);
if ( post_password_required($post) ) {  // and it doesn't match the cookie
	echo(get_the_password_form());
} else { ?>

<?php if ($comments) { ?>
<ol id="commentlist">
<?php foreach ($comments as $comment) { ?>
	<li id="comment-<?php comment_ID() ?>">
	<?php comment_text() ?>
	<p><cite><?php comment_type(esc_html__('Comment', 'gpp'), esc_html__('Trackback', 'gpp'), esc_html__('Pingback', 'gpp')); ?> <?php esc_html_e('by', 'gpp'); ?> <?php comment_author_link() ?> &#8212; <?php comment_date() ?> @ <a href="#comment-<?php comment_ID() ?>"><?php comment_time() ?></a></cite></p>
	</li>

<?php } // end for each comment ?>
</ol>
<?php } else { // this is displayed if there are no comments so far ?>
	<p><?php esc_html_e('No comments yet.', 'gpp'); ?></p>
<?php } ?>

<?php if ('open' == $post->comment_status) { ?>
<h2><?php esc_html_e('Leave a comment', 'gpp'); ?></h2>
<p><?php esc_html_e('Line and paragraph breaks automatic, e-mail address never displayed,', 'gpp'); ?> <acronym title="Hypertext Markup Language"><?php esc_html_e('HTML', 'gpp'); ?></acronym> <?php esc_html_e('allowed:', 'gpp'); ?> <code><?php echo allowed_tags(); ?></code></p>  

<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
<?php if ( $user_ID ) : ?>
	<p><?php esc_html_e('Logged in as', 'gpp'); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account"><?php esc_html_e('Log out', 'gpp'); ?> &raquo;</a></p>
<?php else : ?>
	<p>
	  <input type="text" name="author" id="author" class="textarea" value="<?php echo $comment_author; ?>" size="28" tabindex="1" />
	   <label for="author"><?php esc_html_e('Name', 'gpp'); ?></label>
	</p>

	<p>
	  <input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="28" tabindex="2" />
	   <label for="email"><?php esc_html_e('E-mail', 'gpp'); ?></label>
	</p>

	<p>
	  <input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="28" tabindex="3" />
	   <label for="url"><abbr title="Universal Resource Locator"><?php esc_html_e('URL', 'gpp'); ?></abbr></label>
	</p>
<?php endif; ?>

	<p>
	  <label for="comment"><?php esc_html_e('Your Comment', 'gpp'); ?></label>
	<br />
	  <textarea name="comment" id="comment" cols="70" rows="4" tabindex="4"></textarea>
	</p>

	<p>
      <input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
	  <input type="hidden" name="redirect_to" value="<?php echo attribute_escape($_SERVER["REQUEST_URI"]); ?>" />
	  <input name="submit" type="submit" tabindex="5" value="<?php esc_html_e('Say It!', 'gpp'); ?>" />
	</p>
	<?php do_action('comment_form', $post->ID); ?>
</form>
<?php } else { // comments are closed ?>
<p><?php esc_html_e('Sorry, the comment form is closed at this time.', 'gpp'); ?></p>
<?php }
} // end password check
?>

<div><strong><a href="javascript:window.close()"><?php esc_html_e('Close this window.', 'gpp'); ?></a></strong></div>

<?php // if you delete this the sky will fall on your head
endwhile; //endwhile have_posts()
else: //have_posts()
?>
<p><?php esc_html_e('Sorry, no posts matched your criteria.', 'gpp'); ?></p>
<?php endif; ?>
<!-- // this is just the end of the motor - don't touch that line either :) -->
<?php //} ?>
<p class="credit"><?php timer_stop(1); ?> <cite><?php esc_html_e('Powered by', 'gpp'); ?> <a href="http://wordpress.org/" title="Powered by WordPress, state-of-the-art semantic personal publishing platform"><strong><?php esc_html_e('WordPress', 'gpp'); ?></strong></a></cite></p>

<script type="text/javascript">
<!--
document.onkeypress = function esc(e) {
	if(typeof(e) == "undefined") { e=event; }
	if (e.keyCode == 27) { self.close(); }
}
// -->
</script>
</body>
</html>
