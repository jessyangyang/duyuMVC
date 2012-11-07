<?php
/**
* Books DAO 
*
* @package     DuyuMvc
* @author      Jess
* @version     1.0
* @license     http://wiki.duyu.com/duyuMvc
*/

namespace duyuu\dao;

class Books extends \local\db\ORM 
{
    public $table = 'books';

    public $fields = array(
        'bid' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'bookID'),
        'title' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'title'),
        'category' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'category'),
        'cover' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'couverURL'),
        'author' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'author'),
        'press' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'press'),
        'published' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'publishing time'),
        'isbn' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'idbn'),
        'summary' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'summary')
        );

    public $primaryKey = "bid";

    // Instance Self
    protected static $instance;


    public static function instance($key = 0)
    {
        return self::$instance ? self::$instance : new Books($key);
    }

    /**
     * [topList description]
     * @return [type] [description]
     */
    public function topList()
    {
        $books = self::instance();
        $table = $this->table;

        $list =  $books->field("books.bid,books.cid,i.path as cover,books.title,books.author")->joinQuery('book_category as c',"c.cid=$table.cid")->joinQuery('book_image as p',"$table.bid=p.bid")->joinQuery('images as i','i.pid=p.pid')->limit(10)->fetchList();
        
        if (is_array($list)) {
            foreach ($list as $key => $value) {
                if (isset($value['cover']) and $value['cover']) {
                    $list[$key]['cover'] = \duyuu\image\ImageControl::getRelativeImage($value['cover']);
                }
            }

            $books->joinTables = array();
            return $list;
        }

        return "";
    }


    /**
     * [getSubCategory description]
     * @return [type] [description]
     */
    public function getSubCategory($cid)
    {
        $books = self::instance();
        $table = $this->table;

        $list = $books->field("$table.bid,$table.title,$table.author,i.path as cover")->joinQuery('book_image as p',"$table.bid=p.bid")->joinQuery('images as i','i.pid=p.pid')->where("p.type = 1 AND cid='$cid'")->limit(10)->fetchList();

        if (is_array($list)) {
            foreach ($list as $key => $value) {
                if (isset($value['cover']) and $value['cover']) {
                    $list[$key]['cover'] = \duyuu\image\ImageControl::getRelativeImage($value['cover']);
                }
            }

            $books->joinTables = array();
            return $list;
        }

        return "";
    }
}