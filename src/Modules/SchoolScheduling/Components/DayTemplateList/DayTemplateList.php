<?php
$body = array(
    'schoolCode' => $schoolCode
);

$dayTemplates = array();
?>

<table>
    <thead>
        <tr>
            <th>Label</th>
            <th>Day Slots</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($dayTemplates as $dayTemplate) { ?>
            <tr>
                <td><?php echo $dayTemplate->label; ?></td>
                <td><?php implode(", ", $dayTemplate->daySlots); ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>