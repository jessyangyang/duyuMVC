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
namespace duyuu;

class Exception extends \local\exception\Exception
{
    public function exceptionMessage($errno, $errstr, $errfile, $errline)
    {
        switch($errno)
        {
            case Yaf_ERR_NOTFOUND_CONTROLLER:
                break;
            case YAF_ERR_NOTFOUND_MODULE:
                break;
            case YAF_ERR_NOTFOUND_ACTION:
                echo "action"; 
                break;
            default:
                break;
        }

        return true;
    }
}