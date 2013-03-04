<?php

	require('../../../wp-blog-header.php');
	global $wpdb;
	$last = wp_get_recent_posts( '1');
	$last_id = $last['0']['ID'];
	$lastposturl = get_permalink( $last_id );
	
	echo "last post =".$lastposturl;
?>