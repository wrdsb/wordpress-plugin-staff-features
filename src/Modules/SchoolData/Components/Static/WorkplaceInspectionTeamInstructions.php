<?php
namespace WRDSB\Staff\Modules\SchoolData\Components;
use WRDSB\Staff\Modules\WP\WPCore as WPCore;

$page_title = "Workplace Inspection Team Instructions";

function setCustomTitle() {
    $page_title = "Workplace Inspection Team Instructions";
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
                    <a href="<?php echo WPCore::homeURL(); ?>/school-data/workplace-inspection-team/">Workplace Inspection Team</a>
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

                <p>The purpose of the WIT is to perform monthly inspections and to assist the school Administration and staff with maintaining a safe and healthy workplace.</p>

                <h2>Elementary Schools &amp; Smaller Workplaces</h2>

                <p>All elementary schools and smaller workplaces shall be inspected once a month.  At least one worker member of the WIT conducts this inspection.  It is recommended that the school administrator attend as many inspections as possible throughout the year.  The total workplace shall be inspected by all members of the WIT at least once a year.  Please note:  A total workplace inspection includes the external property of the school site (i.e. entrances, exits, pathways, play equipment, fields, and other locations where staff may be present on-site).</p>

                <h2>Secondary Schools &amp; the Education Centre</h2>

                <p>All secondary schools and the Education Centre shall be inspected at least once a year in its entirety, inspecting at least a portion of the workplace each month.  High risk areas such as science prep rooms, technical shops and boiler rooms must be inspected once every three months as part of the regularly scheduled inspections. Please note:  A total workplace inspection includes the external property of the school site (i.e. entrances, exits, pathways, play equipment, fields, and other locations where staff may be present on-site).</p>

                <p>Please list the names and affiliation of the members of your Workplace Inspection Team (typically composed of 3-5 members including an administrator, the custodian and a teacher or other staff members).</p>

                <p><strong>The first name will be the sites worker health and safety contact otherwise known as the “Auxiliary Member”.  He/She will receive all health and safety correspondence and/or be contacted by the Health, Safety and Security department or the JHSC Co-Chairs, if needed.</strong></p>
                <!-- /CONTENT -->
            </div>
        </div>
    </div>
<?php } ?>

<?php WPCore::getFooter();
