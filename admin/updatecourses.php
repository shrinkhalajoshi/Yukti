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

// Update course
if (isset($_POST['update_course'])) {
    $course_id = mysqli_real_escape_string($connection, $_POST['course_id']);
    $new_course_name = mysqli_real_escape_string($connection, $_POST['new_course_name']);
    $new_course_category = mysqli_real_escape_string($connection, $_POST['new_course_category']);
    $new_course_description = mysqli_real_escape_string($connection, $_POST['new_course_description']);

    // Basic validation
    if (empty($new_course_name) || empty($new_course_category) || empty($new_course_description)) {
        $error_message = "All fields are required.";
    } else {
        $update_query = "UPDATE `courses` 
                         SET `course_name`='$new_course_name', 
                             `course_category`='$new_course_category', 
                             `course_description`='$new_course_description' 
                         WHERE `course_id`='$course_id'";

        $result = $connection->query($update_query);

        if ($result) {
            $success_message = "Course updated successfully!";
            // Fetch the updated course details
            $fetch_updated_query = "SELECT * FROM `courses` WHERE `course_id`='$course_id'";
            $fetch_updated_result = $connection->query($fetch_updated_query);

            if ($fetch_updated_result && $fetch_updated_result->num_rows > 0) {
                $course_data = $fetch_updated_result->fetch_assoc();
            }
        } else {
            $error_message = "Error: " . $connection->error;
        }
    }
}

// Fetch course details for the selected course
if (isset($_POST['update'])) {
    $course_id = mysqli_real_escape_string($connection, $_POST['course_update']);
    $fetch_query = "SELECT * FROM `courses` WHERE `course_id`='$course_id'";
    $fetch_result = $connection->query($fetch_query);

    if ($fetch_result && $fetch_result->num_rows > 0) {
        $course_data = $fetch_result->fetch_assoc();
    } else {
        $error_message = "Course not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Course</title>
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

        .container input[type="text"] {
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

        .container a {
            display: block;
            text-align: center;
            margin-bottom: 15px;
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
        }

        .container a:hover {
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
    <h2>Update Course</h2>
    <a href="admin.php">All Courses</a>
    <?php
    if (isset($error_message)) {
        echo '<p class="error">' . $error_message . '</p>';
    }

    if (isset($success_message)) {
        echo '<p class="success">' . $success_message . '</p>';
    }
    ?>

<?php if (isset($course_data)) : ?>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="hidden" name="course_id" value="<?php echo $course_data['course_id']; ?>">

        <label for="new_course_name">Update Course Name:</label>
        <input type="text" name="new_course_name" value="<?php echo $course_data['course_name']; ?>" required>

        <label for="new_course_category">Update Course Category:</label>
        <input type="text" name="new_course_category" value="<?php echo $course_data['course_category']; ?>" required>

        <label for="new_course_description">Update Course Description:</label>
        <textarea name="new_course_description" required><?php echo $course_data['course_description']; ?></textarea>

        <!-- Add Videos Button (above the Update Course button) -->
        <a href="video.php">Add Videos</a>

        <button type="submit" name="update_course">Update Course</button>
    </form>
<?php else : ?>
    <p>No course selected for update.</p>
<?php endif; ?>

</div>

</body>
</html>
