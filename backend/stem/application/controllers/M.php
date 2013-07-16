<?php
/**
 * ATS Controllers
 *
 * @package     DuyuMvc
 * @author      Jess
 * @version     1.0
 * @license     http://wiki.duyu.com/duyuMvc
 */

use \backend\dao\Members;
use \backend\dao\MemberInfo;
use \backend\dao\Images;
use \backend\dao\Books;
use \backend\dao\BookCategory;
use \backend\dao\BookInfo;
use \backend\dao\BookFields;
use \backend\dao\BookMenu;
use \backend\dao\BookChapter;

use \lib\dao\BookControllers;
use \lib\dao\MembersControl;

use \backend\image\ImageControl;
use \Yaf\Session;

use \local\social\OAuthException;
use \local\social\SaeTOAuthV2;
use \local\social\SaeTClientV2;


class MController extends \Yaf\Controller_Abstract 
{
    public function indexAction($action = false)
    {
        $display = $this->getView();

        $data = $this->getRequest();

        $session = Session::getInstance();
        $userInfo = Members::getCurrentUser();

        $book = new BookControllers();

        switch ($action) {
            case 'page':
                # code...
                break;
            
            default:
                # code...
                break;
        }

        $limit = $data->isPost('limit') ? $data->getPost('limit') : 10;
        $page = $data->isPost('page') ? $data->getPost('page') : 1;

        $list = $book->getBooksList(array('status' => BookControllers::BOOK_PUBLISHED_STATE,'p.type'=>1),$limit,$page);

        $count = is_array($list) ? count($list) : 0;

        $display->assign("title", "蠹鱼有书 - 荐书");
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

        if(!$bid) 
        {
            header('Location: /m/index');
            exit();
        }

        $menus = $menu->getMenuForBookID($bid);

        $book = new BookControllers();

        $list = $book->getBooksRow(array('books.bid'=>$bid,'p.type'=>1));

        $display->assign("title", "蠹鱼有书 - ".$list["title"]);
        $display->assign('topTitle',$list['title']);
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

        $weiboConfig = \Yaf\Application::app()->getConfig()->toArray();
        $weibo = new SaeTOAuthV2( $weiboConfig['weibo']['akey'] , $weiboConfig['weibo']['skey'] );
        $weiboUrl = $weibo->getAuthorizeURL($weiboConfig['weibo']['callback']);
        $keys = $weiboMessage = array();

        $title = "登录";

        switch ($action) {
            case 'callback':
                $keys['code'] = $_GET['code'];
                $keys['redirect_uri'] = $weiboConfig['weibo']['callback'];
                try {
                    $token = $weibo->getAccessToken( 'code', $keys ) ;
                    if($token) 
                    {
                        $session->set('token',$token);
                        header('Location: /m/user/register');
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
                $title = "欢迎你， ".$weiboMessage['name'];
                
                if ($data->isPost()) {
                    if($member->register($data->getPost('email'),$weiboMessage['name'],$data->getPost('password'),$weiboMessage['avatar_large']))
                    {
                        header('Location: /m/index');
                        exit();
                    }
                }
                break;
            default:
                # code...
                break;
        }
        
        $display->assign('action',$action);
        $display->assign('weibo_url',$weiboUrl);
        $display->assign("title", "蠹鱼有书 - 登录");
        $display->assign('topTitle',$title);
    }
}