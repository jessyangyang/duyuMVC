<?php
/**
 * Image
 *
 * 
 *
 * @package     DuyuMvc
 * @author      Jess
 * @version     1.0
 * @license     http://wiki.duyu.com/duyuMvc
 **/

namespace local\image;

abstract class Images {

    // The file URL or File PATH
    public $_file;

    // The Image Width 
    public $_width;

    // The Image Height
    public $_height;

    public function thumb()
    {

    }

    public function writeFile()
    {

    }

    public function waterMake()
    {

    }

    public function getSize()
    {
        return getimagesize($this->_file);
    }

    public function getX()
    {
        return imagesx($this->_file);
    }

    public function getY()
    {
        return imagesy($this->_file);
    }

    public function setWidth($size)
    {
        $this->_width = $size;
    }

    public function setHeight($size)
    {
        $this->_height = $size;
    }

    /**
     * [getFilePath description]
     * @return String [description]
     */
    // public function getFilePath()
    // {
    //     return strtolower(substr($this->_file,0,strripos($this->_file, ".")));
    // }

    public function getImageType()
    {
        return strtolower(trim(substr(strrchr($this->_file, '.'), 1)));
    }

    public function hasImageType($type)
    {
        $extensions = array(
            1  => 'gif',
            2  => 'jpeg',
            3  => 'png',
            4  => 'swf',
            5  => 'psd',
            6  => 'bmp',
            7  => 'tiff',
            8  => 'tiff',
            9  => 'jpc',
            10 => 'jp2',
            11 => 'jpf',
            12 => 'jb2',
            13 => 'swc',
            14 => 'aiff',
            15 => 'wbmp',
            16 => 'xbm'
        );
        return in_array($type, $extensions);
    }

}