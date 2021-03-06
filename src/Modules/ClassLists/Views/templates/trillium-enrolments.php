<?php
$class_code = $wp_query->query_vars['class-code'];
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
?>

<?php get_header(); ?>

<div class="container-top">
    <?php get_template_part('partials/header', 'masthead'); ?>

    <?php if (! current_user_can_view_content()) { ?>
        <?php get_template_part('partials/content', 'unauthorized'); ?>
    <?php } else { ?>
        <?php get_template_part('partials/header', 'navbar'); ?>

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
            </ol>
        </div>
    <?php } ?>
</div>

<?php if (current_user_can_view_content()) { ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-3 col-lg-3" role="complementary">
                <div class="navbar my-sub-navbar" id="section_navigation" role="navigation">
                    <div class="sub-navbar-header">
                        <button type="button" class="navbar-toggle toggle-subnav" data-toggle="collapse" data-target=".sub-navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <span class="navbar-brand">Subnav</span>
                    </div>
                    <div class="collapse sub-navbar-collapse">
                        <div class="sub-menu-heading">
                            <span><a href="<?php echo home_url(); ?>/trillium/classes">Class Lists</a></span>
                        </div>
                        <div class="sub-menu-items">
                            <ul>
                                <ul>
                                    <li><a href="<?php echo home_url(); ?>/trillium/classes">List Classes</a></li>
                                </ul>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-9 col-lg-9" role="main">
                <h1><?php echo $class_code; ?></h1>
                <!-- CONTENT -->
                <div class="description">
                    <div class="description-text">
                        <p><a href="../enrolments-email-list/?class-code=<?php echo $class_code ?>">View comma-separated list of email addresses</a></p>
                    </div>
                    <div class="download-buttons" style="float:right">
                        <span id="button-copy" class="nav-item"></span>
                        <span id="button-csv" class="nav-item"></span>
                        <span id="button-pdf" class="nav-item"></span>
                    </div>
                </div>

                <table id="sample-data-table" class="table">
                    <thead>
                        <tr>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Last Name</span>
                                </div>
                            </th>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">First Name</span>
                                </div>
                            </th>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Sortable Name</span>
                                </div>
                            </th>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Full Name</span>
                                </div>
                            </th>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Email</span>
                                </div>
                            </th>
                            <th class="secondary-text">
                                <div class="table-header">
                                    <span class="column-title">Student Number</span>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($enrolments as $enrolment) {
                            ?>
                            <tr>
                                <td><?php echo $enrolment->student_last_name; ?></td>
                                <td><?php echo $enrolment->student_first_name; ?></td>
                                <td><?php echo $enrolment->student_last_name; ?>, <?php echo $enrolment->student_first_name; ?></td>
                                <td><?php echo $enrolment->student_first_name; ?> <?php echo $enrolment->student_last_name; ?></td>
                                <td><?php echo $enrolment->student_email; ?></td>
                                <td><?php echo $enrolment->student_number; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <!-- CONTENT -->
            </div>
        </div>
    </div>
<?php } ?>

<?php get_footer();
