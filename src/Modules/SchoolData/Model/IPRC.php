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

    private $blogID;
    private $schoolCode;
    private $email;

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
        $customFields = get_post_custom($postFromDB->ID);

        $postFromDB->principalFirstname = $customFields['principalFirstname'][0];
        $postFromDB->principalLastname = $customFields['principalLastname'][0];
        $postFromDB->teacher1Firstname = $customFields['teacher1Firstname'][0];
        $postFromDB->teacher1Lastname = $customFields['teacher1Lastname'][0];
        $postFromDB->teacher2Firstname = $customFields['teacher2Firstname'][0];
        $postFromDB->teacher2Lastname = $customFields['teacher2Lastname'][0];
        $postFromDB->teacher3Firstname = $customFields['teacher3Firstname'][0];
        $postFromDB->teacher3Lastname = $customFields['teacher3Lastname'][0];
        $postFromDB->teacher4Firstname = $customFields['teacher4Firstname'][0];
        $postFromDB->teacher4Lastname = $customFields['teacher4Lastname'][0];
        $postFromDB->teacher5Firstname = $customFields['teacher5Firstname'][0];
        $postFromDB->teacher5Lastname = $customFields['teacher5Lastname'][0];
    
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

        $instance = self::getInstance();

        $instance->title   = "{$postArray['schoolCode']} IPRC";
        $instance->content = $instance->content . "<br/>Updated by {$postArray['email']} at " . date('Y-m-d H:i:s');
        $instance->excerpt = "Last updated by {$postArray['email']} at " . date('Y-m-d H:i:s');

        $instance->blogID     = $postArray['blogID']     ?? $instance->blogID;
        $instance->schoolCode = $postArray['schoolCode'] ?? $instance->schoolCode;
        $instance->email      = $postArray['email']      ?? $instance->email;

        $instance->principalFirstname = $postArray['principalFirstname'] ?? $instance->principalFirstname;
        $instance->principalLastname = $postArray['principalLastname'] ?? $instance->principalLastname;
        $instance->teacher1Firstname = $postArray['teacher1Firstname'] ?? $instance->teacher1Firstname;
        $instance->teacher1Lastname = $postArray['teacher1Lastname'] ?? $instance->teacher1Lastname;
        $instance->teacher2Firstname = $postArray['teacher2Firstname'] ?? $instance->teacher2Firstname;
        $instance->teacher2Lastname = $postArray['teacher2Lastname'] ?? $instance->teacher2Lastname;
        $instance->teacher3Firstname = $postArray['teacher3Firstname'] ?? $instance->teacher3Firstname;
        $instance->teacher3Lastname = $postArray['teacher3Lastname'] ?? $instance->teacher3Lastname;
        $instance->teacher4Firstname = $postArray['teacher4Firstname'] ?? $instance->teacher4Firstname;
        $instance->teacher4Lastname = $postArray['teacher4Lastname'] ?? $instance->teacher4Lastname;
        $instance->teacher5Firstname = $postArray['teacher5Firstname'] ?? $instance->teacher5Firstname;
        $instance->teacher5Lastname = $postArray['teacher5Lastname'] ?? $instance->teacher5Lastname;

        $saved = $instance->save();

        if ($saved) {
            WPCore::wpRedirect($wpRedirect);
        } else {

        }
    }

    private static function instantiate($post) {
        $instance = new IPRC;

        $instance->ID      = $post->ID           ?? 0;
        $instance->content = $post->post_content ?? '';
        $instance->title   = $post->post_title   ?? '';
        $instance->excerpt = $post->post_excerpt ?? '';

        $instance->blogID     = $post->blogID ?? '';
        $instance->schoolCode = $post->schoolCode ?? '';
        $instance->email      = $post->email ?? '';

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

    public function __construct($params = []) {
        $this->ID = $params['ID'];
        $this->content = $params['content'];
        $this->title = $params['title'];
        $this->excerpt = $params['excerpt'];
        $this->blogID = $params['blogID'];
        $this->schoolCode = $params['schoolCode'];
        $this->email = $params['email'];
        $this->principalFirstname = $params['principalFirstname'];
        $this->principalLastname = $params['principalLastname'];
        $this->teacher1Firstname = $params['teacher1Firstname'];
        $this->teacher1Lastname = $params['teacher1Lastname'];
        $this->teacher2Firstname = $params['teacher2Firstname'];
        $this->teacher2Lastname = $params['teacher2Lastname'];
        $this->teacher3Firstname = $params['teacher3Firstname'];
        $this->teacher3Lastname = $params['teacher3Lastname'];
        $this->teacher4Firstname = $params['teacher4Firstname'];
        $this->teacher4Lastname = $params['teacher4Lastname'];
        $this->teacher5Firstname = $params['teacher5Firstname'];
        $this->teacher5Lastname = $params['teacher5Lastname'];
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

    public function toWPPostArray() {
        $postArray = array(
            'ID'      => $this->ID,

            'post_type'    => 'iprc',
            'post_status'  => 'publish',

            'post_content' => $this->content,
            'post_title'   => $this->title,
            'post_excerpt' => $this->excerpt,

            'blogID'     => $this->blogID,
            'schoolCode' => $this->schoolCode,
            'email'      => $this->email,

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

        $post = $this->toWPPostArray();
        $postID = (int) $post['ID'];

        if (0 == $postID) {
            $saveResult = WPCore::wpInsertPost($post, true);
        } else {
            $saveResult = WPCore::wpUpdatePost($post, true);
        }

        if (is_wp_error($saveResult)) {
            $error_string = $saveResult->get_error_message();
            echo '<div id="message" class="error"><p>' . $error_string . '</p></div>';
            return false;
        } else {
            WPCore::updatePostMeta($postID, 'principalFirstname', $post['principalFirstname']);
            WPCore::updatePostMeta($postID, 'principalLastname', $post['principalLastname']);

            WPCore::updatePostMeta($postID, 'teacher1Firstname', $post['teacher1Firstname']);
            WPCore::updatePostMeta($postID, 'teacher1Lastname', $post['teacher1Lastname']);

            WPCore::updatePostMeta($postID, 'teacher2Firstname', $post['teacher2Firstname']);
            WPCore::updatePostMeta($postID, 'teacher2Lastname', $post['teacher2Lastname']);

            WPCore::updatePostMeta($postID, 'teacher3Firstname', $post['teacher3Firstname']);
            WPCore::updatePostMeta($postID, 'teacher3Lastname', $post['teacher3Lastname']);

            WPCore::updatePostMeta($postID, 'teacher4Firstname', $post['teacher4Firstname']);
            WPCore::updatePostMeta($postID, 'teacher4Lastname', $post['teacher4Lastname']);

            WPCore::updatePostMeta($postID, 'teacher5Firstname', $post['teacher5Firstname']);
            WPCore::updatePostMeta($postID, 'teacher5Lastname', $post['teacher5Lastname']);
        }

        return true;
    }
}