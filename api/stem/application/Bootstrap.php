<?php
/**
 * Bootstrap.php
 *
 * @package     DuyuMvc
 * @author      Jess
 * @version     1.0
 * @license     http://wiki.duyu.com/duyuMvc
 */

use \Yaf\Dispatcher;
use \stem\db\MySQL;

class Bootstrap extends \Yaf\Bootstrap_Abstract 
{
    public function _initConfig(Dispatcher $dispatcher)
    {
        $config = Yaf\Application::app()->getConfig()->get("mysql")->toArray();
        MySQL::setInstance('default', $config, true);
    }

    public function _initRoute(Dispatcher $dispatcher) {
        $router = \Yaf\Dispatcher::getInstance()->getRouter();
        $config = array(
            "name" => array(
               "type"  => "rewrite",        //Yaf_Route_Rewrite route
               "match" => "/test/:id", //match only /user/list/?/
               "route" => array(
                   'controller' => "api",  //route to user controller,
                   'action'     => "test",  //route to list action
               ),
            ),
        );
        $router->addConfig(new \Yaf\Config\Simple($config));
    }
}

?>