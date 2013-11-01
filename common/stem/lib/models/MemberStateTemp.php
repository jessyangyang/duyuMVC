<?php
/**
* MemberStateTemp DAO 
*
* @package     DuyuMvc
* @author      Jess
* @version     1.0
* @license     http://wiki.duyu.com/duyuMvc
*/

namespace lib\models;

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
        'expired' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'expired')
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
     * @param String , $token
     * @return [type] [description]
     */
    public static function getCurrentUserForAuth($token = false)
    {
        $memberState  = self::instance();

        $wherearr = false;
        if ($token) {
            $wherearr = "authtoken='" .$memberState->escapeString($token). "'";
        }
        elseif (isset($_SERVER['HTTP_AUTH_TOKEN']) and $_SERVER['HTTP_AUTH_TOKEN']) {
            $wherearr = "authtoken='" .$_SERVER['HTTP_AUTH_TOKEN']. "'";
        }
        if($wherearr) return  $memberState->field("uid,authtoken,expired")->where($wherearr)->fetchRow();
        return false;
    }

    /**
     * [isExpired description]
     * @param  [type]  $time [description]
     * @return boolean       [description]
     */
    public static function isExpired($time)
    {
        if(time() > $time) return true;
        return false;
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
                if($memberState->insert(array('uid' => $memberState->escapeString($uid),'authtoken' => $memberState->escapeString($authtoken),'expired' => strtotime('next month')))) return true;
            }
        }
        return false;
    }

    public function deleteTokenForUserId($uid)
    {
        $memberState = self::instance();
        $uid = $memberState->escapeString($uid);
        return $memberState->where("uid='$uid'")->delete();
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