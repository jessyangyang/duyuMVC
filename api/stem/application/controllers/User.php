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
use \duyuu\dao\MemberStateTemp;
use \duyuu\dao\Images;
use \duyuu\dao\OAuthAccessTokens;
use \local\rest\Restful;
use \Yaf\Session;

class UserController extends \Yaf\Controller_Abstract 
{
    public function loginAction()
    {
        $rest = Restful::instance();
        $data = $this->getRequest();
        $user = Members::getCurrentUser();
        $userState = MemberStateTemp::getCurrentUserForAuth();
        $session = Session::getInstance();
        $userInfo = $authToken = array();

        $code = 201;
        $message = "invild!";

        if ($userState)
        {
            $code = 203;
            $message = "already login.";
            $authToken = isset($userState['authtoken']) ? $userState['authtoken'] : "";
        }
        elseif ($data->isPost()) 
        {
            $user = Members::instance();
            $userState = MemberStateTemp::instance();

            $userInfo = $user->login($data);

            if ($userInfo) {
                $auth = OAuthAccessTokens::instance();

                $authToken = md5($userInfo['id'].$userInfo['email']);

                if ($state = $auth->hasArrow($authToken)) {
                    $session->set('current_id',$state['user_id']);
                    $session->set('authToken',$state['oauth_token']);
                }
                else
                {

                    $authArr = array(
                            'oauth_token' => md5($userInfo['id']),
                            'client_id' => $userInfo['id'],
                            'user_id' => $userInfo['id'],
                            'expires' => strtotime("next Monday"));
                    $auth->insert($authArr);
                    $session->set('current_id',$userInfo['id']);
                    $session->set('authToken',$authToken);
                }

                $userState->addAuthToken($userInfo['id'],$authToken);

                $code = 200;
                $message = "ok";
            }
        }

        header("Auth-Token:".$authToken);

        $rest->assign('code',$code);
        $rest->assign('message',$message);
        $rest->assign('userInfo',$userInfo);
        $rest->assign('authToken',$authToken ? $authToken : "");

        $rest->response();
    }

    public function registerAction()
    {
        $rest = Restful::instance();

        $user = Members::instance();
        $image = Images::instance();

        $code = 200;
        $message = "No Data.";

        $data = $this->getRequest();
        $session = Session::getInstance();

        $authToken = "";

        if ($data->isPost()) {
            $file = $data->getFiles();

            if($user->isRegistered($data->getPost('email'))) 
            {
                $code = 204;
                $message = "already register!!";

            }
            else 
            {
                $email = addslashes($data->getPost('email'));

                $arr = array(
                        'email' => $email,
                        'username' => addslashes($data->getPost('username')),
                        'password' => md5(trim($data->getPost('password'))),
                        'published' => time(),
                        'role_id' => 500
                    );
                
                if ($userId = $user->insert($arr)) {

                    $file  = $data->getFiles();
                    $avatarId = $image->storeFiles($file['avatar'],$userId , 2,'head');

                    $avatarId = $avatarId ? $avatarId : 0;

                    $memberInfo = MemberInfo::instance();
                    $memberState = MemberStateTemp::instance();

                    $infoArr = array(
                        'id' => $userId,
                        'avatar_id' => $avatarId);

                    if ($memberInfo->insert($infoArr)) {
                        $message = "sussceful!!";

                        $auth = OAuthAccessTokens::instance();
                        
                        $authToken = md5($userId.$email);
                        $authArr = array(
                            'oauth_token' => $authToken,
                            'client_id' => $userId,
                            'user_id' => $userId,
                            'expires' => strtotime("next Monday"));
                        $auth->insert($authArr);

                        //temp
                        $memberState->addAuthToken($userId,$authToken);


                        $session->set('current_id',$userId);
                        $session->set('authToken',$authToken);

                        header("Auth-Token:".$authToken);
                    }

                }
            }
        }

        $rest->assign('code',$code);
        $rest->assign('message',$message);
        $rest->assign('authToken',$authToken ? $authToken : "");

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