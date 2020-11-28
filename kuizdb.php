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
$count = 1;
$pilihradio = "pilihradio";
$radio = $pilihradio . $count;
$ppilihradio = $_POST[$radio];

$nosoal = count($psoal);
$nopilih = $nosoal * 4;


for ($i = 0; $i < $nosoal; $i++) {
  $vsoal = $psoal[$i];
  if (empty($vsoal)) {
      $errors['soal'] = "Please fill in all the blank";
      echo "Sila masukkan semua soalan,";
  }
}
for ($i = 0; $i < $nopilih; $i++) {
  $vpilih = $ppilih[$i];
  if (empty($vpilih)) {
      $errors['soal'] = "Please fill in all the blank";
      echo "Sila masukkan semua pilihan,";
  }
}


$counter = 0;
if (count($errors) === 0) {
    for ($i = 0; $i < $nosoal; $i++) {
      $prefix = "T";
      $sql = mysqli_query($conn, "select * from topik");
      $topikrow = mysqli_num_rows($sql);
      if ($topikrow === 0){
        $idtopik = $prefix. '1';
        $topiksql = mysqli_query($conn, "INSERT INTO topik (idtopik, topik) VALUES ('$idtopik', '$topik')");
      } else {
        $checkexisting = mysqli_query($conn, "SELECT * FROM topik WHERE (topik= '$topik')");
        $resultexisting = mysqli_num_rows($checkexisting);
        $result = mysqli_fetch_array($checkexisting);
        $idtopik = $result['idtopik'];
        if ($resultexisting === 0) {
          $getlastidtopik = mysqli_query($conn, "SELECT idtopik FROM topik ORDER BY LENGTH (idtopik) DESC, idtopik DESC LIMIT 1");
          $resultidtopik = mysqli_fetch_array($getlastidtopik);
          $stridtopik = ltrim($resultidtopik['idtopik'], $prefix);
          $intidtopik = (int)$stridtopik;
          $intidtopik++;
          $idtopik = $prefix.$intidtopik;
          $topiksql = mysqli_query($conn, "INSERT INTO topik (idtopik, topik) VALUES ('$idtopik', '$topik')");
          echo $idtopik, $topik;
        }
      }
      $x = $i + 1;
      $radio = $pilihradio . $x;
      $ppilihradio = $_POST[$radio];
      echo $ppilihradio;
      $counter = $counter + 4;
      $x3 = $counter - 1;
      $x2 = $counter - 2;
      $x1 = $counter - 3;
      $x0 = $counter - 4;
      $pilih1 = $ppilih[$x0];
      $pilih2 = $ppilih[$x1];
      $pilih3 = $ppilih[$x2];
      $pilih4 = $ppilih[$x3];
      $soal = $psoal[$i];
      $search1 = mysqli_query($conn, "select * from testsoal where (idtopik ='$idtopik' AND soal ='$soal' AND pilih = '$pilih1')");
      $search2 = mysqli_query($conn, "select * from testsoal where (idtopik ='$idtopik' AND soal ='$soal' AND pilih = '$pilih2')");
      $search3 = mysqli_query($conn, "select * from testsoal where (idtopik ='$idtopik' AND soal ='$soal' AND pilih = '$pilih3')");
      $search4 = mysqli_query($conn, "select * from testsoal where (idtopik ='$idtopik' AND soal ='$soal' AND pilih = '$pilih4')");
      $result1 = mysqli_fetch_array($search1);
      $result2 = mysqli_fetch_array($search2);
      $result3 = mysqli_fetch_array($search3);
      $result4 = mysqli_fetch_array($search4);
      $sql1 = "INSERT INTO testsoal(idtopik, soal, pilih, jaw) VALUES('$idtopik', '$soal', '$pilih1','0')";
      $sql2 = "INSERT INTO testsoal(idtopik, soal, pilih, jaw) VALUES('$idtopik', '$soal', '$pilih2','0')";
      $sql3 = "INSERT INTO testsoal(idtopik, soal, pilih, jaw) VALUES('$idtopik', '$soal', '$pilih3','0')";
      $sql4 = "INSERT INTO testsoal(idtopik, soal, pilih, jaw) VALUES('$idtopik', '$soal', '$pilih4','0')";
      if ($result1['idtopik'] == $idtopik && $result1['soal'] == $soal && $result1['pilih'] == $pilih1 && $result2['soal'] == $soal && $result2['pilih'] == $pilih2 
      && $result3['soal'] == $soal && $result3['pilih'] == $pilih3 && $result4['soal'] == $soal && $result4['pilih'] == $pilih4) {
        echo "Question existed";        
      } else if ($ppilihradio != "A" && $ppilihradio != "B" && $ppilihradio != "C" && $ppilihradio != "D"){
        echo "Jawapan betul tidak dipilih";
      }else {
        $conn->query($sql1);
        $conn->query($sql2);
        $conn->query($sql3);
        $conn->query($sql4);
        echo "Success";
        if ($ppilihradio == "A") {
          $update1 = "UPDATE testsoal SET jaw='1' WHERE (topik ='$topik' AND soal ='$soal' AND pilih = '$pilih1')";
          $conn->query($update1);
        }
        else if ($ppilihradio == "B") {
          $update2 = "UPDATE testsoal SET jaw='1' WHERE (topik ='$topik' AND soal ='$soal' AND pilih = '$pilih2')";
          $conn->query($update2);
        }
        else if ($ppilihradio == "C") {
          $update3 = "UPDATE testsoal SET jaw='1' WHERE (topik ='$topik' AND soal ='$soal' AND pilih = '$pilih3')";
          $conn->query($update3);
        }
        else if ($ppilihradio == "D") {
          $update4 = "UPDATE testsoal SET jaw='1' WHERE (topik ='$topik' AND soal ='$soal' AND pilih = '$pilih4')";
          $conn->query($update4);
        }
      }
  }
}

?>