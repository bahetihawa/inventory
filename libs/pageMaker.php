<?php
	class pageMaker{
			
			 static $vars ;
			 //public $url = array();
			public function pageMaker(){
					$var = trim(self::$vars,"/");
					$link = explode("/",$var);
					foreach($link as $k=>$v):
						$name = "url".$k;
						$this->$name = $v;
					endforeach;
			} 
	}
	pageMaker::$vars = $_SERVER['REQUEST_URI'] ;