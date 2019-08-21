<?php
    $user_id = get_query_var('user');
    $date = get_query_var('date');

    echo 'Employee Absence Edit works!';
?>
<div>User: <?php echo $user_id ?></div>
<div>Date: <?php echo $date ?></div>