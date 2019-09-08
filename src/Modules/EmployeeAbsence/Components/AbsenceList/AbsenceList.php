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
$functionKey = CMA_ABSENCE_QUERY_KEY;

function setCustomTitle()
{
    $pageTitle = "Employee Absence List";
    return $pageTitle;
}
add_filter('pre_get_document_title', 'setCustomTitle');

$body = array(
    'schoolCode' => $schoolCode,
);

if ($wp_query->query_vars['epoch']) {
    $epoch = $wp_query->query_vars['epoch'];
    $body['epoch'] = $epoch;
    $body['today'] = date('Y-m-d');
    $body['tomorrow'] = date('Y-m-d', mktime(0, 0, 0, date("m")  , date("d")+1, date("Y")));
    $pageTitle = "Employee Absence List ({$epoch})";
} elseif ($wp_query->query_vars['date']) {
    $date = $wp_query->query_vars['date'];
    $body['date'] = $date;
    $pageTitle = "Employee Absences for {$date}";
} elseif ($wp_query->query_vars['employee']) {
    $employee = $wp_query->query_vars['employee'];
    $body['employee'] = $employee;
    $pageTitle = "Absences for Employee #{$employee}";
} else {
    $pageTitle = "Employee Absence List";
}

$url = "https://wrdsb-cma.azurewebsites.net/api/absence-query?code={$functionKey}";
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

$day = $response_object;
?>

<?php get_header(); ?>

<div class="container container-top">
    <?php
        get_template_part('partials/header', 'masthead');
        get_template_part('partials/header', 'navbar');
    ?>
</div>

<?php if (! in_array($current_user->user_email, $authorized)) { ?>

<div class="container">
    <div class="row">
        <h1>You are not authorized to view this page.</h1>
    </div>
</div>

<?php } else { ?>

<div class="container">
    <div class="row">
        <p>
            <a href="<?php echo home_url(); ?>/employee/absences/old">Old</a>
            &nbsp;&nbsp;|&nbsp;&nbsp;
            <a href="<?php echo home_url(); ?>/employee/absences/today">Today</a>
            &nbsp;&nbsp;|&nbsp;&nbsp;
            <a href="<?php echo home_url(); ?>/employee/absences/tomorrow">Tomorrow</a>
            &nbsp;&nbsp;|&nbsp;&nbsp;
            <a href="<?php echo home_url(); ?>/employee/absences/future">Future</a>
        </p>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-sm-12 col-lg-12" role="main">
            <!-- CONTENT -->
            <h1><?php echo $pageTitle; ?></h1>
            <table width="100%">
                <thead>
                    <tr>
                        <th width="20%">Employee</th>
                        <th>Absence Date</th>
                        <th>Lunch</th>
                        <th>Class 1</th>
                        <th>Class 2</th>
                        <th>Class 3</th>
                        <th>Class 4</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($response_object as $form) { ?>
                        <tr>
                            <td width="20%">
                                <p><a href="<?php echo home_url(); ?>/employee/absence/<?php echo $form->id; ?>"><?php echo $form->staffMember; ?></a></p>
                                <p><?php echo $form->reason; ?></p>
                            </td>
                            <td>
                                <p><?php echo $form->absentOnDate; ?></p>
                                <p><?php echo $form->absentFromTime; ?> - <?php echo $form->absentToTime; ?></p>
                                <p>APTE: <?php echo $form->ecJob; ?></p>
                            </td>
                            <td><?php echo ($form->lunch == "true") ? 'Yes' : 'No'; ?></td>
                            <td>
                                <pre><?php echo $form->courseCode_1; ?></pre>
                                <ul>
                                    <li>1st: <?php echo ($form->coverageFirst_1 == "true") ? 'Yes' : 'No'; ?></li>
                                    <li>2nd: <?php echo ($form->coverageSecond_1 == "true") ? 'Yes' : 'No'; ?></li>
                                    <li>Medical: <?php echo ($form->medical_1 == "true") ? 'Yes' : 'No'; ?></li>
                                    <li>Safety: <?php echo ($form->safety_1 == "true") ? 'Yes' : 'No'; ?></li>
                                </ul>
                            </td>
                            <td>
                                <pre><?php echo $form->courseCode_2; ?></pre>
                                <ul>
                                    <li>1st: <?php echo ($form->coverageFirst_2 == "true") ? 'Yes' : 'No'; ?></li>
                                    <li>2nd: <?php echo ($form->coverageSecond_2 == "true") ? 'Yes' : 'No'; ?></li>
                                    <li>Medical: <?php echo ($form->medical_2 == "true") ? 'Yes' : 'No'; ?></li>
                                    <li>Safety: <?php echo ($form->safety_2 == "true") ? 'Yes' : 'No'; ?></li>
                                </ul>
                            </td>
                            <td>
                                <pre><?php echo $form->courseCode_3; ?></pre>
                                <ul>
                                    <li>1st: <?php echo ($form->coverageFirst_3 == "true") ? 'Yes' : 'No'; ?></li>
                                    <li>2nd: <?php echo ($form->coverageSecond_3 == "true") ? 'Yes' : 'No'; ?></li>
                                    <li>Medical: <?php echo ($form->medical_3 == "true") ? 'Yes' : 'No'; ?></li>
                                    <li>Safety: <?php echo ($form->safety_3 == "true") ? 'Yes' : 'No'; ?></li>
                                </ul>
                            </td>
                            <td>
                                <?php if (strlen($form->courseCode_4) > 0) { ?>
                                    <pre><?php echo $form->courseCode_4; ?></pre>
                                    <ul>
                                        <li>1st: <?php echo ($form->coverageFirst_4 == "true") ? 'Yes' : 'No'; ?></li>
                                        <li>2nd: <?php echo ($form->coverageSecond_4 == "true") ? 'Yes' : 'No'; ?></li>
                                        <li>Medical: <?php echo ($form->medical_4 == "true") ? 'Yes' : 'No'; ?></li>
                                        <li>Safety: <?php echo ($form->safety_4 == "true") ? 'Yes' : 'No'; ?></li>
                                    </ul>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <!-- /CONTENT -->
        </div>
    </div>
</div>

<?php } ?>

<?php get_footer();
