<?php require_once 'authController.php';
if (isset($_SESSION['username']) || isset($_SESSION['notel'])) {
    if ($_SESSION['peranan'] == "murid") {
        header("Location: studentmain.php");
        exit();
    } else {
        header ("Location: adminmain.php");
    }
}
?>
<!DOCTYPE html>
<head>
    <title>Login</title>
    <link href='https://fonts.googleapis.com/css?family=Galada' rel='stylesheet'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <div class="header">
    <h1 style="font-family: 'Galada';font-size: 40px;" class="text-center navbar-home">Selamat Datang ke</h1>
    <h1 style="font-family: 'Galada';font-size: 50px;"class="text-center navbar-home" onclick="homepage()">Sistem Penilaian Kuiz Matematik</>
    </div>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form-div">
                <form action="login.php" method="post">
                    <h3 class="text-center">Login</h3>

                    <?php if(count($errors) > 0): ?>
                    <div class="alert alert-danger">
                    <?php foreach($errors as $error):?>
                        <li class="alert-tag"><?php echo $error; ?></li>
                    <?php endforeach;?>
                    </div>
                    <?php endif ?>

                    <div class="form-group">
                        <label for="username">Username or Telefon Number</label>
                        <input type="text" name="username" value="<?php echo $username; ?>" class="form-control form-control-lg">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control form-control-lg">
                    </div>
                    <div class="form-group">
                        <button type="submit" name="login-btn" class="btn btn-primary btn-block btn-lg">Login</button>
                    </div>
                    <p class="text-center">Not yet a member?<a href="signup.php"> Sign Up </a></p>
                </form>
            </div>
        </div>
    </div>
</body>
</html>