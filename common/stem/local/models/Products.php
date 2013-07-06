<?php
/**
* Products Model 
*
* @package     DuyuMvc
* @author      Jess
* @version     1.0
* @license     http://wiki.duyu.com/duyuMvc
*/

namespace local\models;

class Products extends \local\db\ORM 
{
    public $table = 'products';

    public $fields = array(
        'pid' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'pid'),
        'type' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'type'),
        'name' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'name'),
        'price' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'price'),
        'product_id' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'product_id'),
        'published' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'published'),
        'summary' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'summary'),
        'costprice' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'costprice'),
        'image_id' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'image_id')
        );

    public $primaryKey = "pid";

    protected static $instance;

    /**
     * Instance Products
     * @param  boolean $id | the primaryKey
     * @return Object with self
     */
    public static function instance($id = false)
    {
        return self::$instance ? self::$instance : new Products($id);
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