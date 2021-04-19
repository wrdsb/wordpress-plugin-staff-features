<?php
namespace WRDSB\Staff\Modules\Quartermaster\Model;
use WRDSB\Staff\Modules\WP\WPCore as WPCore;

use WRDSB\Staff\Modules\Quartermaster\QuartermasterModule as Module;
use WRDSB\Staff\Modules\Quartermaster\Services\QuartermasterService as Service;

/**
 * Define the "QuartermasterQuery" Model
 * *
 * @link       https://www.wrdsb.ca
 * @since      1.0.0
 *
 * @package    WRDSB_Staff
 * @subpackage WRDSB_Staff/Quartermaster
 */

class QuartermasterQuery {
    private $dataType;
    private $operation;
    private $payload;

    private $databaseID;
    private $searchID;

    private $service;
    private $state;
    private $status;
    private $error;
    private $rawResponse;
    private $totalResults;
    private $results;

    private static function getService(): Service {
        return Module::getQuartermasterService();
    }

    public function __construct(string $dataType, string $operation, array $params) {
        $this->dataType = $dataType;
        $this->operation = $operation;

        $this->databaseID = $params['databaseID']     ?? null;
        $this->searchID   = $params['searchID']       ?? null;

        $this->count        = $params['count']        ?? true;
        $this->facets       = $params['facets']       ?? '';
        $this->filter       = $params['filter']       ?? '';
        $this->orderby      = $params['orderby']      ?? '';
        $this->search       = $params['search']       ?? '*';
        $this->searchFields = $params['searchFields'] ?? '';
        $this->select       = $params['select']       ?? '*';
        $this->skip         = $params['skip']         ?? 0;
        $this->top          = $params['top']          ?? 50;

        $this->highlight        = $params['highlight']        ?? '';
        $this->highlightPreTag  = $params['highlightPreTag']  ?? '';
        $this->highlightPostTag = $params['highlightPostTag'] ?? '';

        $this->service = self::getService();
        $this->state   = 'pending';
    }

    public function run() {
        switch ($this->operation) {
            case 'get':
                $temp = $this->service->get($this);

                $this->state = $temp->getState();
                $this->status = $temp->getStatus();
                $this->rawResponse = $temp->getRawResponse();
                $this->error = $temp->getError();
    
                if ($this->getState() === 'success') {
                    $this->results = $this->rawResponse;
                }

                break;

            case 'search':
                $temp = $this->service->search($this);

                $this->state = $temp->getState();
                $this->status = $temp->getStatus();
                $this->rawResponse = $temp->getRawResponse();
                $this->error = $temp->getError();
    
                if ($this->getState() === 'success') {
                    $this->totalResults = $temp->getTotalResults();
                    $this->results = $temp->getResults();
                }

                break;

            default:
                break;
        }
    }

    public function jsonSerialize() {
        $vars = get_object_vars($this);
        return $vars;
    }

    public function getDataType(): string {
        return $this->dataType;
    }

    public function getOperation(): string {
        return $this->operation;
    }

    public function getPayload() {
        return $this->payload;
    }

    public function getState(): string {
        return $this->state;
    }
    public function setState(string $state) {
        $this->state = $state;
    }

    public function getStatus(): int {
        return $this->status;
    }
    public function setStatus(int $status) {
        $this->status = $status;
    }

    public function getError(): string {
        return $this->error;
    }
    public function setError(string $error) {
        $this->error = $error;
    }

    public function getRawResponse() {
        return $this->rawResponse;
    }
    public function setRawResponse($rawResponse) {
        $this->rawResponse = $rawResponse;
    }

    public function getTotalResults() {
        return $this->totalResults;
    }
    public function setTotalResults($totalResults) {
        $this->totalResults = $totalResults;
    }

    public function getResults() {
        return $this->results;
    }
    public function setResults($results) {
        $this->results = $results;
    }
}
