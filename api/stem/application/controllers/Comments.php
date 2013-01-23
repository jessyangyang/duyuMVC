<?php
/**
 * Comments Controllers
 *
 * @package     DuyuMvc
 * @author      Jess
 * @version     1.0
 * @license     http://wiki.duyu.com/duyuMvc
 */

use \duyuu\dao\Comments;
use \duyuu\rest\Restful;

class CommentsController extends \Yaf\Controller_Abstract 
{

    public function indexAction() 
    {
        echo "hello";
        exit();
    }

    public function bookCommentListAction($bid, $limit = 10, $page = 1)
    {
        $rest = Restful::instance();
        $comments = Comments::instance();

        $code = 200;
        $message = "ok";

        $list = $comments->getCommentList(intval($bid),$limit,$page);

        $rest->assign('code',$code);
        $rest->assign('message',$message);
        if ($list) {
            $rest->assign('pages',$pages);
            $rest->assign('commentList',$list['list']);
        }
        else
        {
            $rest->assign('pages',0);
            $rest->assign('commentList',"");
        }

        $rest->response();
    }

    public function bookCommentListForUserAction($uid, $limit = 10, $page = 1)
    {

    }
}

?>