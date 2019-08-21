<?php
namespace WRDSB\Staff\Modules\EmployeeAbsence\Services;

use WRDSB\Staff\Modules\EmployeeAbsence\Model\Absence as Absence;
use WRDSB\Staff\Modules\ContentSearch\Model\WPRemotePost as WPRemotePost;

/**
 * Define the "AbsenceService" class
 * *
 * @link       https://www.wrdsb.ca
 * @since      1.0.0
 *
 * @package    WRDSB_Staff
 * @subpackage WRDSB_Staff/Absence
 */

class AbsenceService
{
    public function __construct()
    {
        $this->target_url = 'https://wrdsb-flenderson.azurewebsites.net/api/absence-query?code=0PhlOjuFpdAZYplY11JgP/KcLFNwo0MzUHCcPWzP/feF16Z1nAGDLw==';
        //$this->target_url = $params['target_url'];
        //$this->api_key = $params['api_key'];
    }

    public function read($id)
    {
        $absence = $this->fetch($id);

        return $absence;
    }

    public function write($absence)
    {
        return true;
    }

    private function fetch($id)
    {
        $headers = array(
            "Accept" => "application/json",
            //"api-key" => $this->api_key,
        );

        $body = array(
            'id' => $id
        );

        $request = new WPRemotePost(array(
            'url' => $this->target_url,
            'headers' => $headers,
            'body' => json_encode($body),
        ));
        $response = $request->run();

        $response_object = json_decode($response['body'], $assoc = false);

        //$this->rawResponse  = $response_object;
        //$this->totalResults = $response_object->{'@odata.count'};
        //$this->results      = $response_object->value;

        return $response_object;
    }
}
