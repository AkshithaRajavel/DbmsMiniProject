<?php
$host='dbmsminiproject.cjtnw5vlqpra.ap-northeast-1.rds.amazonaws.com';
$username='admin';
$password='akshitha';
$dbname='dbmsMiniProject';
$_ENV = parse_ini_file('.env');
if(!array_key_exists('con', $_ENV)){
$_ENV['con'] = mysqli_connect($_ENV['host'],$_ENV['username'],$_ENV['password'],$_ENV['dbname']);
}
$sql="SELECT * FROM users";
$query=mysqli_query($_ENV['con'],$sql);
var_dump(mysqli_fetch_assoc($query));
var_dump(mysqli_fetch_assoc($query));
var_dump(mysqli_fetch_assoc($query));
var_dump(mysqli_fetch_assoc($query));
?>