<?php
/**
* Images DAO 
*
* @package     DuyuMvc
* @author      Jess
* @version     1.0
* @license     http://wiki.duyu.com/duyuMvc
*/

namespace duyuu\dao;

class Images extends \local\db\ORM 
{
    public $table = 'images';

    public $fields = array(
        'pid' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'pid'),
        'uid' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'uid'),
        'class' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'class'),
        'title' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'title'),
        'filename' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'filename'),
        'type' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'type'),
        'size' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'size'),
        'path' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'path'),
        'thumb' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'thumb'),
        'published' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'published')
    );

    public $primaryKey = "pid";

    protected static $instance;

    /**
     * Instance self
     * 
     * @param String $key ,primary_key
     * @return Images Object
     */
    public static function instance($key = false)
    {
        return self::$instance ? self::$instance : new Images($key);
    }

    /**
     * Insert ImageURL to Database
     * @return [type] [description]
     */
    public function save()
    {

    }


}