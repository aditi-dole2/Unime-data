<?php

$serverName = "localhost";
$userName ="root";
$password = "";
$db_name = "university";

//connection creation

$con = mysqli_connect($serverName,$userName,$password);

if(mysqli_connect_error()){
    echo "failed to connect"
    exit();

} 
echo "connection successfull";


?>