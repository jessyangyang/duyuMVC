<?php
/**
* PaymentUtil Controller 
*
* @package     DuyuMvc
* @author      Jess
* @version     1.0
* @license     http://wiki.duyu.com/duyuMvc
*/

namespace local\payment;

use duyuu\dao\AppleProduct;

class paymentutil {
    private static $verify = "https://buy.itunes.apple.com/verifyReceipt";
    private static $sandbox_verify = "https://sandbox.itunes.apple.com/verifyReceipt";

    public static function appleSubscription($productID,$vertifyResp,$user)
    {
        if (!is_array($vertifyResp) or !isset($vertifyResp['receipt'])) {
            return false;
        }
        $apple = AppleProduct::instance();

        $receipt = $vertifyResp['receipt'];
        $appleProduct = AppleProduct::getByID($productID);

        if ($appleProduct) {
            if (isset($varifyResp['receipt']['expires_date'])) {
                // buy subscription product
            }
        }

    }
}