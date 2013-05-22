<?php
/**
 * SmartyPlugin
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
use \Yaf\Dispatcher;
use \local\template\SmartyAdapterRouter;

class SmartyControllerPlugin extends Plugin_Abstract {
 
     public function routerStartup(Request_Abstract $request, Response_Abstract $response) {
     }
 
     public function routerShutdown(Request_Abstract $request, Response_Abstract $response) {
         //整合smarty
         $dispatcher = Dispatcher::getInstance();
         //$dispatcher->disableView();
         $dispatcher->autoRender(false);
         $objSmarty = new SmartyAdapterRouter(null, Yaf\Application::app()->getConfig()->smarty);
         $dispatcher->setView($objSmarty);
         
     }
 
     // public function dispatchLoopStartup(Yaf_Request_Abstract $request, Yaf_Response_Abstract $response) {
     //     echo "Plugin DispatchLoopStartup called <br/>\n";
     // }
 
     // public function preDispatch(Yaf_Request_Abstract $request, Yaf_Response_Abstract $response) {
     //     echo "Plugin PreDispatch called <br/>\n";
     // }
 
     // public function postDispatch(Yaf_Request_Abstract $request, Yaf_Response_Abstract $response) {
     //     echo "Plugin postDispatch called <br/>\n";
     // }
 
     // public function dispatchLoopShutdown(Yaf_Request_Abstract $request, Yaf_Response_Abstract $response) {
     //     echo "Plugin DispatchLoopShutdown called <br/>\n";
     // }
 }