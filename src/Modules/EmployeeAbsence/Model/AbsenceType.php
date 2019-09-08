<?php
namespace WRDSB\Staff\Modules\EmployeeAbsence\Model;

/**
 * Define the "AbsenceType" class
 * *
 * @link       https://www.wrdsb.ca
 * @since      1.0.0
 *
 * @package    WRDSB_Staff
 * @subpackage WRDSB_Staff/EmployeeAbsence
 */

class AbsenceType
{
    public $id;
    public $code;
    public $name;
    public $description;

    public function __construct($params)
    {
        $this->id   = $params['id'];
        $this->code = $params['code'];
        $this->name = $params['name'];
        $this->name = $params['description'];
    }
}
