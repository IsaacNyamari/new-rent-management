<?php
require "path.php";
?>
<!DOCTYPE html>
<html>

<head>
    <title>Property Management System</title>
    <link href="<?php echo loadAsset('assets/images/logo-2.png'); ?>" rel="shortcut icon">
    <link href="<?php echo loadAsset('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo loadAsset('assets/css/fontawesome/css/fontawesome.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo loadAsset('assets/css/fontawesome/css/solid.min.css'); ?>" rel="stylesheet">
<style>
    .btn-hover-animate {
        transition: all 0.3s ease;
        transform: translateY(0);
    }
    .btn-hover-animate:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
</style>
</head>

<body class="bg-light">