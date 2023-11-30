<?php
include("userdashheader.php");
?>

<style>
    /* Style for the grid container */
    .courses-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); /* Create a responsive grid with minimum 300px width for each column */
        gap: 30px; /* Increased spacing between grid items */
        justify-items: center; /* Center-align grid items horizontally */
    }

    /* Style for each course item */
    .courses-item {
        background-color: #2C2C6C; /* Updated main color theme */
        border-radius: 5px; /* Add some border radius for a card-like appearance */
        padding: 20px;
        text-align: center;
        font-size: 16px;
        color: #fff; /* Text color set to white for better visibility */
    }

    /* Style for the course image */
    .image-container img {
        max-width: 100%;
        height: auto; /* Maintain image aspect ratio */
    }
</style>

<!-- Add a container for the courses grid -->
<div class="courses-grid">
    <!-- Loop through your courses and generate the course items -->
    <?php
$sql = "SELECT * FROM courses";
$result = $connection->query($sql);

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $courseId = $row['course_id'];
        $courseName = $row['course_name'];
        $courseDescription = $row['course_description'];
        $course_ratings = array(); // array initialization
        $course_rating_query = "SELECT rating FROM reviews WHERE course_id = '$courseId'"; // Correct variable name
        
        // Main Algorithm Code
        $course_rating_data = $connection->query($course_rating_query);
        if ($course_rating_data) {
            while ($course_rating_row = $course_rating_data->fetch_assoc()) {
                $course_ratings[] = $course_rating_row['rating']; // Store each rating in the array
            }
            if (count($course_ratings) > 0) {
                $course_review_count = count($course_ratings);
                $course_average_rating = array_sum($course_ratings) / count($course_ratings);
            } else {
                $course_review_count = "0.0";
                $course_average_rating = "0.0"; // Fixed variable name
            }
        }
        
        // Inside your PHP loop that fetches courses
        echo '<div class="courses-item flex f-col s-center items-center">';
        echo '<div class="image-container p-one">';
        echo '<img src="./Images/weatherApp.png" alt="">'; // You may want to replace this with the actual course image
        echo '</div>';
        echo "<h1 class='t-white poppins'>$courseName</h1>";
        echo "<p class='t-white poppins'>$courseDescription</p>";
        echo "<div class='rating'><p class='t-white poppins'>" . $course_average_rating . "/5</p></div>";
        echo "<p class='t-white poppins'>Total Reviews: $course_review_count</p>";
        echo '<div class="buttons flex s-around">';
        echo "<a href='videoplayer.php?course_id=$courseId' class='btn mx-1 m-top' id='view$courseId'>View</a>";
        echo "<a href='signin.php' class='btn m-top live' id='save$courseId'>Save</a>";
        echo '</div>';
        echo '</div>';
    }
} else {
    // Handle the case where fetching courses from the database fails
    echo "Error: Unable to fetch courses from the database.";
}
?>

</div>

<?php
include("footer.php");
?>