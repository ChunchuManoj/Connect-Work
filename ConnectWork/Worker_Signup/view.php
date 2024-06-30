<?php
// Configuration
$db_host = 'localhost';
$db_username = '';
$db_password = '';
$db_name = 'user';

// Create connection
$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Validate form data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Handle file upload
    $profile_pic = file_get_contents($_FILES["profile_pic"]["tmp_name"]);

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
    $description = $_POST['description'];
    $terms = isset($_POST['terms']) ? 1 : 0;

    // Validate form data
    if (!empty($username) && !empty($full_name) && !empty($email) && !empty($password) && !empty($mobile_number) && !empty($address) && !empty($area) && !empty($pin_code) && !empty($work_field) && !empty($work_experience) && !empty($description) && $terms) {
        // Validate email format
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Validate mobile number format
            if (preg_match('/^[0-9]{10}$/', $mobile_number)) {
                // Validate pin code format
                if (preg_match('/^[0-9]{6}$/', $pin_code)) {
                    // Validate terms checkbox
                    if ($terms) {
                        // Insert data into database
                        // Insert data into database
                        $stmt = $conn->prepare("INSERT INTO workers (username, full_name, email, password, mobile_number, address, area, pin_code, work_field, work_experience, description, profile_pic) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

                        // Bind parameters
                        // Bind parameters
                        $stmt->bind_param("ssssissiiisb", $username, $full_name, $email, $password, $mobile_number, $address, $area, $pin_code, $work_field, $work_experience, $description, $profile_pic);


                        $stmt->send_long_data(12, $profile_pic); // Bind BLOB data
                        $stmt->execute();

                        // Check for errors
                        if ($stmt->error) {
                            echo "Error: " . $stmt->error;
                        } else {
                            echo "Registration successful!";
                        }

                        // Close statement
                        $stmt->close();
                    } else {
                        echo "Please accept the terms and privacy policy.";
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