<?php require_once 'auth.php';
if (isset($_SESSION['nop']) || isset($_SESSION['notel'])) {
    if ($_SESSION['peranan'] == "murid") {
        header("Location: studentmain.php");
        exit();
    } else {
        header ("Location: adminmain.php");
        exit();     
    }
}
?>
<!DOCTYPE html>
<head>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
    crossorigin="anonymous"></script>
    <title>Login</title>
    <link href='https://fonts.googleapis.com/css?family=Galada' rel='stylesheet'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <div class="header">
    <h1 style="font-family: 'Galada';font-size: 40px;" class="text-center navbar-home">Selamat Datang ke</h1>
    <h1 style="font-family: 'Galada';font-size: 50px;"class="text-center navbar-home" onclick="homepage()">Sistem Penilaian Kuiz Matematik</h1>
    </div>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form-div">
                <form id="main" action="login.php" method="post">
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
                        <input id="nop" type="text" name="nop" value="<?php echo $nop; ?>" class="form-control form-control-lg" autocomplete="off";>
                    </div>
                    <div class="form-group">
                        <label for="password">Kata Laluan</label>
                        <input id="password" type="password" name="password" class="form-control form-control-lg" autocomplete="off";>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block btn-lg">Log Masuk</button>
                    </div>
                    <p class="text-center">Belum daftar? Daftar di <a href="signup.php">sini</a></p>
                    <script type="text/Javascript">
                    $(document).ready(function () {
                    // Listen to submit event on the <form> itself!
                    $('#main').submit(function (e) {

                        e.preventDefault();

                        var nop = $("#nop").val();
                        var password = $("#password").val();

                        $.post("auth.php", {
                        nop: nop,
                        password: password
                        }).always(function() {
                            console.log("Success");
                        });
                    });
                    });
                    </script>
                </form>
            </div>
        </div>
    </div>
</body>
</html>