<?php
    $connection= new mysqli("localhost","root","","sva");
    if($connection->connect_errno!=0){die("Database Connectivity Error");}
    session_start(); 
    if(!isset($_SESSION['admin'])) {
    header("Location:index.php"); 
    }
    $row=$_SESSION['admin']; 
    $email=$row['admin_email']; 

    if(isset($_POST['logout'])){
    session_destroy();
    header("Location:index.php");  
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<style>
      body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.header {
    background-color: #007bff;
    color: #fff;
    display: flex;
    justify-content: space-between;
    padding: 10px 20px;
}

.header a {
    color: #fff;
    text-decoration: none;
}

.add-link {
    display: block;
    text-align: center;
    margin-bottom: 15px;
    text-decoration: none;
    color: #007bff;
    font-weight: bold;
}

.add-link:hover {
    text-decoration: underline;
}

.table-responsive {
    width: 80%;
    margin: 20px auto;
}

.table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

.table th,
.table td {
    padding: 12px;
    border: 1px solid #ccc;
}

.table th {
    background-color: #007bff;
    color: #fff;
}

    </style> 
  </head>
  <body>
    <div class="header">
      <a href="home.php">Home</a>
    </div>
    <main>
        <h2 class="display-6 text-center mb-4">Videos</h2>
        <a href="video.php" class="add-link">Add Videos</a>
        <div class="table-responsive">
            <table class="table text-center">
                <thead>
                    <tr>
                        <th style="width: 10%;">#</th>
                        <th style="width: 25%;">Course Name</th>
                        <th style="width: 22%;">Course Category</th>
                        <th style="width: 22%;">Course Created At</th>
                        <th style="width: 22%;">Episode No</th>
                        <th style="width: 22%;">Title</th>
                        <th style="width: 22%;">Description</th>
                        <th style="width: 22%;">Videos</th>
                        <th style="width: 30%;">Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
$sql = "SELECT * FROM courses c NATURAL JOIN videos v LIMIT 0, 25;";
$i = 1;
if ($result = $connection->query($sql)) {
    while ($row = $result->fetch_assoc()) {
        echo "
            <tr>
                <td>".$i++."</td>
                <td>".$row['course_name']."</td>
                <td>".$row['course_category']."</td>
                <td>".$row['course_created']."</td>
                <td>".$row['episode_no']."</td>
                <td>".$row['title']."</td>
                <td>".$row['description']."</td>
                <td>
                    <p>".$row['video_file_path']."</p>
                </td>
                <td>
                    <form action='updatevideos.php' method='post'>
                        <input type='hidden' value='".$row['video_id']."' name='video_update'>
                        <input type='submit' value='View' name='update'>
                    </form> 
                    <form action='deletevideos.php' method='post'>
                        <input type='hidden' value='".$row['video_id']."' name='video_delete'>
                        <input type='submit' value='Delete' name='delete'>
                    </form> 
                </td>           
            </tr>
        ";
    }
}
?>

                </tbody>
            </table>
        </div>
    </main>
</body>
</html>