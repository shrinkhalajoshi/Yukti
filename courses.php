<?php
include("db.php");
// Fetch all courses from the 'courses' table
$sql = "SELECT * FROM `courses`";
$result = $connection->query($sql);

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $courseId = $row['course_id'];
        $courseName = $row['course_name'];
        $courseDescription = $row['course_description'];
        //$courseRating = $row['course_rating'];

        // Generate HTML for each course
        echo '<div class="courses-item flex f-col s-center items-center">';
        echo '<div class="image-container p-one">';
echo '<img src="thumbnails/' . $row['thumbnail'] . '" width="280px" alt="">';
echo '</div>';

        echo "<h1 class='t-white poppins'>$courseName</h1>";
        echo "<p class='t-white poppins'>$courseDescription</p>";
        echo '<div class="rating">';
       // echo "<p class='rating-text'>Rating: <span class='rating-value'>$courseRating/5</span></p>";
        echo '</div>';
        echo '<div class="buttons flex s-around">';
        echo "<a href='signin.php' class='btn mx-1 m-top' id='view$courseId'>View</a>";
        echo "<a href='signin.php' class='btn m-top live' id='save$courseId'>Save</a>";
        echo '</div>';
        echo '</div>';
    }
} else {
    // Handle the case where fetching courses from the database fails
    echo "Error: Unable to fetch courses from the database.";
}
?>
