<?php
/**
 * Restful
 *
 * @package     DuyuMvc
 * @author      Jess
 * @version     1.0
 * @license     http://wiki.duyu.com/duyuMvc
 * 
 */

namespace local\rest;

class REST
{
    const CONTENT_TYPE = "application/json";

    public $_allow = array(); 
    public $_request = array();

    private $_method = "";
    private $_code = 200;

    public function __construct() 
    {
        $this->getRequest();
    }

    /**
     * [getReferer]
     * @return [String]
     */
    public function getReferer()
    {
        return $_SERVER['HTTP_REFERER'];
    }

    /**
     * [response description]
     * @param  [String] $pData
     * @param  [String] $pStatus
     * @return [Json]
     */
    public function response($pData,$pStatus)
    {
        $this->_code = ($pStatus) ? $status : 200;
        $this->setHeaders();
        echo $data;
        exit;
    }

    /**
     * [getStatusMsg description]
     * @return [type] [description]
     */
    private function getStatusMsg()
    {
        $status = array(
                        100 => 'Continue',  
                        101 => 'Switching Protocols',  
                        200 => 'OK',
                        201 => 'Created',  
                        202 => 'Accepted',  
                        203 => 'Non-Authoritative Information',  
                        204 => 'No Content',  
                        205 => 'Reset Content',  
                        206 => 'Partial Content',  
                        300 => 'Multiple Choices',  
                        301 => 'Moved Permanently',  
                        302 => 'Found',  
                        303 => 'See Other',  
                        304 => 'Not Modified',  
                        305 => 'Use Proxy',  
                        306 => '(Unused)',  
                        307 => 'Temporary Redirect',  
                        400 => 'Bad Request',  
                        401 => 'Unauthorized',  
                        402 => 'Payment Required',  
                        403 => 'Forbidden',  
                        404 => 'Not Found',  
                        405 => 'Method Not Allowed',  
                        406 => 'Not Acceptable',  
                        407 => 'Proxy Authentication Required',  
                        408 => 'Request Timeout',  
                        409 => 'Conflict',  
                        410 => 'Gone',  
                        411 => 'Length Required',  
                        412 => 'Precondition Failed',  
                        413 => 'Request Entity Too Large',  
                        414 => 'Request-URI Too Long',  
                        415 => 'Unsupported Media Type',  
                        416 => 'Requested Range Not Satisfiable',  
                        417 => 'Expectation Failed',  
                        500 => 'Internal Server Error',  
                        501 => 'Not Implemented',  
                        502 => 'Bad Gateway',  
                        503 => 'Service Unavailable',  
                        504 => 'Gateway Timeout',  
                        505 => 'HTTP Version Not Supported');
            return ($status[$this->_code]) ? $status[$this->_code] : $status[500];
    }

    /**
     * [getRequestMethod For HTTP]
     * @return [String] 
     */
    public function getRequestMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    /**
     * [Get DATA for HTTP Request]
     */
    private function getRequest()
    {
        switch ($this->getRequestMethod()) {
            case 'POST':
                $this->_request = $this->_filter($_POST);
                break;
            case 'GET':
                # code...
                break;
            case 'DELETE':
                $this->_request = $this->_filter($_GET);
                break;
            case 'PUT':
                parse_str(file_get_contents("php://input", $this->_request));
                $this->_request = $this->_filter($this->_request);
                break;
            
            default:
                $this->response('',406);
                break;
        }
    }

    /**
    * Return String with decodes a JSON
    * @return String
    */
    public function decode($data)
    {
        return json_decode($data);
    }

    /**
    * Returns the JSON representation of a value
    * @return Json
    */
    public function display($data)
    {
        echo json_encode($data);
        exit();
    }

    /**
    * Returns the last error (if any) occurred during the last JSON encoding/decoding
    * @return String for json last error
    */
    public function errorForJson()
    {

    }

    /**
     * [filter of the request data]
     * @param  [Array] $pData [description]
     * @return [Array]        [description]
     */
    private function _filter($pData)
    {
        $_filter = array();
        if (is_array($pData)) 
        {
            foreach ($pData as $key => $value) {
                $_filter[$key] = $this->_filter($value);
            }
        }
        else
        {
            if (get_magic_quotes_gpc()) {
                $pData = trim(stripcslashes($pData));
            }
            $pData = strip_tags($pData);
            $_filter = trim($pData);
        }
        return $_filter;
    }

    /**
     * Set HTTP headers
     */
    private function setHeaders()
    {
        header("HTTP/1.1 " . $this->_code . " " . $this->getStatusMsg());
        header("Content-Type:" . CONTENT_TYPE);
    }
}