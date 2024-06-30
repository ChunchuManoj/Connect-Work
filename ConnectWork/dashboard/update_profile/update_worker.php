<?php
// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "user");
session_start();

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if a file was uploaded
    if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] == UPLOAD_ERR_OK) {
        // Handle file upload
        $target_dir = "../../Worker_Signup/uploads/";
        $imageFileType = strtolower(pathinfo($_FILES["profile_pic"]["name"], PATHINFO_EXTENSION));
        $uploadOk = 1;

        // Generate a unique file name
        $newFileName = uniqid() . '.' . $imageFileType;
        $target_file = $target_dir . $newFileName;

        // Check if file is an image
        $check = getimagesize($_FILES["profile_pic"]["tmp_name"]);
        if ($check === false) {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "File already exists.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["profile_pic"]["size"] > 500000) {
            echo "File is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if (!in_array($imageFileType, ["jpg", "jpeg", "png", "gif"])) {
            echo "Only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // If everything is ok, try to upload file
        if ($uploadOk) {
            if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $target_file)) {
                echo "The file " . htmlspecialchars(basename($_FILES["profile_pic"]["name"])) . " has been uploaded.";
                $profile_pic = $newFileName;
            } else {
                echo "An error occurred during upload.";
                $uploadOk = 0;
            }
        } else {
            $profile_pic = $_SESSION['user']['profile_pic'];
        }
    } else {
        // If no file was uploaded, use the existing profile picture from the session
        $profile_pic = $_SESSION['user']['profile_pic'];
    }

    if (isset($profile_pic)) {
        // Get the form data
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $mobile_number = $_POST['mobile_number'];
        $address = $_POST['address'];
        $area = $_POST['area'];
        $pin_code = $_POST['pin_code'];
        $field = $_POST['work_field'];
        $work_experience = $_POST['work_experience'];
        $latitude = $_POST['latitude'];
        $longitude = $_POST['longitude'];

        // Update the database
        $sql = "UPDATE workers SET profile_pic = ?, full_name = ?, username = ?, mobile_number = ?, address = ?, area = ?, pin_code = ?, field = ?, work_experience = ?, latitude = ?, longitude = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sssssssssssi", $profile_pic, $full_name, $username, $mobile_number, $address, $area, $pin_code, $field, $work_experience, $latitude, $longitude, $_SESSION['user']['id']);
        if (mysqli_stmt_execute($stmt)) {
            echo "Profile updated successfully.";
        } else {
            echo "Error updating profile: " . mysqli_error($conn);
        }

        // Close the database connection
        mysqli_close($conn);

        // Redirect back to the form or another page
        // header("Location: ../dashboard/workers_list.php");
    }
}
?>
