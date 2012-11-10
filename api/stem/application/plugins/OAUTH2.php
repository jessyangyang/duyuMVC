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
    }

    public function authorize()
    {
        
    }
}

?>