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
use \Yaf\Exception;


class PermissionControllerPlugin extends Plugin_Abstract 
{
    public function routerStartup(Request_Abstract $request ,Response_Abstract $response)
    {

    }
    public function routerShutdown(Request_Abstract $request, Response_Abstract $response) 
    {
        $this->checkPermission($request, $response);
    }

    public function dispatchLoopStartup( Request_Abstract $request ,Response_Abstract $response )
    {
    }

    public function preDispatch( Request_Abstract $request ,Response_Abstract $response )
    {
    }

    public function postDispatch( Request_Abstract $request ,Response_Abstract $response )
    {
    }

    public function dispatchLoopShutdown( Request_Abstract $request ,Response_Abstract $response )
    {

    }

    public function checkPermission(Request_Abstract $request, Response_Abstract $response)
    {
        $config = Application::app()->getConfig()->get('api');

        if ($config and $config->get("permission") == false) {
            return;
        }
        $parm = null;
        // $parms = substr(stripos(,"?")+1);

        foreach ($request->getParams() as $key => $value) {
            if (stripos($value[$key],"?"))
            {
                $parm = substr($value[$key],stripos($value['action'],"?")+1);
                $request->setParam($key,$value[$key]);
            }
        }
        print_r($parm);
        print_r($request);

        $error = new Exception();

        // echo "<pre>";
        // print_r($error);
        // echo "<pre>";
        // print_r($request);
        // print_r($response);

        $session = Session::getInstance();
    }
}