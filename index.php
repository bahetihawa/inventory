<?php
	require "libs/include.php";
	if(isset($_SESSION["Anurag"])):
		core::loadPage("Header");
		isset($url2) ? core::loadPage($url2) : core::loadPage("default");
		core::loadPage("Footer");
	else:
		core::loadPage("login");
	endif;
	
	