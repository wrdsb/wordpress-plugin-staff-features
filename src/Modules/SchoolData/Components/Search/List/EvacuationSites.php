<?php
namespace WRDSB\Staff\Modules\SchoolData\Components;

use WRDSB\Staff\Modules\WP\WPCore as WPCore;
use WRDSB\Staff\Modules\SchoolData\Model\SchoolsList as SchoolsList;
use WRDSB\Staff\Modules\SchoolData\Model\EvacuationSitesSearch as EvacuationSitesSearch;

$page_title = "Evacuation Sites List";

function setCustomTitle() {
    $page_title = "Evacuation Sites List";
    return $page_title;
}
WPCore::addFilter('pre_get_document_title', '\WRDSB\Staff\Modules\SchoolData\Components\setCustomTitle');

$schools = SchoolsList::all();
$list = EvacuationSitesSearch::list();
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
                    Evacuation Sites
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
                        <span id="button-csv-all" class="nav-item"></span>
                    </div>
                </div>

                <table id="school-data-evacuation-sites-table" class="table">
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
                                    <span class="column-title">Site 1 Name</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Site 1 Address</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Site 1 City</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Site 1 PostalCode</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Site 1 Firstname</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Site 1 Lastname</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Site 1 Phone</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Site 1 Hours Start</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Site 1 Hours End</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Site 2 Name</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Site 2 Address</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Site 2 City</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Site 2 Postal Code</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Site 2 Firstname</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Site 2 Lastname</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Site 2 Phone</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Site 2 Hours Start</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Site 2 Hours End</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Site 3 Name</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Site 3 Address</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Site 3 City</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Site 3 Postal Code</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Site 3 Firstname</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Site 3 Lastname</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Site 3 Phone</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Site 3 Hours Start</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Site 3 Hours End</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Site 4 Name</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Site 4 Address</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Site 4 City</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Site 4 Postal Code</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Site 4 Firstname</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">site4Lastname</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Site 4 Phone</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Site 4 Hours Start</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Site 4 Hours End</span>
                                </div>
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($list as $post) { ?>
                            <?php if ($post->schoolCode != "DSPS") { ?>
                                <tr>
                                    <td><a href="<?php echo WPCore::homeURL(); ?>/school-data/single/evacuation-sites/<?php echo strtolower($post->schoolCode); ?>/"><?php echo strtoupper($post->schoolCode); ?></a></td>
                                    <td><?php echo $schools[strtolower($post->schoolCode)]; ?></td>
                                    <td><?php echo $post->post_modified; ?></td>
                                    <td><?php echo $post->site1Name; ?></td>
                                    <td><?php echo $post->site1Address; ?></td>
                                    <td><?php echo $post->site1City; ?></td>
                                    <td><?php echo $post->site1PostalCode; ?></td>
                                    <td><?php echo $post->site1Firstname; ?></td>
                                    <td><?php echo $post->site1Lastname; ?></td>
                                    <td><?php echo $post->site1Phone; ?></td>
                                    <td><?php echo $post->site1HoursStart; ?></td>
                                    <td><?php echo $post->site1HoursEnd; ?></td>
                                    <td><?php echo $post->site2Name; ?></td>
                                    <td><?php echo $post->site2Address; ?></td>
                                    <td><?php echo $post->site2City; ?></td>
                                    <td><?php echo $post->site2PostalCode; ?></td>
                                    <td><?php echo $post->site2Firstname; ?></td>
                                    <td><?php echo $post->site2Lastname; ?></td>
                                    <td><?php echo $post->site2Phone; ?></td>
                                    <td><?php echo $post->site2HoursStart; ?></td>
                                    <td><?php echo $post->site2HoursEnd; ?></td>
                                    <td><?php echo $post->site3Name; ?></td>
                                    <td><?php echo $post->site3Address; ?></td>
                                    <td><?php echo $post->site3City; ?></td>
                                    <td><?php echo $post->site3PostalCode; ?></td>
                                    <td><?php echo $post->site3Firstname; ?></td>
                                    <td><?php echo $post->site3Lastname; ?></td>
                                    <td><?php echo $post->site3Phone; ?></td>
                                    <td><?php echo $post->site3HoursStart; ?></td>
                                    <td><?php echo $post->site3HoursEnd; ?></td>
                                    <td><?php echo $post->site4Name; ?></td>
                                    <td><?php echo $post->site4Address; ?></td>
                                    <td><?php echo $post->site4City; ?></td>
                                    <td><?php echo $post->site4PostalCode; ?></td>
                                    <td><?php echo $post->site4Firstname; ?></td>
                                    <td><?php echo $post->site4Lastname; ?></td>
                                    <td><?php echo $post->site4Phone; ?></td>
                                    <td><?php echo $post->site4HoursStart; ?></td>
                                    <td><?php echo $post->site4HoursEnd; ?></td>
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
