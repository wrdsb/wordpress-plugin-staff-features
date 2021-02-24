<?php
namespace WRDSB\Staff\Modules\Quartermaster;

use WRDSB\Staff\Modules\Quartermaster\Services\DeviceLoanForms as DeviceLoanFormsService;

class QuartermasterModule
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

    public static function getDeviceLoanFormsCommandService(): DeviceLoanFormsService
    {
        $deviceLoanFormsService = new DeviceLoanFormsService;
        return $deviceLoanFormsService;
    }

    /**
     * Register the stylesheets for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueueStyles()
    {
        wp_enqueue_style(
            'device-loans',
            plugin_dir_url(__FILE__) . 'assets/css/device-loans.css',
            array(),
            $this->version,
            'all'
        );
        wp_enqueue_style(
            'dataTables',
            'https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.18/b-1.5.2/b-colvis-1.5.1/b-flash-1.5.2/b-html5-1.5.2/b-print-1.5.2/cr-1.5.0/fh-3.1.4/r-2.2.2/datatables.min.css',
            array(),
            $this->version,
            'all'
        );
        wp_enqueue_style(
            'dataTablesButtons',
            'https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css',
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
            plugin_dir_url(__FILE__) . 'assets/js/device-loans.js',
            array('jquery'),
            $this->version,
            false
        );
        wp_enqueue_script(
            'pdfMake',
            'https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js',
            array( 'jquery' ),
            $this->version,
            false
        );
        wp_enqueue_script(
            'vfsFonts',
            'https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js',
            array( 'jquery' ),
            $this->version,
            false
        );
        wp_enqueue_script(
            'dataTables',
            'https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.18/b-1.5.2/b-colvis-1.5.1/b-flash-1.5.2/b-html5-1.5.2/b-print-1.5.2/cr-1.5.0/fh-3.1.4/r-2.2.2/datatables.min.js',
            array( 'jquery' ),
            $this->version,
            false
        );
        wp_localize_script($this->plugin_name, 'wpApiSettings', array(
            'root' => esc_url_raw( rest_url() ),
            //'root' => 'https://staff-dev.wrdsb.io/wp-json/',
            'nonce' => wp_create_nonce('wp_rest')
        ));
    }

    private function addViews()
    {
        $this->plugin->addView('device-loans-new', 'device-loans-new');
        $this->plugin->addView('device-loans-active-list', 'device-loans-active-list');
        $this->plugin->addView('device-loans-returned-list', 'device-loans-returned-list');
        $this->plugin->addView('device-loans-all-list', 'device-loans-all-list');
    }

    private function addPageTemplates()
    {
        $this->plugin->addPageTemplate('device-loans-new', 'Quartermaster/Components/DeviceLoanForm/DeviceLoanForm.php');
        $this->plugin->addPageTemplate('device-loans-active-list', 'Quartermaster/Components/DeviceLoanFormList/ActiveList.php');
        $this->plugin->addPageTemplate('device-loans-returned-list', 'Quartermaster/Components/DeviceLoanFormList/ReturnedList.php');
        $this->plugin->addPageTemplate('device-loans-all-list', 'Quartermaster/Components/DeviceLoanFormList/AllList.php');
    }
}
