<html>
<body>
<script src="changepage.js"></script>
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
$nama = '';
$errors = array();


// if user clicks on the sign up button
if (isset($_POST['signup-btn'])) {
    $receivednop = $_POST['nop'];
    $nop = trim($receivednop);
    $receivednama = $_POST['nama'];
    $nama = trim($receivednama);
    $receivednotel = $_POST['notel'];
    $notel = trim($receivednotel);
    $password = $_POST['password'];
    $passwordConf = $_POST['passwordConf'];
    //validation
    if (empty($nop)) {
        $errors['nop'] = "Username required";
    }
    if (empty($nama)) {
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
        $sql = "INSERT INTO telefon (notel, nama) VALUES ('$notel', '$nama'); INSERT INTO pengguna (nop, notel, peranan, password) VALUES ('$nop', '$notel', 'murid', '$password');";
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
        if(($row['notel'] == $notel  && $row['password'] == $password) || ($row['nop'] == $nop && $row['password'] == $password)) {
            $_SESSION['nop'] = $row['nop'];
            $_SESSION['peranan'] = $row['peranan'];
            $_SESSION['notel'] = $row['notel'];
            $_SESSION['nama'] = $namerow['nama'];
            header("Location: main.php");
        }  else {
            $errors['loginfail'] = "Login Failed";
        }         
    }
}

/// For adminkuizlist.php delete button
if (isset($_GET['delete'])) {
    $nosoal = $_GET['id'];
    $sqldelete = mysqli_query($conn, "DELETE FROM testsoal WHERE (nosoal='$nosoal')");
    // echo '<script type="text/javascript">',
    // 'quizlistpage();',
    // '</script>';
    exit();
}

/// For adminkuizlist.php edit button
if(isset($_POST["nosoal"])) {
    $nosoal = $_POST['nosoal'];
    $result = mysqli_query($conn, "SELECT * FROM testsoal WHERE (nosoal='$nosoal')");
    $row = mysqli_fetch_assoc($result);
    header('Content-Type: application/json');
    $jsonresult = json_encode($row);
    echo $jsonresult;
}


?>
</body>
</html>
