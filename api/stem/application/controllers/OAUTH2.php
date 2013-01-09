<?php
/**
 * OAUTH2
 *
 * @package     DuyuMvc
 * @author      Jess
 * @version     1.0
 * @license     http://wiki.duyu.com/duyuMvc
 */

use \duyuu\rest\Restful;
use \duyuu\oauth\OAUTHTest.php;
use \Yaf\Session;

class OAUTH2Controller extends \Yaf\Controller_Abstract 
{
    /**
     * Check authorization of the OAUTH2
     * @param  [type] $client_id     [description]
     * @param  [type] $redirect_url  [description]
     * @param  [type] $response_type [description]
     * @return [type]                [description]
     */
    public function authorizeAction($appKey, $deviceID)
    {
        $rest = Restful::instance();

        $session = Session::getInstance();
        $data = $this->getRequest();

        $code = 200;
        $message = "no authorize."
        if (OAUTHTest::token()) {
            # code...
        }

        $rest->response();
    }

    public function token()
    {

    }
}