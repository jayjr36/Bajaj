<?php
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "bajaj_tracking";
// Create connection

$conn = new mysqli("localhost", "admin","admin1234", "bajaji");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Default bajaj_id if not provided
$bajaj_id = isset($_GET['bajaj_id']) ? intval($_GET['bajaj_id']) : 1;

// Query to get the switch state for the specified Bajaj ID
$sql = "SELECT switch FROM switch_state WHERE bajaj_id = ? ORDER BY timestamp DESC LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $bajaj_id);
$stmt->execute();
$stmt->bind_result($switch_state);

if ($stmt->fetch()) {
    echo "switch_state=" . $switch_state;
} else {
    echo "Error: No switch state found for bajaj_id " . $bajaj_id;
}

$stmt->close();
$conn->close();
?>
