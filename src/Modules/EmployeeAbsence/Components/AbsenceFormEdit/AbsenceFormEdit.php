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
    $pageTitle = "Edit Employee Absence";
    return $pageTitle;
}
add_filter('pre_get_document_title', 'setCustomTitle');

$body = array(
    'schoolCode' => $schoolCode,
);

if ($wp_query->query_vars['id']) {
    $formID = $wp_query->query_vars['id'];
    $body['id'] = $formID;
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

<?php } elseif (($form->processed == "true") && ($current_user->user_email == $form->email)) { ?>
    <div class="col-sm-10 col-lg-10" role="main">
        <!-- CONTENT -->
        <h1><?php echo "Employee Absence #{$formID}"; ?></h1>
        <h2>This form has been processed by the office and cannot be edited.</h2>

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

<?php } else { ?>
    <div class="col-sm-10 col-lg-10" role="main">
        <!-- CONTENT -->
        <h1><?php echo "Edit Employee Absence #{$formID}"; ?></h1>

        <form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post">
            <input type="hidden" name="action" value="absence_form_submit">
            <input type="hidden" name="schoolCode" value="<?php echo $schoolCode; ?>">
            <input type="hidden" name="email" value="<?php echo $current_user->user_email ?>">
            <input type="hidden" name="id" value="<?php echo $formID ?>">

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
                    <select name="reason" id="reason" class="form-control">
                        <option selected="selected"><?php echo $form->reason; ?></option>
                        <option>A100 - Personal Illness</option>
                        <option>A400 - Medical Appointment</option>
                        <option>School Activity:Coaching (team)</option>
                        <option>School Activity:Field Trip - not SHSM(destination)</option>
                        <option>School Activity:Meeting (purpose)</option>
                        <option>A315 - Personal Day</option>
                        <option>A256 - Family Care (specify relationship (son, daughter, etc.))</option>
                        <option>A280 - Bereavement Family (specify)</option>
                        <option>A105 - Bereavement Other Teaching (Specify Relationship)</option>
                        <option>A240 - Religious Days (Comment Required)</option>
                        <option>A324 - SITE BASED DAY Math</option>
                        <option>A325 - SITE BASED DAY Wellbeing</option>
                        <option>A326 - SITE BASED DAY Pathways to Success</option>
                        <option>A327 - SITE BASED DAY  French</option>
                        <option>A276 - Staff Development (Board) (specify title, location, and SD #)</option>
                        <option>A328 - Special Education PD</option>
                        <option>A212 - Subject Association (specify subject)</option>
                        <option>A321 - NTIP New Teacher</option>
                        <option>A322 - NTIP Mentor</option>
                        <option>A295 - Staff development (include Short Term Ed. Leave (STEL) # or Staff Development (SD) #)</option>
                        <option>A241 - Third Party Billing (Comment Required)</option>
                        <option>A244 - Severe Weather</option>
                        <option>A231 - Graduation - Teaching (Specify Relationship)</option>
                        <option>A410 - Unpaid Day</option>
                        <option>A270 - Jury Duty/Witness</option>
                        <option>A205 - Lieu of Overtime</option>
                        <option>A228 - Admin/Fed Rep Meeting</option>
                        <option>A268 - Birth/Adoption Day</option>
                        <option>A341 - Health and Safety PD</option>
                        <option>A336 - BMS Training</option>
                        <option>A110 - Misc Exams - Teaching Staff</option>
                        <option>A335 - Specialist High Skills Major</option>
                        <option>A542 - Secondary High Skills Program</option>  
                        <option>Other (indicate reason)</option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="ecJob">Easy Connect job number</label>
                    <input type="number" name="ecJob" id="ecJob" class="form-control" aria-describedby="ecJobHelp" value="<?php echo $form->ecJob; ?>">
                </div>
                <div class="form-group col-md-9">
                    <label for="comments">Comments</label>
                    <input type="text" name="comments" id="comments" class="form-control" aria-describedby="commentsHelp" value="<?php echo $form->comments; ?>">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="absentOn">Date of Absence (dd/mm/yyyy)</label>
                    <input type="date" name="absentOnDate" id="absentOnDate" class="form-control" aria-describedby="absentOnHelp" value="<?php echo $form->absentOnDate; ?>">
                </div>
                <!-- Ignore in calculations -->
                <div class="form-group col-md-4">
                    <label for="absentOn">From</label>
                    <input type="time" name="absentFromTime" id="absentFromTime" class="form-control" aria-describedby="absentOnHelp" value="<?php echo $form->absentFromTime; ?>">
                </div>
                <!-- Ignore in calculations -->
                <div class="form-group col-md-4">
                    <label for="absentOn">To</label>
                    <input type="time" name="absentToTime" id="absentToTime" class="form-control" aria-describedby="absentOnHelp" value="<?php echo $form->absentToTime; ?>">
                </div>
            </div>

            <label class="col-md-12" style="padding-top:15px;padding-bottom:28px;">Lunch coverage required?&nbsp;&nbsp;&nbsp;
                <label class="radio-inline">
                    <input type="radio" name="lunch" id="lunchNo" value="false" <?php echo ($form->lunch == "false") ? 'checked' : ''; ?>> No
                </label>
                <label class="radio-inline">
                    <input type="radio" name="lunch" id="lunchYes" value="true" <?php echo ($form->lunch == "true") ? 'checked' : ''; ?>> Yes
                </label>
            </label>

            <h4><?php echo $form->courseCode_1; ?></h4>
            <fieldset class="form-group col-md-12">
                <div class="form-row col-md-12" style="padding-top:15px;">
                    <div class="col-md-6" style="padding-top:10px;">
                        <div class="form-group col-md-4">
                            <label for="courseCode_1">Class</label>
                            <input type="text" name="courseCode_1" id="courseCode_1" class="form-control" aria-describedby="courseCodeHelp" value="<?php echo $form->courseCode_1; ?>">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="roomNumber_1">Room Number</label>
                            <input type="text" name="roomNumber_1" id="roomNumber_1" class="form-control" aria-describedby="roomNumberHelp" value="<?php echo $form->roomNumber_1; ?>">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="lessonPlans_1">Lesson plan is in:</label>
                            <select name="lessonPlans_1" id="lessonPlans_1" class="form-control">
                                <option selected="selected"><?php echo $form->lessonPlans_1; ?></option>
                                <option>Main office</option>
                                <option>Department desk</option>
                                <option>Classroom desk</option>
                                <?php //if unplanned absence code chosen ?>
                                <option>Email to main office staff</option>
                            </select>
                        </div>

                        <div class="col-md-12">
                            <label class="col-md-12">Medical Plan of Care?&nbsp;&nbsp;&nbsp;
                                <label class="radio-inline">
                                    <input
                                        type="radio"
                                        name="medical_1"
                                        id="medicalNo_1"
                                        value="false"
                                        <?php echo ($form->medical_1 == "false") ? 'checked' : ''; ?>
                                        onclick="disable('medicalDetails_1')">
                                        No
                                </label>
                                <label class="radio-inline">
                                    <input
                                        type="radio"
                                        name="medical_1"
                                        id="medicalYes_1"
                                        value="true"
                                        <?php echo ($form->medical_1 == "true") ? 'checked' : ''; ?>
                                        onclick="enable('medicalDetails_1')">
                                        Yes
                                </label>
                            </label>
                            <div class="form-group">
                                <input
                                    type="text"
                                    name="medicalDetails_1"
                                    id="medicalDetails_1"
                                    value="<?php echo $form->medicalDetails_1; ?>"
                                    class="form-control"
                                    aria-describedby="medicalDetailsHelp"
                                    <?php echo ($form->medical_1 == "false") ? 'disabled="disabled"' : ''; ?>
                                >
                            </div>
                        </div>

                        <div class="col-md-12">
                            <label class="col-md-12">Safety Plan?&nbsp;&nbsp;&nbsp;
                                <label class="radio-inline">
                                    <input
                                        type="radio"
                                        name="safety_1"
                                        id="safetyNo_1"
                                        value="false"
                                        <?php echo ($form->safety_1 == "false") ? 'checked' : ''; ?>
                                        onclick="disable('safetyDetails_1')">
                                        No
                                </label>
                                <label class="radio-inline">
                                    <input
                                        type="radio"
                                        name="safety_1"
                                        id="safetyYes_1"
                                        value="true"
                                        <?php echo ($form->safety_1 == "true") ? 'checked' : ''; ?>
                                        onclick="enable('safetyDetails_1')">
                                        Yes
                                </label>
                            </label>
                            <div class="form-group">
                                <input
                                    type="text"
                                        name="safetyDetails_1"
                                        id="safetyDetails_1"
                                        value="<?php echo $form->safetyDetails_1; ?>"
                                        class="form-control"
                                        aria-describedby="safetyDetailsHelp"
                                        <?php echo ($form->safety_1 == "false") ? 'disabled="disabled"' : ''; ?>
                                    >
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group" style="margin-top:15px;">
                            <fieldset>
                                <div class="col-md-12">
                                    <label style="padding-top:10px;padding-bottom:10px;">Coverage Requested?</label>
                                </div>

                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <fieldset>
                                            <label style="padding-top:10px;">First Half</label>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="coverageFirst_1" id="coverageFirstYes_1" value="true" <?php echo ($form->coverageFirst_1 == "true") ? 'checked' : ''; ?>>
                                                    Yes
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="coverageFirst_1" id="coverageFirstNo_1" value="false" <?php echo ($form->coverageFirst_1 == "false") ? 'checked' : ''; ?>>
                                                    No
                                                </label>
                                            </div>
                                        </fieldset> 
                                    </div>
                                    <div class="col-md-6">
                                        <fieldset>
                                            <label style="padding-top:10px;">Second Half</label>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="coverageSecond_1" id="coverageSecondYes_1" value="true" <?php echo ($form->coverageSecond_1 == "true") ? 'checked' : ''; ?>>
                                                    Yes
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="coverageSecond_1" id="coverageSecondNo_1" value="false" <?php echo ($form->coverageSecond_1 == "false") ? 'checked' : ''; ?>>
                                                    No
                                                </label>
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>
                            </fieldset> 
                        </div>
                    </div>
                </div>
            </fieldset>

            <h4><?php echo $form->courseCode_2; ?></h4>
            <fieldset class="form-group col-md-12">
                <div class="form-row col-md-12" style="padding-top:15px;">
                    <div class="col-md-6" style="padding-top:10px;">
                        <div class="form-group col-md-4">
                            <label for="courseCode_2">Class</label>
                            <input type="text" name="courseCode_2" id="courseCode_2" class="form-control" aria-describedby="courseCodeHelp" value="<?php echo $form->courseCode_2; ?>">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="roomNumber_2">Room Number</label>
                            <input type="text" name="roomNumber_2" id="roomNumber_2" class="form-control" aria-describedby="roomNumberHelp" value="<?php echo $form->roomNumber_2; ?>">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="lessonPlans_2">Lesson plan is in:</label>
                            <select name="lessonPlans_2" id="lessonPlans_2" class="form-control">
                                <option selected="selected"><?php echo $form->lessonPlans_2; ?></option>
                                <option>Main office</option>
                                <option>Department desk</option>
                                <option>Classroom desk</option>
                                <?php //if unplanned absence code chosen ?>
                                <option>Email to main office staff</option>
                            </select>
                        </div>

                        <div class="col-md-12">
                            <label class="col-md-12">Medical Plan of Care?&nbsp;&nbsp;&nbsp;
                                <label class="radio-inline">
                                    <input
                                        type="radio"
                                        name="medical_2"
                                        id="medicalNo_2"
                                        value="false"
                                        <?php echo ($form->medical_2 == "false") ? 'checked' : ''; ?>
                                        onclick="disable('medicalDetails_2')">
                                        No
                                </label>
                                <label class="radio-inline">
                                    <input
                                        type="radio"
                                        name="medical_2"
                                        id="medicalYes_2"
                                        value="true"
                                        <?php echo ($form->medical_2 == "true") ? 'checked' : ''; ?>
                                        onclick="enable('medicalDetails_2')">
                                        Yes
                                </label>
                            </label>
                            <div class="form-group">
                                <input
                                    type="text"
                                    name="medicalDetails_2"
                                    id="medicalDetails_2"
                                    value="<?php echo $form->medicalDetails_2; ?>"
                                    class="form-control"
                                    aria-describedby="medicalDetailsHelp"
                                    <?php echo ($form->medical_2 == "false") ? 'disabled="disabled"' : ''; ?>
                                >
                            </div>
                        </div>

                        <div class="col-md-12">
                            <label class="col-md-12">Safety Plan?&nbsp;&nbsp;&nbsp;
                                <label class="radio-inline">
                                    <input
                                        type="radio"
                                        name="safety_2"
                                        id="safetyNo_2"
                                        value="false"
                                        <?php echo ($form->safety_2 == "false") ? 'checked' : ''; ?>
                                        onclick="disable('safetyDetails_2')">
                                        No
                                </label>
                                <label class="radio-inline">
                                    <input
                                        type="radio"
                                        name="safety_2"
                                        id="safetyYes_2"
                                        value="true"
                                        <?php echo ($form->safety_2 == "true") ? 'checked' : ''; ?>
                                        onclick="enable('safetyDetails_2')">
                                        Yes
                                </label>
                            </label>
                            <div class="form-group">
                                <input
                                    type="text"
                                        name="safetyDetails_2"
                                        id="safetyDetails_2"
                                        value="<?php echo $form->safetyDetails_2; ?>"
                                        class="form-control"
                                        aria-describedby="safetyDetailsHelp"
                                        <?php echo ($form->safety_2 == "false") ? 'disabled="disabled"' : ''; ?>
                                    >
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group" style="margin-top:15px;">
                            <fieldset>
                                <div class="col-md-12">
                                    <label style="padding-top:10px;padding-bottom:10px;">Coverage Requested?</label>
                                </div>

                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <fieldset>
                                            <label style="padding-top:10px;">First Half</label>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="coverageFirst_2" id="coverageFirstYes_2" value="true" <?php echo ($form->coverageFirst_2 == "true") ? 'checked' : ''; ?>>
                                                    Yes
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="coverageFirst_2" id="coverageFirstNo_2" value="false" <?php echo ($form->coverageFirst_2 == "false") ? 'checked' : ''; ?>>
                                                    No
                                                </label>
                                            </div>
                                        </fieldset> 
                                    </div>
                                    <div class="col-md-6">
                                        <fieldset>
                                            <label style="padding-top:10px;">Second Half</label>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="coverageSecond_2" id="coverageSecondYes_2" value="true" <?php echo ($form->coverageSecond_2 == "true") ? 'checked' : ''; ?>>
                                                    Yes
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="coverageSecond_2" id="coverageSecondNo_2" value="false" <?php echo ($form->coverageSecond_2 == "false") ? 'checked' : ''; ?>>
                                                    No
                                                </label>
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>
                            </fieldset> 
                        </div>
                    </div>
                </div>
            </fieldset>

            <h4><?php echo $form->courseCode_3; ?></h4>
            <fieldset class="form-group col-md-12">
                <div class="form-row col-md-12" style="padding-top:15px;">
                    <div class="col-md-6" style="padding-top:10px;">
                        <div class="form-group col-md-4">
                            <label for="courseCode_3">Class</label>
                            <input type="text" name="courseCode_3" id="courseCode_3" class="form-control" aria-describedby="courseCodeHelp" value="<?php echo $form->courseCode_3; ?>">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="roomNumber_3">Room Number</label>
                            <input type="text" name="roomNumber_3" id="roomNumber_3" class="form-control" aria-describedby="roomNumberHelp" value="<?php echo $form->roomNumber_3; ?>">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="lessonPlans_3">Lesson plan is in:</label>
                            <select name="lessonPlans_3" id="lessonPlans_3" class="form-control">
                                <option selected="selected"><?php echo $form->lessonPlans_3; ?></option>
                                <option>Main office</option>
                                <option>Department desk</option>
                                <option>Classroom desk</option>
                                <?php //if unplanned absence code chosen ?>
                                <option>Email to main office staff</option>
                            </select>
                        </div>

                        <div class="col-md-12">
                            <label class="col-md-12">Medical Plan of Care?&nbsp;&nbsp;&nbsp;
                                <label class="radio-inline">
                                    <input
                                        type="radio"
                                        name="medical_3"
                                        id="medicalNo_3"
                                        value="false"
                                        <?php echo ($form->medical_3 == "false") ? 'checked' : ''; ?>
                                        onclick="disable('medicalDetails_3')">
                                        No
                                </label>
                                <label class="radio-inline">
                                    <input
                                        type="radio"
                                        name="medical_3"
                                        id="medicalYes_3"
                                        value="true"
                                        <?php echo ($form->medical_3 == "true") ? 'checked' : ''; ?>
                                        onclick="enable('medicalDetails_3')">
                                        Yes
                                </label>
                            </label>
                            <div class="form-group">
                                <input
                                    type="text"
                                    name="medicalDetails_3"
                                    id="medicalDetails_3"
                                    value="<?php echo $form->medicalDetails_3; ?>"
                                    class="form-control"
                                    aria-describedby="medicalDetailsHelp"
                                    <?php echo ($form->medical_3 == "false") ? 'disabled="disabled"' : ''; ?>
                                >
                            </div>
                        </div>

                        <div class="col-md-12">
                            <label class="col-md-12">Safety Plan?&nbsp;&nbsp;&nbsp;
                                <label class="radio-inline">
                                    <input
                                        type="radio"
                                        name="safety_3"
                                        id="safetyNo_3"
                                        value="false"
                                        <?php echo ($form->safety_3 == "false") ? 'checked' : ''; ?>
                                        onclick="disable('safetyDetails_3')">
                                        No
                                </label>
                                <label class="radio-inline">
                                    <input
                                        type="radio"
                                        name="safety_3"
                                        id="safetyYes_3"
                                        value="true"
                                        <?php echo ($form->safety_3 == "true") ? 'checked' : ''; ?>
                                        onclick="enable('safetyDetails_3')">
                                        Yes
                                </label>
                            </label>
                            <div class="form-group">
                                <input
                                    type="text"
                                        name="safetyDetails_3"
                                        id="safetyDetails_3"
                                        value="<?php echo $form->safetyDetails_3; ?>"
                                        class="form-control"
                                        aria-describedby="safetyDetailsHelp"
                                        <?php echo ($form->safety_3 == "false") ? 'disabled="disabled"' : ''; ?>
                                    >
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group" style="margin-top:15px;">
                            <fieldset>
                                <div class="col-md-12">
                                    <label style="padding-top:10px;padding-bottom:10px;">Coverage Requested?</label>
                                </div>

                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <fieldset>
                                            <label style="padding-top:10px;">First Half</label>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="coverageFirst_3" id="coverageFirstYes_3" value="true" <?php echo ($form->coverageFirst_3 == "true") ? 'checked' : ''; ?>>
                                                    Yes
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="coverageFirst_3" id="coverageFirstNo_3" value="false" <?php echo ($form->coverageFirst_3 == "false") ? 'checked' : ''; ?>>
                                                    No
                                                </label>
                                            </div>
                                        </fieldset> 
                                    </div>
                                    <div class="col-md-6">
                                        <fieldset>
                                            <label style="padding-top:10px;">Second Half</label>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="coverageSecond_3" id="coverageSecondYes_3" value="true" <?php echo ($form->coverageSecond_3 == "true") ? 'checked' : ''; ?>>
                                                    Yes
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="coverageSecond_3" id="coverageSecondNo_3" value="false" <?php echo ($form->coverageSecond_3 == "false") ? 'checked' : ''; ?>>
                                                    No
                                                </label>
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>
                            </fieldset> 
                        </div>
                    </div>
                </div>
            </fieldset>

            <?php if ($form->courseCode_4) { ?>
                <h4><?php echo $form->courseCode_4; ?></h4>
                <fieldset class="form-group col-md-12">
                    <div class="form-row col-md-12" style="padding-top:15px;">
                        <div class="col-md-6" style="padding-top:10px;">
                            <div class="form-group col-md-4">
                                <label for="courseCode_4">Class</label>
                                <input type="text" name="courseCode_4" id="courseCode_4" class="form-control" aria-describedby="courseCodeHelp" value="<?php echo $form->courseCode_4; ?>">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="roomNumber_4">Room Number</label>
                                <input type="text" name="roomNumber_4" id="roomNumber_4" class="form-control" aria-describedby="roomNumberHelp" value="<?php echo $form->roomNumber_4; ?>">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="lessonPlans_4">Lesson plan is in:</label>
                                <select name="lessonPlans_4" id="lessonPlans_4" class="form-control">
                                    <option selected="selected"><?php echo $form->lessonPlans_4; ?></option>
                                    <option>Main office</option>
                                    <option>Department desk</option>
                                    <option>Classroom desk</option>
                                    <?php //if unplanned absence code chosen ?>
                                    <option>Email to main office staff</option>
                                </select>
                            </div>

                            <div class="col-md-12">
                                <label class="col-md-12">Medical Plan of Care?&nbsp;&nbsp;&nbsp;
                                    <label class="radio-inline">
                                        <input
                                            type="radio"
                                            name="medical_4"
                                            id="medicalNo_4"
                                            value="false"
                                            <?php echo ($form->medical_4 == "false") ? 'checked' : ''; ?>
                                            onclick="disable('medicalDetails_4')">
                                            No
                                    </label>
                                    <label class="radio-inline">
                                        <input
                                            type="radio"
                                            name="medical_4"
                                            id="medicalYes_4"
                                            value="true"
                                            <?php echo ($form->medical_4 == "true") ? 'checked' : ''; ?>
                                            onclick="enable('medicalDetails_4')">
                                            Yes
                                    </label>
                                </label>
                                <div class="form-group">
                                    <input
                                        type="text"
                                        name="medicalDetails_4"
                                        id="medicalDetails_4"
                                        value="<?php echo $form->medicalDetails_4; ?>"
                                        class="form-control"
                                        aria-describedby="medicalDetailsHelp"
                                        <?php echo ($form->medical_4 == "false") ? 'disabled="disabled"' : ''; ?>
                                    >
                                </div>
                            </div>

                            <div class="col-md-12">
                                <label class="col-md-12">Safety Plan?&nbsp;&nbsp;&nbsp;
                                    <label class="radio-inline">
                                        <input
                                            type="radio"
                                            name="safety_4"
                                            id="safetyNo_4"
                                            value="false"
                                            <?php echo ($form->safety_4 == "false") ? 'checked' : ''; ?>
                                            onclick="disable('safetyDetails_4')">
                                            No
                                    </label>
                                    <label class="radio-inline">
                                        <input
                                            type="radio"
                                            name="safety_4"
                                            id="safetyYes_4"
                                            value="true"
                                            <?php echo ($form->safety_4 == "true") ? 'checked' : ''; ?>
                                            onclick="enable('safetyDetails_4')">
                                            Yes
                                    </label>
                                </label>
                                <div class="form-group">
                                    <input
                                        type="text"
                                            name="safetyDetails_4"
                                            id="safetyDetails_4"
                                            value="<?php echo $form->safetyDetails_4; ?>"
                                            class="form-control"
                                            aria-describedby="safetyDetailsHelp"
                                            <?php echo ($form->safety_4 == "false") ? 'disabled="disabled"' : ''; ?>
                                        >
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group" style="margin-top:15px;">
                                <fieldset>
                                    <div class="col-md-12">
                                        <label style="padding-top:10px;padding-bottom:10px;">Coverage Requested?</label>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <fieldset>
                                                <label style="padding-top:10px;">First Half</label>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="coverageFirst_4" id="coverageFirstYes_4" value="true" <?php echo ($form->coverageFirst_4 == "true") ? 'checked' : ''; ?>>
                                                        Yes
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="coverageFirst_4" id="coverageFirstNo_4" value="false" <?php echo ($form->coverageFirst_4 == "false") ? 'checked' : ''; ?>>
                                                        No
                                                    </label>
                                                </div>
                                            </fieldset> 
                                        </div>
                                        <div class="col-md-6">
                                            <fieldset>
                                                <label style="padding-top:10px;">Second Half</label>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="coverageSecond_4" id="coverageSecondYes_4" value="true" <?php echo ($form->coverageSecond_4 == "true") ? 'checked' : ''; ?>>
                                                        Yes
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="coverageSecond_4" id="coverageSecondNo_4" value="false" <?php echo ($form->coverageSecond_4 == "false") ? 'checked' : ''; ?>>
                                                        No
                                                    </label>
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                </fieldset> 
                            </div>
                        </div>
                    </div>
                </fieldset>
            <?php } ?>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <!-- /CONTENT -->
    </div>

    <script>
        function disable(id) {
            document.getElementById(id).disabled = true;
        }
        function enable(id) {
            document.getElementById(id).disabled = false;
        }
    </script>

<?php } ?>

    </div>
</div>

<?php get_footer();
