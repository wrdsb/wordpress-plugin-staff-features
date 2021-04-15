<?php
namespace WRDSB\Staff\Modules\Codex\Services;
use WRDSB\Staff\Modules\WP\WPCore as WPCore;

use WRDSB\Staff\Modules\Codex\CodexModule as Module;

use WRDSB\Staff\Modules\Codex\Model\CodexSearch as Search;

use WRDSB\Staff\Modules\WP\WPRemotePost as WPRemotePost;

/**
 * Define the main Codex Service
 * *
 * @link       https://www.wrdsb.ca
 * @since      1.0.0
 *
 * @package    WRDSB_Staff
 * @subpackage WRDSB_Staff/Codex
 */

class CodexService {
    public function __construct() {
    }

    public function search(Search $search): Search {
        switch ($search->getDataType()) {
            case 'CodexPerson':
                $search->setURL('https://wrdsb-codex.search.windows.net/indexes/flenderson-people/docs?api-version=2020-06-30');
                $search = $this->searchRequest($search);
                break;
            
            default:
                $search->setState('failure');
                $search->setStatus('dataType required');
                $search->setError('dataType required');
                break;
        }
        
        return $search;
    }

    public function suggest(Search $search): Search {
        switch ($search->getDataType()) {
            case 'CodexPerson':
                $search->setURL('https://wrdsb-codex.search.windows.net/indexes/flenderson-people/docs/suggest?api-version=2020-06-30');
                $search->setSuggester('flenderson-people');
                $search = $this->suggestRequest($search);
                break;
            
            default:
                $search->setState('failure');
                $search->setStatus('dataType required');
                $search->setError('dataType required');
                break;
        }
        
        return $search;
    }


    private function searchRequest(Search $search): Search {
        $searchKey = Module::getCodexSearchKey();
        $url = $search->getURL();

        $headers = array(
            "Accept" => "application/json",
            "api-key" => $searchKey,
        );

        $body = array(
            "filter"       => $search->getFilter(),
            "facets"       => $search->getFacets(),
            "search"       => $search->getSearch(),
            "searchFields" => $search->getSearchFields(),
            "select"       => $search->getSelect(),
            "orderby"      => $search->getOrderby(),
            "top"          => $search->getTop(),
            "count"        => $search->getCount(),
            "skip"         => $search->getSkip(),
        );
    
        $request = new WPRemotePost(array(
            'url' => $url,
            'headers' => $headers,
            'body' => json_encode($body),
        ));
        $request->run();

        if ($request->success) {
            $search->setState('success');
            $search->setStatus($request->status);
            $search->setRawResponse($request->response->value);
            $search->setTotalResults(count($request->response->value));
            $search->setResults($request->response->value);
        } else {
            $search->setState('failure');
            $search->setStatus($request->status);
            $search->setError($request->error);
        }

        return $search;
    }

    private function suggestRequest(Search $search): Search {
        $searchKey = Module::getCodexSearchKey();
        $url = $search->getURL();

        $headers = array(
            "Accept" => "application/json",
            "api-key" => $searchKey,
        );

        $body = array(
            "filter"           => $search->getFilter(),
            "fuzzy"            => true,
            "highlightPreTag"  => $search->gethHghlightPreTag(),
            "highlightPostTag" => $search->gethHghlightPostTag(),
            "orderby"          => $search->getOrderby(),
            "search"           => $search->getSearch(),
            "searchFields"     => $search->getSearchFields(),
            "select"           => $search->getSelect(),
            "suggesterName"    => $search->getSuggester(),
            "top"              => $search->getTop()
        );

        $request = new WPRemotePost(array(
            'url' => $url,
            'headers' => $headers,
            'body' => json_encode($body),
        ));
        $request->run();

        if ($request->success) {
            $search->setState('success');
            $search->setStatus($request->status);
            $search->setRawResponse($request->response->value);
            $search->setTotalResults(count($request->response->value));
            $search->setResults($request->response->value);
            $search->setError('');
        } else {
            $search->setState('failure');
            $search->setStatus($request->status);
            $search->setError($request->error);
            error_log('CodexService::suggestRequest: failure');
            error_log("CodexService::suggestRequest: {$request->status}");
            error_log("CodexService::suggestRequest: {$request->error}");
        }

        return $search;
    }
}
