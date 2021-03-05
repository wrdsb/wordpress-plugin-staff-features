<?php
namespace WRDSB\Staff\Modules\Quartermaster\Model;
use WRDSB\Staff\Modules\WP\WPCore as WPCore;

use WRDSB\Staff\Modules\Quartermaster\QuartermasterModule as Module;
use WRDSB\Staff\Modules\Quartermaster\Services\QuartermasterService as Service;

/**
 * Define the "QuartermasterCommand" Model
 * *
 * @link       https://www.wrdsb.ca
 * @since      1.0.0
 *
 * @package    WRDSB_Staff
 * @subpackage WRDSB_Staff/Quartermaster
 */

class QuartermasterCommand implements \JsonSerializable {
    private $operation;
    private $payload;

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

    public function __construct(string $operation, string $id, array $object = null) {
        if ($object) {
            $this->operation = $operation;
            $this->payload   = $object;
            $this->service   = self::getService();
            $this->state     = 'pending';
        } elseif ($operation === 'delete') {
            $object = new Model;
            $object->setID($id);

            $this->operation = $operation;
            $this->payload   = $object;
            $this->service   = self::getService();
            $this->state     = 'pending';
        } else {
            $this->operation = 'error';
            $this->state = 'error';
            $this->status = 500;
            $this->error = 'Bad request.';
        }
    }

    public function run() {
        switch ($this->operation) {
            case 'patch':
                $temp = $this->service->patch($this);
                $this->state = $temp->getState();
                $this->status = $temp->getStatus();
                $this->rawResponse = $temp->getRawResponse();
                $this->totalResults = $temp->getTotalResults();
                $this->results = $temp->getResults();
                $this->error = $temp->getError();
                break;
            
            case 'replace':
                $temp = $this->service->replace($this);
                $this->state = $temp->getState();
                $this->status = $temp->getStatus();
                $this->rawResponse = $temp->getRawResponse();
                $this->totalResults = $temp->getTotalResults();
                $this->results = $temp->getResults();
                $this->error = $temp->getError();
                break;
            
            case 'delete':
                $temp = $this->service->delete($this);
                $this->state = $temp->getState();
                $this->status = $temp->getStatus();
                $this->rawResponse = $temp->getRawResponse();
                $this->totalResults = $temp->getTotalResults();
                $this->results = $temp->getResults();
                $this->error = $temp->getError();
                break;
            
            default:
                // operation is error. no change in state or status.
                break;
        }
    }

    public function jsonSerialize() {
        $vars = get_object_vars($this);
        return $vars;
    }

    public function getPayload() {
        return $this->payload;
    }

    public function getOperation(): string {
        return $this->operation;
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
        return $this->error ?? 'None';
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
