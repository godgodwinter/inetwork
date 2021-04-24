/* Routines to manage font icons in theme settings and custom panel. */

;var Themify_Icons = {};

(function($){

	'use strict';

	Themify_Icons = {
		target: '',
		ajaxurl: tfIconPicker.ajaxurl,
		top:typeof top_iframe!=='undefined'?$(top_iframe):$(document),
		init: function() {
			var self = Themify_Icons;
			self.top.on('click', '.themify_fa_toggle', function(e){
				e.preventDefault();
				e.stopPropagation();
				var $self = $( this );
				self.target =  $self.prop('data-target')?$( $self.prop('data-target') ):$self.prev();
				self.showLightbox( self.target.val() );
			}).on('click', '#themify_lightbox_fa .lightbox_container a', function(e){
				e.preventDefault();
								e.stopPropagation();
				self.setIcon( $( this ).data( 'icon' ) );
			}).on('click', '#themify_lightbox_overlay, #themify_lightbox_fa .close_lightbox', function(e){
				e.preventDefault();
								e.stopPropagation();
				self.closeLightbox();
			}).on('change', '.tf-icon-group-select input', function(e){
				var group = $(this).val();
				$( '#themify_lightbox_fa .tf-font-group',self.top ).hide().filter( '[data-group="' + group + '"]' ).show();
			});
			self.Category();
			self.Search();

		},

		showLightbox: function( selected ) {
			var self = Themify_Icons;
			self.loadIconsList( function(){
				var top = self.top.scrollTop() + 80,
					$lightbox = $("#themify_lightbox_fa",self.top),
					$lightboxOverlay = $('#themify_lightbox_overlay',self.top);
				if( selected ) {
					$('a', $lightbox).removeClass('selected').find('.' + selected).closest('a').addClass('selected');
				}
								
				// Position lightbox correctly in Builder
				if ($lightboxOverlay.length===0 && $('body',self.top).hasClass('themify_builder_active')) {
									$('body',self.top).append($lightboxOverlay);
				}
								
				// set active font group
				if( $lightbox.find( 'a.selected' ).length>0) {
					var group = $lightbox.find( 'a.selected' ).closest( '.tf-font-group' ).data( 'group' );
					$lightbox.find('.tf-icon-group-select input[value="' + group + '"]' ).click();
				} else {
					$lightbox.find('.tf-icon-group-select input:first' ).click();
				}

				$('#themify-search-icon-input',$lightbox).val('').trigger('keyup');
				$('.themify-lightbox-icon'.$lightbox).find('.selected').trigger('click');
								
				$lightboxOverlay.show();
				$lightbox
				.css('top', self.top.height())
				.show()
				.animate({
					top: top
				}, 600 );

			});
		},

		loadIconsList : function( callback ){
			if( $( '#themify_lightbox_fa',Themify_Icons.top ).length>0) {
				callback();
			} else {
				$.ajax({
					url : Themify_Icons.ajaxurl,
					data : { action : 'tf_icon_picker' },
					type : 'POST',
					success : function( data ){
						$( 'body',Themify_Icons.top ).append( data );
						callback();
					}
				});
			}
		},

		setIcon: function(iconName) {
			Themify_Icons.target.val(iconName).trigger('change');
			// icon preview
			var icon_prev = $('.fa:not(.icon-close)', Themify_Icons.target.parent().parent());
			if ( icon_prev.length > 0 ) {
				$.ajax({
					url : Themify_Icons.ajaxurl,
					data : { action: 'tf_get_icon', tf_icon : iconName },
					success: function( data ){
							icon_prev.removeClass().addClass( data );
					}
				});
			}
			Themify_Icons.closeLightbox();
		},

		closeLightbox: function() {
			$('#themify_lightbox_fa',Themify_Icons.top).animate({
				top: Themify_Icons.top.height()
			}, 400, function() {
				$('#themify_lightbox_overlay',Themify_Icons.top).hide();
				$(this).hide();
			});
		},
		Category:function(){
			Themify_Icons.top.on('click','.themify-lightbox-icon li',function(e){
				e.preventDefault();
				e.stopPropagation();
				var is_selected = $(this).hasClass('selected');
				$(this).closest('.themify-lightbox-icon').find('.selected').removeClass('selected');
				if(!is_selected){
					var $id = $(this).data('id'),
						group = $('#'+$id,Themify_Icons.top);
						$(this).addClass('selected');
					if(group.length>0){
						$(this).closest('.lightbox_container').find('section').not('#'+$id).fadeOut('fast',function(){
							group.fadeIn('normal');
						});
					}
				}
				else {
					$(this).closest('.lightbox_container').find('section').fadeIn('fast',function(){
							$('#themify-search-icon-input',Themify_Icons.top).trigger('keyup');
					});
				}
			});
		},
		Search:function(){
			$.expr[":"].contains = $.expr.createPseudo(function(arg) {
				return function( elem ) {
					return $(elem).text().toUpperCase().indexOf(arg.toUpperCase()) >= 0;
				};
			});
			Themify_Icons.top.on('keyup','#themify-search-icon-input',function(){
				var $text = $.trim($(this).val()),
					$container = $('#themify_lightbox_fa',Themify_Icons.top).find('.tf-font-group a'),
					$sections  = $('#themify_lightbox_fa',Themify_Icons.top).find('section');
				if($text){
					$container.hide();
					$sections.hide();
					$container.filter(':contains(' + $text.toUpperCase()  + ')').show().each( function(){
						$( this ).closest( 'section' ).show();
					} );
				}
				else{
				   
					$sections.show();
					$container.show();
				}
			});
		}
	};
	$( document ).ready( Themify_Icons.init );
})(jQuery);