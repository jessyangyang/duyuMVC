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
use \local\db\MySQL;
use \local\template\SmartyAdapter;

class Bootstrap extends \Yaf\Bootstrap_Abstract 
{
    public function _initConfig(Dispatcher $dispatcher)
    {
        Yaf\Registry::set("common", new \duyuAT\common());
        $config = Yaf\Application::app()->getConfig()->get("mysql")->toArray();
    }

    // public function _initRoute(Dispatcher $dispatcher) {
    //     $router = $dispatcher->getRouter();
    //     $rest = RegisterRest::initRegister();
    //     $router->addConfig(new Yaf\Config\Simple($rest));
    // }

    public function _initException(Dispatcher $dispatcher)
    {
        // $exception = new Exception();
        // $dispatcher->setErrorHandler($exception->exceptionMessage());
    }

    public function _initSmarty(Dispatcher $dispatcher)
    {
        $smarty = new SmartyAdapter(null, Yaf\Application::app()->getConfig()->smarty);
        $dispatcher->setView($smarty);
    }

    public function _initPlugins(Dispatcher $dispatcher)
    {
        $dispatcher->registerPlugin(new PermissionControllerPlugin());
        // $dispatcher->registerPlugin(new OAUTH2Plugin());
    }
}

?>