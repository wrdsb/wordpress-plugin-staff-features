<?php
namespace WRDSB\Staff;

use WRDSB\OptionsFramework as OptionsFramework;

use \WRDSB\Staff\Modules\ClassLists\Views\BackEnd as ClassLists_BackEnd;
use \WRDSB\Staff\Modules\ClassLists\Views\FrontEnd as ClassLists_FrontEnd;

use \WRDSB\Staff\Modules\ContentSearch\ContentSearchModule as ContentSearchModule;

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link    https://github.com/wrdsb
 * @since   1.0.0
 * @package WRDSB_Staff
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
if (! defined('WPINC')) {
    die;
}

require_once 'vendor/autoload.php';

/**
 * Instantiate the container.
 */
$container = Plugin::getContainer();

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
$container['plugin'] = function ($c) {
    return new Plugin($c['plugin_name'], $c['version']);
};

$container['class_lists_back_end'] = function ($c) {
    return new ClassLists_BackEnd($c['plugin']);
};

$container['class_lists_front_end'] = function ($c) {
    return new ClassLists_FrontEnd($c['plugin']);
};

$container['ContentSearchModule'] = function ($c) {
    return new ContentSearchModule($c['plugin']);
};

register_activation_hook(__FILE__, array( __NAMESPACE__ . '\\Activator', 'activate' ));
register_deactivation_hook(__FILE__, array( __NAMESPACE__ . '\\Deactivator', 'deactivate' ));

/**
 * Bootstrap the plugin.
 */
$plugin = $container['plugin'];

$container['ContentSearchModule']->init();

$class_lists_back_end = $container['class_lists_back_end'];
$class_lists_front_end = $container['class_lists_front_end'];

$plugin->registerHooks();
