<?php
include 'dbconn.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['search'])) {
    $search_query = $_GET['search'];

    // Use a prepared statement to prevent SQL injection
    $stment = $dbconn->prepare("SELECT * FROM user WHERE username LIKE ?");
    $stment->bindparam("s", $search_query);
    $stment->execute();
    $connect = $stment->fetchAll(PDO::FETCH_ASSOC);


}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Search Results</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
<style>
         body {
            background-color: lightgray;
            font-family: "Poppins", sans-serif;
        }

        .container {
            margin-top: 50px;
        }

        h2 {
            color: #007bff;
        }

        .user-result {
            margin-bottom: 20px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: #fff;
        }

        .user-result img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-right: 20px;
        }

        .user-info {
            display: flex;
            align-items: center;
        }

        .user-info p {
            margin: 0;
            font-size: 16px;
            color: #333;
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
</head>
<body>

<header class="navbar border-bottom border-2 flex-md-nowrap p-0 shadow" style="width: 1999px; height: 110px; background-color:#892bcc;" data-bs-theme="dark">
    <ul class="nav">
 
    <li><a class="navbar-brand fas fa-less-than  col-1 me-0 px-5 fs-10 text-white" href="home.php"></a></li>
    </ul>
</header><br>
<div class="container">
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['search'])) {
        $search_query = $_GET['search'];

        $sql = "SELECT * FROM user WHERE username LIKE ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $search_query);
        $stmt->execute();
        $result = $stmt->get_result();

        echo "<h2>Search Results</h2>";

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='user-result'>";
                echo "<div class='user-info'>";
                echo "<p><b>User:</b> {$row['name']}<br><b>Username:</b> {$row['username']}</p>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<p>No results found.</p>";
        }

        $stmt->close();
    }
    ?>
</div>


</body>
</html>