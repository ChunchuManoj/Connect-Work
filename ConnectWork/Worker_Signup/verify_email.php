<?php 
    session_start();

    $conn = mysqli_connect("localhost","root","","user");

    if(isset($_GET['token'])){
        $token = $_GET['token'];
        $verify_query = "SELECT  verify_token, verify_status FROM workers WHERE verify_token='$token' LIMIT 1";
        $verify_query_run = mysqli_query($conn, $verify_query);

        if(mysqli_num_rows($verify_query_run) > 0){
            $row = mysqli_fetch_array($verify_query_run);
            if($row['verify_status'] == "0"){
                $update_query = "UPDATE workers SET verify_status='1' WHERE verify_token='$token'";
                $update_query_run = mysqli_query($conn, $update_query);
                if($update_query_run){
                    $_SESSION['status'] = "Your account has been verified";
                    echo "<script>alert('Successfully verified');</script>";
                    header("Location:../Home_page/Signin/index.php");
                }
                else{
                    $_SESSION['status'] = "Something went wrong";
                    echo "<script>alert('Something went wrong');</script>";
                    header("Location:../Home_page/Signin/index.php");
                }
            }
        }else{
            $_SESSION['status'] = "This token does not exist";
            // header("Location:../../Home_page/Signin/index.php");
        }
    }else{
        $_SESSION['status'] = "Not Allowed";
        // header("Location:../../Home_page/Signin/index.php");
    }
?>