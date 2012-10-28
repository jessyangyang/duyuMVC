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
        echo "hello";
        exit();
    }

    public function testAction($id)
    {
        echo "test:$id";
        exit();
    }

    public function regAction($id)
    {
        $display = $this->getView();
        $user = new \duyuu\dao\Members();
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

}

?>