<?php
/**
* MenusControl  Class 
*
* @package     DuyuMvc
* @author      Jess
* @version     1.0
* @license     http://wiki.duyu.com/duyuMvc
*/

namespace lib\dao;

use \lib\models\Menus;
use \lib\models\MenusCategory;

class MenusControl 
{
    private $menus;
    private $menusCategory;

    /**
     * Instance construct
     */
    function __construct($mid = false) {
        $this->menus = Menus::instance($mid);
        $this->menusCategory = MenusCategory::instance();
    }

    /**
    * Class destructor
    *
    * @return void
    * @TODO make sure elements in the destructor match the current class elements
    */
    function __destruct() {
        $this->menus = NULL;
        $this->menusCategory = NULL;
    }

    /**
     * Get Menus
     *
     * @param String ,$mid
     * @return Array.
     */
    public function getMenus($mid = false)
    {
        if($mid)
        {
            return $this->menus->where("mid='$mid'")->fetchRow();
        }
        else
        {
            return $this->menus->fetchList();
        }
        return false;
    }


    /**
     * Get Category
     *
     * @param String ,$pcid ,if mcid is false,return category in the all.
     * @return Array
     */
    public function getCategory($mcid = false)
    {
        if($mcid)
        {
            return $this->menusCategory->where("mcid='$mcid'")->fetchRow();
        }
        else
        {
            return $this->menusCategory->fetchList();
        }
        return false;
    }


     /**
     * Add Category
     *
     * @param Array , $fields
     * @return Boolean
     */
    public function addCategory($fields = array())
    {
        if (!is_array($fields) or !$fields) return false;
        return $this->menusCategory->insert($fields);
    }

    /**
     * Add Menus
     *
     * @param Array , $fields
     * @return Boolean
     */
    public function addMenus($fields = array())
    {
        if (!is_array($fields) or !$fields) return false;
        return $this->menus->insert($fields);
    }

    /**
     * Update Menus
     *
     * @param String , $mid
     * @param Array , $fields
     * @return Boolean
     */
    public function updateMenus($mid,$fields = array())
    {
        if(!is_array($fields) or isset($fields['mid'])) return false;
        return $this->menus->where("mid='$mid'")->update($fields);
    }

    /**
     * Update Category
     *
     * @param String , $mcid
     * @param Array , $fields
     * @return Boolean
     */
    public function updateCategory($mcid,$fields = array())
    {
        if(!is_array($fields) or isset($fields['mcid'])) return false;
        return $this->menusCategory->where("mcid='$mcid'")->update($fields);
    }

    /**
     * delete Product
     *
     * @param String , $pid
     * @return Boolean
     */
    public function deleteProductForMid($pid)
    {
        if(!$bid) return false;
        return $this->menus->where("mid='$mid'")->delete();
    }

    /**
     * delete Category
     *
     * @param String , $pid
     * @return Boolean
     */
    public function deleteCategoryForMcid($pcid)
    {
        if(!$bid) return false;
        return $this->menusCategory->where("mcid='$mcid'")->delete();
    }
}