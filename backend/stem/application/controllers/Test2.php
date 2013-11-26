<?php
/**
 * Test Controllers
 *
 * @package     DuyuMvc
 * @author      Jess
 * @version     1.0
 * @license     http://wiki.duyu.com/duyuMvc
 */

use \lib\dao\BookControllers;
use \backend\dao\Roles;

class Test2Controller extends \Yaf\Controller_Abstract 
{

    public function rolesAction() 
    {
        $roles = new Roles();
        $roles->initRoles();
        exit();
    }
}