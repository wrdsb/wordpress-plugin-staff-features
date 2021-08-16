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
    private $slug;
    private $guid;

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

        $post = self::instantiate($postFromDB);

        return $post;
    }

    public static function fromForm($postRequest) {
        $postArray = array(
            'action' => $postRequest['action'],

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
            'bombDrillDate'  => $postRequest['bombDrillDate'],
            'bombDrillTime'  => $postRequest['bombDrillTime'],
        );

        echo "<pre>";
        echo "from CPT";
        print_r($_POST);
        print_r($_REQUEST);
        print_r(self::getInstance());
        echo "</pre>";
    }

    private static function instantiate($post) {
        $instance = new DrillSchedule;

        $instance->ID      = $post->ID           ?? 0;
        $instance->content = $post->post_content ?? '';
        $instance->title   = $post->post_title   ?? '';
        $instance->excerpt = $post->post_excerpt ?? '';
        $instance->slug    = $post->post_name    ?? '';
        $instance->guid    = $post->guid         ?? '';

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

    public function toArray() {
        $postArray = array(
            'ID'      => $this->ID,
            'content' => $this->content,
            'title'   => $this->title,
            'excerpt' => $this->excerpt,
            'slug'    => $this->slug,
            'guid'    => $this->guid,

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

        $post = $this->toArray;
        $postID = $post['ID'];

        if (0 !== $postID) {
            WPCore::wpUpdatePost($post, true);

        } else {
            $postID = WPCore::wpInsertPost($post, true);
        }

        if (isset($this->fireDrill1Date)) {
            WPCore::updatePostMeta($postID, 'fireDrill1Date', WPCore::sanitizeTextField($post['fireDrill1Date']));
        }
        if (isset($this->fireDrill1Time)) {
            WPCore::updatePostMeta($postID, 'fireDrill1Time', WPCore::sanitizeTextField($post['fireDrill1Time']));
        }
        if (isset($this->fireDrill2Date)) {
            WPCore::updatePostMeta($postID, 'fireDrill2Date', WPCore::sanitizeTextField($post['fireDrill2Date']));
        }
        if (isset($this->fireDrill2Time)) {
            WPCore::updatePostMeta($postID, 'fireDrill2Time', WPCore::sanitizeTextField($post['fireDrill2Time']));
        }
        if (isset($this->fireDrill3Date)) {
            WPCore::updatePostMeta($postID, 'fireDrill3Date', WPCore::sanitizeTextField($post['fireDrill3Date']));
        }
        if (isset($this->fireDrill3Time)) {
            WPCore::updatePostMeta($postID, 'fireDrill3Time', WPCore::sanitizeTextField($post['fireDrill3Time']));
        }
        if (isset($this->fireDrill4Date)) {
            WPCore::updatePostMeta($postID, 'fireDrill4Date', WPCore::sanitizeTextField($post['fireDrill4Date']));
        }
        if (isset($this->fireDrill4Time)) {
            WPCore::updatePostMeta($postID, 'fireDrill4Time', WPCore::sanitizeTextField($post['fireDrill4Time']));
        }
        if (isset($this->fireDrill5Date)) {
            WPCore::updatePostMeta($postID, 'fireDrill5Date', WPCore::sanitizeTextField($post['fireDrill5Date']));
        }
        if (isset($this->fireDrill5Time)) {
            WPCore::updatePostMeta($postID, 'fireDrill5Time', WPCore::sanitizeTextField($post['fireDrill5Time']));
        }
        if (isset($this->bombDrill1Date)) {
            WPCore::updatePostMeta($postID, 'bombDrill1Date', WPCore::sanitizeTextField($post['bombDrill1Date']));
        }
        if (isset($this->bombDrill1Time)) {
            WPCore::updatePostMeta($postID, 'bombDrill1Time', WPCore::sanitizeTextField($post['bombDrill1Time']));
        }
    }
}