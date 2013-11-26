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
        //*** backend Admin 
        //***************/
        self::regRestURL('adminIndex','/admin/index/:mid','admin','index');

        self::regRestURL('adminAllBook','/admin/allbook/:limit/:page','admin','allbook');
        self::regRestURL('adminPost','/admin/post/:type/:post_id','admin','post');

        
        //admin Test
        self::regRestURL('adminTestIndex','/api/test/test/:id','test','test');
        self::regRestURL('adminTestReg','/api/test/reg','test','reg');
        self::regRestURL('adminTestLogin','/api/test/login','test','login');
        self::regRestURL('adminTestAdd','/api/test/addClient','test','addClient');
        self::regRestURL('adminTestAuth','/api/test/auth','test','auth');
        self::regRestURL('adminTestUpload','/api/test/upload','test','upload');
        self::regRestURL('adminTestComment','/api/test/addComment','test','addComment');

        /**
         * Index System
         */
        self::regRestURL('webIndex','/index','index','index');

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

        
        return self::$restURL;
    }

}
