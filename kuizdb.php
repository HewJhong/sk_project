<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "spkm";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$nosoal = 2;
$topik = array();
$soal = array();

$topik = "fixed value";
$psoal = $_POST['psoal'];
$ppilih = $_POST['ppilih'];



for ($i = 0; $i < $nosoal; $i++) {
    $soal = $psoal[$i];
    $pilih = $ppilih[$i];
    $sql = "insert into testsoal(topik, soal, pilih) values('$topik', '$soal', '$pilih')";
    $conn->query($sql);
    echo "Sucess";
}

?>