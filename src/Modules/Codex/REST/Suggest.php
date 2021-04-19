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
 * Define the "Suggest" REST Controller
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
        $this->api_namespace = 'wrdsb/staff/codex/search/suggest';
        $this->api_version = '1';
    }

    /**
     * Register the routes for the objects of the controller.
     */
    public function registerRoutes() {
        register_rest_route($this->api_namespace, '/flenderson-people/email', array(
            array(
                'methods'             => WP_REST_Server::READABLE,
                'callback'            => array( $this, 'flendersonPeopleEmail' ),
                'permission_callback' => array( $this, 'flendersonPeoplePermissionsCheck' ),
            ),
        ));
        register_rest_route($this->api_namespace, '/flenderson-people/fullName', array(
            array(
                'methods'             => WP_REST_Server::READABLE,
                'callback'            => array( $this, 'flendersonPeopleFullName' ),
                'permission_callback' => array( $this, 'flendersonPeoplePermissionsCheck' ),
            ),
        ));
        register_rest_route($this->api_namespace, '/skinner-students/email', array(
            array(
                'methods'             => WP_REST_Server::READABLE,
                'callback'            => array( $this, 'skinnerStudentsEmail' ),
                'permission_callback' => array( $this, 'skinnerStudentsPermissionsCheck' ),
            ),
        ));
        register_rest_route($this->api_namespace, '/skinner-students/fullName', array(
            array(
                'methods'             => WP_REST_Server::READABLE,
                'callback'            => array( $this, 'skinnerStudentsFullName' ),
                'permission_callback' => array( $this, 'skinnerStudentsPermissionsCheck' ),
            ),
        ));
    }


    /**
     * Suggest FlendersonPeople by email
     *
     * @param WP_REST_Request $request Full data about the request.
     * @return WP_REST_Response
     */
    public function flendersonPeopleEmail(WP_REST_Request $request): WP_REST_Response {
        $response = array();
        $term = $request['term'];

        $flendersonPeople = FlendersonPerson::suggest(array(
            'field' => 'email',
            'value' => $term
        ));

        foreach ($flendersonPeople as $flendersonPerson) {
            $fullName = $flendersonPerson->getFullName();
            $email = $flendersonPerson->getEmail();
            $response[] = array(
                'label' => "{$fullName} <{$email}>",
                'value' => "{$fullName} <{$email}>"
            );
        };

        return new WP_REST_Response($response, 200);
    }

    /**
     * Suggest FlendersonPeople by fullName
     *
     * @param WP_REST_Request $request Full data about the request.
     * @return WP_REST_Response
     */
    public function flendersonPeopleFullName(WP_REST_Request $request): WP_REST_Response {
        $response = array();
        $term = $request['term'];

        $flendersonPeople = FlendersonPerson::suggest(array(
            'field' => 'fullName',
            'value' => $term
        ));

        foreach ($flendersonPeople as $flendersonPerson) {
            $fullName = $flendersonPerson->getFullName();
            $email = $flendersonPerson->getEmail();
            $response[] = array(
                'label' => "{$fullName} <{$email}>",
                'value' => "{$fullName} <{$email}>"
            );
        };

        return new WP_REST_Response($response, 200);
    }

    /**
     * Suggest SkinnerStudent by email
     *
     * @param WP_REST_Request $request Full data about the request.
     * @return WP_REST_Response
     */
    public function skinnerStudentsEmail(WP_REST_Request $request): WP_REST_Response {
        $response = array();
        $term = $request['term'];

        $skinnerStudents = SkinnerStudent::suggest(array(
            'field' => 'email',
            'value' => $term
        ));

        foreach ($skinnerStudents as $skinnerStudent) {
            $fullName = $skinnerStudent->getFullName();
            $email = $skinnerStudent->getEmail();
            $response[] = array(
                'label' => "{$fullName} <{$email}>",
                'value' => "{$fullName} <{$email}>"
            );
        };

        return new WP_REST_Response($response, 200);
    }

    /**
     * Suggest SkinnerStudent by fullName
     *
     * @param WP_REST_Request $request Full data about the request.
     * @return WP_REST_Response
     */
    public function skinnerStudentsFullName(WP_REST_Request $request): WP_REST_Response {
        $response = array();
        $term = $request['term'];

        $skinnerStudents = SkinnerStudent::suggest(array(
            'field' => 'fullName',
            'value' => $term
        ));

        foreach ($skinnerStudents as $skinnerStudent) {
            $fullName = $skinnerStudent->getFullName();
            $email = $skinnerStudent->getEmail();
            $response[] = array(
                'label' => "{$fullName} <{$email}>",
                'value' => "{$fullName} <{$email}>"
            );
        };

        return new WP_REST_Response($response, 200);
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
