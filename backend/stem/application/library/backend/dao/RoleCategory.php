<?php
/**
* RoleCategory DAO 
*
* @package     DuyuMvc
* @author      Jess
* @version     1.0
* @license     http://wiki.duyu.com/duyuMvc
*/

namespace backend\dao;


class RoleCategory extends lib\models\RoleCategory
{
    public static function instance($key = 0)
    {
        return self::$instance ? self::$instance : new RoleCategory($key);
    }


}