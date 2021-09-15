<?php
namespace WRDSB\Staff\Modules\SchoolData\Components;
use WRDSB\Staff\Modules\WP\WPCore as WPCore;
use WRDSB\Staff\Modules\SchoolData\SchoolDataModule as Module;

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
                    <a href="<?php echo WPCore::homeURL(); ?>/school-data/evacuation-sites/">Evacuation Sites</a>
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

				<div class="announcement">Data Collection is closed for the 2020/2021 school year. If you have changes to your teams, please contact Mary Hingley directly (via email or ext. 4438).</div>

				<h2>Prepare Your Teams</h2>
				<div class="alert alert-info">
				    <p>If you need to leave the form before you finish entering your team information, you will now have the ability to save your progress and return to the form at a more convenient time.</p>
				    <p>Begin entering your School Teams data by choosing the appropriate Team tab above and completing the information. You will then have an option to either save your progress or submit.</p>
    				<p>If you save your progress, you can reload your saved data by hovering over the data in the <strong>Edit previously saved data</strong> box and click on the <strong>Load</strong> link that appears to the right.</p>
				    <p>Once a team is submitted, it cannot be edited. Please contact Mary Hingley (via email or ext. 4438) with the necessary changes.</p>
				</div>
				<p>Each school year, Principals are required to submit the following information relating to their schools:</p>
				<ul>
					<li><a href="https://staff.wrdsb.ca/school-teams/ert/">Emergency Response Team</a></li>
					<li><a href="https://staff.wrdsb.ca/school-teams/evacuation-sites/">Evacuation Site Information</a></li>
					<li><a href="https://staff.wrdsb.ca/school-teams/fire-bomb-drill/">Fire Drill and Fire/Bomb Threat</a> drill dates and times for local Fire Departments</li>
					<li>Health &amp; Safety – <a href="https://staff.wrdsb.ca/school-teams/wit/">Workplace Inspection Team</a>
				<ul>
					<li>Please have the members of the WIT identify a worker health and safety contact (‘Auxiliary Member’) for the site</li>
				</ul>
				</li>
					<li><a href="https://staff.wrdsb.ca/school-teams/iprc/">Identification, Placement and Review Committee</a> Membership</li>
					<li><a href="https://staff.wrdsb.ca/school-teams/scis/">Safe, Caring, and Inclusive Schools</a></li>
				</ul>
				<p><strong>This information is due by Friday, Sept. 18, 2020. </strong> Please contact <a href="mailto:mary_hingley@wrdsb.ca">Mary Hingley</a>, ext. 4438, if you have difficulty accessing the reporting tool.</p>
                <!-- /CONTENT -->
            </div>
        </div>
    </div>
<?php } ?>

<?php WPCore::getFooter();
