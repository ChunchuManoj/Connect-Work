<?php
// Configuration

session_start();


$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'user';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../Customer_Signup/vendor/autoload.php';

// Create connection
$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

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
        <a href='http://localhost/ConnectWork/Worker_Signup/verify_email.php?token=$verify_token'>Verify Here</a>
    ";
    $mail->Body = $email_template;
    $mail->send();
    echo "message has been sent";
    
}


// Validate form data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Handle file upload
    $target_dir = "uploads/";
    $target_file = $target_dir. basename($_FILES["profile_pic"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if file is an image
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
    

    // Get form data
    $username = $_POST['username'];
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $mobile_number = $_POST['mobile_number'];
    $address = $_POST['address'];
    $area = $_POST['area'];
    $pin_code = $_POST['pin_code'];
    $work_field = $_POST['work_field'];
    $work_experience = $_POST['work_experience'];
    $latitude = $_POST["latitude"];
    $longitude = $_POST["longitude"];
    $description = $_POST['description'];
    // $terms = isset($_POST['terms'])? 1 : 0;
    $profile_pic = basename($_FILES["profile_pic"]["name"]);// Store the original name of the uploaded file
    $verify_token = md5(rand());

    // Check if email already exists
    $email_check = "SELECT email FROM workers WHERE email = '$email'";
    $result = $conn->query($email_check);
    if ($result->num_rows > 0) {
        echo "Email already exists.";
        exit;
    }

    // Check if mobile number already exists
    $mobile_number_check = "SELECT mobile_number FROM workers WHERE mobile_number = '$mobile_number'";
    $result = $conn->query($mobile_number_check);
    if ($result->num_rows > 0) {
        echo "Mobile number already exists.";
        exit;
    }


    // Validate form data
    if (!empty($username) &&!empty($full_name) &&!empty($email) &&!empty($password) &&!empty($mobile_number) &&!empty($address) &&!empty($area) &&!empty($pin_code) &&!empty($work_field) &&!empty($work_experience) &&!empty($description) && $terms) {
        // Validate email format
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Validate mobile number format
            if (preg_match('/^[0-9]{10}$/', $mobile_number)) {
                // Validate pin code format
                if (preg_match('/^[0-9]{6}$/', $pin_code)) {
                    // Validate work experience format
                    if (preg_match('/^[0-9]+$/', $work_experience)) {
                        // Validate terms checkbox
                        
                        
                            if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $target_file)) {
                                echo "The file ". basename($_FILES["profile_pic"]["name"]). " has been uploaded.";
                                
                        
                                // header("Location:../dashboard/workers_list.php");
                            } else {
                                echo "An error occurred during upload.";
                                exit;
                            }
                            // Insert data into database
                            $stmt = $conn->prepare("INSERT INTO workers (username, full_name, email, password, mobile_number, address, area, pin_code, work_experience, description, profile_pic, field, latitude, longitude, verify_token) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
                            $stmt->bind_param("ssssissiissssss", $username, $full_name, $email, $password, $mobile_number, $address, $area, $pin_code, $work_experience, $description, $profile_pic,$work_field, $latitude, $longitude, $verify_token);
                            
                            if ($stmt->execute()) {
                                sendemail_verify("$username","$email","$verify_token");
                                $_SESSION['status'] = "Registration Successfull.! please verify your Email Address";
                                header("Location: index.php");
                            } else {
                                echo "Registration unsuccessful!";
                                
                            }




                            // Close statement$stmt->close();
                      
                    } else {
                        echo "Invalid work experience format.";
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
}

// Close connection
$conn->close();
?>