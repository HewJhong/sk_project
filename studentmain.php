<html>
<head>
    <meta charset="UTF-8">
    <title id="title">Home</title>
    <link rel="icon" type="image/png" href="Logov2.png">
    <!-- scripts -->
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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" 
    integrity="sha384-vSIIfh2YWi9wW0r9iZe7RJPrKwp6bG+s9QZMoITbCckVJqGCCRhc+ccxNcdpHuYu" 
    crossorigin="anonymous">
    <script src="auto-tables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script src='fontSizeChanger.js'></script>
    <!-- scripts -->
    <nav id="navbar" class="navbar navigation">
    <p style="font-family: 'Galada';font-size: 40px;"class="navbar-home" onclick="studenthome()">Sistem Penilaian Kuiz Matematik</p>
    <p class="account-status">Akaun Murid</p>
    <div class="float-right">
    <button class="navbar-btn btn btn-secondary btn-lg" id="home-btn" onclick="studenthome(); hometitle()">Home</button>
    <div class="dropdown dropmenu">
    <button type="button" id='kuizdropdown-btn' data-toggle="dropdown" class="navbar-btn btn btn-secondary btn-lg dropdown-toggle" aria-haspopup="true" aria-expanded="false">Keputusan</button>
    <div class="dropdown-menu" aria-labelledby="kuizdropdown-btn">
        <button class="dropdown-item" id="dropdown-btn" onclick="studentresult(); keputusankuiztitle();">Keputusan Kuiz</button>
        <div class="dropdown-divider"></div>
        <button class="dropdown-item" id="dropdown-btn" onclick="studentreportcard(); kadlaporantitle();">Kad Laporan</button>
    </div>
    </div>
    <button class="navbar-btn btn btn-secondary btn-lg" id="score-btn" onclick="studentkuizlist(); studentkuiztitle();">Kuiz</button>
    <button id='fontSizeMinus' type="button" class="btn btn-primary btn-lg fontsizectrl" onclick=decreaseFontSize();>-</button>
    <button id='fontSizeAdd' type="button" class="btn btn-primary btn-lg fontsizectrl" onclick=increaseFontSize();>+</button>
    <button type="text" class="btn btn-warning navbar-btn-logout" onclick="destroysession()">Log Out</button>
    </div>
    </nav>
    <?php require_once 'authController.php';?>
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
    </script>
</head>
<body style="overflow: hidden;">

    <script>
        window.history.pushState('', null, './');
        $(window).on('popstate', function() {
            window.location.reload();
        });

        // student submit quiz button (placed here to prevent double echo'ing' the script)

        $(document).on('click', '#jawab-kuiz-submit-btn', function() {
        var count = $('.soalcontainer').length
        var obj = $("#jawabkuizform").serializeArray();
        $.ajax({
        url: 'studentkuizprocessdb.php',
        type: 'POST',
        data: {data: obj, count: count},
        success: function(result){
            if (result == "errorNoAns") {
            $('#warningModel').modal('show');
            } else {
            studentresult();
            }
        }
        });
    });
    </script>

    <div id="main-content"  style="overflow-x: hidden; overflow-y: scroll; height: 89%;"></div>
    <?php 
    if (!isset($_SESSION['NoP'])) {
        header ("Location: login.php");
        exit();
    }
    else if ($_GET['page'] == "studenthome"){
        echo "<script>studenthome(); hometitle();</script>";
    }
    else if ($_GET['page'] == "studentresult"){
        echo "<script>studentresult(); keputusankuiztitle();</script>";
    }
    else if ($_GET['page'] == "studentkuizlist"){
        echo "<script>studentkuizlist(); studentkuiztitle();</script>";
    }
    else if ($_GET['page'] == "studentjawabkuiz"){
        echo "<script>studentjawabkuiz();</script>";
    }
    else if ($_GET['page'] == "studentreportcard"){
        echo "<script>studentreportcard(); kadlaporantitle();</script>";
    }
?>
</body>
</html>