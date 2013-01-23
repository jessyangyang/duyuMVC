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
use \duyuu\dao\BookCategory;
use \duyuu\rest\Restful;

class StoreController extends \Yaf\Controller_Abstract 
{

    public function recommendAction()
    {
        $rest = Restful::instance();
        $book = BookRecommend::instance();

        $code = 200;
        $message = "ok";

        $booklist = $book->getIndexRecommend();
        
        $top = $book->topRecommendIndex();

        $rest->assign('code',$code);
        $rest->assign('message',$message);
        $rest->assign('topBanner',$top);
        $rest->assign('bookList',$booklist);

        $rest->response();
    }

    public function topAction($sortID = 1)
    {
        $rest = Restful::instance();
        $book = Books::instance();

        $code = 200;
        $message = "ok";

        switch ($sortID) {
            case '1':
                # code...
                break;
            case '2':
                break;

            case '3':
                break;
            default:
                # code...
                break;
        }

        $rest->assign('code',$code);
        $rest->assign('message',$message);
        $rest->assign('TopList',$book->topList());

        $rest->response();
    }

    public function categoryAction()
    {
        $rest = Restful::instance();
        $category = BookCategory::instance();

        $code = 200;
        $message = "ok";

        $rest->assign('code',$code);
        $rest->assign('message',$message);
        $rest->assign('categoryList',$category->getCategory());

        $rest->response();
    }

    public function subCategoryAction($cid,$limit = 10,$page = 1)
    {
        $rest = Restful::instance();
        $book = Books::instance();

        $code = 200;
        $message = "ok";

        $list = $book->getSubCategory(intval($cid),$limit,$page);

        $rest->assign('code',$code);
        $rest->assign('message',$message);
        $rest->assign('pages',$list['pages']);
        $rest->assign('subList',$list['list']);

        $rest->response();
    }
}