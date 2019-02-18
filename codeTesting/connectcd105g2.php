<?php
$dsn = "mysql:host=localhost;port=3306;dbname=cd105g2;charset=utf8";
$user = "cd105g2";
$password = "vm,61841j4ck6fmp6";
$options = array(PDO::ATTR_CASE=>PDO::CASE_NATURAL, PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION);
$pdo = new PDO($dsn,$user,$password,$options);
?>


