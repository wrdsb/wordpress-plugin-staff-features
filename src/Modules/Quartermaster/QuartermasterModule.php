<?php
namespace WRDSB\Staff\Modules\Quartermaster;
use WRDSB\Staff\Modules\WP\WPCore as WPCore;

use WRDSB\Staff\Modules\Quartermaster\Services\QuartermasterService as Service;
use WRDSB\Staff\Modules\Quartermaster\Services\DeviceLoanForms as DeviceLoanFormsService;

class QuartermasterModule {
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

    public function __construct($plugin) {
        $this->plugin      = $plugin;
        $this->plugin_name = $plugin->getPluginName();
        $this->version     = $plugin->getVersion();
    }

    public function init() {
        $this->addViews();
        $this->addPageTemplates();

        $this->plugin->addAction('wp_enqueue_scripts', $this, 'enqueueStyles');
        $this->plugin->addAction('wp_enqueue_scripts', $this, 'enqueueScripts');
    }

    public static function getCodexSearchKey() {
        $key = defined('WRDSB_CODEX_SEARCH_KEY') ? WRDSB_CODEX_SEARCH_KEY : false;
        return $key;
    }

    public static function getQuartermasterCommandKey() {
        $key = defined('WRDSB_QUARTERMASTER_COMMAND_KEY') ? WRDSB_QUARTERMASTER_COMMAND_KEY : false;
        return $key;
    }

    public static function getQuartermasterQueryKey() {
        $key = defined('WRDSB_QUARTERMASTER_QUERY_KEY') ? WRDSB_QUARTERMASTER_QUERY_KEY : false;
        return $key;
    }

    public static function getDeviceLoansQueryKey() {
        $key = defined('WRDSB_QUARTERMASTER_QUERY_KEY') ? WRDSB_QUARTERMASTER_QUERY_KEY : false;
        return $key;
    }

    public static function getDeviceLoanFormsCommandKey() {
        $key = defined('QUARTERMASTER_DEVICE_LOAN_SUBMISSION_COMMAND_KEY') ? QUARTERMASTER_DEVICE_LOAN_SUBMISSION_COMMAND_KEY : false;
        return $key;
    }

    // TODO: Make this return the same instance, ie Singleton, every time
    public static function getQuartermasterService(): Service {
        $quartermasterService = new Service;
        return $quartermasterService;
    }
    
    public static function getDeviceLoanFormsCommandService(): DeviceLoanFormsService {
        $deviceLoanFormsService = new DeviceLoanFormsService;
        return $deviceLoanFormsService;
    }

    /**
     * Register the stylesheets for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueueStyles() {
        WPCore::wpEnqueueStyle(
            'device-loans',
            WPCore::pluginDirURL(__FILE__) . 'assets/css/device-loans.css',
            array(),
            $this->version,
            'all'
        );
        WPCore::wpEnqueueStyle(
            'datepicker',
            'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css',
            array(),
            $this->version,
            'all'
        );
        WPCore::wpEnqueueStyle(
            'dataTables',
            'https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.18/b-1.5.2/b-colvis-1.5.1/b-flash-1.5.2/b-html5-1.5.2/b-print-1.5.2/cr-1.5.0/fh-3.1.4/r-2.2.2/datatables.min.css',
            array(),
            $this->version,
            'all'
        );
        WPCore::wpEnqueueStyle(
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
    public function enqueueScripts() {
        WPCore::wpEnqueueScript(
            'device-loans',
            WPCore::pluginDirURL(__FILE__) . 'assets/js/device-loans.js',
            array('jquery'),
            $this->version,
            false
        );
        WPCore::wpEnqueueScript(
            'asset-assignments',
            WPCore::pluginDirURL(__FILE__) . 'assets/js/asset-assignments.js',
            array('jquery'),
            $this->version,
            false
        );
        WPCore::wpEnqueueScript(
            'pdfMake',
            'https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js',
            array( 'jquery' ),
            $this->version,
            false
        );
        WPCore::wpEnqueueScript(
            'vfsFonts',
            'https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js',
            array( 'jquery' ),
            $this->version,
            false
        );
        WPCore::wpEnqueueScript(
            'dataTables',
            'https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.18/b-1.5.2/b-colvis-1.5.1/b-flash-1.5.2/b-html5-1.5.2/b-print-1.5.2/cr-1.5.0/fh-3.1.4/r-2.2.2/datatables.min.js',
            array( 'jquery' ),
            $this->version,
            false
        );
        WPCore::wpEnqueueScript(
            'jqueryUI',
            'https://code.jquery.com/ui/1.12.1/jquery-ui.js',
            array( 'jquery' ),
            $this->version,
            false
        );
        WPCore::wpEnqueueScript(
            'datepicker',
            'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js',
            array( 'jquery' ),
            $this->verion,
            false
        );
        WPCore::wpLocalizeScript('device-loans', 'wpApiSettings', array(
            'root' => WPCore::escURLRaw(WPCore::restURL() ),
            'nonce' => WPCore::wpCreateNonce('wp_rest')
        ));
        WPCore::wpLocalizeScript('asset-assignments', 'wpApiSettings', array(
            'root' => WPCore::escURLRaw(WPCore::restURL() ),
            'nonce' => WPCore::wpCreateNonce('wp_rest'),
            'success' => 'Thanks for your submission!',
            'failure' => 'Your submission could not be processed.'
        ));
    }

    private function addViews() {
        $this->plugin->addView('asset-assignment-new', 'asset-assignment-new');
        $this->plugin->addView('asset-assignment-edit', 'asset-assignment-edit');
        $this->plugin->addView('asset-assignment-view', 'asset-assignment-view');
        $this->plugin->addView('asset-assignments-list-all', 'asset-assignments-list-all');
        $this->plugin->addView('asset-assignments-list', 'asset-assignments-list');

        $this->plugin->addView('device-loan-new', 'device-loan-new');
        $this->plugin->addView('device-loan-edit', 'device-loan-edit');
        $this->plugin->addView('device-loan-view', 'device-loan-view');
        $this->plugin->addView('device-loans-list-active', 'device-loans-list-active');
        $this->plugin->addView('device-loans-list-returned', 'device-loans-list-returned');
        $this->plugin->addView('device-loans-list-all', 'device-loans-list-all');
    }

    private function addPageTemplates() {
        $this->plugin->addPageTemplate('asset-assignment-new', 'Quartermaster/Components/AssetAssignments/New.php');
        $this->plugin->addPageTemplate('asset-assignment-edit', 'Quartermaster/Components/AssetAssignments/Edit.php');
        $this->plugin->addPageTemplate('asset-assignment-view', 'Quartermaster/Components/AssetAssignments/View.php');
        $this->plugin->addPageTemplate('asset-assignments-list-all', 'Quartermaster/Components/AssetAssignments/ListAll.php');
        $this->plugin->addPageTemplate('asset-assignments-list', 'Quartermaster/Components/AssetAssignments/List.php');

        $this->plugin->addPageTemplate('device-loan-new', 'Quartermaster/Components/DeviceLoans/New.php');
        $this->plugin->addPageTemplate('device-loan-edit', 'Quartermaster/Components/DeviceLoans/Edit.php');
        $this->plugin->addPageTemplate('device-loan-view', 'Quartermaster/Components/DeviceLoans/View.php');
        $this->plugin->addPageTemplate('device-loans-list-active', 'Quartermaster/Components/DeviceLoans/ListActive.php');
        $this->plugin->addPageTemplate('device-loans-list-returned', 'Quartermaster/Components/DeviceLoans/ListReturned.php');
        $this->plugin->addPageTemplate('device-loans-list-all', 'Quartermaster/Components/DeviceLoans/ListAll.php');
    }
}
