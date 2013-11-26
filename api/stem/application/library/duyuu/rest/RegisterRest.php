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
        self::regRestURL('apiTestIndex','/api/test/index','test','index');
        self::regRestURL('apiTestReg','/api/test/reg','test','reg');
        self::regRestURL('apiTestLogin','/api/test/login','test','login');
        self::regRestURL('apiTestAddClient','/api/test/addclient','test','addClient');
        self::regRestURL('apiTestToken','/api/test/token','test','token');
        self::regRestURL('apiTestAuthorize','/api/test/authorize','test','authorize');
        self::regRestURL('apiTestCallback','/api/test/callback','test','callback');
        self::regRestURL('apiTestUpload','/api/test/upload','test','upload');
        self::regRestURL('apiTestAddComment','/api/test/addComment','test','addComment');
        self::regRestURL('apiTestResource','/api/test/resource','test','resource');
        self::regRestURL('apiTestFinish','/api/test/finish','test','finish');

        /**User
        ************************/

        // userLogin
        self::regRestURL('apiUserLogin','/api/user/login','user','login');
        // userRegister
        self::regRestURL('apiUserRegister','/api/user/register','user','register');
        // userLogout
        self::regRestURL('apiUserLogout','/api/user/logout','user','logout');
        // userProfile
        self::regRestURL('apiUserProfile','/api/user/profile','user','profile');
        // userPurchased
        self::regRestURL('apiUserPurchased','/api/user/purchased/:page/:limit','user','purchased');
        
        // user Buylist
        self::regRestURL('apiUserBuyList','/api/user/buyList/:offset/:limit','userShelf','buyList');
        // user Anthor BuyList
        self::regRestURL('apiUserOtherBuyList','/api/user/otherList/:type','userShelf','otherList');
        // user Delete book
        self::regRestURL('apiUserDeleteBook','/api/user/book/delete/:bid','userShelf','delete');



        /** Content
        ************************/
        
        // store recommond books
        self::regRestURL('apiStoreIndexRecommend','/api/store/recommend','store','recommend');
        // store top list
        self::regRestURL('apiStoreTopList','/api/store/top/:sortID','store','top');

        // store menu list
        self::regRestURL('apiStoreMenuList','/api/store/menu/:mid/:limit/:page','store','menu');

        // store The Book of category
        self::regRestURL('apiStoreCategory','/api/store/category','store','category');
        // store Sub category
        self::regRestURL('apiStoreSubCategory','/api/store/category/:cid/:limit/:page','store','subCategory');
        // store Book Infomation
        self::regRestURL('apiStoreBookInfo','/api/store/book/:bid','storeBook','book');
        // store Book Menu
        self::regRestURL('apiStoreBookMenu','/api/store/book/menu/:bid','storeBook','bookMenu');
        // store Book Chapter
        self::regRestURL('apiStoreBookChapter','/api/store/book/chapter/:bid','store','bookChapter');

        // store Download Book
        self::regRestURL('apiStoreDownLoadBook','/api/store/download/book/:bid','Download','book');

        /** Comments
        *************************/

        // add comment
        self::regRestURL('apiStoreAddComment','/api/comments/add','Comments','addComment');
        // delete comment
        self::regRestURL('apiStoreDeleteComment','/api/comments/delete/:bid','Comments','deleteComment');
        // book Comments List
        self::regRestURL('apiStoreBookCommentList','/api/comments/bid/:bid/:limit/:page','Comments','bookCommentList');

        // book Comments list for user
        self::regRestURL('apiStoreBookCommentListForUser','/api/comments/uid/:limit/:page','Comments','bookCommentListForUser');

        /** Payment
        *************************/

        // Payment For Apple
        self::regRestURL('apiPaymentForApple','/api/payment/apple/feedback','store','paymentForApple');
        
        
        // Payment For Alipay
        
        self::regRestURL('apiPaymentForAlipayTo', '/api/payment/alipay/pay/:productID', 'payment', 'alipayTo');
        self::regRestURL('apiPaymentForAlipayNotify', '/api/payment/alipay/notify', 'payment', 'alipayNotify');
        self::regRestURL('apiPaymentForAlipayCallback', '/api/payment/alipay/callback', 'payment', 'alipayReturn');

        // WeChaT
        self::regRestURL('apiWechatIndex', '/api/wechat/index', 'wechat', 'index');
        self::regRestURL('apiWechatToken', '/api/wechat/token', 'wechat', 'token');
        
        return self::$restURL;
    }

}
