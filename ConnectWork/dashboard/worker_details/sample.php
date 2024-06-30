<!DOCTYPE html>
<html>

<head>
    <title>Worker Profile</title>
    <!-- <link rel="stylesheet" type="text/css" href="./style.css"> -->
</head>

<body>
    <div id="worker-profile">
        <h2>Worker Profile</h2>
        <img id="profile-pic" src="" alt="Profile Pic">
        <h3 id="full-name"></h3>
        <p id="email"></p>
        <p id="phone"></p>
        <p id="address"></p>
        <p id="work-field"></p>
        <p id="experience"></p>
        <p id="description"></p>
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
                    document.getElementById('work-field').textContent = worker.field;
                    document.getElementById('experience').textContent = worker.experience;
                    document.getElementById('description').textContent = worker.description;

                    // Add Google Map
                    const lat = worker.latitude;
                    const lng = worker.longitude;
                    const mapDiv = document.getElementById('map');
                    const map = new google.maps.Map(mapDiv, {
                        center: {
                            lat,
                            lng
                        },
                        zoom: 15
                    });
                    const marker = new google.maps.Marker({
                        position: {
                            lat,
                            lng
                        },
                        map,
                        title: worker.full_name
                    });
                } else {
                    alert('Error fetching worker details');
                }
            })
            .catch(error => {
                console.error('Error fetching worker details:', error);
                alert('Error fetching worker details');
            });
    }
    </script>
    <!-- Load Google Maps API -->
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap">
    </script>
</body>

</html>