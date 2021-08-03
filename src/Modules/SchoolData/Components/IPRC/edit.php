<?php
namespace WRDSB\Staff\Modules\SchoolData\Components;
use WRDSB\Staff\Modules\WP\WPCore as WPCore;
use WRDSB\Staff\Modules\SchoolData\SchoolDataModule as Module;
//use WRDSB\Staff\Modules\SchoolData\Model\IPRC as Model;

//$apiKey = Module::getCodexSearchKey();
$schoolCode = strtoupper(WPCore::getOption('wrdsb_school_code'));
$current_user = WPCore::getCurrentUser();
$current_time = WPCore::currentTime();
$page_title = "Edit IPRC";

function setCustomTitle() {
    $page_title = "Edit IPRC";
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
                <form id="editIPRC">

                    <h1><?php echo $page_title; ?></h1>

                    <input type="hidden" id="blogID" name="blogID" value="<?php echo WPCore::getCurrentBlogID(); ?>">
                    <input type="hidden" id="schoolCode" name="schoolCode" value="<?php echo $schoolCode; ?>">
                    <input type="hidden" id="email" name="email" value="<?php echo $current_user->user_email ?>">

					<p>Fields marked with <span class="required">*</span> are required.</p>
					
					<fieldset>
						<legend>Principal</legend>
						<label for="principal-firstname" id="label-principal-firstname">Principal firstname</label>
						<input type="text" value="" id="principal-firstname" name="principal-firstname" aria-invalid="false" aria-labelledby="label-principal-firstname">
						<label for="principal-lastname" id="label-principal">Principal lastname</label>
						<input type="text" value="" id="principal-lastname" name="principal-lastname" aria-invalid="false" aria-labelledby="label-principal-lastname">
					</fieldset>

					<fieldset>
						<legend>Teacher 1</legend>
						<label for="teacher-1-firstname" id="label-teacher-1-firstname">Teacher 1 firstname</label>
						<input type="text" value="" id="teacher-1-firstname" name="teacher-1-firstname" aria-invalid="false" aria-labelledby="label-teacher-1-firstname">
						<label for="teacher-1-lastname" id="teacher-1-lastname">Teacher 1 lastname</label>
						<input type="text" value="" id="teacher-1-lastname" name="teacher-1-lastname" aria-invalid="false" aria-labelledby="label-teacher-1-lastname">
					</fieldset>

					<fieldset>
						<legend>Teacher 2</legend>
						<label for="teacher-2-firstname" id="label-teacher-2-firstname">Teacher 2 firstname</label>
						<input type="text" value="" id="teacher-2-firstname" name="teacher-2-firstname" aria-invalid="false" aria-labelledby="label-teacher-2-firstname">
						<label for="teacher-2-lastname" id="teacher-2-lastname">Teacher 2 lastname</label>
						<input type="text" value="" id="teacher-2-lastname" name="teacher-2-lastname" aria-invalid="false" aria-labelledby="label-teacher-2-lastname">
					</fieldset>

					<fieldset>
						<legend>Teacher 3</legend>
						<label for="teacher-3-firstname" id="label-teacher-3-firstname">Teacher 3 firstname</label>
						<input type="text" value="" id="teacher-3-firstname" name="teacher-3-firstname" aria-invalid="false" aria-labelledby="label-teacher-3-firstname">
						<label for="teacher-3-lastname" id="teacher-3-lastname">Teacher 3 lastname</label>
						<input type="text" value="" id="teacher-3-lastname" name="teacher-3-lastname" aria-invalid="false" aria-labelledby="label-teacher-3-lastname">
					</fieldset>	

					<fieldset>
						<legend>Teacher 4</legend>
						<label for="teacher-4-firstname" id="label-teacher-4-firstname">Teacher 4 firstname</label>
						<input type="text" value="" id="teacher-4-firstname" name="teacher-4-firstname" aria-invalid="false" aria-labelledby="label-teacher-4-firstname">
						<label for="teacher-4-lastname" id="teacher-4-lastname">Teacher 4 lastname</label>
						<input type="text" value="" id="teacher-4-lastname" name="teacher-4-lastname" aria-invalid="false" aria-labelledby="label-teacher-4-lastname">
					</fieldset>

					<fieldset>
						<legend>Teacher 5</legend>
						<label for="teacher-5-firstname" id="label-teacher-5-firstname">Teacher 5 firstname</label>
						<input type="text" value="" id="teacher-5-firstname" name="teacher-5-firstname" aria-invalid="false" aria-labelledby="label-teacher-5-firstname">
						<label for="teacher-5-lastname" id="teacher-5-lastname">Teacher 5 lastname</label>
						<input type="text" value="" id="teacher-5-lastname" name="teacher-5-lastname" aria-invalid="false" aria-labelledby="label-teacher-5-lastname">
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
