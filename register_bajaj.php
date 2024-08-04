<?php
// Database connection
include('config.php');

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ownerName = $_POST['owner_name'];
    $contactInfo = $_POST['contact_info'];
    $model = $_POST['model'];
    $licensePlate = $_POST['license_plate'];

    // Insert owner
    $stmt = $pdo->prepare("INSERT INTO owners (name, contact_info) VALUES (?, ?)");
    $stmt->execute([$ownerName, $contactInfo]);
    $ownerId = $pdo->lastInsertId();

    // Insert Bajaj
    $stmt = $pdo->prepare("INSERT INTO bajaj (model, license_plate) VALUES (?, ?)");
    $stmt->execute([$model, $licensePlate]);
    $bajajId = $pdo->lastInsertId();

    // Associate Bajaj with owner
    $stmt = $pdo->prepare("INSERT INTO bajaj_owners (owner_id, bajaj_id) VALUES (?, ?)");
    $stmt->execute([$ownerId, $bajajId]);

    echo "<div class='container'><p class='success-message'>Bajaj registered successfully!</p></div>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bajaj Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #e0e5ec;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden;
        }
        .container {
            max-width: 400px;
            width: 100%;
            background: #ffffff;
            box-shadow: 8px 8px 15px rgba(0, 0, 0, 0.2), -8px -8px 15px rgba(255, 255, 255, 0.5);
            border-radius: 15px;
            padding: 30px;
            margin: 20px;
        }
        h1 {
            text-align: center;
            color: #333333;
            margin-bottom: 20px;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        input[type="text"] {
            padding: 15px;
            margin: 10px 0;
            border-radius: 10px;
            border: 1px solid #d1d9e6;
            background: #f7f9fc;
            box-shadow: inset 4px 4px 8px rgba(0, 0, 0, 0.1), inset -4px -4px 8px rgba(255, 255, 255, 0.8);
        }
        input[type="submit"] {
            padding: 15px;
            border-radius: 10px;
            border: none;
            background: #28a745;
            color: #ffffff;
            font-size: 16px;
            cursor: pointer;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: background 0.3s ease;
        }
        input[type="submit"]:hover {
            background: #218838;
        }
        .success-message {
            color: #28a745;
            font-size: 18px;
            text-align: center;
        }
        @media (max-width: 600px) {
            .container {
                padding: 20px;
                box-shadow: 6px 6px 12px rgba(0, 0, 0, 0.2), -6px -6px 12px rgba(255, 255, 255, 0.5);
            }
            input[type="text"], input[type="submit"] {
                font-size: 14px;
                padding: 12px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Register Your Bajaj</h1>
        <form method="post">
            <input type="text" name="owner_name" placeholder="Owner Name" required>
            <input type="text" name="contact_info" placeholder="Contact Info" required>
            <input type="text" name="model" placeholder="Bajaj Model" required>
            <input type="text" name="license_plate" placeholder="License Plate" required>
            <input type="submit" value="Register Bajaj">
        </form>
    </div>
</body>
</html>
