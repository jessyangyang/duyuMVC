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

class ImageControl extends \local\image\Images 
{
    public function __construct()
    {

        // file_exists($file) and $this->_file = $file;
    }

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

        $image = new \backend\dao\Images();

        $imageParam = array(
            'uid' => $uid,
            'class' => $class,
            'title' => $FILE['name'],
            'filename' => $FILE['name'],
            'type' => $FILE['type'],
            'size' => $FILE['size'],
            'path' => $image->escapeString($this->_file),
            'thumb' => 0,
            'published' => time()
            );

        $image->insert($imageParam);
        return $image->insertId() ? $image->insertId() : 0;

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
        $imagePath = \Yaf\Application::app()->getConfig()->toArray();
        $pathOne = gmdate("Ym");
        $pathTwo = gmdate('j');

        $common =  \Yaf\Registry::get('common');

        if (!$id) return false;
        $fileName = $id ."_".$common->random(4).urldecode($file);
        
        if ($mkdir) {
            $newFilePath = FILES_PATH . '/files' . $imagePath['path'][$path].$pathOne;

            if (!is_dir($newFilePath)) {
                if (!mkdir($newFilePath,0755)) {
                    return $fileName;
                }
            }

            $newFilePath .= "/".$pathTwo;
            if (!is_dir($newFilePath)) {
                if (!mkdir($newFilePath)) {
                    return $pathOne . "/" . $fileName;
                }
            }

        }

        return $imagePath['path'][$path].$pathOne."/".$pathTwo."/".$fileName;
    }

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

    public static function getRelativeImage($path)
    {
        $imagePath = \Yaf\Application::app()->getConfig()->toArray();
        return $imagePath['server']['imagesBook'].$path;
    }
}