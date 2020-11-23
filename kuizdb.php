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

$topik = array();
$soal = array();
$errors = array();
$nosoal = 1;
$nopilih = $nosoal * 2;

$topik = $_POST['topik'];
$psoal = $_POST['psoal'];
$ppilih = $_POST['ppilih'];
$index = $_POST['index'];

for ($i = 0; $i < $nosoal; $i++) {
  $vsoal = $psoal[$i];
  if (empty($vsoal)) {
      $errors['soal'] = "Please fill in all the blank";
      echo "Blanks found!";
  }
}
for ($i = 0; $i < $nopilih; $i++) {
  $vpilih = $ppilih[$i];
  if (empty($vpilih)) {
      $errors['soal'] = "Please fill in all the blank";
      echo "Blanks found!";
  }
}

$counter = 0;

if (count($errors) === 0) {
  for ($i = 0; $i < $nosoal; $i++) {
      $counter = $counter + 2;
      $x = $counter - 1;
      $y = $counter - 2;
      $pilih1 = $ppilih[$y];
      $pilih2 = $ppilih[$x];
      $soal = $psoal[$i];
      $sql1 = "INSERT INTO testsoal(topik, soal, pilih) VALUES('$topik', '$soal', '$pilih1')";
      $conn->query($sql1);
      $sql2 = "INSERT INTO testsoal(topik, soal, pilih) VALUES('$topik', '$soal', '$pilih2')";
      $conn->query($sql2);
      echo "Success";
  }
}

?>