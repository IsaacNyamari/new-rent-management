<?php
require "./includes/functions.php";
$imagePath = loadAsset('assets/images/logo.png');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Rent Management System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="<?php echo loadAsset('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo loadAsset('assets/css/fontawesome/css/fontawesome.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo loadAsset('assets/css/fontawesome/css/solid.min.css'); ?>" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
        }

        .landing-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card {
            border-radius: 1rem;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.08);
        }

        .logo-img {
            width: 80px;
            height: 80px;
            object-fit: contain;
        }
    </style>
</head>

<body>
    <div class="landing-container">
        <div class="card p-5 text-center">
            <div class="d-flex justify-content-center mb-3">
                <img src="<?php echo $imagePath; ?>" alt="Company logo showing a stylized building with the text Rent Management System below, conveying a professional and welcoming atmosphere for property management" class="logo-img">
            </div>
            <h1 class="mb-3"><i class="fas fa-building text-success"></i> Rent Management System</h1>
            <p class="lead mb-4">
                Manage your properties, tenants, and payments with ease.<br>
                Secure, simple, and efficient.
            </p>
            <a href="login.php" class="btn btn-success btn-lg me-2 mb-2">
                <i class="fas fa-sign-in-alt"></i> Login
            </a>
            <a href="register.php" class="btn btn-outline-success btn-lg">
                <i class="fas fa-user-plus"></i> Register
            </a>
        </div>
    </div>
    <script src="<?php echo loadAsset('assets/js/bootstrap.bundle.min.js'); ?>"></script>
</body>

</html>