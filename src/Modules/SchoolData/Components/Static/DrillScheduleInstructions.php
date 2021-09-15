<?php
namespace WRDSB\Staff\Modules\SchoolData\Components;
use WRDSB\Staff\Modules\WP\WPCore as WPCore;
use WRDSB\Staff\Modules\SchoolData\SchoolDataModule as Module;

$page_title = "Drill Schedule Instructions";

function setCustomTitle() {
    $page_title = "Drill Schedule Instructions";
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
                    <a href="<?php echo WPCore::homeURL(); ?>/school-data/drill-schedule/">Drill Schedule</a>
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

                <p>Refer to <a href="https://staff.wrdsb.ca/policyprocedure/?page_id=146">Administrative Procedure #3050 - Fire Drills</a> and <a href="https://staff.wrdsb.ca/policyprocedure/?page_id=304">Police Protocol - Appendix G</a>.</p>

                <p>Each school is required to perform a total of six (6) fire drills per school year (3 in the Fall term and 3 in the Spring term).  One (1) of the fire drills must be a combined fire/bomb threat drill to meet the requirements of the Ministry of Education and set forth in the updated Police Protocol (Appendix G).</p>

                <p>All schools must provide scheduled dates and times of their five (5) fire drills and one (1) combination fire/bomb drill. The local fire departments have requested this information in hopes to support the schools by arranging for Fire Prevention Officers to be present during the drills. Drill dates and times are collected by central administration at the beginning of each school year using this electronic survey collection tool and then forwarded to the local fire departments by Health, Safety &amp; Security.</p>

                <p>Drills may be held in the morning or the afternoon, ensuring one drill is done per term in both the morning and afternoon.  It is strongly suggested that administrators consider performing the fire drills during different times of the day and without prior notice to school staff and students (to emulate a real emergency situation).  Records of all drills must be retained at the school. </p>

                <p><b>Extended Day:</b> Because the Extended Day program does not operate during regular school hours, six (6) independent drills (using a whistle) must also be done separately for all classrooms in use.</p>

                <p><b>Summer Term</b>: Fire drills must be performed at least monthly during the summer school term if the school is in operation.</p>

                <p class="note">Once this information has been collected and shared with the fire departments, any changes to these dates/times are to be communicated directly to your school’s local fire department by the school and/or administrator.</p>
                <!-- /CONTENT -->
            </div>
        </div>
    </div>
<?php } ?>

<?php WPCore::getFooter();
