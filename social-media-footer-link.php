<?php
/**
 * Social media footer link
 *
 * @package           PluginPackage
 * @author            Khalid Ahmed
 * @copyright         2019 Khalid Ahmed
 * @license           GPL-2.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name:       Social media footer link
 * Plugin URI:        https://example.com/plugin-name
 * Description:       Show author's facebook and linkedin url below his post
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Khalid Ahmed
 * Author URI:        https://example.com
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       social-media-footer-link
 * Domain Path:       /languages
 */


if( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Include autoload file
 */
if( file_exists( __DIR__. '/vendor/autoload.php' ) ) {
	require_once __DIR__. '/vendor/autoload.php';
}

/**
 * Class Wp_Social_Media_Link
 */

final class Wp_Social_Media_Link {
    /**
     * Class constructor
     */
    public function __construct() {
        $this->wp_smfl_define_constants();
		register_activation_hook( __FILE__, [ $this, 'wp_smfl_activate' ] );
        add_action( 'init', [ $this, 'wp_smfl_init_plugin' ] );
    }

    /**
	 * Plugin version
	 */
	public const version = '1.0.0';

	/**
	 * Initialize singleton instance
	 *
	 * @return \Wp_Social_Media_Link
	 */
	public static function wp_smfl_init() {
		static $instance  = false;

		if(! $instance) {
			$instance = new self();
		}
		return $instance;
	}

	/**
	 * Define required plugins constants
	 *
	 * @return void
	 */
	public function wp_smfl_define_constants() {
		define( 'WP_SMFL_VERSION', self::version );
		define( 'WP_SMFL_FILE', __FILE__ );
		define( 'WP_SMFL_PATH', __DIR__ );
		define( 'WP_SMFL_URL', plugins_url( '', WP_SMFL_FILE ) );
		define( 'WP_SMFL_ASSETS', WP_SMFL_URL . '/assets' );
	}

    /**
	 * Initialize the plugin
	 *
	 * @return void
	 */

	public function wp_smfl_init_plugin() {
		new \Social\Link\Wp_Smfl_Add_Field();
	}

    /**
	 * Do stuff upon plugin activation
	 *
	 * @return void
	 */
	public function wp_smfl_activate() {
		$installed = get_option( 'wp_ffl_installed' );
		if( ! $installed ) {
			update_option('wp_ffl_installed', time() );
		}
		update_option('wp_ffl_installed', WP_SMFL_VERSION );
	}
}

/**
 * Initialize the main plugin
 *
 * @return \Wp_Social_Media_Link
 */
function wp_smfl_start_idea_manager()
{
	return Wp_Social_Media_Link::wp_smfl_init();
}

/**
 * Kick of plugin
 */
wp_smfl_start_idea_manager();