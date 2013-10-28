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

use lib\dao\ImageControl;

class Comments extends \lib\models\Comments 
{
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

    public function getCommentsForStick($limit = 10,$page = 1)
    {
        $comment = self::instance();
        $table = $this->table;

        $count = $comment->field("count(*) as count")->where("type = 1 AND stick > 0")->fetchList();

        $count = $count ? $count[0]['count'] : 0;
        $offset = 0;

        $pages = $count/$limit;
        $pages = $pages < 1 ? 1 : $pages;
        $pages = is_float($pages) ? intval($pages)+1 : $pages;

        $page = $page < 1 ? 1 : $page;
        $page = $page > $pages ? $pages : $page;

        $offset = $limit * ($page - 1);

        $list   = $comment->field("$table.id,post_id as bid,$table.uid,u.username,u.email,$table.content,$table.published,$table.parent,i.path as avatar")
            ->joinQuery('members as u',"$table.uid = u.id")
            ->joinQuery('images as i',"i.uid = $table.uid")
            ->where("$table.type = 1 AND i.class = 2 AND $table.stick > 0")
            ->order("$table.published DESC")
            ->limit("$offset,$limit")->fetchList();

        if ($list) {
            foreach ($list as $key => $value) {
                $list[$key]['avatar'] = ImageControl::getRelativeImage($value['avatar']);
            }
            return $list;
        }
        else return array();
    }
}