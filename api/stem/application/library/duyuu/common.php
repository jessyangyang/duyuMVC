<?php
/**
* Common Functions Class 
*
* @package     DuyuMvc
* @author      Jess
* @version     1.0
* @license     http://wiki.duyu.com/duyuMvc
*/

namespace duyuu;

class common extends \local\base\Base
{
    /**
     * Create a random 32 character MD5 token
     *
     * @return string
     */
    public function token()
    {
        return md5(str_shuffle(chr(mt_rand(32, 126)) . uniqid() . microtime(TRUE)));
    }

    /**
     * Create a random 32 character MD5 token
     *
     * @return string
     */
    function token()
    {
        return md5(str_shuffle(chr(mt_rand(32, 126)) . uniqid() . microtime(TRUE)));
    }

    /**
     * Encode a string so it is safe to pass through the URL
     *
     * @param string | $string to encode
     * @return string
     */
    public function base64_url_encode($string = NULL)
    {
        return strtr(base64_encode($string), '+/=', '-_~');
    }


    /**
     * Decode a string passed through the URL
     *
     * @param string | $string to decode
     * @return string
     */
    public function base64_url_decode($string = NULL)
    {
        return base64_decode(strtr($string, '-_~', '+/='));
    }


    /**
     * Convert special characters to HTML safe entities.
     *
     * @param string $string to encode
     * @return string
     */
    function h($string)
    {
        return htmlspecialchars($string, ENT_QUOTES, 'utf-8');
    }

    /**
     * Return a SQLite/MySQL/PostgreSQL datetime string
     *
     * @param int $timestamp
     */
    function sql_date($timestamp = NULL)
    {
        return date('Y-m-d H:i:s', $timestamp ?: time());
    }


    /**
     * Make a request to the given URL using cURL.
     *
     * @param string $url to request
     * @param array $options for cURL object
     * @return object
     */
    function curl_request($url, array $options = NULL)
    {
        $ch = curl_init($url);

        $defaults = array(
            CURLOPT_HEADER => 0,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_TIMEOUT => 5,
        );

        // Connection options override defaults if given
        curl_setopt_array($ch, (array) $options + $defaults);

        // Create a response object
        $object = new stdClass;

        // Get additional request info
        $object->response = curl_exec($ch);
        $object->error_code = curl_errno($ch);
        $object->error = curl_error($ch);
        $object->info = curl_getinfo($ch);

        curl_close($ch);

        return $object;
    }

}