<?php

$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "spkm";

// Create connection
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
if ($conn->connect_error) {
    die("Database error: " . $conn->connect_error);
}

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
        header("Location: studentmain.php");
    }  else {
        $errors['loginfail'] = "Login Failed";
    }         
}

?>