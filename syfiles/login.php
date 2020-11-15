<?php require_once 'checkPassword.php' ?>
<!DOCTYPE html>    
    <head>
        <title> Login Screen </title>
        <link rel="stylesheet" href="mystyle.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">    <!--to fit the content base on what device user use-->
    </head>
    
    <body class="login">

        <div style="background-color: rgba(154, 209, 191, 0.863);">
            <p style="color: rgba(154, 209, 191, 0.863);"> . </p>
            <h2 style="background-color: rgba(154, 209, 191, 0.66);"> Selamat Datang Ke </h2>                      <!--some welcome messages-->
            <h2 style="background-color: rgba(154, 209, 191, 0.66);"> Sistem Pengurusan Penilaian Kuiz </h2>
            <h3 style="background-color: rgba(154, 209, 191, 0.66);"> Ilmu Di Hujung Jari, Matematik Tingkatan 4(DLP) </h3>
            
            <?php echo "Hello World" ?>
            <div class="container">
            <?php foreach($errors as $error):?>
                <li class="alert-tag"><?php echo $error; ?></li>
            <?php endforeach;?>
            </div>
            <form action="login.php" method="POST">
                <div>
                    <img src="Image/user icon.png">        <!--user icon-->
                </div>
                <br>
                <div>
                <label for="NoIC"> Nombor IC: </label> <br>         <!--ask user to input NoIC-->
                <input type="text" placeholder="04041714****" value = "<?php echo $NoIC?>" id = "NoIC" name="NoIC" value="" required><br>
                <br>
                <label for="KataLaluan"> Kata Laluan: </label> <br>     <!--ask user to input password-->
                <input type="password" placeholder="Masukkan kata lauan anda" id = "KataLaluan" name="KataLaluan" value="" required><br>
                <br>
                <button type="submit" name="login-btn"> Log Masuk </button>    <!--login button-->
                <button type="reset" value="reset"> semula </button>     <!--reset the value if type wrong -->
                </div>
                
                <div>
                    <p> Pengguna Baharu? <a href="register.html">Daftar di sini</a> </p>   <!--if new user, use the link to register-->
                </div>
                <p style="color: rgba(154, 209, 191, 0.863);"> . </p>
            </form>
        </div>
        
    </body>

</html>