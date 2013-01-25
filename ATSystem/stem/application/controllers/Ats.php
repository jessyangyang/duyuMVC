<?php
/**
 * Index Controllers
 *
 * @package     DuyuMvc
 * @author      Jess
 * @version     1.0
 * @license     http://wiki.duyu.com/duyuMvc
 */

class AtsController extends \Yaf\Controller_Abstract 
{

    public function indexAction() 
    {
        $this->getView()->assign("title", "Hello Wrold");
    }

}

?>