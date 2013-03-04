<form method="get" id="searchform" action="<?php bloginfo('url'); ?>/">
	<fieldset>
			<input type="text" onblur="if (this.value == '') {this.value = '<?php _e('ابحث', 'wpzoom') ?>';}" onfocus="if (this.value == '<?php _e('ابحث', 'wpzoom') ?>') {this.value = '';}" value="<?php _e('ابحث', 'wpzoom') ?>" name="s" id="s" />
			<input type="submit" id="searchsubmit" value="<?php _e('ابحث', 'wpzoom') ?>" />
	</fieldset>
</form>
 