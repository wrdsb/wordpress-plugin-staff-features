<?php
namespace WRDSB\Staff\Modules\SchoolData\Components;
use WRDSB\Staff\Modules\WP\WPCore as WPCore;
use WRDSB\Staff\Modules\SchoolData\SchoolDataModule as Module;
//use WRDSB\Staff\Modules\SchoolData\Model\SCISTeam as Model;

//$apiKey = Module::getCodexSearchKey();
$schoolCode = strtoupper(WPCore::getOption('wrdsb_school_code'));
$current_user = WPCore::getCurrentUser();
$current_time = WPCore::currentTime();
$page_title = "SCIS Team";

function setCustomTitle() {
    $page_title = "SCIS Team";
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

				<div class="alert alert-info">
					<p>Each school must have in place a Safe, Caring and Inclusive Schools team. The school-based Safe, Caring and Inclusive Schools team will operate in accordance with the <a href="https://staff.wrdsb.ca/learning-services/safe-caring-and-inclusive-schools/safe-caring-and-inclusive-schools/" target="_blank" rel="noopener noreferrer">SCIS Terms of Reference</a>, school Code of Conduct, Board policies and procedures, Ministry of Education directions for school boards, and align with other relevant legislation, including the Canadian Charter of Rights and Freedoms and the Ontario Human Rights Code.</p>
					<p>Safe, Caring and Inclusive Schools teams will consist of a minimum of seven members, as follows:</p>
						<ul>
							<li>Administrator (1)</li>
							<li>Teacher (1)</li>
							<li>Paraprofessional (1 – CYW, EA, etc.)</li>
							<li>Parent (1)</li>
							<li>Community Member (1)</li>
							<li>Student (2)</li>
						</ul>
					<p>One staff member should be identified as the school's Indigenous &amp; Equity Liaison. This staff member can be a teacher, paraprofessional and, if necessary, an administrator (administrator(s) can be identified as a contact in addition to a staff member). The role will be to share messaging with staff from the Indigenous, Equity, and Human Rights Department (IEHR).</p>
					<p>Please review the <a href="https://staff.wrdsb.ca/school-teams/scis/scis-team-responsibilities/">SCIS Team Responsibilities</a>.</p>
				</div>

				<form id="viewSCISTeam">
                    <input type="hidden" id="blogID" name="blogID" value="<?php echo WPCore::getCurrentBlogID(); ?>">
                    <input type="hidden" id="schoolCode" name="schoolCode" value="<?php echo $schoolCode; ?>">
                    <input type="hidden" id="email" name="email" value="<?php echo $current_user->user_email ?>">

					<p>Fields marked with <span class="required">*</span> are required.</p>
					
					<fieldset>
						<legend>Administrator</legend>
						<label for="student-3-firstname" id="label-student-3-firstname">Administrator firstname</label>
						<input type="text" value="" id="student-3-firstname" name="student-3-firstname" aria-invalid="false" aria-labelledby="label-student-3-firstname">
						<label for="student-3-lastname" id="label-student-3-lastname">Administrator lastname</label>
						<input type="text" value="" id="student-3-lastname" name="student-3-lastname" aria-invalid="false" aria-labelledby="label-student-3-lastname">
						<label for="student-3-i-e-liasion" id="label-student-3-i-e-liasion">Indigenous &amp; Equity Liaison</label>
						<input id="student-3-i-e-liasion" name="student-3-i-e-liasion" type="checkbox" value="1" aria-labelledby="label-student-3-i-e-liasion">
					</fieldset>

					<fieldset>
						<legend>Teacher</legend>
						<label for="teacher-firstname" id="label-teacher-firstname">Teacher firstname</label>
						<input type="text" value="" id="teacher-firstname" name="teacher-firstname" aria-invalid="false" aria-labelledby="label-teacher-firstname">
						<label for="teacher-lastname" id="label-teacher-lastname">Teacher lastname</label>
						<input type="text" value="" id="teacher-lastname" name="teacher-lastname" aria-invalid="false" aria-labelledby="label-teacher-lastname">
						<label for="teacher-i-e-liasion" id="label-teacher-i-e-liasion">Indigenous &amp; Equity Liaison</label>
						<input id="teacher-i-e-liasion" name="teacher-i-e-liasion" type="checkbox" value="1" aria-labelledby="label-teacher-i-e-liasion">
					</fieldset>

					<fieldset>
						<legend>Paraprofessional (CYW, EA, etc)</legend>
						<label for="paraprofessional-firstname" id="label-paraprofessional-firstname">Paraprofessional (CYW, EA, etc) firstname</label>
						<input type="text" value="" id="paraprofessional-firstname" name="paraprofessional-firstname" aria-invalid="false" aria-labelledby="label-paraprofessional-firstname">
						<label for="paraprofessional-lastname" id="label-paraprofessional-lastname">Paraprofessional (CYW, EA, etc) lastname</label>
						<input type="text" value="" id="paraprofessional-lastname" name="paraprofessional-lastname" aria-invalid="false" aria-labelledby="label-paraprofessional-lastname">
						<label for="paraprofessional-i-e-liasion" id="label-paraprofessional-i-e-liasion">Indigenous &amp; Equity Liaison</label>
						<input id="paraprofessional-i-e-liasion" name="paraprofessional-i-e-liasion" type="checkbox" value="1" aria-labelledby="label-paraprofessional-i-e-liasion">
					</fieldset>

					<fieldset>
						<legend>Parent</legend>
						<label for="parent-firstname" id="label-parent-firstname">Administrator firstname</label>
						<input type="text" value="" id="parent-firstname" name="parent-firstname" aria-invalid="false" aria-labelledby="label-parent-firstname">
						<label for="parent-lastname" id="label-parent-lastname">Administrator lastname</label>
						<input type="text" value="" id="parent-lastname" name="parent-lastname" aria-invalid="false" aria-labelledby="label-parent-lastname">
						<label for="parent-i-e-liasion" id="label-parent-i-e-liasion">Indigenous &amp; Equity Liaison</label>
						<input id="parent-i-e-liasion" name="parent-i-e-liasion" type="checkbox" value="1" aria-labelledby="label-parent-i-e-liasion">
					</fieldset>

					<fieldset>
						<legend>Community Member</legend>
						<label for="community-member-firstname" id="label-community-member-firstname">Community Member firstname</label>
						<input type="text" value="" id="community-member-firstname" name="community-member-firstname" aria-invalid="false" aria-labelledby="label-community-member-firstname">
						<label for="community-member-lastname" id="label-community-member-lastname">Community Member lastname</label>
						<input type="text" value="" id="community-member-lastname" name="community-member-lastname" aria-invalid="false" aria-labelledby="label-community-member-lastname">
						<label for="community-member-i-e-liasion" id="label-community-member-i-e-liasion">Indigenous &amp; Equity Liaison</label>
						<input id="community-member-i-e-liasion" name="community-member-i-e-liasion" type="checkbox" value="1" aria-labelledby="label-community-member-i-e-liasion">
					</fieldset>

					<fieldset>
						<legend>Student 1</legend>
						<label for="student-3-firstname" id="label-student-3-firstname">Student 1 firstname</label>
						<input type="text" value="" id="student-3-firstname" name="student-3-firstname" aria-invalid="false" aria-labelledby="label-student-3-firstname">
						<label for="student-3-lastname" id="label-student-3-lastname">Student 1 lastname</label>
						<input type="text" value="" id="student-3-lastname" name="student-3-lastname" aria-invalid="false" aria-labelledby="label-student-3-lastname">
						<label for="student-3-i-e-liasion" id="label-student-3-i-e-liasion">Indigenous &amp; Equity Liaison</label>
						<input id="student-3-i-e-liasion" name="student-3-i-e-liasion" type="checkbox" value="1" aria-labelledby="label-student-3-i-e-liasion">
					</fieldset>

					<fieldset>
						<legend>Student 2</legend>
						<label for="student-2-firstname" id="label-student-2-firstname">Student 2 firstname</label>
						<input type="text" value="" id="student-2-firstname" name="student-2-firstname" aria-invalid="false" aria-labelledby="label-student-2-firstname">
						<label for="student-2-lastname" id="label-student-2-lastname">Student 2 lastname</label>
						<input type="text" value="" id="student-2-lastname" name="student-2-lastname" aria-invalid="false" aria-labelledby="label-student-2-lastname">
						<label for="student-2-i-e-liasion" id="label-student-2-i-e-liasion">Indigenous &amp; Equity Liaison</label>
						<input id="student-2-i-e-liasion" name="student-2-i-e-liasion" type="checkbox" value="1" aria-labelledby="label-student-2-i-e-liasion">
					</fieldset>

					<fieldset>
						<legend>Optional member and role 1</legend>
						<label for="optional-3-firstname" id="label-optional-3-firstname">Optional member and role firstname</label>
						<input type="text" value="" id="optional-3-firstname" name="optional-3-firstname" aria-invalid="false" aria-labelledby="label-optional-3-firstname">
						<label for="optional-3-lastname" id="label-optional-3-lastname">Optional member and role lastname</label>
						<input type="text" value="" id="optional-3-lastname" name="optional-3-lastname" aria-invalid="false" aria-labelledby="label-optional-3-lastname">
						<label for="optional-3-i-e-liasion" id="label-optional-3-i-e-liasion">Indigenous &amp; Equity Liaison</label>
						<input id="optional-3-i-e-liasion" name="optional-3-i-e-liasion" type="checkbox" value="1" aria-labelledby="label-optional-3-i-e-liasion">
					</fieldset>

					<fieldset>
						<legend>Optional member and role 2</legend>
						<label for="optional-2-firstname" id="label-optional-2-firstname">Optional member and role firstname</label>
						<input type="text" value="" id="optional-2-firstname" name="optional-2-firstname" aria-invalid="false" aria-labelledby="label-optional-2-firstname">
						<label for="optional-2-lastname" id="label-optional-2-lastname">Optional member and role lastname</label>
						<input type="text" value="" id="optional-2-lastname" name="optional-2-lastname" aria-invalid="false" aria-labelledby="label-optional-2-lastname">
						<label for="optional-2-i-e-liasion" id="label-optional-2-i-e-liasion">Indigenous &amp; Equity Liaison</label>
						<input id="optional-2-i-e-liasion" name="optional-2-i-e-liasion" type="checkbox" value="1" aria-labelledby="label-optional-2-i-e-liasion">
					</fieldset>

					<fieldset>
						<legend>Optional member and role 3</legend>
						<label for="optional-3-firstname" id="label-optional-3-firstname">Optional member and role firstname</label>
						<input type="text" value="" id="optional-3-firstname" name="optional-3-firstname" aria-invalid="false" aria-labelledby="label-optional-3-firstname">
						<label for="optional-3-lastname" id="label-optional-3-lastname">Optional member and role lastname</label>
						<input type="text" value="" id="optional-3-lastname" name="optional-3-lastname" aria-invalid="false" aria-labelledby="label-optional-3-lastname">
						<label for="optional-3-i-e-liasion" id="label-optional-3-i-e-liasion">Indigenous &amp; Equity Liaison</label>
						<input id="optional-3-i-e-liasion" name="optional-3-i-e-liasion" type="checkbox" value="1" aria-labelledby="label-optional-3-i-e-liasion">
					</fieldset>

					<fieldset>
						<legend>Optional member and role 4</legend>
						<label for="optional-4-firstname" id="label-optional-4-firstname">Optional member and role firstname</label>
						<input type="text" value="" id="optional-4-firstname" name="optional-4-firstname" aria-invalid="false" aria-labelledby="label-optional-4-firstname">
						<label for="optional-4-lastname" id="label-optional-4-lastname">Optional member and role lastname</label>
						<input type="text" value="" id="optional-4-lastname" name="optional-4-lastname" aria-invalid="false" aria-labelledby="label-optional-4-lastname">
						<label for="optional-4-i-e-liasion" id="label-optional-4-i-e-liasion">Indigenous &amp; Equity Liaison</label>
						<input id="optional-4-i-e-liasion" name="optional-4-i-e-liasion" type="checkbox" value="1" aria-labelledby="label-optional-4-i-e-liasion">
					</fieldset>

					<fieldset>
						<legend>Optional member and role 5</legend>
						<label for="optional-5-firstname" id="label-optional-5-firstname">Optional member and role firstname</label>
						<input type="text" value="" id="optional-5-firstname" name="optional-5-firstname" aria-invalid="false" aria-labelledby="label-optional-5-firstname">
						<label for="optional-5-lastname" id="label-optional-5-lastname">Optional member and role lastname</label>
						<input type="text" value="" id="optional-5-lastname" name="optional-5-lastname" aria-invalid="false" aria-labelledby="label-optional-5-lastname">
						<label for="optional-5-i-e-liasion" id="label-optional-5-i-e-liasion">Indigenous &amp; Equity Liaison</label>
						<input id="optional-5-i-e-liasion" name="optional-5-i-e-liasion" type="checkbox" value="1" aria-labelledby="label-optional-5-i-e-liasion">
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
