<?php
namespace WRDSB\Staff\Modules\SchoolData\Components;

use WRDSB\Staff\Modules\WP\WPCore as WPCore;
use WRDSB\Staff\Modules\SchoolData\SchoolDataModule as Module;
use WRDSB\Staff\Modules\SchoolData\Components\Partials\PermissionDenied as PermissionDenied;

use WRDSB\Staff\Modules\SchoolData\Model\SchoolsList as SchoolsList;
use WRDSB\Staff\Modules\SchoolData\Model\PrincipalsList as PrincipalsList;
use WRDSB\Staff\Modules\SchoolData\Model\EvacuationSitesSearch as EvacuationSitesSearch;

$featureCheck = Module::featureGuard('SchoolDataAdminAudits');
$viewCheck = Module::userCanViewGuard();

$page_title = "Evacuation Sites Audit";

function setCustomTitle() {
    $page_title = "Evacuation Sites Audit";
    return $page_title;
}
WPCore::addFilter('pre_get_document_title', '\WRDSB\Staff\Modules\SchoolData\Components\setCustomTitle');

$schools = SchoolsList::all();
$principals = PrincipalsList::all();
$audit = EvacuationSitesSearch::audit();

$principalEmails = array();
foreach ($audit['bad'] as $schoolCode => $schoolName) {
    $principalEmails[] = $principals[strtolower($schoolCode)] . ', ';
}

$totalEmails                = count($principalEmails);
$lastEmail                  = $totalEmails - 1;
$principalEmails[$lastEmail] = str_replace(',', '', $principalEmails[$lastEmail]);

$emailsList = '';
foreach ($principalEmails as $email) {
    $emailsList .= $email;
}
?>

<?php WPCore::getHeader(); ?>

<div class="container-top">
    <?php WPCore::getTemplatePart('partials/header', 'masthead'); ?>

    <?php if (! $viewCheck) { ?>
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
                    Evacuation Sites
                </li>
            </ol>
        </div>
    <?php } ?>
</div>

<div class="container">
    <div class="row">
    <?php if ($viewCheck && !$featureCheck) { ?>
            <?php echo PermissionDenied::featureUnavailable(); ?>
        
        <?php } elseif ($viewCheck && $featureCheck) {?>
            <div class="col-sm-12 col-lg-12" role="main">
                <!-- CONTENT -->
                <!-- CONTENT -->
                <h1><?php echo $page_title; ?></h1>

                <h2>Principals with Outstanding Forms:</h2>
                <div><?php echo $emailsList; ?></div>

                <h2>Outstanding Forms by School</h2>
                <table id="sample-data-table" class="table">
                    <thead>
                        <tr>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Code</span>
                                </div>
                            </th>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Name</span>
                                </div>
                            </th>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Principal</span>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($audit['bad'] as $schoolCode => $schoolName) { ?>
                            <tr>
                                <td><?php echo strtoupper($schoolCode); ?></td>
                                <td><?php echo $schoolName; ?></td>
                                <td><?php echo $principals[strtolower($schoolCode)]; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <!-- /CONTENT -->
            </div>
        <?php } ?>
    </div>
</div>

<script>
    function disable(id) {
        document.getElementById(id).disabled = true;
    }
    function enable(id) {
        document.getElementById(id).disabled = false;
    }
</script>

<?php WPCore::getFooter();
