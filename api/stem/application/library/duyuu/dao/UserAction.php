<?php
/**
* UserAction DAO 
*
* @package     DuyuMvc
* @author      Jess
* @version     1.0
* @license     http://wiki.duyu.com/duyuMvc
*/

namespace duyuu\dao;

class UserAction extends \local\db\ORM 
{
    public $table = "user_action";

    public $fields = array(
        'id' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'id'),
        'name' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'actionName'),
        'action' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'action'),
        'controller' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'controller')
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