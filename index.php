<?php 
session_start();
include("config.php");

if(isset($_POST['login'])) { 
    $uemail = $_POST['username'];  
    $upass = $_POST['password'];  
    if(!empty($uemail) && !empty($upass)) {
        $sql = "SELECT * FROM user WHERE email='$uemail' AND password='$upass'";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($result);
        $count = mysqli_num_rows($result);
        if($count == 1) {
            $_SESSION['email'] = $uemail;
            header('location: page.php');
            exit;
        } else {
            $error = "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong>Hey!</strong> Email & Password does not match!
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Glassmorphism Login Form</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <style>
        *,
        *::before,
        *::after {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }
        body {
            background-color: #080710;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .background {
            width: 100%;
            height: 100%;
            position: absolute;
            left: 0;
            top: 0;
            z-index: -1;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }
        .shape {
            position: absolute;
            border-radius: 50%;
        }
        .shape:first-child {
            background: linear-gradient(#1845ad, #23a2f6);
            height: 200px;
            width: 200px;
            left: -100px;
            top: -100px;
        }
        .shape:last-child {
            background: linear-gradient(to right, #ff512f, #f09819);
            height: 200px;
            width: 200px;
            right: -100px;
            bottom: -100px;
        }
        form {
            width: 100%;
            max-width: 400px;
            background-color: rgba(255, 255, 255, 0.13);
            border-radius: 10px;
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 0 40px rgba(8, 7, 16, 0.6);
            padding: 50px 35px;
            position: relative;
        }
        form * {
            font-family: 'Poppins', sans-serif;
            color: #ffffff;
            letter-spacing: 0.5px;
            outline: none;
            border: none;
        }
        form h3 {
            font-size: 32px;
            font-weight: 500;
            line-height: 42px;
            text-align: center;
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-top: 30px;
            font-size: 16px;
            font-weight: 500;
        }
        input {
            display: block;
            height: 50px;
            width: 100%;
            background-color: rgba(255, 255, 255, 0.07);
            border-radius: 3px;
            padding: 0 10px;
            margin-top: 8px;
            font-size: 14px;
            font-weight: 300;
        }
        ::placeholder {
            color: #e5e5e5;
        }
        .button {
            margin-top: 30px;
            width: 100%;
            background-color: #ffffff;
            color: #080710;
            padding: 15px 0;
            font-size: 18px;
            font-weight: 600;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .button:hover {
            background-color: #e0e0e0;
        }
        .social {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
        }
        .social div {
            background-color: rgba(255, 255, 255, 0.27);
            width: 48%;
            border-radius: 3px;
            padding: 5px;
            text-align: center;
            color: #eaf0fb;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .social div:hover {
            background-color: rgba(255, 255, 255, 0.47);
        }
        .social i {
            margin-right: 4px;
        }
        @media (max-width: 600px) {
            .shape {
                height: 150px;
                width: 150px;
            }
            .shape:first-child {
                left: -70px;
                top: -70px;
            }
            .shape:last-child {
                right: -70px;
                bottom: -70px;
            }
            form {
                width: 90%;
                padding: 30px 20px;
            }
            form h3 {
                font-size: 24px;
            }
            input {
                height: 45px;
                font-size: 12px;
            }
            .button {
                font-size: 16px;
            }
            .social div {
                width: 48%;
                font-size: 14px;
                padding: 5px 10px;
            }
        }
    </style>
</head>
<body>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <form method="POST">
        <h3>Login Here</h3>

        <label for="username">Username</label>
        <input type="text" placeholder="Email or Phone" id="username" name="username" required>

        <label for="password">Password</label>
        <input type="password" placeholder="Password" id="password" name="password" required>

        <input type="submit" class="button" name="login" value="Login">
        <div class="social">
            <div class="go"><i class="fab fa-google"></i> Google</div>
            <div class="fb"><i class="fab fa-facebook"></i> Facebook</div>
        </div>
    </form>
</body>
</html>
