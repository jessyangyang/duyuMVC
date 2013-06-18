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

class Files
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

    /**
     *  Get Dir
     *  @param String ,$path
     *  @return Array
     */
    static public function getDir($path) {
        $dirArray[]=NULL;
        if (false != ($handle = opendir ( $path ))) {
            $i=0;
            while ( false !== ($file = readdir ( $handle )) ) {
                //去掉"“.”、“..”以及带“.xxx”后缀的文件
                if ($file != "." and  $file != ".." and !strpos($file,".")) {
                    $dirArray[$i]=$file;
                    $i++;
                }
            }
            //关闭句柄
            closedir ( $handle );
        }
        return $dirArray;
    }

    /**
     * Get File in Dir
     *
     * @param String ,$path
     * @return Array
     */
    static public function getFile($path,$url = "") {
        $fileArray[]=NULL;
        if (false != ($handle = opendir ( $path ))) {
            $i=0;
            while ( false !== ($file = readdir ( $handle )) ) {
                //去掉"“.”、“..”以及带“.xxx”后缀的文件
                if ($file != "." and  $file != ".." and strpos($file,".")) {
                    $fileArray[$i]=$url . $file;
                    if($i==100){
                        break;
                    }
                    $i++;
                }
            }
            //关闭句柄
            closedir ( $handle );
        }
        return $fileArray;
    }
}