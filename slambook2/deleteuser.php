<?php
    include 'dbconn.php';

 if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stment = $dbconn->prepare("DELETE FROM user WHERE id=:user_id");
    $stment->bindparam(":user_id", $id);
    $stment->execute();
    $connect->link('viewusers.php');
    
    }     