<?php 
    session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Sign Up Form</title>
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <form id="registrationForm" action="config.php" method="post" enctype="multipart/form-data">
        <?php 
            if(isset($_SESSION["status"])){
                echo "<h4>".$_SESSION['status']."</h4>";
            }
        ?>
        <h2> Customer Sign Up</h2>
        <label for="profile_pic">Profile Picture:</label>
        <input type="file" id="profile_pic" name="profile_pic" required><br><br>

        <label for="username">User Name:</label>
        <input type="text" id="username" name="username" required><br><br>

        <label for="full_name">Full Name:</label>
        <input type="text" id="full_name" name="full_name" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <label for="mobile_number">Mobile Number:</label>
        <input type="tel" id="mobile_number" name="mobile_number" required minlength="10" maxlength="10"><br><br>

        <label for="area">Area:</label>
        <input type="text" id="area" name="area" required><br><br>

        <label for="pin_code">Pin Code:</label>
        <input type="number" id="pin_code" name="pin_code" required minlength="6" maxlength="6"><br><br>

        <input type="submit" value="Sign Up">
    </form>
    <script>
    // Get form elements
    const username = document.getElementById('username');
    const fullName = document.getElementById('full_name');
    const email = document.getElementById('email');
    const password = document.getElementById('password');
    const mobileNumber = document.getElementById('mobile_number');
    const area = document.getElementById('area');
    const pinCode = document.getElementById('pin_code');

    document.getElementById('registrationForm').addEventListener('submit', function(event){

        event.preventDefault();

        if(username.value.trim() ==='' ||
         fullName.value.trim() ==='' ||
         email.value.trim() ==='' ||
         password.value.trim() ==='' ||
         mobileNumber.value.trim() ==='' ||
         area.value.trim() ==='' ||
         pinCode.value.trim() ===''){
            alert('Please fill in all required fields.');
            return;
         }else if(!validatePassword(password.value)) {
            alert('Password must contain at least one special character.');
        }
    

    function validatePassword(password) {
        // Add your password validation logic here
        // Return true if the password is valid, false otherwise
        const re = /[!@#$%^&*(),.?":{}|<>]/;
            if (!re.test(password)) {
                document.getElementById('passwordError').style.display = 'block';
                return false;
            }
            return true;
    }

    function validatePassword(password) {
            const re = /[!@#$%^&*(),.?":{}|<>]/;
            return re.test(password);
        }
        this.submit();
    });
</script>
</body>

</html>