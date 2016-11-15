<?php

require_once 'autoload.php';

\ClassLoader::register();
$config = require_once 'config.php';

$action = new \DB\dbaction();

$action->setMasterConf($config['master']);
$action->setSlaveConf($config['slave']);
$action->init();
$action->run();

