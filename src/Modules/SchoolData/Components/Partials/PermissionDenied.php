<?php
namespace WRDSB\Staff\Modules\SchoolData\Components\Partials;

/**
 * Define and register class for "permission denied" partial(s)
 * *
 * @link       https://www.wrdsb.ca
 * @since      1.0.0
 *
 * @package    Staff Features
 * @subpackage School Data
 */

class PermissionDenied {
    public static function cannotView() {
        $output = "You do not have permission to view this content.";

        return $output;
    }

    public static function cannotEdit() {
        $output = "You do not have permission to edit this content.";

        return $output;
    }

    public static function featureUnavailable() {
        $output = "The feature you've requested is unavailable here.";

        return $output;
    }
}