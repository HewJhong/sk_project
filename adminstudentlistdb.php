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
<input type='text' id='myInput' onkeyup='myFunction()' placeholder='Search for names...' class='form-control noprint'>
<table class='tablesort tablelist' style='width:100%; white-space:nowrap;' id='myTable'>
  <thead>
  <tr style='text-align:center;'>
    <th data-tablesort-type='int' style='width:50px; height:40px;'>No.</th>
    <th data-tablesort-type='string'>Nama</th>
    <th>No. Telefon</th>
    <th data-tablesort-type='int' style='width:220px'>Purata Markah</th>
    <th data-tablesort-type='string' style='width:90px'>Gred</th>
    <th class='noprint' style='width:80px'></th>
  </tr>
  </thead>
";

$sql1 = mysqli_query($conn, "SELECT * FROM pengguna WHERE (Peranan = 'murid')");
echo "<tbody>";
while ($row1 = mysqli_fetch_assoc($sql1)) {
    $jumlahmar = 0;
    $jumlahtopik = 0;
    $NoP = $row1['NoP'];
    $NoTel = $row1['NoTel'];
    $sql2 = mysqli_query($conn, "SELECT * FROM telefon WHERE (NoTel = '$NoTel')");
    $row2 = mysqli_fetch_assoc($sql2);
    $sql3 = mysqli_query($conn, "SELECT * FROM perekodan WHERE (NoP = '$NoP')");
    while ($row3 = mysqli_fetch_assoc($sql3)){
        $jumlahtopik ++;
        $Mar = $row3['Mar'];
        $jumlahmar += $Mar;
    }
    if ($jumlahtopik >= 1) {
      $avgmar = $jumlahmar / $jumlahtopik;
      $avgmar = number_format((float)$avgmar, 2, '.', '');
    } else {
      $avgmar = "-";
    }
    
    if ($avgmar == "-"){
      $Gred = "-";
    }else if ($avgmar >= 80) {
      $Gred = "A";
    }
    else if ($avgmar >=70 && $avgmar <80) {
      $Gred = "B";
    } 
    else if ($avgmar >=60 && $avgmar <70) {
      $Gred = "C";
    }
    else if ($avgmar >=50 && $avgmar <60) {
      $Gred = "D";
    }
    else if ($avgmar <50) {
      $Gred = "F";
    }
    $Nama = $row2['Nama'];
    $NoTel = $row2['NoTel'];
    echo "
    <tr class='item'>
      <td>".$no."</td>
      <td>".$Nama."</td>
      <td>".$NoTel."</td>
      <td>".$avgmar."</td>
      <td>".$Gred."</td>
      <td class='noprint' style='text-align:center;'><button class='info-btn btn btn-primary' style='margin-top: 5px; margin-bottom: 5px;' id='$NoP'>Info</button></td>
    </tr>
    ";
    $no ++;
}
echo "</tbody>";
echo "</table>";  
echo "<div id='noresults' class='text-center' style='display: none'><br><h3>No matching results found...<h3></div>";  
echo "</div>";
