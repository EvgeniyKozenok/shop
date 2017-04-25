<?php
use John\Frame\Application;

$loader = require '../vendor/autoload.php';

$loader->addPsr4("Shop\\", dirname(__FILE__) . '/../src/');

$app = new Application((include dirname(__FILE__) . "/../config/config.php"), dirname(__FILE__) . "/../logs");

$app->start();
