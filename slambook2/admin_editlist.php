<?php
 include 'dbconn.php';

 if (isset($_GET['id'])) {
    $list_id = $_GET['id']; 
    $stment = $dbconn->prepare("SELECT * from lists WHERE id=:list_id");
    $stment->execute([':list_id' => $list_id]);
    $showlist = $stment->fetch(PDO::FETCH_ASSOC);
   }
    

    if (isset($_POST['submit'])) {  
        $updatelist = $_POST['updatelists'];
        $connect->adminupdateList($list_id, $updatelist);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width-device-width, initil-scale=1">
	<title>Edit List</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>

<style type="text/css">
body {
	  background-color: #D6EEEE;
}
 input[type="submit"] {
            padding: 10px 20px;
            background-color: green;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
          
        }


</style>


<form method="POST">
<center>
		<h3> <label>Edit List</label> </h3>

            <input type="text" name="updatelists" value="<?php echo $showlist['list']; ?>"> <br>
            <input type="submit" name="submit">
		      <a href="viewusers.php">Cancel</a>
</center>

</form>
</body>
</html>