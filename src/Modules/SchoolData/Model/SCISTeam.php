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

    private $blogID;
    private $schoolCode;
    private $email;

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
            'post_type' => 'scisTeam',
            'post_status' => 'publish',
            'posts_per_page' => 1,
            'orderby' => 'title',
            'order' => 'ASC',
        );

        $query = new \WP_Query($args);
        
        $postFromDB = $query->posts[0];
        $customFields = get_post_custom($postFromDB->ID);

        $postFromDB->administratorFirstname = $customFields['administratorFirstname'][0];
        $postFromDB->administratorLastname = $customFields['administratorLastname'][0];
        $postFromDB->administratorIELiasion = $customFields['administratorIELiasion'][0];
        $postFromDB->teacherFirstname = $customFields['teacherFirstname'][0];
        $postFromDB->teacherLastname = $customFields['teacherLastname'][0];
        $postFromDB->teacherIELiasion = $customFields['teacherIELiasion'][0];
        $postFromDB->paraprofessionalFirstname = $customFields['paraprofessionalFirstname'][0];
        $postFromDB->paraprofessionalLastname = $customFields['paraprofessionalLastname'][0];
        $postFromDB->paraprofessionalIELiasion = $customFields['paraprofessionalIELiasion'][0];
        $postFromDB->parentFirstname = $customFields['parentFirstname'][0];
        $postFromDB->parentLastname = $customFields['parentLastname'][0];
        $postFromDB->parentIELiasion = $customFields['parentIELiasion'][0];
        $postFromDB->communityMemberFirstname = $customFields['communityMemberFirstname'][0];
        $postFromDB->communityMemberLastname = $customFields['communityMemberLastname'][0];
        $postFromDB->communityMemberIELiasion = $customFields['communityMemberIELiasion'][0];
        $postFromDB->student1Firstname = $customFields['student1Firstname'][0];
        $postFromDB->student1Lastname = $customFields['student1Lastname'][0];
        $postFromDB->student1IELiasion = $customFields['student1IELiasion'][0];
        $postFromDB->student2Firstname = $customFields['student2Firstname'][0];
        $postFromDB->student2Lastname = $customFields['student2Lastname'][0];
        $postFromDB->student2IELiasion = $customFields['student2IELiasion'][0];
        $postFromDB->optional1Firstname = $customFields['optional1Firstname'][0];
        $postFromDB->optional1Lastname = $customFields['optional1Lastname'][0];
        $postFromDB->optional1IELiasion = $customFields['optional1IELiasion'][0];
        $postFromDB->optional2Firstname = $customFields['optional2Firstname'][0];
        $postFromDB->optional2Lastname = $customFields['optional2Lastname'][0];
        $postFromDB->optional2IELiasion = $customFields['optional2IELiasion'][0];
        $postFromDB->optional3Firstname = $customFields['optional3Firstname'][0];
        $postFromDB->optional3Lastname = $customFields['optional3Lastname'][0];
        $postFromDB->optional3IELiasion = $customFields['optional3IELiasion'][0];
        $postFromDB->optional4Firstname = $customFields['optional4Firstname'][0];
        $postFromDB->optional4Lastname = $customFields['optional4Lastname'][0];
        $postFromDB->optional4IELiasion = $customFields['optional4IELiasion'][0];
        $postFromDB->optional5Firstname = $customFields['optional5Firstname'][0];
        $postFromDB->optional5Lastname = $customFields['optional5Lastname'][0];
        $postFromDB->optional5IELiasion = $customFields['optional5IELiasion'][0];

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

            'administratorFirstname' => $postRequest['administratorFirstname'],
            'administratorLastname' => $postRequest['administratorLastname'],
            'administratorIELiasion' => $postRequest['administratorIELiasion'] ?? '0',
            'teacherFirstname' => $postRequest['teacherFirstname'],
            'teacherLastname' => $postRequest['teacherLastname'],
            'teacherIELiasion' => $postRequest['teacherIELiasion'] ?? '0',
            'paraprofessionalFirstname' => $postRequest['paraprofessionalFirstname'],
            'paraprofessionalLastname' => $postRequest['paraprofessionalLastname'],
            'paraprofessionalIELiasion' => $postRequest['paraprofessionalIELiasion'] ?? '0',
            'parentFirstname' => $postRequest['parentFirstname'],
            'parentLastname' => $postRequest['parentLastname'],
            'parentIELiasion' => $postRequest['parentIELiasion'] ?? '0',
            'communityMemberFirstname' => $postRequest['communityMemberFirstname'],
            'communityMemberLastname' => $postRequest['communityMemberLastname'],
            'communityMemberIELiasion' => $postRequest['communityMemberIELiasion'] ?? '0',
            'student1Firstname' => $postRequest['student1Firstname'],
            'student1Lastname' => $postRequest['student1Lastname'],
            'student1IELiasion' => $postRequest['student1IELiasion'] ?? '0',
            'student2Firstname' => $postRequest['student2Firstname'],
            'student2Lastname' => $postRequest['student2Lastname'],
            'student2IELiasion' => $postRequest['student2IELiasion'] ?? '0',
            'optional1Firstname' => $postRequest['optional1Firstname'],
            'optional1Lastname' => $postRequest['optional1Lastname'],
            'optional1IELiasion' => $postRequest['optional1IELiasion'] ?? '0',
            'optional2Firstname' => $postRequest['optional2Firstname'],
            'optional2Lastname' => $postRequest['optional2Lastname'],
            'optional2IELiasion' => $postRequest['optional2IELiasion'] ?? '0',
            'optional3Firstname' => $postRequest['optional3Firstname'],
            'optional3Lastname' => $postRequest['optional3Lastname'],
            'optional3IELiasion' => $postRequest['optional3IELiasion'] ?? '0',
            'optional4Firstname' => $postRequest['optional4Firstname'],
            'optional4Lastname' => $postRequest['optional4Lastname'],
            'optional4IELiasion' => $postRequest['optional4IELiasion'] ?? '0',
            'optional5Firstname' => $postRequest['optional5Firstname'],
            'optional5Lastname' => $postRequest['optional5Lastname'],
            'optional5IELiasion' => $postRequest['optional5IELiasion'] ?? '0',
        );

        $instance = self::getInstance();

        $instance->title   = "{$postArray['schoolCode']} SCIS Team";
        $instance->content = $instance->content . "<br/>Updated by {$postArray['email']} at " . date('Y-m-d H:i:s');
        $instance->excerpt = "Last updated by {$postArray['email']} at " . date('Y-m-d H:i:s');

        $instance->blogID     = $postArray['blogID']     ?? $instance->blogID;
        $instance->schoolCode = $postArray['schoolCode'] ?? $instance->schoolCode;
        $instance->email      = $postArray['email']      ?? $instance->email;

        $instance->administratorFirstname = $postArray['administratorFirstname'] ?? $instance->administratorFirstname;
        $instance->administratorLastname = $postArray['administratorLastname'] ?? $instance->administratorLastname;
        $instance->administratorIELiasion = $postArray['administratorIELiasion'] ?? $instance->administratorIELiasion;
        $instance->teacherFirstname = $postArray['teacherFirstname'] ?? $instance->teacherFirstname;
        $instance->teacherLastname = $postArray['teacherLastname'] ?? $instance->teacherLastname;
        $instance->teacherIELiasion = $postArray['teacherIELiasion'] ?? $instance->teacherIELiasion;
        $instance->paraprofessionalFirstname = $postArray['paraprofessionalFirstname'] ?? $instance->paraprofessionalFirstname;
        $instance->paraprofessionalLastname = $postArray['paraprofessionalLastname'] ?? $instance->paraprofessionalLastname;
        $instance->paraprofessionalIELiasion = $postArray['paraprofessionalIELiasion'] ?? $instance->paraprofessionalIELiasion;
        $instance->parentFirstname = $postArray['parentFirstname'] ?? $instance->parentFirstname;
        $instance->parentLastname = $postArray['parentLastname'] ?? $instance->parentLastname;
        $instance->parentIELiasion = $postArray['parentIELiasion'] ?? $instance->parentIELiasion;
        $instance->communityMemberFirstname = $postArray['communityMemberFirstname'] ?? $instance->communityMemberFirstname;
        $instance->communityMemberLastname = $postArray['communityMemberLastname'] ?? $instance->communityMemberLastname;
        $instance->communityMemberIELiasion = $postArray['communityMemberIELiasion'] ?? $instance->communityMemberIELiasion;
        $instance->student1Firstname = $postArray['student1Firstname'] ?? $instance->student1Firstname;
        $instance->student1Lastname = $postArray['student1Lastname'] ?? $instance->student1Lastname;
        $instance->student1IELiasion = $postArray['student1IELiasion'] ?? $instance->student1IELiasion;
        $instance->student2Firstname = $postArray['student2Firstname'] ?? $instance->student2Firstname;
        $instance->student2Lastname = $postArray['student2Lastname'] ?? $instance->student2Lastname;
        $instance->student2IELiasion = $postArray['student2IELiasion'] ?? $instance->student2IELiasion;
        $instance->optional1Firstname = $postArray['optional1Firstname'] ?? $instance->optional1Firstname;
        $instance->optional1Lastname = $postArray['optional1Lastname'] ?? $instance->optional1Lastname;
        $instance->optional1IELiasion = $postArray['optional1IELiasion'] ?? $instance->optional1IELiasion;
        $instance->optional2Firstname = $postArray['optional2Firstname'] ?? $instance->optional2Firstname;
        $instance->optional2Lastname = $postArray['optional2Lastname'] ?? $instance->optional2Lastname;
        $instance->optional2IELiasion = $postArray['optional2IELiasion'] ?? $instance->optional2IELiasion;
        $instance->optional3Firstname = $postArray['optional3Firstname'] ?? $instance->optional3Firstname;
        $instance->optional3Lastname = $postArray['optional3Lastname'] ?? $instance->optional3Lastname;
        $instance->optional3IELiasion = $postArray['optional3IELiasion'] ?? $instance->optional3IELiasion;
        $instance->optional4Firstname = $postArray['optional4Firstname'] ?? $instance->optional4Firstname;
        $instance->optional4Lastname = $postArray['optional4Lastname'] ?? $instance->optional4Lastname;
        $instance->optional4IELiasion = $postArray['optional4IELiasion'] ?? $instance->optional4IELiasion;
        $instance->optional5Firstname = $postArray['optional5Firstname'] ?? $instance->optional5Firstname;
        $instance->optional5Lastname = $postArray['optional5Lastname'] ?? $instance->optional5Lastname;
        $instance->optional5IELiasion = $postArray['optional5IELiasion'] ?? $instance->optional5IELiasion;
    
        $saved = $instance->save();

        if ($saved) {
            WPCore::wpRedirect($wpRedirect);
        } else {

        }
    }

    private static function instantiate($post) {
        $instance = new SCISTeam;

        $instance->ID      = $post->ID           ?? 0;
        $instance->content = $post->post_content ?? '';
        $instance->title   = $post->post_title   ?? '';
        $instance->excerpt = $post->post_excerpt ?? '';

        $instance->blogID     = $post->blogID ?? '';
        $instance->schoolCode = $post->schoolCode ?? '';
        $instance->email      = $post->email ?? '';

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

    public function __construct($params = []) {
        $this->ID = $params['ID'];
        $this->content = $params['content'];
        $this->title = $params['title'];
        $this->excerpt = $params['excerpt'];
        $this->blogID = $params['blogID'];
        $this->schoolCode = $params['schoolCode'];
        $this->email = $params['email'];
        $this->administratorFirstname = $params['administratorFirstname'];
        $this->administratorLastname = $params['administratorLastname'];
        $this->administratorIELiasion = $params['administratorIELiasion'];
        $this->teacherFirstname = $params['teacherFirstname'];
        $this->teacherLastname = $params['teacherLastname'];
        $this->teacherIELiasion = $params['teacherIELiasion'];
        $this->paraprofessionalFirstname = $params['paraprofessionalFirstname'];
        $this->paraprofessionalLastname = $params['paraprofessionalLastname'];
        $this->paraprofessionalIELiasion = $params['paraprofessionalIELiasion'];
        $this->parentFirstname = $params['parentFirstname'];
        $this->parentLastname = $params['parentLastname'];
        $this->parentIELiasion = $params['parentIELiasion'];
        $this->communityMemberFirstname = $params['communityMemberFirstname'];
        $this->communityMemberLastname = $params['communityMemberLastname'];
        $this->communityMemberIELiasion = $params['communityMemberIELiasion'];
        $this->student1Firstname = $params['student1Firstname'];
        $this->student1Lastname = $params['student1Lastname'];
        $this->student1IELiasion = $params['student1IELiasion'];
        $this->student2Firstname = $params['student2Firstname'];
        $this->student2Lastname = $params['student2Lastname'];
        $this->student2IELiasion = $params['student2IELiasion'];
        $this->optional1Firstname = $params['optional1Firstname'];
        $this->optional1Lastname = $params['optional1Lastname'];
        $this->optional1IELiasion = $params['optional1IELiasion'];
        $this->optional2Firstname = $params['optional2Firstname'];
        $this->optional2Lastname = $params['optional2Lastname'];
        $this->optional2IELiasion = $params['optional2IELiasion'];
        $this->optional3Firstname = $params['optional3Firstname'];
        $this->optional3Lastname = $params['optional3Lastname'];
        $this->optional3IELiasion = $params['optional3IELiasion'];
        $this->optional4Firstname = $params['optional4Firstname'];
        $this->optional4Lastname = $params['optional4Lastname'];
        $this->optional4IELiasion = $params['optional4IELiasion'];
        $this->optional5Firstname = $params['optional5Firstname'];
        $this->optional5Lastname = $params['optional5Lastname'];
        $this->optional5IELiasion = $params['optional5IELiasion'];
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
        return ($this->administratorIELiasion === '1') ? true : false;
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
        return ($this->teacherIELiasion === '1') ? true : false;
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
        return ($this->paraprofessionalIELiasion === '1') ? true : false;
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
        return ($this->parentIELiasion === '1') ? true : false;
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
        return ($this->communityMemberIELiasion === '1') ? true : false;
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
        return ($this->student1IELiasion === '1') ? true : false;
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
        return ($this->student2IELiasion === '1') ? true : false;
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
        return ($this->optional1IELiasion === '1') ? true : false;
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
        return ($this->optional2IELiasion === '1') ? true : false;
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
        return ($this->optional3IELiasion === '1') ? true : false;
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
        return ($this->optional4IELiasion === '1') ? true : false;
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
        return ($this->optional5IELiasion === '1') ? true : false;
    }

    public function toWPPostArray() {
        $postArray = array(
            'ID'      => $this->ID,

            'post_type'    => 'scisTeam',
            'post_status'  => 'publish',

            'post_content' => $this->content,
            'post_title'   => $this->title,
            'post_excerpt' => $this->excerpt,

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
            $postID = $saveResult;

            WPCore::updatePostMeta($postID, 'administratorFirstname', $post['administratorFirstname']);
            WPCore::updatePostMeta($postID, 'administratorLastname', $post['administratorLastname']);
            WPCore::updatePostMeta($postID, 'administratorIELiasion', $post['administratorIELiasion']);

            WPCore::updatePostMeta($postID, 'teacherFirstname', $post['teacherFirstname']);
            WPCore::updatePostMeta($postID, 'teacherLastname', $post['teacherLastname']);
            WPCore::updatePostMeta($postID, 'teacherIELiasion', $post['teacherIELiasion']);

            WPCore::updatePostMeta($postID, 'paraprofessionalFirstname', $post['paraprofessionalFirstname']);
            WPCore::updatePostMeta($postID, 'paraprofessionalLastname', $post['paraprofessionalLastname']);
            WPCore::updatePostMeta($postID, 'paraprofessionalIELiasion', $post['paraprofessionalIELiasion']);

            WPCore::updatePostMeta($postID, 'parentFirstname', $post['parentFirstname']);
            WPCore::updatePostMeta($postID, 'parentLastname', $post['parentLastname']);
            WPCore::updatePostMeta($postID, 'parentIELiasion', $post['parentIELiasion']);

            WPCore::updatePostMeta($postID, 'communityMemberFirstname', $post['communityMemberFirstname']);
            WPCore::updatePostMeta($postID, 'communityMemberLastname', $post['communityMemberLastname']);
            WPCore::updatePostMeta($postID, 'communityMemberIELiasion', $post['communityMemberIELiasion']);

            WPCore::updatePostMeta($postID, 'student1Firstname', $post['student1Firstname']);
            WPCore::updatePostMeta($postID, 'student1Lastname', $post['student1Lastname']);
            WPCore::updatePostMeta($postID, 'student1IELiasion', $post['student1IELiasion']);

            WPCore::updatePostMeta($postID, 'student2Firstname', $post['student2Firstname']);
            WPCore::updatePostMeta($postID, 'student2Lastname', $post['student2Lastname']);
            WPCore::updatePostMeta($postID, 'student2IELiasion', $post['student2IELiasion']);

            WPCore::updatePostMeta($postID, 'optional1Firstname', $post['optional1Firstname']);
            WPCore::updatePostMeta($postID, 'optional1Lastname', $post['optional1Lastname']);
            WPCore::updatePostMeta($postID, 'optional1IELiasion', $post['optional1IELiasion']);

            WPCore::updatePostMeta($postID, 'optional2Firstname', $post['optional2Firstname']);
            WPCore::updatePostMeta($postID, 'optional2Lastname', $post['optional2Lastname']);
            WPCore::updatePostMeta($postID, 'optional2IELiasion', $post['optional2IELiasion']);

            WPCore::updatePostMeta($postID, 'optional3Firstname', $post['optional3Firstname']);
            WPCore::updatePostMeta($postID, 'optional3Lastname', $post['optional3Lastname']);
            WPCore::updatePostMeta($postID, 'optional3IELiasion', $post['optional3IELiasion']);

            WPCore::updatePostMeta($postID, 'optional4Firstname', $post['optional4Firstname']);
            WPCore::updatePostMeta($postID, 'optional4Lastname', $post['optional4Lastname']);
            WPCore::updatePostMeta($postID, 'optional4IELiasion', $post['optional4IELiasion']);

            WPCore::updatePostMeta($postID, 'optional5Firstname', $post['optional5Firstname']);
            WPCore::updatePostMeta($postID, 'optional5Lastname', $post['optional5Lastname']);
            WPCore::updatePostMeta($postID, 'optional5IELiasion', $post['optional5IELiasion']);
        }

        return true;
    }
}