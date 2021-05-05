<?php
namespace WRDSB\Staff\Modules\Codex\Model;
use WRDSB\Staff\Modules\WP\WPCore as WPCore;

use WRDSB\Staff\Modules\Codex\Model\CodexSearch as Search;

/**
 * Define the "TrilliumClass" Model
 * *
 * @link       https://www.wrdsb.ca
 * @since      1.0.0
 *
 * @package    WRDSB_Staff
 * @subpackage WRDSB_Staff/Codex
 */
class TrilliumClass {
    private $createdAt;
    private $updatedAt;
    private $deletedAt;
    private $deleted;

    private $id;
    private $changeDetectionHash;
    private $isSaved;

    private $classCode;
    private $schoolCode;
    private $teacherEIN;
    private $teacherEmail;

    public function __construct(array $params = null) {
        $this->createdAt           = $params['createdAt']            ?? '';
        $this->updatedAt           = $params['updatedAt']            ?? '';
        $this->deletedAt           = $params['deletedAt']            ?? '';
        $this->deleted             = $params['deleted']              ?? false; 

        $this->id                  = $params['id']                   ?? '';
        $this->changeDetectionHash = $params['changeDetectionHash']  ?? '';
        $this->isSaved             = $params['isSaved']              ?? false;

        $this->classCode           = $params['class_code']           ?? '';
        $this->schoolCode          = $params['school_code']          ?? '';
        $this->teacherEIN          = $params['teacher_ein']          ?? '';
        $this->teacherEmail        = $params['teacher_email']        ?? '';
    }

    public function jsonSerialize() {
        $vars = get_object_vars($this);
        return $vars;
    }

    /**
     * Returns the TrilliumClass with the specified id.
     *
     * Examples:
     *     TrilliumClass::get('1')    # get the TrilliumClass with id '1'.
     *     TrilliumClass::get('DFW')  # get the TrilliumClass with id 'DFW'.
     *
     * @param string $id The id of the TrilliumClass to be returned.
     * @return TrilliumClass The TrilliumClass whose id matches the id provided.
     */
    public static function get(string $id): self{
        $search = new Search(array(
            'dataType' => 'TrilliumClass',
            'count'    => true,
            'top'      => 1,
            'search'   => "id eq {$id}"
        ));
        $search->search();

        if ($search->getState() === 'success') {
            $searchResults = $search->getResults();
            $searchRecord = json_decode(json_encode($searchResults[0]), true);
            $trilliumClass = new self($searchRecord);

            $trilliumClass->id = ($searchRecord->id) ? $searchRecord->id : '';
            $trilliumClass->isSaved = true;

            return $trilliumClass;

        } else {
            error_log($search->getError());
            $trilliumClass = new self();
            $trilliumClass->isSaved = false;
            return $trilliumClass;
        }
    }

    /**
     * Returns an array of TrilliumClass records matching the search criteria.
     *
     * Examples:
     *     TrilliumClass::find(array('field' => 'classCode', 'value' => 'ENG'))
     *
     * @param array $query The search field and its value.
     * @return array Array of TrilliumClass objects.
     */
    public static function find(array $query) {
        $field = $query['field'];
        $value = $query['value'];

        $search = new Search(array(
            'dataType'     => 'TrilliumClass',
            'count'        => true,
            'search'       => $value,
            'searchFields' => $field
        ));
        $search->suggest();

        if ($search->getState() === 'success') {
            $trilliumClasses = array();
            $searchResults = $search->getResults();

            foreach ($searchResults as $searchResult) {
                $searchRecord = json_decode(json_encode($searchResult, true));
                $trilliumClass = new self($searchRecord);
                $trilliumClass->id = ($searchRecord->id) ? $searchRecord->id : '';
                $trilliumClass->isSaved = true;

                $trilliumClasses[] = $trilliumClass;
            }

            return $trilliumClasses;

        } else {
            error_log($search->getError());
            $trilliumClasses = array();
            $trilliumClass = new self();
            $trilliumClass->isSaved = false;
            $trilliumClasses[] = $trilliumClass;

            return $trilliumClasses;
        }
    }

    /**
     * Returns upto 15 TrilliumClass records whose Field (partially) matches Value.
     *
     * Examples:
     *     TrilliumClass::suggest(array('field' => 'classCode', 'value' => 'ENG'))
     *     Would return up to 10 ENG classes
     *
     * @param array $query The search field and its value.
     * @return array Array of TrilliumClass objects.
     */
    public static function suggest(array $query) {
        $field = $query['field'];
        $value = $query['value'];

        $search = new Search(array(
            'dataType'     => 'TrilliumClass',
            'count'        => true,
            'fuzzy'        => true,
            'top'          => 15,
            'search'       => $value,
            'searchFields' => $field
        ));
        $search->suggest();

        if ($search->getState() === 'success') {
            $trilliumClasses = array();
            $searchResults = $search->getResults();

            foreach ($searchResults as $searchResult) {
                $searchRecord = (array) json_decode(json_encode($searchResult, true));
                $trilliumClass = new self($searchRecord);
                $trilliumClass->id = ($searchRecord['id']) ? $searchRecord['id'] : '';
                $trilliumClass->isSaved = true;

                $trilliumClasses[] = $trilliumClass;
            }

            return $trilliumClasses;

        } else {
            error_log($search->getError());
            $trilliumClasses = array();
            $trilliumClass = new self();
            $trilliumClass->isSaved = false;
            $trilliumClasses[] = $trilliumClass;

            return $trilliumClasses;
        }
    }

    public function fromJSON(string $jsonString) {
        $object = json_decode($jsonString, $assoc = false);

        foreach ($object as $property => $value) {
            $this->$property = $value;
        }
    }

    public function getCreatedAt(): string {
        return $this->createdAt;
    }

    public function getUpdatedAt(): string {
        return $this->updatedAt;
    }

    public function getDeletedAt(): string {
        return $this->deletedAt;
    }

    public function getDeleted(): bool {
        return $this->deleted;
    }

    public function getID(): string {
        return $this->id;
    }
    public function setID(string $id) {
        $this->id = $id;
    }

    public function getChangeDetectionHash(): string {
        return $this->changeDetectionHash;
    }

    public function getIsSaved(): bool {
        return $this->isSaved;
    }

    public function getClassCode(): string {
        return $this->classCode;
    }
    public function setClassCode(string $classCode): void {
        $this->classCode = $classCode;
    }

    public function getSchoolCode(): string {
        return $this->schoolCode;
    }
    public function setSchoolCode(string $schoolCode): void {
        $this->schoolCode = $schoolCode;
    }

    public function getTeacherEIN(): string {
        return $this->teacherEIN;
    }
    public function setTeacherEIN(string $teacherEIN): void {
        $this->teacherEIN = $teacherEIN;
    }

    public function getTeacherEmail(): string {
        return $this->teacherEmail;
    }
    public function setTeacherEmail(string $teacherEmail): void {
        $this->teacherEmail = $teacherEmail;
    }
}
