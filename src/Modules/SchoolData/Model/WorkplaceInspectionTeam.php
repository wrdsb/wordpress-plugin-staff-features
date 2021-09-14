<?php
namespace WRDSB\Staff\Modules\SchoolData\Model;
use WRDSB\Staff\Modules\WP\WPCore as WPCore;

/**
 * Define and register class for posts of type "workplaceInspectionTeam"
 * *
 * @link       https://www.wrdsb.ca
 * @since      1.0.0
 *
 * @package    Staff Features
 * @subpackage School Data
 */

class WorkplaceInspectionTeam {
    private $ID;
    private $content;
    private $title;
    private $excerpt;

    private $blogID;
    private $schoolCode;
    private $email;

    private $principalFirstname;
    private $principalLastname;
    private $principalAffiliation;
    private $principalHSContact;
    private $custodianFirstname;
    private $custodianLastname;
    private $custodianAffiliation;
    private $custodianHSContact;
    private $staffMember1Firstname;
    private $staffMember1Lastname;
    private $staffMember1Affiliation;
    private $staffMember1HSContact;
    private $staffMember2Firstname;
    private $staffMember2Lastname;
    private $staffMember2Affiliation;
    private $staffMember2HSContact;
    private $staffMember3Firstname;
    private $staffMember3Lastname;
    private $staffMember3Affiliation;
    private $staffMember3HSContact;
    private $staffMember4Firstname;
    private $staffMember4Lastname;
    private $staffMember4Affiliation;
    private $staffMember4HSContact;

    public static function getInstance() {
        $args = array(
            'post_type' => 'wit',
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
        $postFromDB->principalAffiliation = $customFields['principalAffiliation'][0];
        $postFromDB->principalHSContact = $customFields['principalHSContact'][0];
        $postFromDB->custodianFirstname = $customFields['custodianFirstname'][0];
        $postFromDB->custodianLastname = $customFields['custodianLastname'][0];
        $postFromDB->custodianAffiliation = $customFields['custodianAffiliation'][0];
        $postFromDB->custodianHSContact = $customFields['custodianHSContact'][0];
        $postFromDB->staffMember1Firstname = $customFields['staffMember1Firstname'][0];
        $postFromDB->staffMember1Lastname = $customFields['staffMember1Lastname'][0];
        $postFromDB->staffMember1Affiliation = $customFields['staffMember1Affiliation'][0];
        $postFromDB->staffMember1HSContact = $customFields['staffMember1HSContact'][0];
        $postFromDB->staffMember2Firstname = $customFields['staffMember2Firstname'][0];
        $postFromDB->staffMember2Lastname = $customFields['staffMember2Lastname'][0];
        $postFromDB->staffMember2Affiliation = $customFields['staffMember2Affiliation'][0];
        $postFromDB->staffMember2HSContact = $customFields['staffMember2HSContact'][0];
        $postFromDB->staffMember3Firstname = $customFields['staffMember3Firstname'][0];
        $postFromDB->staffMember3Lastname = $customFields['staffMember3Lastname'][0];
        $postFromDB->staffMember3Affiliation = $customFields['staffMember3Affiliation'][0];
        $postFromDB->staffMember3HSContact = $customFields['staffMember3HSContact'][0];
        $postFromDB->staffMember4Firstname = $customFields['staffMember4Firstname'][0];
        $postFromDB->staffMember4Lastname = $customFields['staffMember4Lastname'][0];
        $postFromDB->staffMember4Affiliation = $customFields['staffMember4Affiliation'][0];
        $postFromDB->staffMember4HSContact = $customFields['staffMember4HSContact'][0];
    
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
            'principalAffiliation' => $postRequest['principalAffiliation'],
            'principalHSContact' => $postRequest['principalHSContact'] ?? '0',
            'custodianFirstname' => $postRequest['custodianFirstname'],
            'custodianLastname' => $postRequest['custodianLastname'],
            'custodianAffiliation' => $postRequest['custodianAffiliation'],
            'custodianHSContact' => $postRequest['custodianHSContact'] ?? '0',
            'staffMember1Firstname' => $postRequest['staffMember1Firstname'],
            'staffMember1Lastname' => $postRequest['staffMember1Lastname'],
            'staffMember1Affiliation' => $postRequest['staffMember1Affiliation'],
            'staffMember1HSContact' => $postRequest['staffMember1HSContact'] ?? '0',
            'staffMember2Firstname' => $postRequest['staffMember2Firstname'],
            'staffMember2Lastname' => $postRequest['staffMember2Lastname'],
            'staffMember2Affiliation' => $postRequest['staffMember2Affiliation'],
            'staffMember2HSContact' => $postRequest['staffMember2HSContact'] ?? '0',
            'staffMember3Firstname' => $postRequest['staffMember3Firstname'],
            'staffMember3Lastname' => $postRequest['staffMember3Lastname'],
            'staffMember3Affiliation' => $postRequest['staffMember3Affiliation'],
            'staffMember3HSContact' => $postRequest['staffMember3HSContact'] ?? '0',
            'staffMember4Firstname' => $postRequest['staffMember4Firstname'],
            'staffMember4Lastname' => $postRequest['staffMember4Lastname'],
            'staffMember4Affiliation' => $postRequest['staffMember4Affiliation'],
            'staffMember4HSContact' => $postRequest['staffMember4HSContact'] ?? '0',
        );

        $instance = self::getInstance();

        $instance->title   = "{$postArray['schoolCode']} Emergency Response Team";
        $instance->content = $instance->content . "<br/>Updated by {$postArray['email']} at " . date('Y-m-d H:i:s');
        $instance->excerpt = "Last updated by {$postArray['email']} at " . date('Y-m-d H:i:s');

        $instance->blogID     = $postArray['blogID']     ?? $instance->blogID;
        $instance->schoolCode = $postArray['schoolCode'] ?? $instance->schoolCode;
        $instance->email      = $postArray['email']      ?? $instance->email;

        $instance->principalFirstname = $postArray['principalFirstname'] ?? $instance->principalFirstname;
        $instance->principalLastname = $postArray['principalLastname'] ?? $instance->principalLastname;
        $instance->principalAffiliation = $postArray['principalAffiliation'] ?? $instance->principalAffiliation;
        $instance->principalHSContact = $postArray['principalHSContact'] ?? $instance->principalHSContact;
        $instance->custodianFirstname = $postArray['custodianFirstname'] ?? $instance->custodianFirstname;
        $instance->custodianLastname = $postArray['custodianLastname'] ?? $instance->custodianLastname;
        $instance->custodianAffiliation = $postArray['custodianAffiliation'] ?? $instance->custodianAffiliation;
        $instance->custodianHSContact = $postArray['custodianHSContact'] ?? $instance->custodianHSContact;
        $instance->staffMember1Firstname = $postArray['staffMember1Firstname'] ?? $instance->staffMember1Firstname;
        $instance->staffMember1Lastname = $postArray['staffMember1Lastname'] ?? $instance->staffMember1Lastname;
        $instance->staffMember1Affiliation = $postArray['staffMember1Affiliation'] ?? $instance->staffMember1Affiliation;
        $instance->staffMember1HSContact = $postArray['staffMember1HSContact'] ?? $instance->staffMember1HSContact;
        $instance->staffMember2Firstname = $postArray['staffMember2Firstname'] ?? $instance->staffMember2Firstname;
        $instance->staffMember2Lastname = $postArray['staffMember2Lastname'] ?? $instance->staffMember2Lastname;
        $instance->staffMember2Affiliation = $postArray['staffMember2Affiliation'] ?? $instance->staffMember2Affiliation;
        $instance->staffMember2HSContact = $postArray['staffMember2HSContact'] ?? $instance->staffMember2HSContact;
        $instance->staffMember3Firstname = $postArray['staffMember3Firstname'] ?? $instance->staffMember3Firstname;
        $instance->staffMember3Lastname = $postArray['staffMember3Lastname'] ?? $instance->staffMember3Lastname;
        $instance->staffMember3Affiliation = $postArray['staffMember3Affiliation'] ?? $instance->staffMember3Affiliation;
        $instance->staffMember3HSContact = $postArray['staffMember3HSContact'] ?? $instance->staffMember3HSContact;
        $instance->staffMember4Firstname = $postArray['staffMember4Firstname'] ?? $instance->staffMember4Firstname;
        $instance->staffMember4Lastname = $postArray['staffMember4Lastname'] ?? $instance->staffMember4Lastname;
        $instance->staffMember4Affiliation = $postArray['staffMember4Affiliation'] ?? $instance->staffMember4Affiliation;
        $instance->staffMember4HSContact = $postArray['staffMember4HSContact'] ?? $instance->staffMember4HSContact;

        $saved = $instance->save();

        if ($saved) {
            WPCore::wpRedirect($wpRedirect);
        } else {

        }
    }

    private static function instantiate($post) {
        $instance = new WorkplaceInspectionTeam;

        $instance->ID      = $post->ID           ?? 0;
        $instance->content = $post->post_content ?? '';
        $instance->title   = $post->post_title   ?? '';
        $instance->excerpt = $post->post_excerpt ?? '';

        $instance->blogID     = $post->blogID ?? '';
        $instance->schoolCode = $post->schoolCode ?? '';
        $instance->email      = $post->email ?? '';

        $instance->principalFirstname = $post->principalFirstname ?? '';
        $instance->principalLastname = $post->principalLastname ?? '';
        $instance->principalAffiliation = $post->principalAffiliation ?? '';
        $instance->principalHSContact = $post->principalHSContact ?? '';
        $instance->custodianFirstname = $post->custodianFirstname ?? '';
        $instance->custodianLastname = $post->custodianLastname ?? '';
        $instance->custodianAffiliation = $post->custodianAffiliation ?? '';
        $instance->custodianHSContact = $post->custodianHSContact ?? '';
        $instance->staffMember1Firstname = $post->staffMember1Firstname ?? '';
        $instance->staffMember1Lastname = $post->staffMember1Lastname ?? '';
        $instance->staffMember1Affiliation = $post->staffMember1Affiliation ?? '';
        $instance->staffMember1HSContact = $post->staffMember1HSContact ?? '';
        $instance->staffMember2Firstname = $post->staffMember2Firstname ?? '';
        $instance->staffMember2Lastname = $post->staffMember2Lastname ?? '';
        $instance->staffMember2Affiliation = $post->staffMember2Affiliation ?? '';
        $instance->staffMember2HSContact = $post->staffMember2HSContact ?? '';
        $instance->staffMember3Firstname = $post->staffMember3Firstname ?? '';
        $instance->staffMember3Lastname = $post->staffMember3Lastname ?? '';
        $instance->staffMember3Affiliation = $post->staffMember3Affiliation ?? '';
        $instance->staffMember3HSContact = $post->staffMember3HSContact ?? '';
        $instance->staffMember4Firstname = $post->staffMember4Firstname ?? '';
        $instance->staffMember4Lastname = $post->staffMember4Lastname ?? '';
        $instance->staffMember4Affiliation = $post->staffMember4Affiliation ?? '';
        $instance->staffMember4HSContact = $post->staffMember4HSContact ?? '';
    
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
        $this->principalAffiliation = $params['principalAffiliation'];
        $this->principalHSContact = $params['principalHSContact'];
        $this->custodianFirstname = $params['custodianFirstname'];
        $this->custodianLastname = $params['custodianLastname'];
        $this->custodianAffiliation = $params['custodianAffiliation'];
        $this->custodianHSContact = $params['custodianHSContact'];
        $this->staffMember1Firstname = $params['staffMember1Firstname'];
        $this->staffMember1Lastname = $params['staffMember1Lastname'];
        $this->staffMember1Affiliation = $params['staffMember1Affiliation'];
        $this->staffMember1HSContact = $params['staffMember1HSContact'];
        $this->staffMember2Firstname = $params['staffMember2Firstname'];
        $this->staffMember2Lastname = $params['staffMember2Lastname'];
        $this->staffMember2Affiliation = $params['staffMember2Affiliation'];
        $this->staffMember2HSContact = $params['staffMember2HSContact'];
        $this->staffMember3Firstname = $params['staffMember3Firstname'];
        $this->staffMember3Lastname = $params['staffMember3Lastname'];
        $this->staffMember3Affiliation = $params['staffMember3Affiliation'];
        $this->staffMember3HSContact = $params['staffMember3HSContact'];
        $this->staffMember4Firstname = $params['staffMember4Firstname'];
        $this->staffMember4Lastname = $params['staffMember4Lastname'];
        $this->staffMember4Affiliation = $params['staffMember4Affiliation'];
        $this->staffMember4HSContact = $params['staffMember4HSContact'];
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
    public function getPrincipalAffiliation() {
        return $this->principalAffiliation;
    }
    public function getPrincipalHSContact() {
        return $this->principalHSContact;
    }
    public function principalHSContactIsChecked() {
        return ($this->principalHSContact === '1') ? true : false;
    }

    public function getCustodianFirstname() {
        return $this->custodianFirstname;
    }
    public function getCustodianLastname() {
        return $this->custodianLastname;
    }
    public function getCustodianAffiliation() {
        return $this->custodianAffiliation;
    }
    public function getCustodianHSContact() {
        return $this->custodianHSContact;
    }
    public function custodianHSContactIsChecked() {
        return ($this->custodianHSContact === '1') ? true : false;
    }

    public function getStaffMember1Firstname() {
        return $this->staffMember1Firstname;
    }
    public function getStaffMember1Lastname() {
        return $this->staffMember1Lastname;
    }
    public function getStaffMember1Affiliation() {
        return $this->staffMember1Affiliation;
    }
    public function getStaffMember1HSContact() {
        return $this->staffMember1HSContact;
    }
    public function staffMember1HSContactIsChecked() {
        return ($this->staffMember1HSContact === '1') ? true : false;
    }

    public function getStaffMember2Firstname() {
        return $this->staffMember2Firstname;
    }
    public function getStaffMember2Lastname() {
        return $this->staffMember2Lastname;
    }
    public function getStaffMember2Affiliation() {
        return $this->staffMember2Affiliation;
    }
    public function getStaffMember2HSContact() {
        return $this->staffMember2HSContact;
    }
    public function staffMember2HSContactIsChecked() {
        return ($this->staffMember2HSContact === '1') ? true : false;
    }

    public function getStaffMember3Firstname() {
        return $this->staffMember3Firstname;
    }
    public function getStaffMember3Lastname() {
        return $this->staffMember3Lastname;
    }
    public function getStaffMember3Affiliation() {
        return $this->staffMember3Affiliation;
    }
    public function getStaffMember3HSContact() {
        return $this->staffMember3HSContact;
    }
    public function staffMember3HSContactIsChecked() {
        return ($this->staffMember3HSContact === '1') ? true : false;
    }

    public function getStaffMember4Firstname() {
        return $this->staffMember4Firstname;
    }
    public function getStaffMember4Lastname() {
        return $this->staffMember4Lastname;
    }
    public function getStaffMember4Affiliation() {
        return $this->staffMember4Affiliation;
    }
    public function getStaffMember4HSContact() {
        return $this->staffMember4HSContact;
    }
    public function staffMember4HSContactIsChecked() {
        return ($this->staffMember4HSContact === '1') ? true : false;
    }

    public function toWPPostArray() {
        $postArray = array(
            'ID'      => $this->ID,

            'post_type'    => 'wit',
            'post_status'  => 'publish',

            'post_content' => $this->content,
            'post_title'   => $this->title,
            'post_excerpt' => $this->excerpt,

            'principalFirstname' => $this->principalFirstname,
            'principalLastname' => $this->principalLastname,
            'principalAffiliation' => $this->principalAffiliation,
            'principalHSContact' => $this->principalHSContact,
            'custodianFirstname' => $this->custodianFirstname,
            'custodianLastname' => $this->custodianLastname,
            'custodianAffiliation' => $this->custodianAffiliation,
            'custodianHSContact' => $this->custodianHSContact,
            'staffMember1Firstname' => $this->staffMember1Firstname,
            'staffMember1Lastname' => $this->staffMember1Lastname,
            'staffMember1Affiliation' => $this->staffMember1Affiliation,
            'staffMember1HSContact' => $this->staffMember1HSContact,
            'staffMember2Firstname' => $this->staffMember2Firstname,
            'staffMember2Lastname' => $this->staffMember2Lastname,
            'staffMember2Affiliation' => $this->staffMember2Affiliation,
            'staffMember2HSContact' => $this->staffMember2HSContact,
            'staffMember3Firstname' => $this->staffMember3Firstname,
            'staffMember3Lastname' => $this->staffMember3Lastname,
            'staffMember3Affiliation' => $this->staffMember3Affiliation,
            'staffMember3HSContact' => $this->staffMember3HSContact,
            'staffMember4Firstname' => $this->staffMember4Firstname,
            'staffMember4Lastname' => $this->staffMember4Lastname,
            'staffMember4Affiliation' => $this->staffMember4Affiliation,
            'staffMember4HSContact' => $this->staffMember4HSContact,
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

            WPCore::updatePostMeta($postID, 'principalFirstname', $post['principalFirstname']);
            WPCore::updatePostMeta($postID, 'principalLastname', $post['principalLastname']);
            WPCore::updatePostMeta($postID, 'principalAffiliation', $post['principalAffiliation']);
            WPCore::updatePostMeta($postID, 'principalHSContact', $post['principalHSContact']);

            WPCore::updatePostMeta($postID, 'custodianFirstname', $post['custodianFirstname']);
            WPCore::updatePostMeta($postID, 'custodianLastname', $post['custodianLastname']);
            WPCore::updatePostMeta($postID, 'custodianAffiliation', $post['custodianAffiliation']);
            WPCore::updatePostMeta($postID, 'custodianHSContact', $post['custodianHSContact']);

            WPCore::updatePostMeta($postID, 'staffMember1Firstname', $post['staffMember1Firstname']);
            WPCore::updatePostMeta($postID, 'staffMember1Lastname', $post['staffMember1Lastname']);
            WPCore::updatePostMeta($postID, 'staffMember1Affiliation', $post['staffMember1Affiliation']);
            WPCore::updatePostMeta($postID, 'staffMember1HSContact', $post['staffMember1HSContact']);

            WPCore::updatePostMeta($postID, 'staffMember2Firstname', $post['staffMember2Firstname']);
            WPCore::updatePostMeta($postID, 'staffMember2Lastname', $post['staffMember2Lastname']);
            WPCore::updatePostMeta($postID, 'staffMember2Affiliation', $post['staffMember2Affiliation']);
            WPCore::updatePostMeta($postID, 'staffMember2HSContact', $post['staffMember2HSContact']);

            WPCore::updatePostMeta($postID, 'staffMember3Firstname', $post['staffMember3Firstname']);
            WPCore::updatePostMeta($postID, 'staffMember3Lastname', $post['staffMember3Lastname']);
            WPCore::updatePostMeta($postID, 'staffMember3Affiliation', $post['staffMember3Affiliation']);
            WPCore::updatePostMeta($postID, 'staffMember3HSContact', $post['staffMember3HSContact']);

            WPCore::updatePostMeta($postID, 'staffMember4Firstname', $post['staffMember4Firstname']);
            WPCore::updatePostMeta($postID, 'staffMember4Lastname', $post['staffMember4Lastname']);
            WPCore::updatePostMeta($postID, 'staffMember4Affiliation', $post['staffMember4Affiliation']);
            WPCore::updatePostMeta($postID, 'staffMember4HSContact', $post['staffMember4HSContact']);
        }

        return true;
    }
}
