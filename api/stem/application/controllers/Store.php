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

class StoreController extends \Yaf\Controller_Abstract 
{
    public function recommendAction()
    {
        $book = new Books();

        $booklist = $book->limit(4)->fetchList();

        echo "<pre>";
        $json = array(
            "code" => 200,
            "message" => "sucessful!",
            "topBanner" => array(
            ),
            "recommondList" => array(
                $booklist
            ),
            "bestList" => array(
                $booklist)
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