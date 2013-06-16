<?php
/**
 * ATS Controllers
 *
 * @package     DuyuMvc
 * @author      Jess
 * @version     1.0
 * @license     http://wiki.duyu.com/duyuMvc
 */

use \backend\dao\Members;
use \backend\dao\MemberInfo;
use \backend\dao\Images;
use \backend\dao\Books;
use \backend\dao\BookCategory;
use \backend\dao\BookInfo;
use \backend\dao\BookFields;
use \backend\dao\BookMenu;
use \backend\dao\BookChapter;
use \Yaf\Session;


class WriterController extends \Yaf\Controller_Abstract 
{

    public function indexAction($action = false,$bid = false) 
    {
        $display = $this->getView();

        $data = $this->getRequest();

        $session = Session::getInstance();
        $userInfo = Members::getCurrentUser();
        $user = Members::instance();
        $bookfield = BookFields::instance();

        $book = Books::instance();

        // define varchar
        $button = false;
        $isLogin = false;
        $isPost = $data->isPost();

        $session->__unset('bid');

        // logout from the get field.
        switch ($action) {
            case 'logout':
                if ($user->logout()) {
                    header('Location: /writer/index');
                    exit();
                }
                break;
            case 'review':
                if($bid)  $bookfield->updateBookStatus($bid,1);
                break;
            case 'inreview':
                if($bid)  $bookfield->updateBookStatus($bid,2);
                break;
            case 'unpublished':
                if($bid)  $bookfield->updateBookStatus($bid,3);
                break;
            case 'published':
                if ($bid) $bookfield->updateBookStatus($bid,4);
                break;

            case 'delete':
                if ($bid) $bookfield->updateBookStatus($bid,0);
                break;
            case 'new':
                header('Location: /writer/title');
                exit();
                break;
            default:
                break;
        }

        if (isset($userInfo->id) AND $userInfo->id) 
        {
            $display->assign("title", "首页");
            $isLogin = true;
            $display->assign('list',$book->getCurrentUserWriterBooks());
            $button['right']['name'] = "创建 : 一本新书";
            $button['right']['url'] = "/writer/index/new/0";
        }
        else $display->assign("title", "登录");
        
        if ($isPost AND $data->getPost('state') != NULL) 
        {
            if ($data->getPost('state') == 'index') $user->login($data->getPost('email') , $data->getPost('password'));

            header('Location: /writer/'. $data->getPost('state'));
            exit();
        }
        
        $display->assign('topButton',$button);
        $display->assign("progress",3);
        $display->assign("islogin",$isLogin);
    }

    public function titleAction($bid = false)
    {
        $display = $this->getView();

        $userInfo = Members::getCurrentUser();
        $category = BookCategory::instance();
        $session = Session::getInstance();
        $data = $this->getRequest();
        $button = false;

        if (isset($userInfo->id) and $userInfo->id) {

            $book = Books::instance();
            $bookinfo = BookInfo::instance();
            $bookfield = BookFields::instance();

            //TODO edit
            if($bid)
            {
                $bookData = $book->getBookInfo($bid);
                $session->set('bid',$bid);
                $display->assign('info',$bookData);
            }
            else
            {
                // Update 
                $bid = $book->getEditingCurrent();
                if($bid)
                {
                    $bookData = $book->getBookInfo($bid);
                    $session->set('bid',$bid);
                    $display->assign('info',$bookData);

                }
                else
                {
                    // header('Location: /writer/index');
                    // exit();
                }
                
            }

            $display->assign('user',array(
                'id' => $userInfo->id,
                'email' => $userInfo->email));
            
            if ($data->isPost() and $data->getPost('state') == "title")
            {

                if ($bid){
                    if($book ->where("bid=$bid")->update(array(
                        'title' => $data->getPost('title'),
                        'author' => $data->getPost('author'),
                        'cid' => $data->getPost('category'))))
                    {
                        $bookinfo->where("bid='$bid'")->update(array(
                            'tags' => $data->getPost('tags'))
                        );
                        $bookfield->where("bid='$bid'")->update(array('bid' => $bid,'uid' => $userInfo->id,'modified' => UPDATE_TIME));
                    }
                }
                else
                {
                    $arr = array(
                        'cid' => $data->getPost('category'),
                        'title' => $data->getPost('title'),
                        'author' => $data->getPost('author'),
                        'published' => UPDATE_TIME);
                    if ($bookid = $book->insert($arr)) 
                    {
                        $bookinfo ->insert(array(
                            'bid' => $bookid,
                            'tags' => $data->getPost('tags')
                        ));

                        $bookfield->insert(array(
                            'bid' => $bookid,
                            'uid' => $userInfo->id,
                            'modified' => UPDATE_TIME
                        ));
                        $session->set('bid',$bookid);
                    }
                }

                header('Location: /writer/edit');
                exit();
            }
            
        }
        else
        {
            header('Location: /writer/index');
            exit();
        }

        if ($bid) {
            $info = $book->getBookInfo($bid);
            $display->assign('info',$info);
        }

        $button['left']['name'] = "回首页";
        $button['left']['url'] = "/writer/index";
        $button['right']['name'] = "下一步：文章录入";

        $display->assign('category',$category->getCategory());
        $display->assign('topButton',$button);
        $display->assign("title", "基本信息");
        $display->assign("progress",3);
        
    }

    public function editAction($action = false, $menuid = false)
    {
        $display = $this->getView();

        $userInfo = Members::getCurrentUser();
        $data = $this->getRequest();
        $button = $menuList = $menuRow = false;
        $menu = BookMenu::instance();
        $body = BookChapter::instance();
        $session = Session::getInstance();
        $bid = $session->get("bid");

        if (!$userInfo->id or !$bid) 
        {
            header('Location: /writer/index');
            exit();
        }
        else
        {

            switch ($action) {
                case 'menu':
                    if ($menuid) {
                        $menuRow = $menu->getMenuAndContentRow($menuid);
                        $session->set('current_menu_id',$menuid);
                    }
                    break;
                case 'delete':
                    if ($menuid) $menu->deleteMenuForMenuID($menuid);
                    $session->__unset('current_menu_id');
                    break;
                case 'next':
                    header('Location: /writer/cover');
                    exit();
                    break;
                default:
                    # code...
                    break;
            }

            if($data->isPost() and $data->getPost('state') == "edit")
            {
                $menu_arr = array(
                    'bid' => $bid,
                    'title' => $data->getPost('menu-title'),
                    // 'author' => $data->getPost('menu-author'),
                    'summary' => $data->getPost('menu-summary'));

                if($menuid || $session->get('current_menu_id')){
                    $menu_arr['id'] = $menuid ? $menuid : $session->get('current_menu_id');
                    $sort = $data->getPost('sort');
                    $menu_arr['sort'] = empty($sort) ? 0 : $data->getPost('sort');
                    $menu->where("id='$menuid'")->update($menu_arr);
                }
                else{
                    $menu_arr['sort'] = 0;
                    $menuid = $menu->insert($menu_arr);
                };

                if ($menuid || $session->get('current_menu_id')){
                    $content = array(
                        'menu_id' => $menuid ? $menuid : $session->get('current_menu_id'),
                        'body' => $data->getPost('textarea-content'));
                        $body->addContent($content);
                        $session->__unset('current_menu_id');
                    }
                }

            $menuList = $menu->getMenuForBookID($bid);

        }

        $button['left']['name'] = "录入下一篇";

        $button['right']['name'] = "下一步-封面设计";
        $button['right']['url'] = "/writer/cover";

        $display->assign("menuRow",$menuRow[0]);
        $display->assign('userinfo',array('userid' => $userInfo->id,'username'=>$userInfo->username));
        $display->assign('menuList',$menuList);
        $display->assign("title", "文章录入");
        $display->assign('topButton',$button);
        $display->assign("progress",33);
    }

    public function coverAction()
    {
        $display = $this->getView();
        $userInfo = Members::getCurrentUser();
        $session = Session::getInstance();
        $button  = false;
        $data = $this->getRequest();
        $bid = $session->get("bid");

        if (!$userInfo->id or !$bid) 
        {
            header('Location: /writer');
            exit();
        }
        else
        {
            if ($data->isPost() and $data->getPost('state') == "cover") 
            {
                header('Location: /writer/end');
                exit();
            }
            
        }

        $button['left']['name'] = "文章录入";
        $button['left']['url'] = "/writer/edit";

        $button['right']['name'] = "下一步-撰写导言";
        $button['right']['url'] = "/writer/end";

        $display->assign('topButton',$button);
        $display->assign("title", "封面设计");
        $display->assign("progress",66);
    }

    public function endAction()
    {
        $display = $this->getView();
        $userInfo = Members::getCurrentUser();
        $button  = false;
        $data = $this->getRequest();
        $session = Session::getInstance();
        $bid = $session->get("bid");

        if (!$userInfo->id or !$bid) 
        {
            header('Location: /writer/index');
            exit();
        }
        else
        {
            if ($data->isPost() and $data->getPost('state') == "cover") 
            {
                // header('Location: /writer/end');
                // exit();
            }
        }

        $button['right']['name'] = "完成并提交全本";
        $button['right']['url'] = "/writer/end";

        $display->assign('topButton',$button);
        $display->assign("progress",99);
        $display->assign("title", "基本信息");
    }

}

?>