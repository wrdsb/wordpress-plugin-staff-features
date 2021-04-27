<?php
namespace WRDSB\Staff\Modules\ContentSearch\Model;

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/wrdsb
 * @since      1.0.0
 *
 * @package    WRDSB_Staff
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    WRDSB_Staff
 * @author     WRDSB <website@wrdsb.ca>
 */
class ContentSearch
{
    public function __construct($params)
    {
        $this->target_url = $params['target_url'];
        $this->api_key = $params['api_key'];

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

    public function run()
    {
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
