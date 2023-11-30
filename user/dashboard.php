<?php
include("userdashheader.php");
?>


    <!-- Bottom Navigator -->
    <section id="bottom">
        <div class="bottom-nav flex s-center items-center">
            <ul class="flex s-around items-center">
                <a href="#home">
                    <li class="bottomo-hover flex s-center items-center"><i class="fa-solid fa-house"></i></li>
                </a>
                <a href="#about">
                    <li class="bottomo-hover flex s-center items-center"><i class="fa-solid fa-user"></i></li>
                </a>
                <a href="#skills">
                    <li class="bottomo-hover flex s-center items-center"><i class="fa-solid fa-code"></i></li>
                </a>
                <a href="#top courses">
                    <li class="bottomo-hover flex s-center items-center">
                        <i class="fa-solid fa-rocket"></i>
                    </li>
                </a>
            </ul>
        </div>
    </section>

    

 
    <!-- Add a container for the courses grid -->
<div class="courses-grid">
<h1 class=" t-center my-2 t-white f-2">Top Courses</h1>
    <!-- Loop through your courses and generate the course items -->
    <?php
$sql = "SELECT * FROM courses";
$result = $connection->query($sql);

if ($result) {
    // Initialize an array to store course data
    $courses = array();

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
                $course_review_count = 0; // Fixed variable name
                $course_average_rating = 0.0; // Fixed variable name
            }

            // Store course data in the array
            $courses[] = array(
                'courseId' => $courseId,
                'courseName' => $courseName,
                'courseDescription' => $courseDescription,
                'courseAverageRating' => $course_average_rating,
                'courseReviewCount' => $course_review_count
            );
        }
    }

    // Sort the courses array by average rating in descending order
    usort($courses, function($a, $b) {
        return $b['courseAverageRating'] - $a['courseAverageRating'];
    });

    // Display the top 3 courses in the desired format
    for ($i = 0; $i < min(3, count($courses)); $i++) {
        echo '<div class="courses-item flex f-col s-center items-center">';
        echo '<div class="image-container p-one">';
        echo '<img src="./Images/weatherApp.png" alt="">'; // You may want to replace this with the actual course image
        echo '</div>';
        echo "<h1 class='t-white poppins'>" . $courses[$i]['courseName'] . "</h1>";
        echo "<p class='t-white poppins'>" . $courses[$i]['courseDescription'] . "</p>";
        echo "<div class='rating'><p class='t-white poppins'>" . $courses[$i]['courseAverageRating'] . "/5</p></div>";
        echo "<p class='t-white poppins'>Total Reviews: " . $courses[$i]['courseReviewCount'] . "</p>";
        echo '<div class="buttons flex s-around">';
        echo "<a href='videoplayer.php?course_id=" . $courses[$i]['courseId'] . "' class='btn mx-1 m-top' id='view" . $courses[$i]['courseId'] . "'>View</a>";
        echo "<a href='signin.php' class='btn m-top live' id='save" . $courses[$i]['courseId'] . "'>Save</a>";
        echo '</div>';
        echo '</div>';
    }
} else {
    // Handle the case where fetching courses from the database fails
    echo "Error: Unable to fetch courses from the database.";
}
?>


</div>


    <!-- courses Section -->
    <section id="courses">
        <h1 class=" t-center my-2 t-white f-2">Courses</h1>
        <div class="courses-container flex s-center">

            <div class="courses-item flex f-col s-center items-center">
                <div class="image-container p-one">
                    <img src="./Images/weatherApp.png" alt="">
                </div>
                <h1 class="t-white poppins">Course 4</h1>
                <p class="t-white poppins">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                <div class="rating">
                    <p class="rating-text">Rating: <span class="rating-value">4/5</span></p>
                </div>
                <div class="buttons flex s-around">
                    <a href="#" target="_blank" class="btn mx-1 m-top" id="view1">View</a>
                    <a href="#" class="btn m-top live" id="save1">Save</a>
                </div>
            </div>


            <div class="courses-item flex f-col s-center items-center">
                <div class="image-container p-one">
                    <img src="./Images/weatherApp.png" alt="">
                </div>
                <h1 class="t-white poppins">Course 5</h1>
                <p class="t-white poppins">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                <div class="rating">
                    <p class="rating-text">Rating: <span class="rating-value">4/5</span></p>
                </div>
                <div class="buttons flex s-around">
                    <a href="#" target="_blank" class="btn mx-1 m-top" id="view1">View</a>
                    <a href="#" class="btn m-top live" id="save1">Save</a>
                </div>
            </div>


            <div class="courses-item flex f-col s-center items-center">
                <div class="image-container p-one">
                    <img src="./Images/weatherApp.png" alt="">
                </div>
                <h1 class="t-white poppins">Course 6</h1>
                <p class="t-white poppins">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                <div class="rating">
                    <p class="rating-text">Rating: <span class="rating-value">4/5</span></p>
                </div>
                <div class="buttons flex s-around">
                    <a href="#" target="_blank" class="btn mx-1 m-top" id="view1">View</a>
                    <a href="#" class="btn m-top live" id="save1">Save</a>
                </div>
            </div>


            <div class="courses-item flex f-col s-center items-center">
                <div class="image-container p-one">
                    <img src="./Images/weatherApp.png" alt="">
                </div>
                <h1 class="t-white poppins">Course 7</h1>
                <p class="t-white poppins">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                <div class="rating">
                    <p class="rating-text">Rating: <span class="rating-value">4/5</span></p>
                </div>
                <div class="buttons flex s-around">
                    <a href="#" target="_blank" class="btn mx-1 m-top" id="view1">View</a>
                    <a href="#" class="btn m-top live" id="save1">Save</a>
                </div>
            </div>

            <div class="courses-item flex f-col s-center items-center">
                <div class="image-container p-one">
                    <img src="./Images/weatherApp.png" alt="">
                </div>
                <h1 class="t-white poppins">Course 8</h1>
                <p class="t-white poppins">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                <div class="rating">
                    <p class="rating-text">Rating: <span class="rating-value">4/5</span></p>
                </div>
                <div class="buttons flex s-around">
                    <a href="#" target="_blank" class="btn mx-1 m-top" id="view1">View</a>
                    <a href="#" class="btn m-top live" id="save1">Save</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer Section -->
    <footer id="footer">
        <ul class="flex s-center w-80 m-auto my-2 res">
            <li><a href="#home" class="poppinss">Home</a></li>
            <li><a href="#signup" class="poppinss">Sign up</a></li>
            <li><a href="#signin" class="poppinss">Sign In</a></li>
            <li><a href="#courses" class="poppinss">Courses</a></li>
            <li><a href="#about" class="poppinss">About</a></li>
        </ul>
        <ul class="flex s-center w-80 font-awesome ">
            <a href="https://in.linkedin.com/" target="_blank">
                <li><i class="fa-brands fa-linkedin-in"></i></li>
            </a>
            <a href="https://github.com/" target="_blank">
                <li><i class="fa-brands fa-github"></i></li>
            </a>
            <a href="https://www.instagram.com/" target="_blank">
                <li><i class="fa-brands fa-instagram"></i></li>
            </a>
            <a href="https://www.youtube.com/" target="_blank">
                <li><i class="fa-brands fa-youtube"></i></li>
            </a>
        </ul>
        <p class="t-center my-2 poppins">&copy; All Rights Reserved - <span class="cpy-white poppins">Yukti</span></p>
    
    </footer>


</body>
<script src="/script.js"></script>
</body>
</html>
