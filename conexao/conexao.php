<?php 

$host = 'localhost';
$user = 'root';
$pass = '';
$banco = 'filedoc';

mysql_connect($host, $user, $pass) or die("Erro:");


mysql_select_db($banco) or die("Erro");

?>