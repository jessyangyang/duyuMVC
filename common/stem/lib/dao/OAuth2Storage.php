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
namespace lib\dao;

use local\oauth2\IOAuth2GrantCode;
use local\oauth2\IOAuth2RefreshTokens;

use lib\models\OAuthAuthCodes;
use lib\models\OAuthClient;
use lib\models\OAuthAccessTokens;
use lib\models\OAuthRefreshTokens;

class OAuth2Storage implements IOAuth2GrantCode, IOAuth2RefreshTokens 
{
    /**
     * Change this to something unique for your system
     * @var string
     */

    private $salt;
    
    /**@#+
     * Centralized table names
     * 
     * @var string
     */
    const TABLE_CLIENTS = 'clients';
    const TABLE_CODES   = 'auth_codes';
    const TABLE_TOKENS  = 'access_tokens';
    const TABLE_REFRESH = 'refresh_tokens';
    /**@#-*/  

    private $oauthcodes;
    private $oauthclient;
    /**
     * Implements OAuth2::__construct().
     */
    public function __construct($salt = 'DUYUPRESS.CN!') {
        $this->oauthcodes   = OAuthAuthCodes::instance();
        $this->oauthclient  = OAuthClient::instance();
        $this->oauthaccess  = OAuthAccessTokens::instance();
        $this->oauthrefresh = OAuthRefreshTokens::instance();
        $this->salt = $salt;
    }

    /**
     * Release DB connection during destruct.
     */
    function __destruct() {
        $this->oauthcodes   = NULL; // Release db connection
        $this->oauthclient  = NULL;
        $this->oauthaccess  = NULL;
        $this->oauthrefresh = NULL;
    }



    /**
    * Little helper function to add a new client to the database.
    *
    * Do NOT use this in production! This sample code stores the secret
    * in plaintext!
    *
    * @param $client_id
    * Client identifier to be stored.
    * @param $client_secret
    * Client secret to be stored.
    * @param $redirect_uri
    * Redirect URI to be stored.
    */
    public function addClient($client_id ,$client_secret,$redirect_uri = 'http://open.duyupress.cn')
    {
        if (!$client_id || !$client_secret) return false;

        $client_secret = $this->hash($client_secret,$client_id);

        $data = array(
            'client_id'=> $this->oauthclient->escapeString($client_id),
            'client_secret' => $this->oauthclient->escapeString($client_secret),
            'redirect_uri' => $this->oauthclient->escapeString($redirect_uri));
        if ($this->oauthclient->insert($data)) return true;
    }

    /**
    * Implements IOAuth2Storage::checkClientCredentials().
    *
    */
    public function checkClientCredentials($client_id, $client_secret = NULL) 
    {
        if (!$client_id) return false;

        $data = $this->oauthclient->field('client_secret')->where("client_id='".$this->oauthclient->escapeString($client_id)."'")->fetchRow();

        if ($client_secret === NULL) return $data !== FALSE;

        return $this->checkPassword($client_secret, $data['client_secret'], $client_id);
    }

    /**
    * Implements IOAuth2Storage::getRedirectUri().
    */
    public function getClientDetails($client_id) 
    {
        if (!$client_id) return false;

        $data = $this->oauthclient->field('redirect_uri')->where("client_id='".$this->oauthclient->escapeString(trim($client_id))."'")->fetchRow();

        if ($data === FALSE)
          return FALSE;

        return isset($data['redirect_uri']) && $data['redirect_uri'] ? $data : NULL;
    }

    /**
    * Implements IOAuth2Storage::getAccessToken().
    */
    public function getAccessToken($oauth_token) {
        return $this->getToken($oauth_token, FALSE);
    }

    /**
    * Implements IOAuth2Storage::setAccessToken().
    */
    public function setAccessToken($oauth_token, $client_id, $user_id, $expires, $scope = NULL) {
        $this->setToken($oauth_token, $client_id, $user_id, $expires, $scope, FALSE);
    }

    /**
    * @see IOAuth2Storage::getRefreshToken()
    */
    public function getRefreshToken($refresh_token) {
        return $this->getToken($refresh_token, TRUE);
    }

    /**
    * @see IOAuth2Storage::setRefreshToken()
    */
    public function setRefreshToken($refresh_token, $client_id, $user_id, $expires, $scope = NULL) {
        return $this->setToken($refresh_token, $client_id, $user_id, $expires, $scope, TRUE);
    }

    /**
    * @see IOAuth2Storage::unsetRefreshToken()
    */
    public function unsetRefreshToken($refresh_token) {

        if (!$refresh_token) return false;

        return $this->oauthcodes->delete("refresh_token='$refresh_token'");

    }

    /**
    * Implements IOAuth2Storage::getAuthCode().
    */
    public function getAuthCode($code) {

        if (!$code) return false;

        $data = $this->oauthcodes->field("code, client_id, user_id, redirect_uri, expires, scope")->where("code='$code'")->fetchRow();

        return $data !== FALSE ? $data : NULL;
        
    }

    /**
    * Implements IOAuth2Storage::setAuthCode().
    */
    public function setAuthCode($code, $client_id, $user_id, $redirect_uri, $expires, $scope = NULL) {
        if (!$code or !$client_id or !$user_id or !$redirect_uri or !$expires) return false;

        $fields = array(
            'code' => $this->oauthcodes->escapeString($code),
            'client_id' => $this->oauthcodes->escapeString($client_id),
            'user_id' => $this->oauthcodes->escapeString($user_id),
            'redirect_uri' => $this->oauthcodes->escapeString($redirect_uri),
            'expires' => $this->oauthcodes->escapeString($expires),
            'scope' => $this->oauthcodes->escapeString($scope)
        );

        return $this->oauthcodes->insert($fields);

    }

    /**
    * @see IOAuth2Storage::checkRestrictedGrantType()
    */
    public function checkRestrictedGrantType($client_id, $grant_type) {
        return TRUE; // Not implemented
    }

    /**
    * Creates a refresh or access token
    *
    * @param string $token - Access or refresh token id
    * @param string $client_id
    * @param mixed $user_id
    * @param int $expires
    * @param string $scope
    * @param bool $isRefresh
    */
    protected function setToken($token, $client_id, $user_id, $expires, $scope, $isRefresh = TRUE) {
        
        if (!$token or !$client_id or !$user_id or !$expires) return false;

        $instance = $isRefresh ? $this->oauthrefresh : $this->oauthaccess;
        $tokenName = $isRefresh ? 'refresh_token' : 'oauth_token';

        $fields = array(
            "$tokenName" => $instance->escapeString($token),
            'client_id' => $instance->escapeString($client_id),
            'user_id' => $instance->escapeString($user_id),
            'expires' => $instance->escapeString($expires),
            'scope' => $instance->escapeString($scope)
        );
        if ($instance->insert($fields)) return true;
        return false;
    }

    /**
    * Retrieves an access or refresh token.
    *
    * @param string $token
    * @param bool $refresh
    */
    protected function getToken($token, $isRefresh = true) {

        if (!$token) return false;

        $instance = $isRefresh ? $this->oauthrefresh : $this->oauthaccess;
        $tokenName = $isRefresh ? 'refresh_token' : 'oauth_token';

        $data = $instance->field("oauth_token AS $tokenName, client_id, expires, scope, user_id")->where("oauth_token='$token'")->fetchRow();

        if ($data) return $data;
        return false;
    }

    /**
    * Change/override this to whatever your own password hashing method is.
    *
    * @param string $secret
    * @return string
    */
    protected function hash($client_secret, $client_id) {
        return hash('sha1', $client_id . $client_secret . $this->salt);
    }
      
      /**
    * Checks the password.
    * Override this if you need to
    *
    * @param string $client_id
    * @param string $client_secret
    * @param string $actualPassword
    */
    protected function checkPassword($try, $client_secret, $client_id) {
        // return $try == $this->hash($client_secret, $client_id);
        return $try == $client_secret;
    }
}