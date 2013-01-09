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
use \duyuu\dao\MemberInfo;
use \duyuu\dao\Images;
use \duyuu\dao\OAuthAccessTokens;
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
            $code = 200;
            $message = "already login.";
        }
        elseif ($data->isPost()) 
        {
            $user = Members::instance();

            $wherearr = "email='" .$data->getPost('email') . "' AND password='" . md5($data->getPost('password')) . "'";
            $row = $user->where($wherearr)->fetchRow();

            if ($row) {
                $auth = OAuthAccessTokens::instance();

                if ($state = $auth->hasArrow(md5($row['id']))) {
                    $session->set('current_id',$state['user_id']);
                    $session->set('authToken',$state['oauth_token']);
                }
                else
                {
                    $authArr = array(
                            'oauth_token' => md5($row['id']),
                            'client_id' => $row['id'],
                            'user_id' => $row['id'],
                            'expires' => strtotime("next Monday"));
                    $auth->insert($authArr);
                    $session->set('current_id',$row['id']);
                    $session->set('authToken',md5($row['id']));
                }

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
            $file = $data->getFiles();

            if($user->isRegistered($data->getPost('email'))) 
            {
                $code = 204;
                $message = "already register!!";

            }
            else 
            {
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

                    if ($memberInfo->insert($infoArr)) {
                        $message = "sussceful!!";

                        $auth = OAuthAccessTokens::instance();
                        
                        $authArr = array(
                            'oauth_token' => md5($userId),
                            'client_id' => $userId,
                            'user_id' => $userId,
                            'expires' => strtotime("next Monday"));
                        $auth->insert($authArr);
                        $session->set('current_id',$userId);
                        $session->set('authToken',md5($userId));

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
        $rest = Restful::instance();
        $session = Session::getInstance();

        $code = 201;
        $message = "No Data";

        if ($session->isset("current_id")) {
            $session->__unset('current_id');
            $session->__unset('authToken');

            $code = 200;
            $message = "ok";
        }

        $rest->assign('code',$code);
        $rest->assign('message',$message);
        $rest->response();
    }

    public function profileAction()
    {
        $rest = Restful::instance();

        $rest->response();
    }
}
?>