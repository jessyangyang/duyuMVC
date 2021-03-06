<?php
/**
* BookFields DAO 
*
* @package     DuyuMvc
* @author      Jess
* @version     1.0
* @license     http://wiki.duyu.com/duyuMvc
*/

namespace lib\models;

use \lib\models\Members;

class BookFields extends \local\db\ORM 
{
    public $table = 'book_fields';

    public $fields = array(
        'bid' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'bid'),
        'uid' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'uid'),
        'status' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'status'),
        'download_count' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'download_count'),
        'modified' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'modified time')
    );

    public $primaryKey = "bid";

    // Instance Self
    protected static $instance;


    public static function instance($key = 0)
    {
        return self::$instance ? self::$instance : new BookFields($key);
    }


    /**
     * [updateBookStatus description]
     * @param  [type] $bid   [description]
     * @param  [type] $state [description]
     * @return [Boolean]        [description]
     */
    public function updateBookStatus($bid,$state)
    {
        $bookfields = self::instance();
        $table = $bookfields->table;
        $userStatus = Members::getCurrentUser();

        if ($bookfields->where("uid='".$userStatus->id."' AND bid='$bid'")->update(array("status"=> $state))) return true;

        return false;
    }
}