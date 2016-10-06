<?php
require "settings.php";
function __autoload($class_name) 
{
    require_once $class_name.'.php';
}

$pageMaker = new pageMaker();
extract((array)$pageMaker);

core::$page_array = $pages;
