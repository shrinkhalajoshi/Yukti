<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Yukti: An online learning platform</title>
    <link rel="icon" type="image/x-icon" href="./Images/favicon.png">
        <style>
        /* Style for the message */
        .no-matches-message 
        {
            background-color: #f7f7f7; /* Background color */
            border: 1px solid #ddd; /* Border */
            padding: 10px; /* Padding around the message */
            text-align: center; /* Center-align the text */
            margin-top: 20px; /* Spacing from the content above */
            font-size: 16px; /* Font size */
            color: #333; /* Text color */
            font-weight: bold; /* Bold text */
        }
        </style>
    <link rel="stylesheet" href="mycss/home.css">
    <link rel="stylesheet" media="screen and (max-width: 821px)" href="responsive.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>
<body>

    <!-- Navbar Section -->
    <nav id="navbar" class="flex s-around bg-color">
        <div class="left-nav">
            <h2 class="t-white">Yukti</h2>
        </div>
                
    <div class="right-nav">
        <ul class="flex">
            <li><a href="#home" class="t-white roboto">Home</a></li>
            <li><a href="signup.php" class="t-white roboto">Sign Up</a></li> <!-- Updated link to "signup.html" -->
            <li><a href="signin.php" class="t-white roboto">Sign In</a></li> <!-- Updated link to "signin.html" -->
            <li><a href="#courses" class="t-white roboto">Courses</a></li>
        </ul>
    </div>
    </nav>


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

    <!-- Home Section -->
    <section id="home" class="flex s-around sw-80 m-auto">
        <div class="home-left flex items-center">
            <div class="home-content">
                <h6 class="poppinss">Yukti</h6>
                <h1 class="t-white">An online Learning Platform</h1>
                <h4 class="poppinss">Explore your Creativity with courses in Nepali</h4>
                <div class="search-bar">
                    <form action="search.php" method="post">
                    <input type="text" placeholder="Search..." name="keyword"class="search-input">
                    <button type="submit" name="searchhere" class="search-btn"><i class="fa-solid fa-search"></i></button>
                    </form>
                </div>
                
            </div>
        </div>
       
    </section>

    <?php
    include("db.php");
    if(isset($_POST['search']))
    {
        $keyword = $_POST['keyword'];
        $result = $connection->query("SELECT * FROM courses WHERE course_name LIKE '%$keyword%'");
    
        if ($result && $result->num_rows > 0) 
        {
            while ($row = $result->fetch_assoc()) 
            {
                $courseId = $row['course_id'];
                $courseName = $row['course_name'];
                $courseDescription = $row['course_description'];
    
                // Generate HTML for each course
                echo '<div class="courses-item flex f-col s-center items-center">';
                echo '<div class="image-container p-one">';
                echo '<img src="./Images/weatherApp.png" alt="">'; // You may want to replace this with the actual course image
                echo '</div>';
                echo "<h1 class='t-white poppins'>$courseName</h1>";
                echo "<p class='t-white poppins'>$courseDescription</p>";
                echo '<div class="rating">';
                echo '</div>';
                echo '<div class="buttons flex s-around">';
                echo "<a href='#' target='_blank' class='btn mx-1 m-top' id='view$courseId'>View</a>";
                echo "<a href='#' class='btn m-top live' id='save$courseId'>Save</a>";
                echo '</div>';
                echo '</div>';
            }
        } 
        else 
        {
            // No matches found, display a message with CSS
            echo '<div class="no-matches-message">No matches found for ' .$keyword.'</div>';
        }
    }
    if(isset($_POST['searchhere']))
    {
        $keyword = $_POST['keyword'];
        $result = $connection->query("SELECT * FROM courses WHERE course_name LIKE '%$keyword%'");
    
        if ($result && $result->num_rows > 0) 
        {
            while ($row = $result->fetch_assoc()) 
            {
                $courseId = $row['course_id'];
                $courseName = $row['course_name'];
                $courseDescription = $row['course_description'];
    
                // Generate HTML for each course
                echo '<div class="courses-item flex f-col s-center items-center">';
                echo '<div class="image-container p-one">';
                echo '<img src="./Images/weatherApp.png" alt="">'; // You may want to replace this with the actual course image
                echo '</div>';
                echo "<h1 class='t-white poppins'>$courseName</h1>";
                echo "<p class='t-white poppins'>$courseDescription</p>";
                echo '<div class="rating">';
                echo '</div>';
                echo '<div class="buttons flex s-around">';
                echo "<a href='#' target='_blank' class='btn mx-1 m-top' id='view$courseId'>View</a>";
                echo "<a href='#' class='btn m-top live' id='save$courseId'>Save</a>";
                echo '</div>';
                echo '</div>';
            }
        } 
        else 
        {
            // No matches found, display a message with CSS
            echo '<div class="no-matches-message">No matches found for ' .$keyword.'</div>';
        }
    }
    ?>

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

    <div id="scroll-top" onclick="scrolltop()">
        <span><i class="fa-solid fa-arrow-up"></i></span>
    </div>

</body>

<script src="myjs/script.js"></script>





</body>
</html>
