<?php
$template_title = "";
$body = array(
    'schoolCode' => $schoolCode
);

$url = '';
$args = array(
    'timeout'     => 5,
    'redirection' => 5,
    'httpversion' => '1.0',
    'user-agent'  => 'cma/wordpress',
    'blocking'    => true,
    'headers'     => array(
        'Accept' => 'application/json',
        'Content-Type' => 'application/json',
        'api-key' => WRDSB_CMA_SERVICE_KEY
    ),
    'cookies'     => array(),
    'body'        => json_encode($body),
    'compress'    => false,
    'decompress'  => true,
    'sslverify'   => false,
    'stream'      => false,
    'filename'    => null
);
//$response = wp_remote_post($url, $args);
//$response_object = json_decode($response['body'], $assoc = false);

//$daySlots = $response_object;
?>

<?php get_header(); ?>

<div class="container container-top">
    <?php
        get_template_part('partials/header', 'masthead');
        get_template_part('partials/header', 'navbar');
    ?>
    <div class="container container-breadcrumb" role="navigation">
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo get_option('home'); ?>">Home</a>
            </li>
            <li>
                School Scheduling
            </li>
            <li>
                <?php echo $template_title; ?>
            </li>
        </ol>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-sm-12 col-lg-12" role="main">
            <!-- CONTENT -->
            <table width="100%">
                <thead>
                    <tr>
                        <th>Label</th>
                        <th>Set<th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th colspan="2">1st Half</th>
                        <th colspan="2">2nd Half</th>
                    </tr>
                    <tr>
                        <th>&nbsp;</th>
                        <th>&nbsp;<th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                        <th>Start</th>
                        <th>End</th>
                        <th>Start</th>
                        <th>End</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($daySlots as $daySlot) { ?>
                        <tr>
                            <td><?php echo $daySlot->set; ?></td>
                            <td><?php echo $daySlot->label; ?></td>
                            <td><?php echo $daySlot->startTime; ?></td>
                            <td><?php echo $daySlot->endTime; ?></td>
                            <td><?php echo $daySlot->firstHalfStartTime; ?></td>
                            <td><?php echo $daySlot->firstHalfEndTime; ?></td>
                            <td><?php echo $daySlot->secondHalfStartTime; ?></td>
                            <td><?php echo $daySlot->secondHalfEndTime; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php get_footer();
