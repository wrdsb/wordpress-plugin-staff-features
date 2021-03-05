<?php
namespace WRDSB\Staff\Modules\Quartermaster\REST;
use WRDSB\Staff\Modules\WP\WPCore as WPCore;

use WRDSB\Staff\Modules\Quartermaster\Model\Asset as Model;

use \WP_REST_Controller as WP_REST_Controller;
use \WP_REST_Server as WP_REST_Server;
use \WP_REST_Request as WP_REST_Request;
use \WP_REST_Response as WP_REST_Response;

/**
 * Define the "Asset" REST Controller
 * *
 * @link       https://www.wrdsb.ca
 * @since      1.0.0
 *
 * @package    WRDSB_Staff
 * @subpackage WRDSB_Staff/Quartermaster
 */

class Asset extends WP_REST_Controller
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
        $this->api_namespace = 'wrdsb/staff/quartermaster';
        $this->api_version = '1';
    }

    /**
     * Register the routes for the objects of the controller.
     */
    public function registerRoutes()
    {
        WPCore::registerRestRoute('wrdsb/staff/quartermaster', '/assets', array(
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
        WPCore::registerRestRoute('wrdsb/staff/quartermaster', '/asset/(?P<id>[A-Za-z0-9-]+)', array(
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
    }

    /**
     * Get a collection of items
     *
     * @param WP_REST_Request $request Full data about the request.
     * @return WP_REST_Response
     */
    public function getItems(WP_REST_Request $request): WP_REST_Response
    {
        $assets = Model::all();

        return new WP_REST_Response($assets, 200);
    }

    /**
     * Get one item from the collection
     *
     * @param WP_REST_Request $request Full data about the request.
     * @return WP_REST_Response
     */
    public function getItem(WP_REST_Request $request): WP_REST_Response
    {
        $id = $this->getAssetID($request);

        $asset = Model::get($id);

        if ($asset->isSaved()) {
            return new WP_REST_Response($asset, 200);
        } else {
            //TODO: Does this constructor work?
            return new WP_REST_Response('Error retrieving asset.', 500);
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
        // TODO: Extract asset from request
        $args = $request->get_body_params();
        //$parameters = $request->get_json_params();

        // TODO: Create asset
        $createdAsset = Model::create($args);

        if ($createdAsset->isSaved()) {
            return new WP_REST_Response($createdAsset, 200);
        } else {
            //TODO: Does this constructor work?
            return new WP_REST_Response('Error creating asset.', 500);
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
        $id = $this->getAssetID($request);
        //TODO: Extract patch

        $updatedAsset = Model::patch(array(
            'id' => $id
            //TODO: Apply patch
        ));

        if ($updatedAsset->isSaved()) {
            return new WP_REST_Response($updatedAsset, 200);
        } else {
            //TODO: Does this constructor work?
            return new WP_REST_Response('Error updating asset.', 500);
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
        $id = $this->getAssetID($request);

        $command = Model::delete($id);
        $commandJSON = json_encode($command);

        //TODO: Send back a JSON response which is more useful to the client.
        if ($command->getState() === 'success') {
            return new WP_REST_Response($commandJSON, 200);
        } else {
            //TODO: Does this constructor work?
            return new WP_REST_Response($commandJSON, 500);
        }
    }

    /**
     * Given a WP_REST_Request object, retrieve the corresponding asset id.
     *
     * @param  WP_REST_Request $request Full details about the request.
     * @return string The asset ID from the request.
     */
    private function getAssetID(WP_REST_Request $request): string
    {
        $params = $request->get_url_params();
        $assetID = $params['id'];

        return $assetID;
    }

    /**
     * Given a WP_REST_Request object, retrieve the corresponding blog id.
     *
     * @param  WP_REST_Request $request Full details about the request.
     * @return string The blog ID from the request.
     */
    private function getBlogID(WP_REST_Request $request): string
    {
        $params = $request->get_url_params();
        $blogID = $params['blog'];

        return $blogID;
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
        if (WPCore::currentUserCan('setup_network')) {
            return true;
        }

        $user = WPCore::getCurrentUser();
        if (empty($user)) return false;

        $blogID = $this->getBlogID($request);
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
    public function deleteItemPermissionsCheck(WP_REST_Request $request): bool
    {
        return $this->updateItemPermissionsCheck($request);
    }
}
