<?php
/**
 * Admin Controllers
 *
 * @package     DuyuMvc
 * @author      Jess
 * @version     1.0
 * @license     http://wiki.duyu.com/duyuMvc
 */

use \lib\models\admin\AdminMenu;
use \lib\dao\BookControllers;

use \backend\dao\Books;
use \backend\dao\BookCategory;
use \backend\dao\BookInfo;
use \backend\dao\BookFields;
use \backend\dao\BookMenu;
use \backend\dao\BookChapter;

class AdminController extends \Yaf\Controller_Abstract 
{

    public function indexAction($mid = false) 
    {
        $display = $this->getView();

        $data = $this->getRequest();

        $adminMenu = AdminMenu::instance();
        $adminMenus = $adminMenu->getMenusToArray();

        $mid = false ? 1 : $mid;

        $display->assign('mid',$mid);
        $display->assign('current',array('menu' => 'dashboard','sub' => 'index'));
        $display->assign('adminMenus',$adminMenus);
        $display->assign('title',"蠹鱼有书");
    }

    public function loginAction()
    {
        $display = $this->getView();

        $data = $this->getRequest();

        $display->assign('current',array('menu' => 'dashboard','sub' => false));
        $display->assign('title',"蠹鱼有书");
    }

    public function postAction($type = 'new', $post_id = false)
    {
        $display = $this->getView();

        $data = $this->getRequest();

        $adminMenu = AdminMenu::instance();
        $adminMenus = $adminMenu->getMenusToArray();

        $menus = BookMenu::instance();
        $category = BookCategory::instance();

        $bookControl = new BookControllers();

        $menuList = $menuRow = $date = $book = array();

        list($date['year'],$date['month'],$date['day'],$date['hour'],$date['minute']) = explode('-',date("Y-m-d-H-i",time()));

        $ccid = $data->isPost() ? $data->getPost('ccid') : false;

        switch ($type) {
            case 'new':
                
                break;
            case 'edit':

                $menuList = $menus->getMenuForBookID($post_id);

                $book = $bookControl->getBooksRow(array('books.bid' => $post_id));
                if ($ccid) {

                }
                else
                {
                    $menuRow = $menus->getMenuAndContentRow($menuList[0]['id']);
                }
                break;
            default:
                
                break;
        }

        $display->assign('menuRow',$menuRow[0]);
        $display->assign('menuList',$menuList);
        $display->assign('categorys',$category->getCategory());
        $display->assign('book',$book);
        $display->assign('date',$date);
        $display->assign('adminMenus',$adminMenus);
        $display->assign('current',array('menu' => 'posts','sub' => 'update'));
        $display->assign('title',"蠹鱼有书 - 编辑");
    }

    public function allbookAction($limit = 10,$page = 1)
    {
        $display = $this->getView();
        $data = $this->getRequest();

        $bookControl = new BookControllers();
        $category = BookCategory::instance();

        $books = $bookControl->getBooksList(array('p.type'=>1),$limit,$page);
        $adminMenu = AdminMenu::instance();
        $adminMenus = $adminMenu->getMenusToArray();

        // print_r($books);
        $display->assign('adminMenus',$adminMenus);
        $display->assign('categorys',$category->getCategory());
        $display->assign('bookList',$books);
        $display->assign('current',array('menu' => 'allbook'));
        $display->assign('title',"蠹鱼有书 - 编辑");
    }

    public function categoryBookAction($limit = 10, $page = 1)
    {
        $display = $this->getView();
        $data = $this->getRequest();

        $adminMenu = AdminMenu::instance();
        $adminMenus = $adminMenu->getMenusToArray();

        $category = BookCategory::instance();

        $display->assign('adminMenus',$adminMenus);
        $display->assign('categorys',$category->getCategory());
        $display->assign('current',array('menu' => 'categorybook'));
        $display->assign('title','');
    }
}

?>