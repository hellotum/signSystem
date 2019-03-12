<?php


$t = "2018 March 06 - 07:20 am";
$timeBegin=@mktime($t);
//echo $timeBegin;
$timeBegin = date("Y-m-d h:i:s", $timeBegin);
echo $timeBegin;