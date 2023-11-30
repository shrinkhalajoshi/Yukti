<?php
include("../db.php");
session_start(); 
if(!isset($_SESSION['user'])) {
    header("Location:../index.php"); 
}
$row=$_SESSION['user']; 
$email=$row['email'];
$fullName=$row['fullName']; 

if(isset($_POST['signout'])){
    session_destroy();
    header("Location:../index.php");
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yukti: An online learning platform</title>
    <link rel="icon" type="image/x-icon" href="./Images/favicon.png">
    <link rel="stylesheet" href="../mycss/userdashboard.css">
    <link rel="stylesheet" media="screen and (max-width: 821px)" href="../mycss/responsive.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@500&family=Ubuntu:wght@300;500;700&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300&family=Roboto:wght@500&family=Ubuntu:wght@300;500;700&display=swap');

        /* Your CSS styles here */
        body {
            font-family: 'Ubuntu', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            scroll-behavior: smooth;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
            color: #1F1F38;
        }

        h3 {
            color: #1F1F38;
        }

        #header {
            background-color: #1F1F38;
            color: #fff;
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        #header-left {
            display: flex;
            align-items: center;
        }

        #header a {
            color: #fff;
            text-decoration: none;
            margin-right: 10px;
        }

        #video-container {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 20px;
            padding: 20px;
            border-radius: 5px;
        }

        #episode-list {
            width: 25%;
            padding: 10px;
        }

        #episode-list ul {
            list-style-type: none;
            padding: 0;
        }

        #episode-list h2 {
            color: #1F1F38;
        }

        #episode-list li {
            color: white;
            cursor: pointer;
            padding: 10px;
            border-radius: 3px;
            background-color: #1F1F38;
            margin: 5px 0;
            transition: background-color 0.3s;
            font-size: 18px; /* Increase the font size */
        }

        #episode-player h2 {
            color: #1F1F38;
            font-size: 24px; /* Increase the font size */
        }

        #episode-list li:hover {
            background-color: #ddd;
        }
        
        #episode-list ul {
            list-style-type: none;
            padding: 0;
        }
        #episode-list li {
            color: white;
            cursor: pointer;
            padding: 10px;
            border-radius: 3px;
            background-color: #1F1F38;
            margin: 5px 0;
            transition: background-color 0.3s;
        }

        #episode-list li:hover {
            background-color: #ddd;
        }
        
        #video-player {
            width: 70%;
            margin-left: 20px;
        }

        #video-player h2 {
            color: #1F1F38;
            font-size: 24px; /* Increase the font size */
            margin-bottom: 20px; /* Add a margin at the bottom for the gap */
        }

        #episode-video {
            width: 100%;
        }

        .rate-button {
            background-color: #1F1F38;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }

        

        #rate-course-container {
            margin-top: 20px; /* Add top margin to create space */
            margin-bottom: 20px;
            text-align: center;

        /* Styling for the navbar */
        #navbar {
            background-color: #1F1F38;
            color: #fff;
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .left-nav h2 {
            color: #fff;
        }

        .right-nav ul {
            list-style-type: none;
            padding: 0;
            display: flex;
        }

        .right-nav li {
            margin-right: 20px;
        }

        .right-nav a {
            text-decoration: none;
            color: #fff;
        }

        .search-btn {
            background-color: transparent;
            border: none;
            cursor: pointer;
        }

        /* Additional CSS for responsive design */
        @media screen and (max-width: 821px) {
            /* Add responsive styles here */
            h1 {
                font-size: 24px;
            }

            #video-container {
                flex-direction: column;
            }

            #episode-list {
                width: 100%;
                margin-top: 20px;
            }

            #video-player {
                width: 100%;
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav id="navbar" class="flex s-around bg-color">
        <div class="left-nav">
            <h2 class="t-white">Yukti</h2>
        </div>
                
        <div class="right-nav">
            <ul class="flex">
                <li><a href="dashboard.php" class="t-white roboto"><?php echo $fullName;?></a></li>
                <li><a href="allcourses.php" class="t-white roboto">Courses</a></li>
                <li><a href="savedcourses.html" class="t-white roboto">Saved Courses</a></li>
                <li>
                    <form id="signin-form" action="dashboard.php" method="post">
                        <button type="submit" class="search-btn" name="signout"><i class="fa fa-sign-out" aria-hidden="true"></i></button>
                    </form>
                </li> 
            </ul>
        </div>
    </nav>
    
    <?php
    if (isset($_GET['course_id'])) {
        $select_course_id = $_GET['course_id'];
        $namesql = "SELECT course_name FROM `videos` NATURAL JOIN courses WHERE courses.course_id='$select_course_id' ORDER BY episode_no ASC LIMIT 1";
        $videosql = "SELECT * FROM `videos` NATURAL JOIN courses WHERE courses.course_id='$select_course_id' ORDER BY episode_no ASC";
        $videos = mysqli_query($connection, $videosql);
        $names = mysqli_query($connection, $namesql);
        
        if (mysqli_num_rows($videos)>0) {
            
              if ($names) {
                while ($name = $names->fetch_assoc()) {
                    
                    echo '<h1>' . $name["course_name"] . '</h1>';
                    /*echo ('<form action="ratecourses.php" method="post">
                    <input type="hidden" name="course_id" value="' . $_GET['course_id'] . '">
                    <button class="rate-button" type="submit" name="rate">Rate Course</button>
                    </form>');*/
                }
            } 
                echo '<div id="video-container">';
                echo '<div id="episode-list">
                    <h3>Episodes</h3>
                    <ul>';
            while ($video = $videos->fetch_assoc()) {
                echo '<li data-video-path="' . $video['video_file_path'] . '" data-episode-name="' . $video['title'] . '">Episode ' . $video['episode_no'] . ': ' . $video['title'] . '</li>';
            }
            echo 
            '</ul>
                </div>';


            echo '<div id="video-player">
                    <h2>Episode Name:</h2>
                    <video id="episode-video" controls>
                        <source src="" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>';
            echo '</div>';

            echo '<div id="rate-course-container">
                <p>Completed the course? Rate it now</p>
                <form action="ratecourses.php" method="post">
                <input type="hidden" name="course_id" value="' . $_GET['course_id'] . '">
                    <button class="rate-button" type="submit" name="rate">Rate Course</button>
                </form>
            </div>';
            echo '</div>';

        } else {
            echo "No videos found for this course.";
        }
    } else {
        echo "See our Course Here";
    }
    ?>
    
    <script>
        const episodeList = document.querySelectorAll("#episode-list li");
        const videoPlayer = document.querySelector("#episode-video");
        const episodeName = document.querySelector("#video-player h2");

        // Function to load and play an episode
        function loadEpisode(episode) {
            episodeName.textContent = episode.getAttribute("data-episode-name");
            videoPlayer.src = episode.getAttribute("data-video-path");
            videoPlayer.load(); // Load the new video source
            videoPlayer.play(); // Play the video
        }

        // Add click event listeners to episode list items
        episodeList.forEach((episode) => {
            episode.addEventListener("click", () => {
                loadEpisode(episode);
            });
        });

        // Load the first episode by default
        if (episodeList.length > 0) {
            loadEpisode(episodeList[0]);
        }
    </script>
</body>
</html>
