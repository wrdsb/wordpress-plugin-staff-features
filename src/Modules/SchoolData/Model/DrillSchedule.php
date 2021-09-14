<?php
namespace WRDSB\Staff\Modules\SchoolData\Model;
use WRDSB\Staff\Modules\WP\WPCore as WPCore;

/**
 * Define and register class for posts of type "drillSchedule"
 * *
 * @link       https://www.wrdsb.ca
 * @since      1.0.0
 *
 * @package    Staff Features
 * @subpackage School Data
 */

class DrillSchedule {
    private $ID;
    private $content;
    private $title;
    private $excerpt;

    private $blogID;
    private $schoolCode;
    private $email;

    private $fireDrill1Date;
    private $fireDrill1Time;
    private $fireDrill2Date;
    private $fireDrill2Time;
    private $fireDrill3Date;
    private $fireDrill3Time;
    private $fireDrill4Date;
    private $fireDrill4Time;
    private $fireDrill5Date;
    private $fireDrill5Time;
    private $bombDrill1Date;
    private $bombDrill1Time;

    public static function getInstance() {
        $args = array(
            'post_type' => 'drillSchedule',
            'post_status' => 'publish',
            'posts_per_page' => 1,
            'orderby' => 'title',
            'order' => 'ASC',
        );

        $query = new \WP_Query($args);
        
        $postFromDB = $query->posts[0];
        $customFields = get_post_custom($postFromDB->ID);

        $postFromDB->fireDrill1Date = $customFields['fireDrill1Date'][0];
        $postFromDB->fireDrill1Time = $customFields['fireDrill1Time'][0];
        $postFromDB->fireDrill2Date = $customFields['fireDrill2Date'][0];
        $postFromDB->fireDrill2Time = $customFields['fireDrill2Time'][0];
        $postFromDB->fireDrill3Date = $customFields['fireDrill3Date'][0];
        $postFromDB->fireDrill3Time = $customFields['fireDrill3Time'][0];
        $postFromDB->fireDrill4Date = $customFields['fireDrill4Date'][0];
        $postFromDB->fireDrill4Time = $customFields['fireDrill4Time'][0];
        $postFromDB->fireDrill5Date = $customFields['fireDrill5Date'][0];
        $postFromDB->fireDrill5Time = $customFields['fireDrill5Time'][0];
        $postFromDB->bombDrill1Date = $customFields['bombDrill1Date'][0];
        $postFromDB->bombDrill1Time = $customFields['bombDrill1Time'][0];
    
        $post = self::instantiate($postFromDB);

        return $post;
    }

    public static function fromForm($postRequest) {
        $action = $postRequest['action'];
        $wpRedirect = $postRequest['wpRedirect'];

        $postArray = array(
            'postID' => $postRequest['postID'],
            'blogID' => $postRequest['blogID'],
            'schoolCode' => $postRequest['schoolCode'],
            'email' => $postRequest['email'],

            'fireDrill1Date' => $postRequest['fireDrill1Date'],
            'fireDrill1Time' => $postRequest['fireDrill1Time'],
            'fireDrill2Date' => $postRequest['fireDrill2Date'],
            'fireDrill2Time' => $postRequest['fireDrill2Time'],
            'fireDrill3Date' => $postRequest['fireDrill3Date'],
            'fireDrill3Time' => $postRequest['fireDrill3Time'],
            'fireDrill4Date' => $postRequest['fireDrill4Date'],
            'fireDrill4Time' => $postRequest['fireDrill4Time'],
            'fireDrill5Date' => $postRequest['fireDrill5Date'],
            'fireDrill5Time' => $postRequest['fireDrill5Time'],
            'bombDrill1Date'  => $postRequest['bombDrill1Date'],
            'bombDrill1Time'  => $postRequest['bombDrill1Time'],
        );

        $instance = self::getInstance();

        $instance->title   = "{$postArray['schoolCode']} Drill Schedule";
        $instance->content = $instance->content . "<br/>Updated by {$postArray['email']} at " . date('Y-m-d H:i:s');
        $instance->excerpt = "Last updated by {$postArray['email']} at " . date('Y-m-d H:i:s');

        $instance->blogID     = $postArray['blogID']     ?? $instance->blogID;
        $instance->schoolCode = $postArray['schoolCode'] ?? $instance->schoolCode;
        $instance->email      = $postArray['email']      ?? $instance->email;

        $instance->fireDrill1Date = $postArray['fireDrill1Date'] ?? $instance->fireDrill1Date;
        $instance->fireDrill1Time = $postArray['fireDrill1Time'] ?? $instance->fireDrill1Time;
        $instance->fireDrill2Date = $postArray['fireDrill2Date'] ?? $instance->fireDrill2Date;
        $instance->fireDrill2Time = $postArray['fireDrill2Time'] ?? $instance->fireDrill2Time;
        $instance->fireDrill3Date = $postArray['fireDrill3Date'] ?? $instance->fireDrill3Date;
        $instance->fireDrill3Time = $postArray['fireDrill3Time'] ?? $instance->fireDrill3Time;
        $instance->fireDrill4Date = $postArray['fireDrill4Date'] ?? $instance->fireDrill4Date;
        $instance->fireDrill4Time = $postArray['fireDrill4Time'] ?? $instance->fireDrill4Time;
        $instance->fireDrill5Date = $postArray['fireDrill5Date'] ?? $instance->fireDrill5Date;
        $instance->fireDrill5Time = $postArray['fireDrill5Time'] ?? $instance->fireDrill5Time;
        $instance->bombDrill1Date = $postArray['bombDrill1Date'] ?? $instance->bombDrill1Date;
        $instance->bombDrill1Time = $postArray['bombDrill1Time'] ?? $instance->bombDrill1Time;

        $saved = $instance->save();

        if ($saved) {
            WPCore::wpRedirect($wpRedirect);
        } else {

        }
    }

    private static function instantiate($post) {
        $instance = new DrillSchedule;

        $instance->ID      = $post->ID           ?? 0;
        $instance->content = $post->post_content ?? '';
        $instance->title   = $post->post_title   ?? '';
        $instance->excerpt = $post->post_excerpt ?? '';

        $instance->blogID     = $post->blogID ?? '';
        $instance->schoolCode = $post->schoolCode ?? '';
        $instance->email      = $post->email ?? '';
    
        $instance->fireDrill1Date = $post->fireDrill1Date ?? '';
        $instance->fireDrill1Time = $post->fireDrill1Time ?? '';
        $instance->fireDrill2Date = $post->fireDrill2Date ?? '';
        $instance->fireDrill2Time = $post->fireDrill2Time ?? '';
        $instance->fireDrill3Date = $post->fireDrill3Date ?? '';
        $instance->fireDrill3Time = $post->fireDrill3Time ?? '';
        $instance->fireDrill4Date = $post->fireDrill4Date ?? '';
        $instance->fireDrill4Time = $post->fireDrill4Time ?? '';
        $instance->fireDrill5Date = $post->fireDrill5Date ?? '';
        $instance->fireDrill5Time = $post->fireDrill5Time ?? '';
        $instance->bombDrill1Date = $post->bombDrill1Date ?? '';
        $instance->bombDrill1Time = $post->bombDrill1Time ?? '';

        return $instance;
    }

    public function __construct($params = []) {
        $this->ID = $params['ID'];
        $this->content = $params['content'];
        $this->title = $params['title'];
        $this->excerpt = $params['excerpt'];
        $this->blogID = $params['blogID'];
        $this->schoolCode = $params['schoolCode'];
        $this->email = $params['email'];
        $this->fireDrill1Date = $params['fireDrill1Date'];
        $this->fireDrill1Time = $params['fireDrill1Time'];
        $this->fireDrill2Date = $params['fireDrill2Date'];
        $this->fireDrill2Time = $params['fireDrill2Time'];
        $this->fireDrill3Date = $params['fireDrill3Date'];
        $this->fireDrill3Time = $params['fireDrill3Time'];
        $this->fireDrill4Date = $params['fireDrill4Date'];
        $this->fireDrill4Time = $params['fireDrill4Time'];
        $this->fireDrill5Date = $params['fireDrill5Date'];
        $this->fireDrill5Time = $params['fireDrill5Time'];
        $this->bombDrill1Date = $params['bombDrill1Date'];
        $this->bombDrill1Time = $params['bombDrill1Time'];
    }

    public function getID() {
        return $this->ID;
    }
    public function getFireDrill1Date() {
        return $this->fireDrill1Date;
    }
    public function getFireDrill1Time() {
        return $this->fireDrill1Time;
    }
    public function getFireDrill2Date() {
        return $this->fireDrill2Date;
    }
    public function getFireDrill2Time() {
        return $this->fireDrill2Time;
    }
    public function getFireDrill3Date() {
        return $this->fireDrill3Date;
    }
    public function getFireDrill3Time() {
        return $this->fireDrill3Time;
    }
    public function getFireDrill4Date() {
        return $this->fireDrill4Date;
    }
    public function getFireDrill4Time() {
        return $this->fireDrill4Time;
    }
    public function getFireDrill5Date() {
        return $this->fireDrill5Date;
    }
    public function getFireDrill5Time() {
        return $this->fireDrill5Time;
    }
    public function getBombDrill1Date() {
        return $this->bombDrill1Date;
    }
    public function getBombDrill1Time() {
        return $this->bombDrill1Time;
    }

    public function toWPPostArray() {
        $postArray = array(
            'ID'      => $this->ID,

            'post_type'    => 'drillSchedule',
            'post_status'  => 'publish',

            'post_content' => $this->content,
            'post_title'   => $this->title,
            'post_excerpt' => $this->excerpt,

            'blogID'     => $this->blogID,
            'schoolCode' => $this->schoolCode,
            'email'      => $this->email,

            'fireDrill1Date' => $this->fireDrill1Date,
            'fireDrill1Time' => $this->fireDrill1Time,
            'fireDrill2Date' => $this->fireDrill2Date,
            'fireDrill2Time' => $this->fireDrill2Time,
            'fireDrill3Date' => $this->fireDrill3Date,
            'fireDrill3Time' => $this->fireDrill3Time,
            'fireDrill4Date' => $this->fireDrill4Date,
            'fireDrill4Time' => $this->fireDrill4Time,
            'fireDrill5Date' => $this->fireDrill5Date,
            'fireDrill5Time' => $this->fireDrill5Time,
            'bombDrill1Date' => $this->bombDrill1Date,
            'bombDrill1Time' => $this->bombDrill1Time,
        );

        return $postArray;
    }

    public function save() {
        // Checks save status
        //$is_autosave    = wp_is_post_autosave($post_id);
        //$is_revision    = wp_is_post_revision($post_id);
        //$is_valid_nonce = (isset($_POST['wrdsb_nonce']) && wp_verify_nonce($_POST['wrdsb_nonce'], basename(__FILE__))) ? 'true' : 'false';

        // Exits script depending on save status
        //if ($is_autosave || $is_revision || ! $is_valid_nonce) {
            //return;
        //}

        $post = $this->toWPPostArray();
        $postID = (int) $post['ID'];

        if (0 == $postID) {
            unset($post['ID']);
            $saveResult = WPCore::wpInsertPost($post, true);
        } else {
            $saveResult = WPCore::wpUpdatePost($post, true);
        }

        if (is_wp_error($saveResult)) {
            $error_string = $saveResult->get_error_message();
            echo '<div id="message" class="error"><p>' . $error_string . '</p></div>';
            return false;
        } else {
            $postID = $saveResult;
            
            WPCore::updatePostMeta($postID, 'blogID',         $post['blogID']);
            WPCore::updatePostMeta($postID, 'schoolCode',     $post['schoolCode']);
            WPCore::updatePostMeta($postID, 'email',          $post['email']);

            WPCore::updatePostMeta($postID, 'fireDrill1Date', $post['fireDrill1Date']);
            WPCore::updatePostMeta($postID, 'fireDrill1Time', $post['fireDrill1Time']);
            WPCore::updatePostMeta($postID, 'fireDrill2Date', $post['fireDrill2Date']);
            WPCore::updatePostMeta($postID, 'fireDrill2Time', $post['fireDrill2Time']);
            WPCore::updatePostMeta($postID, 'fireDrill3Date', $post['fireDrill3Date']);
            WPCore::updatePostMeta($postID, 'fireDrill3Time', $post['fireDrill3Time']);
            WPCore::updatePostMeta($postID, 'fireDrill4Date', $post['fireDrill4Date']);
            WPCore::updatePostMeta($postID, 'fireDrill4Time', $post['fireDrill4Time']);
            WPCore::updatePostMeta($postID, 'fireDrill5Date', $post['fireDrill5Date']);
            WPCore::updatePostMeta($postID, 'fireDrill5Time', $post['fireDrill5Time']);
            WPCore::updatePostMeta($postID, 'bombDrill1Date', $post['bombDrill1Date']);
            WPCore::updatePostMeta($postID, 'bombDrill1Time', $post['bombDrill1Time']);
        }

        return true;
    }
}