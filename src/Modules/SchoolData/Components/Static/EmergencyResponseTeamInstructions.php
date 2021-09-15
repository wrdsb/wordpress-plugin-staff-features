<?php
namespace WRDSB\Staff\Modules\SchoolData\Components;
use WRDSB\Staff\Modules\WP\WPCore as WPCore;
use WRDSB\Staff\Modules\SchoolData\SchoolDataModule as Module;

$page_title = "Emergency Response Team Instructions";

function setCustomTitle() {
    $page_title = "Emergency Response Team Instructions";
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
                    <a href="<?php echo WPCore::homeURL(); ?>/school-data/emergency-response-team/">Emergency Response Team</a>
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

                <p>Each school must have an <strong>Emergency Response Team</strong> who will take leadership in dealing with <strong>crisis</strong> and emergency situations. The membership of the team should be carefully considered to ensure the team has the requisite skills and training to be effective. In addition to administrative staff, teachers (number determined by needs/size of school) and/or support staff should be members of the team. <strong>The team must have at least one member with current, valid training in CPR and first aid.</strong> It is also recommended that the team include members who have received BMS training.</p>

                <p>The team's planned response, procedures and approaches to crisis should be communicated to all staff so that personnel are comfortable with the planned response to a crisis and each person's role in that response. The principal will ensure that the team and school staff practice the response plan at least once during the school year. (It is important that in the emergency plan, the team can function efficiently and quickly in a situation where the school administrator(s) is/are not on site.)</p>
                <p class="alert alert-warning">Not all members require first aid/medical training; however, at least one team member must be CPR qualified and another must have first aid training.</p>
                <!-- /CONTENT -->
            </div>
        </div>
    </div>
<?php } ?>

<?php WPCore::getFooter();
