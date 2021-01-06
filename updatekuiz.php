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

if (isset($_POST['nosoal'])) {
    
    $nosoal = $_POST['nosoal'];
    $soal = $_POST['soal'];
    $pilih1 = $_POST['pilih1'];
    $pilih2 = $_POST['pilih2'];
    $pilih3 = $_POST['pilih3'];
    $pilih4 = $_POST['pilih4'];
    $checkbox1 = $_POST['checkbox1'];
    $checkbox2 = $_POST['checkbox2'];
    $checkbox3 = $_POST['checkbox3'];
    $checkbox4 = $_POST['checkbox4'];
    $idsoalsql = mysqli_query($conn, "SELECT * FROM testsoal WHERE nosoal=$nosoal");
    $idsoalresult = mysqli_fetch_array($idsoalsql);
    $idsoal = $idsoalresult['idsoal'];
    echo $idsoal;
    $sql1 = mysqli_query($conn, "UPDATE testsoal SET soal=$soal, pilih=$pilih1 WHERE ");
}

?>