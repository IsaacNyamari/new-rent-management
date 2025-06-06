<?php require "./includes/header.php";
$imagePath = loadAsset('assets/images/logo-1.png');
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow">
                <div class="card-body">
                    <div class="d-flex justify-content-center mb-3 top-0">
                        <img src="<?php echo $imagePath; ?>" alt="Company logo showing a stylized building with the text Rent Management System below, conveying a professional and welcoming atmosphere for property management" class="logo-img">
                    </div>
                    <h2 class="mb-4 text-center"><i class="fa fa-sign-in-alt"></i> Login</h2>
                    <form method="post" action="#" id="login">
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($email ?? '') ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-success w-100"><i class="fa fa-sign-in-alt"></i> Login</button>
                    </form>
                    <div class="mt-3 text-center">
                        Don't have an account? <a href="<?php echo loadAsset("register.php")?>">Register</a></div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require "./includes/footer.php" ?>