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
$nop = $_SESSION['nop'];
$date = date("d/m/Y");
$idtopik = $_SESSION["kuizidtopik"];


if (isset($_POST['data'])) {
  $data = $_POST['data'];
  $count = $_POST['count'];
  $result = $data[0]['name'];
  if (count($data) < $count){
    echo "errorNoAns";
  }
  else {
    for ($i=0; $i<$count; $i++) {
      $nosoal = $data[$i]['name'];
      $studentjaw = $data[$i]['value'];
      $sql1 = mysqli_query($conn, "SELECT * FROM soalan WHERE (nosoal = '$nosoal')");
      while ($row1 = mysqli_fetch_assoc($sql1)) {
        $pilih = $row1['jaw'];
        array_push($pilihlist, $pilih);
      }
      $jawindex = array_search(1, $pilihlist);
      $jaw = $valuelist[$jawindex];
      if ($studentjaw == $jaw) {
        $score += 1;
      }
      $pilihlist = array();
    }
    echo $score;
    $markah = $score / $count * 100;
    if ($markah >= 80) {
      $gred = "A";
    }
    else if ($markah >=70 && $markah <80) {
      $gred = "B";
    } 
    else if ($markah >=60 && $markah <70) {
      $gred = "C";
    }
    else if ($markah >=50 && $markah <60) {
      $gred = "D";
    }
    else {
      $gred = "F";
    }
    $idrekodsql = mysqli_query($conn, "SELECT * FROM perekodan");
    $idrekodnumrows = mysqli_num_rows($idrekodsql);
    if ($idrekodnumrows === 0) {
      $idrekod = $rekodprefix.'001';
      $insertidrekod = "INSERT INTO perekodan(idrekod, mar, gred, tar, nop, idtopik) VALUES('$idrekod', '$markah', '$gred', '$date', '$nop', '$idtopik')";
      $conn->query($insertidrekod);
    } else {
      $getlastidrekod = mysqli_query($conn, "SELECT * FROM perekodan ORDER BY LENGTH (idrekod) DESC, idrekod DESC LIMIT 1");
      $existingidrekod = mysqli_fetch_assoc($getlastidrekod);
      $stridrekod = ltrim($existingidrekod['idrekod'], $rekodprefix);
      $intrekod = (int)$stridrekod;
      $intrekod++;
      $int = sprintf('%03d', $intrekod);
      $idrekod = $rekodprefix.$int;
      $insertidrekod = "INSERT INTO perekodan(idrekod, mar, gred, tar, nop, idtopik) VALUES('$idrekod', '$markah', '$gred', '$date', '$nop', '$idtopik')";
      $conn->query($insertidrekod);
    }
  }
  unset($_SESSION['kuizidtopik']);
}
else {
  echo "errorNoAns";
}

