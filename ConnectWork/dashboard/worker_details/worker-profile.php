<!DOCTYPE html>
<html>

<head>
    <title>Connect Work | Worker Profile</title>
    <link rel="stylesheet" type="text/css" href="./style.css">
    <link href="../../Home_page/images/logo.png" rel="icon">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lovers+Quarrel&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700&display=swap" rel="stylesheet">
</head>

<body>
    <?php
    session_start();
   ?>
    <?php 
    if (!isset($_SESSION['user']) || empty($_SESSION['user'])) {
        header("Location:../../Home_page/Signin/index.php");
        exit();
    }
   ?>
    <div id="nav">
        <div id="left-nav">
            <img src="./logo.png" alt="logo" id="logo">
            <h2>Connect Work</h2>
        </div>
        <div id="right-nav">
            <a href="../../Home_page/index.html#contact">Contact Us</a>
            <?php if (isset($_SESSION['user']) &&!empty($_SESSION['user'])) :?>
            <img src="../../Worker_Signup/uploads/<?= $_SESSION['user']['profile_pic']?>" alt="Profile Pic" width="50px"
                height="50px" id="profile">
            <?php endif;?>
            <div id="drop-down">
                <a href="../update_profile/index.php">Update profile</a>
                <a href="#" id="profile-log-out">log out</a>
            </div>
        </div>
    </div>
    <h2>Worker Profile</h2>
    <div id="worker-profile">
        <div id="image">
            <img id="profile-pic" src="" alt="Profile Pic">
        </div>
        <div id="worker-name">
            <h3>Full Name</h3>
            <p id="full-name"></p>
        </div>
    </div>
    <center>
    <table>
            <tr>
        <td>
            <h4 class="font">Email</h4>
        </td>
        <td>
            <p id="email" class="font"></p>
        </td>
    </tr>
    <tr>
        <td>
            <h4 class="font">Phone Number</h4>
        </td>
        <td>
            <p id="phone" class="font"></p>
        </td>
    </tr>
    <tr>
        <td>
            <h4 class="font">Address</h4>
        </td>
        <td>
            <p id="address" class="font"></p>
        </td>
    </tr>
    <tr>
        <td>
            <h4 class="font">Area</h4>
        </td>
        <td>
            <p id="area" class="font"></p>
        </td>
    </tr>
    <tr>
        <td>
            <h4 class="font">Work Field</h4>
        </td>
        <td>
            <p id="work-field" class="font"></p>
        </td>
    </tr>
    <tr>
        <td>
            <h4 class="font">Experiance</h4>
        </td>
        <td>
            <p id="experiance" class="font"></p>
        </td>
    </tr>
    <tr>
        <td>
            <h4 class="font">Description</h4>
        </td>
        <td>
            <p id="description" class="font"></p>
        </td>
    </tr>
    </table>
    </center>
    <center><h2 id="mapes">Maps</h2></center>
    <div id="maps">
        <div id="map" style="width: 100%; height: 400px;"></div>
    </div>
    <script>
    const urlParams = new URLSearchParams(window.location.search);
    const workerId = parseInt(urlParams.get('id'), 10);

    if (isNaN(workerId) || workerId <= 0) {
        alert('Invalid worker ID');
    } else {
        fetch('config.php?action=getWorkerDetails&id=' + workerId)
           .then(response => response.json())
           .then(data => {
                console.log(data);
                if (data.success) {
                    const worker = data.worker;

                    document.getElementById('profile-pic').src =
                        `../../Worker_Signup/uploads/${worker.profile_pic}`;
                    document.getElementById('full-name').textContent = worker.full_name;
                    document.getElementById('email').textContent = worker.email;
                    document.getElementById('phone').textContent = worker.mobile_number;
                    document.getElementById('address').textContent = worker.address;
                    document.getElementById('area').textContent = worker.area;
                    document.getElementById('work-field').textContent = worker.field;
                    document.getElementById('experiance').textContent = worker.work_experience;
                    document.getElementById('description').textContent = worker.description;

                    // Add OpenStreetMap
                    const lat = worker.latitude;
                    const lng = worker.longitude;
                    const mapDiv = document.getElementById('map');
                    const map = L.map(mapDiv).setView([lat, lng], 15);

                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                    }).addTo(map);

                    L.marker([lat, lng]).addTo(map);
                } else {
                    alert('Error fetching worker details');
                }
            })
           .catch(error => {
                console.error('Error fetching worker details:', error);
            });
    }
</script>

<!-- Load Leaflet library -->
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />

<script>
    var profile = document.getElementById('profile');
    var list = document.getElementById('drop-down');
    let clickCount = 0;
    profile.addEventListener('click', () => {
        clickCount++;
        if (clickCount % 2!= 0) {
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
        let userpresent = document.getElementById('user-login');
        let usernotpresent = document.getElementById('user-not-login');
        localStorage.removeItem('user');
        window.location.href = '../temp.php';
    });
</script>