<?php
/**
*
* ImageControl
*
* @package     DuyuMvc
* @author      Jess
* @version     1.0
* @license     http://wiki.duyu.com/duyuMvc
*/

namespace backend\image;

use \backend\dao\Images;
use \local\models\BookImage;

class ImageControl extends \local\image\Images 
{

    // Images Instance
    private $images;
    // BookImage Instance
    private $bookimage;
    // File Name
    private $fileName;

    // lastest insertId for database server
    public $insertId;

    // Files Size : KB
    protected $allowFileSize = 2000;

    // Files Directory
    protected $path = array();

    // Server Files
    protected $siteUrl;

    /**
     * Class construct
     * @return void
     */
    function __construct()
    {

        // file_exists($file) and $this->_file = $file;
        $this->images = images::instance();
        $this->bookimage = BookImage::instance();

        $sitePath = \Yaf\Application::app()->getConfig()->toArray();

        $this->siteUrl = $sitePath['server']['imagesBook'];
        $this->path = $sitePath['path'];
    }

    /**
     * Get BookImage Row
     *
     * @param Array , $option
     * @return Array
     */
    public function getBookImageRow($option = array())
    {
        if (!is_array($option) or !$option) return false;

        $sql = '';
        foreach ($option as $key => $value) {
            if(end($option) == $value) $sql .= "$key='" . $value . "'";
            else $sql .= "$key='" . $value . "' AND ";
        }

        return $this->bookimage->where($sql)->fetchRow();
    }

    /**
     * Add BookImage Table
     *
     * @param Int ,$insertId , if $insertId = 0, then $insertId = lastest mysql insertid
     * @param Int ,$bid
     * @param Int ,$type
     *
     * @return Boolean or Int
     */
    public function addBookImage($insertId,$bid,$type = 1,$name = false)
    {
        if (!$insertId or !$bid) return 0;

        $fields = array(
            'bid'  => $bid,
            'pid'  => $insertId,
            'type' => $type
        );

        $name and $fields['name'] = $name;
        $this->bookimage->insert($fields);

        return $this->bookimage->insertId() ? $this->bookimage->insertId() : 0;
    }

    /**
     * Update BookImage Table
     *
     * @param Int ,pramary key
     * @param Array , $fields
     * @return Boolean
     */
    public function updateBookImage($id,$fields = array())
    {
        if(!is_array($fields) or isset($fields['id'])) return false;

        return $this->bookimage->where("id='$id'")->update($fields);
    }

    /**
     * Delete BookImage Row For pid
     *
     * @param Int ,$pid
     * @return Boolean
     */
    public function deleteBookImageForPid($pid)
    {
        if(!$pid) return false;
        return $this->bookimage->where("pid='$pid'")->delete();
    }

    /**
     * Get Images Row
     *
     * @param Array , $option
     * @return Array
     */
    public function getImagesRow($option = array())
    {
        if (!is_array($option) or !$option) return false;

        $sql = '';
        foreach ($option as $key => $value) {
            if(end($option) == $value) $sql .= " $key='" . $value . "' ";
            else $sql .= " $key='" . $value . "' AND ";
        }

        return $this->images->where($sql)->fetchRow();
    }

    public function addImages()
    {

    }

    /**
     * Delete Images Row For pid
     *
     * @param Int ,$pid
     * @return Boolean
     */
    public function deleteImagesForPid($pid)
    {
        if(!$pid) return false;
        $item = $this->getImagesRow(array('pid'=> $pid));
        $is_delete = $this->images->where("pid='$pid'")->delete();
        if($is_delete) $this->unlink($item['path']);
        return $is_delete;
    }

    /**
     * Get Image for BookID
     *
     * @param String ,
     * @return Array
     */
    public function getImagesForBookid($bid)
    {
        if(!$bid) return false;

        $table = $this->bookimage->table;
        return $this->bookimage->field("$table.pid,i.uid,i.title,i.filename,i.type,i.path,i.published")->joinQuery("images as i","$table.pid=i.pid")->where("$table.bid='$bid'")->limit(1)->fetchList();
    }

    /**
     * Save image to folder and Update Images table.
     *
     * @param 
     */
    public function save($FILE, $uid, $class = 1, $path = "image", $thumb = false)
    {
        if (!$uid)  return false;

        $FILE['size'] = $FILE['size'] ? $FILE['size'] : "";

        // Checkout File
        if ($FILE['size'] || $tmpName || !empty($FILE['error'])) {
            # code...
        }

        $fileExt = $this->getImageType($FILE['name']);
        // Allow Type
        if (!$this->hasImageType($fileExt)) {
            # code...
        }

        // Get file path
        if (!$this->_file = $this->getFilePath($FILE['name'],$uid,true, $path)) {
            # code...
        }
        
        // Save to server 
        if ($this->upload($FILE['tmp_name'])) {
            # code...
        }

        // Make a Thumb
        if ($thumb) {
            # code...
        }

        $imageParam = array(
            'uid' => $uid,
            'class' => $class,
            'title' => basename($FILE['name']),
            'filename' => $this->fileName,
            'type' => $FILE['type'],
            'size' => $FILE['size'],
            'path' => $this->images->escapeString($this->_file),
            'thumb' => 0,
            'published' => time()
            );

        $this->images->insert($imageParam);
        $this->insertId = $this->images->insertId();
        return $this->insertId ? $this->insertId : 0;

    }

    /**
     *  Remove Image Files
     *
     *  @param String ,$path
     *  @return Boolean
     */
    public function unlink($path)
    {
        $filepath = FILES_PATH . '/files' . $path;
        if(is_dir($filepath)) return unlink($filepath);
        return false;
    }

    /**
     * [Get file path ]
     * @param  [type]  $fileType [description]
     * @param  boolean $mkdir    [description]
     * @param  string  $type     [$type = {'head','image','book'}
     * @return [type]            [description]
     */
    public function getFilePath($file, $id, $mkdir = false, $path = "image")
    {
        $pathOne = gmdate("Ym");
        $pathTwo = gmdate('j');

        $common =  \Yaf\Registry::get('common');

        if (!$id) return false;
        $fileInfo = pathinfo($file);
        $this->fileName = $id ."_".$common->random(4) . "_" . time() .'.'.$fileInfo['extension'];
        
        if ($mkdir) {
            $newFilePath = FILES_PATH . '/files' . $this->path[$path].$pathOne;

            if (!is_dir($newFilePath)) {
                if (!mkdir($newFilePath,0755)) {
                    return $this->fileName;
                }
            }

            $newFilePath .= "/".$pathTwo;
            if (!is_dir($newFilePath)) {
                if (!mkdir($newFilePath)) {
                    return $pathOne . "/" . $this->fileName;
                }
            }

        }

        return $this->path[$path].$pathOne."/".$pathTwo."/".$this->fileName;
    }

    /**
     * Move file
     *
     * @param String $tmpName
     * @return Boolean 
     */
    public function upload($tmpName)
    {
        if ($this->_file) {
            if (copy($tmpName,FILES_PATH . '/files' . $this->_file)) {
                unlink($tmpName);
            }
            elseif (function_exists('move_uploaded_file') and move_uploaded_file($tmpName, FILES_PATH . '/files' . $this->_file)) {
                # code...
            }
            elseif (rename($tmpName, FILES_PATH . '/files' . $this->_file)) {
                # code...
            }
            else {
                return false;
            }
            return true;
        }
    }

    /**
     * Get store path
     *
     * @param String , $path
     * @return String , the store path.
     */
    public static function getRelativeImage($path)
    {
        $imagePath = \Yaf\Application::app()->getConfig()->toArray();
        return $imagePath['server']['imagesBook'].$path;
    }
}