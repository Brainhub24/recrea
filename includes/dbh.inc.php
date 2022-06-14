<?php

$server  = "localhost:8889";
$dbusername = "root";
$dbpassword = "root";
$dbname = "scool";

$conn = mysqli_connect($server, $dbusername, $dbpassword, $dbname);

if (!$conn) {
    die("connection failed: ".mysqli_connect_error());
}
