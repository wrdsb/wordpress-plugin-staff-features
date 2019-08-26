<?php
$id = $wp_query->query_vars['id'];
$schoolCode = get_option('wrdsb_school_code');
$pageTitle = "Day Parts";
$functionKey = CMA_DAY_PART_QUERY_KEY;

function setCustomTitle()
{
    $pageTitle = "Day Parts";
    return $pageTitle;
}
add_filter('pre_get_document_title', 'setCustomTitle');

$body = array(
    'schoolCode' => $schoolCode,
    'id' => $id,
);

$url = "https://wrdsb-cma.azurewebsites.net/api/day-part-query?code={$functionKey}";
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

$dayPart = $response_object[0];
?>

<div>
    <strong>CMA ID: </strong>
    <?php echo $dayPart->id; ?>
</div>

<div>
    <strong>School Code: </strong>
    <?php echo $dayPart->schoolCode; ?>
</div>

<div>
    <strong>Day Part Set: </strong>
    <?php echo $dayPart->set; ?>
</div>

<div>
    <strong>Label: </strong>
    <?php echo $dayPart->label; ?>
</div>

<div>
    <strong>Start Time: </strong>
    <?php echo $dayPart->startTime; ?>
</div>

<div>
    <strong>End Time: </strong>
    <?php echo $dayPart->endTime; ?>
</div>

<div>
    <strong>1st Half Start: </strong>
    <?php echo $dayPart->firstHalfStartTime; ?>
</div>

<div>
    <strong>1st Half End: </strong>
    <?php echo $dayPart->firstHalfEndTime; ?>
</div>

<div>
    <strong>2nd Half Start: </strong>
    <?php echo $dayPart->secondHalfStartTime; ?>
</div>

<div>
    <strong>2nd Half End: </strong>
    <?php echo $dayPart->secondHalfEndTime; ?>
</div>

