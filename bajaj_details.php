<?php
session_start();
include("config.php");

// Get Bajaj ID from query parameter
$bajaj_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch Bajaj details from the database
$query = "SELECT * FROM bajaj WHERE bajaj_id = $bajaj_id";
$result = mysqli_query($con, $query);
$bajaj = mysqli_fetch_assoc($result);

// Fetch the current switch state
$switch_query = "SELECT switch FROM switch_state WHERE id = 1";
$switch_result = mysqli_query($con, $switch_query);
$switch_state = mysqli_fetch_assoc($switch_result);

// Fetch the motor state
$motor_query = "SELECT motor_state FROM bajaj_data WHERE bajaj_id = $bajaj_id ORDER BY timestamp DESC LIMIT 1";
$motor_result = mysqli_query($con, $motor_query);
$motor_data = mysqli_fetch_assoc($motor_result);
$motor_state = isset($motor_data['motor_state']) ? $motor_data['motor_state'] : '0'; // Default to '0' if not set

// Handle switch state toggle request
if (isset($_GET['switch'])) {
    $switch = $_GET['switch'];
    $update_query = "UPDATE switch_state SET switch = '$switch', timestamp = CURRENT_TIMESTAMP WHERE id = 1";
    mysqli_query($con, $update_query);
    // Refresh the page to reflect changes
    header("Location: " . $_SERVER['PHP_SELF'] . "?id=" . $bajaj_id);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Bajaj Details</title>
    <link rel="stylesheet" href="CSS/bootstrap.min.css">
    <style>
        body {
            background-color: #e0e5ec; /* Light gray background to enhance glass effect */
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .card-custom {
            min-height: 220px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 20px; /* Adjusted padding */
            margin: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            background: rgba(255, 255, 255, 0.2); /* Increased opacity for glass effect */
            backdrop-filter: blur(15px); /* Stronger blur effect */
            -webkit-backdrop-filter: blur(15px); /* For Safari */
            border: 1px solid rgba(255, 255, 255, 0.3); /* More visible border */
        }
        .card-title {
            font-size: 1.4rem; /* Adjusted font size for better responsiveness */
            font-weight: bold;
            margin-bottom: 15px;
            color: #ffffff;
        }
        .form-switch {
            margin-top: 20px;
        }
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
            transition: background-color 0.3s ease-in-out;
        }
        .switch input {
            display: none;
        }
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
            border-radius: 34px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }
        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }
        input:checked + .slider {
            background-color: #2196F3;
        }
        input:checked + .slider:before {
            transform: translateX(26px);
        }
        .motor-status {
            margin-top: 20px;
            font-size: 1.2rem;
            font-weight: bold;
            color: #ffffff;
        }
        .status-moving {
            color: #28a745; /* Green for Moving */
        }
        .status-stopped {
            color: #dc3545; /* Red for Stopped */
        }
        .navbar {
            margin-bottom: 30px;
        }
        footer {
            margin-top: 30px;
        }

        /* Responsive styles */
        @media (max-width: 768px) {
            .card-custom {
                padding: 15px;
            }
            .card-title {
                font-size: 1.2rem;
            }
            .switch {
                width: 50px;
                height: 28px;
            }
            .slider:before {
                height: 22px;
                width: 22px;
            }
            .motor-status {
                font-size: 1rem;
            }
        }

        @media (max-width: 576px) {
            .card-custom {
                padding: 10px;
            }
            .card-title {
                font-size: 1rem;
            }
            .switch {
                width: 40px;
                height: 24px;
            }
            .slider:before {
                height: 18px;
                width: 18px;
            }
            .motor-status {
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>

<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">Bajaj Management</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="page.php">Back to List</a></li>
                <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Main Section -->
<section class="py-5">
    <div class="container">
        <?php if ($bajaj): ?>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card bg-light card-custom">
                    <div class="card-body">
                        <h5 class="card-title text-info">Model: <?php echo htmlspecialchars($bajaj['model']); ?></h5>
                        <p class="card-text">License Plate: <?php echo htmlspecialchars($bajaj['license_plate']); ?></p>
                        <p class="card-text">Owner: <?php echo isset($bajaj['owner']) ? htmlspecialchars($bajaj['owner']) : 'N/A'; ?></p>

                        <?php
                        // Fetch the latest Bajaj data for the specific Bajaj ID
                        $data_query = "SELECT * FROM bajaj_data WHERE bajaj_id = $bajaj_id ORDER BY timestamp DESC LIMIT 1";
                        $data_result = mysqli_query($con, $data_query);
                        $bajaj_data = mysqli_fetch_assoc($data_result);
                        ?>

                        <?php if ($bajaj_data): ?>
                        <p><strong>Latitude:</strong> <?php echo htmlspecialchars($bajaj_data['latitude']); ?></p>
                        <p><strong>Longitude:</strong> <?php echo htmlspecialchars($bajaj_data['longitude']); ?></p>
                        <p><strong>Passenger Count:</strong> <?php echo htmlspecialchars($bajaj_data['passenger_count']); ?></p>
                        <p><strong>Google Maps:</strong> <a href="https://maps.google.com/?q=<?php echo urlencode($bajaj_data['latitude']); ?>,<?php echo urlencode($bajaj_data['longitude']); ?>" target="_blank">View Location</a></p>

                        <div class="form-check form-switch">
                            <label class="form-check-label" for="switch">Relay Control</label>
                            <label class="switch">
                                <input type="checkbox" id="switch" <?php echo $switch_state['switch'] == 'ON' ? 'checked' : ''; ?> onchange="toggleSwitch(this)">
                                <span class="slider"></span>
                            </label>
                        </div>

                        <div class="motor-status <?php echo $motor_state == '1' ? 'status-moving' : 'status-stopped'; ?>">
                            Bajaj is <?php echo $motor_state == '1' ? 'Moving' : 'Stopped'; ?>
                        </div>
                        <?php else: ?>
                        <p>No data available for this Bajaj.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php else: ?>
        <div class="alert alert-warning" role="alert">
            Bajaj not found.
        </div>
        <?php endif; ?>
    </div>
</section>

<!-- Footer-->
<footer class="py-4 bg-dark">
    <div class="container"><p class="m-0 text-center text-white">&copy; 2024 Bajaj Management</p></div>
</footer>

<script>
function toggleSwitch(element) {
    var switchState = element.checked ? 'ON' : 'OFF';
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "?id=<?php echo $bajaj_id; ?>&switch=" + switchState, true);
    xhr.send();
}
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
