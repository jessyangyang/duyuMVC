<?php
/**
 * APC ORM
 *
 * Provides ORM result caching using APC.
 *
 * @package     DuyuMvc
 * @author      Jess
 * @version     1.0
 * @license     http://wiki.duyu.com/duyuMvc
 **/

namespace stem\db;

class APC extends ORM
{

    public static function cache_set($key, $value)
    {
        apc_store($key, $value, static::$cache);
    }


    public static function cache_get($key)
    {
        return apc_fetch($key);
    }


    public static function cache_delete($key)
    {
        return apc_delete($key);
    }


    public static function cache_exists($key)
    {
        return apc_exists($key);
    }

}

// END
