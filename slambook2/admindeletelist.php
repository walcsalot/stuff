<?php
    include 'dbconn.php';

 if (isset($_GET['list_id'])) {
    $list = $_GET['list_id'];
  
    $stment = $dbconn->prepare("DELETE FROM lists WHERE id=:list_id");
    $stment->bindparam(":list_id", $list);
    $stment->execute();
    $connect->link('viewusers.php');
    
    }
