<?php
	class pageMaker{
			
			 static $vars ;
			public function pageMaker(){
					$var = trim(self::$vars,"/");
					$link = explode("/",$var);
					print_r($link);
			} 
	}
	pageMaker::$vars = $_SERVER['REQUEST_URI'] ;