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
use \Yaf\Session;

class AtsController extends \Yaf\Controller_Abstract 
{

    public function indexAction($action = false) 
    {
        $display = $this->getView();

        $data = $this->getRequest();

        $userInfo = Members::getCurrentUser();
        $user = Members::instance();
        $session = Session::getInstance();


        switch ($action) {
            case 'logout':
                if ($user->logout()) {
                    header('Location: /ats/index');
                    exit();
                }
                break;
            default:
                # code...
                break;
        }

        if (isset($userInfo->id) AND $userInfo->id AND $data->getPost('state') != 'index') 
        {
            header('Location: /ats/title');
            exit();
        }
        elseif ($data->isPost() AND $data->getPost('state') == 'index') 
        {
            if ($user->login($data->getPost('email') , $data->getPost('password')))
            {
                header('Location: /ats/title');
                exit();
            }
        }
        
        $display->assign("title", "Login");
    }

    public function titleAction()
    {
        $display = $this->getView();

        $userInfo = Members::getCurrentUser();
        $data = $this->getRequest();
        $bid = "";

        if (isset($userInfo->id) and $userInfo->id) {
            $book = Books::instance();
            $bid = $book->getEditingCurrent();

            $display->assign('user',array(
                'id' => $userInfo->id,
                'email' => $userInfo->email));
            
            if ($data->isPost() and $data->getPost('state') == "title") 
            {
                if ($bid){
                    $book ->where("bid=$bid")->update(array(
                        'title' => $data->getPost('title'),
                        'author' => $data->getPost('author'),
                        'modified' => UPDATE_TIME));
                }
                else
                {
                    $arr = array(
                        'cid' => 0,
                        'title' => $data->getPost('title'),
                        'author' => $data->getPost('author'),
                        'published' => UPDATE_TIME,
                        'modified' => UPDATE_TIME);
                    if ($bookid = $book->insert($arr)) {
                        $session = Session::getInstance();
                        $session->set('bid',$bookid);
                    }
                }

                header('Location: /ats/edit');
                exit();
            }
        }
        else
        {
            header('Location: /ats/index');
            exit();
        }

        $display->assign('info',"");

        if ($bid) {
            $info = $book->getBookInfo($bid);

            $display->assign('info',$info);
        }


        
        $display->assign("title", "基本信息");
        
    }

    public function editAction()
    {
        $display = $this->getView();
        $userInfo = Members::getCurrentUser();
        $data = $this->getRequest();

        if (!$userInfo->id) 
        {
            header('Location: /ats');
            exit();
        }
        else
        {
            if ($data->isPost() and $data->getPost('state') == "edit") 
            {
                header('Location: /ats/cover');
                exit();
            }
        }
        $display->assign("title", "基本信息");
    }

    public function coverAction()
    {
        $display = $this->getView();
        $userInfo = Members::getCurrentUser();
        $data = $this->getRequest();

        if (!$userInfo->id) 
        {
            header('Location: /ats');
            exit();
        }
        else
        {
            if ($data->isPost() and $data->getPost('state') == "cover") 
            {
                header('Location: /ats/end');
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
            header('Location: /ats');
            exit();
        }
        $display->assign("title", "基本信息");
    }

}

?>