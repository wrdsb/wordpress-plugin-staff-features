<?php
$id = $wp_query->query_vars['id'];
$schoolCode = get_option('wrdsb_school_code');
$pageTitle = "Day Templates";
$functionKey = CMA_DAY_TEMPLATE_QUERY_KEY;

function setCustomTitle()
{
    $pageTitle = "Day Templates";
    return $pageTitle;
}
add_filter('pre_get_document_title', 'setCustomTitle');

$body = array(
    'schoolCode' => $schoolCode,
    'id' => $id,
);

$url = "https://wrdsb-cma.azurewebsites.net/api/day-template-query?code={$functionKey}";
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

$dayTemplate = $response_object[0];
?>

<div>
    <strong>CMA ID: </strong>
    <?php echo $dayTemplate->id; ?>
</div>

<div>
    <strong>School Code: </strong>
    <?php echo $dayTemplate->schoolCode; ?>
</div>

<div>
    <strong>Code: </strong>
    <?php echo $dayTemplate->code; ?>
</div>

<div>
    <strong>Label: </strong>
    <?php echo $dayTemplate->label; ?>
</div>

<h2>Day Parts</h2>
<?php foreach ($dayTemplate->dayParts as $dayPart) { ?>
    <div>
        <?php echo $dayPart; ?>
    </div>
<?php } ?>
