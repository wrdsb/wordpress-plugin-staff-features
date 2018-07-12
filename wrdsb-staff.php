<?php
namespace WRDSB\Staff;

use \WRDSB\Staff\Modules\UI\BackEnd;
use \WRDSB\Staff\Modules\UI\FrontEnd;

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/wrdsb
 * @since             1.0.0
 * @package           WRDSB_Staff
 *
 * @wordpress-plugin
 * Plugin Name:       WRDSB Staff Features
 * Plugin URI:        https://github.com/wrdsb/wordpress-plugin-staff-features
 * Description:       An omnibus plugin to provide features unique to our wrdsbstaff WordPress install.
 * Version:           1.0.0
 * Author:            WRDSB
 * Author URI:        https://github.com/wrdsb
 * License:           GPL-3.0+
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain:       wrdsb-staff
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

require_once 'vendor/autoload.php';

/**
 * Instantiate the container.
 */
$container = get_container();

/**
 * Current plugin name.
 * Change this to your plugin's slug.
 */
$container['plugin_name'] = 'wrdsb-staff';

/**
 * Current plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 */
$container['version'] = '1.0.0';

/**
 * Instantiate main plugin class.
 * Pass plugin name and version from container to constructor.
 */
$container['plugin'] = function( $c ) {
	return new Plugin( $c['plugin_name'], $c['version'] );
};

$container['back_end_ui'] = function( $c ) {
	return new BackEnd( $c['plugin'] );
};

$container['front_end_ui'] = function( $c ) {
	return new FrontEnd( $c['plugin'] );
};

register_activation_hook( __FILE__, array( __NAMESPACE__ . '\\Activator', 'activate' ) );
register_deactivation_hook( __FILE__, array( __NAMESPACE__ . '\\Deactivator', 'deactivate' ) );

$plugin = $container['plugin'];

$back_end_ui   = $container['back_end_ui'];
$front_end_ui = $container['front_end_ui'];

$plugin->register_hooks();


/**
 * Get plugin's container
 *
 * @return \Pimple\Container
 */
function get_container() : \Pimple\Container {
	static $container;
	if ( ! $container ) {
		$container = new \Pimple\Container();
	}
	return $container;
}
