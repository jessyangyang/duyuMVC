<?php
/**
* BookFields DAO 
*
* @package     DuyuMvc
* @author      Jess
* @version     1.0
* @license     http://wiki.duyu.com/duyuMvc
*/

namespace duyuAT\dao;

class BookFields extends \local\db\ORM 
{
    public $table = 'book_fields';

    public $fields = array(
        'bid' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'bid'),
        'status' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'status')
    );

    public $primaryKey = "bid";
}