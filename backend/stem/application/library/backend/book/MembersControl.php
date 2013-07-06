<?php
/**
* MembersControl  Class 
*
* @package     DuyuMvc
* @author      Jess
* @version     1.0
* @license     http://wiki.duyu.com/duyuMvc
*/

namespace backend\book;

use \backend\dao\Members;
use \backend\dao\MemberInfo;
use \backend\dao\OAuthAccessTokens;
use \backend\image\ImageControl;
use \Yaf\Session;

class MembersControl 
{
    const ROLE_SUPER_ADMIN = 1;
    const ROLE_ADMIN = 2;
    const ROLE_DEVELOPMENTER = 3;

    const ROLE_GENERAL_EDITOR = 101;

    const ROLE_AUTHOR = 120;
    const ROLE_PROOFREADER = 121;

    const ROLE_NORMAL = 500;

    const ROLE_ANONYMITY = 1001;
    const ROLE_LIMITED = 1002;

    const IMAGE_TYPE = 2;
    const IMAGE_PATH = 'head';

    private $members;
    private $memberInfo;
    private $oauthaccesstoken;
    private $images;
    private $session;

    /**
     * Instance construct
     */
    function __construct($uid = false) {
        $this->members = Members::instance($uid);
        $this->memberInfo = MemberInfo::instance();
        $this->oauthaccesstoken = OAuthAccessTokens::instance();
        $this->images = new ImageControl();
        $this->session = Session::getInstance();
    }

    /**
    * Class destructor
    *
    * @return void
    * @TODO make sure elements in the destructor match the current class elements
    */
    function __destruct() {
        $this->members = NULL;
        $this->memberInfo = NULL;
        $this->oauthaccesstoken = NULL;
    }

    /**
     * Register User 
     *
     * @param String , $email
     * @param String , $username
     * @param String , $password
     * @param String , $img , image url
     * @return Boolean
     */
    public function register($email,$username,$password,$imgUrl)
    {
        $email = addslashes($email);

        $arr = array(
            'email' => $email,
            'username' => addslashes($username),
            'password' => md5(trim($password)),
            'published' => time(),
            'role_id' => MembersControl::ROLE_NORMAL
        );
                
        if ($userId = $this->members->insert($arr)) {

            $avatarId = $this->images->saveImageFromUrl($imgUrl . ".jpeg", $userId, MembersControl::IMAGE_TYPE, MembersControl::IMAGE_PATH);

            $avatarId = $avatarId ? $avatarId : 0;

            $infoArr = array(
                'id' => $userId,
                'avatar_id' => $avatarId);

            if ($this->memberInfo->insert($infoArr)) {      
                $authToken = md5($userId.$email);
                $authArr = array(
                    'oauth_token' => $authToken,
                    'client_id' => $userId,
                    'user_id' => $userId,
                    'expires' => strtotime("next Monday"));
                $this->oauthaccesstoken->insert($authArr);

                $this->session->set('current_id',$userId);
                $this->session->set('authToken',$authToken);

                header("Auth-Token:".$authToken);
            }

            return true;
        }
        return false;
    }

    
}