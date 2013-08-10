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
use \local\rest\Restful;
use \Yaf\Session;
use \lib\dao\ProductsControl;

class UserController extends \Yaf\Controller_Abstract 
{
    public function indexAction($action = false)
    {
        $rest = Restful::instance();
        $data = $this->getRequest();
        $user = Members::getCurrentUser();
        $userState = MemberStateTemp::getCurrentUserForAuth();
        $session = Session::getInstance();

        $code = 201;
        $message = "invild";

        switch ($action) {
            case 'callback':
                # code...
                break;
            default:
                # code...
                break;
        }

        $rest->assign('code',$code);
        $rest->assign('message',$message);

        $rest->response();
    }

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
            if (MemberStateTemp::isExpired($userState['expired'])) {
               $code = 205;
               $message = "登录过期，请重新登录";
            }
            else {
                $code = 203;
                $message = "已登录.";
                $authToken = isset($userState['authtoken']) ? $userState['authtoken'] : "";
                $session->set('current_id',$userState['uid']);
                $session->set('authToken',$authToken);
                header("Auth-Token:".$authToken);
            }
        }
        elseif ($data->isPost()) 
        {
            $user = Members::instance();
            $userState = MemberStateTemp::instance();

            $userInfo = $user->login($data);

            if (!$data->isPost('email') || !$data->isPost('password')) 
            {
                $code = 206;
                $message = "参数不完整";
            }
            elseif ($userInfo) {

                $authToken = md5($userInfo['id'].$userInfo['email']);

                $session->set('current_id',$userInfo['id']);
                $session->set('authToken',$authToken);

                $userState->addAuthToken($userInfo['id'],$authToken);

                $code = 200;
                $message = "登录成功";
                header("Auth-Token:".$authToken);
            }
        }


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

            if (!$data->isPost('email') || !$data->isPost('username') || !$data->isPost('password') || !$file) {
                $code = 206;
                $message = "参数不完整";
            }
            elseif (!$data->getPost('email') || !$data->getPost('username') || !$data->getPost('password'))
            {
                $code = 207;
                $message = "参数不能为空";
            }
            elseif($user->isRegistered($data->getPost('email'))) 
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

                    $avatarId = $image->storeFiles($file['avatar'],$userId , 2,'head');

                    $avatarId = $avatarId ? $avatarId : 0;

                    $memberInfo = MemberInfo::instance();
                    $memberState = MemberStateTemp::instance();

                    $infoArr = array(
                        'id' => $userId,
                        'avatar_id' => $avatarId);

                    if ($memberInfo->insert($infoArr)) {
                        $message = "sussceful!!";
                        
                        $authToken = md5($userId.$email);

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
        $userState = MemberStateTemp::instance();
        $current = MemberStateTemp::getCurrentUserForAuth();

        $code = 201;
        $message = "No Data";
        $uid = false;
        if ($session->has("current_id")) {
            $uid = $session->get('current_id');
            $session->del('current_id');
            $session->del('authToken');
        }

        if (isset($current['uid']) and $current['uid'])
        {
            $userState->deleteTokenForUserId($current['uid']);
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

    public function purchasedAction($page = 1 ,$limit = 20)
    {
        $rest = Restful::instance();
        $session = Session::getInstance();
        $userState = MemberStateTemp::getCurrentUserForAuth();

        $list = array();

        $code = 200;
        $message = "ok";

        if (!$userState) {
            $code = 402;
            $message = "No Login.";
        }
        else
        {
            $purchased = new ProductsControl();
            $list = $purchased->getPurchasedForBooks(array('product_purchased.uid'=> $userState["uid"]),$limit,$page);
        }

        $rest->assign('code',$code);
        $rest->assign('message',$message);
        $rest->assign('purchased',$list);
        $rest->response();
    }
}
?>