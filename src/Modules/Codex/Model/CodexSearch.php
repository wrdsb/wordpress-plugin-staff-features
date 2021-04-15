<?php
namespace WRDSB\Staff\Modules\Codex\Model;
use WRDSB\Staff\Modules\WP\WPCore as WPCore;

use WRDSB\Staff\Modules\Codex\CodexModule as Module;
use WRDSB\Staff\Modules\Codex\Services\CodexService as Service;

/**
 * Define the "CodexSearch" Model
 * *
 * @link       https://www.wrdsb.ca
 * @since      1.0.0
 *
 * @package    WRDSB_Staff
 * @subpackage WRDSB_Staff/Codex
 */

class CodexSearch {
    private $dataType;
    private $url;
    private $suggester;

    private $service;

    private $state;
    private $status;
    private $error;
    private $rawResponse;
    private $totalResults;
    private $results;

    private static function getService($service): Service {
        return Module::getCodexService($service);
    }

    public function __construct($params) {
        $this->dataType     = $params['dataType']     ?? 'CodexPerson';

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

        $this->service = self::getService($params['service']);
        $this->state   = 'pending';
    }

    public function search() {
        $temp = $this->service->search($this);

        $this->state = $temp->getState();
        $this->status = $temp->getStatus();
        $this->rawResponse = $temp->getRawResponse();
        $this->totalResults = $temp->getTotalResults();
        $this->results = $temp->getResults();
        $this->error = $temp->getError();
    }

    public function suggest() {
        $temp = $this->service->suggest($this);

        $this->state = $temp->getState();
        $this->status = $temp->getStatus();
        $this->rawResponse = $temp->getRawResponse();
        $this->totalResults = $temp->getTotalResults();
        $this->results = $temp->getResults();
        $this->error = $temp->getError();
    }

    public function getDataType(): string {
        return $this->dataType;
    }
    public function setDataType(string $dataType) {
        $this->dataType = $dataType;
    }

    public function getSuggester(): string {
        return $this->suggester;
    }
    public function setSuggester(string $suggester) {
        $this->suggester = $suggester;
    }

    public function getURL(): string {
        return $this->url;
    }
    public function setURL(string $url) {
        $this->url = $url;
    }

    public function getCount(): bool {
        return $this->count;
    }
    public function setCount(bool $count) {
        $this->count = $count;
    }

    public function getFacets(): string {
        return $this->facets;
    }
    public function setFacets(string $facets) {
        $this->facets = $facets;
    }

    public function getFilter(): string {
        return $this->filter;
    }
    public function setFilter(string $filter) {
        $this->filter = $filter;
    }

    public function getOrderBy(): string {
        return $this->orderby;
    }
    public function setOrderBy(string $orderby) {
        $this->orderby = $orderby;
    }

    public function getSearch(): string {
        return $this->search;
    }
    public function setSearch(string $search) {
        $this->search = $search;
    }

    public function getSearchFields(): string {
        return $this->searchFields;
    }
    public function setSearchFields(string $searchFields) {
        $this->searchFields = $searchFields;
    }

    public function getSelect(): string {
        return $this->select;
    }
    public function setSelect(string $select) {
        $this->select = $select;
    }

    public function getSkip(): int {
        return $this->skip;
    }
    public function setSkip(int $skip) {
        $this->skip = $skip;
    }

    public function getTop(): int {
        return $this->top;
    }
    public function setTop(int $top) {
        $this->top = $top;
    }

    public function getHighlight(): string {
        return $this->highlight;
    }
    public function setHighlight(string $highlight) {
        $this->highlight = $highlight;
    }

    public function gethHghlightPreTag(): string {
        return $this->highlightPreTag;
    }
    public function setHighlightPreTag(string $highlightPreTag) {
        $this->highlightPreTag = $highlightPreTag;
    }

    public function gethHghlightPostTag(): string {
        return $this->highlightPostTag;
    }
    public function setHighlightPostTag(string $highlightPostTag) {
        $this->highlightPostTag = $highlightPostTag;
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
