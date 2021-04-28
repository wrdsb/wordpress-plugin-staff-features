<?php
namespace WRDSB\Staff\Modules\Quartermaster\Components;
use WRDSB\Staff\Modules\WP\WPCore as WPCore;
use WRDSB\Staff\Modules\Quartermaster\QuartermasterModule as Module;
use WRDSB\Staff\Modules\Quartermaster\Model\AssetAssignment as Model;

$apiKey = Module::getCodexSearchKey();
$schoolCode = strtoupper(WPCore::getOption('wrdsb_school_code'));
$current_user = WPCore::getCurrentUser();
$current_time = WPCore::currentTime();
$page_title = "New Asset Assignment";

function setCustomTitle() {
    $page_title = "New Asset Assignment";
    return $page_title;
}
WPCore::addFilter('pre_get_document_title', '\WRDSB\Staff\Modules\Quartermaster\Components\setCustomTitle');
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
                    <a href="<?php echo WPCore::homeURL(); ?>/quartermaster/asset-assignments/all">Asset Assignments</a>
                </li>
                <li>
                    <?php echo $page_title; ?>
                </li>
            </ol>
        </div>
    <?php } ?>
</div>

<?php if (WPCore::currentUserCanViewContent()) { ?>
    <div class="container">
        <div class="row">

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
                            <span><a href="<?php echo WPCore::homeURL(); ?>/quartermaster/asset-assignments/all">Asset Assignments</a></span>
                        </div>
                        <div class="sub-menu-items">
                            <ul><ul>
                                    <li><a href="<?php echo WPCore::homeURL(); ?>/quartermaster/asset-assignment/new">Create New Asset Assignment</a></li>
                                    <li><a href="<?php echo WPCore::homeURL(); ?>/quartermaster/asset-assignments/all">View All Asset Assignments</a></li>
                                    <li><a href="<?php echo WPCore::homeURL(); ?>/quartermaster/asset-assignments/active">View Active Asset Assignments</a></li>
                                    <li><a href="<?php echo WPCore::homeURL(); ?>/quartermaster/asset-assignments/returned">View Returned Assets</a></li>
                            </ul></ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-9 col-lg-9" role="main">
                <!-- CONTENT -->
                <h1><?php echo $page_title; ?></h1>

                <form id="newAssetAssignment">
                    <input type="hidden" id="blogID" name="blogID" value="<?php echo WPCore::getCurrentBlogID(); ?>">
                    <input type="hidden" id="schoolCode" name="schoolCode" value="<?php echo $schoolCode; ?>">
                    <input type="hidden" id="email" name="email" value="<?php echo $current_user->user_email ?>">

                    <h3>Assignment Info</h3>
                    <fieldset id="assignmentInfo" class="form-group col-md-12" style="padding-top:10px;padding-bottom:20px;margin-bottom:50px;">
                        <div class="form-row col-md-12" style="padding-top:15px;">
                            <label class="col-md-9">Assignment Type&nbsp;&nbsp;&nbsp;
                                <label class="radio-inline">
                                    <input type="radio" name="isTemporary" id="isTemporaryFalse" value="0" checked> Open-ended
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="isTemporary" id="isTemporaryTrue" value="1" > End-dated
                                </label>
                            </label>
                        </div>
                        <div class="form-row col-md-12" style="padding-top:15px;">
                            <div class="form-group col-md-5">
                                <label for="startDate">Start Date</label>
                                <input type="text" name="startDate" id="startDate" class="form-control" aria-describedby="startDateHelp">
                            </div>
                            <div id="isTemporaryBlock" class="form-group col-md-5" style="display:none;">
                                <label for="endDate">End Date</label>
                                <input type="text" name="endDate" id="endDate" class="form-control" aria-describedby="endDateHelp">
                            </div>
                        </div>
                    </fieldset>

                    <h3>Student Info</h3>
                    <fieldset class="form-group col-md-12" style="padding-top:10px;padding-bottom:20px;margin-bottom:50px;">
                        <div class="form-row col-md-12"  style="padding-top:15px;">
                            <div class="form-group col-md-5">
                                <label for="assignedToPerson">Assigned To</label>
                                <input type="text" name="assignedToPerson" id="assignedToPerson" class="form-control" aria-describedby="assignedToPersonHelp">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="assignedToPersonEmail">Email</label>
                                <input type="text" name="assignedToPersonEmail" id="assignedToPersonEmail" class="form-control" aria-describedby="assignedToPersonEmaillHelp">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="assignedToPersonNumber">Student&nbsp;Number</label>
                                <input type="text" name="assignedToPersonNumber" id="assignedToPersonNumber" class="form-control" aria-describedby="assignedToPersonNumberHelp">
                            </div>
                        </div>
                        <div class="form-row col-md-12" style="padding-top:15px;">
                            <label class="col-md-9">Received by&nbsp;&nbsp;&nbsp;
                                <label class="radio-inline">
                                    <input type="radio" name="wasReceivedByAssignee" id="wasReceivedByAssigneeTrue" value="1" checked> Student
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="wasReceivedByAssignee" id="wasReceivedByAssigneeFalse" value="0" > Other
                                </label>
                            </label>
                            <div class="form-group col-md-3">
                                <label for="assignedToPersonLocation">Student&nbsp;Location</label>
                                <input type="text" name="assignedToPersonLocation" id="assignedToPersonLocation" class="form-control" aria-describedby="assignedToPersonLocationHelp" value="<?php echo strtoupper($schoolCode); ?>" readonly tabindex="-1">
                            </div>
                        </div>
                        <div id="receivedByBlock" class="form-row col-md-12" style="padding-top:15px;display:none;">
                            <div class="form-group col-md-7">
                                <label for="receivedBy">Received By Name</label>
                                <input type="text" name="receivedBy" id="receivedBy" class="form-control" aria-describedby="receivedByHelp">
                            </div>
                            <div class="form-group col-md-5">
                                <label for="receivedByRole">Relationship to Student</label>
                                <input type="text" name="receivedByRole" id="receivedByRole" class="form-control" aria-describedby="receivedByRoleHelp">
                            </div>
                        </div>
                    </fieldset>

                    <h3>Device Info</h3>
                    <fieldset class="form-group col-md-12" style="padding-top:10px;padding-bottom:28px;margin-bottom:50px;">
                        <div class="form-row col-md-12"  style="padding-top:15px;">
                            <div class="form-group col-md-3">
                                <label for="assetID">Device Barcode</label>
                                <input type="text" name="assetID" id="assetID" class="form-control" aria-describedby="assetIDHelp">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="assetSerialNumber">Serial Number</label>
                                <input type="text" name="assetSerialNumber" id="assetSerialNumber" class="form-control" aria-describedby="assetSerialNumberHelp">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="assetType">Device Type</label>
                                <input type="text" name="assetType" id="assetType" class="form-control" aria-describedby="assetTypeHelp">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="assetLocation">Device Location</label>
                                <input type="text" name="assetLocation" id="assetLocation" class="form-control" aria-describedby="assetLocationHelp" value="<?php echo strtoupper($schoolCode); ?>" readonly tabindex="-1">
                            </div>
                            <div class="form-group col-md-12" id="seaDeviceWarning">
                                This is a Spec Ed / SEA device. Please be certain you want to assign it to this student.
                            </div>
                        </div>
                    </fieldset>

                    <h3>Additional Info</h3>
                    <fieldset class="form-group col-md-12" style="padding-top:10px;padding-bottom:28px;margin-bottom:50px;">
                        <div class="form-row col-md-12"  style="padding-top:15px;">
                            <div class="form-group-inline">
                                <label class="form-element-inline" style="padding-top:15px;">Peripherals&nbsp;Provided&nbsp;&nbsp;&nbsp;
                                    <label class="form-element-inline">
                                        <input type="text" name="untrackedAssestsIncluded" id="untrackedAssestsIncluded" class="form-control" aria-describedby="untrackedAssestsIncludedHelp">
                                    </label>
                                </label>
                            </div>
                            <div class="form-group-inline">
                                <label class="form-element-inline" style="padding-top:15px;">Notes&nbsp;&nbsp;&nbsp;
                                    <label class="form-element-inline">
                                        <input type="text" name="notes" id="notes" class="form-control" aria-describedby="notesHelp">
                                    </label>
                                </label>
                            </div>
                        </div>
                    </fieldset>

                    <div class="form-row col-md-12" style="padding-top:10px;padding-bottom:28px;">
                        <div class="form-group col-md-6">
                            <label for="assignedBy">Assigned By</label>
                            <input type="text" name="assignedBy" id="assignedBy" class="form-control" aria-describedby="assignedByHelp" value="<?php echo $current_user->display_name; ?>" readonly tabindex="-1">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="assignedFromLocation">School Code</label>
                            <input type="text" name="assignedFromLocation" id="assignedFromLocation" class="form-control" aria-describedby="assignedFromLocationHelp" value="<?php echo strtoupper($schoolCode); ?>" readonly tabindex="-1">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="createdAt">Date/Time Submitted</label>
                            <input type="text" name="createdAt" id="createdAt" class="form-control" aria-describedby="createdAtHelp" value="<?php echo $current_time; ?>" readonly tabindex="-1">
                        </div>
                    </div>

                    <div id="submitBlock" style="padding-bottom:30px;">
                        <button id="submitButton" type="submit" class="btn btn-primary">Submit</button>
                        <div id="progressbar"></div>
                        <p id="submittedMessage" style="display: none;">Form submitted for processing.</p>
                        <p id="acceptedMessage" style="display: none;">Form accepted for processing.</p>
                        <p id="processingMessage" style="display: none;">Processing form.</p>
                        <p id="finishedMessage" style="display: none;">Finished processing form.</p>
                        <button id="continueButton" class="btn btn-primary" type="button" onclick="location.href='<?php echo WPCore::homeURL(); ?>/quartermaster/asset-assignments/all'" style="display:none;">Continue</button>
                        <p id="failureMessage" style="display: none;">There was an error. Please click the submit button again.</p>
                    </div>
                </form>
                <!-- /CONTENT -->
            </div>
        </div>
    </div>
<?php } ?>

<script>
    function disable(id) {
        document.getElementById(id).disabled = true;
    }
    function enable(id) {
        document.getElementById(id).disabled = false;
    }
</script>

<?php WPCore::getFooter();
