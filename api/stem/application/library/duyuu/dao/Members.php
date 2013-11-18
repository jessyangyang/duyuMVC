<?php
/**
* Members DAO 
*
* @package     DuyuMvc
* @author      Jess
* @version     1.0
* @license     http://wiki.duyu.com/duyuMvc
*/

namespace duyuu\dao;

class Members extends \local\db\ORM 
{
    public $table = 'members';

    public $fields = array(
        'id' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'uid'),
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
     * The Login of API
     * @param Object of Http, $request
     * @return Array, return the Member Array
     */
    public function login($request)
    {
        if ($request->isPost()) {
            $user = Members::instance();
            $wherearr = "email='" .$user->escapeString($request->getPost('email')) . "' AND password='" . md5($request->getPost('password')) . "'";
            $row = $user->field("id,email,username,role_id")->where($wherearr)->fetchRow();
            if ($row) {
                $image = \duyuu\dao\Images::instance();

                $cover = $image->getImageForUser($row['id']);
                $row['cover'] = \duyuu\image\ImageControl::getRelativeImage($cover);
            }
            return $row;
        }

        return false;
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
}