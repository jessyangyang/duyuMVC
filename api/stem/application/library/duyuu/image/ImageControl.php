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

namespace duyuu\image;

class ImageControl extends \local\image\Images 
{
    public function __construct()
    {

        // file_exists($file) and $this->_file = $file;
    }

    public function save($FILE, $class = 1, $thumb = false)
    {
        $user = \duyuu\dao\Members::getCurrentUser();

        if (!$user)  return false;

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
        if (!$this->_file = $this->getFilePath($FILE['name'],true)) {
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

        $image = new \duyuu\dao\Images();

        $imageParam = array(
            'uid' => $user->id,
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
    public function getFilePath($fileType,$mkdir = false)
    {
        $imagePath = \Yaf\Application::app()->getConfig()->toArray();
        $pathOne = gmdate("Ym");
        $pathTwo = gmdate('j');

        $common =  \Yaf\Registry::get('common');
        $user = \duyuu\dao\Members::getCurrentUser();

        if (!$user) return false;
        $filePath = $user->id."_".$common->random(4)."$fileType";
        
        if ($mkdir) {
            $newFilePath = $imagePath['path']['image'].$pathOne;
            if (!is_dir($newFilePath)) {
                if (!mkdir($newFilePath,0755)) {
                    return $filePath;
                }
            }

            $newFilePath .= "/".$pathTwo;
            if (!is_dir($newFilePath)) {
                if (!mkdir($newFilePath)) {
                    return $pathOne . "/" . $filePath;
                }
            }

        }
        return $imagePath['path']['image'].$pathOne."/".$pathTwo."/".$filePath;
    }

    public function upload($tmpName)
    {
        if ($this->_file) {
            if (copy($tmpName,$this->_file)) {
                unlink($tmpName);
            }
            elseif (function_exists('move_uploaded_file') and move_uploaded_file($tmpName, $this->_file)) {
                # code...
            }
            elseif (rename($tmpName, $this->_file)) {
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