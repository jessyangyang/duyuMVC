<?php
/**
* Books DAO 
*
* @package     DuyuMvc
* @author      Jess
* @version     1.0
* @license     http://wiki.duyu.com/duyuMvc
*/

namespace duyuu\dao;

class Books extends \local\db\ORM 
{
    public $table = 'books';

    public $fields = array(
        'bid' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'bookID'),
        'title' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'title'),
        'category' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'category'),
        'cover' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'couverURL'),
        'author' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'author'),
        'press' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'press'),
        'published' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'publishing time'),
        'isbn' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'idbn'),
        'summary' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'summary')
        );

    public $primaryKey = "bid";
}