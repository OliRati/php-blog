<?php
define("PATH_PROJET", $_SERVER['DOCUMENT_ROOT']  . "/php-blog");
define("WEB_ROOT", "/php-blog");

$configdb = [
    'host'    => 'db',
    'db'      => 'blog',
    'user'    => 'root',
    'pass'    => 'root',
    'charset' => 'utf8mb4'
];

$routes = [
    'home' => 'home.php',
];
