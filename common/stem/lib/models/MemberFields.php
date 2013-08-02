<?php
/**
* MemberFields Model 
*
* @package     DuyuMvc
* @author      Jess
* @version     1.0
* @license     http://wiki.duyu.com/duyuMvc
*/

namespace lib\models;

class MemberFields extends \local\db\ORM 
{
    public $table = 'member_fields';

    public $fields = array(
        'id' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'mid'),
        'name' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'title'),
        'download_count' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'download_count'),
        'purchased_count' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'purchased_count')
        );

    public $primaryKey = "id";

    protected static $instance;

    /**
     * Instance Menus
     * @param  boolean $id | the primaryKey
     * @return Object with self
     */
    public static function instance($id = false)
    {
        return self::$instance ? self::$instance : new MemberFields($id);
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