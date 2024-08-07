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

// Get POST data
$bajaj_id = $_POST['bajaj_id']; // Include Bajaj ID to differentiate entries
$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];
$passenger_count = $_POST['passenger_count'];
$motor_state = $_POST['motor_state'];

// Check if entry for this Bajaj ID exists
$sql_check = "SELECT * FROM bajaj_data WHERE bajaj_id = '$bajaj_id'";
$result = $conn->query($sql_check);

if ($result->num_rows > 0) {
    // Update existing record
    $sql = "UPDATE bajaj_data SET latitude='$latitude', longitude='$longitude', passenger_count='$passenger_count', motor_state='$motor_state' WHERE bajaj_id='$bajaj_id'";
} else {
    // Insert new record
    $sql = "INSERT INTO bajaj_data (bajaj_id, latitude, longitude, passenger_count, motor_state) VALUES ('$bajaj_id', '$latitude', '$longitude', '$passenger_count', '$motor_state')";
}

if ($conn->query($sql) === TRUE) {
    echo "Data updated successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
