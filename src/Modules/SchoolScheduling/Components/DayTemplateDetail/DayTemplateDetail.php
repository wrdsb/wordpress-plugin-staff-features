<?php
$body = array(
    'schoolCode' => $schoolCode,
    'id' => ''
);

$dayTemplate;
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

<h2>Day Slots</h2>
<?php foreach ($dayTemplate->daySlots as $daySlot) { ?>
    <div>
        <?php echo $daySlot; ?>
    </div>
<?php } ?>
