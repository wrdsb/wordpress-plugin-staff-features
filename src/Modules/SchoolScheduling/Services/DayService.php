<?php
namespace WRDSB\Staff\Modules\SchoolScheduling\Services;

/**
 * Define the "DayService" class
 * *
 * @link       https://www.wrdsb.ca
 * @since      1.0.0
 *
 * @package    WRDSB_Staff
 * @subpackage WRDSB_Staff/SchoolScheduling
 */

class DayService
{
    public function __construct($httpClient, $serviceURL)
    {
        $this->httpClient = $httpClient;
        $this->serviceURL = $serviceURL;
    }

    public function getDays(): array
    {
        $days = array();

        $request = array(
            'url' => $this->serviceURL,
            'body' => array(

            )
        );
        $response = $this->doRequest($request);

        return $days;
    }

    public function getDay(string $date): Day
    {
        $request = array();
        return $day;
    }

    public function addDay(Day $day)
    {
        $request = array();
    }

    public function updateDay(Day $day)
    {
        $request = array();
    }

    public function deleteDay(Day $day)
    {
        $request = array();
    }

    private function doRequest($request)
    {
        return $this->httpClient->doRequest($request);
    }
}
