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
$school_code = strtolower($schoolCode);
$functionKey = CMA_ABSENCE_FORM_INIT_KEY;

function setCustomTitle()
{
    $pageTitle = "Quick Add Employee Absence";
    return $pageTitle;
}
add_filter('pre_get_document_title', 'setCustomTitle');

$body = array(
    'schoolCode' => $schoolCode,
    'email' => $current_user->user_email
);

$pageTitle = "Quick Add Employee Absence";

$employees = array();

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
            date!
            teacher drop down
            select teacher

            <form>
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
                            </div>

                            <div class="col-md-6">
                                <div class="form-group" style="margin-top:15px;">
                                    <fieldset>
                                        <div class="col-md-12">
                                            <label style="padding-top:10px;padding-bottom:10px;">Coverage Required?</label>
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
