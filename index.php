<?php

require_once 'app/config/routes.php';

spl_autoload_register();
$routing = new app\vendor\Routing;
$routing->startApp();
