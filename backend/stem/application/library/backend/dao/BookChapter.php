<?php
/**
* BookChapter DAO 
*
* @package     DuyuMvc
* @author      Jess
* @version     1.0
* @license     http://wiki.duyu.com/duyuMvc
*/

namespace backend\dao;

class BookChapter extends \local\db\ORM 
{
    public $table = 'book_chapter';

    public $fields = array(
        'menu_id' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'menu_id'),
        'body' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'body')
    );

    public $primaryKey = "menu_id";

    // Instance Self
    protected static $instance;


    public static function instance($key = 0)
    {
        return self::$instance ? self::$instance : new BookChapter($key);
    }

    /**
     * [addContent description]
     * @param [type] $arr [description]
     * @return [Boolean or String] ,if updated return true ,inserted return
     * insert_id ,or return false.
     */
    public function addContent($arr)
    {
        $chapter = self::instance();
        if (is_array($arr)) {
            if ($chapter->where("menu_id='$arr[menu_id]'")->fetchRow()) {
                return $chapter->where("menu_id='$arr[menu_id]'")->update($arr);
            }
            else
            {
                return $chapter->insert($arr);
            }
        }
        return false;
    }
}