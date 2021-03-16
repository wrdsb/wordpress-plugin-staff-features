<?php
namespace WRDSB\Staff\Modules\Quartermaster\Model;
use WRDSB\Staff\Modules\WP\WPCore as WPCore;

use WRDSB\Staff\Modules\Quartermaster\Model\QuartermasterSearch as Search;
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
    private $createdAt;
    private $updatedAt;
    private $deletedAt;
    private $deleted;

    private $createdBy;
    private $updatedBy;
    private $deletedBy;

    private $id;
    //private $saved;
    //private $dirty;
    private $changeDetectionHash;

    private $assetID;

    private $assignedBy;
    
    private $assignedToPerson;
    private $assignedToBusinessUnit;
    private $receivedBy;

    private $startDate;
    private $endDate;

    private $untrackedAssestsIncluded;
    private $notes;
    

    public function __construct() {
        $this->createdAt = '';
        $this->updatedAt = '';
        $this->deletedAt = '';
        $this->deleted = false;

        $this->createdBy = '';
        $this->updatedBy = '';
        $this->deletedBy = '';
    
        $this->id = '';
        //$this->saved = false;
        //$this->dirty = true;
        $this->changeDetectionHash = '';

        $this->assetID = '';
    
        $this->assignedBy = '';
        
        $this->assignedToPerson = '';
        $this->assignedToBusinessUnit = '';
        $this->receivedBy = '';
    
        $this->startDate = '';
        $this->endDate = '';
    
        $this->untrackedAssestsIncluded = '';
        $this->notes = '';
    }

    public function jsonSerialize() {
        $vars = get_object_vars($this);
        return $vars;
    }

    /**
     * Returns the AssetAssignment with the specified id.
     *
     * Examples:
     *     AssetAssignment::get('1')    # get the AssetAssignment with id '1'.
     *     AssetAssignment::get('DFW')  # get the AssetAssignment with id 'DFW'.
     *
     * @param string $id The id of the AssetAssignment to be returned.
     * @return AssetAssignment The AssetAssignment whose id matches the id provided.
     */
    public static function get(string $id): self{
        $query = new Query('AssetAssignment', $id);
        $query->run();

        if ($query->getState() === 'success') {
            $records = $query->getResults();
            $record = $records[0];
            $response = new self();

            $response->id = ($record->id) ? $record->id : '';

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
     * @return AssetAssignment
     */
    public static function patch(string $id, array $form): Command {
        $command = new Command('patch', $id, $form);
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
     * @return boolean
     */
    public static function delete(string $id): Command {
        $command = new Command('delete', $id);
        $command->run();

        if ($command->getState() === 'success') {
            return $command;
        } else {
            return $command;
        }
    }

    /**
     * Marks a record as deleted and saves record.
     *
     * markDeleted() will return true or false depending on whether the record is successfully deleted or not.
     * The deleted record remains in storage, but is marked as deleted and the deletion is timestamped.
     *
     * @return boolean
     */
    public function markDeleted(): bool {
        $this->setDeleted();

        $command = new Command('delete', $this->id);
        $command->run();

        if ($command->getState() === 'success') {
            //$this->dirty = false;
            return true;
        } else {
            //$this->dirty = true;
            return false;
        }
    }

    /**
     * Marks a record as undeleted and saves record.
     *
     * markUndeleted() will return true or false depending on whether the record is successfully undeleted or not.
     *
     * @return boolean
     */
    public function markUndeleted(): bool {
        $this->setUndeleted();
        
        $command = new Command('patch', $this->id);
        $command->run();

        if ($command->getState() === 'success') {
            //$this->dirty = false;
            return true;
        } else {
            //$this->dirty = true;
            return false;
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
        //$this->dirty = true;
    }

    private function setUndeleted() {
        $this->deletedAt = null;
        $this->deleted = false;
        //$this->dirty = true;
    }

    //public function getSaved(): string {
        //return $this->saved;
    //}
    //public function setSaved(bool $saved) {
        //$this->saved = $saved;
    //}
    //public function getDirty(): string {
        //return $this->dirty;
    //}
    //public function setDirty(bool $dirty) {
        //$this->dirty = $dirty;
    //}

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

    public function getCreatedBy(): string {
        return $this->createdBy;
    }

    public function getUpdatedBy(): string {
        return $this->updatedBy;
    }

    public function getDeletedBy(): string {
        return $this->deletedBy;
    }

    public function getID(): string {
        return $this->id;
    }
    public function setID(string $id) {
        $this->id = $id;
        //$this->dirty = true;
    }

    public function getChangeDetectionHash(): string {
        return $this->changeDetectionHash;
    }

    public function getAssetID(): string {
        return $this->assetID;
    }

    public function getAssignedBy(): string {
        return $this->assignedBy;
    }
    
    public function getAssignedToPerson(): string {
        return $this->assignedToPerson;
    }

    public function assignedToBusinessUnit(): string {
        return $this->assignedToBusinessUnit;
    }

    public function getReceivedBy(): string {
        return $this->receivedBy;
    }

    public function getStartDate(): string {
        return $this->startDate;
    }

    public function getEndDate(): string {
        return $this->endDate;
    }

    public function getUntrackedAssestsIncluded(): string {
        return $this->untrackedAssestsIncluded;
    }

    public function getNotes(): string {
        return $this->notes;
    }
}