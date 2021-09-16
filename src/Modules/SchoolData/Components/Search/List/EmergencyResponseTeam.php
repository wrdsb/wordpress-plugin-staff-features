<?php
namespace WRDSB\Staff\Modules\SchoolData\Components;

use WRDSB\Staff\Modules\WP\WPCore as WPCore;
use WRDSB\Staff\Modules\SchoolData\SchoolDataModule as Module;
use WRDSB\Staff\Modules\SchoolData\Components\Partials\PermissionDenied as PermissionDenied;

use WRDSB\Staff\Modules\SchoolData\Model\SchoolsList as SchoolsList;
use WRDSB\Staff\Modules\SchoolData\Model\EmergencyResponseTeamSearch as EmergencyResponseTeamSearch;

$featureCheck = Module::featureGuard('SchoolDataAdminEmergencyResponseTeam');
$viewCheck = Module::userCanViewGuard();

$page_title = "Emergency Response Team List";

function setCustomTitle() {
    $page_title = "Emergency Response Team List";
    return $page_title;
}
WPCore::addFilter('pre_get_document_title', '\WRDSB\Staff\Modules\SchoolData\Components\setCustomTitle');

$schools = SchoolsList::all();
$list = EmergencyResponseTeamSearch::list();
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
                    Emergency Response Team
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
                <h1><?php echo $page_title; ?></h1>
                <div class="description">
                    <div class="description-text">
                    </div>
                    <div class="download-buttons" style="float:right">
                        <span id="button-copy" class="nav-item"></span>
                        <span id="button-csv-all" class="nav-item"></span>
                    </div>
                </div>

                <table id="school-data-emergency-response-team-table" class="table">
                    <thead>
                        <tr>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">School Code</span>
                                </div>
                            </th>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">School Name</span>
                                </div>
                            </th>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Last Updated</span>
                                </div>
                            </th>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Firstname 1</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Lastname 1</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">CPR Expiry 1</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">First Aid Expiry 1</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">BMS Expiry 1</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Firstname 2</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Lastname 2</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">CPR Expiry 2</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">First Aid Expiry 2</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">BMS Expiry 2</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Firstname 3</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Lastname 3</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">CPR Expiry 3</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">First Aid Expiry 3</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">BMS Expiry 3</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Firstname 4</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Lastname 4</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">CPR Expiry 4</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">First Aid Exiry 4</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">BMS Expiry 4</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Firstname 5</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Lastname 5</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">CPR Expiry 5</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">First Aid Expiry 5</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">BMS Expiry 5</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Firstname 6</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Lastname 6</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">CPR Expiry 6</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">First Aid Expiry 6</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">BMS Expiry 6</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Firstname 7</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Lastname 7</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">CPR Expiry 7</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">First Aid Expiry 7</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">BMS Expiry 7</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Firstname 8</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Lastname 8</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">CPR Expiry 8</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">First Aid Expiry 8</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">BMS Expiry 8</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Firstname 9</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Lastname 9</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">CPR Expiry 9</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">First Aid Expiry 9</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">BMS Expiry 9</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Firstname 10</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Lastname 10</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">CPR Expiry 10</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">First Aid Expiry 10</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">BMS Expiry 10</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Firstname 11</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Lastname 11</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">CPR Expiry 11</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">FirstAid Expiry 11</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">BMS Expiry 11</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Firstname 12</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Lastname 12</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">CPR Expiry 12</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">First Aid Expiry 12</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">BMS Expiry 12</span>
                                </div>
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($list as $post) { ?>
                            <?php if ($post->schoolCode != "DSPS") { ?>
                                <tr>
                                    <td><a href="<?php echo WPCore::homeURL(); ?>/school-data/single/emergency-response-team/<?php echo strtolower($post->schoolCode); ?>/"><?php echo strtoupper($post->schoolCode); ?></a></td>
                                    <td><?php echo $schools[strtolower($post->schoolCode)]; ?></td>
                                    <td><?php echo $post->post_modified; ?></td>
                                    <td><?php echo $post->firstname1; ?></td>
                                    <td><?php echo $post->lastname1; ?></td>
                                    <td><?php echo $post->cprExpiry1; ?></td>
                                    <td><?php echo $post->firstAidExpiry1; ?></td>
                                    <td><?php echo $post->bmsExpiry1; ?></td>
                                    <td><?php echo $post->firstname2; ?></td>
                                    <td><?php echo $post->lastname2; ?></td>
                                    <td><?php echo $post->cprExpiry2; ?></td>
                                    <td><?php echo $post->firstAidExpiry2; ?></td>
                                    <td><?php echo $post->bmsExpiry2; ?></td>
                                    <td><?php echo $post->firstname3; ?></td>
                                    <td><?php echo $post->lastname3; ?></td>
                                    <td><?php echo $post->cprExpiry3; ?></td>
                                    <td><?php echo $post->firstAidExpiry3; ?></td>
                                    <td><?php echo $post->bmsExpiry3; ?></td>
                                    <td><?php echo $post->firstname4; ?></td>
                                    <td><?php echo $post->lastname4; ?></td>
                                    <td><?php echo $post->cprExpiry4; ?></td>
                                    <td><?php echo $post->firstAidExpiry4; ?></td>
                                    <td><?php echo $post->bmsExpiry4; ?></td>
                                    <td><?php echo $post->firstname5; ?></td>
                                    <td><?php echo $post->lastname5; ?></td>
                                    <td><?php echo $post->cprExpiry5; ?></td>
                                    <td><?php echo $post->firstAidExpiry5; ?></td>
                                    <td><?php echo $post->bmsExpiry5; ?></td>
                                    <td><?php echo $post->firstname6; ?></td>
                                    <td><?php echo $post->lastname6; ?></td>
                                    <td><?php echo $post->cprExpiry6; ?></td>
                                    <td><?php echo $post->firstAidExpiry6; ?></td>
                                    <td><?php echo $post->bmsExpiry6; ?></td>
                                    <td><?php echo $post->firstname7; ?></td>
                                    <td><?php echo $post->lastname7; ?></td>
                                    <td><?php echo $post->cprExpiry7; ?></td>
                                    <td><?php echo $post->firstAidExpiry7; ?></td>
                                    <td><?php echo $post->bmsExpiry7; ?></td>
                                    <td><?php echo $post->firstname8; ?></td>
                                    <td><?php echo $post->lastname8; ?></td>
                                    <td><?php echo $post->cprExpiry8; ?></td>
                                    <td><?php echo $post->firstAidExpiry8; ?></td>
                                    <td><?php echo $post->bmsExpiry8; ?></td>
                                    <td><?php echo $post->firstname9; ?></td>
                                    <td><?php echo $post->lastname9; ?></td>
                                    <td><?php echo $post->cprExpiry9; ?></td>
                                    <td><?php echo $post->firstAidExpiry9; ?></td>
                                    <td><?php echo $post->bmsExpiry9; ?></td>
                                    <td><?php echo $post->firstname10; ?></td>
                                    <td><?php echo $post->lastname10; ?></td>
                                    <td><?php echo $post->cprExpiry10; ?></td>
                                    <td><?php echo $post->firstAidExpiry10; ?></td>
                                    <td><?php echo $post->bmsExpiry10; ?></td>
                                    <td><?php echo $post->firstname11; ?></td>
                                    <td><?php echo $post->lastname11; ?></td>
                                    <td><?php echo $post->cprExpiry11; ?></td>
                                    <td><?php echo $post->firstAidExpiry11; ?></td>
                                    <td><?php echo $post->bmsExpiry11; ?></td>
                                    <td><?php echo $post->firstname12; ?></td>
                                    <td><?php echo $post->lastname12; ?></td>
                                    <td><?php echo $post->cprExpiry12; ?></td>
                                    <td><?php echo $post->firstAidExpiry12; ?></td>
                                    <td><?php echo $post->bmsExpiry12; ?></td>
                                </tr>
                            <?php } ?>
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
