/* bender-tags: editor */

( function() {
	'use strict';

	bender.test( {
		setUp: function() {
			this.parse = CKEDITOR.tools.style.parse;
		},

		'test style.parse.background return type': function() {
			var ret = this.parse.background( 'red url(foo.bar)' );

			assert.isObject( ret, 'Type returned' );
			// Array is also an object, so it needs some extra checking.
			assert.areNotSame( Array, ret.constructor, 'Returned value constructor' );
		},

		'test style.parse.background single background': function() {
			var ret = this.parse.background( 'red url(foo.bar) no-repeat' );

			objectAssert.areEqual( { color: 'red', unprocessed: 'url(foo.bar) no-repeat' }, ret );
		},

		'test style.parse.background unknown markup': function() {
			var ret = this.parse.background( 'foo bar   baz!' );

			objectAssert.areEqual( { unprocessed: 'foo bar   baz!' }, ret );
		},

		'test style.parse.background docs sample': function() {
			var background = CKEDITOR.tools.style.parse.background( '#0C0 url(foo.png)' );
			objectAssert.areEqual( { color: '#0C0', unprocessed: 'url(foo.png)' }, background );
		},

		'test style.parse._findColor empty value': function() {
			var ret = this.parse._findColor( '' );

			assert.isInstanceOf( Array, ret, 'Return type' );
			assert.areSame( 0, ret.length, 'Returned item count' );
		},

		'test style.parse._findColor hex': function() {
			var ret = this.parse._findColor( 'foo #foo #aa1 #000 aa #1234 #123456 #aag #AAB #AAB' );

			arrayAssert.itemsAreEqual( [ '#aa1', '#000', '#123456', '#AAB', '#AAB' ], ret );
		},

		'test style.parse._findColor rgba': function() {
			var ret = this.parse._findColor( 'rgb(255,0,128), rgb(),rgb,rgba(0000), rgb(10%, 10% ,10%) rgba(0,0,0,0.3) rgba(0,0,0,0)' );

			arrayAssert.itemsAreEqual( [ 'rgb(255,0,128)', 'rgb(10%, 10% ,10%)', 'rgba(0,0,0,0.3)', 'rgba(0,0,0,0)' ], ret );
		},

		'test style.parse._findColor hsla': function() {
			var ret = this.parse._findColor( 'hsl(10,30%,30%)   hsla(10,30%,30%,1)  hsla( 90.5, 10%, 10%, 1)' );

			arrayAssert.itemsAreEqual( [ 'hsl(10,30%,30%)', 'hsla(10,30%,30%,1)', 'hsla( 90.5, 10%, 10%, 1)' ], ret );
		},

		'test style.parse._findColor predefined': function() {
			var ret = this.parse._findColor( 'xa orange red blueish' );

			arrayAssert.itemsAreEqual( [ 'orange', 'red' ], ret );
		},

		'test style.parse.margin 1 member': function() {
			var ret = this.parse.margin( '7px' ),
				expected = {
					/* vertical | horizontal */
					top: '7px',
					right: '7px',
					bottom: '7px',
					left: '7px'
				};

			objectAssert.areEqual( expected, ret );
		},

		'test style.parse.margin 2 members': function() {
			var ret = this.parse.margin( '10px 20px' ),
				expected = {
					/* vertical | horizontal */
					top: '10px',
					right: '20px',
					bottom: '10px',
					left: '20px'
				};

			objectAssert.areEqual( expected, ret );
		},

		'test style.parse.margin 3 members': function() {
			var ret = this.parse.margin( ' 3px 0 2' ),
				expected = {
					top: '3px',
					right: '0',
					bottom: '2',
					left: '0'
				};

			objectAssert.areEqual( expected, ret );
		},

		'test style.parse.margin 4 members': function() {
			var ret = this.parse.margin( ' 20px 2.5em 0 auto	' ),
				expected = {
					top: '20px',
					right: '2.5em',
					bottom: '0',
					left: 'auto'
				};

			objectAssert.areEqual( expected, ret );
		},

		'test style.parse.margin percentage': function() {
			var ret = this.parse.margin( ' 10px 5%;' ),
				expected = {
					top: '10px',
					right: '5%',
					bottom: '10px',
					left: '5%'
				};

			objectAssert.areEqual( expected, ret );
		},

		'test style.parse.margin docs sample': function() {
			objectAssert.areEqual( { top: '3px', right: '0', bottom: '2', left: '0' }, CKEDITOR.tools.style.parse.margin( '3px 0 2' ) );
		},

		'test style.parse.border docs sample': function() {
			objectAssert.areEqual( { width: '3px', style: 'solid', color: '#ffeedd' }, CKEDITOR.tools.style.parse.border( '3px solid #ffeedd' ) );
		},

		'test style.parse.border only with width': function() {
			objectAssert.areEqual( { width: '0%' }, CKEDITOR.tools.style.parse.border( '0%' ) );
		},

		'test style.parse.border only with zero width': function() {
			objectAssert.areEqual( { width: '0' }, CKEDITOR.tools.style.parse.border( '0' ) );
		},

		'test style.parse.border only with zero width with dot': function() {
			objectAssert.areEqual( {}, CKEDITOR.tools.style.parse.border( '0.' ) );
		},

		'test style.parse.border with width and style': function() {
			objectAssert.areEqual( { width: '0%', style: 'groove' }, CKEDITOR.tools.style.parse.border( '0% groove' ) );
		},

		'test style.parse.border with mixed color and style': function() {
			objectAssert.areEqual( { color: '#ff0000', style: 'dotted' }, CKEDITOR.tools.style.parse.border( '#ff0000 dotted' ) );
		},

		'test style.parse.border with mixed color, style and width': function() {
			objectAssert.areEqual( { width: '7.5em', color: '#ff0000', style: 'dotted' }, CKEDITOR.tools.style.parse.border( '#ff0000 dotted 7.5em' ) );
		},

		'test style.parse.border with style only': function() {
			objectAssert.areEqual( { style: 'dotted' }, CKEDITOR.tools.style.parse.border( 'dotted' ) );
		},

		'test style.parse.border with style and rgba color': function() {
			objectAssert.areEqual( { style: 'dotted', color: 'rgba(0,0,0,0)' }, CKEDITOR.tools.style.parse.border( 'dotted rgba(0,0,0,0)' ) );
		},

		'test style.parse.border with style and hsla color': function() {
			objectAssert.areEqual( { style: 'dotted', color: 'hsla(10,30%,30%,1)' }, CKEDITOR.tools.style.parse.border( 'dotted hsla(10,30%,30%,1)' ) );
		},

		'test style.parse.border with color white spaces': function() {
			objectAssert.areEqual( { style: 'solid', color: 'rgba(10,  20, 30,  .75)', width: '1px' },
				CKEDITOR.tools.style.parse.border( '1px solid rgba(10,  20, 30,  .75)' ) );
		}
	} );
} )();
