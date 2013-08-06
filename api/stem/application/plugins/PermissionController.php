<?php
/**
 * PermissionPlugin
 *
 * @package     DuyuMvc
 * @author      Jess
 * @version     1.0
 * @license     http://wiki.duyu.com/duyuMvc
 */

use \Yaf\Request_Abstract;
use \Yaf\Response_Abstract;
use \Yaf\Plugin_Abstract;
use \Yaf\Application;
use \Yaf\Session;


class PermissionControllerPlugin extends Plugin_Abstract 
{
    public function routerShutdown(Request_Abstract $request, Response_Abstract $response) 
    {
        $this->checkPermission($request, $response);
    }

    public function checkPermission(Request_Abstract $request, Response_Abstract $response)
    {
        $config = Application::app()->getConfig()->get('api');

        if ($config and $config->get("permission") == false) {
            return;
        }
        $parms = $request->getParams();

        foreach ($parms as $key => $value) {
            if (stripos($parms[$key],"?"))
            {
                $parm = substr($parms[$key],0,stripos($parms[$key],"?"));
                $request->setParam($key,$parm);
            }
        }

        $session = Session::getInstance();

        
    }
}