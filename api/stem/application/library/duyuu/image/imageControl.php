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

namespace \duyuu\image;

class imageControl extends \local\image\images 
{
    public function __construct($file)
    {

        file_exists($file) and $this->_file = $file;
    }

    public function save()
    {
        
    }
}