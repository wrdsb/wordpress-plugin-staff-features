<?php
namespace WRDSB\Staff\Modules\Quartermaster\Components;
use WRDSB\Staff\Modules\WP\WPCore as WPCore;
use WRDSB\Staff\Modules\Quartermaster\QuartermasterModule as Module;
use WRDSB\Staff\Modules\Quartermaster\Model\DeviceLoanForm as Model;

$apiKey = Module::getDeviceLoansQueryKey();
$schoolCode = WPCore::getOption('wrdsb_school_code');
$current_user = WPCore::getCurrentUser();
$current_time = WPCore::currentTime();

function setCustomTitle()
{
    $pageTitle = "Edit Device Loan";
    return $pageTitle;
}
WPCore::addFilter('pre_get_document_title', '\WRDSB\Staff\Modules\Quartermaster\Components\setCustomTitle');
$pageTitle = "Edit Device Loan";

$body = array(
    'schoolCode' => $schoolCode,
);

if ($wp_query->query_vars['id']) {
    $id = $wp_query->query_vars['id'];
    $pageTitle = "Edit Device Loan #{$id}";
}

$loan = Model::get($id);
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
                    Device Loans
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
                            <span><a href="<?php echo WPCore::homeURL(); ?>/quartermaster/device-loans/all">LFH Device Loans</a></span>
                        </div>
                        <div class="sub-menu-items">
                            <ul><ul>
                                    <li><a href="<?php echo WPCore::homeURL(); ?>/quartermaster/device-loan/new">Create New Device Loan</a></li>
                                    <li><a href="<?php echo WPCore::homeURL(); ?>/quartermaster/device-loans/all">View All Device Loans</a></li>
                                    <li><a href="<?php echo WPCore::homeURL(); ?>/quartermaster/device-loans/active">View Active Device Loans</a></li>
                                    <li><a href="<?php echo WPCore::homeURL(); ?>/quartermaster/device-loans/returned">View Returned Devices</a></li>
                            </ul></ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-9 col-lg-9" role="main">
                <h1><?php echo $pageTitle; ?></h1>
                <!-- CONTENT -->
                <h2><a href="<?php echo WPCore::homeURL(); ?>/quartermaster/device-loan/<?php echo $loan->getID(); ?>">Cancel Editing</a></h2>

                <form action="<?php echo WPCore::escURL(WPCore::adminURL('admin-post.php')); ?>" method="post">
                    <input type="hidden" name="action" value="device_loan_form_submit">
                    <input type="hidden" name="schoolCode" value="<?php echo $schoolCode; ?>">
                    <input type="hidden" name="email" value="<?php echo $current_user->user_email ?>">
                    <input type="hidden" name="id" value="<?php echo $formID ?>">

                    <h3>Student Info</h3>
                    <fieldset class="form-group col-md-12" style="padding-top:10px;padding-bottom:20px;margin-bottom:50px;">
                        <div class="form-row col-md-12"  style="padding-top:15px;">
                            <div class="form-group col-md-5">
                                <label for="loanedToName">Loaned To</label>
                                <input type="text" name="loanedToName" id="loanedToName" class="form-control" aria-describedby="loanedToNameHelp" value="<?php echo $loan->getLoanedToName(); ?>">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="loanedToEmail">Email</label>
                                <input type="text" name="loanedToEmail" id="loanedToEmail" class="form-control" aria-describedby="loanedToEmailHelp" value="<?php echo $loan->getLoanedToEmail(); ?>">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="loanedToNumber">Student&nbsp;Number</label>
                                <input type="text" name="loanedToNumber" id="loanedToNumber" class="form-control" aria-describedby="loanedToNumberHelp" value="<?php echo $loan->getLoanedToNumber(); ?>">
                            </div>
                        </div>
                        <div class="form-row col-md-12" style="padding-top:15px;">
                            <label class="col-md-12">Received by:&nbsp;&nbsp;&nbsp;
                                <label class="radio-inline">
                                    <input type="radio" name="receivedByRole" id="receivedByRoleStudent" value="student" <?php if ($loan->getReceivedByRole() == 'student') {echo 'checked';} ?>> Student
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="receivedByRole" id="receivedByRoleOther" value="other" <?php if ($loan->getReceivedByRole() != 'student') {echo 'checked';} ?>> Other
                                </label>
                            </label>
                        </div>
                        <div id="receivedByBlock" class="form-row col-md-12" style="padding-top:15px;">
                            <div class="form-group col-md-7">
                                <label for="receivedByName">Received By Name</label>
                                <input type="text" name="receivedByName" id="receivedByName" class="form-control" aria-describedby="receivedByNameHelp" value="<?php echo $loan->getReceivedByName; ?>" readonly>
                            </div>
                            <div class="form-group col-md-5">
                                <label for="receivedByRelationship">Relationship to Student</label>
                                <input type="text" name="receivedByRelationship" id="receivedByRelationship" class="form-control" aria-describedby="receivedByRelationshipHelp" value="<?php echo $loan->getReceivedByRelationship(); ?>" readonly>
                            </div>
                        </div>
                    </fieldset>

                    <h3>Device Info</h3>
                    <fieldset class="form-group col-md-12" style="padding-top:10px;padding-bottom:28px;margin-bottom:50px;">
                        <div class="form-row col-md-12"  style="padding-top:15px;">
                            <div class="form-group col-md-3">
                                <label for="assetID">Device Barcode</label>
                                <input type="text" name="assetID" id="assetID" class="form-control" aria-describedby="assetIDHelp" value="<?php echo $loan->getCorrectedAssetID(); ?>" readonly>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="assetType">Device Type</label>
                                <input type="text" name="assetType" id="assetType" class="form-control" aria-describedby="assetTypeHelp" value="<?php echo $loan->getDeviceType(); ?>" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="assetModel">Device Model</label>
                                <input type="text" name="assetModel" id="assetModel" class="form-control" aria-describedby="assetModelHelp" value="<?php echo $loan->getDeviceModel(); ?>" readonly>
                            </div>
                        </div>

                        <div class="form-row col-md-12"  style="padding-top:15px;">
                            <div class="form-group col-md-12" id="seaDeviceWarning">
                                This is a Spec Ed / SEA device. Please be certain you want to loan it to this student.
                            </div>
                            <div class="form-group col-md-12">
                                <label for="peripheralsProvided">Peripherals Provided</label>
                                <input type="text" name="peripheralsProvided" id="peripheralsProvided" class="form-control" aria-describedby="peripheralsProvidedHelp" value="<?php echo $loan->getPeripheralsProvided(); ?>" readonly>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="notes">Notes</label>
                                <input type="text" name="notes" id="notes" class="form-control" aria-describedby="notesHelp" value="<?php echo $loan->getNotes(); ?>" readonly>
                            </div>
                        </div>
                    </fieldset>

                    <div class="form-row col-md-12">
                        <div class="form-group col-md-6">
                            <label for="loanedBy">Loaned By</label>
                            <input type="text" name="loanedBy" id="loanedBy" class="form-control" aria-describedby="loanedByHelp" value="<?php echo $loan->getLoanedBy(); ?>" readonly>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="schoolCode">School Code</label>
                            <input type="text" name="schoolCode" id="schoolCode" class="form-control" aria-describedby="schoolCodeHelp" value="<?php echo $loan->getSchoolCode(); ?>" readonly>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="createdOn">Date/Time Submitted</label>
                            <input type="text" name="createdOn" id="createdOn" class="form-control" aria-describedby="createdOnHelp" value="<?php echo $loan->getTimestamp(); ?>" readonly>
                        </div>
                    </div>

                    <div class="form-row col-md-12">
                        <div class="form-group col-md-6">
                            <label for="returnedBy">Returned By</label>
                            <input type="text" name="returnedBy" id="returnedBy" class="form-control" aria-describedby="returnedByHelp" value="<?php echo $loan->getReturnedBy(); ?>" readonly>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="returnedAt">Date/Time Returned</label>
                            <input type="text" name="returnedAt" id="returnedAt" class="form-control" aria-describedby="returnedAtHelp" value="<?php echo $loan->getReturnedAt(); ?>" readonly>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
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
