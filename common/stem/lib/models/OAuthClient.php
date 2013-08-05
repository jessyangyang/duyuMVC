<?php
/**
* oauthClient DAO 
*
* @package     DuyuMvc
* @author      Jess
* @version     1.0
* @license     http://wiki.duyu.com/duyuMvc
*/

namespace lib\models;

class OAuthClient extends \local\db\ORM 
{
    public $table = 'oauth_client';

    public $fields = array(
        'client_id' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'client_id'),
        'client_secret' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'client_secret'),
        'redirect_uri' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'redirect_uri')
        );

    public $primaryKey = "client_id";

    protected static $instance;

    public static function instance($key = false)
    {
        return self::$instance ? self::$instance : new OAuthClient($key);
    }
}