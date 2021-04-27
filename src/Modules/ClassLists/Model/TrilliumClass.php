<?php
namespace WRDSB\Staff\Modules\ClassLists\Model;

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
class TrilliumClass
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
        $this->teacher_ein        = $data['teacher_ein'];
        $this->teacher_email      = $data['teacher_email'];
    }
}
