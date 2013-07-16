<?php
/**
* BookInfo Model 
*
* @package     DuyuMvc
* @author      Jess
* @version     1.0
* @license     http://wiki.duyu.com/duyuMvc
*/

namespace lib\models;

class BookImage extends \local\db\ORM 
{
    public $table = 'book_image';

    public $fields = array(
        'id' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'id'),
        'bid' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'bid'),
        'pid' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'pid'),
        'name' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'name'),
        'type' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'type')
        );

    public $primaryKey = "id";

    // Instance Self
    protected static $instance;


    public static function instance($key = 0)
    {
        return self::$instance ? self::$instance : new BookImage($key);
    }

}