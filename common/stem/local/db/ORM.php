<?php
/**
* ORM (Object-relational mapping)
* 
* @package    DuyuMvc
* @author     Jess
* @version    1.0
* @license    http://wiki.duyu.com/duyuMvc
*/

namespace local\db;

use local\db\MySQL;

class ORM extends MySQL
{

    // Query params
    public $options = array();

    // Join Tables 
    public $joinTables = array();

    /** Private 
    ********************************************/
    
    // Mysql object
    protected static $db;

    // Instance Object
    protected static $instance;

    // Allow Methods
    private $allowDBOMethods = array('table','field','group','where','order','having','distinct','lock','limit','offset','page');

    // Allow Maths Methods
    private $allowMathMethods = array('sum','min','max','count','avg');

    /**
    * Constructor
    * @param int | dbPrimaryKey , if not, param = false
    * @param string | dbConfig , if emptu = "default"
    */
    public function __construct($dbPrimaryKey = false ,$dbConfigName = "default" ) {

        self::$db = Mysql::init($dbPrimaryKey,$dbConfigName);

        if ($dbPrimaryKey) {    
            if ($tmpRow = $this->fetchRow($dbPrimaryKey)) {
                foreach ($tmpRow as $key => $value) 
                {
                    // $this->attributes[$key] = $value;
                    $this->$key = $value;
                }

            }
            else {
                foreach ($this->fields as $key => $value) 
                {
                    // $this->attributes[$key] = false;
                    $this->$key = false;
                }
            }
        }
    }

        /**
    * Instance database
    * @param string | dbConfig
    * @return  Object | mysqli
    */
    public static function instance() {
        $dbConfigName = $dbPrimaryKey = array();
        if ($param  = func_get_args()) {
            $dbPrimaryKey = isset($param[0]) ? $param[0] : false;
            $dbConfigName = isset($param[1]) ? $param[1] : "default";
        }
        if (!isset(self::$instance)) {
            self::$instance = new ORM($dbPrimaryKey ,$dbConfigName);
        }
        return self::$instance;
    }

    /**
    * Call Methods
    * @param string | dbMethod
    * @param array  | dbFields
    * @return Object | self
    */
    function __call($dbMethod, $dbFields) {

        // Checkout Methods
        if (in_array($dbMethod, $this->allowDBOMethods, true)) {
            $this->options[$dbMethod] = $dbFields[0];
            return $this;
        }
        // Maths Methods
        if (in_array($dbMethod, $this->allowMathMethods)) {
            $field = isset($dbFields[0]) ? $dbFields[0] : "*";
            return $this->fetchOne("$dbMethod($field)");
        }
        
        // Find data for field
        if (substr($dbMethod, 0, 4) == "find") {
            return $this->wherr(strtolower(substr($dbMethod, 0, 4)."='{$dbFields[0]}'"))->fetchRow();
        }
    }

    /**
    * Query params
    * @param Array | $option
    * @return Array 
    */
    private function _options($option = array()) {

        //Merge Query Condition 
        $tmpOption = $option ? array_merge($this->options,$option) : $this->options;
        $this->options = array();
        //tables
        empty($tmpOption['table']) and $tmpOption['table'] = $this->table;
        empty($tmpOption['field']) and $tmpOption['field'] = '*';

        $tmpIntType = array('int','tinyint','smallint','mediumint','integer','bigint');
        $tmpFloatType = array('float','double');
        $tmpFloatType = array('bit');

        // query condition
        if(isset($tmpOption['where']) and is_array($tmpOption['where']))
        {
            foreach ($tmpOption['where'] as $key => $value) 
            {
                // Check $value 
                if(isset($this->fields[$key]) and is_scalar($value))
                {
                    //Format int
                    foreach ($tmpIntType as $key2 => $var) 
                    {
                        if ( strripos( $this->fields[$key]['type'], $var)) 
                        {
                            $tmpOption['where']["`$key`"] = intval($value);
                        }
                    }
                    
                    //Format float
                    foreach ($tmpFloatType as $key2 => $var) 
                    {
                        if( strripos( $this->fields[$key]['type'], $var))
                        {
                            $tmpOption['where']["`$key`"] = floatval($value);
                        }
                    }

                    //Format boolean
                    foreach ($tmpFloatType as $key2 => $var) 
                    {
                         if( strripos( $this->fields[$key]['type'], $var))
                         {
                            $tmpOption['where']["`$key`"] = $value ? "b'".$value."'." : "b'".$value."'";
                                
                        }
                    }
                }
            }
        }
        elseif (isset($tmpOption['where'])) {
            $tmpOption['where'] = $this->escapeString($tmpOption['where']);
        }
        // elseif (isset($tmpOption['where']))
        // {
        //     $isFilter = array();
        //     foreach ($this->fields as $key => &$value) {
        //         if (!in_array($key, $isFilter)) {
        //             $tmpOption['where'] = str_replace($key, '`'.$key.'`', $tmpOption['where']);
        //             if ($value['type'] == 'bit') {
                        
        //             }
        //             $isFilter[] = $key;
        //         }
        //     }
        // }
        return $tmpOption;

    }


    /**
     * Filter Data
     * @param array $dbData
     * @return boolean ,
     */
    private function _filter(&$dbData){
        if(!is_array($dbData))return false;
        foreach ($dbData as $key => $value){
            if(empty($this->fields[$key])) 
            { 
                $dbData["`".$key."`"] = $dbData[$key];
                unset($dbData[$key]); 
                continue; 
            }
            foreach (array('\\'=> '', "'"=>'`') as $key_2 => $var2)
            {
                if( strripos($value, $key_2))
                {
                    $value = str_replace($key_2, $var2, $value);
                }
                
            }
        }
        return $dbData ? true: false;
    }

    /**
    * SQL ADDSLASHES
    * @param Array | Stirng : $string
    * @return Array | Streing
    */
    public function saddslashes($string) {
        if(is_array($string)) {
            foreach($string as $key => $val) {
                $string[$key] = saddslashes($val);
            }
        } else {
            $string = addslashes($string);
        }
        return $string;
    }

    /**
    * Join table query
    * @param String | dbTable
    * @param String | dbSqlarr
    * @param String | dbPrefix
    * @return self
    */
    function joinQuery($dbTable,$dbSqlarr,$dbPrefix = "LEFT") {
        $this->joinTables[] = " $dbPrefix JOIN $dbTable ON $dbSqlarr ";
        return $this;
    }

    /**
     * Save Data(Auto Partitioning Insert/Update)
     * @param array | dbData
     */
    function save($dbData = false) {

        $tKey = false;
        isset($this->primaryKey) and $tKey = $this->primaryKey;
        if ($dbData[$this->primaryKey]) {
            return $this->update($dbData) ? $dbData[$this->primaryKey] : 0;
        }
        elseif (isset($tKey)) {
           foreach ($this->fields as $key => $value) {
               if (isset($this->$key)) {
                   $sqlArr[$key] = $this->$key; 
               }
           }
           return $this->update($sqlArr);
        }
        return $this->insert($dbData);
    }

    /**
     * Insert data
     * @param Array | dbData
     * @return Int | if true return insert_id.
     */
    function insert($dbData) {
        if ($this->_filter($dbData)) {
            foreach ($dbData as $key => $value) {
                $dbData["`$key`"] = "'$dbData[$key]'";
                if (array_key_exists($key,$this->fields) and $this->fields[$key]['type'] == "bit") {
                    $dbData["`$key`"] = "b'$value'";
                }
                unset($dbData[$key]);
            }
            $tmpField = implode(',',array_keys($dbData));
            $tmpValue = implode(",",$dbData);

            $sql = "INSERT INTO $this->table($tmpField) VALUES($tmpValue)";
            self::$db->query($sql);

            if (!self::$db->error() and self::$db->insertId() > 0) {
               return self::$db->insertId();
            }
            elseif (!self::$db->error()) {
                return true;
            }
        }
        return 0;
    }

    /**
     * Update Data
     * @param Array | dbData
     * @return Boolean
     */
    function update($dbData) {
        if ($this->_filter($dbData)) {
            $tmpOption = array();
            // check primaryKey not empty
            if (array_key_exists($this->primaryKey, $dbData)) {
                $tmpOption = array(
                    'where' => "`$this->primaryKey` " . " = '" .$dbData[$this->primaryKey] . "'"
                    );
            }
            $tmpOption = $this->_options($tmpOption);

            // Updata
            if ($dbData and isset($tmpOption['where']) and $tmpOption['where'])
            {
                foreach ($dbData as $key => $value) {
                    $setarr[] = $this->fields[$key]['type'] == 'bit' ? "`$key`=b'$value'" :"`$key`='$value'";
                }
                $sql = "UPDATE " . $tmpOption['table'] . " SET " . implode(',', $setarr) . " WHERE " . $tmpOption['where'];
                self::$db->query($sql);
                return self::$db->affected_rows() ? true : false;
            }

            return false;

        }
    }

    /**
     * Delete Data
     * @param Array | dbParams
     * @return Boolean
     */
    function delete() {

        // Delete row data for primaryKey
        if ($param = func_get_args()) {
            $sql = "DELETE FROM $this->table WHERE ";
            if (intval($param) || count($param) > 0) {
                $sql.= $this->primaryKey . " IN(" . implode(',', $param) . ")";
                return self::$db->query($sql);
            }
        }

        $tmpOption = $this->_options();

        if ($tmpOption) {
            $sql = "DELETE FROM " . $tmpOption['table'] . " WHERE " . $tmpOption['where'];
            self::$db->query($sql);
            return self::$db->affected_rows() ? true : false;
        }
        return false;

    }

    /**
     * Query field ( In view of fetchRow )
     * @param Int | key : primaryKey
     * @return Array 
     */
    function fetchRow($key = false) {
        $tmpOption = $key ? $this->_options(array('where' => $this->primaryKey."='$key'")): $this->_options();

        $tmpOption['where'] = empty($tmpOption['where'])? '': ' WHERE '.$tmpOption['where'];
        //Return record of wrong sql in base,when the sql make wrong.
        $sql = 'SELECT '.$tmpOption['field'].' FROM '.$tmpOption['table'].' '.$tmpOption['where'].' LIMIT 0,1';
        if($resule = self::$db->query($sql))
        {
            return $resule[0];
        }
        return array();
    }

    /**
     * Query field ( In view of fetchOne )
     * @param String $dbField
     * @return String | false
     */
    function fetchOne($dbField) {
        $this->field($dbField);
        if(($tmpRow = $this->fetchRow()) and isset($tmpRow[$dbField])){
            return $tmpRow[$dbField];
        }
        return false;
    }

    /**
     * Query data to Array
     * @param Array | option
     * @return Array 
     */
    function fetchList($option = array(),$debug = false) {
        if(!is_array($option)){
            $option = array('where' => $this->primaryKey.(strpos($option, ',')? ' IN('.$option.')': '='.$option));
        }
        $tmpOption = $this->_options($option);
        $distinct = empty($tmpOption['distinct']) ? "" : 'DISTINCT ';
        $tmpSql = 'SELECT ' . $distinct;
        $tmpSql .= $tmpOption['field'].' FROM '.$tmpOption['table'];
        $this->joinTables and $tmpSql.= implode($this->joinTables);
        empty($tmpOption['where']) || $tmpSql.= ' WHERE '.$tmpOption['where'];
        empty($tmpOption['group']) || $tmpSql.= ' GROUP BY '.$tmpOption['group'];
        empty($tmpOption['order']) || $tmpSql.= ' ORDER BY '.$tmpOption['order'];
        empty($tmpOption['limit']) || $tmpSql.= ' LIMIT '.$tmpOption['limit'];

        if($debug) echo $tmpSql;
        $this->joinTables = array();
        return self::$db->query($tmpSql);
    }

    /**
     * Query and return to Hash array ( In view of fetchList )
     * @param string $dbField
     * @return array
     */
    function fetchHash() 
    {

    }
}
