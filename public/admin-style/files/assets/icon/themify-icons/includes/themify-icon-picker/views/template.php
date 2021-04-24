<?php
/**
 * @var $icon_fonts
 */
?>
<div id="themify_lightbox_fa" class="themify-admin-lightbox clearfix">
	<input type="text" id="themify-search-icon-input" placeholder="<?php _e( 'Search', 'themify' ); ?>" />
	<h3 class="themify_lightbox_title"><?php _e( 'Choose icon', 'themify' ); ?></h3>
	<a href="#" class="close_lightbox"><i class="ti-close"></i></a>

	<div class="tf-icon-group-select">
		<?php foreach( $icon_fonts as $class => $font ) : ?>
			<label><input name="icon-font-group" type="radio" value="<?php echo $font->get_id(); ?>"><?php echo $font->get_label(); ?></input></label> 
		<?php endforeach; ?>
	</div>

	<div class="lightbox_container">

		<?php foreach( $icon_fonts as $class => $font ) : ?>
			<?php $font->picker_template(); ?>
		<?php endforeach; ?>

	</div><!-- .lightbox_container -->
</div>
<div id="themify_lightbox_overlay"></div>