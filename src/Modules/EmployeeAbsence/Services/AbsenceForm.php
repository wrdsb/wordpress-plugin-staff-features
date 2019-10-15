<?php
namespace WRDSB\Staff\Modules\EmployeeAbsence\Services;

use WRDSB\Staff\Modules\EmployeeAbsence\Model\AbsenceForm as Model;
use WRDSB\Staff\Modules\EmployeeAbsence\Model\AbsenceFormCollection as ModelCollection;

use WRDSB\Staff\Modules\EmployeeAbsence\Model\AbsenceFormSearch as Search;
use WRDSB\Staff\Modules\EmployeeAbsence\Model\AbsenceFormCommand as Command;
use WRDSB\Staff\Modules\EmployeeAbsence\Model\AbsenceFormQuery as Query;
use WRDSB\Staff\Modules\WP\WPRemotePost as WPRemotePost;

/**
 * Define the "AbsenceForm" Service
 * *
 * @link       https://www.wrdsb.ca
 * @since      1.0.0
 *
 * @package    WRDSB_Staff
 * @subpackage WRDSB_Staff/Absence
 */

class AbsenceForm
{
    public function __construct()
    {
    }

    public function search(Search $search): Search
    {
        $search = $this->searchRequest($search);
        return $search;
    }

    public function fetch(Query $query): Query
    {
        $query = $this->queryRequest($query);
        return $query;
    }

    public function patch(Command $command): Command
    {
        $command = $this->storeRequest($command);
        return $command;
    }

    public function replace(Command $command): Command
    {
        $command = $this->storeRequest($command);
        return $command;
    }

    public function delete(Command $command): Command
    {
        $command = $this->storeRequest($command);
        return $command;
    }

    private function searchRequest(Search $search): Search
    {
        $searchKey = '';
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
            $forms = new ModelCollection;
            $forms.fromJSON($request->response);

            $search->setState('success');
            $search->setStatus($request->status);
            $search->setRawResponse($request->response);
            $search->setTotalResults(1);
            $search->setResults($forms);
        } else {
            $search->setState('failure');
            $search->setStatus($request->status);
            $search->setError($request->error);
        }

        return $search;
    }

    private function queryRequest(Query $query): Query
    {
        $functionKey = CMA_ABSENCE_FORM_QUERY_KEY;
        $url = "https://wrdsb-cma.azurewebsites.net/api/absence-query?code={$functionKey}";
        $body = array(
            'id' => $query->getID()
        );

        $request = new WPRemotePost(array(
            'url' => $url,
            'body' => json_encode($body),
        ));
        $request->run();

        if ($request->success) {
            $form = new Model;
            $form.fromJSON($request->response);

            $query->setState('success');
            $query->setStatus($request->status);
            $query->setRawResponse($request->response);
            $query->setTotalResults(1);
            $query->setResults($form);
        } else {
            $query->setState('failure');
            $query->setStatus($request->status);
            $query->setError($request->error);
        }
        
        return $query;
    }

    private function storeRequest(Command $command): Command
    {
        $functionKey = CMA_ABSENCE_FORM_STORE_KEY;
        $url = "https://wrdsb-cma.azurewebsites.net/api/absence-form-store?code={$functionKey}";
        $body = array(
            'operation' => $command->getOperation(),
            'payload' => $command->getPayload(),
        );

        $request = new WPRemotePost(array(
            'url' => $url,
            'body' => json_encode($body),
        ));
        $request->run();

        if ($request->success) {
            $form = new Model;
            $form.fromJSON($request->response);

            $command->setState('success');
            $command->setStatus($request->status);
            $command->setRawResponse($request->response);
            $command->setTotalResults(1);
            $command->setResults($form);
        } else {
            $command->setState('failure');
            $command->setStatus($request->status);
            $command->setError($request->error);
        }
        
        return $command;
    }
}
