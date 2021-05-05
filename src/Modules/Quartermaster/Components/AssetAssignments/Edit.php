<?php
namespace WRDSB\Staff\Modules\Quartermaster\Components;
use WRDSB\Staff\Modules\WP\WPCore as WPCore;
use WRDSB\Staff\Modules\Quartermaster\QuartermasterModule as Module;
use WRDSB\Staff\Modules\Quartermaster\Model\AssetAssignment as Model;

$apiKey = Module::getCodexSearchKey();
$schoolCode = strtoupper(WPCore::getOption('wrdsb_school_code'));
$current_user = WPCore::getCurrentUser();
$current_time = WPCore::currentTime();
$pageTitle = "Edit Asset Assignment";

function setCustomTitle() {
    $pageTitle = "Edit Asset Assignment";
    return $pageTitle;
}
WPCore::addFilter('pre_get_document_title', '\WRDSB\Staff\Modules\Quartermaster\Components\setCustomTitle');

if ($wp_query->query_vars['id']) {
    $id = $wp_query->query_vars['id'];
}

$assignment = Model::getBySearchID($id);
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
                    <?php echo $pageTitle; ?>
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
                <h1><?php echo $pageTitle; ?></h1>
                <p>Editing Assignment Number: <?php echo $id; ?></p>
                <button><a href="<?php echo WPCore::homeURL(); ?>/quartermaster/asset-assignment/<?php echo $id; ?>">Cancel Editing</a></button>

                <form id="editAssetAssignment">
                    <input type="hidden" id="searchID" name="searchID" value="<?php echo $assignment->getSearchID(); ?>">
                    <input type="hidden" id="blogID" name="blogID" value="<?php echo WPCore::getCurrentBlogID(); ?>">
                    <input type="hidden" id="schoolCode" name="schoolCode" value="<?php echo $schoolCode; ?>">
                    <input type="hidden" id="email" name="email" value="<?php echo $current_user->user_email ?>">
                    <input type="hidden" id="updatedAt" name="updatedAt" value="<?php echo $current_time ?>">
                    <input type="hidden" id="updatedBy" name="updatedBy" value="<?php echo $current_user->user_email ?>">

                    <h3>Assignment Info</h3>
                    <fieldset id="assignmentInfo" class="form-group col-md-12" style="padding-top:10px;padding-bottom:20px;margin-bottom:50px;">
                        <div class="form-row col-md-12" style="padding-top:15px;">
                            <label class="col-md-9">Assignment Type&nbsp;&nbsp;&nbsp;
                                <label class="radio-inline">
                                    <input type="radio" name="isTemporary" id="isTemporaryFalse" value="0" <?php if ($assignment->getIsTemporary() === false) {echo 'checked';} ?>>  Open-ended
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="isTemporary" id="isTemporaryTrue" value="1" <?php if ($assignment->getIsTemporary() === true) {echo 'checked';} ?>> End-dated
                                </label>
                            </label>
                        </div>
                        <div class="form-row col-md-12" style="padding-top:15px;">
                            <div class="form-group col-md-5">
                                <label for="startDate">Start Date</label>
                                <input type="text" name="startDate" id="startDate" class="form-control" aria-describedby="startDateHelp" value="<?php echo $assignment->getStartDate(); ?>">
                            </div>
                            <div id="isTemporaryBlock" class="form-group col-md-5" style="<?php if ($assignment->getIsTemporary() === false) {echo 'display:none;';} ?>">
                                <label for="endDate">End Date</label>
                                <input type="text" name="endDate" id="endDate" class="form-control" aria-describedby="endDateHelp" value="<?php echo $assignment->getEndDate(); ?>">
                            </div>
                        </div>
                    </fieldset>

                    <h3>Student Info</h3>
                    <fieldset id="studentInfo" class="form-group col-md-12" style="padding-top:10px;padding-bottom:20px;margin-bottom:50px;">
                        <div class="form-row col-md-12"  style="padding-top:15px;">
                            <div class="form-group col-md-5">
                                <label for="assignedToPerson">Assigned To</label>
                                <input type="text" name="assignedToPerson" id="assignedToPerson" class="form-control" aria-describedby="assignedToPersonHelp" value="<?php echo $assignment->getAssignedToPerson(); ?>">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="assignedToPersonEmail">Email</label>
                                <input type="text" name="assignedToPersonEmail" id="assignedToPersonEmail" class="form-control" aria-describedby="assignedToPersonEmaillHelp" value="<?php echo $assignment->getAssignedToPersonEmail(); ?>" tabindex="-1">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="assignedToPersonNumber">Student&nbsp;Number</label>
                                <input type="text" name="assignedToPersonNumber" id="assignedToPersonNumber" class="form-control" aria-describedby="assignedToPersonNumberHelp" value="<?php echo $assignment->getAssignedToPersonNumber(); ?>" tabindex="-1">
                            </div>
                        </div>
                        <div class="form-row col-md-12" style="padding-top:15px;">
                            <label class="col-md-9">Received by&nbsp;&nbsp;&nbsp;
                                <label class="radio-inline">
                                    <input type="radio" name="wasReceivedByAssignee" id="wasReceivedByAssigneeTrue" value="1" <?php if ($assignment->getwasReceivedByAssignee() === true) {echo 'checked';} ?>> Student
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="wasReceivedByAssignee" id="wasReceivedByAssigneeFalse" value="0" <?php if ($assignment->getwasReceivedByAssignee() === false) {echo 'checked';} ?>> Other
                                </label>
                            </label>
                            <div class="form-group col-md-3">
                                <label for="assignedToPersonLocation">Student&nbsp;Location</label>
                                <input type="text" name="assignedToPersonLocation" id="assignedToPersonLocation" class="form-control" aria-describedby="assignedToPersonLocationHelp" value="<?php echo $assignment->getAssignedToPersonLocation(); ?>" readonly tabindex="-1">
                            </div>
                        </div>
                        <div id="receivedByBlock" class="form-row col-md-12" style="padding-top:15px;<?php if ($assignment->getWasReceivedByAssignee() === true) {echo 'display:none;';} ?>">
                            <div class="form-group col-md-7">
                                <label for="receivedBy">Received By Name</label>
                                <input type="text" name="receivedBy" id="receivedBy" class="form-control" aria-describedby="receivedByHelp" value="<?php echo $assignment->getReceivedBy(); ?>">
                            </div>
                            <div class="form-group col-md-5">
                                <label for="receivedByRole">Relationship to Student</label>
                                <input type="text" name="receivedByRole" id="receivedByRole" class="form-control" aria-describedby="receivedByRoleHelp" value="<?php echo $assignment->getReceivedByRole(); ?>">
                            </div>
                        </div>
                    </fieldset>

                    <h3>Device Info</h3>
                    <fieldset id="deviceInfo" class="form-group col-md-12" style="padding-top:10px;padding-bottom:28px;margin-bottom:50px;">
                        <div class="form-row col-md-12"  style="padding-top:15px;">
                            <div class="form-group col-md-3">
                                <label for="assetID">Device Barcode</label>
                                <input type="text" name="assetID" id="assetID" class="form-control" aria-describedby="assetIDHelp" value="<?php echo $assignment->getAssetID(); ?>">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="assetSerialNumber">Serial Number</label>
                                <input type="text" name="assetSerialNumber" id="assetSerialNumber" class="form-control" aria-describedby="assetSerialNumberHelp" value="<?php echo $assignment->getAssetSerialNumber(); ?>" tabindex="-1">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="assetType">Device Type</label>
                                <input type="text" name="assetType" id="assetType" class="form-control" aria-describedby="assetTypeHelp" value="<?php echo $assignment->getAssetType(); ?>" tabindex="-1">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="assetLocation">Device Location</label>
                                <input type="text" name="assetLocation" id="assetLocation" class="form-control" aria-describedby="assetLocationHelp" value="<?php echo $assignment->getAssetLocation(); ?>" readonly tabindex="-1">
                            </div>
                            <div class="form-group col-md-12" id="seaDeviceWarning">
                                This is a Spec Ed / SEA device. Please be certain you want to assign it to this student.
                            </div>
                        </div>
                    </fieldset>

                    <h3>Additional Info</h3>
                    <fieldset id="additionalInfo" class="form-group col-md-12" style="padding-top:10px;padding-bottom:28px;margin-bottom:50px;">
                        <div class="form-row col-md-12"  style="padding-top:15px;">
                            <div class="form-group-inline">
                                <label class="form-element-inline" style="padding-top:15px;">Peripherals&nbsp;Provided&nbsp;&nbsp;&nbsp;
                                    <label class="form-element-inline">
                                        <input type="text" name="untrackedAssestsIncluded" id="untrackedAssestsIncluded" class="form-control" aria-describedby="untrackedAssestsIncludedHelp" value="<?php echo $assignment->getUntrackedAssestsIncluded(); ?>">
                                    </label>
                                </label>
                            </div>
                            <div class="form-group-inline">
                                <label class="form-element-inline" style="padding-top:15px;">Notes&nbsp;&nbsp;&nbsp;
                                    <label class="form-element-inline">
                                        <input type="text" name="notes" id="notes" class="form-control" aria-describedby="notesHelp" value="<?php echo $assignment->getNotes(); ?>">
                                    </label>
                                </label>
                            </div>
                        </div>
                    </fieldset>

                    <div class="form-row col-md-12" style="padding-top:10px;padding-bottom:28px;">
                        <div class="form-group col-md-6">
                            <label for="assignedBy">Assigned By</label>
                            <input type="text" name="assignedBy" id="assignedBy" class="form-control" aria-describedby="assignedByHelp" value="<?php echo $assignment->getAssignedBy(); ?>" readonly tabindex="-1">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="assignedFromLocation">School Code</label>
                            <input type="text" name="assignedFromLocation" id="assignedFromLocation" class="form-control" aria-describedby="assignedFromLocationHelp" value="<?php echo $assignment->getAssignedFromLocation(); ?>" readonly tabindex="-1">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="createdAt">Date/Time Submitted</label>
                            <input type="text" name="createdAt" id="createdAt" class="form-control" aria-describedby="createdAtHelp" value="<?php echo $assignment->getCreatedAt(); ?>" readonly tabindex="-1">
                        </div>
                    </div>

                    <div id="submitBlock" style="padding-bottom:30px;">
                        <button id="submitButton" type="submit" class="btn btn-primary">Submit</button>
                        <div id="progressbar"></div>
                        <p id="submittedMessage" style="display: none;">Form submitted for processing.</p>
                        <p id="acceptedMessage" style="display: none;">Form accepted for processing.</p>
                        <p id="processingMessage" style="display: none;">Processing form.</p>
                        <p id="finishedMessage" style="display: none;">Finished processing form.</p>
                        <button id="continueButton" class="btn btn-primary" type="button" onclick="location.href='<?php echo WPCore::homeURL(); ?>/quartermaster/asset-assignment/<?php echo $id; ?>'" style="display:none;">Continue</button>
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
