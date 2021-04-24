<?php

/**
 * Returns the icon name chosen for a given menu item
 *
 * @return string|null
 * @since 1.0
 */
function themify_icons_get_menu_icon( $item_id ) {
	return get_post_meta( $item_id, themify_icons_get_menu_icon_meta_key(), true );
}

function themify_icons_get_menu_icon_meta_key() {
	return '_themify_menu_item_icon';
}

/**
 * Setup custom walker for Nav_Menu_Edit
 *
 * @since 1.0
 */
function themify_icons_edit_nav_menu_walker( $walker ) {
	if( ! class_exists( 'Themify_Walker_Nav_Menu_Edit' ) ) {
		include( THEMIFY_ICONS_DIR . 'includes/class-themify-walker-nav-menu-edit.php' );
	}
	return 'Themify_Walker_Nav_Menu_Edit';
}
add_filter( 'wp_edit_nav_menu_walker', 'themify_icons_edit_nav_menu_walker', 20 );

/**
 * Display the icon picker for menu items in the backend
 *
 * @since 1.0
 */
function themify_icons_nav_menu_item_custom_fields( $item_id, $item, $depth, $args ) {
	$saved_meta = themify_icons_get_menu_icon( $item_id );
?>
	<p class="field-themify-icon description description-thin">
		<label for="edit-menu-item-ti_icon-<?php echo $item_id; ?>">
			<?php _e( 'Icon', 'themify-icons' ) ?><br/>
			<input type="text" name="menu-item-ti_icon[<?php echo $item_id; ?>]" id="edit-menu-item-ti_icon-<?php echo $item_id ?>" size="8" class="edit-menu-item-icon themify-choose-icon" value="<?php echo esc_attr( $saved_meta ); ?>">
			<a class="button button-secondary hide-if-no-js themify_fa_toggle" href="#" data-target="#edit-menu-item-ti_icon-<?php echo $item_id ?>"><?php _e( 'Insert Icon', 'themify-icons' ); ?></a>
		</label>
	</p>
<?php }
add_action( 'wp_nav_menu_item_custom_fields', 'themify_icons_nav_menu_item_custom_fields', 12, 4 );

/**
 * Save the icon meta for a menu item. Also removes the meta entirely if the field is cleared.
 *
 * @since 1.0
 */
function themify_icons_wp_update_nav_menu_item( $menu_id, $menu_item_db_id, $args ) {
	if( ! isset( $_POST['menu-item-ti_icon'][$menu_item_db_id] ) ) return;
	$meta_value = themify_icons_get_menu_icon( $menu_item_db_id );
	$new_meta_value = stripcslashes( $_POST['menu-item-ti_icon'][$menu_item_db_id] );

	if ( $new_meta_value && '' == $meta_value )
		add_post_meta( $menu_item_db_id, themify_icons_get_menu_icon_meta_key(), $new_meta_value, true );
	elseif ( $new_meta_value && $new_meta_value != $meta_value )
		update_post_meta( $menu_item_db_id, themify_icons_get_menu_icon_meta_key(), $new_meta_value );
	elseif ( '' == $new_meta_value && $meta_value )
		delete_post_meta( $menu_item_db_id, themify_icons_get_menu_icon_meta_key(), $meta_value );
}
add_action( 'wp_update_nav_menu_item', 'themify_icons_wp_update_nav_menu_item', 10, 3 );

/**
 * Clean up the icon meta field when a menu item is deleted
 *
 * @since 1.0
 */
function themify_icons_remove_menu_icon_meta( $post_id ) {
	if( is_nav_menu_item( $post_id ) ) {
		delete_post_meta( $post_id, themify_icons_get_menu_icon_meta_key() );
	}
}
add_action( 'delete_post', 'themify_icons_remove_menu_icon_meta', 1, 3 );

function themify_icons_add_menu_item_title_filter( $args ) {
	add_filter( 'the_title', 'themify_icons_the_title', 10, 2 );
	return $args;
}
add_filter( 'wp_nav_menu_args', 'themify_icons_add_menu_item_title_filter' );

/**
 * The menu is rendered, we longer need to look for menu icons
 */
function themify_icons_remove_menu_item_title_filter( $nav_menu ) {
	remove_filter( 'the_title', 'themify_icons_the_title', 10, 2 );
	return $nav_menu;
}
add_filter( 'wp_nav_menu', 'themify_icons_remove_menu_item_title_filter' );

/**
 * Append icon to a menu item
 *
 * @since 1.0
 */
function themify_icons_the_title( $title, $id ) {
	if( $icon = themify_icons_get_menu_icon( $id ) ) {
		wp_enqueue_style( 'themify-icons' );
		$title = '<i class="themify-menu-icon ' . themify_get_icon( $icon ) . '"></i> ' . $title;
	}

	return $title;
}