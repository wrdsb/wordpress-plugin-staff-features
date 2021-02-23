<?php
$current_user = wp_get_current_user();
$authorized = [
    'janie_straus@wrdsb.ca',
    'jason_denhart@wrdsb.ca',
    'joene_kouvelos@wrdsb.ca',
    'sandy_millar@wrdsb.ca',
    'siobhan_watters@wrdsb.ca',
    'james_schumann@wrdsb.ca'
];

$schoolCode = get_option('wrdsb_school_code');
$functionKey = CMA_ABSENCE_FORM_QUERY_KEY;

function setCustomTitle()
{
    $pageTitle = "Employee Absence Detail";
    return $pageTitle;
}
add_filter('pre_get_document_title', 'setCustomTitle');

$pageTitle = "Employee Absence Detail";

$body = array(
    'schoolCode' => $schoolCode
);

if ($wp_query->query_vars['id']) {
    $id = $wp_query->query_vars['id'];
    $body['id'] = $id;
    $pageTitle = "Employee Absence #{$id}";
}

$url = "https://wrdsb-cma.azurewebsites.net/api/absence-form-query?code={$functionKey}";
$args = array(
    'timeout'     => 5,
    'redirection' => 5,
    'httpversion' => '1.0',
    'user-agent'  => 'cma/wordpress',
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
$response = wp_remote_post($url, $args);
$response_object = json_decode($response['body'], $assoc = false);

$form = $response_object[0];
?>

<?php get_header(); ?>

<div class="container-top">
    <?php
        get_template_part('partials/header', 'masthead');
        get_template_part('partials/header', 'navbar');
    ?>
</div>

<div class="container">
    <div class="row">

    <div class="col-sm-2 col-lg-2" role="complementary">
        <div class="sidebar-left widget-area" role="complementary">
            <div class="sub-menu-heading"><span>Online Pink Sheets</span></div>
            <div class="textwidget">
                <p><a href="/jam/employee/absence/new">New Pink Sheet</a></p>
                <p><a href="/jam/employee/me/absences">View My Pink Sheets</a></p>
                <?php if (in_array($current_user->user_email, $authorized)) { ?>
                    <p><a href="/jam/employee/absences/today">View All Pink Sheets</a></p>
                <?php } ?>
            </div>
        </div>
    </div>

<?php if ((!in_array($current_user->user_email, $authorized)) && ($current_user->user_email != $form->email)) { ?>
    <div class="col-sm-10 col-lg-10" role="main">
        <h1>You are not authorized to view this page.</h1>
    </div>

<?php } else { ?>
    <div class="col-sm-10 col-lg-10" role="main">
        <!-- CONTENT -->
        <h1><?php echo $pageTitle; ?></h1>
        <h2><a href="/jam/employee/absence/<?php echo $form->id; ?>/edit">Edit this Pink Sheet</h2>
        <form action="" method="post">
            <div class="form-row">
                <div class="col-md-9">
                    <div class="form-group">
                        <label for="staffMember">Staff Member</label>
                        <input type="text" name="staffMember" id="staffMember" class="form-control" aria-describedby="staffMemberHelp" value="<?php echo $form->staffMember; ?>" readonly>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="createdOn">Date/Time Submitted</label>
                        <input type="text" name="createdOn" id="createdOn" class="form-control" aria-describedby="createdOnHelp" value="<?php echo $form->createdOn; ?>" readonly>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="reason">Reason for absence</label>
                    <select name="reason" id="reason" class="form-control" readonly>
                        <option><?php echo $form->reason; ?></option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="ecJob">Easy Connect job number</label>
                    <input type="number" name="ecJob" id="ecJob" class="form-control" aria-describedby="ecJobHelp" value="<?php echo $form->ecJob; ?>" readonly>
                </div>
                <div class="form-group col-md-9">
                    <label for="comments">Comments</label>
                    <input type="text" name="comments" id="comments" class="form-control" aria-describedby="commentsHelp" value="<?php echo $form->comments; ?>" readonly>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="absentOn">Date of Absence</label>
                    <input type="date" name="absentOnDate" id="absentOnDate" class="form-control" aria-describedby="absentOnHelp" value="<?php echo $form->absentOnDate; ?>" readonly>
                </div>
                <!-- Ignore in calculations -->
                <div class="form-group col-md-4">
                    <label for="absentOn">From</label>
                    <input type="time" name="absentFromTime" id="absentFromTime" class="form-control" aria-describedby="absentOnHelp" value="<?php echo $form->absentFromTime; ?>" readonly>
                </div>
                <!-- Ignore in calculations -->
                <div class="form-group col-md-4">
                    <label for="absentOn">To</label>
                    <input type="time" name="absentToTime" id="absentToTime" class="form-control" aria-describedby="absentOnHelp" value="<?php echo $form->absentToTime; ?>" readonly>
                </div>
            </div>

            <label class="col-md-12" style="padding-top:15px;padding-bottom:28px;">Lunch coverage required?&nbsp;&nbsp;&nbsp;
                <?php echo ($form->lunch == "true") ? 'Yes' : 'No'; ?>
            </label>

            <div>
                <pre><?php echo $form->courseCode_1; ?></pre>
                <ul>
                    <li>Room: <?php echo $form->roomNumber_1; ?></li>
                    <li>Lesson Plans: <?php echo $form->lessonPlans_1; ?></li>
                    <li>1st: <?php echo ($form->coverageFirst_1 == "true") ? 'Yes' : 'No'; ?></li>
                    <li>2nd: <?php echo ($form->coverageSecond_1 == "true") ? 'Yes' : 'No'; ?></li>
                    <li>Medical: <?php echo ($form->medical_1 == "true") ? 'Yes' : 'No'; ?></li>
                    <li>Medical Details: <?php echo $form->medicalDetails_1; ?></li>
                    <li>Safety: <?php echo ($form->safety_1 == "true") ? 'Yes' : 'No'; ?></li>
                    <li>Safety Details: <?php echo $form->safetyDetails_1; ?></li>
                </ul>
            </div>
            <div>
                <pre><?php echo $form->courseCode_2; ?></pre>
                <ul>
                <li>Room: <?php echo $form->roomNumber_2; ?></li>
                    <li>Lesson Plans: <?php echo $form->lessonPlans_2; ?></li>
                    <li>1st: <?php echo ($form->coverageFirst_2 == "true") ? 'Yes' : 'No'; ?></li>
                    <li>2nd: <?php echo ($form->coverageSecond_2 == "true") ? 'Yes' : 'No'; ?></li>
                    <li>Medical: <?php echo ($form->medical_2 == "true") ? 'Yes' : 'No'; ?></li>
                    <li>Medical Details: <?php echo $form->medicalDetails_2; ?></li>
                    <li>Safety: <?php echo ($form->safety_2 == "true") ? 'Yes' : 'No'; ?></li>
                    <li>Safety Details: <?php echo $form->safetyDetails_2; ?></li>
                </ul>
            </div>
            <div>
                <pre><?php echo $form->courseCode_3; ?></pre>
                <ul>
                    <li>Room: <?php echo $form->roomNumber_3; ?></li>
                    <li>Lesson Plans: <?php echo $form->lessonPlans_3; ?></li>
                    <li>1st: <?php echo ($form->coverageFirst_3 == "true") ? 'Yes' : 'No'; ?></li>
                    <li>2nd: <?php echo ($form->coverageSecond_3 == "true") ? 'Yes' : 'No'; ?></li>
                    <li>Medical: <?php echo ($form->medical_3 == "true") ? 'Yes' : 'No'; ?></li>
                    <li>Medical Details: <?php echo $form->medicalDetails_3; ?></li>
                    <li>Safety: <?php echo ($form->safety_3 == "true") ? 'Yes' : 'No'; ?></li>
                    <li>Safety Details: <?php echo $form->safetyDetails_3; ?></li>
                </ul>
            </div>
            <div>
                <?php if (strlen($form->courseCode_4) > 0) { ?>
                    <pre><?php echo $form->courseCode_4; ?></pre>
                    <ul>
                        <li>Room: <?php echo $form->roomNumber_4; ?></li>
                        <li>Lesson Plans: <?php echo $form->lessonPlans_4; ?></li>
                        <li>1st: <?php echo ($form->coverageFirst_4 == "true") ? 'Yes' : 'No'; ?></li>
                        <li>2nd: <?php echo ($form->coverageSecond_4 == "true") ? 'Yes' : 'No'; ?></li>
                        <li>Medical: <?php echo ($form->medical_4 == "true") ? 'Yes' : 'No'; ?></li>
                        <li>Medical Details: <?php echo $form->medicalDetails_4; ?></li>
                        <li>Safety: <?php echo ($form->safety_4 == "true") ? 'Yes' : 'No'; ?></li>
                        <li>Safety Details: <?php echo $form->safetyDetails_4; ?></li>
                    </ul>
                <?php } ?>
            </div>
        </form>
        <!-- /CONTENT -->
    </div>
<?php } ?>

    </div>
</div>

<?php get_footer();
