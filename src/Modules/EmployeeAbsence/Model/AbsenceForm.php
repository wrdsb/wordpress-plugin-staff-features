<?php
namespace WRDSB\Staff\Modules\EmployeeAbsence\Model;

use WRDSB\Staff\Modules\EmployeeAbsence\EmployeeAbsenceModule as Module;
use WRDSB\Staff\Modules\EmployeeAbsence\Services\AbsenceForm as Service;

use WRDSB\Staff\Modules\EmployeeAbsence\Model\AbsenceFormCollection as Collection;

/**
 * Define the "AbsenceForm" Model
 * *
 * @link       https://www.wrdsb.ca
 * @since      1.0.0
 *
 * @package    WRDSB_Staff
 * @subpackage WRDSB_Staff/EmployeeAbsence
 */

class AbsenceForm
{
    private $service;

    private $id;
    private $saved;
    private $dirty;

    private $action;
    private $processed;
    private $schoolCode;
    private $employeeEmail;
    private $employeeName;
    private $createdOn;
    private $absenceReason;
    private $ECJob;
    private $comments;
    private $absentOnDate;
    private $absentFromTime;
    private $absentToTime;
    private $lunch;
    private $courseCode1;
    private $roomNumber1;
    private $lessonPlansLocation1;
    private $medicalPlan1;
    private $medicalDetails1;
    private $safetyPlan1;
    private $safetyPlanDetails1;
    private $coverageFirstHalf1;
    private $coverageSecondHalf1;
    private $courseCode2;
    private $roomNumber2;
    private $lessonPlansLocation2;
    private $medicalPlan2;
    private $medicalDetails2;
    private $safetyPlan2;
    private $safetyPlanDetails2;
    private $coverageFirstHalf2;
    private $coverageSecondHalf2;
    private $courseCode3;
    private $roomNumber3;
    private $lessonPlansLocation3;
    private $medicalPlan3;
    private $medicalDetails3;
    private $safetyPlan3;
    private $safetyPlanDetails3;
    private $coverageFirstHalf3;
    private $coverageSecondHalf3;
    private $courseCode4;
    private $roomNumber4;
    private $lessonPlansLocation4;
    private $medicalPlan4;
    private $medicalDetails4;
    private $safetyPlan4;
    private $safetyPlanDetails4;
    private $coverageFirstHalf4;
    private $coverageSecondHalf4;

    private static function getService(): Service
    {
        return Module::getAbsenceFormService();
    }

    private static function init(array $args): self
    {

    }

    /**
     * Returns the AbsenceForm with the specified id.
     *
     * Examples:
     *     AbsenceForm::get('1')    # get the AbsenceForm with id '1'.
     *     AbsenceForm::get('DFW')  # get the AbsenceForm with id 'DFW'.
     *
     * @param string $id The id of the AbsenceForm to be returned.
     * @return AbsenceForm The AbenceForm whose id matches the id provided.
     */
    public static function get(string $id): self
    {
        $form = $service->fetch($id);
        return $form;
    }

    /**
     * Returns the first AbsenceForm matching the properties provided.
     *
     * In the case of multiple property arguments,
     * AbsenceForms are sorted by first argument, then second argument, etc.
     *
     * Examples:
     *     AbsenceForm::first(array('name' => 'Metro'))  # first matching record with the name 'Metro'
     *
     * @param array $args An associative array of property names and their values.
     * @return AbsenceForm The first AbenceForm found matching the arguments provided.
     */
    public static function first(array $args): self
    {
    }

    /**
     * Returns the last AbsenceForm matching the properties provided.
     *
     * In the case of multiple property arguments,
     * AbsenceForms are sorted by first argument, then second argument, etc.
     *
     * Examples:
     *     AbsenceForm::last(array('name' => 'Metro'))  # first matching record with the name 'Metro'
     *
     * @param array $args An associative array of property names and their values.
     * @return AbsenceForm The last AbenceForm found matching the arguments provided.
     */
    public static function last(array $args): self
    {
    }

    /**
     * Returns a collection of all AbsenceForm objects matching the properties provided.
     *
     * If no arguments are provided, a collection of all AbsenceForm objects are returned.
     *
     * Examples:
     *     AbsenceForm::all()                            # all AbsenceForms
     *     AbsenceForm::all(array('processed' => true))  # all AbsenceForms that are processed
     *
     * @param array $args An associative array of property names and their values.
     * @return AbsenceFormCollection A collection of all AbenceForms found matching the arguments provided.
     */
    public static function all(array $args = []): Collection
    {
    }

    /**
     * Instantiates a new AbsenceForm object and saves it in a single operation.
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
     * @return AbsenceForm
     */
    public static function create(array $args): self
    {
    }

    /**
     * Finds or creates the first AbsenceForm object matching the provided arguments.
     *
     * If you want to either find the first resource matching some given criteria or
     * just create that resource if it can’t be found, you can use firstOrCreate().
     *
     * @param array $args An associative array of property names and their values.
     * @return AbsenceForm
     */
    public static function firstOrCreate(array $args): self
    {
    }

    /**
     * Finds or instantiates (without saving) the first AbsenceForm object matching the provided arguments.
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
     * @return AbsenceForm
     */
    
    public static function firstOrNew(array $args): self
    {
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
     * @return AbsenceForm
     */
    public static function patch(array $args): self
    {
        $service = self::getService();

        return true;
    }

    /**
     * Marks a record as deleted.
     *
     * delete() will return true or false depending on whether the record is successfully deleted or not.
     * The deleted record remains in storage, but is marked as deleted and the deletion is timestamped.
     *
     * @return boolean
     */
    public static function delete(string $id): self
    {
        return true;
    }

    /**
     * Updates the AbsenceForm object's properties and persists those changes in one call.
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
     * Persists the current state of the AbsenceForm.
     *
     * The call to save() will return true if saving succeeds, or false in case something went wrong.
     *
     * @return boolean
     */
    //public function save(): bool
    //{
        //return true;
    //}

    /**
     * Marks a record as deleted.
     *
     * delete() will return true or false depending on whether the record is successfully deleted or not.
     * The deleted record remains in storage, but is marked as deleted and the deletion is timestamped.
     *
     * @return boolean
     */
    //public function delete()
    //{
        //$this->service->delete($this);
    //}

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

    const ABSENCE_TYPES = array(
        'A100 - Personal Illness',
        'A400 - Medical Appointment',
        'School Activity:Coaching (team)',
        'School Activity:Field Trip - not SHSM(destination)',
        'School Activity:Meeting (purpose)',
        'A315 - Personal Day',
        'A256 - Family Care (specify relationship (son, daughter, etc.))',
        'A280 - Bereavement Family (specify)',
        'A105 - Bereavement Other Teaching (Specify Relationship)',
        'A240 - Religious Days (Comment Required)',
        'A324 - SITE BASED DAY Math',
        'A325 - SITE BASED DAY Wellbeing',
        'A326 - SITE BASED DAY Pathways to Success',
        'A327 - SITE BASED DAY  French',
        'A276 - Staff Development (Board) (specify title, location, and SD #)',
        'A328 - Special Education PD',
        'A212 - Subject Association (specify subject)',
        'A321 - NTIP New Teacher',
        'A322 - NTIP Mentor',
        'A295 - Staff development (include Short Term Ed. Leave (STEL) # or Staff Development (SD) #)',
        'A241 - Third Party Billing (Comment Required)',
        'A244 - Severe Weather',
        'A231 - Graduation - Teaching (Specify Relationship)',
        'A410 - Unpaid Day',
        'A270 - Jury Duty/Witness',
        'A205 - Lieu of Overtime',
        'A228 - Admin/Fed Rep Meeting',
        'A268 - Birth/Adoption Day',
        'A341 - Health and Safety PD',
        'A336 - BMS Training',
        'A110 - Misc Exams - Teaching Staff',
        'A335 - Specialist High Skills Major',
        'A542 - Secondary High Skills Program',
        'Other (indicate reason)',
    );

    const LESSON_PLAN_LOCATIONS = array(
        'Main office',
        'Department desk',
        'Classroom desk',
        'Email to main office staff',
    );

    public function isProcessed(): bool
    {
        return $this->processed;
    }
    public function markProcessed(): bool
    {
        $this->processed = true;
        return $this->processed;
    }
    public function markUnprocessed(): bool
    {
        $this->processed = false;
        return $this->processed;
    }

    public function getID(): string
    {
        return $this->id;
    }
    public function setID(string $id)
    {
        $this->id = $id;
    }

    public function getAction(): string
    {
        return $this->action;
    }
    public function setAction(string $action)
    {
        $this->action = $action;
    }

    public function getSchoolCode(): string
    {
        return $this->schoolCode;
    }
    public function setSchoolCode(string $schoolCode)
    {
        $this->schoolCode = $schoolCode;
    }
    
    public function getEmployeeEmail(): string
    {
        return $this->employeeEmail;
    }
    public function setEmployeeEmail(string $email)
    {
        $this->employeeEmail = $email;
    }

    public function getEmployeeName(): string
    {
        return $this->employeeName;
    }
    public function setEmployeeName(string $employeeName)
    {
        $this->employeeName = $employeeName;
    }

    public function getCreatedOn(): string
    {
        return $this->createdOn;
    }
    public function setCreatedOn(string $date)
    {
        $this->createdOn = $date;
    }

    public function getAbsenceReason(): string
    {
        return $this->absenceReason;
    }
    public function setAbsenceReason(string $reason)
    {
        $this->absenceReason = $reason;
    }

    public function getECJob(): int
    {
        return $this->ECJob;
    }
    public function setECJob(int $ecJob)
    {
        $this->ECJob = $ecJob;
    }

    public function getComments(): string
    {
        return $this->comments;
    }
    public function setComments(string $comments)
    {
        $this->comments = $comments;
    }

    public function getAbsentOnDate(): string
    {
        return $this->absentOnDate;
    }
    public function setAbsentOnDate(string $absentOnDate)
    {
        $this->absentOnDate = $absentOnDate;
    }

    public function getAbsentFromTime(): string
    {
        return $this->absentFromTime;
    }
    public function setAbsentFromTime(string $absentFromTime)
    {
        $this->absentFromTime = $absentFromTime;
    }

    public function getAbsentToTime(): string
    {
        return $this->absentToTime;
    }
    public function setAbsentToTime(string $absentToTime)
    {
        $this->$absentToTime = $absentToTime;
    }

    public function getLunch(): bool
    {
        return $this->lunch;
    }
    public function setLunch(bool $lunch)
    {
        $this->lunch = $lunch;
    }

    public function getCourseCode1(): string
    {
        return $this->courseCode1;
    }
    public function setCourseCode1(string $courseCode1)
    {
        $this->courseCode1 = $courseCode1;
    }

    public function getRoomNumber1(): string
    {
        return $this->roomNumber1;
    }
    public function setRoomNumber1(string $roomNumber1)
    {
        $this->roomNumber1 = $roomNumber1;
    }

    public function getLessonPlansLocation1(): string
    {
        return $this->lessonPlansLocation1;
    }
    public function setLessonPlansLocation1(string $lessonPlansLocation1)
    {
        $this->lessonPlansLocation1 = $lessonPlansLocation1;
    }

    public function getMedicalPlan1(): bool
    {
        return $this->medicalPlan1;
    }
    public function setMedicalPlan1(bool $medicalPlan1)
    {
        $this->medicalPlan1 = $medicalPlan1;
    }

    public function getMedicalDetails1(): string
    {
        return $this->medicalDetails1;
    }
    public function setMedicalDetails1(string $medicalDetails1)
    {
        $this->medicalDetails1 = $medicalDetails1;
    }

    public function getSafetyPlan1(): bool
    {
        return $this->safetyPlan1;
    }
    public function setSafetyPlan1(bool $safetyPlan1)
    {
        $this->safetyPlan1 = $safetyPlan1;
    }

    public function getSafetyPlanDetails1(): string
    {
        return $this->safetyPlanDetails1;
    }
    public function setSafetyPlanDetails1(string $safetyPlanDetails1)
    {
        $this->safetyPlanDetails1 = $safetyPlanDetails1;
    }

    public function getCoverageFirstHalf1(): bool
    {
        return $this->coverageFirstHalf1;
    }
    public function setCoverageFirstHalf1(bool $coverageFirstHalf1)
    {
        $this->coverageFirstHalf1 = $coverageFirstHalf1;
    }

    public function getCoverageSecondHalf1(): bool
    {
        return $this->coverageSecondHalf1;
    }
    public function setCoverageSecondHalf1(bool $coverageSecondHalf1)
    {
        $this->coverageSecondHalf1 = $coverageSecondHalf1;
    }

    public function getCourseCode2(): string
    {
        return $this->courseCode2;
    }
    public function setCourseCode2(string $courseCode2)
    {
        $this->courseCode2 = $courseCode2;
    }

    public function getRoomNumber2(): string
    {
        return $this->roomNumber2;
    }
    public function setRoomNumber2(string $roomNumber2)
    {
        $this->roomNumber2 = $roomNumber2;
    }

    public function getLessonPlansLocation2(): string
    {
        return $this->lessonPlansLocation2;
    }
    public function setLessonPlansLocation2(string $lessonPlansLocation2)
    {
        $this->lessonPlansLocation2 = $lessonPlansLocation2;
    }

    public function getMedicalPlan2(): bool
    {
        return $this->medicalPlan2;
    }
    public function setMedicalPlan2(bool $medicalPlan2)
    {
        $this->medicalPlan2 = $medicalPlan2;
    }

    public function getMedicalDetails2(): string
    {
        return $this->medicalDetails2;
    }
    public function setMedicalDetails2(string $medicalDetails2)
    {
        $this->medicalDetails2 = $medicalDetails2;
    }

    public function getSafetyPlan2(): bool
    {
        return $this->safetyPlan2;
    }
    public function setSafetyPlan2(bool $safetyPlan2)
    {
        $this->safetyPlan2 = $safetyPlan2;
    }

    public function getSafetyPlanDetails2(): string
    {
        return $this->safetyPlanDetails2;
    }
    public function setSafetyPlanDetails2(string $safetyPlanDetails2)
    {
        $this->safetyPlanDetails2 = $safetyPlanDetails2;
    }

    public function getCoverageFirstHalf2(): bool
    {
        return $this->coverageFirstHalf2;
    }
    public function setCoverageFirstHalf2(bool $coverageFirstHalf2)
    {
        $this->coverageFirstHalf2 = $coverageFirstHalf2;
    }

    public function getCoverageSecondHalf2(): bool
    {
        return $this->coverageSecondHalf2;
    }
    public function setCoverageSecondHalf2(bool $coverageSecondHalf2)
    {
        $this->coverageSecondHalf2 = $coverageSecondHalf2;
    }

    public function getCourseCode3(): string
    {
        return $this->courseCode3;
    }
    public function setCourseCode3(string $courseCode3)
    {
        $this->courseCode3 = $courseCode3;
    }

    public function getRoomNumber3(): string
    {
        return $this->roomNumber3;
    }
    public function setRoomNumber3(string $roomNumber3)
    {
        $this->roomNumber3 = $roomNumber3;
    }

    public function getLessonPlansLocation3(): string
    {
        return $this->lessonPlansLocation3;
    }
    public function setLessonPlansLocation3(string $lessonPlansLocation3)
    {
        $this->lessonPlansLocation3 = $lessonPlansLocation3;
    }

    public function getMedicalPlan3(): bool
    {
        return $this->medicalPlan3;
    }
    public function setMedicalPlan3(bool $medicalPlan3)
    {
        $this->medicalPlan3 = $medicalPlan3;
    }

    public function getMedicalDetails3(): string
    {
        return $this->medicalDetails3;
    }
    public function setMedicalDetails3(string $medicalDetails3)
    {
        $this->medicalDetails3 = $medicalDetails3;
    }

    public function getSafetyPlan3(): bool
    {
        return $this->safetyPlan3;
    }
    public function setSafetyPlan3(bool $safetyPlan3)
    {
        $this->safetyPlan3 = $safetyPlan3;
    }

    public function getSafetyPlanDetails3(): string
    {
        return $this->safetyPlanDetails3;
    }
    public function setSafetyPlanDetails3(string $safetyPlanDetails3)
    {
        $this->safetyPlanDetails3 = $safetyPlanDetails3;
    }

    public function getCoverageFirstHalf3(): bool
    {
        return $this->coverageFirstHalf3;
    }
    public function setCoverageFirstHalf3(bool $coverageFirstHalf3)
    {
        $this->coverageFirstHalf3 = $coverageFirstHalf3;
    }

    public function getCoverageSecondHalf3(): bool
    {
        return $this->coverageSecondHalf3;
    }
    public function setCoverageSecondHalf3(bool $coverageSecondHalf3)
    {
        $this->coverageSecondHalf3 = $coverageSecondHalf3;
    }

    public function getCourseCode4(): string
    {
        return $this->courseCode4;
    }
    public function setCourseCode4(string $courseCode4)
    {
        $this->courseCode4 = $courseCode4;
    }

    public function getRoomNumber4(): string
    {
        return $this->roomNumber4;
    }
    public function setRoomNumber4(string $roomNumber4)
    {
        $this->roomNumber4 = $roomNumber4;
    }

    public function getLessonPlansLocation4(): string
    {
        return $this->lessonPlansLocation4;
    }
    public function setLessonPlansLocation4(string $lessonPlansLocation4)
    {
        $this->lessonPlansLocation4 = $lessonPlansLocation4;
    }

    public function getMedicalPlan4(): bool
    {
        return $this->medicalPlan4;
    }
    public function setMedicalPlan4(bool $medicalPlan4)
    {
        $this->medicalPlan4 = $medicalPlan4;
    }

    public function getMedicalDetails4(): string
    {
        return $this->medicalDetails4;
    }
    public function setMedicalDetails4(string $medicalDetails4)
    {
        $this->medicalDetails4 = $medicalDetails4;
    }

    public function getSafetyPlan4(): bool
    {
        return $this->safetyPlan4;
    }
    public function setSafetyPlan4(bool $safetyPlan4)
    {
        $this->safetyPlan4 = $safetyPlan4;
    }

    public function getSafetyPlanDetails4(): string
    {
        return $this->safetyPlanDetails4;
    }
    public function setSafetyPlanDetails4(string $safetyPlanDetails4)
    {
        $this->safetyPlanDetails4 = $safetyPlanDetails4;
    }

    public function getCoverageFirstHalf4(): bool
    {
        return $this->coverageFirstHalf4;
    }
    public function setCoverageFirstHalf4(bool $coverageFirstHalf4)
    {
        $this->coverageFirstHalf4 = $coverageFirstHalf4;
    }

    public function getCoverageSecondHalf4(): bool
    {
        return $this->coverageSecondHalf4;
    }
    public function setCoverageSecondHalf4(bool $coverageSecondHalf4)
    {
        $this->coverageSecondHalf4 = $coverageSecondHalf4;
    }
}
