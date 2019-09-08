<?php
$schoolCode = get_option('wrdsb_school_code');
$functionKey = CMA_ABSENCE_PART_QUERY_KEY;

function setCustomTitle()
{
    $pageTitle = "Employee Absence Part List";
    return $pageTitle;
}
add_filter('pre_get_document_title', 'setCustomTitle');

$body = array(
    'schoolCode' => $schoolCode,
);

if ($wp_query->query_vars['date']) {
    $date = $wp_query->query_vars['date'];
    $body['date'] = $date;
    $pageTitle = "Employee Absence Parts for {$date}";
} elseif ($wp_query->query_vars['employee']) {
    $employee = $wp_query->query_vars['employee'];
    $body['employee'] = $employee;
    $pageTitle = "Absence Parts for Employee #{$employee}";
} else {
    $pageTitle = "Employee Absence Part List";
}

$url = "https://wrdsb-cma.azurewebsites.net/api/absence-part-query?code={$functionKey}";
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
            <!-- /CONTENT -->
        </div>
    </div>
</div>

<?php get_footer();
