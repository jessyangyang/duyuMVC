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
use \duyuu\rest\RegisterRest;
use \duyuu\APIException;
use \local\template\SmartyAdapter;

class Bootstrap extends \Yaf\Bootstrap_Abstract 
{
    public function _initConfig(Dispatcher $dispatcher)
    {
        Yaf\Registry::set("common", new \duyuu\common());
        $config = Yaf\Application::app()->getConfig()->get("mysql")->toArray();
        MySQL::setInstance('default', $config, true);
    }

    public function _initRoute(Dispatcher $dispatcher) {
        $router = $dispatcher->getRouter();
        $rest = RegisterRest::initRegister();
        $router->addConfig(new Yaf\Config\Simple($rest));
    }

    public function _initException(Dispatcher $dispatcher)
    {
        $exception = new APIException();
        $dispatcher->setErrorHandler(array(get_class($exception),'exceptionMessage'));
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