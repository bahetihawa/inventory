<?php
	class core{
		public static $page_array =array();
		public static function validPage($page){
			if(isset($page)):
				if(array_key_exists($page,self::$page_array)){
					return self::$page_array[$page];
				}else{
					return "Error";
				}
			else:
				return "Error";
			endif;
		}
		public static function loadPage($page){
			return file_exists(self::validPage($page)) ? require(self::validPage($page)) : require(self::validPage("Error"));
		}
		
		public static function isAjax(){
			
			return (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
		}
	}