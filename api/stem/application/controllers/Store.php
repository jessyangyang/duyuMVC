<?php
/**
* Store API 
*
* @package     DuyuMvc
* @author      Jess
* @version     1.0
* @license     http://wiki.duyu.com/duyuMvc
*/

use \duyuu\dao\Books;
use \duyuu\dao\BookRecommend;
use \duyuu\rest\Restful;

class StoreController extends \Yaf\Controller_Abstract 
{

    public function recommendAction()
    {
        $rest = Restful::instance();
        $book = new BookRecommend();

        $booklist = $book->getIndexRecommend();
        
        $top = $book->topIndex();

        if ($booklist) {
            $rest->assign('code',200);
            $rest->assign('message',"ok");
            $rest->assign('topBanner',$top);
            $rest->assign('bookList',$booklist);
        }

        $rest->response();
    }

    public function topAction()
    {

    }

    public function category()
    {

    }

    public function subCategoryAction($cid)
    {

    }
}