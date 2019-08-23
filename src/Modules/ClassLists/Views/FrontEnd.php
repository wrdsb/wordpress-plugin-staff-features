<?php
namespace WRDSB\Staff\Modules\ClassLists\Views;

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://github.com/wrdsb
 * @since      1.0.0
 *
 * @package    WRDSB_Staff
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    WRDSB_Staff
 * @author     WRDSB <website@wrdsb.ca>
 */
class FrontEnd
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

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $plugin_name       The name of the plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($plugin)
    {
        $this->plugin      = $plugin;
        $this->plugin_name = $plugin->getPluginName();
        $this->version     = $plugin->getVersion();

        $this->addQueryVar();
        $this->addRewriteRules();
        $this->addViews();
        $this->addPageTemplates();

        $plugin->addAction('wp_enqueue_scripts', $this, 'enqueueStyles');
        $plugin->addAction('wp_enqueue_scripts', $this, 'enqueueScripts');
    }

    /**
     * Register the stylesheets for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueueStyles()
    {
        wp_enqueue_style(
            'classLists',
            plugin_dir_url(__FILE__) . 'assets/css/front-end.css',
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
            'href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css',
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
            'classLists',
            plugin_dir_url(__FILE__) . 'assets/js/front-end.js',
            array( 'jquery' ),
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
    }

    private function addQueryVar()
    {
        $this->plugin->addQueryVar('class-code');
    }

    private function addRewriteRules()
    {
        $this->plugin->addRewriteRule('^trillium/classes$', 'index.php?view=trillium-classes');
        $this->plugin->addRewriteRule('^trillium/enrolments$', 'index.php?view=trillium-enrolments');
        $this->plugin->addRewriteRule('^trillium/enrolments-email-list$', 'index.php?view=trillium-enrolments-emails');
    }

    private function addViews()
    {
        $this->plugin->addView('trillium-classes', 'trillium-classes');
        $this->plugin->addView('trillium-enrolments', 'trillium-enrolments');
        $this->plugin->addView('trillium-enrolments-emails', 'trillium-enrolments-emails');
    }

    private function addPageTemplates()
    {
        $this->plugin->addPageTemplate('trillium-classes', 'ClassLists/Views/templates/trillium-classes.php');
        $this->plugin->addPageTemplate('trillium-enrolments', 'ClassLists/Views/templates/trillium-enrolments.php');
        $this->plugin->addPageTemplate('trillium-enrolments-emails', 'ClassLists/Views/templates/trillium-enrolments-emails.php');
    }
}
