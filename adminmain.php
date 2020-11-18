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
    <div id="navbar" class="header">
        <button style="font-family: 'Galada';font-size: 40px;"class="top-title text-center navbar-home" onclick="homepage()">Sistem Penilaian Kuiz Matematik</button>
        <button type="text" class="top-title text-center navbar-btn-logout" onclick="destroysession()">Log Out</button>
        <a class="text-center account-status">Akaun <?php echo $_SESSION['peranan'];?></a>
        <button class="top-title text-center navbar-btn" onclick="quizpage()">Kuiz</button>
        <button class="top-title text-center navbar-btn" onclick="resultpage()">Keputusan</button>
        <button class="top-title text-center navbar-btn active" onclick="homepage()">Home</button>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
    crossorigin="anonymous"></script>
    <script>
    $(document).ready(function(){
        // set default page
        quizpage();
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
        $("#main-content").load("adminhome.php");
    }
    function quizpage() {
        $("#main-content").load("adminkuiz.php");
    }
    function resultpage() {
        $("#main-content").load("studentresult.php");
    }
    function kuiztitle() {
        $("#title").load("kuiztitle.php");
    }
    function destroysession() {
        window.location.href = "./logKeluar.php";
    }
    </script>   
</head>
<body style="overflow: hidden;">
    <div id="main-content"  style="overflow-x: hidden; overflow-y: scroll; height: 89%;">
    </div>
</body>
</html>