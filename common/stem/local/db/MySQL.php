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

namespace local\db;

class MySQL extends Database 
{

    // Database connection object
    protected static $db;

    // Instantiate the Mysqli Object
    protected static $instance;

    // Config Instance
    protected static $config;

    // SQL 
    private static $SQL;


    /**
    * Constructor
    * @param string | dbConfig , if emptu = "default"
    */
    public function __construct()
    {

    }

    static function hasInstance() 
    {
        return isset(self::$db);
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
        if (!isset(self::$config[$dbConfigName])) {
            self::$config[$dbConfigName]['name'] = $dbConfigName;
            self::$config[$dbConfigName]['params'] = $dbParams;
            self::$config[$dbConfigName]['daufalt'] = $dbHasDaufalt;
        }
        elseif (isset(self::$config[$dbConfigName]) and $config != $dbConfigName) {
            self::$config[$dbConfigName]['name'] = $dbConfigName;
            self::$config[$dbConfigName]['params'] = $dbParams;
            self::$config[$dbConfigName]['daufalt'] = $dbHasDaufalt;
        }
    }


    /**
    * Instance database
    * @param Boolean | dbConfigName
    * @return  Object | mysqli
    */
    static function instance($primary_key = 0,$dbConfigName = false) 
    {
        $socket = & self::$config;
        $param = $mysql = array();
        if (!$dbConfigName and is_array($socket)) {
            foreach ($socket as $key => $value) {
                if (isset($value['daufalt']) and $value['daufalt'] == true ) {
                    $param = $value['params'];
                }
            }
        }
        elseif (is_array($socket))
        {
            foreach ($socket as $key => $value) {
                if (isset($value['name']) and $dbConfigName == $value['name']) {
                    $param = $value['params'];
                }
            }
        }

        if ($socket) {
            try {
                self::$db = new \mysqli($param['host'],$param['user'],$param['password'],$param['schema']);

                if (self::$db->connect_error) {
                    throw new \mysqli_sql_exception('Connect error!',100);
                }

                if (!isset(self::$instance)) {
                    self::$instance = new Mysql($socket);
                }

                return self::$instance;

            }
            catch (\mysqli_sql_exception $e) {
                $e->getMessage();
            }
        }
    }


    /** Common
    ******************************************************/

    /**
    * Query 
    * @param string | sql
    * @param boolean | hasArray , if not array type,return mysqli_result object
    */
    function query() {
        $tmpParams = func_get_args();
        $tmpNums = func_num_args();
        $tmpSql = self::$SQL = array_shift($tmpParams);
        $hasArray = false;
        
        // Query Database
        if ($tmpParams) {
            // Prepare in mysql > 5.0
            $resule = self::$db->prepare($tmpSql);
            $resule->execute($tmpParams);
        } 
        else {
            $resule = self::$db->query($tmpSql);
        }

        if (self::$db->error) {
            self::printDebug("SQL Error:",$tmpSql);
            return false;
        }
        if (isset($resule->num_rows) and $resule->num_rows > 0) {

            return $resule->fetch_all(MYSQLI_ASSOC);
            
        }

        return false;
    }


    /**Methods of the database
    *******************************************/

    function selectTable($tableName) {
        return self::$db->select_db($tableName);
    }

    function insertId() {
        return self::$db->insert_id;
    }

    function affected_rows()
    {
        return self::$db->affected_rows;
    }

    function setCharset($charset = "UTF8")
    {
        return self::$db->set_charset($charset);
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
    function error() {
        return self::$db->error;
    }

    /**
    * Mysql Exception Errno
    * @return 
    */
    function errno() {
        return self::$db->errno;
    }

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


    /**Transaction
    *******************************************/

    /**
     * Begin transaction
     */
    function begin(){
        self::$db->autocommit(false);
    }

    /**
     * Commit transaction
     */
    function commit(){
        self::$db->commit();
        self::$db->autocommit(true);
    }

    /**
     * Rollback transaction 
     */
    function rollback(){
        self::$db->rollback();
    }


    /**Debug output
    *******************************************/

    /**
    * output to page for mysql debug
    * @param string | $message
    * @param string | $sql
    */
    static function printDebug($message = '' , $sql = '') {
        $dberror = self::$db->error;
        $dberrno = self::$db->errno;
        $debug = 1;
        echo json_encode(array('code'=>$dberrno,'message'=>$dberror,'row'=>$sql,'debug'=>$debug,'other'=>$message));
        exit();
    }

    public function printSQL()
    {
        return self::$SQL;
    }


}
