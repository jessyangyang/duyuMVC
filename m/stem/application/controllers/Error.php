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


class ErrorController extends \Yaf\Controller_Abstract 
{

    public function errorAction()
    {
        header("Location:/index");
        exit();
    }
}