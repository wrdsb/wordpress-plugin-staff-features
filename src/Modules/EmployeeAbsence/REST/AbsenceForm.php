<?php
namespace WRDSB\Staff\Modules\EmployeeAbsence\REST;

use WRDSB\Staff\Modules\EmployeeAbsence\Model\AbsenceForm as Model;

use \WP_REST_Controller as WP_REST_Controller;
use \WP_REST_Server as WP_REST_Server;
use \WP_REST_Request as WP_REST_Request;
use \WP_REST_Response as WP_REST_Response;

/**
 * Define the "AbsenceForm" REST Controller
 * *
 * @link       https://www.wrdsb.ca
 * @since      1.0.0
 *
 * @package    WRDSB_Staff
 * @subpackage WRDSB_Staff/EmployeeAbsence
 */

class AbsenceForm extends WP_REST_Controller
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

    private $api_namespace;
    private $api_version;

    public function __construct()
    {
        $this->api_namespace = 'wrdsb/staff/employee/absence';
        $this->api_version = '1';
    }

    public function getAuthorizedUsers()
    {
        $authorized = [
            'janie_straus@wrdsb.ca',
            'jason_denhart@wrdsb.ca',
            'joene_kouvelos@wrdsb.ca',
            'sandy_millar@wrdsb.ca',
            'siobhan_watters@wrdsb.ca',
            'james_schumann@wrdsb.ca'
        ];

        return $authorized;
    }

    /**
     * Register the routes for the objects of the controller.
     */
    public function registerRoutes()
    {
        register_rest_route('wrdsb/staff/employee/absence', '/forms', array(
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
        register_rest_route('wrdsb/staff/employee/absence', '/form/(?P<id>[A-Za-z0-9-]+)', array(
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
        register_rest_route('wrdsb/staff/employee/absence', '/form/(?P<id>[A-Za-z0-9-]+)/processed', array(
            array(
                'methods'             => WP_REST_Server::EDITABLE,
                'callback'            => array( $this, 'markItemProcessed' ),
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
    public function updateItem(WP_REST_Request $request): WP_REST_Response
    {
        $id = $this->getFormID($request);
        //TODO: Extract patch

        $updated_form = Model::patch(array(
            'id' => $id
            //TODO: Apply patch
        ));

        if ($updated_form->isSaved()) {
            return new WP_REST_Response($updated_form, 200);
        } else {
            //TODO: Does this constructor work?
            return new WP_REST_Response('Error updating form.', 500);
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

        $deleted_form = Model::delete($id);

        if ($deleted_form->isSaved()) {
            return new WP_REST_Response($deleted_form, 200);
        } else {
            //TODO: Does this constructor work?
            return new WP_REST_Response('Error deleting form.', 500);
        }
    }

    /**
     * Mark one item from the collection as 'processed'.
     *
     * @param WP_REST_Request $request Full data about the request.
     * @return WP_REST_Response
     */
    public function markItemProcessed(WP_REST_Request $request): WP_REST_Response
    {
        $id = $this->getFormID($request);

        $updated_form = Model::patch(array(
            'id' => $id,
            'processed' => true
        ));

        if ($updated_form->isSaved()) {
            return new WP_REST_Response($updated_form, 200);
        } else {
            //TODO: Does this constructor work?
            return new WP_REST_Response('Error processing form.', 500);
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
        $current_user = wp_get_current_user();

        if (in_array($current_user->user_email, $this->getAuthorizedUsers())) {
            return true;
        } else {
            return false;
        }
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
