<?php
$schoolCode = get_option('wrdsb_school_code');
//$functionKey = CMA_DAY_QUERY_KEY;

function setCustomTitle()
{
    $pageTitle = "Quick Add Employee Absence";
    return $pageTitle;
}
add_filter('pre_get_document_title', 'setCustomTitle');

$body = array(
    'schoolCode' => $schoolCode,
);

$pageTitle = "Quick Add Employee Absence";

$employees = array();

?>

<?php get_header(); ?>

<div class="container container-top">
    <?php
        get_template_part('partials/header', 'masthead');
        get_template_part('partials/header', 'navbar');
    ?>
    <div class="container container-breadcrumb" role="navigation">
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo get_option('home'); ?>">Home</a>
            </li>
            <li>
                Employee Absences
            </li>
            <li>
                <?php echo $pageTitle; ?>
            </li>
        </ol>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-sm-12 col-lg-12" role="main">
            <!-- CONTENT -->
            <h1><?php echo $pageTitle; ?></h1>
            teacher drop down
            select teacher
            display schedule
            each coverage?
            which hal(f|ves)?
            submit
            <!-- /CONTENT -->
        </div>
    </div>
</div>

<?php get_footer();
