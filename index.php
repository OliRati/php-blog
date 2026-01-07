<?php
require 'config.php';
include 'fonctions.php';


$pageFiltre = filter_input(INPUT_GET, 'page' , FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$page = $pageFiltre ?? 'home';

if (!array_key_exists($page,$routes)) {
    redirect('404.php');
}

require $routes[$page];
die();