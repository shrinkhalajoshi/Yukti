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

// Update video
if (isset($_POST['update_video_button'])) {
    $upadtevideo_id = mysqli_real_escape_string($connection, $_POST['updatevideo_id']);
    $new_title = mysqli_real_escape_string($connection, $_POST['new_title']);
    $new_description = mysqli_real_escape_string($connection, $_POST['new_description']);
    $new_episode_no = mysqli_real_escape_string($connection, $_POST['new_episode_no']);
    $update_course_id = mysqli_real_escape_string($connection, $_POST['update_course_id']);
    // Basic validation
    if (empty($new_title) || empty($new_description)) {
        $error_message = "All fields are required.";
    } else {
        // Check if a new video file is uploaded
        if ($_FILES['new_video']['error'] == 0) {
            // File information
            $file_name = $_FILES['new_video']['name'];
            $file_size = $_FILES['new_video']['size'];
            $file_tmp = $_FILES['new_video']['tmp_name'];
            $file_type = $_FILES['new_video']['type'];

            // Move the uploaded file to the desired folder
            $upload_path = '../videos/'; // Specify the upload path
            $target_path = $upload_path . $file_name;
            
            if (move_uploaded_file($file_tmp, $target_path)) {
                // Update video details in the 'videos' table
                $update_query = "UPDATE `videos` 
                                 SET `title`='$new_title', 
                                    `description`='$new_description', 
                                    `episode_no`='$new_episode_no', 
                                    `video_file_path`='$target_path',
                                    `course_id`='$update_course_id'
                                 WHERE `video_id`='$upadtevideo_id'";

                $result = $connection->query($update_query);

                if ($result) {
                    $success_message = "Video details updated successfully!";
                } else {
                    $error_message = "Error: " . $connection->error;
                }
            } else {
                $error_message = "Failed to upload video file.";
            }
        } else {
            // Update video details in the 'videos' table without changing the video file
            $update_query = "UPDATE `videos` 
                             SET `title`='$new_title', 
                            `description`='$new_description',
                            `episode_no`='$new_episode_no', 
                            `course_id`='$update_course_id'
                             WHERE `video_id`='$upadtevideo_id'";
                            

            $result = $connection->query($update_query);

            if ($result) {
                $success_message = "Video details updated successfully!";
                header("Location:viewvideo.php");
            } else {
                $error_message = "Error: " . $connection->error;
            }
        }
    }
}

// Fetch video details for the selected video
if (isset($_POST['update'])) {
    $video_id = mysqli_real_escape_string($connection, $_POST['video_update']);
    $fetch_query = "SELECT * FROM `videos` WHERE `video_id`='$video_id'";
    $fetch_result = $connection->query($fetch_query);

    if ($fetch_result && $fetch_result->num_rows > 0) {
        $video_data = $fetch_result->fetch_assoc();
    } else {
        $error_message = $video_id."Video not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Video</title>
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

        .container input[type="file"] {
            margin-bottom: 10px;
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
    <h2>Update Video</h2>
    <a href="viewvideo.php">All Videos</a>
    <?php
    if (isset($error_message)) {
        echo '<p class="error">' . $error_message . '</p>';
    }

    if (isset($success_message)) {
        echo '<p class="success">' . $success_message . '</p>';
    }
    ?>

    <?php if (isset($video_data)) : ?>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
            <input type="hidden" name="updatevideo_id" value="<?php echo $video_data['video_id']; ?>">
            <label for="course">Select Course:</label>
            <select name="update_course_id" id="course" required>
            <?php
            $sql = "SELECT * FROM courses";
            $categories = $connection->query($sql);
            foreach ($categories as $category) {
                $selected = ($category['course_id'] == $row['course_name']) ? 'selected' : '';
                echo("<option value='" . $category['course_id'] . "' $selected>" . $category['course_name'] . "</option>");
            }
            ?>
        </select>
            <label for="new_title">Update Video Title:</label>
            <input type="text" name="new_title" value="<?php echo $video_data['title']; ?>" required>
            <label for="new_title">Update Video Episode:
                Now <?php echo $video_data['episode_no']; ?>
            </label>
            <input type="number" name="new_episode_no" min='1' required>

            <label for="new_description">Update Video Description:</label>
            <textarea name="new_description" required><?php echo $video_data['description']; ?></textarea>
            
            <video controls width='640' height='360'>
                <source src="<?php echo $video_data['video_file_path'];?>" type='video/mp4'>
                Your browser does not support the video tag.
            </video>

            <label for="new_video">Update Video File:</label>
            <input type="file" name="new_video">

            <button type="submit" name="update_video_button">Update Video</button>
        </form>
    <?php else : ?>
        <p>No video selected for update.</p>
    <?php endif; ?>

</div>

</body>
</html>