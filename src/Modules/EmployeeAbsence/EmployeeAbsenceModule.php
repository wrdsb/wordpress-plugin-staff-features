<?php
namespace WRDSB\Staff\Modules\EmployeeAbsence;

class EmployeeAbsenceModule
{
    private $plugin;

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    public function __construct($plugin)
    {
        $this->plugin      = $plugin;
        $this->plugin_name = $plugin->getPluginName();
        $this->version     = $plugin->getVersion();
    }

    public function init()
    {
        $this->addQueryVar();
        $this->addRewriteRules();
        $this->addViews();
        $this->addPageTemplates();

        $this->plugin->addAction('wp_enqueue_scripts', $this, 'enqueueStyles');
        $this->plugin->addAction('wp_enqueue_scripts', $this, 'enqueueScripts');

        $this->plugin->addAction('admin_post_absence_form_submit', $this, 'absenceFormSubmit');
    }

    /**
     * Register the stylesheets for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueueStyles()
    {
        wp_enqueue_style(
            $this->plugin_name,
            plugin_dir_url(__FILE__) . 'assets/css/employee-absence.css',
            array(),
            $this->version,
            'all'
        );
    }

    /**
     * Register the JavaScript for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueueScripts()
    {
        wp_enqueue_script(
            $this->plugin_name,
            plugin_dir_url(__FILE__) . 'assets/js/employee-absence.js',
            array('jquery'),
            $this->version,
            false
        );
    }

    public function absenceFormSubmit()
    {
        //wp_redirect('your location');

        print_r($_POST);

        $submission = $_POST;
        $functionKey = CMA_ABSENCE_FORM_SUBMIT_KEY;

        $body = $submission;
        
        $url = "https://wrdsb-cma.azurewebsites.net/api/absence-form-submit?code={$functionKey}";
        $args = array(
            'timeout'     => 5,
            'redirection' => 5,
            'httpversion' => '1.0',
            'user-agent'  => 'cma/wordpress',
            'blocking'    => true,
            'headers'     => array(
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ),
            'cookies'     => array(),
            'body'        => json_encode($body),
            'compress'    => false,
            'decompress'  => true,
            'sslverify'   => false,
            'stream'      => false,
            'filename'    => null
        );
        $response = wp_remote_post($url, $args);
        $response_object = json_decode($response['body'], $assoc = false);

        print_r($response_object);
    }

    private function absenceFormValidate($submission)
    {
        return true;
    }

    private function addQueryVar()
    {
        $this->plugin->addQueryVar('id');
        $this->plugin->addQueryVar('date');
        $this->plugin->addQueryVar('employee');
    }

    private function addRewriteRules()
    {
        $this->plugin->addRewriteRule('^employee/absence/types$', 'index.php?view=absence-type-list');
        $this->plugin->addRewriteRule('^employee/absence/type/([^/]*)/?', 'index.php?view=absence-type-detail&id=$matches[1]');

        $this->plugin->addRewriteRule('^employee/absence/parts$', 'index.php?view=absence-part-list');
        $this->plugin->addRewriteRule('^employee/absence/parts/([^/]*)/?', 'index.php?view=absence-part-list&date=$matches[1]');
        $this->plugin->addRewriteRule('^employee/absence/part/([^/]*)/?', 'index.php?view=absence-part-detail&id=$matches[1]');

        $this->plugin->addRewriteRule('^employee/absences$', 'index.php?view=absence-list');
        $this->plugin->addRewriteRule('^employee/absences/([^/]*)/?', 'index.php?view=absence-list&date=$matches[1]');
        $this->plugin->addRewriteRule('^employee/absence/new$', 'index.php?view=absence-new');
        $this->plugin->addRewriteRule('^employee/absence/quick-add$', 'index.php?view=absence-quick-add');
        $this->plugin->addRewriteRule('^employee/absence/([^/]*)/edit', 'index.php?view=absence-edit&id=$matches[1]');
        $this->plugin->addRewriteRule('^employee/absence/([^/]*)/?', 'index.php?view=absence-detail&id=$matches[1]');

        $this->plugin->addRewriteRule('^employee/([^/]*)/absences', 'index.php?view=absence-list&employee=$matches[1]');
        $this->plugin->addRewriteRule('^employee/([^/]*)/absence/parts', 'index.php?view=absence-part-list&employee=$matches[1]');
    }

    private function addViews()
    {
        $this->plugin->addView('absence-type-list', 'absence-type-list');
        $this->plugin->addView('absence-type-detail', 'absence-type-detail');

        $this->plugin->addView('absence-part-list', 'absence-part-list');
        $this->plugin->addView('absence-part-detail', 'absence-part-detail');

        $this->plugin->addView('absence-list', 'absence-list');
        $this->plugin->addView('absence-detail', 'absence-detail');
        $this->plugin->addView('absence-new', 'absence-new');
        $this->plugin->addView('absence-quick-add', 'absence-quick-add');
        $this->plugin->addView('absence-edit', 'absence-edit');
    }

    private function addPageTemplates()
    {
        $this->plugin->addPageTemplate('absence-type-list', 'EmployeeAbsence/Components/AbsenceTypeList/AbsenceTypeList.php');
        $this->plugin->addPageTemplate('absence-type-detail', 'EmployeeAbsence/Components/AbsenceTypeDetail/AbsenceTypeDetail.php');

        $this->plugin->addPageTemplate('absence-part-list', 'EmployeeAbsence/Components/AbsencePartList/AbsencePartList.php');
        $this->plugin->addPageTemplate('absence-part-detail', 'EmployeeAbsence/Components/AbsencePartDetail/AbsencePartDetail.php');

        $this->plugin->addPageTemplate('absence-list', 'EmployeeAbsence/Components/AbsenceList/AbsenceList.php');
        $this->plugin->addPageTemplate('absence-detail', 'EmployeeAbsence/Components/AbsenceDetail/AbsenceDetail.php');
        $this->plugin->addPageTemplate('absence-new', 'EmployeeAbsence/Components/AbsenceNew/AbsenceNew.php');
        $this->plugin->addPageTemplate('absence-quick-add', 'EmployeeAbsence/Components/AbsenceQuickAdd/AbsenceQuickAdd.php');
        $this->plugin->addPageTemplate('absence-edit', 'EmployeeAbsence/Components/AbsenceEdit/AbsenceEdit.php');
    }
}
