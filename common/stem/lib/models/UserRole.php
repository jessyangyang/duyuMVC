<?php
/**
* UserRole Model 
*
* @package     DuyuMvc
* @author      Jess
* @version     1.0
* @license     http://wiki.duyu.com/duyuMvc
*/

namespace lib\models;

class UserRole extends \local\db\ORM 
{
    public $table = 'user_role';

    public $fields = array(
        'id' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'id'),
        'name' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'name')
        );

    public $primaryKey = "id";

    // Instance Self
    protected static $instance;

    /**
     * Instance 
     *
     */
    public static function instance($key = 0)
    {
        return self::$instance ? self::$instance : new UserRole($key);
    }

}