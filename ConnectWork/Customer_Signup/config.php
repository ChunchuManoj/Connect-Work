<?php
// config.php

// Database connection settings
session_start();


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: ". $conn->connect_error);
}
function sendemail_verify($name,$email,$verify_token){
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->SMTPAuth = true;

    $mail->Host = "smtp.gmail.com";
    $mail->Username = "connectwork789@gmail.com";
    $mail->Password = "gqzvkgfiyvysujwt";
    
    $mail->SMTPSecure = "tls";
    $mail->Port = 587;

    $mail->setFrom("connectwork789@gmail.com");
    $mail->addAddress($email);

    $mail->isHTML(true);
    $mail->Subject = "Email Verification from Connect Work";

    $email_template = "
        <h2>You have Registered with Connect Work</h2>
        <h5>Verify your email address to login with the below given link</h5>
        <br>
        <br>
        <a href='http://localhost/ConnectWork/Customer_Signup/verify_email.php?token=$verify_token'>Verify Here</a>
    ";
    $mail->Body = $email_template;
    $mail->send();
    echo "message has been sent";
    
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $profile_pic = $_FILES["profile_pic"];
    $username = $_POST["username"];
    $full_name = $_POST["full_name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $mobile_number = $_POST["mobile_number"];
    $area = $_POST["area"];
    $pin_code = $_POST["pin_code"];
    $verify_token = md5(rand());

   // Validate form data


    //Upload profile picture
    $target_dir = "../Worker_Signup/uploads/";
    $target_file = $target_dir. basename($profile_pic["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($profile_pic["tmp_name"]);
    if ($check!== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($profile_pic["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType!= "jpg" && $imageFileType!= "png" && $imageFileType!= "jpeg") {
        echo "Sorry, only JPG, JPEG, PNG files are allowed.";
        $uploadOk = 0;
    }

    // Upload profile picture
    
   
    $email_check = "SELECT email FROM customers WHERE email = '$email'";
    $result = $conn->query($email_check);
    if ($result->num_rows > 0) {
        echo "Email already exists.";
        exit;
    }

    // Check if mobile number already exists
    $mobile_number_check = "SELECT mobile_number FROM customers WHERE mobile_number = '$mobile_number'";
    $result = $conn->query($mobile_number_check);
    if ($result->num_rows > 0) {
        echo "Mobile number already exists.";
        exit;
    }
    if (!empty($username) && !empty($full_name) && !empty($email) && !empty($password) && !empty($mobile_number) && !empty($area) && !empty($pin_code)) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Validate mobile number format
            if (preg_match('/^[0-9]{10}$/', $mobile_number)) {
                // Validate pin code format
                if (preg_match('/^[0-9]{6}$/', $pin_code)) {
                    // Validate work experience format
                    if ($uploadOk == 1) {
                        if (move_uploaded_file($profile_pic["tmp_name"], $target_file)) {
                            echo "The file has been uploaded.";
                            $image_name = basename($profile_pic["name"]);
                        } else {
                            echo "Sorry, there was an error uploading your file.";
                        }
                    }
                            // Insert data into database
                            $password_hash = password_hash($password, PASSWORD_DEFAULT);

                            // Insert data into database
                            $sql = "INSERT INTO customers (username, full_name, email, password, mobile_number, area, pin_code, profile_pic, verify_token) VALUES (?,?,?,?,?,?,?,?,?)";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("sssssssss", $username, $full_name, $email, $password_hash, $mobile_number, $area, $pin_code, $image_name, $verify_token);
                           
                            
                            // Check for errors
                           
                            if ($stmt->execute()) {
                                sendemail_verify("$username","$email","$verify_token");
                                $_SESSION['status'] = "Registration Successfull.! please verify your Email Address";
                                header("Location: signup.php");
                            } else {
                                echo "Registration unsuccessful!";
                                

                            }

                     
                } else {
                    echo "Invalid pin code format.";
                }
            } else {
                echo "Invalid mobile number format.";
            }
        } else {
            echo "Invalid email format.";
        }
    } else {
        echo "Please fill in all required fields.";
    }
    
    // Hash password
}
$conn->close();
?>