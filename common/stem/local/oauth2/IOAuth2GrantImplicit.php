<?php

/**
 * Storage engines that support the "Implicit"
 * grant type should implement this interface
 * 
 * @package     DuyuMvc
 * @author      Jess
 * @version     1.0
 * @license     http://wiki.duyu.com/duyuMvc
 * @see http://tools.ietf.org/html/draft-ietf-oauth-v2-20#section-4.2
 */

namespace local\oauth2;

interface IOAuth2GrantImplicit extends IOAuth2Storage {
	
	/**
	 * The Implicit grant type supports a response type of "token". 
	 * 
	 * @var string
	 * @see http://tools.ietf.org/html/draft-ietf-oauth-v2-20#section-1.4.2
	 * @see http://tools.ietf.org/html/draft-ietf-oauth-v2-20#section-4.2
	 */
	const RESPONSE_TYPE_TOKEN = OAuth2::RESPONSE_TYPE_ACCESS_TOKEN;
}