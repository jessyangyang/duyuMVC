<?php
/**
* DownloadControl  Class 
*
* @package     DuyuMvc
* @author      Jess
* @version     1.0
* @license     http://wiki.duyu.com/duyuMvc
*/

namespace lib\dao;

use \lib\models\Members;
use \lib\models\BookMenu;
use \lib\models\Books;
use \lib\models\Downloads;
use \lib\dao\ImageControl;

class DownloadControl
{
    const VERSION = 1.0;

    private $downloads;

    /**
     * Instance construct
     */
    function __construct($id = false) {
        $this->downloads = Downloads::instance($id);
    }

    /**
    * Class destructor
    *
    * @return void
    * @TODO make sure elements in the destructor match the current class elements
    */
    function __destruct() {
        $this->downloads = NULL;
    }

    /**
     * [getDownloadForUserid description]
     *
     * $type:
     *      1 = api
     *      2 = m
     * $uid == 1 , free book;
     * 
     * @param  [type]  $uid  [description]
     * @param  integer $type [description]
     * @return [type]        [description]
     */
    public function getDownloadForUserid($uid,$limit = 10, $page = 1,$type = 1)
    {
        $table = $this->downloads->table;
        $sql = "($table.uid = '$uid' || $table.uid = '1') AND $table.type = '$type' AND bi.type = 1 AND i.class=1";

        $offset = $page == 1 ? 0 : ($page - 1)*$limit; 

        $list = $this->downloads->field("DISTINCT b.bid,$table.did,$table.published,$table.uid,$table.old_id,b.title,b.author,i.path as cover")
            ->joinQuery("books as b","$table.old_id=b.bid")
            ->joinQuery('book_image as bi',"b.bid=bi.bid")
            ->joinQuery('images as i','i.pid=bi.pid')
            ->where($sql)->order("$table.published")
            ->limit($offset,$limit)->fetchList();

        if (is_array($list)) {
            foreach ($list as $key => $value) {
                if (isset($value['cover']) and $value['cover']) {
                    $list[$key]['cover'] = ImageControl::getRelativeImage($value['cover']);
                }
            }

            $this->downloads->joinTables = array();
            return $list;
        }
        return false;
    }

}