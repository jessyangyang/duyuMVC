<?php
/**
* oauthClient DAO 
*
* @package     DuyuMvc
* @author      Jess
* @version     1.0
* @license     http://wiki.duyu.com/duyuMvc
*/

namespace duyuu\dao;

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
        'redirect_url' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'redirect_url')
        );

    public $primaryKey = "client_id";

    protected static $instance;

    public static function instance($key = false)
    {
        return new OAuthAuthCode($key);
    }
}