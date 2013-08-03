<?php
/**
 * ErrorController
 *
 * @package     DuyuMvc
 * @author      Jess
 * @version     1.0
 * @license     http://wiki.duyu.com/duyuMvc
 */

use \local\rest\Restful;

class ErrorController extends \Yaf\Controller_Abstract {
     /** 
      * you can also call to Yaf_Request_Abstract::getException to get the 
      * un-caught exception.
      */
     public function errorAction($exception) {
        /* error occurs */
        $rest = Restful::instance();

        $message = $exception->getMessage();
        $code = $exception->getCode();

        $rest->assign('code',$code);
        $rest->assign('message',$message);
        $rest->assign('error_no',$exception->getCode());
        $rest->assign('line',$exception->getLine());
        $rest->assign('file',$exception->getFile());
        $rest->assign('trace',$exception->getTraceAsString());
        $rest->response();
     } 
}