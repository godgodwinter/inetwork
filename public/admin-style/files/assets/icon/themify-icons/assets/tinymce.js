(function($) {
	'use strict';

	tinymce.PluginManager.add( 'themifyicons', function( editor, url ) {

		function createColorPickAction() {
			var colorPickerCallback = editor.settings.color_picker_callback;

			if ( colorPickerCallback ) {
				return function() {
					var self = this;

					colorPickerCallback.call(
						editor,
						function( value ) {
							self.value( value ).fire( 'change' );
						},
						self.value()
					);
				};
			}
		}

		editor.addButton( 'themifyicons', {
			title: 'Themify Icon',
			image: url + '/images/favicon.png',
			onclick: function(){
				var fields = [];
				jQuery.each( themifyIcons.fields, function( i, field ){
					if( field.type == 'colorbox' ) {
						field.onaction = createColorPickAction()
					} else if( field.type == 'iconpicker' ) {
						/* create an icon picker */
						field = {
							type : 'container',
							label : field.label,
							layout : 'flex',
							direction : 'row',
							items : [
								{ type : 'textbox', name : field.name },
								{ type : 'button', text : field.text, onclick : function(){
									var $this = jQuery( this.$el );
									if(document.getElementById("themify_builder_site_canvas_iframe"))
										var Themify_Icons = document.getElementById("themify_builder_site_canvas_iframe").contentWindow.Themify_Icons;
									Themify_Icons.target = $this.prev(); // set the input text box that recieves the value
									Themify_Icons.showLightbox( Themify_Icons.target.val() ); // show the icon picker lightbox
								} }
							]
						};
					}
					fields.push( field );
				} );

				editor.windowManager.open({
					'title' : themifyIcons.menuName,
					'body' : fields,
					onSubmit : function( e ){
						var values = this.toJSON(); // get form field values
						values.selectedContent = editor.selection.getContent();
						var template = wp.template( 'themify-icons-plugin' );
						editor.insertContent( template( values ) );
					}
				});
			}
		});
	});
})(jQuery);