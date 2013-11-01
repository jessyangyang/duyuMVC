<?php
/**
* Common Functions Class 
*
* @package     DuyuMvc
* @author      Jess
* @version     1.0
* @license     http://wiki.duyu.com/duyuMvc
*/

namespace local\base;

class Common
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
    * Changging the data and salt to hashdata
    */
    public function md5($data,$salt)
    {
        return md5($data.$salt);
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

    /**
     * [random description]
     * @param  [type]  $length  [description]
     * @param  integer $numeric [description]
     * @return [type]           [description]
     */
    function random($length, $numeric = 0) {
        PHP_VERSION < '4.2.0' ? mt_srand((double)microtime() * 1000000) : mt_srand();
        $seed = base_convert(md5(print_r($_SERVER, 1).microtime()), 16, $numeric ? 10 : 35);
        $seed = $numeric ? (str_replace('0', '', $seed).'012340567890') : ($seed.'zZ'.strtoupper($seed));
        $hash = '';
        $max = strlen($seed) - 1;
        for($i = 0; $i < $length; $i++) {
            $hash .= $seed[mt_rand(0, $max)];
        }
        return $hash;
    }

    /**
     * [Get client IP]
     * @return 
     */
    function ip()
    {
        $onlineip = "";
        if(getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown')) 
        {
            $onlineip = getenv('HTTP_CLIENT_IP');
        }
        elseif(getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown'))
        {
            $onlineip = getenv('HTTP_X_FORWARDED_FOR');
        }
        elseif(getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown'))
        {
            $onlineip = getenv('REMOTE_ADDR');
        }
        elseif(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown'))
        {
            $onlineip = $_SERVER['REMOTE_ADDR'];
        }
        return $onlineip;
    }

    public static function is_mobile() {
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        $mobile_agents = Array("240x320","acer","acoon","acs-","abacho","ahong","airness","alcatel","amoi","android","anywhereyougo.com","applewebkit/525","applewebkit/532","asus","audio","au-mic","avantogo","becker","benq","bilbo","bird","blackberry","blazer","bleu","cdm-","compal","coolpad","danger","dbtel","dopod","elaine","eric","etouch","fly ","fly_","fly-","go.web","goodaccess","gradiente","grundig","haier","hedy","hitachi","htc","huawei","hutchison","inno","ipad","ipaq","ipod","jbrowser","kddi","kgt","kwc","lenovo","lg ","lg2","lg3","lg4","lg5","lg7","lg8","lg9","lg-","lge-","lge9","longcos","maemo","mercator","meridian","micromax","midp","mini","mitsu","mmm","mmp","mobi","mot-","moto","nec-","netfront","newgen","nexian","nf-browser","nintendo","nitro","nokia","nook","novarra","obigo","palm","panasonic","pantech","philips","phone","pg-","playstation","pocket","pt-","qc-","qtek","rover","sagem","sama","samu","sanyo","samsung","sch-","scooter","sec-","sendo","sgh-","sharp","siemens","sie-","softbank","sony","spice","sprint","spv","symbian","tablet","talkabout","tcl-","teleca","telit","tianyu","tim-","toshiba","tsm","up.browser","utec","utstar","verykool","virgin","vk-","voda","voxtel","vx","wap","wellco","wig browser","wii","windows ce","wireless","xda","xde","zte");
        $is_mobile = false;
        foreach ($mobile_agents as $device) {
            if (stristr($user_agent, $device)) {
                $is_mobile = true;
                break;
            }
        }
        return $is_mobile;
    }


}