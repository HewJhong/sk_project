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

$topik = $_POST['topik'];
$psoal = $_POST['psoal'];
$ppilih = $_POST['ppilih'];

for ($i = 0; $i < $nosoal; $i++) {
  $vsoal = $psoal[$i];
  if (empty($vsoal)) {
      $errors['soal'] = "Please fill in all the blank";
      echo "Blanks found!";
  }
}
for ($i = 0; $i < $nosoal; $i++) {
  $vpilih = $ppilih[$i];
  if (empty($vpilih)) {
      $errors['soal'] = "Please fill in all the blank";
      echo "Blanks found!";
  }
}


if (count($errors) === 0) {
  for ($i = 0; $i < $nosoal; $i++) {
      $pilih = $ppilih[$i];
      $soal = $psoal[$i];
      $sql = "INSERT INTO testsoal(topik, soal, pilih) VALUES('$topik', '$soal', '$pilih')";
      $conn->query($sql);
      echo "Success";
  }
}

?>