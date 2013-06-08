<?php
/**
* UserRolePermission Model 
*
* @package     DuyuMvc
* @author      Jess
* @version     1.0
* @license     http://wiki.duyu.com/duyuMvc
*/

namespace local\models;

class UserRolePermission extends \local\db\ORM 
{
    public $table = 'user_role_permission';

    public $fields = array(
        'role_id' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'role_id'),
        'role_action_id' => array(
            'type' => 'role_action_id',
            'default' => 0,
            'comment' => 'role_action_id'),
        'permission' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'permission')
        );

    public $primaryKey = "role_id";

    // Instance Self
    protected static $instance;

    /**
     * Instance 
     *
     */
    public static function instance($key = 0)
    {
        return self::$instance ? self::$instance : new UserRolePermission($key);
    }

}