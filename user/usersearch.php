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
    <?php
    if (isset($_POST['usersearchhere'])) {
        $keyword = $_POST['keyword'];
        $result = $connection->query("SELECT * FROM courses WHERE course_name LIKE '%$keyword%'");
        
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $courseId = $row['course_id'];
                $courseName = $row['course_name'];
                $courseDescription = $row['course_description'];

                // Inside your PHP loop that fetches courses
                echo '<div class="courses-item flex f-col s-center items-center">';
                echo '<div class="image-container p-one">';
                echo '<img src="./Images/weatherApp.png" alt="">'; // You may want to replace this with the actual course image
                echo '</div>';
                echo "<h1 class='t-white poppins'>$courseName</h1>";
                echo "<p class='t-white poppins'>$courseDescription</p>";
                echo '<div class="rating"></div>';
                echo '<div class="buttons flex s-around">';
                echo "<a href='signin.php' class='btn mx-1 m-top' id='view$courseId'>View</a>";
                echo "<a href='signin.php' class='btn m-top live' id='save$courseId'>Save</a>";
                echo '</div>';
                echo '</div>';
            }
        } else {
            // No matches found, display a message with CSS
            echo '<div class="no-matches-message">No matches found for ' . $keyword . '</div>';
        }
    }
    ?>
</div>

<?php
include("footer.php");
?>
