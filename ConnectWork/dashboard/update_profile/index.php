<html>
    <head>
    <link rel="stylesheet" href="./style.css">
    <title>Connect Work | Update Profile</title>
    <link href="../../Home_page/images/logo.png" rel="icon">
    </head>
    <body>


    <center><h2 style="margin:50px 0; color:blue">update Profile</h2></center>
        <?php
session_start();
    
if (isset($_SESSION['user'])) {
  
  $user = $_SESSION['user'];
  if (isset($user['work_experience'])) {
    // Execute if 'field' value exists
    // Your code here
    // echo " value exists: " . $user['work_experience'];
    echo "
    
    

    <form action='update_worker.php' method='post' enctype='multipart/form-data'>
    <div id='forms'>
        <label for='profile_pic'>Profile Picture</label>
        <input type='file' id='profile_pic' name='profile_pic' >
        <label for='full_name'>Full Name</label>
        <input type='text' id='full_name' name='full_name' value='".$user['full_name']."'>
        <label for='username'>User Name:</label>
        <input type='text' id='username' name='username' value='". $user['username']. "'>
        <label for='mobile_number'>Mobile Number:</label>
        <input type='tel' id='mobile_number' name='mobile_number' value='". $user['mobile_number']. "'>
        <label for='address'>Address:</label>
        <input type='text' id='address' name='address' value='". $user['address']. "'>
        <label for='area'>Area:</label>
        <input type='text' id='area' name='area' value='". $user['area']. "'>
        <label for='pin_code'>Pin Code:</label>
        <input type='number' id='pin_code' name='pin_code' value='". $user['pin_code']. "'>
        <label for='work_field'>Work Field:</label>
        <input type='text' id='work_field' name='work_field' value='". $user['field']. "'>
        <label for='work_experience'>Work Experience:</label>
        <input type='text' id='work_experience' name='work_experience' value='". $user['work_experience']. "'>
        <label for='latitude'>Work Latitude:</label>
        <input type='number' id='latitude' name='latitude' value='". $user['latitude']. "'>
        <label for='longitude'>Work Longitude:</label>
        <input type='number' id='longitude' name='longitude' value='". $user['longitude']. "'>
        <input type='submit' value='Submit'>
    </div>
    </form>
    ";
} else {
    // Execute if 'field' value does not exist
    // Your code here
    echo " value does not exist" .$user['id'];
    echo "
    <form action='update_customer.php' method='post' enctype='multipart/form-data'>
    <div id='forms'>
        <label for='profile_pic'>Profile Picture</label>
        <input type='file' id='profile_pic' name='profile_pic'>
        <label for='full_name'>Full Name</label>
        <input type='text' id='full_name' name='full_name' value='".$user['full_name']."'>
        <label for='username'>User Name:</label>
        <input type='text' id='username' name='username' value='". $user['username']. "'>
        <label for='mobile_number'>Mobile Number:</label>
        <input type='tel' id='mobile_number' name='mobile_number' value='". $user['mobile_number']. "'>
        <label for='area'>Area:</label>
        <input type='text' id='area' name='area' value='". $user['area']. "'>
        <label for='pin_code'>Pin Code:</label>
        <input type='number' id='pin_code' name='pin_code' value='". $user['pin_code']. "'>
        <input type='submit' value='Submit'>
    </div>
    </form>
    ";
}
}

?>
</body
    </html>