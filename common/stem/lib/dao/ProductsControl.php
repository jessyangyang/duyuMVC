<?php
/**
* ProductsControl  Class 
*
* @package     DuyuMvc
* @author      Jess
* @version     1.0
* @license     http://wiki.duyu.com/duyuMvc
*/

namespace lib\dao;

use \lib\models\Products;
use \lib\models\ProductCategory;
use \lib\models\ProductPurchased;

class ProductsControl
{
    private $products;
    private $productCategory;
    private $productPurchased;

    /**
     * Instance construct
     */
    function __construct($pid = false) {
        $this->products = Products::instance($pid);
        $this->productCategory = ProductCategory::instance();
        $this->productPurchased = ProductPurchased::instance();
    }

    /**
    * Class destructor
    *
    * @return void
    * @TODO make sure elements in the destructor match the current class elements
    */
    function __destruct() {
        $this->products = NULL;
        $this->productCategory = NULL;
        $this->productPurchased = NULL;
    }


    /////////////////////////////
    // Products from subobject //
    /////////////////////////////


    public function getPurchasedForBooks($option = array(),$limit = 10, $page = 1)
    {
        if (!is_array($option) or !$option) return false;

        $sql = '';
        $i = 1;
        $table = $this->productPurchased->table;

        $option = array_merge_recursive($option , array('bi.type'=>'1'));

        $count = count($option);
        foreach ($option as $key => $value) {
            if($i == $count) $sql .= "$key='" . $value . "'";
            else $sql .= "$key='" . $value . "' AND ";
            $i ++;
        }


        $offset = $page == 1 ? 0 : ($page - 1)*$limit; 

        $list = $this->productPurchased->field("$table.pid,$table.status,$table.published,$table.uid,b.bid,b.title,b.author,i.path as cover")
        	->joinQuery("products as p","$table.pid=p.pid")
        	->joinQuery("books as b","p.oldid=b.bid")
        	->joinQuery('book_image as bi',"b.bid=bi.bid")
        	->joinQuery('images as i','i.pid=bi.pid')
        	->where($sql)->order("$table.published")
        	->limit($offset,$limit)->fetchList();

    	if (is_array($list)) {
            foreach ($list as $key => $value) {
                if (isset($value['cover']) and $value['cover']) {
                    $list[$key]['cover'] = \duyuu\image\ImageControl::getRelativeImage($value['cover']);
                }
            }

            $this->productPurchased->joinTables = array();
            return $list;
        }

        return false;
    }

    //////////////
    // Products //
    //////////////

    /**
     * Get Products List
     *
     * @param Array , $option
     * @param Int , $limit
     * @param Int , $page
     * @return Array 
     */
    public function getProductsList($option = array(),$limit = 10,$page = 1)
    {
        if (!is_array($option) or !$option) return false;

        $sql = '';
        $i = 1;
        $count = count($option);
        foreach ($option as $key => $value) {
            if($i == $count) $sql .= "$key='" . $value . "'";
            else $sql .= "$key='" . $value . "' AND ";
            $i ++;
        }

        $offset = $page == 1 ? 0 : ($page - 1)*$limit; 
        $table = $this->products->table;

        $list = $this->products->field("$table.pid,$table.type,$table.name,$table.price,$table.oldid,$table.product_id,$table.published,$table.summary,$table.costprice,$table.image_id,pc.name,pc.uid")->joinQuery("product_category as pc","$table.type=pc.pcid")->where($sql)->order("$table.published")->limit($offset,$limit)->fetchList();

        if ($list) return $list;

        return false;
    }

    /**
     * Get Category
     *
     * @param String ,$pcid ,if pcid is false,return category in the all.
     * @return Array
     */
    public function getCategory($pcid = false)
    {
        if($pcid)
        {
            return $this->productCategory->where("pcid='$pcid'")->fetchRow();
        }
        else
        {
            return $this->productCategory->fetchList();
        }
        return false;
    }

    /**
     * Get Purchased For Pid
     *
     * @param String ,$pid
     * @return Array
     */
    public function getPurchasedForRow($pid,$uid = false)
    {
        $pid and $sql .= " pid='$pid' ";
        $uid and $sql .= " AND uid='$uid'";

        $table = $this->products->table;

        $list = $this->products->field("$table.pid,$table.type,$table.name,$table.price,$table.oldid,$table.product_id,$table.published,$table.summary,$table.costprice,$table.image_id,pc.name,pc.uid")->joinQuery("product_category as pc","$table.type=pc.pcid")->joinQuery("product_purchased as pp","$table.pid=pp.pid")->where($sql)->order("$table.published")->limit(1)->fetchList();

        if($list) return $list[0];

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
        return $this->productCategory->insert($fields);
    }

    /**
     * Add Purchased
     *
     * @param Array , $fields
     * @return Boolean
     */
    public function addPurchased($fields = array())
    {
        if (!is_array($fields) or !$fields) return false;
        return $this->productPurchased->insert($fields);
    }

    /**
     * Add Product
     *
     * @param Array , $fields
     * @return Boolean
     */
    public function addProduct($fields = array())
    {
        if (!is_array($fields) or !$fields) return false;
        return $this->products->insert($fields);
    }

    /**
     * Update Product
     *
     * @param String , $Pid
     * @param Array , $fields
     * @return Boolean
     */
    public function updateProduct($pid,$fields = array())
    {
        if(!is_array($fields) or isset($fields['pid'])) return false;
        return $this->products->where("pid='$pid'")->update($fields);
    }

    /**
     * Update Category
     *
     * @param String , $Pcid
     * @param Array , $fields
     * @return Boolean
     */
    public function updateCategory($pcid,$fields = array())
    {
        if(!is_array($fields) or isset($fields['pcid'])) return false;
        return $this->productCategory->where("pcid='$pcid'")->update($fields);
    }

    /**
     * Update Purchased
     *
     * @param String , $pid
     * @param Array , $fields
     * @return Boolean
     */
    public function updatePurchased($pid,$fields = array())
    {
        if(!is_array($fields) or isset($fields['pid'])) return false;
        return $this->productPurchased->where("pid='$pid'")->update($fields);
    }

    /**
     * delete Product
     *
     * @param String , $pid
     * @return Boolean
     */
    public function deleteProductForPid($pid)
    {
        if(!$bid) return false;
        return $this->products->where("pid='$pid'")->delete();
    }

    /**
     * delete Category
     *
     * @param String , $pid
     * @return Boolean
     */
    public function deleteCategoryForPcid($pcid)
    {
        if(!$bid) return false;
        return $this->productCategory->where("pcid='$pcid'")->delete();
    }

    /**
     * delete Purchased
     *
     * @param String , $pid
     * @return Boolean
     */
    public function deletePurchasedForPid($pid)
    {
        if(!$bid) return false;
        return $this->productPurchased->where("pid='$pid'")->delete();
    }

}