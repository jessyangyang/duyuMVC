<?php
/**
* PaymentUtil  Class 
*
* @package     DuyuMvc
* @author      Jess
* @version     1.0
* @license     http://wiki.duyu.com/duyuMvc
*/

namespace lib\dao;

use \local\pay\alipay\lib\AlipaySubmit;
use \local\pay\alipay\lib\AlipayNotify;
use \local\pay\alipay\lib\AlipayCore;
use \lib\models\PaymentConfig;

class PaymentUtil {

	private static $alipay_format = "XML";
	private static $alipay_service;
	private static $alipay_version = "2.0";

	private static $ini = null;
	private static $ini_auth = null;
	private static $config = null;
	private static $http_verify_url = 'http://notify.alipay.com/trade/notify_query.do?';
	
	
	function __construct()
	{

	}
	
	public static function getConfig($configid = 2)
	{
		if (self::$ini_auth == null) self::$ini_auth = PaymentConfig::instance($configid);
		return self::$ini_auth;
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
			"service" => self::$ini_auth->alipay_service_auth,
			"payment_type" => self::$ini_auth->alipay_payment_type,
			"partner" => self::$ini_auth->alipay_pid,
			"_input_charset" => self::$ini_auth->alipay_input_charset,
			"seller_email" => self::$ini_auth->alipay_email,
			"return_url" => self::getBaseUrl() . self::$ini_auth->alipay_return_url,
			"notify_url" => self::getBaseUrl() . self::$ini_auth->alipay_notify_url,
			"subject" => self::$ini_auth->alipay_subject,
			"body" => self::$ini_auth->alipay_body,
			"exter_invoke_ip" => self::$ini_auth->alipay_exter_invoke_ip,
			"show_url" => self::getBaseUrl() . self::$ini_auth->alipay_show_url
		);	

		if ($more && is_array($more)) {

			if (isset($more['out_trade_no'])) {
				$config['show_url'] = $config['show_url'] . '/' . $more['out_trade_no'];
			}

			foreach ($more as $key=>$v) {
				$config[$key] = $v;
			}
		}

		$key = trim(self::$ini_auth->alipay_key); 

		$config = AlipayCore::paraFilter($config);
		$config = AlipayCore::argSort($config);
		$signType = strtoupper(trim(self::$ini_auth->alipay_sign_type));
		$sign = AlipayCore::buildMysign($config, $key, $signType);
		
		$config['sign'] = $sign;
		$config['sign_type'] = $signType;

		return $config;
	}

	/**
	 * [getAlipayConfigForWAP description]
	 * @param  boolean $more [description]
	 * @return [type]        [description]
	 *
	 * 
	 * $config = array(
			"service" => "alipay.wap.auth.authAndExecute",
			"partner" => "2008***",
			"sec_id" => "***",
			"format"	=> "XML",
			"v"	=> $v,
			"req_id"	=> $req_id,
			"req_data"	=> $req_data,
			"_input_charset"	=> trim(strtolower($alipay_config['input_charset']))
		 );
	 */
	public static function getAlipayConfigForWAP($configid = 2, $more = false )
	{
		self::getConfig($configid);
		self::$config = array(
			"service" => self::$ini_auth->alipay_service_auth,
			"partner" => self::$ini_auth->alipay_pid,
			'sec_id' => self::$ini_auth->alipay_sign_type,
			'format' => self::$alipay_format,
			"v" => self::$alipay_version,
			"req_id" => date('Ymdhis'),
			"_input_charset" => self::$ini_auth->alipay_input_charset,
		);

		self::$ini = array(
			'partner' => self::$ini_auth->alipay_pid,
			'key' => self::$ini_auth->alipay_key,
			'sign_type' => self::$ini_auth->alipay_sign_type,
			'input_charset' => self::$ini_auth->alipay_input_charset,
			'transport' => self::$ini_auth->alipay_transport,
			'private_key_path'	=> 'key/rsa_private_key.pem',
			'ali_public_key_path' => 'key/alipay_public_key.pem',
			'cacert' => '');	

		if ($more && is_array($more)) {
			foreach ($more as $key=>$v) {
				self::$config[$key] = $v;
			}
		}

	}
	
	
	public static function getAlipayToUrl($order_no, $total_fee, $subject = false, $more=false)
	{
		if ($more && is_array($more)) $config = $more;
		else $config = array();

		self::getAlipayConfigForWAP();

		$config = self::$config;
		$req_data = '<direct_trade_create_req><notify_url>' . self::getBaseUrl() . self::$ini_auth->alipay_notify_url . '</notify_url><call_back_url>' . self::getBaseUrl() . self::$ini_auth->alipay_notify_url . '</call_back_url><seller_account_name>' . self::$ini_auth->alipay_email . '</seller_account_name><out_trade_no>' . $order_no . '</out_trade_no><subject>' . $subject . '</subject><total_fee>' . $total_fee . '</total_fee></direct_trade_create_req>';
		
		$config['out_trade_no'] = $order_no;
		$config['total_fee'] = $total_fee;
		$config['req_data'] = $req_data;

		
		$url = self::$http_verify_url;
		foreach ($config as $key=>$value)
		{
			$url.= $key . '=' . urlencode($value) . '&';
		}

		self::$config = $config;
		
		return $config;
	}

	public function getRequestToken()
	{
		$alipaySubmit = new AlipaySubmit(self::$ini);
		$html_text = $alipaySubmit->buildRequestHttp(self::$config);

		$html_text = urldecode($html_text);

		echo "<pre>";
		print_r($html_text);

		$para_html_text = $alipaySubmit->parseResponse($html_text);

		$request_token = $para_html_text['request_token'];

		$req_data = '<auth_and_execute_req><request_token>' . $request_token . '</request_token></auth_and_execute_req>';

		self::$config['service'] = self::$ini_auth->alipay_service_pay;
		self::$config['req_data'] = $req_data;

		// echo "<pre>";
		// print_r(self::$ini);
		// print_r($para_html_text);
		// print_r(self::$config);
		// exit();
		$alipaySubmit = new AlipaySubmit(self::$ini);
		$html_text = $alipaySubmit->buildRequestForm(self::$config, 'get', '确认');
		
		return $html_text;
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