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
use \lib\dao\ImageControl;

class ProductsControl
{
	const PRODUCT_TYPE_RENT = 1;
	const PRODUCT_TYPE_SUBSCRIPTION = 2;
	
	const STATUS_DEPRECATED = -1;
	const STATUS_NOT_PAIED = 0;
	const STATUS_PAIED = 1;
	
	const PAY_METHOD_ALIPAY = 'alipay';
	const PAY_METHOD_APPLE = 'apple';
	
    public $products;
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
    
    //////////////////////
    // Instance Objects //
    //////////////////////
    
    /**
     * Get products Object
     * 
     * @return Object , return products model object
     * */
    public function getProducts()
    {
    	return $this->products;
    }
    
    /**
     * Get ProductPurchased Object
     * @return Object , return ProductPurchased Model Object
     * */
    public function getProductPurchased()
    {
    	return $this->productPurchased;
    }
    
    /**
     * Get ProductCategory Object
     * @return Object, return ProductCategory Model Object
     * */
    public function getProductCategory()
    {
    	return $this->productCategory;
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

        $list = $this->productPurchased->field("$table.pid,$table.status,$table.published,$table.uid,b.bid,b.title,b.author,i.path as cover,p.total_fee as price")
        	->joinQuery("products as p","$table.pid=p.pid")
        	->joinQuery("books as b","p.oldid=b.bid")
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

        $list = $this->products->field("$table.pid,$table.pcid,$table.order_num,$table.product_name,$table.total_fee,$table.oldid,$table.product_id,$table.created_time,$table.modified_time,$table.paied_time,$table.summary,$table.costprice,$table.image_id,pc.name")
            ->joinQuery("product_category as pc","$table.pcid=pc.pcid")
            ->where($sql)
            ->order("$table.created_time")
            ->limit($offset,$limit)->fetchList();

        if ($list) return $list;

        return false;
    }
    
    /**
     * Get Products For Row
     * 
     * @param Array , $option 
     * @return Array.
     * */
    public function getProductsRow($option = array())
    {
    	$row = $this->getProductsList($option, 1 , 1);
    	return $row ? $row[0] : false;
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
    public function getPurchasedForRow($option = array())
    {

        $list = $this->getPurchasedList($option,1,1);

        if($list) return $list[0];

        return false;
    }


    public function getPurchasedForUserID($uid = false, $limit = 50,$page = 1,$type = "list")
    {
        $option = array();
        $uid and $option['uid'] = $uid;
        $option['status'] = "1";
        $list = $this->getPurchasedList($option,$limit,$page);

        if($list and $type == "row") return $list[0];
        else return $list;

        return false;
    }

    /**
     * [getPurchasedList description]
     * @param  array   $option [description]
     * @param  integer $limit  [description]
     * @param  integer $page   [description]
     * @return [type]          [description]
     */
    public function getPurchasedList($option = array(),$limit = 10,$page = 1)
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
        $table = $this->productPurchased->table;

        $list = $this->productPurchased->field("$table.ppid,$table.pid,$table.trade_no,$table.out_trade_no,$table.uid,$table.old_id,$table.status,$table.published")
            ->where($sql)
            ->order("$table.published")
            ->limit($offset,$limit)->fetchList();

        if ($list) return $list;

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