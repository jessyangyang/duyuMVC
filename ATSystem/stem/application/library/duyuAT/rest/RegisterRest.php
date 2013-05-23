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

namespace duyuAT\rest;



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

        /**User
        ************************/

        // userLogin
        self::regRestURL('userLogin','/api/user/login','user','login');
        // userRegister
        self::regRestURL('userRegister','/api/user/register','user','register');
        // userLogout
        self::regRestURL('userLogout','/api/user/logout','user','logout');
        // userProfile
        self::regRestURL('userProfile','/api/user/profile','user','profile');
        
        // user Buylist
        self::regRestURL('userBuyList','/api/user/buyList/:offset/:limit','userShelf','buyList');
        // user Anthor BuyList
        self::regRestURL('userOtherBuyList','/api/user/otherList/:type','userShelf','otherList');
        // user Delete book
        self::regRestURL('userDeleteBook','/api/user/book/delete/:bid','userShelf','delete');

        // Payment For Apple
        self::regRestURL('paymentForApple','/api/payment/apple/feedback','store','paymentForApple');
        
        
        return self::$restURL;
    }

}
