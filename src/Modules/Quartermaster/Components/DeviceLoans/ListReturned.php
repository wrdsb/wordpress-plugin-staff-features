<?php
namespace WRDSB\Staff\Modules\Quartermaster\Model;
use WRDSB\Staff\Modules\WP\WPCore as WPCore;
use WRDSB\Staff\Modules\Quartermaster\QuartermasterModule as Module;

$apiKey = Module::getCodexSearchKey();
$schoolCode = strtoupper(WPCore::getOption('wrdsb_school_code'));
$access_time = WPCore::currentTime();
$page_title = "Returned Devices";
$userIsAdmin = (WPCore::currentUserCan('setup_network') || WPCore::currentUserCan('manage_options')) ? true : false;

function setCustomTitle()
{
    $page_title = "Returned Devices";
    return $page_title;
}
WPCore::addFilter('pre_get_document_title', 'setCustomTitle');

global $wp_version;
$url = 'https://wrdsb-codex.search.windows.net/indexes/quartermaster-device-loan-submissions/docs/search?api-version=2016-09-01';
$args = array(
    'timeout'     => 5,
    'redirection' => 5,
    'httpversion' => '1.0',
    'user-agent'  => 'WordPress/' . $wp_version . '; ' . WPCore::homeURL(),
    'blocking'    => true,
    'headers'     => array(
        'Accept' => 'application/json',
        'Content-Type' => 'application/json',
        'api-key' => $apiKey
    ),
    'cookies'     => array(),
    'body'        => json_encode(array(
        "filter"  => "schoolCode eq '{$schoolCode}' and wasReturned eq true",
        "search"  => "*",
        "select"  => "*",
        "orderby" => "loanedToName",
        "top"     => 1000,
        "count"   => true
    )),
    'compress'    => false,
    'decompress'  => true,
    'sslverify'   => false,
    'stream'      => false,
    'filename'    => null
);

$response = WPCore::wpRemotePost($url, $args);
$response_object = json_decode($response['body'], $assoc = false);
$forms = $response_object->value;
$forms_count = $response_object->{'@odata.count'};
$page_min = 1;
$page_max = count($forms);
$pages = 1;

while ($forms_count > $page_max) {
    $body = json_decode($args['body'], $assoc = true);
    $body["skip"] = $pages * 1000;
    $args['body'] = json_encode($body);
    $response = WPCore::wpRemotePost($url, $args);
    $response_object = json_decode($response['body'], $assoc = false);
    $forms = array_merge($forms, $response_object->value);
    $page_max = count($forms);
    $pages++;
}
?>

<?php WPCore::getHeader(); ?>

<div class="container-top">
    <?php WPCore::getTemplatePart('partials/header', 'masthead'); ?>

    <?php if (! WPCore::currentUserCanViewContent()) { ?>
        <?php WPCore::getTemplatePart('partials/content', 'unauthorized'); ?>
    <?php } else { ?>
        <?php WPCore::getTemplatePart('partials/header', 'navbar'); ?>

        <div class="container container-breadcrumb" role="navigation">
            <ol class="breadcrumb">
                <li>
                    <a href="<?php echo WPCore::getOption('home'); ?>">Home</a>
                </li>
                <li>
                    <a href="<?php echo WPCore::homeURL(); ?>/quartermaster/device-loans/all">Device Loans</a>
                </li>
                <li>
                    <?php echo $page_title; ?>
                </li>
            </ol>
        </div>
    <?php } ?>
</div>

<?php if (WPCore::currentUserCanViewContent()) { ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-3 col-lg-3" role="complementary">
                <div class="navbar my-sub-navbar" id="section_navigation" role="navigation">
                    <div class="sub-navbar-header">
                        <button type="button" class="navbar-toggle toggle-subnav" data-toggle="collapse" data-target=".sub-navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <span class="navbar-brand">Subnav</span>
                    </div>
                    <div class="collapse sub-navbar-collapse">
                        <div class="sub-menu-heading">
                            <span><a href="<?php echo WPCore::homeURL(); ?>/quartermaster/device-loans/all">LFH Device Loans</a></span>
                        </div>
                        <div class="sub-menu-items">
                            <ul><ul>
                                    <li><a href="https://docs.google.com/forms/d/e/1FAIpQLSdjwdzc1parYWphvvyfnuaz4v5cketHMJSa0kvY0dRf7VZI4A/viewform" target="_blank">Create New Device Loan</a></li>
                                    <li><a href="<?php echo WPCore::homeURL(); ?>/quartermaster/device-loans/all">View All Device Loans</a></li>
                                    <li><a href="<?php echo WPCore::homeURL(); ?>/quartermaster/device-loans/active">View Active Device Loans</a></li>
                                    <li><a href="<?php echo WPCore::homeURL(); ?>/quartermaster/device-loans/returned">View Returned Devices</a></li>
                            </ul></ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-9 col-lg-9" role="main">
                <h1><?php echo $page_title; ?></h1>
                <!-- CONTENT -->
                <div class="description">
                    <div class="download-buttons" style="float:right">
                        <span id="button-copy" class="nav-item"></span>
                        <span id="button-csv" class="nav-item"></span>
                        <span id="button-pdf" class="nav-item"></span>
                    </div>
                </div>
                <table id="sample-data-table" class="table" width="100%">
                    <thead>
                        <tr>
                            <th class="secondary-text">
                                <div class="table-header">
                                    Loaned To
                                </div>
                            </th>
                            <th class="secondary-text">
                                <div class="table-header">
                                    Device Type
                                </div>
                            </th>
                            <th class="secondary-text">
                                <div class="table-header">
                                    Asset ID
                                </div>
                            </th>
                            <th class="secondary-text">
                                <div class="table-header">
                                    Loaned
                                </div>
                            </th>
                            <th class="secondary-text">
                                <div class="table-header">
                                    Returned
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($forms as $form) { ?>
                            <?php $parts = explode(",", $form->powerAppsId); ?>
                            <?php $id = $parts[0]; ?>
                            <?php echo '<tr id="'.$id.'-row">'; ?>
                                <td width="20%" onclick="location.href='<?php echo WPCore::homeURL(); ?>/quartermaster/device-loan/<?php echo $id; ?>';" style="cursor: pointer;">
                                    <?php echo $form->loanedToName; ?>
                                </td>
                                <td onclick="location.href='<?php echo WPCore::homeURL(); ?>/quartermaster/device-loan/<?php echo $id; ?>';" style="cursor: pointer;">
                                    <?php echo $form->deviceType; ?>
                                </td>
                                <td onclick="location.href='<?php echo WPCore::homeURL(); ?>/quartermaster/device-loan/<?php echo $id; ?>';" style="cursor: pointer;">
                                    <?php echo $form->correctedAssetID; ?>
                                </td>
                                <td onclick="location.href='<?php echo WPCore::homeURL(); ?>/quartermaster/device-loan/<?php echo $id; ?>';" style="cursor: pointer;">
                                    <?php echo date("F j, Y", strtotime($form->timestamp)); ?>
                                </td>
                                <td>
                                    <?php echo ($form->wasReturned == true) ? date("F j, Y", strtotime($form->returnedAt)) : '-'; ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <!-- /CONTENT -->
            </div>
        </div>
    </div>
<?php } ?>

<?php WPCore::getFooter();
