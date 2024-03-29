<?php
namespace WRDSB\Staff\Modules\SchoolData\Components;
use WRDSB\Staff\Modules\WP\WPCore as WPCore;
use WRDSB\Staff\Modules\SchoolData\Components\Partials\PermissionDenied as PermissionDenied;
use WRDSB\Staff\Modules\SchoolData\SchoolDataModule as Module;
use WRDSB\Staff\Modules\SchoolData\Model\EvacuationSites as Model;

//$apiKey = Module::getCodexSearchKey();
$schoolCode = strtoupper(Module::getSchoolCode());
$current_user = WPCore::getCurrentUser();
$current_time = WPCore::currentTime();
$currentInstance = Model::getInstance();

$page_title = "Evacuation Sites";

function setCustomTitle() {
    $page_title = "Evacuation Sites";
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

<div class="container">
    <div class="row">
        <?php if (!Module::userCanViewGuard()) { ?>
            <?php //echo PermissionDenied::cannotView(); ?>

        <?php } else { ?>
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
                <?php if (Module::userCanEditGuard()) { ?>
                    <p><button onclick="location.href='./edit/';"><a href="./edit/">Update this Information</a></button></p>
                <?php } ?>

				<p class="alert alert-info"><strong>All schools</strong> must provide alternate evacuation site(s) information to be used in case of emergencies.</p>

				<!--<p>Please review the <a href="<?php echo WPCore::homeURL(); ?>/school-data/evacuation-sites/instructions">Evacuation Sites Instructions</a>.</p>-->
				
                <form id="viewEvacuationSites">
                    <input type="hidden" id="blogID" name="blogID" value="<?php echo WPCore::getCurrentBlogID(); ?>">
                    <input type="hidden" id="schoolCode" name="schoolCode" value="<?php echo $schoolCode; ?>">
                    <input type="hidden" id="email" name="email" value="<?php echo $current_user->user_email ?>">
					<input type="hidden" id="postID" name="postID" value="<?php echo $currentInstance->getID(); ?>">

					<p>Fields marked with <span class="required">*</span> are required.</p>
					
					<label for="no-evac" id="label-no-evac">This location has no evacuation site</label>
					<input id="no-evac" name="no-evac" type="checkbox" value="1" aria-labelledby="label-no-evac">

					<fieldset>
						<legend>Site 1</legend>
						<label for="site-1-name" id="label-site-1-name"><span class="sr-only">Site 1 </span>Name</label>
						<input disabled type="text" value="<?php echo $currentInstance->getSite1Name(); ?>" id="site-1-name" name="site1Name" aria-invalid="false" aria-labelledby="label-site-1-name"><br />
						<label for="site-1-address" id="label-site-1-address"><span class="sr-only">Site 1 </span>Address</label>
						<input disabled type="text" value="<?php echo $currentInstance->getSite1Address(); ?>" id="site-1-address" name="site1Address" aria-invalid="false" aria-labelledby="label-site-1-address">
						<label for="site-1-city" id="label-site-1-city"><span class="sr-only">Site 1 </span>City</label>
						<input disabled type="text" value="<?php echo $currentInstance->getSite1City(); ?>" id="site-1-city" name="site1City" aria-invalid="false" aria-labelledby="label-site-1-city">
						<label for="site-1-postal-code" id="label-site-1-postal-code"><span class="sr-only">Site 1 </span>Postal Code</label>
						<input disabled type="text" value="<?php echo $currentInstance->getSite1PostalCode(); ?>" id="site-1-postal-code" name="site1PostalCode" aria-invalid="false" aria-labelledby="label-site-1-postal-code"><br />
						<label for="site-1-firstname" id="label-site-1-firstname"><span class="sr-only">Site 1 </span>Contact Firstname</label>
						<input disabled type="text" value="<?php echo $currentInstance->getSite1Firstname(); ?>" id="site-1-firstname" name="site1Firstname" aria-invalid="false" aria-labelledby="label-site-1-firstname">
						<label for="site-1-lastname" id="label-site-1-lastname"><span class="sr-only">Site 1 </span>Contact Lastname</label>
						<input disabled type="text" value="<?php echo $currentInstance->getSite1Lastname(); ?>" id="site-1-lastname" name="site1Lastname" aria-invalid="false" aria-labelledby="label-site-1-lastname"><br />
						<label for="site-1-phone" id="label-site-1-phone"><span class="sr-only">Site 1 </span>Contact Phone</label>
						<input disabled type="text" value="<?php echo $currentInstance->getSite1Phone(); ?>" id="site-1-phone" name="site1Phone" aria-invalid="false" aria-labelledby="label-site-1-phone"><br />
						<label for="site-1-hours-start" id="label-site-1-hours-start"><span class="sr-only">Site 1 </span>Hours Available (start)</label>
						<input disabled type="time" value="<?php echo $currentInstance->getSite1HoursStart(); ?>" id="site-1-hours-start" name="site1HoursStart" aria-invalid="false" aria-labelledby="label-site-1-hours-start"><br />
						<label for="site-1-hours-end" id="label-site-1-hours-end"><span class="sr-only">Site 1 </span>Hours Available (end)</label>
						<input disabled type="time" value="<?php echo $currentInstance->getSite1HoursEnd(); ?>" id="site-1-hours-end" name="site1HoursEnd" aria-invalid="false" aria-labelledby="label-site-1-hours-end">
					</fieldset>

					<fieldset>
						<legend>Site 2</legend>
						<label for="site-2-name" id="label-site-2-name"><span class="sr-only">Site 2 </span>Name</label>
						<input disabled type="text" value="<?php echo $currentInstance->getSite2Name(); ?>" id="site-2-name" name="site2Name" aria-invalid="false" aria-labelledby="label-site-2-name"><br />
						<label for="site-2-address" id="label-site-2-address"><span class="sr-only">Site 2 </span>Address</label>
						<input disabled type="text" value="<?php echo $currentInstance->getSite2Address(); ?>" id="site-2-address" name="site2Address" aria-invalid="false" aria-labelledby="label-site-2-address">
						<label for="site-2-city" id="label-site-2-city"><span class="sr-only">Site 2 </span>City</label>
						<input disabled type="text" value="<?php echo $currentInstance->getSite2City(); ?>" id="site-2-city" name="site2City" aria-invalid="false" aria-labelledby="label-site-2-city">
						<label for="site-2-postal-code" id="label-site-2-postal-code"><span class="sr-only">Site 2 </span>Postal Code</label>
						<input disabled type="text" value="<?php echo $currentInstance->getSite2PostalCode(); ?>" id="site-2-postal-code" name="site2PostalCode" aria-invalid="false" aria-labelledby="label-site-2-postal-code"><br />
						<label for="site-2-firstname" id="label-site-2-firstname"><span class="sr-only">Site 2 </span>Contact Firstname</label>
						<input disabled type="text" value="<?php echo $currentInstance->getSite2Firstname(); ?>" id="site-2-firstname" name="site2Firstname" aria-invalid="false" aria-labelledby="label-site-2-firstname">
						<label for="site-2-lastname" id="label-site-2-lastname"><span class="sr-only">Site 2 </span>Contact Lastname</label>
						<input disabled type="text" value="<?php echo $currentInstance->getSite2Lastname(); ?>" id="site-2-lastname" name="site2Lastname" aria-invalid="false" aria-labelledby="label-site-2-lastname"><br />
						<label for="site-2-phone" id="label-site-2-phone"><span class="sr-only">Site 2 </span>Contact Phone</label>
						<input disabled type="text" value="<?php echo $currentInstance->getSite2Phone(); ?>" id="site-2-phone" name="site2Phone" aria-invalid="false" aria-labelledby="label-site-2-phone"><br />
						<label for="site-2-hours-start" id="label-site-2-hours-start"><span class="sr-only">Site 2 </span>Hours Available (start)</label>
						<input disabled type="time" value="<?php echo $currentInstance->getSite2HoursStart(); ?>" id="site-2-hours-start" name="site2HoursStart" aria-invalid="false" aria-labelledby="label-site-2-hours-start"><br />
						<label for="site-2-hours-end" id="label-site-2-hours-end"><span class="sr-only">Site 2 </span>Hours Available (end)</label>
						<input disabled type="time" value="<?php echo $currentInstance->getSite2HoursEnd(); ?>" id="site-2-hours-end" name="site2HoursEnd" aria-invalid="false" aria-labelledby="label-site-2-hours-end">
					</fieldset>

					<fieldset>
						<legend>Site 3</legend>
						<label for="site-3-name" id="label-site-3-name"><span class="sr-only">Site 3 </span>Name</label>
						<input disabled type="text" value="<?php echo $currentInstance->getSite3Name(); ?>" id="site-3-name" name="site3Name" aria-invalid="false" aria-labelledby="label-site-3-name"><br />
						<label for="site-3-address" id="label-site-3-address"><span class="sr-only">Site 3 </span>Address</label>
						<input disabled type="text" value="<?php echo $currentInstance->getSite3Address(); ?>" id="site-3-address" name="site3Address" aria-invalid="false" aria-labelledby="label-site-3-address">
						<label for="site-3-city" id="label-site-3-city"><span class="sr-only">Site 3 </span>City</label>
						<input disabled type="text" value="<?php echo $currentInstance->getSite3City(); ?>" id="site-3-city" name="site3City" aria-invalid="false" aria-labelledby="label-site-3-city">
						<label for="site-3-postal-code" id="label-site-3-postal-code"><span class="sr-only">Site 3 </span>Postal Code</label>
						<input disabled type="text" value="<?php echo $currentInstance->getSite3PostalCode(); ?>" id="site-3-postal-code" name="site3PostalCode" aria-invalid="false" aria-labelledby="label-site-3-postal-code"><br />
						<label for="site-3-firstname" id="label-site-3-firstname"><span class="sr-only">Site 3 </span>Contact Firstname</label>
						<input disabled type="text" value="<?php echo $currentInstance->getSite3Firstname(); ?>" id="site-3-firstname" name="site3Firstname" aria-invalid="false" aria-labelledby="label-site-3-firstname">
						<label for="site-3-lastname" id="label-site-3-lastname"><span class="sr-only">Site 3 </span>Contact Lastname</label>
						<input disabled type="text" value="<?php echo $currentInstance->getSite3Lastname(); ?>" id="site-3-lastname" name="site3Lastname" aria-invalid="false" aria-labelledby="label-site-3-lastname"><br />
						<label for="site-3-phone" id="label-site-3-phone"><span class="sr-only">Site 3 </span>Contact Phone</label>
						<input disabled type="text" value="<?php echo $currentInstance->getSite3Phone(); ?>" id="site-3-phone" name="site3Phone" aria-invalid="false" aria-labelledby="label-site-3-phone"><br />
						<label for="site-3-hours-start" id="label-site-3-hours-start"><span class="sr-only">Site 3 </span>Hours Available (start)</label>
						<input disabled type="time" value="<?php echo $currentInstance->getSite3HoursStart(); ?>" id="site-3-hours-start" name="site3HoursStart" aria-invalid="false" aria-labelledby="label-site-3-hours-start"><br />
						<label for="site-3-hours-end" id="label-site-3-hours-end"><span class="sr-only">Site 3 </span>Hours Available (end)</label>
						<input disabled type="time" value="<?php echo $currentInstance->getSite3HoursEnd(); ?>" id="site-3-hours-end" name="site3HoursEnd" aria-invalid="false" aria-labelledby="label-site-3-hours-end">
					</fieldset>

					<fieldset>
						<legend>Site 4</legend>
						<label for="site-4-name" id="label-site-4-name"><span class="sr-only">Site 4 </span>Name</label>
						<input disabled type="text" value="<?php echo $currentInstance->getSite4Name(); ?>" id="site-4-name" name="site4Name" aria-invalid="false" aria-labelledby="label-site-4-name"><br />
						<label for="site-4-address" id="label-site-4-address"><span class="sr-only">Site 4 </span>Address</label>
						<input disabled type="text" value="<?php echo $currentInstance->getSite4Address(); ?>" id="site-4-address" name="site4Address" aria-invalid="false" aria-labelledby="label-site-4-address">
						<label for="site-4-city" id="label-site-4-city"><span class="sr-only">Site 4 </span>City</label>
						<input disabled type="text" value="<?php echo $currentInstance->getSite4City(); ?>" id="site-4-city" name="site4City" aria-invalid="false" aria-labelledby="label-site-4-city">
						<label for="site-4-postal-code" id="label-site-4-postal-code"><span class="sr-only">Site 4 </span>Postal Code</label>
						<input disabled type="text" value="<?php echo $currentInstance->getSite4PostalCode(); ?>" id="site-4-postal-code" name="site4PostalCode" aria-invalid="false" aria-labelledby="label-site-4-postal-code"><br />
						<label for="site-4-firstname" id="label-site-4-firstname"><span class="sr-only">Site 4 </span>Contact Firstname</label>
						<input disabled type="text" value="<?php echo $currentInstance->getSite4Firstname(); ?>" id="site-4-firstname" name="site4Firstname" aria-invalid="false" aria-labelledby="label-site-4-firstname">
						<label for="site-4-lastname" id="label-site-4-lastname"><span class="sr-only">Site 4 </span>Contact Lastname</label>
						<input disabled type="text" value="<?php echo $currentInstance->getSite4Lastname(); ?>" id="site-4-lastname" name="site4Lastname" aria-invalid="false" aria-labelledby="label-site-4-lastname"><br />
						<label for="site-4-phone" id="label-site-4-phone"><span class="sr-only">Site 4 </span>Contact Phone</label>
						<input disabled type="text" value="<?php echo $currentInstance->getSite4Phone(); ?>" id="site-4-phone" name="site4Phone" aria-invalid="false" aria-labelledby="label-site-4-phone"><br />
						<label for="site-4-hours-start" id="label-site-4-hours-start"><span class="sr-only">Site 4 </span>Hours Available (start)</label>
						<input disabled type="time" value="<?php echo $currentInstance->getSite4HoursStart(); ?>" id="site-4-hours-start" name="site4HoursStart" aria-invalid="false" aria-labelledby="label-site-4-hours-start"><br />
						<label for="site-4-hours-end" id="label-site-4-hours-end"><span class="sr-only">Site 4 </span>Hours Available (end)</label>
						<input disabled type="time" value="<?php echo $currentInstance->getSite4HoursEnd(); ?>" id="site-4-hours-end" name="site4HoursEnd" aria-invalid="false" aria-labelledby="label-site-4-hours-end">
					</fieldset>
				</form>

                <?php if (Module::userCanEditGuard()) { ?>
                    <p><button onclick="location.href='./edit/';"><a href="./edit/">Update this Information</a></button></p>
                <?php } ?>
				<!-- /CONTENT -->
            </div>
		<?php } ?>
	</div>
</div>

<script>
    function disable(id) {
        document.getElementById(id).disabled = true;
    }
    function enable(id) {
        document.getElementById(id).disabled = false;
    }
</script>

<?php WPCore::getFooter();
