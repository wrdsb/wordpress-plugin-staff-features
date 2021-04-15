<?php
namespace WRDSB\Staff\Modules\Codex\Model;
use WRDSB\Staff\Modules\WP\WPCore as WPCore;

use WRDSB\Staff\Modules\Codex\Model\CodexSearch as Search;

/**
 * Define the "TrilliumEnrolment" Model
 * *
 * @link       https://www.wrdsb.ca
 * @since      1.0.0
 *
 * @package    WRDSB_Staff
 * @subpackage WRDSB_Staff/Codex
 */
class TrilliumEnrolment {
    private $createdAt;
    private $updatedAt;
    private $deletedAt;
    private $deleted;

    private $id;
    private $changeDetectionHash;
    private $isSaved;

    private $classCode;
    private $schoolCode;

    private $studentEmail;
    private $studentFirstName;
    private $studentLastName;
    private $studentNumber;

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

        $this->class_code          = $params['class_code']           ?? '';
        $this->school_code         = $params['school_code']          ?? '';

        $this->student_email       = $params['student_email']        ?? '';
        $this->student_first_name  = $params['student_first_name']   ?? '';
        $this->student_last_name   = $params['student_last_name']    ?? '';
        $this->student_number      = $params['student_number']       ?? '';

        $this->teacher_ein         = $params['teacher_ein']          ?? '';
        $this->teacher_email       = $params['teacher_email']        ?? '';
    }

    public function jsonSerialize() {
        $vars = get_object_vars($this);
        return $vars;
    }

    /**
     * Returns the TrilliumEnrolment with the specified id.
     *
     * Examples:
     *     TrilliumEnrolment::get('1')    # get the TrilliumEnrolment with id '1'.
     *     TrilliumEnrolment::get('DFW')  # get the TrilliumEnrolment with id 'DFW'.
     *
     * @param string $id The id of the TrilliumEnrolment to be returned.
     * @return TrilliumEnrolment The TrilliumEnrolment whose id matches the id provided.
     */
    public static function get(string $id): self{
        $search = new Search(array(
            'dataType' => 'TrilliumEnrolment',
            'count'    => true,
            'top'      => 1,
            'search'   => "id eq {$id}"
        ));
        $search->search();

        if ($search->getState() === 'success') {
            $searchResults = $search->getResults();
            $searchRecord = json_decode(json_encode($searchResults[0]), true);
            $trilliumEnrolment = new self($searchRecord);

            $trilliumEnrolment->id = ($searchRecord->id) ? $searchRecord->id : '';
            $trilliumEnrolment->isSaved = true;

            return $trilliumEnrolment;

        } else {
            error_log($search->getError());
            $trilliumEnrolment = new self();
            $trilliumEnrolment->isSaved = false;
            return $trilliumEnrolment;
        }
    }

    /**
     * Returns an array of TrilliumEnrolment records matching the search criteria.
     *
     * Examples:
     *     TrilliumEnrolment::find(array('field' => 'classCode', 'value' => 'ENG'))
     *
     * @param array $query The search field and its value.
     * @return array Array of TrilliumEnrolment objects.
     */
    public static function find(array $query) {
        $field = $query['field'];
        $value = $query['value'];

        $search = new Search(array(
            'dataType'     => 'TrilliumEnrolment',
            'count'        => true,
            'search'       => $value,
            'searchFields' => $field
        ));
        $search->suggest();

        if ($search->getState() === 'success') {
            $trilliumEnrolments = array();
            $searchResults = $search->getResults();

            foreach ($searchResults as $searchResult) {
                $searchRecord = json_decode(json_encode($searchResult, true));
                $trilliumEnrolment = new self($searchRecord);
                $trilliumEnrolment->id = ($searchRecord->id) ? $searchRecord->id : '';
                $trilliumEnrolment->isSaved = true;

                $trilliumEnrolments[] = $trilliumEnrolment;
            }

            return $trilliumEnrolments;

        } else {
            error_log($search->getError());
            $trilliumEnrolments = array();
            $trilliumEnrolment = new self();
            $trilliumEnrolment->isSaved = false;
            $trilliumEnrolments[] = $trilliumEnrolment;

            return $trilliumEnrolments;
        }
    }

    /**
     * Returns upto 15 TrilliumEnrolment records whose Field (partially) matches Value.
     *
     * Examples:
     *     TrilliumEnrolment::suggest(array('field' => 'classCode', 'value' => 'ENG'))
     *     Would return up to 10 ENG TrilliumEnrolments
     *
     * @param array $query The search field and its value.
     * @return array Array of TrilliumEnrolment objects.
     */
    public static function suggest(array $query) {
        $field = $query['field'];
        $value = $query['value'];

        $search = new Search(array(
            'dataType'     => 'TrilliumEnrolment',
            'count'        => true,
            'fuzzy'        => true,
            'top'          => 15,
            'search'       => $value,
            'searchFields' => $field
        ));
        $search->suggest();

        if ($search->getState() === 'success') {
            $trilliumEnrolments = array();
            $searchResults = $search->getResults();

            foreach ($searchResults as $searchResult) {
                $searchRecord = (array) json_decode(json_encode($searchResult, true));
                $trilliumEnrolment = new self($searchRecord);
                $trilliumEnrolment->id = ($searchRecord['id']) ? $searchRecord['id'] : '';
                $trilliumEnrolment->isSaved = true;

                $trilliumEnrolments[] = $trilliumEnrolment;
            }

            return $trilliumEnrolments;

        } else {
            error_log($search->getError());
            $trilliumEnrolments = array();
            $trilliumEnrolment = new self();
            $trilliumEnrolment->isSaved = false;
            $trilliumClasses[] = $trilliumEnrolment;

            return $trilliumEnrolments;
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

    public function getStudentEmail(): string {
        return $this->studentEmail;
    }
    public function setStudentEmail(string $studentEmail): void {
        $this->studentEmail = $studentEmail;
    }

    public function getStudentFirstName(): string {
        return $this->studentFirstName;
    }
    public function setStudentFirstName(string $studentFirstName): void {
        $this->studentFirstName = $studentFirstName;
    }

    public function getStudentLastName(): string {
        return $this->studentLastName;
    }
    public function setStudentLastName(string $studentLastName): void {
        $this->studentLastName = $studentLastName;
    }

    public function getStudentNumber(): string {
        return $this->studentNumber;
    }
    public function setStudentNumber(string $studentNumber): void {
        $this->studentNumber = $studentNumber;
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
