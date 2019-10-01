<?php
namespace WRDSB\Staff\Modules\EmployeeAbsence\Services;

use \WP_REST_Controller as WP_REST_Controller;
use \WP_REST_Server as WP_REST_Server;
use \WP_REST_Response as WP_REST_Response;
use \WP_Error as WP_Error;

class AbsenceFormAPI extends WP_REST_Controller
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
                'args'                => array(
                    'context' => $this->get_context_param(array('default' => 'edit')),
                ),
            ),
        ));
        register_rest_route('wrdsb/staff/employee/absence', '/form/(?P<id>[A-Za-z0-9-]+)', array(
            array(
                'methods'             => WP_REST_Server::READABLE,
                'callback'            => array( $this, 'getItem' ),
                'permission_callback' => array( $this, 'getItemPermissionsCheck' ),
                'args'                => array(
                    'context' => $this->get_context_param(array('default' => 'edit')),
                ),
            ),
            array(
                'methods'             => WP_REST_Server::EDITABLE,
                'callback'            => array( $this, 'updateItem' ),
                'permission_callback' => array( $this, 'updateItemPermissionsCheck' ),
                'args'                => $this->get_endpoint_args_for_item_schema(WP_REST_Server::EDITABLE),
            ),
            array(
                'methods'             => WP_REST_Server::DELETABLE,
                'callback'            => array( $this, 'deleteItem' ),
                'permission_callback' => array( $this, 'deleteItemPermissionsCheck' ),
                'args'                => array(
                    'force' => array(
                        'default'     => false,
                        'description' => __('Required to be true, as resource does not support trashing.'),
                    ),
                    'reassign' => array(),
                ),
            ),
        ));
        register_rest_route('wrdsb/staff/employee/absence', '/form/(?P<id>[A-Za-z0-9-]+)/processed', array(
            array(
                'methods'             => WP_REST_Server::EDITABLE,
                'callback'            => array( $this, 'markItemProcessed' ),
                'permission_callback' => array( $this, 'updateItemPermissionsCheck' ),
                'args'                => $this->get_endpoint_args_for_item_schema(WP_REST_Server::EDITABLE),
            ),
        ));
    }

    public function getItems($request)
    {

    }

    public function getItem($request)
    {
        $schoolCode = "JAM";
        $params = $request->get_url_params();
        $form_id = $params['id'];
        $form = $this->fetchForm($schoolCode, $form_id);
    
        //return a response or error based on some conditional
        if ( 1 == 1 ) {
            //$data = $this->prepare_item_for_response($form, $request);
            $data = $form;
            return new WP_REST_Response( $data, 200 );
        } else {
            return new WP_Error( 'code', __( 'message', 'text-domain' ) );
        }        
    }

    public function updateItem($request)
    {
        
    }

    public function deleteItem($request)
    {
        
    }

    public function markItemProcessed($request)
    {
        $schoolCode = "JAM";
        $params = $request->get_url_params();
        $form_id = $params['id'];
        $form = $this->fetchForm($schoolCode, $form_id);

        $form->processed = "true";

        $updated_form = $this->patchForm($form);

        //return a response or error based on some conditional
        if ( 1 == 1 ) {
            //$data = $this->prepare_item_for_response($form, $request);
            $data = $updated_form;
            return new WP_REST_Response( $data, 200 );
        } else {
            return new WP_Error( 'code', __( 'message', 'text-domain' ) );
        }        
    }

    private function fetchForm($schoolCode, $id)
    {
        $functionKey = CMA_ABSENCE_QUERY_KEY;

        $body = array(
            'schoolCode' => $schoolCode,
            'id' => $id,
        );
        
        $url = "https://wrdsb-cma.azurewebsites.net/api/absence-query?code={$functionKey}";
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
        
        $form = $response_object[0];
        return $form;
    }

    private function patchForm($patch)
    {
        $functionKey = CMA_ABSENCE_FORM_STORE_KEY;

        $body = array(
            'operation' => 'patch',
            'payload' => $patch,
        );
        
        $url = "https://wrdsb-cma.azurewebsites.net/api/absence-form-store?code={$functionKey}";
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
        
        $form = $response_object;
        return $form;
    }

    /**
     * Check if a given request has access to read a collection of items
     *
     * @param  WP_REST_Request $request Full details about the request.
     * @return WP_Error|boolean
     */
    public function getItemsPermissionsCheck($request)
    {
        return $this->updateItemPermissionsCheck($request);
    }

    /**
     * Check if a given request has access to read an item
     *
     * @param  WP_REST_Request $request Full details about the request.
     * @return WP_Error|boolean
     */
    public function getItemPermissionsCheck($request)
    {
        return $this->updateItemPermissionsCheck($request);
    }

    /**
     * Check if a given request has access to update an item
     *
     * @param  WP_REST_Request $request Full details about the request.
     * @return WP_Error|boolean
     */
    public function updateItemPermissionsCheck($request)
    {
        $current_user = wp_get_current_user();

        if (in_array($current_user->user_email, $this->getAuthorizedUsers())) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Check if a given request has access delete an item
     *
     * @param  WP_REST_Request $request Full details about the request.
     * @return WP_Error|boolean
     */
    public function deleteItemPermissionsCheck($request)
    {
        return $this->updateItemPermissionsCheck($request);
    }
}
