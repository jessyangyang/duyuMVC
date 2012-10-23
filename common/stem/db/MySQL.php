<?php
/**
 * MySQL Base
 *
 * Base class for the MySQL database.
 * 
 * @package     Duyu
 * @author      Jess
 * @version     1.0
 * @license     http://wiki.duyu.cc/duyuMvc
 */

namespace stem\db;

class MySQL extends Database 
{

    // Database connection object
    protected static $db;

    // Instantiate the Mysqli Object
    static $instance = array();

    // Use cache
    private $cache = array();


    /**
    * Constructor
    * @param string | dbConfig , if emptu = "default"
    */
    private function __construct($dbConfig = false)
    {

        self::$db = self::$instance;

    }

    static function hasInstance() 
    {
        return isset($GLOBALS['dbGlobalInstance']);
    }

    /**
    * Set the global database instance
    *
    * In View of dbParams
    * 
    * $dbParams = new array()
    * {
    *   'host' => '',
    *   'dbName' => '',
    *   'user' => '',
    *   'password' =>
    * 
    * }
    *
    * @param String | dbCOnfigName
    * @param Array | dbParams
    * @param Boolean | dbHasDaufalt , if
    */
    static function setInstance($dbConfigName,$dbParams,$dbHasDaufalt = false)
    {
        if (!isset($GLOBALS['dbGlobalConfig'][$dbConfigName])) {
            $GLOBALS['dbGlobalConfig'][$dbConfigName]['name'] = $dbConfigName;
            $GLOBALS['dbGlobalConfig'][$dbConfigName]['params'] = $dbParams;
            $GLOBALS['dbGlobalConfig'][$dbConfigName]['daufalt'] = $dbHasDaufalt;
        }
        elseif (isset($GLOBALS['dbGlobalConfig'][$dbConfigName]) and $GLOBALS['dbGlobalConfig'] != $dbConfigName) {
            $GLOBALS['dbGlobalConfig'][$dbConfigName]['name'] = $dbConfigName;
            $GLOBALS['dbGlobalConfig'][$dbConfigName]['params'] = $dbParams;
            $GLOBALS['dbGlobalConfig'][$dbConfigName]['daufalt'] = $dbHasDaufalt;
        }
    }


    /**
    * Instance database
    * @param Boolean | dbConfigName
    * @return  Object | mysqli
    */
    static function instance($key = 0,$dbConfigName = false) 
    {
        $socket = & $GLOBALS['dbGlobalConfig'];
        $param = $mysql = array();

        if (!$dbConfigName) {
            foreach ($socket as $key => $value) {
                if (isset($value['daufalt']) and $value['daufalt'] == true ) {
                    $param = $value['params'];
                }
            }
        }
        else
        {
            foreach ($socket as $key => $value) {
                if (isset($value['name']) and $dbConfigName == $value['name']) {
                    $param = $value['params'];
                }
            }
        }

        if ($socket) {
            try {
                self::$instance = new \mysqli($param['host'],$param['user'],$param['password'],$param['schema']);

                if (self::$instance->connect_error) {
                    throw new \mysqli_sql_exception('Connect error!',100);
                }

                if (isset($GLOBALS['dbGlobalInstance'])) {
                    $mysql = $GLOBALS['dbGlobalInstance'];
                }
                else
                {
                    $mysql = new Mysql($socket);
                    $GLOBALS['dbGlobalInstance'] = $mysql;
                }

                return $mysql;
            }
            catch (\mysqli_sql_exception $e) {
                $e->getMessage();
            }
        }
    }


    /** Common
    ******************************************************/

    /**
     * Open query cache in self
     * @param str $key MemKey
     * @param int $expire Active Time
     */
    function cache($key = 'md5', $expire = 86400){
        $this->cache['key'] = $key;
        $this->cache['expire'] = $expire;
        return $this;
    }

    /**
    * Query 
    * @param string | sql
    * @param boolean | hasArray , if not array type,return mysqli_result object
    */
    function query() {
        $tmpParams = func_get_args();
        $tmpNums = func_num_args();
        $tmpSql = array_shift($tmpParams);
        //$hasArray = false;

        // use cache
        if($this->cache){
            $memory = & Cache_Memcache::instance('session');
            if('md5' == $this->cache['key']){
                $this->cache['key'] = md5($tmpSql.($tmpParams? join(',', $tmpParams): ''));
            }
            if(empty($_GET['duyu.upcache'])){
                if(false !== ($resule = $memory->get($this->cache['key']))){
                    return $resule;
                }
            }
        }

        // Query Database
        if ($tmpParams) {
            // Prepare in mysql > 5.0
            $resule = self::$db->prepare($tmpSql);
            $resule->execute($tmpParams);
        } 
        else {
            $resule = self::$db->query($tmpSql);
        }

        if(!$resule) return array();
        // not cache query result
        if(!$this->cache){
            return $resule->fetchAll(PDO::FETCH_ASSOC);
        }
        if (isset($resule->num_rows) and $resule->num_rows > 0) {
            return $resule->fetch_all(MYSQLI_ASSOC);
        }
    }


    /**Methods of the database
    *******************************************/

    function selectTable($tableName) {
        return self::$db->select_db($tableName);
    }

    function insertId() {
        return self::$db->insert_id;
    }

    /**
     * DataBase to tables of all
     * @return array
     */
    function getTables() {
        return self::$db->query("SHOW TABLES")->fetch_all(3);
    }

    /**
     * Tables to filters of all
     * @return array
     */
    function getFields($dbTable) {
        return self::$db->query("SHOW FULL FIELDS FROM ".$dbTable)->fetch_all(2);
    }

    /**
    * Mysql Version
    * @return String
    */
    function version() {}

    /**
    * Mysql Exception Error
    * @return exception object
    */
    function error() {}

    /**
    * Mysql Exception Errno
    * @return 
    */
    function errno() {}

    /**
    * Close Mysql Connect
    */
    function close() {}

    /**
    * Frees the memory associated with a result
    */
    function free()
    {
        return self::$db->free();
    }

    /**
    * Escapes special characters in a string for use in an SQL statement, taking 
    * into account the current charset of the connection
    */
    function escapeString($fields) 
    {
        return self::$db->real_escape_string($fields);
    }


    /** Transaction
    *******************************************/

    /**
     * Begin transaction
     */
    function begin(){}

    /**
     * Commit transaction
     */
    function commit(){}

    /**
     * Rollback transaction 
     */
    function rollback(){}

    /**Debug output
    *******************************************/

    /**
    * output to page for mysql debug
    * @param string | $message
    * @param string | $sql
    */
    static function printDebug($message = '' , $sql = '') {
        // $dberror = self::$db->error();
        // $dberrno = self::$db->errno();
        // echo "<div style=\"position:absolute;font-size:12px;font-family:arial;background:#EBEBEB;padding:0.5em;\">
        //      <b>MySQL Error</b><br>
        //      <b>Message</b>: $message<br>
        //      <b>From SQL</b>: $sql<br>
        //      <b>Error</b>: $dberror<br>
        //      <b>Errno.</b>: $dberrno<br>
        //      </div>";
        // exit();
    }
}
?>