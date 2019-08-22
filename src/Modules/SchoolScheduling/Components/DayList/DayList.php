<?php
$body = array(
    'schoolCode' => $schoolCode
);

$days = array();
?>

<table>
    <thead>
        <tr>
            <th>Date</th>
            <th>Day Template</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($days as $day) { ?>
            <tr>
                <td><?php echo $day->date; ?></td>
                <td><?php echo $day->dayTemplate; ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>
