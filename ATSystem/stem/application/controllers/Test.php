<?php
/**
 * Test Controllers
 *
 * @package     DuyuMvc
 * @author      Jess
 * @version     1.0
 * @license     http://wiki.duyu.com/duyuMvc
 */

class IndexController extends \Yaf\Controller_Abstract 
{

    public function testAction() 
    {
        $this->getView()->assign("title", "Hello Wrold");
    }

}

?>