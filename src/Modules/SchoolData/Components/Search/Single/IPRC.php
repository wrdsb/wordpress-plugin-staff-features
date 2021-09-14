<?php
namespace WRDSB\Staff\Modules\SchoolData\Components;
use WRDSB\Staff\Modules\WP\WPCore as WPCore;
use WRDSB\Staff\Modules\SchoolData\Components\Partials\PermissionDenied as PermissionDenied;
use WRDSB\Staff\Modules\SchoolData\Model\IPRC;
use WRDSB\Staff\Modules\SchoolData\SchoolDataModule as Module;
use WRDSB\Staff\Modules\SchoolData\Model\IPRCSearch as IPRCSearch;

if ($wp_query->query_vars['schoolCode']) {
    $schoolCode = strtoupper($wp_query->query_vars['schoolCode']);
}
$searchInstance = IPRCSearch::getBySchoolCode($schoolCode);
$currentInstance = new IPRC(json_decode(json_encode($searchInstance), true));

$page_title = "{$schoolCode} IPRC";

function setCustomTitle($schoolCode) {
    $page_title = "{$schoolCode} IPRC";
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
                    <a href="<?php echo WPCore::homeURL(); ?>/school-data/lists/iprc/">IPRC</a>
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
                        <legend>Principal</legend>
                        <label for="principal-firstname" id="label-principal-firstname"><span class="sr-only">Principal </span>Firstname</label>
                        <input disabled type="text" value="<?php echo $currentInstance->getPrincipalFirstname(); ?>" id="principal-firstname" name="principalFirstname" aria-invalid="false" aria-labelledby="label-principal-firstname">
                        <label for="principal-lastname" id="label-principal"><span class="sr-only">Principal </span>Lastname</label>
                        <input disabled type="text" value="<?php echo $currentInstance->getPrincipalLastname(); ?>" id="principal-lastname" name="principalLastname" aria-invalid="false" aria-labelledby="label-principal-lastname">
                    </fieldset>

                    <fieldset>
                        <legend>Teacher 1</legend>
                        <label for="teacher-1-firstname" id="label-teacher-1-firstname"><span class="sr-only">Teacher 1 </span>Firstname</label>
                        <input disabled type="text" value="<?php echo $currentInstance->getTeacher1Firstname(); ?>" id="teacher-1-firstname" name="teacher1Firstname" aria-invalid="false" aria-labelledby="label-teacher-1-firstname">
                        <label for="teacher-1-lastname" id="teacher-1-lastname"><span class="sr-only">Teacher 1 </span>Lastname</label>
                        <input disabled type="text" value="<?php echo $currentInstance->getTeacher1Lastname(); ?>" id="teacher-1-lastname" name="teacher1Lastname" aria-invalid="false" aria-labelledby="label-teacher-1-lastname">
                    </fieldset>

                    <fieldset>
                        <legend>Teacher 2</legend>
                        <label for="teacher-2-firstname" id="label-teacher-2-firstname"><span class="sr-only">Teacher 2 </span>Firstname</label>
                        <input disabled type="text" value="<?php echo $currentInstance->getTeacher2Firstname(); ?>" id="teacher-2-firstname" name="teacher2Firstname" aria-invalid="false" aria-labelledby="label-teacher-2-firstname">
                        <label for="teacher-2-lastname" id="teacher-2-lastname"><span class="sr-only">Teacher 2 </span>Lastname</label>
                        <input disabled type="text" value="<?php echo $currentInstance->getTeacher2Lastname(); ?>" id="teacher-2-lastname" name="teacher2Lastname" aria-invalid="false" aria-labelledby="label-teacher-2-lastname">
                    </fieldset>

                    <fieldset>
                        <legend>Teacher 3</legend>
                        <label for="teacher-3-firstname" id="label-teacher-3-firstname"><span class="sr-only">Teacher 3 </span>Firstname</label>
                        <input disabled type="text" value="<?php echo $currentInstance->getTeacher3Firstname(); ?>" id="teacher-3-firstname" name="teacher3Firstname" aria-invalid="false" aria-labelledby="label-teacher-3-firstname">
                        <label for="teacher-3-lastname" id="teacher-3-lastname"><span class="sr-only">Teacher 3 </span>Lastname</label>
                        <input disabled type="text" value="<?php echo $currentInstance->getTeacher3Lastname(); ?>" id="teacher-3-lastname" name="teacher3Lastname" aria-invalid="false" aria-labelledby="label-teacher-3-lastname">
                    </fieldset> 

                    <fieldset>
                        <legend>Teacher 4</legend>
                        <label for="teacher-4-firstname" id="label-teacher-4-firstname"><span class="sr-only">Teacher 4 </span>Firstname</label>
                        <input disabled type="text" value="<?php echo $currentInstance->getTeacher4Firstname(); ?>" id="teacher-4-firstname" name="teacher4Firstname" aria-invalid="false" aria-labelledby="label-teacher-4-firstname">
                        <label for="teacher-4-lastname" id="teacher-4-lastname"><span class="sr-only">Teacher 4 </span>Lastname</label>
                        <input disabled type="text" value="<?php echo $currentInstance->getTeacher4Lastname(); ?>" id="teacher-4-lastname" name="teacher4Lastname" aria-invalid="false" aria-labelledby="label-teacher-4-lastname">
                    </fieldset>

                    <fieldset>
                        <legend>Teacher 5</legend>
                        <label for="teacher-5-firstname" id="label-teacher-5-firstname"><span class="sr-only">Teacher 5 </span>Firstname</label>
                        <input disabled type="text" value="<?php echo $currentInstance->getTeacher5Firstname(); ?>" id="teacher-5-firstname" name="teacher5Firstname" aria-invalid="false" aria-labelledby="label-teacher-5-firstname">
                        <label for="teacher-5-lastname" id="teacher-5-lastname"><span class="sr-only">Teacher 5 </span>Lastname</label>
                        <input disabled type="text" value="<?php echo $currentInstance->getteacher5Lastname(); ?>" id="teacher-5-lastname" name="teacher5Lastname" aria-invalid="false" aria-labelledby="label-teacher-5-lastname">
                    </fieldset> 
                </form>
                <!-- /CONTENT -->
            </div>
        <?php } ?>
    </div>
</div>

<?php WPCore::getFooter();
