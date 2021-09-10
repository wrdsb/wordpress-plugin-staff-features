<?php
namespace WRDSB\Staff\Modules\SchoolData\Components;

use WRDSB\Staff\Modules\WP\WPCore as WPCore;
use WRDSB\Staff\Modules\SchoolData\Model\SchoolsList as SchoolsList;
use WRDSB\Staff\Modules\SchoolData\Model\DrillScheduleSearch as DrillScheduleSearch;

$page_title = "Drill Schedule List";

function setCustomTitle() {
    $page_title = "Drill Schedule List";
    return $page_title;
}
WPCore::addFilter('pre_get_document_title', '\WRDSB\Staff\Modules\SchoolData\Components\setCustomTitle');

$schools = SchoolsList::all();
$list = DrillScheduleSearch::list();
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
                    Drill Schedule
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
                                    <span class="column-title">Last Update</span>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($list as $post) { ?>
                            <?php if ($post->schoolCode != "DSPS") { ?>
                                <tr>
                                    <td><?php echo strtoupper($post->schoolCode); ?></td>
                                    <td><?php echo $schools[strtolower($post->schoolCode)]; ?></td>
                                    <td><?php echo $post->post_modified; ?></td>
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
