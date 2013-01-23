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

        $list =  $books->field("books.bid,books.cid,i.path as cover,books.title,books.author,bi.apple_price as price")->joinQuery('book_category as c',"c.cid=$table.cid")->joinQuery('book_image as p',"$table.bid=p.bid")->joinQuery('images as i','i.pid=p.pid')->joinQuery('book_info as bi','bi.bid=books.bid')->where("p.type = 1")->limit(10)->fetchList();
        
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
    public function getSubCategory($cid,$limit = 10,$page = 1)
    {
        $books = self::instance();
        $table = $this->table;

        $count = $books->field("count(*) as count")->joinQuery('book_image as p',"$table.bid=p.bid")->joinQuery('images as i','i.pid=p.pid')->where("p.type = 1 AND cid='$cid'")->fetchList();

        $count = $count ? $count[0]['count'] : 0;
        $offset = 0;

        $pages = $count/$limit;
        $pages = $pages < 1 ? 1 : $pages;
        $pages = is_float($pages) ? intval($pages)+1 : $pages;

        $page = $page < 1 ? 1 : $page;
        $page = $page > $pages ? $pages : $page;

        $offset = $limit * ($page - 1);

        $list['count'] = $count;
        $list['page'] = $page;
        $list['pages'] = $pages;
        $list["list"] = $books->field("$table.bid,$table.title,$table.author,i.path as cover,bi.apple_price as price")->joinQuery('book_image as p',"$table.bid=p.bid")->joinQuery('images as i','i.pid=p.pid')->joinQuery('book_info as bi',"bi.bid=$table.bid")->where("p.type = 1 AND cid='$cid'")->limit("$offset,$limit")->fetchList();

        if (is_array($list["list"])) {
            foreach ($list["list"] as $key => $value) {
                if (isset($value['cover']) and $value['cover']) {
                    $list["list"][$key]['cover'] = \duyuu\image\ImageControl::getRelativeImage($value['cover']);
                }
            }
            return $list;
        }

        return "";
    }

    public function getBookInfo($bid)
    {
        $books = self::instance();
        $table = $books->table;

        $list = $books->field("$table.bid,$table.title,$table.author,i.path as cover,$table.pubtime,$table.press,f.apple_price as price,$table.summary")->joinQuery("book_info as f","$table.bid=f.bid")->joinQuery('book_image as p',"$table.bid=p.bid")->joinQuery('images as i','i.pid=p.pid')->where("p.type = 1 AND $table.bid='$bid'")->order("$table.published")->limit(1)->fetchList();

        if (is_array($list)) {
            foreach ($list as $key => $value) {
                if (isset($value['cover']) and $value['cover']) {
                    $list[$key]['cover'] = \duyuu\image\ImageControl::getRelativeImage($value['cover']);
                }
            }
            return $list[0];
        }

        return "";
    }
}