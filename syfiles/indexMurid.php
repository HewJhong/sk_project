
<!DOCTYPE html>

<head>
    <title> Index Murid </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <meta name="description" content="Sistem Pengurusan Penilaian Kuiz">
    <meta name="keywords" content="HTML, CSS, JavaScript">
    <meta name="author" content= "Sim Sze Yu">
    <link rel="stylesheet" href="mystyleMurid.css">


    <!--Banner-->
    <div class="banner">
        <div style="background-color:  rgb(194, 247, 240);">
            <p style="color: rgb(194, 247, 240);">.</p>
            <h1> Ilmu Di Hujung Jari </h1>
            <h2> Matematik Tingkatan 4 (DLP) </h2>
            <p style="color: rgb(194, 247, 240);">.</p>
        </div>
    </div>

    <!--log out button-->
    <div class="logOut">
        <a href="login.php"> Log Out </a>   
    </div> 

    <!--Top navigation bar with index murid active-->
    <div class="topnav">
        <a class="active" onclick="homeMurid()">Laman Utama</a>     
        <a onclick="collectionMurid()">Koleksi Kuiz</a>
        <a onclick="checkMurid()">Prestasi Sendiri</a>
    </div>


    <!--add some js library-->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" 
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
    crossorigin="anonymous" ></script>

    <script>
        function homeMurid(){
            $("#contentMurid").load("homeMurid.php")
        }

        function collectionMurid(){
            $("#contentMurid").load("collectionMurid.php")
        }

        function checkMurid(){
            $("#contentMurid").load("checkMurid.php")
        }
    </script>
    
</head>

<body class="indexMurid">
    <div id="contentMurid">
        <h1>Selamat datang</h1>         <!--put same content with laman utama-->
    
    </div>
</body>

</html>
