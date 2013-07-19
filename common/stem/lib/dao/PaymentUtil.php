<?php
/**
* PaymentUtil  Class 
*
* @package     DuyuMvc
* @author      Jess
* @version     1.0
* @license     http://wiki.duyu.com/duyuMvc
*/

namespace \lib\dao;

use \local\pay\alipay\lib\AlipaySubmit;
use \local\pay\alipay\lib\AlipayNotify;
use \local\pay\alipay\lib\AlipayCore;
use \lib\models\PaymentConfig;

class PaymentUtil {
	
	private static $ini = null;
	private static $http_verify_url = 'http://notify.alipay.com/trade/notify_query.do?';
	
	public static function getConfig()
	{
		if (self::$ini == null) self::$ini = PaymentConfig::instance(1);
		return self::$ini;
	}
	
	public static function getBaseUrl()
	{
		return 'http://' . $_SERVER['HTTP_HOST'];
	}
	
	/**
	 * Full config array:
		 $config = array(
			 "service"			=> "create_direct_pay_by_user",
			 "payment_type"		=> "1",
			 "partner"			=> "2008***",
			 "_input_charset"	=> "utf-8",
			 "seller_email"		=> "",
			 "return_url"		=> "",
			 "notify_url"		=> "",
			 "out_trade_no"		=> "",
			 "subject"			=> "",
			 "body"				=> "",
			 "total_fee"			=> "",
			 "paymethod"			=> "",
			 "defaultbank"		=> "",
			 "anti_phishing_key"	=> "",
			 "exter_invoke_ip"	=> "",
			 "show_url"			=> "",
			 "extra_common_param"=> "",
			 "royalty_type"		=> "",
			 "royalty_parameters"=> ""
		 );
	 */
	public static function getAlipayConfig($more = false)
	{
		$config = array(
			"service" => self::$ini->alipay_service,
			"payment_type" => self::$ini->alipay_payment_type,
			"partner" => self::$ini-alipay_pid,
			"_input_charset" => self::$ini->alipay_input_charset,
			"seller_email" => self::$ini->alipay_email,
			"return_url" => self::getBaseUrl() . self::$ini->alipay_return_url,
			"notify_url" => self::getBaseUrl() . self::$ini->alipay_notify_url,
			"subject" => self::$ini->alipay_subject,
			"body" => self::$ini->alipay_body,
			"exter_invoke_ip" => self::$ini->alipay_exter_invoke_ip,
			"show_url" => self::getBaseUrl() . self::$ini->alipay_show_url
		);	

		if ($more && is_array($more)) {

			if (isset($more['out_trade_no'])) {
				$config['show_url'] = $config['show_url'] . '/' . $more['out_trade_no'];
			}

			foreach ($more as $key=>$v) {
				$config[$key] = $v;
			}
		}

		$key = trim(self::$ini->alipay_key); 

		$config = AlipayCore::paraFilter($config);
		$config = AlipayCore::argSort($config);
		$signType = strtoupper(trim(self::$ini->alipay_sign_type));
		$sign = AlipayCore::buildMysign($config, $key, $signType);
		
		$config['sign'] = $sign;
		$config['sign_type'] = $signType;

		return $config;
	}
	
	
	public static function getAlipayToUrl($order_no, $total_fee, $more=false)
	{
		if ($more && is_array($more)) $config = $more;
		else $config = array();
		
		$config['out_trade_no'] = $order_no;
		$config['total_fee'] = $total_fee;
		$config = self::getAlipayConfig();
		
		$url = self::$http_verify_url;
		foreach ($config as $key=>$value)
		{
			$url.= $key . '=' . urlencode($value) . '&';
		}
		
		return $url;
	}
	
	public static function validateAlipayResultSign()
	{
		$sign = $_GET['sign'];
		
		$key = trim(self::getConfig()->alipay_key); 
		$params = AlipayCore::paraFilter($_GET);
		$params = AlipayCore::argSort($params);
		$signType = strtoupper(trim(self::getConfig()->alipay_sign_type));
		$vsign = AlipayCore::buildMysign($params, $key, $signType);

		if ($sign == $vsign) {
			return true;
		}
		return false;
	}
	
	public static function isAlipaySuccessd()
	{
		$isSuccess = isset($_GET['is_success']) ? trim($_GET['is_success']) : false;
		if ($isSuccess && $isSuccess == 'T') {
			return true;
		}
		return false;
	}
	
	public static function paiedProcess()
	{
		//TODO implements the process after paied successfully.
		echo 'Processing...<br />';
	}
	
}