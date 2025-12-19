<?php
$db_server = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "bankly_v2";


$conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name, 3307);

if (!$conn){
    echo 'connection error'.mysqli_connect_error();
}

?>