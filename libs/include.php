<?php
function __autoload($class_name) 
{
    require_once $class_name.'.php';
}

new pageMaker();