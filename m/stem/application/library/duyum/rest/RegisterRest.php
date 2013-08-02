<?php
/**
 * Register
 *
 * @package     DuyuMvc
 * @author      Jess
 * @version     1.0
 * @license     http://wiki.duyu.com/duyuMvc
 * 
 */

namespace duyum\rest;

class RegisterRest extends \local\rest\Restful{

    public static function initRegister()
    {
        /**
         * Files System
         */
        
        // Upload Image
        self::regRestURL('filesUpload','/files/upload/:type','files','upload');
        self::regRestURL('filesLoad','/files/load/:type','files','load');
        self::regRestURL('filesSend','/files/send/:fileName','files','send');

        /////////////////////
        // Mobile WebSite  //
        /////////////////////
        self::regRestURL('mIndex','/index/:action','index','index');
        self::regRestURL('mBook','/book/:bid','index','book');
        self::regRestURL('mUser','/user/:action','index','user');
        self::regRestURL('mPayment','/payment/:bid','index','payment');
        self::regRestURL('mPaymentHandle','/paymenthandle/:action','index','paymenthandle');
        self::regRestURL('mDownload','/download/:id','index','download');


        ///////////
        // Test  //
        ///////////
        self::regRestURL('testIndex','/test/:action','test','index');
        
        return self::$restURL;
    }

}
