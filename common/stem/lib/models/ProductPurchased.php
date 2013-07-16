<?php
/**
* ProductPurchased Model 
*
* @package     DuyuMvc
* @author      Jess
* @version     1.0
* @license     http://wiki.duyu.com/duyuMvc
*/

namespace lib\models;

class ProductPurchased extends \local\db\ORM 
{
    public $table = 'product_purchased';

    public $fields = array(
        'pid' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'pid'),
        'uid' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'uid'),
        'status' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'status'),
        'published' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'published')
        );

    public $primaryKey = "pid";

    protected static $instance;

    /**
     * Instance ProductPurchased
     * @param  boolean $id | the primaryKey
     * @return Object with self
     */
    public static function instance($id = false)
    {
        return self::$instance ? self::$instance : new ProductPurchased($id);
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