<?php
$schoolCode = get_option('wrdsb_school_code');
//$functionKey = CMA_DAY_QUERY_KEY;

function setCustomTitle()
{
    $pageTitle = "New Employee Absence";
    return $pageTitle;
}
add_filter('pre_get_document_title', 'setCustomTitle');

$body = array(
    'schoolCode' => $schoolCode,
);

$pageTitle = "New Employee Absence";

$current_user = wp_get_current_user();
$current_time = current_time('mysql');

$dayParts = array();

$dayPart1 = new stdClass;
$dayPart1->id = '1';
$dayPart1->label = 'Block A';
$dayPart1->courseCode = 'asdf';
$dayPart1->roomNumber = '1234';
$dayParts[] = $dayPart1;

$dayPart2 = new stdClass;
$dayPart2->id = '2';
$dayPart2->label = 'Block B';
$dayPart2->courseCode = 'fdsa';
$dayPart2->roomNumber = '456';
$dayParts[] = $dayPart2;

$dayPart3 = new stdClass;
$dayPart3->id = '3';
$dayPart3->label = 'Block E';
$dayPart3->courseCode = 'ashewr';
$dayPart3->roomNumber = '5467';
$dayParts[] = $dayPart3;

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

            <form>
                <div class="form-row">
                    <div class="col-md-9">
                        <div class="form-group">
                            <label for="staffMember">Staff Member</label>
                            <input type="text" class="form-control" id="staffMember" aria-describedby="staffMemberHelp" value="<?php echo $current_user->display_name; ?>" disabled="disabled">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="createdOn">Date/Time Submitted</label>
                            <input type="text" class="form-control" id="createdOn" aria-describedby="createdOnHelp" value="<?php echo $current_time; ?>" disabled="disabled">
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="reason">Reason for absence</label>
                        <select class="form-control" id="reason">
                            <option>A295 Staff development (include Short Term Ed. Leave (STEL) # or Staff Development (SD) #)</option>
                            <option>Board-mandated meeting (include Occasional Teacher (OT) allocation code)</option>
                            <option>A201 School Activity/Field Trip (include OT request form and Off Campus #)</option>
                            <option>A201 School Activity/Field Trip (internal coverage (on call) is expected) (specify FT/sport coached/club/event) (location)</option>
                            <option>Coaching (team)</option>
                            <option>Field Trip (destination)</option>
                            <option>Meeting (location)</option>

                            <option>A315 Personal Day</option>
                            <option>A100 Personal Illness</option>
                            <option>A400 Medical Appointments</option>
                            <option>A256 Family Care (specify relationship (son, daughter, etc.))</option>
                            <option>A212 Subject Association (specify subject)</option>
                            <option>A276 Staff Development (Board) (specify title, location, and SD #)</option>
                            <option>A326 Site Based 7-12 (School) (specify title, location)</option>
                            <option>A280 Bereavement (specify)</option>
                            <option>A400 Medical Appointment</option>
                            <option>A321 NTIP New Teacher</option>
                            <option>A322 NTIP Mentor</option>

                            <option>Family Care Day (indicate family member and reason)</option>
                            <option>Remedy Day</option>
                            <option>Other (indicate reason)</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="ecJob">Easy Connect job number</label>
                        <input type="number" class="form-control" id="ecJob" aria-describedby="ecJobHelp" placeholder="123456" disabled>
                    </div>
                    <div class="form-group col-md-9">
                        <label for="comments">Comments</label>
                        <input type="text" class="form-control" id="comments" aria-describedby="commentsHelp" disabled>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="absentOn">Date of Absence</label>
                        <input type="date" class="form-control" id="absentOnDate" aria-describedby="absentOnHelp" placeholder="2019-01-31">
                    </div>
                    <!-- Ignore in calculations -->
                    <div class="form-group col-md-4">
                        <label for="absentOn">From</label>
                        <input type="time" class="form-control" id="absentFromTime" aria-describedby="absentOnHelp" placeholder="8:00">
                    </div>
                    <!-- Ignore in calculations -->
                    <div class="form-group col-md-4">
                        <label for="absentOn">To</label>
                        <input type="time" class="form-control" id="absentToTime" aria-describedby="absentOnHelp" placeholder="15:00">
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

                <?php foreach ($dayParts as $dayPart) { ?>
                    <h4><?php echo $dayPart->label; ?></h4>
                    <fieldset class="form-group col-md-12">
                        <div class="form-row col-md-12" style="padding-top:15px;">
                            <div class="col-md-6" style="padding-top:10px;">
                                <div class="form-group col-md-4">
                                    <label for="courseCode-<?php echo $dayPart->id; ?>">Class</label>
                                    <input type="text" class="form-control" id="courseCode-<?php echo $dayPart->id; ?>" aria-describedby="courseCodeHelp" placeholder="<?php echo $dayPart->courseCode; ?>">
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="roomNumber-<?php echo $dayPart->id; ?>">Room Number</label>
                                    <input type="text" class="form-control" id="roomNumber-<?php echo $dayPart->id; ?>" aria-describedby="roomNumberHelp" placeholder="<?php echo $dayPart->roomNumber; ?>">
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="lessonPlans-<?php echo $dayPart->id; ?>">Lesson plan is in:</label>
                                    <select class="form-control" id="lessonPlans-<?php echo $dayPart->id; ?>">
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
                                            <input type="radio" name="medical-<?php echo $dayPart->id; ?>" id="medicalNo-<?php echo $dayPart->id; ?>" value="false" checked> No
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="medical-<?php echo $dayPart->id; ?>" id="medicalYes-<?php echo $dayPart->id; ?>" value="true"> Yes
                                        </label>
                                    </label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="medicalDetails-<?php echo $dayPart->id; ?>" placeholder="student one, student two" aria-describedby="medicalDetailsHelp" disabled="disabled">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <label class="col-md-12">Safety Plan?&nbsp;&nbsp;&nbsp;
                                        <label class="radio-inline">
                                            <input type="radio" name="behaviour-<?php echo $dayPart->id; ?>" id="behaviourNo-<?php echo $dayPart->id; ?>" value="false" checked> No
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="behaviour-<?php echo $dayPart->id; ?>" id="behaviourYes-<?php echo $dayPart->id; ?>" value="true"> Yes
                                        </label>
                                    </label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="behaviourDetails-<?php echo $dayPart->id; ?>" placeholder="student one, student two" aria-describedby="behaviourDetailsHelp" disabled="disabled">
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

<?php get_footer();
