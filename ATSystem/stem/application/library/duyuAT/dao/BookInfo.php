<?php
/**
* BookInfo DAO 
*
* @package     DuyuMvc
* @author      Jess
* @version     1.0
* @license     http://wiki.duyu.com/duyuMvc
*/

namespace duyuAT\dao;

class BookInfo extends \local\db\ORM 
{
    public $table = 'book_info';

    public $fields = array(
        'bid' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'bid'),
        'oldtitle' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'oldtitle'),
        'translator' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'translator'),
        'price' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'price'),
        'apple_price' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'apple_price'),
        'download_path' => array(
                'type' => 'varchar',
                'default' => 0,
                'comment' => 'download_path')
        );

    public $primaryKey = "bid";
}