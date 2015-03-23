<?php
error_reporting(E_ERROR || E_WARNING || E_PARSE);

define("DEFAULT_PATH",dirname(dirname(__FILE__)));
define("PROJECT_NAME",basename(DEFAULT_PATH));
define("DS","/");

include(DEFAULT_PATH . DS . "config" . DS . "Autoloader.php");

Q::run();