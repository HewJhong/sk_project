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

session_start();

$totalmarkah = 0;
$markahlist = array();
$topiklist = array();
$counter = 1;
$donecounter = 0;

echo "<div class='text-center' style='margin-top: 20px;'><h2>Kad Laporan</h2></div>";
echo "<div  class='quiz-form-div'>";
echo "";



$idtopiklist = array();
$doneidtopiklist = array();

$nop = $_SESSION['nop'];
echo "<div><h5>Nombor Pengguna: ".$nop."</h5></div>";
$sql1 = mysqli_query($conn, "SELECT * FROM pengguna WHERE (nop = '$nop')");
$row1 = mysqli_fetch_assoc($sql1);
$notel = $row1['notel'];
$sql2 = mysqli_query($conn, "SELECT * FROM telefon WHERE (notel = '$notel')");
$row2 = mysqli_fetch_assoc($sql2);
$nama = $row2['nama']; 
echo "<div><h5>Nama: ".$nama."</h5></div>";
$sql3 = mysqli_query($conn, "SELECT * FROM soalan");
while ($row3 = mysqli_fetch_assoc($sql3)) {
    $idtopik = $row3['idtopik'];
    array_push($idtopiklist, $idtopik);
}
$idtopikarray = array_unique($idtopiklist);
$sql4 = mysqli_query($conn, "SELECT * FROM perekodan WHERE (nop = '$nop')");
while ($row4 = mysqli_fetch_assoc($sql4)) {
    $idtopik = $row4['idtopik'];
    array_push($doneidtopiklist, $idtopik);
}
$doneidtopikarray = array_unique($doneidtopiklist);
$missingidtopikarray = array_diff($idtopikarray, $doneidtopikarray);
echo "<br>";
echo "<div><h5>Kerja Rumah: </h5></div>";
echo "<table style='width: 100%' class='tablesort'>
<thead>
<tr>
  <th style='width:50px'>No.</th>
  <th style='width:150px'>Topik</th>
  <th>Markah</th>
  <th>Gred</th>
  <th>Tarikh</th>
  <th>Status</th>
</tr>
</thead>
";
echo "<tbody>";
foreach ($doneidtopikarray as $value) {
  $sql5 = mysqli_query($conn, "SELECT * FROM perekodan WHERE (idtopik = '$value')");
  $row5 = mysqli_fetch_assoc($sql5);
  $markah = $row5['mar'];
  $tarikh =$row5['tar'];
  $totalmarkah += $markah;
  array_push($markahlist, $markah);
  $gred = $row5['gred'];
  $sql6 = mysqli_query($conn, "SELECT * FROM topik WHERE (idtopik = '$value')");
  $row6 = mysqli_fetch_assoc($sql6);
  $topik = $row6['topik'];
  array_push($topiklist, $topik);
  echo "<tr class='item'>";
  echo "<td>".$counter."</td>";
  echo "<td>".$topik."</td>";
  echo "<td>".$markah."</td>";
  echo "<td>".$gred."</td>";
  echo "<td>".$tarikh."</td>";
  echo "<td><i style='margin-top: 5px; margin-bottom: 5px;' class='fas fa-check-circle'></i></td>";
  echo "</tr>";
  echo "<tr class='spacer'></tr>";
  $counter ++;
  $donecounter ++;
}
$topikdata = json_encode($topiklist);
$markahdata = json_encode($markahlist);
foreach ($missingidtopikarray as $value) {
  $sql7 = mysqli_query($conn, "SELECT * FROM topik WHERE (idtopik = '$value')");
  $row7 = mysqli_fetch_assoc($sql7);
  $topik = $row7['topik'];
  echo "<tr class='item'>";
  echo "<td>".$counter."</td>";
  echo "<td>".$topik."</td>";
  echo "<td>N/A</td>";
  echo "<td>N/A</td>";
  echo "<td>N/A</td>";
  echo "<td><i style='margin-top: 5px; margin-bottom: 5px;' class='fas fa-times-circle'></i></td>";
  echo "</tr>";
  echo "<tr class='spacer'></tr>";
  $counter ++;
}
echo "</tbody>";
echo "</table>";
 
echo "<div>";
echo "<br>";
if ($totalmarkah <= 0) {
  $avgmar = "-";
} else {
  $avgmar = $totalmarkah / $donecounter;
  $avgmar = number_format((float)$avgmar, 2, '.', '');
}
echo "<h5>Purata Markah: ".$avgmar."</h5>";
echo "</div>";
echo "<br>";
echo "<canvas id='myChart'></canvas>";
echo "<script>
var ctx = document.getElementById('myChart').getContext('2d');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'line',

    // The data for our dataset
    data: {
        labels: $topikdata,
        datasets: [{
            label: 'Markah',
            backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 99, 132)',
            data: $markahdata
        }]
    },

    // Configuration options go here
    options: {}
});
</script>
";
echo "</div>"; 
?>