<?php
/*
Plugin Name: CLAS Connections Dashboard Banner
Plugin URI: 
Description: 
Version: 0.1.1
Author: Crystal Barton
Author URI: https://www.linkedin.com/in/crystalbarton
Network: False
GitHub Plugin URI: https://github.com/clas-web/clas-connections-dashboard-banner
*/


// add_action( 'wp_dashboard_setup', 'ccdb_add_dashboard_widgets' );
add_action( 'admin_notices', 'ccdb_admin_notices', 1 );


// if( !function_exists('ccdb_add_dashboard_widgets') ):
// function ccdb_add_dashboard_widgets()
// {
// 	global $wp_meta_boxes;
// 	var_dump($wp_meta_boxes);
//
// 	wp_add_dashboard_widget(
// 		'ccdb_dashboard_widget',			// Widget slug.
// 		'UNC Charlotte Dashboard Widget',	// Title.
// 		'ccdb_display_dashboard_widget'		// Display function.
// 	);
// }
// endif;


// if( !function_exists('ccdb_display_dashboard_widget') ):
// function ccdb_display_dashboard_widget()
// {
// 	echo 'UNC Charlotte widget text.';
// }
// endif;


if( !function_exists('ccdb_admin_notices') ):
function ccdb_admin_notices()
{
	$current_screen = get_current_screen();
	if( $current_screen->id !== 'dashboard' ) return;
	if( !post_type_exists('connection') ) return;

	$user = wp_get_current_user();
	$username = $user->user_login;

	$posts = get_posts( array(
			'post_per_page' => 1,
			'post_type' => 'connection',
			'meta_key' => 'username',
			'meta_value' => $username,
		)
	);

	if( empty($posts) ) return;

	?>
	
	<div class="updated">
		<p>
			<a href="<?php echo get_edit_post_link($posts[0]->ID, '&'); ?>">
				Connections Post
			</a>
		</p>
	</div>

	<?php
}
endif;

