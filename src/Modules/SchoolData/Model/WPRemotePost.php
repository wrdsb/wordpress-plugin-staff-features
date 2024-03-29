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
class WPRemotePost
{
    public static $defaultHeaders = array(
        'Accept'       => 'application/json',
        'Content-Type' => 'application/json'
    );

    public function __construct($params)
    {
        $this->timeout     = $params['timeout']     ?? 5;
        $this->redirection = $params['redirection'] ?? 5;
        $this->httpversion = $params['httpversion'] ?? '1.0';
        $this->useragent   = $params['useragent']   ?? "WordPress";
        $this->blocking    = $params['blocking']    ?? true;
        $this->cookies     = $params['cookies']     ?? array();
        $this->compress    = $params['compress']    ?? false;
        $this->decompress  = $params['decompress']  ?? true;
        $this->sslverify   = $params['sslverify']   ?? false;
        $this->stream      = $params['stream']      ?? false;
        $this->filename    = $params['filename']    ?? null;
    
        $this->url     = $params['url'];
        $this->headers = array_merge(self::$defaultHeaders, $params['headers']);
        $this->body    = $params['body'] ?? null;
    }

    public function run()
    {
        $args = array(
            'timeout'     => $this->timeout,
            'redirection' => $this->redirection,
            'httpversion' => $this->httpversion,
            'user-agent'  => $this->useragent,
            'blocking'    => $this->blocking,
            'cookies'     => $this->cookies,
            'compress'    => $this->compress,
            'decompress'  => $this->decompress,
            'sslverify'   => $this->sslverify,
            'stream'      => $this->stream,
            'filename'    => $this->filename,
            'headers'     => $this->headers,
            'body'        => $this->body
        );
        
        $response  = wp_remote_post($this->url, $args);

        return $response;
    }
}
