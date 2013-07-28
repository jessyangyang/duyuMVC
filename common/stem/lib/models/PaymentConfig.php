<?php
/**
* Config Model 
*
* @package     DuyuMvc
* @author      Jess
* @version     1.0
* @license     http://wiki.duyu.com/duyuMvc
*/

namespace lib\models;

class PaymentConfig extends \local\db\ORM 
{
    public $table = 'payment_config';

    public $fields = array(
        'configid' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'configid'),
        'alipay_pid' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'alipay_pid'),
        'alipay_key' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'alipay_key'),
        'alipay_email' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'alipay_email'),
        'alipay_service_auth' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'alipay_service_auth'),
        'alipay_service_pay' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'alipay_service_pay'),
        'alipay_sign_type' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'alipay_sign_type'),
        'alipay_input_charset' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'alipay_input_charset'),
        'alipay_transport' => array(
            'type' => 'int',
            'default' => 0,
            'comment' => 'alipay_transport'),
        'alipay_subject' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'alipay_subject'),
        'alipay_body' => array(
            'type' => 'varchar',
            'default' => 0,
            'comment' => 'alipay_body'))
        );

    public $primaryKey = "configid";

    // Instance Self
    protected static $instance;


    public static function instance($key = 0)
    {
        return self::$instance ? self::$instance : new PaymentConfig($key);
    }

}