<?php
/**
* UserRolePermission DAO 
*
* @package     DuyuMvc
* @author      Jess
* @version     1.0
* @license     http://wiki.duyu.com/duyuMvc
*/

namespace duyuu\dao;

class UserRolePermission extends \local\db\ORM 
{
    public $table = "user_role_permission";

    public $fields = array(
        'role_id' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'roleID'),
        'role_action_id' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'roleActionID'),
        'permission' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'permission')
        );

    public $primaryKey = 'role_id';

    // Instance Self
    protected static $instance;

    /**
     * [instance description]
     * @param  integer $key [description]
     * @return [type]       [description]
     */
    public static function instance($key = 0)
    {
        return self::$instance ? self::$instance : new UserRolePermission($key);
    }
}