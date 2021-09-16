<?php
namespace WRDSB\Staff\Modules\SchoolData\Components;

use WRDSB\Staff\Modules\WP\WPCore as WPCore;
use WRDSB\Staff\Modules\SchoolData\SchoolDataModule as Module;
use WRDSB\Staff\Modules\SchoolData\Components\Partials\PermissionDenied as PermissionDenied;

use WRDSB\Staff\Modules\SchoolData\Model\SchoolsList as SchoolsList;
use WRDSB\Staff\Modules\SchoolData\Model\IPRCSearch as IPRCSearch;

$featureCheck = Module::featureGuard('SchoolDataAdminIPRC');
$viewCheck = Module::userCanViewGuard();

$page_title = "IPRC List";

function setCustomTitle() {
    $page_title = "IPRC List";
    return $page_title;
}
WPCore::addFilter('pre_get_document_title', '\WRDSB\Staff\Modules\SchoolData\Components\setCustomTitle');

$schools = SchoolsList::all();
$list = IPRCSearch::list();
?>

<?php WPCore::getHeader(); ?>

<div class="container-top">
    <?php WPCore::getTemplatePart('partials/header', 'masthead'); ?>

    <?php if ($viewCheck) { ?>
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
                    IPRC
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
                        <span id="button-csv-visible" class="nav-item"></span>
                        <span id="button-csv-all" class="nav-item"></span>
                    </div>
                </div>

                <table id="school-data-iprc-table" class="table">
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
                                    <span class="column-title">Principal Firstname</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Principal Lastname</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Teacher 1 Firstname</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Teacher 1 Lastname</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Teacher 2 Firstname</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Teacher 2 Lastname</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Teacher 3 Firstname</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Teacher 3 Lastname</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Teacher 4 Firstname</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Teacher 4 Lastname</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Teacher 5 Firstname</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Teacher 5 Lastname</span>
                                </div>
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($list as $post) { ?>
                            <?php if ($post->schoolCode != "DSPS") { ?>
                                <tr>
                                    <td><a href="<?php echo WPCore::homeURL(); ?>/school-data/single/iprc/<?php echo strtolower($post->schoolCode); ?>/"><?php echo strtoupper($post->schoolCode); ?></a></td>
                                    <td><?php echo $schools[strtolower($post->schoolCode)]; ?></td>
                                    <td><?php echo $post->post_modified; ?></td>
                                    <td><?php echo $post->principalFirstname; ?></td>
                                    <td><?php echo $post->principalLastname; ?></td>
                                    <td><?php echo $post->teacher1Firstname; ?></td>
                                    <td><?php echo $post->teacher1Lastname; ?></td>
                                    <td><?php echo $post->teacher2Firstname; ?></td>
                                    <td><?php echo $post->teacher2Lastname; ?></td>
                                    <td><?php echo $post->teacher3Firstname; ?></td>
                                    <td><?php echo $post->teacher3Lastname; ?></td>
                                    <td><?php echo $post->teacher4Firstname; ?></td>
                                    <td><?php echo $post->teacher4Lastname; ?></td>
                                    <td><?php echo $post->teacher5Firstname; ?></td>
                                    <td><?php echo $post->teacher5Lastname; ?></td>
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
