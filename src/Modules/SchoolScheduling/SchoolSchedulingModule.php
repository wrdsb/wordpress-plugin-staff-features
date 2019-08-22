<?php
namespace WRDSB\Staff\Modules\SchoolScheduling;

class SchoolSchedulingModule
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
        //$this->plugin->addQueryVar('class-code');
    }

    private function addRewriteRules()
    {
        $this->plugin->addRewriteRule('^scheduling/day-slots$', 'index.php?view=day-slot-list');

        $this->plugin->addRewriteRule('^scheduling/day-templates$', 'index.php?view=day-template-list');

        $this->plugin->addRewriteRule('^scheduling/days$', 'index.php?view=day-list');
    }

    private function addViews()
    {
        $this->plugin->addView('day-slot-list', 'day-slot-list');
        $this->plugin->addView('day-template-list', 'day-template-list');
        $this->plugin->addView('day-list', 'day-list');
    }

    private function addPageTemplates()
    {
        $this->plugin->addPageTemplate('day-slot-list', 'SchoolScheduling/Components/DaySlotList/DaySlotList.php');
        $this->plugin->addPageTemplate('day-template-list', 'SchoolScheduling/Components/DayTemplateList/DayTemplateList.php');
        $this->plugin->addPageTemplate('day-list', 'SchoolScheduling/Components/DayList/DayList.php');
    }
}
