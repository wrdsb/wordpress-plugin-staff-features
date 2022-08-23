<?php
namespace WRDSB\Staff\Modules\SchoolData\Components;
use WRDSB\Staff\Modules\WP\WPCore as WPCore;
use WRDSB\Staff\Modules\SchoolData\SchoolDataModule as Module;
use WRDSB\Staff\Modules\SchoolData\Components\Partials\PermissionDenied as PermissionDenied;

$page_title = "School Data Collection";

function setCustomTitle() {
    $page_title = "School Data Collection";
    return $page_title;
}
WPCore::addFilter('pre_get_document_title', '\WRDSB\Staff\Modules\SchoolData\Components\setCustomTitle');
?>

<?php WPCore::getHeader(); ?>

<div class="container-top">
    <?php WPCore::getTemplatePart('partials/header', 'masthead'); ?>

    <?php if (! Module::userCanViewGuard()) { ?>
        <?php WPCore::getTemplatePart('partials/content', 'unauthorized'); ?>
    <?php } else { ?>
        <?php WPCore::getTemplatePart('partials/header', 'navbar'); ?>

        <div class="container container-breadcrumb" role="navigation">
            <ol class="breadcrumb">
                <li>
                    <a href="<?php echo WPCore::getOption('home'); ?>">Home</a>
                </li>
                <li>
                    <a href="<?php echo WPCore::homeURL(); ?>/school-data/home">School Data</a>
                </li>
                <li>
                    <?php echo $page_title; ?>
                </li>
            </ol>
        </div>
    <?php } ?>
</div>

<?php if (Module::userCanViewGuard()) { ?>
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
                            <span><a href="<?php echo WPCore::homeURL(); ?>/school-data/home">School Data</a></span>
                        </div>
                        <div class="sub-menu-items">
                            <ul>
                                <ul>
                                    <li><a href="<?php echo WPCore::homeURL(); ?>/school-data/drill-schedule/">Drill Schedule</a></li>
                                    <li><a href="<?php echo WPCore::homeURL(); ?>/school-data/emergency-response-team/">Emergency Response Team</a></li>
                                    <li><a href="<?php echo WPCore::homeURL(); ?>/school-data/evacuation-sites/">Evacuation Sites</a></li>
                                    <li><a href="<?php echo WPCore::homeURL(); ?>/school-data/iprc/">IPRC</a></li>
                                    <li><a href="<?php echo WPCore::homeURL(); ?>/school-data/scis-team">SCIS Team</a></li>
                                    <li><a href="<?php echo WPCore::homeURL(); ?>/school-data/workplace-inspection-team/">Workplace Inspection Team</a></li>
                                </ul>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-9 col-lg-9" role="main">
                <!-- CONTENT -->
				<h1><?php echo $page_title; ?></h1>

                <p>School Data includes team composition, dates for fire and bomb drills and evacuation sites.</p>


                <?php if (Module::userCanEditGuard()) { ?>

                <p>Each school year, Principals are required to submit the following information relating to their schools:</p>
                
                <ul>
                    <li>Emergency Response Team</li>
                    <li>Evacuation Site Information</li>
                    <li>Fire Drill and Fire/Bomb Threat &ndash; drill dates and times for local Fire Departments</li>
                    <li>Health &amp; Safety – Workplace Inspection Team</li>
                    <li>Identification, Placement and Review Committee Membership</li>
                    <li>Safe, Caring, and Inclusive Schools</li>
                </ul>
                
                <p><strong>This information is due by Friday, Sept. 16, 2022.</strong></p>

                <p>To update the information for any collection of data, go to that data page and choose the "Update this Information" button and change the data. This button is only visible to you.</p>

                <p>If you do not wish to change the data after starting, choose "Cancel Update".</p>

                <p>To complete updating the information, choose "Update" at the bottom of each form. The updates will be live the moment you choose "Update".</p>

                <p>If you have requests or feedback, please send in a ticket to <a href="https://itservicedesk.wrdsb.ca/" target="_blank" rel="noopener">ITService Desk</a>!</p>

                <p>For questions regarding the collection of data itself, please contact Julianne Amaral, ext. 4208 for assistance.</p>


                <?php } ?>
				
                <!-- /CONTENT -->
            </div>
        </div>
    </div>
<?php } ?>

<?php WPCore::getFooter();
