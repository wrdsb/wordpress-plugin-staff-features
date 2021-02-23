<?php
namespace WRDSB\Staff\Modules\Quartermaster\Model;

use WRDSB\Staff\Modules\Quartermaster\QuartermasterModule as Module;
use WRDSB\Staff\Modules\Quartermaster\Services\DeviceLoanForms as Service;

use WRDSB\Staff\Modules\Quartermaster\Model\DeviceLoanForm as Model;
use WRDSB\Staff\Modules\Quartermaster\Model\DeviceLoanFormCollection as Collection;

/**
 * Define the "DeviceLoanFormQuery" Model
 * *
 * @link       https://www.wrdsb.ca
 * @since      1.0.0
 *
 * @package    WRDSB_Staff
 * @subpackage WRDSB_Staff/Quartermaster
 */

class DeviceLoanFormQuery
{
    private $id;

    private $service;
    private $state;
    private $status;
    private $error;
    private $rawResponse;
    private $totalResults;
    private $results;

    private static function getService(): Service
    {
        return Module::getAbsenceFormQueryService();
    }

    public function __construct(string $id)
    {
        $this->id = $id;

        $this->service = self::getService();
        $this->state   = 'pending';
    }

    public function run()
    {
        $temp = $this->service->fetch($this);

        $this->state = $temp->getState();
        $this->status = $temp->getStatus();
        $this->rawResponse = $temp->getRawResponse();
        $this->totalResults = $temp->getTotalResults();
        $this->results = $temp->getResults();
        $this->error = $temp->getError();
    }

    public function getID(): string
    {
        return $this->id;
    }

    public function getState(): string
    {
        return $this->state;
    }
    public function setState(string $state)
    {
        $this->state = $state;
    }

    public function getStatus(): int
    {
        return $this->status;
    }
    public function setStatus(int $status)
    {
        $this->status = $status;
    }

    public function getError(): string
    {
        return $this->error;
    }
    public function setError(string $error)
    {
        $this->error = $error;
    }

    public function getRawResponse()
    {
        return $this->rawResponse;
    }
    public function setRawResponse($rawResponse)
    {
        $this->rawResponse = $rawResponse;
    }

    public function getTotalResults()
    {
        return $this->totalResults;
    }
    public function setTotalResults($totalResults)
    {
        $this->totalResults = $totalResults;
    }

    public function getResults()
    {
        return $this->results;
    }
    public function setResults($results)
    {
        $this->results = $results;
    }
}
