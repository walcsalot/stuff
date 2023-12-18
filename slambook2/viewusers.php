<?php

    include 'dbconn.php';
    $lists = $dbconn->query("SELECT * FROM lists");
    $search = isset($_POST['search']) ? $_POST['search'] : '';
    $users = $dbconn->query("SELECT * FROM user WHERE username LIKE '%$search%' OR name LIKE '%$search%' ORDER BY id DESC");
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>

<style type="text/css">
   body {
      padding: 0;
            margin: 0;
            background-image: url('https://i.pinimg.com/564x/54/6d/5e/546d5e096868f30d366baba3b3195ed9.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            font-family: "Poppins", sans-serif;

}


   table {
   border-collapse: collapse;
   width: 50%;
   }

   th, td {
   text-align: left;
   padding: 5px;
   }  
   tr:nth-child(odd) {
   background-color: #E6E6E6;
   }
   tr:nth-child(even) {
   background-color: #D6EEEE;
   }
   .navbar-brand {
            text-decoration: none;
            color: white;
            transition: transform 0.3s ease;
            display: inline-block;
        }

        .navbar-brand:hover {
            transform: scale(1.1);
        }

</style>

<header class="navbar border-bottom border-2 flex-md-nowrap p-0 shadow" style="width: auto; height: 60px; background-color:#892bcc;" data-bs-theme="dark">
    <a class="px-4 btn" style="color:darkblue" href="loggedout.php">Logout</a>

</header><br><br>
        <center> <label for="search"><b>Search Users:</label>
        <form method="POST" action="viewusers.php" role="search">
        <input type="text" name="search" placeholder="Enter Name or Username" style="width: 400px;  padding: 2px;">
        <button type="submit">Search</button> <center> <br>
        </form>
   <table align = "center" border = "1" cellpadding = "3" cellspacing = "0">
   <center><h1>Account User</h1><br>
   		<tr>
   			<th>ID</th>
            <th>Full Name</th>
   			<th>Username</th>
   			<th>Password</th>
            <th>Edit User</th>
   		</tr>

   		<?php while($user = $users->fetch(PDO::FETCH_ASSOC)): ?>
   		<tr>
   			<td><?php echo $user['id']; ?> </td>
            <td><?php echo $user['name']; ?> </td>
   			<td><?php echo $user['username']; ?> </td>
   			<td><?php echo $user['password']; ?> </td>
            <td> <a href="user_edit_page.php?id=<?php echo $user['id']; ?>"style="color: green;">Edit</a>
            <a href="deleteuser.php?id=<?php echo $user['id']; ?>" style="color: red;">Remove</a>
            </td>
      <?php endwhile; ?>
   		</tr>
      </table>
      <br><br>
      <table align = "center" border = "1" cellpadding = "3" cellspacing = "0">
           <center><h1>User Lists</h1><br>
         <tr>
            <th>ID</th>
            <th>User Lists</th>
            <th>User_ID</th>
            <th>Edit List</th>
         </tr>

         <?php while($list = $lists->fetch(PDO::FETCH_ASSOC)): ?>
         <tr>
            <td><?php echo $list['id']; ?> </td>
            <td><?php echo $list['list']; ?> </td>
            <td><?php echo $list['user_id']; ?> </td'>
            <td> <a href="admin_editlist.php?id=<?php echo $list['id']; ?>"style="color: green;">Edit</a>
            <a href="admindeletelist.php?list_id=<?php echo $list['id']; ?>" style="color: red;">Remove</a>
            </td>
   	<?php endwhile; ?>
         </tr>
   </table>
</body>
</html>