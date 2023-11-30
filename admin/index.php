<?php
if(isset($_POST['login']))
{
  $email=$_POST['email']; // name collect garne variable
  $password=md5($_POST['password']);// password collect garne variable
        // Connection ko variable
        $connection= new mysqli("localhost","root","","sva");
        // Checking Database Connection
        if($connection->connect_errno!=0)
        // 0 means connected 
        {
            die("Database Connectivity Error");
        }

        // comparision qeury using select
        //user ko table databse sanga
        $sql="SELECT * FROM `admin` WHERE admin_email='$email' AND admin_password='$password'";
        $result=$connection->query($sql);// query execution
        if($result->num_rows>0)// data match bako xa bane
        {
          // session start after login
          session_start();

          // table ma bako data extract gareko adminlist table bata
         $row=$result->fetch_assoc();

           // tes lai $_Session ma store gareko
         $_SESSION['admin']=$row;

          // redirecting to  user dashboard page after login is successful with session
          header("Location:admin.php");
        }
        else // data match bako xaina bane
        {
          echo("<script> alert(' $email, $password Wrong Email Or Password ');</script>");
        }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign In</title>
    <style>
      body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
      }
      .header {
        background-color: #007bff;
        color: #fff;
        display: flex;
        justify-content: space-between;
        padding: 10px 20px;
      }
      .header a {
        color: #fff;
        text-decoration: none;
      }
      .container {
        width: 300px;
        margin: 20px auto;
        padding: 20px;
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      }
      .container h2 {
        text-align: center;
      }
      .container label {
        display: block;
        margin-bottom: 5px;
      }
      .container input[type="text"],
      .container input[type="password"] {
        width: 93%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 3px;
      }
      .container button[type="submit"] {
        width: 100%;
        padding: 10px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 3px;
        cursor: pointer;
      }
      .container button[type="submit"]:hover {
        background-color: #0056b3;
      }
    </style> 
  </head>
  <body>
    <div class="header">
      <a href="home.php">Home</a>
    </div>

    <div class="container">
      <h2>Sign In</h2>
      <form id="signin-form" action="index.php" method="post">
        <label for="username">Admin Email:</label>
        <input type="text" id="username" name="email" required />

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required />

        <button type="submit" name="login">Log In</button>
      </form>
    </div>
  </body>
</html>