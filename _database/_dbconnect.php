<?php

$dbhost = "localhost";
$username = "root";
$password = "";
$database = "scl_community";

$connect = mysqli_connect($dbhost, $username, $password, $database);
if (mysqli_connect_errno()) {
    die("Could Not Connect to _db" . mysqli_connect_error());
} else {
    echo "";
}
;
