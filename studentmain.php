<?php require_once 'authController.php';?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title id="title">Home</title>
    <link href='https://fonts.googleapis.com/css?family=Galada' rel='stylesheet'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
    crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" 
    integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" 
    crossorigin="anonymous"></script>
    <script src="changepage.js"></script>
    <nav id="navbar" class="navbar navigation">
    <p style="font-family: 'Galada';font-size: 40px;"class="navbar-home" onclick="studenthome()">Sistem Penilaian Kuiz Matematik</p>
    <p class="account-status">Akaun Murid</p>
    <div class="float-right">
    <button class="navbar-btn btn btn-secondary btn-lg" id="home-btn" onclick="studenthome(); hometitle()">Home</button>
    <button class="navbar-btn btn btn-secondary btn-lg" id="score-btn" onclick="studentresult()">Keputusan</button>
    <button class="navbar-btn btn btn-secondary btn-lg" id="score-btn" onclick="studentkuizlist()">Kuiz</button>
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
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" 
    integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" 
    crossorigin="anonymous">
    </script>
    <script>
    $(document).on('click', '#dropdown-btn', function() {
        $('#kuizdropdownbtn').dropdown('toggle');
    });
    </script> 
</head>
<body style="overflow: hidden;">

    <script>
        window.history.pushState('', null, './');
        $(window).on('popstate', function() {
            window.location.reload();
        });
    </script>

    <div id="main-content"  style="overflow-x: hidden; overflow-y: scroll; height: 89%;"></div>
    <?php 
    if (!isset($_SESSION['nop'])) {
        header ("Location: login.php");
        exit();
    }
    else if ($_GET['page'] == "studenthome"){
        echo "<script>studenthome();</script>";
    }
    else if ($_GET['page'] == "studentresult"){
        echo "<script>studentresult();</script>";
    }
    else if ($_GET['page'] == "studentkuizlist"){
        echo "<script>studentkuizlist();</script>";
    }
    else if ($_GET['page'] == "studentjawabkuiz"){
        echo "<script>studentjawabkuiz();</script>";
    }
?>
</body>
</html>