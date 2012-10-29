<?php
/**
* @file
* Sample OAuth2 Library Mysqli DB Implementation.
*
* @package     DuyuMvc
* @author      Jess
* @version     1.0
* @license     http://wiki.duyu.com/duyuMvc
*/
namespace duyuu\oauth;

use local\oauth2\OAuth2;
use local\oauth2\IOAuth2GrantClient;
use local\oauth2\IOAuth2Srorage;
use local\oauth2\IOAuth2RefreshTokens;
use duyuu\dao\OAuthAuthCode;
use duyuu\dao\OAuthClient;

class OAuth2Storage implements IOAuth2GrantCode, IOAuth2RefreshTokens 
{
    /**
     * Change this to something unique for your system
     * @var string
     */
    const SALT = 'CHANGE_ME!';
    
    /**@#+
     * Centralized table names
     * 
     * @var string
     */
    const TABLE_CLIENTS = 'clients';
    const TABLE_CODES = 'auth_codes';
    const TABLE_TOKENS = 'access_tokens';
    const TABLE_REFRESH = 'refresh_tokens';
    /**@#-*/

    /**
     * @var mysqli
     */
    private $db;    

    /**
     * Implements OAuth2::__construct().
     */
    public function __construct() {
    }

    /**
     * Release DB connection during destruct.
     */
    function __destruct() {
        $this->db = NULL; // Release db connection
    }

    /**
     * Handle Mysql exceptional cases.
     */
    private function handleException($e) {
        echo 'Database error: ' . $e->getMessage();
        exit();
    }

    /**
    * Add Client
    */
    public function addClient($client_id ,$client_secret,$redirect_url)
    {
        if ($client_id and $client_secret) 
        {
            $client_secret = $this->hash();

            $client = OAuthClient::instance();

            $data = array(
                'client_id'=> $client->escapeString($client_id),\
                'client_secret' => $client_secret,
                'redirect_url' => $redirect_url);
            if ($client->insert($data)) return true;
        }
        return false;
    }

    public function checkClientCredentials($client_id, $client_secret = NULL) 
    {
        if ($client_id) {
            $client = OAuthClient::instance();

            $data = $client->field('client_secret')->where("client_id='".trim($client_id)."'")->fetchRow();

            if (isset($data) and $data['client_secret'] == $client_secret) 
                return true;
        }
        return false;
    }

    public function getClientDetails($client_id) 
    {

    }

    public function getAccessToken()
    {

    }

    public function setAccessToken()
    {

    }

    public function getRefreshToken()
    {

    }

    public function setRefreshToken()
    {

    }

    public function unsetRefreshToken()
    {

    }

    public function getAuthCode()
    {

    }

    public function setAuthCode()
    {

    }

    public function checkRestrictedGrantType()
    {

    }

    public function setToken()
    {

    }

    public function getToken();

    protected function checkPassword($try, $client_secret, $client_id) {
        return $try == $this->hash($client_secret, $client_id);
    }
}