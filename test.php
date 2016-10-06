<?php

require "libs/DB.php";
require "libs/dataBase.php";
$data = new dataBase("get_in");
$dat = $data->getRows("*");
print_r($dat);