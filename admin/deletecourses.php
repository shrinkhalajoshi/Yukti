<?php
$connection = new mysqli("localhost", "root", "", "sva");
if ($connection->connect_errno != 0) {
    die("Database Connectivity Error");
}

if (isset($_POST['course_delete'])) {
    $course_id = mysqli_real_escape_string($connection, $_POST['course_delete']);

    // Delete course
    $delete_query = "DELETE FROM `courses` WHERE `course_id`='$course_id'";
    $result = $connection->query($delete_query);

    if ($result) {
        // Redirect to admin.php after successful deletion
        header("Location: admin.php");
    } else {
        echo "Error: " . $connection->error;
    }
} else {
    // If the page is accessed without a proper POST request, redirect to admin.php
    header("Location: admin.php");
}
?>
