<?php
namespace WRDSB\Staff\Modules\SchoolData\Components;

use WRDSB\Staff\Modules\WP\WPCore as WPCore;
use WRDSB\Staff\Modules\SchoolData\SchoolDataModule as Module;
use WRDSB\Staff\Modules\SchoolData\Components\Partials\PermissionDenied as PermissionDenied;

use WRDSB\Staff\Modules\SchoolData\Model\EmergencyResponseTeam;
use WRDSB\Staff\Modules\SchoolData\Model\EmergencyResponseTeamSearch as EmergencyResponseTeamSearch;

$featureCheck = Module::featureGuard('SchoolDataAdminEmergencyResponseTeam');
$viewCheck = Module::userCanViewGuard();

if ($wp_query->query_vars['schoolCode']) {
    $schoolCode = strtoupper($wp_query->query_vars['schoolCode']);
}
$searchInstance = EmergencyResponseTeamSearch::getBySchoolCode($schoolCode);
$currentInstance = new EmergencyResponseTeam(json_decode(json_encode($searchInstance), true));

$page_title = "{$schoolCode} Emergency Response Team";

function setCustomTitle($schoolCode) {
    $page_title = "{$schoolCode} Emergency Response Team";
    return $page_title;
}
WPCore::addFilter('pre_get_document_title', '\WRDSB\Staff\Modules\SchoolData\Components\setCustomTitle');
?>

<?php WPCore::getHeader(); ?>

<div class="container-top">
    <?php WPCore::getTemplatePart('partials/header', 'masthead'); ?>

    <?php if (! $viewCheck) { ?>
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
                    <a href="<?php echo WPCore::homeURL(); ?>/school-data/admin">Admin</a>
                </li>
                <li>
                    <a href="<?php echo WPCore::homeURL(); ?>/school-data/lists/emergency-response-team/">Emergency Response Team</a>
                </li>
                <li>
                    <?php echo $page_title?>
                </li>
            </ol>
        </div>
    <?php } ?>
</div>

<div class="container">
    <div class="row">
		<?php if ($viewCheck && !$featureCheck) { ?>
            <?php echo PermissionDenied::featureUnavailable(); ?>
        
        <?php } elseif ($viewCheck && $featureCheck) {?>
            <div class="col-sm-12 col-lg-12" role="main">
                <!-- CONTENT -->
                <h1><?php echo $page_title; ?></h1>

                <form>
                <fieldset>
						<legend>Staff Member 1</legend>
						<label for="firstname-1" id="label-firstname-1">Firstname<span class="sr-only"> 1</span></label>
						<input disabled type="text" value="<?php echo $currentInstance->getFirstname1(); ?>" id="firstname-1" name="firstname1" aria-invalid="false" aria-labelledby="label-firstname-1">
						<label for="lastname-1" id="label-lastname-1">Lastname<span class="sr-only"> 1</span></label>
						<input disabled type="text" value="<?php echo $currentInstance->getLastname1(); ?>" id="lastname-1" name="lastname1" aria-invalid="false" aria-labelledby="label-lastname-1"><br />
						<label for="email-1" id="label-email-1">Email<span class="sr-only"> 1</span></label>
						<input disabled type="text" value="<?php echo $currentInstance->getEmail1(); ?>" id="email-1" name="email1" aria-invalid="false" aria-labelledby="label-email-1">
						<label for="role-1" id="label-role-1">Role<span class="sr-only"> 1</span></label>
						<input disabled type="text" value="<?php echo $currentInstance->displayRole1(); ?>" id="role-1" name="role1" aria-invalid="false" aria-labelledby="label-role-1"><br />
						<label for="cpr-expiry-1" id="label-cpr-expiry-1">CPR Expiry<span class="sr-only"> 1</span></label>
						<input disabled id="cpr-expiry-1" name="cprExpiry1" aria-invalid="false" aria-labelledby="label-cpr-expiry-1" type="date" value="<?php echo $currentInstance->getCPRExpiry1(); ?>"><br />
						<label for="first-aid-expiry-1" id="label-first-aid-expiry-1">First Aid Expiry<span class="sr-only"> 1</span></label>
						<input disabled id="first-aid-expiry-1" name="firstAidExpiry1" aria-invalid="false" aria-labelledby="label-first-aid-expiry-1" type="date" value="<?php echo $currentInstance->getFirstAidExpiry1(); ?>"><br />
						<label for="bms-expiry-1" id="label-bms-expiry-1">BMS Expiry<span class="sr-only"> 1</span></label>
						<input disabled id="bms-expiry-1" name="bmsExpiry1" aria-invalid="false" aria-labelledby="label-bms-expiry-1" type="date" value="<?php echo $currentInstance->getBMSExpiry1(); ?>">
					</fieldset>

					<fieldset>
						<legend>Staff Member 2</legend>
						<label for="firstname-2" id="label-firstname-2">Firstname<span class="sr-only"> 2</span></label>
						<input disabled type="text" value="<?php echo $currentInstance->getFirstname2(); ?>" id="firstname-2" name="firstname2" aria-invalid="false" aria-labelledby="label-firstname-2">
						<label for="lastname-2" id="label-lastname-2">Lastname<span class="sr-only"> 2</span></label>
						<input disabled type="text" value="<?php echo $currentInstance->getLastname2(); ?>" id="lastname-2" name="lastname2" aria-invalid="false" aria-labelledby="label-lastname-2"><br />
						<label for="email-2" id="label-email-2">Email<span class="sr-only"> 2</span></label>
						<input disabled type="text" value="<?php echo $currentInstance->getEmail2(); ?>" id="email-2" name="email2" aria-invalid="false" aria-labelledby="label-email-2">
						<label for="role-2" id="label-role-2">Role<span class="sr-only"> 2</span></label>
						<input disabled type="text" value="<?php echo $currentInstance->displayRole2(); ?>" id="role-2" name="role2" aria-invalid="false" aria-labelledby="label-role-2"><br />
						<label for="cpr-expiry-2" id="label-cpr-expiry-2">CPR Expiry<span class="sr-only"> 2</span></label>
						<input disabled id="cpr-expiry-2" name="cprExpiry2" aria-invalid="false" aria-labelledby="label-cpr-expiry-2" type="date" value="<?php echo $currentInstance->getCPRExpiry2(); ?>"><br />
						<label for="first-aid-expiry-2" id="label-first-aid-expiry-2">First Aid Expiry<span class="sr-only"> 2</span></label>
						<input disabled id="first-aid-expiry-2" name="firstAidExpiry2" aria-invalid="false" aria-labelledby="label-first-aid-expiry-2" type="date" value="<?php echo $currentInstance->getFirstAidExpiry2(); ?>"><br />
						<label for="bms-expiry-2" id="label-bms-expiry-2">BMS Expiry<span class="sr-only"> 2</span></label>
						<input disabled id="bms-expiry-2" name="bmsExpiry2" aria-invalid="false" aria-labelledby="label-bms-expiry-2" type="date" value="<?php echo $currentInstance->getBMSExpiry2(); ?>">
					</fieldset>

					<fieldset>
						<legend>Staff Member 3</legend>
						<label for="firstname-3" id="label-firstname-3">Firstname<span class="sr-only"> 3</span></label>
						<input disabled type="text" value="<?php echo $currentInstance->getFirstname3(); ?>" id="firstname-3" name="firstname3" aria-invalid="false" aria-labelledby="label-firstname-3">
						<label for="lastname-3" id="label-lastname-3">Lastname<span class="sr-only"> 3</span></label>
						<input disabled type="text" value="<?php echo $currentInstance->getLastname3(); ?>" id="lastname-3" name="lastname3" aria-invalid="false" aria-labelledby="label-lastname-3"><br />
						<label for="email-3" id="label-email-3">Email<span class="sr-only"> 3</span></label>
						<input disabled type="text" value="<?php echo $currentInstance->getEmail3(); ?>" id="email-3" name="email3" aria-invalid="false" aria-labelledby="label-email-3">
						<label for="role-3" id="label-role-3">Role<span class="sr-only"> 3</span></label>
						<input disabled type="text" value="<?php echo $currentInstance->displayRole3(); ?>" id="role-3" name="role3" aria-invalid="false" aria-labelledby="label-role-3"><br />
						<label for="cpr-expiry-3" id="label-cpr-expiry-3">CPR Expiry<span class="sr-only"> 3</span></label>
						<input disabled id="cpr-expiry-3" name="cprExpiry3" aria-invalid="false" aria-labelledby="label-cpr-expiry-3" type="date" value="<?php echo $currentInstance->getCPRExpiry3(); ?>"><br />
						<label for="first-aid-expiry-3" id="label-first-aid-expiry-3">First Aid Expiry<span class="sr-only"> 3</span></label>
						<input disabled id="first-aid-expiry-3" name="firstAidExpiry3" aria-invalid="false" aria-labelledby="label-first-aid-expiry-3" type="date" value="<?php echo $currentInstance->getFirstAidExpiry3(); ?>"><br />
						<label for="bms-expiry-3" id="label-bms-expiry-3">BMS Expiry<span class="sr-only"> 3</span></label>
						<input disabled id="bms-expiry-3" name="bmsExpiry3" aria-invalid="false" aria-labelledby="label-bms-expiry-3" type="date" value="<?php echo $currentInstance->getBMSExpiry3(); ?>">
					</fieldset>

					<fieldset>
						<legend>Staff Member 4</legend>
						<label for="firstname-4" id="label-firstname-4">Firstname<span class="sr-only"> 4</span></label>
						<input disabled type="text" value="<?php echo $currentInstance->getFirstname4(); ?>" id="firstname-4" name="firstname4" aria-invalid="false" aria-labelledby="label-firstname-4">
						<label for="lastname-4" id="label-lastname-4">Lastname<span class="sr-only"> 4</span></label>
						<input disabled type="text" value="<?php echo $currentInstance->getLastname4(); ?>" id="lastname-4" name="lastname4" aria-invalid="false" aria-labelledby="label-lastname-4"><br />
						<label for="email-4" id="label-email-4">Email<span class="sr-only"> 4</span></label>
						<input disabled type="text" value="<?php echo $currentInstance->getEmail4(); ?>" id="email-4" name="email4" aria-invalid="false" aria-labelledby="label-email-4">
						<label for="role-4" id="label-role-4">Role<span class="sr-only"> 4</span></label>
						<input disabled type="text" value="<?php echo $currentInstance->displayRole4(); ?>" id="role-4" name="role4" aria-invalid="false" aria-labelledby="label-role-4"><br />
						<label for="cpr-expiry-4" id="label-cpr-expiry-4">CPR Expiry<span class="sr-only"> 4</span></label>
						<input disabled id="cpr-expiry-4" name="cprExpiry4" aria-invalid="false" aria-labelledby="label-cpr-expiry-4" type="date" value="<?php echo $currentInstance->getCPRExpiry4(); ?>"><br />
						<label for="first-aid-expiry-4" id="label-first-aid-expiry-4">First Aid Expiry<span class="sr-only"> 4</span></label>
						<input disabled id="first-aid-expiry-4" name="firstAidExpiry4" aria-invalid="false" aria-labelledby="label-first-aid-expiry-4" type="date" value="<?php echo $currentInstance->getFirstAidExpiry4(); ?>"><br />
						<label for="bms-expiry-4" id="label-bms-expiry-4">BMS Expiry<span class="sr-only"> 4</span></label>
						<input disabled id="bms-expiry-4" name="bmsExpiry4" aria-invalid="false" aria-labelledby="label-bms-expiry-4" type="date" value="<?php echo $currentInstance->getBMSExpiry4(); ?>">
					</fieldset>

					<fieldset>
						<legend>Staff Member 5</legend>
						<label for="firstname-5" id="label-firstname-5">Firstname<span class="sr-only"> 5</span></label>
						<input disabled type="text" value="<?php echo $currentInstance->getFirstname5(); ?>" id="firstname-5" name="firstname5" aria-invalid="false" aria-labelledby="label-firstname-5">
						<label for="lastname-5" id="label-lastname-5">Lastname<span class="sr-only"> 5</span></label>
						<input disabled type="text" value="<?php echo $currentInstance->getLastname5(); ?>" id="lastname-5" name="lastname5" aria-invalid="false" aria-labelledby="label-lastname-5"><br />
						<label for="email-5" id="label-email-5">Email<span class="sr-only"> 5</span></label>
						<input disabled type="text" value="<?php echo $currentInstance->getEmail5(); ?>" id="email-5" name="email5" aria-invalid="false" aria-labelledby="label-email-5">
						<label for="role-5" id="label-role-5">Role<span class="sr-only"> 5</span></label>
						<input disabled type="text" value="<?php echo $currentInstance->displayRole5(); ?>" id="role-5" name="role5" aria-invalid="false" aria-labelledby="label-role-5"><br />
						<label for="cpr-expiry-5" id="label-cpr-expiry-5">CPR Expiry<span class="sr-only"> 5</span></label>
						<input disabled id="cpr-expiry-5" name="cprExpiry5" aria-invalid="false" aria-labelledby="label-cpr-expiry-5" type="date" value="<?php echo $currentInstance->getCPRExpiry5(); ?>"><br />
						<label for="first-aid-expiry-5" id="label-first-aid-expiry-5">First Aid Expiry<span class="sr-only"> 5</span></label>
						<input disabled id="first-aid-expiry-5" name="firstAidExpiry5" aria-invalid="false" aria-labelledby="label-first-aid-expiry-5" type="date" value="<?php echo $currentInstance->getFirstAidExpiry5(); ?>"><br />
						<label for="bms-expiry-5" id="label-bms-expiry-5">BMS Expiry<span class="sr-only"> 5</span></label>
						<input disabled id="bms-expiry-5" name="bmsExpiry5" aria-invalid="false" aria-labelledby="label-bms-expiry-5" type="date" value="<?php echo $currentInstance->getBMSExpiry5(); ?>">
					</fieldset>

					<fieldset>
						<legend>Staff Member 6</legend>
						<label for="firstname-6" id="label-firstname-6">Firstname<span class="sr-only"> 6</span></label>
						<input disabled type="text" value="<?php echo $currentInstance->getFirstname6(); ?>" id="firstname-6" name="firstname6" aria-invalid="false" aria-labelledby="label-firstname-6">
						<label for="lastname-6" id="label-lastname-6">Lastname<span class="sr-only"> 6</span></label>
						<input disabled type="text" value="<?php echo $currentInstance->getLastname6(); ?>" id="lastname-6" name="lastname6" aria-invalid="false" aria-labelledby="label-lastname-6"><br />
						<label for="email-6" id="label-email-6">Email<span class="sr-only"> 6</span></label>
						<input disabled type="text" value="<?php echo $currentInstance->getEmail6(); ?>" id="email-6" name="email6" aria-invalid="false" aria-labelledby="label-email-6">
						<label for="role-6" id="label-role-6">Role<span class="sr-only"> 6</span></label>
						<input disabled type="text" value="<?php echo $currentInstance->displayRole6(); ?>" id="role-6" name="role6" aria-invalid="false" aria-labelledby="label-role-6"><br />
						<label for="cpr-expiry-6" id="label-cpr-expiry-6">CPR Expiry<span class="sr-only"> 6</span></label>
						<input disabled id="cpr-expiry-6" name="cprExpiry6" aria-invalid="false" aria-labelledby="label-cpr-expiry-6" type="date" value="<?php echo $currentInstance->getCPRExpiry6(); ?>"><br />
						<label for="first-aid-expiry-6" id="label-first-aid-expiry-6">First Aid Expiry<span class="sr-only"> 6</span></label>
						<input disabled id="first-aid-expiry-6" name="firstAidExpiry6" aria-invalid="false" aria-labelledby="label-first-aid-expiry-6" type="date" value="<?php echo $currentInstance->getFirstAidExpiry6(); ?>"><br />
						<label for="bms-expiry-6" id="label-bms-expiry-6">BMS Expiry<span class="sr-only"> 6</span></label>
						<input disabled id="bms-expiry-6" name="bmsExpiry6" aria-invalid="false" aria-labelledby="label-bms-expiry-6" type="date" value="<?php echo $currentInstance->getBMSExpiry6(); ?>">
					</fieldset>

					<fieldset>
						<legend>Staff Member 7</legend>
						<label for="firstname-7" id="label-firstname-7">Firstname<span class="sr-only"> 7</span></label>
						<input disabled type="text" value="<?php echo $currentInstance->getFirstname7(); ?>" id="firstname-7" name="firstname7" aria-invalid="false" aria-labelledby="label-firstname-7">
						<label for="lastname-7" id="label-lastname-7">Lastname<span class="sr-only"> 7</span></label>
						<input disabled type="text" value="<?php echo $currentInstance->getLastname7(); ?>" id="lastname-7" name="lastname7" aria-invalid="false" aria-labelledby="label-lastname-7"><br />
						<label for="email-7" id="label-email-7">Email<span class="sr-only"> 7</span></label>
						<input disabled type="text" value="<?php echo $currentInstance->getEmail7(); ?>" id="email-7" name="email7" aria-invalid="false" aria-labelledby="label-email-7">
						<label for="role-7" id="label-role-7">Email<span class="sr-only"> 7</span></label>
						<input disabled type="text" value="<?php echo $currentInstance->displayRole7(); ?>" id="role-7" name="role7" aria-invalid="false" aria-labelledby="label-role-7"><br />
						<label for="cpr-expiry-7" id="label-cpr-expiry-7">CPR Expiry<span class="sr-only"> 7</span></label>
						<input disabled id="cpr-expiry-7" name="cprExpiry7" aria-invalid="false" aria-labelledby="label-cpr-expiry-7" type="date" value="<?php echo $currentInstance->getCPRExpiry7(); ?>"><br />
						<label for="first-aid-expiry-7" id="label-first-aid-expiry-7">First Aid Expiry<span class="sr-only"> 7</span></label>
						<input disabled id="first-aid-expiry-7" name="firstAidExpiry7" aria-invalid="false" aria-labelledby="label-first-aid-expiry-7" type="date" value="<?php echo $currentInstance->getFirstAidExpiry7(); ?>"><br />
						<label for="bms-expiry-7" id="label-bms-expiry-7">BMS Expiry<span class="sr-only"> 7</span></label>
						<input disabled id="bms-expiry-7" name="bmsExpiry7" aria-invalid="false" aria-labelledby="label-bms-expiry-7" type="date" value="<?php echo $currentInstance->getBMSExpiry7(); ?>">
					</fieldset>

					<fieldset>
						<legend>Staff Member 8</legend>
						<label for="firstname-8" id="label-firstname-8">Firstname<span class="sr-only"> 8</span></label>
						<input disabled type="text" value="<?php echo $currentInstance->getFirstname8(); ?>" id="firstname-8" name="firstname8" aria-invalid="false" aria-labelledby="label-firstname-8">
						<label for="lastname-8" id="label-lastname-8">Lastname<span class="sr-only"> 8</span></label>
						<input disabled type="text" value="<?php echo $currentInstance->getLastname8(); ?>" id="lastname-8" name="lastname8" aria-invalid="false" aria-labelledby="label-lastname-8"><br />
						<label for="email-8" id="label-email-8">Email<span class="sr-only"> 8</span></label>
						<input disabled type="text" value="<?php echo $currentInstance->getEmail8(); ?>" id="email-8" name="email8" aria-invalid="false" aria-labelledby="label-email-8">
						<label for="role-8" id="label-email-8">Role<span class="sr-only"> 8</span></label>
						<input disabled type="text" value="<?php echo $currentInstance->displayRole8(); ?>" id="role-8" name="role8" aria-invalid="false" aria-labelledby="label-role-8"><br />
						<label for="cpr-expiry-8" id="label-cpr-expiry-8">CPR Expiry<span class="sr-only"> 8</span></label>
						<input disabled id="cpr-expiry-8" name="cprExpiry8" aria-invalid="false" aria-labelledby="label-cpr-expiry-8" type="date" value="<?php echo $currentInstance->getCPRExpiry8(); ?>"><br />
						<label for="first-aid-expiry-8" id="label-first-aid-expiry-8">First Aid Expiry<span class="sr-only"> 8</span></label>
						<input disabled id="first-aid-expiry-8" name="firstAidExpiry8" aria-invalid="false" aria-labelledby="label-first-aid-expiry-8" type="date" value="<?php echo $currentInstance->getFirstAidExpiry8(); ?>"><br />
						<label for="bms-expiry-8" id="label-bms-expiry-8">BMS Expiry<span class="sr-only"> 8</span></label>
						<input disabled id="bms-expiry-8" name="bmsExpiry8" aria-invalid="false" aria-labelledby="label-bms-expiry-8" type="date" value="<?php echo $currentInstance->getBMSExpiry8(); ?>">
					</fieldset>

					<fieldset>
						<legend>Staff Member 9</legend>
						<label for="firstname-9" id="label-firstname-9">Firstname<span class="sr-only"> 9</span></label>
						<input disabled type="text" value="<?php echo $currentInstance->getFirstname9(); ?>" id="firstname-9" name="firstname9" aria-invalid="false" aria-labelledby="label-firstname-9">
						<label for="lastname-9" id="label-lastname-9">Lastname<span class="sr-only"> 9</span></label>
						<input disabled type="text" value="<?php echo $currentInstance->getLastname9(); ?>" id="lastname-9" name="lastname9" aria-invalid="false" aria-labelledby="label-lastname-9"><br />
						<label for="email-9" id="label-email-9">Email<span class="sr-only"> 9</span></label>
						<input disabled type="text" value="<?php echo $currentInstance->getEmail9(); ?>" id="email-9" name="email9" aria-invalid="false" aria-labelledby="label-email-9">
						<label for="role-9" id="label-role-9">Role<span class="sr-only"> 9</span></label>
						<input disabled type="text" value="<?php echo $currentInstance->displayRole9(); ?>" id="role-9" name="role9" aria-invalid="false" aria-labelledby="label-role-9"><br />
						<label for="cpr-expiry-9" id="label-cpr-expiry-9">CPR Expiry<span class="sr-only"> 9</span></label>
						<input disabled id="cpr-expiry-9" name="cprExpiry9" aria-invalid="false" aria-labelledby="label-cpr-expiry-9" type="date" value="<?php echo $currentInstance->getCPRExpiry9(); ?>"><br />
						<label for="first-aid-expiry-9" id="label-first-aid-expiry-9">First Aid Expiry<span class="sr-only"> 9</span></label>
						<input disabled id="first-aid-expiry-9" name="firstAidExpiry9" aria-invalid="false" aria-labelledby="label-first-aid-expiry-9" type="date" value="<?php echo $currentInstance->getFirstAidExpiry9(); ?>"><br />
						<label for="bms-expiry-9" id="label-bms-expiry-9">BMS Expiry<span class="sr-only"> 9</span></label>
						<input disabled id="bms-expiry-9" name="bmsExpiry9" aria-invalid="false" aria-labelledby="label-bms-expiry-9" type="date" value="<?php echo $currentInstance->getBMSExpiry9(); ?>">
					</fieldset>

					<fieldset>
						<legend>Staff Member 10</legend>
						<label for="firstname-10" id="label-firstname-10">Firstname<span class="sr-only"> 10</span></label>
						<input disabled type="text" value="<?php echo $currentInstance->getFirstname10(); ?>" id="firstname-10" name="firstname10" aria-invalid="false" aria-labelledby="label-firstname-10">
						<label for="lastname-10" id="label-lastname-10">Lastname<span class="sr-only"> 10</span></label>
						<input disabled type="text" value="<?php echo $currentInstance->getLastname10(); ?>" id="lastname-10" name="lastname10" aria-invalid="false" aria-labelledby="label-lastname-10"><br />
						<label for="email-10" id="label-email-10">Email<span class="sr-only"> 10</span></label>
						<input disabled type="text" value="<?php echo $currentInstance->getEmail10(); ?>" id="email-10" name="email10" aria-invalid="false" aria-labelledby="label-email-10">
						<label for="role-10" id="label-role-10">Role<span class="sr-only"> 10</span></label>
						<input disabled type="text" value="<?php echo $currentInstance->displayRole10(); ?>" id="role-10" name="role10" aria-invalid="false" aria-labelledby="label-role-10"><br />
						<label for="cpr-expiry-10" id="label-cpr-expiry-10">CPR Expiry<span class="sr-only"> 10</span></label>
						<input disabled id="cpr-expiry-10" name="cprExpiry10" aria-invalid="false" aria-labelledby="label-cpr-expiry-10" type="date" value="<?php echo $currentInstance->getCPRExpiry10(); ?>"><br />
						<label for="first-aid-expiry-10" id="label-first-aid-expiry-10">First Aid Expiry<span class="sr-only"> 10</span></label>
						<input disabled id="first-aid-expiry-10" name="firstAidExpiry10" aria-invalid="false" aria-labelledby="label-first-aid-expiry-10" type="date" value="<?php echo $currentInstance->getFirstAidExpiry10(); ?>"><br />
						<label for="bms-expiry-10" id="label-bms-expiry-10">BMS Expiry<span class="sr-only"> 10</span></label>
						<input disabled id="bms-expiry-10" name="bmsExpiry10" aria-invalid="false" aria-labelledby="label-bms-expiry-10" type="date" value="<?php echo $currentInstance->getBMSExpiry10(); ?>">
					</fieldset>

					<fieldset>
						<legend>Staff Member 11</legend>
						<label for="firstname-11" id="label-firstname-11">Firstname<span class="sr-only"> 11</span></label>
						<input disabled type="text" value="<?php echo $currentInstance->getFirstname11(); ?>" id="firstname-11" name="firstname11" aria-invalid="false" aria-labelledby="label-firstname-11">
						<label for="lastname-11" id="label-lastname-11">Lastname<span class="sr-only"> 11</span></label>
						<input disabled type="text" value="<?php echo $currentInstance->getLastname11(); ?>" id="lastname-11" name="lastname11" aria-invalid="false" aria-labelledby="label-lastname-11"><br />
						<label for="email-11" id="label-email-11">Email<span class="sr-only"> 11</span></label>
						<input disabled type="text" value="<?php echo $currentInstance->getEmail11(); ?>" id="email-11" name="email11" aria-invalid="false" aria-labelledby="label-email-11">
						<label for="role-11" id="label-role-11">Role<span class="sr-only"> 11</span></label>
						<input disabled type="text" value="<?php echo $currentInstance->displayRole11(); ?>" id="role-11" name="role11" aria-invalid="false" aria-labelledby="label-role-11"><br />
						<label for="cpr-expiry-11" id="label-cpr-expiry-11">CPR Expiry<span class="sr-only"> 11</span></label>
						<input disabled id="cpr-expiry-11" name="cprExpiry11" aria-invalid="false" aria-labelledby="label-cpr-expiry-11" type="date" value="<?php echo $currentInstance->getCPRExpiry11(); ?>"><br />
						<label for="first-aid-expiry-11" id="label-first-aid-expiry-11">First Aid Expiry<span class="sr-only"> 11</span></label>
						<input disabled id="first-aid-expiry-11" name="firstAidExpiry11" aria-invalid="false" aria-labelledby="label-first-aid-expiry-11" type="date" value="<?php echo $currentInstance->getFirstAidExpiry11(); ?>"><br />
						<label for="bms-expiry-11" id="label-bms-expiry-11">BMS Expiry<span class="sr-only"> 11</span></label>
						<input disabled id="bms-expiry-11" name="bmsExpiry11" aria-invalid="false" aria-labelledby="label-bms-expiry-11" type="date" value="<?php echo $currentInstance->getBMSExpiry11(); ?>">
					</fieldset>

					<fieldset>
						<legend>Staff Member 12</legend>
						<label for="firstname-12" id="label-firstname-12">Firstname<span class="sr-only"> 12</span></label>
						<input disabled type="text" value="<?php echo $currentInstance->getFirstname12(); ?>" id="firstname-12" name="firstname12" aria-invalid="false" aria-labelledby="label-firstname-12">
						<label for="lastname-12" id="label-lastname-12">Lastname<span class="sr-only"> 12</span></label>
						<input disabled type="text" value="<?php echo $currentInstance->getLastname12(); ?>" id="lastname-12" name="lastname12" aria-invalid="false" aria-labelledby="label-lastname-12"><br />
						<label for="email-12" id="label-email-12">Email<span class="sr-only"> 12</span></label>
						<input disabled type="text" value="<?php echo $currentInstance->getEmail12(); ?>" id="email-12" name="email12" aria-invalid="false" aria-labelledby="label-email-12">
						<label for="role-12" id="label-role-12">Role<span class="sr-only"> 12</span></label>
						<input disabled type="text" value="<?php echo $currentInstance->displayRole12(); ?>" id="role-12" name="role12" aria-invalid="false" aria-labelledby="label-role-12"><br />
						<label for="cpr-expiry-12" id="label-cpr-expiry-12">CPR Expiry<span class="sr-only"> 12</span></label>
						<input disabled id="cpr-expiry-12" name="cprExpiry12" aria-invalid="false" aria-labelledby="label-cpr-expiry-12" type="date" value="<?php echo $currentInstance->getCPRExpiry12(); ?>"><br />
						<label for="first-aid-expiry-12" id="label-first-aid-expiry-12">First Aid Expiry<span class="sr-only"> 12</span></label>
						<input disabled id="first-aid-expiry-12" name="firstAidExpiry12" aria-invalid="false" aria-labelledby="label-first-aid-expiry-12" type="date" value="<?php echo $currentInstance->getFirstAidExpiry12(); ?>"><br />
						<label for="bms-expiry-12" id="label-bms-expiry-12">BMS Expiry<span class="sr-only"> 12</span></label>
						<input disabled id="bms-expiry-12" name="bmsExpiry12" aria-invalid="false" aria-labelledby="label-bms-expiry-12" type="date" value="<?php echo $currentInstance->getBMSExpiry12(); ?>">
					</fieldset>
                </form>
                <!-- /CONTENT -->
            </div>
        <?php } ?>
    </div>
</div>

<?php WPCore::getFooter();
