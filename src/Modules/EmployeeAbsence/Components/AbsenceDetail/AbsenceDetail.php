<?php
$schoolCode = get_option('wrdsb_school_code');
$current_user = wp_get_current_user();
$functionKey = CMA_ABSENCE_QUERY_KEY;

function setCustomTitle()
{
    $pageTitle = "Employee Absence Detail";
    return $pageTitle;
}
add_filter('pre_get_document_title', 'setCustomTitle');

$pageTitle = "Employee Absence Detail";

$body = array(
    'schoolCode' => $schoolCode,
    'email' => $current_user->user_email
);

if ($wp_query->query_vars['id']) {
    $id = $wp_query->query_vars['id'];
    $body['id'] = $id;
    $pageTitle = "Employee Absence #{$id}";
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

$day = $response_object[0];
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
            <pre><?php print_r($wp_query); ?></pre>
            <pre><?php print_r($response_object); ?></pre>
            <!-- /CONTENT -->
        </div>
    </div>
</div>

<?php get_footer();
