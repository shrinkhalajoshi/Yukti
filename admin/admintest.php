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
            align-items: center; /* Center-align the header content vertically */
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px;
            border: 1px solid #ccc;
        }

        th {
            background-color: #007bff;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #e0e0e0;
        }

        .action-buttons {
            display: flex;
            justify-content: space-around;
        }

        .action-buttons form {
            display: inline-block;
            margin: 0;
        }

        .action-buttons input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 8px 16px;
            cursor: pointer;
        }

        .action-buttons input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="header">
        <span>Hello Admin!</span> <!-- "Hello Admin!" section added -->
        <a href="home.php">Home</a>
        <form method="post" action="">
            <input type="submit" name="logout" value="Log out"> <!-- "Log out" button added -->
        </form>
    </div>
    <main>
        <h2 class="display-6 text-center mb-4">Courses</h2> <!-- Center-aligned "Courses" text -->
        <a href="insertcourses.php" class="add-link">Add Course</a>
        <div class="table-responsive">
            <table class="table text-center">
                <thead>
                    <tr>
                        <th style="width: 10%;">#</th>
                        <th style="width: 25%;">Course Name</th>
                        <th style="width: 22%;">Course Category</th>
                        <th style="width: 22%;">Videos</th>
                        <th style="width: 22%;">Course Created At</th>
                        <th style="width: 30%;">Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $sql = "SELECT * FROM courses";
                    $i = 1;
                    if ($result = $connection->query($sql)) {
                        while ($row = $result->fetch_assoc()) {
                            echo "
                                <tr>
                                    <td>".$i++."</td>
                                    <td>".$row['course_name']."</td>
                                    <td>".$row['course_category']."</td>
                                    <td>".$row['no_of _videos']."</td>
                                    <td>".$row['course_created']."</td>
                                    <td>
                                        <form action='updatecourses.php' method='post'>
                                            <input type='hidden' value='".$row['course_id']."' name='course_update'>
                                            <input type='submit' value='View' name='update'>
                                        </form> 
                                        <form action='deletecourses.php' method='post'>
                                            <input type='hidden' value='".$row['course_id']."' name='course_delete'>
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
