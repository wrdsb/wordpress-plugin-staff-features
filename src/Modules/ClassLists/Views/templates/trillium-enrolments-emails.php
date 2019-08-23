<?php
$class_code = $wp_query->query_vars['class-code'];
//$school_code = 'CHC';
$school_code = get_option('wrdsb_school_code');
$page_title = $class_code . ' Class List';
$access_time = current_time('mysql');

function setCustomTitle()
{
    global $wp_query;
    $class_code = $wp_query->query_vars['class-code'];
    $page_title = $class_code . ' Class List';
    return $page_title;
}
add_filter('pre_get_document_title', 'setCustomTitle');

global $wp_version;
$url = 'https://wrdsb-codex.search.windows.net/indexes/skinner-enrolments/docs/search?api-version=2016-09-01';
$args = array(
    'timeout'     => 5,
    'redirection' => 5,
    'httpversion' => '1.0',
    'user-agent'  => 'WordPress/' . $wp_version . '; ' . home_url(),
    'blocking'    => true,
    'headers'     => array(
        'Accept' => 'application/json',
        'Content-Type' => 'application/json',
        'api-key' => WRDSB_CODEX_SEARCH_KEY
    ),
    'cookies'     => array(),
    'body'        => json_encode(array(
        "filter"  => "class_code eq '{$class_code}' and school_code eq '{$school_code}'",
        "search"  => "*",
        "select"  => "*",
        "orderby" => "student_email",
        "top"     => 1000,
        "count"   => true
    )),
    'compress'    => false,
    'decompress'  => true,
    'sslverify'   => false,
    'stream'      => false,
    'filename'    => null
);

$response = wp_remote_post($url, $args);
$response_object = json_decode($response['body'], $assoc = false);
$enrolments = $response_object->value;
$enrolments_count = $response_object->{'@odata.count'};
$page_min = 1;
$page_max = count($enrolments);
$pages = 1;

while ($enrolments_count > $page_max) {
    $body = json_decode($args['body'], $assoc = true);
    $body["skip"] = $pages * 1000;
    $args['body'] = json_encode($body);
    $response = wp_remote_post($url, $args);
    $response_object = json_decode($response['body'], $assoc = false);
    $enrolments = array_merge($enrolments, $response_object->value);
    $page_max = count($enrolments);
    $pages++;
}

$student_emails = array();
foreach ($enrolments as $enrolment) {
    $student_emails[] = "<div>{$enrolment->student_email},</div>";
}
$total_emails = count($student_emails);
$last_email = $total_emails - 1;
$student_emails[$last_email] = str_replace(',', '', $student_emails[$last_email]);

$emails_list = '';
foreach ($student_emails as $email) {
    $emails_list .= $email;
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
      Trillium
    </li>
    <li>
      <a href="<?php echo get_option('home'); ?>/trillium/classes">Classes</a>
    </li>
    <li>
      <a href="<?php echo get_option('home'); ?>/trillium/enrolments/?class-code=<?php echo $class_code; ?>"><?php echo $page_title; ?></a>
    </li>
    <li>
      Email List
    </li>
        </ol>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-sm-8 col-lg-8" role="main">
            <!-- CONTENT -->
              <div class="content container">
                <h3><?php echo $class_code ?></h3>
                <?php echo $emails_list; ?>
              </div>
            <!-- CONTENT -->
            </div>
    </div>
</div>

<?php get_footer();
