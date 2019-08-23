<?php
$school_code = get_option('wrdsb_school_code');
$page_title = 'Classes';

function setCustomTitle()
{
    return 'Classes';
}
add_filter('pre_get_document_title', 'setCustomTitle');


global $wp_version;
$url = 'https://wrdsb-codex.search.windows.net/indexes/skinner-classes/docs/search?api-version=2016-09-01';
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
        "filter"  => "school_code eq '{$school_code}'",
        "search"  => "*",
        "select"  => "*",
        "orderby" => "class_code",
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
$classes = $response_object->value;
$classes_count = $response_object->{'@odata.count'};
$page_min = 1;
$page_max = count($classes);
$pages = 1;

while ($classes_count > $page_max) {
    $body = json_decode($args['body'], $assoc = true);
    $body["skip"] = $pages * 1000;
    $args['body'] = json_encode($body);
    $response = wp_remote_post($url, $args);
    $response_object = json_decode($response['body'], $assoc = false);
    $classes = array_merge($classes, $response_object->value);
    $page_max = count($classes);
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
        <div class="col-sm-8 col-lg-8" role="main">
            <!-- CONTENT -->
            <ul>
            <?php
            foreach ($classes as $class) {
                echo '<li><a href="../enrolments/?class-code=' . $class->class_code . '">' . $class->class_code . '</a></li>';
            }
            ?>
            </ul>
            <!-- CONTENT -->
            </div>
    </div>
</div>

<?php get_footer();
