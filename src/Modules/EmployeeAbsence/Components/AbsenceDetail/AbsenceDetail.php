<?php
use \WRDSB\Staff\Modules\EmployeeAbsence\Model\Absence as Absence;

$absence_id = get_query_var('employee-absence-id');
$user_id = get_query_var('user');
$date    = get_query_var('date');

$absence = Absence::find($absence_id);
?>

<h1>Employee Absence Detail</h1>

<?php print_r($absence); ?>
