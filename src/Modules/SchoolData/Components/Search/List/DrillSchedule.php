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
                <div class="description">
                    <div class="description-text">
                    </div>
                    <div class="download-buttons" style="float:right">
                        <span id="button-copy" class="nav-item"></span>
                        <span id="button-csv" class="nav-item"></span>
                        <span id="button-pdf" class="nav-item"></span>
                    </div>
                </div>

                <table id="school-data-data-table" class="table">
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
                                    <span class="column-title">Date 1</span>
                                </div>
                            </th>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Time 1</span>
                                </div>
                            </th>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Date 2</span>
                                </div>
                            </th>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Time 2</span>
                                </div>
                            </th>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Date 3</span>
                                </div>
                            </th>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Time 3</span>
                                </div>
                            </th>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Date 4</span>
                                </div>
                            </th>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Time 4</span>
                                </div>
                            </th>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Date 5</span>
                                </div>
                            </th>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Time 5</span>
                                </div>
                            </th>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Bomb Drill Date</span>
                                </div>
                            </th>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Bomb Drill Time</span>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($list as $post) { ?>
                            <?php if ($post->schoolCode != "DSPS") { ?>
                                <tr>
                                    <td><a href="<?php echo WPCore::homeURL(); ?>/school-data/single/drill-schedule/<?php echo strtolower($post->schoolCode); ?>/"><?php echo strtoupper($post->schoolCode); ?></a></td>
                                    <td><?php echo $schools[strtolower($post->schoolCode)]; ?></td>
                                    <td><?php echo $post->fireDrill1Date; ?></td>
                                    <td><?php echo $post->fireDrill1Time; ?></td>
                                    <td><?php echo $post->fireDrill2Date; ?></td>
                                    <td><?php echo $post->fireDrill2Time; ?></td>
                                    <td><?php echo $post->fireDrill3Date; ?></td>
                                    <td><?php echo $post->fireDrill3Time; ?></td>
                                    <td><?php echo $post->fireDrill4Date; ?></td>
                                    <td><?php echo $post->fireDrill4Time; ?></td>
                                    <td><?php echo $post->fireDrill5Date; ?></td>
                                    <td><?php echo $post->fireDrill5Time; ?></td>
                                    <td><?php echo $post->bombDrill1Date; ?></td>
                                    <td><?php echo $post->bombDrill1Time; ?></td>
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
