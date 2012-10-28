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

use local\oauth2\OAuth2;
use local\oauth2\IOAuth2GrantClient;
use local\oauth2\IOAuth2Srorage;
use local\oauth2\IOAuth2RefreshTokens;

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
}