<?php
/**
* Comments DAO 
*
* @package     DuyuMvc
* @author      Jess
* @version     1.0
* @license     http://wiki.duyu.com/duyuMvc
*/

namespace duyuu\dao;

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
            'comment' => 'parent')
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
        $list["list"]   = $comment->field('id,post_id,uid,u.username,u.email,content,published')->joinQuery('members as u',"$table.uid = u.id")->where("post_id = '$key' AND type = 1")->limit("$offset,$limit")->fetchList();

        if (is_array($list["list"])) {
            return $list;
        }
        else
        {
            return "";
        }
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
        $user = Members::getCurrentUser();

        if ($request and $user) {
            $data = array(
                'post_id' => $request->getPost('post_id'),
                'type' => $request->getPost('type'),
                'uid' => $user->id,
                'title' => $request->getPost('title'),
                'content' => $request->getPost('content'),
                'ip' => $request->getPost('ip'),
                'published' => START_TIME,
                'parent' => getPost('parent'));

        }
        if ($comment->insert($data)) {
            return true;
        }

        return false;
    }

    public function deleteComment()
    {

    }

    public function getCommentListForUser()
    {
        
    }
}