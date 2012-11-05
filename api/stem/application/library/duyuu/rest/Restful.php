<?php
/**
 * Restful
 *
 * @package     DuyuMvc
 * @author      Jess
 * @version     1.0
 * @license     http://wiki.duyu.com/duyuMvc
 * 
 */
namespace duyuu\rest;

class Restful extends \local\rest\REST
{

    private static  $routeType = 'rewrite';
    
    public static  $restURL = array();

    public static $instance;

    public $responseData = array();

    public function __construct()
    {
       // parent::__construct();
       //new \Yaf\Config\Simple(self::$restURL);
    }

    /**
     * [regRestURL description]
     *
     * $restOptions = array (
     *     'type' => 'rewrite',
     *     'match' => '/test/login/:id',
     *     'route' => array (
     *         'controller' => "user",
     *         'action'=>'list'
     *     )
     * );
     *
     * 
     * @param  [String] $restName    [description]
     * @param  [Array] $restOptions [description]
     * @return [Array]              [description]
     */
    static function regRestURL($restName, $restUrl, $controller, $action = ''){ 
        self::$restURL[$restName]['type'] = self::$routeType;
        self::$restURL[$restName]['match'] = $restUrl;
        self::$restURL[$restName]['route']['controller'] = $controller;
        if ($action) {
            self::$restURL[$restName]['route']['action'] = $action;
        }

    }

    public static function instance()
    {
        return self::$instance ? self::$instance : new Restful();
    }

    static function getRouteName($restName)
    {
        return self::$restURL[$restName];
    }

    /**
    */
    public function setData($key, $data)
    {
        $this->responseData[$key] = $data;
    }
}