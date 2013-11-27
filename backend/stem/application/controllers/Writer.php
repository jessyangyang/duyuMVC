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
use \lib\dao\BookControllers;

use \backend\image\ImageControl;
use \Yaf\Session;


class WriterController extends \Yaf\Controller_Abstract 
{

    public function indexAction($action = false,$bid = false) 
    {
        $display = $this->getView();

        $data = $this->getRequest();

        $session = Session::getInstance();
        $userInfo = Members::getCurrentUser();
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
                if ($userInfo->logout()) {
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
            $button['right']['type'] = "btn-danger";
            $button['right']['action'] = "btn-next";
        }
        else $display->assign("title", "登录");
        
        if ($isPost AND $data->getPost('state') != NULL) 
        {
            if ($data->getPost('state') == 'index') $userInfo->login($data->getPost('email') , $data->getPost('password'));

            header('Location: /writer/'. $data->getPost('state'));
            exit();
        }
        
        $display->assign('member',$userInfo);
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
                    $book ->where("bid=$bid")->update(array(
                        'title' => $book->escapeString($data->getPost('title')),
                        'author' => $book->escapeString($data->getPost('author')),
                        'cid' => $book->escapeString($data->getPost('category'))));
                    
                    $bookinfo->where("bid='$bid'")->update(array(
                            'tags' => $book->escapeString($data->getPost('tags')))
                    );
                    $bookfield->where("bid='$bid'")->update(array('bid' => $bid,'uid' => $userInfo->id,'modified' => UPDATE_TIME));
                }
                else
                {
                    $arr = array(
                        'cid' => $book->escapeString($data->getPost('category')),
                        'title' => $book->escapeString($data->getPost('title')),
                        'author' => $book->escapeString($data->getPost('author')),
                        'published' => UPDATE_TIME);
                    if ($bookid = $book->insert($arr)) 
                    {
                        $bookinfo ->insert(array(
                            'bid' => $bookid,
                            'tags' => $book->escapeString($data->getPost('tags'))
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
        $button['right']['type'] = "btn-danger";
        $button['right']['action'] = "btn-next";

        $display->assign('member',$userInfo);
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
                case 'sort':
                    if ($data->isPost()) {
                        $titles = $data->getPost('menuTitle');
                        $sorts = $data->getPost('menuSort');
                        $mids = $data->getPost('menuMid');

                        $sql = "UPDATE $menu->table SET title = CASE id ";
                        $tmp = ' END, sort = CASE id ';
                        $ids = implode(',', array_values($mids));
                        foreach ($mids as $key => $value) 
                        {
                            $sql .= " WHEN $value THEN '$titles[$key]' ";
                            $tmp .= " WHEN $value THEN '$sorts[$key]' ";
                        }
                        $sql .= $tmp . "END WHERE id IN ($ids) AND bid='$bid'";
                        $menu->query($sql);
                        exit();
                    }
                    break;
                case 'next':
                    header('Location: /writer/cover');
                    exit();
                    break;
                case 'submit':
                    if($data->isPost() and $data->getPost('state') == "edit")
                    {
                        $menu_arr = array(
                            'bid' => $bid,
                            'title' => $menu->escapeString($data->getPost('menu-title')),
                            // 'author' => $data->getPost('menu-author'),
                            'summary' => $menu->escapeString($data->getPost('menu-summary')));

                        if($menuid || $session->get('current_menu_id')){
                            $menu_arr['id'] = $menuid ? $menuid : $session->get('current_menu_id');
                            $sort = $data->isPost('sort') ? $data->getPost('sort') : 0;
                            $menu_arr['sort'] = $sort;
                            $menu->where("id='$menuid'")->update($menu_arr);
                        }
                        else{
                            $menu_arr['sort'] = $menu->escapeString($data->getPost('sort-count') + 1);
                            $menuid = $menu->insert($menu_arr);
                        };

                        $content = array(
                            'menu_id' => $menuid ? $menuid : $session->get('current_menu_id'),
                            'body' => $body->escapeString($data->getPost('textarea-content')));
                        $body->addContent($content);
                        $session->__unset('current_menu_id');
                    }
                    break;
                default:
                    # code...
                    break;
            }
            $menuList = $menu->getMenuForBookID($bid);
        }

        $button['left']['name'] = "上一步：基本信息";
        $button['left']['url'] = "/writer/title";
        $button['center']['name'] = "录入下一篇";
        $button['center']['action'] = "btn-next";
        $button['right']['name'] = "下一步-封面设计";
        $button['right']['url'] = "/writer/cover";
        $button['right']['type'] = "btn-danger";

        $display->assign("menuRow",$menuRow[0]);
        $display->assign('userinfo',array('userid' => $userInfo->id,'username'=>$userInfo->username));
        $display->assign('member',$userInfo);
        $display->assign('menuList',$menuList);
        $display->assign("title", "文章录入");
        $display->assign('topButton',$button);
        $display->assign("progress",33);
    }

    public function coverAction($type = false)
    {
        $display = $this->getView();
        $userInfo = Members::getCurrentUser();
        $session = Session::getInstance();
        $button  = $coverPath =false;
        $data = $this->getRequest();
        $bid = $session->get("bid");
        $code = 0;


        if (!$userInfo->id or !$bid) 
        {
            header('Location: /writer');
            exit();
        }
        else
        {
            $image = new ImageControl();

            $bookImage = $image->getImagesForBookid($bid,1);

            $coverPath = isset($bookImage[0]['path']) ?  ImageControl::getRelativeImage($bookImage[0]['path']) : false;

            if ($data->isPost() and $data->getPost('state') == "cover") 
            {

                $files = $data->getFiles();

                // if file null. return false
                if (count($files) < 0) {
                    return false;
                }

                foreach ($files as $key => $file) {
                    $path = '';
                    $type = $key;
                    switch ($type) {
                        case 'cover':
                            $code = 3;
                            $path = "book";
                            break;
                        case 'thumb':
                            $code = 1;
                            $path = "image";
                            break;
                        default:
                            # code...
                            break;
                    }

                    if($file['size'] > 0 and $type and $code > 0)
                    {
                        $item = $image->getBookImageRow(array(
                                'bid'=>$bid,
                                'type'=> $code));

                        if($item)
                        {
                            if($image->deleteImagesForPid($item['pid']))
                            {
                                $avatarId = $image->save($file,$userInfo->id,$code,$path);
                                $image->updateBookImage($item['id'],array('pid' => $avatarId));
                            }
                        }
                        else
                        {
                            $avatarId = $image->save($file,$userInfo->id , $code,$path);
                            $image->addBookImage($avatarId,$bid,$code);
                        }
                    }
                }
                

                header('Location: /writer/end');
                exit();
            }
            
        }

        $button['left']['name'] = "上一步：文章录入";
        $button['left']['url'] = "/writer/edit";

        $button['right']['name'] = "下一步-撰写导言";
        // $button['right']['url'] = "/writer/end";
        $button['right']['type'] = "btn-danger";
        $button['right']['action'] = "btn-next";

        $display->assign('member',$userInfo);
        $display->assign("cover",$coverPath);
        $display->assign('topButton',$button);
        $display->assign("title", "封面设计");
        $display->assign("progress",66);
    }

    public function endAction()
    {
        $display = $this->getView();
        $userInfo = Members::getCurrentUser();
        $button = $book = $summary = false;
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
            $book = new BookControllers();

            $summary = $book->getBooksRow(array('books.bid'=>$bid));


            if ($data->isPost() and $data->getPost('state') == "end") 
            {

                $book->updateBooks($bid,array('summary'=>$userInfo->escapeString($data->getPost('summary'))));

                $book->saveBook($bid);

                header('Location: /writer/index');
                exit();
            }
        }

        $button['left']['name'] = "上一步：封面设计";
        $button['left']['url'] = "/writer/cover";
        $button['right']['name'] = "完成并提交全本";
        $button['right']['url'] = "/writer/end";
        $button['right']['type'] = "btn-danger";
        $button['right']['action'] = "btn-next";

        $display->assign('summary',$summary['summary']);
        $display->assign('member',$userInfo);
        $display->assign('topButton',$button);
        $display->assign("progress",99);
        $display->assign("title", "基本信息");
    }
}

?>