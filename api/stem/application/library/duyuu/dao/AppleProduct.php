<?php
/**
* AppleProduct DAO 
*
* @package     DuyuMvc
* @author      Jess
* @version     1.0
* @license     http://wiki.duyu.com/duyuMvc
*/

namespace duyuu\dao;

class AppleProduct extends \local\db\ORM 
{
    public $table = 'apple_product';

    public $fields = array(
        'id' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'productID'),
        'bid' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'bid'),
        'price' => array(
            'type' => 'float',
            'default' => 0,
            'comment' => 'price'),
        'status' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'status'),
        'published' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'published')
        );

    public $primaryKey = "id";

    protected static $instance;

    /**
     * Instance AppleProduct
     * @param  boolean $id | the primaryKey
     * @return Object with self
     */
    public static function instance($id = false)
    {
        return self::$instance ? self::$instance : new AppleProduct($id);
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

    

    public function __get($fieldName)
    {
        return $this->$fieldName;
    }

    public function __set($fieldName, $value)
    {
        $this->$fieldName = $value;
    }
}