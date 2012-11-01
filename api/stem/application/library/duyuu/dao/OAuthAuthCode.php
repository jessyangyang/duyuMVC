<?php
/**
* authCode DAO 
*
* @package     DuyuMvc
* @author      Jess
* @version     1.0
* @license     http://wiki.duyu.com/duyuMvc
*/

namespace duyuu\dao;

class OAuthAuthCode extends \local\db\ORM 
{
    public $table = 'oauth_auth_code';

    public $fields = array(
        'code' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'code'),
        'client_id' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'client_id'),
        'uid' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'uid'),
        'redirect_url' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'redirect_url'),
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
        return new OAuthAuthCode($key);
    }
}