<?php
/**
 * Test Controllers
 *
 * @package     DuyuMvc
 * @author      Jess
 * @version     1.0
 * @license     http://wiki.duyu.com/duyuMvc
 */

class testController extends \Yaf\Controller_Abstract 
{

    public function indexAction() 
    {
        echo "hello";
        exit();
    }

    public function testAction($id)
    {
        echo "test:$id";
        exit();
    }

    public function test2Action($id)
    {
        echo "test2:$id";
        exit();
    }

}

?>