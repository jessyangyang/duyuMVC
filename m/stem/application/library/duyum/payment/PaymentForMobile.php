<?php
/**
*
* PaymentForMobile
*
* @package     DuyuMvc
* @author      Jess
* @version     1.0
* @license     http://wiki.duyu.com/duyuMvc
*/

namespace duyum\payment;

use \lib\dao\PaymentUtil;
use \lib\dao\ProductsControl;

use \lib\models\Members;

class PaymentForMobile
{
    private $config;
    private $request_data;

    private $payment;
    private $products;
    private $member;

    function __construct()
    {
        $this->products = new ProductsControl();
        $this->payment = new PaymentUtil();
        $this->member = Members::getCurrentUser();
    }

    public function payment($bid)
    {
        $product = $this->products->getProductsRow(array("products.oldid" => $this->products->products->escapeString($bid),'pc.pcid' => 1));
        if ($product and isset($product['total_fee']) and $product['total_fee'] > 0)
        {
            $this->config = PaymentUtil::getAlipayToUrl($product['product_id'],$product['total_fee'],$product['product_name']);
            $html = PaymentUtil::getRequestToken();
        
            return $html;
        }
        else 
        {
            header("Location:/m/book/$bid");
            exit();
        }

        return false;
    }

    public function ResultHandle($action = false)
    {
        $this->config = PaymentUtil::getConfig(2);
        
        switch ($action) {
            case 'callback':
                $verify_result = $this->payment->alipayNotify->verifyReturn();
                if ($verify_result) {
                    $out_trade_no = $_GET['out_trade_no'];
                    $trade_no = $_GET['trade_no'];
                    $result = $_GET['result'] == "success" ? 1 : 0;
                    PaymentUtil::sendLog("type:callback;model:TRADE_SUCCESS;out_trade_no:$out_trade_no;trade_no:$trade_no;trade_status:$result");
                    if ($product = $this->addToPurchased($out_trade_no,$trade_no,$result)) {
                        header("Location:/m/book/".$product['oldid']);
                        exit();
                    }
                }
                break;
            case 'notify':
                $verify_result = $this->payment->alipayNotify->verifyNotify();
                if ($verify_result) {
                    $notify_data = $_POST['notify_data'];
                    if ($this->config->alipay_sign_type != "MD5") $notify_data = $this->payment->alipayNotify->decrypt($_POST['notify_data']);
                    $this->validateResultForAlipay($notify_data);
                }
                
                break;
            default:
                # code...
                break;
        }
    }

    public function validateResultForAlipay($notifyData)
    {
        $doc = new \DOMDocument();
        $doc->loadXML($notifyData);

        if( ! empty($doc->getElementsByTagName( "notify" )->item(0)->nodeValue) ) {

            $out_trade_no = $doc->getElementsByTagName( "out_trade_no" )->item(0)->nodeValue;
            $trade_no = $doc->getElementsByTagName( "trade_no" )->item(0)->nodeValue;
            $trade_status = $doc->getElementsByTagName( "trade_status" )->item(0)->nodeValue;
            
            if($_POST['trade_status'] == 'TRADE_FINISHED' and $this->member->id) {

                if ($this->addToPurchased($out_trade_no,$trade_no,$trade_status))
                {
                    PaymentUtil::sendLog("type:notify;model:TRADE_SUCCESS;out_trade_no:$out_trade_no;trade_no:$trade_no;trade_status:$trade_status");
                    echo "success";     //请不要修改或删除
                }
                else
                {
                    PaymentUtil::sendLog("type:notify;model:TRADE_SUCCESS;out_trade_no:$out_trade_no;trade_no:$trade_no;trade_status:$trade_status");
                    echo "fail";
                }
            }
            else if ($_POST['trade_status'] == 'TRADE_SUCCESS' and $this->member->id) {
                if ($this->addToPurchased($out_trade_no,$trade_no,$trade_status))
                {
                    PaymentUtil::sendLog("type:notify;model:TRADE_SUCCESS;out_trade_no:$out_trade_no;trade_no:$trade_no;trade_status:$trade_status");
                    echo "success";     //请不要修改或删除
                }
                else {
                    PaymentUtil::sendLog("type:notify;model:TRADE_SUCCESS;out_trade_no:$out_trade_no;trade_no:$trade_no;trade_status:$trade_status");
                    echo "fail";

                }
            }
        }
    }

    public function addToPurchased($out_trade_no,$trade_no,$trade_status)
    {
        $product_id = substr($out_trade_no, 0 , strrpos($out_trade_no,"O") + 1);

        $product = $this->products->getProductsRow(array('products.product_id' => $product_id));

        if ($product)
        {
            $result = $this->products->addPurchased($this->initPurchasedFields($product['pid'],$product['oldid'],$out_trade_no,$trade_no,$trade_status));
            if ($result) return $product;
        }

        return false;
    }

    public function initPurchasedFields($pid,$old_id,$out_trade_no, $trade_no, $trade_status)
    {
        return array(
            'pid' => $pid,
            'status' => $trade_status,
            'published' => time(),
            'trade_no' => $trade_no,
            'out_trade_no' => $out_trade_no,
            'uid' => $this->member->id,
            'old_id' => $old_id
            );
    }
}