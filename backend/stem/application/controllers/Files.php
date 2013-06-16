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

        $book = Books::instance();

        if (!$userInfo->id) return false;

        switch ($type) {
            case 'img':
                
                break;
            case 'flash':
                break;
            case 'epub':
                break;
            default:
                # code...
                break;
        }


        $rest->response();
    }
}