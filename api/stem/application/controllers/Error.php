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

        $code = 200;
        $message = "ok";

        switch ($exception->getCode()) {
            case YAF_ERR_NOTFOUND_MODULE:
            case YAF_ERR_NOTFOUND_CONTROLLER:
            case YAF_ERR_NOTFOUND_ACTION:
            case YAF_ERR_NOTFOUND_VIEW:
                $code = 404;
                $message = $exception->getMessage();
                break;
            default :
                $code = 0;
                $message = $exception->getMessage();
                break;
        }

        $rest->assign('code',$code);
        $rest->assign('message',$message);
        $rest->response();
     } 
}