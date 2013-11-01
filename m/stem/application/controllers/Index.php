<?php
/**
 * Index Controllers
 *
 * @package     DuyuMvc
 * @author      Jess
 * @version     1.0
 * @license     http://wiki.duyu.com/duyuMvc
 */

use \lib\models\Members;
use \lib\models\MemberInfo;
use \lib\models\MemberFields;
use \lib\models\Images;
use \lib\models\Books;
use \lib\models\BookCategory;
use \lib\models\BookInfo;
use \lib\models\BookFields;
use \lib\models\BookMenu;
use \lib\models\BookChapter;

use \lib\dao\BookControllers;
use \lib\dao\MembersControl;
use \lib\dao\ProductsControl;
use \lib\dao\DownloadControl;

use \duyum\payment\PaymentForMobile;
use \lib\models\ImageControl;
use \Yaf\Session;

use \local\social\OAuthException;
use \local\social\SaeTOAuthV2;
use \local\social\SaeTClientV2;
use \local\base\Common;


class IndexController extends \Yaf\Controller_Abstract 
{

    public function indexAction($action = false)
    {
        $display = $this->getView();

        $data = $this->getRequest();

        $session = Session::getInstance();
        $userInfo = Members::getCurrentUser();

        $book = new BookControllers();
        
        $action = $action == false ? $action = "recommend" : $action;
        
        $menus = $book->getRecommendMenuForType($book::MOBILE_TYPE);
        
        $cid = false;
        
        foreach ($menus as $key => $value)
        {
            if ($value['action'] == $action) {
                $cid = $value['cid'];
                $title = $value['name'];
            }
        }

        $limit = $data->isPost('limit') ? $data->getPost('limit') : 10;
        $page = $data->isPost('page') ? $data->getPost('page') : 1;

        $list = $book->getBookRecommendList(array('status' => BookControllers::BOOK_PUBLISHED_STATE,'p.type'=>1),$cid,$limit,$page);

        $count = is_array($list) ? count($list) : 0;

        $display->assign('user',$userInfo);
        $display->assign('menus',$menus);
        $display->assign('current',$action);
        $display->assign("title", $title);
        $display->assign('topTitle',"蠹鱼有书");
        $display->assign('books',$list);
        $display->assign("pages",array('limit'=>$limit,'page'=>$page,'count'=>$count));
    }

    public function bookAction($bid = false)
    {
        $display = $this->getView();

        $data = $this->getRequest();

        $session = Session::getInstance();
        $userInfo = Members::getCurrentUser();
        $menu = BookMenu::instance();
        $isLogin = isset($userInfo->id) and $userInfo->id ? true : false;
        
        $purchased = null;

        if(!$bid) 
        {
            header('Location: /index');
            exit();
        }

        $menus = $menu->getMenuForBookID($bid);

        $book = new BookControllers();
        $product = new ProductsControl();
        if (isset($userInfo->id) and $userInfo->id) $purchased = $product->getPurchasedForUserID($userInfo->id);

        $result = array();


        if ($purchased)
        {
            foreach ($purchased as $key => $value) {
                $result[] = $value['old_id'];
            }
        }
        $list = $book->getBooksRow(array('books.bid'=>$bid,'p.type'=>1));

        $display->assign('user',$userInfo);
        $display->assign("title", $list["title"]);
        $display->assign('topTitle',$list['title']);
        $display->assign('purchased',$result);
        $display->assign('book',$list);
        $display->assign('menus',$menus);
        $display->assign('isLogin',$isLogin);
    }

    public function userAction($action = false)
    {
        $display = $this->getView();

        $data = $this->getRequest();

        $session = Session::getInstance();
        $userInfo = Members::getCurrentUser();
        $member = new MembersControl();
        $user = new MembersControl();
        
        $title = "登录";
        $topTitle = "登录";
        
        $purchasedList = array();
        
        

        $weiboConfig = \Yaf\Application::app()->getConfig()->toArray();
        $weibo = new SaeTOAuthV2( $weiboConfig['weibo']['akey'] , $weiboConfig['weibo']['skey'] );
        $weiboUrl = $weibo->getAuthorizeURL($weiboConfig['weibo']['callback'],'code', NULL, "mobile");
        $keys = $weiboMessage = array();
        
        $display->assign('weibo_url',$weiboUrl);

        $message = '';



        switch ($action) {
            case 'callback':

                $keys['code'] = $_GET['code'];
                $keys['redirect_uri'] = $weiboConfig['weibo']['callback'];
                try {
                    $token = $weibo->getAccessToken( 'code', $keys ) ;

                    if($token) 
                    {
                        $session->set('token',$token);
                        header('Location: /user/register');
                        exit();
                    } 
                } catch (OAuthException $e) {
                }
                break;
            case 'register':

                    $token = $session->get('token');
                    $client = new SaeTClientV2( $weiboConfig['weibo']['akey'] , $weiboConfig['weibo']['skey'] , $token['access_token']);
                    $ms  = $client->home_timeline(); // done
                    $uid_get = $client->get_uid();
                    $uid = $uid_get['uid'];
                    $weiboMessage = $client->show_user_by_id($uid);
                    $topTitle = "你好， ".$weiboMessage['name'];
                
                if ($data->isPost()) {
                    $check = $user->checkUser($data->getPost('email'),$data->getPost('password'));
                    if ($check['title'] == false)
                    {
                        $message = $check['message'];
                    }
                    else if($member->register($data->getPost('email'),$weiboMessage['name'],$data->getPost('password'),$weiboMessage['avatar_large']))
                    {
                        header('Location: /index');
                        exit();
                    }
                }
                break;
            case 'login':
                if (isset($userInfo->id) and $userInfo->id)
                {
                    $title = $userInfo->username;
                    $topTitle = "购买记录";
                    $action = "purchased";
                    goto purchased;
                }
                if ($data->isPost()) {
                    $check = $user->checkUser($data->getPost('email'),$data->getPost('password'),false);
                    if ($check['title'] == false)
                    {
                        $message = $check['message'];
                    }
                    else if ($user->login($data->getPost('email'),$data->getPost('password')))
                    {
                        header('Location: /index');
                        exit();
                    }
                }
                break;
            case 'purchased':
                purchased:
                $products = new ProductsControl();
                $purchasedList = $products->getPurchasedForBooks(array(
                        'product_purchased.uid'=>$userInfo->id),50,1);

                $downloads = new DownloadControl();
                $downloadList = $downloads->getDownloadForUserid($userInfo->id,100,1);
                $download_count = $downloadList ? count($downloadList) : 0;
                $count = array('purchased'=>count($purchasedList),'download'=>$download_count);
                foreach ($purchasedList as $key => $value) {
                    $count['count'] += $value['price'];
                }

                foreach ($downloadList as $key => $value) {
                    $value['price'] = 0;
                    $purchasedList[] = $value;
                }

                $display->assign('user',$userInfo);
                $display->assign('count',$count);
                $display->assign('purchased',$purchasedList);
                $display->assign('action',$action);
                $display->assign("title", $title);
                $display->assign('topTitle',$topTitle);
                $display->display("index/purchased.tpl");
                break;
            case 'logout':
                $user->logout();
                header('Location: /index');
                exit();
                break;
            case 'cancel':
                header("Location:/user/login");
                exit();
                break;
            default:
                # code...
                break;
        }
        
        show:
        $display->assign('message',$message);
        $display->assign('user',$userInfo);
        $display->assign('action',$action);
        $display->assign("title", $title);
        $display->assign('topTitle',$topTitle);
    }


    public function paymentAction($bid = false)
    {
        $display = $this->getView();
        $userInfo = Members::getCurrentUser();

        if (isset($userInfo->id) and $userInfo->id)  {
            $payment = new PaymentForMobile();
            $html = $payment->payment($bid);

            if ($html) {
                header("Content-type: text/html; charset=utf-8"); 
                echo $html;
                exit();
            }
        }
        else
        {
            header('Location: /user/login');
            exit();
        }

        exit();
    }

    public function paymentHandleAction($action = false)
    {
        $display = $this->getView();

        $data = $this->getRequest();

        
        $userInfo = Members::getCurrentUser();

        if (isset($userInfo->id) and $userInfo->id)  {
           $payment = new PaymentForMobile();
           $payment->ResultHandle($action);
        }


        exit();
    }

    public function downloadAction($id = false)
    {
        $display = $this->getView();

        $data = $this->getRequest();

        $userInfo = Members::getCurrentUser();
        $isMobile = Common::is_mobile();

        if (isset($userInfo->id) and $userInfo->id) {
            $fields = MemberFields::instance($userInfo->id);
            if($fields->id)
            {
                $fields->download_count += 1;
                $fields->save();
            }
            else
            {
                $fields->insert(array('id'=>$userInfo->id,'download_count'=> '1'));
            }

            $download = new DownloadControl();
            $download->addDownload($userInfo->id,$id);
        }
        if ($isMobile) {
            header("duyu://?sync=$id&open=$id");
            exit();
        }  
    }
}