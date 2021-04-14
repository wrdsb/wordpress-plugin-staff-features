<?php
namespace WRDSB\Staff\Modules\Codex\Model;
use WRDSB\Staff\Modules\WP\WPCore as WPCore;

use WRDSB\Staff\Modules\Codex\Model\CodexSearch as Search;

/**
 * Define the "CodexPerson" Model
 * *
 * @link       https://www.wrdsb.ca
 * @since      1.0.0
 *
 * @package    WRDSB_Staff
 * @subpackage WRDSB_Staff/Codex
 */

class CodexPerson implements \JsonSerializable {
    private $createdAt;
    private $updatedAt;
    private $deletedAt;
    private $deleted;

    private $id;
    private $changeDetectionHash;
    private $isSaved;

    private $email;
    private $username;
    private $employeeID;
    private $ein;

    private $firstName;
    private $lastName;
    private $fullName;
    private $sortableName;

    private $locationCodes;
    private $schoolCodes;
    private $jobCodes;
    private $employeeGroupCodes;

    private $homeLocation;
    private $directory;
    private $phone;
    private $extension;
    private $mbxNumber;

    private $numberOfAssignments;
    private $numberOfActiveAssignments;
    private $assignments;


    public function __construct(array $params = null) {
        $this->createdAt                 = $params['createdAt'] ?? '';
        $this->updatedAt                 = $params['updatedAt'] ?? '';
        $this->deletedAt                 = $params['deletedAt'] ?? '';
        $this->deleted                   = $params['deleted']   ?? false; 

        $this->id                        = $params['id'] ?? '';
        $this->changeDetectionHash       = $params['changeDetectionHash'] ?? '';
        $this->isSaved                   = $params['isSaved'] ?? false;

        $this->email                     = $params['email'] ?? '';
        $this->username                  = $params['username'] ?? '';
        $this->employeeID                = $params['employeeID'] ?? '';
        $this->ein                       = $params['ein'] ?? '';

        $this->firstName                 = $params['firstName'] ?? '';
        $this->lastName                  = $params['lastName'] ?? '';
        $this->fullName                  = $params['fullName'] ?? '';
        $this->sortableName              = $params['sortableName'] ?? '';

        $this->locationCodes             = $params['locationCodes'] ?? array();
        $this->schoolCodes               = $params['schoolCodes'] ?? array();
        $this->jobCodes                  = $params['jobCodes'] ?? array();
        $this->employeeGroupCodes        = $params['employeeGroupCodes'] ?? array();

        $this->homeLocation              = $params['homeLocation'] ?? '';
        $this->directory                 = $params['directory'] ?? '';
        $this->phone                     = $params['phone'] ?? '';
        $this->extension                 = $params['extension'] ?? '';
        $this->mbxNumber                 = $params['mbxNumber'] ?? '';

        $this->numberOfAssignments       = $params['numberOfAssignments'] ?? 0;
        $this->numberOfActiveAssignments = $params['numberOfActiveAssignments'] ?? 0;
        $this->assignments               = $params['assignments'] ?? array();
    }

    public function jsonSerialize() {
        $vars = get_object_vars($this);
        return $vars;
    }

    /**
     * Returns the CodexPerson with the specified id.
     *
     * Examples:
     *     CodexPerson::get('1')    # get the CodexPerson with id '1'.
     *     CodexPerson::get('DFW')  # get the CodexPerson with id 'DFW'.
     *
     * @param string $id The id of the CodexPerson to be returned.
     * @return CodexPerson The CodexPerson whose id matches the id provided.
     */
    public static function get(string $id): self{
        $search = new Search(array(
            'dataType' => 'CodexPerson',
            'count'    => true,
            'top'      => 1,
            'search'   => "id eq {$id}"
        ));
        $search->search();

        if ($search->getState() === 'success') {
            $searchResults = $search->getResults();
            $searchRecord = json_decode(json_encode($searchResults[0]), true);
            $codexPerson = new self($searchRecord);

            $codexPerson->id = ($searchRecord->id) ? $searchRecord->id : '';
            $codexPerson->isSaved = true;

            return $codexPerson;

        } else {
            error_log($search->getError());
            $codexPerson = new self();
            $codexPerson->isSaved = false;
            return $codexPerson;
        }
    }


    /**
     * Returns an array of CodexPerson records matching the search criteria.
     *
     * Examples:
     *     CodexPerson::suggest(array('field' => 'firstName', 'value' => 'Susan'))
     *     Would return up to 10 Susans, Susannes, Suzans, Suzannes, etc.
     *
     * @param array $query The search field and its value.
     * @return array Array of CodexPerson objects.
     */
    public static function find(array $query) {
        $field = $query['field'];
        $value = $query['value'];

        $search = new Search(array(
            'dataType'     => 'CodexPerson',
            'count'        => true,
            'fuzzy'        => true,
            'top'          => 10,
            'search'       => $value,
            'searchFields' => $field
        ));
        $search->suggest();

        if ($search->getState() === 'success') {
            $codexPeople = array();
            $searchResults = $search->getResults();

            foreach ($searchResults as $searchResult) {
                $searchRecord = json_decode(json_encode($searchResult, true));
                $codexPerson = new self($searchRecord);
                $codexPerson->id = ($searchRecord->id) ? $searchRecord->id : '';
                $codexPerson->isSaved = true;

                $codexPeople[] = $codexPerson;
            }

            return $codexPeople;

        } else {
            error_log($search->getError());
            $codexPeople = array();
            $codexPerson = new self();
            $codexPerson->isSaved = false;
            $codexPeople[] = $codexPerson;

            return $codexPeople;
        }
    }


    /**
     * Returns upto 10 CodexPerson records whose Field (partially) matches Value.
     *
     * Examples:
     *     CodexPerson::suggest(array('field' => 'firstName', 'value' => 'Susan'))
     *     Would return up to 10 Susans, Susannes, Suzans, Suzannes, etc.
     *
     * @param array $query The search field and its value.
     * @return array Array of CodexPerson objects.
     */
    public static function suggest(array $query) {
        error_log('Model::suggest');
        $field = $query['field'];
        $value = $query['value'];

        $search = new Search(array(
            'dataType'     => 'CodexPerson',
            'count'        => true,
            'fuzzy'        => true,
            'top'          => 10,
            'search'       => $value,
            'searchFields' => $field
        ));
        $search->suggest();

        if ($search->getState() === 'success') {
            $codexPeople = array();
            $searchResults = $search->getResults();

            foreach ($searchResults as $searchResult) {
                $searchRecord = (array) json_decode(json_encode($searchResult, true));
                $codexPerson = new self($searchRecord);
                $codexPerson->id = ($searchRecord['id']) ? $searchRecord['id'] : '';
                $codexPerson->isSaved = true;

                $codexPeople[] = $codexPerson;
            }

            return $codexPeople;

        } else {
            error_log($search->getError());
            $codexPeople = array();
            $codexPerson = new self();
            $codexPerson->isSaved = false;
            $codexPeople[] = $codexPerson;

            return $codexPeople;
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

    public function getEmail(): string {
        return $this->email;
    }
    public function setEmail(string $email) {
        $this->email = $email;
    }

    public function getUsername(): string {
        return $this->username;
    }
    public function setUsername(string $username) {
        $this->username = $username;
    }

    public function getEmployeeID(): string {
        return $this->employeeID;
    }
    public function setEmployeeID(string $employeeID) {
        $this->employeeID = $employeeID;
    }

    public function getEIN(): string {
        return $this->ein;
    }
    public function setEIN(string $ein) {
        $this->ein = $ein;
    }

    public function getFirstName(): string {
        return $this->firstName;
    }
    public function setFirstName(string $firstName) {
        $this->firstName = $firstName;
    }

    public function getLastName(): string {
        return $this->lastName;
    }
    public function setLastName(string $lastName) {
        $this->lastName = $lastName;
    }

    public function getFullName(): string {
        return $this->fullName;
    }
    public function setFullName(string $fullName) {
        $this->fullName = $fullName;
    }

    public function getSortableName(): string {
        return $this->sortableName;
    }
    public function setSortableName(string $sortableName) {
        $this->sortableName = $sortableName;
    }

    public function getLocationCodes(): array {
        return $this->locationCodes;
    }
    public function setLocationCodes(array $locationCodes) {
        $this->locationCodes = $locationCodes;
    }

    public function getSchoolCodes(): array {
        return $this->schoolCodes;
    }
    public function setSchoolCodes(array $schoolCodes) {
        $this->schoolCodes = $schoolCodes;
    }

    public function getJobCodes(): array {
        return $this->jobCodes;
    }
    public function setJobCodes(array $jobCodes) {
        $this->jobCodes = $jobCodes;
    }

    public function getEmployeeGroupCodes(): array {
        return $this->employeeGroupCodes;
    }
    public function setEmployeeGroupCodes(array $employeeGroupCodes) {
        $this->employeeGroupCodes = $employeeGroupCodes;
    }

    public function getHomeLocation(): string {
        return $this->homeLocation;
    }
    public function setHomeLocation(string $homeLocation) {
        $this->homeLocation = $homeLocation;
    }

    public function getDirectory(): string {
        return $this->directory;
    }
    public function setDirectory(string $directory) {
        $this->directory = $directory;
    }

    public function getPhone(): string {
        return $this->phone;
    }
    public function setPhone(string $phone) {
        $this->phone = $phone;
    }

    public function getExtension(): string {
        return $this->extension;
    }
    public function setExtension(string $extension) {
        $this->extension = $extension;
    }

    public function getMBXNumber(): string {
        return $this->mbxNumber;
    }
    public function setMBXNumber(string $mbxNumber) {
        $this->mbxNumber = $mbxNumber;
    }

    public function getNumberOfAssignments(): int {
        return $this->numberOfAssignments;
    }
    public function setNumberOfAssignments(int $numberOfAssignments) {
        $this->numberOfAssignments = $numberOfAssignments;
    }

    public function getNumberOfActiveAssignments(): int {
        return $this->numberOfActiveAssignments;
    }
    public function setNumberOfActiveAssignments(int $numberOfActiveAssignments) {
        $this->numberOfActiveAssignments = $numberOfActiveAssignments;
    }

    public function getAssignments(): array {
        return $this->assignments;
    }
    public function setAssignments(array $assignments) {
        $this->assignments = $assignments;
    }
}