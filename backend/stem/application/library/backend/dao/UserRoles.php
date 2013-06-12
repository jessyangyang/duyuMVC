<?php
/**
* BookCategory DAO 
*
* @package     DuyuMvc
* @author      Jess
* @version     1.0
* @license     http://wiki.duyu.com/duyuMvc
*/

namespace backend\dao;

use \local\models\UserRole;
use \local\models\UserRolePermission;

class UserRoles
{
    // Instance Self
    protected static $instance;

    protected $permissionRoles;

    /**
     * Instance Methods
     */
    public static function instance()
    {
        return self::$instance ? self::$instance : new UserRoles();
    }

    /**
     * 
     */
    public function init()
    {
        $userRole = UserRole::instance()

        $permissionRoles = array(
            'api' => array(),
            'backend' => array(),
            'user' =>array());
    }

    public function getRoles($role_id = false)
    {
        
    }
}