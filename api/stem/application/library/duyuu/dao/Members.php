<?php
/**
* Members DAO 
*
* @package     DuyuMvc
* @author      Jess
* @version     1.0
* @license     http://wiki.duyu.com/duyuMvc
*/

namespace duyuu\dao;

class Members extends \local\db\ORM 
{
    public $table = 'members';

    public $fields = array(
        'id' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'bookID'),
        'email' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'email'),
        'password' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'password'),
        'username' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'username')
        );

    public $primary_key = "id";
}