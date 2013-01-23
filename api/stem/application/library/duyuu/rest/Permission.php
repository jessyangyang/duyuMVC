<?php
/**
* The Permission of All 
*
* @package     DuyuMvc
* @author      Jess
* @version     1.0
* @license     http://wiki.duyu.com/duyuMvc
*/

namespace duyuu;

use duyuu\dao\Members;
use Yaf\Request_Abstract;

class Permission
{
    private $registerAPI;
    private $user;
    private $requset;

    /**
     * [__construct description]
     * @param Array            $registerAPI [description]
     * @param Members          $user        [description]
     * @param Request_Abstract $request     [description]
     */
    public function __construct(Array $registerAPI, Members $user,Request_Abstract $request)
    {
        $this->registerAPI = $registerAPI;
        $this->user = $user;
        $this->requset = $requset;
    }

    public function hashPermission()
    {

    }


}