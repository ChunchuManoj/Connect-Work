
<script src="/dashboard/workers_list.php"></script>
<?php
// Connect to the database
$host = 'localhost';
$db   = 'user';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo = new PDO($dsn, $user, $pass, $opt);
$value_from_php = "Hello from PHP!";
echo json_encode($value_from_php);

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hash the input password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
   
    
    // Check worker database
    $stmt = $pdo->prepare('SELECT id, email, password, full_name, profile_pic, username, mobile_number, address, area, pin_code,field, work_experience, description, latitude, longitude, verify_status FROM workers WHERE email = :email');
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        // User is a worker
        $worker = $stmt->fetch();
        $hashed_password_in_db = $worker['password'];

        // Verify the input password with the hashed password in the database
        if (password_verify($password, $hashed_password_in_db)) {
            if($worker['verify_status'] == "1"){
                session_start();
                $_SESSION['user'] = $worker;
                header('Location:../../dashboard/workers_list.php');
                exit;
            }else{
                echo "<script type='text/javascript'>alert('Your email is not verified'); window.location = 'index.php';</script>";
            }
        } else {
            echo "<script type='text/javascript'>alert('Invalid email or password'); window.location = 'index.php';</script>";
        }
    } else {
        // Check customer database
        $stmt = $pdo->prepare('SELECT id, username, email, password, full_name,mobile_number,area, pin_code, profile_pic, verify_status FROM customers WHERE email = :email');
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            // User is a customer
            $customer = $stmt->fetch();
            $hashed_password_in_db = $customer['password'];

            // Verify the input password with the hashed password in the database
            if (password_verify($password, $hashed_password_in_db)) {
                if($customer['verify_status'] == "1"){
                    session_start();
                    $_SESSION['user'] = $customer;
                    header('Location:../../dashboard/workers_list.php');
                    exit;
                }else{
                    echo "<script type='text/javascript'>alert('Your email is not verified'); window.location = 'index.php';</script>";
                }
               
            } else {

               echo "<script type='text/javascript'>alert('Invalid email or password'); window.location = 'index.php';</script>";
            }
        } else {
            echo "<script type='text/javascript'>alert('Invalid email or password'); window.location = 'index.php';</script>";
            
        }
    }
   
}