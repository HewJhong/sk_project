<html>
<head>
    <title>Log Masuk</title>
    <link rel="icon" type="image/png" href="Logov2.png">
    <link href='https://fonts.googleapis.com/css?family=Galada' rel='stylesheet'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <div class="header">
    <h1 style="font-family: 'Galada';font-size: 40px;" class="text-center navbar-home">Selamat Datang ke</h1>
    <h1 style="font-family: 'Galada';font-size: 50px;"class="text-center navbar-home" onclick="homepage()">Sistem Penilaian Kuiz Matematik</h1>
    </div>
    <?php require_once 'authController.php';
    if (isset($_SESSION['NoP']) || isset($_SESSION['NoTel'])) {
        if ($_SESSION['Peranan'] == "murid") {
            header("Location: studentmain.php?page=studenthome");
            exit();
        } else {
            header ("Location: adminmain.php?page=adminhome");
            exit();     
        }
    }
    ?>
    <script>
    document.cookie = "currentZoom = 100";
    </script>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form-div">
                <form action="login.php" method="post">
                    <h3 class="text-center">Log Masuk</h3>

                    <?php if(count($errors) > 0): ?>
                    <div class="alert alert-danger">
                    <?php foreach($errors as $error):?>
                        <li class="alert-tag"><?php echo $error; ?></li>
                    <?php endforeach;?>
                    </div>
                    <?php endif ?>

                    <div class="form-group">
                        <label for="username">No. Pengguna atau No. Telefon</label>
                        <input type="text" name="NoP" value="<?php echo $NoP; ?>" class="form-control form-control-lg" autocomplete="off";>
                    </div>
                    <div class="form-group">
                        <label for="KataLaluan">Kata Laluan</label>
                        <input type="password" name="KataLaluan" class="form-control form-control-lg" autocomplete="off";>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="login-btn" class="btn btn-primary btn-block btn-lg">Log Masuk</button>
                    </div>
                    <p class="text-center">Belum daftar? Daftar di <a href="signup.php">sini</a></p>
                </form>
            </div>
        </div>
    </div>
</body>
</html>