<?php
/**
* Products Model 
*
* @package     DuyuMvc
* @author      Jess
* @version     1.0
* @license     http://wiki.duyu.com/duyuMvc
*/

namespace lib\models;

class Products extends \local\db\ORM 
{
    public $table = 'products';

    public $fields = array(
        'pid' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'pid'),
        'pcid' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'type'),
        'order_num' => array(
            'type' => 'varchar',
            'default' => '0',
            'comment' => 'order_num'),
        'product_name' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'name'),
        'total_fee' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'price'),
        'oldid' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'oldid'),
        'product_id' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'product_id'),
        'created_time' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'published'),
        'paied_time' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'paied_time'),
        'modified_time' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'modified_time'),
        'pay_status' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'pay_status'),
        'pay_method' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'pay_method'),
        'summary' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'summary'),
        'costprice' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'costprice'),
        'image_id' => array(
            'type' => 'int',
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