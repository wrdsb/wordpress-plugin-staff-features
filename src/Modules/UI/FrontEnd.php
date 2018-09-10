<?php
namespace WRDSB\Staff\Modules\UI;

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
        $this->plugin_name = $plugin->getPluginName();
        $this->version     = $plugin->getVersion();

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
        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'assets/css/front-end.css', array(), $this->version, 'all');
    }

    /**
     * Register the JavaScript for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueueScripts()
    {
        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'assets/js/front-end.js', array( 'jquery' ), $this->version, false);
    }
}
