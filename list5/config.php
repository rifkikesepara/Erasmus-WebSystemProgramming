<?php
$server = "localhost";
$database = "test";
$user = "root";
$pass = "";
$dbConnection = new PDO("mysql:host=" . $server . ";dbname=" . $database, $user, $pass);
