<?php
namespace WRDSB\Staff\Modules\Codex;
use WRDSB\Staff\Modules\WP\WPCore as WPCore;

use WRDSB\Staff\Modules\Codex\Services\CodexService as Service;

class CodexModule {
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

    // TODO: Make this return the same instance, ie Singleton, every time
    public static function getCodexService(): Service {
        $codexService = new Service;
        return $codexService;
    }
    
    /**
     * Register the stylesheets for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueueStyles() {
        WPCore::wpEnqueueStyle(
            'autocompletes',
            WPCore::pluginDirURL(__FILE__) . 'assets/css/autocompletes.css',
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
            'autocompletes',
            WPCore::pluginDirURL(__FILE__) . 'assets/js/autocompletes.js',
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
        WPCore::wpLocalizeScript('autocompletes', 'wpApiSettings', array(
            'root' => WPCore::escURLRaw(WPCore::restURL() ),
            'nonce' => WPCore::wpCreateNonce('wp_rest')
        ));
    }

    private function addViews() {
        $this->plugin->addView('staff-search', 'staff-search');
    }

    private function addPageTemplates() {
        $this->plugin->addPageTemplate('staff-search', 'Codex/Components/Staff/Search.php');
    }
}
