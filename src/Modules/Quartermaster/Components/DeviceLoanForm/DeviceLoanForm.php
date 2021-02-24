<?php
$schoolCode = get_option('wrdsb_school_code');
$school_code = strtolower($schoolCode);

$current_user = wp_get_current_user();
$current_time = current_time('mysql');

$functionKey = QUARTERMASTER_DEVICE_LOAN_FORM_INIT_KEY;

$page_title = "New Device Loan";

function setCustomTitle()
{
    $page_title = "New Device Loan";
    return $page_title;
}
add_filter('pre_get_document_title', 'setCustomTitle');

$body = array(
    'school_code' => $school_code,
    'email' => $current_user->user_email
);

$url = "https://wrdsb-quartermaster.azurewebsites.net/api/device-loan-form-init?code={$functionKey}";
$args = array(
    'timeout'     => 5,
    'redirection' => 5,
    'httpversion' => '1.0',
    'user-agent'  => 'WordPress/' . $wp_version . '; ' . home_url(),
    'blocking'    => true,
    'headers'     => array(
        'Accept' => 'application/json',
        'Content-Type' => 'application/json',
    ),
    'cookies'     => array(),
    'body'        => json_encode($body),
    'compress'    => false,
    'decompress'  => true,
    'sslverify'   => false,
    'stream'      => false,
    'filename'    => null
);

$retries = 0;
$maxRetries = 5;

while ($retries < $maxRetries) {
    $backoff = 5 * $retries;
    $args['timeout'] = $args['timeout'] + $backoff;
    $response = wp_remote_post($url, $args);

    if (is_array($response) && !empty($response) && $response["response"]["code"] == 200) {
        break;
    }
    $retries++;
}

if (!empty($response) && $response["response"]["code"] == 200) {
    $response_object = json_decode($response['body'], $assoc = false);
    $employee = $response_object;
    $employeeSchedule = $employee->schedule;
} else {
    $employeeSchedule = array();
}
?>

<?php get_header(); ?>

<div class="container-top">
    <?php get_template_part('partials/header', 'masthead'); ?>

    <?php if (! current_user_can_view_content()) { ?>
        <?php get_template_part('partials/content', 'unauthorized'); ?>
    <?php } else { ?>
        <?php get_template_part('partials/header', 'navbar'); ?>

        <div class="container container-breadcrumb" role="navigation">
            <ol class="breadcrumb">
                <li>
                    <a href="<?php echo get_option('home'); ?>">Home</a>
                </li>
                <li>
                    Device Loans
                </li>
                <li>
                    <?php echo $page_title; ?>
                </li>
            </ol>
        </div>
    <?php } ?>
</div>

<?php if (current_user_can_view_content()) { ?>
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
                            <span><a href="<?php echo home_url(); ?>/quartermaster/device-loans/all">LFH Device Loans</a></span>
                        </div>
                        <div class="sub-menu-items">
                            <ul><ul>
                                    <li><a href="https://docs.google.com/forms/d/e/1FAIpQLSdjwdzc1parYWphvvyfnuaz4v5cketHMJSa0kvY0dRf7VZI4A/viewform" target="_blank">New Device Loan</a></li>
                                    <li><a href="<?php echo home_url(); ?>/quartermaster/device-loans/all">View All Device Loans</a></li>
                                    <li><a href="<?php echo home_url(); ?>/quartermaster/device-loans/active">View Active Device Loans</a></li>
                                    <li><a href="<?php echo home_url(); ?>/quartermaster/device-loans/returned">View Returned Devices</a></li>
                            </ul></ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-9 col-lg-9" role="main">
                <!-- CONTENT -->
                <h1><?php echo $page_title; ?></h1>

                <form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post">
                    <input type="hidden" name="action" value="absence_form_submit">
                    <input type="hidden" name="schoolCode" value="<?php echo $schoolCode; ?>">
                    <input type="hidden" name="email" value="<?php echo $current_user->user_email ?>">

                    <h3>Student Info</h3>
                    <fieldset class="form-group col-md-12" style="padding-top:10px;padding-bottom:20px;margin-bottom:50px;">
                        <div class="form-row col-md-12"  style="padding-top:15px;">
                            <div class="form-group col-md-5">
                                <label for="loanedToName">Loaned To</label>
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
                    </fieldset>

                    <h3>Device Info</h3>
                    <fieldset class="form-group col-md-12" style="padding-top:10px;padding-bottom:28px;margin-bottom:50px;">
                        <div class="form-row col-md-12"  style="padding-top:15px;">
                            <div class="form-group col-md-6">
                                <label for="submittedAssetID">Device Asset ID</label>
                                <input type="text" name="submittedAssetID" id="submittedAssetID" class="form-control" aria-describedby="submittedAssetIDHelp">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="deviceType">Device Type</label>
                                <input type="text" name="deviceType" id="deviceType" class="form-control" aria-describedby="deviceTypeHelp" readonly tabindex="-1">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="serialNumber">Serial Number</label>
                                <input type="text" name="serialNumber" id="serialNumber" class="form-control" aria-describedby="serialNumberHelp" readonly tabindex="-1">
                            </div>
                        </div>

                        <div class="form-row col-md-12">
                            <div class="form-group">
                                <label style="padding-top:15px;">Is&nbsp;SEA&nbsp;Device?&nbsp;&nbsp;&nbsp;
                                    <label class="radio-inline">
                                        <input type="radio" name="isSEADevice" id="isSEADeviceNo" value="false" checked> No
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="isSEADevice" id="isSEADeviceYes" value="true"> Yes
                                    </label>
                                </label>
                            </div>
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

                    <div class="form-row col-md-12">
                        <div class="form-group col-md-6">
                            <label for="loanedBy">Loaned By</label>
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

<?php get_footer();
