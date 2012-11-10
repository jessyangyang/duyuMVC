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

        $data = $this->getRequest();
        $message = "invild!";
        if ($data->isPost() and $data->getPost('state') == 'reg') {
            if($user->where("email='".$data->getPost('email')."'")->fetchRow()) 
            {
                $message = "already register!!";

            }
            else {
                $arr = array(
                    'email' => addslashes($data->getPost('email')),
                    'username' => addslashes($data->getPost('username')),
                    'password' => md5(trim($data->getPost('password'))),
                    'published' => time(),
                    'role_id' => 3
                    );
                if($user->insert($arr)) $message = "sussceful!!";
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
            $user = new Members();
            $row = $user->where($wherearr)->fetchRow();
            if ($row) {
                $session = Yaf\Session::getInstance();
                $session->set('current_id',$row['id']);
                header("Location:/api/test/addClient");
            }
        }

        $user = \duyuu\dao\Members::getCurrentUser();
        if ($user) {
            $display->assign('user',array(
                'id' => $user->id,
                'email' => $user->email));
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