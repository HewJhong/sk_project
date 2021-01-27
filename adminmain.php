<?php require_once 'authController.php';?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title id="title">Home</title>
    <link href='https://fonts.googleapis.com/css?family=Galada' rel='stylesheet'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <!-- <div id="navbar" class="header">
        <button style="font-family: 'Galada';font-size: 40px;"class="top-title text-center navbar-home" onclick="homepage()">Sistem Penilaian Kuiz Matematik</button>
        <button type="text" class="top-title text-center navbar-btn-logout" onclick="destroysession()">Log Out</button>
        <p class="text-center account-status">Akaun <?php echo $_SESSION['peranan'];?></p>
        <button class="top-title text-center navbar-btn" onclick="quizpage()">Kuiz</button>
        <button class="top-title text-center navbar-btn" onclick="resultpage()">Keputusan</button>
        <button class="top-title text-center navbar-btn active" onclick="homepage()">Home</button>
    </div> -->
    <nav id="navbar" class="navbar navigation">
    <p style="font-family: 'Galada';font-size: 40px;"class="navbar-home" onclick="homepage()">Sistem Penilaian Kuiz Matematik</p>
    <p class="account-status">Akaun Admin</p>
    <div class="float-right">
    <button class="navbar-btn btn btn-secondary btn-lg" id="home-btn" onclick="homepage(); hometitle()">Home</button>
    <button class="navbar-btn btn btn-secondary btn-lg" id="score-btn" onclick="resultpage()">Keputusan</button>
    <div class="dropdown dropmenu">
    <button type="button" id='kuizdropdown-btn' data-toggle="dropdown" class="navbar-btn btn btn-secondary btn-lg dropdown-toggle">Kuiz</button>
    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <button class="dropdown-item" id="dropdown-btn" onclick="quizlistpage()">Senarai Kuiz</button>
          <div class="dropdown-divider"></div>
          <button class="dropdown-item" id="dropdown-btn" onclick="quizpage(); kuiztitle()">Tambah Kuiz Baharu</button>
    </div>
    </div>
    <button type="text" class="btn btn-warning navbar-btn-logout" onclick="destroysession()">Log Out</button>
    </div>
    </nav>
    <!-- errors alert box -->
    <?php if(count($errors) > 0): ?>
        <div class="alertmessage">
            <div class="alert alert-warning alert-dismissible fade show alertbox" role="alert">
            <?php foreach($errors as $error):?>
                <li><?php echo $error; ?></li>
            <?php endforeach;?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>
            </div>
    <?php endif ?>
</head>
<body style="overflow: hidden;">
    <div id="main-content"  style="overflow-x: hidden; overflow-y: scroll; height: 89%;"></div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
    crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" 
    integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" 
    crossorigin="anonymous"></script>
    <script src="changepage.js"></script>
    <script>
    $(document).ready(function(){
        // $("#main-content").load("adminhome.php");
    });
    $(document).on('click', '#dropdown-btn', function() {
        $('#kuizdropdownbtn').dropdown('toggle');
    })
    </script> 
    <?php 
        if (!isset($_SESSION['nop'])) {
            header ("Location: login.php");
            exit();
        }
        else if ($_GET['page'] == "adminhome"){
            echo "<script>homepage();</script>";
        }
        else if ($_GET['page'] == "adminkeputusan"){
            echo "<script>resultpage();</script>";
        }
        else if ($_GET['page'] == "adminkuizlist"){
            echo "<script>quizlistpage();</script>";
        }
        else if ($_GET['page'] == "adminkuiz"){
            echo "<script>quizpage();</script>";
        }
    ?>
</body>
</html>