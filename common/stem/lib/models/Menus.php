<?php
/**
* Menus Model 
*
* @package     DuyuMvc
* @author      Jess
* @version     1.0
* @license     http://wiki.duyu.com/duyuMvc
*/

namespace lib\models;

class Menus extends \local\db\ORM 
{
    public $table = 'menus';

    public $fields = array(
        'mid' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'mid'),
        'title' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'title'),
        'type' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'type'),
        'sub_id' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'sub_id'),
        'summary' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'summary')
        );

    public $primaryKey = "mid";

    protected static $instance;

    /**
     * Instance Menus
     * @param  boolean $id | the primaryKey
     * @return Object with self
     */
    public static function instance($id = false)
    {
        return self::$instance ? self::$instance : new Menus($id);
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