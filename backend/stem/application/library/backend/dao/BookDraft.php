<?php
/**
* BookDraft DAO 
*
* @package     DuyuMvc
* @author      Jess
* @version     1.0
* @license     http://wiki.duyu.com/duyuMvc
*/

namespace backend\dao;

class BookDraft extends \local\db\ORM 
{
    public $table = 'book_draft';

    public $fields = array(
        'menu_id' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'menu_id'),
        'version' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'version',
        'body' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'body'),
        'published' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'published')
        )
    );

    public $primaryKey = "menu_id";
}