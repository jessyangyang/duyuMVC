<?php
/**
 * Exception
 *
 * @package     DuyuMvc
 * @author      Jess
 * @version     1.0
 * @license     http://wiki.duyu.com/duyuMvc
 * 
 */
namespace local\files;

class Files extends \Filesystem
{
    /**
     * Make New DIR
     *
     * Only add new dir  in files menu.
     *
     * Example: "/home/wwwroot/duyuMVC/files" after add new dir.
     *
     * @param $path String 
     * @param $mode Int
     *
     * @return Boolean
     */
    static public function makeNewDir($path,$mode = 0755)
    {
        $pathTmp = explode('/',$path);
        $newDir = "";
        $is_dir = false;
        foreach ($pathTmp as $key => $value) {
            $newDir .= '/' . $value;
            if (!is_dir($newDir)) {
                $is_dir = mkdir($newDir,$mode);
            }
        }
        return $is_dir;
    }
}