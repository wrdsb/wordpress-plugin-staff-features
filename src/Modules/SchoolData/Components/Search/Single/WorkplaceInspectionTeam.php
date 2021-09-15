<?php
namespace WRDSB\Staff\Modules\SchoolData\Components;
use WRDSB\Staff\Modules\WP\WPCore as WPCore;
use WRDSB\Staff\Modules\SchoolData\Components\Partials\PermissionDenied as PermissionDenied;
use WRDSB\Staff\Modules\SchoolData\Model\WorkplaceInspectionTeam;
use WRDSB\Staff\Modules\SchoolData\SchoolDataModule as Module;
use WRDSB\Staff\Modules\SchoolData\Model\WorkplaceInspectionTeamSearch as WorkplaceInspectionTeamSearch;

if ($wp_query->query_vars['schoolCode']) {
    $schoolCode = strtoupper($wp_query->query_vars['schoolCode']);
}
$searchInstance = WorkplaceInspectionTeamSearch::getBySchoolCode($schoolCode);
$currentInstance = new WorkplaceInspectionTeam(json_decode(json_encode($searchInstance), true));

$page_title = "{$schoolCode} Workplace Inspection Team";

function setCustomTitle($schoolCode) {
    $page_title = "{$schoolCode} Workplace Inspection Team";
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
                    <a href="<?php echo WPCore::homeURL(); ?>/school-data/admin">Admin</a>
                </li>
                <li>
                    <a href="<?php echo WPCore::homeURL(); ?>/school-data/lists/workplace-inspection-team/">Workplace Inspection Teams</a>
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
        <?php if (!Module::userCanViewGuard()) { ?>
            <?php //echo PermissionDenied::cannotView(); ?>

        <?php } else { ?>
            <div class="col-sm-12 col-lg-12" role="main">
                <!-- CONTENT -->
                <h1><?php echo $page_title; ?></h1>

                <form>
                    <fieldset>
						<legend>Principal</legend>
						<label for="principal-firstname" id="label-principal-firstname"><span class="sr-only">Principal </span>Firstname</label>
						<input disabled type="text" value="<?php echo $currentInstance->getPrincipalFirstname();  ?>" id="principal-firstname" name="principalFirstname" aria-invalid="false" aria-labelledby="label-principal-firstname"><br />
						<label for="principal-lastname" id="label-principal-lastname"><span class="sr-only">Principal </span>Lastname</label>
						<input disabled type="text" value="<?php echo $currentInstance->getPrincipalLastname();  ?>" id="principal-lastname" name="principalLastname" aria-invalid="false" aria-labelledby="label-principal-lastname"><br />
						<label for="principal-affiliation" id="label-principal-affiliation"><span class="sr-only">Principal</span> Affiliation</label>
						<select disabled id="principal-affiliation" name="principalAffiliation" aria-invalid="false" aria-labelledby="label-principal-affiliation">
							<option value="<?php echo $currentInstance->getPrincipalAffiliation(); ?>"><?php echo $currentInstance->getPrincipalAffiliation(); ?></option>
						</select><br />
						<label for="principal-h-s-contact" id="label-principal-h-s-contact"><span class="sr-only">Principal is </span>H&amp;S Contact?</label>
						<input disabled id="principal-h-s-contact" name="principalHSContact" type="checkbox" value="1" <?php echo ($currentInstance->principalHSContactIsChecked()) ? 'checked' : ''; ?> aria-labelledby="label-principal-h-s-contact">
					</fieldset>

					<fieldset>
						<legend>Custodian</legend>
						<label for="custodian-firstname" id="label-custodian-firstname"><span class="sr-only">Custodian </span>Firstname</label>
						<input disabled type="text" value="<?php echo $currentInstance->getCustodianFirstname();  ?>" id="custodian-firstname" name="custodianFirstname" aria-invalid="false" aria-labelledby="label-custodian-firstname"><br />
						<label for="custodian-lastname" id="label-custodian-lastname"><span class="sr-only">Custodian </span>Lastname</label>
						<input disabled type="text" value="<?php echo $currentInstance->getCustodianLastname();  ?>" id="custodian-lastname" name="custodianLastname" aria-invalid="false" aria-labelledby="label-custodian-lastname"><br />
						<label for="custodian-affiliation" id="label-custodian-affiliation"><span class="sr-only">Custodian </span>Affiliation</label>
						<select disabled id="custodian-affiliation" name="custodianAffiliation" aria-invalid="false" aria-labelledby="label-custodian-affiliation">
							<option value="<?php echo $currentInstance->getCustodianAffiliation(); ?>"><?php echo $currentInstance->getCustodianAffiliation(); ?></option>
						</select><br />
						<label for="custodian-h-s-contact" id="label-custodian-h-s-contact"><span class="sr-only">Custodian is </span>H&amp;S Contact?</span></label>
						<input disabled id="custodian-h-s-contact" name="custodianHSContact" type="checkbox" value="1" <?php echo ($currentInstance->custodianHSContactIsChecked()) ? 'checked' : ''; ?> aria-labelledby="label-custodian-h-s-contact">
					</fieldset>

					<fieldset>
						<legend>Staff Member 1</legend>
						<label for="staff-member-1-firstname" id="label-staff-member-1-firstname"><span class="sr-only">Staff Member 1 </span>Firstname</label>
						<input disabled type="text" value="<?php echo $currentInstance->getStaffMember1Firstname();  ?>" id="staff-member-1-firstname" name="staffMember1Firstname" aria-invalid="false" aria-labelledby="label-staff-member-1-firstname"><br />
						<label for="staff-member-1-lastname" id="label-staff-member-1-lastname"><span class="sr-only">Staff Member 1 </span>Lastname</label>
						<input disabled type="text" value="<?php echo $currentInstance->getStaffMember1Lastname();  ?>" id="staff-member-1-lastname" name="staffMember1Lastname" aria-invalid="false" aria-labelledby="label-staff-member-1-lastname"><br />
						<label for="staff-member-1-affiliation" id="label-staff-member-1-affiliation"><span class="sr-only">Staff Member 1 </span>Affiliation</label>
						<select disabled id="staff-member-1-affiliation" name="staffMember1Affiliation" aria-invalid="false" aria-labelledby="label-staff-member-1-affiliation">
							<option value="<?php echo $currentInstance->getStaffMember1Affiliation(); ?>"><?php echo $currentInstance->getStaffMember1Affiliation(); ?></option>
						</select><br />
						<label for="staff-member-1-h-s-contact" id="label-staff-member-1-h-s-contact"><span class="sr-only">Staff Member 1 is</span>H&amp;S Contact?</label>
						<input disabled id="staff-member-1-h-s-contact" name="staffMember1HSContact" type="checkbox" value="1" <?php echo ($currentInstance->staffMember1HSContactIsChecked()) ? 'checked' : ''; ?> aria-labelledby="label-staff-member-1-h-s-contact">
					</fieldset>

					<fieldset>
						<legend>Staff Member 2</legend>
						<label for="staff-member-2-firstname" id="label-staff-member-2-firstname"><span class="sr-only">Staff Member 2 </span>Firstname</label>
						<input disabled type="text" value="<?php echo $currentInstance->getStaffMember2Firstname();  ?>" id="staff-member-2-firstname" name="staffMember2Firstname" aria-invalid="false" aria-labelledby="label-staff-member-2-firstname"><br />
						<label for="staff-member-2-lastname" id="label-staff-member-2-lastname"><span class="sr-only">Staff Member 2 </span>Lastname</label>
						<input disabled type="text" value="<?php echo $currentInstance->getStaffMember2Lastname();  ?>" id="staff-member-2-lastname" name="staffMember2Lastname" aria-invalid="false" aria-labelledby="label-staff-member-2-lastname"><br />
						<label for="staff-member-2-affiliation" id="label-staff-member-2-affiliation"><span class="sr-only">Staff Member 2 </span>Affiliation</label>
						<select disabled id="staff-member-2-affiliation" name="staffMember2Affiliation" aria-invalid="false" aria-labelledby="label-staff-member-2-affiliation">
							<option value="<?php echo $currentInstance->getStaffMember2Affiliation() === ''; ?>"><?php echo $currentInstance->getStaffMember2Affiliation(); ?></option>
						</select><br />
						<label for="staff-member-2-h-s-contact" id="label-staff-member-2-h-s-contact"><span class="sr-only">Staff Member 2 is </span>H&amp;S Contact?</label>
						<input disabled id="staff-member-2-h-s-contact" name="staffMember2HSContact" type="checkbox" value="1" <?php echo ($currentInstance->staffMember2HSContactIsChecked()) ? 'checked' : ''; ?> aria-labelledby="label-staff-member-2-h-s-contact">
					</fieldset>

					<fieldset>
						<legend>Staff Member 3</legend>
						<label for="staff-member-3-firstname" id="label-staff-member-3-firstname"><span class="sr-only">Staff Member 3 </span>Firstname</label>
						<input disabled type="text" value="<?php echo $currentInstance->getStaffMember3Firstname();  ?>" id="staff-member-3-firstname" name="staffMember3Firstname" aria-invalid="false" aria-labelledby="label-staff-member-3-firstname"><br />
						<label for="staff-member-3-lastname" id="label-staff-member-3-lastname"><span class="sr-only">Staff Member 3 </span>Lastname</label>
						<input disabled type="text" value="<?php echo $currentInstance->getStaffMember3Lastname();  ?>" id="staff-member-3-lastname" name="staffMember3Lastname" aria-invalid="false" aria-labelledby="label-staff-member-3-lastname"><br />
						<label for="staff-member-3-affiliation" id="label-staff-member-3-affiliation"><span class="sr-only">Staff Member 3 </span>Affiliation</label>
						<select disabled id="staff-member-3-affiliation" name="staffMember3Affiliation" aria-invalid="false" aria-labelledby="label-staff-member-3-affiliation">
							<option value="<?php echo $currentInstance->getStaffMember3Affiliation() === ''; ?>"><?php echo $currentInstance->getStaffMember3Affiliation(); ?></option>
						</select><br />
						<label for="staff-member-3-h-s-contact" id="label-staff-member-3-h-s-contact"><span class="sr-only">Staff Member 3 is </span>H&amp;S Contact?</label>
						<input disabled id="staff-member-3-h-s-contact" name="staffMember3HSContact" type="checkbox" value="1" <?php echo ($currentInstance->staffMember3HSContactIsChecked()) ? 'checked' : ''; ?> aria-labelledby="label-staff-member-3-h-s-contact">
					</fieldset>

					<fieldset>
						<legend>Staff Member 4</legend>
						<label for="staff-member-4-firstname" id="label-staff-member-4-firstname"><span class="sr-only">Staff Member 4 </span>Firstname</label>
						<input disabled type="text" value="<?php echo $currentInstance->getStaffMember4Firstname();  ?>" id="staff-member-4-firstname" name="staffMember4Firstname" aria-invalid="false" aria-labelledby="label-staff-member-4-firstname"><br />
						<label for="staff-member-4-lastname" id="label-staff-member-4-lastname"><span class="sr-only">Staff Member 4 </span>Lastname</label>
						<input disabled type="text" value="<?php echo $currentInstance->getStaffMember4Lastname();  ?>" id="staff-member-4-lastname" name="staffMember4Lastname" aria-invalid="false" aria-labelledby="label-staff-member-4-lastname"><br />
						<label for="staff-member-4-affiliation" id="label-staff-member-4-affiliation"><span class="sr-only">Staff Member 4 </span>Affiliation</label>
						<select disabled id="staff-member-4-affiliation" name="staffMember4Affiliation" aria-invalid="false" aria-labelledby="label-staff-member-4-affiliation">
							<option value="<?php echo $currentInstance->getStaffMember4Affiliation() === ''; ?>"><?php echo $currentInstance->getStaffMember4Affiliation(); ?></option>
						</select><br />
						<label for="staff-member-4-h-s-contact" id="label-staff-member-4-h-s-contact"><span class="sr-only">Staff Member 4 is </span>H&amp;S Contact?</label>
						<input disabled id="staff-member-4-h-s-contact" name="staffMember4HSContact" type="checkbox" value="1" <?php echo ($currentInstance->staffMember4HSContactIsChecked()) ? 'checked' : ''; ?> aria-labelledby="label-staff-member-4-h-s-contact">
					</fieldset>
                </form>
                <!-- /CONTENT -->
            </div>
        <?php } ?>
    </div>
</div>

<?php WPCore::getFooter();
