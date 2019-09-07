<?php
namespace WRDSB\Staff;

use \WRDSB\Staff\Modules\ClassLists\ClassListsModule as ClassListsModule;

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

if (! is_admin()) {
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

    $container['ClassListsModule'] = function ($c) {
        return new ClassListsModule($c['plugin']);
    };

    $container['ContentSearchModule'] = function ($c) {
        return new ContentSearchModule($c['plugin']);
    };

    /**
     * Bootstrap the plugin.
     */
    $plugin = $container['plugin'];

    $schoolCode = get_option('wrdsb_school_code', false);

    $container['ContentSearchModule']->init();

    if ($schoolCode) {
        $container['ClassListsModule']->init();
    }

    $plugin->registerHooks();
}

// Formerly WRDSB Kitchen Sink
add_filter('send_password_change_email', '__return_false');
add_filter('send_email_change_email', '__return_false');
