<?php
/**
 * WeChat Controllers
 *
 * @package     DuyuMvc
 * @author      Jess
 * @version     1.0
 * @license     http://wiki.duyu.com/duyuMvc
 */
use \local\social\WeChatCallback;

use \local\rest\Restful;
use \Yaf\Session;

class WeChatController extends \Yaf\Controller_Abstract 
{

    public function indexAction() 
    {
        echo "hello";
        exit();
    }

    public function tokenAction()
    {
        $rest = Restful::instance();

        $wechat = new WeChatCallback();
        $wechat->valid();

        exit();
        $rest->response();
    }

}

?>