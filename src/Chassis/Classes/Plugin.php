<?php
namespace WRDSB\Staff;

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://github.com/wrdsb
 * @since      1.0.0
 *
 * @package    WRDSB_Staff
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    WRDSB_Staff
 * @author     WRDSB <website@wrdsb.ca>
 */
class Plugin
{
    /**
     * The unique identifier of this plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string    $plugin_name    The string used to uniquely identify this plugin.
     */
    protected $plugin_name;

    /**
     * The current version of the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string    $version    The current version of the plugin.
     */
    protected $version;

    /**
     * Store this plugin's Dependency Injection Container.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string    $plugin_name    The string used to uniquely identify this plugin.
     */
    protected $container;

    /**
     * The array of actions registered with WordPress.
     *
     * @since    1.0.0
     * @access   protected
     * @var      array    $actions    The actions registered with WordPress to fire when the plugin loads.
     */
    protected $actions;

    /**
     * The array of filters registered with WordPress.
     *
     * @since    1.0.0
     * @access   protected
     * @var      array    $filters    The filters registered with WordPress to fire when the plugin loads.
     */
    protected $filters;

    protected $routes;

    /**
     * The array of widgets registered with WordPress.
     *
     * @since    1.0.0
     * @access   protected
     * @var      array    $widgets    The widgets registered with WordPress when the plugin loads.
     */
    protected $widgets;

    /**
     * The array of rewrite rules registered with WordPress.
     *
     * @since    1.0.0
     * @access   protected
     * @var      array    $rewrite_rules    The rewrite rules registered with WordPress when the plugin loads.
     */
    protected $rewrite_rules;

    /**
     * The array of query variables registered with WordPress.
     *
     * @since    1.0.0
     * @access   protected
     * @var      array    $query_vars    The query variables registered with WordPress when the plugin loads.
     */
    protected $query_vars;

    /**
     * The array of views (query var + page template) registered with WordPress.
     *
     * @since    1.0.0
     * @access   protected
     * @var      array    $views    The views (query var + page template) registered with WordPress when the plugin loads.
     */
    protected $views;

    /**
     * The array of page templates (name + file path) registered with WordPress.
     *
     * @since    1.0.0
     * @access   protected
     * @var      array    $page_templates    The page templates (name + file path) registered with WordPress when the plugin loads.
     */
    protected $page_templates;

    /**
     * Define the core functionality of the plugin.
     *
     * Set the plugin name and the plugin version that can be used throughout the plugin.
     * Initialize arrays to store the widgets, rewrite rules, query variables, and views
     * (page templates) which will be registered with WordPress.
     *
     * @since    1.0.0
     */
    public function __construct($container)
    {
        $this->plugin_name = $container['plugin_name'];
        $this->version     = $container['version'];
        $this->container   = $container;

        $this->actions = array();
        $this->filters = array();
        $this->routes = array();

        $this->widgets = array();
        $this->rewrite_rules = array();
        $this->query_vars = array();
        $this->views = array();
        $this->page_templates = array();
    }

    /**
     * Init the plugin. Hooked to 'init'.
     *
     * @since    1.0.0
     */
    public function init() {
        $this->addQueryVar('view');

        add_action('do_parse_request', array($this, 'parseRequest'), 30, 3);

        // Add an action hook to register all widgets
        add_action('widgets_init', array($this, 'registerWidgets'), 10, 1);

        // Add an action hook to register all rewrite rules
        add_action('init', array($this, 'registerRewriteRules'), 10, 1);
        
        // Add a filter hook to register all query vars
        add_filter('query_vars', array($this, 'registerQueryVars'), 10, 1);

        // Add an action hook to get the current view (page template file)
        add_action('template_include', array($this, 'currentView'), 10, 1);

        add_action('init', array($this, 'addRewriteTags'), 10, 1);

        add_action('init', array($this, 'addRewriteRules'), 10, 1);

        add_action('admin_post_absence_form_submit', array($this, 'absenceFormSubmit'));
    }

    /**
     * Register the filters and actions with WordPress.
     *
     * @since    1.0.0
     */
    public function registerHooks()
    {
        // Cycle through all filter hooks and register them.
        foreach ($this->filters as $hook) {
            add_filter($hook['hook'], array( $hook['component'], $hook['callback'] ), $hook['priority'], $hook['accepted_args']);
        }

        // Cycle through all action hooks and register them.
        foreach ($this->actions as $hook) {
            add_action($hook['hook'], array( $hook['component'], $hook['callback'] ), $hook['priority'], $hook['accepted_args']);
        }
    }

    /**
     * Get the plugin's Dependency Injection Container.
     *
     * If a container already exists, return that container. Otherwise, create a
     * new container and return it.
     *
     * @return \Pimple\Container
     */
    public static function initContainer()
    {
        static $container;
        if (! $container) {
            $container = new \Pimple\Container();
        }
        return $container;
    }

    /**
     * Get the plugin's Dependency Injection Container.
     *
     * @return \Pimple\Container
     */
    public function getContainer()
    {
        return $this->container;
    }

    /**
     * The name of the plugin used to uniquely identify it within the context of
     * WordPress and to define internationalization functionality.
     *
     * @since     1.0.0
     * @return    string    The name of the plugin.
     */
    public function getPluginName()
    {
        return $this->plugin_name;
    }

    /**
     * Retrieve the version number of the plugin.
     *
     * @since     1.0.0
     * @return    string    The version number of the plugin.
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Add a new action to the collection to be registered with WordPress.
     *
     * @since    1.0.0
     * @param    string               $hook             The name of the WordPress action that is being registered.
     * @param    object               $component        A reference to the instance of the object on which the action is defined.
     * @param    string               $callback         The name of the function definition on the $component.
     * @param    int                  $priority         Optional. The priority at which the function should be fired. Default is 10.
     * @param    int                  $accepted_args    Optional. The number of arguments that should be passed to the $callback. Default is 1.
     */
    public function addAction($hook, $component, $callback, $priority = 10, $accepted_args = 1)
    {
        $this->actions = $this->addHook($this->actions, $hook, $component, $callback, $priority, $accepted_args);
    }

    /**
     * Add a new filter to the collection to be registered with WordPress.
     *
     * @since    1.0.0
     * @param    string               $hook             The name of the WordPress filter that is being registered.
     * @param    object               $component        A reference to the instance of the object on which the filter is defined.
     * @param    string               $callback         The name of the function definition on the $component.
     * @param    int                  $priority         Optional. The priority at which the function should be fired. Default is 10.
     * @param    int                  $accepted_args    Optional. The number of arguments that should be passed to the $callback. Default is 1
     */
    public function addFilter($hook, $component, $callback, $priority = 10, $accepted_args = 1)
    {
        $this->filters = $this->addHook($this->filters, $hook, $component, $callback, $priority, $accepted_args);
    }

    /**
     * A utility function that is used to register the actions and hooks into a single
     * collection.
     *
     * @since    1.0.0
     * @access   private
     * @param    array                $hooks            The collection of hooks that is being registered (that is, actions or filters).
     * @param    string               $hook             The name of the WordPress filter that is being registered.
     * @param    object               $component        A reference to the instance of the object on which the filter is defined.
     * @param    string               $callback         The name of the function definition on the $component.
     * @param    int                  $priority         The priority at which the function should be fired.
     * @param    int                  $accepted_args    The number of arguments that should be passed to the $callback.
     * @return   array                                  The collection of actions and filters registered with WordPress.
     */
    private function addHook($hooks, $hook, $component, $callback, $priority, $accepted_args)
    {
        $hooks[] = array(
            'hook'          => $hook,
            'component'     => $component,
            'callback'      => $callback,
            'priority'      => $priority,
            'accepted_args' => $accepted_args,
        );

        return $hooks;
    }

    /**
     * Add a route to the router. Overwrites a route if it shares the same name as an already registered one.
     *
     * @param string $name
     * @param Route  $route
     */
    public function addRoute($name, Route $route)
    {
        $this->routes[$name] = $route;
    }

    /**
     * Add a new widget to the collection to be registered with WordPress.
     *
     * @since    1.0.0
     * @param    string               $widget           The name of the widget that is being registered.
     * @param    object               $component        A reference to the instance of the object on which the filter is defined.
     * @param    string               $callback         The name of the function definition on the $component.
     * @param    int                  $priority         Optional. The priority at which the function should be fired. Default is 10.
     * @param    int                  $accepted_args    Optional. The number of arguments that should be passed to the $callback. Default is 1
     */
    public function addWidget($widget, $component, $callback, $priority = 10, $accepted_args = 1)
    {
        $this->widgets[] = array(
            'hook'          => $hook,
            'component'     => $component,
            'callback'      => $callback,
            'priority'      => $priority,
            'accepted_args' => $accepted_args,
        );
    }

    /**
     * Register the widgets with WordPress.
     *
     * @since    1.0.0
     */
    public function registerWidgets()
    {
        foreach ($this->widgets as $widget) {
            register_widget();
        }
    }

    /**
     * Add a new rewrite rule to the collection to be registered with WordPress.
     *
     * @param string $key
     * @param string $value
     * @return void
     */
    public function addRewriteRule($key, $value)
    {
        $this->rewrite_rules[$key] = $value;
    }

    /**
     * Register the rewrite rules with WordPress.
     *
     * @since    1.0.0
     */
    public function registerRewriteRules()
    {
        foreach ($this->rewrite_rules as $key => $value) {
            add_rewrite_rule($key, $value, 'top');
        }
    }

    /**
     * Add a new query var name to the collection of query vars to be registered with WordPress.
     *
     * @param string $name
     * @return void
     */
    public function addQueryVar($name)
    {
        $this->query_vars[] = $name;
    }

    /**
     * Register the query vars with WordPress.
     *
     * @param array $vars  WordPress's own array of query vars to which we append our own.
     * @return void
     */
    public function registerQueryVars($vars)
    {
        foreach ($this->query_vars as $query_var) {
            $vars[] = $query_var;
        }
        return $vars;
    }

    /**
     * Add a view to the plugin's collection of views.
     *
     * @param string $view_name
     * @param string $template_name
     * @return void
     */
    public function addView($view_name, $template_name)
    {
        $this->views[$view_name] = $template_name;
    }

    /**
     * Retrieve the current view (page template name)
     * from the plugin's collection of views,
     * based on the value of the 'view' query var.
     *
     * @return void
     */
    public function currentView($template)
    {
        $view_name = get_query_var('view', 'default');

        if ('default' === $view_name) {
            return $template;
        }

        $template_name = $this->views[$view_name];
        $template_file = $this->getPageTemplate($template_name);
        $template_path = $this->getTemplatePath($template_file, $template);

        return $template_path;
    }

    /**
     * Add a page template to the collection of page templates.
     *
     * @param string $template_name
     * @param string $template_path
     * @return void
     */
    public function addPageTemplate($template_name, $template_path)
    {
        $this->page_templates[$template_name] = $template_path;
    }

    /**
     * Retrieve a template file path, given the template's name.
     *
     * @param string $template_name
     * @return void
     */
    public function getPageTemplate($template_name)
    {
        return $this->page_templates[$template_name];
    }

    private function getTemplatePath($template_file, $template)
    {
        $template_path = locate_template(array($template_file));
        if ('' !== $template_path) {
            return $template_path;
        }

        //Check plugin directory next
        $template_path = plugin_dir_path(dirname(__FILE__)) . 'src/Modules/' . $template_file;
        if (file_exists($template_path)) {
            return $template_path;
        }

        //Fall back to original template
        return $template;
    }

    public function getCurrentURL()
    {
        $current_url = trim(esc_url_raw(add_query_arg([])), '/');

        $home_path = trim(parse_url(home_url(), PHP_URL_PATH), '/');

        if ($home_path && strpos($current_url, $home_path) === 0) {
            $current_url = trim(substr($current_url, strlen($home_path)), '/');
        }

        return $current_url;
    }

    public function parseRequest($doParse, $environment, $extra_query_vars) {
        $container = $this->getContainer();
        $current_url = $container['plugin']->getCurrentURL();
        $routes = $container['routes'];
        
        if (empty($routes) || !is_array($routes)) {
            return $doParse;
        }
    
        $urlParts = explode('?', $current_url, 2);
        $urlPath = trim($urlParts[0], '/');
        $urlVars = [];
    
        if (isset($urlParts[1])) {
            parse_str($urlParts[1], $urlVars);
        }
    
        $query_vars = null;
    
        foreach ($routes as $pattern => $route) {
            if (preg_match('~' . trim($pattern, '/') . '~', $urlPath, $matches)) {
    
                if (in_array($route['module'], $container['modules'])) {
                    $container[$route['module']]->init();

                    $routeVars = $route;
                    $query_vars = array_merge($routeVars, $urlVars);
                    $query_vars['matches'] = $matches;

                    foreach ($route['matches'] as $key => $value) {
                        $query_vars[$value] = $matches[$key];
                    }

                    $environment->query_vars = $query_vars;
        
                    $container['plugin']->registerHooks();
        
                    return false;
                }
            }
        }
    
        return $doParse;
    }

    public function addRewriteTags()
    {
        add_rewrite_tag('%view%', '([^&]+)');
        add_rewrite_tag('%class-code%', '([^&]+)');
        add_rewrite_tag('%wp-posts-search%', '([^&]+)');
        add_rewrite_tag('%wp-posts-search-skip%', '([^&]+)');
        add_rewrite_tag('%search-filter-site-name%', '([^&]+)');
        add_rewrite_tag('%id%', '([^&]+)');
        add_rewrite_tag('%date%', '([^&]+)');
        add_rewrite_tag('%employee%', '([^&]+)');
    }

    public function addRewriteRules()
    {
        add_rewrite_rule('^trillium/classes$',                 'index.php?view=trillium-classes', 'top');
        add_rewrite_rule('^trillium/enrolments$',              'index.php?view=trillium-enrolments', 'top');
        add_rewrite_rule('^trillium/enrolments-email-list$',   'index.php?view=trillium-enrolments-emails', 'top');
    
        add_rewrite_rule('^search/content$',                   'index.php?view=search-wp-posts', 'top');
    }

    public function absenceFormSubmit()
    {
        print_r($_POST);
    
        $submission = $_POST;
        $functionKey = CMA_ABSENCE_FORM_SUBMIT_KEY;
    
        $body = $submission;
        
        $url = "https://wrdsb-cma.azurewebsites.net/api/absence-form-submit?code={$functionKey}";
        $args = array(
            'timeout'     => 5,
            'redirection' => 5,
            'httpversion' => '1.0',
            'user-agent'  => 'cma/wordpress',
            'blocking'    => true,
            'headers'     => array(
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ),
            'cookies'     => array(),
            'body'        => json_encode($body),
            'compress'    => false,
            'decompress'  => true,
            'sslverify'   => false,
            'stream'      => false,
            'filename'    => null
        );
        $response = wp_remote_post($url, $args);
        $response_object = json_decode($response['body'], $assoc = false);
    
        print_r($response_object);
    
        wp_redirect(home_url()."/employee/absence/{$response_object->id}");
    }
    
    public function absenceFormValidate($submission)
    {
        return true;
    }
}
