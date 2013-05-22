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

        if (empty($arrRequest->module) or 'index' == strtolower($arrRequest->module)) {
            $this->_script_path = APPLICATION_PATH.'/application/' . $this->_views . '/' . strtolower($arrRequest->controller);
            $this->setScriptPath(APPLICATION_PATH.'/application/' . $this->_views . '/' . strtolower($arrRequest->controller));
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
         echo $this->_smarty->fetch($view_path, $cache_id, $compile_id);
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

     /**
     * Return the template engine object
     *
     * @return Smarty
     */
    public function getEngine() {
        return $this->_smarty;
    }
    
    /**
     * Alias for setScriptPath
     *
     * @param string $path
     * @param string $prefix Unused
     * @return void
     */
    public function setBasePath($path, $prefix = 'Zend_View')
    {
        return $this->setScriptPath($path);
    }
 
    /**
     * Alias for setScriptPath
     *
     * @param string $path
     * @param string $prefix Unused
     * @return void
     */
    public function addBasePath($path, $prefix = 'Zend_View')
    {
        return $this->setScriptPath($path);
    }
 
    /**
     * Assign a variable to the template
     *
     * @param string $key The variable name.
     * @param mixed $val The variable value.
     * @return void
     */
    public function __set($key, $val)
    {
        $this->_smarty->assign($key, $val);
    }
 
    /**
     * Allows testing with empty() and isset() to work
     *
     * @param string $key
     * @return boolean
     */
    public function __isset($key)
    {
        return (null !== $this->_smarty->get_template_vars($key));
    }
 
    /**
     * Allows unset() on object properties to work
     *
     * @param string $key
     * @return void
     */
    public function __unset($key)
    {
        $this->_smarty->clear_assign($key);
    }

    /**
     * Clear all assigned variables
     *
     * Clears all variables assigned to Zend_View either via
     * {@link assign()} or property overloading
     * ({@link __get()}/{@link __set()}).
     *
     * @return void
     */
    public function clearVars() {
        $this->_smarty->clear_all_assign();
    }
}
