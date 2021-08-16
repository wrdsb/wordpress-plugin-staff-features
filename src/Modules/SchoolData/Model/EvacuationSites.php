<?php
namespace WRDSB\Staff\Modules\SchoolData\Model;
use WRDSB\Staff\Modules\WP\WPCore as WPCore;

/**
 * Define and register class for posts of type "evacuationSites"
 * *
 * @link       https://www.wrdsb.ca
 * @since      1.0.0
 *
 * @package    Staff Features
 * @subpackage School Data
 */

class EvacuationSites {
    private $ID;
    private $content;
    private $title;
    private $excerpt;
    private $slug;
    private $guid;

    private $site1Name;
    private $site1Address;
    private $site1City;
    private $site1PostalCode;
    private $site1Firstname;
    private $site1Lastname;
    private $site1Phone;
    private $site1HoursStart;
    private $site1HoursEnd;
    private $site2Name;
    private $site2Address;
    private $site2City;
    private $site2PostalCode;
    private $site2Firstname;
    private $site2Lastname;
    private $site2Phone;
    private $site2HoursStart;
    private $site2HoursEnd;
    private $site3Name;
    private $site3Address;
    private $site3City;
    private $site3PostalCode;
    private $site3Firstname;
    private $site3Lastname;
    private $site3Phone;
    private $site3HoursStart;
    private $site3HoursEnd;
    private $site4Name;
    private $site4Address;
    private $site4City;
    private $site4PostalCode;
    private $site4Firstname;
    private $site4Lastname;
    private $site4Phone;
    private $site4HoursStart;
    private $site4HoursEnd;
    
    public static function getInstance() {
        $args = array(
            'post_type' => 'evacuationSites',
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

            'site1Name' => $postRequest['site1Name'],
            'site1Address' => $postRequest['site1Address'],
            'site1City' => $postRequest['site1City'],
            'site1PostalCode' => $postRequest['site1PostalCode'],
            'site1Firstname' => $postRequest['site1Firstname'],
            'site1Lastname' => $postRequest['site1Lastname'],
            'site1Phone' => $postRequest['site1Phone'],
            'site1HoursStart' => $postRequest['site1HoursStart'],
            'site1HoursEnd' => $postRequest['site1HoursEnd'],
            'site2Name' => $postRequest['site2Name'],
            'site2Address' => $postRequest['site2Address'],
            'site2City' => $postRequest['site2City'],
            'site2PostalCode' => $postRequest['site2PostalCode'],
            'site2Firstname' => $postRequest['site2Firstname'],
            'site2Lastname' => $postRequest['site2Lastname'],
            'site2Phone' => $postRequest['site2Phone'],
            'site2HoursStart' => $postRequest['site2HoursStart'],
            'site2HoursEnd' => $postRequest['site2HoursEnd'],
            'site3Name' => $postRequest['site3Name'],
            'site3Address' => $postRequest['site3Address'],
            'site3City' => $postRequest['site3City'],
            'site3PostalCode' => $postRequest['site3PostalCode'],
            'site3Firstname' => $postRequest['site3Firstname'],
            'site3Lastname' => $postRequest['site3Lastname'],
            'site3Phone' => $postRequest['site3Phone'],
            'site3HoursStart' => $postRequest['site3HoursStart'],
            'site3HoursEnd' => $postRequest['site3HoursEnd'],
            'site4Name' => $postRequest['site4Name'],
            'site4Address' => $postRequest['site4Address'],
            'site4City' => $postRequest['site4City'],
            'site4PostalCode' => $postRequest['site4PostalCode'],
            'site4Firstname' => $postRequest['site4Firstname'],
            'site4Lastname' => $postRequest['site4Lastname'],
            'site4Phone' => $postRequest['site4Phone'],
            'site4HoursStart' => $postRequest['site4HoursStart'],
            'site4HoursEnd' => $postRequest['site4HoursEnd'],
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

        $instance->site1Name = $post->site1Name ?? '';
        $instance->site1Address = $post->site1Address ?? '';
        $instance->site1City = $post->site1City ?? '';
        $instance->site1PostalCode = $post->site1PostalCode ?? '';
        $instance->site1Firstname = $post->site1Firstname ?? '';
        $instance->site1Lastname = $post->site1Lastname ?? '';
        $instance->site1Phone = $post->site1Phone ?? '';
        $instance->site1HoursStart = $post->site1HoursStart ?? '';
        $instance->site1HoursEnd = $post->site1HoursEnd ?? '';
        $instance->site2Name = $post->site2Name ?? '';
        $instance->site2Address = $post->site2Address ?? '';
        $instance->site2City = $post->site2City ?? '';
        $instance->site2PostalCode = $post->site2PostalCode ?? '';
        $instance->site2Firstname = $post->site2Firstname ?? '';
        $instance->site2Lastname = $post->site2Lastname ?? '';
        $instance->site2Phone = $post->site2Phone ?? '';
        $instance->site2HoursStart = $post->site2HoursStart ?? '';
        $instance->site2HoursEnd = $post->site2HoursEnd ?? '';
        $instance->site3Name = $post->site3Name ?? '';
        $instance->site3Address = $post->site3Address ?? '';
        $instance->site3City = $post->site3City ?? '';
        $instance->site3PostalCode = $post->site3PostalCode ?? '';
        $instance->site3Firstname = $post->site3Firstname ?? '';
        $instance->site3Lastname = $post->site3Lastname ?? '';
        $instance->site3Phone = $post->site3Phone ?? '';
        $instance->site3HoursStart = $post->site3HoursStart ?? '';
        $instance->site3HoursEnd = $post->site3HoursEnd ?? '';
        $instance->site4Name = $post->site4Name ?? '';
        $instance->site4Address = $post->site4Address ?? '';
        $instance->site4City = $post->site4City ?? '';
        $instance->site4PostalCode = $post->site4PostalCode ?? '';
        $instance->site4Firstname = $post->site4Firstname ?? '';
        $instance->site4Lastname = $post->site4Lastname ?? '';
        $instance->site4Phone = $post->site4Phone ?? '';
        $instance->site4HoursStart = $post->site4HoursStart ?? '';
        $instance->site4HoursEnd = $post->site4HoursEnd ?? '';
    
        return $instance;
    }

    public function getSite1Name() {
        return $this->site1Name;
    }
    public function getSite1Address() {
        return $this->site1Address;
    }
    public function getSite1City() {
        return $this->site1City;
    }
    public function getSite1PostalCode() {
        return $this->site1PostalCode;
    }
    public function getSite1Firstname() {
        return $this->site1Firstname;
    }
    public function getSite1Lastname() {
        return $this->site1Lastname;
    }
    public function getSite1Phone() {
        return $this->site1Phone;
    }
    public function getSite1HoursStart() {
        return $this->site1HoursStart;
    }
    public function getSite1HoursEnd() {
        return $this->site1HoursEnd;
    }
    public function getSite2Name() {
        return $this->site2Name;
    }
    public function getSite2Address() {
        return $this->site2Address;
    }
    public function getSite2City() {
        return $this->site2City;
    }
    public function getSite2PostalCode() {
        return $this->site2PostalCode;
    }
    public function getSite2Firstname() {
        return $this->site2Firstname;
    }
    public function getSite2Lastname() {
        return $this->site2Lastname;
    }
    public function getSite2Phone() {
        return $this->site2Phone;
    }
    public function getSite2HoursStart() {
        return $this->site2HoursStart;
    }
    public function getSite2HoursEnd() {
        return $this->site2HoursEnd;
    }
    public function getSite3Name() {
        return $this->site3Name;
    }
    public function getSite3Address() {
        return $this->site3Address;
    }
    public function getSite3City() {
        return $this->site3City;
    }
    public function getSite3PostalCode() {
        return $this->site3PostalCode;
    }
    public function getSite3Firstname() {
        return $this->site3Firstname;
    }
    public function getSite3Lastname() {
        return $this->site3Lastname;
    }
    public function getSite3Phone() {
        return $this->site3Phone;
    }
    public function getSite3HoursStart() {
        return $this->site3HoursStart;
    }
    public function getSite3HoursEnd() {
        return $this->site3HoursEnd;
    }
    public function getSite4Name() {
        return $this->site4Name;
    }
    public function getSite4Address() {
        return $this->site4Address;
    }
    public function getSite4City() {
        return $this->site4City;
    }
    public function getSite4PostalCode() {
        return $this->site4PostalCode;
    }
    public function getSite4Firstname() {
        return $this->site4Firstname;
    }
    public function getSite4Lastname() {
        return $this->site4Lastname;
    }
    public function getSite4Phone() {
        return $this->site4Phone;
    }
    public function getSite4HoursStart() {
        return $this->site4HoursStart;
    }
    public function getSite4HoursEnd() {
        return $this->site4HoursEnd;
    }

    public function toArray() {
        $postArray = array(
            'ID'      => $this->ID,
            'content' => $this->content,
            'title'   => $this->title,
            'excerpt' => $this->excerpt,
            'slug'    => $this->slug,
            'guid'    => $this->guid,

            'site1Name' => $this->site1Name,
            'site1Address' => $this->site1Address,
            'site1City' => $this->site1City,
            'site1PostalCode' => $this->site1PostalCode,
            'site1Firstname' => $this->site1Firstname,
            'site1Lastname' => $this->site1Lastname,
            'site1Phone' => $this->site1Phone,
            'site1HoursStart' => $this->site1HoursStart,
            'site1HoursEnd' => $this->site1HoursEnd,
            'site2Name' => $this->site2Name,
            'site2Address' => $this->site2Address,
            'site2City' => $this->site2City,
            'site2PostalCode' => $this->site2PostalCode,
            'site2Firstname' => $this->site2Firstname,
            'site2Lastname' => $this->site2Lastname,
            'site2Phone' => $this->site2Phone,
            'site2HoursStart' => $this->site2HoursStart,
            'site2HoursEnd' => $this->site2HoursEnd,
            'site3Name' => $this->site3Name,
            'site3Address' => $this->site3Address,
            'site3City' => $this->site3City,
            'site3PostalCode' => $this->site3PostalCode,
            'site3Firstname' => $this->site3Firstname,
            'site3Lastname' => $this->site3Lastname,
            'site3Phone' => $this->site3Phone,
            'site3HoursStart' => $this->site3HoursStart,
            'site3HoursEnd' => $this->site3HoursEnd,
            'site4Name' => $this->site4Name,
            'site4Address' => $this->site4Address,
            'site4City' => $this->site4City,
            'site4PostalCode' => $this->site4PostalCode,
            'site4Firstname' => $this->site4Firstname,
            'site4Lastname' => $this->site4Lastname,
            'site4Phone' => $this->site4Phone,
            'site4HoursStart' => $this->site4HoursStart,
            'site4HoursEnd' => $this->site4HoursEnd,
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

        if (isset($this->site1Name)) {
            WPCore::updatePostMeta($postID, 'site1Name', WPCore::sanitizeTextField($post['site1Name']));
        }
        if (isset($this->site1Address)) {
            WPCore::updatePostMeta($postID, 'site1Address', WPCore::sanitizeTextField($post['site1Address']));
        }
        if (isset($this->site1City)) {
            WPCore::updatePostMeta($postID, 'site1City', WPCore::sanitizeTextField($post['site1City']));
        }
        if (isset($this->site1PostalCode)) {
            WPCore::updatePostMeta($postID, 'site1PostalCode', WPCore::sanitizeTextField($post['site1PostalCode']));
        }
        if (isset($this->site1Firstname)) {
            WPCore::updatePostMeta($postID, 'site1Firstname', WPCore::sanitizeTextField($post['site1Firstname']));
        }
        if (isset($this->site1Lastname)) {
            WPCore::updatePostMeta($postID, 'site1Lastname', WPCore::sanitizeTextField($post['site1Lastname']));
        }
        if (isset($this->site1Phone)) {
            WPCore::updatePostMeta($postID, 'site1Phone', WPCore::sanitizeTextField($post['site1Phone']));
        }
        if (isset($this->site1HoursStart)) {
            WPCore::updatePostMeta($postID, 'site1HoursStart', WPCore::sanitizeTextField($post['site1HoursStart']));
        }
        if (isset($this->site1HoursEnd)) {
            WPCore::updatePostMeta($postID, 'site1HoursEnd', WPCore::sanitizeTextField($post['site1HoursEnd']));
        }

        if (isset($this->site2Name)) {
            WPCore::updatePostMeta($postID, 'site2Name', WPCore::sanitizeTextField($post['site2Name']));
        }
        if (isset($this->site2Address)) {
            WPCore::updatePostMeta($postID, 'site2Address', WPCore::sanitizeTextField($post['site2Address']));
        }
        if (isset($this->site2City)) {
            WPCore::updatePostMeta($postID, 'site2City', WPCore::sanitizeTextField($post['site2City']));
        }
        if (isset($this->site2PostalCode)) {
            WPCore::updatePostMeta($postID, 'site2PostalCode', WPCore::sanitizeTextField($post['site2PostalCode']));
        }
        if (isset($this->site2Firstname)) {
            WPCore::updatePostMeta($postID, 'site2Firstname', WPCore::sanitizeTextField($post['site2Firstname']));
        }
        if (isset($this->site2Lastname)) {
            WPCore::updatePostMeta($postID, 'site2Lastname', WPCore::sanitizeTextField($post['site2Lastname']));
        }
        if (isset($this->site2Phone)) {
            WPCore::updatePostMeta($postID, 'site2Phone', WPCore::sanitizeTextField($post['site2Phone']));
        }
        if (isset($this->site2HoursStart)) {
            WPCore::updatePostMeta($postID, 'site2HoursStart', WPCore::sanitizeTextField($post['site2HoursStart']));
        }
        if (isset($this->site2HoursEnd)) {
            WPCore::updatePostMeta($postID, 'site2HoursEnd', WPCore::sanitizeTextField($post['site2HoursEnd']));
        }

        if (isset($this->site3Name)) {
            WPCore::updatePostMeta($postID, 'site3Name', WPCore::sanitizeTextField($post['site3Name']));
        }
        if (isset($this->site3Address)) {
            WPCore::updatePostMeta($postID, 'site3Address', WPCore::sanitizeTextField($post['site3Address']));
        }
        if (isset($this->site3City)) {
            WPCore::updatePostMeta($postID, 'site3City', WPCore::sanitizeTextField($post['site3City']));
        }
        if (isset($this->site3PostalCode)) {
            WPCore::updatePostMeta($postID, 'site3PostalCode', WPCore::sanitizeTextField($post['site3PostalCode']));
        }
        if (isset($this->site3Firstname)) {
            WPCore::updatePostMeta($postID, 'site3Firstname', WPCore::sanitizeTextField($post['site3Firstname']));
        }
        if (isset($this->site3Lastname)) {
            WPCore::updatePostMeta($postID, 'site3Lastname', WPCore::sanitizeTextField($post['site3Lastname']));
        }
        if (isset($this->site3Phone)) {
            WPCore::updatePostMeta($postID, 'site3Phone', WPCore::sanitizeTextField($post['site3Phone']));
        }
        if (isset($this->site3HoursStart)) {
            WPCore::updatePostMeta($postID, 'site3HoursStart', WPCore::sanitizeTextField($post['site3HoursStart']));
        }
        if (isset($this->site3HoursEnd)) {
            WPCore::updatePostMeta($postID, 'site3HoursEnd', WPCore::sanitizeTextField($post['site3HoursEnd']));
        }

        if (isset($this->site4Name)) {
            WPCore::updatePostMeta($postID, 'site4Name', WPCore::sanitizeTextField($post['site4Name']));
        }
        if (isset($this->site4Address)) {
            WPCore::updatePostMeta($postID, 'site4Address', WPCore::sanitizeTextField($post['site4Address']));
        }
        if (isset($this->site4City)) {
            WPCore::updatePostMeta($postID, 'site4City', WPCore::sanitizeTextField($post['site4City']));
        }
        if (isset($this->site4PostalCode)) {
            WPCore::updatePostMeta($postID, 'site4PostalCode', WPCore::sanitizeTextField($post['site4PostalCode']));
        }
        if (isset($this->site4Firstname)) {
            WPCore::updatePostMeta($postID, 'site4Firstname', WPCore::sanitizeTextField($post['site4Firstname']));
        }
        if (isset($this->site4Lastname)) {
            WPCore::updatePostMeta($postID, 'site4Lastname', WPCore::sanitizeTextField($post['site4Lastname']));
        }
        if (isset($this->site4Phone)) {
            WPCore::updatePostMeta($postID, 'site4Phone', WPCore::sanitizeTextField($post['site4Phone']));
        }
        if (isset($this->site4HoursStart)) {
            WPCore::updatePostMeta($postID, 'site4HoursStart', WPCore::sanitizeTextField($post['site4HoursStart']));
        }
        if (isset($this->site4HoursEnd)) {
            WPCore::updatePostMeta($postID, 'site4HoursEnd', WPCore::sanitizeTextField($post['site4HoursEnd']));
        }
    }
}