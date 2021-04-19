<?php
namespace WRDSB\Staff\Modules\Codex\REST;
use WRDSB\Staff\Modules\WP\WPCore as WPCore;

use WRDSB\Staff\Modules\Codex\Model\FlendersonPerson as FlendersonPerson;
use WRDSB\Staff\Modules\Codex\Model\SkinnerStudent as SkinnerStudent;

use WRDSB\Staff\Modules\Codex\Model\CodexSearch as Search;

use \WP_REST_Controller as WP_REST_Controller;
use \WP_REST_Server as WP_REST_Server;
use \WP_REST_Request as WP_REST_Request;
use \WP_REST_Response as WP_REST_Response;

/**
 * Define the "Search" REST Controller
 * *
 * @link       https://www.wrdsb.ca
 * @since      1.0.0
 *
 * @package    WRDSB_Staff
 * @subpackage WRDSB_Staff/Codex
 */

class Suggest extends WP_REST_Controller {
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
        $this->api_namespace = 'wrdsb/staff/codex/search';
        $this->api_version = '1';
    }

    /**
     * Register the routes for the objects of the controller.
     */
    public function registerRoutes() {
        register_rest_route($this->api_namespace, '/flenderson-people', array(
            array(
                'methods'             => WP_REST_Server::READABLE,
                'callback'            => array( $this, 'flendersonPeople' ),
                'permission_callback' => array( $this, 'flendersonPeoplePermissionsCheck' ),
            ),
        ));
        register_rest_route($this->api_namespace, '/skinner-students', array(
            array(
                'methods'             => WP_REST_Server::READABLE,
                'callback'            => array( $this, 'skinnerStudents' ),
                'permission_callback' => array( $this, 'skinnerStudentsPermissionsCheck' ),
            ),
        ));
    }

    /**
     * Search for a FlendersonPerson
     *
     * @param WP_REST_Request $request Full data about the request.
     * @return WP_REST_Response
     */
    public function flendersonPeople(WP_REST_Request $request): WP_REST_Response {
        $body = $request->get_json_params();

        $codexPeople = FlendersonPerson::find(array(
        ));

        if ($codexPerson->getIsSaved()) {
            return new WP_REST_Response($codexPerson, 200);
        } else {
            return new WP_REST_Response($codexPerson, 404);
        }
    }

    /**
     * Search for a SkinnerStudent
     *
     * @param WP_REST_Request $request Full data about the request.
     * @return WP_REST_Response
     */
    public function skinnerStudents(WP_REST_Request $request): WP_REST_Response {
        $body = $request->get_json_params();

        $codexPeople = SkinnerStudent::find(array(
        ));

        if ($codexPerson->getIsSaved()) {
            return new WP_REST_Response($codexPerson, 200);
        } else {
            return new WP_REST_Response($codexPerson, 404);
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
     * Check if a given request has access to search for people
     *
     * @param  WP_REST_Request $request Full details about the request.
     * @return boolean
     */
    public function peopleSearchPermissionsCheck(WP_REST_Request $request): bool {
        return true;
    }
}
