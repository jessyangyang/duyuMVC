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

    public function indexAction() 
    {
        $display = $this->getView();

        $userInfo = Members::getCurrentUser();

        print_r($userInfo);

        if ($userInfo) {
            header('Location: /ats/title');
        }
        $user = Members::instance();
        $data = $this->getRequest();
        if ($data->isPost() and $data->getPost('email')) {
            if ($user->login($data->getPost('email') , $data->getPost('password')))
            {
                header('Location: /ats/title');
                exit;
            }
        }
        
        $display->assign("title", "Login");
    }

    public function titleAction()
    {
        $display = $this->getView();

        $userInfo = Members::getCurrentUser();
        $data = $this->getRequest();

        if (!$userInfo->id) 
        {
            header('Location: /ats');
            exit;
        }

        $book = Books::instance();
        $bid = $book->getEditingCurrent();

        
        if ($data->isPost() and $data->getPost('state') == "title") 
        {
            print_r($data);
            if ($bid){
                $book ->where("bid=$bid")->update(array(
                    'title' => $data->getPost('title'),
                    'author' => $data->getPost('author'),
                    'modified' => START_TIME));
            }
            else
            {
                $arr = array(
                    'cid' => 0,
                    'title' => $data->getPost('title'),
                    'author' => $data->getPost('author'),
                    'published' => START_TIME,
                    'modified' => START_TIME);
                if ($bookid = $book->insert($arr)) {
                    $session = Session::getInstance();
                    $session->set('bid',$bookid);
                }
            }
            // header('Location: /ats/edit');
            // exit;
        }

        $display->assign('info',"");

        if ($bid) {
            $info = $book->getBookInfo($bid);
            $display->assign('info',$info);
        }

        $display->assign('user',array(
                'id' => $userInfo->id,
                'email' => $userInfo->email));
        $display->assign("title", "基本信息");
    }

    public function editAction()
    {
        $display = $this->getView();
        $userInfo = Members::getCurrentUser();
        if (!$userInfo->id) 
        {
            header('Location: /ats');
            exit;
        }
        $display->assign("title", "基本信息");
    }

    public function coverAction()
    {
        $display = $this->getView();
        $userInfo = Members::getCurrentUser();
        if (!$userInfo->id) 
        {
            header('Location: /ats');
            exit;
        }
        $display->assign("title", "基本信息");
    }

    public function endAction()
    {
        $display = $this->getView();
        $userInfo = Members::getCurrentUser();
        if (!$userInfo->id) 
        {
            header('Location: /ats');
            exit;
        }
        $display->assign("title", "基本信息");
    }

}

?>