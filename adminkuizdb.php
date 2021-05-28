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

$errors = [];
$Topik = array();
$Soal = array();
$NoSoal = 1;
$nopilih = $NoSoal * 4;

$Topik = $_POST['Topik'];
$psoal = $_POST['psoal'];
$ppilih = $_POST['ppilih'];
$count = 1;
$pilihradio = "pilihradio";
$radio = $pilihradio . $count;
$ppilihradio = $_POST[$radio];

$NoSoal = count($psoal);
$nopilih = $NoSoal * 4;
$intnosoal = 1;



for ($i = 0; $i < $NoSoal; $i++) {
  $vsoal = $psoal[$i];
  if (empty($vsoal)) {
      $errors['Soal']="Sila masukkan soalan";
  }
}

for ($i = 0; $i < $nopilih; $i++) {
  $vpilih = $ppilih[$i];
  if ($vpilih == "") {
      $errors['Pilih']="Sila masukkan pilihan";
  }
}

for ($i = 0; $i < $NoSoal; $i++) {
  $y = $i + 1;
  $pilihradio = "pilihradio";
  $radio = $pilihradio . $y;
  $ppilihradio = $_POST[$radio];
  $vpilihradio = $ppilihradio[0];
  if (empty($vpilihradio)) {
      $errors['pilihradio']="Sila masukkan jawapan betul";
  }
}

if (empty($Topik)) {
  $errors['Topik']="Sila masukkan Topik";
}

print_r($errors);

$topikprefix = "T";
$soalprefix = "S";
$counter = 0;
if (count($errors) === 0) {
  for ($i = 0; $i < $NoSoal; $i++) {
    $sql = mysqli_query($conn, "SELECT * FROM Topik");
    $topikrow = mysqli_num_rows($sql);
    if ($topikrow === 0){
      $IdTopik = $topikprefix. '1';
      $topiksql = mysqli_query($conn, "INSERT INTO Topik (IdTopik, Topik) VALUES ('$IdTopik', '$Topik')");
    } else {
      $checkexisting = mysqli_query($conn, "SELECT * FROM Topik WHERE (Topik= '$Topik')");
      $resultexisting = mysqli_num_rows($checkexisting);
      $result = mysqli_fetch_array($checkexisting);
      if ($resultexisting === 0) {
        $getlastidtopik = mysqli_query($conn, "SELECT IdTopik FROM Topik ORDER BY LENGTH (IdTopik) DESC, IdTopik DESC LIMIT 1");
        $resultidtopik = mysqli_fetch_array($getlastidtopik);
        $stridtopik = ltrim($resultidtopik['IdTopik'], $topikprefix);
        $intidtopik = (int)$stridtopik;
        $intidtopik++;
        $IdTopik = $topikprefix.$intidtopik;
        $topiksql = mysqli_query($conn, "INSERT INTO Topik (IdTopik, Topik) VALUES ('$IdTopik', '$Topik')");
        echo $IdTopik, $Topik;
      } else {
        $IdTopik = $result['IdTopik'];
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
    $Soal = $psoal[$i];
    $search1 = mysqli_query($conn, "SELECT * FROM soalan WHERE (IdTopik ='$IdTopik' AND Soal ='$Soal' AND Pilih = '$pilih1')");
    $search2 = mysqli_query($conn, "SELECT * FROM soalan WHERE (IdTopik ='$IdTopik' AND Soal ='$Soal' AND Pilih = '$pilih2')");
    $search3 = mysqli_query($conn, "SELECT * FROM soalan WHERE (IdTopik ='$IdTopik' AND Soal ='$Soal' AND Pilih = '$pilih3')");
    $search4 = mysqli_query($conn, "SELECT * FROM soalan WHERE (IdTopik ='$IdTopik' AND Soal ='$Soal' AND Pilih = '$pilih4')");
    $result1 = mysqli_fetch_array($search1);
    $result2 = mysqli_fetch_array($search2);
    $result3 = mysqli_fetch_array($search3);
    $result4 = mysqli_fetch_array($search4);
    if ($result1['IdTopik'] == $IdTopik && $result1['Soal'] == $Soal && $result1['Pilih'] == $pilih1 && $result2['Soal'] == $Soal && $result2['Pilih'] == $pilih2 
    && $result3['Soal'] == $Soal && $result3['Pilih'] == $pilih3 && $result4['Soal'] == $Soal && $result4['Pilih'] == $pilih4) {
      echo "Question existed";        
    } else if ($ppilihradio != "A" && $ppilihradio != "B" && $ppilihradio != "C" && $ppilihradio != "D"){
      echo "Jawapan betul tidak dipilih";
    }else {
      $sqlsoal = mysqli_query($conn, "SELECT * FROM soalan");
      $soalrows = mysqli_num_rows($sqlsoal);
      if ($soalrows === 0){
        $idsoal1 = $soalprefix. "001";
        $idsoal2 = $soalprefix. "002";
        $idsoal3 = $soalprefix. "003";
        $idsoal4 = $soalprefix. "004";
        $intnosoal = 1;
      } else {
        $getlastidsoal = mysqli_query($conn, "SELECT * FROM soalan ORDER BY LENGTH (IdSoal) DESC, IdSoal DESC LIMIT 1");
        $existingidsoal = mysqli_fetch_array($getlastidsoal);
        $stridsoal = ltrim($existingidsoal['IdSoal'], $soalprefix);
        $intsoal = (int)$stridsoal;
        $intsoal++;
        $int1 = sprintf('%03d',$intsoal);
        $int2 = sprintf('%03d',$intsoal+1);
        $int3 = sprintf('%03d',$intsoal+2);
        $int4 = sprintf('%03d',$intsoal+3);
        $idsoal1 = $soalprefix.$int1;
        $idsoal2 = $soalprefix.$int2;
        $idsoal3 = $soalprefix.$int3;
        $idsoal4 = $soalprefix.$int4;
        $getlastnosoal = mysqli_query($conn, "SELECT * FROM soalan ORDER BY NoSoal DESC LIMIT 1");
        $existingnosoal = mysqli_fetch_array($getlastnosoal);
        $intnosoal = (int)$existingnosoal['NoSoal'];
        $intnosoal++;
      }
      $sql1 = "INSERT INTO soalan(NoSoal, IdSoal, IdTopik, Soal, Pilih, Jaw) VALUES('$intnosoal', '$idsoal1', '$IdTopik', '$Soal', '$pilih1','0')";
      $sql2 = "INSERT INTO soalan(NoSoal, IdSoal, IdTopik, Soal, Pilih, Jaw) VALUES('$intnosoal', '$idsoal2', '$IdTopik', '$Soal', '$pilih2','0')";
      $sql3 = "INSERT INTO soalan(NoSoal, IdSoal, IdTopik, Soal, Pilih, Jaw) VALUES('$intnosoal', '$idsoal3', '$IdTopik', '$Soal', '$pilih3','0')";
      $sql4 = "INSERT INTO soalan(NoSoal, IdSoal, IdTopik, Soal, Pilih, Jaw) VALUES('$intnosoal', '$idsoal4', '$IdTopik', '$Soal', '$pilih4','0')";
      $conn->query($sql1);
      $conn->query($sql2);
      $conn->query($sql3);
      $conn->query($sql4);
      echo " Success";
      echo '<script type="text/javascript">',
     'kuizlistpage();',
     '</script>';
     
      $_SESSION['questionset'] = "Question Set";
      if ($ppilihradio == "A") {
        $update1 = "UPDATE soalan SET Jaw='1' WHERE (IdTopik ='$IdTopik' AND Soal ='$Soal' AND Pilih = '$pilih1')";
        $conn->query($update1);
      }
      else if ($ppilihradio == "B") {
        $update2 = "UPDATE soalan SET Jaw='1' WHERE (IdTopik ='$IdTopik' AND Soal ='$Soal' AND Pilih = '$pilih2')";
        $conn->query($update2);
      }
      else if ($ppilihradio == "C") {
        $update3 = "UPDATE soalan SET Jaw='1' WHERE (IdTopik ='$IdTopik' AND Soal ='$Soal' AND Pilih = '$pilih3')";
        $conn->query($update3);
      }
      else if ($ppilihradio == "D") {
        $update4 = "UPDATE soalan SET Jaw='1' WHERE (IdTopik ='$IdTopik' AND Soal ='$Soal' AND Pilih = '$pilih4')";
        $conn->query($update4);
      }
    }
  }
}
    

?>