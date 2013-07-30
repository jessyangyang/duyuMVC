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

class OAuthAccessTokens extends \local\db\ORM 
{
    public $table = 'oauth_access_tokens';

    public $fields = array(
        'client_id' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'client_id'),
        'expires' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'expires'),
        'oauth_token' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'oauth_token'),
        'scope' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'scope'),
        'user_id' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'uid')
        );

    public $primaryKey = "oauth_token";

    protected static $instance;

    public static function instance($key = false)
    {
        return self::$instance ? self::$instance : new OAuthAccessTokens($key);
    }

    /**
     * [hasArrow description]
     * @param  [type]  $authToken [description]
     * @return boolean            [description]
     */
    public function hasArrow($authToken)
    {
        return $this->where("oauth_token='" . $authToken . "'")->fetchRow();
    }

}