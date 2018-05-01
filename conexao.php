<?php 
$con = new MySQLi('localhost', 'root', '', 'produtos');

if (!$con) {
	echo $con->error();
}

 ?>