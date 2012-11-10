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
namespace local\download;

class Download 
{
    public static function setHeader($param)
    {
        header($param);
    }

    public static function download($filePath, $params = false)
    {
        if (is_array($params)) {
            foreach ($params as $key => $value) {
                self::setHeader($value);
            }
        }
        readfile($filePath);
    }
}