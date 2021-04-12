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

echo "<div class='text-center' style='margin-top: 20px;'><h2>Senarai Murid</h2></div>";
echo "<div  class='quiz-form-div'>";
$no = 1; 
echo "
<input type='text' id='myInput' onkeyup='myFunction()' placeholder='Search for names..' class='form-control'>
<table class='tablesort tablelist' style='width:100%; white-space:nowrap;' id='myTable'>
  <thead>
  <tr style='text-align:center;'>
    <th data-tablesort-type='int' style='width:50px; height:40px;'>No.</th>
    <th data-tablesort-type='string'>Nama</th>
    <th>No. Telefon</th>
    <th data-tablesort-type='int' style='width:220px'>Purata Markah</th>
    <th data-tablesort-type='string' style='width:90px'>Gred</th>
    <th style='width:80px'></th>
  </tr>
  </thead>
";

$sql1 = mysqli_query($conn, "SELECT * FROM pengguna WHERE (peranan = 'murid')");
echo "<tbody>";
while ($row1 = mysqli_fetch_assoc($sql1)) {
    $jumlahmar = 0;
    $jumlahtopik = 0;
    $nop = $row1['nop'];
    $notel = $row1['notel'];
    $sql2 = mysqli_query($conn, "SELECT * FROM telefon WHERE (notel = '$notel')");
    $row2 = mysqli_fetch_assoc($sql2);
    $sql3 = mysqli_query($conn, "SELECT * FROM perekodan WHERE (nop = '$nop')");
    while ($row3 = mysqli_fetch_assoc($sql3)){
        $jumlahtopik ++;
        $mar = $row3['mar'];
        $jumlahmar += $mar;
    }
    if ($jumlahtopik >= 1) {
      $avgmar = $jumlahmar / $jumlahtopik;
      $avgmar = number_format((float)$avgmar, 2, '.', '');
    } else {
      $avgmar = "-";
    }
    
    if ($avgmar == "-"){
      $gred = "-";
    }else if ($avgmar >= 80) {
      $gred = "A";
    }
    else if ($avgmar >=70 && $avgmar <80) {
      $gred = "B";
    } 
    else if ($avgmar >=60 && $avgmar <70) {
      $gred = "C";
    }
    else if ($avgmar >=50 && $avgmar <60) {
      $gred = "D";
    }
    else if ($avgmar <50) {
      $gred = "F";
    }
    $nama = $row2['nama'];
    $notel = $row2['notel'];
    echo "
    <tr class='item'>
      <td>".$no."</td>
      <td>".$nama."</td>
      <td>".$notel."</td>
      <td>".$avgmar."</td>
      <td>".$gred."</td>
      <td style='text-align:center;'><button class='info-btn btn btn-primary' style='margin-top: 5px; margin-bottom: 5px;' id='$nop'>Info</button></td>
    </tr>
    ";
    $no ++;
}
echo "</tbody>";
echo "</div>";