<?php
/**
* User API 
*
* @package     DuyuMvc
* @author      Jess
* @version     1.0
* @license     http://wiki.duyu.com/duyuMvc
*/

use \duyuu\dao\Members;
use \duyuu\dao\Images;
use \duyuu\rest\Restful;
use \Yaf\Session;

class UserController extends \Yaf\Controller_Abstract 
{
    public function loginAction()
    {
        $rest = Restful::instance();
        $data = $this->getRequest();
        $user = Members::getCurrentUser();
        $session = Session::getInstance();

        $code = 201;
        $message = "invild!";

        if (isset($user->id))
        {
            $code = 302;
            $message = "already login.";
        }
        elseif ($data->isPost()) 
        {
            $user = Members::instance();

            $wherearr = "email='" .$data->getPost('email') . "' AND password='" . md5($data->getPost('password')) . "'";
            $row = $user->where($wherearr)->fetchRow();

            if ($row) {
                $session->set('authToken',md5($row['id']));

                $code = 200;
                $message = "ok";
                header("Auth-Token:".$session->get('authToken'));
            }
        }


        $rest->assign('code',$code);
        $rest->assign('message',$message);
        $rest->assign('authToken',$session->get('authToken') ? $session->get('authToken') : "");

        $rest->response();
    }

    public function registerAction()
    {
        $rest = Restful::instance();

        $user = Members::instance();
        $image = Images::instance();

        $code = 201;
        $message = "No Data";

        $data = $this->getRequest();
        $session = Session::getInstance();

        if ($data->isPost()) {
            $file  = $data->getFiles();

            if($user->where("email='".$data->getPost('email')."'")->fetchRow()) 
            {
                $code = 204;
                $message = "already register!!";

            }
            else {

                $avatarId = $image->storeFiles($file['avatar'],2);
                $avatarId = $avatarId ? $avatarId : 0;

                echo $avatarId;

               if ($avatarId) {
                    $arr = array(
                        'email' => addslashes($data->getPost('email')),
                        'username' => addslashes($data->getPost('username')),
                        'password' => md5(trim($data->getPost('password'))),
                        'published' => time(),
                        'avatar_id' => $avatarId,
                        'role_id' => 3
                        );
                    if($user->insert($arr)) {
                        $image->commit();
                        $message = "sussceful!!";
                        $session->set('authToken',md5($avatarId));
                        header("Auth-Token:".$session->get('authToken'));
                    }
                }
            }


        }

        $rest->assign('code',$code);
        $rest->assign('message',$message);
        $rest->assign('authToken',$session->get('authToken') ? $session->get('authToken') : "");

        $rest->response();
    }

    public function logoutAction()
    {

    }

    public function profileAction()
    {

    }
}
?>