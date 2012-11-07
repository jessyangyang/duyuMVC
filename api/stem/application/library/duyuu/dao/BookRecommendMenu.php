<?php
/**
* BookRecommendMenu DAO 
*
* @package     DuyuMvc
* @author      Jess
* @version     1.0
* @license     http://wiki.duyu.com/duyuMvc
*/

namespace duyuu\dao;

class BookRecommendMenu extends \local\db\ORM 
{
    public $table = 'book_recommend_menu';

    public $fields = array(
        'cid' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'cid'),
        'name' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'name'),
        'sort' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'sort'),
        'type' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'type')
        );

    public $primaryKey = "cid";

    // Instance Self
    protected static $instance;


    public static function instance($key = 0)
    {
        return self::$instance ? self::$instance : new BookRecommendMenu($key);
    }
}