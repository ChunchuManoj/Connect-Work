<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connect Work | Sign in</title>
    <link href="../images/logo.png" rel="icon">
    <link rel="stylesheet" href="./style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lovers+Quarrel&display=swap" rel="stylesheet">
</head>

<body>
    <div id="container">
        <form action="signin.php" method="post">


            <div id="heading">
                <img src="../images/logo.png" alt="logo">
                <h1>Connect Work</h1>
            </div>
            <p id="heading-text">Sign in to your Account</p>
            <div id="input">
                <div class="container">
                
                      <input type="email" required name="email" class="input">
                     <label for="email" class="label">Email</label>
                </div>
                <div class="container">
                
                     <input type="password" required name="password" class="input">
                     <label for="password" class="label">Password</label>
                </div>
            </div>
            <div id="forget-password">
                    <div id="checkbox-parent">
                        <input type="checkbox" id="checkbox">
                        <label for="checkbox"><p id="remember">Remember me</p></label>
                    </div>
                    <a href="../../password_reset/index.php">Forget Password?</a>
                </div>
                <div class="button-container">
                        <button class="button" type="submit">Sign in</button>
                </div>

                <p>Don't have an account? <a href="../../Sign_up_type/index.php">Sing up</a> </p>
            </div>
        </form>
        <!-- <p>Don't have an account <a href="../../Sign_up_type/index.php">Sign Up</a></p>
        <a href="../../password_reset/index.php">Forgot Password ?</a> -->
    </div>
    <script>
    function submitForm(form) {
        var data = new FormData(form);
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'signin.php', true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                // Form submitted successfully
                alert('Form submitted successfully');
            } else {
                // Form submission failed
                alert('Form submission failed');
            }
        };
        xhr.send(data);
        return false;
    }
    </script>
</body>

</html>