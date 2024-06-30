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
    <form id="registrationForm" action="signup.php" method="post" enctype="multipart/form-data">
    <?php 
            if(isset($_SESSION["status"])){
                echo "<h4>".$_SESSION['status']."</h4>";
            }
        ?>
        <h2>Sign Up</h2>
        <label for="profile_pic">Profile Picture:</label>
        <input type="file" id="profile_pic" name="profile_pic" required><br><br>

        <label for="username">User Name:</label>
        <input type="text" id="username" name="username" required><br><br>

        <label for="full_name">Full Name:</label>
        <input type="text" id="full_name" name="full_name" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <div id="passwordError" style="color: red; display: none;">Password must contain at least one special character.
        </div>
        <br><br>

        <label for="mobile_number">Mobile Number:</label>
        <input type="tel" id="mobile_number" name="mobile_number" required required minlength="10" maxlength="10"><br><br>

        <label for="address">Address:</label>
        <input type="text" id="address" name="address" required><br><br>

        <label for="area">Area:</label>
        <input type="text" id="area" name="area" required><br><br>

        <label for="pin_code">Pin Code:</label>
        <input type="number" id="pin_code" name="pin_code" required required minlength="6" maxlength="6"><br><br>


        <label for="work_field">Work Field:</label>
        <select id="work_field" name="work_field">
            <option value="Electrician">Electrician</option>
            <option value="plumber">Plumber</option>
            <option value="painter">Painter</option>
            <option value="carpenter">Carpenter</option>
            <option value="cleaner">Cleaner</option>
            <option value="appliance_repair">Appliance Repair</option>
            <!-- Add more options for work fields -->
        </select><br><br>


        <label for="work_experience">Work Experience:</label>
        <input type="number" id="work_experience" name="work_experience" required><br><br>

        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea><br><br>
        <label for="latitude">latitude</label>
        <input type="text" id="latitude" name="latitude" required><br><br>

        <label for="longitude">Longitude</label>
        <input type="text" id="longitude" name="longitude" required><br><br>

        <!-- <input type="checkbox" id="terms" name="terms">
        <label for="terms">I agree to the Terms and Privacy Policy</label><br><br> -->

        <input type="submit" value="Sign Up"><br>
        
        <center><a href="./guide.html">location video</a></center>
    </form>

    <script>
    // Get form elements
    const username = document.getElementById('username');
    const fullName = document.getElementById('full_name');
    const email = document.getElementById('email');
    const password = document.getElementById('password');
    const mobileNumber = document.getElementById('mobile_number');
    const address = document.getElementById('address');
    const area = document.getElementById('area');
    const pinCode = document.getElementById('pin_code');
    const workField = document.getElementById('work_field');
    const workExperience = document.getElementById('work_experience');
    const description = document.getElementById('description');
    const terms = document.getElementById('terms');
    const profilePic = document.getElementById('profile_pic');

    // Add event listener to form submit event
    document.getElementById('registrationForm').addEventListener('submit', function(event) {
        // Prevent form from submitting normally
        event.preventDefault();

        // Validate form data
        if (username.value.trim() === '' ||
            fullName.value.trim() === '' ||
            email.value.trim() === '' ||
            password.value.trim() === '' ||
            mobileNumber.value.trim() === '' ||
            address.value.trim() === '' ||
            area.value.trim() === '' ||
            pinCode.value.trim() === '' ||
            workField.value.trim() === '' ||
            workExperience.value.trim() === '' ||
            description.value.trim() === '' ||
            !terms.checked ||
            !validatePassword(password.value)) {
            alert(
                'Please fill in all required fields and make sure the password contains at least one special character.'
            );
            return;
        }

        // Validate email format
        if (!validateEmail(email.value)) {
            alert('Invalid email format.');
            return;
        }

        // Validate password format
        function validatePassword(password) {
            const re = /[!@#$%^&*(),.?":{}|<>]/;
            if (!re.test(password)) {
                document.getElementById('passwordError').style.display = 'block';
                return false;
            }
            return true;
        }

        // Validate password format
        function validatePassword(password) {
            const re = /[!@#$%^&*(),.?":{}|<>]/;
            return re.test(password);
        }

        // Validate mobile number format
        if (!validateMobileNumber(mobileNumber.value)) {
            alert('Invalid mobile number format.');
            return;
        }

        // Validate pin code format
        if (!validatePinCode(pinCode.value)) {
            alert('Invalid pin code format.');
            return;
        }

        // Validate work experience format
        if (!validateWorkExperience(workExperience.value)) {
            alert('Invalid work experience format.');
            return;
        }

        // Validate terms checkbox
        if (!terms.checked) {
            alert('Please accept the terms and privacy policy.');
            return;
        }

        // Validate file upload
        if (profilePic.files.length === 0) {
            alert('No file selected.');
            return;
        }

        // Validate file type
        const file = profilePic.files[0];
        const fileType = file.type.split('/')[1];
        if (fileType !== 'jpg' && fileType !== 'jpeg' && fileType !== 'png' && fileType !== 'gif') {
            alert('Only JPG, JPEG, PNG & GIF files are allowed.');
            return;
        }

        // Validate file size
        if (file.size > 500000) {
            alert('File is too large.');
            return;
        }

        // If all validations pass, submit the form
        this.submit();
    });

    // Validate email format
    function validateEmail(email) {
        const re =
            /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
    }

    // Validate mobile number format
    function validateMobileNumber(mobileNumber) {
        return /^[0-9]{10}$/.test(mobileNumber);
    }

    // Validate pin code format
    function validatePinCode(pinCode) {
        return /^[0-9]{6}$/.test(pinCode);
    }

    // Validate work experience format
    function validateWorkExperience(workExperience) {
        return /^[0-9]+$/.test(workExperience);
    }
    </script>
</body>

</html>