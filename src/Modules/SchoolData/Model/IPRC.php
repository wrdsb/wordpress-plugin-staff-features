<?php
namespace WRDSB\Staff\Modules\SchoolData\Model;
use WRDSB\Staff\Modules\WP\WPCore as WPCore;

/**
 * Define and register class for posts of type "iprc"
 * *
 * @link       https://www.wrdsb.ca
 * @since      1.0.0
 *
 * @package    Staff Features
 * @subpackage School Data
 */

class IPRC {
    private $ID;
    private $content;
    private $title;
    private $excerpt;

    private $principalFirstname;
    private $principalLastname;
    private $teacher1Firstname;
    private $teacher1Lastname;
    private $teacher2Firstname;
    private $teacher2Lastname;
    private $teacher3Firstname;
    private $teacher3Lastname;
    private $teacher4Firstname;
    private $teacher4Lastname;
    private $teacher5Firstname;
    private $teacher5Lastname;

    public static function getInstance() {
        $args = array(
            'post_type' => 'iprc',
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

            'principalFirstname' => $postRequest['principalFirstname'],
            'principalLastname' => $postRequest['principalLastname'],
            'teacher1Firstname' => $postRequest['teacher1Firstname'],
            'teacher1Lastname' => $postRequest['teacher1Lastname'],
            'teacher2Firstname' => $postRequest['teacher2Firstname'],
            'teacher2Lastname' => $postRequest['teacher2Lastname'],
            'teacher3Firstname' => $postRequest['teacher3Firstname'],
            'teacher3Lastname' => $postRequest['teacher3Lastname'],
            'teacher4Firstname' => $postRequest['teacher4Firstname'],
            'teacher4Lastname' => $postRequest['teacher4Lastname'],
            'teacher5Firstname' => $postRequest['teacher5Firstname'],
            'teacher5Lastname' => $postRequest['teacher5Lastname'],
        );

        echo "<pre>";
        echo "from CPT";
        print_r($_POST);
        print_r($_REQUEST);
        print_r(self::getInstance());
        echo "</pre>";
    }

    private static function instantiate($post) {
        $instance = new IPRC;

        $instance->ID      = $post->ID           ?? 0;
        $instance->content = $post->post_content ?? '';
        $instance->title   = $post->post_title   ?? '';
        $instance->excerpt = $post->post_excerpt ?? '';

        $instance->principalFirstname = $post->principalFirstname ?? '';
        $instance->principalLastname = $post->principalLastname ?? '';
        $instance->teacher1Firstname = $post->teacher1Firstname ?? '';
        $instance->teacher1Lastname = $post->teacher1Lastname ?? '';
        $instance->teacher2Firstname = $post->teacher2Firstname ?? '';
        $instance->teacher2Lastname = $post->teacher2Lastname ?? '';
        $instance->teacher3Firstname = $post->teacher3Firstname ?? '';
        $instance->teacher3Lastname = $post->teacher3Lastname ?? '';
        $instance->teacher4Firstname = $post->teacher4Firstname ?? '';
        $instance->teacher4Lastname = $post->teacher4Lastname ?? '';
        $instance->teacher5Firstname = $post->teacher5Firstname ?? '';
        $instance->teacher5Lastname = $post->teacher5Lastname ?? '';

        return $instance;
    }

    public function getID() {
        return $this->ID;
    }
    public function getPrincipalFirstname() {
        return $this->principalFirstname;
    }
    public function getPrincipalLastname() {
        return $this->principalLastname;
    }
    public function getTeacher1Firstname() {
        return $this->teacher1Firstname;
    }
    public function getTeacher1Lastname() {
        return $this->teacher1Lastname;
    }
    public function getTeacher2Firstname() {
        return $this->teacher2Firstname;
    }
    public function getTeacher2Lastname() {
        return $this->teacher2Lastname;
    }
    public function getTeacher3Firstname() {
        return $this->teacher3Firstname;
    }
    public function getTeacher3Lastname() {
        return $this->teacher3Lastname;
    }
    public function getTeacher4Firstname() {
        return $this->teacher4Firstname;
    }
    public function getTeacher4Lastname() {
        return $this->teacher4Lastname;
    }
    public function getTeacher5Firstname() {
        return $this->teacher5Firstname;
    }
    public function getteacher5Lastname() {
        return $this->teacher5Lastname;
    }

    public function toArray() {
        $postArray = array(
            'ID'      => $this->ID,
            'content' => $this->content,
            'title'   => $this->title,
            'excerpt' => $this->excerpt,

            'principalFirstname' => $this->principalFirstname,
            'principalLastname' => $this->principalLastname,
            'teacher1Firstname' => $this->teacher1Firstname,
            'teacher1Lastname' => $this->teacher1Lastname,
            'teacher2Firstname' => $this->teacher2Firstname,
            'teacher2Lastname' => $this->teacher2Lastname,
            'teacher3Firstname' => $this->teacher3Firstname,
            'teacher3Lastname' => $this->teacher3Lastname,
            'teacher4Firstname' => $this->teacher4Firstname,
            'teacher4Lastname' => $this->teacher4Lastname,
            'teacher5Firstname' => $this->teacher5Firstname,
            'teacher5Lastname' => $this->teacher5Lastname,
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

        if (isset($this->principalFirstname)) {
            WPCore::updatePostMeta($postID, 'principalFirstname', WPCore::sanitizeTextField($post['principalFirstname']));
        }
        if (isset($this->principalLastname)) {
            WPCore::updatePostMeta($postID, 'principalLastname', WPCore::sanitizeTextField($post['principalLastname']));
        }

        if (isset($this->teacher1Firstname)) {
            WPCore::updatePostMeta($postID, 'teacher1Firstname', WPCore::sanitizeTextField($post['teacher1Firstname']));
        }
        if (isset($this->teacher1Lastname)) {
            WPCore::updatePostMeta($postID, 'teacher1Lastname', WPCore::sanitizeTextField($post['teacher1Lastname']));
        }

        if (isset($this->teacher2Firstname)) {
            WPCore::updatePostMeta($postID, 'teacher2Firstname', WPCore::sanitizeTextField($post['teacher2Firstname']));
        }
        if (isset($this->teacher2Lastname)) {
            WPCore::updatePostMeta($postID, 'teacher2Lastname', WPCore::sanitizeTextField($post['teacher2Lastname']));
        }

        if (isset($this->teacher3Firstname)) {
            WPCore::updatePostMeta($postID, 'teacher3Firstname', WPCore::sanitizeTextField($post['teacher3Firstname']));
        }
        if (isset($this->teacher3Lastname)) {
            WPCore::updatePostMeta($postID, 'teacher3Lastname', WPCore::sanitizeTextField($post['teacher3Lastname']));
        }

        if (isset($this->teacher4Firstname)) {
            WPCore::updatePostMeta($postID, 'teacher4Firstname', WPCore::sanitizeTextField($post['teacher4Firstname']));
        }
        if (isset($this->teacher4Lastname)) {
            WPCore::updatePostMeta($postID, 'teacher4Lastname', WPCore::sanitizeTextField($post['teacher4Lastname']));
        }

        if (isset($this->teacher5Firstname)) {
            WPCore::updatePostMeta($postID, 'teacher5Firstname', WPCore::sanitizeTextField($post['teacher5Firstname']));
        }
        if (isset($this->teacher5Lastname)) {
            WPCore::updatePostMeta($postID, 'teacher5Lastname', WPCore::sanitizeTextField($post['teacher5Lastname']));
        }
    }
}