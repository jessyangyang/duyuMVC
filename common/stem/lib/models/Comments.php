<?php
/**
* Comments DAO 
*
* @package     DuyuMvc
* @author      Jess
* @version     1.0
* @license     http://wiki.duyu.com/duyuMvc
*/

namespace lib\models;

use lib\models\MemberStateTemp;
use lib\dao\ImageControl;

class Comments extends \local\db\ORM 
{
    public $table = 'comments';

    public $fields = array(
        'id' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'id'),
        'post_id' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'post_id'),
        'type' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'type'),
        'uid' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'uid'),
        'title' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'title'),
        'content' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'content'),
        'ip' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'ip'),
        'published' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'published'),
        'parent' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'parent'),
        'stick' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'stick')
    );

    public $primaryKey = "id";

    protected static $instance;

    /**
     * Instance self
     * 
     * @param String $key ,primary_key
     * @return Images Object
     */
    public static function instance($key = false)
    {
        return self::$instance ? self::$instance : new Comments($key);
    }

    /**
     * Return the comment list
     *
     * @param Integer $key , post id
     * @param Integer $limit , 
     * @param Integer $page
     * @return Array 
     */
    public function getCommentList($key,$limit = 10,$page = 1)
    {
        $comment = self::instance();
        $table = $this->table;

        $count = $comment->field("count(*) as count")->where("type = 1 AND post_id='$key'")->fetchList();

        $count = $count ? $count[0]['count'] : 0;
        $offset = 0;

        $pages = $count/$limit;
        $pages = $pages < 1 ? 1 : $pages;
        $pages = is_float($pages) ? intval($pages)+1 : $pages;

        $page = $page < 1 ? 1 : $page;
        $page = $page > $pages ? $pages : $page;

        $offset = $limit * ($page - 1);

        $list['count']  = $count;
        $list['page']   = $page;
        $list['pages']  = $pages;
        $list["list"]   = $comment->field("$table.id,post_id as bid,$table.uid,u.username,u.email,$table.content,$table.published,$table.parent,i.path as avatar")->joinQuery('members as u',"$table.uid = u.id")->joinQuery('images as i',"i.uid = $table.uid")->where("$table.post_id = '$key' AND $table.type = 1 AND i.class = 2")->order("$table.published DESC")->limit("$offset,$limit")->fetchList();

        if ($list['list']) {
            foreach ($list["list"] as $key => $value) {
                $list['list'][$key]['avatar'] = ImageControl::getRelativeImage($value['avatar']);
            }
            return $list;
        }
        else return array();

    }

    /**
     * Add Comment
     *
     * @param Array 
     * @return Boolean , if insert complete,return true
     */
    public function addComment($request)
    {
        $comment = self::instance();
        // $user = Members::getCurrentUser();
        $userState = MemberStateTemp::getCurrentUserForAuth();
        
        if ($request and $userState) {
            $common =  \Yaf\Registry::get('common');

            $data = array(
                'post_id' => $request->getPost('bid'),
                'type' => $request->getPost('type'),
                'uid' => $userState['uid'],
                'title' => $request->getPost('title'),
                'content' => $request->getPost('content'),
                'ip' => $common->ip(),
                'published' => $request->getPost('published'),
                'parent' => $request->getPost('parent'));

            if ($comment->insert($data)) return true;

        }
        
        return false;
    }

    /**
     * Delete Comment 
     *
     * @param String or Integer ,primary key
     * @return Boolean , if deleted,return true.
     */
    public function deleteComment($key)
    {
        $comment = self::instance();
        $user = Members::getCurrentUser();

        if ($user) {
            if($comment->where("id= '$key'")->delete()) return true;
        }

        return false;
    }

    /**
     * Get Comment list For UserID
     *
     * @param Integer ,$uid,the userid.
     * @param Integer ,$limit,limit.
     * @param Integer ,$page ,the number of page.
     * @return Array , the commit list 
     */
    public function getCommentListForUser($uid,$limit = 10,$page = 1)
    {
        $comment = self::instance();
        $table = $this->table;

        $count = $comment->field("count(*) as count")->where("type = 1 AND post_id='$key'")->fetchList();

        $count = $count ? $count[0]['count'] : 0;
        $offset = 0;

        $pages = $count/$limit;
        $pages = $pages < 1 ? 1 : $pages;
        $pages = is_float($pages) ? intval($pages)+1 : $pages;

        $page = $page < 1 ? 1 : $page;
        $page = $page > $pages ? $pages : $page;

        $offset = $limit * ($page - 1);

        $list['count']  = $count;
        $list['page']   = $page;
        $list['pages']  = $pages;
        $list["list"]   = $comment->field('comments.id,post_id as bid,uid,u.username,u.email,content,comments.published,comments.parent')->joinQuery('members as u',"$table.uid = u.id")->where("u.id = '$uid' AND type = 1")->limit("$offset,$limit")->fetchList();

        if (is_array($list["list"])) {
            return $list;
        }
        else
        {
            return array();
        }
    }
}