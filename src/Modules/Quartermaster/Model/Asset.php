<?php
namespace WRDSB\Staff\Modules\Quartermaster\Model;

use WRDSB\Staff\Modules\WP\WPCore as WPCore;
use WRDSB\Staff\Modules\Quartermaster\Model\QuartermasterCollection as Collection;

use WRDSB\Staff\Modules\Quartermaster\Model\QuartermasterSearch as Search;
use WRDSB\Staff\Modules\Quartermaster\Model\QuartermasterCommand as Command;
use WRDSB\Staff\Modules\Quartermaster\Model\QuartermasterQuery as Query;

/**
 * Define the "Asset" Model
 * *
 * @link       https://www.wrdsb.ca
 * @since      1.0.0
 *
 * @package    WRDSB_Staff
 * @subpackage WRDSB_Staff/Quartermaster
 */

class Asset implements \JsonSerializable
{
    private $id;

    private $saved;
    //private bool $dirty;

    private $createdAt;
    private $updatedAt;
    private $deletedAt;
    private $deleted;

    private $createdBy;
    private $updatedBy;
    private $deletedBy;

    private $changeDetectionHash;

    private $assetID;
    private $lifecycleState;

    private $isAllotted;

    private $personAllotmentID;
    private $allottedToPersonID;

    private $businessUnitAllotmentID;
    private $allottedToBusinessUnitID;

    private $programAllotmentID;
    private $allottedToProgramID;

    private $projectAllotmentID;
    private $allottedToProjectID;

    private $isAssigned;

    private $personAssignmentID;
    private $assignedToPersonID;

    private $businessUnitAssignmentID;
    private $assignedToBusinessUnitID;

    private $programAssignmentID;
    private $assignedToProgramID;

    private $projectAssignmentID;
    private $assignedToProjectID;

    private $wasPurchased;
    private $wasPrivatePurchase;
    private $wasDonated;
    private $wasUsed;

    private $wasReplacement;
    private $replacementID;
    private $isReplaceable;
    private $replaceableUntil;
    private $replaceableOn;
    private $wasReplaced;
    private $replacedID;

    private $purchaseOrderID;
    private $purchasedOn;
    private $receivedOn;
    private $commissionedOn;
    private $allottedOn;
    private $unallottedOn;
    private $assignedOn;
    private $unassignedOn;
    private $decommissionedOn;
    private $recycledOn;
    private $warrantyEndsOn;
    
    private $assetType;
    private $manufacturer;
    private $model;

    private $isSEA;
    private $seaType;

    private $serialNumber;
    private $macAddress;
    private $bitlockerID;
    private $tpmID;

    private $notes;
    
    public function __construct()
    {
    }

    public function jsonSerialize()
    {
        $vars = get_object_vars($this);
        return $vars;
    }

    /**
     * Returns the Asset with the specified id.
     *
     * Examples:
     *     Asset::get('1')    # get the Asset with id '1'.
     *     Asset::get('DFW')  # get the Asset with id 'DFW'.
     *
     * @param string $id The id of the Asset to be returned.
     * @return Asset The Asset whose id matches the id provided.
     */
    //public static function get(string $id): self
    //{
    //}

    /**
     * Returns the first Asset matching the properties provided.
     *
     * In the case of multiple property arguments,
     * Assets are sorted by first argument, then second argument, etc.
     *
     * Examples:
     *     Asset::first(array('name' => 'Metro'))  # first matching record with the name 'Metro'
     *
     * @param array $args An associative array of property names and their values.
     * @return Asset The first Asset found matching the arguments provided.
     */
    //public static function first(array $args): self
    //{
    //}

    /**
     * Returns the last Asset matching the properties provided.
     *
     * In the case of multiple property arguments,
     * Assets are sorted by first argument, then second argument, etc.
     *
     * Examples:
     *     Asset::last(array('name' => 'Metro'))  # first matching record with the name 'Metro'
     *
     * @param array $args An associative array of property names and their values.
     * @return Asset The last Asset found matching the arguments provided.
     */
    //public static function last(array $args): self
    //{
    //}

    /**
     * Returns a collection of all Asset objects matching the properties provided.
     *
     * If no arguments are provided, a collection of all Asset objects are returned.
     *
     * Examples:
     *     Asset::all()                            # all Assets
     *     Asset::all(array('processed' => true))  # all Assets that are processed
     *
     * @param array $args An associative array of property names and their values.
     * @return AssetCollection A collection of all Assets found matching the arguments provided.
     */
    //public static function all(array $args = []): Collection
    //{
    //}

    /**
     * Instantiates a new Asset object and saves it in a single operation.
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
     * @return Asset
     */
    //public static function create(array $args): self
    //{
    //}

    /**
     * Finds or creates the first Asset object matching the provided arguments.
     *
     * If you want to either find the first resource matching some given criteria or
     * just create that resource if it can’t be found, you can use firstOrCreate().
     *
     * @param array $args An associative array of property names and their values.
     * @return Asset
     */
    //public static function firstOrCreate(array $args): self
    //{
    //}

    /**
     * Finds or instantiates (without saving) the first Asset object matching the provided arguments.
     *
     * If you want to either find the first resource matching some given criteria or
     * instatiate that resource if it can’t be found, you can use firstOrNew().
     *
     * Just like create() has an accompanying firstOrCreate method, new() has its firstOrNew() counterpart as well.
     * The only difference with firstOrNew() is that it returns a new unsaved resource in case it couldn’t find
     * one for the given query criteria.
     *
     * Apart from that, firstOrNew() behaves just like firstOrCreate and accepts the same parameters.
     *
     * @param array $args An associative array of property names and their values.
     * @return Asset
     */
    //public static function firstOrNew(array $args): self
    //{
    //}

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
     * @return Asset
     */
    public static function patch(string $id, array $asset): Command
    {
        $command = new Command('patch', $id, $asset);
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
    public static function delete(string $id): Command
    {
        $command = new Command('delete', $id);
        $command->run();

        if ($command->getState() === 'success') {
            return $command;
        } else {
            return $command;
        }
    }

    /**
     * Updates the Asset object's properties and persists those changes in one call.
     *
     * update() will return true if the record saves and false if the save fails, exactly like the save() method.
     *
     * @param array $args An associative array of property names and their values.
     * @return boolean
     */
    //public function update(array $args): bool
    //{
        //return true;
    //}

    /**
     * Persists the current state of the Asset.
     *
     * The call to save() will return true if saving succeeds, or false in case something went wrong.
     *
     * @return boolean
     */
    //public function save(): bool
    //{
        //$command = new Command('patch', $this);
        //$command->run();

        //if ($command->getState() === 'success') {
            ////$this->dirty = false;
            //return true;
        //} else {
            //return false;
        //}
    //}

    /**
     * Marks a record as deleted and saves record.
     *
     * markDeleted() will return true or false depending on whether the record is successfully deleted or not.
     * The deleted record remains in storage, but is marked as deleted and the deletion is timestamped.
     *
     * @return boolean
     */
    public function markDeleted(): bool
    {
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
    public function markUndeleted(): bool
    {
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

    //You can also use #update to do mass updates on a model. In the previous examples we’ve used
    //DataMapper::Resource#update to update a single resource. We can also use DataMapper::Model#update which
    //is available as a class method on our models. Calling it will update all instances of the model
    //with the same values.
    //Zoo.update(:name => 'Funky Town Municipal Zoo')
    //This will set all Zoo instances’ name property to ‘Funky Town Municipal Zoo’.
    //Internally it does the equivalent of:
    //Zoo.all.update(:name => 'Funky Town Municipal Zoo')
    //This shows that actually, #update is also available on any DataMapper::Collection and performs a mass update
    //on that collection when being called. You typically retrieve a DataMapper::Collection from either
    //a call to SomeModel.all or a call to a relationship accessor for any 1:n or m:n relationship.
    //You can also use #destroy to do mass deletes on a model. In the previous examples we’ve used
    //DataMapper::Resource#destroy to destroy a single resource. We can also use DataMapper::Model#destroy
    //which is available as a class method on our models. Calling it will remove all instances of that model
    //from the repository.
    //This shows that actually, #destroy is also available on any DataMapper::Collection and performs a
    //mass delete on that collection when being called. You typically retrieve a DataMapper::Collection
    //from either a call to SomeModel.all or a call to a relationship accessor for any 1:n or m:n relationship.

    public function fromJSON(string $jsonString)
    {
        $object = json_decode($jsonString, $assoc = false);

        foreach ($object as $property => $value) {
            $this->$property = $value;
        }
    }

    private function setDeleted()
    {
        $current_time = WPCore::currentTime();
        $this->deletedAt = $current_time;
        $this->deleted = true;
        //$this->dirty = true;
    }

    private function setUndeleted()
    {
        $this->deletedAt = null;
        $this->deleted = false;
        //$this->dirty = true;
    }

    public function getID(): string
    {
        return $this->id;
    }
    public function setID(string $id)
    {
        $this->id = $id;
        //$this->dirty = true;
    }

    public function getDirty(): string
    {
        return $this->dirty;
    }
    public function setDirty(bool $dirty)
    {
        $this->dirty = $dirty;
    }

    public function getSchoolCode(): string
    {
        return $this->schoolCode;
    }
    public function setSchoolCode(string $schoolCode)
    {
        $this->schoolCode = $schoolCode;
        //$this->dirty = true;
    }
}
