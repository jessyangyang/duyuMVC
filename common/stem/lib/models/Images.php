<?php
/**
* Images DAO 
*
* @package     DuyuMvc
* @author      Jess
* @version     1.0
* @license     http://wiki.duyu.com/duyuMvc
*/

namespace lib\models;

class Images extends \local\db\ORM 
{
    public $table = 'images';

    public $fields = array(
        'pid' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'pid'),
        'uid' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'uid'),
        'class' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'class'),
        'title' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'title'),
        'filename' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'filename'),
        'type' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'type'),
        'size' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'size'),
        'path' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'path'),
        'thumb' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'thumb'),
        'published' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'published')
    );

    public $primaryKey = "pid";

    protected static $instance;

    /**
     * Instance self
     * 
     * @param String $key ,primary_key
     * @return Images Object
     */
    public static function instance($key = false)
    {
        return self::$instance ? self::$instance : new Images($key);
    }

    /**
     * [getThumb description]
     * @return [type] [description]
     */
    public static function getThumb()
    {
        $image = self::instance();
        
    }

    /**
     * [storeFiles description]
     * @param  [type] $FILE  [description]
     * @param  [type] $class [description]
     * @return [type]        [description]
     */
    public function storeFiles($FILE, $uid, $class = 1, $path = "image", $thumb = false)
    {
        if ($FILE) {
            $class = $class ? $class : 1;
            $imageCon = new \duyuu\image\ImageControl();
            return $imageCon->save($FILE, $uid, $class, $path ,$thumb);
        }
        return false;
    }


}