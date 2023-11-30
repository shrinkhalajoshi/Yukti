<?php
$connection = new mysqli("localhost", "root", "", "sva");
if ($connection->connect_errno != 0) {
    die("Database Connectivity Error");
}
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location:index.php");
}
$row = $_SESSION['admin'];
$email = $row['admin_email'];

if (isset($_POST['logout'])) {
    session_destroy();
    header("Location:index.php");
}

// Insert new course
if (isset($_POST['insert_course'])) {
    $course_name = mysqli_real_escape_string($connection, $_POST['course_name']);
    $course_category = mysqli_real_escape_string($connection, $_POST['course_category']);
    $course_description = mysqli_real_escape_string($connection, $_POST['course_description']);

    // Basic validation
    if (empty($course_name) || empty($course_category)  || empty($course_description)) {
        $error_message = "All fields are required.";
    } else {
        $insert_query = "INSERT INTO `courses` 
                         (`course_name`, `course_category`, `course_description`) 
                         VALUES ('$course_name', '$course_category','$course_description')";

        $result = $connection->query($insert_query);

        if ($result) {
            $success_message = "Course inserted successfully!";
            header("Location:admin.php");
        } else {
            $error_message = "Error: " . $connection->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Course</title>
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

        .error {
            color: red;
            margin-bottom: 10px;
        }

        .success {
            color: green;
            margin-bottom: 10px;
        }

        .container {
            width: 50%;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .container h2 {
            text-align: center;
        }

        .container label {
            display: block;
            margin-bottom: 5px;
        }

        .container input[type="text"],
        .container input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        .container textarea {
            width: 100%;
            height: 150px; /* Adjust the height as needed */
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        .container button[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        .container button[type="submit"]:hover {
            background-color: #0056b3;
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
    </style>
</head>
<body>

<div class="header">
    <a href="admin.php">Home</a>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <button type="submit" name="logout">Logout</button>
    </form>
</div>

<div class="container">
    <h2>Insert Course</h2>
    <a href="admin.php" class="add-link">All Courses</a>
    <?php
    if (isset($error_message)) {
        echo '<p class="error">' . $error_message . '</p>';
    }

    if (isset($success_message)) {
        echo '<p class="success">' . $success_message . '</p>';
    }
    ?>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="course_name">Course Name:</label>
        <input type="text" name="course_name" required>

        <label for="course_category">Course Category:</label>
        <input type="text" name="course_category" required>


        <label for="course_description">Course Description:</label>
        <textarea name="course_description" rows="5" style="width: 100%;" required></textarea>

        <button type="submit" name="insert_course">Insert Course</button>
    </form>
</div>

</body>
</html>
