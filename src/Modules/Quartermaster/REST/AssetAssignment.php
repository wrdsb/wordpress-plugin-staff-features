<?php
namespace WRDSB\Staff\Modules\Quartermaster\REST;
use WRDSB\Staff\Modules\WP\WPCore as WPCore;

use WRDSB\Staff\Modules\Quartermaster\Model\AssetAssignment as Model;

use \WP_REST_Controller as WP_REST_Controller;
use \WP_REST_Server as WP_REST_Server;
use \WP_REST_Request as WP_REST_Request;
use \WP_REST_Response as WP_REST_Response;

/**
 * Define the "AssetAssignment" REST Controller
 * *
 * @link       https://www.wrdsb.ca
 * @since      1.0.0
 *
 * @package    WRDSB_Staff
 * @subpackage WRDSB_Staff/Quartermaster
 */

class AssetAssignment extends WP_REST_Controller {
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

    public function __construct() {
        $this->api_namespace = 'wrdsb/staff/quartermaster';
        $this->api_version = '1';
    }

    /**
     * Register the routes for the objects of the controller.
     */
    public function registerRoutes() {
        register_rest_route($this->api_namespace, '/asset-assignments', array(
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
        register_rest_route($this->api_namespace, '/asset-assignment/(?P<id>[A-Za-z0-9-]+)', array(
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
        register_rest_route($this->api_namespace, '/asset-assignment/(?P<id>[A-Za-z0-9-]+)/return', array(
            array(
                'methods'             => WP_REST_Server::EDITABLE,
                'callback'            => array( $this, 'markItemReturned' ),
                'permission_callback' => array( $this, 'updateItemPermissionsCheck' ),
            ),
        ));
        register_rest_route($this->api_namespace, '/blog/(?P<blog>[A-Za-z0-9-]+)/asset-assignments', array(
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
        register_rest_route($this->api_namespace, '/blog/(?P<blog>[A-Za-z0-9-]+)/asset-assignment/(?P<id>[A-Za-z0-9-]+)', array(
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
        register_rest_route($this->api_namespace, '/blog/(?P<blog>[A-Za-z0-9-]+)/asset-assignment/(?P<id>[A-Za-z0-9-]+)/return', array(
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
    //public function getItems(WP_REST_Request $request): WP_REST_Response {
        //$assignments = Model::all();

        //return new WP_REST_Response($assignments, 200);
    //}

    /**
     * Get one item from the collection
     *
     * @param WP_REST_Request $request Full data about the request.
     * @return WP_REST_Response
     */
    //public function getItem(WP_REST_Request $request): WP_REST_Response {
        //$id = $this->getItemID($request);

        //$item = Model::get($id);

        //if ($item->isSaved()) {
            //return new WP_REST_Response($item, 200);
        //} else {
            //TODO: Does this constructor work?
            //return new WP_REST_Response('Error retrieving form.', 500);
        //}
    //}

    /**
     * Create one item from the collection
     *
     * @param WP_REST_Request $request Full data about the request.
     * @return WP_REST_Response
     */
    public function createItem(WP_REST_Request $request): WP_REST_Response {
        $body = $request->get_json_params();

        $assetAssignment = new Model($body);

        $command = Model::create($assetAssignment);

        if ($command->getState() === 'success') {
            return new WP_REST_Response($command, $command->getStatus());
        } else {
            error_log(json_encode($command));
            return new WP_REST_Response($command, $command->getStatus());
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
        $searchID = $this->getItemID($request);
        $body = $request->get_json_params();

        $coreArray = array(
            'searchID' => $searchID,
            'updatedAt' => $currentTime
        );
        $patch = array_merge($coreArray, $body);

        $command = Model::patch($searchID, $patch);

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
    public function deleteItem(WP_REST_Request $request): WP_REST_Response {
        $searchID = $this->getItemID($request);

        $command = Model::delete($searchID);

        if ($command->getState() === 'success') {
            return new WP_REST_Response($command, $command->getStatus());
        } else {
            error_log(json_encode($command));
            return new WP_REST_Response($command, $command->getStatus());
        }
    }

    /**
     * Mark one item from the collection as 'returned'.
     *
     * @param WP_REST_Request $request Full data about the request.
     * @return WP_REST_Response
     */
    public function markItemReturned(WP_REST_Request $request): WP_REST_Response {
        $currentTime = WPCore::currentTime();
        $searchID = $this->getItemID($request);
        $body = $request->get_json_params();

        $patch = array(
            'searchID' => $searchID,
            'updatedAt' => $currentTime,
            'updatedBy' => $body['updatedBy'],
            'wasReturned' => true,
            'returnedAt' => $body['returnedAt'],
            'returnedBy' => $body['returnedBy'],
        );
        
        $command = Model::patch($searchID, $patch);

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
    private function getItemID(WP_REST_Request $request): string {
        $params = $request->get_url_params();
        $itemID = $params['id'];

        return $itemID;
    }

    /**
     * Given a WP_REST_Request object, retrieve the corresponding form id.
     *
     * @param  WP_REST_Request $request Full details about the request.
     * @return string The form ID from the request.
     */
    private function getBlogID(WP_REST_Request $request): string {
        $params = $request->get_url_params();
        $blogID = $params['blog'] ? $params['blog'] : '';

        return $blogID;
    }

    /**
     * Check if a given request has access to read a collection of items
     *
     * @param  WP_REST_Request $request Full details about the request.
     * @return boolean
     */
    public function getItemsPermissionsCheck(WP_REST_Request $request): bool {
        return $this->updateItemPermissionsCheck($request);
    }

    /**
     * Check if a given request has access to read an item
     *
     * @param  WP_REST_Request $request Full details about the request.
     * @return boolean
     */
    public function getItemPermissionsCheck(WP_REST_Request $request): bool {
        return $this->updateItemPermissionsCheck($request);
    }

    /**
     * Check if a given request has access to create an item
     *
     * @param WP_REST_Request $request Full details about the request.
     * @return boolean
     */
    public function createItemPermissionsCheck(WP_REST_Request $request): bool {
        return $this->updateItemPermissionsCheck($request);
    }

    /**
     * Check if a given request has access to update a specific item
     *
     * @param  WP_REST_Request $request Full details about the request.
     * @return boolean
     */
    public function updateItemPermissionsCheck(WP_REST_Request $request): bool {
        if (WPCore::currentUserCan('setup_network')) {
            return true;
        }

        $user = WPCore::getCurrentUser();
        if (empty($user)) return false;

        $blogID = $this->getBlogID($request);
        if ($blogID === '') return false;
        
        WPCore::switchToBlog($blogID);
		
        if (WPCore::userCan($user->id, 'manage_options')) {
            WPCore::restoreCurrentBlog();
            return true;
        }

        WPCore::restoreCurrentBlog();
        return false;
    }

    /**
     * Check if a given request has access delete a specific item
     *
     * @param  WP_REST_Request $request Full details about the request.
     * @return boolean
     */
    public function deleteItemPermissionsCheck(WP_REST_Request $request): bool {
        return $this->updateItemPermissionsCheck($request);
    }
}
