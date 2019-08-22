<?php
$body = array(
    'schoolCode' => $schoolCode
    'id' => '',
    'date' => ''
);

$day;
?>

<div>
    <strong>Date: </strong>
    <?php echo $day->date; ?>
</div>

<div>
    <strong>School Code: </strong>
    <?php echo $day->schoolCode; ?>
</div>

<div>
    <strong>Day Template: </strong>
    <?php echo $day->dayTemplate; ?>
</div>
