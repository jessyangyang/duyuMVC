<?php
/**
 * Exception
 *
 * @package     DuyuMvc
 * @author      Jess
 * @version     1.0
 * @license     http://wiki.duyu.com/duyuMvc
 * 
 */
namespace local\exception;

/**
 * All the exception should be a descent of this class
 *
 * @author Jess<shawnisun@gmail.com>
 * @package dsnp
 */
class Exception extends \Exception 
{

    /**
    * Redefine the exception so message isn't optional
    * @param String | $message : error message
    * @param Int | $code : error code
    * @param Exception Object | pervious
    */
     public function __construct($message, $code = 0, Exception $previous = null) {
    
        parent::__construct($message, $code, $previous);
    }

    /**
    * Custom string representation of object
    * @return string | error message and error code;
    */
    public function __toString()
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }


    /**
    * Custom MysqlConnectException
    * @return String 
    */
    public function MysqlConnectException($message) {
        echo 'Connect Error: ' . $message;
    }


}

