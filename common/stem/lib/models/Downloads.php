<?php
/**
* Downloads DAO 
*
* @package     DuyuMvc
* @author      Jess
* @version     1.0
* @license     http://wiki.duyu.com/duyuMvc
*/

namespace lib\models;

class Downloads extends \local\db\ORM 
{
    public $table = 'downloads';

    public $fields = array(
        'did' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'pid'),
        'uid' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'uid'),
        'type' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'type'),
        'old_id' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'old_id'),
        'count' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'count'),
        'published' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'published')
    );

    public $primaryKey = "did";

    protected static $instance;

    /**
     * Instance self
     * 
     * @param String $key ,primary_key
     * @return Images Object
     */
    public static function instance($key = false)
    {
        return self::$instance ? self::$instance : new Downloads($key);
    }
}