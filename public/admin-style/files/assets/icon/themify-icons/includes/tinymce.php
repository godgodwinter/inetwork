<?php

function themify_icons_mce_external_plugins( $plugins ) {
	$plugins['themifyicons'] = THEMIFY_ICONS_URI . 'assets/tinymce.js';

	return $plugins;
}
add_filter( 'mce_external_plugins', 'themify_icons_mce_external_plugins' );

function themify_icons_mce_buttons( $mce_buttons ) {
	array_push( $mce_buttons, 'separator', 'themifyicons' );
	return $mce_buttons;
}
add_filter( 'mce_buttons', 'themify_icons_mce_buttons' );

function themify_icons_tinymce_localize() {
	wp_localize_script( 'editor', 'themifyIcons', array(
		'fields' => themify_icons_shortcode_generator_fields(),
		'editor' => array(
			'menuName' => __( 'Themify Icon', 'themify-icons' ),
		)
	));
}
add_action( 'admin_enqueue_scripts', 'themify_icons_tinymce_localize' );

function themify_icons_print_media_templates() {
	?>
	<script type="text/html" id="tmpl-themify-icons-plugin">[ti_icon<# if ( data.icon ) { #> icon="{{data.icon}}"<# } #><# if ( data.text ) { #> text="{{data.text}}"<# } #><# if ( data.link ) { #> link="{{data.link}}"<# } #><# if ( data.target ) { #> target="{{data.target}}"<# } #> size="{{data.size}}" style="{{data.style}}"<# if ( data.corners ) { #> corners="{{data.corners}}"<# } #><# if( data.custom_text_color ) { data.text_color = data.custom_text_color; } if ( data.text_color ) { #> text_color="{{data.text_color}}"<# } #><# if( data.custom_background_color ) { data.background_color = data.custom_background_color; } if ( data.background_color ) { #> background_color="{{data.background_color}}"<# } #><# if( data.custom_icon_color ) { data.icon_color = data.custom_icon_color; } if ( data.icon_color ) { #> icon_color="{{data.icon_color}}"<# } #>]</script>
	<?php
}
add_action( 'print_media_templates', 'themify_icons_print_media_templates' );

function themify_icons_shortcode_generator_fields() {
	return array(
		array(
			'name'    => 'icon',
			'type'  => 'iconpicker',
			'text' => __( 'Pick', 'themify-icons' ),
			'label' => __( 'Icon:', 'themify-icons' )
		),
		array(
			'name'    => 'text',
			'type'  => 'textbox',
			'label' => __( 'Text', 'themify-icons' )
		),
		array(
			'name'    => 'link',
			'type'  => 'textbox',
			'value' => 'http://',
			'label' => __( 'Link:', 'themify-icons' )
		),
		array(
			'name' => 'target',
			'type' => 'textbox',
			'label' => __( 'Link Target:', 'themify-icons' ),
			'tooltip' => sprintf( __( 'Entering %s will open link in a new window (leave blank for default).', 'themify-icons' ), '<strong>_blank</strong>' )
		),
		array(
			'name' => 'size',
			'type' => 'listbox',
			'values' => array(
				array( 'value' => 'default', 'text' => __( 'Default', 'themify-icons' ) ),
				array( 'value' => 'medium', 'text' => __( 'Medium', 'themify-icons' ) ),
				array( 'value' => 'large', 'text' => __( 'Large', 'themify-icons' ) ),
			),
			'label' => __( 'Size', 'themify-icons' ),
		),
		array(
			'name' => 'style',
			'type' => 'listbox',
			'values' => array(
				array( 'value' => 'icon-left', 'text' => __( 'Icon Left', 'themify-icons' ) ),
				array( 'value' => 'icon-boxed', 'text' => __( 'Icon Boxed', 'themify-icons' ) ),
				array( 'value' => 'icon-top', 'text' => __( 'Icon Top', 'themify-icons' ) ),
				array( 'value' => 'icon-boxed-top', 'text' => __( 'Icon Boxed Top', 'themify-icons' ) ),
				array( 'value' => 'icon-wrapped', 'text' => __( 'Icon Wrapped', 'themify-icons' ) ),
				array( 'value' => 'icon-wrapped-top', 'text' => __( 'Icon wrapped Top', 'themify-icons' ) ),
			),
			'label' => __( 'Style', 'themify-icons' ),
		),
		array(
			'name' => 'corners',
			'type' => 'listbox',
			'values' => array(
				array( 'value' => '', 'text' => '' ),
				array( 'value' => 'square', 'text' => __( 'Square', 'themify-icons' ) ),
				array( 'value' => 'rounded', 'text' => __( 'Rounded', 'themify-icons' ) ),
				array( 'value' => 'circle', 'text' => __( 'Circle', 'themify-icons' ) ),
			),
			'label' => __( 'Corners', 'themify-icons' ),
		),
		array(
			'name' => 'text_color',
			'type' => 'listbox',
			'values' => array(
				array( 'value' => 'blue', 'text' => __( 'Blue', 'themify-icons' ) ),
				array( 'value' => 'white', 'text' => __( 'White', 'themify-icons' ) ),
				array( 'value' => 'pink', 'text' => __( 'Pink', 'themify-icons' ) ),
				array( 'value' => 'purple', 'text' => __( 'Purple', 'themify-icons' ) ),
				array( 'value' => 'yellow', 'text' => __( 'Yellow', 'themify-icons' ) ),
				array( 'value' => 'orange', 'text' => __( 'Orange', 'themify-icons' ) ),
				array( 'value' => 'brown', 'text' => __( 'Brown', 'themify-icons' ) ),
				array( 'value' => 'black', 'text' => __( 'Black', 'themify-icons' ) ),
			),
			'label' => __( 'Text Color', 'themify-icons' ),
		),
		array(
			'name'    => 'custom_text_color',
			'type'  => 'colorbox',
			'label' => __( 'Custom Text Color', 'themify-icons' ),
			'tooltip'  => __( 'Enter color in hexadecimal format. For example, #ddd.', 'themify-icons' )
		),
		array(
			'name' => 'background_color',
			'type' => 'listbox',
			'values' => array(
				array( 'value' => 'blue', 'text' => __( 'Blue', 'themify-icons' ) ),
				array( 'value' => 'white', 'text' => __( 'White', 'themify-icons' ) ),
				array( 'value' => 'pink', 'text' => __( 'Pink', 'themify-icons' ) ),
				array( 'value' => 'purple', 'text' => __( 'Purple', 'themify-icons' ) ),
				array( 'value' => 'yellow', 'text' => __( 'Yellow', 'themify-icons' ) ),
				array( 'value' => 'orange', 'text' => __( 'Orange', 'themify-icons' ) ),
				array( 'value' => 'brown', 'text' => __( 'Brown', 'themify-icons' ) ),
				array( 'value' => 'black', 'text' => __( 'Black', 'themify-icons' ) ),
			),
			'label' => __( 'Background Color', 'themify-icons' ),
		),
		array(
			'name'    => 'custom_background_color',
			'type'  => 'colorbox',
			'label' => __( 'Custom Background Color', 'themify-icons' ),
			'tooltip'  => __( 'Enter color in hexadecimal format. For example, #ddd.', 'themify-icons' )
		),
		array(
			'name' => 'icon_color',
			'type' => 'listbox',
			'values' => array(
				array( 'value' => 'blue', 'text' => __( 'Blue', 'themify-icons' ) ),
				array( 'value' => 'white', 'text' => __( 'White', 'themify-icons' ) ),
				array( 'value' => 'pink', 'text' => __( 'Pink', 'themify-icons' ) ),
				array( 'value' => 'purple', 'text' => __( 'Purple', 'themify-icons' ) ),
				array( 'value' => 'yellow', 'text' => __( 'Yellow', 'themify-icons' ) ),
				array( 'value' => 'orange', 'text' => __( 'Orange', 'themify-icons' ) ),
				array( 'value' => 'brown', 'text' => __( 'Brown', 'themify-icons' ) ),
				array( 'value' => 'black', 'text' => __( 'Black', 'themify-icons' ) ),
			),
			'label' => __( 'Icon Color', 'themify-icons' ),
		),
		array(
			'name'    => 'custom_icon_color',
			'type'  => 'colorbox',
			'label' => __( 'Custom Icon Color', 'themify-icons' ),
			'tooltip'  => __( 'Enter color in hexadecimal format. For example, #ddd.', 'themify-icons' )
		),
	);
}