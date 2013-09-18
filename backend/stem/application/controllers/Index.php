<?php
/**
 * Index Controllers
 *
 * @package     DuyuMvc
 * @author      Jess
 * @version     1.0
 * @license     http://wiki.duyu.com/duyuMvc
 */

class IndexController extends \Yaf\Controller_Abstract 
{

    public function indexAction() 
    {
        $display = $this->getView();

        $data = $this->getRequest();

        $display->assign('title',"蠹鱼有书");
    }

}

?>