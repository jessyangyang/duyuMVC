<?php
/**
* Store Payment API 
*
* @package     DuyuMvc
* @author      Jess
* @version     1.0
* @license     http://wiki.duyu.com/duyuMvc
*/

use \lib\dao\ProductsControl;
use \lib\dao\PaymentUtil;
use \local\pay\alipay\lib\AlipayCore;
use \local\pay\alipay\lib\AlipayNotify;
use \local\pay\alipay\lib\AlipaySubmit;
use \local\rest\Restful;

use \duyuu\dao\MemberStateTemp;

class PaymentController extends \Yaf\Controller_Abstract 
{
    public function applePaymentAction()
    {

    }
    
    public function alipayNotifyAction()
    {
    	$rest = Restful::instance();
    	$products = ProductsControl::instance();
    	
    	$code = 200;
    	$message = "ok";
    	
    	foreach ($_GET as $key=>$v) {
    		$params .= $key . '=' . $v . "\n";
    	}
    	
    	$rest->assign('code',$code);
    	$rest->assign('message',$message);
    	$rest->assign('params', $params);
    	 
    	$rest->response();
    }
    
    public function alipayReturnAction()
    {
    	$rest = Restful::instance();
    	$products = ProductsControl::instance();
    	
    	$code = 200;
    	$message = "ok";
    	
    	if(PaymentUtil::validateAlipayResultSign())
        {
            if (PaymentUtil::isAlipaySucceed())
            {
                PaymentUtil::paiedProcess();
            }
            else
            {
                //TODO log failure of payment
            	list($code, $message) = array (202, 'Failed to pay.');
            }
        }
        else
        {
            //TODO log failure of sign validation
        	list($code, $message) = array (202, "sign validation failed.");
        }
        
        $rest->assign('code',$code);
        $rest->assign('message',$message);
         
        $rest->response();
    }
    
    public function alipayToAction($productID = false)
    {
    	$rest = Restful::instance();
    	$userState = MemberStateTemp::getCurrentUserForAuth();
    	$products = new ProductsControl();
    	
    	$code = 200;
    	$message = "ok";
    	
    	if (!$userState) {
    		list($code ,$message ) = array(402 , "No Login.");
    		goto toJson;
    	}
    	
    	if ($productID == false)
    	{
    		list($code, $message) = array (202, "GET failed. ProductID Not Null.");
    		goto toJson;
    	}
    	
    	$product_object = $products->getProductsRow(array('product_id' => $productID));
    	 
    	if (!$product_object)
    	{
    		list ($code, $message ) = array(202 , "Product failed. ProductID not existed.");
    		goto toJson;
    	}
    	else 
    	{
    		$order_num = isset($product_object['order_num']) ? $product_object['order_num'] : 0;
    		$total_fee = isset($product_object['total_fee']) ? $product_object['total_fee'] : 0;
    		
    		header("Location: " . PaymentUtil::GetAlipayToUrl($order_num, $total_fee));
    		exit();
    	}
    	
    	toJson:
    	$rest->assign('code',$code);
    	$rest->assign('message',$message);
    	
    	$rest->response();
    }
   
}