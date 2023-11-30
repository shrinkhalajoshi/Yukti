<?php
include("../db.php");
session_start(); 
if(!isset($_SESSION['user'])) {
header("Location:../index.php"); 
}
$row=$_SESSION['user']; 
$email=$row['email'];
$user_id=$row['user_id'];
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
    <title> Yukti: An online learning platform</title>
    <link rel="icon" type="image/x-icon" href="./Images/favicon.png">
    <link rel="stylesheet" href="../mycss/userdashboard.css">
    <link rel="stylesheet" media="screen and (max-width: 821px)" href="../mycss/responsive.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
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
</head>
<body>

     <!-- Navbar Section -->
 <nav id="navbar" class="flex s-around bg-color">
    <div class="left-nav">
        <h2 class="t-white">Yukti</h2>
    </div>
            
<div class="right-nav">
    <ul class="flex">
        <li><a href="dashboard.php" class="t-white roboto"><?php echo $fullName;?></a></li>
        <li><a href="allcourses.php" class="t-white roboto">Courses</a></li>
        <li><a href="savedcourses.html" class="t-white roboto">Saved Courses</a></li> <!-- Updated link to "signup.html" -->
        <li>
            <form id="signin-form" action="dashboard.php"  method="post">
                <button type="submit" class="search-btn" name="signout"><i class="fa fa-sign-out" aria-hidden="true"></i></button>
            </form>
        </li> 
    </ul>
</div>
</nav>