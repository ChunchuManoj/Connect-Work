<?php 

    session_start();

    $host = 'localhost';
    $db = 'user';
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


    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../Customer_Signup/vendor/autoload.php';

function sendemail_verify($id){
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->SMTPAuth = true;

    $mail->Host = "smtp.gmail.com";
    $mail->Username = "connectwork789@gmail.com";
    $mail->Password = "gqzvkgfiyvysujwt";
    
    $mail->SMTPSecure = "tls";
    $mail->Port = 587;

    $mail->setFrom("connectwork789@gmail.com");
    $mail->addAddress($id);

    $mail->isHTML(true);
    $mail->Subject = "Email Verification from Connect Work";

    $email_template = "
        <h2>You have requested to change your Password with Connect Work</h2>
        <h5>Reset your password with the below given link</h5>
        <br>
        <br>
        <a href='http://localhost/ConnectWork/password_reset/verify_email.php?email=$id'>Verify Here</a>
    ";
    $mail->Body = $email_template;
    $mail->send();
    echo "✉️ mail is sent to your eamil account please check";
    
}

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $email = $_POST['email'];

        $stmt = $pdo->prepare('SELECT id,  email FROM workers WHERE email = :email');
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $result = $pdo->prepare('SELECT id, email FROM customers WHERE email = :email');
        $result->bindParam(':email',$email);
        $result->execute();

        if($stmt->rowCount() > 0){
            $row = $stmt->fetch();
            $id = $row['email'];
            sendemail_verify("$id");
        }elseif($result->rowCount() > 0){
            $row = $result->fetch();
            $id = $row['email'];
            sendemail_verify("$id");
        }else{
            echo "<script>alert('Given email is not exist')</script>";
        }
    }
?>