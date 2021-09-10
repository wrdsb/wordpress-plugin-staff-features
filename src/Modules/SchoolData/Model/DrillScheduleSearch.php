<?php
namespace WRDSB\Staff\Modules\SchoolData\Model;

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    WRDSB_Staff
 * @author     WRDSB <website@wrdsb.ca>
 */
class DrillScheduleSearch {
    private $target_url = 'https://wrdsb-codex.search.windows.net/indexes/lamson-wp-posts2/docs/search?api-version=2016-09-01';
    private $api_key = WRDSB_CODEX_SEARCH_KEY;

    public static function audit() {
        $good = [];
        $bad = SchoolsList::all();

        $search_params = [];
        $search_params['count']   = true;
        $search_params['filter']  = "post_type eq 'drillschedule'";
        $search_params['orderby'] = 'post_title';
        $search_params['search']  = '*';
        $search_params['select']  = '*';
        $search_params['top']     = '200';

        $search = new DrillScheduleSearch($search_params);
        $search->run();

        foreach ($search->results as $post) {
            if (strtoupper($post->schoolCode) != "DSPS") {
                $good[strtoupper($post->schoolCode)] = $post;
                unset($bad[strtolower($post->schoolCode)]);
            }
        }

        return [
            'good' => $good,
            'bad' => $bad
        ];
    }

    public static function list() {
        $search_params = [];
        $search_params['count']   = true;
        $search_params['filter']  = "post_type eq 'drillschedule'";
        $search_params['orderby'] = 'post_title';
        $search_params['search']  = '*';
        $search_params['select']  = '*';
        $search_params['top']     = '200';

        return new DrillScheduleSearch($search_params);
    }

    public function __construct($params) {
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
       
        $this->totalResults = 0;
        $this->results = array();
    }

    public function run() {
        $headers = array(
            "Accept" => "application/json",
            "api-key" => $this->api_key,
        );

        $body = array(
            "filter"  => $this->filter,
            "facets"  => $this->facets,
            "search"  => $this->search,
            "select"  => $this->select,
            "orderby" => $this->orderby,
            "top"     => $this->top,
            "count"   => $this->count,
            "skip"    => $this->skip,
        );
    
        $request = new WPRemotePost(array(
            'url' => $this->target_url,
            'headers' => $headers,
            'body' => json_encode($body),
        ));
        $response = $request->run();

        $response_object = json_decode($response['body'], $assoc = false);

        $this->rawResponse  = $response_object;
        $this->totalResults = $response_object->{'@odata.count'};
        $this->results      = $response_object->value;
    }
}
