<?php

require '_database/_dbconnect.php';
session_start();

$loggedin = false;
if (isset($_SESSION["loggedin"]) and $_SESSION["loggedin"] == true) {
    $loggedin = true;
} else {
    $loggedin = false;
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="./partials/CSS/style.css">
</head>

<body>

    <header class="header-container">
        <div class="header">
            <div class="logo"> <a href="index.php"> Sameer's Code Lab </a> </div>
            <nav class="nav_menu">
                <ul>
                    <li> <a href="/login_system"> Home </a> </li>
                    <li> <a href="/profile.php
                    "> Profile </a> </li>
                    <li> <a href=""> Explore </a> </li>
                    <li> <a href=""> Search </a> </li>
                    <li> <a href=""> Create</a> </li>
                </ul>
            </nav>
            <?php
            if ($loggedin) {
                echo "<div class='logout'>
               <a href='logout.php' class='btn btn-success rounded-0'>Log out</a>
            </div> \n";
            } else {
                echo "<div class='login'>
                <a class='btn btn-primary rounded-0 mx-2' href='index.php'>Login</a>
                <a class='btn btn-success rounded-0' href='signup.php'>Sign Up</a>
            </div> \n";
            }
            ?>
        </div>
    </header>