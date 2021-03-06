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
use \local\files\Files;

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

        $fileSaveType = $filePathType = 0;

        $code = 200;
        $message = "ok";

        $ckeditor = $_GET;

        $book = Books::instance();

        $image = new ImageControl();

        if(stripos($type,'?')) $type = mb_substr($type,0,stripos($type,'?'), 'utf-8');

        $echoResult = function($fn,$fileurl,$message)
        {
            $str='<script type="text/javascript">window.parent.CKEDITOR.tools.callFunction('.$fn.', \''.$fileurl.'\', \''.$message.'\');</script>';
            exit($str);
        };

        if (!$userInfo->id or !$bid)
        {
            $code = 402;
            $message = "No Login";
        }

        if(!isset($ckeditor['CKEditorFuncNum'])) $echoResult(1,"","错误的文件调用请求");

        $file = $data->getFiles();


        switch ($type) {
            case 'images':
                $fileSaveType = 4;
                $filePathType = "book";
                break;
            case 'thumb':
                
                break;
            case 'flash':
                break;
            case 'epub':
                break;
            default:
                # code...
                break;
        }

        if ($fileSaveType > 0)
        {
            $avatarId = $image->save($file['upload'],$userInfo->id , $fileSaveType,$filePathType, false, $bid);
            $image->addBookImage($avatarId,$bid,$fileSaveType);
            $echoResult($ckeditor['CKEditorFuncNum'],ImageControl::getRelativeImage($image->_file),"上传成功");
        }
        else
        {
            $echoResult($ckeditor['CKEditorFuncNum'],"","文件上传失败，请检查上传目录设置和目录读写权限");
        }

        $rest->assign('code',$code);
        $rest->assign('message',$message);
        $rest->response();
    }

    public function loadAction($type = false)
    {
        $display = $this->getView();

        $data = $this->getRequest();

        $session = Session::getInstance();
        $bid = $session->get("bid");

        $image = new ImageControl();

        if(stripos($type,'?')) $type = mb_substr($type,0,stripos($type,'?'), 'utf-8');

        $ckeditor = $_GET;

        $paths = "";

        $items = Files::getFile(FILES_PATH . '/files/book/' . $bid);

        foreach ($items as $key => $value) {
            $paths[] = ImageControl::getRelativeImage("/book/" . $bid . "/".$value);
        }

        $display->assign('title',"图片管理器");
        $display->assign('files',$items);
        $display->assign('paths',$paths);
    }

    public function sendAction($fileName = false)
    {
        $rest = Restful::instance();

        $data = $this->getRequest();

        $session = Session::getInstance();
        $bid = $session->get("bid");
        $ckeditor = $_GET;

        if(stripos($fileName,'?')) $fileName = mb_substr($fileName,0,stripos($fileName,'?'), 'utf-8');

        $echoResult = function($fn,$fileurl,$message)
        {
            $str='<script type="text/javascript">window.parent.CKEDITOR.tools.callFunction('.$fn.', \''.$fileurl.'\', \''.$message.'\');</script>';
            exit($str);
        };

        $echoResult($ckeditor['CKEditorFuncNum'],ImageControl::getRelativeImage("/book/" . $bid . "/".$fileName),"上传成功");
    }
}