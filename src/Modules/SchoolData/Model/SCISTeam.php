<?php
namespace WRDSB\Staff\Modules\SchoolData\Model;
use WRDSB\Staff\Modules\WP\WPCore as WPCore;

/**
 * Define and register class for posts of type "scisTeam"
 * *
 * @link       https://www.wrdsb.ca
 * @since      1.0.0
 *
 * @package    Staff Features
 * @subpackage School Data
 */

class SCISTeam {
    private $ID;
    private $content;
    private $title;
    private $excerpt;

    private $administratorFirstname;
    private $administratorLastname;
    private $administratorIELiasion;
    private $teacherFirstname;
    private $teacherLastname;
    private $teacherIELiasion;
    private $paraprofessionalFirstname;
    private $paraprofessionalLastname;
    private $paraprofessionalIELiasion;
    private $parentFirstname;
    private $parentLastname;
    private $parentIELiasion;
    private $communityMemberFirstname;
    private $communityMemberLastname;
    private $communityMemberIELiasion;
    private $student1Firstname;
    private $student1Lastname;
    private $student1IELiasion;
    private $student2Firstname;
    private $student2Lastname;
    private $student2IELiasion;
    private $optional1Firstname;
    private $optional1Lastname;
    private $optional1IELiasion;
    private $optional2Firstname;
    private $optional2Lastname;
    private $optional2IELiasion;
    private $optional3Firstname;
    private $optional3Lastname;
    private $optional3IELiasion;
    private $optional4Firstname;
    private $optional4Lastname;
    private $optional4IELiasion;
    private $optional5Firstname;
    private $optional5Lastname;
    private $optional5IELiasion;

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

            'administratorFirstname' => $postRequest['administratorFirstname'],
            'administratorLastname' => $postRequest['administratorLastname'],
            'administratorIELiasion' => $postRequest['administratorIELiasion'],
            'teacherFirstname' => $postRequest['teacherFirstname'],
            'teacherLastname' => $postRequest['teacherLastname'],
            'teacherIELiasion' => $postRequest['teacherIELiasion'],
            'paraprofessionalFirstname' => $postRequest['paraprofessionalFirstname'],
            'paraprofessionalLastname' => $postRequest['paraprofessionalLastname'],
            'paraprofessionalIELiasion' => $postRequest['paraprofessionalIELiasion'],
            'parentFirstname' => $postRequest['parentFirstname'],
            'parentLastname' => $postRequest['parentLastname'],
            'parentIELiasion' => $postRequest['parentIELiasion'],
            'communityMemberFirstname' => $postRequest['communityMemberFirstname'],
            'communityMemberLastname' => $postRequest['communityMemberLastname'],
            'communityMemberIELiasion' => $postRequest['communityMemberIELiasion'],
            'student1Firstname' => $postRequest['student1Firstname'],
            'student1Lastname' => $postRequest['student1Lastname'],
            'student1IELiasion' => $postRequest['student1IELiasion'],
            'student2Firstname' => $postRequest['student2Firstname'],
            'student2Lastname' => $postRequest['student2Lastname'],
            'student2IELiasion' => $postRequest['student2IELiasion'],
            'optional1Firstname' => $postRequest['optional1Firstname'],
            'optional1Lastname' => $postRequest['optional1Lastname'],
            'optional1IELiasion' => $postRequest['optional1IELiasion'],
            'optional2Firstname' => $postRequest['optional2Firstname'],
            'optional2Lastname' => $postRequest['optional2Lastname'],
            'optional2IELiasion' => $postRequest['optional2IELiasion'],
            'optional3Firstname' => $postRequest['optional3Firstname'],
            'optional3Lastname' => $postRequest['optional3Lastname'],
            'optional3IELiasion' => $postRequest['optional3IELiasion'],
            'optional4Firstname' => $postRequest['optional4Firstname'],
            'optional4Lastname' => $postRequest['optional4Lastname'],
            'optional4IELiasion' => $postRequest['optional4IELiasion'],
            'optional5Firstname' => $postRequest['optional5Firstname'],
            'optional5Lastname' => $postRequest['optional5Lastname'],
            'optional5IELiasion' => $postRequest['optional5IELiasion'],
        );

        echo "<pre>";
        echo "from CPT";
        print_r($_POST);
        print_r($_REQUEST);
        print_r(self::getInstance());
        echo "</pre>";
    }

    private static function instantiate($post) {
        $instance = new SCISTeam;

        $instance->ID      = $post->ID           ?? 0;
        $instance->content = $post->post_content ?? '';
        $instance->title   = $post->post_title   ?? '';
        $instance->excerpt = $post->post_excerpt ?? '';

        $instance->administratorFirstname = $post->administratorFirstname ?? '';
        $instance->administratorLastname = $post->administratorLastname ?? '';
        $instance->administratorIELiasion = $post->administratorIELiasion ?? '';
        $instance->teacherFirstname = $post->teacherFirstname ?? '';
        $instance->teacherLastname = $post->teacherLastname ?? '';
        $instance->teacherIELiasion = $post->teacherIELiasion ?? '';
        $instance->paraprofessionalFirstname = $post->paraprofessionalFirstname ?? '';
        $instance->paraprofessionalLastname = $post->paraprofessionalLastname ?? '';
        $instance->paraprofessionalIELiasion = $post->paraprofessionalIELiasion ?? '';
        $instance->parentFirstname = $post->parentFirstname ?? '';
        $instance->parentLastname = $post->parentLastname ?? '';
        $instance->parentIELiasion = $post->parentIELiasion ?? '';
        $instance->communityMemberFirstname = $post->communityMemberFirstname ?? '';
        $instance->communityMemberLastname = $post->communityMemberLastname ?? '';
        $instance->communityMemberIELiasion = $post->communityMemberIELiasion ?? '';
        $instance->student1Firstname = $post->student1Firstname ?? '';
        $instance->student1Lastname = $post->student1Lastname ?? '';
        $instance->student1IELiasion = $post->student1IELiasion ?? '';
        $instance->student2Firstname = $post->student2Firstname ?? '';
        $instance->student2Lastname = $post->student2Lastname ?? '';
        $instance->student2IELiasion = $post->student2IELiasion ?? '';
        $instance->optional1Firstname = $post->optional1Firstname ?? '';
        $instance->optional1Lastname = $post->optional1Lastname ?? '';
        $instance->optional1IELiasion = $post->optional1IELiasion ?? '';
        $instance->optional2Firstname = $post->optional2Firstname ?? '';
        $instance->optional2Lastname = $post->optional2Lastname ?? '';
        $instance->optional2IELiasion = $post->optional2IELiasion ?? '';
        $instance->optional3Firstname = $post->optional3Firstname ?? '';
        $instance->optional3Lastname = $post->optional3Lastname ?? '';
        $instance->optional3IELiasion = $post->optional3IELiasion ?? '';
        $instance->optional4Firstname = $post->optional4Firstname ?? '';
        $instance->optional4Lastname = $post->optional4Lastname ?? '';
        $instance->optional4IELiasion = $post->optional4IELiasion ?? '';
        $instance->optional5Firstname = $post->optional5Firstname ?? '';
        $instance->optional5Lastname = $post->optional5Lastname ?? '';
        $instance->optional5IELiasion = $post->optional5IELiasion ?? '';

        return $instance;
    }

    public function getID() {
        return $this->ID;
    }
    public function getAdministratorFirstname() {
        return $this->administratorFirstname;
    }
    public function getAdministratorLastname() {
        return $this->administratorLastname;
    }
    public function getAdministratorIELiasion() {
        return $this->administratorIELiasion;
    }
    public function administratorIELiasionIsChecked() {
        return ($this->administratorIELiasion === 1) ? true : false;
    }

    public function getTeacherFirstname() {
        return $this->teacherFirstname;
    }
    public function getTeacherLastname() {
        return $this->teacherLastname;
    }
    public function getTeacherIELiasion() {
        return $this->teacherIELiasion;
    }
    public function teacherIELiasionIsChecked() {
        return ($this->teacherIELiasion === 1) ? true : false;
    }

    public function getParaprofessionalFirstname() {
        return $this->paraprofessionalFirstname;
    }
    public function getParaprofessionalLastname() {
        return $this->paraprofessionalLastname;
    }
    public function getParaprofessionalIELiasion() {
        return $this->paraprofessionalIELiasion;
    }
    public function paraprofessionalIELiasionIsChecked() {
        return ($this->paraprofessionalIELiasion === 1) ? true : false;
    }

    public function getParentFirstname() {
        return $this->parentFirstname;
    }
    public function getParentLastname() {
        return $this->parentLastname;
    }
    public function getParentIELiasion() {
        return $this->parentIELiasion;
    }
    public function parentIELiasionIsChecked() {
        return ($this->parentIELiasion === 1) ? true : false;
    }

    public function getCommunityMemberFirstname() {
        return $this->communityMemberFirstname;
    }
    public function getCommunityMemberLastname() {
        return $this->communityMemberLastname;
    }
    public function getCommunityMemberIELiasion() {
        return $this->communityMemberIELiasion;
    }
    public function communityMemberIELiasionIsChecked() {
        return ($this->communityMemberIELiasion === 1) ? true : false;
    }

    public function getStudent1Firstname() {
        return $this->student1Firstname;
    }
    public function getStudent1Lastname() {
        return $this->student1Lastname;
    }
    public function getStudent1IELiasion() {
        return $this->student1IELiasion;
    }
    public function student1IELiasionIsChecked() {
        return ($this->student1IELiasion === 1) ? true : false;
    }

    public function getStudent2Firstname() {
        return $this->student2Firstname;
    }
    public function getStudent2Lastname() {
        return $this->student2Lastname;
    }
    public function getStudent2IELiasion() {
        return $this->student2IELiasion;
    }
    public function student2IELiasionIsChecked() {
        return ($this->student2IELiasion === 1) ? true : false;
    }

    public function getOptional1Firstname() {
        return $this->optional1Firstname;
    }
    public function getOptional1Lastname() {
        return $this->optional1Lastname;
    }
    public function getOptional1IELiasion() {
        return $this->optional1IELiasion;
    }
    public function optional1IELiasionIsChecked() {
        return ($this->optional1IELiasion === 1) ? true : false;
    }

    public function getOptional2Firstname() {
        return $this->optional2Firstname;
    }
    public function getOptional2Lastname() {
        return $this->optional2Lastname;
    }
    public function getOptional2IELiasion() {
        return $this->optional2IELiasion;
    }
    public function optional2IELiasionIsChecked() {
        return ($this->optional2IELiasion === 1) ? true : false;
    }

    public function getOptional3Firstname() {
        return $this->optional3Firstname;
    }
    public function getOptional3Lastname() {
        return $this->optional3Lastname;
    }
    public function getOptional3IELiasion() {
        return $this->optional3IELiasion;
    }
    public function optional3IELiasionIsChecked() {
        return ($this->optional3IELiasion === 1) ? true : false;
    }

    public function getOptional4Firstname() {
        return $this->optional4Firstname;
    }
    public function getOptional4Lastname() {
        return $this->optional4Lastname;
    }
    public function getOptional4IELiasion() {
        return $this->optional4IELiasion;
    }
    public function optional4IELiasionIsChecked() {
        return ($this->optional4IELiasion === 1) ? true : false;
    }

    public function getOptional5Firstname() {
        return $this->optional5Firstname;
    }
    public function getOptional5Lastname() {
        return $this->optional5Lastname;
    }
    public function getOptional5IELiasion() {
        return $this->optional5IELiasion;
    }
    public function optional5IELiasionIsChecked() {
        return ($this->optional5IELiasion === 1) ? true : false;
    }

    public function toArray() {
        $postArray = array(
            'ID'      => $this->ID,
            'content' => $this->content,
            'title'   => $this->title,
            'excerpt' => $this->excerpt,

            'administratorFirstname' => $this->administratorFirstname,
            'administratorLastname' => $this->administratorLastname,
            'administratorIELiasion' => $this->administratorIELiasion,
            'teacherFirstname' => $this->teacherFirstname,
            'teacherLastname' => $this->teacherLastname,
            'teacherIELiasion' => $this->teacherIELiasion,
            'paraprofessionalFirstname' => $this->paraprofessionalFirstname,
            'paraprofessionalLastname' => $this->paraprofessionalLastname,
            'paraprofessionalIELiasion' => $this->paraprofessionalIELiasion,
            'parentFirstname' => $this->parentFirstname,
            'parentLastname' => $this->parentLastname,
            'parentIELiasion' => $this->parentIELiasion,
            'communityMemberFirstname' => $this->communityMemberFirstname,
            'communityMemberLastname' => $this->communityMemberLastname,
            'communityMemberIELiasion' => $this->communityMemberIELiasion,
            'student1Firstname' => $this->student1Firstname,
            'student1Lastname' => $this->student1Lastname,
            'student1IELiasion' => $this->student1IELiasion,
            'student2Firstname' => $this->student2Firstname,
            'student2Lastname' => $this->student2Lastname,
            'student2IELiasion' => $this->student2IELiasion,
            'optional1Firstname' => $this->optional1Firstname,
            'optional1Lastname' => $this->optional1Lastname,
            'optional1IELiasion' => $this->optional1IELiasion,
            'optional2Firstname' => $this->optional2Firstname,
            'optional2Lastname' => $this->optional2Lastname,
            'optional2IELiasion' => $this->optional2IELiasion,
            'optional3Firstname' => $this->optional3Firstname,
            'optional3Lastname' => $this->optional3Lastname,
            'optional3IELiasion' => $this->optional3IELiasion,
            'optional4Firstname' => $this->optional4Firstname,
            'optional4Lastname' => $this->optional4Lastname,
            'optional4IELiasion' => $this->optional4IELiasion,
            'optional5Firstname' => $this->optional5Firstname,
            'optional5Lastname' => $this->optional5Lastname,
            'optional5IELiasion' => $this->optional5IELiasion,
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

        if (isset($this->administratorFirstname)) {
            WPCore::updatePostMeta($postID, 'administratorFirstname', WPCore::sanitizeTextField($post['administratorFirstname']));
        }
        if (isset($this->administratorLastname)) {
            WPCore::updatePostMeta($postID, 'administratorLastname', WPCore::sanitizeTextField($post['administratorLastname']));
        }
        if (isset($this->administratorIELiasion)) {
            WPCore::updatePostMeta($postID, 'administratorIELiasion', WPCore::sanitizeTextField($post['administratorIELiasion']));
        }

        if (isset($this->teacherFirstname)) {
            WPCore::updatePostMeta($postID, 'teacherFirstname', WPCore::sanitizeTextField($post['teacherFirstname']));
        }
        if (isset($this->teacherLastname)) {
            WPCore::updatePostMeta($postID, 'teacherLastname', WPCore::sanitizeTextField($post['teacherLastname']));
        }
        if (isset($this->teacherIELiasion)) {
            WPCore::updatePostMeta($postID, 'teacherIELiasion', WPCore::sanitizeTextField($post['teacherIELiasion']));
        }

        if (isset($this->paraprofessionalFirstname)) {
            WPCore::updatePostMeta($postID, 'paraprofessionalFirstname', WPCore::sanitizeTextField($post['paraprofessionalFirstname']));
        }
        if (isset($this->paraprofessionalLastname)) {
            WPCore::updatePostMeta($postID, 'paraprofessionalLastname', WPCore::sanitizeTextField($post['paraprofessionalLastname']));
        }
        if (isset($this->paraprofessionalIELiasion)) {
            WPCore::updatePostMeta($postID, 'paraprofessionalIELiasion', WPCore::sanitizeTextField($post['paraprofessionalIELiasion']));
        }

        if (isset($this->parentFirstname)) {
            WPCore::updatePostMeta($postID, 'parentFirstname', WPCore::sanitizeTextField($post['parentFirstname']));
        }
        if (isset($this->parentLastname)) {
            WPCore::updatePostMeta($postID, 'parentLastname', WPCore::sanitizeTextField($post['parentLastname']));
        }
        if (isset($this->parentIELiasion)) {
            WPCore::updatePostMeta($postID, 'parentIELiasion', WPCore::sanitizeTextField($post['parentIELiasion']));
        }

        if (isset($this->communityMemberFirstname)) {
            WPCore::updatePostMeta($postID, 'communityMemberFirstname', WPCore::sanitizeTextField($post['communityMemberFirstname']));
        }
        if (isset($this->communityMemberLastname)) {
            WPCore::updatePostMeta($postID, 'communityMemberLastname', WPCore::sanitizeTextField($post['communityMemberLastname']));
        }
        if (isset($this->communityMemberIELiasion)) {
            WPCore::updatePostMeta($postID, 'communityMemberIELiasion', WPCore::sanitizeTextField($post['communityMemberIELiasion']));
        }

        if (isset($this->student1Firstname)) {
            WPCore::updatePostMeta($postID, 'student1Firstname', WPCore::sanitizeTextField($post['student1Firstname']));
        }
        if (isset($this->student1Lastname)) {
            WPCore::updatePostMeta($postID, 'student1Lastname', WPCore::sanitizeTextField($post['student1Lastname']));
        }
        if (isset($this->student1IELiasion)) {
            WPCore::updatePostMeta($postID, 'student1IELiasion', WPCore::sanitizeTextField($post['student1IELiasion']));
        }

        if (isset($this->student2Firstname)) {
            WPCore::updatePostMeta($postID, 'student2Firstname', WPCore::sanitizeTextField($post['student2Firstname']));
        }
        if (isset($this->student2Lastname)) {
            WPCore::updatePostMeta($postID, 'student2Lastname', WPCore::sanitizeTextField($post['student2Lastname']));
        }
        if (isset($this->student2IELiasion)) {
            WPCore::updatePostMeta($postID, 'student2IELiasion', WPCore::sanitizeTextField($post['student2IELiasion']));
        }

        if (isset($this->optional1Firstname)) {
            WPCore::updatePostMeta($postID, 'optional1Firstname', WPCore::sanitizeTextField($post['optional1Firstname']));
        }
        if (isset($this->optional1Lastname)) {
            WPCore::updatePostMeta($postID, 'optional1Lastname', WPCore::sanitizeTextField($post['optional1Lastname']));
        }
        if (isset($this->optional1IELiasion)) {
            WPCore::updatePostMeta($postID, 'optional1IELiasion', WPCore::sanitizeTextField($post['optional1IELiasion']));
        }

        if (isset($this->optional2Firstname)) {
            WPCore::updatePostMeta($postID, 'optional2Firstname', WPCore::sanitizeTextField($post['optional2Firstname']));
        }
        if (isset($this->optional2Lastname)) {
            WPCore::updatePostMeta($postID, 'optional2Lastname', WPCore::sanitizeTextField($post['optional2Lastname']));
        }
        if (isset($this->optional2IELiasion)) {
            WPCore::updatePostMeta($postID, 'optional2IELiasion', WPCore::sanitizeTextField($post['optional2IELiasion']));
        }

        if (isset($this->optional3Firstname)) {
            WPCore::updatePostMeta($postID, 'optional3Firstname', WPCore::sanitizeTextField($post['optional3Firstname']));
        }
        if (isset($this->optional3Lastname)) {
            WPCore::updatePostMeta($postID, 'optional3Lastname', WPCore::sanitizeTextField($post['optional3Lastname']));
        }
        if (isset($this->optional3IELiasion)) {
            WPCore::updatePostMeta($postID, 'optional3IELiasion', WPCore::sanitizeTextField($post['optional3IELiasion']));
        }

        if (isset($this->optional4Firstname)) {
            WPCore::updatePostMeta($postID, 'optional4Firstname', WPCore::sanitizeTextField($post['optional4Firstname']));
        }
        if (isset($this->optional4Lastname)) {
            WPCore::updatePostMeta($postID, 'optional4Lastname', WPCore::sanitizeTextField($post['optional4Lastname']));
        }
        if (isset($this->optional4IELiasion)) {
            WPCore::updatePostMeta($postID, 'optional4IELiasion', WPCore::sanitizeTextField($post['optional4IELiasion']));
        }

        if (isset($this->optional5Firstname)) {
            WPCore::updatePostMeta($postID, 'optional5Firstname', WPCore::sanitizeTextField($post['optional5Firstname']));
        }
        if (isset($this->optional5Lastname)) {
            WPCore::updatePostMeta($postID, 'optional5Lastname', WPCore::sanitizeTextField($post['optional5Lastname']));
        }
        if (isset($this->optional5IELiasion)) {
            WPCore::updatePostMeta($postID, 'optional5IELiasion', WPCore::sanitizeTextField($post['optional5IELiasion']));
        }
    }
}