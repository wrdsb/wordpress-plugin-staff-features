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

        $this->plugin->addAction('admin_enqueue_scripts', $this, 'enqueueStyles');
        $this->plugin->addAction('admin_enqueue_scripts', $this, 'enqueueScripts');
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
            plugin_dir_url(__FILE__) . 'assets/css/front-end.css',
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
            plugin_dir_url(__FILE__) . 'assets/js/front-end.js',
            array( 'jquery' ),
            $this->version,
            false
        );
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

        $this->plugin->addRewriteRule('^employee/absence/slots$', 'index.php?view=absence-slot-list');
        $this->plugin->addRewriteRule('^employee/absence/slots/([^/]*)/?', 'index.php?view=absence-slot-list&date=$matches[1]');
        $this->plugin->addRewriteRule('^employee/absence/slot/([^/]*)/?', 'index.php?view=absence-slot-detail&id=$matches[1]');

        $this->plugin->addRewriteRule('^employee/absences$', 'index.php?view=absence-list');
        $this->plugin->addRewriteRule('^employee/absences/([^/]*)/?', 'index.php?view=absence-list&date=$matches[1]');
        $this->plugin->addRewriteRule('^employee/absence/new$', 'index.php?view=absence-new');
        $this->plugin->addRewriteRule('^employee/absence/([^/]*)/edit', 'index.php?view=absence-edit&id=$matches[1]');
        $this->plugin->addRewriteRule('^employee/absence/([^/]*)/?', 'index.php?view=absence-detail&id=$matches[1]');

        $this->plugin->addRewriteRule('^employee/([^/]*)/absences', 'index.php?view=absence-list&employee=$matches[1]');
        $this->plugin->addRewriteRule('^employee/([^/]*)/absence/slots', 'index.php?view=absence-slot-list&employee=$matches[1]');
    }

    private function addViews()
    {
        $this->plugin->addView('absence-type-list', 'absence-type-list');
        $this->plugin->addView('absence-type-detail', 'absence-type-detail');

        $this->plugin->addView('absence-slot-list', 'absence-slot-list');
        $this->plugin->addView('absence-slot-detail', 'absence-slot-detail');

        $this->plugin->addView('absence-list', 'absence-list');
        $this->plugin->addView('absence-detail', 'absence-detail');
        $this->plugin->addView('absence-new', 'absence-new');
        $this->plugin->addView('absence-edit', 'absence-edit');
    }

    private function addPageTemplates()
    {
        $this->plugin->addPageTemplate('absence-type-list', 'EmployeeAbsence/Components/AbsenceTypeList/AbsenceTypeList.php');
        $this->plugin->addPageTemplate('absence-type-detail', 'EmployeeAbsence/Components/AbsenceTypeDetail/AbsenceTypeDetail.php');

        $this->plugin->addPageTemplate('absence-slot-list', 'EmployeeAbsence/Components/AbsenceSlotList/AbsenceSlotList.php');
        $this->plugin->addPageTemplate('absence-slot-detail', 'EmployeeAbsence/Components/AbsenceSlotDetail/AbsenceSlotDetail.php');

        $this->plugin->addPageTemplate('absence-list', 'EmployeeAbsence/Components/AbsenceList/AbsenceList.php');
        $this->plugin->addPageTemplate('absence-detail', 'EmployeeAbsence/Components/AbsenceDetail/AbsenceDetail.php');
        $this->plugin->addPageTemplate('absence-new', 'EmployeeAbsence/Components/AbsenceNew/AbsenceNew.php');
        $this->plugin->addPageTemplate('absence-edit', 'EmployeeAbsence/Components/AbsenceEdit/AbsenceEdit.php');
    }
}
