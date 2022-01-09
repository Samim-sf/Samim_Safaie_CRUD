<?php

use CRUD\Controller\PersonController;

include("loader.php");

//$server = "localhost";
//$username = "root";
//$password = "samim123";
//$con = mysqli_connect($server, $username, $password);
//
//
//
//
//
//if (!$con) {
//    echo "not connect";
//} else {
//    echo "connect";
//}
//echo "\n";
//
//$name="perspolis";
//$sql="Create schema ".$name;
////$query = "insert into first (name) values ('je')";
////if ($con->query("DROP DATABASE chert")) {
////    echo "drop successful";
////} else {
////    echo "drop failed";
////}
//echo "\n";
//if ($con->query($sql)) {
//    echo "database query successful";
//} else {
//    echo "failed";
//}
//$con->close();
$server="localhost";
$username="root";
$password="samim123";
$dbName="persons";
$controller = new PersonController($server, $username, $password, $dbName);
$controller->switcher($_SERVER['PATH_INFO'], $_REQUEST);
