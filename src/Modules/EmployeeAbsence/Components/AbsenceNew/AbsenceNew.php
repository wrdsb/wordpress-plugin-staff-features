<?php
$schoolCode = get_option('wrdsb_school_code');
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
    'schoolCode' => $schoolCode,
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
$response = wp_remote_post($url, $args);
$response_object = json_decode($response['body'], $assoc = false);

$employee = $response_object[0];
$employeeSchedule = $employee->schedule;
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
                            <option onclick="disable('ecJob')">A295 Staff development (include Short Term Ed. Leave (STEL) # or Staff Development (SD) #)</option>
                            <option onclick="disable('ecJob')">Board-mandated meeting (include Occasional Teacher (OT) allocation code)</option>
                            <option onclick="disable('ecJob')">A201 School Activity/Field Trip (include OT request form and Off Campus #)</option>
                            <option onclick="disable('ecJob')">A201 School Activity/Field Trip (internal coverage (on call) is expected) (specify FT/sport coached/club/event) (location)</option>
                            <option onclick="disable('ecJob')">Coaching (team)</option>
                            <option onclick="disable('ecJob')">Field Trip (destination)</option>
                            <option onclick="disable('ecJob')">Meeting (location)</option>

                            <option onclick="enable('ecJob')">A315 Personal Day</option>
                            <option onclick="enable('ecJob')">A100 Personal Illness</option>
                            <option onclick="enable('ecJob')">A400 Medical Appointments</option>
                            <option onclick="enable('ecJob')">A256 Family Care (specify relationship (son, daughter, etc.))</option>
                            <option onclick="disable('ecJob')">A212 Subject Association (specify subject)</option>
                            <option onclick="disable('ecJob')">A276 Staff Development (Board) (specify title, location, and SD #)</option>
                            <option onclick="disable('ecJob')">A326 Site Based 7-12 (School) (specify title, location)</option>
                            <option onclick="enable('ecJob')">A280 Bereavement (specify)</option>
                            <option onclick="enable('ecJob')">A400 Medical Appointment</option>
                            <option onclick="disable('ecJob')">A321 NTIP New Teacher</option>
                            <option onclick="disable('ecJob')">A322 NTIP Mentor</option>

                            <option onclick="enable('ecJob')">Family Care Day (indicate family member and reason)</option>
                            <option onclick="disable('ecJob')">Remedy Day</option>
                            <option onclick="disable('ecJob')">Other (indicate reason)</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="ecJob">Easy Connect job number</label>
                        <input type="number" name="ecJob" id="ecJob" class="form-control" aria-describedby="ecJobHelp" placeholder="123456" disabled>
                    </div>
                    <div class="form-group col-md-9">
                        <label for="comments">Comments</label>
                        <input type="text" name="comments" id="comments" class="form-control" aria-describedby="commentsHelp" disabled>
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

                <?php foreach ($employeeSchedule as $dayPart) { ?>
                    <h4><?php echo $dayPart->label; ?></h4>
                    <fieldset class="form-group col-md-12">
                        <div class="form-row col-md-12" style="padding-top:15px;">
                            <div class="col-md-6" style="padding-top:10px;">
                                <div class="form-group col-md-4">
                                    <label for="courseCode-<?php echo $dayPart->id; ?>">Class</label>
                                    <input type="text" name="courseCode-<?php echo $dayPart->id; ?>" id="courseCode-<?php echo $dayPart->id; ?>" class="form-control" aria-describedby="courseCodeHelp" value="<?php echo $dayPart->courseCode; ?>">
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="roomNumber-<?php echo $dayPart->id; ?>">Room Number</label>
                                    <input type="text" name="roomNumber-<?php echo $dayPart->id; ?>" id="roomNumber-<?php echo $dayPart->id; ?>" class="form-control" aria-describedby="roomNumberHelp" value="<?php echo $dayPart->roomNumber; ?>">
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="lessonPlans-<?php echo $dayPart->id; ?>">Lesson plan is in:</label>
                                    <select name="lessonPlans-<?php echo $dayPart->id; ?>" id="lessonPlans-<?php echo $dayPart->id; ?>" class="form-control">
                                        <option>Main office</option>
                                        <option>Department desk</option>
                                        <option>Classroom desk</option>
                                        <?php //if unplanned absence code chosen ?>
                                        <option>Email to main office staff</option>
                                    </select>
                                </div>

                                <div class="col-md-12">
                                    <label class="col-md-12">Medical?&nbsp;&nbsp;&nbsp;
                                        <label class="radio-inline">
                                            <input
                                                type="radio"
                                                name="medical-<?php echo $dayPart->id; ?>"
                                                id="medicalNo-<?php echo $dayPart->id; ?>"
                                                value="false"
                                                checked
                                                onclick="disable('medicalDetails-<?php echo $dayPart->id; ?>')">
                                                No
                                        </label>
                                        <label class="radio-inline">
                                            <input
                                                type="radio"
                                                name="medical-<?php echo $dayPart->id; ?>"
                                                id="medicalYes-<?php echo $dayPart->id; ?>"
                                                value="true"
                                                onclick="enable('medicalDetails-<?php echo $dayPart->id; ?>')">
                                                Yes
                                        </label>
                                    </label>
                                    <div class="form-group">
                                        <input
                                            type="text"
                                            name="medicalDetails-<?php echo $dayPart->id; ?>"
                                            id="medicalDetails-<?php echo $dayPart->id; ?>"
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
                                                name="behaviour-<?php echo $dayPart->id; ?>"
                                                id="behaviourNo-<?php echo $dayPart->id; ?>"
                                                value="false"
                                                checked
                                                onclick="disable('behaviourDetails-<?php echo $dayPart->id; ?>')">
                                                No
                                        </label>
                                        <label class="radio-inline">
                                            <input
                                                type="radio"
                                                name="behaviour-<?php echo $dayPart->id; ?>"
                                                id="behaviourYes-<?php echo $dayPart->id; ?>"
                                                value="true"
                                                onclick="enable('behaviourDetails-<?php echo $dayPart->id; ?>')">
                                                Yes
                                        </label>
                                    </label>
                                    <div class="form-group">
                                        <input
                                            type="text"
                                                name="behaviourDetails-<?php echo $dayPart->id; ?>"
                                                id="behaviourDetails-<?php echo $dayPart->id; ?>"
                                                placeholder="student one, student two"
                                                class="form-control"
                                                aria-describedby="behaviourDetailsHelp"
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
                                                            <input type="radio" name="coverageFirst-<?php echo $dayPart->id; ?>" id="coverageFirstYes-<?php echo $dayPart->id; ?>" value="true" checked>
                                                            Yes
                                                        </label>
                                                    </div>
                                                    <div class="radio">
                                                        <label>
                                                            <input type="radio" name="coverageFirst-<?php echo $dayPart->id; ?>" id="coverageFirstNo-<?php echo $dayPart->id; ?>" value="false">
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
                                                            <input type="radio" name="coverageSecond-<?php echo $dayPart->id; ?>" id="coverageSecondYes-<?php echo $dayPart->id; ?>" value="true" checked>
                                                            Yes
                                                        </label>
                                                    </div>
                                                    <div class="radio">
                                                        <label>
                                                            <input type="radio" name="coverageSecond-<?php echo $dayPart->id; ?>" id="coverageSecondNo-<?php echo $dayPart->id; ?>" value="false">
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
