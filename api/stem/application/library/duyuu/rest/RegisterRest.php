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

namespace duyuu\rest;

use \duyuu\rest\Restful;

class RegisterRest {

    public static function initRegister()
    {
        //test
        Restful::regRestURL('testIndex','/api/test/test/:id','test','test');
        Restful::regRestURL('testReg','/api/test/reg','test','reg');
        Restful::regRestURL('testLogin','/api/test/login','test','login');
        Restful::regRestURL('testAdd','/api/test/addClient','test','addClient');

        /**User
        ************************/

        // userLogin
        Restful::regRestURL('userLogin','/api/user/login/:email/:password','user','login');
        // userRegister
        Restful::regRestURL('userRegister','/api/user/register/:email/:name/:password','user','register');
        // userLogout
        Restful::regRestURL('userLogout','/api/user/logout','user','logout');
        // userProfile
        Restful::regRestURL('userProfile','/api/user/profile','user','profile');
        
        // user Buylist
        Restful::regRestURL('userBuyList','/api/user/buyList/:offset/:limit','userShelf','buyList');
        // user Anthor BuyList
        Restful::regRestURL('userOtherBuyList','/api/user/otherList/:type','userShelf','otherList');
        // user Delete book
        Restful::regRestURL('userDeleteBook','/api/user/book/delete/:bid','userShelf','delete');



        /** Content
        ************************/
        
        // store recommond books
        Restful::regRestURL('storeIndexRecommend','/api/store/recommend','store','recommond');
        // store top list
        Restful::regRestURL('storeTopList','/api/store/top','store','top');

        // store The Book of category
        Restful::regRestURL('storeCategory','/api/store/category','store','category');
        // store Sub category
        Restful::regRestURL('storeSubCategory','/api/store/category/:cid','store','subCategory');
        // store Book Infomation
        Restful::regRestURL('storeBookInfo','/api/store/book/:bid','store','bookInfo');
        // store Book Chapter
        Restful::regRestURL('storeBookChapter','/api/store/book/chapter/:bid','store','bookChapter');

        // store Download Book
        Restful::regRestURL('storeDownLoadBook','/api/store/download/book/:bid','store','download');

        /** Payment
        *************************/

        // Payment For Apple
        Restful::regRestURL('paymentForApple','/api/payment/apple/feedback','store','paymentForApple');
        
        
        return Restful::$restURL;
    }

}
