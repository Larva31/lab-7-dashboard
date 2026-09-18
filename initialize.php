<?php
session_start();

// Your exact Aiven Connection Details
$host = "mysql-2137823f-alvarezloreinq-125c.a.aivencloud.com";
$port = 12991;
$user = "avnadmin";
$password = getenv("DB_PASSWORD"); 
$database = "defaultdb"; 

$connection = mysqli_init();

// This requires the ca.pem file to be in the same folder as this PHP file
mysqli_ssl_set($connection, NULL, NULL, __DIR__ . "/ca.pem", NULL, NULL);
mysqli_real_connect($connection, $host, $user, $password, $database, $port, NULL, MYSQLI_CLIENT_SSL);

if($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
?>