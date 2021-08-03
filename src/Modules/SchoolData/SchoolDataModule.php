<?php
namespace WRDSB\Staff\Modules\SchoolData;
use WRDSB\Staff\Modules\WP\WPCore as WPCore;

//use WRDSB\Staff\Modules\Codex\Services\CodexService as Service;

class SchoolDataModule {
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

    public static function getCodexSearchURL(): string {
        $currentEnv = defined('WRDSB_ENV') ? WRDSB_ENV : 'dev';
        switch ($currentEnv) {
            case 'prod':
                return 'https://wrdsb-codex.search.windows.net/indexes';
                break;
            
            case 'test':
                return 'https://wrdsb-codex.search.windows.net/indexes';
                break;

            default:
                return 'https://wrdsb-codex.search.windows.net/indexes';
                break;
        }
    }

    public static function getCodexSearchKey() {
        $key = defined('WRDSB_CODEX_SEARCH_KEY') ? WRDSB_CODEX_SEARCH_KEY : false;
        return $key;
    }

    /**
     * Register the stylesheets for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueueStyles() {
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
        WPCore::wpEnqueueStyle(
            'progressbar',
            'https://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css',
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
            'datatable',
            WPCore::pluginDirURL(__FILE__) . 'assets/js/datatable.js',
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
    }

    private function addViews() {
        $this->plugin->addView('drill-schedule-view', 'drill-schedule-view');
        $this->plugin->addView('drill-schedule-edit', 'drill-schedule-edit');

        $this->plugin->addView('emergency-response-team-view', 'emergency-response-team-view');
        $this->plugin->addView('emergency-response-team-edit', 'emergency-response-team-edit');

        $this->plugin->addView('evacuation-sites-view', 'evacuation-sites-view');
        $this->plugin->addView('evacuation-sites-edit', 'evacuation-sites-edit');

        $this->plugin->addView('iprc-view', 'iprc-view');
        $this->plugin->addView('iprc-edit', 'iprc-edit');

        $this->plugin->addView('scis-team-view', 'scis-team-view');
        $this->plugin->addView('scis-team-edit', 'scis-team-edit');

        $this->plugin->addView('workplace-inspection-team-view', 'workplace-inspection-team-view');
        $this->plugin->addView('workplace-inspection-team-edit', 'workplace-inspection-team-edit');
    }

    private function addPageTemplates() {
        $this->plugin->addPageTemplate('drill-schedule-view', 'SchoolData/Components/DrillSchedule/View.php');
        $this->plugin->addPageTemplate('drill-schedule-edit', 'SchoolData/Components/DrillSchedule/Edit.php');

        $this->plugin->addPageTemplate('emergency-response-team-view', 'SchoolData/Components/EmergencyResponseTeam/View.php');
        $this->plugin->addPageTemplate('emergency-response-team-edit', 'SchoolData/Components/EmergencyResponseTeam/Edit.php');

        $this->plugin->addPageTemplate('evacuation-sites-view', 'SchoolData/Components/EvacuationSites/View.php');
        $this->plugin->addPageTemplate('evacuation-sites-edit', 'SchoolData/Components/EvacuationSites/Edit.php');

        $this->plugin->addPageTemplate('iprc-view', 'SchoolData/Components/IPRC/View.php');
        $this->plugin->addPageTemplate('iprc-edit', 'SchoolData/Components/IPRC/Edit.php');

        $this->plugin->addPageTemplate('scis-team-view', 'SchoolData/Components/SCISTeam/View.php');
        $this->plugin->addPageTemplate('scis-team-edit', 'SchoolData/Components/SCISTeam/Edit.php');

        $this->plugin->addPageTemplate('workplace-inspection-team-view', 'SchoolData/Components/WorkplaceInspectionTeam/View.php');
        $this->plugin->addPageTemplate('workplace-inspection-team-edit', 'SchoolData/Components/WorkplaceInspectionTeam/Edit.php');
    }
}
