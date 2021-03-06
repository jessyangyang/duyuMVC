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
use \duyuu\dao\Members;
use \duyuu\dao\MemberStateTemp;
use \local\rest\Restful;

class CommentsController extends \Yaf\Controller_Abstract 
{

    public function indexAction() 
    {
        echo "hello";
        exit();
    }

    /**
     *  Add Comment
     */
    public function addCommentAction()
    {
        $rest = Restful::instance();
        $comment = Comments::instance();
        $userState = MemberStateTemp::getCurrentUserForAuth();

        $code = 200;
        $message = "ok";

        if (!$userState) {
            $code = 402;
            $message = "No Login.";
        }
        else
        {

            $data = $this->getRequest();
            if($data->isPost() and $comment->addComment($data)) {
                $message = "inserted complete.";
            }
            else
            {
                $message = "fault.";
                $code = 201;
            }
        }

        $rest->assign('code',$code);
        $rest->assign('message',$message);
        $rest->response();
    }

    /**
     *  Delete Comment
     */
    public function deleteCommentAction($bid)
    {
        $rest = Restful::instance();
        $comment = Comments::instance();

        $code = 200;
        $message = "ok";

        if($comment->deleteComment($bid)) 
        {
            $message = "delete complete.";
        }
        else
        {
            $message = "fault.";
            $code = 201;
        }

        $rest->assign('code',$code);
        $rest->assign('message',$message);
        $rest->response();
    }

    /**
     *  The bookList of the comment
     */
    public function bookCommentListAction($bid, $limit = 10, $page = 1)
    {
        $rest = Restful::instance();
        $comments = Comments::instance();

        $code = 200;
        $message = "ok";

        $list = $comments->getCommentList($bid,$limit,$page);

        if ($list) {
            $rest->assign('code',$code);
            $rest->assign('message',$message);
            $rest->assign('pages',$list['pages']);
            $rest->assign('commentList',$list['list']);
        }
        else
        {
            $code = 201;
            $message = "No Data";
            $rest->assign('pages',0);
            $rest->assign('commentList',array());
        }
        
        $rest->response();
    }

    /**
     *  The list of comment for the user.
     */
    public function bookCommentListForUserAction($limit = 10, $page = 1)
    {
        $rest = Restful::instance();
        $comments = Comments::instance();

        $code = 200;
        $message = "ok";

        $userState = MemberStateTemp::getCurrentUserForAuth();

        $list = array();

        if (!$userState) {
            $code = 402;
            $message = "No Login.";
        }
        else {
            $list = $comments->getCommentListForUser($userState['uid'],$limit,$page);
        }

        if ($list) {
            $rest->assign('pages',$list['pages']);
            $rest->assign('commentList',$list['list']);
        }
        else
        {
            $rest->assign('pages',0);
            $rest->assign('commentList',array());
        }

        $rest->assign('code',$code);
        $rest->assign('message',$message);
        $rest->response();
    }
}

?>