<?php
namespace WRDSB\Staff\Modules\SchoolData\Components;
use WRDSB\Staff\Modules\WP\WPCore as WPCore;
use WRDSB\Staff\Modules\SchoolData\Components\Partials\PermissionDenied as PermissionDenied;
use WRDSB\Staff\Modules\SchoolData\Model\DrillSchedule;
use WRDSB\Staff\Modules\SchoolData\SchoolDataModule as Module;
use WRDSB\Staff\Modules\SchoolData\Model\DrillScheduleSearch as DrillScheduleSearch;

if ($wp_query->query_vars['schoolCode']) {
    $schoolCode = strtoupper($wp_query->query_vars['schoolCode']);
}
$searchInstance = DrillScheduleSearch::getBySchoolCode($schoolCode);
$currentInstance = new DrillSchedule(json_decode(json_encode($searchInstance), true));

$page_title = "{$schoolCode} Drill Schedule";

function setCustomTitle($schoolCode) {
    $page_title = "{$schoolCode} Drill Schedule";
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
                    <a href="<?php echo WPCore::homeURL(); ?>/school-data/lists/drill-schedule/">Drill Schedules</a>
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
                    <fieldset>
                        <legend>Fire Drill 1</legend>
                        <label for="fire-drill-1-date" id="label-fire-drill-1-date"><span class="sr-only">Fire Drill 1 </span>Date</label>
                        <input disabled id="fire-drill-1-date" name="fireDrill1Date" aria-invalid="false" aria-labelledby="label-fire-drill-1-date" type="date" value="<?php echo $currentInstance->getFireDrill1Date(); ?>">
                        <label for="fire-drill-1-time" id="label-fire-drill-1-time"><span class="sr-only">Fire Drill 1 </span>Time</label>
                        <input disabled id="fire-drill-1-time" name="fireDrill1Time" aria-invalid="false" aria-labelledby="label-fire-drill-1-time" type="time" value="<?php echo $currentInstance->getFireDrill1Time(); ?>">
                    </fieldset>

                    <fieldset>
                        <legend>Fire Drill 2</legend>
                        <label for="fire-drill-2-date" id="label-fire-drill-2-date"><span class="sr-only">Fire Drill 2 </span>Date</label>
                        <input disabled id="fire-drill-2-date" name="fireDrill2Date" aria-invalid="false" aria-labelledby="label-fire-drill-2-date" type="date" value="<?php echo $currentInstance->getFireDrill2Date(); ?>">
                        <label for="fire-drill-2-time" id="label-fire-drill-2-time"><span class="sr-only">Fire Drill 2 </span>Time</label>
                        <input disabled id="fire-drill-2-time" name="fireDrill2Time" aria-invalid="false" aria-labelledby="label-fire-drill-2-time" type="time" value="<?php echo $currentInstance->getFireDrill2Time(); ?>">
                    </fieldset>

                    <fieldset>
                        <legend>Fire Drill 3</legend>
                        <label for="fire-drill-3-date" id="label-fire-drill-3-date"><span class="sr-only">Fire Drill 3 </span>Date</label>
                        <input disabled id="fire-drill-3-date" name="fireDrill3Date" aria-invalid="false" aria-labelledby="label-fire-drill-3-date" type="date" value="<?php echo $currentInstance->getFireDrill3Date(); ?>">
                        <label for="fire-drill-3-time" id="label-fire-drill-3-time"><span class="sr-only">Fire Drill 3 </span>Time</label>
                        <input disabled id="fire-drill-3-time" name="fireDrill3Time" aria-invalid="false" aria-labelledby="label-fire-drill-3-time" type="time" value="<?php echo $currentInstance->getFireDrill3Time(); ?>">
                    </fieldset>

                    <fieldset>
                        <legend>Fire Drill 4</legend>
                        <label for="fire-drill-4-date" id="label-fire-drill-4-date"><span class="sr-only">Fire Drill 4 </span>Date</label>
                        <input disabled id="fire-drill-4-date" name="fireDrill4Date" aria-invalid="false" aria-labelledby="label-fire-drill-4-date" type="date" value="<?php echo $currentInstance->getFireDrill4Date(); ?>">
                        <label for="fire-drill-4-time" id="label-fire-drill-4-time"><span class="sr-only">Fire Drill 4 </span>Time</label>
                        <input disabled id="fire-drill-4-time" name="fireDrill4Time" aria-invalid="false" aria-labelledby="label-fire-drill-4-time" type="time" value="<?php echo $currentInstance->getFireDrill4Time(); ?>">
                    </fieldset>

                    <fieldset>
                        <legend>Fire Drill 5</legend>
                        <label for="fire-drill-5-date" id="label-fire-drill-5-date"><span class="sr-only">Fire Drill 5 </span>Date</label>
                        <input disabled id="fire-drill-5-date" name="fireDrill5Date" aria-invalid="false" aria-labelledby="label-fire-drill-5-date" type="date" value="<?php echo $currentInstance->getFireDrill5Date(); ?>">
                        <label for="fire-drill-5-time" id="label-fire-drill-5-time"><span class="sr-only">Fire Drill 5 </span>Time</label>
                        <input disabled id="fire-drill-5-time" name="fireDrill5Time" aria-invalid="false" aria-labelledby="label-fire-drill-5-time" type="time" value="<?php echo $currentInstance->getFireDrill5Time(); ?>">
                    </fieldset>

                    <fieldset>
                        <legend>Fire/Bomb Drill</legend>
                        <label for="bomb-drill-date" id="label-bomb-drill-date"><span class="sr-only">Fire/Bomb Drill </span>Date</label>
                        <input disabled id="bomb-drill-date" name="bombDrill1Date" aria-invalid="false" aria-labelledby="label-bomb-drill-date" type="date" value="<?php echo $currentInstance->getBombDrill1Date(); ?>">
                        <label for="bomb-drill-time" id="label-bomb-drill-time"><span class="sr-only">Fire/Bomb Drill </span>Time</label>
                        <input disabled id="bomb-drill-time" name="bombDrill1Time" aria-invalid="false" aria-labelledby="label-bomb-drill-time" type="time" value="<?php echo $currentInstance->getBombDrill1Time(); ?>">
                    </fieldset>
                </form>
                <!-- /CONTENT -->
            </div>
        <?php } ?>
    </div>
</div>

<?php WPCore::getFooter();
