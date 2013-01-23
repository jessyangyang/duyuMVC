<?php

/**
 * OAuth2 Test
 *
 * @package     DuyuMvc
 * @author      Jess
 * @version     1.0
 * @license     http://wiki.duyu.com/duyuMvc
 *
 */
namespace duyuu\oauth;

class OAUTHTest 
{
    public static function token()
    {
        if (isset($_SERVER['HTTP_ACCESS_TOKEN']) and isset($_SERVER['HTTP_DEVICE_ID']) {
           $accessToken = $_SERVER['HTTP_ACCESS_TOKEN'];
           $devicdID = $_SERVER['HTTP_DEVICE_ID'];
           $session->set('authToken',md5($accessToken.$devicdID));
           header("Auth-Token:".$session->get('authToken'));
           return true;
        }
        return false;
    }
}