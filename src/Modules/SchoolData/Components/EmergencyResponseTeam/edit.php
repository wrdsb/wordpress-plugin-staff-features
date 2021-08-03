<?php
namespace WRDSB\Staff\Modules\SchoolData\Components;
use WRDSB\Staff\Modules\WP\WPCore as WPCore;
use WRDSB\Staff\Modules\SchoolData\SchoolDataModule as Module;
//use WRDSB\Staff\Modules\SchoolData\Model\EmergencyResponseTeam as Model;

//$apiKey = Module::getCodexSearchKey();
$schoolCode = strtoupper(WPCore::getOption('wrdsb_school_code'));
$current_user = WPCore::getCurrentUser();
$current_time = WPCore::currentTime();
$page_title = "Edit Emergency Response Team";

function setCustomTitle() {
    $page_title = "Edit Emergency Response Team";
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
                                    <li><a href="<?php echo WPCore::homeURL(); ?>/school-data/form1/form1-view">Form 1</a></li>
                                    <li><a href="<?php echo WPCore::homeURL(); ?>/school-data/form2/form2-view">Form 2</a></li>
                                    <li><a href="<?php echo WPCore::homeURL(); ?>/school-data/form3/form3-view">Form 3</a></li>
                                    <li><a href="<?php echo WPCore::homeURL(); ?>/school-data/form4/form4-view">Form 4</a></li>
                        	    </ul>
							</ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-9 col-lg-9" role="main">
				<!-- CONTENT -->

				<div class="alert alert-info">
					<p>Each school's Emergency Response Team takes leadership in dealing with crises and emergency situations. Carefully consider the membership of the team to ensure the team has the requisite skills and training to be effective.</p>
					<p>Please review the <a href="https://staff.wrdsb.ca/school-teams/ert/ert-responsibilities/">ERT Responsibilities</a>.</p>
				</div>

				<div class="note">
					<p>Administrative staff, teachers (number determined by needs/size of school) and/or support staff should be members of the team. <strong><em>The team must have at least one member with current, valid training in CPR and first aid</em></strong>. The team should include members who have received Behaviour Management Systems (BMS) training.</p>
					<p>Not all members require first aid/medical training; however, at least one team member must be CPR-qualified and another must have first aid training.</p>
				</div>

				<form id="editEmergencyResponseTeam">

                    <h1><?php echo $page_title; ?></h1>

                    <input type="hidden" id="blogID" name="blogID" value="<?php echo WPCore::getCurrentBlogID(); ?>">
                    <input type="hidden" id="schoolCode" name="schoolCode" value="<?php echo $schoolCode; ?>">
                    <input type="hidden" id="email" name="email" value="<?php echo $current_user->user_email ?>">

					<p>Fields marked with <span class="required">*</span> are required.</p>
					
					<fieldset>
						<legend>Staff Member 1</legend>
						<label for="firstname-1" id="label-firstname-1">Firstname 1</label>
						<input type="text" value="" id="firstname-1" name="firstname-1" aria-invalid="false" aria-describedby="error-1047" aria-labelledby="label-firstname-1">
						<label for="lastname-1" id="label-lastname-1">Lastname 1</label>
						<input type="text" value="" id="lastname-1" name="lastname-1" aria-invalid="false" aria-describedby="error-449" aria-labelledby="label-lastname-1">
						<label for="cpr-expiry-1" id="label-cpr-expiry-1">CPR Expiry 4</label>
						<input id="cpr-expiry-1" name="cpr-expiry-1" aria-invalid="false" aria-labelledby="label-cpr-expiry-1" type="date" value="">
						<label for="first-aid-expiry-1" id="label-first-aid-expiry-1">First Aid Expiry 4</label>
						<input id="first-aid-expiry-1" name="first-aid-expiry-1" aria-invalid="false" aria-labelledby="label-first-aid-expiry-1" type="date" value="">
						<label for="bms-expiry-1" id="label-bms-expiry-1">BMS Expiry 4</label>
						<input id="bms-expiry-1" name="bms-expiry-1" aria-invalid="false" aria-labelledby="label-bms-expiry-1" type="date" value="">
					</fieldset>


					<fieldset>
						<legend>Staff Member 2</legend>
						<label for="firstname-2" id="label-firstname-2">Firstname 2</label>
						<input type="text" value="" id="firstname-2" name="firstname-2" aria-invalid="false" aria-describedby="error-2047" aria-labelledby="label-firstname-2">
						<label for="lastname-2" id="label-lastname-2">Lastname 2</label>
						<input type="text" value="" id="lastname-2" name="lastname-2" aria-invalid="false" aria-describedby="error-449" aria-labelledby="label-lastname-2">
						<label for="cpr-expiry-2" id="label-cpr-expiry-2">CPR Expiry 4</label>
						<input id="cpr-expiry-2" name="cpr-expiry-2" aria-invalid="false" aria-labelledby="label-cpr-expiry-2" type="date" value="">
						<label for="first-aid-expiry-2" id="label-first-aid-expiry-2">First Aid Expiry 4</label>
						<input id="first-aid-expiry-2" name="first-aid-expiry-2" aria-invalid="false" aria-labelledby="label-first-aid-expiry-2" type="date" value="">
						<label for="bms-expiry-2" id="label-bms-expiry-2">BMS Expiry 4</label>
						<input id="bms-expiry-2" name="bms-expiry-2" aria-invalid="false" aria-labelledby="label-bms-expiry-2" type="date" value="">
					</fieldset>


					<fieldset>
						<legend>Staff Member 3</legend>
						<label for="firstname-3" id="label-firstname-3">Firstname 3</label>
						<input type="text" value="" id="firstname-3" name="firstname-3" aria-invalid="false" aria-describedby="error-3047" aria-labelledby="label-firstname-3">
						<label for="lastname-3" id="label-lastname-3">Lastname 3</label>
						<input type="text" value="" id="lastname-3" name="lastname-3" aria-invalid="false" aria-describedby="error-449" aria-labelledby="label-lastname-3">
						<label for="cpr-expiry-3" id="label-cpr-expiry-3">CPR Expiry 3</label>
						<input id="cpr-expiry-3" name="cpr-expiry-3" aria-invalid="false" aria-labelledby="label-cpr-expiry-3" type="date" value="">
						<label for="first-aid-expiry-3" id="label-first-aid-expiry-3">First Aid Expiry 3</label>
						<input id="first-aid-expiry-3" name="first-aid-expiry-3" aria-invalid="false" aria-labelledby="label-first-aid-expiry-3" type="date" value="">
						<label for="bms-expiry-3" id="label-bms-expiry-3">BMS Expiry 3</label>
						<input id="bms-expiry-3" name="bms-expiry-3" aria-invalid="false" aria-labelledby="label-bms-expiry-3" type="date" value="">
					</fieldset>


					<fieldset>
						<legend>Staff Member 4</legend>
						<label for="firstname-4" id="label-firstname-4">Firstname 4</label>
						<input type="text" value="" id="firstname-4" name="firstname-4" aria-invalid="false" aria-describedby="error-4047" aria-labelledby="label-firstname-4">
						<label for="lastname-4" id="label-lastname-4">Lastname 4</label>
						<input type="text" value="" id="lastname-4" name="lastname-4" aria-invalid="false" aria-describedby="error-449" aria-labelledby="label-lastname-4">
						<label for="cpr-expiry-4" id="label-cpr-expiry-4">CPR Expiry 4</label>
						<input id="cpr-expiry-4" name="cpr-expiry-4" aria-invalid="false" aria-labelledby="label-cpr-expiry-4" type="date" value="">
						<label for="first-aid-expiry-4" id="label-first-aid-expiry-4">First Aid Expiry 4</label>
						<input id="first-aid-expiry-4" name="first-aid-expiry-4" aria-invalid="false" aria-labelledby="label-first-aid-expiry-4" type="date" value="">
						<label for="bms-expiry-4" id="label-bms-expiry-4">BMS Expiry 4</label>
						<input id="bms-expiry-4" name="bms-expiry-4" aria-invalid="false" aria-labelledby="label-bms-expiry-4" type="date" value="">
					</fieldset>


					<fieldset>
						<legend>Staff Member 5</legend>
						<label for="firstname-5" id="label-firstname-5">Firstname 5</label>
						<input type="text" value="" id="firstname-5" name="firstname-5" aria-invalid="false" aria-describedby="error-5047" aria-labelledby="label-firstname-5">
						<label for="lastname-5" id="label-lastname-5">Lastname 5</label>
						<input type="text" value="" id="lastname-5" name="lastname-5" aria-invalid="false" aria-describedby="error-449" aria-labelledby="label-lastname-5">
						<label for="cpr-expiry-5" id="label-cpr-expiry-5">CPR Expiry 5</label>
						<input id="cpr-expiry-5" name="cpr-expiry-5" aria-invalid="false" aria-labelledby="label-cpr-expiry-5" type="date" value="">
						<label for="first-aid-expiry-5" id="label-first-aid-expiry-5">First Aid Expiry 5</label>
						<input id="first-aid-expiry-5" name="first-aid-expiry-5" aria-invalid="false" aria-labelledby="label-first-aid-expiry-5" type="date" value="">
						<label for="bms-expiry-5" id="label-bms-expiry-5">BMS Expiry 5</label>
						<input id="bms-expiry-5" name="bms-expiry-5" aria-invalid="false" aria-labelledby="label-bms-expiry-5" type="date" value="">
					</fieldset>

					<fieldset>
						<legend>Staff Member 6</legend>
						<label for="firstname-6" id="label-firstname-6">Firstname 6</label>
						<input type="text" value="" id="firstname-6" name="firstname-6" aria-invalid="false" aria-describedby="error-6047" aria-labelledby="label-firstname-6">
						<label for="lastname-6" id="label-lastname-6">Lastname 6</label>
						<input type="text" value="" id="lastname-6" name="lastname-6" aria-invalid="false" aria-describedby="error-449" aria-labelledby="label-lastname-6">
						<label for="cpr-expiry-6" id="label-cpr-expiry-6">CPR Expiry 6</label>
						<input id="cpr-expiry-6" name="cpr-expiry-6" aria-invalid="false" aria-labelledby="label-cpr-expiry-6" type="date" value="">
						<label for="first-aid-expiry-6" id="label-first-aid-expiry-6">First Aid Expiry 6</label>
						<input id="first-aid-expiry-6" name="first-aid-expiry-6" aria-invalid="false" aria-labelledby="label-first-aid-expiry-6" type="date" value="">
						<label for="bms-expiry-6" id="label-bms-expiry-6">BMS Expiry 6</label>
						<input id="bms-expiry-6" name="bms-expiry-6" aria-invalid="false" aria-labelledby="label-bms-expiry-6" type="date" value="">
					</fieldset>


					<fieldset>
						<legend>Staff Member 7</legend>
						<label for="firstname-7" id="label-firstname-7">Firstname 7</label>
						<input type="text" value="" id="firstname-7" name="firstname-7" aria-invalid="false" aria-describedby="error-7047" aria-labelledby="label-firstname-7">
						<label for="lastname-7" id="label-lastname-7">Lastname 7</label>
						<input type="text" value="" id="lastname-7" name="lastname-7" aria-invalid="false" aria-describedby="error-449" aria-labelledby="label-lastname-7">
						<label for="cpr-expiry-7" id="label-cpr-expiry-7">CPR Expiry 7</label>
						<input id="cpr-expiry-7" name="cpr-expiry-7" aria-invalid="false" aria-labelledby="label-cpr-expiry-7" type="date" value="">
						<label for="first-aid-expiry-7" id="label-first-aid-expiry-7">First Aid Expiry 7</label>
						<input id="first-aid-expiry-7" name="first-aid-expiry-7" aria-invalid="false" aria-labelledby="label-first-aid-expiry-7" type="date" value="">
						<label for="bms-expiry-7" id="label-bms-expiry-7">BMS Expiry 7</label>
						<input id="bms-expiry-7" name="bms-expiry-7" aria-invalid="false" aria-labelledby="label-bms-expiry-7" type="date" value="">
					</fieldset>


					<fieldset>
						<legend>Staff Member 8</legend>
						<label for="firstname-8" id="label-firstname-8">Firstname 8</label>
						<input type="text" value="" id="firstname-8" name="firstname-8" aria-invalid="false" aria-describedby="error-8047" aria-labelledby="label-firstname-8">
						<label for="lastname-8" id="label-lastname-8">Lastname 8</label>
						<input type="text" value="" id="lastname-8" name="lastname-8" aria-invalid="false" aria-describedby="error-449" aria-labelledby="label-lastname-8">
						<label for="cpr-expiry-8" id="label-cpr-expiry-8">CPR Expiry 8</label>
						<input id="cpr-expiry-8" name="cpr-expiry-8" aria-invalid="false" aria-labelledby="label-cpr-expiry-8" type="date" value="">
						<label for="first-aid-expiry-8" id="label-first-aid-expiry-8">First Aid Expiry 8</label>
						<input id="first-aid-expiry-8" name="first-aid-expiry-8" aria-invalid="false" aria-labelledby="label-first-aid-expiry-8" type="date" value="">
						<label for="bms-expiry-8" id="label-bms-expiry-8">BMS Expiry 8</label>
						<input id="bms-expiry-8" name="bms-expiry-8" aria-invalid="false" aria-labelledby="label-bms-expiry-8" type="date" value="">
					</fieldset>


					<fieldset>
						<legend>Staff Member 9</legend>
						<label for="firstname-9" id="label-firstname-9">Firstname 9</label>
						<input type="text" value="" id="firstname-9" name="firstname-9" aria-invalid="false" aria-describedby="error-9047" aria-labelledby="label-firstname-9">
						<label for="lastname-9" id="label-lastname-9">Lastname 9</label>
						<input type="text" value="" id="lastname-9" name="lastname-9" aria-invalid="false" aria-describedby="error-449" aria-labelledby="label-lastname-9">
						<label for="cpr-expiry-9" id="label-cpr-expiry-9">CPR Expiry 9</label>
						<input id="cpr-expiry-9" name="cpr-expiry-9" aria-invalid="false" aria-labelledby="label-cpr-expiry-9" type="date" value="">
						<label for="first-aid-expiry-9" id="label-first-aid-expiry-9">First Aid Expiry 9</label>
						<input id="first-aid-expiry-9" name="first-aid-expiry-9" aria-invalid="false" aria-labelledby="label-first-aid-expiry-9" type="date" value="">
						<label for="bms-expiry-9" id="label-bms-expiry-9">BMS Expiry 9</label>
						<input id="bms-expiry-9" name="bms-expiry-9" aria-invalid="false" aria-labelledby="label-bms-expiry-9" type="date" value="">
					</fieldset>


					<fieldset>
						<legend>Staff Member 10</legend>
						<label for="firstname-10" id="label-firstname-10">Firstname 10</label>
						<input type="text" value="" id="firstname-10" name="firstname-10" aria-invalid="false" aria-describedby="error-10047" aria-labelledby="label-firstname-10">
						<label for="lastname-10" id="label-lastname-10">Lastname 10</label>
						<input type="text" value="" id="lastname-10" name="lastname-10" aria-invalid="false" aria-describedby="error-449" aria-labelledby="label-lastname-10">
						<label for="cpr-expiry-10" id="label-cpr-expiry-10">CPR Expiry 10</label>
						<input id="cpr-expiry-10" name="cpr-expiry-10" aria-invalid="false" aria-labelledby="label-cpr-expiry-10" type="date" value="">
						<label for="first-aid-expiry-10" id="label-first-aid-expiry-10">First Aid Expiry 10</label>
						<input id="first-aid-expiry-10" name="first-aid-expiry-10" aria-invalid="false" aria-labelledby="label-first-aid-expiry-10" type="date" value="">
						<label for="bms-expiry-10" id="label-bms-expiry-10">BMS Expiry 10</label>
						<input id="bms-expiry-10" name="bms-expiry-10" aria-invalid="false" aria-labelledby="label-bms-expiry-10" type="date" value="">
					</fieldset>


					<fieldset>
						<legend>Staff Member 11</legend>
						<label for="firstname-11" id="label-firstname-11">Firstname 11</label>
						<input type="text" value="" id="firstname-11" name="firstname-11" aria-invalid="false" aria-describedby="error-11047" aria-labelledby="label-firstname-11">
						<label for="lastname-11" id="label-lastname-11">Lastname 11</label>
						<input type="text" value="" id="lastname-11" name="lastname-11" aria-invalid="false" aria-describedby="error-449" aria-labelledby="label-lastname-11">
						<label for="cpr-expiry-11" id="label-cpr-expiry-11">CPR Expiry 11</label>
						<input id="cpr-expiry-11" name="cpr-expiry-11" aria-invalid="false" aria-labelledby="label-cpr-expiry-11" type="date" value="">
						<label for="first-aid-expiry-11" id="label-first-aid-expiry-11">First Aid Expiry 11</label>
						<input id="first-aid-expiry-11" name="first-aid-expiry-11" aria-invalid="false" aria-labelledby="label-first-aid-expiry-11" type="date" value="">
						<label for="bms-expiry-11" id="label-bms-expiry-11">BMS Expiry 11</label>
						<input id="bms-expiry-11" name="bms-expiry-11" aria-invalid="false" aria-labelledby="label-bms-expiry-11" type="date" value="">
					</fieldset>


					<fieldset>
						<legend>Staff Member 12</legend>
						<label for="firstname-12" id="label-firstname-12">Firstname 12</label>
						<input type="text" value="" id="firstname-12" name="firstname-12" aria-invalid="false" aria-describedby="error-12047" aria-labelledby="label-firstname-12">
						<label for="lastname-12" id="label-lastname-12">Lastname 12</label>
						<input type="text" value="" id="lastname-12" name="lastname-12" aria-invalid="false" aria-describedby="error-449" aria-labelledby="label-lastname-12">
						<label for="cpr-expiry-12" id="label-cpr-expiry-12">CPR Expiry 12</label>
						<input id="cpr-expiry-12" name="cpr-expiry-12" aria-invalid="false" aria-labelledby="label-cpr-expiry-12" type="date" value="">
						<label for="first-aid-expiry-12" id="label-first-aid-expiry-12">First Aid Expiry 12</label>
						<input id="first-aid-expiry-12" name="first-aid-expiry-12" aria-invalid="false" aria-labelledby="label-first-aid-expiry-12" type="date" value="">
						<label for="bms-expiry-12" id="label-bms-expiry-12">BMS Expiry 12</label>
						<input id="bms-expiry-12" name="bms-expiry-12" aria-invalid="false" aria-labelledby="label-bms-expiry-12" type="date" value="">
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
