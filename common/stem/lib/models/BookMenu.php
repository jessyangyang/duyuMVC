<?php
/**
* BookMenu DAO 
*
* @package     DuyuMvc
* @author      Jess
* @version     1.0
* @license     http://wiki.duyu.com/duyuMvc
*/

namespace lib\models;

use \lib\models\BookChapter;

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
        'sort' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'sort'),
        'type' => array(
            'type' => 'int',
            'default' => 1,
            'comment' => 'type'),
        'title' => array(
            'type' => 'title',
            'default' => 0,
            'comment' => 'title'),
        'summary' => array(
            'type' => 'summary',
            'default' => 0,
            'comment' => 'summary')
    );

    public $primaryKey = "id";

    // Instance Self
    protected static $instance;


    public static function instance($key = 0)
    {
        return self::$instance ? self::$instance : new BookMenu($key);
    }

    /**
     * [getMenuForBookID description]
     * @param  [type] $bid [description]
     * @return [type]      [description]
     */
    public function getMenuForBookID($bid)
    {
        $menu = self::instance();
        $table = $this->table;

        $list = $menu->field("$table.id,$table.bid,$table.type,$table.sort,$table.title,$table.summary")->where("bid=$bid")->order("sort")->fetchList();

        $menu->joinTables = array();
        return $list;
    }

    /**
     * [getMenuAndContentRow description]
     * @param  [type] $menu_id [description]
     * @return [type]          [description]
     */
    public function getMenuAndContentRow($menu_id)
    {
        $menu = self::instance();
        $table = $this->table;

        $list = $menu->field("$table.id,$table.bid,$table.type,$table.sort,$table.title,$table.summary,bc.body")->joinQuery('book_chapter as bc',"$table.id=bc.menu_id")->where("$table.id='$menu_id'")->limit(1)->fetchList();

        $menu->joinTables = array();
        return $list;
    }

    /**
     * Get Content List For bid
     *
     * @param string $bid
     * @return array
     */
    public function getMenuAndContentList($bid)
    {
        $menu = self::instance();
        $table = $this->table;

        $list = $menu->field("$table.id,$table.bid,$table.type,$table.sort,$table.title,$table.summary,bc.body")->joinQuery('book_chapter as bc',"$table.id=bc.menu_id")->where("$table.bid='$bid'")->order("$table.sort")->fetchList();

        $menu->joinTables = array();
        return $list;
    }

    /**
     * [deleteMenuForMenuID description]
     * @param  [type] $menu_id [description]
     * @return [type]          [description]
     */
    public function deleteMenuForMenuID($menu_id)
    {
        $menu = self::instance();
        $chapter = BookChapter::instance();

        $chapter->where("menu_id='$menu_id'")->delete();
        return $menu->where("id='$menu_id'")->delete();
        
    }
}