<?php 
		$dsn = "mysql:host=localhost;port=3306;dbname=cd105g2;charset=utf8";
		$user = "root";
		$password = "km781031";
		$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
	   	$pdo = new PDO($dsn, $user, $password, $options);
 ?>