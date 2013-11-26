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
        self::regRestURL('mFilesUpload','/files/upload/:type','files','upload');
        self::regRestURL('mFilesLoad','/files/load/:type','files','load');
        self::regRestURL('mFilesSend','/files/send/:fileName','files','send');

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
        self::regRestURL('mTestIndex','/test/:action','test','index');
        self::regRestURL('mTestRoles','/test/:action','test','roles');
        
        return self::$restURL;
    }

}
