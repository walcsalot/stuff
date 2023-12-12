<?php
 session_start();
 $servername = "localhost";
 $username = "root";
 $password = "";
 $dbname = "slambook";

    try {
    $dbconn = new PDO("mysql:host={$servername};port=3307;dbname={$dbname}",$username,$password);
    $dbconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    catch(PDOException $error) {
     echo $error->getMessage();
    }

    include 'user.php';
    $connect = new Users($dbconn);