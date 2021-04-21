<?php
namespace WRDSB\Staff\Modules\Quartermaster\Model;
use WRDSB\Staff\Modules\WP\WPCore as WPCore;

use WRDSB\Staff\Modules\Quartermaster\Model\QuartermasterCommand as Command;
use WRDSB\Staff\Modules\Quartermaster\Model\QuartermasterQuery as Query;

/**
 * Define the "DeviceLoanForm" Model
 * *
 * @link       https://www.wrdsb.ca
 * @since      1.0.0
 *
 * @package    WRDSB_Staff
 * @subpackage WRDSB_Staff/Quartermaster
 */

class DeviceLoanForm implements \JsonSerializable {
    private $id;

    private $createdAt;
    private $updatedAt;
    private $deletedAt;
    private $deleted;

    private $powerAppsId;
    private $changeDetectionHash;
    
    private $serialNumber;
    private $submittedAssetID;
    private $correctedAssetID;
    private $deviceType;
    private $deviceModel;

    private $locationName;
    private $locationCode;
    private $schoolCode;
    
    private $loanedBy;
    private $loanedToName;
    private $loanedToNumber;
    private $loanedToEmail;
    private $loanedToRole;
    private $receivedBy;
    private $receivedByRole;
    private $receivedByName;
    private $receivedByRelationship;
    
    private $isSEADevice;
    private $addedToSchoolInventory;
    private $peripheralsProvided;
    private $timestamp;
    private $notes;
    
    private $wasReturned;
    private $returnedAt;
    private $returnedBy;

    
    public function __construct(array $params = null) {
        $this->databaseID               = $params['databaseID']           ?? '';
        $this->searchID                 = $params['searchID']             ?? '';
        $this->powerAppsId              = $params['powerAppsId']          ?? '';
        $this->changeDetectionHash      = $params['changeDetectionHash']  ?? '';


        $this->createdAt                = $params['createdAt'] ?? '';
        $this->updatedAt                = $params['updatedAt'] ?? '';
        $this->deletedAt                = $params['deletedAt'] ?? '';
        $this->deleted                  = $params['deleted']   ?? false; 

        $this->serialNumber             = $params['serialNumber']      ?? '';
        $this->submittedAssetID         = $params['submittedAssetID']  ?? '';
        $this->correctedAssetID         = $params['correctedAssetID']  ?? '';
        $this->deviceType               = $params['deviceType']        ?? '';
        $this->deviceModel              = $params['deviceModel']       ?? '';

        $this->locationName             = $params['locationName']  ?? '';
        $this->locationCode             = $params['locationCode']  ?? '';
        $this->schoolCode               = $params['schoolCode']    ?? '';

        $this->loanedBy                 = $params['loanedBy']                ?? '';
        $this->loanedToName             = $params['loanedToName']            ?? '';
        $this->loanedToNumber           = $params['loanedToNumber']          ?? '';
        $this->loanedToEmail            = $params['loanedToEmail']           ?? '';
        $this->loanedToRole             = $params['loanedToRole']            ?? '';
        $this->receivedBy               = $params['receivedBy']              ?? '';
        $this->receivedByRole           = $params['receivedByRole']          ?? '';
        $this->receivedByName           = $params['receivedByName']          ?? '';
        $this->receivedByRelationship   = $params['receivedByRelationship']  ?? '';
    
        $this->isSEADevice              = $params['isSEADevice']             ?? false;
        $this->addedToSchoolInventory   = $params['addedToSchoolInventory']  ?? false;
        $this->peripheralsProvided      = $params['peripheralsProvided']     ?? '';
        $this->timestamp                = $params['timestamp']               ?? '';
        $this->notes                    = $params['notes']                   ?? '';

        $this->wasReturned              = $params['wasReturned']  ?? false;
        $this->returnedAt               = $params['returnedAt']   ?? '';
        $this->returnedBy               = $params['returnedBy']   ?? '';
    }

    public function jsonSerialize() {
        $vars = get_object_vars($this);
        return $vars;
    }

    /**
     * Returns the DeviceLoanForm with the specified searchID.
     *
     * Examples:
     *     DeviceLoanForm::getBySearchID('1')    # get the DeviceLoanForm with searchID '1'.
     *     DeviceLoanForm::getBySearchID('DFW')  # get the DeviceLoanForm with searchID 'DFW'.
     *
     * @param string $searchID The searchID of the DeviceLoanForm to be returned.
     * @return DeviceLoanForm The DeviceLoanForm whose searchID matches the searchID provided.
     */
    public static function getBySearchID(string $searchID): self{
        $query = new Query('DeviceLoan', 'get', array('id' => $searchID));
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
     * Returns the DeviceLoanForm with the specified databaseID.
     *
     * Examples:
     *     DeviceLoanForm::getByDatabaseID('1')    # get the DeviceLoanForm with databaseID '1'.
     *     DeviceLoanForm::getByDatabaseID('DFW')  # get the DeviceLoanForm with databaseID 'DFW'.
     *
     * @param string $databaseID The databaseID of the DeviceLoanForm to be returned.
     * @return DeviceLoanForm The DeviceLoanForm whose databaseID matches the databaseID provided.
     */
    public static function getByDatabaseID(string $databaseID): self{
        $query = new Query('DeviceLoan', 'get', array('id' => $databaseID));
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
     * @return DeviceLoanForm
     */
    public static function patch(string $searchID, self $record): Command {
        $databaseID = base64_decode($searchID);
        $recordArray = json_decode(json_encode($record), true);
        $recordArray['id'] = $databaseID;
        unset($recordArray['searchID']);
        unset($recordArray['databaseID']);

        $command = new Command('DeviceLoan', 'patch', $databaseID, $recordArray);
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

        $command = new Command('DeviceLoan', 'delete', $databaseID);
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

        $command = new Command('DeviceLoan', 'delete', $this->id);
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

        $command = new Command('DeviceLoan', 'patch', $this->databaseID, $recordArray);
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

        $command = new Command('DeviceLoan', 'patch', $this->databaseID, $recordArray);
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

        $command = new Command('DeviceLoan', 'patch', $this->databaseID, $recordArray);
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
        $this->deletedAt = null;
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

    public function getCreatedAt(): string {
        return $this->createdAt;
    }

    public function getUpdatedAt(): string {
        return $this->updatedAt;
    }

    public function getDeletedAt(): string {
        return $this->deletedAt;
    }

    public function getDeleted(): string {
        return $this->deleted;
    }

    public function getPowerAppsId(): string {
        return $this->powerAppsId;
    }

    public function getChangeDetectionHash(): string {
        return $this->changeDetectionHash;
    }

    public function getSerialNumber(): string {
        return $this->serialNumber;
    }

    public function getSubmittedAssetID(): string {
        return $this->submittedAssetID;
    }

    public function getCorrectedAssetID(): string {
        return $this->correctedAssetID;
    }

    public function getDeviceType(): string {
        return $this->deviceType;
    }

    public function getDeviceModel(): string {
        return $this->deviceModel;
    }

    public function getLocationName(): string {
        return $this->locationName;
    }

    public function getLocationCode(): string {
        return $this->locationCode;
    }

    public function getSchoolCode(): string {
        return $this->schoolCode;
    }
    public function setSchoolCode(string $schoolCode) {
        $this->schoolCode = $schoolCode;
    }

    public function getLoanedBy(): string {
        return $this->loanedBy;
    }

    public function getLoanedToName(): string {
        return $this->loanedToName;
    }

    public function getLoanedToNumber(): string {
        return $this->loanedToNumber;
    }

    public function getLoanedToEmail(): string {
        return $this->loanedToEmail;
    }

    public function getLoanedToRole(): string {
        return $this->loanedToRole;
    }

    public function getReceivedBy(): string {
        return $this->receivedBy;
    }

    public function getReceivedByRole(): string {
        return $this->receivedByRole;
    }

    public function getReceivedByName(): string {
        return $this->receivedByName;
    }

    public function getReceivedByRelationship(): string {
        return $this->receivedByRelationship;
    }

    public function getIsSEADevice(): string {
        return $this->isSEADevice;
    }

    public function getAddedToSchoolInventory(): string {
        return $this->addedToSchoolInventory;
    }

    public function getPeripheralsProvided(): string {
        return $this->peripheralsProvided;
    }

    public function getTimestamp(): string {
        return $this->timestamp;
    }

    public function getNotes(): string {
        return $this->notes;
    }

    public function getWasReturned(): string {
        return $this->wasReturned;
    }
    public function setWasReturned(bool $wasReturned) {
        $this->wasReturned= $wasReturned;
    }

    public function getReturnedAt(): string {
        return $this->returnedAt;
    }
    public function setReturnedAt(string $returnedAt) {
        $this->returnedAt = $returnedAt;
    }

    public function getReturnedBy(): string {
        return $this->returnedBy;
    }
    public function setReturnedBy(string $returnedBy) {
        $this->returnedBy = $returnedBy;
    }

}
