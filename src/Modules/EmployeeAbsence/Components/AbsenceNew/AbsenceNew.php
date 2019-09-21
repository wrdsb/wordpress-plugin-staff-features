<?php
$schoolCode = get_option('wrdsb_school_code');
$school_code = strtolower($schoolCode);
$functionKey = CMA_ABSENCE_FORM_INIT_KEY;

function setCustomTitle()
{
    $pageTitle = "New Employee Absence";
    return $pageTitle;
}
add_filter('pre_get_document_title', 'setCustomTitle');

$pageTitle = "New Employee Absence";

$current_user = wp_get_current_user();
$current_time = current_time('mysql');

$body = array(
    'school_code' => $school_code,
    'email' => $current_user->user_email
);

$url = "https://wrdsb-cma.azurewebsites.net/api/absence-form-init?code={$functionKey}";
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

<div class="container container-top">
    <?php
        get_template_part('partials/header', 'masthead');
        get_template_part('partials/header', 'navbar');
    ?>
    <div class="container container-breadcrumb" role="navigation">
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo get_option('home'); ?>">Home</a>
            </li>
            <li>
                Employee Absences
            </li>
            <li>
                <?php echo $pageTitle; ?>
            </li>
        </ol>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-sm-12 col-lg-12" role="main">
            <!-- CONTENT -->
            <h1><?php echo $pageTitle; ?></h1>

            <form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post">
                <input type="hidden" name="action" value="absence_form_submit">
                <input type="hidden" name="schoolCode" value="<?php echo $schoolCode; ?>">
                <input type="hidden" name="email" value="<?php echo $current_user->user_email ?>">

                <div class="form-row">
                    <div class="col-md-9">
                        <div class="form-group">
                            <label for="staffMember">Staff Member</label>
                            <input type="text" name="staffMember" id="staffMember" class="form-control" aria-describedby="staffMemberHelp" value="<?php echo $current_user->display_name; ?>" readonly>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="createdOn">Date/Time Submitted</label>
                            <input type="text" name="createdOn" id="createdOn" class="form-control" aria-describedby="createdOnHelp" value="<?php echo $current_time; ?>" readonly>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="reason">Reason for absence</label>
                        <select name="reason" id="reason" class="form-control">
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
                        <input type="number" name="ecJob" id="ecJob" class="form-control" aria-describedby="ecJobHelp" placeholder="123456">
                    </div>
                    <div class="form-group col-md-9">
                        <label for="comments">Comments</label>
                        <input type="text" name="comments" id="comments" class="form-control" aria-describedby="commentsHelp">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="absentOn">Date of Absence</label>
                        <input type="date" name="absentOnDate" id="absentOnDate" class="form-control" aria-describedby="absentOnHelp" placeholder="2019-01-31">
                    </div>
                    <!-- Ignore in calculations -->
                    <div class="form-group col-md-4">
                        <label for="absentOn">From</label>
                        <input type="time" name="absentFromTime" id="absentFromTime" class="form-control" aria-describedby="absentOnHelp" placeholder="8:00">
                    </div>
                    <!-- Ignore in calculations -->
                    <div class="form-group col-md-4">
                        <label for="absentOn">To</label>
                        <input type="time" name="absentToTime" id="absentToTime" class="form-control" aria-describedby="absentOnHelp" placeholder="15:00">
                    </div>
                </div>

                <label class="col-md-12" style="padding-top:15px;padding-bottom:28px;">Lunch coverage required?&nbsp;&nbsp;&nbsp;
                    <label class="radio-inline">
                        <input type="radio" name="lunch" id="lunchNo" value="false" checked> No
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="lunch" id="lunchYes" value="true"> Yes
                    </label>
                </label>

                <?php $dayPartIndex = 0; ?>
                <?php foreach ($employeeSchedule as $dayPart) { ?>
                    <?php $dayPartIndex++; ?>

                    <h4>Block <?php echo $dayPart->block; ?></h4>

                    <fieldset class="form-group col-md-12">
                        <div class="form-row col-md-12" style="padding-top:15px;">
                            <div class="col-md-6" style="padding-top:10px;">
                                <div class="form-group col-md-4">
                                    <label for="courseCode_<?php echo $dayPartIndex; ?>">Class</label>
                                    <input type="text" name="courseCode_<?php echo $dayPartIndex; ?>" id="courseCode_<?php echo $dayPartIndex; ?>" class="form-control" aria-describedby="courseCodeHelp" value="<?php echo $dayPart->classCode; ?>">
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="roomNumber_<?php echo $dayPartIndex; ?>">Room Number</label>
                                    <input type="text" name="roomNumber_<?php echo $dayPartIndex; ?>" id="roomNumber_<?php echo $dayPartIndex; ?>" class="form-control" aria-describedby="roomNumberHelp" value="<?php echo $dayPart->roomNumber; ?>">
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="lessonPlans_<?php echo $dayPartIndex; ?>">Lesson plan is in:</label>
                                    <select name="lessonPlans_<?php echo $dayPartIndex; ?>" id="lessonPlans_<?php echo $dayPartIndex; ?>" class="form-control">
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
                                                name="medical_<?php echo $dayPartIndex; ?>"
                                                id="medicalNo_<?php echo $dayPartIndex; ?>"
                                                value="false"
                                                checked
                                                onclick="disable('medicalDetails_<?php echo $dayPartIndex; ?>')">
                                                No
                                        </label>
                                        <label class="radio-inline">
                                            <input
                                                type="radio"
                                                name="medical_<?php echo $dayPartIndex; ?>"
                                                id="medicalYes_<?php echo $dayPartIndex; ?>"
                                                value="true"
                                                onclick="enable('medicalDetails_<?php echo $dayPartIndex; ?>')">
                                                Yes
                                        </label>
                                    </label>
                                    <div class="form-group">
                                        <input
                                            type="text"
                                            name="medicalDetails_<?php echo $dayPartIndex; ?>"
                                            id="medicalDetails_<?php echo $dayPartIndex; ?>"
                                            placeholder="student one, student two"
                                            class="form-control"
                                            aria-describedby="medicalDetailsHelp"
                                            disabled="disabled"
                                        >
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <label class="col-md-12">Safety Plan?&nbsp;&nbsp;&nbsp;
                                        <label class="radio-inline">
                                            <input
                                                type="radio"
                                                name="safety_<?php echo $dayPartIndex; ?>"
                                                id="safetyNo_<?php echo $dayPartIndex; ?>"
                                                value="false"
                                                checked
                                                onclick="disable('safetyDetails_<?php echo $dayPartIndex; ?>')">
                                                No
                                        </label>
                                        <label class="radio-inline">
                                            <input
                                                type="radio"
                                                name="safety_<?php echo $dayPartIndex; ?>"
                                                id="safetyYes_<?php echo $dayPartIndex; ?>"
                                                value="true"
                                                onclick="enable('safetyDetails_<?php echo $dayPartIndex; ?>')">
                                                Yes
                                        </label>
                                    </label>
                                    <div class="form-group">
                                        <input
                                            type="text"
                                                name="safetyDetails_<?php echo $dayPartIndex; ?>"
                                                id="safetyDetails_<?php echo $dayPartIndex; ?>"
                                                placeholder="student one, student two"
                                                class="form-control"
                                                aria-describedby="safetyDetailsHelp"
                                                disabled="disabled"
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
                                                            <input type="radio" name="coverageFirst_<?php echo $dayPartIndex; ?>" id="coverageFirstYes_<?php echo $dayPartIndex; ?>" value="true" checked>
                                                            Yes
                                                        </label>
                                                    </div>
                                                    <div class="radio">
                                                        <label>
                                                            <input type="radio" name="coverageFirst_<?php echo $dayPartIndex; ?>" id="coverageFirstNo_<?php echo $dayPartIndex; ?>" value="false">
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
                                                            <input type="radio" name="coverageSecond_<?php echo $dayPartIndex; ?>" id="coverageSecondYes_<?php echo $dayPartIndex; ?>" value="true" checked>
                                                            Yes
                                                        </label>
                                                    </div>
                                                    <div class="radio">
                                                        <label>
                                                            <input type="radio" name="coverageSecond_<?php echo $dayPartIndex; ?>" id="coverageSecondNo_<?php echo $dayPartIndex; ?>" value="false">
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

<?php get_footer();
