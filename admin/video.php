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

// Initialize variables for messages
$uploadMessage = '';

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Get form data
    $course_id = $_POST['course_id'];

    // Check if a file was uploaded
    if (isset($_FILES['video']) && $_FILES['video']['error'] == UPLOAD_ERR_OK) {
        // Define target directory and file path
        $target_dir = '../videos/';
        $extension = pathinfo($_FILES['video']['name'], PATHINFO_EXTENSION);
        $unique_id = uniqid();
        $target_file = $target_dir . $unique_id . '.' . $extension;

        

        // Move the uploaded file to the desired directory
        if (move_uploaded_file($_FILES['video']['tmp_name'], $target_file)) {
            // Insert information into the database
            $video_file_path = $target_file;
            $created_at = date('Y-m-d H:i:s'); // Current date and time

            // Additional video details
            $title = $_POST['title'];
            $description = $_POST['description'];
            $episode_no=$_POST['episode_no'];

            // Insert into the 'videos' table
            $insert_query = "INSERT INTO videos (title, description, video_file_path, created_at, course_id,episode_no) 
                             VALUES ('$title', '$description', '$video_file_path', '$created_at', '$course_id','$episode_no')";

            $insert_result = $connection->query($insert_query);

            if ($insert_result) {
                $uploadMessage = '<p class="success">Video uploaded successfully!</p>';
            } else {
                $uploadMessage = '<p class="error">Error uploading video to the database.</p>';
            }
        } else {
            $uploadMessage = '<p class="error">Error moving uploaded file.</p>';
        }
    } else {
        $uploadMessage = '<p class="error">No file uploaded or an error occurred.</p>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Page</title>
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

        .container select,
        .container input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }

        .container input[type="submit"] {
            display: block;
            width: 100%;
            padding: 10px;
            font-size: 16px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .container input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .header a,
        .add-link {
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

        /* Add styles for success and error messages */
        .success {
            color: green;
            margin-bottom: 10px;
        }

        .error {
            color: red;
            margin-bottom: 10px;
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
    <h2>Video Upload</h2>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">

        <label for="course">Select Course:</label>
        <select name="course_id" id="course" required>
            <?php
            $sql = "SELECT * FROM courses";
            $categories = $connection->query($sql);
            foreach ($categories as $category) {
                $selected = ($category['course_id'] == $row['course_name']) ? 'selected' : '';
                echo("<option value='" . $category['course_id'] . "' $selected>" . $category['course_name'] . "</option>");
            }
            ?>
        </select>

        <label for="title">Video Title:</label>
        <input type="text" name="title" required>

        <label for="episode_no">Episode No:</label>
        <input type="number" name="episode_no" min='1' required>
        <label for="description">Video Description:</label>
        <textarea name="description" required></textarea>

        <label for="video">Upload Video:</label>
        <input type="file" name="video" accept="video/*" required>

        <input type="submit" name="submit" value="Upload">

        <!-- Display upload messages -->
        <?php echo $uploadMessage; ?>
    </form>
</div>
</body>
</html>
