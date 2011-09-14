<?php
/*
Plugin Name: Filosofo's Pagination
Plugin URI:
Description: Show pagination
Author: Austin Matzko
Author URI: http://austinmatzko.com
Version: 1.0
*/


if ( version_compare( PHP_VERSION, '5.2.0') >= 0 ) {

	require_once dirname( __FILE__ ) . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'core.php';
	
} else {
	
	function filosofo_pagination_php_version_message()
	{
		?>
		<div id="filosofo-pagination-warning" class="updated fade error">
			<p>
				<?php 
				printf(
					__('<strong>ERROR</strong>: Your WordPress site is using an outdated version of PHP, %s.  Version 5.2 of PHP is required to use the pagination plugin. Please ask your host to update.', 'filosofo-pagination'),
					PHP_VERSION
				);
				?>
			</p>
		</div>
		<?php
	}

	add_action('admin_notices', 'filosofo_pagination_php_version_message');
}

function filosofo_pagination_init_event()
{
	load_plugin_textdomain('filosofo-pagination', null, dirname( __FILE__ ) . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'l10n');
}

add_action('init', 'filosofo_pagination_init_event');
