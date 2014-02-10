<?php
/**
* Roles DAO 
*
* @package     DuyuMvc
* @author      Jess
* @version     1.0
* @license     http://wiki.duyu.com/duyuMvc
*/

namespace duyum\dao;

use duyum\rest\RegisterRest;

class Roles extends \lib\models\users\Roles
{
    public static function instance($key = 0)
    {
        return self::$instance ? self::$instance : new Roles($key);
    }

    public function initRoles()
    {
        $list = RegisterRest::initRegister();
        $roles = self::instance();

        $datas = $roles->fetchList();
        $names = array();

        if ($datas) {
           foreach ($datas as $key => $value) {
            if (isset($value['name'])) {
                $names[] = $value['name'];
            }
        }
        }
        

        $index = 0;
        foreach ($list as $key => $value) {
            if (in_array($key, $names)) {
                $roles->where("name='$key'")->update(array('controller' => $value['route']['controller'], 'action' => $value['route']['action'],'published' => time()));
                 echo 'update :'.$key . "<br>";
            }
            else
            {
                $roles->insert(array('rcid' => 4,'name' => $key,'controller' => $value['route']['controller'], 'action' => $value['route']['action'],'published' => time(),'sort' => $index));
                echo 'insert :'.$key . "<br>";
            }
            $index ++;
        }
    }

}