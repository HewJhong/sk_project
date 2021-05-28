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

$NoP = '';
$NoTel = '';
$Nama = '';
$errors = array();


// if user clicks on the sign up button
if (isset($_POST['signup-btn'])) {
    $receivedNoP = $_POST['NoP'];
    $NoP = trim($receivedNoP);
    $receivednama = $_POST['Nama'];
    $Nama = trim($receivednama);
    $receivedNoTel = $_POST['NoTel'];
    $NoTel = trim($receivedNoTel);
    $KataLaluan = $_POST['KataLaluan'];
    $KataLaluanConf = $_POST['KataLaluanConf'];
    //validation
    if (empty($NoP)) {
        $errors['NoP'] = "Username required";
    }
    if (empty($Nama)) {
        $errors['name'] = "Name required";
    }
    if (empty($NoTel)) {
        $errors['NoTel'] = "Telefon Number required";
    }
    if(preg_match("/^[0]{1}[1]{1}[0-9]{1}-[0-9]{7}$/", $NoTel) || preg_match("/^[0]{1}[1]{1}[0-9]{1}-[0-9]{8}$/", $NoTel)) {
    } else {
        $errors['telefonnumber'] = "Wrong Telefon Number format";
    }
    if (empty($KataLaluan)) {
        $errors['KataLaluan'] = "KataLaluan required";
    }
    if (empty($KataLaluanConf)) {
        $errors['KataLaluanConf'] = "Please confirm your KataLaluan";
    }
    if ($KataLaluan != $KataLaluanConf) {
        $errors['KataLaluan'] = 'The two KataLaluan do not match!';
    }

    if (count($errors) === 0) {
        $checkNoP = mysqli_query($conn, "SELECT * FROM pengguna WHERE (NoP = '$NoP')");
        $rowsNoP = mysqli_num_rows($checkNoP);
        if ($rowsNoP <= 0) {
            $sql = "INSERT INTO telefon (NoTel, Nama) VALUES ('$NoTel', '$Nama'); INSERT INTO pengguna (NoP, NoTel, Peranan, KataLaluan) VALUES ('$NoP', '$NoTel', 'murid', '$KataLaluan');";
            if ($conn->multi_query($sql) === TRUE) {
                header("Location: login.php");
            } else {
                $errors['duplicate'] = "Your have already signed up or your username has been taken";
            }
        } else {
            $errors['duplicate'] = "Your have already signed up or your username has been taken";
        }
        $conn->close();
    } 
}

// if user clicks on the login button
if (isset($_POST['login-btn'])) {
    $receivedNoP = $_POST['NoP'];
    $NoP = trim($receivedNoP);
    $KataLaluan = $_POST['KataLaluan'];
    $receivedNoTel = $_POST['NoP'];
    $NoTel = trim($receivedNoTel);
    
    //validation
    if (empty($NoP)) {
        $errors['NoP'] = "Username required";
    }
    if (empty($KataLaluan)) {
        $errors['KataLaluan'] = "KataLaluan required";
    }

    if (count($errors) === 0) {
        $result = mysqli_query($conn, "SELECT * FROM pengguna WHERE (NoP ='$NoP' AND KataLaluan = '$KataLaluan') OR (NoTel ='$NoTel' AND KataLaluan = '$KataLaluan')") 
        or die("Failed to query database" .mysql_error());
        $nameresult = mysqli_query($conn, "SELECT * FROM telefon WHERE NoTel = '$NoTel'");
        $namerow = mysqli_fetch_array($nameresult);
        $row = mysqli_fetch_array($result);
        $admin = "admin";
        $murid = "murid";
        if(($row['NoTel'] == $NoTel  && $row['KataLaluan'] == $KataLaluan) || ($row['NoP'] == $NoP && $row['KataLaluan'] == $KataLaluan)) {
            $_SESSION['NoP'] = $row['NoP'];
            $_SESSION['Peranan'] = $row['Peranan'];
            $_SESSION['NoTel'] = $row['NoTel'];
            $_SESSION['Nama'] = $namerow['Nama'];
        }  else {
            $errors['loginfail'] = "Login Failed";
        }         
    }
}

/// For adminkuizlist.php delete button
if (isset($_GET['delete'])) {
    $NoSoal = $_GET['id'];
    $sqldelete = mysqli_query($conn, "DELETE FROM soalan WHERE (NoSoal='$NoSoal')");
}

/// For adminkuizlist.php kuiz delete button
if (isset($_GET['deletekuiz'])) {
    $IdTopik = $_GET['IdTopik'];
    $sqldelete = mysqli_query($conn, "DELETE FROM soalan WHERE (IdTopik='$IdTopik')");
}

/// For adminkuizlist.php edit button
if(isset($_POST["NoSoal"])) {
    $NoSoal = $_POST['NoSoal'];
    $result = mysqli_query($conn, "SELECT * FROM soalan WHERE (NoSoal='$NoSoal')");
    $row = mysqli_fetch_assoc($result);
    header('Content-Type: application/json');
    $jsonresult = json_encode($row);
    echo $jsonresult;
}

/// for studentjawabkuiz.php jawab kuiz button
if(isset($_POST["id"])) {
    $_SESSION["kuizidtopik"] = $_POST["id"];
}

?>
</body>
</html>
