<?php
namespace WRDSB\Staff;

use \WRDSB\Staff\Modules\ClassLists\ClassListsModule as ClassListsModule;
use \WRDSB\Staff\Modules\ContentSearch\ContentSearchModule as ContentSearchModule;
use \WRDSB\Staff\Modules\Quartermaster\QuartermasterModule as QuartermasterModule;

use \WRDSB\Staff\Modules\Quartermaster\REST\DeviceLoanForm as DeviceLoanFormRESTController;
use \WRDSB\Staff\Modules\Quartermaster\REST\AssetAssignment as AssetAssignmentRESTController;
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
 * Version:           1.4.0
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
$container = Plugin::initContainer();

/**
 * Current plugin name.
 * Change this to your plugin's slug.
 */
$container['plugin_name'] = 'wrdsb-staff';

/**
 * Current plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 */
$container['version'] = '1.4.0';

$container['schoolCode'] = get_option('wrdsb_school_code', false);


$enabledModules = [
    'ContentSearchModule',
];

if ($container['schoolCode']) {
    $enabledModules[] = 'ClassListsModule';
    $enabledModules[] = 'QuartermasterModule';
}

$container['modules'] = $enabledModules;

$container['routes'] = [
    '^trillium/classes$' => [
        'module' => 'ClassListsModule',
        'view' => 'trillium-classes',
        'template' => 'ClassLists/Views/templates/trillium-classes.php'
    ],
    '^trillium/enrolments$' => [
        'module' => 'ClassListsModule',
        'view' => 'trillium-enrolments',
        'template' => 'ClassLists/Views/templates/trillium-enrolments.php'
    ],
    '^trillium/enrolments-email-list$' => [
        'module' => 'ClassListsModule',
        'view' => 'trillium-enrolments-emails',
        'template' => 'ClassLists/Views/templates/trillium-enrolments-emails.php'
    ],

    '^search/content$' => [
        'module' => 'ContentSearchModule',
        'view' => 'search-wp-posts',
        'template' => 'ContentSearch/Views/templates/search-wp-posts.php'
    ],

    '^quartermaster/asset-assignment/new$' => [
        'module' => 'QuartermasterModule',
        'view' => 'asset-assignment-new',
        'template' => 'Quartermaster/Components/AssetAssignments/New.php'
    ],
    '^quartermaster/asset-assignment/([^/]*)/edit' => [
        'module' => 'QuartermasterModule',
        'view' => 'asset-assignment-edit',
        'template' => 'Quartermaster/Components/AssetAssignments/Edit.php',
        'matches' => array('route', 'id')
    ],
    '^quartermaster/asset-assignment/([^/]*)/?' => [
        'module' => 'QuartermasterModule',
        'view' => 'asset-assignment-view',
        'template' => 'Quartermaster/Components/AssetAssignments/View.php',
        'matches' => array('route', 'id')
    ],
    '^quartermaster/asset-assignments/all$' => [
        'module' => 'QuartermasterModule',
        'view' => 'asset-assignments-list-all',
        'template' => 'Quartermaster/Components/AssetAssignments/ListAll.php',
    ],

    '^quartermaster/device-loan/new$' => [
        'module' => 'QuartermasterModule',
        'view' => 'device-loan-new',
        'template' => 'Quartermaster/Components/DeviceLoans/New.php'
    ],
    '^quartermaster/device-loan/([^/]*)/edit' => [
        'module' => 'QuartermasterModule',
        'view' => 'device-loan-edit',
        'template' => 'Quartermaster/Components/DeviceLoans/Edit.php',
        'matches' => array('route', 'id')
    ],
    '^quartermaster/device-loan/([^/]*)/?' => [
        'module' => 'QuartermasterModule',
        'view' => 'device-loan-view',
        'template' => 'Quartermaster/Components/DeviceLoans/View.php',
        'matches' => array('route', 'id')
    ],
    '^quartermaster/device-loans/active$' => [
        'module' => 'QuartermasterModule',
        'view' => 'device-loans-list-active',
        'template' => 'Quartermaster/Components/DeviceLoans/ListActive.php'
    ],
    '^quartermaster/device-loans/returned$' => [
        'module' => 'QuartermasterModule',
        'view' => 'device-loans-list-returned',
        'template' => 'Quartermaster/Components/DeviceLoans/ListReturned.php',
    ],
    '^quartermaster/device-loans/all$' => [
        'module' => 'QuartermasterModule',
        'view' => 'device-loans-list-all',
        'template' => 'Quartermaster/Components/DeviceLoans/ListAll.php',
    ],
];

/**
 * Instantiate main plugin class.
 * Pass plugin name and version from container to constructor.
 */
$container['plugin'] = function ($c) {
    return new Plugin($c, $c['plugin_name'], $c['version']);
};

$container['router'] = function ($c) {
    return new Router();
};

$container['ClassListsModule'] = function ($c) {
    return new ClassListsModule($c['plugin']);
};

$container['ContentSearchModule'] = function ($c) {
    return new ContentSearchModule($c['plugin']);
};

$container['QuartermasterModule'] = function ($c) {
    return new QuartermasterModule($c['plugin']);
};

/**
 * Bootstrap the plugin.
 */
$plugin = $container['plugin'];
$plugin->init();

// Formerly WRDSB Kitchen Sink
add_filter('send_password_change_email', '__return_false');
add_filter('send_email_change_email', '__return_false');

add_action('rest_api_init', function () {
    $controller = new DeviceLoanFormRESTController();
    $controller->registerRoutes();
});

add_action('rest_api_init', function () {
    $controller = new AssetAssignmentRESTController();
    $controller->registerRoutes();
});
