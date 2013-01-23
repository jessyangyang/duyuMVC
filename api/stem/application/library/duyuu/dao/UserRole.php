<?php
/**
* UserRole DAO 
*
* @package     DuyuMvc
* @author      Jess
* @version     1.0
* @license     http://wiki.duyu.com/duyuMvc
*/

namespace duyuu\dao;

class UserRole extends \local\db\ORM 
{
    public $table = "user_role";

    public $fields = array(
        'id' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'roleID'),
        'name' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'roleName')
        );

    public $primaryKey = 'id';

    // Instance Self
    protected static $instance;

    /**
     * [instance description]
     * @param  integer $key [description]
     * @return [type]       [description]
     */
    public static function instance($key = 0)
    {
        return self::$instance ? self::$instance : new UserRole($key);
    }
}