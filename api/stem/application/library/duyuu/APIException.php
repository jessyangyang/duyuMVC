<?php
/**
 * Exception 
 *
 * @package     DuyuMvc
 * @author      Jess
 * @version     1.0
 * @license     http://wiki.duyu.com/duyuMvc
 * 
 */
namespace duyuu;

use \local\rest\Restful;

class APIException extends \Yaf\Exception
{
    public function exceptionMessage($errno, $errstr, $errfile, $errline ,$errcontext)
    {
        $rest = Restful::instance();

        $rest->assign('code',$errno);
        $rest->assign('message',$errstr);
        $rest->assign('line',$errline);
        $rest->assign('file',$errfile);
        $rest->response();
    }
}