<?php require_once 'authController.php';
if (isset($_SESSION['username'])) {
    if ($_SESSION['role'] == "murid") {
        header("Location: studentmain.php");
        exit();
    } else {
        header ("Location: adminmain.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link href='https://fonts.googleapis.com/css?family=Galada' rel='stylesheet'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="styles.css">
    <div class="header">
    <h1 style="font-family: 'Galada';font-size: 40px;" class="text-center navbar-home">Selamat Datang ke</h1>
    <h1 style="font-family: 'Galada';font-size: 50px;"class="top-title text-center navbar-home" onclick="homepage()">Sistem Penilaian Kuiz Matematik</h1>
    </div>
</head> 
<body style="overflow: hidden;">
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form-div">
                <form action="signup.php" method="post">
                    <h3 class="text-center">Pendaftaran</h3>

                    <?php if(count($errors) > 0): ?>
                    <div class="alert alert-danger">
                    <?php foreach($errors as $error):?>
                        <li><?php echo $error; ?></li>
                    <?php endforeach;?>
                    </div>
                    <?php endif ?>

                    <div class="form-group">
                        <label for="username">No. Pengguna</label>
                        <input type="text" name="nop" value="<?php echo $nop;?>" class="form-control form-control-lg">
                    </div>
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" name="name" value="<?php echo $name;?>" class="form-control form-control-lg">
                    </div>
                    <div class="form-group">
                        <label for="notel">Nombor Telefon</label>
                        <input type="text" name="notel" value="<?php echo $notel;?>" class="form-control form-control-lg">
                    </div>
                    <div class="form-group">
                        <label for="password">Kata Laluan</label>
                        <input type="password" name="password" class="form-control form-control-lg">
                    </div>
                    <div class="form-group">
                        <label for="passwordConf">Sahkan Kata Laluan</label>
                        <input type="password" name="passwordConf" class="form-control form-control-lg">
                    </div>
                    <div class="form-group">
                        <button type="submit" name="signup-btn" class="btn btn-primary btn-block btn-lg">Sign Up</button>
                    </div>
                    <p class="text-center">Sudah daftar? Log masuk di <a href="login.php">sini</a></p>
                </form>
            </div>
        </div>
    </div>
</body>
</html>