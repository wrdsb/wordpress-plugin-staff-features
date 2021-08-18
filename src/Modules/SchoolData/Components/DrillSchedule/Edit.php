<?php
namespace WRDSB\Staff\Modules\SchoolData\Components;
use WRDSB\Staff\Modules\WP\WPCore as WPCore;
use WRDSB\Staff\Modules\SchoolData\Components\Partials\PermissionDenied as PermissionDenied;
use WRDSB\Staff\Modules\SchoolData\SchoolDataModule as Module;
use WRDSB\Staff\Modules\SchoolData\Model\DrillSchedule as Model;

//$apiKey = Module::getCodexSearchKey();
$schoolCode = strtoupper(WPCore::getOption('wrdsb_school_code'));
$current_user = WPCore::getCurrentUser();
$current_time = WPCore::currentTime();
$currentInstance = Model::getInstance();

$page_title = "Update Drill Schedule";

function setCustomTitle() {
    $page_title = "Update Drill Schedule";
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
                    <a href="..">Drill Schedule</a>
                </li>
                <li>
                    Update
                </li>
            </ol>
        </div>
    <?php } ?>
</div>

<div class="container">
    <div class="row">
        <?php if (!WPCore::currentUserCanViewContent()) { ?>
            <?php echo PermissionDenied::cannotView(); ?>
        
        <?php } elseif (!Module::currentUserCanEdit()) { ?>
            <?php echo PermissionDenied::cannotEdit(); ?>

        <?php } else { ?>
            <div class="col-sm-3 col-lg-3" role="complementary">
                <div class="navbar my-sub-navbar" id="section_navigation" role="navigation">
                    <div class="sub-navbar-header">
                        <button type="button" class="navbar-toggle toggle-subnav" data-toggle="collapse" data-target=".sub-navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <span class="navbar-brand">Subnav</span>
                    </div>
                    <div class="collapse sub-navbar-collapse">
                        <div class="sub-menu-heading">
                            <span><a href="<?php echo WPCore::homeURL(); ?>/school-data/home">School Data</a></span>
                        </div>
                        <div class="sub-menu-items">
                            <ul>
                                <ul>
                                    <li><a href="<?php echo WPCore::homeURL(); ?>/school-data/drill-schedule/">Drill Schedule</a></li>
                                    <li><a href="<?php echo WPCore::homeURL(); ?>/school-data/emergency-response-team/">Emergency Response Team</a></li>
                                    <li><a href="<?php echo WPCore::homeURL(); ?>/school-data/evacuation-sites/">Evacuation Sites</a></li>
                                    <li><a href="<?php echo WPCore::homeURL(); ?>/school-data/iprc/">IPRC</a></li>
                                    <li><a href="<?php echo WPCore::homeURL(); ?>/school-data/scis-team">SCIS Team</a></li>
                                    <li><a href="<?php echo WPCore::homeURL(); ?>/school-data/workplace-inspection-team/">Workplace Inspection Team</a></li>
                                </ul>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-9 col-lg-9" role="main">
                <!-- CONTENT -->
                <h1><?php echo $page_title; ?></h1>
                <p><button><a href="..">Cancel Update</a></button></p>

                <div class="alert alert-info">
                    <p>All schools must now provide scheduled dates and times of their five (5) fire drills and one (1) combination fire/bomb drill to the local fire departments so they may support the schools by arranging for Fire Prevention Officers to be present during the drills.</p>
                    <p>Please see all the <a href="https://staff.wrdsb.ca/school-teams/bomb-drill/fire-department-schedule/">Fire Drill Schedule Information</a>.</p>
                </div>

                <p class="alert alert-warning">Once this information has been collected and shared with the fire departments, any changes to these dates/times are to be communicated directly to your school’s local fire department by the school and/or administrator.</p>
    
                <form id="editDrillSchedule" action="<?php echo WPCore::homeURL(); ?>/wp-admin/admin-post.php" method="post">
                    <input type="hidden" name="action" value="schoolDataDrillSchedule">
                    <?php WPCore::wpNonceField('schoolDataDrillSchedule', 'schoolData'); ?>
                    <input type="hidden" id="blogID" name="blogID" value="<?php echo WPCore::getCurrentBlogID(); ?>">
                    <input type="hidden" id="schoolCode" name="schoolCode" value="<?php echo $schoolCode; ?>">
                    <input type="hidden" id="email" name="email" value="<?php echo $current_user->user_email ?>">
                    <input type="hidden" id="postID" name="postID" value="<?php echo $currentInstance->getID(); ?>">
                    <input type="hidden" id="wpRedirect" name="wpRedirect" value="<?php echo WPCore::homeURL(); ?>/school-data/drill-schedule/">

                    <p>Fields marked with <span class="required">*</span> are required.</p>

                    <fieldset>
                        <legend>Fire Drill 1</legend>
                        <label for="fire-drill-1-date" id="label-fire-drill-1-date"><span class="sr-only">Fire Drill 1 </span>Date</label>
                        <input id="fire-drill-1-date" name="fireDrill1Date" aria-invalid="false" aria-labelledby="label-fire-drill-1-date" type="date" value="<?php echo $currentInstance->getFireDrill1Date(); ?>">
                        <label for="fire-drill-1-time" id="label-fire-drill-1-time"><span class="sr-only">Fire Drill 1 </span>Time</label>
                        <input id="fire-drill-1-time" name="fireDrill1Time" aria-invalid="false" aria-labelledby="label-fire-drill-1-time" type="time" value="<?php echo $currentInstance->getFireDrill1Time(); ?>">
                    </fieldset>

                    <fieldset>
                        <legend>Fire Drill 2</legend>
                        <label for="fire-drill-2-date" id="label-fire-drill-2-date"><span class="sr-only">Fire Drill 2 </span>Date</label>
                        <input id="fire-drill-2-date" name="fireDrill2Date" aria-invalid="false" aria-labelledby="label-fire-drill-2-date" type="date" value="<?php echo $currentInstance->getFireDrill2Date(); ?>">
                        <label for="fire-drill-2-time" id="label-fire-drill-2-time"><span class="sr-only">Fire Drill 2 </span>Time</label>
                        <input id="fire-drill-2-time" name="fireDrill2Time" aria-invalid="false" aria-labelledby="label-fire-drill-2-time" type="time" value="<?php echo $currentInstance->getFireDrill2Time(); ?>">
                    </fieldset>

                    <fieldset>
                        <legend>Fire Drill 3</legend>
                        <label for="fire-drill-3-date" id="label-fire-drill-3-date"><span class="sr-only">Fire Drill 3 </span>Date</label>
                        <input id="fire-drill-3-date" name="fireDrill3Date" aria-invalid="false" aria-labelledby="label-fire-drill-3-date" type="date" value="<?php echo $currentInstance->getFireDrill3Date(); ?>">
                        <label for="fire-drill-3-time" id="label-fire-drill-3-time"><span class="sr-only">Fire Drill 3 </span>Time</label>
                        <input id="fire-drill-3-time" name="fireDrill3Time" aria-invalid="false" aria-labelledby="label-fire-drill-3-time" type="time" value="<?php echo $currentInstance->getFireDrill3Time(); ?>">
                    </fieldset>

                    <fieldset>
                        <legend>Fire Drill 4</legend>
                        <label for="fire-drill-4-date" id="label-fire-drill-4-date"><span class="sr-only">Fire Drill 4 </span>Date</label>
                        <input id="fire-drill-4-date" name="fireDrill4Date" aria-invalid="false" aria-labelledby="label-fire-drill-4-date" type="date" value="<?php echo $currentInstance->getFireDrill4Date(); ?>">
                        <label for="fire-drill-4-time" id="label-fire-drill-4-time"><span class="sr-only">Fire Drill 4 </span>Time</label>
                        <input id="fire-drill-4-time" name="fireDrill4Time" aria-invalid="false" aria-labelledby="label-fire-drill-4-time" type="time" value="<?php echo $currentInstance->getFireDrill4Time(); ?>">
                    </fieldset>

                    <fieldset>
                        <legend>Fire Drill 5</legend>
                        <label for="fire-drill-5-date" id="label-fire-drill-5-date"><span class="sr-only">Fire Drill 5 </span>Date</label>
                        <input id="fire-drill-5-date" name="fireDrill5Date" aria-invalid="false" aria-labelledby="label-fire-drill-5-date" type="date" value="<?php echo $currentInstance->getFireDrill5Date(); ?>">
                        <label for="fire-drill-5-time" id="label-fire-drill-5-time"><span class="sr-only">Fire Drill 5 </span>Time</label>
                        <input id="fire-drill-5-time" name="fireDrill5Time" aria-invalid="false" aria-labelledby="label-fire-drill-5-time" type="time" value="<?php echo $currentInstance->getFireDrill5Time(); ?>">
                    </fieldset>

                    <fieldset>
                        <legend>Fire/Bomb Drill</legend>
                        <label for="bomb-drill-date" id="label-bomb-drill-date"><span class="sr-only">Fire/Bomb Drill </span>Date</label>
                        <input id="bomb-drill-date" name="bombDrillDate" aria-invalid="false" aria-labelledby="label-bomb-drill-date" type="date" value="<?php echo $currentInstance->getBombDrill1Date(); ?>">
                        <label for="bomb-drill-time" id="label-bomb-drill-time"><span class="sr-only">Fire/Bomb Drill </span>Time</label>
                        <input id="bomb-drill-time" name="bombDrillTime" aria-invalid="false" aria-labelledby="label-bomb-drill-time" type="time" value="<?php echo $currentInstance->getBombDrill1Time(); ?>">
                    </fieldset>
                    <input type="submit" value="Update">
                    <button><a href="..">Cancel Update</a></button>
                </form>
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
