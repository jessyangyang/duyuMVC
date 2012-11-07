<?php
/**
* BookRecommend DAO 
*
* @package     DuyuMvc
* @author      Jess
* @version     1.0
* @license     http://wiki.duyu.com/duyuMvc
*/

namespace duyuu\dao;

class BookRecommend extends \local\db\ORM 
{
    public $table = 'book_recommend';

    public $fields = array(
        'rid' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'rid'),
        'bid' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'bid'),
        'cid' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'cid'),
        'sort' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'sort')
        );

    public $primaryKey = "rid";

    // Instance Self
    protected static $instance;


    public static function instance($key = 0)
    {
        return self::$instance ? self::$instance : new BookRecommend($key);
    }

    /**
     * [getAllRecommend description]
     * @param String | limit, defaule = 4
     * @return Array | Empty
     */
    public function getIndexRecommend($limit = 4)
    {
        $recommend = self::instance();
        $table = $this->table;

        $category = \duyuu\dao\BookRecommendMenu::instance();
        $categoryList = $category->where('type = 1')->fetchList();

        $list = array();

        foreach ($categoryList as $key => $value) {
            if (isset($value['cid'])) {
                

                $list[] = array(
                    'cid' => $value['cid'],
                    'name' => $value['name'],
                    'list' => $recommend->field("b.bid,b.title,i.path as cover,b.cid,c.name")->joinQuery("books as b","b.bid=$table.bid")->joinQuery('book_category as c','c.cid=b.cid')->joinQuery('book_image as p','b.bid=p.bid')->joinQuery('images as i','i.pid=p.pid')->where("p.type = 1 AND $table.cid='" . $value['cid'] . "'")->limit(4)->fetchList());
                $recommend->joinTables = array();
            }
        }

        // $list = $recommend->field("b.bid,b.title,c.name,b.cover,$table.sort")->joinQuery("book_category as c","c.cid=$table.cid")->joinQuery("books as b","b.bid=$table.bid")->where("c.type = 1")->limit(4)->fetchList();
        return $list ? $list : "";
    }

    /**
     * [topIndex description]
     * @return [type] [description]
     */
    public function topIndex()
    {
        $recommend = self::instance();
        $table = $this->table;

        $list =  $recommend->field("b.bid,b.title,i.path as cover,b.cid,c.name")->joinQuery("books as b","b.bid=$table.bid")->joinQuery('book_category as c','c.cid=b.cid')->joinQuery('book_image as p','b.bid=p.bid')->joinQuery('images as i','i.pid=p.pid')->where("p.type = 2 AND $table.cid='2'")->limit(4)->fetchList();
        
        $recommend->joinTables = array();

        return $list;
    }

}