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

if (isset($_POST['NoSoal'])) {
    $array = array();
    $idsoalarray = array();
    $NoSoal = $_POST['NoSoal'];
    $jaw1 = 0; $jaw2 = 0; $jaw3 = 0; $jaw4 = 0;
    $Soal = $_POST['Soal'];
    $pilih1 = $_POST['pilih1'];
    $pilih2 = $_POST['pilih2'];
    $pilih3 = $_POST['pilih3'];
    $pilih4 = $_POST['pilih4'];
    $checkbox1 = $_POST['checkbox1'];
    $checkbox2 = $_POST['checkbox2'];
    $checkbox3 = $_POST['checkbox3'];
    $checkbox4 = $_POST['checkbox4'];
    $idsoalsql = mysqli_query($conn, "SELECT * FROM soalan WHERE NoSoal=$NoSoal");
    while ($idsoalresult = mysqli_fetch_assoc($idsoalsql)) {
        $IdSoal = $idsoalresult['IdSoal'];
        array_push($idsoalarray, $IdSoal);
    }
    if ($checkbox1 == 'true') {
        $jaw1 = 1;
    }
    else if ($checkbox2 == 'true') {
        $jaw2 = 1;
    }
    else if ($checkbox3 == 'true') {
        $jaw3 = 1;
    }
    else if ($checkbox4 == 'true') {
        $jaw4 = 1;
    }
    $idsoal1 = $idsoalarray[0];
    $idsoal2 = $idsoalarray[1];
    $idsoal3 = $idsoalarray[2];
    $idsoal4 = $idsoalarray[3];
    $sql1 = mysqli_query($conn, "UPDATE soalan SET Soal='$Soal', Pilih='$pilih1', Jaw='$jaw1' WHERE IdSoal='$idsoal1'");
    $sql2 = mysqli_query($conn, "UPDATE soalan SET Soal='$Soal', Pilih='$pilih2', Jaw='$jaw2' WHERE IdSoal='$idsoal2'");
    $sql3 = mysqli_query($conn, "UPDATE soalan SET Soal='$Soal', Pilih='$pilih3', Jaw='$jaw3' WHERE IdSoal='$idsoal3'");
    $sql4 = mysqli_query($conn, "UPDATE soalan SET Soal='$Soal', Pilih='$pilih4', Jaw='$jaw4' WHERE IdSoal='$idsoal4'");
    $conn->query($sql1);
    $conn->query($sql2);
    $conn->query($sql3);
    $conn->query($sql4);
    echo $jaw1;
}

?>