<?php
namespace WRDSB\Staff;

use \WRDSB\Staff\Modules\ClassLists\ClassListsModule as ClassListsModule;
use \WRDSB\Staff\Modules\ContentSearch\ContentSearchModule as ContentSearchModule;
use \WRDSB\Staff\Modules\SchoolScheduling\SchoolSchedulingModule as SchoolSchedulingModule;
use \WRDSB\Staff\Modules\EmployeeAbsence\EmployeeAbsenceModule as EmployeeAbsenceModule;

use \WRDSB\Staff\Modules\EmployeeAbsence\REST\AbsenceForm as AbsenceFormRESTController;

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
$container['version'] = '1.2.0';

$container['schoolCode'] = get_option('wrdsb_school_code', false);

$container['schoolSchedulingEnabledFor'] = ['JAM', 'SSS'];

$container['employeeAbsenceEnabledFor'] = ['JAM', 'SSS'];

$enabledModules = [
    'ContentSearchModule',
];

if ($container['schoolCode']) {
    $enabledModules[] = 'ClassListsModule';
}

if ($container['schoolCode'] && in_array($container['schoolCode'], $container['schoolSchedulingEnabledFor'])) {
    $enabledModules[] = 'SchoolSchedulingModule';
}

if ($container['schoolCode'] && in_array($container['schoolCode'], $container['employeeAbsenceEnabledFor'])) {
    $enabledModules[] = 'EmployeeAbsenceModule';
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
    '^employee/absence/types$' => [
        'module' => 'EmployeeAbsenceModule',
        'view' => 'absence-type-list',
        'template' => 'EmployeeAbsence/Components/AbsenceTypeList/AbsenceTypeList.php'
    ],
    '^employee/absence/type/([^/]*)/?' => [
        'module' => 'EmployeeAbsenceModule',
        'view' => 'absence-type-detail',
        'template' => 'EmployeeAbsence/Components/AbsenceTypeDetail/AbsenceTypeDetail.php',
    ],
    '^employee/absence/parts$' => [
        'module' => 'EmployeeAbsenceModule',
        'view' => 'absence-part-list',
        'template' => 'EmployeeAbsence/Components/AbsencePartList/AbsencePartList.php'
    ],
    '^employee/absence/parts/([^/]*)/?' => [
        'module' => 'EmployeeAbsenceModule',
        'view' => 'absence-part-list',
        'template' => 'EmployeeAbsence/Components/AbsencePartList/AbsencePartList.php'
    ],
    '^employee/absence/part/([^/]*)/?' => [
        'module' => 'EmployeeAbsenceModule',
        'view' => 'absence-part-detail',
        'template' => 'EmployeeAbsence/Components/AbsencePartDetail/AbsencePartDetail.php'
    ],
    '^employee/absences/([^/]*)/?' => [
        'module' => 'EmployeeAbsenceModule',
        'view' => 'absence-form-list',
        'template' => 'EmployeeAbsence/Components/AbsenceFormList/AbsenceFormList.php',
        'matches' => array('route', 'epoch')
    ],
    '^employee/absence/new$' => [
        'module' => 'EmployeeAbsenceModule',
        'view' => 'absence-form-new',
        'template' => 'EmployeeAbsence/Components/AbsenceFormNew/AbsenceFormNew.php'
    ],
    '^employee/absence/quick-add$' => [
        'module' => 'EmployeeAbsenceModule',
        'view' => 'absence-quick-add',
        'template' => 'EmployeeAbsence/Components/AbsenceQuickAdd/AbsenceQuickAdd.php'
    ],
    '^employee/absence/([^/]*)/edit' => [
        'module' => 'EmployeeAbsenceModule',
        'view' => 'absence-form-edit',
        'template' => 'EmployeeAbsence/Components/AbsenceFormEdit/AbsenceFormEdit.php',
        'matches' => array('route', 'id')
    ],
    '^employee/absence/([^/]*)/?' => [
        'module' => 'EmployeeAbsenceModule',
        'view' => 'absence-form-view',
        'template' => 'EmployeeAbsence/Components/AbsenceFormView/AbsenceFormView.php',
        'matches' => array('route', 'id')
    ],
    '^employee/([^/]*)/absences' => [
        'module' => 'EmployeeAbsenceModule',
        'view' => 'absence-form-list',
        'template' => 'EmployeeAbsence/Components/AbsenceFormList/AbsenceFormList.php',
        'matches' => array('route', 'employee')
    ],
    '^employee/([^/]*)/absence/parts' => [
        'module' => 'EmployeeAbsenceModule',
        'view' => 'absence-part-list',
        'template' => 'EmployeeAbsence/Components/AbsencePartList/AbsencePartList.php'
    ],
    '^scheduling/day-parts$' => [
        'module' => 'SchoolSchedulingModule',
        'view' => 'day-part-list',
        'template' => 'SchoolScheduling/Components/DayPartList/DayPartList.php'
    ],
    '^scheduling/day-part/([^/]*)/?' => [
        'module' => 'SchoolSchedulingModule',
        'view' => 'day-part-detail',
        'template' => 'SchoolScheduling/Components/DayPartDetail/DayPartDetail.php'
    ],
    '^scheduling/day-templates$' => [
        'module' => 'SchoolSchedulingModule',
        'view' => 'day-template-list',
        'template' => 'SchoolScheduling/Components/DayTemplateList/DayTemplateList.php'
    ],
    '^scheduling/day-template/([^/]*)/?' => [
        'module' => 'SchoolSchedulingModule',
        'view' => 'day-template-detail',
        'template' => 'SchoolScheduling/Components/DayTemplateDetail/DayTemplateDetail.php'
    ],
    '^scheduling/days$' => [
        'module' => 'SchoolSchedulingModule',
        'view' => 'day-list',
        'template' => 'SchoolScheduling/Components/DayList/DayList.php'
    ],
    '^scheduling/day/([^/]*)/?' => [
        'module' => 'SchoolSchedulingModule',
        'view' => 'day-detail',
        'template' => 'SchoolScheduling/Components/DayDetail/DayDetail.php'
    ]
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

$container['EmployeeAbsenceModule'] = function ($c) {
    return new EmployeeAbsenceModule($c['plugin']);
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
    $controller = new AbsenceFormRESTController();
    $controller->registerRoutes();
});
