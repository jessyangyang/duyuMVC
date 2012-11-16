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
    public function loginAction($email,$password)
    {
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
                $avatarId = $image->storeFiles($file['avatar'],2) ? $image->storeFiles($file['avatar'],2) : 0;

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