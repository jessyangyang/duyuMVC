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

use lib\dao\ImageControl;

class Books extends \lib\models\Books
{

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

        $list = $books->field("books.bid,books.cid,i.path as cover,books.title,books.author,bi.apple_price as price,ps.product_id")
            ->joinQuery('book_category as c',"c.cid=$table.cid")
            ->joinQuery('book_image as p',"$table.bid=p.bid")
            ->joinQuery('images as i','i.pid=p.pid')
            ->joinQuery('book_info as bi','bi.bid=books.bid')
            ->joinQuery('products as ps',"ps.oldid=$table.bid")
            ->where("p.type = 1")->limit(10)->fetchList();
        
        if (is_array($list)) {
            foreach ($list as $key => $value) {
                if (isset($value['cover']) and $value['cover']) {
                    $list[$key]['cover'] = ImageControl::getRelativeImage($value['cover']);
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
                    $list["list"][$key]['cover'] = ImageControl::getRelativeImage($value['cover']);
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

        $config = \Yaf\Application::app()->getConfig()->toArray();

        $list = $books->field("$table.bid,$table.title,$table.author,i.path as cover,$table.pubtime,$table.press,f.apple_price as price,$table.summary,c.name as cname,f.wordcount,f.tags,f.copyright,f.proofreader,ps.product_id")
            ->joinQuery("book_info as f","$table.bid=f.bid")
            ->joinQuery('book_image as p',"$table.bid=p.bid")
            ->joinQuery('images as i','i.pid=p.pid')
            ->joinQuery('book_category as c',"$table.cid=c.cid")
            ->joinQuery('products as ps',"ps.oldid=$table.bid")
            ->where("p.type = 1 AND $table.bid='$bid'")->order("$table.published")->limit(1)->fetchList();

        if (is_array($list)) {
            foreach ($list as $key => $value) {
                if (isset($value['cover']) and $value['cover']) {
                    $list[$key]['cover'] = ImageControl::getRelativeImage($value['cover']);
                }
                if (isset($value['product_id']) and $value['product_id']) {
                    $list[$key]['product_id'] = $config['products']["IAPName"] . $value['product_id'];
                }
                else
                {
                    $list[$key]['product_id'] = "";
                }
            }
            return $list[0];
        }

        return array();
    }

    /**
     * Get Books List
     *
     * @param Array , $option
     * @param int , $limit
     * @param int , $page
     * @return Array
     */
    public function getBooksList($option = array(),$limit = 10,$page = 1)
    {
        if (!is_array($option) or !$option) return false;

        $sql = '';
        $i = 1;
        $count = count($option);
        foreach ($option as $key => $value) {
            if($i == $count) $sql .= "$key='" . $value . "'";
            else $sql .= "$key='" . $value . "' AND ";
            $i ++;
        }

        $offset = $page == 1 ? 0 : ($page - 1)*$limit; 
        $table = $this->table;

        $config = \Yaf\Application::app()->getConfig()->toArray();

        $list = $this->field("$table.bid,$table.cid,$table.title,$table.author,i.path as cover,$table.pubtime,$table.isbn,$table.press,f.apple_price as price,$table.summary,f.tags,bi.price,bi.apple_price,ps.product_id")
            ->joinQuery("book_info as f","$table.bid=f.bid")
            ->joinQuery('book_image as p',"$table.bid=p.bid")
            ->joinQuery('images as i','i.pid=p.pid')
            ->joinQuery('book_fields as bf',"$table.bid=bf.bid")
            ->joinQuery('book_info as bi',"$table.bid=bi.bid")
            ->joinQuery('products as ps',"ps.oldid=$table.bid")
            ->where($sql)->order("$table.published")
            ->limit($offset,$limit)->fetchList();

        if (is_array($list)) {
            foreach ($list as $key => $value) {
                if (isset($value['cover']) and $value['cover']) {
                    $list[$key]['cover'] = ImageControl::getRelativeImage($value['cover']);
                }
                if (isset($value['product_id']) and $value['product_id']) {
                    $list[$key]['product_id'] = $config['products']["IAPName"] . $value['product_id'];
                }
                else
                {
                    $list[$key]['product_id'] = "";
                }
            }
            return $list;
        }

        return false;
    }
    
    /**
     * Get BookRecommand List 
     * 
     * @param Array, $option
     * @param Int, $limit
     * @param Int, $page
     * @param Int, $type
     * @return Array
     * */
    public function getBookRecommendList($option = array(),$limit = 10,$page = 1)
    {
        if (!is_array($option) or !$option) return false;
        
        $sql = '';
        $i = 1;
        $count = count($option);
        foreach ($option as $key => $value) {
            if($i == $count) $sql .= "$key='" . $value . "'";
            else $sql .= "$key='" . $value . "' AND ";
            $i ++;
        }
        
        $offset = $page == 1 ? 0 : ($page - 1)*$limit;
        $table = $this->table;

        $config = \Yaf\Application::app()->getConfig()->toArray();
        
        $list = $this->field("$table.bid,$table.cid,$table.title,$table.author,i.path as cover,$table.pubtime,$table.isbn,$table.press,f.apple_price as price,$table.summary,f.tags,ps.product_id")
            ->joinQuery("book_info as f","$table.bid=f.bid")
            ->joinQuery('book_image as p',"$table.bid=p.bid")
            ->joinQuery('images as i','i.pid=p.pid')
            ->joinQuery('book_fields as bf',"$table.bid=bf.bid")
            ->joinQuery('book_recommend as br',"$table.bid=br.bid")
            ->joinQuery('products as ps',"ps.oldid=$table.bid")
            ->where($sql)->order("br.sort AND $table.published DESC")
            ->limit($offset,$limit)->distinct('YES')->fetchList();
        
        if (is_array($list)) {
            foreach ($list as $key => $value) {
                if (isset($value['cover']) and $value['cover']) {
                    $list[$key]['cover'] = ImageControl::getRelativeImage($value['cover']);
                }
                if (isset($value['product_id']) and $value['product_id']) {
                    $list[$key]['product_id'] = $config['products']["IAPName"] . $value['product_id'];
                }
                else
                {
                    $list[$key]['product_id'] = "";
                }
            }
            return $list;
        }
        return false;
    }
}