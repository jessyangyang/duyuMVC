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

namespace backend\rest;



class RegisterRest extends \local\rest\Restful{

    public static function initRegister()
    {
        //test
        self::regRestURL('testIndex','/api/test/test/:id','test','test');
        self::regRestURL('testReg','/api/test/reg','test','reg');
        self::regRestURL('testLogin','/api/test/login','test','login');
        self::regRestURL('testAdd','/api/test/addClient','test','addClient');
        self::regRestURL('testAuth','/api/test/auth','test','auth');
        self::regRestURL('testAuth','/api/test/upload','test','upload');
        self::regRestURL('testAuth','/api/test/addComment','test','addComment');

        /**Writer System
        ************************/

        // writer login
        self::regRestURL('writerIndex','/writer/index/:action/:bid','writer','index');
        // writer title
        self::regRestURL('writerTitle','/writer/title/:bid','writer','title');
        // writer edit 
        self::regRestURL('writerEdit','/writer/edit/:action/:menuid','writer','edit');
        // writer cover 
        self::regRestURL('writerCover','/writer/cover/:type','writer','cover');
        // writer end
        self::regRestURL('writerEnd','/writer/end','writer','end');


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
        self::regRestURL('mIndex','/m/index/:action','m','index');
        self::regRestURL('mBook','/m/book/:bid','m','book');
        self::regRestURL('mUser','/m/user/:action','m','user');
        
        return self::$restURL;
    }

}
