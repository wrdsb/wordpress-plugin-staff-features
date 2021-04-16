<?php
namespace WRDSB\Staff\Modules\Codex\Model;
use WRDSB\Staff\Modules\WP\WPCore as WPCore;

use WRDSB\Staff\Modules\Codex\Model\CodexSearch as Search;

/**
 * Define the "SkinnerStudent" Model
 * *
 * @link       https://www.wrdsb.ca
 * @since      1.0.0
 *
 * @package    WRDSB_Staff
 * @subpackage WRDSB_Staff/Codex
 */
class SkinnerStudent implements \JsonSerializable {
    private $createdAt;
    private $updatedAt;
    private $deletedAt;
    private $deleted;

    private $id;
    private $changeDetectionHash;
    private $isSaved;

    private $email;
    private $username;
    private $studentNumber;

    private $firstName;
    private $lastName;
    private $fullName;
    private $sortableName;

    private $schoolCodes;

    private $grade;
    private $oyap;
    private $shsmSector;
    

    public function __construct(array $params = null) {
        $this->createdAt                 = $params['createdAt']           ?? '';
        $this->updatedAt                 = $params['updatedAt']           ?? '';
        $this->deletedAt                 = $params['deletedAt']           ?? '';
        $this->deleted                   = $params['deleted']             ?? false; 

        $this->id                        = $params['id']                  ?? '';
        $this->changeDetectionHash       = $params['changeDetectionHash'] ?? '';
        $this->isSaved                   = $params['isSaved']             ?? false;

        $this->email                     = $params['email']               ?? '';
        $this->username                  = $params['username']            ?? '';
        $this->studentNumber             = $params['studentNumber']       ?? '';

        $this->firstName                 = $params['firstName']           ?? '';
        $this->lastName                  = $params['lastName']            ?? '';
        $this->fullName                  = $params['fullName']            ?? '';
        $this->sortableName              = $params['sortableName']        ?? '';

        $this->schoolCodes               = $params['schoolCodes']         ?? array();

        $this->grade                     = $params['grade']               ?? '';
        $this->oyap                      = $params['oyap']                ?? '';
        $this->shsmSector                = $params['shsmSector']          ?? '';
    }

    public function jsonSerialize() {
        $vars = get_object_vars($this);
        return $vars;
    }

    /**
     * Returns the SkinnerStudent with the specified id.
     *
     * Examples:
     *     SkinnerStudent::get('1')    # get the SkinnerStudent with id '1'.
     *     SkinnerStudent::get('DFW')  # get the SkinnerStudent with id 'DFW'.
     *
     * @param string $id The id of the SkinnerStudent to be returned.
     * @return SkinnerStudent The SkinnerStudent whose id matches the id provided.
     */
    public static function get(string $id): self{
        $search = new Search(array(
            'dataType' => 'SkinnerStudent',
            'count'    => true,
            'top'      => 1,
            'search'   => "id eq {$id}"
        ));
        $search->search();

        if ($search->getState() === 'success') {
            $searchResults = $search->getResults();
            $searchRecord = json_decode(json_encode($searchResults[0]), true);
            $skinnerStudent = new self($searchRecord);

            $skinnerStudent->id = ($searchRecord->id) ? $searchRecord->id : '';
            $skinnerStudent->isSaved = true;

            return $skinnerStudent;

        } else {
            error_log($search->getError());
            $skinnerStudent = new self();
            $skinnerStudent->isSaved = false;
            return $skinnerStudent;
        }
    }


    /**
     * Returns an array of SkinnerStudent records matching the search criteria.
     *
     * Examples:
     *     SkinnerStudent::find(array('field' => 'firstName', 'value' => 'Susan'))
     *     Would return up to 10 Susans, Susannes, Suzans, Suzannes, etc.
     *
     * @param array $query The search field and its value.
     * @return array Array of SkinnerStudent objects.
     */
    public static function find(array $query) {
        $field = $query['field'];
        $value = $query['value'];

        $search = new Search(array(
            'dataType'     => 'SkinnerStudent',
            'count'        => true,
            'search'       => $value,
            'searchFields' => $field
        ));
        $search->suggest();

        if ($search->getState() === 'success') {
            $skinnerStudents = array();
            $searchResults = $search->getResults();

            foreach ($searchResults as $searchResult) {
                $searchRecord = json_decode(json_encode($searchResult, true));
                $skinnerStudent = new self($searchRecord);
                $skinnerStudent->id = ($searchRecord->id) ? $searchRecord->id : '';
                $skinnerStudent->isSaved = true;

                $skinnerStudents[] = $skinnerStudent;
            }

            return $skinnerStudents;

        } else {
            error_log($search->getError());
            $skinnerStudents = array();
            $skinnerStudent = new self();
            $skinnerStudent->isSaved = false;
            $skinnerStudents[] = $skinnerStudent;

            return $skinnerStudents;
        }
    }


    /**
     * Returns upto 15 SkinnerStudent records whose Field (partially) matches Value.
     *
     * Examples:
     *     SkinnerStudent::suggest(array('field' => 'firstName', 'value' => 'Susan'))
     *     Would return up to 10 Susans, Susannes, Suzans, Suzannes, etc.
     *
     * @param array $query The search field and its value.
     * @return array Array of SkinnerStudent objects.
     */
    public static function suggest(array $query) {
        $field = $query['field'];
        $value = $query['value'];

        $search = new Search(array(
            'dataType'     => 'SkinnerStudent',
            'count'        => true,
            'fuzzy'        => true,
            'top'          => 15,
            'search'       => $value,
            'searchFields' => $field
        ));
        $search->suggest();

        if ($search->getState() === 'success') {
            $skinnerStudents = array();
            $searchResults = $search->getResults();

            foreach ($searchResults as $searchResult) {
                $searchRecord = (array) json_decode(json_encode($searchResult, true));
                $skinnerStudent = new self($searchRecord);
                $skinnerStudent->id = ($searchRecord['id']) ? $searchRecord['id'] : '';
                $skinnerStudent->isSaved = true;

                $skinnerStudents[] = $skinnerStudent;
            }

            return $skinnerStudents;

        } else {
            error_log($search->getError());
            $skinnerStudents = array();
            $skinnerStudent = new self();
            $skinnerStudent->isSaved = false;
            $skinnerStudents[] = $skinnerStudent;

            return $skinnerStudents;
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
    public function setID(string $id): void {
        $this->id = $id;
    }

    public function getChangeDetectionHash(): string {
        return $this->changeDetectionHash;
    }

    public function getIsSaved(): bool {
        return $this->isSaved;
    }

    public function getEmail(): string {
        return $this->email;
    }
    public function setEmail(string $email): void {
        $this->email = $email;
    }

    public function getUsername(): string {
        return $this->username;
    }
    public function setUsername(string $username): void {
        $this->username = $username;
    }

    public function getStudentNumber(): string {
        return $this->studentNumber;
    }
    public function setStudentNumber(string $studentNumber): void {
        $this->studentNumber = $studentNumber;
    }

    public function getFirstName(): string {
        return $this->firstName;
    }
    public function setFirstName(string $firstName): void {
        $this->firstName = $firstName;
    }

    public function getLastName(): string {
        return $this->lastName;
    }
    public function setLastName(string $lastName): void {
        $this->lastName = $lastName;
    }

    public function getFullName(): string {
        return $this->fullName;
    }
    public function setFullName(string $fullName): void {
        $this->fullName = $fullName;
    }

    public function getSortableName(): string {
        return $this->sortableName;
    }
    public function setSortableName(string $sortableName): void {
        $this->sortableName = $sortableName;
    }

    public function getSchoolCodes(): array {
        return $this->schoolCodes;
    }
    public function setSchoolCodes(array $schoolCodes): void {
        $this->schoolCodes = $schoolCodes;
    }

    public function getGrade(): string {
        return $this->grade;
    }
    public function setGrade(string $grade): void {
        $this->grade = $grade;
    }

    public function getOYAP(): string {
        return $this->oyap;
    }
    public function setOYAP(string $oyap): void {
        $this->oyap = $oyap;
    }

    public function getSHSMSector(): string {
        return $this->shsmSector;
    }
    public function setSHSMSector(string $shsmSector): void {
        $this->shsmSector = $shsmSector;
    }
}