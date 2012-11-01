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
            'comment' => 'username')
        );

    public $primaryKey = "id";

    protected static $instance;

    private static $currentUser;

    public static function instance($key = false)
    {
        return isset(self::$instance) ? self::$instance : new Members($key);
    }

    public static function getByID($id)
    {
        return self::instance(intval($id));
    }

    public static function getCurrentUser()
    {
        if (!isset(self::$currentUser)) {
            
            // $session = \Yaf\Session::getInstance();
            // print_r($session);
            // if ($session->has('current_id')) {
            //     self::$currentUser = self::getByID($session->current_id);
            // }
        }
        // return self::$currentUser;
    }
}