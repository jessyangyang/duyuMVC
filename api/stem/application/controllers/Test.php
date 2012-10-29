<?php
/**
 * Test Controllers
 *
 * @package     DuyuMvc
 * @author      Jess
 * @version     1.0
 * @license     http://wiki.duyu.com/duyuMvc
 */

class testController extends \Yaf\Controller_Abstract 
{

    public function indexAction() 
    {
        echo "index";
        exit();
    }

    public function testAction($id)
    {
        echo "test:$id";
        exit();
    }

    public function regAction($id = false)
    {
        $display = $this->getView();
        $user = new \duyuu\dao\Members($id);
        $message = "invild!";
        if ($_POST) {
            if($user->where("email='".$_POST['email']."'")->fetchRow()) 
            {
                $message = "already register!!";

            }
            else {

                $arr = array(
                    'email' => $_POST['email'],
                    'username' => $_POST['username'],
                    'password' => md5(trim($_POST['password'])));
                if($user->insert($arr)) $message = "sussceful!!";
            }
        }

        $display->assign("title", "Hello Wrold");
        $display->assign("message", $message);
    }

    public function addAction()
    {
        $display = $this->getView();

        $client = new \duyuu\dao\OAuthClient();

        if ($_POST) {
            $title = $_POST['title'];
            $summary = $_POST['summary'];

        }

        $display->assign();
    }
}

?>