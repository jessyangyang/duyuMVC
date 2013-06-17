<?php
/**
 * Files Controllers
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
use \backend\image\ImageControl;
use \Yaf\Session;
use \local\rest\Restful;

class FilesController extends \Yaf\Controller_Abstract 
{

    public function uploadAction($type = false) 
    {
        $rest = Restful::instance();

        $data = $this->getRequest();

        $session = Session::getInstance();
        $userInfo = Members::getCurrentUser();
        $user = Members::instance();
        $bookfield = BookFields::instance();
        $bid = $session->get("bid");

        $code = 200;
        $message = "ok";

        $book = Books::instance();

        $image = new ImageControl();

        if (!$userInfo->id or !$bid)
        {
            $code = 402;
            $message = "No Login";
        }

        $file = $data->getFiles();

        switch ($type) {
            case 'cover':
                $avatarId = $image->storeFiles($file['cover'],$userInfo->id , 3,'image');
                $image->addBookImage($avatarId,$bid,3);
                break;
            case 'thumb':
                $avatarId = $image->storeFiles($file['thumb'],$userInfo->id , 1,'image');
                $image->addBookImage($avatarId,$bid,1);
                break;
            case 'flash':
                break;
            case 'epub':
                break;
            default:
                # code...
                break;
        }

        $rest->assign('code',$code);
        $rest->assign('message',$message);
        $rest->response();
    }
}