<?php
/**
 * Base
 *
 * Base class to the extended by the Database wrapper.
 *
 * @package 	DuyuMvc
 * @author 		Jess
 * @version  	1.0
 * @license 	http://wiki.duyu.com/duyuMvc
 * 
 */

namespace stem\base;

abstract class Base
{
    public $db;
    public $tables;

    // Create database schema
    abstract public function createSchema();

    // Drop database schema
    abstract public function dropSchema();

    /**
     *  Save data into new schema
     */
    public function store() 
    {
        
    }
}
?>