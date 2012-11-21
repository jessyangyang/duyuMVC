<?php
/**
 * Test Controllers
 *
 * @package     DuyuMvc
 * @author      Jess
 * @version     1.0
 * @license     http://wiki.duyu.com/duyuMvc
 */

use \duyuu\dao\Members;
use \duyuu\dao\MemberInfo;
use \duyuu\dao\Images;
use \duyuu\rest\Restful;
use \Yaf\Session;

class testController extends \Yaf\Controller_Abstract 
{

    public function indexAction() 
    {
        echo "index";
        exit();
    }

    public function testAction($id = false)
    {
        echo "test:$id";
        exit();
    }

    public function regAction()
    {
        $display = $this->getView();
        $user = new \duyuu\dao\Members();
        $session = Session::getInstance();

        $user = Members::instance();
        $image = Images::instance();

        $code = 201;
        $message = "No Data";
        $session = Session::getInstance();

        $data = $this->getRequest();
        $message = "invild!";
        if ($data->isPost() and $data->getPost('state') == 'reg') {
            if($user->isRegistered($data->getPost('email'))) 
            {
                $message = "already register!!";

            }
            else {
                
                $arr = array(
                        'email' => addslashes($data->getPost('email')),
                        'username' => addslashes($data->getPost('username')),
                        'password' => md5(trim($data->getPost('password'))),
                        'published' => time(),
                        'role_id' => 4
                    );
                
                if ($userId = $user->insert($arr)) {

                    $file  = $data->getFiles();

                    
                    $avatarId = $image->storeFiles($file['avatar'],$userId , 2,'head');

                    $avatarId = $avatarId ? $avatarId : 0;

                    

                    $memberInfo = MemberInfo::instance();
                    

                    $infoArr = array(
                        'id' => $userId,
                        'avatar_id' => $avatarId);

                    $infoId = $memberInfo->insert($infoArr);

                    if ($infoId) {
                        $code = 200;
                        $message = "注册成功!!";
                        $session->set('current_id',$userId);
                        $session->set('authToken',md5($userId));

                        header("Auth-Token:".$session->get('authToken'));
                    }
                    

                }
            }
        }

        $display->assign("title", "Hello Wrold");
        $display->assign("message", $message);
    }

    public function addClientAction()
    {
        $display = $this->getView();

        $client = new \duyuu\dao\OAuthClient();
        $message = '';

        $data = $this->getRequest();

        if ($data->isPost() and $data->getPost('state') == "add") {
            $title = $data->getPost('title');
            $summary = $data->getPost('summary');
            $summary = $data->getPost('summary');
            $redirectUrl = $data->getPost('redirect_url');
            $user = Members::getCurrentUser();

            if ($user) {
                $data = array(
                    'client_id' => md5($user->email),
                    'client_secret' => md5($user->email.$user->password),
                    'redirect_url' => $redirectUrl);
                
                if ($client->insert($data)) {
                    $message = "success!!";
                }
            }
            
        }

        $display->assign('title',"addClient");
        $display->assign('message',$message);
    }

    public function loginAction()
    {
        $display = $this->getView();

        $data = $this->getRequest();
        if ($data->isPost() and $data->getPost('state') == 'login') {
            $wherearr = "email='" .$data->getPost('email') . "' AND password='" . md5($data->getPost('password')) . "'";
            $user = Members::instance();
            $row = $user->where($wherearr)->fetchRow();

            if ($row) {
                $session = Yaf\Session::getInstance();
                $session->set('current_id',$row['id']);
                // header("Location:/api/test/addClient");
                $session->set('authToken',md5($row['id']));
                header("Auth-Token:".$session->get('authToken'));
            }
        }

        $userInfo = Members::getCurrentUser();

        if ($userInfo) {
            $display->assign('user',array(
                'id' => $userInfo->id,
                'email' => $userInfo->email));
        }
        else
        {
            $display->assign('user',"");
        }
        
        $display->assign('title','login');
    }

    public function authAction()
    {
        $appKey = $_SERVER[''];

        exit();
    }

    public function uploadAction()
    {
        $display = $this->getView();

        $data = $this->getRequest();

        if ($data->isPost() and $data->getPost('state') == "upload") {
            
            $file  = $data->getFiles();
            $image = new \duyuu\image\ImageControl();
            $class = $data->getPost('type') ? $data->getPost('type') : 1;

            $image->save($file['file'],$class);
        }

        $display->assign('title', 'upload');
    }
}

?>