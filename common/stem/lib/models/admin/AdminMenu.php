<?php
/**
* AdminMenu DAO 
*
* @package     DuyuMvc
* @author      Jess
* @version     1.0
* @license     http://wiki.duyu.com/duyuMvc
*/

namespace lib\models\admin;

class AdminMenu extends \local\db\ORM 
{
    public $table = 'admin_menu';

    public $fields = array(
        'amid' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'amid'),
        'title' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'title'),
        'sort' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'sort'),
        'parent_id' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'parent_id'),
        'type' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'type')
        );

    public $primaryKey = "amid";

    // Instance Self
    protected static $instance;


    public static function instance($key = 0)
    {
        return self::$instance ? self::$instance : new AdminMenu($key);
    }

    /**
     * [getCategorysToArray description]
     * @return [type] [description]
     */
    public function getMenusToArray()
    {
        $adminmenu = self::instance();
        $table = $this->table;

        $list = $adminmenu->fetchList();

        if (is_array($list))
        {
            $menus = array();
            foreach ($list as $key => $value) {

                if($value['parent_id'] == 0)
                {
                    $menus[$value['type']][$value['amid']] = $value;
                }
                else 
                {
                    $menus[$value['type']][$value['parent_id']]['sub'][$value['sort']] = $value;
                }
            }

            array_multisort($menus,SORT_ASC);

            return $menus;
        }

        return array();
    }
}