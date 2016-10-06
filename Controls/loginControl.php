<?php
	require "../libs/include.php";
	 function isAjax(){
		
		return (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
	}
//isAjax();
$_SESSION["Anurag"] = "Anurag";
echo "success";