<?php
/**
* Store Book API 
*
* @package     DuyuMvc
* @author      Jess
* @version     1.0
* @license     http://wiki.duyu.com/duyuMvc
*/

use \duyuu\dao\Books;
use \duyuu\dao\BookMenu;
use \local\rest\Restful;

class StoreBookController extends \Yaf\Controller_Abstract 
{
    public function bookAction($bid)
    {
        $rest = Restful::instance();
        $book = new Books();
        $bookMenu = BookMenu::instance();

        $code = 200;
        $message = "ok";

        $list = $book->getBookInfo(intval($bid));
        $menu = $bookMenu->getBookMenu(intval($bid));

        $rest->assign('code',$code);
        $rest->assign('message',$message);
        $rest->assign('bookInfo',$list);
        $rest->assign('bookMenu',$menu);

        $rest->response();
    }

    public function bookMenuAction($bid)
    {
        $rest = Restful::instance();
        $bookMenu = BookMenu::instance();

        $code = 200;
        $message = "ok";

        $list = $bookMenu->getBookMenu(intval($bid));

        $rest->assign('code',$code);
        $rest->assign('message',$message);
        $rest->assign('bookMenu',$list);

        $rest->response();
    }

    public function bookChapterAction($bid)
    {
        
    }
}