<?php
namespace WRDSB\Staff\Modules\Quartermaster\Services;
use WRDSB\Staff\Modules\WP\WPCore as WPCore;

use WRDSB\Staff\Modules\Quartermaster\QuartermasterModule as Module;
use WRDSB\Staff\Modules\Quartermaster\Model\QuartermasterSearch as Search;
use WRDSB\Staff\Modules\Quartermaster\Model\QuartermasterCommand as Command;
use WRDSB\Staff\Modules\Quartermaster\Model\QuartermasterQuery as Query;
use WRDSB\Staff\Modules\WP\WPRemotePost as WPRemotePost;

/**
 * Define the main Quartermaster Service
 * *
 * @link       https://www.wrdsb.ca
 * @since      1.0.0
 *
 * @package    WRDSB_Staff
 * @subpackage WRDSB_Staff/Quartermaster
 */

class QuartermasterService {
    public function __construct() {
    }

    public function search(Search $search): Search {
        $search = $this->searchRequest($search);
        return $search;
    }

    public function fetch(Query $query): Query {
        $query = $this->queryRequest($query);
        return $query;
    }

    public function patch(Command $command): Command {
        $command = $this->storeRequest($command);
        return $command;
    }

    public function replace(Command $command): Command {
        $command = $this->storeRequest($command);
        return $command;
    }

    public function delete(Command $command): Command {
        $command = $this->storeRequest($command);
        return $command;
    }

    private function searchRequest(Search $search): Search {
        $searchKey = Module::getCodexSearchKey();
        $url = '';

        $headers = array(
            "Accept" => "application/json",
            "api-key" => $searchKey,
        );

        $body = array(
            "filter"  => $search->filter,
            "facets"  => $search->facets,
            "search"  => $search->search,
            "select"  => $search->select,
            "orderby" => $search->orderby,
            "top"     => $search->top,
            "count"   => $search->count,
            "skip"    => $search->skip,
        );
    
        $request = new WPRemotePost(array(
            'url' => $url,
            'headers' => $headers,
            'body' => json_encode($body),
        ));
        $request->run();

        if ($request->success) {
            $items = new ModelCollection;
            $items.fromJSON($request->response);

            $search->setState('success');
            $search->setStatus($request->status);
            $search->setRawResponse($request->response);
            $search->setTotalResults(1);
            $search->setResults($items);
        } else {
            $search->setState('failure');
            $search->setStatus($request->status);
            $search->setError($request->error);
        }

        return $search;
    }

    private function queryRequest(Query $query): Query {
        $functionKey = Module::getQuartermasterQueryKey();
        $url = "https://wrdsb-quartermaster.azurewebsites.net/api/quartermaster-query?code={$functionKey}";
        $body = array(
            'dataType' => $query->getDataType(),
            'id' => $query->getID()
        );

        $request = new WPRemotePost(array(
            'headers' => array(),
            'url' => $url,
            'body' => json_encode($body),
        ));
        $request->run();

        if ($request->success) {
            $query->setState('success');
            $query->setStatus($request->status);
            $query->setRawResponse($request->response);
            $query->setError('');
        } else {
            $query->setState('failure');
            $query->setStatus($request->status);
            $query->setRawResponse($request->response);
            $query->setError($request->error);
            error_log('Quartermaster Serivce: ' . $request->status);
            error_log('Quartermaster Service: ' . $request->error);
        }
        
        return $query;
    }

    private function storeRequest(Command $command): Command {
        $functionKey = Module::getQuartermasterCommandKey();
        $url = "https://wrdsb-quartermaster.azurewebsites.net/api/quartermaster-command?code={$functionKey}";
        $body = array(
            'jobType' => 'Quartermaster.DeviceLoanSubmission.Store',
            'operation' => $command->getOperation(),
            'payload' => $command->getPayload(),
        );

        $request = new WPRemotePost(array(
            'headers' => array(),
            'url' => $url,
            'body' => json_encode($body),
        ));
        $request->run();

        if ($request->success) {
            $responseString = json_encode($request->response);

            $item = new Model;
            $item->fromJSON($responseString);

            $command->setState('success');
            $command->setStatus($request->status);
            $command->setRawResponse($request->response);
            $command->setTotalResults(1);
            $command->setResults($item);
        } else {
            $command->setState('failure');
            $command->setStatus($request->status);
            $command->setError($request->error);
            error_log(json_encode($command));
        }
        
        return $command;
    }
}
