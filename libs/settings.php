<?php
date_default_timezone_set('Asia/Calcutta');

session_start();

define('BASEPATH','/');
define('TITLE','ITCombine: Inventory Management System');

define('SITE_ROOT',getcwd());
$protocol = isset($_SERVER["HTTPS"]) ? 'https' : 'http';
define("SITE_URL",$protocol."://".$_SERVER["HTTP_HOST"].'/project/inventory/');

define('ASSETS', SITE_URL.'Assets');
define('JS', SITE_ROOT.'js');
define('CSS', SITE_ROOT.'css');
define('IMAGES', SITE_ROOT.'images');

define('ABSOLUTE_PATH', $_SERVER['DOCUMENT_ROOT']);
define('DOC_ROOT', ABSOLUTE_PATH . BASEPATH);

$pages = [
			"login"=>"login.php",
			"default"=>"Pages/default.php",
			"Header"=>"Commons/header.php",
			"Footer"=>"Commons/footer.php",
			"Error"=>"Pages/error.php",
			"loginControl"=>"Control/loginControl.php",
			"categories"=>"Pages/categories.php",
		];
