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
                    'email' => $data->getPost('email'),
                    'username' => $data->getPost('username'),
                    'password' => md5(trim($data->getPost('password')))
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

        // $client = new \duyuu\dao\OAuthClient();
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
                if ($user->insert($data)) {
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
            $user = \duyuu\dao\Members::instance()->where($wherearr)->fetchRow();
            if ($user) {
                $session = Yaf\Session::getInstance();
                $session->set('current_id',$user['id']);
                header("Location:/api/test/addClient");
            }
        }

        $display->assign('title','login');
    }
}

?>