<?php
include("db.php");

$fullNameError = $emailError = $phoneError = $passwordError = $confirmPasswordError = $termsCheckboxError = "";
$isValid = true;

// Check if the form is submitted
if (isset($_POST['register'])) {
    // Retrieve user input from the form
     $fullName = $_POST['fullName'];
     $email = $_POST['email'];
     $phone = $_POST['phone'];
     $password = md5($_POST['password']); // MD5 Hash the password for security
     $confirmPassword = md5($_POST['confirmPassword']);
     $termsCheckbox = isset($_POST['termsCheckbox']);


    
    if ($fullName === "") {
        $fullNameError = "Full Name is required";
        $isValid = false;
    } else if (!isValidFullName($fullName)) {
        $fullNameError = "Full Name should not contain numbers or special characters";
        $isValid = false;
    }

    // Validation for Email
    if (!isValidEmail($email)) {
        $emailError = "Invalid Email address";
        $isValid = false;
    }

    // Validation for Phone Number
    if (!isValidPhone($phone)) {
        $phoneError = "Invalid Phone Number";
        $isValid = false;
    }

    // Validation for Password
    if (strlen($password) < 6) {
        $passwordError = "Password must be at least 6 characters long";
        $isValid = false;
    }

    // Validation for Confirm Password
    if ($password !== $confirmPassword) {
        $confirmPasswordError = "Passwords do not match";
        $isValid = false;
    }

    // Validation for Terms Checkbox
    if (!$termsCheckbox) {
        $termsCheckboxError = "You must accept the terms of use and privacy policy";
        $isValid = false;
    }

    // If isValid is still true, it means all validations passed
    if ($isValid) {
        // Check if the user already exists based on the email
        $checkUserSql = "SELECT `user_id` FROM `user` WHERE `email` = '$email'";
        $checkUserStmt = $connection->query($checkUserSql);

        if (mysqli_num_rows($checkUserStmt)>0) {
            // User with this email already exists, handle accordingly (e.g., display an error message)
            $emailError = "User with this email already exists.";
        } else {
            // Insert user data into the 'user' table
            $insertUserSql = "INSERT INTO `user` (`fullName`, `email`, `phone`, `password`) 
            VALUES ('$fullName','$email','$phone','$password')";
            $insertUserStmt = $connection->query($insertUserSql);

            if ($insertUserStmt) {
                header("Location:signin.php");
            } else {
                // Insertion failed, handle the error (e.g., display an error message)
                echo "Error: " . $insertUserStmt->errorInfo()[2];
            }
        }
    }
}

function isValidFullName($fullName) {
    $nameRegex = "/^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$/";
    return preg_match($nameRegex, $fullName);
}

function isValidEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function isValidPhone($phone) {
    return preg_match("/^\d{10}$/", $phone);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
        .header {
            width: 100%;
            background-color: #1F1F38;
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
            width: 400px;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px; /* Added margin to create space */
        }
        .container h2 {
            text-align: center;
        }
        .container label {
            display: block;
            margin-bottom: 5px;
        }
        .container input[type="text"],
        .container input[type="email"],
        .container input[type="tel"],
        .container input[type="password"] {
            width: 94%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        .container label.checkbox {
            display: flex;
            align-items: center;
        }
        .container input[type="checkbox"] {
            margin-right: 5px;
        }
        .container .error {
            color: red;
        }
        .container button[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #1F1F38;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        .container button[type="submit"]:hover {
            background-color: #1F1F38;
        }
    </style>
</head>
<body>
    <div class="header">
        <a href="Home.html">Home</a>
        <a href="SignIn.html">Sign In</a>
    </div>
    
    <div class="container">
        <h2>Sign Up</h2>
        <form id="signup-form" action="signup.php" method="post">
            <label for="fullName">Full Name:</label>
            <input type="text" id="fullName" name="fullName" value="<?php if(isset($_POST['register'])){echo $fullName;}?>"required>
            <div class="error" id="fullNameError"><?php echo $fullNameError; ?></div>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php if(isset($_POST['register'])){echo $email;}?>"required>
            <div class="error" id="emailError"><?php echo $emailError; ?></div>

            <label for="phone">Phone No:</label>
            <input type="tel" id="phone" name="phone" value="<?php if(isset($_POST['register'])){echo $phone;}?>" required>
            <div class="error" id="phoneError"><?php echo $phoneError; ?></div>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <div class="error" id="passwordError"><?php echo $passwordError; ?></div>

            <label for="confirmPassword">Confirm Password:</label>
            <input type="password" id="confirmPassword" name="confirmPassword" required>
            <div class="error" id="confirmPasswordError"><?php echo $confirmPasswordError; ?></div>

            <label class="checkbox" for="termsCheckbox">
                <input type="checkbox" id="termsCheckbox" name="termsCheckbox" required>
                I accept the terms of use and privacy policy
            </label>
            <div class="error" id="termsCheckboxError"><?php echo $termsCheckboxError; ?></div>

            <button type="submit" name="register">Sign Up</button>
        </form>
    </div>
</body>
</html>
