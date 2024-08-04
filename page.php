<?php
session_start();
include("config.php");

// Fetch Bajaj records from the database
$query = "SELECT * FROM bajaj";
$query_run = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Bajaj Management</title>
    <link rel="stylesheet" href="CSS/bootstrap.min.css">
    <style>
        body {
            background-color: #e0e5ec; /* Light gray background to enhance neomorphism */
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .card-custom {
            min-height: 200px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 20px;
            margin: 15px;
            border-radius: 15px;
            box-shadow: 6px 6px 10px rgba(0, 0, 0, 0.2), 
                        -6px -6px 10px rgba(255, 255, 255, 0.8); /* Neomorphism shadow */
            background: #e0e5ec; /* Same as body background for neomorphism effect */
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .card-custom:hover {
            transform: translateY(-5px);
            box-shadow: 8px 8px 15px rgba(0, 0, 0, 0.3), 
                        -8px -8px 15px rgba(255, 255, 255, 0.7); /* Enhanced shadow on hover */
        }
        .card-title {
            font-size: 1.3rem;
            font-weight: bold;
            color: #333;
        }
        .card-text {
            font-size: 1rem;
            color: #555;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            border-radius: 20px; /* Rounded button corners */
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
        .btn-register {
            background-color: #28a745;
            border-color: #28a745;
            border-radius: 20px;
            color: white;
            font-size: 1rem;
            margin-top: 20px;
        }
        .btn-register:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }

        /* Responsive styles */
        @media (max-width: 768px) {
            .card-custom {
                margin: 10px;
                padding: 15px;
            }
            .card-title {
                font-size: 1.2rem;
            }
            .card-text {
                font-size: 0.9rem;
            }
            .btn-primary, .btn-register {
                font-size: 0.9rem;
            }
        }

        @media (max-width: 576px) {
            .card-custom {
                margin: 5px;
                padding: 10px;
            }
            .card-title {
                font-size: 1rem;
            }
            .card-text {
                font-size: 0.8rem;
            }
            .btn-primary, .btn-register {
                font-size: 0.8rem;
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
                <li class="nav-item"><a class="nav-link" href="index.php">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Main Section -->
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <?php 
            if (mysqli_num_rows($query_run) > 0) {
                foreach ($query_run as $bajaj) {
                    ?>
                    <div class="col-md-4 col-lg-3">
                        <div class="card bg-light card-custom">
                            <div class="card-body">
                                <h5 class="card-title">Model: <?php echo htmlspecialchars($bajaj['model']); ?></h5>
                                <p class="card-text">License Plate: <?php echo htmlspecialchars($bajaj['license_plate']); ?></p>
                                <a href="bajaj_details.php?id=<?php echo $bajaj['bajaj_id']; ?>" class="btn btn-primary">View Details</a>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "<h5>No Bajaj Records Found</h5>";
            }
            ?>
        </div>
        <!-- Register Button -->
        <div class="text-center">
            <a href="register_bajaj.php" class="btn btn-register">Register New Bajaj</a>
        </div>
    </div>
</section>

<!-- Footer-->
<footer class="py-4 bg-dark">
    <div class="container"><p class="m-0 text-center text-white">&copy; 2024 Bajaj Management</p></div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
