<?php
/**
* BookRecommendMenu DAO 
*
* @package     DuyuMvc
* @author      Jess
* @version     1.0
* @license     http://wiki.duyu.com/duyuMvc
*/

namespace lib\models;

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
            'comment' => 'type'),
    	'action' => array(
    		'type' => 'int',
    		'default' => 0,
    		'comment' => 'action')
        );

    public $primaryKey = "cid";

    // Instance Self
    protected static $instance;


    public static function instance($key = 0)
    {
        return self::$instance ? self::$instance : new BookRecommendMenu($key);
    }
    
    /**
     * Get RecommandMenu For Type
     * 
     * @param Int, $type
     * @return Array.
     * */
    public function getRecommendMenuForType($type = false)
    {
    	$table = $this->table;
    	$list = $this->field("$table.cid,$table.name,$table.sort,$table.type,$table.action")
    	->where("type='$type'")->order('sort')->fetchList();
    	return $list;
    }
}