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
            'post_type' => 'workplaceInspectionTeam',
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
            'principalAffiliation' => $postRequest['principalAffiliation'],
            'principalHSContact' => $postRequest['principalHSContact'],
            'custodianFirstname' => $postRequest['custodianFirstname'],
            'custodianLastname' => $postRequest['custodianLastname'],
            'custodianAffiliation' => $postRequest['custodianAffiliation'],
            'custodianHSContact' => $postRequest['custodianHSContact'],
            'staffMember1Firstname' => $postRequest['staffMember1Firstname'],
            'staffMember1Lastname' => $postRequest['staffMember1Lastname'],
            'staffMember1Affiliation' => $postRequest['staffMember1Affiliation'],
            'staffMember1HSContact' => $postRequest['staffMember1HSContact'],
            'staffMember2Firstname' => $postRequest['staffMember2Firstname'],
            'staffMember2Lastname' => $postRequest['staffMember2Lastname'],
            'staffMember2Affiliation' => $postRequest['staffMember2Affiliation'],
            'staffMember2HSContact' => $postRequest['staffMember2HSContact'],
            'staffMember3Firstname' => $postRequest['staffMember3Firstname'],
            'staffMember3Lastname' => $postRequest['staffMember3Lastname'],
            'staffMember3Affiliation' => $postRequest['staffMember3Affiliation'],
            'staffMember3HSContact' => $postRequest['staffMember3HSContact'],
            'staffMember4Firstname' => $postRequest['staffMember4Firstname'],
            'staffMember4Lastname' => $postRequest['staffMember4Lastname'],
            'staffMember4Affiliation' => $postRequest['staffMember4Affiliation'],
            'staffMember4HSContact' => $postRequest['staffMember4HSContact'],
        );

        echo "<pre>";
        echo "from CPT";
        print_r($_POST);
        print_r($_REQUEST);
        print_r(self::getInstance());
        echo "</pre>";
    }

    private static function instantiate($post) {
        $instance = new WorkplaceInspectionTeam;

        $instance->ID      = $post->ID           ?? 0;
        $instance->content = $post->post_content ?? '';
        $instance->title   = $post->post_title   ?? '';
        $instance->excerpt = $post->post_excerpt ?? '';

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
        return ($this->principalHSContact === 1) ? true : false;
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
        return ($this->custodianHSContact === 1) ? true : false;
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
        return ($this->staffMember1HSContact === 1) ? true : false;
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
        return ($this->staffMember2HSContact === 1) ? true : false;
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
        return ($this->staffMember3HSContact === 1) ? true : false;
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
        return ($this->staffMember4HSContact === 1) ? true : false;
    }

    public function toArray() {
        $postArray = array(
            'ID'      => $this->ID,
            'content' => $this->content,
            'title'   => $this->title,
            'excerpt' => $this->excerpt,

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
        if (isset($this->principalAffiliation)) {
            WPCore::updatePostMeta($postID, 'principalAffiliation', WPCore::sanitizeTextField($post['principalAffiliation']));
        }
        if (isset($this->principalHSContact)) {
            WPCore::updatePostMeta($postID, 'principalHSContact', WPCore::sanitizeTextField($post['principalHSContact']));
        }

        if (isset($this->custodianFirstname)) {
            WPCore::updatePostMeta($postID, 'custodianFirstname', WPCore::sanitizeTextField($post['custodianFirstname']));
        }
        if (isset($this->custodianLastname)) {
            WPCore::updatePostMeta($postID, 'custodianLastname', WPCore::sanitizeTextField($post['custodianLastname']));
        }
        if (isset($this->custodianAffiliation)) {
            WPCore::updatePostMeta($postID, 'custodianAffiliation', WPCore::sanitizeTextField($post['custodianAffiliation']));
        }
        if (isset($this->custodianHSContact)) {
            WPCore::updatePostMeta($postID, 'custodianHSContact', WPCore::sanitizeTextField($post['custodianHSContact']));
        }

        if (isset($this->staffMember1Firstname)) {
            WPCore::updatePostMeta($postID, 'staffMember1Firstname', WPCore::sanitizeTextField($post['staffMember1Firstname']));
        }
        if (isset($this->staffMember1Lastname)) {
            WPCore::updatePostMeta($postID, 'staffMember1Lastname', WPCore::sanitizeTextField($post['staffMember1Lastname']));
        }
        if (isset($this->staffMember1Affiliation)) {
            WPCore::updatePostMeta($postID, 'staffMember1Affiliation', WPCore::sanitizeTextField($post['staffMember1Affiliation']));
        }
        if (isset($this->staffMember1HSContact)) {
            WPCore::updatePostMeta($postID, 'staffMember1HSContact', WPCore::sanitizeTextField($post['staffMember1HSContact']));
        }

        if (isset($this->staffMember2Firstname)) {
            WPCore::updatePostMeta($postID, 'staffMember2Firstname', WPCore::sanitizeTextField($post['staffMember2Firstname']));
        }
        if (isset($this->staffMember2Lastname)) {
            WPCore::updatePostMeta($postID, 'staffMember2Lastname', WPCore::sanitizeTextField($post['staffMember2Lastname']));
        }
        if (isset($this->staffMember2Affiliation)) {
            WPCore::updatePostMeta($postID, 'staffMember2Affiliation', WPCore::sanitizeTextField($post['staffMember2Affiliation']));
        }
        if (isset($this->staffMember2HSContact)) {
            WPCore::updatePostMeta($postID, 'staffMember2HSContact', WPCore::sanitizeTextField($post['staffMember2HSContact']));
        }

        if (isset($this->staffMember3Firstname)) {
            WPCore::updatePostMeta($postID, 'staffMember3Firstname', WPCore::sanitizeTextField($post['staffMember3Firstname']));
        }
        if (isset($this->staffMember3Lastname)) {
            WPCore::updatePostMeta($postID, 'staffMember3Lastname', WPCore::sanitizeTextField($post['staffMember3Lastname']));
        }
        if (isset($this->staffMember3Affiliation)) {
            WPCore::updatePostMeta($postID, 'staffMember3Affiliation', WPCore::sanitizeTextField($post['staffMember3Affiliation']));
        }
        if (isset($this->staffMember3HSContact)) {
            WPCore::updatePostMeta($postID, 'staffMember3HSContact', WPCore::sanitizeTextField($post['staffMember3HSContact']));
        }

        if (isset($this->staffMember4Firstname)) {
            WPCore::updatePostMeta($postID, 'staffMember4Firstname', WPCore::sanitizeTextField($post['staffMember4Firstname']));
        }
        if (isset($this->staffMember4Lastname)) {
            WPCore::updatePostMeta($postID, 'staffMember4Lastname', WPCore::sanitizeTextField($post['staffMember4Lastname']));
        }
        if (isset($this->staffMember4Affiliation)) {
            WPCore::updatePostMeta($postID, 'staffMember4Affiliation', WPCore::sanitizeTextField($post['staffMember4Affiliation']));
        }
        if (isset($this->staffMember4HSContact)) {
            WPCore::updatePostMeta($postID, 'staffMember4HSContact', WPCore::sanitizeTextField($post['staffMember4HSContact']));
        }
    }
}
