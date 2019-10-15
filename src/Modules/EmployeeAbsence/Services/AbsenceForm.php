<?php
namespace WRDSB\Staff\Modules\EmployeeAbsence\Services;

use WRDSB\Staff\Modules\EmployeeAbsence\Model\AbsenceForm as Model;
use WRDSB\Staff\Modules\WP\WPRemotePost as WPRemotePost;

/**
 * Define the "AbsenceForm" Service
 * *
 * @link       https://www.wrdsb.ca
 * @since      1.0.0
 *
 * @package    WRDSB_Staff
 * @subpackage WRDSB_Staff/Absence
 */

class AbsenceForm
{
    public function __construct()
    {
        //$this->target_url = $params['target_url'];
        //$this->api_key = $params['api_key'];
    }

    public function find(string $scope, string $by, string $valule, string $schoolCode = 'any')
    {
        switch ($scope) {
            case 'all':
                # code...
                break;
            
            case 'first':
                # code...
                break;
            
            default:
                # code...
                break;
        }
    }

    public function fetch(string $id): Model
    {
        $body = array(
            'id' => $id
        );

        $form = $this->queryRequest($body);
        return $form;
    }

    private function patch(Model $form)
    {
        $body = array(
            'operation' => 'patch',
            'payload' => $form,
        );

        $this->storeRequest($body);
    }

    public function replace(Model $form)
    {
        $body = array(
            'operation' => 'replace',
            'payload' => $form,
        );

        $this->storeRequest($body);
    }

    public function delete(Model $form)
    {
        $body = array(
            'operation' => 'delete',
            'payload' => $form,
        );

        $this->storeRequest($body);
    }

    private function queryRequest(array $body): Model
    {
        $functionKey = CMA_ABSENCE_FORM_QUERY_KEY;
        $url = "https://wrdsb-cma.azurewebsites.net/api/absence-query?code={$functionKey}";

        $request = new WPRemotePost(array(
            'url' => $url,
            'body' => json_encode($body),
        ));
        $request->run();

        if ($request->success) {

        } else {
            $response_object = $request->response;
        }
        $response_object = json_decode($response['body'], $assoc = false);
        
        $form = $response_object[0];
        return $form;
    }

    private function storeRequest(array $body): Model
    {
        $functionKey = CMA_ABSENCE_FORM_STORE_KEY;
        $url = "https://wrdsb-cma.azurewebsites.net/api/absence-form-store?code={$functionKey}";

        $request = new WPRemotePost(array(
            'url' => $url,
            'body' => json_encode($body),
        ));
        $request->run();

        $response_object = json_decode($response['body'], $assoc = false);
        
        $form = $response_object;
        return $form;
    }
}
