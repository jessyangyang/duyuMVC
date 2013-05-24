<?php
/**
* Books DAO 
*
* @package     DuyuMvc
* @author      Jess
* @version     1.0
* @license     http://wiki.duyu.com/duyuMvc
*/

namespace duyuAT\dao;

use duyuAT\dao\Members;
use duyuAT\dao\BookFields;

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
        'cid' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'cid'),
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
     *  GET Bookinfo on online
     *  @return integer , bookid in the session.
     */
    public function getEditingCurrent()
    {
        $user = \duyuAT\dao\Members::getCurrentUser();
        if (!$user->id) return false;
        $session = \Yaf\Session::getInstance();
        if ($session->has('bid')) {
            return $session->bid;
        }
        return false;
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
                    $list["list"][$key]['cover'] = \duyuAT\image\ImageControl::getRelativeImage($value['cover']);
                }
            }
            return $list;
        }

        return "";
    }

    /**
     * [getCurrentUserWriterBooks]
     *
     * @return Array or false , return array of the current writer book online
     */
    public function getCurrentUserWriterBooks()
    {
        $books = self::instance();
        $table = $books->table;
        $userStatus = Members::getCurrentUser();
        if (!$userStatus->id) return false;



        $list = $books->field("$table.bid,$table.title,$table.cover,$table.author,$table.press,$table.published,$table.isbn,$table.summary,bf.uid,bf.status,bc.name")->joinQuery('book_fields as bf',"$table.bid=bf.bid")->joinQuery('book_category as bc',"bc.cid=books.cid")->where("bf.uid='".$userStatus->id."'")->order("$table.published")->fetchList();

        // print_r($list);

        if (is_array($list)) {
            foreach ($list as $key => $value) {
                if (isset($value['cover']) and $value['cover']) {
                    $list[$key]['cover'] = \duyuAT\image\ImageControl::getRelativeImage($value['cover']);
                }
            }
            return $list;
        }

        return false;
    }

    /**
     * [addBook description]
     */
    public function addBook($fields = array())
    {

    }

    /**
     * [getBookInfo description]
     * @param  [String] $bid [description]
     * @return [Array]      [return list of the bookInfo]
     */
    public function getBookInfo($bid)
    {
        $books = self::instance();
        $table = $books->table;
        $userStatus = Members::getCurrentUser();

        $list = $books->field("$table.bid,$table.cid,$table.title,$table.author,i.path as cover,$table.pubtime,$table.press,f.apple_price as price,$table.summary,f.tags")->joinQuery("book_info as f","$table.bid=f.bid")->joinQuery('book_image as p',"$table.bid=p.bid")->joinQuery('images as i','i.pid=p.pid')->joinQuery('book_fields as bf',"$table.bid=bf.bid AND bf.uid=$userStatus->id")->where("$table.bid='$bid'")->order("$table.published")->limit(1)->fetchList();


        if (is_array($list)) {
            foreach ($list as $key => $value) {
                if (isset($value['cover']) and $value['cover']) {
                    $list[$key]['cover'] = \duyuAT\image\ImageControl::getRelativeImage($value['cover']);
                }
            }
            return $list[0];
        }

        return "";
    }
}