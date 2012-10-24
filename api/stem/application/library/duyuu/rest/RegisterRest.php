<?php
/**
 * Register
 *
 * @package     DuyuMvc
 * @author      Jess
 * @version     1.0
 * @license     http://wiki.duyu.com/duyuMvc
 * 
 */

namespace duyuu\rest;

use \duyuu\rest\Restful;

class RegisterRest {

    public static function initRegister()
    {
        Restful::regRestURL('test','/test/:id','test','test');
        
        return Restful::$restURL;
    }

}
