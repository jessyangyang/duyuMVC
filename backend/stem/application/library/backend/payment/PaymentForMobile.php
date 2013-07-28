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

namespace backend\payment;

use \lib\dao\PaymentUtil;
use \lib\dao\ProductsControl;

class PaymentForMobile
{
    private $config;
    private $request_data;

    private $payment;
    private $products;

    function __construct()
    {
        $this->products = new ProductsControl();
        $this->payment = new PaymentUtil();
    }

    public function payment($productID)
    {
        $product = $this->products->getProductsRow(array('product_id' => $this->products->products->escapeString($productID)));

        $config = PaymentUtil::getAlipayToUrl($product['product_id'],$product['total_fee'],$product['product_name']);
        $html = PaymentUtil::getRequestToken();
        
    }
}