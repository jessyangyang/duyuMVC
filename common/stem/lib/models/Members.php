<?php
/**
* Members Model 
*
* @package     DuyuMvc
* @author      Jess
* @version     1.0
* @license     http://wiki.duyu.com/duyuMvc
*/

namespace lib\models;

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
}