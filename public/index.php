<?php
use john\frame\Application;

$loader = require '../vendor/autoload.php';

$app = new Application((include dirname(__FILE__) . "/../config/config.php")['routes'], dirname(__FILE__) . "/../logs");
var_dump($_SERVER);
$app->start();
