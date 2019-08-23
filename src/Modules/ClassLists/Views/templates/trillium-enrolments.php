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
              <?php echo $page_title; ?>
            </li>
        </ol>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-sm-12 col-lg-12" role="main">
            <!-- CONTENT -->

                      <div class="description">
                        <div class="description-text">
                          <h3><?php echo $class_code; ?></h3>
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
            <!-- CONTENT -->
            </div>
    </div>
</div>

<?php get_footer();
