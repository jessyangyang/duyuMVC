<?php
/**
 * Index
 *
 * @package     DuyuMvc
 * @author      Jess
 * @version     1.0
 * @license     http://wiki.duyu.com/duyuMvc
 */

// Default PATH
define("APPLICATION_PATH", realpath((phpversion() >= "5.3"? __DIR__: dirname(__FILE__)).'/../'));

// System Start Time
define("START_TIME", microtime(true));

// System Start Memory
define("START_MEMORY_USAGE", memory_get_usage());

// Dafaule Type of all PHP files
define('DUYU_TYPE', ".php");

// Directory separator (Unix-Style works on all OS)
define('DS', '/');

// Absolute path to the system folder
define('SP', realpath(__DIR__). DS);

// Is this an AJAX request?
define('AJAX_REQUEST', strtolower(getenv('HTTP_X_REQUESTED_WITH')) === 'xmlhttprequest');

// The current TLD address, scheme, and port
define('DOMAIN', (strtolower(getenv('HTTPS')) == 'on' ? 'https' : 'http') . '://'
    . getenv('HTTP_HOST') . (($p = getenv('SERVER_PORT')) != 80 AND $p != 443 ? ":$p" : ''));

// The current site path
define('PATH', parse_url(getenv('REQUEST_URI'), PHP_URL_PATH));

$app = new Yaf\Application(APPLICATION_PATH . "/settings/setting.ini");
$app->bootstrap()->run();

?>