<?php
/**
 * ErrorController
 *
 * @package     DuyuMvc
 * @author      Jess
 * @version     1.0
 * @license     http://wiki.duyu.com/duyuMvc
 */

class ErrorController extends \Yaf\Controller_Abstract 
{

    public function errorAction()
    {
        header("Location:/index");
        exit();
    }
}