<?php
/**
* BookControllers  Class 
*
* @package     DuyuMvc
* @author      Jess
* @version     1.0
* @license     http://wiki.duyu.com/duyuMvc
*/

namespace backend\book;

use \backend\dao\Members;
use \backend\dao\MemberInfo;

class MembersControl 
{
    const ROLE_SUPER_ADMIN = 1;
    const ROLE_ADMIN = 2;
    const ROLE_DEVELOPMENTER = 3;

    const ROLE_GENERAL_EDITOR = 101;

    const ROLE_AUTHOR = 120;
    const ROLE_PROOFREADER = 121;

    const ROLE_NORMAL = 500;

    const ROLE_ANONYMITY = 1001;
    const ROLE_LIMITED = 1002;

    private $members;
    private $memberInfo;

    /**
     * Instance construct
     */
    function __construct($uid = false) {
        $this->members = Members::instance($uid);
        $this->memberInfo = MemberInfo::instance();
    }

    /**
    * Class destructor
    *
    * @return void
    * @TODO make sure elements in the destructor match the current class elements
    */
    function __destruct() {
        $this->members = NULL;
        $this->memberInfo = NULL;
    }

    
}