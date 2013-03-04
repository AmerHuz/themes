<?php

add_action( 'admin_init', 'theme_options_init' );
add_action( 'admin_menu', 'theme_options_add_page' );

/**
 * Init plugin options to white list our options
 */
function theme_options_init(){
	register_setting( 'mansion_options', 'mansion_theme_options', 'theme_options_validate' );
}

/**
 * Load up the menu page
 */
function theme_options_add_page() {
	add_theme_page( 'Theme Options',  'Theme Options', 'edit_theme_options', 'theme_options', 'theme_options_do_page' );
}

/**
 * Create arrays for our select and radio options
 */
// Get Wordpress Categories
global $categories;
$cats_array = get_categories();
$blog = array();
foreach ($cats_array as $cats) {
	$catarray = array(
		'value' =>	$cats->cat_ID,
		'label' => __( $cats->cat_name )		
	);
	array_push($blog, $catarray);
}


function theme_options_do_page() {
	global $blog, $usesitebanners, $usesitepopunder;
	
	$manual  =  get_bloginfo("template_directory")."/manual.pdf";

	if ( ! isset( $_REQUEST['updated'] ) )
		$_REQUEST['updated'] = false;

	?>
	<div class="wrap">
		<?php screen_icon(); echo "<h2>" . ' Theme Options' . "</h2>"; ?>
		
		<?php if ( false !== $_REQUEST['updated'] ) : ?>
		<div class="updated fade"><p><strong><?php _e( 'Options saved' ); ?></strong></p></div>
		<?php endif; ?>
		<h2><a href = '<?php echo $manual; ?>'>Manual</a> Read This First!</h2>
		<form method="post" action="options.php">
			<?php settings_fields( 'mansion_options' ); ?>
			<?php $options = get_option( 'mansion_theme_options' ); ?>

			<table class="form-table">			
				
				<tr valign="top"><th scope="row"><?php _e( 'Site Banner Codes' ); ?></th>
					<td>
						<textarea name = "mansion_theme_options[siteBannerURLs]" rows = "7" cols = "75"><?php  echo $options['siteBannerURLs'];?></textarea>
					</td>				
				</tr>	
				
				<tr valign="top"><th scope="row"><?php _e( 'Site Pop Under URLs' ); ?></th>
					<td>
						<textarea name = "mansion_theme_options[sitePopUnderURLs]" rows = "7" cols = "75"><?php  echo $options['sitePopUnderURLs'];?></textarea>
					</td>				
				</tr>
				<tr valign="top"><th scope="row"><?php _e( 'Pop Under Frequency (in hours)' ); ?></th>
					<td>
						<input name = "mansion_theme_options[sitePopUpFreq]" value = "<?php echo $options['sitePopUpFreq'];?>">
					</td>				
				</tr>				
				
				<hr>
				<tr valign="top"><th scope="row"><?php _e( 'Background Color'); ?></th>
					<td>
						<input name = "mansion_theme_options[backgroundColor]" value = "<?php echo $options['backgroundColor'];?>">
					</td>					
				</tr>
				<tr valign="top"><th scope="row"><?php _e( 'Text Color'); ?></th>
					<td>
						<input name = "mansion_theme_options[textColor]" value = "<?php echo $options['textColor'];?>">
					</td>					
				</tr>
				<tr valign="top"><th scope="row"><?php _e('Menu Color'); ?></th>
					<td>
						<input name = "mansion_theme_options[menuColor]" value = "<?php echo $options['menuColor'];?>">
					</td>					
				</tr>
				<tr valign="top"><th scope="row"><?php _e( 'Menu Text Color'); ?></th>
					<td>
						<input name = "mansion_theme_options[menuTextColor]" value = "<?php echo $options['menuTextColor'];?>">
					</td>					
				</tr>
				<tr valign="top"><th scope="row"><?php _e('Enable Public MEME Generation? <br />(Let your visitors generate images)'); ?></th>
					<td>
						<?php if ($options["publicGens" ]== "yes"){
								echo'
								<input type="radio" name = "mansion_theme_options[publicGens]" value="yes" checked = "checked">Yes<br>
								<input type="radio" name = "mansion_theme_options[publicGens]"  value="no">No';
							}
							else{
								echo'
								<input type="radio" name = "mansion_theme_options[publicGens]" value="yes">Yes<br>
								<input type="radio" name = "mansion_theme_options[publicGens]"  value="no" checked = "checked">No';
							}?>
					</td>					
				</tr>
				
			</table>

			<p class="submit">
				<input type="submit" class="button-primary" value="<?php _e( 'Save Options' ); ?>" />
			</p>
		</form>
	</div>
	<?php
}

/**
 * Sanitize and validate input. Accepts an array, return a sanitized array.
 */
function theme_options_validate( $input ) {
	global $blog;

	// Our select option must actually be in our array of select options
	if ( ! array_key_exists( $input['blog'], $blog ) )
		$input['blog'] = null;


	return $input;
}

// adapted from http://planetozh.com/blog/2009/05/handling-plugins-options-in-wordpress-28-with-register_setting/