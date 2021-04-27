<?php
namespace WRDSB\Staff\Modules\Quartermaster\REST;
use WRDSB\Staff\Modules\WP\WPCore as WPCore;

use WRDSB\Staff\Modules\Quartermaster\Model\DeviceLoan as Model;

use \WP_REST_Controller as WP_REST_Controller;
use \WP_REST_Server as WP_REST_Server;
use \WP_REST_Request as WP_REST_Request;
use \WP_REST_Response as WP_REST_Response;

/**
 * Define the "DeviceLoan" REST Controller
 * *
 * @link       https://www.wrdsb.ca
 * @since      1.0.0
 *
 * @package    WRDSB_Staff
 * @subpackage WRDSB_Staff/Quartermaster
 */

class DeviceLoan extends WP_REST_Controller {
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

    private $api_namespace;
    private $api_version;

    public function __construct()
    {
        $this->api_namespace = 'wrdsb/staff/quartermaster/device-loans';
        $this->api_version = '1';
    }

    public function getAuthorizedRoles()
    {
        $authorized = [
            'administrator'
        ];

        return $authorized;
    }

    /**
     * Register the routes for the objects of the controller.
     */
    public function registerRoutes()
    {
        register_rest_route('wrdsb/staff/quartermaster/device-loans', '/forms', array(
            array(
                'methods'             => WP_REST_Server::READABLE,
                'callback'            => array( $this, 'getItems' ),
                'permission_callback' => array( $this, 'getItemsPermissionsCheck' ),
            ),
            array(
                'methods'             => WP_REST_Server::CREATABLE,
                'callback'            => array( $this, 'createItem' ),
                'permission_callback' => array( $this, 'createItemPermissionsCheck' ),
            ),
        ));
        register_rest_route('wrdsb/staff/quartermaster/device-loans', '/form/(?P<id>[A-Za-z0-9-]+)/return', array(
            array(
                'methods'             => WP_REST_Server::EDITABLE,
                'callback'            => array( $this, 'markItemReturned' ),
                'permission_callback' => array( $this, 'updateItemPermissionsCheck' ),
            ),
        ));
        register_rest_route('wrdsb/staff/quartermaster/device-loans', '/form/(?P<id>[A-Za-z0-9-]+)', array(
            array(
                'methods'             => WP_REST_Server::READABLE,
                'callback'            => array( $this, 'getItem' ),
                'permission_callback' => array( $this, 'getItemPermissionsCheck' ),
            ),
            array(
                'methods'             => WP_REST_Server::EDITABLE,
                'callback'            => array( $this, 'updateItem' ),
                'permission_callback' => array( $this, 'updateItemPermissionsCheck' ),
            ),
            array(
                'methods'             => WP_REST_Server::DELETABLE,
                'callback'            => array( $this, 'deleteItem' ),
                'permission_callback' => array( $this, 'deleteItemPermissionsCheck' ),
            ),
        ));
        register_rest_route('wrdsb/staff/quartermaster/blog', '/(?P<blog>[A-Za-z0-9-]+)/device-loans/form/(?P<id>[A-Za-z0-9-]+)', array(
            array(
                'methods'             => WP_REST_Server::EDITABLE,
                'callback'            => array( $this, 'updateItem' ),
                'permission_callback' => array( $this, 'updateItemPermissionsCheck' ),
            ),
        ));
        register_rest_route('wrdsb/staff/quartermaster/blog', '/(?P<blog>[A-Za-z0-9-]+)/device-loans/form/(?P<id>[A-Za-z0-9-]+)/return', array(
            array(
                'methods'             => WP_REST_Server::EDITABLE,
                'callback'            => array( $this, 'markItemReturned' ),
                'permission_callback' => array( $this, 'updateItemPermissionsCheck' ),
            ),
        ));
    }

    /**
     * Get a collection of items
     *
     * @param WP_REST_Request $request Full data about the request.
     * @return WP_REST_Response
     */
    public function getItems(WP_REST_Request $request): WP_REST_Response
    {
        $forms = Model::all();

        return new WP_REST_Response($forms, 200);
    }

    /**
     * Get one item from the collection
     *
     * @param WP_REST_Request $request Full data about the request.
     * @return WP_REST_Response
     */
    public function getItem(WP_REST_Request $request): WP_REST_Response
    {
        $id = $this->getFormID($request);

        $form = Model::get($id);

        if ($form->isSaved()) {
            return new WP_REST_Response($form, 200);
        } else {
            //TODO: Does this constructor work?
            return new WP_REST_Response('Error retrieving form.', 500);
        }
    }

    /**
     * Create one item from the collection
     *
     * @param WP_REST_Request $request Full data about the request.
     * @return WP_REST_Response
     */
    public function createItem(WP_REST_Request $request): WP_REST_Response
    {
        // TODO: Extract form from request
        $args = $request->get_body_params();
        //$parameters = $request->get_json_params();

        // TODO: Create form
        $created_form = Model::create($args);

        if ($created_form->isSaved()) {
            return new WP_REST_Response($created_form, 200);
        } else {
            //TODO: Does this constructor work?
            return new WP_REST_Response('Error creating form.', 500);
        }
    }
  
    /**
     * Update one item from the collection.
     *
     * @param WP_REST_Request $request Full data about the request.
     * @return WP_REST_Response
     */
    public function updateItem(WP_REST_Request $request): WP_REST_Response {
        $currentTime = WPCore::currentTime();
        $id = $this->getFormID($request);
        $body = $request->get_json_params();

        $coreArray = array(
            'id' => $id,
            'updatedAt' => $currentTime
        );
        $patch = array_merge($coreArray, $body);

        $command = Model::patch($id, $patch);

        if ($command->getState() === 'success') {
            return new WP_REST_Response($command, $command->getStatus());
        } else {
            error_log(json_encode($command));
            return new WP_REST_Response($command, $command->getStatus());
        }
    }
 
    /**
     * Delete one item from the collection.
     *
     * @param WP_REST_Request $request Full data about the request.
     * @return WP_REST_Response
     */
    public function deleteItem(WP_REST_Request $request): WP_REST_Response
    {
        $id = $this->getFormID($request);

        $command = Model::delete($id);
        $command_json = \json_encode($command);

        //TODO: Send back a JSON response which is more useful to the client.
        if ($command->getState() === 'success') {
            return new WP_REST_Response($command_json, 200);
        } else {
            //TODO: Does this constructor work?
            return new WP_REST_Response($command_json, 500);
        }
    }

    /**
     * Mark one item from the collection as 'returned'.
     *
     * @param WP_REST_Request $request Full data about the request.
     * @return WP_REST_Response
     */
    public function markItemReturned(WP_REST_Request $request): WP_REST_Response
    {
        $current_time = current_time('mysql');
        $id = $this->getFormID($request);
        $body = $request->get_json_params();

        $patch = array(
            'id' => $id,
            'wasReturned' => true,
            'returnedAt' => $body['returnedAt'],
            'returnedBy' => $body['returnedBy'],
        );
        $deviceLoan = new Model($patch);
        $command = Model::patch($id, $deviceLoan);

        if ($command->getState() === 'success') {
            return new WP_REST_Response($command, $command->getStatus());
        } else {
            error_log(json_encode($command));
            return new WP_REST_Response($command, $command->getStatus());
        }
    }

    /**
     * Given a WP_REST_Request object, retrieve the corresponding form id.
     *
     * @param  WP_REST_Request $request Full details about the request.
     * @return string The form ID from the request.
     */
    private function getFormID(WP_REST_Request $request): string
    {
        $params = $request->get_url_params();
        $form_id = $params['id'];

        return $form_id;
    }

    /**
     * Given a WP_REST_Request object, retrieve the corresponding form id.
     *
     * @param  WP_REST_Request $request Full details about the request.
     * @return string The form ID from the request.
     */
    private function getBlogID(WP_REST_Request $request): string
    {
        $params = $request->get_url_params();
        $blog_id = $params['blog'];

        return $blog_id;
    }

    /**
     * Check if a given request has access to read a collection of items
     *
     * @param  WP_REST_Request $request Full details about the request.
     * @return boolean
     */
    public function getItemsPermissionsCheck(WP_REST_Request $request): bool
    {
        return $this->updateItemPermissionsCheck($request);
    }

    /**
     * Check if a given request has access to read an item
     *
     * @param  WP_REST_Request $request Full details about the request.
     * @return boolean
     */
    public function getItemPermissionsCheck(WP_REST_Request $request): bool
    {
        return $this->updateItemPermissionsCheck($request);
    }

    /**
     * Check if a given request has access to create an item
     *
     * @param WP_REST_Request $request Full details about the request.
     * @return boolean
     */
    public function createItemPermissionsCheck(WP_REST_Request $request): bool
    {
        return $this->updateItemPermissionsCheck($request);
    }

    /**
     * Check if a given request has access to update a specific item
     *
     * @param  WP_REST_Request $request Full details about the request.
     * @return boolean
     */
    public function updateItemPermissionsCheck(WP_REST_Request $request): bool
    {
        if (current_user_can('setup_network')) {
            return true;
        }

        $user = wp_get_current_user();
        if (empty($user)) return false;

        $blog_id = $this->getBlogID($request);
        switch_to_blog($blog_id);
		
        if (user_can($user->id, 'manage_options')) {
            restore_current_blog();
            return true;
        }

        restore_current_blog();
        return false;
    }

    /**
     * Check if a given request has access delete a specific item
     *
     * @param  WP_REST_Request $request Full details about the request.
     * @return boolean
     */
    public function deleteItemPermissionsCheck(WP_REST_Request $request): bool
    {
        return $this->updateItemPermissionsCheck($request);
    }
}
