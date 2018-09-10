<?php
namespace WRDSB\Staff\Modules\Codex\Model;

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
class Search
{
    /**
     * Someting
     *
     * Something else
     *
     * @since    1.0.0
     */
    public function __construct($data)
    {
    }
}

global $wp_version;

$this->url = 'https://wrdsb-codex.search.windows.net/indexes/groups-groups/docs/search?api-version=2016-09-01';

$this->args = array();

$this->args['timeout'] = $data['timeout'] ? $data['timeout'] : 5;

'redirection' => 5,
    'httpversion' => '1.0',
    'user-agent'  => 'WordPress/' . $wp_version . '; ' . home_url(),
    'blocking'    => true,
    'headers'     => array(
		'Accept' => 'application/json',
		'Content-Type' => 'application/json',
		'api-key' => WRDSB_HOUSTON_API_KEY
    ),
    'cookies'     => array(),
    'body'        => json_encode(array(
		"search"  => "*",
		"select"  => "*",
		"orderby" => "email",
		"top"     => 1000,
		"count"   => true
	)),
    'compress'    => false,
    'decompress'  => true,
    'sslverify'   => false,
    'stream'      => false,
    'filename'    => null
);

$list_type = $wp_query->query_vars['list-type'];
global $post;
switch ($list_type) {
	case "all":
		$post->post_title = "List Groups - All";
		$table_title = "All Groups";
		break;
	case "automated":
		$post->post_title = "List Groups - Automated";
		$table_title = "Automated Groups";
		$body = json_decode($args['body'], $assoc = TRUE);
		$body["filter"] = "membership_automation_active eq true";
		$args['body'] = json_encode($body);
		break;
	case "admin-created":
		$post->post_title = "List Groups - Admin Created";
		$table_title = "Admin Created Groups";
		$body = json_decode($args['body'], $assoc = TRUE);
		$body["filter"] = "adminCreated eq true";
		$args['body'] = json_encode($body);
		break;
	default:
		$post->post_title = "List Groups";
		break;
}

public function run() {
    $response = wp_remote_post( $this->url, $this->args );
    $response_object = json_decode($response['body'], $assoc = FALSE);

}

$groups = $response_object->value;
$groups_count = $response_object->{'@odata.count'};
$page_min = 1;
$page_max = count($groups);
$pages = 1;

while ( $groups_count > $page_max ) {
	$body = json_decode($args['body'], $assoc = TRUE);
	$body["skip"] = $pages * 1000;
	$args['body'] = json_encode($body);
	$response = wp_remote_post( $url, $args );
	$response_object = json_decode($response['body'], $assoc = FALSE);
	$groups = array_merge($groups, $response_object->value);
	$page_max = count($groups);
	$pages++;
}
