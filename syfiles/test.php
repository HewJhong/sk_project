<?php
require_once 'checkPassword.php';
?>
<html>
    <head>
    <title> Login Screen </title>
    <link rel="stylesheet" href="mystyle.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <?php echo "Hello World" ?>
        <div class="container">
        <?php foreach($errors as $error):?>
            <li class="alert-tag"><?php echo $error; ?></li>
        <?php endforeach;?>
        </div>
        <div class="container" style="margin: 20px">
            <form action="test.php" method="POST">
                <div>
                    <label for="NoIc"> No IC:</label>
                    <input type="text" placeholder="IC" value="<?php echo $NoIC?>" id="NoIC" name="NoIC" required>
                    <br>
                    <label for="KataLaluan"> Kata Laluan: </label>
                    <input type="password" placeholder="Masukkan kata lauan anda" id = "KataLaluan" name="KataLaluan" value="" required>
                    <br>
                    <button name="login-btn" type="submit"> Log Masuk </button>   
                    <button type="reset" value="reset"> semula </button>
                </div>
            </form>
        </div>
    </body>
</html>