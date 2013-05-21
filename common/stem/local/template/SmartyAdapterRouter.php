<?php
/**
 * SmartyAdapterRouter.php
 * 
 * @package     DuyuMvc
 * @author      Jess
 * @version     1.0
 * @license     http://wiki.duyu.com/duyuMvc
 */

namespace local\template;

require_once(substr(__DIR__,0,strrpos(__DIR__,"common"))."/common/third/smarty/Smarty.class.php");

use \Yaf\Dispatcher;

class SmartyAdapterRouter implements \Yaf\View_Interface
{
    public $_smarty;

    private $_script_path;
    private $_views;

    public function __construct($views = null ,$extraParams = array())
    {
        $this->_smarty = new \Smarty();
         
        foreach ($extraParams as $key => $value) {
            $this->_smarty->$key = $value;
        }

        //根据不同的模块设置不同的模版路径
        $dispatcher = Dispatcher::getInstance();
        $arrRequest = $dispatcher->getRequest();

        if ($views == null) $this->_views = "views";
        else $this->_views = $views;
        
        if (empty($arrRequest->module)) {
            $this->_script_path = APPLICATION_PATH.'/application/' . $this->_views;
            $this->setScriptPath(APPLICATION_PATH.'/application/') . $this->_views;
        } 
        else 
        {
            $this->_script_path = APPLICATION_PATH.'/application/modules/'.$arrRequest->module . '/' . $this->_views;
            $this->setScriptPath(APPLICATION_PATH.'/application/modules/'.$arrRequest->module . '/' . $this->_views);
        }
    }
     
     //返回要显示的内容
     public function render( $view_name ,  $tpl_vars = NULL )//string
     {
         $view_path = $this->_script_path.'/'.$view_name;
         $cache_id     = empty($tpl_vars['cache_id']) ? '' : $tpl_vars['cache_id'];
         $compile_id = empty($tpl_vars['compile_id']) ? '' : $tpl_vars['compile_id'];
         return $this->_smarty->fetch($view_path, $cache_id, $compile_id, false);//返回应该输出的内容,而不是显示
     }
     
     //显示模版
     public function display( $view_name, $tpl_vars = NULL )//boolean
     {
         $view_path = $this->_script_path.'/'.$view_name;
         $cache_id     = empty($tpl_vars['cache_id']) ? '' : $tpl_vars['cache_id'];
         $compile_id = empty($tpl_vars['compile_id']) ? '' : $tpl_vars['compile_id'];
         return $this->_smarty->display($view_path, $cache_id, $compile_id);
     }
     
     //模版赋值
     public function assign( $name, $value = NULL )//boolean
     {
         return $this->_smarty->assign($name, $value);
     }
     
     //设定脚本路径
     public function setScriptPath( $view_directory )//boolean
     {
         return $this->_smarty->setTemplateDir($view_directory);
     }
     
     //得到脚本路径
     public function getScriptPath()//string
     {
         return $this->_script_path;
     }
     
}
