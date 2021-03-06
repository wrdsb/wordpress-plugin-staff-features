<?php
namespace WRDSB\Staff\Modules\Quartermaster\Model;

use WRDSB\Staff\Modules\Quartermaster\Model\DeviceLoanForm as Model;
use WRDSB\Staff\Modules\Quartermaster\Services\DeviceLoanForms as Service;

/**
 * Define the "DeviceLoanFormCollection" Model
 * *
 * @link       https://www.wrdsb.ca
 * @since      1.0.0
 *
 * @package    WRDSB_Staff
 * @subpackage WRDSB_Staff/Quartermaster
 */

class DeviceLoanFormCollection
{
    private $members = array();

    public function add(Model $obj, $key = null)
    {
        if ($key == null) {
            $this->members[] = $obj;
        } else {
            if (isset($this->members[$key])) {
                throw new KeyHasUseException("Key $key already in use.");
            } else {
                $this->members[$key] = $obj;
            }
        }
    }
    
    public function remove($key)
    {
        if (isset($this->members[$key])) {
            unset($this->members[$key]);
        } else {
            throw new KeyInvalidException("Invalid key $key.");
        }
    }
    
    public function get($key)
    {
        if (isset($this->members[$key])) {
            return $this->members[$key];
        } else {
            throw new KeyInvalidException("Invalid key $key.");
        }
    }

    public function keys()
    {
        return array_keys($this->members);
    }
    
    public function length()
    {
        return count($this->members);
    }
    
    public function keyExists($key)
    {
        return isset($this->members[$key]);
    }
}
