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
        $this->addViews();
        $this->addPageTemplates();

        $this->plugin->addAction('wp_enqueue_scripts', $this, 'enqueueStyles');
        $this->plugin->addAction('wp_enqueue_scripts', $this, 'enqueueScripts');
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

        wp_localize_script($this->plugin_name, 'wpApiSettings', array(
            'root' => esc_url_raw( rest_url() ),
            'nonce' => wp_create_nonce('wp_rest')
        ));
    }

    private function addViews()
    {
        $this->plugin->addView('absence-type-list', 'absence-type-list');
        $this->plugin->addView('absence-type-detail', 'absence-type-detail');

        $this->plugin->addView('absence-part-list', 'absence-part-list');
        $this->plugin->addView('absence-part-detail', 'absence-part-detail');

        $this->plugin->addView('absence-form-list', 'absence-form-list');
        $this->plugin->addView('absence-form-view', 'absence-form-view');
        $this->plugin->addView('absence-form-new', 'absence-form-new');
        $this->plugin->addView('absence-form-edit', 'absence-form-edit');

        $this->plugin->addView('absence-quick-add', 'absence-quick-add');
    }

    private function addPageTemplates()
    {
        $this->plugin->addPageTemplate('absence-type-list', 'EmployeeAbsence/Components/AbsenceTypeList/AbsenceTypeList.php');
        $this->plugin->addPageTemplate('absence-type-detail', 'EmployeeAbsence/Components/AbsenceTypeDetail/AbsenceTypeDetail.php');

        $this->plugin->addPageTemplate('absence-part-list', 'EmployeeAbsence/Components/AbsencePartList/AbsencePartList.php');
        $this->plugin->addPageTemplate('absence-part-detail', 'EmployeeAbsence/Components/AbsencePartDetail/AbsencePartDetail.php');

        $this->plugin->addPageTemplate('absence-form-list', 'EmployeeAbsence/Components/AbsenceFormList/AbsenceFormList.php');
        $this->plugin->addPageTemplate('absence-form-view', 'EmployeeAbsence/Components/AbsenceFormView/AbsenceFormView.php');
        $this->plugin->addPageTemplate('absence-form-new', 'EmployeeAbsence/Components/AbsenceFormNew/AbsenceFormNew.php');
        $this->plugin->addPageTemplate('absence-form-edit', 'EmployeeAbsence/Components/AbsenceFormEdit/AbsenceFormEdit.php');

        $this->plugin->addPageTemplate('absence-quick-add', 'EmployeeAbsence/Components/AbsenceQuickAdd/AbsenceQuickAdd.php');
    }
}
