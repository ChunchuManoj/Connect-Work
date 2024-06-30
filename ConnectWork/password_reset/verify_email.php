<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "user");

if (isset($_GET['email'])) {
    $email = $_GET['email'];
    $verify_query = "SELECT email, password FROM workers WHERE email='$email' LIMIT 1";
    $verify_query_run = mysqli_query($conn, $verify_query);
    $result = "SELECT email, password FROM customers WHERE email='$email' LIMIT 1";
    $result_run = mysqli_query($conn, $result);

    if (mysqli_num_rows($verify_query_run) > 0) {
        if (isset($_POST['password']) && isset($_POST['conform_password'])) {
            $password = $_POST['password'];
            $conform_password = $_POST['conform_password'];

            if ($password == $conform_password) {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $update_query = "UPDATE workers SET password='$hashed_password' WHERE email='$email'";
                $update_query_run = mysqli_query($conn, $update_query);

                if ($update_query_run) {
                    echo "<script>alert('password updated successfully');
                    window.location.href = '../Home_page/Signin/index.php';
                    </script>";
                } else {
                    echo "<script>alert('Error updating password')</script>";
                }
            } else {
                echo "<script>alert('Passwords do not match')</script>";
            }
        }
    }else{
        if (isset($_POST['password']) && isset($_POST['conform_password'])) {
            $password = $_POST['password'];
            $conform_password = $_POST['conform_password'];

            if ($password == $conform_password) {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $update_query = "UPDATE customers SET password='$hashed_password' WHERE email='$email'";
                $update_query_run = mysqli_query($conn, $update_query);

                if ($update_query_run) {
                    echo "<script>alert('password updated successfully');
                    window.location.href = '../Home_page/Signin/index.php';
                    </script>";
                    
                }        
                } else {
                    echo "<script>alert('Error updating password')</script>";
                }
            } else {
                echo "<script>alert('Passwords do not match')</script>";
            }
        }
    }



?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(to right top, rgba(236, 49, 49, 0.418), rgba(255, 255, 255, 0.507),rgba(0, 115, 255, 0.274) , rgba(75, 168, 9, 0.432) );
        }
        #container {
            width: 400px;
            height: 400px;
            border: 1px solid black;
            border-radius: 10px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        form {
            margin-top: 30px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: start;
            /* gap: 20px; */
        }
        #submit {
            display: flex;
            justify-content: center;
            width: 100%;
        }
        .input-container {
  position: relative;
  margin: 50px auto;
  width: 200px;
  bottom: 40px;
}

.input-container input[type="password"] {
  font-size: 20px;
  width: 100%;
  border: none;
  border-bottom: 2px solid #000000;
  padding: 5px 0;
  background-color: transparent;
  outline: none;
}

.input-container .label {
  position: absolute;
  top: 0;
  left: 0;
  color: #000000;
  transition: all 0.3s ease;
  pointer-events: none;
}

.input-container input[type="password"]:focus ~ .label,
.input-container input[type="password"]:valid ~ .label {
  top: -20px;
  font-size: 19px;
  color: #0b4eb4;
  font-weight: 400;
}

.input-container .underline {
  position: absolute;
  bottom: 0;
  left: 0;
  height: 2px;
  width: 100%;
  background-color: #000000;
  transform: scaleX(0);
  transition: all 0.3s ease;
}

.input-container input[type="password"]:focus ~ .underline,
.input-container input[type="password"]:valid ~ .underline {
  transform: scaleX(1);
}
button {
  font-family: monospace;
  background-color: #34c5ed;
  color: #ffffff;
  border: none;
  border-radius: 8px;
  width: 100px;
  height: 45px;
  transition: .3s;
}

button:hover {
  background-color: #3b82f6;
  box-shadow: 0 0 0 5px #3b83f65f;
  color: #fff;
}
#top{
    position: relative;
    top: 20px;
}

    </style>
</head>
<body>
    <div id="container">
        <h1>Password Reset</h1>
        <form action="" method="post">
            <div class="input-container" id="top">
                <input type="password" name="password" required id="input">
                <label for="input" class="label">Password</label>
            </div>
            <div class="input-container">
                <input type="password" name="conform_password" required id="input">
                <label for="input" class="label">Conform your Password</label>
            </div>
            <div id="submit">
                <button type="submit" value="Submit">Submit</button>
            </div>

        </form>
    </div>
    <script>
        const password = document.getElementById("") 
    </script>
</body>
</html>