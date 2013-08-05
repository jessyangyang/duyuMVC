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

class OAuthRefreshTokens extends \local\db\ORM 
{
    public $table = 'oauth_refresh_tokens';

    public $fields = array(
        'refresh_token' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'refresh_token'),
        'client_id' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'client_id'),
        'user_id' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'user_id'),
        'expires' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'expires'),
        'scope' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'scope')
        );

    public $primaryKey = "refresh_token";

    protected static $instance;

    public static function instance($key = false)
    {
        return self::$instance ? self::$instance : new OAuthRefreshTokens($key);
    }
}