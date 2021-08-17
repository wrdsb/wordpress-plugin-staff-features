<?php
namespace WRDSB\Staff\Modules\SchoolData\Components;
use WRDSB\Staff\Modules\WP\WPCore as WPCore;
use WRDSB\Staff\Modules\SchoolData\SchoolDataModule as Module;
use WRDSB\Staff\Modules\SchoolData\Model\SCISTeam as Model;

//$apiKey = Module::getCodexSearchKey();
$schoolCode = strtoupper(WPCore::getOption('wrdsb_school_code'));
$current_user = WPCore::getCurrentUser();
$current_time = WPCore::currentTime();
$currentInstance = Model::getInstance();

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
				<p><button><a href="./edit/">Update this Information</a></button></p>

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
						<label for="administrator-firstname" id="label-administrator-firstname"><span class="sr-only">Administrator </span>Firstname</label>
						<input type="text" value="<?php echo $currentInstance->getAdministratorFirstname(); ?>" id="administrator-firstname" name="administratorFirstname" aria-invalid="false" aria-labelledby="label-administrator-firstname"><br />
						<label for="administrator-lastname" id="label-administrator-lastname"><span class="sr-only">Administrator </span>Lastname</label>
						<input type="text" value="<?php echo $currentInstance->getAdministratorLastname(); ?>" id="administrator-lastname" name="administratorLastname" aria-invalid="false" aria-labelledby="label-administrator-lastname"><br />
						<label for="administrator-i-e-liasion" id="label-administrator-i-e-liasion"><span class="sr-only">Administrator is </span>Indigenous &amp; Equity Liaison</label>
						<input id="administrator-i-e-liasion" name="administratorIELiasion" type="checkbox" value="1" <?php echo ($currentInstance->administratorIELiasionIsChecked()) ? 'checked' : ''; ?> aria-labelledby="label-administrator-i-e-liasion">
					</fieldset>

					<fieldset>
						<legend>Teacher</legend>
						<label for="teacher-firstname" id="label-teacher-firstname"><span class="sr-only">Teacher </span>Firstname</label>
						<input type="text" value="<?php echo $currentInstance->getTeacherFirstname(); ?>" id="teacher-firstname" name="teacherFirstname" aria-invalid="false" aria-labelledby="label-teacher-firstname"><br />
						<label for="teacher-lastname" id="label-teacher-lastname"><span class="sr-only">Teacher </span>Lastname</label>
						<input type="text" value="<?php echo $currentInstance->getTeacherLastname(); ?>" id="teacher-lastname" name="teacherLastname" aria-invalid="false" aria-labelledby="label-teacher-lastname"><br />
						<label for="teacher-i-e-liasion" id="label-teacher-i-e-liasion"><span class="sr-only">Teacher is </span>Indigenous &amp; Equity Liaison</label>
						<input id="teacher-i-e-liasion" name="teacherIELiasion" type="checkbox" value="1" <?php echo ($currentInstance->teacherIELiasionIsChecked()) ? 'checked' : ''; ?> aria-labelledby="label-teacher-i-e-liasion">
					</fieldset>

					<fieldset>
						<legend>Paraprofessional (CYW, EA, etc)</legend>
						<label for="paraprofessional-firstname" id="label-paraprofessional-firstname"><span class="sr-only">Paraprofessional (CYW, EA, etc) </span>Firstname</label>
						<input type="text" value="<?php echo $currentInstance->getParaprofessionalFirstname(); ?>" id="paraprofessional-firstname" name="paraprofessionalFirstname" aria-invalid="false" aria-labelledby="label-paraprofessional-firstname"><br />
						<label for="paraprofessional-lastname" id="label-paraprofessional-lastname"><span class="sr-only">Paraprofessional (CYW, EA, etc) </span>Lastname</label>
						<input type="text" value="<?php echo $currentInstance->getParaprofessionalLastname(); ?>" id="paraprofessional-lastname" name="paraprofessionalLastname" aria-invalid="false" aria-labelledby="label-paraprofessional-lastname"><br />
						<label for="paraprofessional-i-e-liasion" id="label-paraprofessional-i-e-liasion">Indigenous &amp; Equity Liaison</label>
						<input id="paraprofessional-i-e-liasion" name="paraprofessionalIELiasion" type="checkbox" value="1" <?php echo ($currentInstance->paraprofessionalIELiasionIsChecked()) ? 'checked' : ''; ?>aria-labelledby="label-paraprofessional-i-e-liasion">
					</fieldset>

					<fieldset>
						<legend>Parent</legend>
						<label for="parent-firstname" id="label-parent-firstname"><span class="sr-only">Parent </span>Firstname</label>
						<input type="text" value="<?php echo $currentInstance->getParentFirstname(); ?>" id="parent-firstname" name="parentFirstname" aria-invalid="false" aria-labelledby="label-parent-firstname"><br />
						<label for="parent-lastname" id="label-parent-lastname"><span class="sr-only">Parent </span>Lastname</label>
						<input type="text" value="<?php echo $currentInstance->getParentLastname(); ?>" id="parent-lastname" name="parentLastname" aria-invalid="false" aria-labelledby="label-parent-lastname"><br />
						<label for="parent-i-e-liasion" id="label-parent-i-e-liasion"><span class="sr-only">Parent is </span>Indigenous &amp; Equity Liaison</label>
						<input id="parent-i-e-liasion" name="parentIELiasion" type="checkbox" value="1" <?php echo ($currentInstance->parentIELiasionIsChecked()) ? 'checked' : ''; ?> aria-labelledby="label-parent-i-e-liasion">
					</fieldset>

					<fieldset>
						<legend>Community Member</legend>
						<label for="community-member-firstname" id="label-community-member-firstname"><span class="sr-only">Community Member </span> Firstname</label>
						<input type="text" value="<?php echo $currentInstance->getCommunityMemberFirstname(); ?>" id="community-member-firstname" name="communityMemberFirstname" aria-invalid="false" aria-labelledby="label-community-member-firstname"><br />
						<label for="community-member-lastname" id="label-community-member-lastname"><span class="sr-only">Community Member </span> Lastname</label>
						<input type="text" value="<?php echo $currentInstance->getCommunityMemberLastname(); ?>" id="community-member-lastname" name="communityMemberLastname" aria-invalid="false" aria-labelledby="label-community-member-lastname"><br />
						<label for="community-member-i-e-liasion" id="label-community-member-i-e-liasion"><span class="sr-only">Community Member is </span>Indigenous &amp; Equity Liaison</label>
						<input id="community-member-i-e-liasion" name="communityMemberIELiasion" type="checkbox" value="1" <?php echo ($currentInstance->communityMemberIELiasionIsChecked()) ? 'checked' : ''; ?> aria-labelledby="label-community-member-i-e-liasion">
					</fieldset>

					<fieldset>
						<legend>Student 1</legend>
						<label for="student-1-firstname" id="label-student-1-firstname"><span class="sr-only">Student 1 </span> Firstname</label>
						<input type="text" value="<?php echo $currentInstance->getStudent1Firstname(); ?>" id="student-1-firstname" name="student1Firstname" aria-invalid="false" aria-labelledby="label-student-1-firstname"><br />
						<label for="student-1-lastname" id="label-student-1-lastname"><span class="sr-only">Student 1 </span> Lastname</label>
						<input type="text" value="<?php echo $currentInstance->getStudent1Lastname(); ?>" id="student-1-lastname" name="student1Lastname" aria-invalid="false" aria-labelledby="label-student-1-lastname"><br />
						<label for="student-1-i-e-liasion" id="label-student-1-i-e-liasion"><span class="sr-only">Student 1 is </span>Indigenous &amp; Equity Liaison</label>
						<input id="student-1-i-e-liasion" name="student1IELiasion" type="checkbox" value="1" <?php echo ($currentInstance->student1IELiasionIsChecked()) ? 'checked' : ''; ?> aria-labelledby="label-student-1-i-e-liasion">
					</fieldset>

					<fieldset>
						<legend>Student 2</legend>
						<label for="student-2-firstname" id="label-student-2-firstname"><span class="sr-only">Student 2 </span> Firstname</label>
						<input type="text" value="<?php echo $currentInstance->getStudent2Firstname(); ?>" id="student-2-firstname" name="student2Firstname" aria-invalid="false" aria-labelledby="label-student-2-firstname"><br />
						<label for="student-2-lastname" id="label-student-2-lastname"><span class="sr-only">Student 2 </span> Lastname</label>
						<input type="text" value="<?php echo $currentInstance->getStudent2Lastname(); ?>" id="student-2-lastname" name="student2Lastname" aria-invalid="false" aria-labelledby="label-student-2-lastname"><br />
						<label for="student-2-i-e-liasion" id="label-student-2-i-e-liasion"><span class="sr-only">Student 2 is </span>Indigenous &amp; Equity Liaison</label>
						<input id="student-2-i-e-liasion" name="student2IELiasion" type="checkbox" value="1" <?php echo ($currentInstance->student2IELiasionIsChecked()) ? 'checked' : ''; ?> aria-labelledby="label-student-2-i-e-liasion">
					</fieldset>

					<fieldset>
						<legend>Optional member and role 1</legend>
						<label for="optional-1-firstname" id="label-optional-1-firstname"><span class="sr-only">Optional member and role 1 </span>Firstname</label>
						<input type="text" value="<?php echo $currentInstance->getOptional1Firstname(); ?>" id="optional-1-firstname" name="optional1Firstname" aria-invalid="false" aria-labelledby="label-optional-1-firstname"><br />
						<label for="optional-1-lastname" id="label-optional-1-lastname"><span class="sr-only">Optional member and role 1 </span>Lastname</label>
						<input type="text" value="<?php echo $currentInstance->getOptional1Lastname(); ?>" id="optional-1-lastname" name="optional1Lastname" aria-invalid="false" aria-labelledby="label-optional-1-lastname"><br />
						<label for="optional-1-i-e-liasion" id="label-optional-1-i-e-liasion"><span class="sr-only">Optional member and role 1 is </span>Indigenous &amp; Equity Liaison</label>
						<input id="optional-1-i-e-liasion" name="optional1IELiasion" type="checkbox" value="1" <?php echo ($currentInstance->optional1IELiasionIsChecked()) ? 'checked' : ''; ?> aria-labelledby="label-optional-1-i-e-liasion">
					</fieldset>

					<fieldset>
						<legend>Optional member and role 2</legend>
						<label for="optional-2-firstname" id="label-optional-2-firstname"><span class="sr-only">Optional member and role 2 </span>Firstname</label>
						<input type="text" value="<?php echo $currentInstance->getOptional2Firstname(); ?>" id="optional-2-firstname" name="optional2Firstname" aria-invalid="false" aria-labelledby="label-optional-2-firstname"><br />
						<label for="optional-2-lastname" id="label-optional-2-lastname"><span class="sr-only">Optional member and role 2 </span>Lastname</label>
						<input type="text" value="<?php echo $currentInstance->getOptional2Lastname(); ?>" id="optional-2-lastname" name="optional2Lastname" aria-invalid="false" aria-labelledby="label-optional-2-lastname"><br />
						<label for="optional-2-i-e-liasion" id="label-optional-2-i-e-liasion"><span class="sr-only">Optional member and role 2 is </span>Indigenous &amp; Equity Liaison</label>
						<input id="optional-2-i-e-liasion" name="optional2IELiasion" type="checkbox" value="1" <?php echo ($currentInstance->optional2IELiasionIsChecked()) ? 'checked' : ''; ?> aria-labelledby="label-optional-2-i-e-liasion">
					</fieldset>

					<fieldset>
						<legend>Optional member and role 3</legend>
						<label for="optional-3-firstname" id="label-optional-3-firstname"><span class="sr-only">Optional member and role 3 </span>Firstname</label>
						<input type="text" value="<?php echo $currentInstance->getOptional3Firstname(); ?>" id="optional-3-firstname" name="optional3Firstname" aria-invalid="false" aria-labelledby="label-optional-3-firstname"><br />
						<label for="optional-3-lastname" id="label-optional-3-lastname"><span class="sr-only">Optional member and role 3 </span>Lastname</label>
						<input type="text" value="<?php echo $currentInstance->getOptional3Lastname(); ?>" id="optional-3-lastname" name="optional3Lastname" aria-invalid="false" aria-labelledby="label-optional-3-lastname"><br />
						<label for="optional-3-i-e-liasion" id="label-optional-3-i-e-liasion"><span class="sr-only">Optional member and role 3 is </span>Indigenous &amp; Equity Liaison</label>
						<input id="optional-3-i-e-liasion" name="optional3IELiasion" type="checkbox" value="1" <?php echo ($currentInstance->optional3IELiasionIsChecked()) ? 'checked' : ''; ?> aria-labelledby="label-optional-3-i-e-liasion">
					</fieldset>

					<fieldset>
						<legend>Optional member and role 4</legend>
						<label for="optional-4-firstname" id="label-optional-4-firstname"><span class="sr-only">Optional member and role 4 </span>Firstname</label>
						<input type="text" value="<?php echo $currentInstance->getOptional4Firstname(); ?>" id="optional-4-firstname" name="optional4Firstname" aria-invalid="false" aria-labelledby="label-optional-4-firstname"><br />
						<label for="optional-4-lastname" id="label-optional-4-lastname"><span class="sr-only">Optional member and role 4 </span>Lastname</label>
						<input type="text" value="<?php echo $currentInstance->getOptional4Lastname(); ?>" id="optional-4-lastname" name="optional4Lastname" aria-invalid="false" aria-labelledby="label-optional-4-lastname"><br />
						<label for="optional-4-i-e-liasion" id="label-optional-4-i-e-liasion"><span class="sr-only">Optional member and role 4 is </span>Indigenous &amp; Equity Liaison</label>
						<input id="optional-4-i-e-liasion" name="optional4IELiasion" type="checkbox" value="1" <?php echo ($currentInstance->optional4IELiasionIsChecked()) ? 'checked' : ''; ?> aria-labelledby="label-optional-4-i-e-liasion">
					</fieldset>

					<fieldset>
						<legend>Optional member and role 5</legend>
						<label for="optional-5-firstname" id="label-optional-5-firstname"><span class="sr-only">Optional member and role 5 </span>Firstname</label>
						<input type="text" value="<?php echo $currentInstance->getOptional5Firstname(); ?>" id="optional-5-firstname" name="optional5Firstname" aria-invalid="false" aria-labelledby="label-optional-5-firstname"><br />
						<label for="optional-5-lastname" id="label-optional-5-lastname"><span class="sr-only">Optional member and role 5 </span>Lastname</label>
						<input type="text" value="<?php echo $currentInstance->getOptional5Lastname(); ?>" id="optional-5-lastname" name="optional5Lastname" aria-invalid="false" aria-labelledby="label-optional-5-lastname"><br />
						<label for="optional-5-i-e-liasion" id="label-optional-5-i-e-liasion"><span class="sr-only">Optional member and role 5 is </span>Indigenous &amp; Equity Liaison</label>
						<input id="optional-5-i-e-liasion" name="optional5IELiasion" type="checkbox" value="1" <?php echo ($currentInstance->optional5IELiasionIsChecked()) ? 'checked' : ''; ?> aria-labelledby="label-optional-5-i-e-liasion">
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
