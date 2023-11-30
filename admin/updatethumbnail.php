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

if (isset($_POST['register'])) {
    // Collect data from the form
    $course_id = $_POST['update_course_id']; // You were missing this line
    // Check if a file was uploaded
    if ($_FILES['picture']['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES['picture'];
        $file_name = uniqid() . $file['name'];
        $file_tmp = $file['tmp_name'];

        // Check file type
        $allowed_types = ['image/jpeg', 'image/jpg', 'image/png'];
        $file_info = finfo_open(FILEINFO_MIME_TYPE);
        $file_mime_type = finfo_file($file_info, $file_tmp);

        if (!in_array($file_mime_type, $allowed_types)) {
            echo "Only JPEG, JPG, and PNG files are allowed.";
            exit();
        }

        // Move the uploaded file to the desired directory
        $destination = "../thumbnails/" . $file_name; // Adjust the destination directory as needed
        move_uploaded_file($file_tmp, $destination);

        // SQL query to update the photo file name in the database
        $sql = "UPDATE courses SET thumbnail='$file_name' WHERE course_id='$course_id'";

        if (mysqli_query($connection, $sql) === TRUE) {
            echo "Thumbnail updated successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . $connection->error;
        }
    } else {
        echo "Error uploading the Thumbnail.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Thumbnail</title>
</head>
<body>
<div class="header">
    <a href="admin.php">Home</a>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <button type="submit" name="logout">Logout</button>
    </form>
</div>

<div class="container">
    <h2>Update Video Thumbnail</h2>
    <a href="viewvideo.php">All Videos</a>
    <div class="cards">
        <div class="card">
            <form action="updatethumbnail.php" method="post" class="form" enctype="multipart/form-data">
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

                <div class="input-box">
                    <label for="picture">Update your course Thumbnail</label>
                    <input type="file" id="picture" name="picture" accept=".jpeg, .jpg, .png" required />
                    <button type="submit" name="register">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>