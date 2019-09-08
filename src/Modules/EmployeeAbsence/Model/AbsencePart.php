<?php
namespace WRDSB\Staff\Modules\EmployeeAbsence\Model;

/**
 * Define the "AbsencePart" class
 * *
 * @link       https://www.wrdsb.ca
 * @since      1.0.0
 *
 * @package    WRDSB_Staff
 * @subpackage WRDSB_Staff/EmployeeAbsence
 */

class AbsencePart
{

    public function __construct($params)
    {
        $this->ID = $params['ID'];

        $this->absenceID;
        $this->partID;

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
        $absence = new AbsencePart(
            array(
                'ID' => $id
            )
        );

        return $absence;
    }
}
