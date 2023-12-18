<?php

    include 'dbconn.php';

    if (!$connect->already_login()) {
        $connect->link('user_login_page.php?You are already logged in!');
    }

    $user_id = $_SESSION['user_online'];
    $user = $connect->displayName($user_id);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
<style>
     body{
            padding: 0;
            margin: 0;
            background-image: url('https://i.pinimg.com/564x/e4/36/3f/e4363fd6709eb8d3ecfc99e627851c69.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            font-family: "Poppins", sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
        }

      .container{
            position:absolute;
            background-color:  lightgray;
            border-radius: 50px;
            box-shadow: 5px 50px 100px rgba(0, 0, 0, 0.2);
            padding: 70px;
            text-align:left;
            left: 50%;
            top: 60%;
            transform: translate(-50%, -50%);
            width: 1000px;
            height: 550px;
            display: flex;
            flex-direction: column;
            align-items: left;
            justify-content: center;
        
        }
        
        h3 {
            color: black;
           
        }

        h1 {
            position:absolute;
            background-color:  skyblue;
            border-radius: 50px;
            box-shadow: 5px 50px 100px rgba(0, 0, 0, 0.2);
            padding: 50px;
            text-align:left;
            left: 50%;
            top: 10%;
            transform: translate(-50%, -50%);
            display: flex;
            flex-direction: column;
            align-items: left;
            justify-content: center;
        }
        <div "task-list" {
            top: 10%;
        }
        .navbar-brand {
            text-decoration: none;
            color: white;
            transition: transform 0.3s ease;
            display: inline-block;
        }

        .navbar-brand:hover {
            transform: scale(1.2);
        }
        .social-icons a {
      color: blue;
      margin: 0 10px;
      font-size: 24px;
    }

</style>
<header class="navbar border-bottom border-2 flex-md-nowrap p-0 shadow" style="width: 1999px; height: 60px; background-color:gray;" data-bs-theme="dark">
    <ul class="nav">
 
        <li><a class="navbar-brand fas fa-home  col-1 me-0 px-5 fs-10 text-white" href="user_dboard.php">Home</a></li>
        <li><a class="navbar-brand fas fa-user col-1 me-0 px-5 fs-8 text-white" href="user_todolist.php">To-Do List</a></li>
        <li><a class="navbar-brand fas fa-user-cog col-1 me-0 px-5 fs-8 text-white" href="Profile.php">Profile</a></li>

    </ul>
    <a class="navbar-brand fas fa-sign-out-alt " style="color:darkblue" href="loggedout.php">Logout</a>
</header>

<center>
    <div class="container">
        <center><h3>Name:
        <p style="color:Darkblue;"><?=$user['name']?> </p> </h3>
        <center><h3>Username:
        <p style="color:DarkBlue;"><?=$user['username']?> </p> </h3> 
        <div class="social-icons">
    <a href="https://www.facebook.com/"><i class="fab fa-facebook"></i></a>
    <a href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a>
</center>
  </div>



</body>
</html>