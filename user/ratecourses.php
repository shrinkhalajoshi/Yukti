<?php
include("withoutsearch.php");
if(isset($_POST['user_rating_button']))
{
$user_comment = $_POST['user_comment'];
$user_rating = $_POST['user_rating'];
$rating_course_id = $_POST['rating_course_id'];
$check="SELECT * FROM reviews WHERE user_id='$user_id'AND course_id='$rating_course_id'";
$check_query=mysqli_query($connection,$check);
$rows=mysqli_num_rows($check_query);
if($rows>0)
{
    echo("<script>alert('you have already rated this event');</script>");
}
else
{
    $rating_sql = "INSERT INTO reviews(user_id, comment, rating, course_id)
    VALUES ('$user_id','$user_comment','$user_rating','$rating_course_id')";
    $query = mysqli_query($connection, $rating_sql);
    if($query)
{
    echo("<script>alert('Rated Successfully');</script>");
    header("Location:allcourses.php");
}
else
{
    echo("<script>alert('UnSuccessful');</script>");
}
}



}
?>
<div>
    <?php
    if(isset($_POST['rate'])) {
        $course_rate_id = $_POST['course_id'];
        $course_sql = "SELECT * FROM courses WHERE courses.course_id='$course_rate_id'";
        if($ratecourses = mysqli_query($connection, $course_sql)) 
        {
            $ratecourse = $ratecourses->fetch_assoc();
            echo("
            <form action='ratecourses.php' method='post'>
            <label>" . $ratecourse['course_name'] . "</label>
            <label>" . $ratecourse['course_category'] . "</label>
            <input type='number' min='1' max='5' name='user_rating'>
            <input type='hidden' value='$course_rate_id' name='rating_course_id'>
            <textarea name='user_comment'></textarea>
            <button type='submit' name='user_rating_button'>Rate</button>
                
            </form>
            ");
        }
    }
    ?>
</div>