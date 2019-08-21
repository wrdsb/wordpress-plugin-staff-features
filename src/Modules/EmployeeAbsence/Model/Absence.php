<?php
namespace WRDSB\Staff\Modules\EmployeeAbsence\Model;

use WRDSB\Staff\Modules\EmployeeAbsence\Services\AbsenceService as AbsenceService;

/**
 * Define the "Absence" class
 * *
 * @link       https://www.wrdsb.ca
 * @since      1.0.0
 *
 * @package    WRDSB_Staff
 * @subpackage WRDSB_Staff/EmployeeAbsence
 */

class Absence
{
    private $deletedAt;

    public function __construct($params)
    {
        $this->id          = $params['id'];
        $this->absenceType = $params['absenceType'];
        $this->employee    = $params['employee'];

        $this->absentOn   = $params['absentOn'];
        $this->absentFrom = $params['absentFrom'];
        $this->absentTo   = $params['absentTo'];

        $this->EasyConnectID = $params['easyConnectID'];

        $this->createdAt = $params['createdAt'];
        $this->updatedAt = $params['updatedAt'];
    }

    public static function findByID($service, $id)
    {
        $absence_service = new AbsenceService();
        $absence = $absence_service->read($id);

        return $absence;
    }

    public static function findByType($service, $type)
    {
        $absence_service = new AbsenceService();
        $absence = $absence_service->read($type);

        return $absence;
    }

    public static function findByEmployee($service, $employee)
    {
        $absence_service = new AbsenceService();
        $absence = $absence_service->read($employee);

        return $absence;
    }

    public static function findByDate($service, $date)
    {
        $absence_service = new AbsenceService();
        $absence = $absence_service->read($date);

        return $absence;
    }

    public function save()
    {
        AbsenceService::write($this);
    }

    public function delete()
    {
        $timestamp = '';
        $this->setDeletedAt($timestamp);
        $this->save();
    }

    public function getSlots()
    {
        $slots = array();

        return $slots;
    }

    private function setDeletedAt($timestamp)
    {
        $this->deletedAt = $timestamp;
    }
}
