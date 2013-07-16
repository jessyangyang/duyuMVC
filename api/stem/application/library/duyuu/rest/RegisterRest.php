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
        // userPurchased
        self::regRestURL('userPurchased','/api/user/purchased/:page/:limit','user','purchased');
        
        // user Buylist
        self::regRestURL('userBuyList','/api/user/buyList/:offset/:limit','userShelf','buyList');
        // user Anthor BuyList
        self::regRestURL('userOtherBuyList','/api/user/otherList/:type','userShelf','otherList');
        // user Delete book
        self::regRestURL('userDeleteBook','/api/user/book/delete/:bid','userShelf','delete');



        /** Content
        ************************/
        
        // store recommond books
        self::regRestURL('storeIndexRecommend','/api/store/recommend','store','recommend');
        // store top list
        self::regRestURL('storeTopList','/api/store/top/:sortID','store','top');

        // store The Book of category
        self::regRestURL('storeCategory','/api/store/category','store','category');
        // store Sub category
        self::regRestURL('storeSubCategory','/api/store/category/:cid/:limit/:page','store','subCategory');
        // store Book Infomation
        self::regRestURL('storeBookInfo','/api/store/book/:bid','storeBook','book');
        // store Book Menu
        self::regRestURL('storeBookMenu','/api/store/book/menu/:bid','storeBook','bookMenu');
        // store Book Chapter
        self::regRestURL('storeBookChapter','/api/store/book/chapter/:bid','store','bookChapter');

        // store Download Book
        self::regRestURL('storeDownLoadBook','/api/store/download/book/:bid','Download','book');

        /** Comments
        *************************/

        // add comment
        self::regRestURL('storeAddComment','/api/comments/add','Comments','addComment');
        // delete comment
        self::regRestURL('storeDeleteComment','/api/comments/delete/:bid','Comments','deleteComment');
        // book Comments List
        self::regRestURL('storeBookCommentList','/api/comments/bid/:bid/:limit/:page','Comments','bookCommentList');

        // book Comments list for user
        self::regRestURL('storeBookCommentListForUser','/api/comments/uid/:uid/:limit/:page','Comments','bookCommentListForUser');

        /** Payment
        *************************/

        // Payment For Apple
        self::regRestURL('paymentForApple','/api/payment/apple/feedback','store','paymentForApple');
        
        
        return self::$restURL;
    }

}
