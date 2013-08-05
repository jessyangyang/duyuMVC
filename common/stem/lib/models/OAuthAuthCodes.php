<?php
/**
* authCode DAO 
*
* @package     DuyuMvc
* @author      Jess
* @version     1.0
* @license     http://wiki.duyu.com/duyuMvc
*/

namespace lib\models;

class OAuthAuthCodes extends \local\db\ORM 
{
    public $table = 'oauth_auth_codes';

    public $fields = array(
        'code' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'code'),
        'client_id' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'client_id'),
        'user_id' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'user_id'),
        'redirect_uri' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'redirect_uri'),
        'expires' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'expires'),
        'scope' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'scope')
        );

    public $primaryKey = "code";

    protected static $instance;

    public static function instance($key = false)
    {
        return self::$instance ? self::$instance : new OAuthAuthCodes($key);
    }
}