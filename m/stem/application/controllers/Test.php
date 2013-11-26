<?php
/**
 * Test Controllers
 *
 * @package     DuyuMvc
 * @author      Jess
 * @version     1.0
 * @license     http://wiki.duyu.com/duyuMvc
 */

use \duyum\dao\Roles;

class TestController extends \Yaf\Controller_Abstract 
{

    public function indexAction($action = false)
    {
        $display = $this->getView();

        switch ($action) {
            case '1':
                # code...
                $display->display("test/1.tpl");
                break;
            case '2':
                $display->display("test/2.tpl");
                # code...
                break;
            default:
                # code...
                break;
        }
    }

    public function rolesAction() 
    {
        $roles = new Roles();
        $roles->initRoles();
        exit();
    }
}