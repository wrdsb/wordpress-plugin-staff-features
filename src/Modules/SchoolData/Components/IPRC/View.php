<?php
namespace WRDSB\Staff\Modules\SchoolData\Components;
use WRDSB\Staff\Modules\WP\WPCore as WPCore;
use WRDSB\Staff\Modules\SchoolData\Components\Partials\PermissionDenied as PermissionDenied;
use WRDSB\Staff\Modules\SchoolData\SchoolDataModule as Module;
use WRDSB\Staff\Modules\SchoolData\Model\IPRC as Model;

//$apiKey = Module::getCodexSearchKey();
$schoolCode = strtoupper(Module::getSchoolCode());
$current_user = WPCore::getCurrentUser();
$current_time = WPCore::currentTime();
$currentInstance = Model::getInstance();

$page_title = "IPRC";

function setCustomTitle() {
    $page_title = "IPRC";
    return $page_title;
}
WPCore::addFilter('pre_get_document_title', '\WRDSB\Staff\Modules\SchoolData\Components\setCustomTitle');
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
                    <?php echo $page_title; ?>
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
                <?php if (Module::userCanEditGuard()) { ?>
                    <p><button onclick="location.href='./edit/';"><a href="./edit/">Update this Information</a></button></p>
                <?php } ?>

                <div class="alert alert-info">
                    <p>Each school must have an Identification, Placement and Review Committee (IPRC). Please review the <a href="<?php echo WPCore::homeURL(); ?>/school-data/iprc/instructions">IPRC Instructions</a>.</p>

                    <h2>Committee Members</h2>
                    <ul>
                        <li>Each Identification Placement and Review Committee needs to have a minimum of three members (the principal is counted as one of the members)</li>
                        <li>The principal</li>
                        <li>Up to five teachers. (Special education certification is not necessary.) The vice-principal (if the school has one) can be included as part of the five.</li>
                    </ul>
                </div>
                <p class="alert alert-warning"><strong>Do not submit central office staff as members</strong> of the school's IPRC committee unless the school is small or the school has negotiated with the contact person, and it is agreed that the contact person will assist the school on the committee.</p>

                <form id="viewIPRC">
                    <input type="hidden" id="blogID" name="blogID" value="<?php echo WPCore::getCurrentBlogID(); ?>">
                    <input type="hidden" id="schoolCode" name="schoolCode" value="<?php echo $schoolCode; ?>">
                    <input type="hidden" id="email" name="email" value="<?php echo $current_user->user_email ?>">
                    <input type="hidden" id="postID" name="postID" value="<?php echo $currentInstance->getID(); ?>">

                    <p>Fields marked with <span class="required">*</span> are required.</p>
                    
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

                <?php if (Module::userCanEditGuard()) { ?>
                    <p><button onclick="location.href='./edit/';"><a href="./edit/">Update this Information</a></button></p>
                <?php } ?>
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
