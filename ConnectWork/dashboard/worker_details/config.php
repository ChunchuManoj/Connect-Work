<?php
// config.php

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Function to get worker details
function getWorkerDetails($conn, $id) {
  $sql = "SELECT * FROM workers WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $id); // "i" indicates integer type for the ID
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $row['latitude'] = (float) $row['latitude']; // Convert latitude to float
    $row['longitude'] = (float) $row['longitude']; // Convert longitude to float
    return array(
      'success' => true,
      'worker' => $row
    );
  } else {
    return array(
      'success' => false
    );
  }
}

// Handle request
if (isset($_GET['action']) && $_GET['action'] == 'getWorkerDetails') {
  if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $response = getWorkerDetails($conn, $id);
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
  } else {
    echo json_encode(array('success' => false, 'message' => 'Worker ID is missing'));
    exit;
  }
}

$conn->close();
?>