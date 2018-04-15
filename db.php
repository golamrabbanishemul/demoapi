<?php

$server = 'localhost' ;
$user = 'root';
$password ='';
$dbname= 'demoapi';

$conn = new mysqli($server,$user,$password,$dbname);

if($conn->connect_error){
    die('connection faild'. $conn->connect_error);
}
echo 'database connect successfully';