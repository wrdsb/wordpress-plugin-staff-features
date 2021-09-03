<?php
namespace WRDSB\Staff\Modules\Quartermaster\Services;
use WRDSB\Staff\Modules\WP\WPCore as WPCore;

use WRDSB\Staff\Modules\Quartermaster\QuartermasterModule as Module;

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

    public function get(Query $query): Query {
        $query = $this->getRequest($query);
        return $query;
    }

    public function search(Query $search): Query {
        $search = $this->searchRequest($search);
        return $search;
    }

    public function create(Command $command): Command {
        $command = $this->createRequest($command);
        return $command;
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


    private function getRequest(Query $query): Query {
        $apiKey = Module::getCodexSearchKey();
        $searchIndex = '';
        $dataType = $query->getDataType();
        $id = $query->getID();
        error_log("Search for record id {$id}");

        switch ($dataType) {
            case 'AssetAssignment':
                $searchIndex = 'quartermaster-asset-assignments';
                break;
            
            case 'DeviceLoan':
                $searchIndex = 'quartermaster-device-loan-submissions';
                break;
                
            default:
                break;
        }

        $args = array(
            'url'         => "https://wrdsb-codex.search.windows.net/indexes/{$searchIndex}/docs/search?api-version=2016-09-01",
            'timeout'     => 15,
            'redirection' => 5,
            'httpversion' => '1.0',
            'blocking'    => true,
            'headers'     => array(
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'api-key' => $apiKey
            ),
            'cookies'     => array(),
            'body'        => json_encode(array(
                "search"  => "id eq {$id}",
                "select"  => "*",
                "top"     => 1,
                "count"   => true
            )),
            'compress'    => false,
            'decompress'  => true,
            'sslverify'   => false,
            'stream'      => false,
            'filename'    => null
        );

        $request = new WPRemotePost($args);
        $request->run();

        if ($request->success) {
            $query->setState('success');
            $query->setStatus($request->status);
            $query->setRawResponse($request->response->value);
            $query->setTotalResults(1);
            $query->setResults($request->response->value[0]);
            $query->setError('');
            error_log("Success searching for record id {$id}");
        } else {
            $query->setState('failure');
            $query->setStatus($request->status);
            $query->setRawResponse($request->response);
            $query->setTotalResults(0);
            $query->setResults(null);
            $query->setError($request->error);
            error_log('Quartermaster Serivce: ' . $request->status);
            error_log('Quartermaster Serivce: ' . json_encode($request->response));
            error_log('Quartermaster Service: ' . $request->error);
        }
        
        return $query;
    }


    private function searchRequest(Query $search): Query {
        $searchKey = Module::getCodexSearchKey();
        $url = '';

        $headers = array(
            "Accept" => "application/json",
            "api-key" => $searchKey,
        );

        $body = array(
            "count"         => $search->getCount(),
            "facets"        => $search->getFacets(),
            "filter"        => $search->getFilter(),
            "orderby"       => $search->getSelect(),
            "search"        => $search->getSearch(),
            "searchFields"  => $search->getSearchFields(),
            "select"        => $search->getSelect(),
            "skip"          => $search->getSkip(),
            "top"           => $search->getTop(),
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


    private function createRequest(Command $command): Command {
        $functionKey = Module::getQuartermasterCommandKey();
        $dataType = $command->getDataType();
        $returnObjectClass = (string) '\WRDSB\Staff\Modules\Quartermaster\Model\\' . $dataType;

        $url = "https://wrdsb-tollbooth.azurewebsites.net/api/quartermaster-command?code={$functionKey}";
        $body = array(
            'jobType' => 'Quartermaster.'.$dataType.'.Create',
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

            $item = new $returnObjectClass;
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

    private function storeRequest(Command $command): Command {
        $functionKey = Module::getQuartermasterCommandKey();
        $dataType = $command->getDataType();
        $returnObjectClass = (string) '\WRDSB\Staff\Modules\Quartermaster\Model\\' . $dataType;

        $url = "https://wrdsb-tollbooth.azurewebsites.net/api/quartermaster-command?code={$functionKey}";
        $body = array(
            'jobType' => 'Quartermaster.'.$dataType.'.Store',
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

            $item = new $returnObjectClass;
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
