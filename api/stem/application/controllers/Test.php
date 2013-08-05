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
use \duyuu\dao\Comments;
use \duyuu\dao\OAuthAccessTokens;
use \duyuu\dao\MemberStateTemp;
use \local\rest\Restful;
use \Yaf\Session;
use \lib\dao\OAuth2Storage;
use \lib\models\MemberFields;

use local\oauth2\OAuth2;
use local\oauth2\OAuth2ServerException;

class testController extends \Yaf\Controller_Abstract 
{

    public function indexAction() 
    {
        $display = $this->getView();

        $data = $this->getRequest();

        $host = $data->getServer("HTTP_HOST");

        $user = Members::getCurrentUser();

        $url = '';

        if (isset($user->id) and $user->id) {
            $fields = MemberFields::instance($user->id);
            $session = Session::getInstance();

            $session->set('state',md5(uniqid(rand(),TRUE)));

            $oauth = new OAuth2Storage();

            $client = $oauth->getClient($fields->app_key);
            $state = $session->get('state');
            $url = "http://$host/api/test/authorize?response_type=code&client_id=" .$client['client_id']. "&redirect_uri=" . $client['redirect_uri']. "&state=$state";
        }

        $display->assign("title", "start");
        $display->assign("url", $url);
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
                        'role_id' => 500
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

    public function loginAction()
    {
        $display = $this->getView();

        $data = $this->getRequest();
        if ($data->isPost() and $data->getPost('state') == 'login') {
            $wherearr = "email='" .$data->getPost('email') . "' AND password='" . md5($data->getPost('password')) . "'";
            $user = Members::instance();
            $row = $user->where($wherearr)->fetchRow();
            $userState = MemberStateTemp::instance();

            if ($row) {
                $auth = OAuthAccessTokens::instance();
                $session = Session::getInstance();
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

    public function addCommentAction()
    {
        $display = $this->getView();

        $data = $this->getRequest();

        $comment = Comments::instance();
        $userInfo = Members::getCurrentUser();

        $message = "false";

        if ($userInfo) {
            $display->assign('user',array(
                'id' => $userInfo->id,
                'email' => $userInfo->email));
        }
        else
        {
            $display->assign('user',"");
        }
        if ($data->isPost() and $data->getPost('state') == 'comment') {
            if($comment->addComment($data)) $message = "true";
        }
        $display->assign('message',$message);
        $display->assign('title','comments');
    }

    public function purchasedAction()
    {
        $display = $this->getView();

        $data = $this->getRequest();
        
    }

    public function addclientAction()
    {
        $display = $this->getView();

        $data = $this->getRequest();
        
        $message = "";

        if ($data->isPost()) 
        {
            $uid = $data->getPost('uid') ? $data->getPost('uid') : '';

            $host = $data->getServer("HTTP_HOST");
            if ($uid) {
                $user = Members::instance($uid);
                
                if ($user->id) {
                    $appkey = time()+time();
                    
                    $secret = $user->id . $user->email;

                    $oauth = new OAuth2Storage();
                    $fields = MemberFields::instance($user->id);

                    $result = $oauth->addClient($appkey,$secret,"http://$host/api/test/callback");
                    if ($result) {
                        if (isset($fields->app_key) and $fields->app_key)
                        {
                            $fields->app_key .= "," . $result['client_id'];

                        }
                        else 
                        {
                            $fields->id = $user->id;
                            $fields->app_key = $result['client_id'];
                        }
                        $fields->save();
                        $message = "yes";
                    }


                }
                
            }

        }

        $display->assign('message',$message);
        $display->assign('title','addclient');
    }

    public function tokenAction()
    {
        $display = $this->getView();

        $data = $this->getRequest();

        $oauth = new OAuth2(new OAuth2Storage());
        try {
            $oauth->grantAccessToken();
        }
        catch (OAuth2ServerException $oauthError) {
          $oauthError->sendHttpResponse();
        }

        exit();
    }

    /**
     * http://api.duyu.dev/api/test/authorize?response_type=code&client_id=2751354540&redirect_uri=http://api.duyu.dev/api/test/callback&state=23872023
     * 
     * [authorizeAction description]
     * @return [type] [description]
     */
    public function authorizeAction()
    {
        $display = $this->getView();

        $data = $this->getRequest();

        $oauth = new OAuth2(new OAuth2Storage());

        $user = Members::getCurrentUser();
        if ($_POST and isset($user->id) and $user->id) {
          $userId = $user->id; // Use whatever method you have for identifying users.
          try {
            $session = Session::getInstance();
            $session->set('client_id',$_GET['client_id']);

            $oauth->finishClientAuthorization($_POST["accept"] == "Yep", $userId, $_POST);
          } catch(OAuth2ServerException $e) {
            $e->sendHttpResponse();
          }
          exit;
        }

        $auth_params = null;
        try {
            $auth_params = $oauth->getAuthorizeParams();
        } catch (OAuth2ServerException $oauthError) {
            $oauthError->sendHttpResponse();
        }
        


        $display->assign('auth_params',$auth_params);
    }

    public function resourceAction()
    {
        try {
            $oauth = new OAuth2(new OAuth2Storage());
            $token = $oauth->getBearerToken();
            $token = $oauth->verifyAccessToken($token);
            print_r($token);
            exit();
        } catch (OAuth2ServerException $oauthError) {
            $oauthError->sendHttpResponse();
        }

    }

    public function finishAction()
    {
        $session = Session::getInstance();
        $data = $this->getRequest();

        $host = $data->getServer("HTTP_HOST");
        $url = "http://$host/api/test/resource";

        $access_token = $session->get('access_token');
        $content = http_build_query(array('access_token' =>$access_token));
        $length = strlen($content);
        $opt  = array('http'=> array('method'=>"POST",'header' => "Content-Type:application/x-www-form-urlencoded\r\nContent-Length:$length\r\n",'content' => $content));
        if(function_exists('file_get_contents') and $content = file_get_contents($url,false,stream_context_create($opt))) 
        {
            echo "以下是获取到的受保护内容:<br />",$content;
            exit();
        }
        exit();
    }

    public function callbackAction()
    {

        $session = Session::getInstance();
        $session->get('client_id');

        $oauth = new OAuth2Storage();

        $app_id = $session->get('client_id');

        $client = $oauth->getClient($app_id);
        $app_secret = $client['client_secret'];

        $data = $this->getRequest();

        $host = $data->getServer("HTTP_HOST");
        // code是服务端返回的临时令牌
        $code = $_REQUEST ["code"];
        // Step2：通过Authorization Code获取Access Token
        if ($_REQUEST ['state'] and $_REQUEST ['state'] == $session->get('state')) {
            $re = $this->http_post("http://$host/api/test/token", 
                array (
                    'client_id' => $app_id, 
                    'client_secret' => $app_secret, 
                    'code' => $code, 
                    'grant_type' => 'authorization_code', 
                    // redirect_uri一定要是当前页面的地址,否则会认证失败
                    'redirect_uri' => 'http://api.duyu.dev/api/test/callback' 
                )
             );
            $re = (array)json_decode($re ['content']);
            if(isset($re['access_token']) and $re['access_token'])
            {
                $session->set('access_token',$re['access_token']);
                echo "访问令牌是:".$re ['access_token'],"<br /><a href='http://$host/api/test/finish'>访问受保护的资源</a>";
            }
            else
            {
                echo "获取令牌失败!";
            }
        }

        exit();
    }

    public function http_post($url, $data) {
            $data_url = http_build_query ($data);
            $data_len = strlen ($data_url);
            
            $context = stream_context_create (array(
                                    'http' => array(
                                        'method' => 'POST', 
                                        'header' => "Content-Type:application/x-www-form-urlencoded\r\nConnection: close\r\nContent-Length: $data_len\r\n",
                                        'timeout' => 60, 
                                        'content' => $data_url)));
            $file = file_get_contents ($url, false, $context);
            print_r($file);
            return array (
                'content' => $file, 
                'headers' => $http_response_header);
    }
}

?>