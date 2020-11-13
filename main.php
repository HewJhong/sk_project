<?php 
require_once 'authController.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title id="title">Home</title>
    <link href='https://fonts.googleapis.com/css?family=Galada' rel='stylesheet'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <div class="header">
        <h1 style="font-family: 'Galada';font-size: 40px;"class="top-title text-center">Sistem Penilaian Kuiz Matematik</h1>
        <button type="text" class="top-title text-center navbar-btn-logout" onclick="destroysession()">Log Out</button>
        <button class="top-title text-center navbar-btn" onclick="quizpage()">Kuiz</button>
        <button class="top-title text-center navbar-btn" onclick="resultpage()">Keputusan</button>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
    crossorigin="anonymous"></script>
    <script>
    function quizpage() {
        $("#main-content").load("studenthome.php")
    }
    function resultpage() {
        $("#main-content").load("studenthome.php")
    }
    function kuiztitle() {
        $("#title").load("kuiztitle.php")
    }
    function destroysession() {
        <?php 
        // session_destroy();
        ?>
        window.location.href = "./logKeluar.php";
    }
    </script>   
</head>
<body>
    <div id="main-content">
        <p>Welcome <?php echo $_SESSION['username'];?></p>
    </div>
</body>
</html>