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
        return self::instance();
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
        $user = self::getCurrentUser();
        $session = \Yaf\Session::getInstance();

        if (isset($user->id) and $user->id) {
            return true;
        }
        else
        {
            $row = $user->field("id,email,username,role_id")->where($wherearr)->fetchRow();
            if ($row) {
                $image = \backend\dao\Images::instance();

                $cover = $image->getImageForUser($row['id']);
                $row['cover'] = \backend\image\ImageControl::getRelativeImage($cover);

                $session->set('current_id',$row['id']);
                $session->set('authToken',md5($email,$password));

                header("Auth-Token:".$session->get('authToken'));
                return $row;
            }
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