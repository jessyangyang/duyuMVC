<?php
/**
* RolesControl  Class 
*
* @package     DuyuMvc
* @author      Jess
* @version     1.0
* @license     http://wiki.duyu.com/duyuMvc
*/

namespace lib\dao;

use \lib\models\Members;
use \lib\models\users\Roles;
use \lib\models\users\RoleCategory;

class RolesControl
{
    const VERSION = 1.0;

    // Role Type
    const ROLE_TYPE_NORMAL = 0;
    const ROLE_TYPE_CUSTOM = 1;
    const ROLE_TYPE_ALL = 2;

    // MEMBERS ROLES
    const MEMBER_SUPER_ADMIN = 1;
    const MEMBER_ADMIN = 2;
    const MEMBER_DEVELOPER = 3;

    const MEMBER_NORMAL_USER = 500;

    // ROLES OBJECTS
    private $roles;
    private $roleCategory;

    // NORMAL ROLES
    private $role_api_normal;
    private $role_moblie_normal;
    private $role_admin_normal;
    private $role_webshop_normal;
    private $role_writer_normal;

    /**
     * Instance construct
     */
    function __construct() {
        $this->roles = Roles::instance();
        $this->rolecategory = RoleCategory::instance();

        $this->role_api_normal = array(
            'type' => ROLE_TYPE_NORMAL,
            'roles' = array(
                'apiUserLogin',
                'apiUserRegister',
                'apiUserLogout',
                'apiUserProfile',
                'apiUserPurchased',
                'apiUserBuyList',
                'apiUserOtherBuyList',
                'apiUserDeleteBook',
                'apiStoreIndexRecommend',
                'apiStoreTopList',
                'apiStoreMenuList',
                'apiStoreCategory',
                'apiStoreSubCategory',
                'apiStoreBookInfo',
                'apiStoreBookMenu',
                'apiStoreBookChapter',
                'apiStoreDownLoadBook',
                'apiStoreAddComment',
                'apiStoreDeleteComment',
                'apiStoreBookCommentList',
                'apiStoreBookCommentListForUser',
                'apiPaymentForApple',
                'apiPaymentForAlipayTo',
                'apiPaymentForAlipayNotify',
                'apiPaymentForAlipayCallback',
                'apiWechatIndex',
                'apiWechatToken')
            );

            $this->role_moblie_normal = array(
                'type' => ROLE_TYPE_NORMAL,
                'roles' => array(
                    'mFilesUpload',
                    'mFilesLoad',
                    'mFilesSend',
                    'mIndex',
                    'mBook',
                    'mUser',
                    'mPayment',
                    'mPaymentHandle',
                    'mDownload',
                    'mTestIndex',
                    'mTestRoles')
                );

            $this->role_admin_normal = array(
                'type' => ROLE_TYPE_ALL,
                'roles' => array());

            $this->role_writer_normal = array(
                'type' => ROLE_TYPE_ALL,
                'roles' => array());
    }


    /**
    * Class destructor
    *
    * @return void
    * @TODO make sure elements in the destructor match the current class elements
    */
    function __destruct() {
        $this->roles = NULL;
        $this->roleCategory = NULL;
    }

    public function initRoles()
    {

    }

}