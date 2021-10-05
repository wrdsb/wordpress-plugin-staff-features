<?php
namespace WRDSB\Staff;

use \WRDSB\Staff\Modules\ClassLists\ClassListsModule as ClassListsModule;
use \WRDSB\Staff\Modules\ContentSearch\ContentSearchModule as ContentSearchModule;
use \WRDSB\Staff\Modules\Quartermaster\QuartermasterModule as QuartermasterModule;
use \WRDSB\Staff\Modules\SchoolData\SchoolDataModule as SchoolDataModule;

use \WRDSB\Staff\Modules\Quartermaster\REST\DeviceLoan as DeviceLoanRESTController;
use \WRDSB\Staff\Modules\Quartermaster\REST\AssetAssignment as AssetAssignmentRESTController;

use \WRDSB\Staff\Modules\SchoolData\Model\DrillScheduleCPT as DrillScheduleCPT;
use \WRDSB\Staff\Modules\SchoolData\Model\EmergencyResponseTeamCPT as EmergencyResponseTeamCPT;
use \WRDSB\Staff\Modules\SchoolData\Model\EvacuationSitesCPT as EvacuationSitesCPT;
use \WRDSB\Staff\Modules\SchoolData\Model\IPRCCPT as IPRCCPT;
use \WRDSB\Staff\Modules\SchoolData\Model\SCISTeamCPT as SCISTeamCPT;
use \WRDSB\Staff\Modules\SchoolData\Model\WorkplaceInspectionTeamCPT as WorkplaceInspectionTeamCPT;

use \WRDSB\Staff\Modules\SchoolData\Model\DrillSchedule as DrillSchedule;
use \WRDSB\Staff\Modules\SchoolData\Model\EmergencyResponseTeam as EmergencyResponseTeam;
use \WRDSB\Staff\Modules\SchoolData\Model\EvacuationSites as EvacuationSites;
use \WRDSB\Staff\Modules\SchoolData\Model\IPRC as IPRC;
use \WRDSB\Staff\Modules\SchoolData\Model\SCISTeam as SCISTeam;
use \WRDSB\Staff\Modules\SchoolData\Model\WorkplaceInspectionTeam as WorkplaceInspectionTeam;

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
 * Version:           1.7.1
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
$container['version'] = '1.7.1';

$container['schoolCode'] = get_option('wrdsb_school_code', false);
$container['schoolDataAdminEnabled'] = (get_option('schoolDataAdminEnabled', false) == 'true') ? true : false;

$enabledModules = [
    'ContentSearchModule',
];

if ($container['schoolCode']) {
    $enabledModules[] = 'ClassListsModule';
    $enabledModules[] = 'QuartermasterModule';
    $enabledModules[] = 'SchoolDataModule';
}

if ($container['schoolDataAdminEnabled']) {
    $enabledModules[] = 'SchoolDataModule';
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
    '^quartermaster/asset-assignments/active$' => [
        'module' => 'QuartermasterModule',
        'view' => 'asset-assignments-list-active',
        'template' => 'Quartermaster/Components/AssetAssignments/ListActive.php',
    ],
    '^quartermaster/asset-assignments/returned$' => [
        'module' => 'QuartermasterModule',
        'view' => 'asset-assignments-list-returned',
        'template' => 'Quartermaster/Components/AssetAssignments/ListReturned.php',
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

    '^school-data/home$' => [
        'module' => 'SchoolDataModule',
        'view' => 'home-page',
        'template' => 'SchoolData/Components/Static/HomePage.php'
    ],
    '^school-data/admin$' => [
        'module' => 'SchoolDataModule',
        'view' => 'admin-home-page',
        'template' => 'SchoolData/Components/Static/AdminHomePage.php'
    ],

    '^school-data/drill-schedule/edit$' => [
        'module' => 'SchoolDataModule',
        'view' => 'drill-schedule-edit',
        'template' => 'SchoolData/Components/DrillSchedule/Edit.php'
    ],
    '^school-data/drill-schedule/instructions$' => [
        'module' => 'SchoolDataModule',
        'view' => 'drill-schedule-instructions',
        'template' => 'SchoolData/Components/Static/DrillScheduleInstructions.php'
    ],
    '^school-data/drill-schedule$' => [
        'module' => 'SchoolDataModule',
        'view' => 'drill-schedule-view',
        'template' => 'SchoolData/Components/DrillSchedule/View.php'
    ],

    '^school-data/emergency-response-team/edit$' => [
        'module' => 'SchoolDataModule',
        'view' => 'emergency-response-team-edit',
        'template' => 'SchoolData/Components/EmergencyResponseTeam/Edit.php'
    ],
    '^school-data/emergency-response-team/instructions$' => [
        'module' => 'SchoolDataModule',
        'view' => 'emergency-response-team-instructions',
        'template' => 'SchoolData/Components/Static/EmergencyResponseTeamInstructions.php'
    ],
    '^school-data/emergency-response-team$' => [
        'module' => 'SchoolDataModule',
        'view' => 'emergency-response-team-view',
        'template' => 'SchoolData/Components/EmergencyResponseTeam/View.php'
    ],

    '^school-data/evacuation-sites/edit$' => [
        'module' => 'SchoolDataModule',
        'view' => 'evacuation-sites-edit',
        'template' => 'SchoolData/Components/EvacuationSites/Edit.php'
    ],
    '^school-data/evacuation-sites/instructions$' => [
        'module' => 'SchoolDataModule',
        'view' => 'evacuation-sites-instructions',
        'template' => 'SchoolData/Components/Static/EvacuationSitesInstructions.php'
    ],
    '^school-data/evacuation-sites$' => [
        'module' => 'SchoolDataModule',
        'view' => 'evacuation-sites-view',
        'template' => 'SchoolData/Components/EvacuationSites/View.php'
    ],

    '^school-data/iprc/edit$' => [
        'module' => 'SchoolDataModule',
        'view' => 'iprc-edit',
        'template' => 'SchoolData/Components/IPRC/Edit.php'
    ],
    '^school-data/iprc/instructions$' => [
        'module' => 'SchoolDataModule',
        'view' => 'iprc-instructions',
        'template' => 'SchoolData/Components/Static/IPRCInstructions.php'
    ],
    '^school-data/iprc$' => [
        'module' => 'SchoolDataModule',
        'view' => 'iprc-view',
        'template' => 'SchoolData/Components/IPRC/View.php'
    ],

    '^school-data/scis-team/edit$' => [
        'module' => 'SchoolDataModule',
        'view' => 'scis-team-edit',
        'template' => 'SchoolData/Components/SCISTeam/Edit.php'
    ],
    '^school-data/scis-team/instructions$' => [
        'module' => 'SchoolDataModule',
        'view' => 'scis-team-instructions',
        'template' => 'SchoolData/Components/Static/SCISTeamInstructions.php'
    ],
    '^school-data/scis-team$' => [
        'module' => 'SchoolDataModule',
        'view' => 'scis-team-view',
        'template' => 'SchoolData/Components/SCISTeam/View.php'
    ],

    '^school-data/workplace-inspection-team/edit$' => [
        'module' => 'SchoolDataModule',
        'view' => 'workplace-inspection-team-edit',
        'template' => 'SchoolData/Components/WorkplaceInspectionTeam/Edit.php'
    ],
    '^school-data/workplace-inspection-team/instructions$' => [
        'module' => 'SchoolDataModule',
        'view' => 'workplace-inspection-team-instructions',
        'template' => 'SchoolData/Components/Static/WorkplaceInspectionTeamInstructions.php'
    ],
    '^school-data/workplace-inspection-team$' => [
        'module' => 'SchoolDataModule',
        'view' => 'workplace-inspection-team-view',
        'template' => 'SchoolData/Components/WorkplaceInspectionTeam/View.php'
    ],

    '^school-data/audits/drill-schedule$' => [
        'module' => 'SchoolDataModule',
        'view' => 'drill-schedule-audit',
        'template' => 'SchoolData/Components/Search/Audit/DrillSchedule.php'
    ],
    '^school-data/lists/drill-schedule$' => [
        'module' => 'SchoolDataModule',
        'view' => 'drill-schedule-list',
        'template' => 'SchoolData/Components/Search/List/DrillSchedule.php'
    ],
    '^school-data/single/drill-schedule/([^/]*)/?' => [
        'module' => 'SchoolDataModule',
        'view' => 'drill-schedule-single',
        'template' => 'SchoolData/Components/Search/Single/DrillSchedule.php',
        'matches' => array('route', 'schoolCode')
    ],

    '^school-data/audits/emergency-response-team$' => [
        'module' => 'SchoolDataModule',
        'view' => 'emergency-response-team-audit',
        'template' => 'SchoolData/Components/Search/Audit/EmergencyResponseTeam.php'
    ],
    '^school-data/lists/emergency-response-team$' => [
        'module' => 'SchoolDataModule',
        'view' => 'emergency-response-team-list',
        'template' => 'SchoolData/Components/Search/List/EmergencyResponseTeam.php'
    ],
    '^school-data/single/emergency-response-team/([^/]*)/?' => [
        'module' => 'SchoolDataModule',
        'view' => 'emergency-response-team-single',
        'template' => 'SchoolData/Components/Search/Single/EmergencyResponseTeam.php',
        'matches' => array('route', 'schoolCode')
    ],

    '^school-data/audits/evacuation-sites$' => [
        'module' => 'SchoolDataModule',
        'view' => 'evacuation-sites-audit',
        'template' => 'SchoolData/Components/Search/Audit/EvacuationSites.php'
    ],
    '^school-data/lists/evacuation-sites$' => [
        'module' => 'SchoolDataModule',
        'view' => 'evacuation-sites-list',
        'template' => 'SchoolData/Components/Search/List/EvacuationSites.php'
    ],
    '^school-data/single/evacuation-sites/([^/]*)/?' => [
        'module' => 'SchoolDataModule',
        'view' => 'evacuation-sites-single',
        'template' => 'SchoolData/Components/Search/Single/EvacuationSites.php',
        'matches' => array('route', 'schoolCode')
    ],

    '^school-data/audits/iprc$' => [
        'module' => 'SchoolDataModule',
        'view' => 'iprc-audit',
        'template' => 'SchoolData/Components/Search/Audit/IPRC.php'
    ],
    '^school-data/lists/iprc$' => [
        'module' => 'SchoolDataModule',
        'view' => 'iprc-list',
        'template' => 'SchoolData/Components/Search/List/IPRC.php'
    ],
    '^school-data/single/iprc/([^/]*)/?' => [
        'module' => 'SchoolDataModule',
        'view' => 'iprc-single',
        'template' => 'SchoolData/Components/Search/Single/IPRC.php',
        'matches' => array('route', 'schoolCode')
    ],

    '^school-data/audits/scis-team$' => [
        'module' => 'SchoolDataModule',
        'view' => 'scis-team-audit',
        'template' => 'SchoolData/Components/Search/Audit/SCISTeam.php'
    ],
    '^school-data/lists/scis-team$' => [
        'module' => 'SchoolDataModule',
        'view' => 'scis-team-list',
        'template' => 'SchoolData/Components/Search/List/SCISTeam.php'
    ],
    '^school-data/single/scis-team/([^/]*)/?' => [
        'module' => 'SchoolDataModule',
        'view' => 'scis-team-single',
        'template' => 'SchoolData/Components/Search/Single/SCISTeam.php',
        'matches' => array('route', 'schoolCode')
    ],

    '^school-data/audits/workplace-inspection-team$' => [
        'module' => 'SchoolDataModule',
        'view' => 'workplace-inspection-team-audit',
        'template' => 'SchoolData/Components/Search/Audit/WorkplaceInspectionTeam.php'
    ],
    '^school-data/lists/workplace-inspection-team$' => [
        'module' => 'SchoolDataModule',
        'view' => 'workplace-inspection-team-list',
        'template' => 'SchoolData/Components/Search/List/WorkplaceInspectionTeam.php'
    ],
    '^school-data/single/workplace-inspection-team/([^/]*)/?' => [
        'module' => 'SchoolDataModule',
        'view' => 'workplace-inspection-team-single',
        'template' => 'SchoolData/Components/Search/Single/WorkplaceInspectionTeam.php',
        'matches' => array('route', 'schoolCode')
    ],
];

/**
 * Instantiate main plugin class.
 * Pass plugin name and version from container to constructor.
 */
$container['plugin'] = function ($c) {
    return new Plugin($c);
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

$container['SchoolDataModule'] = function ($c) {
    return new SchoolDataModule($c['plugin']);
};

$container['DrillScheduleCPT'] = function ($c) {
    return new DrillScheduleCPT($c['plugin']);
};

$container['EmergencyResponseTeamCPT'] = function ($c) {
    return new EmergencyResponseTeamCPT($c['plugin']);
};

$container['EvacuationSitesCPT'] = function ($c) {
    return new EvacuationSitesCPT($c['plugin']);
};

$container['IPRCCPT'] = function ($c) {
    return new IPRCCPT($c['plugin']);
};

$container['SCISTeamCPT'] = function ($c) {
    return new SCISTeamCPT($c['plugin']);
};

$container['WorkplaceInspectionTeamCPT'] = function ($c) {
    return new WorkplaceInspectionTeamCPT($c['plugin']);
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
    $controller = new DeviceLoanRESTController();
    $controller->registerRoutes();
});

add_action('rest_api_init', function () {
    $controller = new AssetAssignmentRESTController();
    $controller->registerRoutes();
});

add_action('admin_post_schoolDataDrillSchedule', __NAMESPACE__ .'\\submitSchoolDataDrillSchedule');
add_action('admin_post_schoolDataEmergencyResponseTeam', __NAMESPACE__ .'\\submitSchoolDataEmergencyResponseTeam');
add_action('admin_post_schoolDataEvacuationSites', __NAMESPACE__ .'\\submitSchoolDataEvacuationSites');
add_action('admin_post_schoolDataIPRC', __NAMESPACE__ .'\\submitSchoolDataIPRC');
add_action('admin_post_schoolDataSCISTeam', __NAMESPACE__ .'\\submitSchoolDataSCISTeam');
add_action('admin_post_schoolDataWorkplaceInspectionTeam', __NAMESPACE__ .'\\submitSchoolDataWorkplaceInspectionTeam');

function submitSchoolDataDrillSchedule() {
    DrillSchedule::fromForm($_POST);
}

function submitSchoolDataEmergencyResponseTeam() {
    EmergencyResponseTeam::fromForm($_POST);
}

function submitSchoolDataEvacuationSites() {
    EvacuationSites::fromForm($_POST);
}

function submitSchoolDataIPRC() {
    IPRC::fromForm($_POST);
}

function submitSchoolDataSCISTeam() {
    SCISTeam::fromForm($_POST);
}

function submitSchoolDataWorkplaceInspectionTeam() {
    WorkplaceInspectionTeam::fromForm($_POST);
}
