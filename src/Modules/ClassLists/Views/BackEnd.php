<?php
namespace WRDSB\Staff\Modules\ClassLists\Views;

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/wrdsb
 * @since      1.0.0
 *
 * @package    WRDSB_Staff
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    WRDSB_Staff
 * @author     WRDSB <website@wrdsb.ca>
 */
class BackEnd
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
     * @param      string    $plugin_name       The name of this plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($plugin)
    {
        $this->plugin_name = $plugin->getPluginName();
        $this->version     = $plugin->getVersion();

        $plugin->addAction('admin_enqueue_scripts', $this, 'enqueue_styles');
        $plugin->addAction('admin_enqueue_scripts', $this, 'enqueue_scripts');
    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueueStyles()
    {
        wp_enqueue_style($this->plugin_name.'-classlists', plugin_dir_url(__FILE__) . 'assets/css/back-end.css', array(), $this->version, 'all');
    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueueScripts()
    {
        wp_enqueue_script($this->plugin_name.'classlists', plugin_dir_url(__FILE__) . 'assets/js/back-end.js', array( 'jquery' ), $this->version, false);
    }
}
