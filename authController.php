<html>
<body>
<?php

session_start();

$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "spkm";

// Create connection
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
if ($conn->connect_error) {
    die("Database error: " . $conn->connect_error);
}

$nop = '';
$notel = '';
$name = '';
$errors = array();


// if user clicks on the sign up button
if (isset($_POST['signup-btn'])) {
    $receivednop = $_POST['nop'];
    $nop = trim($receivednop);
    $receivedname = $_POST['name'];
    $name = trim($receivedname);
    $receivednotel = $_POST['notel'];
    $notel = trim($receivednotel);
    $password = $_POST['password'];
    $passwordConf = $_POST['passwordConf'];
    //validation
    if (empty($nop)) {
        $errors['nop'] = "Username required";
    }
    if (empty($name)) {
        $errors['name'] = "Name required";
    }
    if (empty($notel)) {
        $errors['notel'] = "Telefon Number required";
    }
    if(preg_match("/^[0]{1}[1]{1}[0-9]{1}-[0-9]{7}$/", $notel) || preg_match("/^[0]{1}[1]{1}[0-9]{1}-[0-9]{8}$/", $notel)) {
    } else {
        $errors['telefonnumber'] = "Wrong Telefon Number format";
    }
    if (empty($password)) {
        $errors['password'] = "Password required";
    }
    if (empty($passwordConf)) {
        $errors['passwordConf'] = "Please confirm your password";
    }
    if ($password != $passwordConf) {
        $errors['password'] = 'The two password do not match!';
    }

    if (count($errors) === 0) {
        $sql = "INSERT INTO pengguna (nop, notel, peranan, password) VALUES ('$nop', '$notel', 'murid', '$password'); INSERT INTO telefon (notel, name) VALUES ('$notel', '$name') ";
        if ($conn->multi_query($sql) === TRUE) {
            header("Location: login.php");
          } else {
            $errors['duplicate'] = "Your have already signed up or your username has been taken";
          }
          $conn->close();
    } 
}

// if user clicks on the login button
if (isset($_POST['login-btn'])) {
    $receivednop = $_POST['nop'];
    $nop = trim($receivednop);
    $password = $_POST['password'];
    $receivednotel = $_POST['nop'];
    $notel = trim($receivednotel);
    
    //validation
    if (empty($nop)) {
        $errors['nop'] = "Username required";
    }
    if (empty($password)) {
        $errors['password'] = "Password required";
    }

    if (count($errors) === 0) {
        $result = mysqli_query($conn, "select * from pengguna where (nop ='$nop' AND password = '$password') OR (notel ='$notel' AND password = '$password')") 
        or die("Failed to query database" .mysql_error());
        $nameresult = mysqli_query($conn, "select * from telefon where notel = '$notel'");
        $namerow = mysqli_fetch_array($nameresult);
        $row = mysqli_fetch_array($result);
        $admin = "admin";
        $murid = "murid";
        if(($row['notel'] == $notel  && $row['password'] == $password) ||  ($row['nop'] == $nop && $row['password'] == $password)) {
            $_SESSION['nop'] = $row['nop'];
            $_SESSION['peranan'] = $row['peranan'];
            $_SESSION['notel'] = $row['notel'];
            $_SESSION['name'] = $namerow['name'];
            header("Location: main.php");
        }  else {
            $errors['loginfail'] = "Login Failed";
        }         
    }
}
?>
</body>
</html>
