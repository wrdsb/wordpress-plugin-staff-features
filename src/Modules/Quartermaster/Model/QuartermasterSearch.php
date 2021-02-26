<?php
namespace WRDSB\Staff\Modules\Quartermaster\Model;
use WRDSB\Staff\Modules\WP\WPCore as WPCore;

use WRDSB\Staff\Modules\Quartermaster\QuartermasterModule as Module;
use WRDSB\Staff\Modules\Quartermaster\Services\QuartermasterService as Service;

/**
 * Define the "QuartermasterSearch" Model
 * *
 * @link       https://www.wrdsb.ca
 * @since      1.0.0
 *
 * @package    WRDSB_Staff
 * @subpackage WRDSB_Staff/Quartermaster
 */

class QuartermasterSearch
{
    private $service;
    private $state;
    private $status;
    private $error;
    private $rawResponse;
    private $totalResults;
    private $results;

    private static function getService($service): Service
    {
        return Module::getQuartermasterService($service);
    }

    public function __construct($params)
    {
        $this->count        = $params['count']        ?? true;
        $this->facets       = $params['facets']       ?? null;
        $this->filter       = $params['filter']       ?? null;
        $this->orderby      = $params['orderby']      ?? null;
        $this->search       = $params['search']       ?? '*';
        $this->searchFields = $params['searchFields'] ?? null;
        $this->select       = $params['select']       ?? '*';
        $this->skip         = $params['skip']         ?? 0;
        $this->top          = $params['top']          ?? 50;

        $this->highlight        = $params['highlight']        ?? null;
        $this->highlightPreTag  = $params['highlightPreTag']  ?? null;
        $this->highlightPostTag = $params['highlightPostTag'] ?? null;

        $this->service = self::getService($params['service']);
        $this->state   = 'pending';
    }

    public function run()
    {
        $temp = $this->service->search($this);

        $this->state = $temp->getState();
        $this->status = $temp->getStatus();
        $this->rawResponse = $temp->getRawResponse();
        $this->totalResults = $temp->getTotalResults();
        $this->results = $temp->getResults();
        $this->error = $temp->getError();
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
}
