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

    private $blogID;
    private $schoolCode;
    private $email;

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
            'post_type' => 'ert',
            'post_status' => 'publish',
            'posts_per_page' => 1,
            'orderby' => 'title',
            'order' => 'ASC',
        );

        $query = new \WP_Query($args);

        $postFromDB = $query->posts[0];
        $customFields = get_post_custom($postFromDB->ID);

        $postFromDB->firstname1 = $customFields['firstname1'][0];
        $postFromDB->lastname1 = $customFields['lastname1'][0];
        $postFromDB->cprExpiry1 = $customFields['cprExpiry1'][0];
        $postFromDB->firstAidExpiry1 = $customFields['firstAidExpiry1'][0];
        $postFromDB->bmsExpiry1 = $customFields['bmsExpiry1'][0];
        $postFromDB->firstname2 = $customFields['firstname2'][0];
        $postFromDB->lastname2 = $customFields['lastname2'][0];
        $postFromDB->cprExpiry2 = $customFields['cprExpiry2'][0];
        $postFromDB->firstAidExpiry2 = $customFields['firstAidExpiry2'][0];
        $postFromDB->bmsExpiry2 = $customFields['bmsExpiry2'][0];
        $postFromDB->firstname3 = $customFields['firstname3'][0];
        $postFromDB->lastname3 = $customFields['lastname3'][0];
        $postFromDB->cprExpiry3 = $customFields['cprExpiry3'][0];
        $postFromDB->firstAidExpiry3 = $customFields['firstAidExpiry3'][0];
        $postFromDB->bmsExpiry3 = $customFields['bmsExpiry3'][0];
        $postFromDB->firstname4 = $customFields['firstname4'][0];
        $postFromDB->lastname4 = $customFields['lastname4'][0];
        $postFromDB->cprExpiry4 = $customFields['cprExpiry4'][0];
        $postFromDB->firstAidExpiry4 = $customFields['firstAidExpiry4'][0];
        $postFromDB->bmsExpiry4 = $customFields['bmsExpiry4'][0];
        $postFromDB->firstname5 = $customFields['firstname5'][0];
        $postFromDB->lastname5 = $customFields['lastname5'][0];
        $postFromDB->cprExpiry5 = $customFields['cprExpiry5'][0];
        $postFromDB->firstAidExpiry5 = $customFields['firstAidExpiry5'][0];
        $postFromDB->bmsExpiry5 = $customFields['bmsExpiry5'][0];
        $postFromDB->firstname6 = $customFields['firstname6'][0];
        $postFromDB->lastname6 = $customFields['lastname6'][0];
        $postFromDB->cprExpiry6 = $customFields['cprExpiry6'][0];
        $postFromDB->firstAidExpiry6 = $customFields['firstAidExpiry6'][0];
        $postFromDB->bmsExpiry6 = $customFields['bmsExpiry6'][0];
        $postFromDB->firstname7 = $customFields['firstname7'][0];
        $postFromDB->lastname7 = $customFields['lastname7'][0];
        $postFromDB->cprExpiry7 = $customFields['cprExpiry7'][0];
        $postFromDB->firstAidExpiry7 = $customFields['firstAidExpiry7'][0];
        $postFromDB->bmsExpiry7 = $customFields['bmsExpiry7'][0];
        $postFromDB->firstname8 = $customFields['firstname8'][0];
        $postFromDB->lastname8 = $customFields['lastname8'][0];
        $postFromDB->cprExpiry8 = $customFields['cprExpiry8'][0];
        $postFromDB->firstAidExpiry8 = $customFields['firstAidExpiry8'][0];
        $postFromDB->bmsExpiry8 = $customFields['bmsExpiry8'][0];
        $postFromDB->firstname9 = $customFields['firstname9'][0];
        $postFromDB->lastname9 = $customFields['lastname9'][0];
        $postFromDB->cprExpiry9 = $customFields['cprExpiry9'][0];
        $postFromDB->firstAidExpiry9 = $customFields['firstAidExpiry9'][0];
        $postFromDB->bmsExpiry9 = $customFields['bmsExpiry9'][0];
        $postFromDB->firstname10 = $customFields['firstname10'][0];
        $postFromDB->lastname10 = $customFields['lastname10'][0];
        $postFromDB->cprExpiry10 = $customFields['cprExpiry10'][0];
        $postFromDB->firstAidExpiry10 = $customFields['firstAidExpiry10'][0];
        $postFromDB->bmsExpiry10 = $customFields['bmsExpiry10'][0];
        $postFromDB->firstname11 = $customFields['firstname11'][0];
        $postFromDB->lastname11 = $customFields['lastname11'][0];
        $postFromDB->cprExpiry11 = $customFields['cprExpiry11'][0];
        $postFromDB->firstAidExpiry11 = $customFields['firstAidExpiry11'][0];
        $postFromDB->bmsExpiry11 = $customFields['bmsExpiry11'][0];
        $postFromDB->firstname12 = $customFields['firstname12'][0];
        $postFromDB->lastname12 = $customFields['lastname12'][0];
        $postFromDB->cprExpiry12 = $customFields['cprExpiry12'][0];
        $postFromDB->firstAidExpiry12 = $customFields['firstAidExpiry12'][0];
        $postFromDB->bmsExpiry12 = $customFields['bmsExpiry12'][0];

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

        $instance = self::getInstance();

        $instance->title   = "{$postArray['schoolCode']} Emergency Response Team";
        $instance->content = $instance->content . "<br/>Updated by {$postArray['email']} at " . date('Y-m-d H:i:s');
        $instance->excerpt = "Last updated by {$postArray['email']} at " . date('Y-m-d H:i:s');

        $instance->blogID     = $postArray['blogID']     ?? $instance->blogID;
        $instance->schoolCode = $postArray['schoolCode'] ?? $instance->schoolCode;
        $instance->email      = $postArray['email']      ?? $instance->email;

        $instance->firstname1 = $postArray['firstname1'] ?? $instance->firstname1;
        $instance->lastname1 = $postArray['lastname1'] ?? $instance->lastname1;
        $instance->cprExpiry1 = $postArray['cprExpiry1'] ?? $instance->cprExpiry1;
        $instance->firstAidExpiry1 = $postArray['firstAidExpiry1'] ?? $instance->firstAidExpiry1;
        $instance->bmsExpiry1 = $postArray['bmsExpiry1'] ?? $instance->bmsExpiry1;
        $instance->firstname2 = $postArray['firstname2'] ?? $instance->firstname2;
        $instance->lastname2 = $postArray['lastname2'] ?? $instance->lastname2;
        $instance->cprExpiry2 = $postArray['cprExpiry2'] ?? $instance->cprExpiry2;
        $instance->firstAidExpiry2 = $postArray['firstAidExpiry2'] ?? $instance->firstAidExpiry2;
        $instance->bmsExpiry2 = $postArray['bmsExpiry2'] ?? $instance->bmsExpiry2;
        $instance->firstname3 = $postArray['firstname3'] ?? $instance->firstname3;
        $instance->lastname3 = $postArray['lastname3'] ?? $instance->lastname3;
        $instance->cprExpiry3 = $postArray['cprExpiry3'] ?? $instance->cprExpiry3;
        $instance->firstAidExpiry3 = $postArray['firstAidExpiry3'] ?? $instance->firstAidExpiry3;
        $instance->bmsExpiry3 = $postArray['bmsExpiry3'] ?? $instance->bmsExpiry3;
        $instance->firstname4 = $postArray['firstname4'] ?? $instance->firstname4;
        $instance->lastname4 = $postArray['lastname4'] ?? $instance->lastname4;
        $instance->cprExpiry4 = $postArray['cprExpiry4'] ?? $instance->cprExpiry4;
        $instance->firstAidExpiry4 = $postArray['firstAidExpiry4'] ?? $instance->firstAidExpiry4;
        $instance->bmsExpiry4 = $postArray['bmsExpiry4'] ?? $instance->bmsExpiry4;
        $instance->firstname5 = $postArray['firstname5'] ?? $instance->firstname5;
        $instance->lastname5 = $postArray['lastname5'] ?? $instance->lastname5;
        $instance->cprExpiry5 = $postArray['cprExpiry5'] ?? $instance->cprExpiry5;
        $instance->firstAidExpiry5 = $postArray['firstAidExpiry5'] ?? $instance->firstAidExpiry5;
        $instance->bmsExpiry5 = $postArray['bmsExpiry5'] ?? $instance->bmsExpiry5;
        $instance->firstname6 = $postArray['firstname6'] ?? $instance->firstname6;
        $instance->lastname6 = $postArray['lastname6'] ?? $instance->lastname6;
        $instance->cprExpiry6 = $postArray['cprExpiry6'] ?? $instance->cprExpiry6;
        $instance->firstAidExpiry6 = $postArray['firstAidExpiry6'] ?? $instance->firstAidExpiry6;
        $instance->bmsExpiry6 = $postArray['bmsExpiry6'] ?? $instance->bmsExpiry6;
        $instance->firstname7 = $postArray['firstname7'] ?? $instance->firstname7;
        $instance->lastname7 = $postArray['lastname7'] ?? $instance->lastname7;
        $instance->cprExpiry7 = $postArray['cprExpiry7'] ?? $instance->cprExpiry7;
        $instance->firstAidExpiry7 = $postArray['firstAidExpiry7'] ?? $instance->firstAidExpiry7;
        $instance->bmsExpiry7 = $postArray['bmsExpiry7'] ?? $instance->bmsExpiry7;
        $instance->firstname8 = $postArray['firstname8'] ?? $instance->firstname8;
        $instance->lastname8 = $postArray['lastname8'] ?? $instance->lastname8;
        $instance->cprExpiry8 = $postArray['cprExpiry8'] ?? $instance->cprExpiry8;
        $instance->firstAidExpiry8 = $postArray['firstAidExpiry8'] ?? $instance->firstAidExpiry8;
        $instance->bmsExpiry8 = $postArray['bmsExpiry8'] ?? $instance->bmsExpiry8;
        $instance->firstname9 = $postArray['firstname9'] ?? $instance->firstname9;
        $instance->lastname9 = $postArray['lastname9'] ?? $instance->lastname9;
        $instance->cprExpiry9 = $postArray['cprExpiry9'] ?? $instance->cprExpiry9;
        $instance->firstAidExpiry9 = $postArray['firstAidExpiry9'] ?? $instance->firstAidExpiry9;
        $instance->bmsExpiry9 = $postArray['bmsExpiry9'] ?? $instance->bmsExpiry9;
        $instance->firstname10 = $postArray['firstname10'] ?? $instance->firstname10;
        $instance->lastname10 = $postArray['lastname10'] ?? $instance->lastname10;
        $instance->cprExpiry10 = $postArray['cprExpiry10'] ?? $instance->cprExpiry10;
        $instance->firstAidExpiry10 = $postArray['firstAidExpiry10'] ?? $instance->firstAidExpiry10;
        $instance->bmsExpiry10 = $postArray['bmsExpiry10'] ?? $instance->bmsExpiry10;
        $instance->firstname11 = $postArray['firstname11'] ?? $instance->firstname11;
        $instance->lastname11 = $postArray['lastname11'] ?? $instance->lastname11;
        $instance->cprExpiry11 = $postArray['cprExpiry11'] ?? $instance->cprExpiry11;
        $instance->firstAidExpiry11 = $postArray['firstAidExpiry11'] ?? $instance->firstAidExpiry11;
        $instance->bmsExpiry11 = $postArray['bmsExpiry11'] ?? $instance->bmsExpiry11;
        $instance->firstname12 = $postArray['firstname12'] ?? $instance->firstname12;
        $instance->lastname12 = $postArray['lastname12'] ?? $instance->lastname12;
        $instance->cprExpiry12 = $postArray['cprExpiry12'] ?? $instance->cprExpiry12;
        $instance->firstAidExpiry12 = $postArray['firstAidExpiry12'] ?? $instance->firstAidExpiry12;
        $instance->bmsExpiry12 = $postArray['bmsExpiry12'] ?? $instance->bmsExpiry12;

        $saved = $instance->save();

        if ($saved) {
            WPCore::wpRedirect($wpRedirect);
        } else {

        }
    }

    private static function instantiate($post) {
        $instance = new EmergencyResponseTeam;

        $instance->ID      = $post->ID           ?? 0;
        $instance->content = $post->post_content ?? '';
        $instance->title   = $post->post_title   ?? '';
        $instance->excerpt = $post->post_excerpt ?? '';

        $instance->blogID     = $post->blogID ?? '';
        $instance->schoolCode = $post->schoolCode ?? '';
        $instance->email      = $post->email ?? '';

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

    public function toWPPostArray() {
        $postArray = array(
            'ID'      => $this->ID,

            'post_type'    => 'ert',
            'post_status'  => 'publish',

            'post_content' => $this->content,
            'post_title'   => $this->title,
            'post_excerpt' => $this->excerpt,

            'blogID'     => $this->blogID,
            'schoolCode' => $this->schoolCode,
            'email'      => $this->email,

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

            WPCore::updatePostMeta($postID, 'firstname1', $post['firstname1']);
            WPCore::updatePostMeta($postID, 'lastname1', $post['lastname1']);
            WPCore::updatePostMeta($postID, 'cprExpiry1', $post['cprExpiry1']);
            WPCore::updatePostMeta($postID, 'firstAidExpiry1', $post['firstAidExpiry1']);
            WPCore::updatePostMeta($postID, 'bmsExpiry1', $post['bmsExpiry1']);

            WPCore::updatePostMeta($postID, 'firstname2', $post['firstname2']);
            WPCore::updatePostMeta($postID, 'lastname2', $post['lastname2']);
            WPCore::updatePostMeta($postID, 'cprExpiry2', $post['cprExpiry2']);
            WPCore::updatePostMeta($postID, 'firstAidExpiry2', $post['firstAidExpiry2']);
            WPCore::updatePostMeta($postID, 'bmsExpiry2', $post['bmsExpiry2']);

            WPCore::updatePostMeta($postID, 'firstname3', $post['firstname3']);
            WPCore::updatePostMeta($postID, 'lastname3', $post['lastname3']);
            WPCore::updatePostMeta($postID, 'cprExpiry3', $post['cprExpiry3']);
            WPCore::updatePostMeta($postID, 'firstAidExpiry3', $post['firstAidExpiry3']);
            WPCore::updatePostMeta($postID, 'bmsExpiry3', $post['bmsExpiry3']);

            WPCore::updatePostMeta($postID, 'firstname4', $post['firstname4']);
            WPCore::updatePostMeta($postID, 'lastname4', $post['lastname4']);
            WPCore::updatePostMeta($postID, 'cprExpiry4', $post['cprExpiry4']);
            WPCore::updatePostMeta($postID, 'firstAidExpiry4', $post['firstAidExpiry4']);
            WPCore::updatePostMeta($postID, 'bmsExpiry4', $post['bmsExpiry4']);

            WPCore::updatePostMeta($postID, 'firstname5', $post['firstname5']);
            WPCore::updatePostMeta($postID, 'lastname5', $post['lastname5']);
            WPCore::updatePostMeta($postID, 'cprExpiry5', $post['cprExpiry5']);
            WPCore::updatePostMeta($postID, 'firstAidExpiry5', $post['firstAidExpiry5']);
            WPCore::updatePostMeta($postID, 'bmsExpiry5', $post['bmsExpiry5']);

            WPCore::updatePostMeta($postID, 'firstname6', $post['firstname6']);
            WPCore::updatePostMeta($postID, 'lastname6', $post['lastname6']);
            WPCore::updatePostMeta($postID, 'cprExpiry6', $post['cprExpiry6']);
            WPCore::updatePostMeta($postID, 'firstAidExpiry6', $post['firstAidExpiry6']);
            WPCore::updatePostMeta($postID, 'bmsExpiry6', $post['bmsExpiry6']);

            WPCore::updatePostMeta($postID, 'firstname7', $post['firstname7']);
            WPCore::updatePostMeta($postID, 'lastname7', $post['lastname7']);
            WPCore::updatePostMeta($postID, 'cprExpiry7', $post['cprExpiry7']);
            WPCore::updatePostMeta($postID, 'firstAidExpiry7', $post['firstAidExpiry7']);
            WPCore::updatePostMeta($postID, 'bmsExpiry7', $post['bmsExpiry7']);

            WPCore::updatePostMeta($postID, 'firstname8', $post['firstname8']);
            WPCore::updatePostMeta($postID, 'lastname8', $post['lastname8']);
            WPCore::updatePostMeta($postID, 'cprExpiry8', $post['cprExpiry8']);
            WPCore::updatePostMeta($postID, 'firstAidExpiry8', $post['firstAidExpiry8']);
            WPCore::updatePostMeta($postID, 'bmsExpiry8', $post['bmsExpiry8']);

            WPCore::updatePostMeta($postID, 'firstname9', $post['firstname9']);
            WPCore::updatePostMeta($postID, 'lastname9', $post['lastname9']);
            WPCore::updatePostMeta($postID, 'cprExpiry9', $post['cprExpiry9']);
            WPCore::updatePostMeta($postID, 'firstAidExpiry9', $post['firstAidExpiry9']);
            WPCore::updatePostMeta($postID, 'bmsExpiry9', $post['bmsExpiry9']);

            WPCore::updatePostMeta($postID, 'firstname10', $post['firstname10']);
            WPCore::updatePostMeta($postID, 'lastname10', $post['lastname10']);
            WPCore::updatePostMeta($postID, 'cprExpiry10', $post['cprExpiry10']);
            WPCore::updatePostMeta($postID, 'firstAidExpiry10', $post['firstAidExpiry10']);
            WPCore::updatePostMeta($postID, 'bmsExpiry10', $post['bmsExpiry10']);

            WPCore::updatePostMeta($postID, 'firstname11', $post['firstname11']);
            WPCore::updatePostMeta($postID, 'lastname11', $post['lastname11']);
            WPCore::updatePostMeta($postID, 'cprExpiry11', $post['cprExpiry11']);
            WPCore::updatePostMeta($postID, 'firstAidExpiry11', $post['firstAidExpiry11']);
            WPCore::updatePostMeta($postID, 'bmsExpiry11', $post['bmsExpiry11']);

            WPCore::updatePostMeta($postID, 'firstname12', $post['firstname12']);
            WPCore::updatePostMeta($postID, 'lastname12', $post['lastname12']);
            WPCore::updatePostMeta($postID, 'cprExpiry12', $post['cprExpiry12']);
            WPCore::updatePostMeta($postID, 'firstAidExpiry12', $post['firstAidExpiry12']);
            WPCore::updatePostMeta($postID, 'bmsExpiry12', $post['bmsExpiry12']);
        }

        return true;
    }
}