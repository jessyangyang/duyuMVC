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

use \duyum\payment\PaymentForMobile;
use \lib\models\ImageControl;
use \Yaf\Session;

use \local\social\OAuthException;
use \local\social\SaeTOAuthV2;
use \local\social\SaeTClientV2;


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
        $weiboUrl = $weibo->getAuthorizeURL($weiboConfig['weibo']['callback']);
        $keys = $weiboMessage = array();
        
        $display->assign('weibo_url',$weiboUrl);

        switch ($action) {
            case 'callback':
                echo "test";
                print_r($_GET);
                print_r($token);
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
                    $topTitle = "欢迎你， ".$weiboMessage['name'];
                
                if ($data->isPost()) {
                    if ($user->isRegistered($data->getPost('email')))
                    {
                        header('Location: /user/register');
                        exit();
                    }
                    if($member->register($data->getPost('email'),$weiboMessage['name'],$data->getPost('password'),$weiboMessage['avatar_large']))
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
                    if ($user->login($data->getPost('email'),$data->getPost('password')))
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
                
                $display->assign('user',$userInfo);
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
            default:
                # code...
                break;
        }
        
        show:
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
}