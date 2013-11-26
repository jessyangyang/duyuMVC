<?php
/**
* Roles Model 
*
* @package     DuyuMvc
* @author      Jess
* @version     1.0
* @license     http://wiki.duyu.com/duyuMvc
*/

namespace lib\models\users;

class Roles extends \local\db\ORM 
{
    public $table = 'roles';

    public $fields = array(
        'rid' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'rid'),
        'rcid' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'rcid'),
        'name' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'title'),
        'controller' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'controller'),
        'action' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'action'),
        'published' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'app_key'),
        'sort' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'app_key')
    );

    public $primaryKey = "rid";

    protected static $instance;

    /**
     * Instance Menus
     * @param  boolean $id | the primaryKey
     * @return Object with self
     */
    public static function instance($id = false)
    {
        return self::$instance ? self::$instance : new Roles($id);
    }

    /**
     * [getByID description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public static function getByID($id)
    {
        return self::instance($id);
    }
}