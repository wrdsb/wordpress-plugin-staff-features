<?php
namespace WRDSB\Staff\Modules\SchoolData\Model;
use WRDSB\Staff\Modules\WP\WPCore as WPCore;

/**
 * Define and register class for posts of type "emergencyResponseTeam"
 * *
 * @link       https://www.wrdsb.ca
 * @since      1.0.0
 *
 * @package    Staff Features
 * @subpackage School Data
 */

class EmergencyResponseTeam {
    private $ID;
    private $content;
    private $title;
    private $excerpt;

    private $firstname1;
    private $lastname1;
    private $cprExpiry1;
    private $firstAidExpiry1;
    private $bmsExpiry1;
    private $firstname2;
    private $lastname2;
    private $cprExpiry2;
    private $firstAidExpiry2;
    private $bmsExpiry2;
    private $firstname3;
    private $lastname3;
    private $cprExpiry3;
    private $firstAidExpiry3;
    private $bmsExpiry3;
    private $firstname4;
    private $lastname4;
    private $cprExpiry4;
    private $firstAidExpiry4;
    private $bmsExpiry4;
    private $firstname5;
    private $lastname5;
    private $cprExpiry5;
    private $firstAidExpiry5;
    private $bmsExpiry5;
    private $firstname6;
    private $lastname6;
    private $cprExpiry6;
    private $firstAidExpiry6;
    private $bmsExpiry6;
    private $firstname7;
    private $lastname7;
    private $cprExpiry7;
    private $firstAidExpiry7;
    private $bmsExpiry7;
    private $firstname8;
    private $lastname8;
    private $cprExpiry8;
    private $firstAidExpiry8;
    private $bmsExpiry8;
    private $firstname9;
    private $lastname9;
    private $cprExpiry9;
    private $firstAidExpiry9;
    private $bmsExpiry9;
    private $firstname10;
    private $lastname10;
    private $cprExpiry10;
    private $firstAidExpiry10;
    private $bmsExpiry10;
    private $firstname11;
    private $lastname11;
    private $cprExpiry11;
    private $firstAidExpiry11;
    private $bmsExpiry11;
    private $firstname12;
    private $lastname12;
    private $cprExpiry12;
    private $firstAidExpiry12;
    private $bmsExpiry12;

    public static function getInstance() {
        $args = array(
            'post_type' => 'emergencyResponseTeam',
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

            'firstname1' => $postRequest['firstname1'],
            'lastname1' => $postRequest['lastname1'],
            'cprExpiry1' => $postRequest['cprExpiry1'],
            'firstAidExpiry1' => $postRequest['firstAidExpiry1'],
            'bmsExpiry1' => $postRequest['bmsExpiry1'],
            'firstname2' => $postRequest['firstname2'],
            'lastname2' => $postRequest['lastname2'],
            'cprExpiry2' => $postRequest['cprExpiry2'],
            'firstAidExpiry2' => $postRequest['firstAidExpiry2'],
            'bmsExpiry2' => $postRequest['bmsExpiry2'],
            'firstname3' => $postRequest['firstname3'],
            'lastname3' => $postRequest['lastname3'],
            'cprExpiry3' => $postRequest['cprExpiry3'],
            'firstAidExpiry3' => $postRequest['firstAidExpiry3'],
            'bmsExpiry3' => $postRequest['bmsExpiry3'],
            'firstname4' => $postRequest['firstname4'],
            'lastname4' => $postRequest['lastname4'],
            'cprExpiry4' => $postRequest['cprExpiry4'],
            'firstAidExpiry4' => $postRequest['firstAidExpiry4'],
            'bmsExpiry4' => $postRequest['bmsExpiry4'],
            'firstname5' => $postRequest['firstname5'],
            'lastname5' => $postRequest['lastname5'],
            'cprExpiry5' => $postRequest['cprExpiry5'],
            'firstAidExpiry5' => $postRequest['firstAidExpiry5'],
            'bmsExpiry5' => $postRequest['bmsExpiry5'],
            'firstname6' => $postRequest['firstname6'],
            'lastname6' => $postRequest['lastname6'],
            'cprExpiry6' => $postRequest['cprExpiry6'],
            'firstAidExpiry6' => $postRequest['firstAidExpiry6'],
            'bmsExpiry6' => $postRequest['bmsExpiry6'],
            'firstname7' => $postRequest['firstname7'],
            'lastname7' => $postRequest['lastname7'],
            'cprExpiry7' => $postRequest['cprExpiry7'],
            'firstAidExpiry7' => $postRequest['firstAidExpiry7'],
            'bmsExpiry7' => $postRequest['bmsExpiry7'],
            'firstname8' => $postRequest['firstname8'],
            'lastname8' => $postRequest['lastname8'],
            'cprExpiry8' => $postRequest['cprExpiry8'],
            'firstAidExpiry8' => $postRequest['firstAidExpiry8'],
            'bmsExpiry8' => $postRequest['bmsExpiry8'],
            'firstname9' => $postRequest['firstname9'],
            'lastname9' => $postRequest['lastname9'],
            'cprExpiry9' => $postRequest['cprExpiry9'],
            'firstAidExpiry9' => $postRequest['firstAidExpiry9'],
            'bmsExpiry9' => $postRequest['bmsExpiry9'],
            'firstname10' => $postRequest['firstname10'],
            'lastname10' => $postRequest['lastname10'],
            'cprExpiry10' => $postRequest['cprExpiry10'],
            'firstAidExpiry10' => $postRequest['firstAidExpiry10'],
            'bmsExpiry10' => $postRequest['bmsExpiry10'],
            'firstname11' => $postRequest['firstname11'],
            'lastname11' => $postRequest['lastname11'],
            'cprExpiry11' => $postRequest['cprExpiry11'],
            'firstAidExpiry11' => $postRequest['firstAidExpiry11'],
            'bmsExpiry11' => $postRequest['bmsExpiry11'],
            'firstname12' => $postRequest['firstname12'],
            'lastname12' => $postRequest['lastname12'],
            'cprExpiry12' => $postRequest['cprExpiry12'],
            'firstAidExpiry12' => $postRequest['firstAidExpiry12'],
            'bmsExpiry12' => $postRequest['bmsExpiry12'],
        );

        echo "<pre>";
        echo "from CPT";
        print_r($_POST);
        print_r($_REQUEST);
        print_r(self::getInstance());
        echo "</pre>";
    }

    private static function instantiate($post) {
        $instance = new EmergencyResponseTeam;

        $instance->ID      = $post->ID           ?? 0;
        $instance->content = $post->post_content ?? '';
        $instance->title   = $post->post_title   ?? '';
        $instance->excerpt = $post->post_excerpt ?? '';

        $instance->firstname1 = $post->firstname1 ?? '';
        $instance->lastname1 = $post->lastname1 ?? '';
        $instance->cprExpiry1 = $post->cprExpiry1 ?? '';
        $instance->firstAidExpiry1 = $post->firstAidExpiry1 ?? '';
        $instance->bmsExpiry1 = $post->bmsExpiry1 ?? '';
        $instance->firstname2 = $post->firstname2 ?? '';
        $instance->lastname2 = $post->lastname2 ?? '';
        $instance->cprExpiry2 = $post->cprExpiry2 ?? '';
        $instance->firstAidExpiry2 = $post->firstAidExpiry2 ?? '';
        $instance->bmsExpiry2 = $post->bmsExpiry2 ?? '';
        $instance->firstname3 = $post->firstname3 ?? '';
        $instance->lastname3 = $post->lastname3 ?? '';
        $instance->cprExpiry3 = $post->cprExpiry3 ?? '';
        $instance->firstAidExpiry3 = $post->firstAidExpiry3 ?? '';
        $instance->bmsExpiry3 = $post->bmsExpiry3 ?? '';
        $instance->firstname4 = $post->firstname4 ?? '';
        $instance->lastname4 = $post->lastname4 ?? '';
        $instance->cprExpiry4 = $post->cprExpiry4 ?? '';
        $instance->firstAidExpiry4 = $post->firstAidExpiry4 ?? '';
        $instance->bmsExpiry4 = $post->bmsExpiry4 ?? '';
        $instance->firstname5 = $post->firstname5 ?? '';
        $instance->lastname5 = $post->lastname5 ?? '';
        $instance->cprExpiry5 = $post->cprExpiry5 ?? '';
        $instance->firstAidExpiry5 = $post->firstAidExpiry5 ?? '';
        $instance->bmsExpiry5 = $post->bmsExpiry5 ?? '';
        $instance->firstname6 = $post->firstname6 ?? '';
        $instance->lastname6 = $post->lastname6 ?? '';
        $instance->cprExpiry6 = $post->cprExpiry6 ?? '';
        $instance->firstAidExpiry6 = $post->firstAidExpiry6 ?? '';
        $instance->bmsExpiry6 = $post->bmsExpiry6 ?? '';
        $instance->firstname7 = $post->firstname7 ?? '';
        $instance->lastname7 = $post->lastname7 ?? '';
        $instance->cprExpiry7 = $post->cprExpiry7 ?? '';
        $instance->firstAidExpiry7 = $post->firstAidExpiry7 ?? '';
        $instance->bmsExpiry7 = $post->bmsExpiry7 ?? '';
        $instance->firstname8 = $post->firstname8 ?? '';
        $instance->lastname8 = $post->lastname8 ?? '';
        $instance->cprExpiry8 = $post->cprExpiry8 ?? '';
        $instance->firstAidExpiry8 = $post->firstAidExpiry8 ?? '';
        $instance->bmsExpiry8 = $post->bmsExpiry8 ?? '';
        $instance->firstname9 = $post->firstname9 ?? '';
        $instance->lastname9 = $post->lastname9 ?? '';
        $instance->cprExpiry9 = $post->cprExpiry9 ?? '';
        $instance->firstAidExpiry9 = $post->firstAidExpiry9 ?? '';
        $instance->bmsExpiry9 = $post->bmsExpiry9 ?? '';
        $instance->firstname10 = $post->firstname10 ?? '';
        $instance->lastname10 = $post->lastname10 ?? '';
        $instance->cprExpiry10 = $post->cprExpiry10 ?? '';
        $instance->firstAidExpiry10 = $post->firstAidExpiry10 ?? '';
        $instance->bmsExpiry10 = $post->bmsExpiry10 ?? '';
        $instance->firstname11 = $post->firstname11 ?? '';
        $instance->lastname11 = $post->lastname11 ?? '';
        $instance->cprExpiry11 = $post->cprExpiry11 ?? '';
        $instance->firstAidExpiry11 = $post->firstAidExpiry11 ?? '';
        $instance->bmsExpiry11 = $post->bmsExpiry11 ?? '';
        $instance->firstname12 = $post->firstname12 ?? '';
        $instance->lastname12 = $post->lastname12 ?? '';
        $instance->cprExpiry12 = $post->cprExpiry12 ?? '';
        $instance->firstAidExpiry12 = $post->firstAidExpiry12 ?? '';
        $instance->bmsExpiry12 = $post->bmsExpiry12 ?? '';
    
        return $instance;
    }

    public function getID() {
        return $this->ID;
    }
    public function getFirstname1() {
        return $this->firstname1;
    }
    public function getLastname1() {
        return $this->lastname1;
    }
    public function getCPRExpiry1() {
        return $this->cprExpiry1;
    }
    public function getFirstAidExpiry1() {
        return $this->firstAidExpiry1;
    }
    public function getBMSExpiry1() {
        return $this->bmsExpiry1;
    }
    public function getFirstname2() {
        return $this->firstname2;
    }
    public function getLastname2() {
        return $this->lastname2;
    }
    public function getCPRExpiry2() {
        return $this->cprExpiry2;
    }
    public function getFirstAidExpiry2() {
        return $this->firstAidExpiry2;
    }
    public function getBMSExpiry2() {
        return $this->bmsExpiry2;
    }
    public function getFirstname3() {
        return $this->firstname3;
    }
    public function getLastname3() {
        return $this->lastname3;
    }
    public function getCPRExpiry3() {
        return $this->cprExpiry3;
    }
    public function getFirstAidExpiry3() {
        return $this->firstAidExpiry3;
    }
    public function getBMSExpiry3() {
        return $this->bmsExpiry3;
    }
    public function getFirstname4() {
        return $this->firstname4;
    }
    public function getLastname4() {
        return $this->lastname4;
    }
    public function getCPRExpiry4() {
        return $this->cprExpiry4;
    }
    public function getFirstAidExpiry4() {
        return $this->firstAidExpiry4;
    }
    public function getBMSExpiry4() {
        return $this->bmsExpiry4;
    }
    public function getFirstname5() {
        return $this->firstname5;
    }
    public function getLastname5() {
        return $this->lastname5;
    }
    public function getCPRExpiry5() {
        return $this->cprExpiry5;
    }
    public function getFirstAidExpiry5() {
        return $this->firstAidExpiry5;
    }
    public function getBMSExpiry5() {
        return $this->bmsExpiry5;
    }
    public function getFirstname6() {
        return $this->firstname6;
    }
    public function getLastname6() {
        return $this->lastname6;
    }
    public function getCPRExpiry6() {
        return $this->cprExpiry6;
    }
    public function getFirstAidExpiry6() {
        return $this->firstAidExpiry6;
    }
    public function getBMSExpiry6() {
        return $this->bmsExpiry6;
    }
    public function getFirstname7() {
        return $this->firstname7;
    }
    public function getLastname7() {
        return $this->lastname7;
    }
    public function getCPRExpiry7() {
        return $this->cprExpiry7;
    }
    public function getFirstAidExpiry7() {
        return $this->firstAidExpiry7;
    }
    public function getBMSExpiry7() {
        return $this->bmsExpiry7;
    }
    public function getFirstname8() {
        return $this->firstname8;
    }
    public function getLastname8() {
        return $this->lastname8;
    }
    public function getCPRExpiry8() {
        return $this->cprExpiry8;
    }
    public function getFirstAidExpiry8() {
        return $this->firstAidExpiry8;
    }
    public function getBMSExpiry8() {
        return $this->bmsExpiry8;
    }
    public function getFirstname9() {
        return $this->firstname9;
    }
    public function getLastname9() {
        return $this->lastname9;
    }
    public function getCPRExpiry9() {
        return $this->cprExpiry9;
    }
    public function getFirstAidExpiry9() {
        return $this->firstAidExpiry9;
    }
    public function getBMSExpiry9() {
        return $this->bmsExpiry9;
    }
    public function getFirstname10() {
        return $this->firstname10;
    }
    public function getLastname10() {
        return $this->lastname10;
    }
    public function getCPRExpiry10() {
        return $this->cprExpiry10;
    }
    public function getFirstAidExpiry10() {
        return $this->firstAidExpiry10;
    }
    public function getBMSExpiry10() {
        return $this->bmsExpiry10;
    }
    public function getFirstname11() {
        return $this->firstname11;
    }
    public function getLastname11() {
        return $this->lastname11;
    }
    public function getCPRExpiry11() {
        return $this->cprExpiry11;
    }
    public function getFirstAidExpiry11() {
        return $this->firstAidExpiry11;
    }
    public function getBMSExpiry11() {
        return $this->bmsExpiry11;
    }
    public function getFirstname12() {
        return $this->firstname12;
    }
    public function getLastname12() {
        return $this->lastname12;
    }
    public function getCPRExpiry12() {
        return $this->cprExpiry12;
    }
    public function getFirstAidExpiry12() {
        return $this->firstAidExpiry12;
    }
    public function getBMSExpiry12() {
        return $this->bmsExpiry12;
    }

    public function toArray() {
        $postArray = array(
            'ID'      => $this->ID,
            'content' => $this->content,
            'title'   => $this->title,
            'excerpt' => $this->excerpt,

            'firstname1' => $this->firstname1,
            'lastname1' => $this->lastname1,
            'cprExpiry1' => $this->cprExpiry1,
            'firstAidExpiry1' => $this->firstAidExpiry1,
            'bmsExpiry1' => $this->bmsExpiry1,
            'firstname2' => $this->firstname2,
            'lastname2' => $this->lastname2,
            'cprExpiry2' => $this->cprExpiry2,
            'firstAidExpiry2' => $this->firstAidExpiry2,
            'bmsExpiry2' => $this->bmsExpiry2,
            'firstname3' => $this->firstname3,
            'lastname3' => $this->lastname3,
            'cprExpiry3' => $this->cprExpiry3,
            'firstAidExpiry3' => $this->firstAidExpiry3,
            'bmsExpiry3' => $this->bmsExpiry3,
            'firstname4' => $this->firstname4,
            'lastname4' => $this->lastname4,
            'cprExpiry4' => $this->cprExpiry4,
            'firstAidExpiry4' => $this->firstAidExpiry4,
            'bmsExpiry4' => $this->bmsExpiry4,
            'firstname5' => $this->firstname5,
            'lastname5' => $this->lastname5,
            'cprExpiry5' => $this->cprExpiry5,
            'firstAidExpiry5' => $this->firstAidExpiry5,
            'bmsExpiry5' => $this->bmsExpiry5,
            'firstname6' => $this->firstname6,
            'lastname6' => $this->lastname6,
            'cprExpiry6' => $this->cprExpiry6,
            'firstAidExpiry6' => $this->firstAidExpiry6,
            'bmsExpiry6' => $this->bmsExpiry6,
            'firstname7' => $this->firstname7,
            'lastname7' => $this->lastname7,
            'cprExpiry7' => $this->cprExpiry7,
            'firstAidExpiry7' => $this->firstAidExpiry7,
            'bmsExpiry7' => $this->bmsExpiry7,
            'firstname8' => $this->firstname8,
            'lastname8' => $this->lastname8,
            'cprExpiry8' => $this->cprExpiry8,
            'firstAidExpiry8' => $this->firstAidExpiry8,
            'bmsExpiry8' => $this->bmsExpiry8,
            'firstname9' => $this->firstname9,
            'lastname9' => $this->lastname9,
            'cprExpiry9' => $this->cprExpiry9,
            'firstAidExpiry9' => $this->firstAidExpiry9,
            'bmsExpiry9' => $this->bmsExpiry9,
            'firstname10' => $this->firstname10,
            'lastname10' => $this->lastname10,
            'cprExpiry10' => $this->cprExpiry10,
            'firstAidExpiry10' => $this->firstAidExpiry10,
            'bmsExpiry10' => $this->bmsExpiry10,
            'firstname11' => $this->firstname11,
            'lastname11' => $this->lastname11,
            'cprExpiry11' => $this->cprExpiry11,
            'firstAidExpiry11' => $this->firstAidExpiry11,
            'bmsExpiry11' => $this->bmsExpiry11,
            'firstname12' => $this->firstname12,
            'lastname12' => $this->lastname12,
            'cprExpiry12' => $this->cprExpiry12,
            'firstAidExpiry12' => $this->firstAidExpiry12,
            'bmsExpiry12' => $this->bmsExpiry12,
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

        if (isset($this->firstname1)) {
            WPCore::updatePostMeta($postID, 'firstname1', WPCore::sanitizeTextField($post['firstname1']));
        }
        if (isset($this->lastname1)) {
            WPCore::updatePostMeta($postID, 'lastname1', WPCore::sanitizeTextField($post['lastname1']));
        }
        if (isset($this->cprExpiry1)) {
            WPCore::updatePostMeta($postID, 'cprExpiry1', WPCore::sanitizeTextField($post['cprExpiry1']));
        }
        if (isset($this->firstAidExpiry1)) {
            WPCore::updatePostMeta($postID, 'firstAidExpiry1', WPCore::sanitizeTextField($post['firstAidExpiry1']));
        }
        if (isset($this->bmsExpiry1)) {
            WPCore::updatePostMeta($postID, 'bmsExpiry1', WPCore::sanitizeTextField($post['bmsExpiry1']));
        }

        if (isset($this->firstname2)) {
            WPCore::updatePostMeta($postID, 'firstname2', WPCore::sanitizeTextField($post['firstname2']));
        }
        if (isset($this->lastname2)) {
            WPCore::updatePostMeta($postID, 'lastname2', WPCore::sanitizeTextField($post['lastname2']));
        }
        if (isset($this->cprExpiry2)) {
            WPCore::updatePostMeta($postID, 'cprExpiry2', WPCore::sanitizeTextField($post['cprExpiry2']));
        }
        if (isset($this->firstAidExpiry2)) {
            WPCore::updatePostMeta($postID, 'firstAidExpiry2', WPCore::sanitizeTextField($post['firstAidExpiry2']));
        }
        if (isset($this->bmsExpiry2)) {
            WPCore::updatePostMeta($postID, 'bmsExpiry2', WPCore::sanitizeTextField($post['bmsExpiry2']));
        }

        if (isset($this->firstname3)) {
            WPCore::updatePostMeta($postID, 'firstname3', WPCore::sanitizeTextField($post['firstname3']));
        }
        if (isset($this->lastname3)) {
            WPCore::updatePostMeta($postID, 'lastname3', WPCore::sanitizeTextField($post['lastname3']));
        }
        if (isset($this->cprExpiry3)) {
            WPCore::updatePostMeta($postID, 'cprExpiry3', WPCore::sanitizeTextField($post['cprExpiry3']));
        }
        if (isset($this->firstAidExpiry3)) {
            WPCore::updatePostMeta($postID, 'firstAidExpiry3', WPCore::sanitizeTextField($post['firstAidExpiry3']));
        }
        if (isset($this->bmsExpiry3)) {
            WPCore::updatePostMeta($postID, 'bmsExpiry3', WPCore::sanitizeTextField($post['bmsExpiry3']));
        }

        if (isset($this->firstname4)) {
            WPCore::updatePostMeta($postID, 'firstname4', WPCore::sanitizeTextField($post['firstname4']));
        }
        if (isset($this->lastname4)) {
            WPCore::updatePostMeta($postID, 'lastname4', WPCore::sanitizeTextField($post['lastname4']));
        }
        if (isset($this->cprExpiry4)) {
            WPCore::updatePostMeta($postID, 'cprExpiry4', WPCore::sanitizeTextField($post['cprExpiry4']));
        }
        if (isset($this->firstAidExpiry4)) {
            WPCore::updatePostMeta($postID, 'firstAidExpiry4', WPCore::sanitizeTextField($post['firstAidExpiry4']));
        }
        if (isset($this->bmsExpiry4)) {
            WPCore::updatePostMeta($postID, 'bmsExpiry4', WPCore::sanitizeTextField($post['bmsExpiry4']));
        }

        if (isset($this->firstname5)) {
            WPCore::updatePostMeta($postID, 'firstname5', WPCore::sanitizeTextField($post['firstname5']));
        }
        if (isset($this->lastname5)) {
            WPCore::updatePostMeta($postID, 'lastname5', WPCore::sanitizeTextField($post['lastname5']));
        }
        if (isset($this->cprExpiry5)) {
            WPCore::updatePostMeta($postID, 'cprExpiry5', WPCore::sanitizeTextField($post['cprExpiry5']));
        }
        if (isset($this->firstAidExpiry5)) {
            WPCore::updatePostMeta($postID, 'firstAidExpiry5', WPCore::sanitizeTextField($post['firstAidExpiry5']));
        }
        if (isset($this->bmsExpiry5)) {
            WPCore::updatePostMeta($postID, 'bmsExpiry5', WPCore::sanitizeTextField($post['bmsExpiry5']));
        }

        if (isset($this->firstname6)) {
            WPCore::updatePostMeta($postID, 'firstname6', WPCore::sanitizeTextField($post['firstname6']));
        }
        if (isset($this->lastname6)) {
            WPCore::updatePostMeta($postID, 'lastname6', WPCore::sanitizeTextField($post['lastname6']));
        }
        if (isset($this->cprExpiry6)) {
            WPCore::updatePostMeta($postID, 'cprExpiry6', WPCore::sanitizeTextField($post['cprExpiry6']));
        }
        if (isset($this->firstAidExpiry6)) {
            WPCore::updatePostMeta($postID, 'firstAidExpiry6', WPCore::sanitizeTextField($post['firstAidExpiry6']));
        }
        if (isset($this->bmsExpiry6)) {
            WPCore::updatePostMeta($postID, 'bmsExpiry6', WPCore::sanitizeTextField($post['bmsExpiry6']));
        }

        if (isset($this->firstname7)) {
            WPCore::updatePostMeta($postID, 'firstname7', WPCore::sanitizeTextField($post['firstname7']));
        }
        if (isset($this->lastname7)) {
            WPCore::updatePostMeta($postID, 'lastname7', WPCore::sanitizeTextField($post['lastname7']));
        }
        if (isset($this->cprExpiry7)) {
            WPCore::updatePostMeta($postID, 'cprExpiry7', WPCore::sanitizeTextField($post['cprExpiry7']));
        }
        if (isset($this->firstAidExpiry7)) {
            WPCore::updatePostMeta($postID, 'firstAidExpiry7', WPCore::sanitizeTextField($post['firstAidExpiry7']));
        }
        if (isset($this->bmsExpiry7)) {
            WPCore::updatePostMeta($postID, 'bmsExpiry7', WPCore::sanitizeTextField($post['bmsExpiry7']));
        }

        if (isset($this->firstname8)) {
            WPCore::updatePostMeta($postID, 'firstname8', WPCore::sanitizeTextField($post['firstname8']));
        }
        if (isset($this->lastname8)) {
            WPCore::updatePostMeta($postID, 'lastname8', WPCore::sanitizeTextField($post['lastname8']));
        }
        if (isset($this->cprExpiry8)) {
            WPCore::updatePostMeta($postID, 'cprExpiry8', WPCore::sanitizeTextField($post['cprExpiry8']));
        }
        if (isset($this->firstAidExpiry8)) {
            WPCore::updatePostMeta($postID, 'firstAidExpiry8', WPCore::sanitizeTextField($post['firstAidExpiry8']));
        }
        if (isset($this->bmsExpiry8)) {
            WPCore::updatePostMeta($postID, 'bmsExpiry8', WPCore::sanitizeTextField($post['bmsExpiry8']));
        }

        if (isset($this->firstname9)) {
            WPCore::updatePostMeta($postID, 'firstname9', WPCore::sanitizeTextField($post['firstname9']));
        }
        if (isset($this->lastname9)) {
            WPCore::updatePostMeta($postID, 'lastname9', WPCore::sanitizeTextField($post['lastname9']));
        }
        if (isset($this->cprExpiry9)) {
            WPCore::updatePostMeta($postID, 'cprExpiry9', WPCore::sanitizeTextField($post['cprExpiry9']));
        }
        if (isset($this->firstAidExpiry9)) {
            WPCore::updatePostMeta($postID, 'firstAidExpiry9', WPCore::sanitizeTextField($post['firstAidExpiry9']));
        }
        if (isset($this->bmsExpiry9)) {
            WPCore::updatePostMeta($postID, 'bmsExpiry9', WPCore::sanitizeTextField($post['bmsExpiry9']));
        }

        if (isset($this->firstname10)) {
            WPCore::updatePostMeta($postID, 'firstname10', WPCore::sanitizeTextField($post['firstname10']));
        }
        if (isset($this->lastname10)) {
            WPCore::updatePostMeta($postID, 'lastname10', WPCore::sanitizeTextField($post['lastname10']));
        }
        if (isset($this->cprExpiry10)) {
            WPCore::updatePostMeta($postID, 'cprExpiry10', WPCore::sanitizeTextField($post['cprExpiry10']));
        }
        if (isset($this->firstAidExpiry10)) {
            WPCore::updatePostMeta($postID, 'firstAidExpiry10', WPCore::sanitizeTextField($post['firstAidExpiry10']));
        }
        if (isset($this->bmsExpiry10)) {
            WPCore::updatePostMeta($postID, 'bmsExpiry10', WPCore::sanitizeTextField($post['bmsExpiry10']));
        }

        if (isset($this->firstname11)) {
            WPCore::updatePostMeta($postID, 'firstname11', WPCore::sanitizeTextField($post['firstname11']));
        }
        if (isset($this->lastname11)) {
            WPCore::updatePostMeta($postID, 'lastname11', WPCore::sanitizeTextField($post['lastname11']));
        }
        if (isset($this->cprExpiry11)) {
            WPCore::updatePostMeta($postID, 'cprExpiry11', WPCore::sanitizeTextField($post['cprExpiry11']));
        }
        if (isset($this->firstAidExpiry11)) {
            WPCore::updatePostMeta($postID, 'firstAidExpiry11', WPCore::sanitizeTextField($post['firstAidExpiry11']));
        }
        if (isset($this->bmsExpiry11)) {
            WPCore::updatePostMeta($postID, 'bmsExpiry11', WPCore::sanitizeTextField($post['bmsExpiry11']));
        }

        if (isset($this->firstname12)) {
            WPCore::updatePostMeta($postID, 'firstname12', WPCore::sanitizeTextField($post['firstname12']));
        }
        if (isset($this->lastname12)) {
            WPCore::updatePostMeta($postID, 'lastname12', WPCore::sanitizeTextField($post['lastname12']));
        }
        if (isset($this->cprExpiry12)) {
            WPCore::updatePostMeta($postID, 'cprExpiry12', WPCore::sanitizeTextField($post['cprExpiry12']));
        }
        if (isset($this->firstAidExpiry12)) {
            WPCore::updatePostMeta($postID, 'firstAidExpiry12', WPCore::sanitizeTextField($post['firstAidExpiry12']));
        }
        if (isset($this->bmsExpiry12)) {
            WPCore::updatePostMeta($postID, 'bmsExpiry12', WPCore::sanitizeTextField($post['bmsExpiry12']));
        }
    }
}