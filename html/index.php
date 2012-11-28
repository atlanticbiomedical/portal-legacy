<?php
error_reporting(E_ALL | E_STRICT);
ini_set("display_errors", 1);
ini_set("register_long_arrays",1);


define('SF_ROOT_DIR',    realpath(dirname(__FILE__).'/..'));
define('SF_APP',         'atlbiomed');
define('SF_ENVIRONMENT', 'prod');
define('SF_DEBUG',       true);
require_once(SF_ROOT_DIR.DIRECTORY_SEPARATOR.'apps'.DIRECTORY_SEPARATOR.SF_APP.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php');

sfContext::getInstance()->getController()->dispatch();

