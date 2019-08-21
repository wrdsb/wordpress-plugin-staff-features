<?php
namespace WRDSB\Staff\Modules\EmployeeAbsence\Model;

/**
 * Define the "AbsenceSlot" class
 * *
 * @link       https://www.wrdsb.ca
 * @since      1.0.0
 *
 * @package    WRDSB_Staff
 * @subpackage WRDSB_Staff/EmployeeAbsence
 */

class AbsenceSlot
{

    public function __construct($params)
    {
        $this->ID = $params['ID'];

        $this->absenceID;
        $this->slotID;

        $this->roomNumber;
        $this->lessonPlanLocation;

        $this->hasMedical;
        $this->hasBehavioural;

        $this->medicalDetails;
        $this->behaviouralDetails;

        $this->coverageRequestedFirstHalf;
        $this->coverageRequestedSecondHalf;

        $this->createdAt;
        $this->updatedAt;
    }

    public static function get($id)
    {
        $absence = new AbsenceSlot(
            array(
                'ID' => $id
            )
        );

        return $absence;
    }
}
