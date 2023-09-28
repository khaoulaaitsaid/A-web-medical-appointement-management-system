<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gestion de rendez-vous";
$conn = "";

try{
    $conn = mysqli_connect($servername,$username,$password,$dbname);

}catch(mysqli_sql_exception){
    echo "could not connect";

}









?>