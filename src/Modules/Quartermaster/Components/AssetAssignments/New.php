<?php
namespace WRDSB\Staff\Modules\Quartermaster\Model;
use WRDSB\Staff\Modules\WP\WPCore as WPCore;
use WRDSB\Staff\Modules\Quartermaster\QuartermasterModule as Module;

$apiKey = Module::getCodexSearchKey();
$schoolCode = WPCore::getOption('wrdsb_school_code');
$school_code = strtolower($schoolCode);

$current_user = WPCore::getCurrentUser();
$current_time = WPCore::currentTime();

$page_title = "New Asset Assignment";

function setCustomTitle()
{
    $page_title = "New Asset Assignment";
    return $page_title;
}
WPCore::addFilter('pre_get_document_title', 'setCustomTitle');
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
                            </ul></ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-9 col-lg-9" role="main">
                <!-- CONTENT -->
                <h1><?php echo $page_title; ?></h1>

                <form action="<?php echo WPCore::escURL(WPCore::adminURL('admin-post.php')); ?>" method="post">
                    <input type="hidden" name="action" value="absence_form_submit">
                    <input type="hidden" name="schoolCode" value="<?php echo $schoolCode; ?>">
                    <input type="hidden" name="email" value="<?php echo $current_user->user_email ?>">

                    <h3>Assignment Info</h3>
                    <fieldset class="form-group col-md-12" style="padding-top:10px;padding-bottom:20px;margin-bottom:50px;">
                        <div class="form-row col-md-12" style="padding-top:15px;">
                            <label class="col-md-9">Assignment Type&nbsp;&nbsp;&nbsp;
                                <label class="radio-inline">
                                    <input type="radio" name="isTemporary" id="isTemporaryFalse" value="false" checked> Permanent
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="isTemporary" id="isTemporaryTrue" value="true" > Temporary
                                </label>
                            </label>
                        </div>
                        <div id="isTemporaryBlock" class="form-row col-md-12" style="padding-top:15px;">
                            <div class="form-group col-md-5">
                                <label for="startDate">Start Date</label>
                                <input type="text" name="startDate" id="startDate" class="form-control" aria-describedby="startDateHelp">
                            </div>
                            <div class="form-group col-md-5">
                                <label for="endDate">End Date</label>
                                <input type="text" name="endDate" id="endDate" class="form-control" aria-describedby="endDateHelp">
                            </div>
                        </div>
                    </fieldset>

                    <h3>Student Info</h3>
                    <fieldset class="form-group col-md-12" style="padding-top:10px;padding-bottom:20px;margin-bottom:50px;">
                        <div class="form-row col-md-12"  style="padding-top:15px;">
                            <div class="form-group col-md-5">
                                <label for="loanedToName">Assigned To</label>
                                <input type="text" name="loanedToName" id="loanedToName" class="form-control" aria-describedby="loanedToNameHelp">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="loanedToEmail">Email</label>
                                <input type="text" name="loanedToEmail" id="loanedToEmail" class="form-control" aria-describedby="loanedToEmailHelp" readonly tabindex="-1">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="loanedToNumber">Student&nbsp;Number</label>
                                <input type="text" name="loanedToNumber" id="loanedToNumber" class="form-control" aria-describedby="loanedToNumberHelp" readonly tabindex="-1">
                            </div>
                        </div>
                        <div class="form-row col-md-12" style="padding-top:15px;">
                            <label class="col-md-9">Received by&nbsp;&nbsp;&nbsp;
                                <label class="radio-inline">
                                    <input type="radio" name="receivedByRole" id="receivedByRoleStudent" value="student" checked> Student
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="receivedByRole" id="receivedByRoleOther" value="other" > Other
                                </label>
                            </label>
                            <div class="form-group col-md-3">
                                <label for="loanedToLocation">Student&nbsp;Location</label>
                                <input type="text" name="loanedToLocation" id="loanedToLocation" class="form-control" aria-describedby="loanedToLocationHelp" readonly tabindex="-1">
                            </div>
                        </div>
                        <div id="receivedByBlock" class="form-row col-md-12" style="padding-top:15px;">
                            <div class="form-group col-md-7">
                                <label for="receivedByName">Received By Name</label>
                                <input type="text" name="receivedByName" id="receivedByName" class="form-control" aria-describedby="receivedByNameHelp">
                            </div>
                            <div class="form-group col-md-5">
                                <label for="receivedByRelationship">Relationship to Student</label>
                                <input type="text" name="receivedByRelationship" id="receivedByRelationship" class="form-control" aria-describedby="receivedByRelationshipHelp">
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
                                <label for="serialNumber">Serial Number</label>
                                <input type="text" name="serialNumber" id="serialNumber" class="form-control" aria-describedby="serialNumberHelp" value="" readonly tabindex="-1">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="assetType">Device Type</label>
                                <input type="text" name="assetType" id="assetType" class="form-control" aria-describedby="assetTypeHelp" value="" readonly tabindex="-1">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="location">Device Location</label>
                                <input type="text" name="location" id="location" class="form-control" aria-describedby="locationHelp" value="" readonly tabindex="-1">
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
                                        <input type="text" name="peripheralsProvided" id="peripheralsProvided" class="form-control" aria-describedby="peripheralsProvidedHelp">
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
                            <label for="loanedBy">Assigned By</label>
                            <input type="text" name="loanedBy" id="loanedBy" class="form-control" aria-describedby="loanedByHelp" value="<?php echo $current_user->display_name; ?>" readonly tabindex="-1">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="schoolCode">School Code</label>
                            <input type="text" name="schoolCode" id="schoolCode" class="form-control" aria-describedby="schoolCodeHelp" value="<?php echo strtoupper($schoolCode); ?>" readonly tabindex="-1">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="createdOn">Date/Time Submitted</label>
                            <input type="text" name="createdOn" id="createdOn" class="form-control" aria-describedby="createdOnHelp" value="<?php echo $current_time; ?>" readonly tabindex="-1">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
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
