<?php

// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "user");
session_start();
print_r($_SESSION['user']['id']);
// Check connection
if (!$conn) {
    die("Connection failed: ". mysqli_connect_error());
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Handle file upload
    $target_dir = "../../Worker_Signup/uploads/";
    $target_file = $target_dir. basename($_FILES["profile_pic"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if file is an image
    if(isset($_FILES['profile_pic']) && !empty($_FILES['profile_pic']['tmp_name'])){
    $check = getimagesize($_FILES["profile_pic"]["tmp_name"]);
    if ($check === false) {
        echo "File is not an image.";
        exit;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "File already exists.";
        exit;
    }

    // Check file size
    if ($_FILES["profile_pic"]["size"] > 500000) {
        echo "File is too large.";
        exit;
    }

    // Allow certain file formats
    if ($imageFileType!= "jpg" && $imageFileType!= "png" && $imageFileType!= "jpeg" && $imageFileType!= "gif") {
        echo "Only JPG, JPEG, PNG & GIF files are allowed.";
        exit;
    }

    // Move the uploaded file to the target directory
    if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $target_file)) {
        echo "The file ". basename($_FILES["profile_pic"]["name"]). " has been uploaded.";
        

        // header("Location:../dashboard/workers_list.php");
    } else {
        echo "An error occurred during upload.";
        exit;
    }
    } else{
        $profile_pic = $_SESSION['user']['profile_pic'];
    }
// Get the form data
// $profile_pic = isset($_FILES['profile_pic'])? $_FILES['profile_pic']['name'] : $_SESSION['user']['profile_pic'];
$profile_pic = basename($_FILES["profile_pic"]["name"]);
$full_name = $_POST['full_name'];
$username = $_POST['username'];
$mobile_number = $_POST['mobile_number'];
$area = $_POST['area'];
$pin_code = $_POST['pin_code'];


// Update the database
$sql = "UPDATE customers SET  profile_pic =?, full_name =?, username =?, mobile_number =?, area =?, pin_code =? WHERE id =?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "sssssds",  $profile_pic, $full_name, $username, $mobile_number, $area, $pin_code, $_SESSION['user']['id']);
mysqli_stmt_execute($stmt);

// Close the database connection
mysqli_close($conn);

// Redirect back to the form
// header("Location: index.php");
}

?>