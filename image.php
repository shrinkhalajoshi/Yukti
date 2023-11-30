<div class="cards">
    <div class="card">
        <form action="view_parents_profile.php" method="post" class="form" enctype="multipart/form-data">
            <div class="input-box">
                <label for="profile">Update your profile photo (JPEG, JPG, PNG, minimum size: 100x100 pixels)</label>
                <input type="file" id="profile" name="profile" accept=".jpeg, .jpg, .png" required />
                <input type="hidden" name="uemail" value="<?php echo $email;?>">
                <button type="submit" name="register">Submit</button>
            </div>
        </form>
    </div>
</div>
if (isset($_POST['register'])) {
    // Collect data from the form
    $email = $_POST['uemail'];

    // Check if a file was uploaded
    if ($_FILES['profile']['error'] === UPLOAD_ERR_OK) 
    {
        $file = $_FILES['profile'];
        $file_name = $file['name'];
        $file_tmp = $file['tmp_name'];

        // Check file type
        $allowed_types = ['image/jpeg', 'image/jpg', 'image/png'];
        $file_info = finfo_open(FILEINFO_MIME_TYPE);
        $file_mime_type = finfo_file($file_info, $file_tmp);

        if (!in_array($file_mime_type, $allowed_types)) {
            echo "Only JPEG, JPG, and PNG files are allowed.";
            exit();
        }

       

        // Move the uploaded file to the desired directory
        $destination = "../uploads/" . $file_name; // Adjust the destination directory as needed
        move_uploaded_file($file_tmp, $destination);

        // SQL query to update the photo file name in the database
        $sql = "UPDATE parent_profile SET photo='$file_name' WHERE email='$email'";

        if (mysqli_query($connection, $sql) === TRUE) {
            echo "Profile photo updated successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . $connection->error;
        }
    } 
    else {
        echo "Error uploading the profile photo.";
    }
}
