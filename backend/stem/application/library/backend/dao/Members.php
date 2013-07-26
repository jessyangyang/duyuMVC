<?php
/**
* Members DAO 
*
* @package     DuyuMvc
* @author      Jess
* @version     1.0
* @license     http://wiki.duyu.com/duyuMvc
*/

namespace backend\dao;

class Members extends \local\db\ORM 
{
    public $table = 'members';

    public $fields = array(
        'id' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'bookID'),
        'email' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'email'),
        'password' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'password'),
        'username' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'username'),
        'published' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'published'),
        'avatar_id' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'avatar_id'),
        'role_id' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'role_id')
        );

    public $primaryKey = "id";

    protected static $instance;

    /**
     * Instance Members
     * @param  boolean $id | the primaryKey
     * @return Object with self
     */
    public static function instance($id = false)
    {
        return self::$instance ? self::$instance : new Members($id);
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
    public static function getCurrentUser()
    {
        if (!isset(self::$instance)) {
            $session = \Yaf\Session::getInstance();
            if ($session->has('current_id')) {
                $member = self::getByID($session->current_id);
                self::$instance =  $member;
            }
        }
        return self::$instance;
    }

    /**
     * Check register with the user.
     * @param  [type]  $email [description]
     * @return boolean | int  return primary_key ,or return false
     */
    public function isRegistered($email)
    {
        $email = $this->escapeString($email);
        if ($data = $this->field('id')->where("email='" . $email ."'")->group("published")->fetchRow()) return $data;
        return false;
    }

    /**
     * Login
     *
     * @param String ,$email
     * @param String ,$password
     * @return Boolean or Array
     */
    public function login($email,$password)
    {
        $wherearr = "email='" . $this->escapeString(trim($email)) . "' AND password='" . md5($this->escapeString($password)) . "'";
        $user = self::instance();
        $row = $user->where($wherearr)->fetchRow();

        if ($row) {
            $auth = \backend\dao\OAuthAccessTokens::instance();
            $session = \Yaf\Session::getInstance();
            if ($state = $auth->hasArrow(md5($row['id'].$email))) {
                $session->set('current_id',$state['user_id']);
                $session->set('authToken',$state['oauth_token']);
                return $state;
            }
            else
            {
                $authArr = array(
                        'oauth_token' => md5($row['id'].$email),
                        'client_id' => $row['id'],
                        'user_id' => $row['id'],
                        'expires' => strtotime("next Monday"));
                $auth->insert($authArr);
                
                $session->set('current_id',$row['id']);
                $session->set('authToken',md5($row['id'].$email));

                return true;
            }

            header("Auth-Token:".$session->get('authToken'));
        }
        return false;
    }

    /**
     * Logout
     *
     * @return Boolean , if unset session ,return true.
     */
    public function logout()
    {
        $session = \Yaf\Session::getInstance();
        if ($session->has("current_id")) {
            $session->__unset('current_id');
            $session->__unset('authToken');
            return true;
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