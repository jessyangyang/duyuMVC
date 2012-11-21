<?php
/**
 *  Permision for OAUTH
 *
 * @package     DuyuMvc
 * @author      Jess
 * @version     1.0
 * @license     http://wiki.duyu.com/duyuMvc
 */

use \Yaf\Request_Abstract;
use \Yaf\Response_Abstract;
use \Yaf\Plugin_Abstract;
use \duyuu\rest\Restful;
use \duyuu\dao\OAuthAccessTokens;
use \Yaf\Session;

class OAUTH2Plugin extends Plugin_Abstract
{
    public function routerShutdown(Request_Abstract $request, Response_Abstract $response) 
    {
        
    }

    public function routerStartup(Request_Abstract $request, Response_Abstract $response)
    {
        $this->checkHeader($request, $response);
    }

    private function checkHeader(Request_Abstract $request, Response_Abstract $response)
    {
        $controller = $request->getControllerName();
        $action = $request->getActionName();


        $restList = Restful::$restURL ? Restful::$restURL : array();
        if (!isset($_SERVER['HTTP_ACCESS_TOKEN']) and !isset($_SERVER['HTTP_DEVICE_ID'])) {
            // header("Location: /api/error");
            // exit();
        }

        if (isset($_SERVER['HTTP_AUTH_TOKEN'])) {

            $authToken = $_SERVER['HTTP_AUTH_TOKEN'];

            $session = Session::getInstance();
            $auth = OAuthAccessTokens::instance();
            if ($state = $auth->hasArrow($authToken)) {
                    $session->set('current_id',$state['user_id']);
                    $session->set('authToken',$state['oauth_token']);
                    header("Auth-Token:".$state['oauth_token']);
            }
        }
    }

    public function authorize()
    {
        
    }
}

?>