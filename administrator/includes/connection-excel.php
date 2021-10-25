<?php
	$host='localhost'; 
	$user='selar353_trial'; 
	$pass='trial123'; 
	$DataBase='selar353_trial';
	
	$Link=@mysqli_connect($host,$user,$pass,$DataBase) or die('Can\'t connect !');
	mysqli_set_charset($Link, 'utf8');
?>