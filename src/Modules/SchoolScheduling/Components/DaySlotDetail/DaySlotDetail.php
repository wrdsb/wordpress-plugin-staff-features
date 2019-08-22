<?php
$body = array(
    'schoolCode' => $schoolCode,
    'id' => ''
);

$daySlot;
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

