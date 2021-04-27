<?php
namespace WRDSB\Staff\Modules\Quartermaster\Model;
use WRDSB\Staff\Modules\WP\WPCore as WPCore;

use WRDSB\Staff\Modules\Quartermaster\Model\QuartermasterCommand as Command;
use WRDSB\Staff\Modules\Quartermaster\Model\QuartermasterQuery as Query;

/**
 * Define the "AssetAssignment" Model
 * *
 * @link       https://www.wrdsb.ca
 * @since      1.0.0
 *
 * @package    WRDSB_Staff
 * @subpackage WRDSB_Staff/Quartermaster
 */

class AssetAssignment implements \JsonSerializable {
    private $databaseID;
    private $searchID;
    private $changeDetectionHash;

    private $createdAt;
    private $updatedAt;
    private $deletedAt;
    private $deleted;

    private $createdBy;
    private $updatedBy;
    private $deletedBy;

    private $assignedBy;
    private $assignedFromLocation;

    private $assetID;
    private $assetSerialNumber;
    private $assetType;
    private $assetLocation;

    private $assignedToPerson;
    private $assignedToPersonEmail;
    private $assignedToPersonNumber;
    private $assignedToPersonLocation;

    private $assignedToBusinessUnit;

    private $wasReceivedByAssignee;
    private $receivedBy;
    private $receivedByRole;

    private $isTemporary;
    private $startDate;
    private $endDate;

    private $wasReturned;
    private $returnedAt;
    private $returnedBy;

    private $untrackedAssestsIncluded;
    private $notes;
    

    public function __construct(array $params = null) {
        $this->databaseID               = $params['databaseID']          ?? '';
        $this->searchID                 = $params['searchID']            ?? '';
        $this->changeDetectionHash      = $params['changeDetectionHash'] ?? '';

        $this->createdAt                = $params['createdAt'] ?? '';
        $this->updatedAt                = $params['updatedAt'] ?? '';
        $this->deletedAt                = $params['deletedAt'] ?? '';
        $this->deleted                  = $params['deleted']   ?? false; 

        $this->createdBy                = $params['createdBy'] ?? '';
        $this->updatedBy                = $params['updatedBy'] ?? '';
        $this->deletedBy                = $params['deletedBy'] ?? '';

        $this->assignedBy               = $params['assignedBy'] ?? '';
        $this->assignedFromLocation     = $params['assignedFromLocation'] ?? '';
    
        $this->assetID                  = $params['assetID'] ?? '';
        $this->assetSerialNumber        = $params['assetSerialNumber'] ?? '';
        $this->assetType                = $params['assetType'] ?? '';
        $this->assetLocation            = $params['assetLocation'] ?? '';
    
        $this->assignedToPerson         = $params['assignedToPerson'] ?? '';
        $this->assignedToPersonEmail    = $params['assignedToPersonEmail'] ?? '';
        $this->assignedToPersonNumber   = $params['assignedToPersonNumber'] ?? '';
        $this->assignedToPersonLocation = $params['assignedToPersonLocation'] ?? '';
    
        $this->assignedToBusinessUnit   = $params['assignedToBusinessUnit'] ?? '';
    
        $this->wasReceivedByAssignee    = $params['wasReceivedByAssignee'] ?? true;
        $this->receivedBy               = $params['receivedBy'] ?? '';
        $this->receivedByRole           = $params['receivedByRole'] ?? '';
    
        $this->isTemporary              = $params['isTemporary'] ?? false;
        $this->startDate                = $params['startDate'] ?? '';
        $this->endDate                  = $params['endDate'] ?? '';
        
        $this->wasReturned              = $params['wasReturned'] ?? false;
        $this->returnedAt               = $params['returnedAt'] ?? '';
        $this->returnedBy               = $params['returnedBy'] ?? '';
    
        $this->untrackedAssestsIncluded = $params['untrackedAssestsIncluded'] ?? '';
        $this->notes                    = $params['notes'] ?? '';
    }

    public function jsonSerialize() {
        $vars = get_object_vars($this);
        return $vars;
    }

    /**
     * Returns the AssetAssignment with the specified searchID.
     *
     * Examples:
     *     AssetAssignment::getBySearchID('1')    # get the AssetAssignment with searchID '1'.
     *     AssetAssignment::getBySearchID('DFW')  # get the AssetAssignment with searchID 'DFW'.
     *
     * @param string $searchID The searchID of the AssetAssignment to be returned.
     * @return AssetAssignment The AssetAssignment whose searchID matches the searchID provided.
     */
    public static function getBySearchID(string $searchID): self {
        $query = new Query('AssetAssignment', 'get', array('id' => $searchID));
        $query->run();

        if ($query->getState() === 'success') {
            $record = $query->getResults();
            $recordArray = json_decode(json_encode($record), true);

            // manually set IDs so we don't blindly use the Base64 one from search
            $recordArray['searchID'] = $recordArray['id'];
            $recordArray['databaseID'] = base64_decode($recordArray['id']);
            unset($recordArray['id']);

            $response = new self($recordArray);

            return $response;

        } else {
            error_log($query->getError());
            $response = new self();
            return $response;
        }
    }

    /**
     * Returns the AssetAssignment with the specified databaseID.
     *
     * Examples:
     *     AssetAssignment::get('1')    # get the AssetAssignment with databaseID '1'.
     *     AssetAssignment::get('DFW')  # get the AssetAssignment with databaseID 'DFW'.
     *
     * @param string $searchID The databaseID of the AssetAssignment to be returned.
     * @return AssetAssignment The AssetAssignment whose databaseID matches the databaseID provided.
     */
    public static function getByDatabaseID(string $databaseID): self {
        $searchID = base64_encode($databaseID);

        $query = new Query('AssetAssignment', 'get', array('id' => $searchID));
        $query->run();

        if ($query->getState() === 'success') {
            $record = $query->getResults();
            $recordArray = json_decode(json_encode($record[0]), true);

            // manually set IDs so we don't blindly use the Base64 one from search
            $recordArray['searchID'] = $recordArray['id'];
            $recordArray['databaseID'] = base64_decode($recordArray['id']);
            unset($recordArray['id']);
            
            $response = new self($recordArray);

            return $response;

        } else {
            error_log($query->getError());
            $response = new self();
            return $response;
        }
    }

    /**
     * Instantiates a new AssetAssignment object and saves it in a single operation.
     *
     * If you want to create a new resource with some given attributes and then
     * save it all in one go, you can use the create() method.
     *
     * If the creation was successful, create() will return the newly created resource.
     * If it failed, it will return a new resource that is initialized with the given attributes
     * and possible default values declared for that resource, but that’s not yet saved.
     *
     * To find out wether the creation was successful or not, you can call isSaved() on
     * the returned resource. It will return true if the resource was successfully persisted,
     * or false otherwise.
     *
     * @param array $args An associative array of property names and their values.
     * @return Command
     */
    public static function create(self $assetAssignment): Command {
        $id = '';
        $recordArray = json_decode(json_encode($assetAssignment), true);
        unset($recordArray['id']);

        $command = new Command('AssetAssignment', 'create', $id, $recordArray);
        $command->run();

        if ($command->getState() === 'success') {
            return $command;
        } else {
            error_log($command);
            return $command;
        }
    }

    /**
     * Updates a record's properties and persists those changes in one call.
     *
     * If you want to update a resource with some given attributes and then
     * save it all in one go, you can use the update() method.
     *
     * If the update was successful, update() will return the updated resource.
     * If it failed, it will return a new resource that is initialized with the given attributes
     * and possible default values declared for that resource, but that’s not yet saved.
     *
     * To find out wether the update was successful or not, you can call isSaved() on
     * the returned resource. It will return true if the resource was successfully persisted,
     * or false otherwise.
     *
     * @param array $args An associative array of property names and their values.
     * @return Command
     */
    public static function patch(string $searchID, array $record): Command {
        $databaseID = base64_decode($searchID);
        $recordArray = $record;
        $recordArray['id'] = $databaseID;
        unset($recordArray['searchID']);
        unset($recordArray['databaseID']);

        $command = new Command('AssetAssignment', 'patch', $databaseID, $recordArray);
        $command->run();

        if ($command->getState() === 'success') {
            return $command;
        } else {
            error_log($command);
            return $command;
        }
    }

    /**
     * Marks a record as deleted.
     *
     * delete() will return true or false depending on whether the record is successfully deleted or not.
     * The deleted record remains in storage, but is marked as deleted and the deletion is timestamped.
     *
     * @return Command
     */
    public static function delete(string $searchID): Command {
        $databaseID = base64_decode($searchID);

        $command = new Command('AssetAssignment', 'delete', $databaseID);
        $command->run();

        if ($command->getState() === 'success') {
            return $command;
        } else {
            error_log($command);
            return $command;
        }
    }

    /**
     * Marks a record as deleted and saves record.
     *
     * markDeleted() will return true or false depending on whether the record is successfully deleted or not.
     * The deleted record remains in storage, but is marked as deleted and the deletion is timestamped.
     *
     * @return Command
     */
    public function markDeleted(): Command {
        $this->setDeleted();
        $this->databaseID = $this->databaseID ?? base64_decode($this->searchID);

        $command = new Command('AssetAssignment', 'delete', $this->databaseID);
        $command->run();

        if ($command->getState() === 'success') {
            return $command;
        } else {
            error_log($command);
            return $command;
        }
    }

    /**
     * Marks a record as undeleted and saves record.
     *
     * markUndeleted() will return true or false depending on whether the record is successfully undeleted or not.
     *
     * @return Command
     */
    public function markUndeleted(): Command {
        $this->setUndeleted();
        $this->databaseID = $this->databaseID ?? base64_decode($this->searchID);
        $recordArray = json_decode(json_encode($this), true);
        $recordArray['id'] = $this->databaseID;
        unset($recordArray['searchID']);
        unset($recordArray['databaseID']);

        $command = new Command('AssetAssignment', 'patch', $this->databaseID, $recordArray);
        $command->run();

        if ($command->getState() === 'success') {
            return $command;
        } else {
            error_log($command);
            return $command;
        }
    }

    /**
     * Marks a record as returned and saves record.
     *
     * markReturned() will return true or false depending on whether the record is successfully undeleted or not.
     *
     * @return Command
     */
    public function markReturned(): Command {
        $this->setReturned();
        $this->databaseID = $this->databaseID ?? base64_decode($this->searchID);
        $recordArray = json_decode(json_encode($this), true);
        $recordArray['id'] = $this->databaseID;
        unset($recordArray['searchID']);
        unset($recordArray['databaseID']);

        $command = new Command('AssetAssignment', 'patch', $this->databaseID, $recordArray);
        $command->run();

        if ($command->getState() === 'success') {
            return $command;
        } else {
            error_log($command);
            return $command;
        }
    }

    /**
     * Marks a record as unreturned and saves record.
     *
     * markUnreturned() will return true or false depending on whether the record is successfully undeleted or not.
     *
     * @return Command
     */
    public function markUnreturned(): Command {
        $this->setUnreturned();
        $this->databaseID = $this->databaseID ?? base64_decode($this->searchID);
        $recordArray = json_decode(json_encode($this), true);
        $recordArray['id'] = $this->databaseID;
        unset($recordArray['searchID']);
        unset($recordArray['databaseID']);

        $command = new Command('AssetAssignment', 'patch', $this->databaseID, $recordArray);
        $command->run();

        if ($command->getState() === 'success') {
            return $command;
        } else {
            error_log($command);
            return $command;
        }
    }

    public function fromJSON(string $jsonString) {
        $object = json_decode($jsonString, $assoc = false);

        foreach ($object as $property => $value) {
            $this->$property = $value;
        }
    }

    private function setDeleted() {
        $current_time = WPCore::currentTime();
        $this->deletedAt = $current_time;
        $this->deleted = true;
    }

    private function setUndeleted() {
        $this->deletedAt = '';
        $this->deleted = false;
    }

    private function setReturned() {
        $current_time = WPCore::currentTime();
        $this->returnedAt = $current_time;
        $this->wasReturned = true;
        $this->returnedBy = '';
    }

    private function setUnreturned() {
        $this->returnedAt = null;
        $this->wasReturned = false;
        $this->returnedBy = null;
    }

    public function isReturned(): bool {
        return $this->wasReturned;
    }

    public function getDatabaseID(): string {
        return $this->databaseID;
    }

    public function getSearchID(): string {
        return $this->searchID;
    }

    public function getChangeDetectionHash(): string {
        return $this->changeDetectionHash;
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

    public function getCreatedBy(): string {
        return $this->createdBy;
    }

    public function getUpdatedBy(): string {
        return $this->updatedBy;
    }

    public function getDeletedBy(): string {
        return $this->deletedBy;
    }

    public function getAssignedBy(): string {
        return $this->assignedBy;
    }
    
    public function getAssignedFromLocation(): string {
        return $this->assignedFromLocation;
    }
    
    public function getAssetID(): string {
        return $this->assetID;
    }

    public function getAssetSerialNumber(): string {
        return $this->assetSerialNumber;
    }

    public function getAssetType(): string {
        return $this->assetType;
    }

    public function getAssetLocation(): string {
        return $this->assetLocation;
    }

    public function getAssignedToPerson(): string {
        return $this->assignedToPerson;
    }

    public function getAssignedToPersonEmail(): string {
        return $this->assignedToPersonEmail;
    }

    public function getAssignedToPersonNumber(): string {
        return $this->assignedToPersonNumber;
    }

    public function getAssignedToPersonLocation(): string {
        return $this->assignedToPersonLocation;
    }

    public function assignedToBusinessUnit(): string {
        return $this->assignedToBusinessUnit;
    }

    public function getwasReceivedByAssignee(): bool {
        return $this->wasReceivedByAssignee;
    }

    public function getReceivedBy(): string {
        return $this->receivedBy;
    }

    public function getReceivedByRole(): string {
        return $this->receivedByRole;
    }

    public function getIsTemporary(): bool {
        return $this->isTemporary;
    }

    public function getStartDate(): string {
        return $this->startDate;
    }

    public function getEndDate(): string {
        return $this->endDate;
    }

    public function getWasReturned(): bool {
        return $this->wasReturned;
    }

    public function getReturnedAt(): string {
        return $this->returnedAt;
    }

    public function getReturnedBy(): string {
        return $this->returnedBy;
    }

    public function getUntrackedAssestsIncluded(): string {
        return $this->untrackedAssestsIncluded;
    }

    public function getNotes(): string {
        return $this->notes;
    }
}