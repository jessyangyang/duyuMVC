<?php
/**
* BookChapter DAO 
*
* @package     DuyuMvc
* @author      Jess
* @version     1.0
* @license     http://wiki.duyu.com/duyuMvc
*/

namespace duyuAT\dao;

class BookChapter extends \local\db\ORM 
{
    public $table = 'book_chapter';

    public $fields = array(
        'menu_id' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'menu_id'),
        'body' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'body')
    );

    public $primaryKey = "menu_id";
}