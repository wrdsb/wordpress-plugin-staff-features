<?php
namespace WRDSB\Staff\Modules\Quartermaster\Model;
use WRDSB\Staff\Modules\WP\WPCore as WPCore;
use WRDSB\Staff\Modules\Quartermaster\QuartermasterModule as Module;

$apiKey = Module::getCodexSearchKey();
$schoolCode = strtoupper(WPCore::getOption('wrdsb_school_code'));
$accessTime = WPCore::currentTime();
$pageTitle = "Returned Assets";
$currentUser = WPCore::getCurrentUser();
$userIsAdmin = (WPCore::currentUserCan('setup_network') || WPCore::currentUserCan('manage_options')) ? true : false;

$enabledFor = ['DSPS', 'WSS'];
if (!in_array($schoolCode, $enabledFor)) {
    $url = WPCore::homeURL() . '/quartermaster/device-loans/returned';
    WPCore::wpRedirect($url);
}

function setCustomTitle()
{
    $pageTitle = "Returned Assets";
    return $pageTitle;
}
WPCore::addFilter('pre_get_document_title', '\WRDSB\Staff\Modules\Quartermaster\Components\setCustomTitle');

global $wp_version;
$url = 'https://wrdsb-codex.search.windows.net/indexes/quartermaster-asset-assignments/docs/search?api-version=2016-09-01';
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
        "filter"  => "assignedFromLocation eq '{$schoolCode}' and wasReturned eq true and deleted ne true",
        "search"  => "*",
        "select"  => "*",
        "orderby" => "assignedToPerson",
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
$assignments = $response_object->value;
$assignments_count = $response_object->{'@odata.count'};
$page_min = 1;
$page_max = count($assignments);
$pages = 1;

while ($assignments_count > $page_max) {
    $body = json_decode($args['body'], $assoc = true);
    $body["skip"] = $pages * 1000;
    $args['body'] = json_encode($body);
    $response = WPCore::wpRemotePost($url, $args);
    $response_object = json_decode($response['body'], $assoc = false);
    $assignments = array_merge($assignments, $response_object->value);
    $page_max = count($assignments);
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
                    <a href="<?php echo WPCore::homeURL(); ?>/quartermaster/asset-assignments/all">Asset Assignments</a>
                </li>
                <li>
                    <?php echo $pageTitle; ?>
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
                            <span><a href="<?php echo WPCore::homeURL(); ?>/quartermaster/asset-assignments/all">Asset Assignments</a></span>
                        </div>
                        <div class="sub-menu-items">
                            <ul><ul>
                                    <li><a href="<?php echo WPCore::homeURL(); ?>/quartermaster/asset-assignment/new">Create New Asset Assignment</a></li>
                                    <li><a href="<?php echo WPCore::homeURL(); ?>/quartermaster/asset-assignments/all">View All Asset Assignments</a></li>
                                    <li><a href="<?php echo WPCore::homeURL(); ?>/quartermaster/asset-assignments/active">View Active Asset Assignments</a></li>
                                    <li><a href="<?php echo WPCore::homeURL(); ?>/quartermaster/asset-assignments/returned">View Returned Assets</a></li>
                            </ul></ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-9 col-lg-9" role="main">
                <h1><?php echo $pageTitle; ?></h1>
                <!-- CONTENT -->
                <div class="description">
                    <div class="download-buttons" style="float:right">
                        <span id="button-copy" class="nav-item"></span>
                        <span id="button-csv" class="nav-item"></span>
                        <span id="button-pdf" class="nav-item"></span>
                    </div>
                </div>
                <table id="quartermaster-data-table" class="table" width="100%">
                    <thead>
                        <tr>
                            <th class="secondary-text">
                                <div class="table-header">
                                    Assigned To
                                </div>
                            </th>
                            <th class="secondary-text">
                                <div class="table-header">
                                    Asset Type
                                </div>
                            </th>
                            <th class="secondary-text">
                                <div class="table-header">
                                    Asset ID
                                </div>
                            </th>
                            <th class="secondary-text">
                                <div class="table-header">
                                    Assigned
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
                        <?php foreach ($assignments as $assignment) { ?>
                            <?php $id = $assignment->id; ?>
                            <?php echo '<tr id="'.$id.'-row">'; ?>
                                <td onclick="location.href='<?php echo WPCore::homeURL(); ?>/quartermaster/asset-assignment/<?php echo $id; ?>';" style="cursor: pointer;">
                                    <?php echo $assignment->assignedToPerson; ?>
                                </td>
                                <td onclick="location.href='<?php echo WPCore::homeURL(); ?>/quartermaster/asset-assignment/<?php echo $id; ?>';" style="cursor: pointer;">
                                    <?php echo $assignment->assetType; ?>
                                </td>
                                <td onclick="location.href='<?php echo WPCore::homeURL(); ?>/quartermaster/asset-assignment/<?php echo $id; ?>';" style="cursor: pointer;">
                                    <?php echo $assignment->assetID; ?>
                                </td>
                                <td onclick="location.href='<?php echo WPCore::homeURL(); ?>/quartermaster/asset-assignment/<?php echo $id; ?>';" style="cursor: pointer;">
                                    <?php echo date("F j, Y", strtotime($assignment->createdAt)); ?>
                                </td>
                                <td>
                                    <?php echo ($assignment->wasReturned == true) ? date("F j, Y", strtotime($assignment->returnedAt)) : '-'; ?>
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
