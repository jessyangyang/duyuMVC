<?php
/**
* MemberStateTemp DAO 
*
* @package     DuyuMvc
* @author      Jess
* @version     1.0
* @license     http://wiki.duyu.com/duyuMvc
*/

namespace duyuu\dao;

class MemberStateTemp extends \local\db\ORM 
{
    public $table = 'member_state_temp';

    public $fields = array(
        'id' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'bookID'),
        'uid' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'uid'),
        'authtoken' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'authtoken'),
        'published' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'published')
        );

    public $primaryKey = "id";

    protected static $instance;

    /**
     * Instance MemberStateTemp
     * @param  boolean $id | the primaryKey
     * @return Object with self
     */
    public static function instance($id = false)
    {
        return self::$instance ? self::$instance : new MemberStateTemp($id);
    }

    /**
     * [getByID description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public static function getByID($id)
    {
        return self::instance($id);
    }

    /**
     * [getCurrentUser description]
     * @return [type] [description]
     */
    public static function getCurrentUserForAuth()
    {
        $memberState  = self::instance();

        if (isset($_SERVER['HTTP_AUTH_TOKEN']) and $_SERVER['HTTP_AUTH_TOKEN']) {
            $wherearr = "authtoken='" .$_SERVER['HTTP_AUTH_TOKEN']. "'";
            if($row = $memberState->field("uid,authtoken")->where($wherearr)->fetchRow()) return $row;
        }
        else return false;
        
    }

    public function addAuthToken($uid,$authtoken)
    {
        $memberState = self::instance();
        if ($uid and $authtoken) {
            if ($memberState->field("uid")->where("authtoken = '$authtoken'")->fetchRow()){
                return true;
            }
            else
            {
                if($memberState->insert(array('uid' => $uid,'authtoken' => $authtoken,'published' => UPDATE_TIME))) return true;
            }
        }
        return false;
    }

    public function __get($fieldName)
    {
        return $this->$fieldName;
    }

    public function __set($fieldName, $value)
    {
        $this->$fieldName = $value;
    }
}