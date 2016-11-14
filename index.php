<?php

error_reporting(E_ERROR | E_USER_ERROR | E_PARSE | E_COMPILE_ERROR);
require_once 'autoload.php';

\ClassLoader::register();
$config = require_once 'config.php';

$action = new \DB\dbaction();

$action->setMasterConf($config['master']);
$action->setSlaveConf($config['slave']);
$action->init();
$arr = $action->run();
var_dump($arr);
exit;

