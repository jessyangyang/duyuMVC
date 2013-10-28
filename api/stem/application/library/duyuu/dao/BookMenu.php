<?php
/**
* BookMenu DAO 
*
* @package     DuyuMvc
* @author      Jess
* @version     1.0
* @license     http://wiki.duyu.com/duyuMvc
*/

namespace duyuu\dao;

class BookMenu extends \local\db\ORM 
{
    public $table = 'book_menu';

    public $fields = array(
        'id' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'id'),
        'bid' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'bid'),
        'title' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'title'),
        'sort' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'sort')
    );

    public $primaryKey = "id";

    // Instance Self
    protected static $instance;


    public static function instance($key = 0)
    {
        return self::$instance ? self::$instance : new BookMenu($key);
    }

    public function getBookMenu($bid)
    {
        $bookmenu = self::instance();
        $table = $bookmenu->table;

        $list = $bookmenu->field("title,sort as mid")->where("bid = '$bid'")->order("sort")->fetchList();

        if (is_array($list)) {
            return $list;
        }

        return array();
    }
}