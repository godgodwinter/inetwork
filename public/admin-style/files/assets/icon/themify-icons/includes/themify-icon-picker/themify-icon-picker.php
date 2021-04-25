<?php
/*
Plugin Name:  Themify Icon Picker
Version:      1.0.0
Author:       Themify
Author URI:   https://themify.me/
Description:   
Text Domain:  themify
Domain Path:  /languages
License:      GNU General Public License v2.0
License URI:  http://www.gnu.org/licenses/gpl-2.0.html
*/

if( ! class_exists( 'Themify_Icon_Picker' ) ) :
/**
 * Icon Picker base class
 *
 * Initializes the plugin and also provides the API to register new icon fonts.
 */
class Themify_Icon_Picker {

	public $url;
	private $types;

	/**
	 * Creates or returns an instance of this class.
	 *
	 * @return	A single instance of this class.
	 */
	public static function get_instance( $url = '' ) {
		static $instance = null;
		if ( $instance === null ) {
			$instance = new self( $url );
		}
		return $instance;
	}

	private function __construct( $url ) {
		$this->url = trailingslashit( $url );
		include trailingslashit( dirname( __FILE__ ) ) . 'includes/class-icon-font-fontawesome.php';
		include trailingslashit( dirname( __FILE__ ) ) . 'includes/class-icon-font-themify.php';
		add_action( 'init', array( $this, 'init' ) );
		add_action( 'wp_ajax_tf_icon_picker', array( $this, 'tf_icon_picker' ) );
		add_action( 'wp_ajax_tf_get_icon', array( $this, 'tf_ajax_get_icon' ) );
	}

	public function init() {
		do_action( 'themify_icon_picker_register_types', $this );
	}

	/**
	 * Register an icon font to be displayed in the icon picker
	 *
	 * @param $class_name the PHP class name
	 */
	public function register( $class_name ) {
		if( class_exists( $class_name ) ) {
			$this->types[ $class_name ] = new $class_name;
		}
	}

	/**
	 * Disable an icon font previsouly registered
	 *
	 * @param $class_name the PHP class name
	 */
	public function deregister( $class_name ) {
		unset( $this->types[ $class_name ] );
	}

	/**
	 * Returns a list of icon fonts registered
	 *
	 * @return array
	 */
	public function get_types() {
		return $this->types;
	}

	/**
	 * Render the icon picker interface
	 *
	 * @since 1.0
	 */
	public function tf_icon_picker() {
		$icon_fonts = $this->get_types();
		if( ! empty( $icon_fonts ) ) {
			include trailingslashit( dirname( __FILE__ ) ) . 'views/template.php';
		}
		die;
	}

	/**
	 * Hooked to "tf_get_icon" Ajax call, returns the icon CSS classname for $_POST['tf_icon']
	 *
	 * @since 1.0
	 */
	public function tf_ajax_get_icon() {
		if( isset( $_GET['tf_icon'] ) ) {
			echo htmlspecialchars( themify_get_icon( $_GET['tf_icon'] ) );
		}
		die;
	}

	/**
	 * Load script and style required for the icon picker interface
	 *
	 * Must be called manually wherever you need the icon picker.
	 */
	public function enqueue() {
		wp_enqueue_style( 'tf-icon-picker', self::themify_unique($this->url . 'assets/styles.css'));
		wp_enqueue_script( 'tf-icon-picker', self::themify_unique($this->url . 'assets/themify.font-icons-select.js'), array( 'jquery' ), null, true );
		wp_localize_script( 'tf-icon-picker', 'tfIconPicker', array(
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
		) );

		do_action( 'themify_icon_picker_enqueue' );
	}
        //need for themify icons plugin
        public static function themify_unique($url){
            return function_exists('themify_enque')?themify_enque($url):$url;
        }
}
endif;

if( ! class_exists( 'Themify_Icon_Picker_Font' ) ) :
/**
 * Definition for icon font classes
 *
 * @since 1.0
 */
class Themify_Icon_Picker_Font {

	/**
	 * Return the ID of the icon font
	 *
	 * @return string
	 */
	function get_id() {
		return '';
	}

	/**
	 * Return the name of the icon font
	 *
	 * @return string
	 */
	function get_label() {
		return '';
	}

	/**
	 * Gets an icon name and checks if it's a valid icon in the font
	 *
	 * @param $name name of the icon
	 * @return bool
	 */
	function is_valid_icon( $name ) {
		return true;
	}

	/**
	 * Returns the formatted CSS classname for the icon
	 *
	 * @return string
	 */
	function get_classname( $icon ) {
		return $icon;
	}

	/**
	 * Returns a list of icons available in this icon font.
	 *
	 * Must return an array formatted as:
	 *     array(
	 *         'category' => array(
	 *             'key' => 'category',
	 *             'label' => 'Category Name',
	 *             'icons' => array(
	 *                 'icon-name' => 'Icon Name',
	 *                 'icon-name' => 'Icon Name',
	 *             )
	 *         ),
	 *     )
	 *
	 * @return array
	 */
	function get_icons() {
		return array();
	}

	function picker_template() { ?>
		<div class="tf-font-group" data-group="<?php echo $this->get_id(); ?>">

			<ul class="themify-lightbox-icon">
				<?php foreach( $this->get_icons() as $category ) : ?>
					<li data-id="<?php echo $this->get_id() . '-' . $category['key']; ?>">
						<span><?php echo $category['label']; ?></span>
					</li>
				<?php endforeach; ?>
			</ul>

			<?php foreach( $this->get_icons() as $category ) : ?>
				<section id="<?php echo $this->get_id() . '-' . $category['key']; ?>">
					<h2 class="page-header"><?php echo $category['label']; ?></h2>
					<div class="row">
						<?php foreach( $category['icons'] as $icon_key => $icon_label ) : ?>
							<a href="#" data-icon="<?php echo $icon_key; ?>">
								<i class="<?php echo $this->get_classname( $icon_key ); ?>" aria-hidden="true"></i>
								<?php echo $icon_label; ?>
							</a>
						<?php endforeach; ?>
					</div>
				</section><!-- #<?php echo $this->get_id() . '-' . $category['key']; ?> -->
			<?php endforeach; ?>

		</div><!-- .tf-font-group -->
	<?php
	}
}
endif;

if( ! function_exists( 'themify_get_icon' ) ) :
/**
 * Retrieve an icon name and returns the proper CSS classname to display that icon
 *
 * @return string
 */
function themify_get_icon( $name ) {
	$types = Themify_Icon_Picker::get_instance()->get_types();
	if( empty( $types ) )
		return $name;

	foreach( $types as $font ) {
		if( $font->is_valid_icon( $name ) ) {
			$name = $font->get_classname( $name );
			break;
		}
	}

	return $name;
}
endif;