<?php
namespace WRDSB\Staff\Modules\SchoolData\Components;

use WRDSB\Staff\Modules\WP\WPCore as WPCore;
use WRDSB\Staff\Modules\SchoolData\Model\SchoolsList as SchoolsList;
use WRDSB\Staff\Modules\SchoolData\Model\SCISTeamSearch as SCISTeamSearch;

$page_title = "SCIS Team List";

function setCustomTitle() {
    $page_title = "SCIS Team List";
    return $page_title;
}
WPCore::addFilter('pre_get_document_title', '\WRDSB\Staff\Modules\SchoolData\Components\setCustomTitle');

$schools = SchoolsList::all();
$list = SCISTeamSearch::list();
?>

<?php WPCore::getHeader(); ?>

<div class="container-top">
    <?php WPCore::getTemplatePart('partials/header', 'masthead'); ?>

    <?php if (! Module::userCanViewGuard()) { ?>
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
                    SCIS Team
                </li>
            </ol>
        </div>
    <?php } ?>
</div>

<div class="container">
    <div class="row">
        <?php if (!Module::userCanViewGuard()) { ?>
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
                        <span id="button-csv-visible" class="nav-item"></span>
                        <span id="button-csv-all" class="nav-item"></span>
                    </div>
                </div>

                <table id="school-data-scis-team-table" class="table">
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
                                    <span class="column-title">Administrator Firstname</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Administrator Lastname</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Administrator IE Liasion</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Teacher Firstname</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Teacher Lastname</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Teacher IE Liasion</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Paraprofessional Firstname</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Paraprofessional Lastname</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Paraprofessional IE Liasion</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Parent Firstname</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Parent Lastname</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Parent IE Liasion</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Community Member Firstname</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Community Member Lastname</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Community Member IE Liasion</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Student 1 Firstname</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Student 1 Lastname</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Student 1 IE Liasion</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Student 2 Firstname</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Student2Lastname</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Student 2 IE Liasion</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Optional 1 Firstname</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Optional 1 Lastname</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Optional 1 IE Liasion</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Optional 2 Firstname</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Optional 2 Lastname</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Optional 2 IE Liasion</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Optional 3 Firstname</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Optional 3 Lastname</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Optional 3 IE Liasion</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Optional 4 Firstname</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Optional 4 Lastname</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Optional 4 IE Liasion</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Optional 5 Firstname</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Optional 5 Lastname</span>
                                </div>
                            </td>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Optional 5 IE Liasion</span>
                                </div>
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($list as $post) { ?>
                            <?php if ($post->schoolCode != "DSPS") { ?>
                                <tr>
                                    <td><a href="<?php echo WPCore::homeURL(); ?>/school-data/single/scis-team/<?php echo strtolower($post->schoolCode); ?>/"><?php echo strtoupper($post->schoolCode); ?></a></td>
                                    <td><?php echo $schools[strtolower($post->schoolCode)]; ?></td>
                                    <td><?php echo $post->post_modified; ?></td>
                                    <td><?php echo $post->administratorFirstname; ?></td>
                                    <td><?php echo $post->administratorLastname; ?></td>
                                    <td><?php echo $post->administratorIELiasion; ?></td>
                                    <td><?php echo $post->teacherFirstname; ?></td>
                                    <td><?php echo $post->teacherLastname; ?></td>
                                    <td><?php echo $post->teacherIELiasion; ?></td>
                                    <td><?php echo $post->paraprofessionalFirstname; ?></td>
                                    <td><?php echo $post->paraprofessionalLastname; ?></td>
                                    <td><?php echo $post->paraprofessionalIELiasion; ?></td>
                                    <td><?php echo $post->parentFirstname; ?></td>
                                    <td><?php echo $post->parentLastname; ?></td>
                                    <td><?php echo $post->parentIELiasion; ?></td>
                                    <td><?php echo $post->communityMemberFirstname; ?></td>
                                    <td><?php echo $post->communityMemberLastname; ?></td>
                                    <td><?php echo $post->communityMemberIELiasion; ?></td>
                                    <td><?php echo $post->student1Firstname; ?></td>
                                    <td><?php echo $post->student1Lastname; ?></td>
                                    <td><?php echo $post->student1IELiasion; ?></td>
                                    <td><?php echo $post->student2Firstname; ?></td>
                                    <td><?php echo $post->student2Lastname; ?></td>
                                    <td><?php echo $post->student2IELiasion; ?></td>
                                    <td><?php echo $post->optional1Firstname; ?></td>
                                    <td><?php echo $post->optional1Lastname; ?></td>
                                    <td><?php echo $post->optional1IELiasion; ?></td>
                                    <td><?php echo $post->optional2Firstname; ?></td>
                                    <td><?php echo $post->optional2Lastname; ?></td>
                                    <td><?php echo $post->optional2IELiasion; ?></td>
                                    <td><?php echo $post->optional3Firstname; ?></td>
                                    <td><?php echo $post->optional3Lastname; ?></td>
                                    <td><?php echo $post->optional3IELiasion; ?></td>
                                    <td><?php echo $post->optional4Firstname; ?></td>
                                    <td><?php echo $post->optional4Lastname; ?></td>
                                    <td><?php echo $post->optional4IELiasion; ?></td>
                                    <td><?php echo $post->optional5Firstname; ?></td>
                                    <td><?php echo $post->optional5Lastname; ?></td>
                                    <td><?php echo $post->optional5IELiasion; ?></td>
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
