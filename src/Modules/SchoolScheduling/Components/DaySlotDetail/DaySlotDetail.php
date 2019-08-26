<?php
$id = $wp_query->query_vars['id'];
$schoolCode = get_option('wrdsb_school_code');
$pageTitle = "Day Slots";
$functionKey = CMA_DAY_SLOT_QUERY_KEY;

function setCustomTitle()
{
    $pageTitle = "Day Slots";
    return $pageTitle;
}
add_filter('pre_get_document_title', 'setCustomTitle');

$body = array(
    'schoolCode' => $schoolCode,
    'id' => $id,
);

$url = "https://wrdsb-cma.azurewebsites.net/api/day-slot-query?code={$functionKey}";
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

$daySlot = $response_object[0];
?>

<div>
    <strong>CMA ID: </strong>
    <?php echo $daySlot->id; ?>
</div>

<div>
    <strong>School Code: </strong>
    <?php echo $daySlot->schoolCode; ?>
</div>

<div>
    <strong>Day Slot Set: </strong>
    <?php echo $daySlot->set; ?>
</div>

<div>
    <strong>Label: </strong>
    <?php echo $daySlot->label; ?>
</div>

<div>
    <strong>Start Time: </strong>
    <?php echo $daySlot->startTime; ?>
</div>

<div>
    <strong>End Time: </strong>
    <?php echo $daySlot->endTime; ?>
</div>

<div>
    <strong>1st Half Start: </strong>
    <?php echo $daySlot->firstHalfStartTime; ?>
</div>

<div>
    <strong>1st Half End: </strong>
    <?php echo $daySlot->firstHalfEndTime; ?>
</div>

<div>
    <strong>2nd Half Start: </strong>
    <?php echo $daySlot->secondHalfStartTime; ?>
</div>

<div>
    <strong>2nd Half End: </strong>
    <?php echo $daySlot->secondHalfEndTime; ?>
</div>

