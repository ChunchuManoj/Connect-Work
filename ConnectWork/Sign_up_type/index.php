<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connect Work | Signup Type</title>
    <link rel="stylesheet" href="./style.css">
    <link href="../Home_page/images/logo.png" rel="icon">
</head>
<body>
    <div id="container">
        <div id="heading">
            <h1>Select your Account Type ?</h1>
        </div>
        <div id="body">
            <div id="worker">
                <img src="./images/worker-man-figure-vector-7888115.avif" alt="worker">
                <h3>Worker</h3>
            </div>
            <div id="customer">
                <img src="./images/customer.jpeg" alt="customer">
                <h3>Customer</h3>
            </div>
        </div>
    </div>
    <script>
        let worker = document.getElementById('worker');
        let customer =document.getElementById('customer');
        worker.addEventListener('click', ()=>{
            window.location.href='../Worker_Signup/index.php';
        });
        customer.addEventListener('click', ()=>{
            window.location.href='../Customer_Signup/signup.php';
        });
    </script>
</body>
</html>