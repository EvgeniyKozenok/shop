<?php

return [
    'routes' => include 'routes.php',
    'services' => include 'services.php',
    "views" => realpath(dirname(__FILE__) . "/../src/views"),
    'middlewares' => include 'middlewares.php',
];