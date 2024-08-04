<?php
// Database connection details
$servername = "localhost"; // Change this to your database server name if different
$username = "root"; // Change this to your database username
$password = ""; // Change this to your database password
$dbname = "solar_panel";

// Check if POST data exists
if(isset($_POST['Dust']) && isset($_POST['temp'])) {
    // Get POST data
    $dustValue = $_POST['Dust'];
    $temperature = $_POST['temp'];

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL to insert data into the table
    $sql = "INSERT INTO solar_details (dust, temp) VALUES ('$dustValue', '$temperature')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
} else {
    echo "Error: POST data not received";
}
?>
