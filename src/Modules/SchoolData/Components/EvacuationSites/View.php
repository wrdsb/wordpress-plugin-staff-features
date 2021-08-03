<?php
namespace WRDSB\Staff\Modules\SchoolData\Components;
use WRDSB\Staff\Modules\WP\WPCore as WPCore;
use WRDSB\Staff\Modules\SchoolData\SchoolDataModule as Module;
//use WRDSB\Staff\Modules\SchoolData\Model\EvacuationSites as Model;

//$apiKey = Module::getCodexSearchKey();
$schoolCode = strtoupper(WPCore::getOption('wrdsb_school_code'));
$current_user = WPCore::getCurrentUser();
$current_time = WPCore::currentTime();
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
                    <a href="<?php echo WPCore::homeURL(); ?>/school-data/menu">School Data</a>
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
                            <span><a href="<?php echo WPCore::homeURL(); ?>/school-data/menu">School Data</a></span>
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

				<p class="alert alert-info"><strong>All schools</strong> must provide alternate evacuation site(s) information to be used in case of emergencies.</p>
				
                <form id="viewEvacuationSites">
                    <input type="hidden" id="blogID" name="blogID" value="<?php echo WPCore::getCurrentBlogID(); ?>">
                    <input type="hidden" id="schoolCode" name="schoolCode" value="<?php echo $schoolCode; ?>">
                    <input type="hidden" id="email" name="email" value="<?php echo $current_user->user_email ?>">

					<p>Fields marked with <span class="required">*</span> are required.</p>
					
					<label for="no-evac" id="label-no-evac">This location has no evacuation site</label>
					<input id="no-evac" name="no-evac" type="checkbox" value="1" aria-labelledby="label-no-evac">

					<fieldset>
						<legend>Site 1</legend>
						<label for="site-1-name" id="label-site-1-name">Site 1 name</label>
						<input type="text" value="" id="site-1-name" name="site-1-name" aria-invalid="false" aria-labelledby="label-site-1-name">
						<label for="site-1-address" id="label-site-1-address">Site 1 address</label>
						<input type="text" value="" id="site-1-address" name="site-1-address" aria-invalid="false" aria-labelledby="label-site-1-address">
						<label for="site-1-city" id="label-site-1-city">Site 1 city</label>
						<input type="text" value="" id="site-1-city" name="site-1-city" aria-invalid="false" aria-labelledby="label-site-1-city">
						<label for="site-1-postal-code" id="label-site-1-postal-code">Site 1 postal code</label>
						<input type="text" value="" id="site-1-postal-code" name="site-1-postal-code" aria-invalid="false" aria-labelledby="label-site-1-postal-code">
						<label for="site-1-firstname" id="label-site-1-firstname">Site 1 contact firstname</label>
						<input type="text" value="" id="site-1-firstname" name="site-1-firstname" aria-invalid="false" aria-labelledby="label-site-1-firstname">
						<label for="site-1-lastname" id="label-site-1-lastname">Site 1 contact lastname</label>
						<input type="text" value="" id="site-1-lastname" name="site-1-lastname" aria-invalid="false" aria-labelledby="label-site-1-lastname">
						<label for="site-1-phone" id="label-site-1-phone">Site 1 phone number</label>
						<input type="text" value="" id="site-1-phone" name="site-1-phone" aria-invalid="false" aria-labelledby="label-site-1-phone">
						<label for="site-1-hours-start" id="label-site-1-hours-start">Site 1 hours available start</label>
						<input type="time" value="" id="site-1-hours-start" name="site-1-hours-start" aria-invalid="false" aria-labelledby="label-site-1-hours-start">
						<label for="site-1-hours-end" id="label-site-1-hours-end">Site 1 hours available end</label>
						<input type="time" value="" id="site-1-hours-end" name="site-1-hours-end" aria-invalid="false" aria-labelledby="label-site-1-hours-end">
					</fieldset>

					<fieldset>
						<legend>Site 2</legend>
						<label for="site-2-name" id="label-site-2-name">Site 2 name</label>
						<input type="text" value="" id="site-2-name" name="site-2-name" aria-invalid="false" aria-labelledby="label-site-2-name">
						<label for="site-2-address" id="label-site-2-address">Site 2 address</label>
						<input type="text" value="" id="site-2-address" name="site-2-address" aria-invalid="false" aria-labelledby="label-site-2-address">
						<label for="site-2-city" id="label-site-2-city">Site 2 city</label>
						<input type="text" value="" id="site-2-city" name="site-2-city" aria-invalid="false" aria-labelledby="label-site-2-city">
						<label for="site-2-postal-code" id="label-site-2-postal-code">Site 2 postal code</label>
						<input type="text" value="" id="site-2-postal-code" name="site-2-postal-code" aria-invalid="false" aria-labelledby="label-site-2-postal-code">
						<label for="site-2-firstname" id="label-site-2-firstname">Site 2 contact firstname</label>
						<input type="text" value="" id="site-2-firstname" name="site-2-firstname" aria-invalid="false" aria-labelledby="label-site-2-firstname">
						<label for="site-2-lastname" id="label-site-2-lastname">Site 2 contact lastname</label>
						<input type="text" value="" id="site-2-lastname" name="site-2-lastname" aria-invalid="false" aria-labelledby="label-site-2-lastname">
						<label for="site-2-phone" id="label-site-2-phone">Site 2 phone number</label>
						<input type="text" value="" id="site-2-phone" name="site-2-phone" aria-invalid="false" aria-labelledby="label-site-2-phone">
						<label for="site-2-hours-start" id="label-site-2-hours-start">Site 2 hours available start</label>
						<input type="time" value="" id="site-1-hours-start" name="site-1-hours-start" aria-invalid="false" aria-labelledby="label-site-2-hours-start">
						<label for="site-2-hours-end" id="label-site-2-hours-end">Site 2 hours available end</label>
						<input type="time" value="" id="site-2-hours-end" name="site-2-hours-end" aria-invalid="false" aria-labelledby="label-site-2-hours-end">
					</fieldset>

					<fieldset>
						<legend>Site 3</legend>
						<label for="site-3-name" id="label-site-3-name">Site 3 name</label>
						<input type="text" value="" id="site-3-name" name="site-3-name" aria-invalid="false" aria-labelledby="label-site-3-name">
						<label for="site-3-address" id="label-site-3-address">Site 3 address</label>
						<input type="text" value="" id="site-3-address" name="site-3-address" aria-invalid="false" aria-labelledby="label-site-3-address">
						<label for="site-3-city" id="label-site-3-city">Site 3 city</label>
						<input type="text" value="" id="site-3-city" name="site-3-city" aria-invalid="false" aria-labelledby="label-site-3-city">
						<label for="site-3-postal-code" id="label-site-3-postal-code">Site 3 postal code</label>
						<input type="text" value="" id="site-3-postal-code" name="site-3-postal-code" aria-invalid="false" aria-labelledby="label-site-3-postal-code">
						<label for="site-3-firstname" id="label-site-3-firstname">Site 3 contact firstname</label>
						<input type="text" value="" id="site-3-firstname" name="site-3-firstname" aria-invalid="false" aria-labelledby="label-site-3-firstname">
						<label for="site-3-lastname" id="label-site-3-lastname">Site 3 contact lastname</label>
						<input type="text" value="" id="site-3-lastname" name="site-3-lastname" aria-invalid="false" aria-labelledby="label-site-3-lastname">
						<label for="site-3-phone" id="label-site-3-phone">Site 3 phone number</label>
						<input type="text" value="" id="site-3-phone" name="site-3-phone" aria-invalid="false" aria-labelledby="label-site-3-phone">
						<label for="site-3-hours-start" id="label-site-3-hours-start">Site 3 hours available start</label>
						<input type="time" value="" id="site-3-hours-start" name="site-3-hours-start" aria-invalid="false" aria-labelledby="label-site-3-hours-start">
						<label for="site-3-hours-end" id="label-site-3-hours-end">Site 3 hours available end</label>
						<input type="time" value="" id="site-3-hours-end" name="site-3-hours-end" aria-invalid="false" aria-labelledby="label-site-3-hours-end">
					</fieldset>

					<fieldset>
						<legend>Site 4</legend>
						<label for="site-4-name" id="label-site-4-name">Site 4 name</label>
						<input type="text" value="" id="site-4-name" name="site-4-name" aria-invalid="false" aria-labelledby="label-site-4-name">
						<label for="site-4-address" id="label-site-4-address">Site 4 address</label>
						<input type="text" value="" id="site-4-address" name="site-4-address" aria-invalid="false" aria-labelledby="label-site-4-address">
						<label for="site-4-city" id="label-site-4-city">Site 4 city</label>
						<input type="text" value="" id="site-4-city" name="site-4-city" aria-invalid="false" aria-labelledby="label-site-4-city">
						<label for="site-4-postal-code" id="label-site-4-postal-code">Site 4 postal code</label>
						<input type="text" value="" id="site-4-postal-code" name="site-4-postal-code" aria-invalid="false" aria-labelledby="label-site-4-postal-code">
						<label for="site-4-firstname" id="label-site-4-firstname">Site 4 contact firstname</label>
						<input type="text" value="" id="site-4-firstname" name="site-4-firstname" aria-invalid="false" aria-labelledby="label-site-4-firstname">
						<label for="site-4-lastname" id="label-site-4-lastname">Site 4 contact lastname</label>
						<input type="text" value="" id="site-4-lastname" name="site-4-lastname" aria-invalid="false" aria-labelledby="label-site-4-lastname">
						<label for="site-4-phone" id="label-site-4-phone">Site 4 phone number</label>
						<input type="text" value="" id="site-4-phone" name="site-4-phone" aria-invalid="false" aria-labelledby="label-site-4-phone">
						<label for="site-4-hours-start" id="label-site-4-hours-start">Site 4 hours available start</label>
						<input type="time" value="" id="site-4-hours-start" name="site-4-hours-start" aria-invalid="false" aria-labelledby="label-site-4-hours-start">
						<label for="site-4-hours-end" id="label-site-4-hours-end">Site 4 hours available end</label>
						<input type="time" value="" id="site-4-hours-end" name="site-4-hours-end" aria-invalid="false" aria-labelledby="label-site-4-hours-end">
					</fieldset>

					</form>
                <!-- /CONTENT -->
            </div>
        </div>
    </div>
<?php } ?>

<script>
    function disable(id) {
        document.getElementById(id).disabled = true;
    }
    function enable(id) {
        document.getElementById(id).disabled = false;
    }
</script>

<?php WPCore::getFooter();
