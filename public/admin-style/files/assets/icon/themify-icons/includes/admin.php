<?php

function themify_icons_add_plugin_page() {
	add_menu_page(
		__( 'Themify Icons', 'themify-icons' ),
		__( 'Themify Icons', 'themify-icons' ),
		'manage_options',
		'themify-icons',
		'themify_icons_create_admin_page'
	);
}
add_action( 'admin_menu', 'themify_icons_add_plugin_page' );

function themify_icons_create_admin_page() {
	include( THEMIFY_ICONS_DIR . 'docs/index.html' );
}