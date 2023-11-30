<?php
$connection = new mysqli("localhost", "root", "", "sva");
if ($connection->connect_errno != 0) {
    die("Database Connectivity Error");
}

if (isset($_POST['delete'])) {
    $video_id = mysqli_real_escape_string($connection, $_POST['video_delete']);

    // Delete course
    $delete_query = "DELETE FROM `videos` WHERE `video_id`='$video_id'";
    $result = $connection->query($delete_query);

    if ($result) {
        // Redirect to admin.php after successful deletion
        header("Location:viewvideo.php");
    } else {
        echo "Error: " . $connection->error;
    }
} else {
    // If the page is accessed without a proper POST request, redirect to admin.php
    header("Location:viewvideo.php");
}
?>
