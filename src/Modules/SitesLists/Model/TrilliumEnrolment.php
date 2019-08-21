<?php
namespace WRDSB\Staff\Modules\SitesLists\Model;

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/wrdsb
 * @since      1.0.0
 *
 * @package    WRDSB_Staff
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    WRDSB_Staff
 * @author     WRDSB <website@wrdsb.ca>
 */
class TrilliumEnrolment
{
    /**
     * Someting
     *
     * Something else
     *
     * @since    1.0.0
     */
    public function __construct($data)
    {
        $this->class_code         = $data['class_code'];
        $this->school_code        = $data['school_code'];
        $this->student_email      = $data['student_email'];
        $this->student_first_name = $data['student_first_name'];
        $this->student_last_name  = $data['student_last_name'];
        $this->student_number     = $data['student_number'];
        $this->teacher_ein        = $data['teacher_ein'];
        $this->teacher_email      = $data['teacher_email'];
    }
}
