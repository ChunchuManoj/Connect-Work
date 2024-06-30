<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connect Work | Workers List</title>
    <link href="../Home_page/images/logo.png" rel="icon">
    <link rel="stylesheet" type="text/css" href="./style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lovers+Quarrel&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700&display=swap" rel="stylesheet">
</head>

<body>
    <?php
    session_start();
    $user_signed_in = isset($_SESSION['user']) && !empty($_SESSION['user']);
   ?>
<div id="user-login">
    <div id="nav" class="hide-when-logged-out">
        <div id="left-nav">
            <img src="./logo.png" alt="logo" id="logo">
            <h2>Connect Work</h2>
        </div>
        <div id="right-nav">
            <a href="../Home_page/index.html#contact">Contact Us</a>
            <?php if (isset($_SESSION['user']) &&!empty($_SESSION['user'])) :?>
            <img src="../Worker_Signup/uploads/<?= $_SESSION['user']['profile_pic']?>" alt="Profile Pic" id="profile">
            <?php endif;?>
        </div>
    </div>
    <div id="drop-down" class="hide-when-logged-out">
        <a href="../dashboard/update_profile/index.php">Update profile</a>
        <a href="#" id="profile-log-out">log out</a>
    </div>
    <div id="top-filter">
        <h2>Select your worker</h2>
        <div id="filter">
            <button class="beautiful-button" onclick="filterWorkers('Appliance Repair')">Appliance Repair</button>
            <button class="beautiful-button" onclick="filterWorkers('Carpenter')">Carpenter</button>
            <button class="beautiful-button" onclick="filterWorkers('Cleaner')">Cleaner</button>
            <button class="beautiful-button" onclick="filterWorkers('Electrician')">Electrician</button>
            <button class="beautiful-button" onclick="filterWorkers('Painter')">Painter</button>
            <button class="beautiful-button" onclick="filterWorkers('Plumber')">Plumber</button>
        </div>
        <button id="show-button" class="beautiful-button" onclick="showAllWorkers()">Show All</button>
        <!-- <div id="search"> -->
            <!-- <input type="text" id="searchInput" onkeyup="searchWorkers()">
            <button>Submit</button> -->
            <div class="search" id="search">
                 <input placeholder="Search Worker Area.." type="text" id="searchInput" onkeyup="searchWorkers()">
                 <button type="submit">Go</button>
            </div>
        <!-- </div> -->
    </div>
    <div id="parent">
        <div id="filter-left">
            <h4>Select Work Field?</h4>
            <div>
                <button class="beautiful-button" onclick="filterWorkers('Appliance Repair')">Appliance Repair</button>
                <button class="beautiful-button" onclick="filterWorkers('Carpenter')">Carpenter</button>
                <button class="beautiful-button" onclick="filterWorkers('Cleaner')">Cleaner</button>
                <button class="beautiful-button" onclick="filterWorkers('Electrician')">Electrician</button>
                <button class="beautiful-button" onclick="filterWorkers('Painter')">Painter</button>
                <button class="beautiful-button" onclick="filterWorkers('Plumber')">Plumber</button>
                <button class="beautiful-button" onclick="showAllWorkers()">Show All</button>
            </div>
        </div>
        <div id="workers-list" data-aos="fade-up" data-aos-delay="200">
            <?php
            include 'config.php';
            $sql = "SELECT * FROM workers";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<div class='worker-item' data-id='". $row["id"]. "' data-work-field='". $row["field"]. "' data-area='". $row["area"]. "'>";
                    echo "<img src='../Worker_Signup/uploads/". $row["profile_pic"]. "' alt='Profile Pic' width='100' height='100'>";
                    echo "<h3>". $row["full_name"]. "</h3>";
                    echo "<p>". $row["email"]. "</p>";
                    echo "<strong>Work Field</strong>";
                    echo "<p>". $row["field"]. "</p>";
                    echo "<strong>Area</strong>";
                    echo "<p>". $row["area"]. "</p>";
                    echo "</div>";
                }
            } else {
                echo "<h2 id='no-workers-found'>No workers found</h2>";
            }
            $conn->close();
            ?>
        </div>
    </div>
    </div>
    <div id="user-not-login">
        <center><h1 style="display: none;">user no more exist..</h1></center>
    </div>
    <h2 id="worker-found">worker is not found</h2>
</body>
<?php 
if(!isset($_SESSION['user'])){
    echo "<script>location.href='../Home_page/Signin/index.php'</script>";
}
?>
<script>
function showAllWorkers() {
    var worker =document.getElementById('worker-found');
    worker.style.display = 'none';
    const workerItems = document.querySelectorAll('.worker-item');
    workerItems.forEach((item) => {
        item.style.display = '';
    });
}

function filterWorkers(workField) {
    const workerItems = document.querySelectorAll('.worker-item');
    var worker = document.getElementById('worker-found');
    let found = false;
    workerItems.forEach((item) => {
        if (item.dataset.workField === workField) {
            item.style.display = '';
            found = true;
        } else {
            item.style.display = 'none';
        }
    }
);
    if(!found){
        worker.style.display = 'block';
    }else{
        worker.style.display = 'none';
    }
}

function searchWorkers() {
    const input = document.getElementById('searchInput').value.toUpperCase();
    const workerItems = document.querySelectorAll('.worker-item');
    var worker = document.getElementById('worker-found');
    let found = false;
    workerItems.forEach((item) => {
        const area = item.dataset.area;
        if (area.toUpperCase().indexOf(input) > -1) {
            item.style.display = '';
            found =true;
        } else {
            item.style.display = 'none';
        }
    });
    if(!found){
        worker.style.display = 'block';
    }else{
        worker.style.display = 'none';
    }
}
// AJAX request to fetch the value from PHP

const workerItems = document.querySelectorAll('.worker-item');
workerItems.forEach((item) => { item.addEventListener('click', () => { 
    const id = item.dataset.id;

    window.location.href = `../dashboard/worker_details/worker-profile.php?id=${id}`;
});
});

var profile = document.getElementById('profile');
var list = document.getElementById('drop-down');

let clickCount = 0;

profile.addEventListener('click', () => {
    clickCount++;
    if (clickCount % 2 != 0) {
        list.style.display = 'flex';
        console.log("clicked");
        list.style.position = 'fixed';
    } else if (clickCount % 2 == 0) {
        list.style.display = 'none';
        console.log("unclicked");
    }
});

var logout = document.getElementById('profile-log-out');
logout.addEventListener('click', () => {
    let userpresent =document.getElementById('user-login');
    let usernotpresent =document.getElementById('user-not-login');
    localStorage.removeItem('user');
   window.location.href='./temp.php';

});

</script>

</html>