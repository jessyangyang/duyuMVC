<?php
/**
* BookMenu DAO 
*
* @package     DuyuMvc
* @author      Jess
* @version     1.0
* @license     http://wiki.duyu.com/duyuMvc
*/

namespace duyuu\dao;

class BookMenu extends \local\db\ORM 
{
    public $table = 'book_menu';

    public $fields = array(
        'id' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'id'),
        'bid' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'bid'),
        'sort' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'sort')
    );

    public $primaryKey = "id";
}