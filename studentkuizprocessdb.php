<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "spkm";

session_start();

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$nosoallist = array();
$jawlist = array();
$pilihlist = array();
$valuelist = ["A", "B", "C", "D"];
$score = 0;
$rekodprefix = "R";
$NoP = $_SESSION['NoP'];
$date = date("d/m/Y");
$IdTopik = $_SESSION["kuizidtopik"];


if (isset($_POST['data'])) {
  $data = $_POST['data'];
  $count = $_POST['count'];
  $result = $data[0]['name'];
  if (count($data) < $count){
    echo count($data);
    echo "errorNoAns";
  }
  else {
    for ($i=0; $i<$count; $i++) {
      $NoSoal = $data[$i]['name'];
      $studentjaw = $data[$i]['value'];
      $sql1 = mysqli_query($conn, "SELECT * FROM soalan WHERE (NoSoal = '$NoSoal')");
      while ($row1 = mysqli_fetch_assoc($sql1)) {
        $Pilih = $row1['Jaw'];
        array_push($pilihlist, $Pilih);
      }
      $jawindex = array_search(1, $pilihlist);
      $Jaw = $valuelist[$jawindex];
      if ($studentjaw == $Jaw) {
        $score += 1;
      }
      $pilihlist = array();
    }
    echo $score;
    $markah = $score / $count * 100;
    if ($markah >= 80) {
      $Gred = "A";
    }
    else if ($markah >=70 && $markah <80) {
      $Gred = "B";
    } 
    else if ($markah >=60 && $markah <70) {
      $Gred = "C";
    }
    else if ($markah >=50 && $markah <60) {
      $Gred = "D";
    }
    else {
      $Gred = "F";
    }
    $IdRekodsql = mysqli_query($conn, "SELECT * FROM perekodan");
    $IdRekodnumrows = mysqli_num_rows($IdRekodsql);
    if ($IdRekodnumrows === 0) {
      $IdRekod = $rekodprefix.'001';
      $insertIdRekod = "INSERT INTO perekodan(IdRekod, Mar, Gred, Tar, NoP, IdTopik) VALUES('$IdRekod', '$markah', '$Gred', '$date', '$NoP', '$IdTopik')";
      $conn->query($insertIdRekod);
    } else {
      $getlastIdRekod = mysqli_query($conn, "SELECT * FROM perekodan ORDER BY LENGTH (IdRekod) DESC, IdRekod DESC LIMIT 1");
      $existingIdRekod = mysqli_fetch_assoc($getlastIdRekod);
      $strIdRekod = ltrim($existingIdRekod['IdRekod'], $rekodprefix);
      $intrekod = (int)$strIdRekod;
      $intrekod++;
      $int = sprintf('%03d', $intrekod);
      $IdRekod = $rekodprefix.$int;
      $insertIdRekod = "INSERT INTO perekodan(IdRekod, Mar, Gred, Tar, NoP, IdTopik) VALUES('$IdRekod', '$markah', '$Gred', '$date', '$NoP', '$IdTopik')";
      $conn->query($insertIdRekod);
    }
  }
}
else {
  echo "errorNoAns";
}

