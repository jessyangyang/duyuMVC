<?php
/**
 * Download Controllers
 *
 * @package     DuyuMvc
 * @author      Jess
 * @version     1.0
 * @license     http://wiki.duyu.com/duyuMvc
 */

use \local\download\Download;
use \local\models\BookInfo;
use \local\rest\Restful;
use \duyuu\dao\MemberStateTemp;

class DownloadController extends \Yaf\Controller_Abstract 
{

    public function bookAction($bid = false) 
    {
        $rest = Restful::instance();

        $code = 200;
        $message = "ok";

        $head = array(
            'Content-type: application/epub+zip',
            "Content-disposition:attachment;filename=". time() .".epub",
            'Content-Transfer-Encoding: binary');

        $bookinfo = BookInfo::instance();

        $list = $bookinfo->field('download_path')->where("bid='$bid'")->fetchRow();

        if (!is_array($list) or empty($list['download_path']) )
        {
            $code = 201;
            $message = "download_path is NULL";
        }
        else
        {
            $path = FILES_PATH."/files/book/" . $list['download_path'];
            Download::download($path,$head);
        }

        
        $rest->assign('code',$code);
        $rest->assign('message',$message);
        $rest->response();
    }

}

?>