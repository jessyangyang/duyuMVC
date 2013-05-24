<?php
/**
 * ATS Controllers
 *
 * @package     DuyuMvc
 * @author      Jess
 * @version     1.0
 * @license     http://wiki.duyu.com/duyuMvc
 */

use \duyuAT\dao\Members;
use \duyuAT\dao\MemberInfo;
use \duyuAT\dao\Images;
use \duyuAT\dao\Books;
use \duyuAT\dao\BookCategory;
use \duyuAT\dao\BookInfo;
use \duyuAT\dao\BookFields;
use \Yaf\Session;


class WriterController extends \Yaf\Controller_Abstract 
{

    public function indexAction($action = false,$bid = false,$value = false) 
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
            case 'state':
                if($bid)
                {
                    if($value == 1) $value = 0;
                    else if ($value == 0) $value = 1; 
                    $bookfield->updateBookStatus($bid,$value);
                }
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
            // $button['right']['url'] = "/writer/title";
        }
        else $display->assign("title", "登录");
        
        if ($isPost AND $data->getPost('state') != NULL) 
        {
            if ($data->getPost('state') == 'index') $user->login($data->getPost('email') , $data->getPost('password'));

            header('Location: /writer/'. $data->getPost('state'));
            exit();
        }
        
        $display->assign('topButton',$button);
        $display->assign("progress",0);
        $display->assign("islogin",$isLogin);
    }

    public function titleAction($bid = false,$state = false)
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

            //TODO
            if($bid)
            {
                $bookData = $book->getBookInfo($bid);
                $session->set('bid',$bid);
                $display->assign('info',$bookData);
            }
            else
            {
                $bid = $book->getEditingCurrent();
                if($bid)
                {
                    $bookData = $book->getBookInfo($bid);
                    $session->set('bid',$bid);
                    $display->assign('info',$bookData);

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
        $button['right']['name'] = "下一步：编辑内容";

        $display->assign('category',$category->getCategory());
        $display->assign('topButton',$button);
        $display->assign("title", "基本信息");
        $display->assign("progress",0);
        
    }

    public function editAction()
    {
        $display = $this->getView();

        $userInfo = Members::getCurrentUser();
        $data = $this->getRequest();
        $button = false;

        if (!$userInfo->id) 
        {
            header('Location: /writer/index');
            exit();
        }
        else
        {
            if ($data->isPost() and $data->getPost('state') == "edit") 
            {
                // header('Location: /writer/cover');
                // exit();
            }
        }

        $button['left']['name'] = "录入下一篇";
        $button['right']['name'] = "下一步-封面设计";

        $display->assign("title", "编辑内容");
        $display->assign('topButton',$button);
        $display->assign("progress",30);
    }

    public function coverAction()
    {
        $display = $this->getView();
        $userInfo = Members::getCurrentUser();
        $data = $this->getRequest();

        if (!$userInfo->id) 
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
        $display->assign("title", "基本信息");
    }

    public function endAction()
    {
        $display = $this->getView();
        $userInfo = Members::getCurrentUser();
        $data = $this->getRequest();
        if (!$userInfo->id) 
        {
            header('Location: /writer');
            exit();
        }
        $display->assign("title", "基本信息");
    }

}

?>