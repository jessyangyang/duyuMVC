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

class StoreController extends \Yaf\Controller_Abstract 
{
    public function recommendAction()
    {
        $book = new BookRecommend();

        $booklist = $book->getIndexRecommend();

        $json = array(
            "code" => 200,
            "message" => "sucessful!",
            "bookList" => $booklist
            );
        echo json_encode($json);
        exit();
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