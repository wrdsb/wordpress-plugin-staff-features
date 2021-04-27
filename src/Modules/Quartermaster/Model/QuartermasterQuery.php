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
    private $id;

    private $service;

    private $count;
    private $facets;
    private $filter;
    private $orderby;
    private $search;
    private $searchFields;
    private $select;
    private $skip;
    private $top;

    private $highlight;
    private $highlightPreTag;
    private $highlightPostTag;

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
        $this->dataType  = $dataType     ?? null;
        $this->operation = $operation    ?? null;
        $this->id        = $params['id'] ?? null;

        $this->service = self::getService();
        $this->state   = 'pending';

        if ($operation === 'search') {
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
        }
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
                    $this->totalResults = $temp->getTotalResults();
                    $this->results = $temp->getResults();
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

    public function getID(): string {
        return $this->id;
    }

    public function getcount(): bool {
        return $this->count;
    }

    public function getfacets(): string {
        return $this->facets;
    }

    public function getfilter(): string {
        return $this->filter;
    }

    public function getorderby(): string {
        return $this->orderby;
    }

    public function getsearch(): string {
        return $this->search;
    }

    public function getsearchFields(): string {
        return $this->searchFields;
    }

    public function getselect(): string {
        return $this->select;
    }

    public function getskip(): int {
        return $this->skip;
    }

    public function gettop(): int {
        return $this->top;
    }

    public function gethighlight(): string {
        return $this->highlight;
    }

    public function gethighlightPreTag(): string {
        return $this->highlightPreTag;
    }

    public function gethighlightPostTag(): string {
        return $this->highlightPostTag;
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
