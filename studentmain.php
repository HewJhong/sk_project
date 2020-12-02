<?php require_once 'authController.php';
if (!isset($_SESSION['nop'])) {
    header ("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title id="title">Home</title>
    <link href='https://fonts.googleapis.com/css?family=Galada' rel='stylesheet'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <nav id="navbar" class="navbar navigation">
    <p style="font-family: 'Galada';font-size: 40px;"class="navbar-home" onclick="homepage()">Sistem Penilaian Kuiz Matematik</p>
    <p class="account-status">Akaun Murid</p>
    <div class="float-right">
    <button class="navbar-btn btn btn-secondary btn-lg" onclick="homepage(); hometitle()">Home</button>
    <button class="navbar-btn btn btn-secondary btn-lg" onclick="resultpage()">Keputusan</button>
    <div class="dropdown dropmenu">
    <button type="button" data-toggle="dropdown" class="navbar-btn btn btn-secondary btn-lg dropdown-toggle">Quiz</button>
    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <button class="dropdown-item" onclick="quizlistpage()">Senarai Kuiz</button>
          <div class="dropdown-divider"></div>
          <button class="dropdown-item" onclick="quizpage(); kuiztitle()">Tambah Kuiz Baharu</button>
    </div>
    </div>
    <button type="text" class="btn btn-warning navbar-btn-logout" onclick="destroysession()">Log Out</button>
    </div>
    </nav>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
    crossorigin="anonymous"></script>
    <script>
    $(document).ready(function(){
        homepage();
        var btnContainer = document.getElementById("navbar");

        // Get all buttons with class="btn" inside the container
        var btns = btnContainer.getElementsByClassName("navbar-btn");

        // Loop through the buttons and add the active class to the current/clicked button
        for (var i = 0; i < btns.length; i++) {
        btns[i].addEventListener("click", function() {
            var current = document.getElementsByClassName("active");
            current[0].className = current[0].className.replace(" active", "");
            this.className += " active";
        });
}
    })
    function homepage() {
        $("#main-content").load("studenthome.php")
    }
    function quizpage() {
        $("#main-content").load("studentquiz.php")
    }
    function resultpage() {
        $("#main-content").load("studentresult.php")
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
    </div>
</body>
</html>