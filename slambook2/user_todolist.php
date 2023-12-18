<?php
    include 'dbconn.php';

  if (!$connect->already_login()) {
  $connect->link("user_login_page.php?You are not logged in!");
  }

  $user_id = $_SESSION['user_online'];


  if (isset($_POST['submit'])) {
    $list = $_POST['lists'];
    $connect->insertList($list, $user_id);
  }

  $listings = $dbconn->query("SELECT * FROM lists WHERE user_id = $user_id ORDER BY id ASC");  

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>To-do List</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="user_todolist.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<style>
    header {
        position: absolute;
        z-index: 9;
    }
.container {
  display: flex;
  flex-flow: row wrap;
  padding-top: 2px;
  width: 100%;
  height: auto;
  min-height: 100px;
  max-width: 400px;
  min-width: 250px;
  background-color: #D6EEEE;
  background-size: 25px 25px;
  border-radius: 20px;
}

    input[type=checkbox]:checked + a {
  color: green;
  font-style: italic;
}
</style>
<body>
<header class="navbar border-bottom border-2 flex-md-nowrap p-0 shadow" style="height: 60px; background-color:gray;" data-bs-theme="dark">
    <ul class="nav">
 
        <li><a class="navbar-brand fas fa-home  col-1 me-0 px-5 fs-10 text-white" href="user_dboard.php">Home</a></li>
        <li><a class="navbar-brand fas fa-user col-1 me-0 px-5 fs-8 text-white" href="user_todolist.php">To-Do List</a></li>
        <li><a class="navbar-brand fas fa-user-cog col-1 me-0 px-5 fs-8 text-white" href="Profile.php">Profile</a></li>
        </ul>
        <a class="navbar-brand fas fa-sign-out-alt " style="color:darkblue" href="loggedout.php">Logout</a>

    </ul>
</header>

<div class="container">
<h3 style="color:blue;"><b>My To-Do List</b></h3><br>
        <form method="POST">
            <label for="list">Add a list</label>
            <input type="text" name="lists" id="list" required>
            <button type="submit" name="submit" id="submit">Add</button>
            <h4 style="color: darkblue;"><b>Task List :</h4>
        </form>
    <div class="box">
        
            <?php while ($showlist = $listings->fetch(PDO::FETCH_ASSOC)):?>
                <div class="checkbox"> <input type="checkbox"> 
                    <a> <?= $showlist['list'] ?> </a> </div>
                        <a href="editlist.php?id=<?= $showlist['id']?>"> Edit </a> 
                        <a href="deletelist.php?list_id=<?= $showlist['id']?>"> Delete </a>
            <?php endwhile; ?>
    </div>
</div>
</body>
</html>

