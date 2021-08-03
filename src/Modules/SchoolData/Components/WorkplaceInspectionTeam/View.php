<?php
namespace WRDSB\Staff\Modules\SchoolData\Components;
use WRDSB\Staff\Modules\WP\WPCore as WPCore;
use WRDSB\Staff\Modules\SchoolData\SchoolDataModule as Module;
//use WRDSB\Staff\Modules\SchoolData\Model\WorkplaceInspectionTeam as Model;

//$apiKey = Module::getCodexSearchKey();
$schoolCode = strtoupper(WPCore::getOption('wrdsb_school_code'));
$current_user = WPCore::getCurrentUser();
$current_time = WPCore::currentTime();
$page_title = "Workplace Inspection Team";

function setCustomTitle() {
    $page_title = "Workplace Inspection Team";
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
                    <a href="<?php echo WPCore::homeURL(); ?>/school-data/home">School Data</a>
                </li>
				<li>
					<a href="<?php echo WPCore::homeURL(); ?>/school-data/workplace-inspection-team">WIT</a>
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

				<div class="alert alert-info">
					<p>The Workplace Inspection Team (WIT) keeps the workplace healthy and safe with a team of 3-5 members, including the principal, custodian, and a teacher or other staff members.</p>
					<p>Please review the <a href="https://staff.wrdsb.ca/school-teams/wit/wit-responsibilities/">WIT Responsibilities</a>.</p>
				</div>

				<p class="alert alert-warning">You <strong>must</strong> indicate the one (1) member designed to receive all health and safety correspondence and/or contact from the Health, Safety and Security Department, or the JHSC Co-Chairs.</p>

				<form id="viewWorkplaceInspectionTeam">
                    <input type="hidden" id="blogID" name="blogID" value="<?php echo WPCore::getCurrentBlogID(); ?>">
                    <input type="hidden" id="schoolCode" name="schoolCode" value="<?php echo $schoolCode; ?>">
                    <input type="hidden" id="email" name="email" value="<?php echo $current_user->user_email ?>">

					<p>Fields marked with <span class="required">*</span> are required.</p>
					
					<fieldset>
						<legend>Principal</legend>
						<label for="principal-firstname" id="label-principal-firstname">Principal firstname</label>
						<input type="text" value="" id="principal-firstname" name="principal-firstname" aria-invalid="false" aria-labelledby="label-principal-firstname">
						<label for="principal-lastname" id="label-principal-lastname">Principal lastname</label>
						<input type="text" value="" id="principal-lastname" name="principal-lastname" aria-invalid="false" aria-labelledby="label-principal-lastname">
						<label for="principal-affiliation" id="label-principal-affiliation">Affiliation (Principal) </label></div>
						<select id="principal-affiliation" name="principal-affiliation" aria-invalid="false" aria-labelledby="label-principal-affiliation">	
							<option value="CAMA">CAMA</option>
							<option value="OSSTF">OSSTF</option>
							<option value="CUPE">CUPE</option>
							<option value="SMACA">SMACA</option>
							<option value="ETFO">ETFO</option>
							<option value="WREA">WREA</option>
							<option value="EAA">EAA</option>
							<option value="OSSTF">OSSTF</option>
							<option value="ESS">ESS</option>
							<option value="SSPA" selected="selected">SSPA</option>
							<option value="SSVPA">SSVPA</option>
							<option value="OPC">OPC</option>
							<option value="Management">Management</option>
						</select>
						<label for="principal-h-s-contact" id="label-principal-h-s-contact">H&amp;S Contact? (Principal) </label>
						<input id="principal-h-s-contact" name="principal-h-s-contact" type="checkbox" value="1" aria-labelledby="label-principal-h-s-contact">
					</fieldset>

					<fieldset>
						<legend>Custodian</legend>
						<label for="custodian-firstname" id="label-custodian-firstname">Custodian firstname</label>
						<input type="text" value="" id="custodian-firstname" name="custodian-firstname" aria-invalid="false" aria-describedby="error-708" aria-labelledby="label-custodian-firstname">
						<label for="custodian-lastname" id="label-custodian-lastname">Custodian lastname</label>
						<input type="text" value="" id="custodian-lastname" name="custodian-lastname" aria-invalid="false" aria-describedby="error-1108" aria-labelledby="label-custodian-lastname">
						<label for="custodian-affiliation" id="label-custodian-affiliation">Affiliation (Custodian)</label>
						<select id="custodian-affiliation" name="custodian-affiliation" aria-invalid="false" aria-describedby="error-1100" aria-labelledby="label-custodian-affiliation">
							<option value="CAMA">CAMA</option>
							<option value="OSSTF">OSSTF</option>
							<option value="CUPE" selected="selected">CUPE</option>
							<option value="SMACA">SMACA</option>
							<option value="ETFO">ETFO</option>
							<option value="WREA">WREA</option>
							<option value="EAA">EAA</option>
							<option value="OSSTF">OSSTF</option>
							<option value="ESS">ESS</option>
							<option value="SSPA">SSPA</option>
							<option value="SSVPA">SSVPA</option>
							<option value="OPC">OPC</option>
							<option value="Management">Management</option>
						</select>
						<label for="custodian-h-s-contact" id="label-custodian-h-s-contact">H&amp;S Contact? (Custodian)</label>
						<input id="custodian-h-s-contact" name="custodian-h-s-contact" aria-describedby="error-710" type="checkbox" value="1" aria-labelledby="label-custodian-h-s-contact">
					</fieldset>

					<fieldset>
						<legend>Staff Member 1</legend>
						<label for="staff-member-1-firstname" id="label-staff-member-1-firstname">Staff Member 1 firstname</label>
						<input type="text" value="" id="staff-member-1-firstname" name="staff-member-1-firstname" aria-invalid="false" aria-describedby="error-708" aria-labelledby="label-staff-member-1-firstname">
						<label for="staff-member-1-lastname" id="label-staff-member-1-lastname">Staff Member 1 lastname</label>
						<input type="text" value="" id="staff-member-1-lastname" name="staff-member-1-lastname" aria-invalid="false" aria-describedby="error-1108" aria-labelledby="label-staff-member-1-lastname">
						<label for="staff-member-1-affiliation" id="label-staff-member-1-affiliation">Affiliation (Staff Member 1)</label>
						<select id="staff-member-1-affiliation" name="staff-member-1-affiliation" aria-invalid="false" aria-describedby="error-1100" aria-labelledby="label-staff-member-1-affiliation">
							<option value="CAMA">CAMA</option>
							<option value="OSSTF">OSSTF</option>
							<option value="CUPE" selected="selected">CUPE</option>
							<option value="SMACA">SMACA</option>
							<option value="ETFO">ETFO</option>
							<option value="WREA">WREA</option>
							<option value="EAA">EAA</option>
							<option value="OSSTF">OSSTF</option>
							<option value="ESS">ESS</option>
							<option value="SSPA">SSPA</option>
							<option value="SSVPA">SSVPA</option>
							<option value="OPC">OPC</option>
							<option value="Management">Management</option>
						</select>
						<label for="staff-member-1-h-s-contact" id="label-staff-member-1-h-s-contact">H&amp;S Contact? (Staff Member 1)</label>
						<input id="staff-member-1-h-s-contact" name="staff-member-1-h-s-contact" aria-describedby="error-710" type="checkbox" value="1" aria-labelledby="label-staff-member-1-h-s-contact">
					</fieldset>

					<fieldset>
						<legend>Staff Member 2</legend>
						<label for="staff-member-2-firstname" id="label-staff-member-2-firstname">Staff Member 2 firstname</label>
						<input type="text" value="" id="staff-member-2-firstname" name="staff-member-2-firstname" aria-invalid="false" aria-describedby="error-708" aria-labelledby="label-staff-member-2-firstname">
						<label for="staff-member-2-lastname" id="label-staff-member-2-lastname">Staff Member 2 lastname</label>
						<input type="text" value="" id="staff-member-2-lastname" name="staff-member-2-lastname" aria-invalid="false" aria-describedby="error-1108" aria-labelledby="label-staff-member-2-lastname">
						<label for="staff-member-2-affiliation" id="label-staff-member-2-affiliation">Affiliation (Staff Member 2)</label>
						<select id="staff-member-2-affiliation" name="staff-member-2-affiliation" aria-invalid="false" aria-describedby="error-1100" aria-labelledby="label-staff-member-2-affiliation">
							<option value="CAMA">CAMA</option>
							<option value="OSSTF">OSSTF</option>
							<option value="CUPE" selected="selected">CUPE</option>
							<option value="SMACA">SMACA</option>
							<option value="ETFO">ETFO</option>
							<option value="WREA">WREA</option>
							<option value="EAA">EAA</option>
							<option value="OSSTF">OSSTF</option>
							<option value="ESS">ESS</option>
							<option value="SSPA">SSPA</option>
							<option value="SSVPA">SSVPA</option>
							<option value="OPC">OPC</option>
							<option value="Management">Management</option>
						</select>
						<label for="staff-member-2-h-s-contact" id="label-staff-member-2-h-s-contact">H&amp;S Contact? (Staff Member 2)</label>
						<input id="staff-member-2-h-s-contact" name="staff-member-2-h-s-contact" aria-describedby="error-710" type="checkbox" value="1" aria-labelledby="label-staff-member-2-h-s-contact">
					</fieldset>

					<fieldset>
						<legend>Staff Member 4</legend>
						<label for="staff-member-3-firstname" id="label-staff-member-3-firstname">Staff Member 4 firstname</label>
						<input type="text" value="" id="staff-member-3-firstname" name="staff-member-3-firstname" aria-invalid="false" aria-describedby="error-708" aria-labelledby="label-staff-member-3-firstname">
						<label for="staff-member-3-lastname" id="label-staff-member-3-lastname">Staff Member 4 lastname</label>
						<input type="text" value="" id="staff-member-3-lastname" name="staff-member-3-lastname" aria-invalid="false" aria-describedby="error-1108" aria-labelledby="label-staff-member-3-lastname">
						<label for="staff-member-3-affiliation" id="label-staff-member-3-affiliation">Affiliation (Staff Member 4)</label>
						<select id="staff-member-3-affiliation" name="staff-member-3-affiliation" aria-invalid="false" aria-describedby="error-1100" aria-labelledby="label-staff-member-3-affiliation">
							<option value="CAMA">CAMA</option>
							<option value="OSSTF">OSSTF</option>
							<option value="CUPE" selected="selected">CUPE</option>
							<option value="SMACA">SMACA</option>
							<option value="ETFO">ETFO</option>
							<option value="WREA">WREA</option>
							<option value="EAA">EAA</option>
							<option value="OSSTF">OSSTF</option>
							<option value="ESS">ESS</option>
							<option value="SSPA">SSPA</option>
							<option value="SSVPA">SSVPA</option>
							<option value="OPC">OPC</option>
							<option value="Management">Management</option>
						</select>
						<label for="staff-member-3-h-s-contact" id="label-staff-member-3-h-s-contact">H&amp;S Contact? (Staff Member 4)</label>
						<input id="staff-member-3-h-s-contact" name="staff-member-3-h-s-contact" aria-describedby="error-710" type="checkbox" value="1" aria-labelledby="label-staff-member-3-h-s-contact">
					</fieldset>

					<fieldset>
						<legend>Staff Member 4</legend>
						<label for="staff-member-4-firstname" id="label-staff-member-4-firstname">Staff Member 4 firstname</label>
						<input type="text" value="" id="staff-member-4-firstname" name="staff-member-4-firstname" aria-invalid="false" aria-describedby="error-708" aria-labelledby="label-staff-member-4-firstname">
						<label for="staff-member-4-lastname" id="label-staff-member-4-lastname">Staff Member 4 lastname</label>
						<input type="text" value="" id="staff-member-4-lastname" name="staff-member-4-lastname" aria-invalid="false" aria-describedby="error-1108" aria-labelledby="label-staff-member-4-lastname">
						<label for="staff-member-4-affiliation" id="label-staff-member-4-affiliation">Affiliation (Staff Member 4)</label>
						<select id="staff-member-4-affiliation" name="staff-member-4-affiliation" aria-invalid="false" aria-describedby="error-1100" aria-labelledby="label-staff-member-4-affiliation">
							<option value="CAMA">CAMA</option>
							<option value="OSSTF">OSSTF</option>
							<option value="CUPE" selected="selected">CUPE</option>
							<option value="SMACA">SMACA</option>
							<option value="ETFO">ETFO</option>
							<option value="WREA">WREA</option>
							<option value="EAA">EAA</option>
							<option value="OSSTF">OSSTF</option>
							<option value="ESS">ESS</option>
							<option value="SSPA">SSPA</option>
							<option value="SSVPA">SSVPA</option>
							<option value="OPC">OPC</option>
							<option value="Management">Management</option>
						</select>
						<label for="staff-member-4-h-s-contact" id="label-staff-member-4-h-s-contact">H&amp;S Contact? (Staff Member 4)</label>
						<input id="staff-member-4-h-s-contact" name="staff-member-4-h-s-contact" aria-describedby="error-710" type="checkbox" value="1" aria-labelledby="label-staff-member-4-h-s-contact">
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
