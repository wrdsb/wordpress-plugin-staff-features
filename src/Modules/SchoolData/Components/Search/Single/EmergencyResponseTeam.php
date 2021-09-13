<?php
namespace WRDSB\Staff\Modules\SchoolData\Components;
use WRDSB\Staff\Modules\WP\WPCore as WPCore;
use WRDSB\Staff\Modules\SchoolData\Components\Partials\PermissionDenied as PermissionDenied;
use WRDSB\Staff\Modules\SchoolData\Model\EmergencyResponseTeam;
use WRDSB\Staff\Modules\SchoolData\SchoolDataModule as Module;
use WRDSB\Staff\Modules\SchoolData\Model\EmergencyResponseTeamSearch as EmergencyResponseTeamSearch;

if ($wp_query->query_vars['schoolCode']) {
    $schoolCode = strtoupper($wp_query->query_vars['schoolCode']);
}
$searchInstance = EmergencyResponseTeamSearch::getBySchoolCode($schoolCode);
$currentInstance = new EmergencyResponseTeam(json_decode(json_encode($searchInstance), true));

$page_title = "{$schoolCode} Emergency Response Team";

function setCustomTitle($schoolCode) {
    $page_title = "{$schoolCode} Emergency Response Team";
    return $page_title;
}
WPCore::addFilter('pre_get_document_title', '\WRDSB\Staff\Modules\SchoolData\Components\setCustomTitle');
?>

<?php WPCore::getHeader(); ?>

<div class="container-top">
    <?php WPCore::getTemplatePart('partials/header', 'masthead'); ?>

    <?php if (! WPCore::currentUserCanViewContent()) { ?>
        <?php WPCore::getTemplatePart('partials/content', 'unauthorized'); ?>
    <?php } else { ?>
        <?php WPCore::getTemplatePart('partials/header', 'navbar'); ?>

        <div class="container container-breadcrumb" role="navigation">
            <ol class="breadcrumb">
            <li>
                    <a href="<?php echo WPCore::getOption('home'); ?>">Home</a>
                </li>
                <li>
                    <a href="<?php echo WPCore::homeURL(); ?>/school-data/home">School Data</a>
                </li>
                <li>
                    <a href="<?php echo WPCore::homeURL(); ?>/school-data/admin">Admin</a>
                </li>
                <li>
                    <a href="<?php echo WPCore::homeURL(); ?>/school-data/lists/emergency-response-team/">Emergency Response Team</a>
                </li>
                <li>
                    <?php echo $page_title?>
                </li>
            </ol>
        </div>
    <?php } ?>
</div>

<div class="container">
    <div class="row">
        <?php if (!WPCore::currentUserCanViewContent()) { ?>
            <?php //echo PermissionDenied::cannotView(); ?>

        <?php } else { ?>
            <div class="col-sm-12 col-lg-12" role="main">
                <!-- CONTENT -->
                <h1><?php echo $page_title; ?></h1>

                <form>
                </form>
                <!-- /CONTENT -->
            </div>
        <?php } ?>
    </div>
</div>

<?php WPCore::getFooter();
