<?php
/**
* RoleCategory Model 
*
* @package     DuyuMvc
* @author      Jess
* @version     1.0
* @license     http://wiki.duyu.com/duyuMvc
*/

namespace lib\models\users;

class RoleCategory extends \local\db\ORM 
{
    public $table = 'roles_category';

    public $fields = array(
        'rcid' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'rcid'),
        'name' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'name'),
        'summary' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'summary'),
        'published' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'app_key'),
        'sort' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'sort')
    );

    public $primaryKey = "rcid";

    protected static $instance;

    /**
     * Instance Menus
     * @param  boolean $id | the primaryKey
     * @return Object with self
     */
    public static function instance($id = false)
    {
        return self::$instance ? self::$instance : new RoleCategory($id);
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