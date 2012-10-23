<?php
/**
 * Database Class
 *
 * The database wrapper around PDO service.
 *
 * @package     Duyu
 * @author      Jess
 * @version     1.0
 * @license     http://wiki.duyu.cc/duyuMvc
 */

namespace stem\db;

abstract class Database {


    /**
    * Instance
    *******************************************/

    static function instance(){}

    static function hasInstance(){}

    static function setInstance(){}

    /**Methods of the data
    *******************************************/

    function query(){}

    /**Methods of the database
    *******************************************/
    function selectTable($table){}

    function insertId(){}

    function getTables(){}

    function getFields($dbTable){}

    function version(){}

    function error(){}

    function errno(){}

    function close(){}

    function escapeString($fields){}

    /**Transaction
    *******************************************/

    function begin(){}

    function commit(){}

    function rollback(){}

}

?>