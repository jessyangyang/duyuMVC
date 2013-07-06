<?php
/**
* MenusCategory Model 
*
* @package     DuyuMvc
* @author      Jess
* @version     1.0
* @license     http://wiki.duyu.com/duyuMvc
*/

namespace local\models;

class MenusCategory extends \local\db\ORM 
{
    public $table = 'menus_category';

    public $fields = array(
        'mcid' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'mcid'),
        'name' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'name'),
        'summary' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'summary')
        );

    public $primaryKey = "mcid";

    protected static $instance;

    /**
     * Instance MenusCategory
     * @param  boolean $id | the primaryKey
     * @return Object with self
     */
    public static function instance($id = false)
    {
        return self::$instance ? self::$instance : new MenusCategory($id);
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