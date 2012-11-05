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

        if ($booklist) {
            $rest->setData('code',200);
            $rest->setData('message',"ok");
            $rest->setData('bookList',$booklist);
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